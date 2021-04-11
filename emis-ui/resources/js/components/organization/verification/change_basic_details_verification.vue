<template>
    <div>
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
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label><u>Previous Details</u></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Name:</label>
                                <span class="text-indigo-600">{{previousDetailsForm.name}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Level:</label>
                                <span class="text-indigo-600">{{previousDetailsForm.level}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Category:</label>
                                <span class="text-indigo-600">{{previousDetailsForm.category == 1 ? "Private" : "Public"}}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Dzongkhag:</label>
                                <span class="text-indigo-600">{{previousDetailsForm.dzongkhag}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Gewog:</label>
                                <span class="text-indigo-600">{{previousDetailsForm.gewog}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Chiwog:</label>
                                <span class="text-indigo-600">{{previousDetailsForm.chiwog}}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Location Type:</label>
                                <span class="text-indigo-600">{{previousDetailsForm.locationType}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Geopolitically Located:</label>
                                <span class="text-indigo-600">{{previousDetailsForm.geoLocated == 1 ? "Yes" : "No"}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>SEN School:</label>
                                <span class="text-indigo-600">{{previousDetailsForm.senSchool == 1 ? "Yes" : "No"}}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Co-located with Parent School:</label>
                                <span class="text-indigo-600">{{previousDetailsForm.parentSchool}}</span>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label><u>Application Details</u></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Name:</label>
                                <span class="text-indigo-600">{{appicationDetailsForm.appName}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Level:</label>
                                <span class="text-indigo-600">{{appicationDetailsForm.appLevel}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Category:</label>
                                <span class="text-indigo-600">{{appicationDetailsForm.appCategory}}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Dzongkhag:</label>
                                <span class="text-indigo-600">{{appicationDetailsForm.appDzongkhag}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Gewog:</label>
                                <span class="text-indigo-600">{{appicationDetailsForm.appGewog}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Chiwog:</label>
                                <span class="text-indigo-600">{{appicationDetailsForm.appChiwog}}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Location Type:</label>
                                <span class="text-indigo-600">{{appicationDetailsForm.appLocationType}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Geopolitically Located:</label>
                                <span class="text-indigo-600">{{appicationDetailsForm.appGeoLocated}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>SEN School:</label>
                                <span class="text-indigo-600">{{appicationDetailsForm.appSenSchool}}</span>
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
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" @click="shownexttab('class-tab')">Save & Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade tab-content-details" id="class-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label><u>Previous Details</u></label>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <ul>
                                            <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;PP</label></li>
                                            <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;I</label></li>
                                            <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;II</label></li>
                                            <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;III</label></li>
                                            <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;IV</label></li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <ul>
                                            <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;V</label></li>
                                            <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;VI</label></li>
                                            <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;VII</label></li>
                                            <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;VIII</label></li>
                                            <li><input type="checkbox" checked><label> &nbsp;&nbsp;&nbsp;IX</label></li>
                                            
                                        </ul>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <ul>
                                            <li><input type="checkbox" checked><label> &nbsp;&nbsp;&nbsp;X</label></li>
                                            <li><input type="checkbox"  id="xlsection_check" @click="showchild('xlsection')"><label> &nbsp;&nbsp;&nbsp;XI</label></li>
                                            <ul id="xlsection" style="display:none"  class="pl-4">
                                                <li><input type="checkbox" checked><label> &nbsp;&nbsp;&nbsp;Science</label></li>
                                                <li><input type="checkbox" checked><label> &nbsp;&nbsp;&nbsp;Commerce</label></li>
                                                <li><input type="checkbox" checked><label> &nbsp;&nbsp;&nbsp;Arts</label></li>
                                            </ul>
                                           <li><input type="checkbox"  id="xlisection_check" @click="showchild('xlisection')"><label> &nbsp;&nbsp;&nbsp;XII</label></li>
                                            <ul id="xlisection" style="display:none" class="pl-4">
                                                <li><input type="checkbox" checked><label> &nbsp;&nbsp;&nbsp;Science</label></li>
                                                <li><input type="checkbox" checked><label> &nbsp;&nbsp;&nbsp;Commerce</label></li>
                                                <li><input type="checkbox" checked><label> &nbsp;&nbsp;&nbsp;Arts</label></li>
                                            </ul>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label><u>Application Details</u></label>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <ul>
                                            <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;PP</label></li>
                                            <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;I</label></li>
                                            <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;II</label></li>
                                            <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;III</label></li>
                                            <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;IV</label></li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <ul>
                                            <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;V</label></li>
                                            <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;VI</label></li>
                                            <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;VII</label></li>
                                            <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;VIII</label></li>
                                            <li><input type="checkbox" checked><label> &nbsp;&nbsp;&nbsp;IX</label></li>
                                            
                                        </ul>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <ul>
                                            <li><input type="checkbox" checked><label> &nbsp;&nbsp;&nbsp;X</label></li>
                                            <li><input type="checkbox" checked id="xlsection_check" @click="showchild('xlsection')"><label> &nbsp;&nbsp;&nbsp;XI</label></li>
                                            <ul id="xlsection"   class="pl-4">
                                                <li><input type="checkbox" checked><label> &nbsp;&nbsp;&nbsp;Science</label></li>
                                                <li><input type="checkbox" checked><label> &nbsp;&nbsp;&nbsp;Commerce</label></li>
                                                <li><input type="checkbox" checked><label> &nbsp;&nbsp;&nbsp;Arts</label></li>
                                            </ul>
                                           <li><input type="checkbox" checked id="xlisection_check" @click="showchild('xlisection')"><label> &nbsp;&nbsp;&nbsp;XII</label></li>
                                            <ul id="xlisection"  class="pl-4">
                                                <li><input type="checkbox" checked><label> &nbsp;&nbsp;&nbsp;Science</label></li>
                                                <li><input type="checkbox" checked><label> &nbsp;&nbsp;&nbsp;Commerce</label></li>
                                                <li><input type="checkbox" checked><label> &nbsp;&nbsp;&nbsp;Arts</label></li>
                                            </ul>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Remarks</label>
                                <textarea class="form-control" id="remarks"></textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('organization-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-flat btn-danger" @click="shownexttab('reject')"> <i class="fa fa-times"></i> Reject </button>
                                <button class="btn btn-flat btn-primary" @click="shownexttab('verify')"> <i class="fa fa-forward"></i>Verify </button>
                                <button class="btn btn-flat btn-dark" @click="shownexttab('approve')"> <i class="fa fa-check"></i>Approve </button>
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
            previousDetailsForm:new form({
                id:'',organizationId:'145f5a09-06b8-407a-8f33-deecc6a2b861',name:'',level:''
                ,category:'',dzongkhag:'',gewog:'',chiwog:'',locationType:'',geoLocated:''
                ,senSchool:'', parentSchool:'',coLocatedParent:'',cid:'',fullName:'',phoneNo:''
                ,email:'',
            }),
            appicationDetailsForm:new form({
                id:'',appOrganizationId:'',appName:'',appLevel:'',appCategory:'',appDzongkhag:'',appGewog:'',
                appChiwog:'',appLocationType:'',appGeoLocated:'',appSenSchool:'', appParentSchool:'',
                appCoLocatedParent:'',appCid:'',appFullName:'',appPhoneNo:'',appEmail:'',
            })
        }
    },

    methods:{

        /**
         * method to load previous org details
         */
        loadCurrentOrgDetails(){
            axios.get('organization/loadCurrentOrgDetails/'+this.form.organizationId)
            .then((response) => {  
                alert("m here");
                let data=response.data.data;
                this.previousDetailsForm.id              =   data.id;
                this.previousDetailsForm.name            =   data.name;
                this.previousDetailsForm.level           =   data.levelId;
                this.previousDetailsForm.category        =   data.category;
                this.previousDetailsForm.locationType    =   data.locationId;

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
                            this.form.applicationNo=this.applicaitondetailsform.applicationNo;
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
    },

    mounted(){
        this.loadCurrentOrgDetails();
    }
}
</script>