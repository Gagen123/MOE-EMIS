<template>
<div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
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
                                <div class="form-group row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <strong><i class="fas fa-file-alt mr-1"></i> Mission mission</strong>
                                        <p class="text-muted">
                                            {{form.mission}}
                                        </p>

                                        <strong><i class="fas fa-file-alt mr-1"></i> Vision</strong>
                                        <p class="text-muted">
                                            {{form.vission}}
                                        </p>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <span id="preview_sec"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                                <div class="card-body ">
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
                                                    <template v-if="existing_details.category!=undefined && !existing_details.category.toLowerCase().includes('eccd')" >
                                                        <tr>
                                                            <td >Levels</td>
                                                            <td >{{levelArray[existing_details.levelId]}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>MOF Code</td>
                                                            <td>{{existing_details.mofCode}}</td>
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
                                                            <td>Is Resource Center</td>
                                                            <td>{{existing_details.isResourceCenter =='1'? 'yes':'No'}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Is an Inclusive School</td>
                                                            <td>{{existing_details.isSenSchool =='1'? 'yes':'No'}}</td>
                                                        </tr>

                                                    </template>
                                                    <tr>
                                                        <td>Year of Establishment</td>
                                                        <td>{{existing_details.yearOfEstablishment}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>RCSC/ZEST Code</td>
                                                        <td>{{existing_details.zestAgencyCode}}</td>
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
                                                       <td>GeoPolitically Located</td>
                                                       <td>{{existing_details.isGeoPoliticallyLocated =='1'? 'yes':'No'}}</td>
                                                    </tr>
                                                 
                                                
                                                   <tr>
                                                       <td>Category{{existing_details.category}}</td>
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
                                                <!-- <tbody v-if="std_data"> -->
                                                <tbody>
                                                    <tr>
                                                        <td>Longitude</td> 
                                                        <td><span v-if="loc_details!=null && loc_details.longitude!=null  && loc_details.longitude!=undefined">{{loc_details.longitude}}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Lattitude</td>
                                                        <td><span v-if="loc_details!=null && loc_details.latitude!=null  && loc_details.latitude!=undefined">{{loc_details.latitude}}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Altitude</td>
                                                         <td><span v-if="loc_details!=null && loc_details.altitude!=null  && loc_details.altitude!=undefined">{{loc_details.altitude}}</span></td>
                                                        <!-- <td>{{loc_details.altitude}}</td> -->
                                                    </tr>
                                                    <tr>
                                                        <td>School Contact No</td>
                                                         <td><span v-if="contactdetail!=null && contactdetail.phone!=null  && contactdetail.phone!=undefined">{{contactdetail.phone}}</span></td>
                                                        <!-- <td>{{contactdetail.phone}}</td> -->
                                                    </tr>
                                                    <tr>
                                                    <td>Mail ID</td>
                                                     <td><span v-if="contactdetail!=null && contactdetail.email!=null  && contactdetail.email!=undefined">{{contactdetail.email}}</span></td>
                                                        <!-- <td>{{contactdetail.email}}</td> -->
                                                    </tr>
                                                    <tr>
                                                    <td>Website Link</td>
                                                     <td><span v-if="contactdetail!=null && contactdetail.website!=null  && contactdetail.website!=undefined">{{contactdetail.website}}</span></td>
                                                        <!-- <td>{{contactdetail.website}}</td> -->
                                                    </tr>
                                                    <tr>
                                                    <td>Facebook Link</td>
                                                      <td><span v-if="contactdetail!=null && contactdetail.facebookLink!=null  && contactdetail.facebookLink!=undefined">{{contactdetail.facebookLink}}</span></td>
                                                        <!-- <td>{{contactdetail.facebookLink}}</td> -->
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
                                                        <td>Male Teachers</td>
                                                        <td>{{total_Staff.Totalmale}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Female Teachers</td>
                                                        <td>{{total_Staff.TotalFemale}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Total</b></td>
                                                        <td><b>{{total_Staff.TOTAL}}</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <template v-if="existing_details.category!=undefined && !existing_details.category.toLowerCase().includes('eccd')">
                                                        <tr>
                                                            <td>Female Special Education Teachers</td>
                                                            <td>{{isSen.femaleSen}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Male Special Education Teachers</td>
                                                            <td>{{isSen.maleSen}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Total</b></td>
                                                            <td><b>{{isSen.totalSen}}</b></td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Total Support Staff(Both Male & Female)</b></td>
                                                            <td><b></b></td>
                                                        </tr>
                                                       
                                                        <tr>
                                                            <td>Female Counselors</td>
                                                            <td>{{counselor.Femalecounselor}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Male Counselors</td>
                                                            <td>{{counselor.Malecounselor}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Total</b></td>
                                                            <td><b>{{counselor.TOTALCouunselor}}</b></td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Female Sports Instructor</td>
                                                            <td>{{SportInstructor.FemaleSportInst}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Male Sports Instructors</td>
                                                            <td>{{SportInstructor.MaleSportInst}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Total</b></td>
                                                            <td><b>{{SportInstructor.TotalSportsInst}}</b></td>
                                                        </tr>
                                                    </template>
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
                                                    <tr v-for="(item, index) in studentData" :key="index">
                                                        <td> {{genderArray[item.CmnSexId]}} Students</td>
                                                        <td> {{item.sex}}</td>
                                                    </tr>
                                                    <tr>
                                                            <td><b>Total</b></td>
                                                            <td><b>{{totalGeneralStudent}}</b></td>
                                                    </tr>
                                                    <tr>
                                                            <td></td>
                                                            <td></td>
                                                    </tr>
                                                    <tr v-for="(item1, count) in studentSenData" :key="'A'+count">
                                                        <td> {{genderArray[item1.CmnSexId]}} Students with Disabilities</td>
                                                        <td> {{item1.sen}}</td>
                                                    </tr>
                                                    <tr>
                                                            <td><b>Total</b></td>
                                                            <td><b>{{totalSenStudent}}</b></td>
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
                genderArray:{},
                isprofile:false,
                std_data:false,
                existing_details:'',
                staff_details:'',
                contactdetail:[],
                loc_details:[],
                totalGeneralStudent:0,
                totalSenStudent:0,
                levelArray:{},
                studentData:[],
                studentSenData:[],
                total_Staff:[],
                counselor:[],
                SportInstructor:[],
                isSen:[],
                form: new form({
                    org_id: '',
                    attachments:'',
                    vission: '',
                    mission:'',
                    profile_path:'',

                }),
            }
        },
        methods:{
            // getorgProfile(rogId){
            //     axios.get('organization/getOrgProfile/'+rogId)
            //     .then(response => {
            //         let data = response.data.data;
            //         this.form.vission=data.vission;
            //         this.form.mission=data.mission;
            //         this.form.profile_path=data.logo_path;
            //         this.orgDetails=data.orgName+' '+data.level;
            //         if(data.logo_path!=""){
            //             this.isprofile=true;
            //         } 

            //     })
            //     .catch(errors =>{
            //         console.log(errors)
            //     });
            // },
            getorgProfile(rogId){
               // alert(rogId);
                axios.get('organization/getOrgProfile/'+rogId)
                .then(response => {
                    let data = response.data.data;
                    this.form.vission=data.vission;
                    this.form.mission=data.mission;
                    this.form.objective=data.objective;
                    this.form.org_id=data.org_id;
                    this.form.profile_path=data.logo_path;
                    this.orgDetails=data.orgName;
                    if(data.level!=undefined && data.level!=null && data.level!=""){
                        this.orgDetails=data.orgName+' '+data.level;
                    }
                    if(data.logo_path!=""){
                        this.isprofile=true;
                    }
                })
                .catch(errors =>{
                    console.log(errors)
                });
            },
            /**
             * to load the array definitions of class, stream and section
             */
            loadGenderArrayList(uri="masters/loadGlobalMasters/all_gender"){
                axios.get(uri)
                .then(response => {
                    let data = response.data.data;
                    for(let i=0;i<data.length;i++){
                        this.genderArray[data[i].id] = data[i].name;
                    }
                })
            },
            getStudentData(rogId){
                axios.get('students/loadStudentInformation/general')
                .then(response => {
                    this.studentData=response.data;
                    for(let i=0;i<this.studentData.length;i++){
                        this.totalGeneralStudent += this.studentData[i].sex;
                    }

                })
                .catch(errors =>{
                    console.log(errors)
                });
            },
            getSenStudentData(rogId){
                axios.get('students/loadStudentInformation/sen')
                .then(response => {
                    this.studentSenData=response.data;
                    for(let i=0;i<this.studentSenData.length;i++){
                        this.totalSenStudent += this.studentSenData[i].sen;
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
              //  alert(org_id)
                axios.get('loadCommons/loadOrgDetails/fullOrgDetbyid/'+org_id)
                .then(response => {
                     alert(JSON.stringify(response.data));

                    this.existing_details=response.data.data;
                    this.contactdetail=response.data.data.contactDetails;
                    this.loc_details=response.data.data.loc_details;

                   // alert(this.loc_details);
                    this.std_data=true;
                    if(response.data.data.locationDetials.googleMapPath!=null && response.data.data.locationDetials.googleMapPath!=undefined){
                        let mapid=response.data.data.locationDetials.googleMapPath;
                        mapid=mapid.replace('width="600"','width="450"');
                        mapid=mapid.replace('height="450"','height="300"');
                        mapid=mapid.replace('width="800"','width="450"');
                        mapid=mapid.replace('height="600"','height=300"');
                        $("#preview_sec").html(mapid);
                    }
                    
                    // this.getgewog(response.data.data.dzongkhagId,response.data.data.gewogId);
                    // this.getVillage(response.data.data.gewogId,response.data.data.chiwogId);
                })
                .catch((error) => {
                    console.log("Error: "+error);
                });
            },
            loadDataList(org_id){
            axios.get('loadCommons/loadStaffCountDetail/staffCount/' +org_id)
            .then(response => {
                    this.staff_details=response.data.data;
                    this.total_Staff=response.data.data.total_Staff[0];
                    this.counselor=response.data.data.counselor[0]
                    this.isSen=response.data.data.isSen[0]   
                    this.SportInstructor=response.data.data.SportInstructor[0];
                })
            .catch((error) => {
                console.log("Error: "+error);
            });
            
        },


        },
        mounted(){
            
            this.getLevel();
            this.loadGenderArrayList();
            if(this.$route.query.org_id!=undefined && this.$route.query.org_id!=""){
                this.getorgProfile(this.$route.query.org_id);
                this.loadPriviousOrgDetails(this.$route.query.org_id);
                this.loadDataList(this.$route.query.org_id);
            }
            else{
                axios.get('common/getSessionDetail')
                .then(response =>{
                    let data = response.data.data;
                    this.getorgProfile(data['Agency_Code']);
                    this.getStudentData(data['Agency_Code']);
                    this.getSenStudentData(data['Agency_Code']);
                    this.loadPriviousOrgDetails(data['Agency_Code']);
                    this.loadDataList(data['Agency_Code'])
                }) ;
            }
           
        }
    }
</script>
