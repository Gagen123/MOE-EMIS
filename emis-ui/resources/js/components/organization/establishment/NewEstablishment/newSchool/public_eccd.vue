<template>
    <div>
        <div class="callout callout-danger" style="display:none" id="screenPermission">
            <h5 class="bg-gradient-danger">Sorry!</h5>
            <div id="message"></div>
        </div>
        <div class="card card-primary card-outline card-outline-tabs" id="mainform">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <li class="nav-item organization-tab" @click="shownexttab('organization-tab')">
                        <a class="nav-link active" data-toggle="pill" role="tab"> 
                            <label class="mb-0.5">Organization Details </label>                              
                        </a>
                    </li>
                    <li class="nav-item file-tab" @click="shownexttab('file-tab')">
                        <a class="nav-link" data-toggle="pill" role="tab">
                            <label class="mb-0.5">File Uploads </label>
                        </a>
                    </li>
                    <li class="nav-item class-tab" @click="shownexttab('class-tab')">
                        <a class="nav-link" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Classes and Stream </label>
                        </a>
                    </li>
                </ul>
            </div>
            <br />
            <div class="card-body pt-0 mt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="organization-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <form class="form-horizontal">
                        <input type="hidden" class="form-control" v-model="form.id" id="id"/>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Proposal Initiated By:<span class="text-danger">*</span></label>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <input type="text" v-model="form.initiatedBy" :class="{ 'is-invalid': form.errors.has('initiatedBy') }" @change="remove_error('initiatedBy')" class="form-control" id="initiatedBy" placeholder="Proposal Initiated By (e.g. Community)"/>
                                <has-error :form="form" field="initiatedBy"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Proposed Name:<span class="text-danger">*</span></label>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <input type="text" v-model="form.proposedName" :class="{ 'is-invalid': form.errors.has('proposedName') }" @change="remove_error('proposedName')" class="form-control" id="proposedName" placeholder="Proposed Name" />
                                <has-error :form="form" field="proposedName"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Proposed Location:<span class="text-danger">*</span></label>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <input type="text" v-model="form.proposedLocation" :class="{ 'is-invalid': form.errors.has('proposedLocation') }" @change="remove_error('proposedLocation')" class="form-control" id="proposedLocation" placeholder="Proposed Location"/>
                                <has-error :form="form" field="proposedLocation"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Gewog:<span class="text-danger">*</span></label>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <select v-model="form.gewog" :class="{ 'is-invalid select2 select2-hidden-accessible':form.errors.has('gewog') }" class="form-control select2" name="gewog" id="gewog">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in gewog_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="gewog"></has-error>
                            </div>
                            <label class="col-lg-1.5 col-md-1.5 col-sm-1.5 col-form-label">Chiwog:<span class="text-danger">*</span></label>
                            <div class="col-lg-2.5 col-md-2.5 col-sm-2.5">
                                <select v-model="form.chiwog" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('chiwog') }" class="form-control select2" name="chiwog" id="chiwog">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in villageList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="chiwog"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Location Type:<span class="text-danger">*</span></label>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <select name="locationCategory" v-model="form.locationType" :class="{ 'is-invalid': form.errors.has('locationType') }" id="locationType" class="form-control select2" @change="remove_error('locationType')">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in locationList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="locationType"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Is Co-located with Parent School:<span class="text-danger">*</span></label>
                            <div class="col-lg-3 col-md-3 col-sm-3 pt-3">
                                <label><input  type="radio" @change="show_parent_school_details(true)" v-model="form.coLocatedParent" value="1" tabindex=""/> Yes</label>
                                <label><input  type="radio" @change="show_parent_school_details(false)" v-model="form.coLocatedParent" value="0" tabindex=""/> No</label>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="parentDetails" style="display:none">
                                <div class="form-group row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="mb-0">Parent School:</label>
                                        <select name="parentSchool" v-model="form.parentSchool" id="parentSchool" class="form-control  editable_fields">
                                            <option value="">--- Please Select ---</option>
                                            <option v-for="(item, index) in orgList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" @click="shownexttab('file-tab')">Save & Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade tab-content-details" id="file-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0">Upload the Required Documents<span class="text-danger">*</span></label>
                            </div>
                        </div><br>
                        <div class="card">
                            <div class="form-group row">
                                <div class="card-body col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>File Name</th>
                                                <th>Upload File</th>                     
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr id="record1" v-for='(att, index) in file_form.fileUpload' :key="index">
                                                <td>
                                                    <input type="text" class="form-control" :class="{ 'is-invalid' :form.errors.has('file_name') }" v-model="att.file_name" :id="'file_name'+(index+1)">
                                                    <span class="text-danger" :id="'file_name'+(index+1)+'_err'"></span>
                                                </td>
                                                <td>                                
                                                    <input type="file" class="form-control" v-on:change="onChangeFileUpload" :id="'attach'+(index+1)">
                                                    <span class="text-danger" :id="'attach'+(index+1)+'_err'"></span>
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
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('organization-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-primary" @click="shownexttab('class-tab')"> Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade tab-content-details" id="class-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0">Select Age Group:<span class="text-danger">*</span></label>
                            </div>
                        </div><br>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                            <span v-for="(item, key, index) in  classStreamList" :key="index">
                                <input type="checkbox" v-model="classStreamForm.class" :value="item.classId"><label class="pr-4"> &nbsp;{{ item.class }}</label>
                                <span v-if="item.class=='Class 11' || item.class=='Class 12'">
                                    <!-- Here we are taking the class stream mapping id. Do not need to use padding-->
                                    <input type="checkbox" v-model="classStreamForm.stream"  :id="item.id" :value="item.id"> <label class="pr-3"> {{ item.stream  }}</label>
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
            dzongkhag:'',
            levelList:[],
            locationList:[],
            dzongkhagList:[],
            gewog_list:[],
            villageList:[],
            orgList:[],
            classList:[],
            streamList:[],
            classStreamList:[],
            fileUpload: [],
            draft_data:[],
            // id:'2fea1ad2-824b-434a-a608-614a482e66c1',

            file_form: new form({
                id:'',
                file_name: '',
                fileUpload: [],
                record_type:'add',
                applicaiton_number:'',
                attachments:
                [{
                    file_name:'',attachment:''
                }],
                ref_docs:[],
            }),

            form: new form({
                id: '',initiatedBy:'', proposedName:'',level:'',category:'1',dzongkhag:'',gewog:'',chiwog:'0',locationType:'',
                coLocatedParent:'0', proposedLocation:'', establishment_type:'public_eccd', status:'pending'
            }),
            classStreamForm: new form({
                id: '',class:[], stream:[], proposed_establishment:'Public ECCD', status:'submitted',applicaiton_number:'',
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
         * method to get Gewog in dropdown
         */
        getGewogList(dzongkhag){
            let uri = 'masters/all_active_dropdowns/dzongkhag/'+dzongkhag;
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.gewog_list = data.data;
            });
        },

        /**
         * method to get gewog list
         */
        // async getgewoglist(dzongkhag){
        //     let dzoId=$('#dzongkhag').val();
        //     if(id!="" && (dzoId==null || dzoId=="")){
        //         dzoId=id;
        //     }
        //     let uri = 'masters/all_active_dropdowns/dzongkhag/'+dzoId;
        //     axios.get(uri)
        //     .then(response =>{
        //         let data = response;
        //         this.gewog_list = data.data.data;
        //     })
        //     .catch(function (error){
        //         console.log("Error:"+error)
        //     });
        // },
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
         * method to add more fields
         */
        addMore: function(){
            this.count++;
            this.file_form.fileUpload.push({file_name:'', file_upload:''})
        },
        addMoreStudents: function(){
            this.count++;
            this.file_form.assigned_student.push({student:'',std_role:'', remarks:''})   
        }, 
        /**
         * method to remove fields
         */
        remove(index){    
             if(this.file_form.roles.length>1){
                this.count--;
                this.file_form.roles.splice(index,1); 
            }
        },
        removeStudents(index){    
             if(this.file_form.assigned_student.length>1){
                this.count--;
                this.file_form.assigned_student.splice(index,1); 
            }
        },

        onChangeFileUpload(e){
            let currentcount=e.target.id.match(/\d+/g)[0];
            if($('#fileName'+currentcount).val()!=""){
                this.file_form.ref_docs.push({name:$('#file_name'+currentcount).val(), attach: e.target.files[0]});
                $('#fileName'+currentcount).prop('readonly',true);
            }
            else{
                $('#fileName'+currentcount+'_err').html('Please mention file name');
                $('#'+e.target.id).val('');
            } 
        },


        /**
         * to load the respective pages depending on the type of establishment
         */

        loadRespectivePage(val){
            this.$router.push({name:''+val,query: {data:id}});
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
            if(id=="establishment_type"){
                this.form.establishment_type=$('#establishment_type').val();     
                this.loadRespectivePage($('#establishment_type').val());   
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
         * method to get class stream in checkbox
         */
        getClassStream:function(){
            axios.get('/masters/loadClassStreamMapping/eccd')
              .then(response => {
                this.classStreamList = response.data.data;
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
                                    title: 'Technical Errors: please contact system administrator for further details'
                                });
                            }
                            if(response!="" && response!="No Screen"){
                                let message="Applicaiton for new Establishment has been submitted for approval. System Generated application number for this transaction is: <b>"+response.data.data.application_number+'.</b><br> Use this application number to track your application status. <br><b>Thank You !</b>';
                                this.$router.push({name:'estb_acknowledgement',params: {data:message}});
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
                if(nextclass=="file-tab"){
                    this.form.post('organization/saveEstablishment',this.form)
                    .then((response) => {
                        if(response.data!=""){
                            this.file_form.applicaiton_number=response.data.data.applicaiton_details.application_no;
                            this.classStreamForm.applicaiton_number=response.data.data.applicaiton_details.application_no;
                            // this.loadpendingdetails('Public_School');
                            this.change_tab(nextclass);
                        }
                    })
                    .catch((error) => {
                       this.applyselect2();
                        this.change_tab('organization-tab');
                        console.log("Error:"+error)
                    })
                }
                else if(nextclass=="class-tab"){
                    const config = {
                        headers: {
                            'content-type': 'multipart/form-data'
                        }
                    }
                    let formData = new FormData();
                    formData.append('id', this.file_form.id);
                    formData.append('ref_docs[]', this.file_form.ref_docs);
                    for(let i=0;i<this.file_form.ref_docs.length;i++){
                        formData.append('attachments[]', this.file_form.ref_docs[i].attach);
                        // formData.append('attachmentname[]', this.form.ref_docs[i].attachment.name+', '+this.form.ref_docs[i].file_name);
                        formData.append('attachmentname[]', this.file_form.ref_docs[i].name);
                    }
                    formData.append('applicaiton_number', this.file_form.applicaiton_number);
                    
                    axios.post('organization/saveUploadedFiles', formData, config)
                    // this.file_form.post('organization/saveUploadedFiles',this.form)
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
        loadpendingdetails(type){
            axios.get('organization/loaddraftApplication/'+type)
              .then(response => {
                this.draft_data = response.data.data;
            });
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
        show_feeding_details(param){
            if(param){
                $('#feedingDetails').show();
            }
            else{
                $('#feedingDetails').hide();
            }
        },
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
        //  loaddOrganizationDetails(){
        //     axios.get('organization/loadOrganizationDetails')
        //     .then((response) => {  
        //         let data=response.data.data;
        //         this.form.id  =   data.id;
        //         this.form.proposedName  =   data.proposedName;
        //         this.form.level         =   data.levelId;
        //         $('#level').val(data.levelId).trigger('change');
        //         this.form.category      =   data.category;
        //         this.form.locationType  =   data.locationId;
        //         $('#locationType').val(data.locationId).trigger('change');
                
        //         //to populate proprietor details if category is private
        //         if(data.category == 0){
        //             this.showprivatedetails('private');
        //             this.loadProprietorDetails();
        //         }
        //         $('#dzongkhag').val(JSON.parse(response.data.dzongkhag).data.id).trigger('change');
        //         this.form.dzongkhag = JSON.parse(response.data.dzongkhag).data.id;
        //         this.getgewoglist(JSON.parse(response.data.dzongkhag).data.id);
        //         this.form.gewog = JSON.parse(response.data.gewog).data.id;
        //         this.getvillagelist(JSON.parse(response.data.gewog).data.id);
        //         this.form.chiwog = data.chiwogId;

        //         this.form.geopoliticallyLocated   =   data.isGeopoliticallyLocated;
        //         this.form.senSchool                 =   data.isSenSchool;
        //         this.form.parentSchool              =   data.parentSchoolId;
        //         this.form.coLocated                 =   data.isColocated;
                
        //     })
        //     .catch((error) => {  
        //         console.log("Error......"+error);
        //     });
        // },

        getScreenAccess(){
            axios.get('common/getScreenAccess/workflow__establishment__public_eccd')
            .then(response => {
                let data = response.data[0].total_count;
                if(data<1){
                    $('#screenPermission').show();
                    $('#mainform').hide();
                    $('#message').html('This page is not accessible to you. Please contact system administrator for further assistant<br> Thank you');
                }
            })    
            .catch(errors => { 
                console.log(errors)
            });
        },
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
        axios.get('common/getSessionDetail')
            .then(response => {
                let data = response.data.data;
                this.dzongkhag=data['Dzo_Id'];
                this.form.dzongkhag=data['Dzo_Id'];
                this.getGewogList(data['Dzo_Id']);
            })    
            .catch(errors => { 
                console.log(errors)
            });
        
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
        this.getClassStream();
        this.getLevel();
        this.getLocation();
        // this.loadactivedzongkhagList();
        this.loaddOrganizationDetails();
        this.getOrgList();
        this.loadpendingdetails('Public_ECCD');
    }, 
}
</script>
