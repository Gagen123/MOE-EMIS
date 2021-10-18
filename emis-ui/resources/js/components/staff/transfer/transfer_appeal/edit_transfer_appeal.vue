<template>
    <div>
        <div class="card card-danger card-outline" id="invalidsection" style="display:none">
            <div class="card-body pb-0 mb-0">
                <div class="callout callout-danger">
                    <div class="form-group row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label class="mb-0" id="err_message"></label><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-primary card-outline card-outline-tabs" id="t_form_details">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <li class="nav-item application-tab" @click="shownexttab('application-tab')">
                        <a class="nav-link active" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Application Details </label>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body pt-0 mt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="application-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <br/><div class="card card-success card-outline collapsed-card" id="adv_serach_ection">
                            <div class="card-body pb-0 mb-0" style="display:none">
                                <div class="callout callout-success">
                                    <div class="form-group row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label class="mb-0">Year:</label>
                                            <span class="text-blue text-bold">{{form.t_year}}</span>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label class="mb-0">From Date:</label>
                                            <span class="text-blue text-bold">{{form.t_from_date}}</span>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label class="mb-0">End Date:</label>
                                            <span class="text-blue text-bold">{{form.t_to_date}}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label class="mb-0">Remarks:</label>
                                            <span class="text-blue text-bold">{{ form.t_remarks}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header pb-0 pt-2">
                                <h3 class="card-title">Transfer Appeal Window <span v-if="t_warning" class="text-danger">({{t_warning_message}})</span></h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-plus" ></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0.5">Applicant Name:</label>
                                <span class="text-blue text-bold">{{this.form.name}}</span>
                                <has-error :form="form" field="name"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0.5">Transfer Type:<i class="text-danger">*</i></label>
                                <br/>
                                <select v-model="form.transfer_type_id" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('transfer_type_id') }" class="form-control select2" name="transfer_type_id" id="transfer_type_id">
                                  <option v-for="(item, index) in applicationNo" :key="index" v-bind:value="item.transfer_type_id">{{ item.aplication_number }}: ({{ item.transferType }})</option>
                                </select>
                        <has-error :form="form" field="aplication_number"></has-error>
                            </div>
                        </div>
                         <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-smSchoolList-12 col-xs-12">
                                <label class="mb-0.5">Reason for seeking transfer appeal:<i class="text-danger">*</i></label>
                                <textarea class="form-control" v-model="form.description" id="description"></textarea>
                            </div>
                        </div>
                        <span class="text-danger" id="undertaking_err"></span>
                        <div class="form-group row " id="attachtment">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0.5">Addtional Attachments:(If Any)<i class="text-danger">*</i></label>
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
                                                <input type="text" class="form-control" readonly :value="attach.user_defined_name">
                                            </td>
                                            <td>
                                                <a href="#" @click="openfile(attach)" class="fa fa-eye"> View</a>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <a href="#" @click="deletefile(attach)" class="fa fa-times text-danger"> Delete </a>
                                            </td>
                                        </tr>
                                        <tr id="record1" v-for='(att, index) in form.attachments' :key="index">
                                            <td>
                                                <input type="text" class="form-control" @change="remove_err('file_name'+(index+1))" :class="{ 'is-invalid' :form.errors.has('file_name') }" v-model="att.file_name" :id="'file_name'+(index+1)">
                                                <span class="text-danger" :id="'file_name'+(index+1)+'_err'"></span>
                                            </td>
                                            <td>
                                                <input type="file" class="form-control" @change="remove_err('attach'+(index+1))" v-on:change="onChangeFileUpload" :id="'attach'+(index+1)">
                                                <span class="text-danger" :id="'attach'+(index+1)+'_err'"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <button type="button" class="btn btn-flat btn-sm btn-primary" id="addMore"
                                                @click="addMoreattachments()"><i class="fa fa-plus"></i> Add More</button>
                                                <button type="button" class="btn btn-flat btn-sm btn-danger" id="addMore"
                                                @click="removeattachments()"><i class="fa fa-trash"></i> Remove</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="form-group row" id="Withdraw">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label><i class="text-danger">(If you wish to cancel the appeal after applying the transfer)</i></label><br/>
                                <label class="mb-1">Withdraw: <input type="checkbox" name="withdraw" v-model="form.withdraw" id="withdraw" class="icheck-success d-inline"></label>
                            </div>
                        </div>
                         <div lass="form-group row" id="remarks">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0">Remarks:<i class="text-danger">*</i></label>
                                <textarea class="form-control" @change="remove_error('remarks')" v-model="form.remarks" id="remarks"></textarea>
                                <span class="text-warning" id="remarks_err"></span>
                            </div>
                        </div>
                         <div class="form-group row" id="actionMessage">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label style="font-size:20"><i class="mb-0.9">You cannot update since your application <b style="color:green">({{this.form.aplication_number}})</b> has been already taken action</i></label><br/>
                            </div>
                        </div>
                        <div  class="row form-group fa-pull-right" id="actionButton">
                         <div v-if="button" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button type="submit" id="button" class="btn btn-primary" @click="shownexttab('submit')"> <i class="fa fa-save"></i>Update </button>
                         </div>
                        </div>
                    </div>
                    <hr>
                 </div>
                </div>
            </div>
        </div>
