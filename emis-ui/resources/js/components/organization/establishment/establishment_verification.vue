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
                            <h4><u>Organization Details</u></h4>
                            <div class="form-group row"> 
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Proposed Name:</label>
                                    <span class="text-blue text-bold">{{applicationdetails.org_details.proposedName}}</span>
                                </div>  
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Level:</label>
                                    <span class="text-blue text-bold">{{levelList[applicationdetails.org_details.level]}}</span>
                                </div>  
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Category:</label>
                                    <span class="text-blue text-bold">
                                        {{ applicationdetails.category  == 1 ? "Public" :  "Private"}}
                                    </span>
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
                                    <span class="text-blue text-bold">{{locationList[applicationdetails.org_details.locationTypeId]}}</span>
                                </div>   
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Geopolitically Located:</label>
                                    <span class="text-blue text-bold">
                                        {{ applicationdetails.geopolicaticallyLocated  == 1 ? "Yes" :  "No"}}
                                    </span>
                                </div> 
                            </div>

                            <div class="form-group row" v-if="applicationdetails.senSchool==1">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                                    <label class="mb-0">Parent School:</label>
                                    <span class="text-blue text-bold">{{applicationdetails.parentSchool}}</span>
                                </div>   
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Co-located with Parent School</label>
                                    <span class="text-blue text-bold">
                                        {{ applicationdetails.coLocated  == 1 ? "Yes" :  "No"}}
                                    </span>
                                </div> 
                            </div>
                            <div v-if="applicationdetails.category==0">
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
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 fa-pull-right">
                                <button class="btn btn-primary" @click="shownexttab('class-tab')">Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div> 
                    <div class="tab-pane fade tab-content-details" id="class-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0">Select classes and streams</label>
                            </div>
                        </div> 
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                            <span v-for="(item, key, index) in  class_section" :key="index">
                                <br>{{calssArray}}
                                <label class="pr-4"> &nbsp;{{ calssArray[item.classId] }}</label>
                                <span v-if="item.class=='Class 11' || item.class=='Class 12'">
                                    <br>
                                    <!-- Here we are taking the class stream mapping id. Do not need to use padding-->
                                    <input type="checkbox" v-model="classStreamForm.stream"  :id="item.id" :value="item.id"> <label class="pr-3"> {{ item.stream  }}</label>
                                </span>
                            </span> 

                            <!-- <span v-for="(item, index) in  class_section" :key="index">
                                <br>
                                <input type="checkbox" checked="true"><label class="pr-4"> &nbsp;{{ calssArray[item.classId] }}</label>
                                 <span v-for="(stm, key, index) in sectionList" :key="index" >
                                    <span v-if="item.classId==stm.classId">
                                        <br>
                                        <input type="checkbox" checked="true"> <label class="pr-3"> {{ stm.section_name }}</label>
                                    </span>
                                </span> 
                            </span>  -->
                        </div>
                        <Workflow
                            :appNo="applicationdetails.applicationNo"
                        />
                        
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
            calssArray:{},
            sectionList:[],
            applicationdetails:[],
            levelList:{},
            locationList:[],
            applicationOrgdetails:[],
            classStreamForm: new form({
                id: '',class:[], stream:[], status:'submitted'
            }),
            form: new form({
                id: '',applicationNo:'',actiontype:'',remarks:''
            }), 
        } 
    },
    methods:{
        loadestablishmentapplicationdetails(appId,type){
            axios.get('organization/loadEstbDetailsForVerification/'+appId+'/'+type)
            .then((response) => {  
                let data=response.data.data;
                this.applicationdetails=data;
                // this.applicationOrgdetails=JSON.stringify(data.org_details);
                this.class_section=data.org_class_stream;
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
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        }, 
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
                            this.form.applicationNo=this.applicationdetails.applicationNo;
                            this.form.actiontype=nextclass;
                            this.form.post('organization/updateNewEstablishmentApplication')
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
                    this.calssArray[data[i].id] = data[i].name; 
                }
            });
        },
    },
    mounted(){
        this.getLevel();
        this.getLocation();
        this.getClassStream();
        this.getClass();
        // this.applicationdetails.applicationNo=this.$route.params.data.application_number;
        this.loadestablishmentapplicationdetails(this.$route.params.data.application_number,this.$route.params.type);
        
        
    }
}
</script>