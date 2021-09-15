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
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id='Counselling'>
                                                    <label>Has Counselling room:</label><br>
                                                    <label><input  type="radio" v-model="form.hasCounselingRoom" value="1" tabindex=""/> Yes</label>
                                                    <label><input  type="radio" v-model="form.hasCounselingRoom" value="0" tabindex=""/> No</label>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label>Is GeoPoliticallyLocated:</label><br>
                                                    <label><input  type="radio" v-model="form.isGeoPoliticallyLocated" value="1" tabindex=""/> Yes</label>
                                                    <label><input  type="radio" v-model="form.isGeoPoliticallyLocated" value="0" tabindex=""/> No</label>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label>Has shift System:</label><br>
                                                    <label><input  type="radio" v-model="form.hasShiftSystem" value="1" tabindex=""/> Yes</label>
                                                    <label><input  type="radio" v-model="form.hasShiftSystem" value="0" tabindex=""/> No</label>
                                                </div>

                                            </div>
                                            <div class="form-group row">
                                                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id='AspNet'>
                                                    <label>Is AspNet School:</label><br>
                                                    <label><input  type="radio" v-model="form.isAspNetSchool" value="1" tabindex=""/> Yes</label>
                                                    <label><input  type="radio" v-model="form.isAspNetSchool" value="0" tabindex=""/> No</label>
                                                </div>
                                                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id='Resource'>
                                                    <label>Is Resource Center:</label><br>
                                                    <label><input  type="radio" v-model="form.isResourceCenter" value="1" tabindex=""/> Yes</label>
                                                    <label><input  type="radio" v-model="form.isResourceCenter" value="0" tabindex=""/> No</label>
                                                </div>

                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id='Has_CE'>
                                                    <label>Has CE:</label><br>
                                                    <label><input  type="radio" v-model="form.hasCE" value="1" tabindex=""/> Yes</label>
                                                    <label><input  type="radio" v-model="form.hasCE" value="0" tabindex=""/> No</label>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label>Distance from Dzongkhag HQ (km):</label><br>
                                                    <input type="number" v-model="form.distance_from_dzo" class="form-control editable_fields" id="distance_from_dzo" />
                                                    <has-error :form="form" field="distance_from_dzo"></has-error>
                                                </div>
                                            </div>
                                         </div>
                                    </div>
                                    <hr>
                                     <div class="form-group row">
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-9 invoice-col">
                                            <label class="mb-0"><i><u>Ownership Details</u></i></label>
                                        </div>
                                        <div class="form-group row">
                                        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3" id='radio1'>
                                            <label><input  type="radio" v-model="form.category" value="0" tabindex="" id="radio1" @click="showtextbox('Yes')"/> Public</label>
                                        </div>
                                         <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3" id='radio2'>
                                            <label><input  type="radio" v-model="form.category" value="1" tabindex="" id="radio2" @click="showtextbox('No')"/> Private</label>
                                         </div>
                                          <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3" id='radio3'>
                                            <label><input  type="radio" v-model="form.category" value="2" tabindex="" id="radio3" @click="showtextbox('Yes')"/> NGO</label>
                                          </div>
                                           <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3" id='radio4'>
                                            <label><input  type="radio" v-model="form.category" value="3" tabindex="" id="radio4" @click="showtextbox('Yes')"/> Corporate</label>
                                        </div>
                                    </div>
    
                                        <div class="row form-group">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:none" id="roadtypeno">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 invoice-col">
                                                    <label class="mb-0"><i><u>Proprietor Details</u></i></label>
                                                </div>
                                                <label class="mb-2"> Name:<i class="text-danger">*</i></label>
                                                <input type="text" v-model="form.proprietorName" class="form-control editable_fields" id="proprietorName" />
                                                <has-error :form="form" field="proprietorName"></has-error>
                                            
                                                <label class="mb-2"> CID:<i class="text-danger">*</i></label>
                                                <input type="text" v-model="form.proprietorCid" class="form-control editable_fields" id="proprietorCid" />
                                                <has-error :form="form" field="proprietorCid"></has-error>

                                                <label class="mb-2"> Phone:<i class="text-danger">*</i></label>
                                                <input type="text" v-model="form.proprietorPhone" class="form-control editable_fields" id="proprietorPhone" />
                                                <has-error :form="form" field="proprietorPhone"></has-error>

                                                <label class="mb-2"> Email:<i class="text-danger">*</i></label>
                                                <input type="text" v-model="form.proprietorEmail" class="form-control editable_fields" id="proprietorEmail" />
                                                <has-error :form="form" field="proprietorEmail"></has-error>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row invoice-info">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label class="mb-0"><i><u>Geo-Position Details</u></i></label>
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
                                            <hr />
                                            <div class="form-group row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Google Map Path:</label>
                                                    <ol>
                                                        <li><i>Visit <a href="https://www.google.com/maps" target="_blank">Google Map Search</a></i></li>
                                                        <li><i>Type your school name in the search box</i></li>
                                                        <li><i>If your school/organization is registered in the google map, then your school/organization will be located in the map. Otherwise need to register first</i></li>
                                                        <li><i>Click on the Embed a map link from the popup and press COPY HTML.</i></li>
                                                        <li><i>Past the link in the above text box.</i></li>
                                                    </ol>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <textarea name="googlemap" class="form-control" v-model="form.map_path" id="googlemap" @change="previewchanges('googlemap','preview_sec')"></textarea>
                                                    <br>
                                                    <span id="preview_sec"></span>
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
                                                    <label><input  type="radio" v-model="form.entranceGate" value="1" @change="showgate(1)" tabindex=""/> Yes</label>
                                                    <label><input  type="radio" v-model="form.entranceGate" value="0" @change="showgate(0)" tabindex=""/> No</label>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="gate_type_section">
                                                    <label>Gate Type:</label>
                                                    <select v-model="form.gate_type" class="form-control" name="gate_type" id="gate_type">
                                                        <option v-for="(item, index) in gate_type_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label>Compound Fencing:</label><br>
                                                    <label  v-for="(item, key, index) in  fence_list" :key="index" class="pr-4">
                                                        <input  type="radio" v-model="form.fencingtype" :value="item.id" tabindex=""/>
                                                        {{item.name}}
                                                    </label>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label>Disaster Area:</label><br>
                                                    <label v-for="(item, index) in  disasterList" :key="index" class="pr-4">
                                                        <input type="checkbox" name="disasterArea" :id="'dester'+item.id" :value="item.id"/>
                                                        {{item.name}}<br />
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
                levelArray:{},
                category:'',
                fence_list:[],
                disasterList:[],
                climate_type_list:[],
                gate_type_list:[],
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
                    fencingtype:'',entranceGate:'',disasterArea:'',
                    fields_for:'school',
                    gate_type:'',
                })
            }
        },
        methods:{
            previewchanges(id,preid){
                if($('#'+id).val()!=""){
                    this.populategooglemap($('#'+id).val());
                }
            },
            getorgProfile(org_id){
                axios.get('loadCommons/loadOrgDetails/fullOrgDetbyid/'+org_id)
                .then(response => {
                    let response_data=response.data.data;
                    this.orgDetails=response_data;
                    if(response_data.category=="public_eccd" ||response_data.category=="private_eccd" ){
                         $('#AspNet').hide();
                         $('#Resource').hide();
                         $('#Has_CE').hide();
                         $('#Counselling').hide();
                        
                    }
                    if(response_data.category=="public_school" ||response_data.category=="private_school" ||response_data.category=="public_ecr" ){
                         $('#radio3').hide();
                         $('#radio4').hide();
                    }
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
                    this.form.isGeoPoliticallyLocated=response_data.isGeopoliticallyLocated;
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
                        if(response_data.locationDetials.disasterArea!=null && response_data.locationDetials.disasterArea!=""){
                            if(response_data.locationDetials.disasterArea.includes(',')){
                                response_data.locationDetials.disasterArea.split(',').forEach(itm => {
                                    $('#dester'+itm).prop('checked',true);
                                });
                            }else{
                                $('#dester'+response_data.locationDetials.disasterArea).prop('checked',true);
                            }
                        }
                        this.form.disasterArea=response_data.locationDetials.disasterArea;
                        this.form.distance_from_dzo=response_data.locationDetials.distance_from_dzo;
                        this.form.entranceGate=response_data.locationDetials.entranceGate;
                        this.form.fencingtype=response_data.locationDetials.fencingtypeId;
                        this.form.map_path=response_data.locationDetials.googleMapPath;
                        if(response_data.locationDetials.googleMapPath!=null && response_data.locationDetials.googleMapPath!=""){
                            this.populategooglemap(response_data.locationDetials.googleMapPath);
                        }
                        this.form.latitude=response_data.locationDetials.latitude;
                        this.form.longitude=response_data.locationDetials.longitude;
                        this.form.thramNo=response_data.locationDetials.thramNo;
                        this.form.gate_type=response_data.locationDetials.gate_type;
                    }
                    let prop=response_data.contactDetails;
                    let contactDetails=[];
                    for(let i=0;i<prop.length;i++){
                     contactDetails.push({contactName:prop[i].contactTypeId,phone:prop[i].phone,mobile:prop[i].mobile,email:prop[i].email,});
                    }
                    this.count=prop.length;
                    this.form.users=contactDetails;
                })
                .catch((error) => {
                    console.log("Error: "+error);
                });
            },
            populategooglemap(value){
                let mapid=value;
                mapid=mapid.replace('width="600"','width="450"');
                mapid=mapid.replace('height="450"','height="300"');
                mapid=mapid.replace('width="800"','width="450"');
                mapid=mapid.replace('height="600"','height=300"');
                $("#preview_sec").html(mapid);
            },

            updateorg(){
                let disasval="";
                $("input[name='disasterArea']:checked").each ( function(index){
                    if(index==$("input[name='disasterArea']:checked").length-1){
                        disasval+=$(this).val();
                    }
                    else{
                        disasval+=$(this).val()+',';
                    }

                });
                this.form.disasterArea=disasval;
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
                this.form.latitude  = position.coords.latitude;
                this.form.longitude = position.coords.longitude
                this.form.altitude  = position.coords.altitude
                // $('#latitude').val(position.coords.latitude);
                // $('#longitude').val(position.coords.longitude);
                // $('#altitude').val(position.coords.altitude);
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
            loadGatetList(uri = 'masters/organizationMasterController/loadOrganizaitonmasters/active/GateType'){
                axios.get(uri)
                .then(response => {
                    let data = response.data.data;
                    this.gate_type_list =  data;
                })
                .catch(function (error) {
                    console.log('error: '+error);
                });
            },
            showgate(type){
                if(type==0){
                    $('#gate_type_section').hide();
                }else{
                    $('#gate_type_section').show();
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
            this.loadGatetList();
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
