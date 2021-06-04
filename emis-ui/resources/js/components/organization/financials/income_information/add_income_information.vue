<template>
    <div>
        <form class="form-horizontal" enctype="multipart/form-data" action="#" method="POST">
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Income Facilities/Source:<i class="text-danger">*</i></label>
                    <select v-model="income_form.income" :class="{ 'is-invalid select2 select2-hidden-accessible': income_form.errors.has('income') }" class="form-control select2" name="income" id="income">
                        <option v-for="(item, index) in incomeList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <has-error :form="income_form" field="income"></has-error>
                </div> 
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="mb-1">Amount Generated:<i class="text-danger">*</i></label>
                        <input type="text" @change="remove_error('amount')" v-model="income_form.amount" :class="{ 'is-invalid': income_form.errors.has('amount') }" class="form-control" name="amount" id="amount" >
                        <has-error :form="income_form" field="amount"></has-error>
                    </div> 
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Date:<span class="text-danger">*</span></label> 
                    <input class="form-control" v-model="income_form.date" :class="{ 'is-invalid': income_form.errors.has('date') }" id="date" @change="remove_err('date')" type="date">
                    <has-error :form="income_form" field="date"></has-error>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <label class="mb-0.5">Remarks:</label>
                    <textarea @change="remove_error('remarks')" class="form-control" v-model="income_form.remarks" :class="{ 'is-invalid': income_form.errors.has('remarks') }" name="remarks" id="remarks"></textarea>
                    <has-error :form="income_form" field="remarks"></has-error>
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
            incomeList:[],
            org_id:'2fea1ad2-824b-434a-a608-614a482e66c1',

            income_form: new form({
                id:'',
                income: '',
                amount: '',
                date: '',
                remarks: '',
                org_id:'',
                incomeFacilitiesId:'',
            }),
        }
    },
    methods: {
        getloadincomeList(){
            axios.get('masters/organizationMasterController/loadincomeList')
            .then(response => {
                let data = response;
                this.incomeList =  data.data.data[0];
                // alert(JSON.stringify(data.data.data[0].name))
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
            // alert("dsadsads");
            // this.$Progress.start();
            let formData = new FormData(); 
            formData.append('org_id', '0e663891-85f2-4a71-b11e-a74f6705b8f4');
            formData.append('incomeFacilitiesId','0e663891-85f2-4a71-b11e-a74f6705b8ff' );
            formData.append('income', this.finacial_form.income);
            formData.append('amount', this.finacial_form.amount);
            formData.append('date', this.finacial_form.date);
            formData.append('remarks', this.finacial_form.remarks);
            axios.post('/organization/saveFinancialInformation',formData,config)
            .then(()=>{
                Toast.fire({
                    icon: 'success',
                    title: 'Data  saved successfully'
                })
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
        this.getloadincomeList();
        this.submitForm();
       
  },
    
}
</script>