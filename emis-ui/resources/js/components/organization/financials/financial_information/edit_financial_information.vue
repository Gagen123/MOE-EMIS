<template>
    <div>
        <form class="form-horizontal" enctype="multipart/form-data" action="#" method="POST">
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Type:<i class="text-danger">*</i></label>
                    <select v-model="finacial_form.type" :class="{ 'is-invalid select2 select2-hidden-accessible': finacial_form.errors.has('type') }" class="form-control select2" name="type" id="type">
                        <option v-for="(item, index) in typeList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <has-error :form="finacial_form" field="type"></has-error>
                </div> 
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="mb-1">Amount:<i class="text-danger">*</i></label>
                        <input type="text" @change="remove_error('amount')" v-model="finacial_form.amount" :class="{ 'is-invalid': finacial_form.errors.has('amount') }" class="form-control" name="amount" id="amount" >
                        <has-error :form="finacial_form" field="amount"></has-error>
                    </div> 
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Date:<span class="text-danger">*</span></label> 
                    <input class="form-control popupDatepicker"  :class="{ 'is-invalid': finacial_form.errors.has('date') }" id="date" @change="remove_err('date')" type="text">
                    <has-error :form="finacial_form" field="date"></has-error>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <label class="mb-0.5">Remarks:</label>
                    <textarea @change="remove_error('remarks')" class="form-control" v-model="finacial_form.remarks" :class="{ 'is-invalid': finacial_form.errors.has('remarks') }" name="remarks" id="remarks"></textarea>
                    <has-error :form="finacial_form" field="remarks"></has-error>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="button" @click="formaction('reset')" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-redo"></i> Reset</button>
                <button type="button" v-on:click="updateForm" class="btn btn-success"> <i class="fas fa-save"></i> update</button>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    data(){
        return {
            typeList:[],

            finacial_form: new form({
                id:'',
                type: '',
                amount: '',
                date:'',
                remarks: '',
                organizationId:'',
                financialInformationId:'',
            }),
        }
    },
    methods: {

        loadtypeList(){
            axios.get('masters/organizationMasterController/loadFinacialtype')
            .then(response => {
                let data = response;
                this.typeList =  data.data.data;
                // alert(JSON.stringify(data.data.data[0].name))
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });

        },
        updateForm(){
            this.finacial_form.date=this.formatYYYYMMDD($('#date').val());
            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
                }
                // this.$Progress.start();

                let formData = new FormData(); 
                formData.append('id', this.finacial_form.id);
                formData.append('type', this.finacial_form.type);
                formData.append('amount', this.finacial_form.amount);
                formData.append('date', this.finacial_form.date); 
                formData.append('remarks', this.finacial_form.remarks);
                
                axios.post('/organization/updateFinancialInfo',formData,config)
                .then(()=>{
                    Toast.fire({
                        icon: 'success',
                        title: 'Data updated successfully'
                    });
                    this.$router.push('/list_financial_info');
                })
                .catch(()=>{console.log("Error.....")})
                 
            

        },
    
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },
     
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="type"){
                this.finacial_form.type=$('#type').val();
            }
        },


        getfinancialInformation(finId){
           // alert (this.finacial_form.id );
            axios.get('organization/getFinancialInfoEdit/'+finId)
            .then((response) => {  
                let data=response.data.data;
                this.finacial_form.type                    =    data.financialInformationId;
                $('#type').val(data.financialInformationId).trigger('change');
                this.loadtypeList();
                this.finacial_form.amount                  =    data.amount;
                this.finacial_form.date                    =    this.formatDateToddmmyyyy(data.date);
                $('#date').val(this.formatDateToddmmyyyy(data.date));
                // this.finacial_form.date                    =    data.date;
                this.finacial_form.remarks                 =    data.remarks;
                this.finacial_form.id                      =    data.id;
               
            })
            .catch((error) =>{  
                console.log("Error:"+error);
            }); 
        },
    },
     mounted() {
        $('[data-toggle="tooltip"]').tooltip();
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id')); 
        });
        
        Fire.$on('changefunction',(id)=> {
            this.changefunction(id);
        });

        
    },
    created() {
    this.loadtypeList();
    this.getfinancialInformation(this.$route.params.data.id);
   
    this.updateForm();
   
    // this.finacial_form.id=this.$route.params.data.id;
    // this.finacial_form.type=this.$route.params.data.type;
    // this.finacial_form.amount=this.$route.params.data.amount;
    // this.finacial_form.date = this.$route.params.data.date;
    // this.finacial_form.remarks =this.$route.params.data.status;
  },
    
}
</script>