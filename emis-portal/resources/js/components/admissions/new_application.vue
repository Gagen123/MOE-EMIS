<template>
<div class="container-fluid">
    <div class="content-header pb-0">
        <div class="content-header pt-1 pb-0">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-10">
                        <h5><b>Application to School</b></h5>
                    </div>
                    <span class="fa-pull-right">
                        <button type="button" class="btn btn-primary text-white btn-sm" @click="showadprocess('add_feeder')"><i class="fa fa-plus"></i> New Application</button>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-primary card-outline">
        <div class="card-body">
            <div class="card-body table-responsive pb-0">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="row form-group">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label class="required" >Name of Student :</label>
                            <label class="text-primary">{{ }}</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label class="required" >CID No/Reference  : </label>
                            <label class="text-primary">{{ }}</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label class="required" >Student Code :</label>
                            <label class="text-primary">{{ }}</label>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label >Date of Birth :</label>
                            <label class="text-primary">{{ }}</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label class="required" >School :</label>
                            <label class="text-primary">{{ }}</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <label class="card-header"><strong>Application Status</strong></label>
                        <table class="table table-bordered table-striped" id="OrgDetails">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Dzongkhag/Thromde</th>
                                    <th>School Name</th>
                                    <th>Application Date</th>
                                    <th>Status</th>
                                    <th>Student Decision</th>
                                    <th>School Decision</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in applicationList" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ dzongkhag.name }}</td>
                                    <td>{{ school.name }}</td>
                                    <td>{{ item.dateOfapply }}</td>
                                    <td><span class="badge badge-success">{{ item.Status}}</span></td>
                                    <td v-if="item.Student_Decision==null && item.school_decision=='Accepted'">
                                        <div class="btn-group btn-group-sm">
                                            <a href="#" class="btn btn-info" @click="StudentDecission(item.id,'Accepted')"> Accept</a>
                                        </div>
                                        <div class="btn-group btn-group-sm">
                                            <a href="#" class="btn btn-danger" @click="StudentDecission(item.id,'Cancelled')">Cancel</a>
                                        </div>
                                    </td>
                                    <td v-if="item.Student_Decision==null && item.school_decision==null">
                                        <div class="btn-group btn-group-sm">
                                            <a href="#" class="btn btn-danger" @click="StudentDecission(item.id,'Cancelled')">Cancel</a>
                                        </div>
                                    </td>
                                    <td v-else>
                                        {{ item.Student_Decision}}
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-lg">
                                            <td>{{ item.School_Decision=='Accepted'? "Accepted":'Under Process'}}</td>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        data(){
            return{
                is_student:false,
                user: "",
                cid:'',
                code:'',
                email:'',
                applicationList:[],
                std_decission:new form({
                    id:'',
                    type:'',
                }),
                dzongkhag:new form({
                name:'',

            }),
               school:new form({
                name:'',
            }),
            }
        },
        methods:{
            loadApplication(cid){
                 axios.get('TrackApplicationController/applicationListsbyCid/' +cid)
                    .then(response => {
                    let data = response;
                    this.applicationList = data.data.data;
                    this.getdzoName(data.data.data[0].dzongkhag)
                    this.geschoolName(data.data.data[0].OrgOrganizationId)
                });
            },
            loadStudentDetails(type, id){
                alert(type);
                axios.get('track_application/getApplicationDetails/'+type+'/'+id)
                    .then(response => {
                    let data = response;
                    this.studentDetails = data.data.data;
                });
            },
            getdzoName(dzo_id){
                 axios.get('load_dzongkhag_details_by_id/' +dzo_id)
                 .then(response => {
                    let data = response;
                    this.dzongkhag=data.data.data;
                 });
            },
            
           geschoolName(org_id){
                 axios.get('loadOrganizationDetailsbyOrgId/' +org_id)
                 .then(response => {
                    let data = response;
                    this.school=data.data.data;
                 });
            },
            StudentDecission(id, actionType){
              Swal.fire({
                  text: 'Are you sure, you want to ' +actionType+ '?',
                  showCancelButton: true,
                  confirmButtonColor: '#d33',
                  cancelButtonColor: '#3085d6',
                  confirmButtonText: 'Yes!'
                  }).then((result) => {
                    if (result.value) {
                        this.std_decission.id=id;
                        this.std_decission.type=actionType;

                        this.std_decission.post('TrackApplicationController/acceptApplication').then(()=>{
                            if( this.std_decission.type == 'Accept'){
                                Swal.fire(
                                'Accepted!',
                                'Your application has been forwarded successfully.',
                                'success'
                                );
                                }
                            else if( this.std_decission.type == 'Cancel'){
                                Swal.fire(
                                'Accepted!',
                                'Your application has been cancelled successfully.',
                                'success'
                                );
                            }
                        })
                    }
                  })
              },
        },
        created(){
            this.loadApplication(this.$route.query.cid);

        },
        mounted() {
            axios.get('getSessionDetail')
                .then(response => {
                    let data = response.data.data;
                    this.cid=data['std_id'];
                    this.code=data['std_code'];
                    this.type=data['user_type'];
                    this.email=data['email'];
                    if(data['user_type']!="Parent"){
                        this.is_student=true;
                        this.loadStudentDetails('student', this.code);
                    }
                    else if(data['user_type'] == "Parent"){
                        this.is_student=false;
                        this.loadApplicantDetails('new', this.email);
                    }
                })
                .catch(errors => {
                    console.log(errors)
                });
        }
    }
</script>
