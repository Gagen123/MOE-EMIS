<template>
    <div>
        <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="form-inline "><h6 class="pt-1">SEN Module</h6></li>
        </ol>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead" role="tablist">
                    <li class="nav-item personal-details-tabs" @click="shownexttab('','personal-details-tabs')">
                        <a class="nav-link active" data-toggle="pill" role="tab"> 
                            <label> SEN Module</label>                              
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="personal-details-tabs" role="tabpanel" aria-labelledby="basicdetails">
                        <table id="waterTable" class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <thead>
                                <tr>
                                    <th style="width:60%">Description</th>
                                    <th style="width:40%">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <b>WASH</b>
                                </tr>
                                <tr id="record1">
                                    <td>Are there accessible toilet for children/student with disabilities? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form.accessibleToilet" value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.accessibleToilet" value="0" tabindex=""/> No</label>
                                            <label><input  type="radio" v-model="form.accessibleToilet" value="2" tabindex=""/> No New Buildings</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record2">
                                    <td>Are there accessible WASH facilities (water taps, basins, bathrooms, etc,) for children/students with disabilities?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form.accessibleWash" value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.accessibleWash" value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <b>Outdoor Spaces</b>
                                </tr>
                                <tr id="record3">
                                    <td>Are outdoor play and recreation areas accessible for children/students with disabilities?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form.outdoorPlayground" value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.outdoorPlayground" value="2" tabindex=""/> Partially</label>
                                            <label><input  type="radio" v-model="form.outdoorPlayground" value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record4">
                                    <td>Are routes between classes and buildings accessible for children/students with disabilities?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form.outdoorRoutes" value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.outdoorRoutes" value="2" tabindex=""/> Partially</label>
                                            <label><input  type="radio" v-model="form.outdoorRoutes" value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <b>Hostels</b>
                                </tr>
                                <tr id="record12">
                                    <td>Are girls hostels accessible for students with disabilities?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form.girlsHostelAccessible" value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.girlsHostelAccessible" value="0" tabindex=""/> No</label>
                                            <label><input  type="radio" v-model="form.girlsHostelAccessible" value="2" tabindex=""/> Partially</label>
                                            <label><input  type="radio" v-model="form.girlsHostelAccessible" value="3" tabindex=""/> No Hostel</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record5">
                                    <td>Are dining halls accessible for children/students with disabilities?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form.diningHall" value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.diningHall" value="0" tabindex=""/> No</label>
                                            <label><input  type="radio" v-model="form.diningHall" value="2" tabindex=""/> Partially</label>
                                            <label><input  type="radio" v-model="form.diningHall" value="3" tabindex=""/> No Dining Hall</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record6">
                                    <td>Are hostel WASH facilities accessible for students with disabilities?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form.hostelWash" value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.hostelWash" value="0" tabindex=""/> No</label>
                                            <label><input  type="radio" v-model="form.hostelWash" value="2" tabindex=""/> Partially</label>
                                            <label><input  type="radio" v-model="form.hostelWash" value="3" tabindex=""/> No Hostel</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record7">
                                    <td>Are boys hostels accessible for students with disabilities?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form.boysHostelAccessible" value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.boysHostelAccessible" value="0" tabindex=""/> No</label>
                                            <label><input  type="radio" v-model="form.boysHostelAccessible" value="2" tabindex=""/> Partially</label>
                                            <label><input  type="radio" v-model="form.boysHostelAccessible" value="3" tabindex=""/> No Hostel</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <b>Enrollment</b>
                                </tr>
                                <tr id="record8">
                                    <td>
                                        Have you had to turn children/students away due to their disability this year? 
                                        If yes, what were the barriers to admitting them?
                                    </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form.enrollment" value="1" tabindex="" @click="showtextbox('1')"/> Yes</label>
                                            <label><input  type="radio" v-model="form.enrollment" value="0" tabindex="" @click="showtextbox('0')"/> No</label>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:none" id="enrollment">
                                            <textarea v-model="form.proprietorName" class="form-control editable_fields" id="proprietorName"></textarea>
                                            <has-error :form="form" field="proprietorName"></has-error>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record9">
                                    <td>
                                        Are you aware of any ECCD centre/school aged children/students with disabilities in your community 
                                        who are not attending ECCD centre/school? If yes, how many of them?
                                    </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form.communityWithDisablities" value="1" tabindex="" @click="showtextbox2('1')"/> Yes</label>
                                            <label><input  type="radio" v-model="form.communityWithDisablities" value="0" tabindex="" @click="showtextbox2('0')"/> No</label>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:none" id="community">
                                            <textarea v-model="form.community" class="form-control editable_fields" id="community"></textarea>
                                            <has-error :form="form" field="community"></has-error>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <b>Others</b>
                                </tr>
                                <tr id="record10">
                                    <td>Does your school have SEN program?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form.senProgram" value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.senProgram" value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record11">
                                    <td>Does your school have children with disabilities?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form.studentDisabilities" value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.studentDisabilities" value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" @click="shownexttab('appointment-tab','final-tab')"> <i class="fa fa-save"></i>Save </button>
                            </div>
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
                users: [],
                contactTypeList:[],
                orgDetails:'',
                isprofile:false,
                levelArray:{},
                category:'',
                fence_list:[],
                disasterList:[],
                climate_type_list:[],
                form: new form({
                    org_id: '',
                    category:0,
                    proprietorName:'',
                    proprietorCid:'',
                    proprietorPhone:'',
                    proprietorEmail:'',
                    isAspNetSchool:'',
                    isColocated: '',
                    isFeedingSchool:'',
                    isGeoPoliticallyLocated:'',
                    isResourceCenter:'',
                    isSenSchool:'',
                    hasCounselingRoom:'',
                    hasShiftSystem:'',
                    hasCE:'',
                    longitude:'', latitude:'', altitude:'',map_path:'',
                    climate_type:'',distance_from_dzo:'',
                    fencingtype:'',entranceGate:'',disasterArea:[],
                    fields_for:'school'
                }) 
            }
        },
        methods:{
            getorgProfile(org_id){
                axios.get('loadCommons/loadOrgDetails/fullOrgDetbyid/'+org_id)
                .then(response => {
                    let response_data=response.data.data;
                    this.orgDetails=response_data;
                    if(response_data.category=="public_school"){
                        this.category="Public School";
                    }
                    if(response_data.category=="public_ecr"){
                        this.category="Public ECR";
                    }
                    if(response_data.category=="private_school"){
                        this.category="Private School";
                    }
                    if(response_data.category=="public_eccd"){
                        this.category="Public ECCD";
                    }
                    if(response_data.category=="private_eccd"){
                        this.category="Public ECCD";
                    }

                    this.form.isAspNetSchool=response_data.isAspNetSchool;
                    this.form.isColocated=response_data.isColocated;
                    this.form.isGeoPoliticallyLocated=response_data.isGeoPoliticallyLocated;
                    this.form.isResourceCenter=response_data.isResourceCenter;
                    this.form.isSenSchool=response_data.isSenSchool;
                    this.form.hasCounselingRoom=response_data.hasCounselingRoom;
                    this.form.hasShiftSystem=response_data.hasShiftSystem;
                    this.form.hasCE=response_data.hasCE;
                    this.form.mofCode=response_data.mofCode;
                    this.form.zestAgencyCode=response_data.zestAgencyCode;
                    if(response_data.locationDetials!=null && response_data.locationDetials!=""){
                        this.form.altitude=response_data.locationDetials.altitude;
                        this.form.climate_type=response_data.locationDetials.climate_type;
                        // this.form.disasterArea=response_data.locationDetials.disasterArea;
                        this.form.distance_from_dzo=response_data.locationDetials.distance_from_dzo;
                        this.form.entranceGate=response_data.locationDetials.entranceGate;
                        this.form.fencingtypeId=response_data.locationDetials.fencingtypeId;
                        this.form.map_path=response_data.locationDetials.googleMapPath;
                        this.form.latitude=response_data.locationDetials.latitude;
                        this.form.longitude=response_data.locationDetials.longitude;
                        this.form.thramNo=response_data.locationDetials.thramNo;
                    }
                    let prop=data.contact;
                    let contactDetails=[];
                    for(let i=0;i<prop.length;i++){
                     contactDetails.push({contactName:prop[i].contactTypeId,phone:prop[i].phone,mobile:prop[i].mobile,email:prop[i].email,});
                    }
                    this.count=data.length;
                    this.form.users=contactDetails;
                    
                })
                .catch((error) => {  
                    console.log("Error: "+error);
                });
            },
            updateorg(){
                this.form.post('organization/updateOrgBasicDetials')
                .then((response) => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Basic Details has been saved successfully'
                    })
                })
                .catch((error) => {
                    Toast.fire({
                        icon: 'error',
                        title: 'Unexpected error occured:'+error
                    });
                })
            },
            getContactTypeDropdown(uri = '/organization/getContactTypeDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.contactTypeList = data;
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
            getLat: function(){
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(this.showPosition);
                } 
            },
            showPosition(position){
                $('#latitude').val(position.coords.latitude);
                $('#longitude').val(position.coords.longitude);
                $('#altitude').val(position.coords.altitude);
            },
            loadDisasterList(uri = 'masters/organizationMasterController/loadOrganizaitonmasters/active/Disaster'){
                axios.get(uri)
                .then(response => {
                    let data = response.data.data;
                    this.disasterList =  data;
                })
            },
            loadfencingList(uri = 'masters/organizationMasterController/loadOrganizaitonmasters/active/FencingType'){
                axios.get(uri)
                .then(response => {
                    let data = response.data.data;
                    this.fence_list =  data;
                })
                .catch(function (error) {
                    console.log('error: '+error);
                });
            },
            loadlcimateTypeList(uri = 'masters/organizationMasterController/loadOrganizaitonmasters/active/ClimateType'){
                axios.get(uri)
                .then(response => {
                    let data = response.data.data;
                    this.climate_type_list =  data;
                })
                .catch(function (error) {
                    console.log('error: '+error);
                });
            },
            addMore: function(){
                this.count++;
                this.form.users.push({contactName:'',phone:'',mobile:'',email:''})    
            }, 
            remove(index){    
                if(this.form.users.length>1){
                  this.count--;
                  this.form.users.splice(index,1); 
                }
            },
            showtextbox:function(type){
                if(type=="1"){
                    $('#enrollment').hide();
                    $('#enrollment').show(); 
                }
                else if(type=="0"){
                    $('#enrollment').hide();
                }
            },
            showtextbox2:function(type){
                if(type=="1"){
                    $('#community').hide();
                    $('#community').show(); 
                }
                else if(type=="0"){
                    $('#community').hide();
                }
            },
        },

        mounted(){
            this.getContactTypeDropdown();
            this.getLat();
            this.getLevel();
            this.loadfencingList();
            this.loadDisasterList();
            this.loadlcimateTypeList();
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