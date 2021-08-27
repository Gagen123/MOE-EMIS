<template>
    <div>
        <ol class="mb-1 ml-xl-n3 mr-xl-n2 pl-3" style="background-color:#E5E5E5">
            <li class="pl-2 form-inline "><h6 class="pt-1">New ECCD Establishment Verification/Approval</h6></li>
        </ol>
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
                                    <span class="text-blue text-bold">{{applicationdetails.application_date}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Service Name:</label>
                                    <span class="text-blue text-bold">{{taskDet.service_name}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Current Status:</label>
                                    <span class="text-blue text-bold">{{taskDet.w_config_status}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="callout callout-success" v-if="applicationdetails.category=='PRIVATE'">
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
                                    <label class="mb-0">Location Type: {{applicationdetails.location_type}} </label>
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
                            <h5><u>Applicant's Attachments</u></h5>
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

                            <h5><u>Attachments (Tentative Notification)</u></h5>
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
                                        <template v-if="attach.upload_type=='tentative'">
                                            <td>  {{attach.user_defined_file_name}}</td>
                                            <td>  {{attach.name}}</td>
                                            <td>
                                                <a href="#" @click="openfile(attach)" class="fa fa-eye"> View</a>
                                            </td>
                                        </template>
                                    </tr>
                                </tbody>
                            </table>
                            <h5><u>Attachments (Tentative Update)</u></h5>
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
                                        <template v-if="attach.upload_type=='document_update'">
                                            <td>  {{attach.user_defined_file_name}}</td>
                                            <td>  {{attach.name}}</td>
                                            <td>
                                                <a href="#" @click="openfile(attach)" class="fa fa-eye"> View</a>
                                            </td>
                                        </template>
                                    </tr>
                                </tbody>
                            </table>

                            <h5><u>Attachments (Approval in Principal)</u></h5>
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
                                        <template v-if="attach.upload_type=='approval_in_principal'">
                                            <td>  {{attach.user_defined_file_name}}</td>
                                            <td>  {{attach.name}}</td>
                                            <td>
                                                <a href="#" @click="openfile(attach)" class="fa fa-eye"> View</a>
                                            </td>
                                        </template>
                                    </tr>
                                </tbody>
                            </table>

                            <h5><u>Attachments (Approval in Principal Confirmation)</u></h5>
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
                                        <template v-if="attach.upload_type=='approval_in_principal_confirm'">
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
                                    <label>Tentative Date:</label>
                                    <input type="date" name="tentative_date" v-model="form.tentative_date" id="tentative_date" class="form-control">
                                    <span class="text-danger" id="tentative_date_err"></span>
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
                                        <tbody id="setverifyingagency">
                                            <tr v-for='(veri, index) in form.verifying_agency_list' :key="index">
                                                <td>{{index+1}}</td>
                                                <td>
                                                    <select v-model="veri.department" class="form-control" @change="getdivision(index)" name="department_id" :id="'department_id'+index">
                                                        <option v-for="(item, index) in departmentList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                    </select>
                                                    <span class="text-danger" id="department_id_err"></span>
                                                </td>
                                                <td>
                                                    <select v-model="veri.division" class="form-control" :id="'org_id'+index">
                                                    </select>
                                                    <span class="text-danger" :id="'org_id_err'+index"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5">

                                                    <button type="button" class="btn btn-flat btn-sm btn-primary" id="addMore"
                                                    @click="addMoreagency()"><i class="fa fa-plus"></i> Add More</button>
                                                    <button type="button" class="btn btn-flat btn-sm btn-danger" id="remove"
                                                    @click="removeagency()"><i class="fa fa-trash"></i> Remove</button>
                                                </td>
                                            </tr>
                                        </tbody>
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
                                    <span class="text-danger" id="verifying_agency_err"></span>
                                </div>
                            </div>
                        </div>
                        <div id="verifier_team" style="display:none">
                            <div class="callout callout-success" >
                                <h5><u>Team Verification</u></h5>
                                <div class="row form-group">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-if="showsearch">
                                        <button type="button" @click="getEmpDetails()" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Staff</button>
                                    </div>
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
                                                <tr>
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
                        <div class="callout callout-success" >
                            <h4><u>Attachments</u></h4>
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
                                            <tr id="record1" v-for='(att, index) in form.fileUpload' :key="index">
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
                            <hr>

                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0">Remarks</label>
                                <textarea class="form-control" @change="remove_error('remarks')" v-model="form.remarks" id="remarks"></textarea>
                                <span class="text-danger" id="remarks_err"></span>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('attachment-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-info text-white" @click="shownexttab('update')" style="display:none" id="updateBtn"> <i class="fa fa-edit"></i><span id="update_btn_level"></span> </button>
                                <button class="btn btn-danger" id="rejectbtn" @click="shownexttab('reject')"> <i class="fa fa-times"></i>Reject </button>
                                <button class="btn btn-info text-white" @click="shownexttab('verify')" style="display:none" id="verifyId"> <i class="fa fa-forward"></i>Verify </button>
                                <button class="btn btn-primary" @click="shownexttab('approve')" style="display:none" id="approveId"> <i class="fa fa-check"></i>Approve </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="search-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Adding Staff</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="bootbox-body">
                            <div class="row form-group">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Select type:<span class="text-danger">*</span></label>
                                    <select class="form-control" @change="getStaff('staff_type')" id="staff_type" v-model="search.staff_type" :class="{ 'is-invalid': search.errors.has('staff_type') }">
                                        <option value="">--Select--</option>
                                    </select>
                                    <has-error :form="search" field="staff_type"></has-error>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label class="mb-0.5">Staff:<i class="text-danger">*</i></label>
                                    <select v-model="search.staff_id" :class="{ 'is-invalid select2 select2-hidden-accessible': search.errors.has('staff_id') }" class="form-control select2" name="staff_id" id="staff_id">
                                        <option v-for="(item, index) in staffList" :key="index" v-bind:value="item.id">{{ item.cid_work_permit }} : {{ item.name }}, {{item.position_title.name}}</option>
                                    </select>
                                    <has-error :form="search" field="staff_id"></has-error>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button data-bb-handler="cancel" type="button" data-dismiss="modal" class="btn btn-flat btn-danger">Cancel</button>
                        <button  @click="addsearchProvider()" type="button" class="btn btn-flat btn-primary">Add</button>
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
                tentative_date:'',
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
                email:'',
                name:'',
                cid:'',
                staff_type:'',
                staff_id:'',
                applicationNo:'',
                working_agency_id:'',
            }),

        }
    },
    methods:{
        async getAttachmentType(type){
            let data = await this.getRequiredDocument(type);
            if(data!=""){
                data.forEach((item => {
                    this.count++;
                    this.form.fileUpload.push({file_name:item.name, file_upload:''});
                    $('#attach'+this.count).prop('readonly',true);
                }));
            }
        },
        getteamVerificationList(){
            axios.get('organizationApproval/loadTeamVerificationList/'+this.search.id)
            .then(response => {
                let data = response.data.data;
                this.searchProviderList=data;
                if(data!=null && data!="" && data.length>0){
                    $('#verifier_team').show();
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
                this.applicationOrgdetails=data.org_details;
                this.taskDet=response.data.app_stage;
                this.class_section=data.org_class_stream;
                this.getteamVerificationList();
                let status_id=0;
                $('#setverifyingagency').hide();
                $('#getverifyingagency').hide();
                $('#updateBtn').show();
                if(this.taskDet.w_config_status.toLowerCase().includes('submitted')){
                    status_id=2;
                    this.getAttachmentType('Tentative_Date_for_ECCD');
                    this.form.update_type='tentative';
                    $('#update_btn_level').html('Notify For Tentative Date');
                    $('#setverifyingagency').show();
                }else{
                    $('#staff_type').empty();
                    let option='<option value="">--Select--</option>';

                    this.form.verifying_agency_verified_list=[];
                    for(let i=0;i<data.app_verification.length;i++){
                        this.form.verifying_agency_verified_list.push({department:data.app_verification[i].department_name, division:data.app_verification[i].division_name});
                        $('#tentative_remarks').val(data.app_verification[i].remarks);
                        $('#tentative_date').val(data.app_verification[i].tentativeDate);
                        this.form.tentative_date=data.app_verification[i].tentativeDate;
                        $('#tentative_date').prop('disabled',true);
                        $('#getverifyingagency').show();
                        option+='<option value="'+data.app_verification[i].verifyingAgency+'">'+data.app_verification[i].department_name+'( '+data.app_verification[i].division_name+')</option>';
                    }
                    $('#staff_type').append(option);

                    if(this.taskDet.w_config_status.toLowerCase().includes('tentative date')){
                        status_id=3;
                        this.getAttachmentType('Document_Update');
                        this.form.update_type='document_update';
                        $('#update_btn_level').html('Update Documents');
                        $('#updateBtn').show();
                    }

                    if(this.taskDet.w_config_status.toLowerCase().includes('document updated')){
                        status_id=4;
                        this.getAttachmentType('Approval_in_Principal');
                        this.form.update_type='approval_in_principal';
                        $('#update_btn_level').html('Update Approval in Principal');
                        $('#updateBtn').show();
                        this.showsearch=true;
                    }
                    if(this.taskDet.w_config_status.toLowerCase().includes('updated approval in principal')){
                        status_id=5;
                        this.getAttachmentType('Approval_in_Principal_Confirmed');
                        this.form.update_type='approval_in_principal_confirm';
                        $('#update_btn_level').html('Confirm Approval in Principal');
                        $('#updateBtn').show();
                    }
                    if(this.taskDet.w_config_status.toLowerCase().includes('confirmed')){
                        status_id=6;
                        this.getAttachmentType('Approve');
                        this.form.update_type='approve';
                        $('#update_btn_level').html('Approve');
                        $('#updateBtn').show();
                    }
                }

                axios.get('organizationApproval/getScreenId/'+this.taskDet.service_name+'__'+status_id)
                .then(response => {
                    let data = response.data[0];
                    if(data!=undefined){
                        this.screenId=data.screen;
                        this.SysRoleId=data.SysRoleId;
                        this.Sequence=data.Sequence;
                        this.Status_Name=data.Status_Name;
                    }else{
                        $('#screenPermission').show();
                        $('#mainform').hide();
                        $('#message').html('You dont have priviletes to create new application for this service. Please contact with system administrator. <br> Thank you!');
                    }
                })
                .catch(errors => {
                    console.log(errors)
                });
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
        addMore: function(){
            this.count++;
            this.form.fileUpload.push({file_name:'', file_upload:''})
        },
        /**
         * method to remove fields
         */
        remove(index){
             if(this.form.fileUpload.length>1){
                this.count--;
                this.form.fileUpload.splice(index,1);
            }
        },
        addMoreagency: function(){
            this.form.verifying_agency_list.push({department:'', division:''})
        },
        /**
         * method to remove fields
         */
        removeagency(index){
           this.form.verifying_agency_list.pop();
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

        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },
        async getStaff(id){
            let divisionId=$('#'+id).val();
            this.staffList=await this.staffOrgwise(divisionId);
        },
        getEmpDetailsForsearch(){
            if($('#emp_deails_forsearch').val()==""){
                $('#emp_deails_forsearch_err').html('Please provide this field');
            }
            else{
                $('#emp_deails_forsearch_err').html('');
                let type="cid_emp_id";
                let uri="loadCommons/viewStaffDetails/"+type+'/'+$('#emp_deails_forsearch').val();
                axios.get(uri)
                .then((response) => {
                    let data=response.data.data;
                    $('#emp_deails').val('');
                    if(data==null){
                        Swal.fire({
                            text: "No details are found with this input!",
                            icon: 'error',
                        });
                    }
                    else{
                        this.search.working_agency_id=data.working_agency_id;
                        this.search.staff_id=data.id;
                        this.search.cid=data.cid_work_permit;
                        this.search.name=data.name;
                        this.search.email=data.email;
                    }
                })
                .catch(function (error){
                    console.log(error);
                });
            }
        },
        addsearchProvider(){
            this.search.applicationNo= this.form.applicationNo;
            alert(this.search.staff_id);
            this.search.post('organizationApproval/updateTeamVerification/')
            .then((response) => {
                this.getteamVerificationList();
                $('#search-modal').modal('hide');
                this.search.staff_id='';
                this.search.cid='';
                this.search.name='';
                this.search.email='';
                this.search.staff_type='';
            })
            .catch((err) =>{
                console.log("Error: "+err);
            });
		},
        getEmpDetails(){
            $('#search-modal').modal('show');
            this.search.staff_id="";
            $('#staff_id').val().trigger('update');
            $('#staff_type').val().trigger('update');
            this.search.staff_type="";
        },
        shownexttab(nextclass){
            if(nextclass=="reject" || nextclass=="update" || nextclass=="verify" || nextclass=="approve"){
                let action=true;
                if(nextclass=="reject" && this.form.remarks==""){
                    $('#remarks_err').html('Please mention remarks');
                    $('#remarks').addClass('is-invalid');
                    action=false;
                }
                if(nextclass=="update" && this.form.update_type=='tentative'){
                    for(let i=0;i<this.form.verifying_agency_list.length;i++){
                        if($('#org_id'+i).val()==""){
                            $('#org_id_err'+i).html('Please select this division ');
                            action=false;
                        }else{
                            $('#org_id_err'+i).html('');
                        }
                    }
                    if(action){
                        $('#verifying_agency_err').html('');
                    }
                    if(this.form.tentative_date==""){
                        $('#tentative_date_err').html('Please provide date');
                        $('#tentative_date').addClass('is-invalid');
                        action=false;
                    }
                }
                if(action){
                    Swal.fire({
                        text: "Are you sure you wish to "+nextclass+" these application ?",
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes!',
                        }).then((result) => {
                        if (result.isConfirmed) {
                            const config = {
                                headers: {
                                    'content-type': 'multipart/form-data'
                                }
                            }
                            let formData = new FormData();
                            formData.append('id', this.form.id);
                            formData.append('actiontype', nextclass);
                            formData.append('applicationNo', this.form.applicationNo);
                            formData.append('remarks', this.form.remarks);
                            formData.append('verifying_agency', this.form.verifying_agency);

                            formData.append('tentative_date', this.form.tentative_date);
                            formData.append('update_type', this.form.update_type);
                            formData.append('servicename', this.form.servicename);
                            formData.append('nomi_staffList', JSON.stringify(this.form.nomi_staffList));

                            formData.append('screenId', this.screenId);
                            formData.append('SysRoleId', this.SysRoleId);
                            formData.append('Sequence', this.Sequence);
                            formData.append('Status_Name', this.Status_Name);
                            formData.append('service_name', this.taskDet.service_name);
                            formData.append('proposedName', this.applicationOrgdetails.proposedName);
                            formData.append('created_by', this.applicationdetails.created_by);

                            formData.append('ref_docs[]', this.form.ref_docs);
                            for(let i=0;i<this.form.ref_docs.length;i++){
                                formData.append('attachments[]', this.form.ref_docs[i].attach);
                                formData.append('attachmentname[]', this.form.ref_docs[i].name);
                            }
                            formData.append('verifying_agency_list', JSON.stringify(this.form.verifying_agency_list));
                            axios.post('organizationApproval/updateNewEstablishmentApplication', formData, config)
                            .then((response) => {
                                if(response!=""){
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Application details has been updated.'
                                    });
                                    this.$router.push({path:'/tasklist'});
                                }
                            })
                            .catch((err) => {
                                Swal.fire(
                                    'error!',
                                    'Not able to update these application details. Please contact system administrator.Error: '+err,
                                    'error',
                                );
                                console.log("Error:"+err)
                            })
                        }
                    });
                }
            }
            else{
                $('#tabhead >li >a').removeClass('active');
                $('#tabhead >li >a >span').addClass('bg-gradient-secondary text-white');
                $('.'+nextclass+' >a').addClass('active');
                $('.'+nextclass+' >a >span').removeClass('bg-gradient-secondary text-white');
                $('.'+nextclass+' >a').removeClass('disabled');
                $('.tab-content-details').hide();
                $('#'+nextclass).show().removeClass('fade');
            }
        },

        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="organization_type_id"){
                this.form.organization_type_id=$('#organization_type_id').val();
                if($('#organization_type_id').val()=="Dzongkhag"){
                    $('#department_id').hide();
                    $('#dzongkhag_id').show();
                }else{
                    $('#department_id').show();
                    $('#dzongkhag_id').hide();
                }
            }
            if(id=="department_id"){
                this.form.department_id=$('#department_id').val();
            }
            if(id=="org_id"){
                this.form.org_id=$('#org_id').val();
            }
            if(id=="staff_id"){
                this.search.staff_id=$('#staff_id').val();
            }
        },
        async getdivision(index){
            $('#org_id'+index).empty();
            let orgList=await this.getdivisionList($('#department_id'+index).val());
            let option='<option value="">--Select--</option>';
            orgList.forEach(itm => {
                option+='<option value="'+itm.id+'">'+itm.name+'</option>';
            });
            $('#org_id'+index).append(option);
        }
    },
    async mounted(){
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
        this.loadestablishmentapplicationdetails(this.$route.params.data.application_number,this.$route.params.type);
        this.departmentList=await this.getDepartmentListbydzo('Ministry','all_ministry_departments');
    }
}
</script>
