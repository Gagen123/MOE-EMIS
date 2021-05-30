<template>
<div>
    <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
        <li class="form-inline "><h6 class="pt-1">Organization Profile</h6></li>
    </ol>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3"> 
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img v-if="isprofile" class="img-fluid img-circle" v-bind:src="'storage/'+form.profile_path" alt="LOGO" onerror="this.src='img/question.PNG'">
                                <img v-else class="profile-user-img img-fluid img-circle" src="img/question.PNG" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center">{{orgDetails}}</h3>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <span>Upload/Change logo</span>
                                <input type="file" class="form-control" v-on:change="onChangeFileUpload">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-sm-9 col-md-9 col-lg-9">
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header p-0 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Mission & Vision</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Basic Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Staff & Student Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Organizational Facilities</a>
                            </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-four-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                                <strong><i class="fas fa-file-alt mr-1"></i> Mission</strong>
                                <p class="text-muted">
                                    To Serve the Nation
                                </p>

                                <strong><i class="fas fa-file-alt mr-1"></i> Vision</strong>
                                <p class="text-muted">
                                    Education for All
                                </p>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                                <strong><i class="fas fa-building mr-1"></i> School Level</strong>
                                <div class="card-body p-0">
                                    <table class="table table-sm">
                                    <thead>
                                        <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Task</th>
                                        <th>Progress</th>
                                        <th style="width: 40px">Label</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <td>1.</td>
                                        <td>Update software</td>
                                        <td>
                                            <div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-danger">55%</span></td>
                                        </tr>
                                        <tr>
                                        <td>2.</td>
                                        <td>Clean database</td>
                                        <td>
                                            <div class="progress progress-xs">
                                            <div class="progress-bar bg-warning" style="width: 70%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-warning">70%</span></td>
                                        </tr>
                                    </tbody>
                                    </table>
                                </div>
                                <strong><i class="fas fa-map-marker mr-1"></i> Location</strong>
                                <div class="card-body p-0">
                                    <table class="table table-sm">
                                    <thead>
                                        <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Task</th>
                                        <th>Progress</th>
                                        <th style="width: 40px">Label</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <td>1.</td>
                                        <td>Update software</td>
                                        <td>
                                            <div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-danger">55%</span></td>
                                        </tr>
                                        <tr>
                                        <td>2.</td>
                                        <td>Clean database</td>
                                        <td>
                                            <div class="progress progress-xs">
                                            <div class="progress-bar bg-warning" style="width: 70%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-warning">70%</span></td>
                                        </tr>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                                <strong><i class="fas fa-users mr-1"></i> Staff</strong>
                                <div class="card-body p-0">
                                    <table class="table table-sm">
                                    <thead>
                                        <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Task</th>
                                        <th>Progress</th>
                                        <th style="width: 40px">Label</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <td>1.</td>
                                        <td>Update software</td>
                                        <td>
                                            <div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-danger">55%</span></td>
                                        </tr>
                                        <tr>
                                        <td>2.</td>
                                        <td>Clean database</td>
                                        <td>
                                            <div class="progress progress-xs">
                                            <div class="progress-bar bg-warning" style="width: 70%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-warning">70%</span></td>
                                        </tr>
                                    </tbody>
                                    </table>
                                </div>
                                <hr>
                                <strong><i class="fas fa-graduation-cap mr-1"></i> Students</strong>
                                <div class="card-body p-0">
                                    <table class="table table-sm">
                                    <thead>
                                        <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Task</th>
                                        <th>Progress</th>
                                        <th style="width: 40px">Label</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <td>1.</td>
                                        <td>Update software</td>
                                        <td>
                                            <div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-danger">55%</span></td>
                                        </tr>
                                        <tr>
                                        <td>2.</td>
                                        <td>Clean database</td>
                                        <td>
                                            <div class="progress progress-xs">
                                            <div class="progress-bar bg-warning" style="width: 70%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-warning">70%</span></td>
                                        </tr>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                                <div class="card-body p-0">
                                    <table class="table table-sm">
                                    <thead>
                                        <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Task</th>
                                        <th>Progress</th>
                                        <th style="width: 40px">Label</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <td>1.</td>
                                        <td>Update software</td>
                                        <td>
                                            <div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-danger">55%</span></td>
                                        </tr>
                                        <tr>
                                        <td>2.</td>
                                        <td>Clean database</td>
                                        <td>
                                            <div class="progress progress-xs">
                                            <div class="progress-bar bg-warning" style="width: 70%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-warning">70%</span></td>
                                        </tr>
                                        <tr>
                                        <td>3.</td>
                                        <td>Cron job running</td>
                                        <td>
                                            <div class="progress progress-xs progress-striped active">
                                            <div class="progress-bar bg-primary" style="width: 30%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-primary">30%</span></td>
                                        </tr>
                                        <tr>
                                        <td>4.</td>
                                        <td>Fix and squish bugs</td>
                                        <td>
                                            <div class="progress progress-xs progress-striped active">
                                            <div class="progress-bar bg-success" style="width: 90%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-success">90%</span></td>
                                        </tr>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>
                        </div>
                        <!-- /.card -->
                        </div>
                </div>
            </div>
        </div>
    </section>  
</div>
</template>
<script>
    export default {
        data(){
            return{
                orgDetails:'',
                orgStudentDetails:[],
                orgStaffDetails:[],

                isprofile:false,
                form: new form({
                    org_id: '',
                    attachments:'',
                    vission: '',
                    mission:'',
                    profile_path:'',
                }) 
            }
        },
        methods:{
            getorgProfile(rogId){
                axios.get('organization/getOrgProfile/'+rogId)
                .then(response => {
                    let data = response.data.data;
                    this.form.vission=data.vission;
                    this.form.mission=data.mission;
                    this.form.org_id=data.org_id;
                    this.form.profile_path=data.logo_path;
                    this.orgDetails=data.orgName+' '+data.level;
                    if(data.logo_path!=""){
                        this.isprofile=true;
                    }
                })    
                .catch(errors =>{ 
                    console.log(errors)
                });
            },
            getOrgStaffDetails(orgId){
                axios.get('loadCommons/getOrgStaffDetails'+orgId)
                .then(response => {
                    let data = response;
                    this.dataList =  data.data.data;
                })
                .catch(function (error) {
                    if(error.toString().includes("500")){
                        $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                    }
                });
            }
        },
        mounted(){
            axios.get('common/getSessionDetail')
            .then(response =>{
                let data = response.data.data;
                this.form.org_id=data['Agency_Code'];
                this.getorgProfile(data['Agency_Code']);
            })    
            .catch(errors =>{ 
                console.log(errors)
            });
        }
    }
</script>
