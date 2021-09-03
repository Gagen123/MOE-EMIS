<template>
    <div>
        <ol class="mb-1 ml-xl-n3 mr-xl-n2 pl-3" style="background-color:#E5E5E5">
            <li class="pl-2 form-inline "><h6 class="pt-1">Verification/Approval for Location Change of ECCD Centre's </h6></li>
        </ol>
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
                                    <thead>
                                        <tr>
                                            <th>Attachment Name</th>
                                            <th>Attachment</th>
                                            <th>File</th>
                                        </tr>
                                    </thead>
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
                                    <thead>
                                        <tr>
                                            <th>Attachment Name</th>
                                            <th>Attachment</th>
                                            <th>File</th>
                                        </tr>
                                    </thead>
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
                                    <thead>
                                        <tr>
                                            <th>Attachment Name</th>
                                            <th>Attachment</th>
                                            <th>File</th>
                                        </tr>
                                    </thead>
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
                                    <thead>
                                        <tr>
                                            <th>Attachment Name</th>
                                            <th>Attachment</th>
                                            <th>File</th>
                                        </tr>
                                    </thead>
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
                                    <thead>
                                        <tr>
                                            <th>Attachment Name</th>
                                            <th>Attachment</th>
                                            <th>File</th>
                                        </tr>
                                    </thead>
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
                                    <thead>
                                        <tr>
                                            <th>Attachment Name</th>
                                            <th>Attachment</th>
                                            <th>File</th>
                                        </tr>
                                    </thead>
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
                                    <input type="date" name="tentative_date" v-model="form.tentative_date" id="tentative_date" class="form-control">
                                    <input type="text" name="tentative_date_show" id="tentative_date_show" style="display:none" class="form-control">
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
                                                    <select v-model="veri.department" class="form-control" @change="getdivision(index,'org_id')" name="department_id" :id="'department_id'+index">
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
                                                    @click="addMoreagency('org_id')"><i class="fa fa-plus"></i> Add More</button>
                                                    <button type="button" class="btn btn-flat btn-sm btn-danger" id="remove"
                                                    @click="removeagency('org_id')"><i class="fa fa-trash"></i> Remove</button>
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
                            <div id="verifier_team" style="display:none">
                                <div class="row form-group">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Date for Feasibility Study:</label>
                                        <input type="date" name="feasibilityStudy_date" v-model="form.feasibilityStudy_date" id="feasibilityStudy_date" class="form-control">
                                        <input type="text" style="display:none" name="feasibilityStudy_date_show" id="feasibilityStudy_date_show" class="form-control">
                                        <span class="text-danger" id="feasibilityStudy_date_err"></span>
                                    </div>
                                </div>
                                <h5><u>Team Verification</u></h5>
                                <div class="row form-group">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-if="showsearch">
                                        <button type="button" @click="getEmpDetails('verifier_team')" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Staff</button>
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
                                    <input type="date" name="final_tentative_date" v-model="form.final_tentative_date" id="final_tentative_date" class="form-control">
                                    <input type="text" name="final_tentative_date_show" id="final_tentative_date_show" style="display:none" class="form-control">
                                    <span class="text-danger" id="final_tentative_date_err"></span>
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
                                        <tbody id="setfinalverifyingagency">
                                            <tr v-for='(veri, index) in form.final_verifying_agency_list' :key="index">
                                                <td>{{index+1}}</td>
                                                <td>
                                                    <select v-model="veri.department" class="form-control" @change="getdivision(index,'final_org_id')" name="final_department_id" :id="'final_department_id'+index">
                                                        <option v-for="(item, index) in departmentList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                    </select>
                                                    <span class="text-danger" id="final_department_id_err"></span>
                                                </td>
                                                <td>
                                                    <select v-model="veri.division" class="form-control" :id="'final_org_id'+index">
                                                    </select>
                                                    <span class="text-danger" :id="'final_org_id_err'+index"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5">
                                                    <button type="button" class="btn btn-flat btn-sm btn-primary" id="addMore"
                                                    @click="addMoreagency('final_org_id')"><i class="fa fa-plus"></i> Add More</button>
                                                    <button type="button" class="btn btn-flat btn-sm btn-danger" id="remove"
                                                    @click="removeagency('final_org_id')"><i class="fa fa-trash"></i> Remove</button>
                                                </td>
                                            </tr>
                                        </tbody>
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
                                    <span class="text-danger" id="final_verifying_agency_err"></span>
                                </div>
                            </div>
                            <div id="final_verifier_team" style="display:none">
                                <div class="row form-group">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Date for final Assessment:</label>
                                        <input type="date" name="final_assessment_date" v-model="form.final_assessment_date" id="final_assessment_date" class="form-control">
                                        <input type="text" name="final_assessment_date_show" id="final_assessment_date_show" style="display:none" class="form-control">
                                        <span class="text-danger" id="final_assessment_date_err"></span>
                                    </div>
                                </div>
                                <h5><u>Final Team Verification</u></h5>
                                <div class="row form-group">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-if="final_showsearch">
                                        <button type="button" @click="getEmpDetails('final_verifier_team')" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Staff</button>
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

                        <div class="callout callout-success" id="attacmentsection">
                            <h4><u>Attachments (<span id="attname"></span>)</u></h4>
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
                                    <span class="text-danger" id="attachment_err"></span>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="row" id="remarksSec">
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
                                <button type="button" class="btn btn-info text-white" @click="shownexttab('update_document')" style="display:none" id="update_document_btn"> <i class="fa fa-edit"></i>Update Documents </button>
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
            feasibilityReport:false,
            final_feasibilityReport:false,
            final_showsearch:false,
            access_level:'',
            proprietorList:[],
            applicationdetails:[],
            applicationOrgdetails:[],
            searchProviderList:[],
            taskDet:[],
            departmentList:[],
            staffList:[],

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
            search: new form({
                id:'',
                type:'',
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
    methods: {
        loadapplicationdetails(appId,type){
            axios.get('organizationApproval/loadEstbDetailsForVerification/'+appId+'/'+type)
            .then((response) => {
                let data=response.data.data;
                this.form.applicationNo=data.application_no;
                this.form.servicename=data.establishment_type;
                this.search.id=data.id;
                this.applicationdetails=data;
                this.applicationOrgdetails=data.orgDetails;
                this.getGewogList(response.data.data.dzongkhagId,data.orgDetails.gewogId,'gewogid');
                this.getvillagelist(response.data.data.gewogId,data.orgDetails.chiwogId,'vilageId');

                this.getGewogList(response.data.data.dzongkhagId,response.data.data.gewogId,'appgewogid');
                this.getvillagelist(response.data.data.gewogId,response.data.data.chiwogId,'appvilageId');
                this.taskDet=response.data.app_stage;
                this.getteamVerificationList();
                let status_id=parseInt(this.taskDet.status_id)+1;

                axios.get('organizationApproval/getScreenId/'+this.taskDet.service_name+'__'+status_id)
                .then(response => {
                    // let data = response.data[0];
                    let data = response.data.data;
                    if(data!=undefined && data!="NA"){
                        this.screenId=data.screen;
                        this.SysRoleId=data.SysRoleId;
                        this.Sequence=data.Sequence;
                        this.Status_Name=data.Status_Name;
                        $('#attname').html(data.Name);
                        this.getAttachmentType(data.Name.replaceAll(" ", "_"));
                        this.form.update_type=data.Name.replaceAll(" ", "_");
                        $('#update_btn_level').html(data.Name);
                        $('#updateBtn').show();
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
                    if(element.upload_type=="final_update_document" || element.upload_type=="Update_Final_Assessment"){
                        this.final_feasibilityReport=true;
                    }
                });

                for(let i=0;i<parseInt(this.taskDet.status_id);i++){
                    $('#verificationattachment'+i).show();
                    if(i==1){
                        $('#attachment_name'+i).html('Notify for Tentative Date of Feasibility Study');
                        $('#attname').html('Feasibility Study Report');
                        if(status_id==3 && !this.feasibilityReport && this.access_level=="Dzongkhag"){
                            this.getAttachmentType('Update_Feasibility_Study_Report');
                        }
                        if(status_id==7 && this.access_level=="Dzongkhag"){
                            this.getAttachmentType('Update_Final_Assessment');
                        }
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
                alert(status_id+this.access_level);
                if(status_id==2){ //initially submitted
                    $('#setverifyingagency').show();
                    $('#getverifyingagency').hide();
                }else{
                    $('#setverifyingagency').hide();
                    $('#getverifyingagency').show();
                    if(data.feasibility_study_date!=null &&  data.feasibility_study_date!=""){
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
                    let option='<option value="">--Select--</option>';
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
                            if(!issetfinal && data.app_verification[i].type!=null && data.app_verification[i].type=="Initial_Assessment"){
                                this.form.verifying_agency_verified_list.push({department:data.app_verification[i].department_name, division:data.app_verification[i].division_name});
                                option+='<option value="'+data.app_verification[i].verifyingAgency+'">'+data.app_verification[i].department_name+'( '+data.app_verification[i].division_name+')</option>';
                            }
                            if(issetfinal && data.app_verification[i].type!=null && data.app_verification[i].type=="Final_Assessment"){
                                this.form.updated_final_verifying_agency_list.push({department:data.app_verification[i].department_name, division:data.app_verification[i].division_name});
                                option+='<option value="'+data.app_verification[i].verifyingAgency+'">'+data.app_verification[i].department_name+'( '+data.app_verification[i].division_name+')</option>';
                            }
                        }
                        $('#staff_type').append(option);
                    }
                }

            })
            .catch((error) => {
                console.log("Error: "+error);
            });
        },
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
        async getdivision(index,id){
            $('#'+id+index).empty();
            let orgList=await this.getdivisionList($('#department_id'+index).val());
            if(id=="final_org_id"){
                orgList=await this.getdivisionList($('#final_department_id'+index).val());
            }
            let option='<option value="">--Select--</option>';
            orgList.forEach(itm => {
                option+='<option value="'+itm.id+'">'+itm.name+'</option>';
            });
            $('#'+id+index).append(option);
        },
        getEmpDetails(type){
            this.search.staff_id="";
            $('#staff_id').val('').trigger('change');
            this.search.staff_type="";
            $('#staff_type').val('').trigger('change');
            this.search.type=type;
            $('#search-modal').modal('show');
        },
        addsearchProvider(){
            this.search.applicationNo= this.form.applicationNo;
            this.search.post('organizationApproval/updateTeamVerification/')
            .then((response) => {
                this.getteamVerificationList();
                $('#search-modal').modal('hide');
                this.search.type='';
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
        async getStaff(id){
            let divisionId=$('#'+id).val();
            this.staffList=await this.staffOrgwise(divisionId);
        },
        shownexttab(nextclass){
            if(nextclass=="reject" || nextclass=="update" || nextclass=="update_document"){
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
                // if(nextclass=="update_document"){
                //     if(this.form.fileUpload.length<1){
                //         action=false;
                //         $('#attachment_err').html('Please attach Feasibility Study Report with appropriate file name');
                //     }
                //     if(this.form.fileUpload.length>0){
                //         $('#attachment_err').html('');
                //         for(let i=1;i<=this.form.fileUpload.length;i++){
                //             if($('#attach'+i).val()==""){
                //                 $('#attach'+i+'_err').html('Please attach this file ');
                //                 action=false;
                //             }
                //             if($('#file_name'+i).val()==""){
                //                 $('#file_name'+i+'_err').html('Please mention appropriate name of the file ');
                //                 action=false;
                //             }
                //         }
                //     }
                // }
                if(nextclass=="update_document"){
                    this.form.update_type="update document for feasibility study";
                    if(this.taskDet.status_id==6){
                        this.form.update_type="update document for final assessment";
                    }
                }
                if(action){
                    Swal.fire({
                        text: "Are you sure you wish to "+this.form.update_type.replaceAll("_", " ")+" for these application ?",
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
                            formData.append('final_tentative_date', this.form.final_tentative_date);
                            formData.append('feasibilityStudy_date', this.form.feasibilityStudy_date);
                            formData.append('final_assessment_date', this.form.final_assessment_date);
                            formData.append('update_type', this.form.update_type);
                            if(nextclass=="update_document"){
                                formData.append('update_type', nextclass);
                                if(this.taskDet.status_id==6){
                                    formData.append('update_type', 'final_update_document');
                                }
                            }
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
                            formData.append('final_verifying_agency_list', JSON.stringify(this.form.final_verifying_agency_list));

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
                this.change_tab(nextclass);
            }
        },
        addMore: function(){
            this.count++;
            this.form.fileUpload.push({file_name:'', file_upload:''})
        },

        remove(index){
             if(this.form.fileUpload.length>1){
                this.count--;
                this.form.fileUpload.splice(index,1);
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
        addMoreagency: function(type){
            if(type=="org_id"){
                this.form.verifying_agency_list.push({department:'', division:''})
            }else{
                this.form.final_verifying_agency_list.push({department:'', division:''})
            }
        },

        removeagency(type,index){
            if(type=="org_id"){
                this.form.verifying_agency_list.pop();
            }else{
                this.form.final_verifying_agency_list.pop();
            }
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
        this.loadapplicationdetails(this.$route.params.data.application_number,this.$route.params.type);
        this.departmentList=await this.getDepartmentListbydzo('Ministry','all_ministry_departments');

    }
}
</script>
