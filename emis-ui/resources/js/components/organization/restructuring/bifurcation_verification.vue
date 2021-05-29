<template>
    <div>
        <ol class="mb-1 ml-xl-n3 mr-xl-n2 pl-3" style="background-color:#E5E5E5">
            <li class="pl-2 form-inline "><h6 class="pt-1">Bifurcation Application Verification/Approval</h6></li>
        </ol>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <li class="nav-item organization-tab" @click="shownexttab('organization-tab')">
                        <a class="nav-link active" data-toggle="pill" role="tab"> 
                            <label class="mb-0.5">Existing Organization Details </label>                              
                        </a>
                    </li>
                    <li class="nav-item proposed-org-tab" @click="shownexttab('proposed-org-tab')">
                        <a class="nav-link" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Proposed Organization Details </label>
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
                                    <span class="text-blue text-bold">{{applicaitondetailsform.applicationNo}}</span>
                                </div> 
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Submitted Date:</label>
                                    <span class="text-blue text-bold">{{applicaitondetailsform.application_date}}</span>
                                </div> 
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Service Name:</label>
                                    <span class="text-blue text-bold">Bifurcation</span>
                                </div> 
                            </div>
                        </div>
                        <div class="callout callout-success">
                            <h4><u>Existing Organization Details</u></h4>
                            <div class="form-group row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="card card-primary card-outline">
                                        <div class="card-body">
                                            <h3 class="card-title">School/ECR/ECCD 1</h3>
                                            <hr>
                                            <div class="form-group row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Code:</label>
                                                    <span class="text-blue text-bold" id="mergerCode1">{{org1_details.code}}</span>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Name:</label>
                                                    <span class="text-blue text-bold" id="mergerName1">{{org1_details.name}}</span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Category:</label>
                                                    <span class="text-blue text-bold" id="megerCategory1">{{org1_details.category  == 1 ? "public" :  "private"}}</span>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Level:</label>
                                                    <span class="text-blue text-bold" id="mergerLevel1">{{org1_details.level}}</span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Dzongkhag:</label>
                                                    <span class="text-blue text-bold" id="mergerDzongkhag1">{{org1_details.dzongkhag}}</span>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Gewog:</label>
                                                    <span class="text-blue text-bold" id="mergerGewog1">{{org1_details.gewog}}</span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Chiwog:</label>
                                                    <span class="text-blue text-bold" id="mergerChiwog1">{{org1_details.village}}</span>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Location Type:</label>
                                                    <span class="text-blue text-bold" id="mergerLocationtype1">{{org1_details.locationType}}</span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Geopolitically Located:</label>
                                                    <span class="text-blue text-bold" id="mergerGeoLocated1">{{org1_details.isGeopoliticallyLocated  == 1 ? "Yes" :  "No"}}</span>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>SEN School:</label>
                                                    <span class="text-blue text-bold" id="mergerSen1">{{org1_details.isSenSchool  == 1 ? "Yes" :  "No"}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 fa-pull-right">
                                <button class="btn btn-primary" @click="shownexttab('proposed-org-tab')">Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade tab-content-details" id="proposed-org-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <h4><u>Proposed Organization Details</u></h4>
                        <div class="callout callout-success">
                             <div class="form-group row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="card card-primary card-outline">
                                        <div class="card-body">
                                            <h3 class="card-title">School/ECR/ECCD 1</h3>
                                            <hr>
                                            <div class="form-group row"> 
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label class="mb-0">Proposed Name:</label>
                                                    <span class="text-blue text-bold">{{applicaitondetails.new1Name}}</span>
                                                </div>  
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label class="mb-0">Level:</label>
                                                    <span class="text-blue text-bold">{{applicaitondetails.new1Level}}</span>
                                                </div>  
                                            </div>
                                            <div class="form-group row"> 
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label class="mb-0">Category:</label>
                                                    <span class="text-blue text-bold">{{applicaitondetails.new1Category == 1 ? "Public" :  "Private" }}</span>
                                                </div>  
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label class="mb-0">Dzongkhag:</label>
                                                    <span class="text-blue text-bold">{{applicaitondetails.new1Dzongkhagname}}</span>
                                                </div>  
                                            </div>
                                            <div class="form-group row"> 
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label class="mb-0">Gewog:</label>
                                                    <span class="text-blue text-bold">{{applicaitondetails.new1Gewogname}}</span>
                                                </div>  
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label class="mb-0">Village:</label>
                                                    <span class="text-blue text-bold">{{applicaitondetails.new1Chiwogname}}</span>
                                                </div>  
                                            </div>
                                            <div class="form-group row"> 
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label class="mb-0">Location Type:</label>
                                                    <span class="text-blue text-bold">{{applicaitondetails.new1Location}}</span>
                                                </div>  
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label class="mb-0">Geopolitically Located:</label>
                                                    <span class="text-blue text-bold">{{applicaitondetails.new1IsGeoLocated == 1 ? "Yes" :  "No"}}</span>
                                                </div>  
                                            </div>
                                            <div class="form-group row"> 
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label class="mb-0">Is SEN School:</label>
                                                    <span class="text-blue text-bold">{{applicaitondetails.new1IsSenSchool == 1 ? "Yes" :  "No"}}</span>
                                                </div>  
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label class="mb-0">Co-located with Parent School:</label>
                                                    <span class="text-blue text-bold">{{applicaitondetails.new1IsCoLocated == 1 ? "Yes" :  "No"}}</span>
                                                </div>  
                                            </div>
                                            <div class="form-group row"> 
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label class="mb-0">Parent School:</label>
                                                    <span class="text-blue text-bold">{{applicaitondetails.parent_school1}}</span>
                                                </div>  
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <label class="mb-0">Select classes and streams</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                                                <span v-for="(item, index) in  applicaitondetails.class_det_1" :key="index">
                                                    <br>
                                                    <input type="checkbox" checked="true"><label class="pr-4"> &nbsp;{{ item.class_name }}</label>
                                                    <span v-for="(stm, key, index) in applicaitondetails.strm_set_1" :key="index" >
                                                        <span v-if="item.classId==stm.classId">
                                                            <br>
                                                            <input type="checkbox" checked="true"> <label class="pr-3"> {{ stm.section_name }}</label>
                                                        </span>
                                                    </span>
                                                </span> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="card card-primary card-outline">
                                        <div class="card-body">
                                            <h3 class="card-title">School/ECR/ECCD 2</h3>
                                            <hr>
                                            <div class="form-group row"> 
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label class="mb-0">Proposed Name:</label>
                                                    <span class="text-blue text-bold">{{applicaitondetails.new2Name}}</span>
                                                </div>  
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label class="mb-0">Level:</label>
                                                    <span class="text-blue text-bold">{{applicaitondetails.new2Level}}</span>
                                                </div>  
                                            </div>
                                            <div class="form-group row"> 
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label class="mb-0">Category:</label>
                                                    <span class="text-blue text-bold">{{applicaitondetails.new2Category == 1 ? "Public" :  "Private" }}</span>
                                                </div>  
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label class="mb-0">Dzongkhag:</label>
                                                    <span class="text-blue text-bold">{{applicaitondetails.new2Dzongkhagname}}</span>
                                                </div>  
                                            </div>
                                            <div class="form-group row"> 
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label class="mb-0">Gewog:</label>
                                                    <span class="text-blue text-bold">{{applicaitondetails.new2Gewogname}}</span>
                                                </div>  
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label class="mb-0">Village:</label>
                                                    <span class="text-blue text-bold">{{applicaitondetails.new2Chiwogname}}</span>
                                                </div>  
                                            </div>
                                            <div class="form-group row"> 
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label class="mb-0">Location Type:</label>
                                                    <span class="text-blue text-bold">{{applicaitondetails.new2Location}}</span>
                                                </div>  
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label class="mb-0">Geopolitically Located:</label>
                                                    <span class="text-blue text-bold">{{applicaitondetails.new2IsGeoLocated == 1 ? "Yes" :  "No"}}</span>
                                                </div>  
                                            </div>
                                            <div class="form-group row"> 
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label class="mb-0">Is SEN School:</label>
                                                    <span class="text-blue text-bold">{{applicaitondetails.new2IsSenSchool == 1 ? "Yes" :  "No"}}</span>
                                                </div>  
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label class="mb-0">Co-located with Parent School:</label>
                                                    <span class="text-blue text-bold">{{applicaitondetails.new2IsCoLocated == 1 ? "Yes" :  "No"}}</span>
                                                </div>  
                                            </div>
                                            <div class="form-group row"> 
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label class="mb-0">Parent School:</label>
                                                    <span class="text-blue text-bold">{{applicaitondetails.parent_school2}}</span>
                                                </div>  
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <label class="mb-0">Select classes and streams</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                                                <span v-for="(item, index) in  applicaitondetails.class_det_2" :key="index">
                                                    <br>
                                                    <input type="checkbox" checked="true"><label class="pr-4"> &nbsp;{{ item.class_name }}</label>
                                                    <span v-for="(stm, key, index) in applicaitondetails.strm_set_2" :key="index" >
                                                        <span v-if="item.classId==stm.classId">
                                                            <br>
                                                            <input type="checkbox" checked="true"> <label class="pr-3"> {{ stm.section_name }}</label>
                                                        </span>
                                                    </span>
                                                </span> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             </div>
                        </div>
                        
                        
                        <Workflow
                            :appNo="applicaitondetailsform.applicationNo"
                        />
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0">Remarks</label>
                                <textarea class="form-control" @change="remove_error('remarks')" v-model="applicaitondetailsform.remarks" id="remarks"></textarea>
                                <span class="text-danger" id="remarks_err"></span>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('organization-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-danger" @click="shownexttab('reject')"> <i class="fa fa-times"></i>Reject </button>
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
            proprietorList:[],
            class_section:[],
            sectionList:[],
            org1_details:'',
            applicaitondetails:'',
            applicaitondetailsform: new form({
                id: '',applicationNo:'',application_date:'',status:'',remarks:'',actiontype:'',service:'bifurcation',screen_id:'',work_status:''
            }),
        } 
    },
    methods:{
        loadestablishmentapplicationdetails(appId,type){
            axios.get('organization/loadbifurcationForVerification/'+appId+'/'+type)
            .then((response) => {  
                let data=response.data.data;
                this.getOrgDetails(data.parentOrgId);
                this.applicaitondetailsform.applicationNo               =   data.applicationNo;
                this.applicaitondetailsform.application_date            =   data.application_date;
                this.applicaitondetailsform.screen_id            =   response.data.screen_id;
                this.applicaitondetailsform.work_status            =   response.data.sequence;
                this.class_section                                      =   data.class_section;
                this.sectionList                                        =   data.sections;
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
        getOrgDetails(id){
            let uri = '/organization/loadCurrentOrgDetails/'+id;
            axios.get(uri)
            .then(response =>{
                this.org1_details=response.data.data;
                this.org1_details.village=response.data.data.village.data.name;
                this.org1_details.gewog=response.data.data.gewog.data.name; 
                this.org1_details.dzongkhag=response.data.data.dzongkhag.data.name;
            });
        },
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        }, 
        shownexttab(nextclass){
            if(nextclass=="reject" || nextclass=="verify" || nextclass=="approve"){
                let action=true;
                if(nextclass=="reject" && this.applicaitondetailsform.remarks==""){
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
                            this.applicaitondetailsform.actiontype=nextclass;
                            this.applicaitondetailsform.post('organization/updateBifurcationApplication')
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
        this.applicaitondetailsform.applicationNo=this.$route.params.data.application_number;
        this.loadestablishmentapplicationdetails(this.$route.params.data.application_number,this.$route.params.type);
    }
}
</script>