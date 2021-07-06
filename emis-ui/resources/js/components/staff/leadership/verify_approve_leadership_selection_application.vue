<template>
    <div>
        <ol class="mb-1 ml-xl-n3 mr-xl-n2 pl-3" style="background-color:#E5E5E5">
            <li class="pl-2 form-inline "><h6 class="pt-1">Leadership Selection Verification/Approval</h6></li>
        </ol>
        <div id="maindiv">
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-body">
                    <template v-if="post_detail!=''">
                        <div class="callout callout-success">
                            <span><label><u>Post Detials</u></label></span>
                            <div class="row form-group">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Position Title:</label>
                                    <span class="text-blue text-bold">{{positionList[post_detail.position_title]}}</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Application Start Date:</label>
                                    <span class="text-blue text-bold">{{post_detail.from_date}}</span>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Application End Date:</label>
                                    <span class="text-blue text-bold">{{post_detail.to_date}}</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <label>Details:</label>
                                    <span class="text-blue text-bold">{{post_detail.details}}</span>
                                </div>
                            </div>
                        </div>
                    </template>
                    <div class="callout callout-success">
                        <span><label><u>Applicant Detials</u></label></span>
                        <div class="row form-group">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Application Status:</label>
                                <span class="text-blue text-bold">{{form.current_status}}</span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Application Number:</label>
                                <span class="text-blue text-bold">{{form.application_number}}</span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Application Date:</label>
                                <span class="text-blue text-bold">{{form.application_date}}</span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Applicant CID:</label>
                                <span class="text-blue text-bold">{{form.aplicant_cid}}</span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Applicant:</label>
                                <span class="text-blue text-bold">{{form.applicant}}</span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Position Title:</label>
                                <span class="text-blue text-bold">{{form.aplicant_position_title}}</span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Working Agency:</label>
                                <span class="text-blue text-bold">{{form.aplicant_working_agency}}</span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Dzongkhag:</label>
                                <span class="text-blue text-bold">{{form.aplicant_working_dzo}}</span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Gewog:</label>
                                <span class="text-blue text-bold">{{form.aplicant_working_gewog}}</span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                <label>Remarks:</label>
                                <span class="text-blue text-bold">{{form.remarks}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="callout callout-success">
                        <span><label><u>Attachment Detials</u></label></span>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0">Documents<span class="text-danger">*</span></label>
                                <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>File Name</th>
                                            <th>Upload File</th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for='(attach,count) in applicationdetailsatt' :key="count+1">
                                            <template>
                                                <td>{{attach.user_defined_name}} </td>
                                                <td>  {{attach.original_name}}</td>
                                                <td>
                                                    <a href="#" @click="openfile(attach)" class="fa fa-eye"> View</a>
                                                </td>
                                            </template>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="callout callout-info" v-if="form.current_status=='Submitted' && form.feedback==1">
                        <h4><u>Feedback Configuration Details</u></h4>
                        <div class="row form-group">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Feed back Start Date:<span class="text-danger">*</span></label>
                                <input type="date" class="form-control" @change="remove_error('feedback_start_date')" :class="{ 'is-invalid': form.errors.has('feedback_start_date') }"  name="feedback_start_date" id="feedback_start_date" v-model="form.feedback_start_date">
                                <has-error :form="form" field="feedback_start_date"></has-error>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Feed back End Date:<span class="text-danger">*</span></label>
                                <input type="date" @change="remove_error('feedback_end_date')" :class="{ 'is-invalid': form.errors.has('feedback_end_date') }"  class="form-control" name="feedback_end_date" id="feedback_end_date" v-model="form.feedback_end_date">
                                <has-error :form="form" field="feedback_end_date"></has-error>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pt-4 mt-1">
                                <button type="button" class="btn btn-primary btn-flat btn-sm fa-pull-right" @click="showmodel()"><i class="fa fa-plus"></i> Add Feedback Provider</button>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Details:</label>
                                <textarea class="form-control" :class="{ 'is-invalid': form.errors.has('reason') }" v-model="form.feedback_details" id="feedback_details"></textarea>
                                <has-error :form="form" field="feedback_details"></has-error>
                            </div>
                        </div>

                        <div class="modal fade show" id="add_modal" aria-modal="true" style="padding-right: 17px;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add Staff for Feedback</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="bootbox-form">
                                            <div class="form-group row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <label>Staff From:<span class="text-danger">*</span></label>
                                                    <input type="radio" v-model="selectstaff.partifipant_from" @change="showSearch('Ministry')" :class="{ 'is-invalid' :form.errors.has('partifipant_from') }" name="partifipant_from" id="partifipant_from0" :value="'Ministry'">
                                                    <label class="pr-3"> Ministry </label>
                                                    <input type="radio" v-model="selectstaff.partifipant_from" @change="showSearch('Dzongkhag')" :class="{ 'is-invalid' :form.errors.has('partifipant_from') }" name="partifipant_from" id="partifipant_from1" :value="'Dzongkhag'">
                                                    <label class="pr-3"> Dzongkhag Head Quarters </label>
                                                    <input type="radio" v-model="selectstaff.partifipant_from" @change="showSearch('School')" :class="{ 'is-invalid' :form.errors.has('partifipant_from') }" name="partifipant_from" id="partifipant_from2" :value="'School'">
                                                    <label class="pr-3"> Schools </label>
                                                    <input type="radio" v-model="selectstaff.partifipant_from" @change="showSearch('outofministry')" :class="{ 'is-invalid' :form.errors.has('partifipant_from') }" name="partifipant_from" id="partifipant_from3" :value="'outofministry'">
                                                    <label class="pr-3"> Out of Ministry (External)</label>
                                                    <span class="text-danger" id="partifipant_from_err"></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" v-if="selectstaff.dzongkhag_section">
                                                    <label>Dzongkhag:<span class="text-danger">*</span></label>
                                                    <select class="form-control select2" v-model="selectstaff.dzongkhag" @change="remove_error('dzongkhag')" name="dzongkhag" id="dzongkhag">
                                                        <option value="">- Please Select -</option>
                                                        <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                                    </select>
                                                    <span class="text-danger" id="dzongkhag_err"></span>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" v-if="selectstaff.school_section">
                                                    <label>School:<span class="text-danger">*</span></label>
                                                    <select class="form-control select2" v-model="selectstaff.school" @change="remove_error('school')" name="school" id="school">
                                                        <option value="">- Please Select -</option>
                                                        <option v-for="(item, index) in school_list" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                                    </select>
                                                    <span class="text-danger" id="school_err"></span>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" v-if="selectstaff.department_section">
                                                    <label>Department/Division:<span class="text-danger">*</span></label>
                                                    <select class="form-control select2" v-model="selectstaff.department" @change="remove_error('school')" name="department" id="department">
                                                        <option value="">- Please Select -</option>
                                                        <option v-for="(item, index) in department_list" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                                    </select>
                                                    <span class="text-danger" id="department_err"></span>
                                                </div>
                                            </div>
                                            <div class="form-group row" v-if="selectstaff.select_staff_section">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <label>Nominee:<span class="text-danger">*</span></label>
                                                    <select class="form-control select2" @change="remove_error('participant'),getdetails()" name="participant" id="participant" v-model="selectstaff.participant">
                                                        <option value="">- Please Select -</option>
                                                        <option v-for="(item, index) in staff_list" :key="index" v-bind:value="item.id+'_'+item.contact_no+'_'+item.email"> {{ item.cid_work_permit }}, {{ item.name }},{{ item.position_title.name }}</option>
                                                    </select>
                                                    <span class="text-danger" id="participant_err"></span>
                                                </div>
                                            </div>
                                            <div class="form-group row" v-if="selectstaff.outofministry_section">
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label>CID:<span class="text-danger">*</span></label>
                                                    <input type="text" v-model="selectstaff.cid" :class="{ 'is-invalid': selectstaff.errors.has('cid') }" name="cid" id="cid" class="form-control">
                                                    <has-error :form="selectstaff" field="cid"></has-error>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label>Name:<span class="text-danger">*</span></label>
                                                    <input type="text" v-model="selectstaff.name" :class="{ 'is-invalid': selectstaff.errors.has('name') }" name="name" id="name" class="form-control">
                                                    <has-error :form="selectstaff" field="name"></has-error>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <label>Feedback Type:<span class="text-danger">*</span></label>
                                                    <select class="form-control select2" @change="remove_error('feedback_type_err')" name="feedback_type" id="feedback_type" v-model="selectstaff.feedback_type">
                                                        <option value="">- Please Select -</option>
                                                        <option v-for="(item, index) in feedbackCategory" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                                    </select>
                                                    <span class="text-danger" id="feedback_type_err"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Contact Number:<span class="text-danger">*</span></label>
                                                    <input type="text" @change="remove_error('contact')" v-model="selectstaff.contact" class="form-control" id="contact">
                                                    <span class="text-danger" id="contact_err"></span>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Email:<span class="text-danger">*</span></label>
                                                    <input type="text" @change="remove_error('email')" v-model="selectstaff.email" class="form-control" id="email">
                                                    <span class="text-danger" id="email_err"></span>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer text-right">
                                        <button data-bb-handler="cancel" type="button" data-dismiss="modal" class="btn btn-danger">Cancel</button>
                                        <button data-bb-handler="confirm" @click="addrecords()" type="button" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h4><u>Attachments</u></h4>
                        <div class="form-group row">
                            <div class="card-body col-lg-12 col-md-12 col-sm-12 col-xs-8">
                                <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>File Name</th>
                                            <th>Upload File</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="record1" v-for='(att, index) in form.attachments' :key="index">
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

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label class="mb-0">Remarks</label>
                            <textarea class="form-control" @change="remove_error('remarks')" v-model="form.verification_remarks" id="remarks"></textarea>
                            <span class="text-danger" id="remarks_err"></span>
                        </div>
                    </div>
                    <hr>
                    <div class="row form-group fa-pull-right">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-info text-white" @click="shownexttab('verify')" v-if="form.current_status=='Submitted' && form.feedback==1"> <i class="fa fa-save"></i> Send Notification </button>
                            <button class="btn btn-primary" @click="shownexttab('approve')" style="display:none" id="approveId"> <i class="fa fa-check"></i> Approve </button>
                            <button class="btn btn-danger" id="rejectbtn" @click="shownexttab('reject')"> <i class="fa fa-times"></i> Reject </button>
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
        return {
            count:0,
            positionList:{},
            roleList:{},
            post_detail:'',
            staff_list:[],
            department_list:[],
            school_list:[],
            dzongkhagList:[],
            feedbackCategory:[],
            applicationdetailsatt:'',
            selectstaff: new form({
                nominees:[],
                partifipant_from:'',
                dzongkhag_section:false,
                school_section:false,
                department_section:false,
                select_staff_section:false,
                outofministry_section:false,
                email:'',
                contact:'',
                participant:'',
                cid:'',
                name:'',
                department:'',
                school:'',
                dzongkhag:'',
                feedback_type:'',

            }),
            form: new form({
                id:'',
                application_number:'',
                application_date:'',
                selection_type:'',
                position_title:'',
                from_date:'',
                to_date:'',
                feedback:'',
                interview:'',
                shortlist:'',
                details:'',
                document:'',
                applicant:'',
                aplicant_cid:'',
                aplicant_position_title:'',
                aplicant_working_agency:'',
                aplicant_working_dzo:'',
                aplicant_working_gewog:'',
                verification_remarks:'',
                feedback_start_date:'',
                feedback_end_date:'',
                feedback_details:'',
                status_id:'',
                current_status:'',
                attachments:
                [{
                    file_name:'',attachment:''
                }],
                ref_docs:[],
            }),
        }
    },
    methods: {
        openfile(file){
            let file_path=file.path+'/'+file.original_name;
            file_path=file_path.replaceAll('/', 'SSS');
            let uri = 'common/viewFiles/'+file_path;
            window.location=uri;
        },
        addMore: function(){
            this.count++;
            this.form.attachments.push({file_name:'', attachment:''})
        },

        remove(index){
             if(this.form.attachments.length>1){
                this.count--;
                this.form.attachments.splice(index,1);
            }
        },

        onChangeFileUpload(e){
            let currentcount=e.target.id.match(/\d+/g)[0];
            if($('#fileName'+currentcount).val()!=""){
                this.form.ref_docs.push({name:$('#file_name'+currentcount).val(), attach: e.target.files[0]});
                $('#fileName'+currentcount).prop('readonly',true);
            }
            else{
                $('#fileName'+currentcount+'_err').html('Please mention file name');
                $('#'+e.target.id).val('');
            }
        },
        showmodel(){
            $('#add_modal').modal('show');
        },
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },
        showSearch(type){
            this.selectstaff.dzongkhag_section=false;
            this.selectstaff.school_section=false;
            this.selectstaff.department_section=false;
            this.selectstaff.select_staff_section=false;
            this.selectstaff.outofministry_section=false;
            if(type=="School"){
                this.selectstaff.dzongkhag_section=true;
                this.selectstaff.school_section=true;
            }
            if(type=="Dzongkhag"){
                this.getDzongkhagHeadQuarterList('all_dzongkhag_headquarters');
                this.selectstaff.dzongkhag_section=true;
            }
            if(type=="Ministry"){
                this.getDzongkhagHeadQuarterList('all_ministry_headquarters');
                this.selectstaff.department_section=true;
            }
            if(type=="outofministry"){
                this.selectstaff.outofministry_section=true;
            }
            else{
                this.selectstaff.select_staff_section=true;
            }
        },
        getDzongkhagHeadQuarterList(type){
            axios.get('loadCommons/loadHeaquarterList/'+type+'/NA')
            .then((response) => {
                let data=response.data.data;
                this.department_list=data;
            })
            .catch((error) =>{
                console.log("Error in retrieving headquarters:"+error);
            });
        },
        loadactivedzongkhagList(uri="masters/loadGlobalMasters/all_active_dzongkhag"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dzongkhagList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error:"+error)
            });
        },
        getSchoolList(dzoId){
            axios.get('loadCommons/loadOrgList/dzongkhagwise/'+dzoId)
            .then((response) => {
                let data=response.data.data;
                this.school_list=data;
            })
            .catch((error) =>{
                console.log("Error in retrieving school List:"+error);
            });
        },
        loadStaffList(id,type){
            let uri="";
            if(id=="NA"){
                uri='loadCommons/loadStaffList/userworkingagency/NA';
            }
            else{
                uri='loadCommons/loadStaffList/'+type+'/'+id;
            }
            axios.get(uri)
            .then((response) => {
                let data=response.data.data;
                this.staff_list=data;
            })
            .catch((error) => {
                console.log("Error:"+error);
            });
        },
        loadPositionTitleList(uri = 'masters/loadStaffMasters/all_active_position_title'){
            axios.get(uri)
            .then(response =>{
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.positionList[data[i].id] = data[i].name;
                }
            })
            .catch(function (error){
                console.log(error);
            });
        },

        loadroleList(uri = 'masters/getroles/allActiveRoles'){
            axios.get(uri)
            .then(response =>{
                let data = response.data;
                for(let i=0;i<data.length;i++){
                    this.roleList[data[i].Id] = data[i].Name;
                }
            })
            .catch(function (error){
                console.log(error);
            });
        },

        loadApplicationDetils(appNo,type){
            axios.get('/staff/staffLeadershipSerivcesController/loadapplicaitontDetialsforVerification/'+appNo+'/'+type)
            .then((response) =>{
                let data=response.data.data;

                this.post_detail=data.Post_details;
                this.form.id=data.id;
                this.form.remarks=data.remarks;
                this.form.applicant=data.aplicant_name;
                this.form.aplicant_cid=data.aplicant_cid;
                this.form.aplicant_position_title=data.aplicant_position_title;
                this.form.aplicant_working_agency=data.aplicant_working_agency;
                this.form.aplicant_working_dzo=data.aplicant_working_dzo;
                this.form.aplicant_working_gewog=data.aplicant_working_gewog;
                this.form.application_number=data.application_number;
                this.form.application_date=data.created_at;
                this.form.post_id=data.post_id;
                this.form.current_status=data.status;
                this.form.feedback=data.Post_details.feedback;
                this.form.interview=data.Post_details.interview;
                this.form.shortlist=data.Post_details.shortlist;

                this.applicationdetailsatt=data.attachments;

                if(data.app_seq_no!=10 && data.app_seq_no!=0){
                    $('#verifyId').show();
                }
                if(data.app_seq_no==10 ){
                    $('#approveId').show();
                }
                this.form.status_id   =   data.app_seq_no;
            })
            .catch((error) =>{
                console.log("Error: "+error);
            });
        },
        changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="dzongkhag"){
                this.selectstaff.dzongkhag=$('#dzongkhag').val();
                this.getSchoolList($('#dzongkhag').val());
            }
            if(id=="department"){
                this.selectstaff.department=$('#department').val();
                this.loadStaffList($('#department').val(),'dzo_hq_departmentwise');
            }
            if(id=="school"){
                this.selectstaff.school=$('#school').val();
                this.loadStaffList($('#school').val(),'orgwise');
            }
        },
        loadcategoryList(uri = 'staff/staffLeadershipSerivcesController/loadData/activeData_FeedbackCategory'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.feedbackCategory =  data.data.data;
            })
            .catch(function (error){
                console.log(error);
            });
        },
    },
    created(){
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
    },
    mounted(){
        this.loadcategoryList();
        this.loadroleList();
        this.loadPositionTitleList();
        this.loadactivedzongkhagList();
        this.form.application_number=this.$route.params.data.application_number;
        this.loadApplicationDetils(this.$route.params.data.application_number,this.$route.params.type);
    },

}
</script>
