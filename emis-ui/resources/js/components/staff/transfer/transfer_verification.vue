<template>
    <div>
        <ol class="mb-1 ml-xl-n3 mr-xl-n2 pl-3" style="background-color:#E5E5E5">
            <li class="pl-2 form-inline "><h6 class="pt-1">Tranfer Verification/Approval</h6></li>
        </ol>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <li class="nav-item application-tab" @click="shownexttab('application-tab')">
                        <a class="nav-link active" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Application Details </label>
                        </a>
                    </li>
                    <li class="nav-item undertaking-tab" @click="shownexttab('undertaking-tab')">
                        <a class="nav-link" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Options & Undertaking</label>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body pt-0 mt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="application-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="callout callout-success">
                            <span><label><u>Applicant Detials</u></label></span>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Applicant Name:</label><br>
                                    <span class="text-blue text-bold">{{app_details.name}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Gender:</label><br>
                                    <span class="text-blue text-bold">{{genderArray[app_details.sex_id]}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                     <label class="mb-0">Transfer Reason:</label><br>
                                    <span class="text-blue text-bold">{{reasonList[form.transfer_reason_id]}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label class="mb-0">Brief description for seeking transfer</label><br>
                                    <span class="text-blue text-bold">{{form.description}}</span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" @click="shownexttab('undertaking-tab')">Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade tab-content-details" id="undertaking-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0.5">Transfer Preferences</label>
                                <table id="participant-table" class="table w-100 table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SlNo</th>
                                            <th>Preferences</th>
                                            <th>Dzongkhag/Thromde</th>
                                            <th id="approveDzohead" style="display:none">Select Dzongkhag</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Preferences 1</td>
                                            <td>
                                                <span class="text-blue text-bold">{{dzongkhagList[form.preference_dzongkhag1]}}</span>
                                            </td>
                                            <td id="approveDzo1" style="display:none">
                                                <input type="radio" name="dzongkhagApproved" :value="form.preference_dzongkhag1" v-model="form.dzongkhagApproved" id="approvedDzongkhag1">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Preferences 2</td>
                                            <td>
                                                <span class="text-blue text-bold" v-if="form.preference_dzongkhag2!=''">{{dzongkhagList[form.preference_dzongkhag2]}}</span>
                                            </td>
                                            <td id="approveDzo2" style="display:none">
                                                <input type="radio" v-model="form.dzongkhagApproved" name="dzongkhagApproved" :value="form.preference_dzongkhag2" id="approvedDzongkhag2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Preferences 3</td>
                                            <td>
                                                <span class="text-blue text-bold" v-if="form.preference_dzongkhag3!=''">{{dzongkhagList[form.preference_dzongkhag3]}}</span>
                                            </td>
                                            <td id="approveDzo3" style="display:none">
                                                <input type="radio" v-model="form.dzongkhagApproved" :value="form.preference_dzongkhag3" name="dzongkhagApproved" id="approvedDzongkhag3">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0.5">Attachments</label>
                                <table id="participant-table" class="table w-100 table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Attachment Name</th>
                                            <th>File</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for='(attach,count) in draft_attachments' :key="count+1">
                                            <td>
                                                {{attach.user_defined_name}}
                                            </td>
                                            <td>
                                                <a href="#" @click="openfile(attach)" class="fa fa-eye"> View</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- <Workflow
                            :appNo="form.application_no"
                        /> -->
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
                                <button class="btn btn-success" @click="shownexttab('application-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
                                 <button class="btn btn-danger" @click="shownexttab('reject')"> <i class="fa fa-times"></i>Reject </button>
                                <button class="btn btn-info text-white" @click="shownexttab('verify')" style="display:none"  id="verifyId"> <i class="fa fa-forward"></i>Verify </button>
                                <button class="btn btn-primary" @click="shownexttab('approve')" style="display:none" id="approveId"> <i class="fa fa-check"></i>Approve </button>
                                <button class="btn btn-primary" @click="shownexttab('confirm')" style="display:none" id="confirm"> <i class="fa fa-check"></i>Confirm </button>
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
            t_from_data:'',
            t_to_date:'',
            t_year:'',
            t_remarks:'',
            t_id:'',
            app_details:'',
            genderArray:{},
            positiontitleList:{},
            reasonList:{},
            dzongkhagList:{},
            draft_attachments:[],
            working_history_list:[],
            training_details_list:[],
            form: new form({
                id: '',
                application_no:'',
                staff_id: '',
                status_id:'',
                service_name:'',
                transfer_reason_id:'',
                description:'',
                transferType:'',
                preference_dzongkhag1:'',
                preference_dzongkhag2:'',
                preference_dzongkhag3:'',
                attachments:
                [{
                    file_name:'',attachment:''
                }],
                ref_docs:[],
                remarks:'',
                dzongkhagApproved:'',
                actiontype:'',
            }),
        }
    },
    methods:{
        loadtransferdetails(appId,type){
            axios.get('staff/transfer/loadtrainsferDetails/'+appId+'/'+type)
            .then((response) =>{
                let data=response.data.data;
                this.gettransferconfig(data.transfer_window_id);
                this.getStaffDetials(data.staff_id);
                this.form.id=data.id;
                this.form.transfer_reason_id=data.transfer_reason_id;
                this.form.description=data.description;
                this.form.staff_id=data.staff_id;
                this.form.transferType=data.transferType;
                
                this.draft_attachments=data.attachments;

                for(let i=0;i<data.preferences.length;i++){
                    if(i==0){
                        this.form.preference_dzongkhag1     =   data.preferences[i].dzongkhag_id;
                        $('#approvedDzongkhag1').val(data.preferences[i].dzongkhag_id);
                    }
                    if(i==1){
                        this.form.preference_dzongkhag2     =   data.preferences[i].dzongkhag_id;
                        $('#approvedDzongkhag2').val(data.preferences[i].dzongkhag_id);
                    }
                    if(i==2){
                        this.form.preference_dzongkhag3     =   data.preferences[i].dzongkhag_id;
                        $('#approvedDzongkhag3').val(data.preferences[i].dzongkhag_id);
                    }
                }
                if(this.form.status_id!=10 && this.form.status_id!=0){
                    $('#verifyId').show();
                }
                if(this.form.status_id==2 ){
                    $('#approveId').show();
                    $('#verifyId').hide();
                    $('#approveDzohead').show();
                    $('#approveDzo1').show();
                    $('#approveDzo2').show();
                    $('#approveDzo3').show();
                    
                    
                }
            })
            .catch((error) =>{
                console.log("Error: "+error);
            });
        },
        gettransferconfig(window_id){
            axios.get('staff/transfer/getcurrentTransferWindowDetails/'+window_id)
            .then(response => {
                let data = response.data.data;
                if(data!=null){
                    this.t_from_data=data.from_date;
                    this.t_to_date=data.to_date;
                    this.t_year=data.year;
                    this.t_remarks=data.remarks;
                    this.t_id=data.id;
                }
            })
            .catch(errors =>{
                console.log(errors)
            });
        },
        getStaffDetials(staffId){
            axios.get('loadCommons/viewStaffDetails/by_id/'+staffId)
            .then(response =>{
                let data = response.data.data;
                if(data!=null){
                    this.app_details=data;
                }
            })
            .catch(errors =>{
                console.log(errors)
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
                if(nextclass=="approve" && $("input[name='dzongkhagApproved']:checked").val()==undefined){
                    Swal.fire(
                        'error!',
                        'Please select prefernece dzongkhag to approve this Application',
                        'error',
                    );
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
                            this.form.actiontype=nextclass;
                            this.form.dzongkhagApproved=$("input[name='dzongkhagApproved']:checked").val();
                            this.form.post('staff/transfer/updateTransferApplication')
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
        loadGenders(uri="masters/loadGlobalMasters/all_active_gender"){
            axios.get(uri)
            .then(response => {
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.genderArray[data.data.data[i].id] = data.data.data[i].name;
                }
            })
            .catch(function (error) {
                console.log("Error:"+error)
            });
        },
        loadpositionTitleList(uri = 'masters/loadStaffMasters/all_active_position_title'){
            axios.get(uri)
            .then(response =>{
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.positiontitleList[data.data.data[i].id] = data.data.data[i].name;
                }
            })
            .catch(function (error){
                console.log('Error: '+error);
            });
        },
        loadreasons(uri = 'masters/loadStaffMasters/active_transfer'){
            axios.get(uri)
            .then(response => {
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.reasonList[data.data.data[i].id] = data.data.data[i].name;
                }
            })
            .catch(function (error) {
               console.log("Error:"+error)
            });
        },
        loadactivedzongkhagList(uri="masters/loadGlobalMasters/all_active_dzongkhag"){
            axios.get(uri)
            .then(response => {
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.dzongkhagList[data.data.data[i].id] = data.data.data[i].name;
                }
            })
            .catch(function (error) {
                console.log("Error:"+error)
            });
        },
        openfile(file){
            let file_path=file.path+'/'+file.original_name;
            file_path=file_path.replaceAll('/', 'SSS');
            let uri = 'common/viewFiles/'+file_path;
            window.location=uri;
        },
    },
    mounted(){
        this.form.application_no=this.$route.params.data.application_number;
        this.form.status_id=this.$route.params.data.status_id;
        this.loadtransferdetails(this.$route.params.data.application_number,this.$route.params.type);
        this.loadGenders();
        this.gettransferconfig();
        this.loadpositionTitleList();
        this.loadreasons();
        this.getStaffDetials();
        this.loadactivedzongkhagList();
    }
}
</script>
