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
                        <div class="form-group row bg-gray-light mt-xl-n3">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <span id="publicscreenName"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Proposal Initiated By:<span class="text-danger">*</span></label>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <select name="initiatedBy" id="initiatedBy" v-model="form.initiatedBy" :class="{ 'is-invalid': form.errors.has('initiatedBy') }" class="form-control select2" @change="remove_error('initiatedBy')">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in proposed_by_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="initiatedBy"></has-error>
                            </div>
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Proposed Name:<span class="text-danger">*</span></label>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <input type="text" v-model="form.proposedName" :class="{ 'is-invalid': form.errors.has('proposedName') }" @change="remove_error('proposedName')" class="form-control" id="proposedName" placeholder="Proposed Name" />
                                <has-error :form="form" field="proposedName"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Location Type:<span class="text-danger">*</span></label>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <select v-model="form.proposedLocation" :class="{ 'is-invalid select2 select2-hidden-accessible':form.errors.has('proposedLocation') }" class="form-control select2" name="proposedLocation" id="proposedLocation">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in locationList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="proposedLocation"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Gewog:<span class="text-danger">*</span></label>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <select v-model="form.gewog" :class="{ 'is-invalid select2 select2-hidden-accessible':form.errors.has('gewog') }" class="form-control select2" name="gewog" id="gewog">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in gewog_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="gewog"></has-error>
                            </div>
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Chiwog:<span class="text-danger">*</span></label>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <select v-model="form.chiwog" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('chiwog') }" class="form-control select2" name="chiwog" id="chiwog">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in villageList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="chiwog"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 col-form-label">Is Co-located with Parent School:<span class="text-danger">*</span></label>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pt-3">
                                <label><input  type="radio" v-model="form.coLocatedParent" value="1" tabindex=""/> Yes</label>
                                <label><input  type="radio" v-model="form.coLocatedParent" value="0" tabindex=""/> No</label>
                            </div>
                            <label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 col-form-label">Parent School: <span class="text-danger">*</span></label>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <select v-model="form.parentSchool" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('parentSchool') }" class="form-control select2" name="parentSchool" id="parentSchool">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in orgList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                 <has-error :form="form" field="parentSchool"></has-error>
                            </div>
                        </div>
                        </form>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" @click="shownexttab('class-tab')">Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade tab-content-details" id="class-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0">Select classes and streams:<span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                            <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Classes</th>
                                        <th class="strm_clas">Stream</th>
                                        <th>Applicable Class Stream</th>
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
                                            <input type="checkbox" v-model="classStreamForm.stream"  :id="item.id" :value="item.id">
                                        </td>
                                        <td v-else>
                                            <input type="checkbox" v-model="classStreamForm.class" :value="item.classId">
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
                                <label class="mb-0">Upload the Required Documents ({{validfile()}})<span class="text-danger">*</span></label>
                            </div>
                        </div><br>
                        <div class="card">
                            <div class="form-group row">
                                <div class="card-body col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                                                    <input type="text"  @change="remove_error('file_name'+(index+1))" class="form-control" :class="{ 'is-invalid' :form.errors.has('file_name') }" v-model="att.file_name" :id="'file_name'+(index+1)">
                                                    <span class="text-danger" :id="'file_name'+(index+1)+'_err'"></span>
                                                </td>
                                                <td>
                                                    <input type="file"  @change="remove_error('attach'+(index+1))" name="attachments" class="form-control application_attachment" v-on:change="onChangeFileUpload" :id="'attach'+(index+1)">
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
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0">Remarks</label>
                                <textarea class="form-control" @change="remove_error('remarks')" v-model="file_form.remarks" id="remarks"></textarea>
                                <span class="text-danger" id="remarks_err"></span>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('class-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-danger" @click="shownexttab('reject')"> <i class="fa fa-times"></i>Reject </button>
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
            levelArray:{},
            locationList:[],
            dzongkhagList:[],
            gewog_list:[],
            villageList:[],
            orgList:[],

            classStreamList:[],
            fileUpload: [],
            draft_data:[],
            proposed_by_list:[],
            multiAgeIdList:[],

            screenId:'',
            SysRoleId:'',
            Sequence:'',
            Status_Name:'',

            form: new form({
                app_id: '',
                ap_estb_id: '',
                initiatedBy:'',
                proposedName:'',
                coLocatedParent:0,
                parentSchool:'',
                dzongkhag:this.dzongkhag,
                gewog:'',
                chiwog:'',
                proposedLocation:'',
                geopoliticallyLocated:'0',
                senSchool:'0',
                isfeedingschool:'0',
                feeding:[],
                category:'public',
                establishment_type:'Public ECR',
                status:'pending',
            }),

            file_form: new form({
                id:'',
                file_name: '',
                fileUpload: [],
                remarks:'',
                status:'Submitted',
                application_number:'',
                attachments:
                [{
                    file_name:'',attachment:''
                }],
                ref_docs:[],
            }),

            classStreamForm: new form({
                id: '',class:[], stream:[],
                application_number:'',
            })
        }
    },
    methods: {
        /**
         * method to get level in dropdown
         */
        getLevel(uri = '/organization/getLevelInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.levelList = data;
                 for(let i=0;i<data.length;i++){
                    this.levelArray[data[i].id] = data[i].name;
                }
            });
        },

        /**
         * method to get Gewog in dropdown
         */
        async getGewogList(dzongkhag){
            this.gewog_list =await this.loadgewogList(dzongkhag);
        },

        /**
         * method to get gewog list
         */
        async getvillagelist(id,vil_id){
            let gewogId=$('#gewog').val();
            if(id!="" && (gewogId==null || gewogId=="")){
                gewogId=id;
            }
            this.villageList =await this.loadvillageList(gewogId);
            if(vil_id!=""){
                this.form.chiwog=draft.chiwogId;
                $('#chiwog').val(draft.chiwogId).trigger('change');;
            }
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
         * method to populate dropdown
         */
        async changefunction(id,text){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="initiatedBy"){
                this.form.initiatedBy=$('#initiatedBy').val();
            }

            if(id=="gewog"){
                this.form.gewog=$('#gewog').val();
                this.getvillagelist($('#gewog').val(),'');
            }
            if(id=="chiwog"){
                this.form.chiwog=$('#chiwog').val();
            }
            if(id=="proposedLocation"){
                this.form.proposedLocation=$('#proposedLocation').val();
            }
            if(id=="parentSchool"){
                this.form.parentSchool=$('#parentSchool').val();
            }

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
                    subform=this.validateFileform();
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

                                formData.append('screenId', this.screenId);
                                formData.append('SysRoleId', this.SysRoleId);
                                formData.append('Sequence', this.Sequence);
                                formData.append('Status_Name', this.Status_Name);

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
                                            let res=response.data.application_no+'.</b><br> Use this application number to track your application status. <br><b>Thank You !</b>';
                                            this.$router.push({name:'acknowledgement_public_school',params: {data:message+res }});
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
                                    console.log("Error:"+error);
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
                    this.form.post('organization/saveprivatepublicschoolEstablishment',this.form)
                    .then((response) => {
                        if(response.data!=""){
                            this.file_form.application_number=response.data.data.applicaiton_details.application_no;
                            this.classStreamForm.application_number=response.data.data.applicaiton_details.application_no;
                            this.change_tab(nextclass);
                        }
                    })
                    .catch((error) => {
                        this.applyselect2();
                        this.change_tab('organization-tab');
                        console.log("Error:"+error);

                    })
                }
                else if(nextclass=="file-tab"){
                    // this.classStreamForm.proposedName=this.form.proposedName;
                    this.classStreamForm.post('organization/saveClassStream')
                    .then((response) => {
                        if(response.data!=""){
                            this.change_tab(nextclass);
                        }
                    })
                    .catch((err) => {
                        if(err.response.status === 422){
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Please select applicable class!',
                            })
                        }
                        this.applyselect2();
                        console.log("Error:"+err);

                    })
                }else{
                    this.change_tab(nextclass);
                }
            }
        },

        validateFileform(){
            let returnvariable=true;
            for(let i=0;i<this.file_form.fileUpload.length;i++){
                if($('#file_name'+(i+1)).val()==""){
                    $('#file_name'+(i+1)+'_err').html('Please mention file name');
                    returnvariable=false;
                }
                if($('#attach'+(i+1)).val()==""){
                    $('#attach'+(i+1)+'_err').html('Please mention file');
                    returnvariable=false;
                }
                if($('#attach'+(i+1)).val()!="" && !this.isvalidfile($('#attach'+(i+1)).val())){
                    $('#attach'+(i+1)+'_err').html('This file is not accepted. The accepted files are: ' +this.validfile());
                    returnvariable=false;
                }
            }
            return returnvariable;
        },

        loadpendingdetails(type){
            axios.get('organization/loaddraftApplication/'+type)
              .then(response => {
                let draft = response.data.data;
                if(draft!=null){
                    this.form.app_id        =draft.id;
                this.form.ap_estb_id    =draft.estb_details.id;

                this.form.initiatedBy   =draft.estb_details.initiated_by;
                $('#initiatedBy').val(draft.estb_details.initiated_by).trigger('change');

                this.form.proposedName  =draft.estb_details.proposedName;
                this.form.level=draft.estb_details.levelId;
                $('#level').val(draft.estb_details.levelId).trigger('change');
                this.getClassStream(this.levelArray[draft.estb_details.levelId]);

                this.form.gewog         =draft.gewogId;
                $('#gewog').val(draft.gewogId).trigger('change');

                this.getvillagelist(draft.gewogId,draft.chiwogId);
                this.form.chiwog=draft.chiwogId;
                this.form.proposedLocation  =draft.estb_details.locationId;
                $('#location').val(draft.estb_details.locationId).trigger('change');
                this.form.isfeedingschool=draft.estb_details.isFeedingSchool;
                if(draft.estb_details.isFeedingSchool==1){
                    $('.feedingDetails').show();
                    let meal_details=draft.meal_details;
                    if(meal_details.length>0){
                        for(let i=0;i<meal_details.length;i++){
                            if(meal_details[i].noOfMeals!=undefined){
                                $('#feeding'+meal_details[i].noOfMeals).prop('checked',true);
                            }
                        }
                    }
                }
                this.form.senSchool     =draft.estb_details.isSenSchool;
                this.form.geopoliticallyLocated=draft.estb_details.isGeoPoliticallyLocated;
                }
            });
        },

        applyselect2(){
            this.applyselect2field('gewog');
            this.applyselect2field('chiwog');
            this.applyselect2field('initiatedBy');
            this.applyselect2field('proposedLocation');
            this.applyselect2field('parentSchool');
            this.applyselect2field('level');
        },

        /**
         * method to get other category if the category is 'ECCD'
         */
        getClassStream(){
            axios.get('/masters/loadClassStreamMapping/school_10')
              .then(response => {
                this.classStreamList = response.data.data;
            });
        },

        show_feeding_details(param){
            if(param){
                $('.feedingDetails').show();
            }
            else{
                $('.feedingDetails').hide();
            }
        },

        async getAttachmentType(){
            let data = await this.getRequiredDocument('Application_for_Public_School');
            if(data!=""){
                data.forEach((item => {
                    this.count++;
                    this.file_form.fileUpload.push({file_name:item.name, file_upload:''})
                }));
            }
        },
    },

    async mounted() {
        axios.get('organizationApproval/getScreenId/'+'Public ECR__'+1)
        .then(response => {
            let data = response.data.data;
            if(data!=undefined && data!="NA"){
                $('#publicscreenName').html('<b>Application for Establishment of '+data.screenName);
                this.screenId=data.screen;
                this.SysRoleId=data.SysRoleId;
                this.Sequence=data.Sequence;
                this.Status_Name=data.Status_Name;
                this.file_form.service_name=data.screenName;
            }else{
                $('#screenPermission').show();
                $('#mainform').hide();
                $('#message').html('You dont have priviletes to create new application for this service. Please contact with system administrator. <br> Thank you!');
            }
        })
        .catch(errors => {
            console.log(errors)
        });

        this.proposed_by_list =  await this.loadproposedByList();
        this.getLevel();

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
            Fire.$emit('changefunction',$(this).attr('id'),$(this).find('option:selected').text());
        });

        Fire.$on('changefunction',(id,text)=> {
            this.changefunction(id,text);
        });
        this.getAttachmentType();
        this.locationList =await this.loadlocationList();
        this.orgList= await this.schoolListUnderUserDzongkhag();
        this.loadpendingdetails('Public ECR');
        this.getClassStream();
    },
}
</script>



