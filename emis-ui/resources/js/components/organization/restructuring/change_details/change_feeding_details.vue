<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs" id="mainform">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <li class="nav-item organization-tab" @click="shownexttab('organization-tab')">
                        <a class="nav-link active" data-toggle="pill" role="tab"> 
                            <label class="mb-0.5">Change Feeding Details of Organization</label>                              
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body pt-0 mt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="organization-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="tab-pane fade active show tab-content-details" id="organization-tab" role="tabpanel" aria-labelledby="basicdetails">
                            <form class="form-horizontal">
                            <input type="hidden" class="form-control" v-model="form.id" id="id"/>
                            <div class="form-group row">
                                <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Select Organization:<span class="text-danger">*</span></label>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <select name="level" id="level" v-model="form.level" :class="{ 'is-invalid': form.errors.has('level') }" class="form-control select2" @change="getCategory(),remove_error('level')">
                                        <option value="">--- Please Select ---</option>
                                        <option v-for="(item, index) in orgList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                    </select>
                                    <has-error :form="form" field="level"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Is Feeding School:<span class="text-danger">*</span></label>
                                <div class="col-lg-3 col-md-3 col-sm-3 pt-3">
                                    <label><input  type="radio" @change="show_feeding_details(true)" v-model="form.isfeedingschool" value="1" tabindex=""/> Yes</label>
                                    <label><input  type="radio" @change="show_feeding_details(false)" v-model="form.isfeedingschool" value="0" tabindex=""/> No</label>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"  id="feedingDetails" style="display:none">
                                    <label class="mb-0">Feeding Modality:</label><br>
                                    <label><input  type="checkbox" v-model="form.feeding" id="feeding1" value="1" tabindex=""/> One Meal</label>
                                    <label><input  type="checkbox" v-model="form.feeding" id="feeding2" value="2" tabindex=""/> Two Meals</label>
                                    <label><input  type="checkbox" v-model="form.feeding" id="feeding3" value="3" tabindex=""/> Three Meals</label>
                                </div>
                            </div>
                            <br>
                            </form>
                            <hr>
                            <div class="row form-group fa-pull-right">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button class="btn btn-primary" @click="shownexttab('class-tab')">Save <i class="fa fa-arrow-right"></i></button>
                                </div>
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
            orgList:'',
            levelList:[],
            locationList:[],
            dzongkhagList:[],
            gewog_list:[],
            villageList:[], 
            classList1:[],
            streamList1:[],
            classList:[],
            streamList:[],
            form: new form({
                organizationId:'',name:'',level:'1',category:'1',dzongkhag:'',gewog:'',chiwog:'',
                locationType:'1',geoLocated:'0',senSchool:'0', parentSchool:'',coLocatedParent:'0',
                cid:'',fullName:'',phoneNo:'',email:'',status:'pending'
            }),
            classStreamForm: new form({
                id: '',class:[], stream:[],application_number:'',status:'submitted'
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
         * method to get location in dropdown
         */
        getLocation(uri = '/organization/getLocationInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.locationList = data;
            });
        },

        getOrgList(uri = '/organization/getOrgList'){
            axios.get(uri)
            .then(response => {
                this.orgList = response.data.data;
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
                                if(response.data=="No Screen"){
                                    Toast.fire({  
                                        icon: 'error',
                                        title: 'Technical Errors: please contact system admimnistrator for further details'
                                    });
                                }
                                if(response!="" && response!="No Screen"){
                                    let message="Applicaiton for Change basic details has been submitted for approval. System Generated application number for this transaction is: <b>"+response.data.data.application_number+'.</b><br> Use this application number to track your application status. <br><b>Thank You !</b>';
                                    this.$router.push({name:'restr_acknowledgement',params: {data:message}});
                                    Toast.fire({  
                                        icon: 'success',
                                        title: 'Change details is saved successfully'
                                    });
                                }
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
                     this.form.post('organization/saveChangeBasicDetails',this.form)
                    .then((response) => {
                        this.classStreamForm.application_number=response.data.data.applicationNo;
                       Toast.fire({
                            icon: 'success',
                            title: 'Data saved Successfully'
                        });
                        this.change_tab(nextclass);
                    })
                    .catch((e) => {
                        this.change_tab('organization-tab');
                        this.applyselect2();
                        console.log("error: "+e)
                    })
                }
                else{
                    this.change_tab(nextclass);
                }
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

         getScreenAccess(){
            axios.get('common/getSessionDetail')
            .then(response => {
                let data = response.data.data.acess_level;
                if(data != "Org"){
                    $('#mainform').hide();
                    $('#applicaitonUnderProcess').show();
                    $('#existmessage').html('You have no access to this page.');
                }
                
            })    
            .catch(errors => { 
                console.log(errors)
            });
        },

        checkPendingApplication(){
            axios.get('organization/checkPendingApplication/change')
            .then((response) => {  
                let data=response.data;
                if(data!=""){
                    $('#mainform').hide();
                    $('#applicaitonUnderProcess').show();
                    $('#existmessage').html('You have already submitted application for basic details change <b>('+data.application_number+')</b> which is under process.');
                }
            })
            .catch((error) => {  
                console.log("Error: "+error);
            });
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
         * Show feeding details options
         */
        show_feeding_details(param){
            if(param){
                $('#feedingDetails').show();
            }
            else{
                $('#feedingDetails').hide();
            }
        },

        /**
         * method to current details
        */        
        loadCurrentOrgDetails(){
            axios.get('organization/getFullSchoolDetials/sessionDet')
            .then((response) => {  
                let data=response.data.data;
                this.form.id        =   data.id;
                this.form.name      =   data.name;
                this.form.level     =   data.levelId;
                this.form.category  =   data.category;
                this.form.locationType  =   data.locationId;

                //to populate parent school details if category is private
                if(data.isSenSchool == 1){
                    this.show_parent_school_details(true);
                }
                $('#dzongkhag').val(data.dzongkhagId).trigger('change');
                this.form.dzongkhag = data.dzongkhagId;
                this.getgewoglist(data.dzongkhagId);
                 $('#gewog').val(data.gewogId).trigger('change');
                this.form.gewog = data.gewogId;
                this.getvillagelist(data.gewogId);
                this.form.chiwog = data.chiwogId;
                this.form.geoLocated                =   data.isGeopoliticallyLocated;
                this.form.senSchool                 =   data.isSenSchool;
                this.form.parentSchool              =   data.parentSchoolId;
                this.form.coLocatedParent           =   data.isColocated;
                let prop=data.proprietor;
                for(let i=0;i<prop.length;i++){
                    this.form.cid = prop[i].cid;
                    this.form.fullName = prop[i].fullName;
                    this.form.phoneNo = prop[i].phoneNo;
                    this.form.email = prop[i].email;
                    this.showprivatedetails('private');
                }
                this.classList1=data.class_section;
                this.streamList1=data.sections;
                // for(let i=0;i<data.class_section.length;i++){
                //     $('#'+data.class_section[i].classId).prop('checked',true);
                //     this.form.class.push(data.class_section[i].classId)
                //     for(let j=0;j<data.sections.length;j++){  
                //         $('#'+data.class_section[i].classId+data.sections[j].streamId).prop('checked',true);
                //         //this.form.stream.push(data.class_section[i].classId+'##'+data.sections[j].streamId);
                //     } 
                // }
            })
            .catch((error) => {  
                console.log("Error: "+error);
            });
        },
        
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
        this.getScreenAccess();
        this.getClass();
        this.getStream();  
        this.checkPendingApplication();
        this.getLevel();
        this.getLocation();
        this.getOrgList();
        this.loadactivedzongkhagList();
        this.loadCurrentOrgDetails();
        this.getApplicationNo();
    }
}
</script>
