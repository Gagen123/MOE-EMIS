<template>
    <div>
        <form class="bootbox-form">
        <div class="card-body">
           
            <div class="card card-primary card-outline card-outline-tabs" id="t_form_details">
                 <ol class="mb-1 ml-xl-n3 mr-xl-n2 pl-3" style="background-color:#E5E5E5">
                        <li class="pl-2 form-inline "><h6 class="pt-1">Tranfer Appeal Verification</h6></li>
                </ol>
                <div class="card-body pt-0 mt-1">
                    <div class="tab-content">
                        <div class="tab-pane fade active show tab-content-details" id="application-tab" role="tabpanel" aria-labelledby="basicdetails">
                            <div class="callout callout-success">
                                <span><label><u>Applicantion Detials</u></label></span>
                                    <div class="form-group row pt-2">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <label class="mb-0">Name of Applicant:</label><br>
                                            <span class="text-blue text-bold">{{this.form.name}}</span>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <label class="mb-0">Application Number:</label><br>
                                            <span class="text-blue text-bold">{{this.form.aplication_number}}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row pt-2">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <label class="mb-0">Date of Application Submission:</label><br>
                                            <span class="text-blue text-bold">{{this.form.created_at}}</span>
                                        </div>
                                         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <label class="mb-0">Reason For Appeal:</label><br>
                                            <span class="text-blue text-bold">{{form.reason}}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row pt-2">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <label class="mb-0">Transfer Type:</label><br>
                                            <span class="text-blue text-bold">{{transferList[form.transferTypeId]}}</span>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <label class="mb-0">Application Status:</label><br>
                                        <span class="text-blue text-bold">{{form.status}}</span>
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group row">
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
                            <div lass="form-group row" >
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label class="mb-0">Remarks:<i class="text-danger">*</i></label>
                                    <textarea class="form-control" @change="remove_error('remarks')" v-model="form.remarks" id="remarks"></textarea>
                                    <span class="text-danger" id="remarks_err"></span>
                                </div>
                            </div>
                            <div  class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button type="submit" id="button" class="btn btn-primary" @click="shownexttab('submit')"> <i class="fa fa-save"></i>Update </button>
                            </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    </div>
                </div>
            </div>
        </form>
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
            draft_attachments:'',
            transferList:[],
            form: new form({
                id: '',
                aplication_number:'',
                service_name:'transfer appeal',
                status:'',
                reason:'',
                name:'',
                remarks:'',
                created_at:'',
                transferTypeId:'',
                attachments:[],
                ref_docs:[],
                actiontype:'approved',
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
            })
            .catch(errors =>{
                console.log('error loadattachementDetails: '+errors)
            });
        },
        loadtransferAppealDetails(appNo){
             axios.get('staff/transfer/loadTransferAppealDetail/'+appNo)
            .then((response) =>{
                let data = response.data[0];
                this.form.name=data.name;
                this.form.reason=data.description;
                this.form.status=data.status;
                this.form.created_at=data.created_at;
                this.form.aplication_number=data.application_no;
                this.form.transferTypeId=data.transferType;
            })
            .catch(errors =>{
                console.log('error loadattachementDetails: '+errors)
            });
        },
        loadtransferType(uri = 'masters/loadStaffMasters/all_transfer_type_list'){
            axios.get(uri)
            .then(response =>{
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.transferList[data[i].id]=data[i].name;                }
            })
            .catch(function (error){
                console.log(error);
            });
        },
        shownexttab(nextclass){
            if(nextclass=="submit"){
                Swal.fire({
                    text: "Are you sure you wish to update transfer appeal application ?",
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
                        
                        formData.append('aplication_number', this.form.aplication_number);
                        formData.append('actiontype', this.form.actiontype);
                        formData.append('remarks', this.form.remarks);
                        for(let i=0;i<this.form.ref_docs.length;i++){
                            formData.append('attachments[]', this.form.ref_docs[i].attachment);
                            formData.append('attachmentname[]', this.form.ref_docs[i].file_name);
                        }
                        axios.post('/staff/transfer/UpdateTransferAppeal', formData, config)
                        .then((response) =>{
                            if(response.data!=""){
                             Toast.fire({
                                        icon: 'success',
                                        title: 'Application has been updated successfully!'
                                    });
                            this.$router.push('/tasklist');
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
        this.loadtransferType();
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

        this.loadtransferAppealDetails(this.$route.params.data.application_number);
        this.loadattachementDetails(this.$route.params.data.application_number);
    },
}
</script>
