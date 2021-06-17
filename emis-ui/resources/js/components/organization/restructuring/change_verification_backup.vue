<template>
    <div>
        <ol class="mb-1 ml-xl-n3 mr-xl-n2 pl-3" style="background-color:#E5E5E5">
            <li class="pl-2 form-inline "><h6 class="pt-1">Basic Change Application Verification/Approval</h6></li>
        </ol>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <li class="nav-item organization-tab" @click="shownexttab('organization-tab')">
                        <a class="nav-link active" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Basic Details </label>
                        </a>
                    </li>
                    <li class="nav-item class-tab" @click="shownexttab('class-tab')">
                        <a class="nav-link" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Classes & Streams </label>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body pt-0 mt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="organization-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="callout callout-success">
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label><u>Previous Details</u></label>
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
                                <!-- <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Category:</label>
                                    <span class="text-blue text-bold">{{existing_details.organizationType == 'public_school' ? "Public" : existing_details.organizationType == 'public_eccd' ? "sss" : "Private"}}</span>
                                </div> -->
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Year of Establishment:</label>
                                    <span class="text-blue text-bold">{{existing_details.yearOfEstablishment}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Zest Code:</label>
                                    <span class="text-blue text-bold">{{existing_details.zestAgencyCode}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Category:</label>
                                    <span class="text-blue text-bold">{{existing_details.category == 1 ? "Public" : "Private"}}</span>
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Dzongkhag:</label>
                                    <span class="text-blue text-bold">{{existing_details.dzongkhag}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Gewog:</label>
                                    <span class="text-blue text-bold">{{existing_details.gewog}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Chiwog:</label>
                                    <span class="text-blue text-bold">{{existing_details.chiwog}}</span>
                                </div>
                            </div> -->
                            <!-- <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Location Type:</label>
                                    <span class="text-blue text-bold">{{existing_details.locationType}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Geopolitically Located:</label>
                                    <span class="text-blue text-bold">{{existing_details.geoLocated == 1 ? "Yes" : "No"}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>SEN School:</label>
                                    <span class="text-blue text-bold">{{existing_details.isSenSchool == 1 ? "Yes" : "No"}}</span>
                                </div>
                            </div>
                            <div class="form-group row" v-if="existing_details.isSenSchool == 1">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Co-located with Parent School:</label>
                                    <span class="text-blue text-bold">{{existing_details.isColocated == 1 ? "Yes" : "No"}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Parent School:</label>
                                    <span class="text-blue text-bold">{{existing_details.parentSchoolId}}</span>
                                </div>
                            </div>
                            -->
                            <div v-if="existing_details.category==0">
                                <div class="row pb-2">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <h4><u>Proprietor Details</u></h4>
                                    </div>
                                </div>
                                <div v-for="(prepro, index) in proprietorList1" :key="index">
                                    <div class="form-group row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <label class="mb-0">CID:</label>
                                            <span class="text-blue text-bold">{{prepro.cid}}</span>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <label class="mb-0">Full Name:</label>
                                            <span class="text-blue text-bold">{{prepro.fullName}}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <label class="mb-0">Phone No:</label>
                                            <span class="text-blue text-bold">{{prepro.phoneNo}}</span>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <label class="mb-0">Email:</label>
                                            <span class="text-blue text-bold">{{prepro.email}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                            </div>
                            <div class="form-group row" v-if="appicationDetails.application_type=='name_change'">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Propose New Name:</label>
                                    <span class="text-blue text-bold">{{appicationDetails.change_details.proposedChange}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Dzongkhag:</label>
                                    <span class="text-blue text-bold">{{appicationDetailsForm.appDzongkhag}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Gewog:</label>
                                    <span class="text-blue text-bold">{{appicationDetailsForm.appGewog}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Chiwog:</label>
                                    <span class="text-blue text-bold">{{appicationDetailsForm.appChiwog}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Location Type:</label>
                                    <span class="text-blue text-bold">{{appicationDetailsForm.appLocationType}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Geopolitically Located:</label>
                                    <span class="text-blue text-bold">{{appicationDetailsForm.appGeoLocated = 1 ? "Yes" : "No"}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>SEN School:</label>
                                    <span class="text-blue text-bold">{{appicationDetailsForm.appSenSchool == 1 ? "Yes" : "No"}}</span>
                                </div>
                            </div>
                            <div class="form-group row" v-if="appicationDetailsForm.appSenSchool==1">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                                    <label class="mb-0">Parent School:</label>
                                    <span class="text-blue text-bold">{{appicationDetailsForm.parentSchool}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Co-located with Parent School</label>
                                    <span class="text-blue text-bold">
                                        {{ appicationDetailsForm.coLocated  == 1 ? "Yes" :  "No"}}
                                    </span>
                                </div>
                            </div>
                            <div v-if="appicationDetailsForm.category==0">
                                <div class="row pb-2">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <h4><u>Proprietor Details</u></h4>
                                    </div>
                                </div>
                                <div v-for="(pro, index) in proprietorList" :key="index">
                                    <div class="form-group row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <label class="mb-0">CID:</label>
                                            <span class="text-blue text-bold">{{pro.cid}}</span>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <label class="mb-0">Full Name:</label>
                                            <span class="text-blue text-bold">{{pro.fullName}}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <label class="mb-0">Phone No:</label>
                                            <span class="text-blue text-bold">{{pro.phoneNo}}</span>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <label class="mb-0">Email:</label>
                                            <span class="text-blue text-bold">{{pro.email}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" @click="shownexttab('class-tab')"> Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade tab-content-details" id="class-tab" role="tabpanel" aria-labelledby="basicdetails">
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

                        <Workflow
                            :appNo="appicationDetailsForm.applicationNo"
                        />
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
                                <button class="btn btn-success" @click="shownexttab('organization-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-danger" @click="shownexttab('reject')"> <i class="fa fa-times"></i> Reject </button>
                                <button class="btn btn-primary" @click="shownexttab('verify')" style="display:none" id="verifyId"> <i class="fa fa-forward"></i>Verify </button>
                                <button class="btn btn-dark" @click="shownexttab('approve')" style="display:none" id="approveId"> <i class="fa fa-check"></i>Approve </button>
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
            proprietorList1:[],
            proprietorList:[],
            class_section:[],
            sectionList:[],
            class_section1:[],
            sectionList1:[],
            existing_details:'',
            levelArray:{},
            appicationDetails:[],
            appicationDetailsForm:new form({
                id:'',organizationId:'',appName:'',appLevel:'',appCategory:'',appDzongkhag:'',appGewog:'',
                appChiwog:'',appLocationType:'',appGeoLocated:'',appSenSchool:'', appParentSchool:'',
                appCoLocatedParent:'',appCid:'',appFullName:'',appPhoneNo:'',appEmail:'',
            }),
            form: new form({
                id: '',applicationNo:'',actiontype:'',remarks:''
            }),
        }
    },

    methods:{
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
            axios.get('loadCommons/loadOrgDetails/Orgbyid/'+org_id)
            .then(response => {
                this.existing_details=response.data.data;
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
                // this.appicationDetailsForm.organizationId       =   data.organizationId;
                // this.appicationDetailsForm.applicationNo        =   data.applicationNo;
                // this.appicationDetailsForm.appName              =   data.proposedName;
                // this.appicationDetailsForm.appLevel             =   data.level;
                // this.appicationDetailsForm.appCategory          =   data.category;
                // this.appicationDetailsForm.appCategory          =   data.category;
                // this.appicationDetailsForm.appDzongkhag         =   response.data.dzongkhag;
                // this.appicationDetailsForm.appGewog             =   response.data.gewog;
                // this.appicationDetailsForm.appChiwog            =   response.data.village;
                // this.appicationDetailsForm.appLocationType      =   data.locationType;
                // this.appicationDetailsForm.appGeoLocated        =   data.isGeopoliticallyLocated;
                // this.appicationDetailsForm.appSenSchool         =   data.isSenSchool;
                // this.appicationDetailsForm.appCoLocatedParent   =   data.isColocated;
                // this.class_section                              =   data.class_section;
                // this.sectionList                                =   data.sections;
                this.loadPriviousOrgDetails(data.change_details.organizationId);
                this.appicationDetails=data;
                if(response.data.app_stage.toLowerCase().includes('verifi')){
                    $('#verifyId').show();
                }
                if(response.data.app_stage.toLowerCase().includes('approve')){
                    $('#approveId').show();
                }
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
                        text: "Are you sure you wish to "+nextclass+" this Application ?",
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes!',
                        }).then((result) => {
                        if (result.isConfirmed) {
                            this.form.applicationNo = this.appicationDetailsForm.applicationNo;
                            this.form.actiontype=nextclass;
                            this.form.post('organization/updateChangeBasicDetailApplication')
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
    },

    mounted(){
        this.appicationDetailsForm.applicationNo=this.$route.params.data.application_number;
        this.loadChangeBasicApplicationDetails(this.$route.params.data.application_number,this.$route.params.type);
        this.getLevel();
    }
}
</script>
