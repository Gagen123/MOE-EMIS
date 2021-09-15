<template>
    <div>
        <ol class="mb-1 ml-xl-n3 mr-xl-n2 pl-3" style="background-color:#E5E5E5">
            <li class="pl-2 form-inline "><h6 class="pt-1">New Establishment Application Verification/Approval</h6></li>
        </ol>
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
                        <div class="callout callout-success">
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
                                <button class="btn btn-success" @click="shownexttab('file-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
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
import Workflow from "../../common/view_workflow_details";
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
            axios.get('organization/loadTeamVerificationList/'+this.search.id)
            .then(response => {
                let data = response.data.data;
                this.searchProviderList=data;
            })
            .catch(errors => {
                console.log(errors)
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
        addMoreagency: function(type){
            if(type=="org_id"){
                this.form.verifying_agency_list.push({department:'', division:''})
            }else{
                this.form.final_verifying_agency_list.push({department:'', division:''})
            }
        },
        /**
         * method to remove fields
         */
        removeagency(type){
            if(type=="org_id"){
                this.form.verifying_agency_list.pop();
            }else{
                this.form.final_verifying_agency_list.pop();
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

        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
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
        getEmpDetails(type){
            this.search.staff_id="";
            $('#staff_id').val('').trigger('change');
            this.search.staff_type="";
            $('#staff_type').val('').trigger('change');
            this.search.type=type;
            $('#search-modal').modal('show');
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
                    if(this.form.tentative_date==""){
                        $('#tentative_date_err').html('Please provide date');
                        $('#tentative_date').addClass('is-invalid');
                        action=false;
                    }
                    if(this.form.verifying_agency==""){
                        $('#verifying_agency_err').html('Please provide this field');
                        $('#verifying_agency').addClass('is-invalid');
                        action=false;
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
                            //update_type will be replaced when deo/teo update reports
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
        applyselect2(){

        },
    },
    async mounted(){
        axios.get('organizationApproval/loadEstbDetailsForVerification/'+this.$route.params.data.application_number+'/'+this.$route.params.type)
        .then((response) => {
            let data=response.data.data;
            this.applicationdetails=data;
            this.taskDet=response.data.app_stage;
            this.applicationOrgdetails=data.org_details;
            if(this.applicationdetails.org_level.toLowerCase().includes('higher')){
                this.streamSection=true;
            }
            if(data.attachments!=undefined && data.attachments!=""){
                this.app_attachments=data.attachments;
            }
            this.class_section=data.org_class_stream;
            this.form.applicationNo=data.application_no;

            this.form.servicename=data.establishment_type;
            this.form.id=data.id;
            this.search.id=data.id;

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

            axios.get('organizationApproval/getScreenId/'+this.taskDet.service_name+'__'+status_id)
            .then(response => {
                let data = response.data.data;
                if(data!=undefined && data!="NA"){
                    this.screenId=data.screen;
                    this.SysRoleId=data.SysRoleId;
                    this.Sequence=data.Sequence;
                    this.Status_Name=data.Status_Name;
                    $('#attname').html(data.Name);
                    alert(data.Name.replaceAll(" ", "_"));
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
            let meals="";
            if(data.org_details.isFeedingSchool==1){
                this.isFeeding=1;
                for(let i=0;i<data.feeding_modality.length;i++){
                    if(data.feeding_modality[i].noOfMeals!=undefined){
                        if(data.feeding_modality[i].noOfMeals==1){
                            meals+='One Meal, ';
                        }
                        if(data.feeding_modality[i].noOfMeals==2){
                            meals+='Two Meal,';
                        }
                        if(data.feeding_modality[i].noOfMeals==3){
                            meals+='Three Meal';
                        }
                        $("#feedingmodal"+data.feeding_modality[i].noOfMeals).prop("checked",true);
                    }
                }
                this.feed_details=meals;
                $('#mealDetails').html(meals);
            }
        })
        .catch((error) => {
            console.log("Error: "+error);
        });

        this.departmentList=await this.getDepartmentListbydzo('Ministry','all_ministry_departments');
    }
}
</script>
