<template>
    <div>
        <ol class="mb-1 ml-xl-n3 mr-xl-n2 pl-3" style="background-color:#E5E5E5">
            <li class="pl-2 form-inline "><h6 class="pt-1">Verification/Approval for Location Change of ECCD Centre's </h6></li>
        </ol>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-body pt-0 mt-1">
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
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                <label class="mb-0">Name:</label>
                                <span class="text-blue text-bold">{{applicationOrgdetails.name}}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Dzongkhag:</label>
                                <span class="text-blue text-bold">{{dzongkhagArray[applicationOrgdetails.dzongkhagId]}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Gewog:</label>
                                <span class="text-blue text-bold" id="gewogid"></span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Chiwog:</label>
                                <span class="text-blue text-bold" id="vilageId"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-if="applicationdetails.location_type!=null">
                                <label class="mb-0">Location Type:</label>
                                <span class="text-blue text-bold">{{applicationdetails.location_type}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Is Co-located with Parent School:</label>
                                <span class="text-blue text-bold">{{ applicationOrgdetails.coLocatedParent  == 1 ? "Yes" :  "No"}}</span>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" v-if="applicationOrgdetails.parent_school!=''">
                                <label class="mb-0">Parent School:</label>
                                <span class="text-blue text-bold">
                                    {{ applicationOrgdetails.parent_school}}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="callout callout-success">
                        <h5><u>Proposed Change Details</u></h5>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Dzongkhag:</label>
                                <span class="text-blue text-bold">{{dzongkhagArray[applicationdetails.dzongkhagId]}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Gewog:</label>
                                <span class="text-blue text-bold" id="appgewogid"></span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Chiwog:</label>
                                <span class="text-blue text-bold" id="appvilageId"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-if="applicationdetails.app_location_type!=null">
                                <label class="mb-0">Location Type:</label>
                                <span class="text-blue text-bold">{{applicationdetails.app_location_type}}</span>
                            </div>
                        </div>
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
            count:1,
            showsearch:false,
            feasibilityReport:false,
            final_feasibilityReport:false,
            final_showsearch:false,
            access_level:'',
            proprietorList:[],
            applicationdetails:[],
            applicationOrgdetails:[],
            searchProviderList:[],
            taskDet:[],
            departmentList:[],
            staffList:[],

            dzongkhagArray:{},
            gewogArray:{},
            villageArray:{},

            screenId:'',
            SysRoleId:'',
            Sequence:'',
            Status_Name:'',
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
    methods: {
        loadapplicationdetails(appId,type){
            alert(appId+type);
            axios.get('organizationApproval/loadEstbDetailsForVerification/'+appId+'/'+type)
            .then((response) => {
                let data=response.data.data;
                this.form.applicationNo=data.application_no;
                this.form.servicename=data.establishment_type;
                this.search.id=data.id;
                this.applicationdetails=data;
                this.applicationOrgdetails=data.orgDetails;
                this.getGewogList(response.data.data.dzongkhagId,data.orgDetails.gewogId,'gewogid');
                this.getvillagelist(response.data.data.gewogId,data.orgDetails.chiwogId,'vilageId');

                this.getGewogList(response.data.data.dzongkhagId,response.data.data.gewogId,'appgewogid');
                this.getvillagelist(response.data.data.gewogId,response.data.data.chiwogId,'appvilageId');

                // data.attachments.forEach(element => {
                //     if(element.upload_type=="update_document" || element.upload_type=="Update_Feasibility_Study_Report"){
                //         this.feasibilityReport=true;
                //     }
                //     if(element.upload_type=="final_update_document" || element.upload_type=="Update_Final_Feasibility_Study_Report"){
                //         this.final_feasibilityReport=true;
                //     }

                // });
                this.taskDet=response.data.app_stage;
                this.getteamVerificationList();

                let status_id=parseInt(this.taskDet.status_id)+1;
                for(let i=0;i<parseInt(this.taskDet.status_id);i++){
                    $('#verificationattachment'+i).show();
                    if(i==1){
                        $('#attachment_name'+i).html('Notify for Tentative Date of Feasibility Study');
                    }
                    if(i==3){
                        $('#attachment_name'+i).html('Notify for Approval in Principle');
                    }
                    if(i==4){
                        $('#attachment_name'+i).html('Requesting for Final Assessment');
                    }
                    if(i==5){
                        $('#attachment_name'+i).html('Notify for Tentative Date of Final Assessment');
                    }
                }
                if(status_id==2){ //initially submitted
                    $('#setverifyingagency').show();
                    $('#getverifyingagency').hide();
                }else{
                    $('#setverifyingagency').hide();
                    $('#getverifyingagency').show();
                    if(status_id==3 && this.access_level=="Ministry"){ //enable the button to update team verification
                        this.showsearch=true;
                        $('#verifier_team').show();
                    }
                    if(status_id==7 && this.access_level=="Ministry"){ //enable the button to update team verification
                        this.final_showsearch=true;
                        $('#final_verifier_team').show();
                    }
                }
                if(status_id==6){ //show final verifying agencies
                    $('#finalverificationdetials').show();
                    $('#getfinalverifyingagency').hide();
                }

                $('#updateBtn').show();
                //hide update button for deo/teo
                if((status_id==3 || status_id==4 || status_id==5 ||  status_id==7 || status_id==8 || status_id==9) && this.access_level=="Dzongkhag"){
                    $('#updateBtn').hide();
                    $('#rejectbtn').hide();
                    if(status_id==3 && !this.feasibilityReport){//show update button at deo level to update feasibility study report
                        $('#update_document_btn').show();
                    }
                    if(status_id==7 && !this.final_feasibilityReport){//show update button at deo level to update final feasibility study report
                        $('#update_document_btn').show();
                    }
                }

                if(!this.taskDet.w_config_status.toLowerCase().includes('submitted')){
                    $('#staff_type').empty();
                    let option='<option value="">--Select--</option>';
                    this.form.verifying_agency_verified_list=[];
                    this.form.updated_final_verifying_agency_list=[];
                    for(let i=0;i<data.app_verification.length;i++){
                        if(data.app_verification[i].type!=null && data.app_verification[i].type=="Initial_Assessment"){
                            this.form.verifying_agency_verified_list.push({department:data.app_verification[i].department_name, division:data.app_verification[i].division_name});
                            $('#tentative_remarks').val(data.app_verification[i].remarks);
                            $('#tentative_date').val(data.app_verification[i].tentativeDate);
                            this.form.tentative_date=data.app_verification[i].tentativeDate;
                            $('#tentative_date').prop('disabled',true);
                            option+='<option value="'+data.app_verification[i].verifyingAgency+'">'+data.app_verification[i].department_name+'( '+data.app_verification[i].division_name+')</option>';
                        }
                        if(data.app_verification[i].type!=null && data.app_verification[i].type=="Final_Assessment"){
                            $('#finalverificationdetials').show();
                            $('#setfinalverifyingagency').hide();
                            this.form.updated_final_verifying_agency_list.push({department:data.app_verification[i].department_name, division:data.app_verification[i].division_name});
                            $('#final_tentative_remarks').val(data.app_verification[i].remarks);
                            $('#final_tentative_date').val(data.app_verification[i].tentativeDate);
                            $('#final_tentative_date').prop('disabled',true);
                            this.form.final_tentative_date=data.app_verification[i].tentativeDate;
                            option+='<option value="'+data.app_verification[i].verifyingAgency+'">'+data.app_verification[i].department_name+'( '+data.app_verification[i].division_name+')</option>';
                        }
                    }
                    $('#staff_type').append(option);
                }
                axios.get('organizationApproval/getScreenId/'+this.taskDet.service_name+'__'+status_id)
                .then(response => {
                    let data = response.data[0];
                    if(data!=undefined){
                        this.screenId=data.screen;
                        this.SysRoleId=data.SysRoleId;
                        this.Sequence=data.Sequence;
                        this.Status_Name=data.Status_Name;
                        $('#attname').html(data.Name);
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
            })
            .catch((error) => {
                console.log("Error: "+error);
            });
        },
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
        async getGewogList(dzongkhag,gewogId,targetId){
            let data = await this.loadgewogList(dzongkhag);
            this.gewog_list = data;
            for(let i=0;i<data.length;i++){
                this.gewogArray[data[i].id] = data[i].name;
            }
            $('#'+targetId).html(this.gewogArray[gewogId]);
        },
        async getvillagelist(gewogId,vil_id,targetId){
            let data = await this.loadvillageList(gewogId);
            for(let i=0;i<data.length;i++){
                this.villageArray[data[i].id] = data[i].name;
            }
            $('#'+targetId).html(this.villageArray[vil_id])
        },
        getteamVerificationList(){
            axios.get('organizationApproval/loadTeamVerificationList/'+this.search.id)
            .then(response => {
                let data = response.data.data;
                this.searchProviderList=data;
                if(data!=null && data!="" && data.length>0){
                    data.forEach(element => {
                        $('#verifier_team').show();
                        if(element.type=="final_verifier_team"){
                            $('#final_verifier_team').show();
                        }
                    });
                }
            })
            .catch(errors => {
                console.log(errors)
            });
        },
        shownexttab(nextclass){
            if(nextclass=="final-tab"){
                Swal.fire({
                    text: "Are you sure you wish to save this details ?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        this.form.post('organization/saveChangeBasicDetails')
                        .then((response) => {
                            if(response!=""){
                                if(response.data=="No Screen"){
                                    Toast.fire({
                                        icon: 'error',
                                        title: 'No dont have privileged to submit this application. Please contact system administrator'
                                    });
                                }
                                if(response!="" && response!="No Screen"){
                                    let message="Application for Change of location type has been updated and send for approval. <br><b>Thank You !</b>";
                                    this.$router.push({name:'location_change_acknowledgement',params: {data:message}});
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Change details is saved successfully'
                                    });
                                }
                            }
                        })
                        .catch((err) => {
                            console.log("Error:"+err)
                        })
                    }
                });
            }
        },
    },

    async mounted() {
        let data= await this.loadactivedzongkhags();
        for(let i=0;i<data.length;i++){
            this.dzongkhagArray[data[i].id] = data[i].name;
        }
        this.loadapplicationdetails(this.$route.params.data.application_number,this.$route.params.type);

    }
}
</script>
