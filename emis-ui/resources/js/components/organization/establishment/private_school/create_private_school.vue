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
                            <div class="form-group row bg-gray-light mt-xl-n3">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <span id="privatescreen"></span>
                                </div>
                            </div>
                            <label class="mb-0"><i><u>School Details</u></i></label>
                            <div class="form-group row">
                                <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Proposed Name:<span class="text-danger">*</span></label>
                                <div class="col-lg-4 col-md-46 col-sm-4">
                                    <input type="text" v-model="form.proposedName" :class="{ 'is-invalid': form.errors.has('proposedName') }" @change="remove_error('proposedName')" class="form-control" id="proposedName" placeholder="Proposed Name"/>
                                    <has-error :form="form" field="proposedName"></has-error>
                                </div>
                                <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Level:<span class="text-danger">*</span></label>
                                <div class="col-lg-4 col-md-4 col-sm-46">
                                    <select name="level" id="level" v-model="form.level" :class="{ 'is-invalid': form.errors.has('level') }" class="form-control select2" @change="remove_error('level')">
                                        <option value="">--- Please Select ---</option>
                                        <option v-for="(item, index) in levelList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                    </select>
                                    <has-error :form="form" field="level"></has-error>
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Expected Enrollment:<span class="text-danger">*</span></label>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <input type="number" v-model="form.enrollmentBoys" :class="{ 'is-invalid': form.errors.has('enrollmentBoys') }" @change="remove_error('enrollmentBoys')" class="form-control" id="enrollmentBoys" placeholder="Boys" />
                                    <has-error :form="form" field="enrollmentBoys"></has-error>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <input type="number" v-model="form.enrollmentGirls" :class="{ 'is-invalid': form.errors.has('enrollmentGirls') }" @change="remove_error('enrollmentGirls')" class="form-control" id="enrollmentGirls" placeholder="Girls"/>
                                    <has-error :form="form" field="enrollmentGirls"></has-error>
                                </div>
                            </div> -->
                            <div class="form-group row">
                                <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Gewog:<span class="text-danger">*</span></label>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <select v-model="form.gewog" :class="{ 'is-invalid select2 select2-hidden-accessible':form.errors.has('gewog') }" class="form-control select2" name="gewog" id="gewog">
                                        <option value="">--- Please Select ---</option>
                                        <option v-for="(item, index) in gewog_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                    </select>
                                    <has-error :form="form" field="gewog"></has-error>
                                </div>
                                <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Chiwog:<span class="text-danger">*</span></label>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <select v-model="form.chiwog" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('chiwog') }" class="form-control select2" name="chiwog" id="chiwog">
                                        <option value="">--- Please Select ---</option>
                                        <option v-for="(item, index) in villageList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                    </select>
                                    <has-error :form="form" field="chiwog"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Proposed Location:<span class="text-danger">*</span></label>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <input type="text" v-model="form.proposedLocation" :class="{ 'is-invalid': form.errors.has('proposedLocation') }" @change="remove_error('proposedLocation')" class="form-control" id="proposedLocation" placeholder="Proposed Location"/>
                                    <has-error :form="form" field="proposedLocation"></has-error>
                                </div>
                                <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Type of School:<span class="text-danger">*</span></label>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pt-2">
                                    <label><input  type="radio" v-model="form.typeOfSchool" value="1" tabindex=""/> Day</label>
                                    <label><input  type="radio" v-model="form.typeOfSchool" value="0" tabindex=""/> Boarding</label>
                                </div>
                            </div>
                            <hr>
                            <label class="mb-0"><i><u>Proprietor Details</u></i></label>
                            <div class="form-group row">
                                <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">CID:<span class="text-danger">*</span></label>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <input type="number" max="11" min="11" @keyup.enter="getDetailsbyCID('proprietorCid')" @blur="getDetailsbyCID('proprietorCid')" v-model="form.proprietorCid" :class="{ 'is-invalid': form.errors.has('proprietorCid') }" @change="remove_error('proprietorCid')" class="form-control" id="proprietorCid" placeholder="CID No."/>
                                    <has-error :form="form" field="proprietorCid"></has-error>
                                </div>
                                <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Name:<span class="text-danger">*</span></label>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <input type="text" v-model="form.proprietorName" :class="{ 'is-invalid': form.errors.has('proprietorName') }" @change="remove_error('proprietorName')" class="form-control" id="proprietorName" placeholder="Proprietor Name"/>
                                    <has-error :form="form" field="proprietorName"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 col-form-label">Contact Information:</label>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <input type="number" v-model="form.proprietorMobile" :class="{ 'is-invalid': form.errors.has('proprietorMobile') }" @change="remove_error('proprietorMobile')" class="form-control" id="proprietorMobile" placeholder="Mobile No *"/>
                                    <has-error :form="form" field="proprietorMobile"></has-error>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <input type="number" v-model="form.proprietorPhone" :class="{ 'is-invalid': form.errors.has('proprietorPhone') }" @change="remove_error('proprietorPhone')" class="form-control" id="proprietorPhone" placeholder="Phone No" />
                                    <has-error :form="form" field="proprietorPhone"></has-error>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <input type="text" v-model="form.proprietorEmail" :class="{ 'is-invalid': form.errors.has('proprietorEmail') }" @change="remove_error('proprietorEmail')" class="form-control" id="proprietorEmail" placeholder="Email"/>
                                    <has-error :form="form" field="proprietorEmail"></has-error>
                                </div>
                            </div>





                        <!-- <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Total Area of Land Proposed:<span class="text-danger">*</span></label>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <input type="text" v-model="form.totalLand" :class="{ 'is-invalid': form.errors.has('totalLand') }" @change="remove_error('totalLand')" class="form-control" id="totalLand" />
                                <has-error :form="form" field="totalLand"></has-error>
                            </div>
                        </div> -->
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
                                                    <input type="file" name="attachment" class="form-control" v-on:change="onChangeFileUpload" :id="'attach'+(index+1)">
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
            levelList:[],
            locationList:[],
            gewog_list:[],
            villageList:[],
            levelArray:{},

            classStreamList:[],
            fileUpload: [],
            draft_data:[],

            screenId:'',
            SysRoleId:'',
            Sequence:'',
            Status_Name:'',

            form: new form({
                id: '',
                proprietorCid:'',
                proprietorName:'',
                proprietorPhone:'',
                proprietorMobile:'',
                proprietorEmail:'',

                proposedName:'',
                level:'',
                dzongkhag:'',
                gewog:'',
                chiwog:'0',
                proposedLocation:'',
                typeOfSchool:'',
                // totalLand:'',
                // enrollmentBoys:'',
                // enrollmentGirls:'',

                category:'',
                establishment_type:'',
                status:'pending',
            }),

            file_form: new form({
                id:'',
                file_name: '',
                fileUpload: [],
                record_type:'add',
                application_number:'',
                status:'Submitted',
                application_number:'',
                remarks:'',
                service_name:'New Establishment of Private School',
                attachments:
                [{
                    file_name:'',attachment:''
                }],
                ref_docs:[],
            }),

            classStreamForm: new form({
                id: '',class:[], stream:[], proposed_establishment:'Private School', status:'submitted',application_number:'',
                action_type:'add',submit_type:'',remarks:'',proposedName:'',
            })
        }
    },
    methods: {
        loadScreenDetails(){
            axios.get('organizationApproval/getScreenId/'+'Private School__'+1)
            .then(response => {
                let data = response.data.data;
                if(data!=undefined && data!="NA"){
                    $('#privatescreen').html('<b>'+data.screenName);
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
        },

        /**
         * method to get level in dropdown
         */
        async getLevel(){
            let leveldata=await this.loadLevelList();
            this.levelList =leveldata;
            for(let i=0;i<leveldata.length;i++){
                this.levelArray[data[i].id] = data[i].name;
            }
        },

        /**
         * method to get Gewog in dropdown
         */
        async getGewogList(dzongkhag){
            this.gewog_list =await this.loadgewogList(dzongkhag);
        },
        async getvillagelist(id){
            let gewogId=$('#gewog').val();
            if(id!="" && (gewogId==null || gewogId=="")){
                gewogId=id;
            }
            this.villageList =await this.loadvillageList(gewogId);
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
            if(id=="level"){
                this.form.level=$('#level').val();
                 this.getClassStream(text);
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
         * method to get class stream in checkbox
         */
        getClassStream(text){
            $('.strm_clas').hide();
            let level = text;
            if(level.toLowerCase().includes('middle')){
                level="10";
            }
            else if(level.toLowerCase().includes('lower')){
                level="8";
            }
            else if(level.toLowerCase().includes('primary')){
                level="6";
            }
            else{
                level="12";
                $('.strm_clas').show();
            }
            axios.get('/masters/loadClassStreamMapping/school_'+level)
              .then(response => {
                this.classStreamList = response.data.data;
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
                                            this.$router.push({name:'acknowledgement_private_school',params: {data:message+res }});
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
                    this.form.post('organization/saveEstablishment',this.form)
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
                        console.log("Error:"+error)
                    })
                }
                else if(nextclass=="file-tab"){
                    this.classStreamForm.submit_type=nextclass;
                    this.classStreamForm.post('organization/saveClassStream')
                    .then((response) => {
                        if(response.data!=""){
                            this.change_tab(nextclass);
                        }
                    })
                    .catch((err) => {
                        console.log("Error:"+err)
                    })


                }else{
                    this.change_tab(nextclass);
                }
            }
        },
       loadpendingdetails(type){
            axios.get('organization/loaddraftApplication/'+type)
              .then(response => {
                let draft = response.data.data;
                if(draft!=null){
                    this.form.id        =draft.id;
                    this.form.proprietorCid=draft.estb_details.proprietorCid;
                    this.form.proprietorEmail=draft.estb_details.proprietorEmail;
                    this.form.proprietorMobile=draft.estb_details.proprietorMobile;
                    this.form.proprietorName=draft.estb_details.proprietorName;
                    this.form.proprietorPhone   =draft.estb_details.proprietorPhone;
                    this.form.proposedLocation   =draft.estb_details.proposedLocation;
                    this.form.typeOfSchool   =draft.estb_details.typeOfSchool;
                    this.form.gewogId   =draft.estb_details.gewogId;
                    this.form.chiwogId   =draft.estb_details.chiwogId;
                    this.form.dzongkhagId   =draft.estb_details.dzongkhagId;

                    this.form.proposedName  =draft.estb_details.proposedName;
                    this.form.level=draft.estb_details.levelId;
                    $('#level').val(draft.estb_details.levelId).trigger('change');

                    this.getClassStream(this.levelArray[draft.estb_details.levelId]);

                    this.form.gewog  =draft.gewogId;
                    $('#gewog').val(draft.gewogId).trigger('change');

                    this.getvillagelist(draft.gewogId,draft.chiwogId);
                    this.form.chiwog=draft.chiwogId;
                }
            });
        },
        applyselect2(){
            this.applyselect2field('gewog');
            this.applyselect2field('chiwog');
            this.applyselect2field('level');
        },

        getDetailsbyCID(fieldId){
            axios.get('getpersonbycid/'+ $('#'+fieldId).val())
            .then(response => {
                if (JSON.stringify(response.data)!='{}'){
                    let personal_detail = response.data;
                    this.form.proprietorName = personal_detail.firstName + " " + personal_detail.lastName;
                }else{
                    Swal.fire({
                        html: "No data found for this CID",
                        icon: 'error'
                    });
                }
            })
            .catch((exception) =>{
                console.log(exception);
            });
        },

        getAttachmentType(){
            let data = await this.getRequiredDocument(type);
            if(data!=""){
                data.forEach((item =>{
                    this.count++;
                    this.file_form.fileUpload.push({file_name:item.name, file_upload:''})
                }));
            }
        }
    },
    async mounted() {
        this.loadScreenDetails();
        this.locationList = await this.loadlocationList();
        this.getLevel();
        this.getAttachmentType('Application_for_Private_School');
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
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id'),$(this).find('option:selected').text());
        });

        Fire.$on('changefunction',(id,text)=> {
            this.changefunction(id,text);
        });
       this.loadpendingdetails('Private_School');
    },
}
</script>
