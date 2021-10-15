<template>
    <div>
        <ol class="mb-1 ml-xl-n3 mr-xl-n2 pl-3" style="background-color:#E5E5E5">
            <li class="pl-2 form-inline "><h6 class="pt-1">Leadership Selection Verification/Approval</h6></li>
        </ol>
        <div id="maindiv">
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-body">
                    <!-- Post Details -->
                    <template v-if="post_detail!=''">
                        <div class="callout callout-success">
                            <span><label><u>Post Detials</u></label></span>
                            <div class="row form-group">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Leadership Selection For:</label>
                                    <input type="hidden" id="selectionfor" :value="selectionListArray[post_detail.selection_type]">
                                    <span class="text-blue text-bold">{{selectionListArray[post_detail.selection_type]}}</span>
                                </div>
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
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label>Details:</label>
                                    <span class="text-blue text-bold">{{post_detail.details}}</span>
                                </div>
                            </div>
                        </div>
                    </template>
                    <!-- Application Detauils -->
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
                                <input type="hidden" id="applicant" :value="form.applicant">
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
                    <!-- Applicant Attachment -->
                    <div class="callout callout-success">
                        <span><label><u>Applicant Attachment(s)</u></label></span>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                                            <template v-if="attach.attachment_for=='Leadership Application'">
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

                    <!-- Feedback Section -->
                    <div class="callout callout-info">
                        <div class="row form-group" v-if="form.shortlisted_remarks!=''">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0">Shortlisted Remarks: </label>
                                <span class="text-blue text-bold">{{form.shortlisted_remarks}}</span>
                            </div>
                        </div>
                        <h4><u>Feedback Configuration Details</u></h4>
                        <div class="row form-group" v-if="form.current_status=='Submitted' && form.feedback==1">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Feed back Start Date:<span class="text-danger">*</span></label>
                                <input type="date" class="form-control" @change="remove_error('feedback_start_date')" :class="{ 'is-invalid': form.errors.has('feedback_start_date') }"  name="feedback_start_date" id="feedback_start_date" v-model="form.feedback_start_date">
                                <has-error :form="form" field="feedback_start_date"></has-error>
                                <span class="text-danger" id="feedback_start_date_err"></span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Feed back End Date:<span class="text-danger">*</span></label>
                                <input type="date" @change="remove_error('feedback_end_date')" :class="{ 'is-invalid': form.errors.has('feedback_end_date') }"  class="form-control" name="feedback_end_date" id="feedback_end_date" v-model="form.feedback_end_date">
                                <has-error :form="form" field="feedback_end_date"></has-error>
                                <span class="text-danger" id="feedback_end_date_err"></span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pt-4 mt-1">
                                <button type="button" class="btn btn-primary btn-flat btn-sm fa-pull-right" @click="showmodel()"><i class="fa fa-plus"></i> Add Feedback Provider</button>
                            </div>
                        </div>
                        <div class="row form-group" v-else>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Feed back Start Date:</label>
                                <span class="text-blue text-bold">{{form.feedback_start_date}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Feed back End Date:</label>
                                <span class="text-blue text-bold">{{form.feedback_end_date}}</span>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Details for Feedback Provider:</label>
                                <span class="text-blue text-bold">{{form.feedback_details}}</span>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Remarks:</label>
                                <span class="text-blue text-bold">{{form.feedback_remarks}}</span>
                            </div>
                        </div>
                        <span><label><u>Feedback Providers</u></label></span>
                        <div class="alert alert-warning alert-dismissible" v-if="feedback_status=='Under Process'">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            In order to take further action for this applicaiton, you need to make sure that you have visited all feedbacks and click visited button from popup. Once you update, the status will chage to visited
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <table id="feedback_provider-table" class="table table-sm table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>From</th>
                                            <th>CID</th>
                                            <th>Name</th>
                                            <th>Position Title</th>
                                            <th>Contact No</th>
                                            <th>Email</th>
                                            <th>Feedback Category</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for='(stf,count) in feedbackNomineesList' :key="count+1">
                                            <template>
                                                <td>{{stf.partifipant_from}} </td>
                                                <td>{{stf.cid}}</td>
                                                <td>{{stf.name}}</td>
                                                <td>{{stf.positiontitle}}</td>
                                                <td>{{stf.contact}}</td>
                                                <td>{{stf.email}}</td>
                                                <td>{{feedbackCategoryArray[stf.feedback_type]}}</td>
                                                <td>
                                                    <span v-if="stf.status=='Pending'" class="right badge badge-warning">{{stf.status}}</span>
                                                    <span v-if="stf.status=='Submitted'" class="right badge badge-success">{{stf.status}}</span>
                                                    <span v-if="stf.status=='Visited'" class="right badge badge-primary">{{stf.status}}</span>
                                                </td>
                                                <td >
                                                    <!-- <button v-if="form.current_status=='Notified for Feedback' && form.feedback==1" type="button" class="btn btn-flat btn-sm btn-danger pt-0 pb-1" id="remove"
                                                        @click="deleteNomination(stf.id)"> Delete</button> -->
                                                    <button v-if="stf.status!='Pending'" type="button" class="btn btn-flat btn-sm btn-primary pt-0 pb-1" id="open"
                                                        @click="checkfeedback(stf.id)"> Open</button>
                                                </td>
                                            </template>
                                        </tr>
                                    </tbody>
                                </table>
                                <span class="text-danger" id="feedbackNomineesList_err"></span>
                            </div>
                        </div>
                        <div class="row form-group" v-if="form.current_status=='Shortlisted' && form.feedback==1">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Details for Feedback Provider:</label>
                                <textarea class="form-control" :class="{ 'is-invalid': form.errors.has('reason') }" v-model="form.feedback_details" id="feedback_details"></textarea>
                                <has-error :form="form" field="feedback_details"></has-error>
                            </div>
                        </div>
                    </div>
                    <!-- Verification Attachments and remarks -->
                    <div class="callout callout-info">
                        <h4><u>Remarks & Attachments (If any)</u></h4>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>File Name</th>
                                            <th>Upload File</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <tr v-for='(attach,count) in applicationdetailsatt' :key="count+1">
                                            <template v-if="attach.attachment_for=='Leadership Selection'">
                                                <td>{{attach.user_defined_name}} </td>
                                                <td>  {{attach.original_name}}</td>
                                                <td>
                                                    <a href="#" @click="openfile(attach)" class="fa fa-eye"> View</a>
                                                </td>
                                            </template>
                                        </tr>

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
                        <div class="alert alert-danger alert-dismissible" v-if="feedback_pending">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            Note: Some of the Feedback Provider did not submitted thier feedback.
                        </div>
                        <div class="row" v-if="feedback_status=='Completed' && form.current_status!='Interviewed'">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Interview Date:<span class="text-danger">*</span></label>
                                <input type="date" class="form-control" @change="remove_error('interniew_date')" :class="{ 'is-invalid': form.errors.has('interniew_date') }"  name="interniew_date" id="interniew_date" v-model="form.interniew_date">
                                <has-error :form="form" field="interniew_date"></has-error>
                                <span class="text-danger" id="interniew_date_err"></span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Interview Score:<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" @change="remove_error('interniew_score')" :class="{ 'is-invalid': form.errors.has('interniew_score') }"  name="interniew_score" id="interniew_score" v-model="form.interniew_score">
                                <has-error :form="form" field="interniew_score"></has-error>
                                <span class="text-danger" id="interniew_score_err"></span>
                            </div>
                        </div>
                        <div class="row" v-if="form.current_status=='Interviewed'">
                           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Interview Date:</label>
                                <span class="text-blue text-bold">{{form.interniew_date}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Interview Score:</label>
                                <span class="text-blue text-bold">{{form.interniew_score}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0">Remarks</label>
                                <textarea class="form-control" @change="remove_error('remarks')" v-model="form.verification_remarks" id="remarks"></textarea>
                                <span class="text-danger" id="remarks_err"></span>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <!-- Action Buttons -->
                    <div class="row form-group fa-pull-right">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-info text-white" @click="shownexttab('feedback')" v-if="form.current_status=='Submitted' && form.feedback==1"> <i class="fa fa-save"></i> Send Notification </button>
                            <button class="btn btn-info text-white" @click="shownexttab('shortlist')" v-if="form.current_status=='Notified for Feedback' && form.shortlist==1"> <i class="fa fa-save"></i> Shortlist </button>
                            <button class="btn btn-primary" @click="shownexttab('interview')" v-if="form.current_status=='Shortlisted' && form.interview==1 && feedback_status=='Completed'"> <i class="fa fa-check"></i> Update Interview </button>
                            <button class="btn btn-primary" @click="shownexttab('select')" v-if="form.current_status=='Interviewed'"> <i class="fa fa-save"></i> Select </button>
                            <button class="btn btn-danger" id="rejectbtn" @click="shownexttab('reject')"> <i class="fa fa-times"></i> Reject </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade show" id="add_modal" aria-modal="true" style="padding-right: 17px;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Feedback</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="bootbox-form">
                            <div class="form-group row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label>Participating From:<span class="text-danger">*</span></label>
                                    <input type="radio" v-model="form.partifipant_from" @change="showSearch('External')" :class="{ 'is-invalid' :form.errors.has('partifipant_from') }" name="partifipant_from" id="partifipant_from" :value="'External'">
                                    <label class="pr-3"> External </label>
                                    <input type="radio" v-model="form.partifipant_from" @change="showSearch('Ministry')" :class="{ 'is-invalid' :form.errors.has('partifipant_from') }" name="partifipant_from" id="partifipant_from0" :value="'Ministry'">
                                    <label class="pr-3"> Ministry </label>
                                    <input type="radio" v-model="form.partifipant_from" @change="showSearch('Dzongkhag')" :class="{ 'is-invalid' :form.errors.has('partifipant_from') }" name="partifipant_from" id="partifipant_from1" :value="'Dzongkhag'">
                                    <label class="pr-3"> Dzongkhag Head Quarters </label>
                                    <input type="radio" v-model="form.partifipant_from" @change="showSearch('School')" :class="{ 'is-invalid' :form.errors.has('partifipant_from') }" name="partifipant_from" id="partifipant_from2" :value="'School'">
                                    <label class="pr-3"> Schools </label>
                                    <span class="text-danger" id="partifipant_from_err"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="dzongkhag_section" style="display:none">
                                    <label>Dzongkhag:<span class="text-danger">*</span></label>
                                    <select class="form-control select2" v-model="form.dzongkhag" @change="remove_error('dzongkhag')" name="dzongkhag" id="dzongkhag">
                                        <option value="">- Please Select -</option>
                                        <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                    </select>
                                    <span class="text-danger" id="dzongkhag_err"></span>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="department_section" style="display:none">
                                    <label>Department:<span class="text-danger">*</span></label>
                                    <select class="form-control select2" v-model="form.department" @change="remove_error('department')" name="department" id="department">
                                        <option value="">- Please Select -</option>
                                        <option v-for="(item, index) in department_list" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                    </select>
                                    <span class="text-danger" id="department_err"></span>
                                </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="school_section" style="display:none">
                                    <label id="levelName">Organization:<span class="text-danger">*</span></label>
                                    <select class="form-control select2" v-model="form.school" @change="remove_error('school')" name="school" id="school">
                                        <option value="">- Please Select -</option>
                                        <option v-for="(item, index) in school_list" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                    </select>
                                    <span class="text-danger" id="school_err"></span>
                                </div>
                            </div>

                            <!-- <div class="form-group row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="display:none" id="dzongkhag_section">
                                    <label>Dzongkhag:<span class="text-danger">*</span></label>
                                    <select class="form-control select2" v-model="selectstaff.dzongkhag" @change="remove_error('dzongkhag')" name="dzongkhag" id="dzongkhag">
                                        <option value="">- Please Select -</option>
                                        <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                    </select>
                                    <span class="text-danger" id="dzongkhag_err"></span>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="display:none" id="school_section">
                                    <label>School:<span class="text-danger">*</span></label>
                                    <select class="form-control select2" v-model="selectstaff.school" @change="remove_error('school')" name="school" id="school">
                                        <option value="">- Please Select -</option>
                                        <option v-for="(item, index) in school_list" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                    </select>
                                    <span class="text-danger" id="school_err"></span>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="display:none" id="department_section">
                                    <label>Department/Division:<span class="text-danger">*</span></label>
                                    <select class="form-control select2" v-model="selectstaff.department" @change="remove_error('school')" name="department" id="department">
                                        <option value="">- Please Select -</option>
                                        <option v-for="(item, index) in department_list" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                    </select>
                                    <span class="text-danger" id="department_err"></span>
                                </div>
                            </div> -->
                            <div class="form-group row" style="display:none" id="select_staff_section">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label>Nominee:<span class="text-danger">*</span></label>
                                    <select class="form-control select2" @change="remove_error('participant'),getdetails()" name="participant" id="participant" v-model="selectstaff.participant">
                                        <option value="">- Please Select -</option>
                                        <option v-for="(item, index) in staff_list" :key="index" v-bind:value="item.id+'_'+item.cid_work_permit+'_'+item.name+'_'+item.contact_no+'_'+item.email+'_'+item.position_title_name"> {{ item.emp_id }}, {{ item.name }},{{ item.position_title_name }}</option>
                                    </select>
                                    <span class="text-danger" id="participant_err"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label>Feedback Category:<span class="text-danger">*</span></label>
                                    <select class="form-control select2" @change="remove_error('feedback_type_err')" name="feedback_type" id="feedback_type" v-model="selectstaff.feedback_type">
                                        <option value="">- Please Select -</option>
                                        <option v-for="(item, index) in feedbackCategory" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                    </select>
                                    <span class="text-danger" id="feedback_type_err"></span>
                                </div>
                            </div>
                            <div class="form-group row" style="display:none" id="outofministry_section">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>CID:<span class="text-danger">*</span></label>
                                    <input type="text" @change="remove_error('cid')" v-model="selectstaff.cid" :class="{ 'is-invalid': selectstaff.errors.has('cid') }" name="cid" id="cid" class="form-control">
                                    <has-error :form="selectstaff" field="cid"></has-error>
                                    <span class="text-danger" id="cid_err"></span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Name:<span class="text-danger">*</span></label>
                                    <input type="text" @change="remove_error('name')" v-model="selectstaff.name" :class="{ 'is-invalid': selectstaff.errors.has('name') }" name="name" id="name" class="form-control">
                                    <has-error :form="selectstaff" field="name"></has-error>
                                    <span class="text-danger" id="name_err"></span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Position Title:<span class="text-danger">*</span></label>
                                    <input type="text" @change="remove_error('positiontitle_err')" v-model="selectstaff.positiontitle" :class="{ 'is-invalid': selectstaff.errors.has('positiontitle') }" name="positiontitle" id="positiontitle" class="form-control">
                                    <has-error :form="selectstaff" field="positiontitle"></has-error>
                                    <span class="text-danger" id="positiontitle"></span>
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

        <div class="modal fade show" id="feedback_modal" aria-modal="true" style="padding-right: 17px;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Feedback Details</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                feedback_details
                                <div class="callout callout-success">
                                    <span><label><u>Feedback Provider Detial</u></label></span>
                                    <div class="row form-group">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Last Date for Feedback:</label><br>
                                            <span class="text-blue text-bold">{{ feedback_details.cid }}</span>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Name:</label><br>
                                            <span class="text-blue text-bold">{{feedback_details.name}}</span>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Position:</label><br>
                                            <span class="text-blue text-bold">{{feedback_details.positiontitle }}</span>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Feedback Category:</label><br>
                                            <span class="text-blue text-bold">{{ feedbackCategoryArray[feedback_details.feedback_type] }}</span>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Contact No:</label><br>
                                            <span class="text-blue text-bold">{{feedback_details.contact}}</span>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Email:</label><br>
                                            <span class="text-blue text-bold">{{feedback_details.email }}</span>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row form-group">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <table id="waterTable" class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <thead>
                                                    <tr>
                                                        <th style="width:5%">Sl#</th>
                                                        <th style="width:55%">Question</th>
                                                        <th style="width:40%">Answers</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(item, index) in feedback_form.questionList" :key="index">
                                                        <td>{{ index+1}}</td>
                                                        <td>{{ item.name}}</td>
                                                        <td v-if="item.answer_type=='TextArea'">
                                                            <textarea class="form-control" disabled :name="'answer_textarea'+index" v-model="item.answered" :id="item.id" ></textarea>
                                                        </td>
                                                        <td v-if="item.answer_type=='Text'">
                                                            <input class="form-control" disabled :name="'answer_text'+index" type="text" v-model="item.answered" :id="item.id">
                                                        </td>

                                                        <td v-if="item.answer_type=='Number'">
                                                            <input class="form-control" disabled :name="'answer_number'+index" type="number" v-model="item.answered" :id="item.id" >
                                                        </td>

                                                        <td v-if="item.answer_type=='Radio'">
                                                            <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <span v-for="(ans, index1) in item.answers" :key="index1">
                                                                    <input type="radio" disabled :name="'answer_radio'+index" v-model="ans.answered" :id="item.id+'_'+ans.id" class="ml-4" :value="ans.id"> <label>  {{ans.name}} </label>
                                                                </span>
                                                            </div>
                                                        </td>

                                                        <td v-if="item.answer_type=='Dropdown'">
                                                            <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <select name="category" disabled v-model="item.answered" :id="item.id" class="form-control">
                                                                    <option value="">--- Please Select ---</option>
                                                                    <option v-for="(item, index) in item.answers" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                                </select>
                                                            </div>
                                                        </td>

                                                        <td v-if="item.answer_type=='Checkbox'">
                                                            <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <span v-for="(ans, index1) in item.answers" :key="index1">
                                                                    <input type="checkbox" disabled :name="'answer_check'+index" v-model="ans.answered" :id="item.id+'_'+ans.id" class="ml-4" :value="ans.id">
                                                                    <label>{{ans.name}} </label>
                                                                </span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-right">
                        <button data-bb-handler="cancel" type="button" data-dismiss="modal" class="btn btn-danger">Cancel</button>
                        <button data-bb-handler="confirm" @click="updatedVisited(feedback_details.id)" type="button" class="btn btn-primary">visited</button>
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
            feedback_status:'Completed',
            feedback_pending:false,
            count:0,
            positionList:{},
            roleList:{},
            post_detail:'',
            staff_list:[],
            department_list:[],
            school_list:[],
            dzongkhagList:[],
            feedbackCategory:[],
            feedbackCategoryArray:{},
            applicationdetailsatt:'',
            feedbackNomineesList:[],
            feedback_details:'',
            questionList:[],
            selectionListArray:{},
            feedback_form: new form({
                questionList:[],
            }),
            selectstaff: new form({
                nominees:[],
                application_number:'',
                partifipant_from:'',
                email:'',
                contact:'',
                participant:'',
                positiontitle:'',
                cid:'',
                name:'',
                department:'',
                school:'',
                dzongkhag:'',
                feedback_type:'',
                action_type:'',
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
                staff_id:'',
                shortlisted_remarks:'',
                aplicant_cid:'',
                aplicant_position_title:'',
                aplicant_working_agency:'',
                aplicant_working_dzo:'',
                aplicant_working_gewog:'',
                verification_remarks:'',
                feedback_start_date:'',
                feedback_end_date:'',
                feedback_details:'',
                feedback_remarks:'',
                interniew_score:'',
                interniew_date:'',
                current_status:'',
                attachments:
                [{
                    file_name:'',attachment:''
                }],
                ref_docs:[],
                feedbackNomineesList:[],
                action_type:'',
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
            this.selectstaff.action_type='add';
            this.resetmodel();
            $('#add_modal').modal('show');
        },
        resetmodel(){
            $('#dzongkhag').val('').trigger('change');
            this.selectstaff.dzongkhag='';
            $('#school').val('').trigger('change');
            this.selectstaff.school='';
            $('#department').val('').trigger('change');
            this.selectstaff.department='';
            this.selectstaff.positiontitle='';
            $('#participant').val('').trigger('change');
            this.selectstaff.participant='';
            $('#feedback_type').val('').trigger('change');
            this.selectstaff.feedback_type='';
            $('#cid').val('');
            this.selectstaff.cid='';
            $('#name').val('');
            this.selectstaff.name='';
            $('#email').val('');
            this.selectstaff.email='';
            $('#contact').val('');
            this.selectstaff.contact='';
        },
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },
        async showSearch(type){
            // $("#dzongkhag_section").hide();
            // $("#school_section").hide();
            // $("#department_section").hide();
            // $("#select_staff_section").hide();
            // $("#outofministry_section").hide();
            // if(type=="School"){
            //     $("#dzongkhag_section").show();
            //     $("#school_section").show();
            // }
            // if(type=="Dzongkhag"){
            //     this.getDzongkhagHeadQuarterList('all_dzongkhag_headquarters');
            //     $("#dzongkhag_section").show();
            // }
            // if(type=="Ministry"){
            //     this.getDzongkhagHeadQuarterList('all_ministry_headquarters');
            //     $("#department_section").show();
            // }
            // if(type=="outofministry"){
            //     $("#outofministry_section").show();
            // }
            // else{
            //     $("#select_staff_section").show();
            // }
            $('#dzongkhag_section').hide();
            $('#school_section').hide();
            $('#department_section').hide();
            $('#outofministry_section').hide();
            $('#select_staff_section').hide();
            if(type=="School"){
                $('#dzongkhag_section').show();
                $('#school_section').show();
            }
            if(type=="Dzongkhag"){
                 this.department_list=await this.getDepartmentListbydzo('DzongkhagHeadquarter','All');
                // this.getDzongkhagHeadQuarterList('all_dzongkhag_headquarters');
                $('#department_section').show();
                $('#select_staff_section').show();
            }
            if(type=="Ministry"){
                this.department_list=await this.getDepartmentListbydzo('Ministry',14);
                // this.getDzongkhagHeadQuarterList('all_ministry_headquarters');
                $('#department_section').show();
                $('#select_staff_section').show();
            }
            if(type=="External"){
                $('#outofministry_section').show();
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
        // loadStaffList(id,type){
        //     let uri="";
        //     if(id=="NA"){
        //         uri='loadCommons/loadStaffList/userOrgWiseCivilServent/ALL_TYPE';
        //     }
        //     else{
        //         uri='loadCommons/loadStaffList/'+type+'/'+id;
        //     }
        //     axios.get(uri)
        //     .then((response) => {
        //         let data=response.data.data;
        //         this.staff_list=data;
        //     })
        //     .catch((error) => {
        //         console.log("Error:"+error);
        //     });
        // },
        loadPositionTitleList(uri = 'staff/loadStaffMasters/active/PositionTitle'){
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
                this.form.staff_id=data.staff_id;
                this.form.aplicant_cid=data.aplicant_cid;
                this.form.aplicant_position_title=data.aplicant_position_title;
                this.form.aplicant_working_agency=data.aplicant_working_agency;
                this.form.aplicant_working_dzo=data.aplicant_working_dzo;
                this.form.aplicant_working_gewog=data.aplicant_working_gewog;
                this.form.application_number=data.application_number;
                this.form.application_date=data.created_at;
                this.form.post_id=data.post_id;
                this.form.current_status=data.status;
                this.form.shortlisted_remarks=data.shortlisted_remarks;
                this.form.feedback=data.Post_details.feedback;
                this.form.interview=data.Post_details.interview;
                this.form.shortlist=data.Post_details.shortlist;
                this.form.feedback_start_date=data.feedback_start_date;
                this.form.feedback_end_date=data.feedback_end_date;
                this.form.feedback_remarks=data.feedback_remarks;
                this.form.feedback_details=data.feedback_details;
                this.applicationdetailsatt=data.attachments;
                this.form.interniew_score=data.interniew_score;
                this.form.interniew_date=data.interniew_date;
            })
            .catch((error) =>{
                console.log("Error: "+error);
            });
        },
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            // if(id=="dzongkhag"){
            //     this.selectstaff.dzongkhag=$('#dzongkhag').val();
            //     this.getSchoolList($('#dzongkhag').val());
            // }
            // if(id=="department"){
            //     this.selectstaff.department=$('#department').val();
            //     this.loadStaffList($('#department').val(),'dzo_hq_departmentwise');
            // }
            // if(id=="school"){
            //     this.selectstaff.school=$('#school').val();
            //     this.loadStaffList($('#school').val(),'orgwise');
            // }
            if(id=="dzongkhag"){
                this.school_list=[];
                this.form.dzongkhag=$('#dzongkhag').val();
                this.school_list=await this.schoolList($('#dzongkhag').val());
                // this.getSchoolList($('#dzongkhag').val());
            }
            if(id=="department"){
                this.school_list=[];
                this.form.department=$('#department').val();
                if($('#department').val()!=""){
                    $('#levelName').html('Division');
                    this.school_list=await this.getdivisionList($('#department').val());
                    $('#school_section').show();
                }
            }
            if(id=="school"){
                this.staff_list=[];
                this.form.school=$('#school').val();
                this.staff_list=await this.staffOrgwise($('#school').val());
                $("#select_staff_section").show();
            }
            if(id=="participant"){
                let valu=$('#participant').val();
                this.selectstaff.participant=valu.split('_')[0];
                this.selectstaff.name=valu.split('_')[2];
                this.selectstaff.cid=valu.split('_')[1];
                this.selectstaff.email=valu.split('_')[4];
                this.selectstaff.contact=valu.split('_')[3];
                this.selectstaff.positiontitle=valu.split('_')[5];
            }
            if(id=="feedback_type"){
                this.selectstaff.feedback_type=$('#feedback_type').val();
            }

        },
        loadcategoryList(uri = 'staff/staffLeadershipSerivcesController/loadData/activeData_FeedbackCategory'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.feedbackCategory =  data;
                for(let i=0;i<data.length;i++){
                    this.feedbackCategoryArray[data[i].id] = data[i].name;
                }
            })
            .catch(function (error){
                console.log(error);
            });
        },
        validateaddform(){
            let retval=true;
            // if($("input[type='radio'][name='partifipant_from']:checked").val()!="outofministry" && $('#participant').val()==""){
            //     $('#participant_err').html('Please select participant');
            //     $('#participant').focus();
            //     $('#participant').addClass('is-invalid');
            //     retval=false;
            // }

            if($('#contact').val()==""){
                $('#contact_err').html('mention contact number');
                $('#contact').focus();
                $('#contact').addClass('is-invalid');
                retval=false;
            }
            if($('#email').val()==""){
                $('#email_err').html('mention email');
                $('#email').focus();
                $('#email').addClass('is-invalid');
                retval=false;
            }

            if($("input[type='radio'][name='partifipant_from']:checked").val()==undefined){
                $('#nature_of_participant_err').html('this field is requred');
                $('#partifipant_from').addClass('is-invalid');
                retval=false;
            }

            if($("input[type='radio'][name='partifipant_from']:checked").val()=="External"){
                if($('#positiontitle').val()==""){
                    $('#positiontitle_err').html('mention position title');
                    $('#positiontitle').focus();
                    $('#positiontitle').addClass('is-invalid');
                    retval=false;
                }
                if($('#name').val()==""){
                    $('#name_err').html('mention name');
                    $('#name').focus();
                    $('#name').addClass('is-invalid');
                    retval=false;
                }
                if($('#cid').val()==""){
                    $('#cid_err').html('mention cid');
                    $('#cid').focus();
                    $('#cid').addClass('is-invalid');
                    retval=false;
                }
            }
            if($('#feedback_type').val()==""){
                $('#feedback_type_err').html('mention email');
                $('#feedback_type').focus();
                $('#feedback_type').addClass('is-invalid');
                retval=false;
            }
            return retval;
        },
        addrecords(){
            if(this.validateaddform()){
                this.selectstaff.partifipant_from=$("input[type='radio'][name='partifipant_from']:checked").val();
                this.selectstaff.selectionFor=$("#selectionfor").val();
                this.selectstaff.applicant=$("#applicant").val();
                this.selectstaff.post('/staff/staffLeadershipSerivcesController/saveFeedbackProviderData',this.selectstaff)
                .then((response) =>{
                    this.form.id=response.data.data.id;
                    Toast.fire({
                        icon: 'success',
                        title: 'Data Saved Successfully'
                    });
                    this.loadexistingfeedbackprovider(this.selectstaff.application_number);
                    $('#add_modal').modal('hide');
                    $('#feedbackNomineesList_err').html('');
                })
                .catch((error) => {
                    console.log("Errors:"+error)
                });
            }
        },

        loadexistingfeedbackprovider(appNo){
            axios.get('/staff/staffLeadershipSerivcesController/getFeedbackProviderData/'+appNo)
            .then(response =>{
                this.form.feedbackNomineesList=[];
                let data = response.data;
                this.feedbackNomineesList=data;
                this.form.feedbackNomineesList=data;
                data.forEach(itm => {
                    if(itm.status!='Visited' && itm.status=="Submitted"){
                        this.feedback_status='Under Process';
                    }
                    if(itm.status=="Pending" && this.form.status!="Submitted"){
                        this.feedback_pending=true;
                        this.feedback_status='Under Process';
                    }
                });
                if(data.length<1){
                    this.feedback_status='UnderProcess';
                }
            })
            .catch(function (error){
                console.log('error loadexistingfeedbackprovider: '+error);
            });
        },
        deleteNomination(id){
            Swal.fire({
                text: "Are you sure you wish to delete record ?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
                }).then((result) => {
                if(result.isConfirmed){
                   axios.get('/staff/staffLeadershipSerivcesController/deleteNomination/'+id)
                    .then(response =>{
                        this.loadexistingfeedbackprovider(this.selectstaff.application_number);
                    })
                    .catch(function (error){
                        console.log(error);
                    });
                }
            });
        },
        checkfeedback(id){
            axios.get('/staff/staffLeadershipSerivcesController/getFeedbackData/'+id)
            .then(response =>{
                let data = response.data;
                this.feedback_details=data;
                this.loadFeedbackQuestion(data.feedback_type,this.post_detail.selection_type,data.answers);
                $('#feedback_modal').modal('show');
            })
            .catch(function (error){
                console.log(error);
            });
        },
        validateVerificationForm(type){
            let returntype=true;
            if(type=="feedback"){
                if($('#feedback_end_date').val()==""){
                    $('#feedback_end_date_err').html('Please mention feedback end date');
                    returntype=false;
                }
                if($('#feedback_start_date').val()==""){
                    $('#feedback_start_date_err').html('Please mention feedback start date');
                    returntype=false;
                }
                if($('#feedbackNomineesList').val()==""){
                    $('#feedbackNomineesList_err').html('Please mention feedback provider');
                    returntype=false;
                }
            }
            if(this.feedback_status=="Completed"){
                if($('#interniew_date').val()==""){
                    $('#interniew_date_err').html('Please mention Interview Date');
                    returntype=false;
                }
                if($('#interniew_score').val()==""){
                    $('#interniew_score_err').html('Please mention Interview Score');
                    returntype=false;
                }
            }
            return returntype;
        },
        shownexttab(type){
            if(this.validateVerificationForm(type)){
                this.form.action_type=type;
                let message="";
                if(type=="shortlist"){
                    message="Shortlist this applicant";
                }
                if(type=="feedback"){
                    message="Send Notification to mentioned feedback providers";
                }
                if(type=="reject"){
                    message="Reject this application";
                }

                if(type=="interview"){
                    message="Update for Interview for this application";
                }
                if(type=="select"){
                    message="Select this applicant";
                }

                Swal.fire({
                    text: "Are you sure you wish to "+message,
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    cancelButtonText:'No',
                    }).then((result) => {
                    if(result.isConfirmed){
                        const config = {
                            headers: {
                                'content-type': 'multipart/form-data'
                            }
                        }
                        let formData = new FormData();
                        formData.append('id', this.form.id);
                        formData.append('staff_id', this.form.staff_id);
                        formData.append('application_number', this.form.application_number);
                        formData.append('application_date', this.form.application_date);
                        formData.append('selection_type', this.form.selection_type);
                        formData.append('position_title', this.form.position_title);
                        formData.append('from_date', this.form.from_date);
                        formData.append('to_date', this.form.to_date);
                        formData.append('feedback', this.form.feedback);
                        formData.append('interview', this.form.interview);
                        formData.append('shortlist', this.form.shortlist);
                        formData.append('details', this.form.details);
                        formData.append('aplicant_cid', this.form.aplicant_cid);
                        formData.append('aplicant_position_title', this.form.aplicant_position_title);
                        formData.append('aplicant_working_agency', this.form.aplicant_working_agency);
                        formData.append('aplicant_working_dzo', this.form.aplicant_working_dzo);
                        formData.append('aplicant_working_gewog', this.form.aplicant_working_gewog);
                        formData.append('verification_remarks', this.form.verification_remarks);
                        formData.append('feedback_start_date', this.form.feedback_start_date);
                        formData.append('feedback_end_date', this.form.feedback_end_date);
                        formData.append('feedback_details', this.form.feedback_details);
                        formData.append('current_status', this.form.current_status);
                        formData.append('action_type', this.form.action_type);
                        formData.append('interniew_date', this.form.interniew_date);
                        formData.append('interniew_score', this.form.interniew_score);

                        formData.append('ref_docs[]', this.form.ref_docs);
                        for(let i=0;i<this.form.ref_docs.length;i++){
                            formData.append('attachments[]', this.form.ref_docs[i].attach);
                            formData.append('attachmentname[]', this.form.ref_docs[i].name);
                        }

                        for(let i=0;i<this.form.feedbackNomineesList.length;i++){
                            formData.append('feedbackNomineesList[]', this.form.feedbackNomineesList[i].attach);
                        }

                        axios.post('staff/staffLeadershipSerivcesController/verifyApproveNotify', formData, config)
                        // this.form.post('/staff/staffLeadershipSerivcesController/verifyApproveNotify')
                        .then(response =>{
                             if(response!=""){
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Application details has been updated.'
                                });
                                this.$router.push({path:'/tasklist'});
                            }
                        })
                        .catch(function (error){
                            console.log(error);
                        });
                    }
                });
            }
        },

        //loadFeedback qeustion according to the type and position
        async loadFeedbackQuestion(feedback_category_id,leadership_selection_id,ans_data){
            axios.get('staff/staffLeadershipSerivcesController/loadData/allQuestionUnderCat_Question_'+feedback_category_id+'_'+leadership_selection_id)
            .then(response => {
                let data = response.data.data;
                this.feedback_form.questionList=data;
                if(this.feedback_form.questionList!=null && this.feedback_form.questionList!="" && ans_data.length>0){
                    //set time interval so that question can populate and then respective answer can be shown
                    setInterval(function(){
                       for(let i=0;i<ans_data.length;i++){
                            if(ans_data[i].ans_type=="Checkbox" || ans_data[i].ans_type=="Radio"){
                                $('#'+ans_data[i].questionId+'_'+ans_data[i].answer).prop('checked',true);
                            }
                            else if(ans_data[i].ans_type=="Text" || ans_data[i].ans_type=="Number" ||
                            ans_data[i].ans_type=="TextArea" || ans_data[i].ans_type=="Dropdown"){
                                $('#'+ans_data[i].questionId).val(ans_data[i].answer);
                            }
                            else{
                                $('#'+ans_data[i].questionId+'_'+ans_data[i].answer).val(ans_data[i].answer);
                            }
                        }
                    }, 500);
                }
            })
            .catch(function (error){
                console.log('err: '+error);
            });
        },

        //get position details to populate form
        getSelectionList(uri = 'staff/staffLeadershipSerivcesController/loadData/activeData_LeadershipType'){
            axios.get(uri)
            .then(response => {
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.selectionListArray[data.data.data[i].id] = data.data.data[i].name;
                }
            })
            .catch(function (error){
                console.log('err: '+error);
            });
        },
        updatedVisited(itmId){
            axios.get('staff/staffLeadershipSerivcesController/updatedVisited/'+itmId)
            .then(response => {
                let data = response.data;
                this.loadexistingfeedbackprovider(this.selectstaff.application_number);
                $('#feedback_modal').modal('hide');
            })
            .catch(function (error){
                console.log('err: '+error);
            });
        }
    },
    created(){
        $('[data-toggle="tooltip"]').tooltip();

    },
    mounted(){
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
        this.loadcategoryList();
        this.loadroleList();
        this.loadPositionTitleList();
        this.loadactivedzongkhagList();
        this.getSelectionList();
        this.form.application_number=this.$route.params.data.application_number;
        this.selectstaff.application_number=this.$route.params.data.application_number;
        this.loadApplicationDetils(this.$route.params.data.application_number,this.$route.params.type);
        this.loadexistingfeedbackprovider(this.selectstaff.application_number);
    },

}
</script>
