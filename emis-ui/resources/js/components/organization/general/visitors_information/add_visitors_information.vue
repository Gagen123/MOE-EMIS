<template>
    <div>
        <form class="bootbox-form" id="equipmentId">
            <div class="card-body">
                <!-- <div class="form-group row">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <label class="mb-1">Visitor Information:<i class="text-danger">*</i></label>
                        <select v-model="form.visitor_information" class="form-control" name="visitor_information" id="visitor_information">
                            <option v-for="(item, index) in visitorTypeList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="visitor_information"></has-error>
                    </div>
                </div> -->
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Name of the Visitor:<span class="text-danger">*</span></label> 
                        <input class="form-control" v-model="form.visitorname" :class="{ 'is-invalid': form.errors.has('visitorname') }" id="visitorname" @change="remove_err('visitorname')" type="text">
                        <has-error :form="form" field="visitorname"></has-error>
                    </div>   
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Designation:<span class="text-danger">*</span></label> 
                        <input class="form-control" v-model="form.designation" :class="{ 'is-invalid': form.errors.has('designation') }" id="designation" @change="remove_err('designation')" type="text">
                        <has-error :form="form" field="designation"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Parent Ministry/Agency:<span class="text-danger">*</span></label> 
                        <input class="form-control" v-model="form.minitsryOrAgency" :class="{ 'is-invalid': form.errors.has('minitsryOrAgency') }" id="minitsryOrAgency" @change="remove_err('minitsryOrAgency')" type="text">
                        <has-error :form="form" field="minitsryOrAgency"></has-error>
                    </div>
                </div>
                 <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Department/Division:<span class="text-danger">*</span></label> 
                        <input class="form-control" v-model="form.deptOrdivision" :class="{ 'is-invalid': form.errors.has('deptOrdivision') }" id="deptOrdivision" @change="remove_err('deptOrdivision')" type="text">
                        <has-error :form="form" field="visitorname"></has-error>
                    </div>   
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Contact No #:<span class="text-danger">*</span></label> 
                        <input class="form-control" v-model="form.contact" :class="{ 'is-invalid': form.errors.has('contact') }" id="contact" @change="remove_err('contact')" type="number">
                        <has-error :form="form" field="contact"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Date of Visit:<span class="text-danger">*</span></label> 
                        <input class="form-control" v-model="form.date" :class="{ 'is-invalid': form.errors.has('date') }" id="date" @change="remove_err('date')" type="date">
                        <has-error :form="form" field="date"></has-error>
                    </div>
                </div>
                <div class="form-group row">
                   <div class="col-lg-6 col-md-6 col-sm-8 col-xs-9">
                        <label class="mb-0.5">Purpose of visit:</label>
                        <textarea @change="remove_error('purposeOfvisit')" class="form-control" v-model="form.purposeOfvisit" :class="{ 'is-invalid': form.errors.has('purposeOfvisit') }" name="purposeOfvisit" id="purposeOfvisit"></textarea>
                        <has-error :form="form" field="purposeOfvisit"></has-error>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-8 col-xs-9">
                        <label class="mb-0.5">Target group:</label>
                        <textarea @change="remove_error('targetgroup')" class="form-control" v-model="form.targetgroup" :class="{ 'is-invalid': form.errors.has('targetgroup') }" name="targetgroup" id="targetgroup"></textarea>
                        <has-error :form="form" field="targetgroup"></has-error>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>No. of hour(s) spent in the school<span class="text-danger">*</span></label> 
                        <input class="form-control" v-model="form.noOfhours" :class="{ 'is-invalid': form.errors.has('noOfhours') }" id="noOfhours" @change="remove_err('noOfhours')" type="number">
                        <has-error :form="form" field="noOfhours"></has-error>
                    </div>
                </div>
               
                <div class="card-footer text-right">
                    <button type="button" @click="formaction('reset')" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-redo"></i> Reset</button>
                    <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    data(){
        return {
            dataList:[],
            visitorTypeList:[],

            org_id:'2fea1ad2-824b-434a-a608-614a482e66c1',

            form: new form({
                id:'',
                visitorname:'',
                designation:'',
                remarks: '',
                contact:'',
                minitsryOrAgency:'',
                deptOrdivision:'',
                noOfhours:'',
                visitor_information: '',
                targetgroup:'',
                purposeOfvisit:'',
                date: '',
               // action_type:'add'
            }),
        }
    },
    methods: {
        //need to get the organisation id and pass it as a parameter
        
        loadMastersList(uri='organization/loadVisitorInformation'){
            axios.get(uri)
            .then(response => {
                let data = response;
                console.log(data);
                this.dataList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        getVisitorTypeDropdown(uri = '/organization/getVisitorTypeDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.visitorTypeList = data;
            });
        },
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },
        formaction: function(type){
            if(type=="reset"){
                this.form.student= '';
                this.form.remarks='';
                this.form.status= 1;
            }
            if(type=="save"){
                this.form.post('/organization/saveVisitorInformation',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/list_visitors_information');
                })
                .catch(() => {
                    console.log("Error......")
                })
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
        this.getVisitorTypeDropdown();
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

        // this.loadMasterList();
    },
    
}
</script>