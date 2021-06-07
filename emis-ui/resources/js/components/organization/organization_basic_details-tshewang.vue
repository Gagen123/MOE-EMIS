<template>
<div>
    <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
        <li class="form-inline "><h6 class="pt-1">Organization Profile</h6></li>
    </ol>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card card-success card-outline">
                        <div class="card-body">
                            <div class="tab-pane">
                                <form class="form-horizontal">
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>MOF Code:</label>
                                            <input type="text" class="form-control" v-model="form.mofCode">
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>RCSC/Zest Code:</label>
                                            <input type="text" class="form-control" v-model="form.zestAgencyCode">
                                        </div>  
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Organization code:</label>
                                            <input type="text" readonly class="form-control" v-model="form.code">
                                        </div>
                                    </div>
                                    <div class="row invoice-info">
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 invoice-col">
                                            <label class="mb-0"><i><u>Basic Details</u></i></label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 invoice-col">
                                            <div class="form-group row">
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label>Is AspNet School:</label><br>
                                                    <label><input  type="radio" v-model="form.isAspNetSchool" value="1" tabindex=""/> Yes</label>
                                                    <label><input  type="radio" v-model="form.isAspNetSchool" value="0" tabindex=""/> No</label>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label>Is GeoPoliticallyLocated:</label><br>
                                                    <label><input  type="radio" v-model="form.isGeoPoliticallyLocated" value="1" tabindex=""/> Yes</label>
                                                    <label><input  type="radio" v-model="form.isGeoPoliticallyLocated" value="0" tabindex=""/> No</label>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label>Is Resource Center:</label><br>
                                                    <label><input  type="radio" v-model="form.hasCounselingRoom" value="1" tabindex=""/> Yes</label>
                                                    <label><input  type="radio" v-model="form.hasCounselingRoom" value="0" tabindex=""/> No</label>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label>Has Counselling room:</label><br>
                                                    <label><input  type="radio" v-model="form.hasCounselingRoom" value="1" tabindex=""/> Yes</label>
                                                    <label><input  type="radio" v-model="form.hasCounselingRoom" value="0" tabindex=""/> No</label>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label>Has shift System:</label><br>
                                                    <label><input  type="radio" v-model="form.hasShiftSystem" value="1" tabindex=""/> Yes</label>
                                                    <label><input  type="radio" v-model="form.hasShiftSystem" value="0" tabindex=""/> No</label>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label>Has CE:</label><br>
                                                    <label><input  type="radio" v-model="form.hasCE" value="1" tabindex=""/> Yes</label>
                                                    <label><input  type="radio" v-model="form.hasCE" value="0" tabindex=""/> No</label>
                                                </div>
                                            </div>
                                         </div>
                                    </div>
                                    <hr>
                                    <div class="row invoice-info">
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 invoice-col">
                                            <label class="mb-0"><i><u>Geo-Position Details</u></i></label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 invoice-col">
                                            <div class="form-group row">
                                                <label class="col-lg-1 col-md-1 col-sm-1 col-xs-12 col-form-label">Long:</label>
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                    <input type="text" v-model="form.longitude" class="form-control editable_fields" id="longitude" />
                                                </div>
                                                <label class="col-lg-1 col-md-1 col-sm-1 col-xs-12 col-form-label">Lat:</label>
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                    <input type="text" v-model="form.latitude" class="form-control editable_fields" id="latitude" />
                                                </div>
                                                <label class="col-lg-1 col-md-1 col-sm-1 col-xs-12 col-form-label">Alt:</label>
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                    <input type="text" v-model="form.altitude" class="form-control editable_fields" id="altitude" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <i>Above values are displayed from your current location. Make sure that you are updating this information from your school, Otherwise you can Overwrite then if you know those values </i>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 col-form-label">Google Map Path:</label>
                                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                                    <input type="text" v-model="form.map_path" class="form-control editable_fields" id="nameOwner"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row invoice-info">
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 invoice-col">
                                            <label class="mb-0"><i><u>Others</u></i></label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 invoice-col">
                                            <div class="form-group row">
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label>Climate Type:</label>
                                                    <select v-model="form.climate_type" class="form-control" name="climate_type" id="climate_type">
                                                        <option v-for="(item, index) in climate_type_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label>Entrance Gate:</label><br>
                                                    <label><input  type="radio" v-model="form.entranceGate" value="1" tabindex=""/> Yes</label>
                                                    <label><input  type="radio" v-model="form.entranceGate" value="0" tabindex=""/> No</label>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label>Compound Fencing:</label><br>
                                                    <label  v-for="(item, key, index) in  fence_list" :key="index" class="pr-4">
                                                        <input  type="radio" v-model="form.fencingtype" :value="item.id" tabindex=""/> 
                                                        {{item.name}}
                                                    </label>
                                                </div>
                                                <!-- <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label>Distance From Dzongkhag HQ (KM):</label>
                                                    <input type="number" min="0" v-model="form.distance_from_dzo" class="form-control editable_fields" id="cidOfOwner"/>
                                                </div> -->
                                                <!-- <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label>Thram No:</label>
                                                    <input type="text" name="thramNo" v-model="form.thramNo" class="form-control editable_fields" id="thramNo"/>
                                                </div> -->
                                            </div>
                                            <div class="form-group row">
                                                
                                                
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label>Disaster Area:</label><br>
                                                    <label  v-for="(item, key, index) in  disasterList" :key="index" class="pr-4">
                                                        <input  type="checkbox" v-model="form.disasterArea" :value="item.id" tabindex=""/> 
                                                        {{item.name}}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row invoice-info">
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 invoice-col">
                                            <label class="mb-0"><i><u>Contact Detail</u></i></label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 invoice-col">
                                           <div class="form-group row">
                                              <div class="card-body col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Contact of</th>
                                                            <th>Phone</th>
                                                            <th>Mobile</th>
                                                            <th>Email</th>                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr id="record1" v-for='(user, index) in form.users' :key="index">
                                                            <td>
                                                                <select name="contactName" id="contactName" class="form-control" v-model="user.contactName" :class="{ 'is-invalid': form.errors.has('contactName') }" @change="remove_err('contactName')">
                                                                    <option value="">--- Please Select ---</option>
                                                                    <option v-for="(item, index) in contactTypeList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                                </select>
                                                                <has-error :form="form" field="user.contactName"></has-error>
                                                            </td>
                                                            <td>                                
                                                                <!-- <input type="number" name="phone" id="phone" class="form-control" v-model="user.phone" :class="{ 'is-invalid': form.errors.has('phone') }" @change="remove_err('phone')"/>
                                                                <has-error :form="form" field="phone"></has-error> -->
                                                               
                                                                <input name="phone"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "6"
                                                                @change="remove_error('phone')" v-model="form.phone" :class="{ 'is-invalid': form.errors.has('phone') }" class="form-control"  id="phone" >
                                                                <has-error :form="form" field="phone"></has-error>
                                                            </td>
                                                            <td>                                
                                                                <!-- <input type="number" name="mobile" id="mobile" class="form-control" v-model="user.mobile" :class="{ 'is-invalid': form.errors.has('mobile') }" @change="remove_err('mobile')"/> -->
                                                                <input name="mobile"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "8"
                                                                @change="remove_error('mobile')" v-model="form.mobile" :class="{ 'is-invalid': form.errors.has('mobile') }" class="form-control"  id="mobile" >
                                                                <has-error :form="form" field="mobile"></has-error>
                                                            </td>
                                                            <td>                                
                                                                <input type="email" name="email" id="email" class="form-control" v-model="user.email" :class="{ 'is-invalid': form.errors.has('email') }" @change="remove_err('email')"/>
                                                                 <has-error :form="form" field="email"></has-error>
                                                            </td>
                                                        </tr> 
                                                        <tr>
                                                            <td colspan="5"> 
                                                                <button type="button" class="btn btn-flat btn-sm btn-primary" id="addMore" 
                                                                @click="addMore()"><i class="fa fa-plus"></i> Add More</button>
                                                                <button type="button" class="btn btn-flat btn-sm btn-danger" id="remove" 
                                                                @click="remove()"><i class="fa fa-trash"></i> Remove</button>
                                                            </td>
                                                        </tr>                                          
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="row form-group fa-pull-right">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <button class="btn btn-flat btn-primary" @click="updateorg()"><i class="fa fa-check"></i> Update</button>
                                        </div>
                                    </div>
                                </form>
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
                    isAspNetSchool:'',
                    isColocated: '',
                    isFeedingSchool:'',
                    isGeoPoliticallyLocated:'',
                    isResourceCenter:'',
                    isSenSchool:'',
                    hasCounselingRoom:'',
                    hasShiftSystem:'',
                    hasCE:'',
                    mofCode:'',
                    zestAgencyCode:'',
                    longitude:'', latitude:'', altitude:'',map_path:'',
                    climate_type:'',distance_from_dzo:'',thramNo:'',
                    fencingtype:'',entranceGate:'',disasterArea:[],
                    users:
                    [{
                        contactName:'',phone:'', mobile:'',email:''
                    }],
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
