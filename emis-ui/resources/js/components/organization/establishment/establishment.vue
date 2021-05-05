<template>
    <div>
        <div class="callout callout-danger" style="display:none" id="applicaitonUnderProcess">
            <h5 class="bg-gradient-danger">Sorry!</h5>
            <div id="existmessage"></div>
        </div>
        <div class="card card-primary card-outline card-outline-tabs" id="mainform">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <li class="nav-item organization-tab" @click="shownexttab('organization-tab')">
                        <a class="nav-link active" data-toggle="pill" role="tab"> 
                            <label class="mb-0.5">Organization Details </label>                              
                        </a>
                    </li>
                    <li class="nav-item class-tab" @click="shownexttab('class-tab')">
                        <a class="nav-link" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Classes and Stream </label>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body pt-0 mt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="organization-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <input type="hidden" class="form-control" v-model="form.id" id="id"/>
                        <div class="form-group row"> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Proposed Name:<span class="text-danger">*</span></label>
                                <input type="text" v-model="form.proposedName" :class="{ 'is-invalid': form.errors.has('proposedName') }" @change="remove_error('proposedName')" class="form-control" id="proposedName" />
                                <has-error :form="form" field="proposedName"></has-error>
                            </div>  
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Level:<span class="text-danger">*</span></label>
                                <select name="level" id="level" v-model="form.level" :class="{ 'is-invalid': form.errors.has('level') }" class="form-control select2" @change="getCategory(),remove_error('level')">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in levelList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="level"></has-error>
                            </div>  
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Category:<span class="text-danger">*</span></label>
                                <br> 
                                <label><input  type="radio" name="category" v-model="form.category" @change="showprivatedetails('public')" value="1" tabindex=""/> Public</label>
                                <label><input  type="radio" name="category" v-model="form.category" @change="showprivatedetails('private')" value="0"  tabindex=""/> Private</label>
                                <label style="display:none" class="eccd"><input type="radio" name="category" v-model="form.category" @change="showprivatedetails('ngo')" value="2" tabindex=""/> Ngo</label>
                                <label style="display:none" class="eccd"><input type="radio" name="category" v-model="form.category" @change="showprivatedetails('coporate')" value="3"  tabindex=""/> Coporate</label>
                                <has-error :form="form" field="proposedName"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Dzongkhag:<span class="text-danger">*</span></label>
                                <select v-model="form.dzongkhag" :class="{ 'is-invalid': form.errors.has('dzongkhag') }" class="form-control select2" name="dzongkhag" id="dzongkhag">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select> 
                                <has-error :form="form" field="dzongkhag"></has-error>
                            </div>  
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Gewog:<span class="text-danger">*</span></label>
                                <select v-model="form.gewog" :class="{ 'is-invalid select2 select2-hidden-accessible':form.errors.has('gewog') }" class="form-control select2" name="gewog" id="gewog">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in gewog_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="gewog"></has-error>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Chiwog:<span class="text-danger">*</span></label>
                                <select v-model="form.chiwog" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('chiwog') }" class="form-control select2" name="chiwog" id="chiwog">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in villageList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="chiwog"></has-error>
                            </div>                 
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Location Type:<span class="text-danger">*</span></label>
                                <select name="locationCategory" v-model="form.locationType" :class="{ 'is-invalid': form.errors.has('locationType') }" id="locationType" class="form-control select2" @change="remove_error('locationType')">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in locationList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="locationType"></has-error>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Geopolitically Located:</label>
                                <br>
                                <label><input  type="radio" v-model="form.geopolicaticallyLocated" value="1" tabindex=""/> Yes</label>
                                <label><input  type="radio" v-model="form.geopolicaticallyLocated" value="0" tabindex=""/> No</label>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Sen School:<span class="text-danger">*</span></label>
                                <br>
                                <label><input  type="radio" @change="show_parent_school_details(true)" v-model="form.senSchool" value="1" tabindex=""/> Yes</label>
                                <label><input  type="radio" @change="show_parent_school_details(false)" v-model="form.senSchool" value="0" tabindex=""/> No</label>
                            </div>                  
                        </div>
                        <div class="form-group row" id="parentDetails" style="display:none">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="parentSchoolDiv">
                                <label class="mb-0">Parent School:</label>
                                <select name="parentSchool" v-model="form.parentSchool" id="parentSchool" class="form-control  editable_fields">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in orgList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="coLocatedDiv">
                                <label class="mb-0">Co-located with Parent School:</label>
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
                                    <input type="text" v-model="form.name" class="form-control" id="fullname"/>
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
                                <label class="mb-0">Select classes and streams:<span class="text-danger">*</span></label>
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
            orgList:[],
            classList:[],
            streamList:[],
            form: new form({
                id: '',proposedName:'',level:'',category:'1',dzongkhag:'',gewog:'',chiwog:'0',locationType:'',
                geopolicaticallyLocated:'0',senSchool:'0',parentSchool:'',coLocatedParent:'0',cid:'',name:'',
                phoneNo:'',email:'',status:'pending'
            }),
            classStreamForm: new form({
                id: '',class:[], stream:[], status:'submitted'
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
        getOrgList(uri = '/organization/getOrgList'){
            axios.get(uri)
            .then(response => {
                this.orgList = response.data.data;
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
            if(id!="" && (dzoId==null || dzoId=="")){
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
            if(id!="" && (gewogId==null || gewogId=="")){
                gewogId=id;
            }
            let uri = 'masters/all_active_dropdowns/gewog/'+gewogId;
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
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="level"){
                this.form.level=$('#level').val();
                this.getCategory();
            }
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
            if(id=="locationType"){
                this.form.locationType=$('#locationType').val();
            }
        },

        /**
         * method to get class in checkbox
         */
        getClass:function(){
            axios.get('/organization/getClass')
              .then(response => {
                this.classList = response.data;
            });
        },

        /**
         * method to get stream in checkbox
         */
        getStream:function(){
            axios.get('/organization/getStream')
              .then(response => {
                this.streamList = response.data;
            });
        },

        /**
         * method to show next tab
         */
        shownexttab(nextclass){ 
            if(nextclass=="final-tab"){ 
                Swal.fire({
                    text: "Are you sure you wish to safe this details ?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        this.classStreamForm.post('organization/saveClassStream')
                        .then((response) => {
                            if(response.data=="No Screen"){
                                Toast.fire({  
                                    icon: 'error',
                                    title: 'Technical Errors: please contact system admimnistrator for further details'
                                });
                            }
                            if(response!="" && response!="No Screen"){
                                let message="Applicaiton for new Establishment has been submitted for approval. System Generated application number for this transaction is: <b>"+response.data.data.application_number+'.</b><br> Use this application number to track your application status. <br><b>Thank You !</b>';
                                this.$router.push({name:'acknowledgement',params: {data:message}});
                                Toast.fire({  
                                    icon: 'success',
                                    title: 'Application for new establishment has been submitted for further action'
                                });
                            } 
                        })
                        .catch((err) => {
                            console.log("Error:"+err)
                        })
                    }
                });
            }
            else{
                if(nextclass=="class-tab"){
                    this.form.post('organization/saveEstablishment',this.form)
                    .then((response) => {
                        if(response.data!=""){
                            this.change_tab(nextclass);
                        }
                    })
                    .catch((error) => {
                       this.applyselect2();
                        this.change_tab('organization-tab');
                        console.log("Error:"+error)
                    })
                }else{
                    this.change_tab(nextclass);
                }
            }
        },

        applyselect2(){
            if(!$('#level').attr('class').includes('select2-hidden-accessible')){
                $('#level').addClass('select2-hidden-accessible');
            }
            if(!$('#dzongkhag').attr('class').includes('select2-hidden-accessible')){
                $('#dzongkhag').addClass('select2-hidden-accessible');
            }
            if(!$('#gewog').attr('class').includes('select2-hidden-accessible')){
                $('#gewog').addClass('select2-hidden-accessible');
            }
            if(!$('#chiwog').attr('class').includes('select2-hidden-accessible')){
                $('#chiwog').addClass('select2-hidden-accessible');
            }
            if(!$('#locationType').attr('class').includes('select2-hidden-accessible')){
                $('#locationType').addClass('select2-hidden-accessible');
            }
        },

        /**
         * method to change tabs
         */
        change_tab(nextclass){
            $('#tabhead >li >a').removeClass('active');
            $('#tabhead >li >a >span').addClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').addClass('active');
            $('.'+nextclass+' >a >span').removeClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').removeClass('disabled');
            $('.tab-content-details').hide();
            $('#'+nextclass).show().removeClass('fade');
            this.applyselect2();
        },

        /**
         * method to get other category if the category is 'ECCD'
         */
        getCategory(){
            let level = $('#level option:selected').text();
            if(level == "ECCD"){
                $(".eccd").show();
            }
            else{
                $(".eccd").hide();
            }
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
        loadProprietorDetails(){
            axios.get('organization/loadProprietorDetails')
            .then((response) => {  

                let data=response.data.data[0];
                this.form.cid           =   data.cid;
                this.form.name          =   data.fullName;
                this.form.phoneNo       =   data.phoneNo;
                this.form.email         =   data.email;
            })
            .catch((error) => {  
                console.log("Error......"+error);
            });
        },
        
        /**
         * method to load organization details
         */
         loaddOrganizationDetails(){
            axios.get('organization/loadOrganizationDetails')
            .then((response) => {  
                let data=response.data.data;
                this.form.id  =   data.id;
                this.form.proposedName  =   data.proposedName;
                this.form.level         =   data.levelId;
                $('#level').val(data.levelId).trigger('change');
                this.form.category      =   data.category;
                this.form.locationType  =   data.locationId;
                $('#locationType').val(data.locationId).trigger('change');
                
                //to populate proprietor details if category is private
                if(data.category == 0){
                    this.showprivatedetails('private');
                    this.loadProprietorDetails();
                }
                $('#dzongkhag').val(JSON.parse(response.data.dzongkhag).data.id).trigger('change');
                this.form.dzongkhag = JSON.parse(response.data.dzongkhag).data.id;
                this.getgewoglist(JSON.parse(response.data.dzongkhag).data.id);
                this.form.gewog = JSON.parse(response.data.gewog).data.id;
                this.getvillagelist(JSON.parse(response.data.gewog).data.id);
                this.form.chiwog = data.chiwogId;

                this.form.geopolicaticallyLocated   =   data.isGeopoliticallyLocated;
                this.form.senSchool                 =   data.isSenSchool;
                this.form.parentSchool              =   data.parentSchoolId;
                this.form.coLocated                 =   data.isColocated;
                
            })
            .catch((error) => {  
                console.log("Error......"+error);
            });
        },

        getScreenAccess(){
            axios.get('common/getSessionDetail')
            .then(response => {
                let data = response.data.data.acess_level;
                if(data == "Org" || data == "Ministry"){
                    $('#mainform').hide();
                    $('#applicaitonUnderProcess').show();
                    $('#existmessage').html('You have no access to this page.');
                }
                
            })    
            .catch(errors => { 
                console.log(errors)
            });
        }

        /** commented after discussing with phuntsho sir. Need to verify with MOE. */ 

        // checkPendingApplication(){
        //     axios.get('organization/checkPendingApplication/establishment')
        //     .then((response) => {  
        //         let data=response.data;
        //         if(data!=""){
        //             $('#mainform').hide();
        //             $('#applicaitonUnderProcess').show();
        //             $('#existmessage').html('You have already submitted application for new establishment <b>('+data.application_number+')</b> which is under process.');
        //         }
        //     })
        //     .catch((error) => {  
        //         console.log("Error: "+error);
        //     });
        // },
    },
    
    created(){
        this.getScreenAccess();
        this.getLevel();
        this.getLocation();
        // this.checkPendingApplication();
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
        this.loaddOrganizationDetails();
        this.getOrgList();
    }, 
}
</script>
