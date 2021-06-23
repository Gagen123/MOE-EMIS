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
                     <li class="nav-item class-tab" @click="shownexttab('class-tab')">
                        <a class="nav-link" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Classes and Stream </label>
                        </a>
                    </li>
                    <li class="nav-item file-tab" @click="shownexttab('file-tab')">
                        <a class="nav-link" data-toggle="pill" role="tab">
                            <label class="mb-0.5">File Uploads </label>
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
                                <select name="initiatedBy" id="initiatedBy" v-model="form.initiatedBy" :class="{ 'is-invalid': form.errors.has('initiatedBy') }" class="form-control select2" @change="remove_error('initiatedBy')">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in proposed_by_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
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
                        <!-- <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Proposed Location:<span class="text-danger">*</span></label>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <input type="text" v-model="form.proposedLocation" :class="{ 'is-invalid': form.errors.has('proposedLocation') }" @change="remove_error('proposedLocation')" class="form-control" id="proposedLocation" placeholder="Proposed Location"/>
                                <has-error :form="form" field="proposedLocation"></has-error>
                            </div>
                        </div> -->
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
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="parentDetails">
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
                            <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Classes</th>
                                        <th class="strm_clas">Stream</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, key, index) in  classStreamList" :key="index">
                                        <td>
                                            <label class="pr-4"> &nbsp;{{ item.class }} </label>
                                        </td>
                                        <td class="strm_clas" v-if="item.class=='Class 11' || item.class=='XI' || item.class=='Class 12' || item.class=='XII'">
                                            {{  item.stream  }}
                                        </td>
                                        <td class="strm_clas" v-else>

                                        </td>
                                        <td v-if="item.class=='Class 11' || item.class=='XI' || item.class=='Class 12' || item.class=='XII'">
                                            <input type="checkbox" name="class_stream" v-model="classStreamForm.stream"  :id="item.id" :value="item.id">
                                        </td>
                                        <td v-else>
                                            <input type="checkbox" name="class_stream" :id="'class_stream'+item.classId" v-model="classStreamForm.class" :value="item.classId">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('organization-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-primary" @click="shownexttab('file-tab')"> Next <i class="fa fa-arrow-right"></i></button>
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
                                <button class="btn btn-success" @click="shownexttab('class-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
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
            proposed_by_list:[],
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
            record_id:'',
            file_form: new form({
                id:'',
                file_name: '',
                fileUpload: [],
                record_type:'edit',
                application_number:'',
                status:'Submitted',
                remarks:'',
                action_type:'edit',
                service_name:'New Establishment of Public ECR',
                attachments:
                [{
                    file_name:'',attachment:''
                }],
                ref_docs:[],
            }),
            form: new form({
                id: '',initiatedBy:'', proposedName:'',level:'',category:'1',dzongkhag:'',gewog:'',chiwog:'0',locationType:'',
                coLocatedParent:'1', proposedLocation:'', establishment_type:'public_ecr', status:'pending',action_type:'edit',
            }),
            classStreamForm: new form({
                id: '',class:[], stream:[], proposed_establishment:'Public ECR', status:'Submitted',application_number:'',action_type:'edit',
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
        addMore: function(){
            this.count++;
            this.file_form.fileUpload.push({file_name:'', file_upload:''})
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

        /**
         * method to get level in dropdown
         */
        getLevel(uri = '/organization/getLevelInDropdown'){
            axios.get('/masters/loadClassStreamMapping/school_6')
              .then(response => {
                this.classStreamList = response.data.data;
            });
        },
        //getOrgList(uri = '/organization/getOrgList'){
        getOrgList(uri = 'loadCommons/loadOrgList/userdzongkhagwise/NA'){
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
            if(id=="initiatedBy"){
                this.form.initiatedBy=$('#initiatedBy').val();
            }

        },

        /**
         * method to get class stream in checkbox
         */
        getClassStream:function(){
            axios.get('/masters/loadClassStreamMapping/school_6')
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
            if(nextclass=="final-tab" || nextclass=="reject"){
                let subform=true;
                let status="";
                let message="";
                if(nextclass=="reject"){
                    if($('#remarks').val()==""){
                        subform=false;
                        $('#remarks_err').html('Please mention remarks');
                    }
                    else{
                        status="Are you sure you wish to reject this application? ";
                        message="Application for new Establishment has been recorded in the system as reject. System Generated application number for this transaction is: ";
                    }
                }
                if(nextclass=="final-tab"){
                    status="Are you sure you wish to submit this application for further approval ? ";
                    message="Application for new Establishment has been submitted for approval. System Generated application number for this transaction is: ";
                }
                if(subform){

                    Swal.fire({
                        text: status,
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes!',
                        }).then((result) => {
                        if (result.isConfirmed) {
                            let clasArray=[];
                            $("input[name='attachment']:checked").each( function () {
                                clasArray.push($(this).val());
                            });
                            if(clasArray.length<1){
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
                                    formData.append('attachmentname[]', this.file_form.ref_docs[i].name);
                                }
                                formData.append('application_number', this.file_form.application_number);
                                formData.append('remarks', this.file_form.remarks);
                                formData.append('status', this.file_form.status);
                                formData.append('service_name', this.file_form.service_name);
                                formData.append('proposedName', this.form.proposedName);
                                formData.append('submit_type', nextclass);
                                axios.post('organization/saveUploadedFiles', formData, config)
                                .then((response) => {
                                    if(response.data!=""){
                                        if(response=="No Screen"){
                                            Toast.fire({
                                                icon: 'error',
                                                title: 'Technical Errors: please contact system administrator for further details'
                                            });
                                        }
                                        if(response!="" && response!="No Screen"){
                                            let res=response.data.application_number+'.</b><br> Use this application number to track your application status. <br><b>Thank You !</b>';
                                            this.$router.push({name:'acknowledgement_ecr',params: {data:message+res }});
                                            Toast.fire({
                                                icon: 'success',
                                                title: 'Application for new establishment has been submitted for further action'
                                            });
                                        }
                                    }
                                })
                                .catch((error) => {
                                    this.applyselect2();
                                    this.change_tab('file-tab');
                                    console.log("Error:"+error)
                                })
                            }
                            else{
                                Swal.fire({
                                    text: "Please attach files ",
                                    icon: 'info',
                                    confirmButtonText: 'OK',
                                    showCancelButton: true,
                                });
                            }
                        }
                    });
                }
            }
            else{
                if(nextclass=="class-tab"){
                    this.form.feeding=[];
                    let meals=[];
                    $("input[name='feeding']:checked").each( function () {
                        meals.push($(this).val());
                    });
                    this.form.feeding=meals;
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
                }
                else if(nextclass=="file-tab"){
                    let clasArray=[];
                    this.classStreamForm.class=[];
                    $("input[name='class_stream']:checked").each( function () {
                        clasArray.push($(this).val());
                    });
                    if(clasArray.length<1){
                        Swal.fire({
                            text: "Please select Age group?",
                            icon: 'info',
                            confirmButtonText: 'OK',
                            showCancelButton: true,
                        });
                        validated=false;
                    }
                    else{
                        this.classStreamForm.class=clasArray;
                        this.classStreamForm.post('organization/saveClassStream')
                        .then((response) => {
                            if(response!=""){
                                 this.change_tab(nextclass);
                            }
                        })
                        .catch((err) => {
                            console.log("Error:"+err)
                        })
                    }
                    // this.classStreamForm.submit_type=nextclass;
                    // this.classStreamForm.post('organization/saveClassStream')
                    // .then((response) => {
                    //     if(response.data!=""){
                    //         this.change_tab(nextclass);
                    //     }
                    // })
                    // .catch((err) => {
                    //     console.log("Error:"+err)
                    // })
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
            if(!$('#gewog').attr('class').includes('select2-hidden-accessible')){
                $('#gewog').addClass('select2-hidden-accessible');
            }
            if(!$('#chiwog').attr('class').includes('select2-hidden-accessible')){
                $('#chiwog').addClass('select2-hidden-accessible');
            }
            // if(!$('#locationType').attr('class').includes('select2-hidden-accessible')){
            //     $('#locationType').addClass('select2-hidden-accessible');
            // }
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


        show_parent_school_details(param){
            if(param){
                $('#parentDetails').show();
            }
            else{
                $('#parentDetails').hide();
            }
        } ,

        getScreenAccess(){
            axios.get('common/getScreenAccess/workflow__establishment__public_ecr')
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
        loadproposedBy(uri = 'masters/organizationMasterController/loadOrganizaitonmasters/active/ProposedBy'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.proposed_by_list =  data;
            })
            .catch(function (error) {
                console.log('error: '+error);
            });
        },
        getAttachmentType(type){
            axios.get('masters/organizationMasterController/loadOrganizaitonmasters/'+type+'/DocumentType')
            .then(response => {
                let data = response.data;
                data.forEach((item => {
                    this.count++;
                    this.file_form.fileUpload.push({file_name:item.name, file_upload:''})
                }));
            })
            .catch(errors => {
                console.log(errors)
            });
        },
        loadApplicationDetials(){
            axios.get('organization/loadEstablishmentApplciaiton/'+this.record_id)
            .then(response => {
                let data = response.data.data;
                this.attachment_details=data.estb_attachments;
                this.form.id=data.id;
                this.form.application_number=data.application_no;
                this.classStreamForm.application_number=data.application_no;
                this.file_form.application_number=data.application_no;
                this.form.initiatedBy=data.estb_details.initiated_by;
                $('#initiatedBy').val(data.estb_details.initiated_by).trigger('change');
                this.form.proposedName=data.estb_details.proposedName;
                this.form.proposedLocation=data.estb_details.proposedLocation;
                this.form.dzongkhag=data.dzongkhagId;
                $('#dzongkhag').val(data.estb_details.dzongkhagId).trigger('change');
                this.getgewoglistunderdzo(data.dzongkhagId,data.gewogId);
                this.getvillagelistundergeo(data.gewogId,data.chiwogId);
                this.form.level=data.estb_details.levelId;
                $('#level').val(data.estb_details.levelId).trigger('change');
                this.form.locationType=data.estb_details.locationId;
                $('#locationType').val(data.estb_details.locationId).trigger('change');
                this.form.parentSchool=data.estb_details.parentSchool;
                $('#parentSchool').val(data.estb_details.parentSchool).trigger('change');
                this.form.geopoliticallyLocated=data.estb_details.isGeoPoliticallyLocated;
                if(data.estb_classStream.length>0){
                    for(let i=0;i<data.estb_classStream.length;i++){
                        $('#class_stream'+data.estb_classStream[i].classId).prop('checked',true);
                        // $('input:checkbox[name="class_stream"][value="' + data.estb_classStream[i].classId + '"]').attr('checked', 'checked');
                    }
                }
            })
            .catch(errors => {
                console.log('error in retrieving: '+errors)
            });
        },
        getgewoglistunderdzo(dzongkhag,gewog_id){
            let uri = 'masters/all_active_dropdowns/dzongkhag/'+dzongkhag;
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.gewog_list = data;
                // for(let i=0;i<data.length;i++){
                //     this.gewog_listArray[data[i].id] = data[i].name;
                // }
                if(gewog_id!="NA"){
                    this.form.gewog=gewog_id;
                    $('#gewog').val(gewog_id).trigger('change');
                }
            });
        },
        getvillagelistundergeo(id,chewqogid){
            let uri = 'masters/all_active_dropdowns/gewog/'+id;
            axios.get(uri)
            .then(response =>{
                let data = response.data.data;
                this.villageList = data;
                // for(let i=0;i<data.length;i++){
                //     this.villagelistArray[data[i].id] = data[i].name;
                // }
                this.form.chiwog=chewqogid;
                $('#chiwog').val(chewqogid).trigger('change');
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },

    },

    created(){
        this.getScreenAccess();
        this.getLevel();
        this.getLocation();
        this.loadproposedBy();
    },
    mounted() {
        this.getAttachmentType('ForTransaction__Application_for_Public_ECR_Update_Doc');
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
        this.getOrgList();
        this.loadpendingdetails('Public_ECR');
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
        this.record_id=this.$route.params.id;
        this.loadApplicationDetials();
    },
}
</script>
