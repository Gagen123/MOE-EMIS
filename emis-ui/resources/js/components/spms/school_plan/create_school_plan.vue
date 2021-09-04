<template>
    <div>
        <form class="bootbox-form" autocomplete="off">
            <div class="card-body">
               <div class="ml-0 row form-group">
                    <div class="mr-2">
                        <label>School:</label> {{ form.organization }} 
                    </div>
                    <div>
                        <label>Year:</label>{{ form.year }} 
                    </div>
                </div> 
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Domain:<span class="text-danger">*</span></label> 
                        <select class="form-control select2" id="spm_domain_id" v-model="form.spm_domain_id" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('spm_domain_id') }" @change="remove_err('spm_domain_id')">
                            <option value=""> ---Select---</option>
                            <option v-for="(item, index) in domains" :key="index" v-bind:value="item.id">
                                {{ item.name }}
                            </option>
                        </select> 
                        <has-error :form="form" field="spm_domain_id"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-6">
                        <label>Activity (What?):<span class="text-danger">*</span></label> 
                        <textarea class="form-control form-control-sm" v-model="form.activity" :class="{ 'is-invalid': form.errors.has('activity') }" id="activity" @change="remove_err('activity')"></textarea>
                        <has-error :form="form" field="activity"></has-error>
                    </div>
                </div>
                <div class="row form-group ">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-6">
                        <label>Objective (Why?):<span class="text-danger">*</span></label> 
                        <textarea class="form-control form-control-sm" v-model="form.objective" :class="{ 'is-invalid': form.errors.has('objective') }" id="objective" @change="remove_err('objective')"></textarea>
                        <has-error :form="form" field="objective"></has-error>
                    </div>
                </div>
                <div class="row form-group ">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>Strategy (How?):<span class="text-danger">*</span></label> 
                        <textarea class="form-control form-control-sm" v-model="form.strategy" :class="{ 'is-invalid': form.errors.has('strategy') }" id="strategy" @change="remove_err('strategy')"></textarea>
                        <has-error :form="form" field="strategy"></has-error>
                    </div>
                </div>
                <div class="row form-group ">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Start Date:<span class="text-danger">*</span></label> 
                        <input type="date" class="form-control form-control-sm" v-model="form.start_date" :class="{ 'is-invalid': form.errors.has('start_date') }" id="start_date" @change="remove_err('start_date')">
                        <has-error :form="form" field="start_date"></has-error>
                    </div>
                     <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>End Date:<span class="text-danger">*</span></label> 
                        <input type="date" class="form-control form-control-sm" v-model="form.end_date" :class="{ 'is-invalid': form.errors.has('end_date') }" id="end_date" @change="remove_err('end_date')">
                        <has-error :form="form" field="end_date"></has-error>
                    </div>
                </div>
                <div class="row form-group ">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>Person Responsible (Who?):<span class="text-danger">*</span></label> 
                        <textarea class="form-control form-control-sm" v-model="form.person_responsible" :class="{ 'is-invalid': form.errors.has('person_responsible') }" id="person_responsible" @change="remove_err('person_responsible')"></textarea>
                        <has-error :form="form" field="person_responsible"></has-error>
                    </div>
                </div>
                <div class="row form-group ">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Implementation Status:<span class="text-danger">*</span></label> 
                        <select class="form-control select2" id="implementation_status_id" v-model="form.implementation_status_id" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('implementation_status_id') }" @change="remove_err('implementation_status_id')">
                            <option value=""> ---Select---</option>
                            <option v-for="(item1, index1) in status" :key="index1" v-bind:value="item1.id">
                                {{ item1.name }}
                            </option>
                        </select> 
                        <has-error :form="form" field="implementation_status_id"></has-error>
                    </div>
                </div>
                <div class="row form-group ">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>Remarks:<span class="text-danger">*</span></label> 
                        <textarea class="form-control form-control-sm" v-model="form.remarks" :class="{ 'is-invalid': form.errors.has('remarks') }" id="remarks" @change="remove_err('remarks')"></textarea>
                        <has-error :form="form" field="remarks"></has-error>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button @click.prevent="save('draft')" class="btn btn-flat btn-sm btn-primary" ><i class="fa fa-save"></i> Save as Draft</button>
                <button type="button" @click="save('submit')" class="btn btn-flat btn-sm btn-primary"><i class="fas fa-check-circle"></i> Submit</button>
            </div>
        </form>
    </div>     
