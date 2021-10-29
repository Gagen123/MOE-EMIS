<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs">
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
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-if="applicationdetails.establishment_type=='Public School'">
                                    <label class="mb-0">Proposal Initiated By:</label>
                                    <span class="text-blue text-bold">{{proposed_by_list[applicationdetails.initiated_by]}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Proposed Name:</label>
                                    <span class="text-blue text-bold">{{applicationOrgdetails.proposedName}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Level:</label>
                                    <span class="text-blue text-bold">{{applicationdetails.org_level}}</span>
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
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Location Type:</label>
                                    <span class="text-blue text-bold">{{applicationdetails.location_type}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-if="applicationdetails.establishment_type=='Private School'">
                                    <label class="mb-0">Type of School:</label>
                                    <span class="text-blue text-bold">{{ applicationOrgdetails.typeOfSchool}}</span>
                                </div>
                                <!-- <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Geopolitically Located:</label>
                                    <span class="text-blue text-bold">
                                        {{ applicationdetails.geopolicaticallyLocated  == 1 ? "Yes" :  "No"}}
                                    </span>
                                </div>  -->
                            </div>
                            <div class="form-group row" v-if="applicationdetails.establishment_type=='Public School'">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Is Feeding School:</label>
                                    <span class="text-blue text-bold">{{ applicationOrgdetails.isFeedingSchool  == 1 ? "Yes" :  "No" }}</span>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" v-if="isFeeding  == 1">
                                    <label class="mb-0">Feeding Modality: </label>
                                    <span class="text-blue text-bold"> {{feed_details}} </span>
                                </div>
                            </div>

                            <div v-if="applicationdetails.establishment_type=='Private School'">
                                <div class="row pb-2">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <h5><u>Proprietor Details</u></h5>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0">CID:</label>
                                        <span class="text-blue text-bold">{{applicationdetails.org_details.proprietorCid}}</span>
                                    </div>
                                   <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0">Full Name:</label>
                                        <span class="text-blue text-bold">{{applicationdetails.org_details.proprietorName}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                   <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0">Mobile No:</label>
                                        <span class="text-blue text-bold">{{applicationdetails.org_details.proprietorMobile}}</span>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0">Phone No:</label>
                                        <span class="text-blue text-bold">{{applicationdetails.org_details.proprietorPhone}}</span>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0">Email:</label>
                                        <span class="text-blue text-bold">{{applicationdetails.org_details.proprietorEmail}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="callout callout-info">
                            <Workflow  :appNo="form.applicationNo"/>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 fa-pull-right">
                                <button class="btn btn-primary" @click="shownexttab('class-tab')">Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade tab-content-details" id="class-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="row pb-2">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="callout callout-success">
                                    <h4><u>Classes / streams</u></h4>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                                        <table id="class-table" class="table table-sm table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Classes</th>
                                                    <th v-if="streamSection">Stream</th>
                                                    <th>Applicable</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(item, key, index) in  class_section" :key="index">
                                                    <td>
                                                        <label class="pr-4"> &nbsp;{{ item.class }} </label>
                                                    </td>
                                                    <td v-if="streamSection">
                                                        <label class="pr-4"> &nbsp;{{ item.stream }} </label>
                                                    </td>
                                                    <td>
                                                       <input type="checkbox" checked="true" disabled>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 fa-pull-right">
                                <button class="btn btn-success" @click="shownexttab('organization-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-primary" @click="shownexttab('file-tab')">Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade tab-content-details" id="file-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="row pb-2">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                                                    <template v-if="attach.upload_type=='Update_Sector_Clearance'">
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
                                <span id="verificationattachment6" style="display:none">
                                    <div class="callout callout-success">
                                        <h5><u>7. Attachments (<span id="attachment_name6"></span>)</u></h5>
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
                                        <h5><u>8. Attachments (Final Feasibility Report)</u></h5>
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
                            </div>
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
                                    <label>Tentative Date for Feasibility Study:</label>
                                    <!-- <input type="date" name="tentative_date" v-model="form.tentative_date" id="tentative_date" class="form-control"> -->
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
                                        <!-- <tbody id="setverifyingagency">
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
                                        </tbody> -->
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

                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('file-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
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
            streamSection:false,
            taskDet:'',
            applicationdetails:[],

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
        }
    },
    methods:{
        openfile(file){
            let file_path=file.path+'/'+file.name;
            file_path=file_path.replaceAll('/', 'SSS');
            let uri = 'common/viewFiles/'+file_path;
            window.location=uri;
        },

        shownexttab(nextclass){
            this.change_tab(nextclass);
        },

        applyselect2(){

        },
        getteamVerificationList(){
            axios.get('organization/loadTeamVerificationList/'+this.id)
            .then(response => {
                let data = response.data.data;
                this.searchProviderList=data;
            })
            .catch(errors => {
                console.log(errors)
            });
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

        axios.get('organizationApproval/loadEstbDetailsForVerification/'+this.$route.query.id+'/NA')
        .then((response) => {
            let data=response.data.data;
            this.applicationdetails=data;
            this.taskDet=response.data.app_stage;
            this.applicationOrgdetails=data.org_details;
            if(this.applicationdetails.org_level!=undefined && this.applicationdetails.org_level.toLowerCase().includes('higher')){
                this.streamSection=true;
            }
            if(data.attachments!=undefined && data.attachments!=""){
                this.app_attachments=data.attachments;
            }
            this.class_section=data.org_class_stream;
            this.form.applicationNo=data.application_no;

            this.form.servicename=data.establishment_type;
            this.getteamVerificationList();

            let status_id=parseInt(this.taskDet.status_id)+1;
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

            axios.get('organizationApproval/getScreenId/'+this.taskDet.service_name+'__1')
            .then(response => {
                let data = response.data.data;
                if(data!=undefined && data!="NA"){
                    this.screenId=data.screen;
                    this.SysRoleId=data.SysRoleId;
                    this.Sequence=data.Sequence;
                    this.Status_Name=data.Status_Name;
                    $('#attname').html(data.Name);
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

            for(let i=0;i<parseInt(this.taskDet.status_id);i++){
                $('#verificationattachment'+i).show();
                if(i==1){
                    $('#attachment_name'+i).html('Notify for Tentative Date of Feasibility Study');
                    $('#attname').html('Feasibility Study Report');
                }
                if(i==3){
                    $('#attachment_name'+i).html('Sector Clearances');
                }
                if(i==4){
                    $('#attachment_name'+i).html('Notifying for approval in Principle');
                }
                if(i==5){
                    $('#attachment_name'+i).html('Requesting for Final Assessment');
                }
                if(i==6){
                    $('#attachment_name'+i).html('Notifying for Tentative Date of Final Assessment');
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
                if(status_id==8 && this.access_level=="Ministry"){ //enable the button to update team verification
                    this.final_showsearch=true;
                    $('#final_verifier_team').show();
                }
                if(status_id>3 ){
                    $('#verifier_team').show();
                }
                if(status_id>8 ){
                    $('#final_verifier_team').show();
                }
            }
            if(status_id==7){ //show final verifying agencies
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
                        if((!issetfinal || status_id>7) && data.app_verification[i].type!=null && data.app_verification[i].type=="Initial_Assessment"){
                            this.form.verifying_agency_verified_list.push({department:data.app_verification[i].department_name, division:data.app_verification[i].division_name});
                            option+='<option value="'+data.app_verification[i].verifyingAgency+'">'+data.app_verification[i].department_name+'( '+data.app_verification[i].division_name+')</option>';
                        }
                        if((issetfinal || status_id>8)&& data.app_verification[i].type!=null && data.app_verification[i].type=="Final_Assessment"){
                            this.form.updated_final_verifying_agency_list.push({department:data.app_verification[i].department_name, division:data.app_verification[i].division_name});
                            option+='<option value="'+data.app_verification[i].verifyingAgency+'">'+data.app_verification[i].department_name+'( '+data.app_verification[i].division_name+')</option>';
                        }
                    }
                }
                $('#staff_type').append(option);
            }

        })
        .catch((error) => {
            console.log("Error: "+error);
        });

        this.departmentList=await this.getDepartmentListbydzo('Ministry','all_ministry_departments');
    }
}
</script>
