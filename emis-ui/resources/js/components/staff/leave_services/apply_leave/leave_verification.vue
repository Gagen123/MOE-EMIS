<template>
    <div>
        <ol class="mb-1 ml-xl-n3 mr-xl-n2 pl-3" style="background-color:#E5E5E5">
            <li class="pl-2 form-inline "><h6 class="pt-1">Leave Verification/Approval</h6></li>
        </ol>
        <div id="maindiv">
            <div class="callout callout-success">
                <span><label><u>Application Detials</u></label></span>
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="mb-0">Application Number:</label><br>
                        <span class="text-blue text-bold">{{form.application_number }}</span>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="mb-0">Application Date:</label><br>
                        <span class="text-blue text-bold">{{reverseDate1(form.date_of_application)}}</span>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Leave Type:</label><br>
                        <span class="text-blue text-bold">{{form.leave_type_name}}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="mb-0">From Date:</label><br>
                        <span class="text-blue text-bold">{{reverseDate1(form.from_date) }}</span>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="mb-0">To Date:</label><br>
                        <span class="text-blue text-bold">{{reverseDate1(form.to_date)}}</span>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>No. Days:</label><br>
                        <span class="text-blue text-bold">{{form.no_days}}</span>
                    </div>
                </div>
            </div>
            <div class="callout callout-success">
                <span><label><u>Leave Detials</u></label></span>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Applicant Name:</label> <br>
                        <span class="text-blue text-bold">{{form.appName}}</span>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Gender:</label> <br>
                        <span class="text-blue text-bold">{{genderArray[form.gender]}}</span>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Position Title:</label><br>
                        <span class="text-blue text-bold">{{positiontitleList[form.position_title]}}</span>
                    </div>
                </div>
                 <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Contact Number:</label> <br>
                        <span class="text-blue text-bold">{{form.contact_number}}</span>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Email:</label> <br>
                        <span class="text-blue text-bold">{{form.email}}</span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pt-4">
                        <label>Details:</label>
                        <span class="text-blue text-bold">{{form.reason}}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label class="mb-0">Upload the Required Documents<span class="text-danger">*</span></label>
                    </div>
                </div>
                <div class="card">
                    <div class="form-group row">
                        <div class="card-body col-lg-12 col-md-12 col-sm-12 col-xs-8">
                            <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>File Name</th>
                                        <th>Upload File</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for='(attach,count) in applicationdetailsatt' :key="count+1" :id="'attach'+count">
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
                </div>
                <Workflow :appNo="form.application_number" />
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label class="mb-0">Remarks</label>
                        <textarea class="form-control" @change="remove_error('remarks')" v-model="form.remarks" id="remarks"></textarea>
                        <span class="text-danger" id="remarks_err"></span>
                    </div>
                </div>
                <hr>
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <button class="btn btn-info text-white" @click="shownexttab('verify')" style="display:none" id="verifyId"> <i class="fa fa-forward"></i>Verify </button>
                        <button class="btn btn-primary" @click="shownexttab('approve')" style="display:none" id="approveId"> <i class="fa fa-check"></i>Approve </button>
                        <button class="btn btn-primary" @click="shownexttab('confirm')" style="display:none" id="confirm"> <i class="fa fa-check"></i>Confirm </button>
                        <button class="btn btn-danger" @click="shownexttab('reject')"> <i class="fa fa-times"></i>Reject </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Workflow from "../../../common/view_workflow_details";
export default {
    components: {
        Workflow,
    },
    data(){
        return {
            genderArray:{},
            applicationdetailsatt:[],
            positiontitleList:{},
            form: new form({
                application_number:'',
                application_no:'',
                from_date:'',
                to_date:'',
                no_days:'',
                reason:'',
                staff_id:'',
                appName:'',
                leave_type_id:'',
                leave_type_name:'',
                date_of_application:'',
                remarks:'',
                status_id:'',
                actiontype:'',
            })
        }
    },
    methods: {
        loadgenderList(uri = 'masters/loadGlobalMasters/all_active_gender'){
            axios.get(uri)
            .then(response => {
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.genderArray[data.data.data[i].id] = data.data.data[i].name;
                }
            })
            .catch(function (error){
               console.log('Error: '+error);
            });
        },
        openfile(file){
            let file_path=file.path+'/'+file.name;
            file_path=file_path.replaceAll('/', 'SSS');
            let uri = 'common/viewFiles/'+file_path;
            window.location=uri;
        },
        loadpositionTitleList(uri = 'staff/loadStaffMasters/active/PositionTitle'){
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
                            this.form.actiontype=nextclass;
                            this.form.post('/staff/staffServices/verifyApproveRejectLeaveApplication')
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
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },
        loadLeaveDetails(appNo,type){
            axios.get('/staff/staffServices/loadLeaveDetails/'+appNo+'/'+type)
            .then((response) =>{
                let data=response.data.data;
                console.log(data);
                this.form.date_of_application           =   data.date_of_application;
                this.form.application_no                =   data.application_no;
                this.form.from_date                     =   data.from_date;
                this.form.to_date                       =   data.to_date;
                this.form.no_days                       =   data.no_days;
                this.form.leave_type_id                 =   data.leave_type_id;
                this.form.reason                        =   data.reason;
                // this.form.staff_id                      =   data.staff_id;leaveDetails
                this.form.leave_type_name               =   data.leave_details.name;
                this.form.appName                       =   data.applicant_details.name;
                this.form.staff_id                      =   data.applicant_details.id;
                this.form.contact_number                =   data.applicant_details.contact_no;
                this.form.email                         =   data.applicant_details.email;
                this.form.gender                        =   data.applicant_details.sex_id;
                if(data.app_seq_no!=10 && data.app_seq_no!=0){
                    $('#verifyId').show();
                }
                if(data.app_seq_no==10 ){
                    $('#approveId').show();
                }
                this.applicationdetailsatt              =   data.attachment;
                this.form.status_id                     =   data.app_seq_no;
                this.form.position_title                =   data.applicant_details.position_title_id;
            })
            .catch((error) =>{
                console.log("Error: "+error);
            });
        }
    },
    mounted(){
        this.loadgenderList();
        this.loadpositionTitleList();
        this.form.application_number=this.$route.params.data.application_number;
        this.loadLeaveDetails(this.$route.params.data.application_number,this.$route.params.type);
    },
}
</script>
