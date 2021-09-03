<template>
    <div>
        <form class="form-horizontal" enctype="multipart/form-data" action="#" method="POST">
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Type:<i class="text-danger">*</i></label>
                     <select v-model="form.financialInformationId" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('financialInformationId') }" class="form-control select2" name="financialInformationId" id="financialInformationId">
                        <option v-for="(item, index) in typeList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        
                    </select>
                    <has-error :form="form" field="financialInformationId"></has-error>
                </div> 
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="mb-1">Amount:<i class="text-danger">*</i></label>
                        <input type="text" @change="remove_error('amount')" v-model="form.amount" :class="{ 'is-invalid': form.errors.has('amount') }" class="form-control" name="amount" id="amount" >
                        <has-error :form="form" field="amount"></has-error>
                    </div> 
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Date:<span class="text-danger">*</span></label> 
                    <input class="form-control" v-model="form.date" :class="{ 'is-invalid': form.errors.has('date') }" id="date" @change="remove_err('date')" type="date">
                    <has-error :form="form" field="date"></has-error>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <label class="mb-0.5">Remarks:</label>
                    <textarea @change="remove_error('remarks')" class="form-control" v-model="form.remarks" :class="{ 'is-invalid': form.errors.has('remarks') }" name="remarks" id="remarks"></textarea>
                    <has-error :form="form" field="remarks"></has-error>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="button" @click="formaction('reset')" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-redo"></i> Reset</button>
                <button type="button" v-on:click="submitForm" class="btn btn-success"> <i class="fas fa-save"></i> Save</button>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    data(){
        return {
            typeList:[],
            form: new form({
                financialInformationId:'',
                amount: '',
                date:'',
                remarks: '',
              
            }),
        }
    },
    methods: {
        loadtypeList(){
            axios.get('masters/organizationMasterController/loadFinacialtype')
            .then(response => {
                let data = response;
                this.typeList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });

        },
        submitForm(){
            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
                }
                // this.$Progress.start();
                let formData = new FormData(); 
                formData.append('financialInformationId', this.form.financialInformationId);
                formData.append('amount', this.form.amount);
                formData.append('date', this.form.date);
                formData.append('remarks', this.form.remarks);
                axios.post('/organization/saveFinancialInfo',formData,config)
                .then(()=>{
                    Toast.fire({
                        icon: 'success',
                        title: 'Data  saved successfully'
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
            if(id=="financialInformationId"){
                this.form.financialInformationId=$('#financialInformationId').val();
            }
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
       
    },
    
}
</script>