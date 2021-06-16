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
                                    <span class="text-blue text-bold">Establishment of {{applicationdetails.establishment_type}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="callout callout-success">
                            <h5><u>Organization Details</u></h5>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-if="applicationdetails.establishment_type=='Public School' || applicationdetails.establishment_type=='Public ECCD'">
                                    <label class="mb-0">Proposal Initiated By:</label>
                                    <span class="text-blue text-bold">{{proposed_by_list[applicationOrgdetails.initiated_by]}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Proposed Name:</label>
                                    <span class="text-blue text-bold">{{applicationOrgdetails.proposedName}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-if="applicationdetails.establishment_type=='Public School' || applicationdetails.establishment_type=='Private School'">
                                    <label class="mb-0">Level:</label>
                                    <span class="text-blue text-bold">{{levelList[applicationOrgdetails.levelId]}}</span>
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
                                    <span class="text-blue text-bold">{{locationList[applicationOrgdetails.locationId]}}</span>
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
                            <div v-if="applicationdetails.establishment_type=='Private School' || applicationdetails.establishment_type=='Private ECCD'">
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
                                <div class="form-group row">
                                   <!-- <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0">Total Area of Land Proposed:</label>
                                        <span class="text-blue text-bold">{{applicationdetails.org_details.totalLand}}</span>
                                    </div> -->
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0">Type of School:</label>
                                        <span class="text-blue text-bold">{{ applicationdetails.org_details.typeOfSchool  == 1 ? "Day" :  "Boarding"}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row pb-2">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <h5><u>Attachments</u></h5>
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
                                <button class="btn btn-primary" @click="shownexttab('class-tab')">Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade tab-content-details" id="class-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="callout callout-success">
                            <h4><u>Classes / streams / Age Group</u></h4>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                                <table id="class-table" class="table table-sm table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Classes</th>
                                            <th class="strm_clas">Stream</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, key, index) in  class_section" :key="index">
                                            <td>
                                                <label class="pr-4"> &nbsp;{{ calssArray[item.classId] }} </label>
                                            </td>
                                            <td class="strm_clas" v-if="calssArray[item.classId]=='Class 11' || calssArray[item.classId]=='XI' || calssArray[item.classId]=='Class 12' || calssArray[item.classId]=='XII'">
                                                {{  streamArray[item.streamId]  }}
                                            </td>
                                            <td class="strm_clas" v-else>

                                            </td>
                                            <td v-if="item.class=='Class 11' || item.class=='XI' || item.class=='Class 12' || item.class=='XII'">
                                                <input type="checkbox" v-model="classStreamForm.stream"  :id="item.id" :value="item.id" disabled>
                                            </td>
                                            <td v-else>
                                                <input type="checkbox" checked="true" disabled>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                                    <span v-for="(item, index) in  class_section" :key="index">
                                        <br>
                                        <input type="checkbox" checked="true"><label class="pr-4">
                                         &nbsp;{{ calssArray[item.classId] }}<span v-if="item.streamId"> - {{ streamArray[item.streamId] }}</span> </label>
                                    </span>
                                </div>  -->
                            </div>
                        </div>
                        <div class="callout callout-success">
                            <h4><u>Site Visit and Verification Details</u></h4>
                            <div class="row form-group">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Tentative Date:</label>
                                    <input type="date" name="tentative_date" v-model="form.tentative_date" id="tentative_date" class="form-control">
                                    <span class="text-danger" id="tentative_date_err"></span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pt-4 mt-2" id="btnstentative">
                                    <button type="button" class="btn btn-flat btn-sm btn-primary"
                                    @click="addMoreagency()"><i class="fa fa-plus"></i> Add More Agency</button>
                                    <button type="button" class="btn btn-flat btn-sm btn-danger"
                                    @click="removeagency()"><i class="fa fa-trash"></i> Remove</button>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-for='(agent, index) in form.verifying_agency_list' :key="index">
                                    <label>Verifying Agency:</label>
                                    <input type="text" name="verifying_agency" v-model="form.verifying_agency[index]" :id="'verifying_agency'+index" class="form-control">
                                    <span class="text-danger" id="verifying_agency_err"></span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-for='(agent, index) in form.verifying_agency_verified_list' :key="index">
                                    <label>Verifying Agency:</label>
                                    <input type="text" name="verifying_agency" v-model="agent.verifying_agency" readonly class="form-control">
                                </div>
                             </div>
                            <div class="row pb-2" style="display:none" id="tentativeAttachment">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <h5><u>Attachments</u></h5>
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
                                </div>
                            </div>
                            <hr>
                            <div id="verifier_team" style="display:none">
                                <h5><u>Team Verification</u></h5>
                                <div class="row form-group">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-if="showsearch">
                                        <label>Enter the Members CID:</label>
                                        <input type="text" name="emp_deails" id="emp_deails" class="form-control">
                                        <span class="text-danger" id="emp_deails_err"></span>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pt-4 mt-2" v-if="showsearch">
                                        <button type="button" @click="getEmpDetails()" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> Search</button>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pt-4">
                                        <table id="nomination-list-table" class="table table-sm table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>CID/Passport</th>
                                                    <th>Position Title</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for='(user, index) in form.nomi_staffList' :key="index">
                                                    <td> {{user.name}}</td>
                                                    <td> {{user.cid}}</td>
                                                    <td> {{user.po_title}}</td>
                                                </tr>
                                                <tr id="removeBtn">
                                                    <td colspan="5">
                                                        <button type="button" class="btn btn-flat btn-sm btn-danger" id="removeId"
                                                        @click="remove('nomination')"><i class="fa fa-trash"></i> Remove</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <span id="nminees_error" class="text-danger"></span>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="row pb-2" style="display:none" id="team_verificationAttachment">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <h5><u>Attachments</u></h5>
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
                                                <template v-if="attach.upload_type=='team_verification'">
                                                    <td>{{attach.user_defined_file_name}} </td>
                                                    <td>  {{attach.name}}</td>
                                                    <td>
                                                        <a href="#" @click="openfile(attach)" class="fa fa-eye"> View</a>
                                                    </td>
                                                </template>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div> -->
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
                                <button class="btn btn-success" @click="shownexttab('organization-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
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
            count:1,
            showsearch:false,
            proprietorList:[],
            class_section:[],
            calssArray:{},
            streamArray:{},
            sectionList:[],
            applicationdetails:[],
            levelList:{},
            proposed_by_list:{},
            locationList:[],
            feeding:[],
            isFeeding:0,
            feed_details:'',
            applicationOrgdetails:{locationTypeId:'', level:'', proposedName:'', initiated_by:''},
            classStreamForm: new form({
                id: '',class:[], stream:[], status:'submitted'
            }),
            form: new form({
                id: '',applicationNo:'',actiontype:'',remarks:'',verifying_agency_verified_list:[],verifying_agency_list:[{verifying_agency:''}],verifying_agency:[],tentative_date:'',update_type:'',servicename:'',
                nomi_staffList:[],fileUpload: [],
                attachments:
                [{
                    file_name:'',attachment:''
                }],
                ref_docs:[],
            }),
        }
    },
    methods:{
        getAttachmentType(type){
            axios.get('masters/organizationMasterController/loadOrganizaitonmasters/'+type+'/DocumentType')
            .then(response => {
                let data = response.data;
                if(data!=null && data!=""){
                    data.forEach((item => {
                        this.count++;
                        this.form.fileUpload.push({file_name:item.name, file_upload:''})
                    }));
                }
            })
            .catch(errors => {
                console.log(errors)
            });
        },
        loadestablishmentapplicationdetails(appId,type){
            $('.strm_clas').hide();
            axios.get('organization/loadEstbDetailsForVerification/'+appId+'/'+type)
            .then((response) => {
                let data=response.data.data;
                this.form.applicationNo=data.application_no;
                this.form.servicename=data.establishment_type;
                this.form.id=data.id;
                this.applicationdetails=data;
                this.applicationOrgdetails=data.org_details;
                this.class_section=data.org_class_stream;
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
                if(response.data.app_stage.toLowerCase().includes('verifi')){
                    $('#verifyId').show();
                }
                if(response.data.app_stage.toLowerCase().includes('approve')){
                    $('#approveId').show();
                }
                if(data.app_verification==null){
                    //tentative document
                    this.getAttachmentType('ForTransaction__Tentative_Date_for_Public');
                    $('#update_btn_level').html('Notify For Tentative Date');
                    this.form.update_type='tentative';
                    $('#updateBtn').show();
                    $('#verifyId').hide();
                    $('#approveId').hide();
                }
                else{
                    $('#tentativeAttachment').show();
                    // this.form.verifying_agency=data.app_verification.verifyingAgency;
                    let veri=data.app_verification.verifyingAgency.split(',');
                    this.form.verifying_agency_list=[];
                    for(let i=0;i<veri.length;i++){
                        this.form.verifying_agency_verified_list.push({verifying_agency:veri[i]});
                    }
                    $('#btnstentative').hide();
                    this.form.id=data.app_verification.id;
                    $('#verifying_agency').prop('readonly',true);
                    this.form.tentative_date=data.app_verification.tentativeDate;
                    $('#tentative_date').prop('readonly',true);
                    $('#verifier_team').show();

                    if((data.establishment_type=="Private School" ||  data.establishment_type=="Private ECCD" || data.establishment_type=="Public ECCD") && data.status!="Document Updated"){
                        $('#verifyId').hide();
                        $('#approveId').hide();
                        $('#rejectbtn').hide();
                    }
                    //approver documents
                    this.getAttachmentType('ForTransaction__Application_for_Public_School_Approver');
                    $('#team_verificationAttachment').show();
                    $('#removeBtn').hide();
                    this.form.update_type='final_verification';
                    this.showsearch=true;
                    $('#updateBtn').hide();
                    $('#update_btn_level').hide();

                    //if(data.app_verification_team.length==0){
                        // this.form.update_type='team_verification';
                        // this.getAttachmentType('ForTransaction__Update_Team_Verification_for_Public');
                        // // $('#update_btn_level').html('Notify For team Verification');
                        // this.showsearch=true;
                        // $('#updateBtn').hide();
                        // $('#verifyId').show();
                        // $('#approveId').show();
                        // $('#update_btn_level').hide();
                    //     this.showsearch=true;
                    //     this.form.update_type='final_verification';

                    //     $('#removeBtn').hide();
                    //     $('#team_verificationAttachment').show();
                    // }
                    // else{

                    //     this.showsearch=false;
                    //     this.form.update_type='final_verification';
                    //     this.getAttachmentType('ForTransaction__Establishment_of_Public_Schoo_Approv');
                    //     $('#removeBtn').hide();
                    //     $('#team_verificationAttachment').show();
                    //     for(let i=0;i<data.app_verification_team.length;i++){
                    //         this.form.nomi_staffList.push({id:'NA',staff_id:data.app_verification_team[i].teamMember,
                    //             name:data.app_verification_team[i].name,
                    //             cid:data.app_verification_team[i].cid,
                    //             po_title:data.app_verification_team[i].po_title,
                    //         })
                    //     }
                    // }

                }


                if(this.levelList[this.applicationOrgdetails.levelId].toLowerCase().includes('higher')){
                    $('.strm_clas').show();
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
            this.form.verifying_agency_list.push({verifying_agency:''})
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
        getEmpDetails(){
            if($('#emp_deails').val()==""){
                $('#emp_deails_err').html('Please provide this field');
            }
            else{
                $('#emp_deails_err').html('');
                let type="";
                if($('#emp_deails').val().length==11){
                    type="cid";
                }
                else{
                    type="emp_id";
                }
                let uri="loadCommons/viewStaffDetails/"+type+'/'+$('#emp_deails').val();
                axios.get(uri)
                .then((response) => {
                    let data=response.data.data;
                    $('#emp_deails').val('');
                    $('#nminees_error').html('');
                    if(data==null){
                        Swal.fire({
                            text: "No details are found with this input!",
                            icon: 'error',
                        });
                    }
                    else{
                        this.form.nomi_staffList.push({id:'NA',staff_id:data.id, name:data.name, cid:data.cid_work_permit, po_title:data.position_title, org_id:data.working_agency_id,org:data.working_agency, dzo_id:data.dzo_id,dzo:data.dzongkhag})
                    }
                })
                .catch(function (error){
                    console.log(error);
                });
            }
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
                            // for(let i=0;i<this.form.nomi_staffList.length;i++){
                            //     alert( JSON.stringify(this.form.nomi_staffList[i]));

                            // }
                            formData.append('nomi_staffList', JSON.stringify(this.form.nomi_staffList));
                            formData.append('ref_docs[]', this.form.ref_docs);
                            for(let i=0;i<this.form.ref_docs.length;i++){
                                formData.append('attachments[]', this.form.ref_docs[i].attach);
                                formData.append('attachmentname[]', this.form.ref_docs[i].name);
                            }

                            axios.post('organization/updateNewEstablishmentApplication', formData, config)
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
        getLevel(uri = '/organization/getLevelInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                for(let i=0;i<data.length;i++){
                    this.levelList[data[i].id] = data[i].name;
                }
            });
        },
        getLocation(uri = '/organization/getLocationInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                for(let i=0;i<data.length;i++){
                    this.locationList[data[i].id] = data[i].name;
                }
            });
        },
        getClassStream:function(){
            axios.get('/masters/loadClassStreamMapping')
              .then(response => {
                this.classStreamList = response.data.data;
                let data = response.data.data;
                //this.calssArray[data[i].id] = data[i].name;
            });
        },

        /**
         * method to get class in checkbox
         */
        getClass:function(){
            axios.get('/organization/getClass')
              .then(response => {
                let data = response.data;
                for(let i=0;i<data.length;i++){
                    this.calssArray[data[i].id] = data[i].class;
                }
            });
        },

        getstream:function(){
            axios.get('/organization/getStream')
              .then(response => {
                let data = response.data;
                for(let i=0;i<data.length;i++){
                    this.streamArray[data[i].id] = data[i].stream;
                }
            });
        },
        loadproposedBy(uri = 'masters/organizationMasterController/loadOrganizaitonmasters/active/ProposedBy'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.proposed_by_list[data[i].id] = data[i].name;
                }
            })
            .catch(function (error) {
                console.log('error: '+error);
            });
        },
    },
    mounted(){
        this.getLevel();
        this.getLocation();
        // this.getClassStream();
        this.getClass();
        this.getstream();
        this.loadproposedBy();
        // this.applicationdetails.applicationNo=this.$route.params.data.application_number;
        this.loadestablishmentapplicationdetails(this.$route.params.data.application_number,this.$route.params.type);


    }
}
</script>
