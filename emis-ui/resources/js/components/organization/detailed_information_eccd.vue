<template>
<div>
    <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
        <li class="form-inline "><h6 class="pt-1">Detailed Organization Information</h6></li>
    </ol>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card card-success card-outline">
                        <div class="card-body">
                            <div class="tab-pane">
                                <div class="form-horizontal">
                                    <hr>
                                    <div class="row invoice-info">
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 invoice-col">
                                            <label class="mb-0"><i><u>Basic Details</u></i></label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 invoice-col">
                                            <div class="form-group row">
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label>Is GeoPoliticallyLocated:</label><br>
                                                    <label><input  type="radio" v-model="form.isGeoPoliticallyLocated" value="1" tabindex=""/> Yes</label>
                                                    <label><input  type="radio" v-model="form.isGeoPoliticallyLocated" value="0" tabindex=""/> No</label>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label>Parent School:</label>
                                                    <select v-model="form.parentSchool" class="form-control" name="parentSchool" id="parentSchool">
                                                        <option v-for="(item, index) in SchoolList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label>Distance from Dzongkhag HQ:</label><br>
                                                    <input type="text" v-model="form.distance_from_dzo" class="form-control editable_fields" id="distance_from_dzo" />
                                                    <has-error :form="form" field="distance_from_dzo"></has-error>
                                                </div>
                                            </div>
                                         </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 invoice-col">
                                            <label class="mb-0"><i><u>Ownership Details</u></i></label>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label><input  type="radio" v-model="form.category" value="0" tabindex="" @click="showtextbox('Yes')"/> Public</label>
                                            <label><input  type="radio" v-model="form.category" value="1" tabindex="" @click="showtextbox('No')"/> Private</label>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:none" id="roadtypeno">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 invoice-col">
                                                    <label class="mb-0"><i><u>Proprietor Details</u></i></label>
                                                </div>
                                                <label class="mb-1"> Name:<i class="text-danger">*</i></label>
                                                <input type="text" v-model="form.proprietorName" class="form-control editable_fields" id="proprietorName" />
                                                <has-error :form="form" field="proprietorName"></has-error>

                                                <label class="mb-1"> CID:<i class="text-danger">*</i></label>
                                                <input type="text" v-model="form.proprietorCid" class="form-control editable_fields" id="proprietorCid" />
                                                <has-error :form="form" field="proprietorCid"></has-error>

                                                <label class="mb-1"> Phone:<i class="text-danger">*</i></label>
                                                <input type="text" v-model="form.proprietorPhone" class="form-control editable_fields" id="proprietorPhone" />
                                                <has-error :form="form" field="proprietorPhone"></has-error>

                                                <label class="mb-1"> Email:<i class="text-danger">*</i></label>
                                                <input type="text" v-model="form.proprietorEmail" class="form-control editable_fields" id="proprietorEmail" />
                                                <has-error :form="form" field="proprietorEmail"></has-error>
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
                                    <div class="row form-group fa-pull-right">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <button class="btn btn-flat btn-primary" @click="updateorg()"><i class="fa fa-check"></i> Update</button>
                                        </div>
                                    </div>
                                </div>
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
                SchoolList:[],
                category:'',
                parentSchoolList:[],
                levelList:[],
                fence_list:[],
                disasterList:[],
                climate_type_list:[],
                form: new form({
                    org_id: '',
                    isGeoPoliticallyLocated:'',
                    parentSchool:'',
                    category:0,
                    proprietorName:'',
                    level:'',
                    proprietorCid:'',
                    proprietorPhone:'',
                    proprietorEmail:'',
                    longitude:'', latitude:'', altitude:'',map_path:'',
                    climate_type:'',distance_from_dzo:'',thramNo:'',
                    fencingtype:'',entranceGate:'',disasterArea:[],
                    fields_for:'eccd',
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
            loadOrgList(uri ='staff/transfer/LoadSchoolByDzoId/userdzongkhagwise/NA'){
                axios.get(uri)
                .then(response => {
                    let data = response;
                    this.SchoolList =  data.data;
                })
                .catch(function (error) {
                    console.log("Error:"+error)
                });
            },

            getContactTypeDropdown(uri = '/organization/getContactTypeDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.contactTypeList = data;
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
                if(type=="Yes"){
                    $('#roadtypeyes').show();
                    $('#roadtypeno').hide();
                }
                else if(type=="No"){
                    $('#roadtypeno').show();
                    $('#roadtypeyes').hide();
                }
                else{
                    $('#roadtypeyes').hide();
                    $('roadtypeno').show();
                }
            },

        },
        mounted(){
            this.getContactTypeDropdown();
            this.getLat();
            this.loadOrgList();
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
