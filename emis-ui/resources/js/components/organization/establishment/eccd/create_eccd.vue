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
                            <label class="mb-0.5">Age Group</label>
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
                                <span id="screenName"></span>
                            </div>
                        </div>

                        <label class="mb-0"><i><u>Establishment Details</u></i></label>
                        <div class="form-group row">
                            <label id="proposed_initiated_by_id" class="col-lg-2 col-md-2 col-sm-2 col-xs-12 col-form-label">Proposal Initiated By:<span class="text-danger">*</span></label>
                            <div id="proposed_initiated_by_id1" class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <select name="initiatedBy" id="initiatedBy" v-model="form.initiatedBy" :class="{ 'is-invalid': form.errors.has('initiatedBy') }" class="form-control select2" @change="remove_error('initiatedBy')">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in proposed_by_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="initiatedBy"></has-error>
                            </div>

                            <label id="parent_agency_id" class="col-lg-2 col-md-2 col-sm-2 col-form-label">Parent Agency:<span class="text-danger">*</span></label>
                            <div id="parent_agency_id1" class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <input type="text" v-model="form.parentAgency" :class="{ 'is-invalid': form.errors.has('parentAgency') }" @change="remove_error('parentAgency')" class="form-control" id="parentAgency" placeholder="Parent Agency Name"/>
                                <has-error :form="form" field="parentAgency"></has-error>
                            </div>

                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Proposed Name:<span class="text-danger">*</span></label>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <input type="text" v-model="form.proposedName" :class="{ 'is-invalid': form.errors.has('proposedName') }" @change="remove_error('proposedName')" class="form-control" id="proposedName" placeholder="Proposed Name" />
                                <has-error :form="form" field="proposedName"></has-error>
                            </div>
                        </div>
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
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Location Type:<span class="text-danger">*</span></label>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <select name="locationCategory" v-model="form.locationType" :class="{ 'is-invalid': form.errors.has('locationType') }" id="locationType" class="form-control select2" @change="remove_error('locationType')">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in locationList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="locationType"></has-error>
                            </div>
                        </div>
                        <span id="private_section" style="display: none">
                            <hr>
                            <label class="mb-0"><i><u>Proprietor Details</u></i></label>
                            <p>
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
                            <hr>
                        </span>
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
                                <label class="mb-0">Select Age Group:<span class="text-danger">*</span></label>
                            </div>
                        </div><br>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                            <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Age Group</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, key, index) in  classStreamList" :key="index">
                                        <td>
                                            <label class="pr-4"> &nbsp;{{ item.class }} </label>
                                        </td>
                                        <td >
                                            <input type="checkbox" name="class" v-model="classForm.class" :value="item.id">
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
                                                    <input type="file" name="attachments" class="form-control" v-on:change="onChangeFileUpload" :id="'attach'+(index+1)">
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
            locationList:[],
            dzongkhagList:[],
            gewog_list:[],
            villageList:[],
            orgList:[],
            classStreamList:[],
            fileUpload: [],
            proposed_by_list:[],

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
                initiatedBy:'',
                category:'',
                dzongkhag:'',
                gewog:'',
                chiwog:'0',
                locationType:'',
                coLocatedParent:'1',
                parentSchool:'',
                establishment_type:'',
                status:'pending'
            }),
            classForm: new form({
                id: '',
                class:[],
                proposedName:'',
                application_number:'',
            }),

            file_form: new form({
                id:'',
                file_name: '',
                fileUpload: [],
                record_type:'add',
                application_number:'',
                status:'Submitted',
                remarks:'',
                service_name:'',
                attachments:
                [{
                    file_name:'',attachment:''
                }],
                ref_docs:[],
            }),
        }
    },
    methods: {
        /**
         * method to get Gewog in dropdown
         */
        async getGewogList(dzongkhag){
            this.gewog_list =await this.loadgewogList(dzongkhag);
        },

        /**
         * method to get gewog list
         */
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

        /**
         * method to remove fields
         */
        remove(index){
             if(this.file_form.roles.length>1){
                this.count--;
                this.file_form.roles.splice(index,1);
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
                                formData.append('screenId', this.screenId);
                                formData.append('SysRoleId', this.SysRoleId);
                                formData.append('Sequence', this.Sequence);
                                formData.append('Status_Name', this.Status_Name);

                                formData.append('submit_type', nextclass);
                                axios.post('organizationApproval/saveUploadedFiles', formData, config)
                                .then((response) => {
                                    if(response.data!=""){
                                        if(response.data=="No Screen"){
                                            Toast.fire({
                                                icon: 'error',
                                                title: 'Technical Errors: please contact system administrator for further details'
                                            });
                                        }
                                        if(response!="" && response!="No Screen"){
                                            let res=response.data.application_no+'.</b><br> Use this application number to track your application status. <br><b>Thank You !</b>';
                                            this.$router.push({name:'acknowledgement_eccd',params: {data:message+res}});
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
                if(nextclass=="file-tab"){
                    let clasArray=[];
                    $("input[name='class']:checked").each( function () {
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
                        this.classForm.post('organizationApproval/saveClassStream')
                        .then((response) => {
                            if(response!=""){
                                 this.change_tab(nextclass);
                            }
                        })
                        .catch((err) => {
                            console.log("Error:"+err)
                        })
                    }
                }
                else if(nextclass=="class-tab"){
                    this.form.post('organizationApproval/saveEstablishment',this.form)
                    .then((response) => {
                        if(response.data!=""){
                            this.file_form.application_number=response.data.application_no;
                            this.classForm.application_number=response.data.application_no;
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
            this.applyselect2field('gewog');
            this.applyselect2field('chiwog');
            this.applyselect2field('locationType');
            this.applyselect2field('parentSchool');
            this.applyselect2field('initiatedBy');
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
            if(id=="parentSchool"){
                this.form.parentSchool=$('#parentSchool').val();
            }
            if(id=="initiatedBy"){
                this.form.initiatedBy=$('#initiatedBy').val();
            }
        },
        getDetailsbyCID(fieldId){
            axios.get('getpersonbycid/'+ $('#'+fieldId).val())
            .then(response => {
                if (JSON.stringify(response.data)!='{}'){
                    let personal_detail = response.data;
                    this.form.proprietorName = personal_detail.firstName + " " + personal_detail.lastName;
                    $('#proprietorName').prop('readonly',true);
                }else{
                    Swal.fire({
                        html: "No data found for this CID",
                        icon: 'error'
                    });
                }
            })
            .catch((exception) => {
                console.log(exception);
            });
        },
        async loadattachments(type){
            let data = await this.getRequiredDocument(type);
            if(data!=""){
                data.forEach((item => {
                    this.count++;
                    this.file_form.fileUpload.push({file_name:item.name, file_upload:''})
                }));
            }
        },
        loadScreenDetails(type){
            $('#private_section').hide();
            $('#proposed_initiated_by_id').hide();
            $('#proposed_initiated_by_id1').hide();
            $('#parent_agency_id').hide();
            $('#parent_agency_id1').hide();
            this.form.establishment_type=type+' ECCD';
            this.form.category=type;
            axios.get('organizationApproval/getScreenId/'+'ECCD Centre__'+1)
            .then(response => {
                let data = response.data[0];
                if(data!=undefined){
                    $('#screenName').html('<b>Creating Application for '+data.screenName+' ('+this.form.category+')</b>');
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
                if(type=="Private"){
                    $('#private_section').show();
                }
                if(type=="NGO" || type=="Public"){
                    $('#proposed_initiated_by_id').show();
                    $('#proposed_initiated_by_id1').show();
                }
                if(type=="Coorporate"){
                    $('#parent_agency_id').show();
                    $('#parent_agency_id1').show();
                }
            })
            .catch(errors => {
                console.log(errors)
            });
        }
    },

    async mounted() {
        this.proposed_by_list =  await this.loadproposedByList();
        this.locationList =await this.loadlocationList();
        this.orgList= await this.schoolListUnderUserDzongkhag();
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
        this.classStreamList =await this.getClassStreamMappings('eccd');
        this.form.category=this.$route.query.type;
        this.loadScreenDetails(this.$route.query.type);
    },

    watch: {
        '$route.query.type': {
            handler: function(type) {
                this.form.category=type;
                this.form.establishment_type=type+' ECCD';
                this.loadattachments('Public_ECCD');
                this.loadScreenDetails(type);
            },
        }
    },
}
</script>