</template>
<script>
export default {
    data(){
        return {
            domains:[],
            status:[],
            orgDetails:'',
            form: new form({
                year: new Date().getFullYear(),
                spm_domain_id:'',
                activity:'',
                objective:'',
                strategy:'',
                start_date:'',
                end_date:'',
                person_responsible:'',
                implementation_status_id:'',
                remarks:'',
                full_name:'',
                roles:'',
                organization:'',
                school_plan_status:'',
                action:'add'
            })
        }
    },
    methods: {
        getDomains(){
            axios.get('masters/loadSpmMasters/all_active_domains')
            .then(response => {
                let data = response 
                this.domains =  data.data.data
            })
            .catch(function (error){
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        getSchoolPlanStatus(){
             axios.get('masters/loadSpmMasters/all_school_plan_status')
            .then(response => {
                let data = response 
                this.status =  data.data.data
            })
            .catch(function (error){
              console.log("Error"+error)
            });
        },
        getorgName(rogId,accessLevel){
            let type="Headquarterbyid";
            if(accessLevel=="Org"){
                type="Orgbyid";
            }
            axios.get('loadCommons/loadOrgDetails/'+type+'/'+rogId)
            .then(response => {
                let data = response.data.data;
                this.form.organization=data['name'];

            })
            .catch(errors => {
                console.log(errors)
            });
        },
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid')
            }
        },
		save(action=''){
            if(action=="draft"){
                this.form.school_plan_status = 0
            }
            if(action=="submit"){
                this.form.school_plan_status = 1
            }
            this.form.post('/spms/saveSchoolPlan',this.form)
                .then(() => {
                Toast.fire({
                    icon: 'success',
                    title: 'Details added successfully'
                })
                Swal.fire({
                title: 'Do you want to add activity?',
                icon: 'question',
                showDenyButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                denyButtonText:'No',
                }).then((result) => {
                    if(result.isConfirmed) {
                        this.form.activity = ''
                        this.form.objective = ''
                        this.form.strategy = ''
                        this.form.start_date = ''
                        this.form.end_date = ''
                        this.form.person_responsible = ''
                        this.form.implementation_status_id = ''
                        this.form.remarks = ''
                    } else if (result.isDenied) {
                        this.$router.push('/lists-annual-school-plan');
                    }
                })
            })
            .catch(() => {
                console.log("Error.")
            })
		}, 
    },

    mounted(){
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').select2().
        on("select2:select", e => {
            const event = new Event("change", { bubbles: true, cancelable: true })
            e.params.data.element.parentElement.dispatchEvent(event)
        })
        .on("select2:unselect", e => {
        const event = new Event("change", { bubbles: true, cancelable: true })
        e.params.data.element.parentElement.dispatchEvent(event)
        });
        axios.get('common/getSessionDetail')
            .then(response => {
                let data = response.data.data;
                  let roleName="";
                for(let i=0;i<data['roles'].length;i++){
                    if(i==data['roles'].length-1){
                        roleName+=data['roles'][i].roleName;
                    }
                    else{
                        roleName+=data['roles'][i].roleName+', ';
                    }
                }
                this.form.full_name=data['Full_Name'];
                this.form.roles=roleName;
                this.getorgName(data['Agency_Code'],data['acess_level']);
            })
            .catch(errors => {
                console.log(errors)
            });
        this.getDomains()
        this.getSchoolPlanStatus()
    }
}
</script>