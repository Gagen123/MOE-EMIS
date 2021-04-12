<template>
    <div>
        <div class="card card-success card-outline">
                <div class="card-header">
                    <h3 class="card-title">Details of School</h3>
                </div>
                <div class="card-body" >
                    <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Application Number:</label>
                                <span class="text-indigo-600">{{form.applicationNo}}</span>
                            </div>
                        </div>
                    <div class="form-group row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Code:</label>
                            <span class="text-indigo-600" id="scode">{{form.code}}</span>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Name:</label>
                            <span class="text-indigo-600" id="sname">{{form.name}}</span>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Category:</label>
                        <span class="text-indigo-600" id="scategory">{{form.category}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Level:</label>
                            <span class="text-indigo-600" id="slevel">{{form.level}}</span>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Dzongkhag:</label>
                            <span class="text-indigo-600" id="sdzongkhag">{{form.dzongkhag}}</span>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Gewog:</label>
                            <span class="text-indigo-600" id="sgewog">{{form.gewog}}</span>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Chiwog:</label>
                            <span class="text-indigo-600" id="schiwog">{{form.chiwog}}</span>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Location Type:</label>
                            <span class="text-indigo-600" id="slocationtype">{{form.locationType}}</span>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Geopolitically Located:</label>
                            <span class="text-indigo-600" id="sgeo">{{form.geoLocated}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>SEN School:</label>
                            <span class="text-indigo-600" id="ssen">{{form.senSchoo}}</span>
                        </div>
                    </div>
                    <div class="form-group row" v-if="form.senSchool==1">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                            <label class="mb-0">Parent School:</label>
                            <span class="text-blue text-bold">{{form.parentSchool}}</span>
                        </div>   
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label class="mb-0">Co-located with Parent School</label>
                            <span class="text-blue text-bold">
                                {{ form.coLocated  == 1 ? "Yes" :  "No"}}
                            </span>
                        </div> 
                    </div>
                    <div v-if="form.category==0">
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
                    <div class="form-group row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Reason:</label>
                            <select class="form-control" v-model="form.reason" readonly>
                                <option value="1">Closing for reason 1</option>
                                <option value="2">Closing for reason 2</option>
                            </select>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <label>Remarks:</label>
                            <textarea class="form-control" v-model="form.remark" readonly> Explanation of the school closing</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Your Remarks:</label>
                            <textarea class="form-control" v-model="form.yourRemark" id="remarks"></textarea>
                        </div>
                    </div>
                    <div class="row form-group fa-pull-right">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-flat btn-danger" @click="shownexttab('reject')"> <i class="fa fa-times"></i> Reject </button>
                            <button class="btn btn-flat btn-primary" @click="shownexttab('verify')"> <i class="fa fa-forward"></i>Verify </button>
                            <button class="btn btn-flat btn-dark" @click="shownexttab('approve')"> <i class="fa fa-check"></i>Approve </button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            form: new form({
                id: '',code:'',name:'',category:'1',level:'',dzongkhag:'',gewog:'',chiwog:'',
                locationType:'',geoLocated:'',senSchool:'',reason:'',remark:'',yourRemark:'',
                cid:'',name:'',phoneNo:'',email:'',parentSchool:'',coLocatedParent:'0',applicationNo:''
            }), 
        }
    },

    methods:{

        /**
         * method to load previous org details
         */
        loadCClosureApplicationDetails(appId,type){
            axios.get('organization/loadClosureApplicationDetails/'+appId+'/'+type)
            .then((response) => {  
                let data=response.data.data;
                this.appicationDetailsForm.applicationNo        =   data.applicationNo;
                
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
        },
    },

    mounted(){
        this.form.applicationNo=this.$route.params.data.application_number;
        this.loadCClosureApplicationDetails(this.$route.params.data.application_number,this.$route.params.type);
    }
}
</script>