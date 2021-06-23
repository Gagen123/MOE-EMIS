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
                                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Basic Information</a>
                                </li>
                                <li class="nav-item border-left border-right">
                                    <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Staff & Student Information</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-four-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                                <strong><i class="fas fa-file-alt mr-1"></i> Mission</strong>
                                <p class="text-muted">
                                    {{form.mission}}
                                </p>

                                <strong><i class="fas fa-file-alt mr-1"></i> Vision</strong>
                                <p class="text-muted">
                                    {{form.vission}}
                                </p>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                                <div class="card-body p-0">
                                    <div class="form-group row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-10">
                                            <table class="table table-sm">
                                                <thead class="bg-info">
                                                     <tr>
                                                         <th>Organization Name</th>
                                                         <th><span class="text-bold">{{existing_details.name}}</span></th>
                                                      </tr>
                                                  </thead>
                                                 <tbody>
                                                  <tr>
                                                     <td>Level</td>
                                                     <td>{{levelArray[existing_details.levelId]}}</td>
                                                   </tr>
                                                   <tr>
                                                        <td>Year of Establishment</td>
                                                        <td>{{existing_details.yearOfEstablishment}}</td>
                                                  </tr>
                                                  <tr>
                                                      <td>RCSC/ZEST Code</td>
                                                     <td>{{existing_details.zestAgencyCode}}</td>
                                                  </tr>
                                                  <tr>
                                                     <td>MOF Code</td>
                                                     <td>{{existing_details.mofCode}}</td>
                                                 </tr>
                                                 <tr>
                                                     <td>Organization Code</td>
                                                     <td>{{existing_details.code}}</td>
                                                   </tr>
                                                   <tr>
                                                      <td>Has Shift System</td>
                                                     <td>{{existing_details.hasShiftSystem =='1'? 'yes':'No'}}</td>
                                                   </tr>
                                                   <tr>
                                                     <td>Has Counselling room</td>
                                                     <td>{{existing_details.hasCounselingRoom =='1'? 'yes':'No'}}</td>
                                                   </tr>
                                                   <tr>
                                                      <td>Has CE</td>
                                                      <td>{{existing_details.hasCE =='1'? 'yes':'No'}}</td>
                                                   </tr>
                                                   <tr>
                                                       <td>Has Feeding School</td>
                                                       <td>{{existing_details.isFeedingSchool =='1'? 'yes':'No'}}</td>
                                                  </tr>
                                                  <tr>
                                                       <td>GeoPolitically Located</td>
                                                       <td>{{existing_details.isGeoPoliticallyLocated =='1'? 'yes':'No'}}</td>
                                                  </tr>
                                                  <tr>
                                                     <td>Is Resource Center</td>
                                                     <td>{{existing_details.isResourceCenter =='1'? 'yes':'No'}}</td>
                                                  </tr>
                                                  <tr>
                                                      <td>Is an Inclusive School</td>
                                                       <td>{{existing_details.isSenSchool =='1'? 'yes':'No'}}</td>
                                                  </tr>
                                                   <tr>
                                                       <td>Category</td>
                                                       <td>{{existing_details.category == 'public_ecr' ? "ECR" : existing_details.category == 'public_school' ? "Public School" : existing_details.category == 'private_school' ? "Private School" : existing_details.category == 'public_eccd' ? "Public ECCD" : "Private ECCD" }}</td>
                                                   </tr>
                                              </tbody>
                                          </table>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-10">
                                            <table class="table table-sm">
                                                <thead class="bg-info">
                                                    <tr>
                                                        <th>Location and Contact Detial</th>
                                                        <th><span class="text-bold"></span></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Longitude</td>
                                                        <td>{{existing_details.longitude}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Lattitude</td>
                                                        <td>{{existing_details.latitude}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Altitude</td>
                                                        <td>{{existing_details.altitude}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>School Contact No</td>
                                                        <td>{{existing_details.mofCode}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Principal Contact No</td>
                                                        <td>{{}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Vice/Assistant Principal Contact No</td>
                                                        <td>{{}}</td>
                                                    </tr>
                                                    <tr>
                                                    <td>Mail ID</td>
                                                        <td>{{existing_details.mailid}}</td>
                                                    </tr>
                                                    <tr>
                                                    <td>Website Link</td>
                                                        <td>{{existing_details.wesitelink}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
 
                            <!--- modified code  -->
                            <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                                <div class="card-body p-0">
                                    <div class="form-group row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-10">
                                            <table class="table table-sm">
                                                <thead class="bg-info">
                                                     <tr>
                                                         <th>Staff Information</th>
                                                         <th></th>
                                                      </tr>
                                                  </thead>
                                                 <tbody>
                                                  <tr>
                                                     <td>Total Male Teachers</td>
                                                     <td></td>
                                                   </tr>
                                                   <tr>
                                                        <td>Total Female Teachers</td>
                                                        <td></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Total Female Special Education Teachers</td>
                                                     <td></td>
                                                  </tr>
                                                    <tr>
                                                       <td>Total Male Special Education Teachers</td>
                                                       <td></td>
                                                   </tr>
                                                  <tr>
                                                     <td>Total Male Support Staff</td>
                                                     <td></td>
                                                 </tr>
                                                 <tr>
                                                     <td>Total Female Support Staff</td>
                                                     <td></td>
                                                   </tr>
                                                   <tr>
                                                      <td>Total Female Counselors</td>
                                                     <td></td>
                                                   </tr>
                                                   <tr>
                                                     <td>Total Male Counselors</td>
                                                     <td></td>
                                                   </tr>
                                                   <tr>
                                                      <td>Total Female Sports Instructor</td>
                                                      <td></td>
                                                   </tr>
                                                   <tr>
                                                       <td>Total Male Sports Instructors</td>
                                                       <td></td>
                                                  </tr>
                                                  <!-- <tr>
                                                       <td>GeoPolitically Located</td>
                                                       <td></td>
                                                  </tr> -->
                                              </tbody>
                                          </table>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-10">
                                            <table class="table table-sm">
                                                <thead class="bg-info">
                                                    <tr>
                                                        <th>Student Information</th>
                                                        <th><span class="text-bold"></span></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Total Female Student</td>
                                                        <td>{{existing_details.longitude}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total Male Sudent</td>
                                                        <td>{{existing_details.latitude}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total Female Student with Disabilities</td>
                                                        <td>{{existing_details.altitude}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total Male Student with Disabilities</td>
                                                        <td>{{existing_details.mofCode}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <!-- <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
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
                            </div> -->
                            


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
