<template>
<div>
    <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
        <li class="form-inline "><h6 class="pt-1">Organization Profile</h6></li>
    </ol>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- <div class="col-md-3"> 
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img v-if="isprofile" class="img-fluid img-circle" v-bind:src="'storage/'+form.profile_path" alt="LOGO" onerror="this.src='img/question.PNG'">
                                <img v-else class="profile-user-img img-fluid img-circle" src="img/question.PNG" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center">{{orgDetails}}</h3>
                        </div>
                    </div>
                </div> -->
                <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header p-0 border-bottom-0">
                            <ul class="nav nav-tabs border-primary" id="custom-tabs-four-tab" role="tablist">
                                <li class="nav-item border-left border-right">
                                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Mission & Vision</a>
                                </li>
                                <li class="nav-item border-left border-right">
                                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Objectives</a>
                                </li>
                                <li class="nav-item border-left border-right">
                                    <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Staff Information</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-four-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                                <strong><i class="fas fa-file-alt mr-1"></i> Mission</strong>
                                <p class="text-muted">
                                    An educated and enlightened society of GNH, built and sustained on the unique Bhutanese values of tha dam-tsig ley gju-drey.<br>
                                </p>

                                <strong><i class="fas fa-file-alt mr-1"></i> Vision</strong>
                                <p class="text-muted">
                                    Develop sound educational policies that enable the creation of a knowledge-based GNH society.<br>
                                    Provide equitable, inclusive and quality education and lifelong learning opportunities to all children and harness their full potential to become productive citizens.<br>
                                    Equip all children with appropriate knowledge, skills and values to cope with the challenges of the 21st century.    <br>                       
                                </p>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                                <div class="card-body p-0">
                                    <strong><i class="fas fa-file-alt mr-1"></i> Objectives</strong>
                                    <p class="text-muted">
                                        The Ministry of Education presently is focused on achieving the following Objectives:<br>
                                        To improve relevance and quality of education<br>
                                        To improve access to and sustainability of education<br>
                                        To strengthen youth development programme and services<br>
                                        To enhance adult literacy and lifelong learning<br>
                                        To ensure full utilization of budget<br>
                                        To enable effective and efficient ICT Service delivery.  <br>                       
                                    </p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                                <strong><i class="fas fa-users mr-1"></i> Staff</strong>
                                <div class="card-body p-0">
                                    <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Total Male Teacher</th>
                                            <th>12</th>
                                        </tr>
                                         <tr>
                                            <th>Total FeMale Teacher</th>
                                            <th>10</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Total Teaching Staff</td>
                                            <td>8</td>
                                        </tr>
                                        <tr>
                                            <td>Total Non Teaching Staff</td>
                                            <td>12</td>
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
                                            <th>Total Male Student</th>
                                            <th>360</th>
                                        </tr>
                                        <tr>
                                            <th>Total Female Student</th>
                                            <th>155</th>
                                        </tr>
                                    </thead>
                                    
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                                <div class="card-body p-0">
                                    <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <!-- <tbody>
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
                                    </tbody> -->
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
                isprofile:false,
                existing_details:'',
                levelArray:{},
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
            getLevel(uri = '/organization/getLevelInDropdown'){
                axios.get(uri)
                .then(response => {
                    let data = response.data;
                    for(let i=0;i<data.length;i++){
                        this.levelArray[data[i].id] = data[i].name; 
                    }
                });
            },
            loadPriviousOrgDetails(org_id){
                axios.get('loadCommons/loadOrgDetails/fullOrgDetbyid/'+org_id)
                .then(response => {
                    this.existing_details=response.data.data;
                    // this.getgewog(response.data.data.dzongkhagId,response.data.data.gewogId);
                    // this.getVillage(response.data.data.gewogId,response.data.data.chiwogId);
                })
                .catch((error) => {  
                    console.log("Error: "+error);
                });
            },
           
        },
        mounted(){
            this.getLevel();
            if(this.$route.query.org_id!=undefined && this.$route.query.org_id!=""){
                this.getorgProfile(this.$route.query.org_id);
                this.loadPriviousOrgDetails(this.$route.query.org_id);
            }
            else{
                axios.get('common/getSessionDetail')
                .then(response =>{
                    let data = response.data.data;
                    this.getorgProfile(data['Agency_Code']);
                    this.loadPriviousOrgDetails(data['Agency_Code']);
                }) ;
            }
        }
    }
</script>
