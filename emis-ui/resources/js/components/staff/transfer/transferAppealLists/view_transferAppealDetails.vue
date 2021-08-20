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
            <div class="card-body pt-0 mt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details">
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
                                    <option v-for="(item, index) in applicationNo" :key="index" v-bind:value="item.id" disabled>{{ item.aplication_number }}: ({{ item.transferType }}) </option>
                                </select>
                                <has-error :form="form" field="aplication_number"></has-error>
                            </div>
                        </div>
                         <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-smSchoolList-12 col-xs-12">
                                <label class="mb-0.5">Reason for transfer appeal:<i class="text-danger">*</i></label>
                                <textarea class="form-control" v-model="form.description" id="description" disabled></textarea>
                            </div>
                        </div>
                        <span class="text-danger" id="undertaking_err"></span>
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0.5">Attachments Details</label>
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
                                            </td>
                                        </tr>
                                        <tr v-for='(att, index) in form.attachments' :key="index">
                                            <td>
                                                <span class="text-danger" :id="'file_name'+(index+1)+'_err'"></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                         <div lass="form-group row" id="remarks">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0">Remarks:<i class="text-danger">*</i></label>
                                <textarea class="form-control" @change="remove_error('remarks')" v-model="form.remarks" id="remarks"></textarea>
                                <span class="text-danger" id="remarks_err"></span>
                            </div>
                        </div>
                        <div  class="row form-group fa-pull-right">
                         <div v-if="button" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button type="submit" id="button" class="btn btn-primary" @click="shownexttab('submit')"> <i class="fa fa-save"></i>Approved </button>
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
                status:'',
                attachments:
                [{
                    file_name:'',attachment:''
                }],
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
        loadattachementDetails(appId){
             axios.get('staff/transfer/loadAppealattachementDetails/'+appId)
            .then((response) =>{
                let data = response.data.data;
                this.draft_attachments=data.documents;
                this.form.status=data.status;
                this.form.transferType=data.transferType;
                
                if(this.form.status =="Appealed"){
                     $('#remarks').hide();
                    $('#button').hide();
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
                }
             })
            .catch((error) => {
                console.log("Error."+error);
            });
        },
        shownexttab(nextclass){
            if(nextclass=="submit"){
                Swal.fire({
                    text: "Are you sure you wish to submit for transfer appeal ?",
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
                        formData.append('withdraw', this.form.withdraw);
                        formData.append('remarks', this.form.remarks);
                        formData.append('aplication_number', this.form.aplication_number);
                        formData.append('description', this.form.description);
                        for(let i=0;i<this.form.ref_docs.length;i++){
                            formData.append('attachments[]', this.form.ref_docs[i].attachment);
                            formData.append('attachmentname[]', this.form.ref_docs[i].file_name);
                        }
                        axios.post('/staff/transfer/SaveTransferAppeal', formData, config)
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
                            this.$router.push('/list_transferAppealLists');
                            }
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
                     this.form.aplication_number = data.aplication_number;
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
        this.loadattachementDetails(this.$route.params.data.application_no);
    },
}
</script>
