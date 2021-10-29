<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs border-primary" id="tabhead">
                    <li class="nav-item organization-tab border-right" @click="shownexttab('organization-tab')">
                        <a class="nav-link active" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Organization Details </label>
                        </a>
                    </li>
                    <li class="nav-item class-tab border-right" @click="shownexttab('class-tab')">
                        <a class="nav-link" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Age Group</label>
                        </a>
                    </li>
                    <li class="nav-item attachment-tab border-right" @click="shownexttab('attachment-tab')">
                        <a class="nav-link" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Attachments</label>
                        </a>
                    </li>
                    <li class="nav-item verification-tab border-right" @click="shownexttab('verification-tab')">
                        <a class="nav-link" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Verification</label>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body pt-0 mt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="organization-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="callout callout-success">
                            <h4><u>Application Details</u></h4>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Application Number:</label>
                                    <span class="text-blue text-bold">{{applicationdetails.application_no}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Submitted Date:</label>
                                    <span class="text-blue text-bold">{{reverseDateTime(applicationdetails.application_date)}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Service Name:</label>
                                    <span class="text-blue text-bold">{{taskDet.service_name}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Current Status:</label>
                                    <span class="text-blue text-bold">{{taskDet.w_config_status}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-if="applicationdetails.applicant_remarks!=null">
                                    <label class="mb-0">Remarks:</label>
                                    <span class="text-blue text-bold">{{applicationdetails.applicant_remarks}}</span>
                                </div>
                            </div>
                        </div>

                        <div class="callout callout-success">
                            <h5><u>Organization Details</u></h5>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-if="applicationdetails.proposed_initiated!=null">
                                    <label class="mb-0">Proposal Initiated By:</label>
                                    <span class="text-blue text-bold">{{applicationdetails.proposed_initiated}}</span>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <label class="mb-0">Proposed Name:</label>
                                    <span class="text-blue text-bold">{{applicationOrgdetails.proposedName}}</span>
                                </div>
                            </div>
                            <div class="form-group row" v-if="applicationOrgdetails.parentAgency!=null && applicationOrgdetails.parentAgency!=''">
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <label class="mb-0">Parent Agency:</label>
                                    <span class="text-blue text-bold">{{applicationOrgdetails.parentAgency}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Dzongkhag:</label>
                                    <span class="text-blue text-bold">{{applicationdetails.dzongkhag}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Gewog:</label>
                                    <span class="text-blue text-bold">{{applicationdetails.gewog}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Chiwog:</label>
                                    <span class="text-blue text-bold">{{applicationdetails.village}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-if="applicationdetails.location_type!=null">
                                    <label class="mb-0">Location Type: </label>
                                    <span class="text-blue text-bold">{{applicationdetails.location_type}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-if="applicationdetails.geopolicaticallyLocated!=null">
                                    <label class="mb-0">Geopolitically Located:</label>
                                    <span class="text-blue text-bold">
                                        {{ applicationdetails.geopolicaticallyLocated  == 1 ? "Yes" :  "No"}}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Is Co-located with Parent School:</label>
                                    <span class="text-blue text-bold">{{ applicationOrgdetails.coLocatedParent  == 1 ? "Yes" :  "No"}}</span>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" v-if="applicationdetails.parent_school!=''">
                                    <label class="mb-0">Parent School:</label>
                                    <span class="text-blue text-bold">
                                        {{ applicationdetails.parent_school}}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="callout callout-success" v-if="applicationdetails.category=='Private'">
                            <h5><u>Proprietor Details</u></h5>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Name:</label>
                                    <span class="text-blue text-bold">{{applicationOrgdetails.proprietorName}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">CID:</label>
                                    <span class="text-blue text-bold">{{applicationOrgdetails.proprietorCid}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Mobile No:</label>
                                    <span class="text-blue text-bold">{{applicationOrgdetails.proprietorMobile}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Phone No:</label>
                                    <span class="text-blue text-bold">{{applicationOrgdetails.proprietorPhone}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Email:</label>
                                    <span class="text-blue text-bold">{{applicationOrgdetails.proprietorEmail}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="callout callout-info">
                            <Workflow
                                :appNo="form.applicationNo"
                            />
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 fa-pull-right">
                                <button class="btn btn-primary" @click="shownexttab('class-tab')">Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade tab-content-details" id="class-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="callout callout-success">
                            <h4><u>Age Group</u></h4>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                                <table id="class-table" class="table table-sm table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Age Group</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, key, index) in  class_section" :key="index">
                                            <td>
                                                <label class="pr-4"> &nbsp;{{ item.class }} </label>
                                            </td>
                                            <td class="notstrm_clas">
                                                <span class="fa fa-check"></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 fa-pull-right">
                                <button class="btn btn-success" @click="shownexttab('organization-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-primary" @click="shownexttab('attachment-tab')">Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade tab-content-details" id="attachment-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="callout callout-success">
                            <h5><u>1. Applicant's Attachments</u></h5>
                            <table id="participant-table" class="table w-100 table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Attachment Name</th>
                                        <th>Attachment</th>
                                        <th>File</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for='(attach,count) in applicationdetails.attachments' :key="count+1">
                                        <template v-if="attach.upload_type == null || attach.upload_type=='Applicant'">
                                            <td> {{attach.user_defined_file_name}} </td>
                                            <td>  {{attach.name}}</td>
                                            <td>
                                                <a href="#" @click="openfile(attach)" class="fa fa-eye"> View</a>
                                            </td>
                                        </template>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <span id="verificationattachment1" style="display:none">
                            <div class="callout callout-success">
                                <h5><u>2. Attachments (<span id="attachment_name1"></span>)</u></h5>
                                <table  class="table w-100 table-bordered table-striped">
                                    <tbody>
                                        <tr v-for='(attach,count) in applicationdetails.attachments' :key="count+1">
                                            <template v-if="attach.upload_type=='Notify_for_Tentative_Date_of_Feasibility_Study'">
                                                <td>  {{attach.user_defined_file_name}}</td>
                                                <td>  {{attach.name}}</td>
                                                <td>
                                                    <a href="#" @click="openfile(attach)" class="fa fa-eye"> View</a>
                                                </td>
                                            </template>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </span>

                        <span v-if="feasibilityReport">
                            <div class="callout callout-success">
                                <!-- <span id="verificationattachment2" style="display:none"> -->
                                <h5><u>3. Attachments (Feasibility Report)</u></h5>
                                <table  class="table w-100 table-bordered table-striped">
                                    <tbody>
                                        <tr v-for='(attach,count) in applicationdetails.attachments' :key="count+1">
                                            <template v-if="attach.upload_type=='update_document' || attach.upload_type=='Update_Feasibility_Study_Report'">
                                                <td>  {{attach.user_defined_file_name}}</td>
                                                <td>  {{attach.name}}</td>
                                                <td>
                                                    <a href="#" @click="openfile(attach)" class="fa fa-eye"> View</a>
                                                </td>
                                            </template>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </span>

                        <span id="verificationattachment3" style="display:none">
                            <div class="callout callout-success">
                                <h5><u>4. Attachments (<span id="attachment_name3"></span>)</u></h5>
                                <table id="participant-table" class="table w-100 table-bordered table-striped">
                                    <tbody>
                                        <tr v-for='(attach,count) in applicationdetails.attachments' :key="count+1">
                                            <template v-if="attach.upload_type=='Notify_for_Approval_in_Principle'">
                                                <td>  {{attach.user_defined_file_name}}</td>
                                                <td>  {{attach.name}}</td>
                                                <td>
                                                    <a href="#" @click="openfile(attach)" class="fa fa-eye"> View</a>
                                                </td>
                                            </template>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </span>

                        <span id="verificationattachment4" style="display:none">
                            <div class="callout callout-success">
                                <h5><u>5. Attachments (<span id="attachment_name4"></span>)</u></h5>
                                <table id="participant-table" class="table w-100 table-bordered table-striped">
                                    <tbody>
                                        <tr v-for='(attach,count) in applicationdetails.attachments' :key="count+1">
                                            <template v-if="attach.upload_type=='Request_for_Final_Assessment'">
                                                <td>  {{attach.user_defined_file_name}}</td>
                                                <td>  {{attach.name}}</td>
                                                <td>
                                                    <a href="#" @click="openfile(attach)" class="fa fa-eye"> View</a>
                                                </td>
                                            </template>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </span>
                        <span id="verificationattachment5" style="display:none">
                            <div class="callout callout-success">
                                <h5><u>6. Attachments (<span id="attachment_name5"></span>)</u></h5>
                                <table id="participant-table" class="table w-100 table-bordered table-striped">
                                    <tbody>
                                        <tr v-for='(attach,count) in applicationdetails.attachments' :key="count+1">
                                            <template v-if="attach.upload_type=='Notify_for_Tentative_Date_of_Final_Assessment'">
                                                <td>  {{attach.user_defined_file_name}}</td>
                                                <td>  {{attach.name}}</td>
                                                <td>
                                                    <a href="#" @click="openfile(attach)" class="fa fa-eye"> View</a>
                                                </td>
                                            </template>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </span>

                        <span v-if="final_feasibilityReport">
                            <div class="callout callout-success">
                                <h5><u>7. Attachments (Final Feasibility Report)</u></h5>
                                <table  class="table w-100 table-bordered table-striped">
                                    <tbody>
                                        <tr v-for='(attach,count) in applicationdetails.attachments' :key="count+1">
                                            <template v-if="attach.upload_type=='final_update_document' || attach.upload_type=='Update_Final_Assessment_Report'">
                                                <td>  {{attach.user_defined_file_name}}</td>
                                                <td>  {{attach.name}}</td>
                                                <td>
                                                    <a href="#" @click="openfile(attach)" class="fa fa-eye"> View</a>
                                                </td>
                                            </template>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </span>

                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 fa-pull-right">
                                <button class="btn btn-success" @click="shownexttab('class-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-primary" @click="shownexttab('verification-tab')">Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade tab-content-details" id="verification-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="callout callout-success" >
                            <h4><u>Site Visit & Verification Details</u></h4>
                            <div class="row form-group">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Tentative Date for Feasibility Study:</label>
                                    <input type="text" name="tentative_date_show" id="tentative_date_show" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width:10%">Sl#</th>
                                                <th style="width:45%">Department</th>
                                                <th style="width:45%">Division</th>
                                            </tr>
                                        </thead>
                                        <tbody id="getverifyingagency">
                                            <tr v-for='(veri, index) in form.verifying_agency_verified_list' :key="index">
                                                <td>{{index+1}}</td>
                                                <td>
                                                    {{veri.department}}
                                                </td>
                                                <td>
                                                    {{veri.division}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                   <span id="tentative_remarks"></span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div id="verifier_team">
                                <div class="row form-group">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Date for Feasibility Study:</label>
                                        <input type="text" name="feasibilityStudy_date_show" id="feasibilityStudy_date_show" class="form-control">
                                    </div>
                                </div>
                                <h5><u>Team Verification</u></h5>
                                <div class="row form-group">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pt-2">
                                        <table id="nomination-list-table" class="table table-sm table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>CID/Passport</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                </tr>
                                            </thead>
                                            <tbody v-for='(user, index) in searchProviderList' :key="index">
                                                <tr v-if="user.type!='final_verifier_team'">
                                                    <td> {{user.cid}}</td>
                                                    <td> {{user.name}}</td>
                                                    <td> {{user.email}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="callout callout-success" id="finalverificationdetials">
                            <h4><u>Final Site Visit & Verification Details</u></h4>
                            <div class="row form-group">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Tentative Date for Final Feasibility Study:</label>
                                    <input type="text" name="final_tentative_date_show" id="final_tentative_date_show" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width:10%">Sl#</th>
                                                <th style="width:45%">Department</th>
                                                <th style="width:45%">Division</th>
                                            </tr>
                                        </thead>
                                        <tbody id="getfinalverifyingagency">
                                            <tr v-for='(veri, index) in form.updated_final_verifying_agency_list' :key="index">
                                                <td>{{index+1}}</td>
                                                <td>
                                                    {{veri.department}}
                                                </td>
                                                <td>
                                                    {{veri.division}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                   <span id="final_tentative_remarks"></span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div id="final_verifier_team">
                                <div class="row form-group">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Date for final Assessment:</label>
                                        <input type="text" name="final_assessment_date_show" id="final_assessment_date_show" class="form-control">
                                    </div>
                                </div>
                                <h5><u>Final Team Verification</u></h5>
                                <div class="row form-group">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pt-2">
                                        <table id="nomination-list-table" class="table table-sm table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>CID/Passport</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                </tr>
                                            </thead>
                                            <tbody v-for='(user, index) in searchProviderList' :key="index">
                                                <tr v-if="user.type=='final_verifier_team'">
                                                    <td> {{user.cid}}</td>
                                                    <td> {{user.name}}</td>
                                                    <td> {{user.email}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('attachment-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
import Workflow from "../../../common/view_workflow_details";
export default {
    components: {
        Workflow,
    },
    data(){
        return{
            count:1,
            showsearch:false,
            feasibilityReport:false,
            final_feasibilityReport:false,
            final_showsearch:false,
            access_level:'',
            proprietorList:[],
            class_section:[],
            sectionList:[],
            applicationdetails:[],
            searchProviderList:[],
            taskDet:[],
            departmentList:[],
            staffList:[],

            screenId:'',
            SysRoleId:'',
            Sequence:'',
            Status_Name:'',

            applicationOrgdetails:{locationTypeId:'', level:'', proposedName:'', initiated_by:''},
            classStreamForm: new form({
                id: '',class:[], stream:[], status:'submitted'
            }),
            form: new form({
                id: '',
                applicationNo:'',
                actiontype:'',
                remarks:'',
                verifying_agency_verified_list:[],
                verifying_agency_list:[{department:'',division:''}],
                verifying_agency:[],
                final_verifying_agency_list:[{department:'',division:''}],
                updated_final_verifying_agency_list:[],
                tentative_date:'',
                final_tentative_date:'',
                feasibilityStudy_date:'',
                final_assessment_date:'',
                update_type:'',
                servicename:'',
                nomi_staffList:[],
                fileUpload: [],
                attachments:
                [{
                    file_name:'',attachment:''
                }],
                ref_docs:[],
            }),
            search: new form({
                id:'',
            }),

        }
    },
    methods:{
        applyselect2(){
        },
        getteamVerificationList(){
            axios.get('organizationApproval/loadTeamVerificationList/'+this.search.id)
            .then(response => {
                let data = response.data.data;
                this.searchProviderList=data;
                if(data!=null && data!="" && data.length>0){
                    data.forEach(element => {
                        $('#verifier_team').show();
                        if(element.type=="final_verifier_team"){
                            $('#final_verifier_team').show();
                        }
                    });
                }
            })
            .catch(errors => {
                console.log(errors)
            });
        },
        loadestablishmentapplicationdetails(appId,type){
            axios.get('organizationApproval/loadEstbDetailsForVerification/'+appId+'/'+type)
            .then((response) => {
                let data=response.data.data;
                this.form.applicationNo=data.application_no;
                this.form.servicename=data.establishment_type;
                this.form.id=data.id;
                this.search.id=data.id;
                this.applicationdetails=data;
                data.attachments.forEach(element => {
                    if(element.upload_type=="update_document" || element.upload_type=="Update_Feasibility_Study_Report"){
                        this.feasibilityReport=true;
                    }
                    if(status_id==5 && !this.feasibilityReport && this.access_level=="Dzongkhag"){
                        $('#attacmentsection').hide();
                    }
                    if(element.upload_type=="final_update_document" || element.upload_type=="Update_Final_Assessment"){
                        this.final_feasibilityReport=true;
                    }
                    if(status_id==7 && !this.final_feasibilityReport && this.access_level=="Dzongkhag"){
                        $('#attacmentsection').hide();
                    }
                });
                this.applicationOrgdetails=data.org_details;
                this.taskDet=response.data.app_stage;
                this.class_section=data.org_class_stream;
                this.getteamVerificationList();

                let status_id=parseInt(this.taskDet.status_id)+1;

                axios.get('organizationApproval/getScreenId/'+this.taskDet.service_name+'__'+status_id)
                .then(response => {
                    let data = response.data.data;
                    if(data!=undefined && data!="NA"){
                        this.screenId=data.screen;
                        this.SysRoleId=data.SysRoleId;
                        this.Sequence=data.Sequence;
                        this.Status_Name=data.Status_Name;
                    }
                })
                .catch(errors => {
                    console.log(errors)
                });

                for(let i=0;i<parseInt(this.taskDet.status_id);i++){
                    $('#verificationattachment'+i).show();
                    if(i==1){
                        $('#attachment_name'+i).html('Notify for Tentative Date of Feasibility Study');
                        $('#attname').html('Feasibility Study Report');
                    }
                    if(i==3){
                        $('#attachment_name'+i).html('Notify for Approval in Principle');
                    }
                    if(i==4){
                        $('#attachment_name'+i).html('Requesting for Final Assessment');
                    }
                    if(i==5){
                        $('#attachment_name'+i).html('Notify for Tentative Date of Final Assessment');
                    }
                }
                if(status_id==2){ //initially submitted
                    $('#setverifyingagency').show();
                    $('#getverifyingagency').hide();
                }else{
                    $('#setverifyingagency').hide();
                    $('#getverifyingagency').show();
                    if(data.feasibility_study_date!=null && data.feasibility_study_date!=""){
                        $('#feasibilityStudy_date_show').val(this.reverseDate(data.feasibility_study_date));
                        $('#feasibilityStudy_date_show').prop('disabled',true);
                        $('#feasibilityStudy_date_show').show();
                        $('#feasibilityStudy_date').hide();
                    }
                    if(status_id==3 && this.access_level=="Ministry"){ //enable the button to update team verification
                        this.showsearch=true;
                        $('#verifier_team').show();
                    }
                    if(status_id==7 && this.access_level=="Ministry"){ //enable the button to update team verification
                        this.final_showsearch=true;
                        $('#final_verifier_team').show();
                    }
                }
                if(status_id==6){ //show final verifying agencies
                    $('#finalverificationdetials').show();
                    $('#getfinalverifyingagency').hide();
                }

                $('#updateBtn').show();
                //hide update button for deo/teo
                if((status_id==4 || status_id==8 || status_id==9) && this.access_level=="Dzongkhag"){
                    $('#attacmentsection').hide();
                    $('#remarksSec').hide();
                }
                if((status_id==3 || status_id==4 || status_id==5 ||  status_id==7 || status_id==8 || status_id==9) && this.access_level=="Dzongkhag"){
                    $('#updateBtn').hide();
                    $('#rejectbtn').hide();
                    if(status_id==3 && !this.feasibilityReport){//show update button at deo level to update feasibility study report
                        $('#update_document_btn').show();
                    }
                    if(status_id==3 && this.feasibilityReport){
                        $('#attacmentsection').hide();
                        $('#remarksSec').hide();
                    }
                    if(status_id==7 && !this.final_feasibilityReport){//show update button at deo level to update final feasibility study report
                        $('#update_document_btn').show();
                    }
                    if(status_id==7 && this.final_feasibilityReport){
                        $('#attacmentsection').hide();
                        $('#remarksSec').hide();
                    }
                }
                if(!this.taskDet.w_config_status.toLowerCase().includes('submitted')){
                    $('#staff_type').empty();
                    this.form.verifying_agency_verified_list=[];
                    this.form.updated_final_verifying_agency_list=[];
                    if(data.app_verification!=undefined){
                        let issetfinal=false;
                        for(let i=0;i<data.app_verification.length;i++){
                            if(data.app_verification[i].type!=null && data.app_verification[i].type=="Final_Assessment"){
                                issetfinal=true;
                            }
                            if(data.app_verification[i].type!=null && data.app_verification[i].type=="Initial_Assessment"){
                                $('#tentative_remarks').val(data.app_verification[i].remarks);
                                $('#tentative_date').val(data.app_verification[i].tentativeDate);
                                this.form.tentative_date=data.app_verification[i].tentativeDate;
                                $('#tentative_date').hide();
                                if(data.app_verification[i].tentativeDate!=null && data.app_verification[i].tentativeDate!=""){
                                    $('#tentative_date_show').val(this.reverseDate(data.app_verification[i].tentativeDate));
                                    $('#tentative_date_show').prop('disabled',true);
                                    $('#tentative_date_show').show();
                                }
                                if(data.feasibility_study_date!=null && data.feasibility_study_date!=""){
                                    $('#feasibilityStudy_date_show').val(this.reverseDate(data.feasibility_study_date));
                                    $('#feasibilityStudy_date_show').prop('disabled',true);
                                    $('#feasibilityStudy_date_show').show();
                                    $('#feasibilityStudy_date').hide();
                                }
                            }
                            if(data.app_verification[i].type!=null && data.app_verification[i].type=="Final_Assessment"){
                                $('#finalverificationdetials').show();
                                $('#setfinalverifyingagency').hide();
                                $('#final_tentative_remarks').val(data.app_verification[i].remarks);
                                $('#final_tentative_date').val(data.app_verification[i].tentativeDate);
                                $('#final_tentative_date').hide();
                                if(data.app_verification[i].tentativeDate!=null && data.app_verification[i].tentativeDate!=""){
                                    $('#final_tentative_date_show').val(this.reverseDate(data.app_verification[i].tentativeDate));
                                    $('#final_tentative_date_show').prop('disabled',true);
                                    $('#final_tentative_date_show').show();
                                }

                                if(data.final_assessment_date!=null && data.final_assessment_date!=""){
                                    $('#final_assessment_date_show').val(this.reverseDate(data.final_assessment_date));
                                    $('#final_assessment_date_show').prop('disabled',true);
                                    $('#final_assessment_date_show').show();
                                    $('#final_assessment_date').hide();
                                }
                                this.form.final_tentative_date=data.app_verification[i].tentativeDate;
                            }
                        }
                        for(let i=0;i<data.app_verification.length;i++){
                            if(issetfinal && data.app_verification[i].type!=null && data.app_verification[i].type=="Initial_Assessment"){
                                this.form.verifying_agency_verified_list.push({department:data.app_verification[i].department_name, division:data.app_verification[i].division_name});
                            }
                            if(issetfinal && data.app_verification[i].type!=null && data.app_verification[i].type=="Final_Assessment"){
                                this.form.updated_final_verifying_agency_list.push({department:data.app_verification[i].department_name, division:data.app_verification[i].division_name});
                            }
                        }
                    }

                }

            })
            .catch((error) => {
                console.log("Error: "+error);
            });
        },
        openfile(file){
            let file_path=file.path+'/'+file.name;
            file_path=file_path.replaceAll('/', 'SSS');
            let uri = 'common/viewFiles/'+file_path;
            window.location=uri;
        },

        shownexttab(nextclass){
           this.change_tab(nextclass);
        },

    },
    async mounted(){
        axios.get('common/getSessionDetail')
        .then(response => {
            let data = response.data.data;
            this.access_level=data.acess_level;
        })
        .catch(errors => {
            console.log(errors)
        });

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
        this.loadestablishmentapplicationdetails(this.$route.params.data.application_no,'NA');
    }
}
</script>