</template>
<script>
export default {
    data(){
        return {
            filecount:1,
            button:true,
            t_warning:false,
            t_warning_message:'',
            transfertypeList:[],
            intratransfer:[],
            applicationNo:[],
            draft_attachments:[],
            form: new form({
                id: '',
                t_year:'',
                name:'',
                user_id:'',
                type:'',
                t_from_date:'',
                t_to_date:'',
                t_remarks:'',
                transferwindow_id:'',
                staff_id: '',
                reason_id:'',
                transfer_type_id:'',
                description:'',
                current_date:'',
                remarks:'',
                withdraw:'',
                aplication_number:'',
                service_name:'transfer appeal',
                actionType:'edit',
                attachments:[],
                ref_docs:[],
            })
        }
    },
    methods: {
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },
        addMoreattachments: function(){
            this.filecount++;
            this.form.attachments.push({file_name:'',attachment:''})
        },
        removeattachments(index){
            if(this.form.attachments.length>1){
                this.filecount--;
                this.form.attachments.pop();
                this.form.ref_docs.pop();
            }
        },
        onChangeFileUpload(e){
            let currentcount=e.target.id.match(/\d+/g)[0];
            if($('#file_name'+currentcount).val()!=""){
                this.form.ref_docs.push({file_name:$('#file_name'+currentcount).val(),attachment:e.target.files[0]});
                $('#file_name'+currentcount).prop('readonly',true);
            }
            else{
                $('#file_name'+currentcount+'_err').html('Please mention file name');
                $('#'+e.target.id).val('');
            }
        },
        loadattachementDetails(appId){
             axios.get('staff/transfer/loadAppealattachementDetails/'+appId)
            .then((response) =>{
                let data = response.data.data;
                this.draft_attachments=data.documents;
                this.form.status=data.status;
                this.form.transferType=data.transferType;
                
                if(this.form.status =="Verfied By HRD" || this.form.status =="withdrawn"){
                    $('#Withdraw').hide();
                    $('#remarks').hide();
                    $('#actionButton').hide();
                    $('#attachtment').hide();
                    $('#actionMessage').show();
                }
                else{
                     $('#actionMessage').hide();
                }
            })
            .catch(errors =>{
                console.log('error loadattachementDetails: '+errors)
            });
        },
        loadtransferwindow(){
            axios.get('masters/loadGlobalMasters/transfer_appeal')
           .then((response) => {
                let data=response.data.data[0];
                 if(data!=null){
                    this.form.transferwindow_id=data.id;
                    this.form.t_from_date=data.from_date;
                    this.form.t_to_date=data.to_date;
                    this.form.t_year=data.year;
                    this.form.t_remarks=data.remarks;
                    this.form.t_id=data.id;
                    let todate=new Date(data.to_date);
                    let formdate = new Date();
                    // One day in milliseconds
                    const oneDay = 1000 * 60 * 60 * 24;

                    // Calculating the time difference between two dates
                    const diffInTime = todate.getTime() - formdate.getTime();

                    // Calculating the no. of days between two dates
                    const diffInDays =(diffInTime / oneDay);
                    if(diffInDays<=5 && diffInDays>0){
                        this.t_warning_message="Only "+Math.ceil(diffInDays)+" day(s) left to apply";
                        this.t_warning=true;
                    }
                    else if(diffInDays<=0){
                        $('#err_message').html("<b>Sorry!</b><br> Tranfer period is over for this year");
                        $('#invalidsection').show();
                        $('#t_form_details').hide();
                    }
                }
                else{
                    $('#err_message').html('<b>Sorry!</b><br> System cannot find a valid Transfer configuration. Might be the tranfer period is over for this year or might not yet reach for the period');
                    $('#invalidsection').show();
                    $('#t_form_details').hide();
                }
             })
            .catch((error) => {
                console.log("Error."+error);
            });
        },
        shownexttab(nextclass){
            if(nextclass=="submit"){
                Swal.fire({
                    text: "Are you sure you wish to update for transfer appeal ?",
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
                        formData.append('transfer_type_id', this.form.transfer_type_id);
                        formData.append('name', this.form.name);
                        formData.append('user_id', this.form.user_id);
                        formData.append('status', this.form.status);
                        formData.append('remarks', this.form.remarks);
                        formData.append('withdraw', this.form.withdraw);
                        formData.append('aplication_number', this.form.aplication_number);
                        formData.append('description', this.form.description);
                        for(let i=0;i<this.form.ref_docs.length;i++){
                            formData.append('attachments[]', this.form.ref_docs[i].attachment);
                            formData.append('attachmentname[]', this.form.ref_docs[i].file_name);
                        }
                        axios.post('staff/transfer/SaveTransferAppeal', formData, config)
                        .then((response) =>{
                            if(response.data!=""){
                                 Swal.fire({
                                    html: "Your application for transfer appeal has been updated successfully ",
                                    icon: 'success',
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'okay!',
                            });
                            this.applyselect2();
                            this.$router.push('/list_transfer_appeal');
                            }
                            // }
                            
                            // else if(response.data=="Not Contain"){
                            //     Swal.fire({
                            //         html: "You are not eligible for applying transfer appeal since you have not applied any type transfer yet! ",
                            //         icon: 'error',
                            //         confirmButtonColor: '#3085d6',
                            //         cancelButtonColor: '#d33',
                            //         confirmButtonText: 'okay!',
                            //     })
                            // }
                            //  else if(response.data=="Approved or rejected"){
                            //     Swal.fire({
                            //         html: "You are not eligible for applying transfer appeal since your application has been already verified or approved ",
                            //         icon: 'error',
                            //         confirmButtonColor: '#3085d6',
                            //         cancelButtonColor: '#d33',
                            //         confirmButtonText: 'okay!',
                            //     })
                            // }
                            
                        })
                        .catch((error) => {
                            console.log("Errors:"+error)
                        });
                    }
                });
                }
        },
        change_tab(nextclass){
            $('#tabhead >li >a').removeClass('active');
            $('#tabhead >li >a >span').addClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').addClass('active');
            $('.'+nextclass+' >a >span').removeClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').removeClass('disabled');
            $('.tab-content-details').hide();
            $('#'+nextclass).show().removeClass('fade');
        },

        profile_details(){
            axios.get('common/getSessionDetail')
            .then(response => {
                this.form.name = response.data.data.Full_Name;
                this.form.user_id = response.data.data.User_Id;
                this.LoadApplicationDetailsByUserId(response.data.data.User_Id);
            })
            .catch(errors =>{
                console.log(errors)
            });
        },
        LoadApplicationDetailsByUserId(user_id){
              axios.get( 'staff/transfer/LoadApplicationDetailsByUserId/Approved/' +user_id)
                .then(response =>{
                    let data = response.data;
                    this.applicationNo =  data;
                    this.form.aplication_number = data[0].aplication_number;
                })
                .catch(function (error){
                console.log(error);
            });
        },
        LoadTransferType(uri = 'masters/loadStaffMasters/appeal'){
            axios.get(uri)
            .then(response =>{
                this.form.type_id = response.data.data[0].id;

            })
            .catch(function (error){
                console.log(error);
            });
        },
        openfile(file){
            let file_path=file.path+'/'+file.original_name;
            file_path=file_path.replaceAll('/', 'SSS');
            let uri = 'common/viewFiles/'+file_path;
            window.location=uri;
        },
        deletefile(file){
            Swal.fire({
                text: "Are you sure you wish to DELETE this selected file ?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
                }).then((result) => {
                if (result.isConfirmed) {
                    let file_path=file.path+'/'+file.name;
                    file_path=file_path.replaceAll('/', 'SSS');
                    let uri = 'organization/deleteFile/'+file_path+'/'+file.id;
                    axios.get(uri)
                    .then(response => {
                        let data = response;
                        if(data.data){
                            Swal.fire(
                                'Success!',
                                'File has been deleted successfully.',
                                'success',
                            );
                        }
                        else{
                        Swal.fire(
                                'error!',
                                'Not able to delete this file. Please contact system adminstrator.',
                                'error',
                            );
                        }

                    })
                    .catch(function (error) {
                        console.log("Error:"+error);
                    });
                }
            });
        },
         changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="transfer_type_id"){
                this.form.transfer_type_id=$('#transfer_type_id').val();
            }
        },
        applyselect2(){
            if(!$('#transfer_type_id').attr('class').includes('select2-hidden-accessible')){
                $('#transfer_type_id').addClass('select2-hidden-accessible');
            }
        }, 
    },
    mounted() {
        let currentdate = new Date();
        this.form.year=currentdate.getFullYear();
        this.form.current_date=currentdate.getFullYear()+'-'+(currentdate.getMonth() + 1)+'-'+currentdate.getDate();
        $('[data-toggle="tooltip"]').tooltip();
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id'));
        });

        Fire.$on('changefunction',(id)=> {
        this.changefunction(id);
        });
        this.profile_details();
        this.LoadTransferType();
        this.loadtransferwindow();
        this.form.id=this.$route.params.data.id;
        this.form.transfer_type_id=this.$route.params.data.transferType;
        this.form.description=this.$route.params.data.description;
        this.form.aplication_number=this.$route.params.data.application_no;
        this.form.transferType=this.$route.params.data.transferType;
        this.form.status=this.$route.params.data.status;
        this.loadattachementDetails(this.$route.params.data.application_no);
    },
}
</script>
