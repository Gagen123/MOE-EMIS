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
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 invoice-col">
                                        <label class="mb-0"><i><u>Basic Details</u></i></label>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>MOF Code:</label>
                                            <input type="text" class="form-control" v-model="form.mofCode" :class="{ 'is-invalid': form.errors.has('mofCode') }" >
                                            <has-error :form="form" field="mofCode"></has-error>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>RCSC/Zest Code:</label>
                                            <input type="text" class="form-control" v-model="form.zestAgencyCode" :class="{ 'is-invalid': form.errors.has('zestAgencyCode') }" >
                                        </div>  
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Organization code:</label>
                                            <input type="text" readonly class="form-control" v-model="form.code" :class="{ 'is-invalid': form.errors.has('code') }" >
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 invoice-col">
                                        <label class="mb-0"><i><u>Contact Details</u></i></label>
                                    </div>
                                    <hr>
                                    <div class="row invoice-info">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 invoice-col">
                                           <div class="form-group row">
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                    <label>Official Contact No:</label>
                                                    <input type="number" class="form-control" v-model="form.contactNo" :class="{ 'is-invalid': form.errors.has('contactNo') }" >
                                                    <has-error :form="form" field="contactNo"></has-error>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                    <label>Official Email:</label>
                                                    <input type="text" class="form-control" v-model="form.officialEmail" :class="{ 'is-invalid': form.errors.has('officialEmail') }" >
                                                    <has-error :form="form" field="officialEmail"></has-error>
                                                </div>  
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                    <label>Official Website:</label>
                                                    <input type="text" class="form-control" v-model="form.officialWebsite" :class="{ 'is-invalid': form.errors.has('officialWebsite') }" >
                                                    <has-error :form="form" field="officialWebsite"></has-error>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                    <label>Facebook Link:</label>
                                                    <input type="text" class="form-control" v-model="form.facebookLink" :class="{ 'is-invalid': form.errors.has('facebookLink') }" >
                                                    <has-error :form="form" field="facebookLink"></has-error>
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
                    code:'',
                    mofCode:'',
                    zestAgencyCode:'',
                    contactNo:'', 
                    officialWebsite:'',
                    officialEmail:'',
                    facebookLink:'',
                    fields_for:'organization'
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
                    if(response_data.contactDetails!=null && response_data.contactDetails!=""){
                        this.form.contactNo=response_data.contactDetails.phone;
                        this.form.facebookLink=response_data.contactDetails.facebookLink;
                        // this.form.disasterArea=response_data.locationDetials.disasterArea;
                        this.form.officialEmail=response_data.contactDetails.email;
                        this.form.officialWebsite=response_data.contactDetails.website;
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
            remove_error(err){
                if($('#'+err).val()!=""){
                    $('#'+err).html('');
                }
            },
            updateorg(){
                this.form.post('organization/updateBasicDetails')
                .then((response) => {
                    this.loadexsitingDetails();
                    alert(response);
                })
                .catch(function (error) {
                    console.log('error: '+error);
                });
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
            loadexsitingDetails(){
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
            
        },
        mounted(){
            this.getContactTypeDropdown();
            this.getLat();
            this.getLevel();
            this.loadfencingList();
            this.loadDisasterList();
            this.loadlcimateTypeList();
            this.loadexsitingDetails();
        }
    }
</script>
