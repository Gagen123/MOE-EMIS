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
                                    <span class="text-blue text-bold">{{applicationdetails.application_date}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Service Name:</label>
                                    <span class="text-blue text-bold">{{taskDet.service_name}}</span>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
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
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <label class="mb-0">Name:</label>
                                    <span class="text-blue text-bold">{{applicationOrgdetails.name}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Dzongkhag:</label>
                                    <span class="text-blue text-bold">{{dzongkhagArray[applicationOrgdetails.dzongkhagId]}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Gewog:</label>
                                    <span class="text-blue text-bold" id="gewogid"></span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Chiwog:</label>
                                    <span class="text-blue text-bold" id="vilageId"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-if="applicationdetails.location_type!=null">
                                    <label class="mb-0">Location Type:</label>
                                    <span class="text-blue text-bold">{{applicationdetails.location_type}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Is Co-located with Parent School:</label>
                                    <span class="text-blue text-bold">{{ applicationOrgdetails.coLocatedParent  == 1 ? "Yes" :  "No"}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-if="applicationOrgdetails.parent_school!=''">
                                    <label class="mb-0">Parent School:</label>
                                    <span class="text-blue text-bold">
                                        {{ applicationOrgdetails.parent_school}}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="callout callout-success">
                            <h5><u>Proposed Change Details</u></h5>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Dzongkhag:</label>
                                    <span class="text-blue text-bold">{{dzongkhagArray[applicationdetails.dzongkhagId]}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Gewog:</label>
                                    <span class="text-blue text-bold" id="appgewogid"></span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Chiwog:</label>
                                    <span class="text-blue text-bold" id="appvilageId"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-if="applicationdetails.app_location_type!=null">
                                    <label class="mb-0">Location Type:</label>
                                    <span class="text-blue text-bold">{{applicationdetails.app_location_type}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Is Co-located with Parent School:</label>
                                    <span class="text-blue text-bold">{{ applicationdetails.colocated_parent_school  == 1 ? "Yes" :  "No"}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-if="applicationdetails.app_parent_school!=''">
                                    <label class="mb-0">Parent School:</label>
                                    <span class="text-blue text-bold">
                                        {{ applicationdetails.app_parent_school}}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="callout callout-info">
                            <Workflow :appNo="form.applicationNo"/>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 fa-pull-right">
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
                                <!-- <span id="verificationattachment2" style="display:none"> -->
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
                                <button class="btn btn-success" @click="shownexttab('organization-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
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
                                    <input type="text" name="tentative_date_show" id="tentative_date_show" style="display:none" class="form-control">
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
                        <div class="callout callout-success" style="display:none" id="finalverificationdetials">
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
                                        <input type="text" name="final_assessment_date_show" id="final_assessment_date_show" style="display:none" class="form-control">
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
            searchid:'',
            count:1,
            feasibilityReport:false,
            final_feasibilityReport:false,
            access_level:'',
            proprietorList:[],
            applicationdetails:[],
            applicationOrgdetails:[],
            taskDet:[],
            staffList:[],
            searchProviderList:[],
            dzongkhagArray:{},
            gewogArray:{},
            villageArray:{},

            screenId:'',
            SysRoleId:'',
            Sequence:'',
            Status_Name:'',
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
                update_type:'',
                servicename:'',
                feasibilityStudy_date:'',
                final_assessment_date:'',
                nomi_staffList:[],
                fileUpload: [],
                attachments:
                [{
                    file_name:'',attachment:''
                }],
                ref_docs:[],
            }),
        }
    },
    methods: {
        getteamVerificationList(){
            axios.get('organizationApproval/loadTeamVerificationList/'+this.searchid)
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
        loadapplicationdetails(appId,type){
            axios.get('organizationApproval/loadEstbDetailsForVerification/'+appId+'/'+type)
            .then((response) => {
                let data=response.data.data;
                this.searchid=data.id;
                this.getteamVerificationList();
                this.form.applicationNo=data.application_no;
                this.form.servicename=data.establishment_type;
                this.applicationdetails=data;
                this.applicationOrgdetails=data.orgDetails;
                this.getGewogList(response.data.data.dzongkhagId,data.orgDetails.gewogId,'gewogid');
                this.getvillagelist(response.data.data.gewogId,data.orgDetails.chiwogId,'vilageId');

                this.getGewogList(response.data.data.dzongkhagId,response.data.data.gewogId,'appgewogid');
                this.getvillagelist(response.data.data.gewogId,response.data.data.chiwogId,'appvilageId');
                this.taskDet=response.data.app_stage;
                let status_id=parseInt(this.taskDet.status_id)+1;

                axios.get('organizationApproval/getScreenId/'+this.taskDet.service_name+'__'+status_id)
                .then(response => {
                    let data = response.data.data;
                    if(data!=undefined && data!="NA"){
                        this.screenId=data.screen;
                        this.SysRoleId=data.SysRoleId;
                        this.Sequence=data.Sequence;
                        this.Status_Name=data.Status_Name;
                        $('#attname').html(data.Name);
                    }else{
                        $('#screenPermission').show();
                        $('#mainform').hide();
                        $('#message').html('You dont have priviletes to create new application for this service. Please contact with system administrator. <br> Thank you!');
                    }
                })
                .catch(errors => {
                    console.log(errors)
                });

                data.attachments.forEach(element => {
                    if(element.upload_type=="update_document" || element.upload_type=="Update_Feasibility_Study_Report"){
                        this.feasibilityReport=true;
                    }
                    if(!this.feasibilityReport && this.access_level=="Dzongkhag"){
                        $('#attacmentsection').hide();
                    }
                    if(element.upload_type=="final_update_document" || element.upload_type=="Update_Final_Assessment"){
                        this.final_feasibilityReport=true;
                    }
                    if(!this.final_feasibilityReport && this.access_level=="Dzongkhag"){
                        $('#attacmentsection').hide();
                    }
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
                if(data.feasibility_study_date!=null &&  data.feasibility_study_date!=""){
                    $('#feasibilityStudy_date_show').val(this.reverseDate(data.feasibility_study_date));
                    $('#feasibilityStudy_date_show').prop('disabled',true);
                    $('#feasibilityStudy_date_show').show();
                    $('#feasibilityStudy_date').hide();
                }

                if(!this.taskDet.w_config_status.toLowerCase().includes('submitted')){
                    this.form.verifying_agency_verified_list=[];
                    this.form.updated_final_verifying_agency_list=[];
                    if(data.app_verification!=undefined){
                        for(let i=0;i<data.app_verification.length;i++){
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
                            if(data.app_verification[i].type!=null && data.app_verification[i].type=="Initial_Assessment"){
                                this.form.verifying_agency_verified_list.push({department:data.app_verification[i].department_name, division:data.app_verification[i].division_name});
                            }
                            if(data.app_verification[i].type!=null && data.app_verification[i].type=="Final_Assessment"){
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

        async getGewogList(dzongkhag,gewogId,targetId){
            let data = await this.loadgewogList(dzongkhag);
            this.gewog_list = data;
            for(let i=0;i<data.length;i++){
                this.gewogArray[data[i].id] = data[i].name;
            }
            $('#'+targetId).html(this.gewogArray[gewogId]);
        },
        async getvillagelist(gewogId,vil_id,targetId){
            let data = await this.loadvillageList(gewogId);
            for(let i=0;i<data.length;i++){
                this.villageArray[data[i].id] = data[i].name;
            }
            $('#'+targetId).html(this.villageArray[vil_id])
        },
        shownexttab(nextclass){
            this.change_tab(nextclass);
        },

    },

    async mounted() {
        axios.get('common/getSessionDetail')
        .then(response => {
            let data = response.data.data;
            this.access_level=data.acess_level;
        })
        .catch(errors => {
            console.log(errors)
        });

        let data= await this.loadactivedzongkhags();
        for(let i=0;i<data.length;i++){
            this.dzongkhagArray[data[i].id] = data[i].name;
        }
        this.loadapplicationdetails(this.$route.params.data.application_no,'NA');
    }
}
</script>
