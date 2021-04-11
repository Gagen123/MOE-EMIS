<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <li class="nav-item organization-tab" @click="shownexttab('organization-tab')">
                        <a class="nav-link active" data-toggle="pill" role="tab"> 
                            <label class="mb-0.5">Basic Details </label>                              
                        </a>
                    </li>
                    <li class="nav-item class-tab" @click="shownexttab('class-tab')">
                        <a class="nav-link" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Classes and Streams </label>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body pt-0 mt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="organization-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <input type="hidden" v-model="form.organizationId" class="form-control"/>
                                <input type="hidden" v-model="form.id" class="form-control"/>
                                <div class="row form-group">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Name:</label>
                                        <input type="text" class="form-control" v-model="form.name" id="name"/>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Level:</label>
                                        <select name="level" id="level" v-model="form.level" :class="{ 'is-invalid': form.errors.has('level') }" class="form-control editable_fields" @change="remove_error('level')">
                                            <option value="">--- Please Select ---</option>
                                            <option v-for="(item, index) in levelList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Category:</label><br>
                                        <label><input  type="radio" v-model="form.category" value="1" @change="showprivatedetails('public')" tabindex=""/> Public</label>
                                        <label><input  type="radio" v-model="form.category" value="0" @change="showprivatedetails('private')" tabindex=""/> Private</label>
                                    </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Dzongkhag:</label>
                                            <select v-model="form.dzongkhag" :class="{ 'is-invalid': form.errors.has('dzongkhag') }" class="form-control select2" name="dzongkhag" id="dzongkhag">
                                                <option value="">--- Please Select ---</option>
                                                <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Gewog:</label>
                                            <select v-model="form.gewog" :class="{ 'is-invalid select2 select2-hidden-accessible':form.errors.has('gewog') }" class="form-control select2" name="gewog" id="gewog">
                                                <option value="">--- Please Select ---</option>
                                                <option v-for="(item, index) in gewog_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Chiwog:</label>
                                            <select v-model="form.chiwog" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('chiwog') }" class="form-control select2" name="chiwog" id="chiwog">
                                                <option value="">--- Please Select ---</option>
                                                <option v-for="(item, index) in villageList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Location Type:</label>
                                            <select name="locationCategory" v-model="form.locationType" :class="{ 'is-invalid': form.errors.has('locationType') }" id="locationCategory" class="form-control editable_fields" @change="remove_error('locationCategory')">
                                                <option value="">--- Please Select ---</option>
                                                <option v-for="(item, index) in locationList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Geopolitically Located:</label><br>
                                            <label><input  type="radio" v-model="form.geoLocated" value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.geoLocated" value="0" tabindex=""/> No</label>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>SEN School:</label><br>
                                            <label><input  type="radio" v-model="form.senSchool" value="1" @change="show_parent_school_details(true)" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.senSchool" value="0" @change="show_parent_school_details(false)" tabindex=""/> No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row" id="parentDetails" style="display:none">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="parentSchoolDiv">
                                    <label>Parent School:</label>
                                    <select name="locationCategory" v-model="form.parentSchool" :class="{ 'is-invalid': form.errors.has('locationType') }" id="locationCategory" class="form-control editable_fields" @change="remove_error('locationCategory')">
                                        <option value="">--- Please Select ---</option>
                                        <option value="1">Kabisa</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="coLocatedDiv">
                                    <label>Co-located with Parent School:</label>
                                    <br>
                                    <label><input  type="radio" v-model="form.coLocatedParent" value="1" tabindex=""/> Yes</label>
                                    <label><input  type="radio" v-model="form.coLocatedParent" value="0" tabindex=""/> No</label>
                                </div>                   
                            </div>
                            <div id="privatedetails" style="display:none">
                            <div class="row pb-2">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label class="mb-0">Proprietor Details</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">CID:<span class="text-danger">*</span></label>
                                    <input type="nubmer" v-model="form.cid" class="form-control" id="cid"/>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Full Name:<span class="text-danger">*</span></label>
                                    <input type="text" v-model="form.fullName" class="form-control" id="fullname"/>
                                </div>
                            </div>
                            <div class="form-group row" >
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Phone No:<span class="text-danger">*</span></label>
                                    <input type="nubmer" v-model="form.phoneNo" class="form-control" id="cid"/>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Email:<span class="text-danger">*</span></label>
                                    <input type="email" v-model="form.email" class="form-control" id="email"/>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" @click="shownexttab('class-tab')">Save & Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade tab-content-details" id="class-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0">Select classes and streams</label>
                            </div>
                        </div><br>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                            <span v-for="(item, key, index) in  classList" :key="index">
                                <br>
                                <input type="checkbox" v-model="classStreamForm.class" :value="item.id"><label class="pr-4"> &nbsp;{{ item.class }}</label>
                                <span v-for="(stm, key, index) in streamList" :key="index" >
                                    <span v-if="item.class=='XI' || item.class=='XII'">
                                        <br>
                                        <input type="checkbox" v-model="classStreamForm.stream"  :id="stm.id" :value="item.id+'##'+stm.id"> <label class="pr-3"> {{ stm.stream  }}</label>
                                    </span>
                                </span>
                            </span> 
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('organization-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-primary" @click="shownexttab('final-tab')"> <i class="fa fa-save"></i>Submit </button>
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
            levelList:[],
            locationList:[],
            dzongkhagList:[],
            gewog_list:[],
            villageList:[], 
           classList:[],
            streamList:[],
            form: new form({
                organizationId:'145f5a09-06b8-407a-8f33-deecc6a2b861',name:'',level:'1',category:'1',dzongkhag:'',gewog:'',chiwog:'',
                locationType:'1',geoLocated:'0',senSchool:'0', parentSchool:'',coLocatedParent:'0',
                cid:'',fullName:'',phoneNo:'',email:'',status:'submitted'
            }),
            classStreamForm: new form({
                id: '',class:[], stream:[]
            })
        } 
    },
    methods: {
        /**
         * method to remove error
         */
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        }, 

        /**
         * method to get level in dropdown
         */
        getLevel(uri = '/organization/getLevelInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.levelList = data;
            });
        },

        /**
         * method to get location in dropdown
         */
        getLocation(uri = '/organization/getLocationInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.locationList = data;
            });
        },

        /**
         * method to get active dzongkhag list
         */
        loadactivedzongkhagList(uri="masters/loadGlobalMasters/all_active_dzongkhag"){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.dzongkhagList =  data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },

        /**
         * method to get gewog list
         */
        async getgewoglist(id){
            let dzoId=$('#dzongkhag').val();
            if(id!="" && dzoId==null){
                dzoId=id;
            }
            let uri = 'masters/all_active_dropdowns/dzongkhag/'+dzoId;
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.gewog_list = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        /**
         * method to get gewog list
         */
        async getvillagelist(id){
            let gewogId=$('#gewog').val();
            if(id!="" && gewogId==null){
                gewogId=id;
            }
            let uri = 'masters/all_active_dropdowns/gewog/'+this.form.gewog;
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.villageList = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },

        /**
         * method to populate dropdown
         */
        async changefunction(id){
            if(id=="dzongkhag"){
                this.form.dzongkhag=$('#dzongkhag').val();
                this.getgewoglist();
            }
            if(id=="gewog"){
                this.form.gewog=$('#gewog').val();
                this.getvillagelist();
            }
            if(id=="chiwog"){
                this.form.chiwog=$('#chiwog').val();
            }
        },

        /**
         * method to get class in checkbox
         */
        getApplicationNo:function(){
            axios.get('/organization/getApplicationNo')
              .then(response => {
                this.form.id = response.data;
            });
        },

        /**
         * method to get class in checkbox
         */
        getClass:function(){
            axios.get('/organization/getCurrentClass')
              .then(response => {
                this.classList = response.data;
            });
        },

        /**
         * method to get stream in checkbox
         */
        getStream:function(){
            axios.get('/organization/getCurrentStream')
              .then(response => {
                this.streamList = response.data;
            });
        },
        /**
         * method to show private fields
         */
        showprivatedetails(type){
            if(type=='private'){
                $('#privatedetails').show();
            }
            else{
                $('#privatedetails').hide();
            }
        },

        show_parent_school_details(param){
            if(param){
                $('#parentDetails').show();
            }
            else{
                $('#parentDetails').hide();
            }
        } ,

        /**
         * method to show next and previous tab
         */
        shownexttab(nextclass){ 
            if(nextclass=="final-tab"){ 
                Swal.fire({
                    text: "Are you sure you wish to save this details ?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        this.classStreamForm.post('organization/saveChangeClass')
                        .then((response) => {
                            if(response!=""){
                                let message="Applicaiton for Change basic details has been submitted for approval. System Generated application number for this transaction is: <b>"+response.data.data.application_number+'.</b><br> Use this application number to track your application status. <br><b>Thank You !</b>';
                                this.$router.push({name:'acknowledgement',params: {data:message}});
                                Toast.fire({  
                                    icon: 'success',
                                    title: 'Change basic details is saved successfully'
                                });
                            }
                        })
                        .catch(() => {
                            console.log("Error......")
                        })
                    }
                });
            }
            else{
                if(nextclass=="class-tab"){
                     this.form.post('organization/saveChangeBasicDetails',this.form)
                    .then(() => {
                       Toast.fire({
                            icon: 'success',
                            title: 'Data saved Successfully'
                        });
                    })
                    .catch(() => {
                        console.log("Error......")
                    })
                }
                this.change_tab(nextclass);
            }
        },
        
        change_tab(nextclass){
            $('#tabhead >li >a').removeClass('active');
            $('#tabhead >li >a >span').addClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').addClass('active');
            $('.'+nextclass+' >a >span').removeClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').removeClass('disabled');
            $('.tab-content-details').hide();
            $('#'+nextclass).show().removeClass('fade');
        },

        /**
         * method to proprietor details
         */
        loadProprietorDetails(){
            axios.get('organization/loadCurrentProprietorDetails/'+this.form.organizationId)
            .then((response) => {  

                let data = response.data.data;
                this.form.cid           =   data.cid;
                this.form.fullName      =   data.fullName;
                this.form.phoneNo       =   data.phoneNo;
                this.form.email         =   data.email;
            })
            .catch((error) => {  
                console.log("Error......"+error);
            });
        },

        loadCurrentOrgDetails(){
            axios.get('organization/loadCurrentOrgDetails/'+this.form.organizationId)
            .then((response) => {  
                let data=response.data.data;
                this.form.id        =   data.id;
                this.form.name      =   data.name;
                this.form.level     =   data.levelId;
                this.form.category  =   data.category;
                this.form.locationType  =   data.locationId;

                //to populate proprietor details if category is private
                if(data.category == 0){
                    this.showprivatedetails('private');
                    this.loadProprietorDetails();
                }

                //to populate parent school details if category is private
                if(data.isSenSchool == 1){
                    this.show_parent_school_details(true);
                }

                $('#dzongkhag').val(JSON.parse(response.data.dzongkhag).data.id).trigger('change');
                this.form.dzongkhag = JSON.parse(response.data.dzongkhag).data.id;
                this.getgewoglist(JSON.parse(response.data.dzongkhag).data.id);
                this.form.gewog = JSON.parse(response.data.gewog).data.id;
                this.getvillagelist(JSON.parse(response.data.gewog).data.id);
                this.form.chiwog = data.chiwogId;
                
                this.form.geoLocated                =   data.isGeopoliticallyLocated;
                this.form.senSchool                 =   data.isSenSchool;
                this.form.parentSchool              =   data.parentSchoolId;
                this.form.coLocatedParent           =   data.isColocated;
            })
            .catch((error) => {  
                console.log("Error......"+error);
            });
        },
        
    },
    
    created() {
        this.getLevel();
        this.getLocation();
        
    },
    
     mounted() { 
        $('[data-toggle="tooltip"]').tooltip();
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id')); 
        });
        
        Fire.$on('changefunction',(id)=> {
            this.changefunction(id);
        });
       
        this.getClass();
        this.getStream();
        this.loadactivedzongkhagList();
        this.loadCurrentOrgDetails();
        this.getApplicationNo();
    }
}
</script>
