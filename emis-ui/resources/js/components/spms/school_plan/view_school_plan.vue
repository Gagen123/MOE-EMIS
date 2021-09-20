<template>
    <div>
        <form class="bootbox-form">
            <div class="card-body">
                <div class="ml-2 row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>School:</label>
                        <br>
                        {{ school }} 
                    </div>
                </div> 
                <div class="row form-group ml-2">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Domain:</label> 
                         <br>
                        {{domain}}
                    </div>
                </div>
                <div class="row form-group ml-2">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>Activity (What?):</label> 
                        <br>
                        {{activity}}
                    </div>
                </div>
                <div class="row form-group ml-2">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>Objective (Why?):</label> 
                         <br>
                        {{objective}}
                    </div>
                </div>
                <div class="row form-group ml-2">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>Strategy (How?):</label> 
                         <br>
                        {{strategy}}
                    </div>
                </div>
                <div class="row form-group ml-2">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>Start Date:</label> 
                        <br>
                        {{start_date}}
                    </div>
                     <div class="col-lg-3 col-md-3 col-sm-2 col-xs-12">
                        <label>End Date:</label> 
                        <br>
                        {{end_date}}
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>Person Responsible (Who?):</label> 
                        <br>
                        {{person_responsible}}
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>Current Implementation Status:</label> 
                        <br>
                        {{form.implementation_status}}
                    </div>
                </div>
                <div class="ml-1 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table id="school-plan-view-detail-table" class="ml-0 table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Implementation Status</th> 
                                <th>Remarks</th> 
                                <th>Remarks By</th>
                                
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr v-for="(item,index) in statusHistory" :key="index">
                                <td>{{item.status_date}}</td>
                                <td>{{item.status}}</td>
                                <td>{{item.remarks}}</td>
                                <td>{{item.role}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                 <div class="row form-group ml-2">
                    <div v-if="form.roles =='Principal'" class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Implementation Status: <span class="text-danger">*</span></label> 
                        <select class="form-control form-control-sm" id="status_id" v-model="form.implementation_status_id" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('status_id') }" @change="remove_err('status_id')">
                            <option value=""> ---Select---</option>
                            <option v-for="(item1, index1) in status" :key="index1" v-bind:value="item1.id">
                                {{ item1.name }}
                            </option>
                        </select> 
                        <has-error :form="form" field="status_id"></has-error>
                    </div>
                </div>
                 <div class="row form-group ml-2">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>Your Remarks: <span class="text-danger">*</span></label> 
                        <textarea class="form-control" v-model="form.comment" :class="{ 'is-invalid': form.errors.has('comment') }" id="comment" @change="remove_err('comment')"></textarea>
                        <has-error :form="form" field="comment"></has-error>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button @click.prevent="save" class="btn btn-flat btn-sm btn-primary" ><i class="fa fa-save"></i> Save</button>
                <!-- <button type="button" @click="save('submit')" class="btn btn-flat btn-sm btn-primary"><i class="fas fa-check-circle"></i> Submit</button> -->
            </div>
        </form>
    </div>     
</template>
<script>
export default {
    data(){
        return {
            status:[],
            statusHistory:[],
            school:'',
            domain:'',
            activity:'',
            objective:'',
            strategy:'',
            start_date:'',
            end_date:'',
            remarks:'',
            person_responsible:'',
            user:[],
            form: new form({
               spm_school_plan_id:'',
               implementation_status_id:'',
               implementation_status:'',
               comment:'',
               full_name:'',
               roles:'',
               organization:'',
            }),
            dt:''
        }
    },
    methods: {
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid')
            }
        },
        getSchoolPlanDetails(){
            axios.get('spms/getSchoolPlanDetails/'+this.form.spm_school_plan_id)
            .then(response => {
                let data = response.data.data
                for(let i=0; data.length > i; i++){
                    this.domain = data[i]['domain']
                    this.activity = data[i]['activity']
                    this.objective = data[i]['objective']
                    this.strategy = data[i]['strategy']
                    this.start_date = data[i]['start_date']
                    this.end_date = data[i]['end_date']
                    this.remarks = data[i]['remarks']
                    this.person_responsible = data[i]['person_responsible']
                    this.form.implementation_status = data[i]['implementation_status']
                }
            })
            .catch(function (error){
              console.log("Error"+error)
            });
        },
        getSchoolPlanHistory(){
            axios.get('spms/getSchoolPlanHistory/'+this.form.spm_school_plan_id)
            .then(response => {
                let data = response.data.data
                this.statusHistory = data
            })
            .catch(function (error){
              console.log("Error"+error)
            });
        },
        getImplementationStatus(){
             axios.get('masters/loadSpmMasters/all_implemenatation_status')
            .then(response => {
                let data = response 
                this.status =  data.data.data
            })
            .catch(function (error){
              console.log("Error"+error)
            });
        },
        getorgName(orgId,accessLevel){
            let type="Headquarterbyid";
            if(accessLevel=="Org"){
                type="Orgbyid";
            }
            axios.get('loadCommons/loadOrgDetails/'+type+'/'+orgId)
            .then(response => {
                let data = response.data.data;
                this.form.organization=data['name'];
            })
            .catch(errors => {
                console.log(errors)
            });
        },
		save(){
            this.form.post('/spms/saveImplementtationStatus',this.form)
                .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.form.comment = ''
                    this.getSchoolPlanHistory()
                })
                .catch(() => {
                    console.log("Error.")
                })
		}, 
    },
    created(){
        this.form.spm_school_plan_id = this.$route.params.data.id
        this.form.implementation_status_id = this.$route.params.data.implementation_status_id
        this.school = this.$route.params.school_name
    },
    mounted(){
        this.dt = $("#school-plan-view-detail-table").DataTable({
            columnDefs: [
                { width: 70    , targets: 0},
                { width: 150    , targets: 1},
                { width: 80, targets: 3},
            ],
            "lengthChange": false,
            "searching": false,
        })
        this.getImplementationStatus()
        this.getSchoolPlanDetails()
        this.getSchoolPlanHistory()
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
            }).catch(errors => {
                console.log(errors)
            });
    },
     watch: {
        statusHistory(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#school-plan-view-detail-table").DataTable({
                    columnDefs: [
                        { width: 70, targets: 0},
                        { width: 150, targets: 1},
                        { width: 80, targets: 3},
                    ],
                    "lengthChange": false,
                    "searching": false,
                })
            });
        }
    }
}
</script>