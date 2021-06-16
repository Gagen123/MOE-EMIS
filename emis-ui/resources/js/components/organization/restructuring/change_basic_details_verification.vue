<template>
    <div>
        <ol class="mb-1 ml-xl-n3 mr-xl-n2 pl-3" style="background-color:#E5E5E5">
            <li class="pl-2 form-inline "><h6 class="pt-1">Basic Change Application Verification/Approval</h6></li>
        </ol>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-body pt-0 mt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="organization-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="callout callout-success">
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label><u>Current Details</u></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Name:</label>
                                    <span class="text-blue text-bold">{{existing_details.name}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Level:</label>
                                    <span class="text-blue text-bold">{{levelArray[existing_details.levelId]}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Year of Establishment:</label>
                                    <span class="text-blue text-bold">{{existing_details.yearOfEstablishment}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-if="existing_details.category!='private_school' || existing_details.category!='private_eccd'">
                                    <label>Zest Code:</label>
                                    <span class="text-blue text-bold">{{existing_details.zestAgencyCode}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Category:</label>
                                    <span class="text-blue text-bold">{{existing_details.category}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Dzongkhag:</label>
                                    <span class="text-blue text-bold">{{dzoArray[existing_details.dzongkhagId]}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Gewog:</label>
                                    <span class="text-blue text-bold">{{selected_gewog}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Village:</label>
                                    <span class="text-blue text-bold">{{selected_village}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Classes</th>
                                                <th class="strm_clas">Stream</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(item, key, index) in  existing_details.classes" :key="index">
                                                <td>
                                                    <label class="pr-4"> &nbsp;{{ calssArray[item.classId] }} </label>
                                                </td>
                                                <td class="strm_clas" v-if="calssArray[item.classId]=='Class 11' || calssArray[item.classId]=='XI' || calssArray[item.classId]=='Class 12' || calssArray[item.classId]=='XII'">
                                                    {{  streamArray[item.streamId]  }}
                                                </td>
                                                <td class="strm_clas" v-else> </td>
                                                <td v-if="item.class=='Class 11' || item.class=='XI' || item.class=='Class 12' || item.class=='XII'">
                                                    <input type="checkbox" checked="true">
                                                </td>
                                                <td v-else>
                                                    <input type="checkbox" checked="true">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="form-group row" v-if="appicationDetails.application_type=='sen_change'">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>is SEN School:</label>
                                    <span class="text-blue text-bold">{{existing_details.isSenSchool==1? 'Yes': 'No'}}</span>
                                </div>
                            </div>
                            <div v-if="appicationDetails.application_type=='proprietor_change'">
                                <div class="form-group row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label><u>Proprietor Details</u></label>
                                    </div>
                                </div>
                                <div class="form-group row" v-if="existing_details.proprioter!=undefined">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="mb-0">CID:</label>
                                        <span class="text-blue text-bold">{{existing_details.proprioter.cid}}</span>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="mb-0">Full Name:</label>
                                        <span class="text-blue text-bold">{{existing_details.proprioter.fullName}}</span>
                                    </div>
                                </div>
                                <div class="form-group row" v-if="existing_details.proprioter!=undefined">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0">Phone No:</label>
                                        <span class="text-blue text-bold">{{existing_details.proprioter.phoneNo}}</span>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0">Mobile No:</label>
                                        <span class="text-blue text-bold">{{existing_details.proprioter.mobileNo}}</span>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0">Email:</label>
                                        <span class="text-blue text-bold">{{existing_details.proprioter.email}}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- <div v-if="appicationDetails.application_type=='level_change'">
                                <div class="form-group row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label><u>Classes Details</u></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <span v-for="(item, index) in  existing_details.classes" :key="index">
                                            <input type="checkbox" checked="true"><label class="pr-4"> &nbsp;{{ calssArray[item.classId] }}<span v-if="item.streamId"> - {{ streamArray[item.streamId] }}</span> </label>
                                        </span>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <div class="callout callout-info">
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label><u>Application Details</u></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Application Number:</label>
                                    <span class="text-blue text-bold">{{appicationDetails.application_no}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Type of Change:</label>
                                <span class="text-blue text-bold">{{appicationDetails.establishment_type}} </span>
                                </div>
                            </div>

                            <div class="form-group row" v-if="appicationDetails.application_type=='name_change'">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Propose New Name:</label>
                                    <span class="text-blue text-bold">{{appicationDetails.change_details.proposedChange}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Proposal Initiated Bye:</label>
                                    <span class="text-blue text-bold">{{proposed_by_list[appicationDetails.change_details.initiatedBy]}}</span>
                                </div>
                            </div>

                            <div class="form-group row" v-if="appicationDetails.application_type=='location_type_change'">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Proposed Location:</label>
                                    <span class="text-blue text-bold">{{locationArray[appicationDetails.change_details.proposedChange]}}</span>
                                </div>
                            </div>

                            <div class="form-group row" v-if="appicationDetails.application_type=='expension_change'">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Current Capacity:</label>
                                    <span class="text-blue text-bold">{{appicationDetails.change_details.proposedChange}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Proposed Capacity:</label>
                                    <span class="text-blue text-bold">{{appicationDetails.change_details.changeInDetails}}</span>
                                </div>
                            </div>

                            <div class="form-group row" v-if="appicationDetails.application_type=='feeding_change'">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Is Feeding School:</label>
                                    <label><input  type="radio" v-model="isfeedingschool" value="1" tabindex=""/> Yes</label>
                                    <label><input  type="radio" v-model="isfeedingschool" value="0" tabindex=""/> No</label>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <label class="mb-0">Feeding Modality:</label>
                                    <label><input  type="checkbox" v-model="feeding1" id="feeding1" value="1" /> One Meal</label>
                                    <label><input  type="checkbox" v-model="feeding2" value="2"/> Two Meals</label>
                                    <label><input  type="checkbox" v-model="feeding3" value="3" /> Three Meals</label>
                                </div>
                            </div>
                            <div class="form-group row" v-if="appicationDetails.application_type=='autonomus_change'">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Is Autonomy:</label>
                                    <label><input  type="radio" v-model="existing_details.isAutonomy" value="1" tabindex=""/> Yes</label>
                                    <label><input  type="radio" v-model="existing_details.isAutonomy" value="0" tabindex=""/> No</label>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <label class="mb-0">Proposed for Autonmy:</label>
                                    <label><input  type="radio" v-model="appicationDetails.change_details.proposedChange" value="1" tabindex=""/> Yes</label>
                                    <label><input  type="radio" v-model="appicationDetails.change_details.proposedChange" value="0" tabindex=""/> No</label>
                                </div>
                            </div>

                            <div class="form-group row" v-if="appicationDetails.application_type=='sen_change'">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Is SEN School:</label>
                                    <label><input  type="radio" v-model="senSchool" value="1" tabindex=""/> Yes</label>
                                    <label><input  type="radio" v-model="senSchool" value="0" tabindex=""/> No</label>
                                </div>
                            </div>

                            <div class="form-group row" v-if="appicationDetails.application_type=='fee_structure_change'">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Curent Fees:</label>
                                    <span class="text-blue text-bold">{{existing_details.current_fees}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Propose New Fees:</label>
                                    <span class="text-blue text-bold">{{appicationDetails.change_details.proposedChange}}</span>
                                </div>
                            </div>
                            <div class="form-group row" v-if="appicationDetails.application_type=='boadring_change'">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Boadring (Current):</label>
                                    <label><input  type="radio" disabled v-model="existing_details.isFeedingSchool" value="1" tabindex=""/> Yes</label>
                                    <label><input  type="radio" disabled v-model="existing_details.isFeedingSchool" value="0" tabindex=""/> No</label>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Propose for Boadring Change:</label>
                                    <label><input  type="radio" disabled v-model="appicationDetails.change_details.proposedChange" value="1" tabindex=""/> Yes</label>
                                    <label><input  type="radio" disabled v-model="appicationDetails.change_details.proposedChange" value="0" tabindex=""/> No</label>
                                </div>
                            </div>

                            <div v-if="appicationDetails.application_type=='proprietor_change'">
                                <div class="form-group row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label><u>Proprietor Details</u></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="mb-0">CID:</label>
                                        <span class="text-blue text-bold">{{appicationDetails.change_prop.proprietorCid}}</span>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="mb-0">Full Name:</label>
                                        <span class="text-blue text-bold">{{appicationDetails.change_prop.proprietorName}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0">Phone No:</label>
                                        <span class="text-blue text-bold">{{appicationDetails.change_prop.proprietorPhone}}</span>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0">Mobile No:</label>
                                        <span class="text-blue text-bold">{{appicationDetails.change_prop.proprietorMobile}}</span>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0">Email:</label>
                                        <span class="text-blue text-bold">{{appicationDetails.change_prop.proprietorEmail}}</span>
                                    </div>
                                </div>
                            </div>


                            <div v-if="appicationDetails.application_type=='level_change' || appicationDetails.application_type=='stream_change'">
                                <div class="form-group row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Proposed Level:</label>
                                        <span class="text-blue text-bold">{{levelArray[appicationDetails.change_details.proposedChange]}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label><u>Change In Classes Details</u></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <span v-for="(item, index) in  appicationDetails.change_classes" :key="index">
                                            <input type="checkbox" checked="true"><label class="pr-4"> &nbsp;{{ calssArray[item.classId] }}<span v-if="item.streamId"> - {{ streamArray[item.streamId] }}</span> </label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="callout callout-info">
                            <div class="row pb-2" id="team_verificationAttachment">
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
                                            <tr v-for='(attach,count) in appicationDetails.attachments' :key="count+1">
                                                <template>
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
                            </div>
                            <div class="form-group row">
                                <div class="card-body col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <h5><u>Any Supporting Documents and Attachments (if applicable)</u></h5>
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
                        <div class="row form-group" v-if="appicationDetails.establishment_type=='Change in Name' || appicationDetails.establishment_type=='Upgrade Downgrade'">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <input type="date" class="form-control" @change="remove_error('effective_date')" v-model="form.effective_date" id="effective_date" />
                                <span class="text-danger" id="effective_date_err"></span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Remarks</label>
                                <textarea class="form-control" @change="remove_error('remarks')" v-model="form.remarks" id="remarks"></textarea>
                                <span class="text-danger" id="remarks_err"></span>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <!-- <button class="btn btn-success" @click="shownexttab('organization-tab')"><i class="fa fa-arrow-left"></i>Previous </button> -->
                                <button class="btn btn-info text-white" @click="shownexttab('update')" style="display:none" id="updateBtn"> <i class="fa fa-edit"></i><span id="update_btn_level"></span> </button>
                                <button class="btn btn-danger" @click="shownexttab('reject')"> <i class="fa fa-times"></i> Reject </button>
                                <button class="btn btn-primary" @click="shownexttab('verify')" style="display:none" id="verifyId"> <i class="fa fa-forward"></i>Verify </button>
                                <button class="btn btn-dark" @click="shownexttab('approve')" style="display:none" id="approveId"> <i class="fa fa-check"></i>Approve </button>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="tab-pane fade tab-content-details" id="class-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="callout callout-success">
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label><u>Previous Class Stream Details</u></label>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-check-inline pl-4">
                                    <span v-for="(item, index) in  class_section1" :key="index">
                                        <input type="checkbox" checked="true"><label class="pr-4"> &nbsp;{{ item.class_name }}</label>
                                        <span v-for="(stm, key, index) in sectionList1" :key="index" >
                                            <span v-if="item.classId==stm.classId">
                                                <br>
                                                <input type="checkbox" checked="true" class="ml-4"> <label class="pr-3"> {{ stm.section_name }}</label>
                                            </span>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="callout callout-info">
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label><u>Application Details</u></label>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-check-inline pl-4">
                                    <span v-for="(item, index) in  class_section" :key="index">
                                        <input type="checkbox" checked="true"><label class="pr-4"> &nbsp;{{ item.class_name }}</label>
                                        <span v-for="(stm, key, index) in sectionList" :key="index" >
                                            <span v-if="item.classId==stm.classId">
                                                <br>
                                                <input type="checkbox" checked="true" class="ml-4"> <label class="pr-3"> {{ stm.section_name }}</label>
                                            </span>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            count:1,
            proprietorList1:[],
            proprietorList:[],
            class_section:[],
            sectionList:[],
            class_section1:[],
            sectionList1:[],

            existing_details:'',
            levelArray:{},
            dzoArray:{},
            gewogArray:{},
            calssArray:{},
            streamArray:{},
            proposed_by_list:{},
            locationArray:{},
            selected_gewog:'',
            selected_village:'',
            appicationDetails:[],
            isfeedingschool:'',
            senSchool:'',
            form: new form({
                id: '',applicationNo:'',actiontype:'',remarks:'',establishment_type:'',
                ref_docs:[],fileUpload: [],sequence:'',screen_id:'',effective_date:'',
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
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },
         /**
         * method to get level in dropdown
         */
        getLevel(uri = '/organization/getLevelInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                for(let i=0;i<data.length;i++){
                    this.levelArray[data[i].id] = data[i].name;
                }
            });
        },
        /**
         * method to load previous org details
         */
        loadPriviousOrgDetails(org_id){
            axios.get('loadCommons/loadOrgDetails/fullOrgDetbyid/'+org_id)
            .then(response => {
                this.existing_details=response.data.data;
                this.form.category=existing_details.category;
                this.getgewog(response.data.data.dzongkhagId,response.data.data.gewogId);
                this.getVillage(response.data.data.gewogId,response.data.data.chiwogId);
            })
            .catch((error) => {
                console.log("Error: "+error);
            });
        },
        /**
         * method to load previous org details
         */
        loadChangeBasicApplicationDetails(appId,type){
            axios.get('organization/loadChangeDetailForVerification/'+appId+'/'+type)
            .then((response) => {
                let data=response.data.data;
                this.loadPriviousOrgDetails(data.change_details.organizationId);
                this.appicationDetails=data;
                this.form.sequence=response.data.sequence;
                this.form.screen_id=response.data.screen_id;
                this.form.establishment_type=data.establishment_type;
                this.isfeedingschool=data.change_details.proposedChange;
                this.senSchool=data.change_details.proposedChange;
                if(data.change_feeding!="" && data.change_feeding!=undefined && data.change_feeding.length>0){
                    for(let i=0; i< data.change_feeding.length; i++){
                        if(i==0){
                            this.feeding1=data.change_feeding[i].noOfMeals;
                        }
                        if(i==1){
                            this.feeding2=data.change_feeding[i].noOfMeals;
                        }
                        if(i==2){
                            this.feeding3=data.change_feeding[i].noOfMeals;
                        }
                    }
                }
                if(response.data.app_stage.toLowerCase().includes('verifi')){
                    $('#verifyId').show();
                }
                if(response.data.app_stage.toLowerCase().includes('approve')){
                    $('#approveId').show();
                }
                // if(data.app_verification==null){
                //     $('#update_btn_level').html('Notify For Tentative Date');
                //     this.form.update_type='tentative';
                //     $('#updateBtn').show();
                //     $('#verifyId').hide();
                //     $('#approveId').hide();
                // }
                // else{
                //     $('#tentativeAttachment').show();
                //     this.form.verifying_agency=data.app_verification.verifyingAgency;
                //     this.form.id=data.app_verification.id;
                //     $('#verifying_agency').prop('readonly',true);
                //     this.form.tentative_date=data.app_verification.tentativeDate;
                //     $('#tentative_date').prop('readonly',true);
                //     $('#verifier_team').show();
                //     if(data.app_verification_team.length==0){
                //         this.form.update_type='team_verification';
                //         this.getAttachmentType('ForTransaction__Update_Team_Verification_for_Public');
                //         $('#update_btn_level').html('Notify For team Verification');
                //         this.showsearch=true;
                //         $('#updateBtn').show();
                //         $('#verifier_team').show();
                //         $('#verifyId').hide();
                //         $('#approveId').hide();
                //     }
                //     else{
                //         if((data.establishment_type=="Private School" || data.establishment_type=="Private ECCD" || data.establishment_type=="Public ECCD") && data.status!="Document Updated"){
                //             $('#verifyId').hide();
                //             $('#approveId').hide();
                //             $('#rejectbtn').hide();
                //         }
                //         this.showsearch=false;
                //         this.form.update_type='final_verification';
                //         this.getAttachmentType('ForTransaction__Establishment_of_Public_Schoo_Approv');
                //         $('#removeBtn').hide();
                //         $('#team_verificationAttachment').show();
                //         for(let i=0;i<data.app_verification_team.length;i++){
                //             this.form.nomi_staffList.push({id:'NA',staff_id:data.app_verification_team[i].teamMember,
                //                 name:data.app_verification_team[i].name,
                //                 cid:data.app_verification_team[i].cid,
                //                 po_title:data.app_verification_team[i].po_title,
                //             })
                //         }
                //     }
                // }
            })
            .catch((error) => {
                console.log("Error......"+error);
            });
        },



        /**
         * method to show next tab and update application accordingly
         */
        shownexttab(nextclass){
            if(nextclass=="reject" || nextclass=="verify" || nextclass=="approve"){
                let action=true;
                if(nextclass=="reject" && this.form.remarks==""){
                    $('#remarks_err').html('Please mention remarks');
                    $('#remarks').addClass('is-invalid');
                    action=false;
                }
                if(action){
                    Swal.fire({
                        text: "Are you sure you wish to "+nextclass+" this applicaiton ?",
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
                            formData.append('category', this.form.category);
                            formData.append('sequence', this.form.sequence);
                            formData.append('screen_id', this.form.screen_id);
                            formData.append('applicationNo', this.form.applicationNo);
                            formData.append('remarks', this.form.remarks);
                            formData.append('service_name', this.form.establishment_type);
                            formData.append('ref_docs[]', this.form.ref_docs);
                            for(let i=0;i<this.form.ref_docs.length;i++){
                                formData.append('attachments[]', this.form.ref_docs[i].attach);
                                formData.append('attachmentname[]', this.form.ref_docs[i].name);
                            }
                            axios.post('organization/updateChangeBasicDetailApplication', formData, config)
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
                                    'Not able to update this application details. Please contact system administrator.Error: '+err,
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
        loaddzongkhagList(uri = 'masters/loadGlobalMasters/all_dzongkhag'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.dzoArray[data[i].id] = data[i].name;
                }
            })
            .catch(function (error) {
                console.log('err: '+error);
            });
        },
        getgewog(dzoId,gewogId){
            axios.get('masters/all_active_dropdowns/dzongkhag/'+dzoId)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.gewogArray[data[i].id] = data[i].name;
                }
                alert(this.gewogArray[gewogId]);
                this.selected_gewog=this.gewogArray[gewogId];
            })
            .catch(function (error) {
                console.log('err: '+error);
            });
        },
        getVillage(gewogId,villageId){
            axios.get('masters/all_active_dropdowns/gewog/'+gewogId)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.villageArray[data[i].id] = data[i].name;
                }
                this.selected_village=this.villageArray[villageId];
            })
            .catch(function (error) {
                console.log('err: '+error);
            });
        },
        getClass:function(){
            axios.get('/organization/getClass')
              .then(response => {
                let data = response.data;
                for(let i=0;i<data.length;i++){
                    this.calssArray[data[i].id] = data[i].class;
                }
            });
        },

        getStream:function(){
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
        getLocation(uri = '/organization/getLocationInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                for(let i=0;i<data.length;i++){
                    this.locationArray[data[i].id] = data[i].name;
                }
            });
        },
    },

    mounted(){
        this.getLocation();
        this.loadproposedBy();
        this.getLevel();
        this.getClass();
        this.getStream();
        this.loaddzongkhagList();
        this.form.applicationNo=this.$route.params.data.application_number;
        this.loadChangeBasicApplicationDetails(this.$route.params.data.application_number,this.$route.params.type);

    }
}
</script>
