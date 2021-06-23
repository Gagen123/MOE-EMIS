<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs" >
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs">
                    <li class="nav-item organization-tab">
                        <a class="nav-link active" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Application for principal Recuritment</label>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body pt-0 mt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details"  >
                        <div class="tab-pane fade active show tab-content-details">
                            <form class="form-horizontal">
                                <input type="hidden" class="form-control" v-model="form.id" id="id"/>
                                    <div class="form-group row">
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <label>Name:</label>
                                             <span class="text-blue text-bold">{{form.name}}</span>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <label>Date of Birth:</label>
                                            <span class="text-blue text-bold">{{form.dob}}</span>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <label>Dzongkhag:</label>
                                             <span class="text-blue text-bold">{{form.dzongkhag}}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <label>Gewog:</label>
                                            <span class="text-blue text-bold">{{form.gewog}}</span>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <label>Village:</label>
                                            <span class="text-blue text-bold">{{form.village}}</span>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <label>Present Address:</label>
                                             <span class="text-blue text-bold">{{form.paddress}}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Email Address:</label>
                                            <span class="text-blue text-bold">{{form.email}}</span>
                                        </div>
                                        
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <label>Contact Number:</label>
                                            <span class="text-blue text-bold">{{form.contact_number}}</span>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <label>Applcation For:</label>
                                            <span class="text-blue text-bold">{{form.application_for}}</span>
                                        </div>
                                         
                                    </div>
                                   
                                    <div class="row pb-2" id="team_verificationAttachment">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <h5><u>Attachments</u></h5>
                                        <table id="participant-table" class="table w-100 table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Attachment Name</th>
                                                    <th>Attachment</th>
                                                    <th>File</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for='(attach,count) in attachments' :key="count+1">
                                                    <template>
                                                        <td>{{attach.user_defined_file_name}} </td>
                                                        <td class="text-blue text-bold">  {{attach.name}}</td>
                                                        <td>
                                                            <a href="#" @click="openfile(attach)" class="fa fa-eye"> View</a>
                                                        </td>
                                                    </template>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <h5><u>Any Supporting Documents and Attachments (if applicable)</u></h5>
                                        <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>File Name</th>
                                                    <th>Upload File</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr id="record1" v-for='(att, index) in form.attachments' :key="index">
                                                    <td>
                                                        <input type="text" class="form-control" :class="{ 'is-invalid' :form.errors.has('file_name') }" v-model="att.file_name" :id="'file_name'+(index+1)">
                                                        <span class="text-danger" :id="'fileName'+(index+1)+'_err'"></span>
                                                    </td>
                                                    <td>
                                                        <input type="file" name="attachments" class="form-control application_attachment" v-on:change="onChangeFileUpload" :id="'attach'+(index+1)">
                                                        <span class="text-danger" :id="'attach'+(index+1)+'_err'"></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                <td colspan="5">
                                                    <button type="button" class="btn btn-flat btn-sm btn-primary" id="addMore"
                                                    @click="addMore()"><i class="fa fa-plus"></i> Add More</button>
                                                    <button type="button" class="btn btn-flat btn-sm btn-danger" id="remove"
                                                    @click="remove()"><i class="fa fa-trash"></i> Remove</button>
                                                </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label>Remarks</label>
                                        <textarea class="form-control" @change="remove_error('remarks')" v-model="form.remarks" id="remarks"></textarea>
                                        <span class="text-danger" id="remarks_err"></span>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <div class="row form-group fa-pull-right">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button class="btn btn-info text-white" @click="shownexttab('update')" style="display:none" id="updateBtn"> <i class="fa fa-edit"></i><span id="update_btn_level"></span> </button>
                                    <button class="btn btn-danger" @click="shownexttab('reject')"> <i class="fa fa-times"></i> Reject </button>
                                    <button class="btn btn-primary" @click="shownexttab('verify')" style="display:none" id="verifyId"> <i class="fa fa-forward"></i>Verify </button>
                                    <button class="btn btn-dark" @click="shownexttab('approve')" style="display:none" id="approveId"> <i class="fa fa-check"></i>Approve </button>
                                </div>
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
            attachments:'',
            form: new form({
                name:'', 
                dob:'',
                dzongkhag:'',
                gewog:'',
                village:'',
                paddress:'',
                email:'',
                contact_number:'',
                remarks:'',
                application_for:'Principal Recruitment',
                application_type:'principal_recruitment',
                action_type:'add', 
                status:'Submitted',
                organization_type:'',
                status:'Submitted',
                applicationNo:'',
                screen_id:'',
                sequence:'',
                application_no:'',
                attachments:
                [{
                    file_name:'',attachment:''
                }],
                ref_docs:[],
            }),
        }
    },
    methods: {
        openfile(file){
            let file_path=file.path+'/'+file.name;
            file_path=file_path.replaceAll('/', 'SSS');
            let uri = 'common/viewFiles/'+file_path;
            window.location=uri;
        },
        onChangeFileUpload(e){
            let currentcount=e.target.id.match(/\d+/g)[0];
            if($('#fileName'+currentcount).val()!=""){
                this.form.ref_docs.push({name:$('#file_name'+currentcount).val(), attach: e.target.files[0]});
                $('#fileName'+currentcount).prop('readonly',true);
            }
            else{
                $('#fileName'+currentcount+'_err').html('Please mention file name');
                $('#'+e.target.id).val('');
            }
        },
        addMore: function(){
            this.form.attachments.push({file_name:'', file_upload:''})
        },
        remove(index){
            if(this.form.attachments.length>1){
                this.form.attachments.pop();
            }
        },
       
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },
        loadPrincipalRecuritmentApplication(appId,type){
            axios.get('staff/StaffApprovalController/loadPrincipalRecuritmentApplication/'+appId+'/'+type)
            .then((response) => {
                let data=response.data
                this.form.name=data.data.name;
                this.form.dob=data.data.DateOfBirth;
                this.form.dzongkhag=data.data.dzongkhag;
                this.form.gewog=data.data.gewog;
                this.form.village=data.data.village;
                this.form.paddress=data.data.presentAddress;
                this.form.email=data.data.EmailAddress;
                this.form.contact_number=data.data.contact_number;
                this.form.application_for=data.data.application_for;
                this.form.screen_id=data.screen_id;
                this.form.application_type=data.application_type;
                this.form.sequence=data.sequence; 
                this.form.app_stage=data.sequence;
                this.form.application_no=data.data.application_no;
                this.attachments=data.data.attachments;
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
                            const config = {
                                headers: {
                                    'content-type': 'multipart/form-data'
                                }
                            }
                            let formData = new FormData();
                            formData.append('id', this.form.id);
                            formData.append('actiontype', nextclass);
                            formData.append('screen_id', this.form.screen_id);
                            formData.append('sequence', this.form.sequence);
                            formData.append('application_for', this.form.application_for);
                            formData.append('application_type', this.form.application_type);
                            formData.append('application_no',  this.form.application_no);
                            formData.append('remarks', this.form.remarks);
                            formData.append('ref_docs[]', this.form.ref_docs);
                            for(let i=0;i<this.form.ref_docs.length;i++){
                                formData.append('attachments[]', this.form.ref_docs[i].attach);
                                formData.append('attachmentname[]', this.form.ref_docs[i].name);
                            }

                            axios.post('staff/StaffApprovalController/updatePrincipalApproval', formData, config)
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
                                this.form.errors.errors = err.response.data.errors;
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

        applyforrecuritment(){
            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }
            let formData = new FormData();
            formData.append('id', this.form.id);
            formData.append('ref_docs[]', this.form.ref_docs);
            for(let i=0;i<this.form.ref_docs.length;i++){
                formData.append('attachments[]', this.form.ref_docs[i].attach);
                formData.append('attachmentname[]', this.form.ref_docs[i].name);
            }
            formData.append('organizationId', this.form.organizationId);
            formData.append('name', this.form.name);
            formData.append('dob', this.form.dob);
            formData.append('dzongkhag', this.form.dzongkhag);
            formData.append('gewog', this.form.gewog);
            formData.append('village', this.form.village);
            formData.append('paddress', this.form.paddress);
            formData.append('email', this.form.email);
            formData.append('contact_number', this.form.contact_number);
            formData.append('application_type', this.form.application_type);
            formData.append('application_for', this.form.application_for);
            formData.append('action_type', this.form.action_type);
            formData.append('status', this.form.status);
            formData.append('organization_type', this.form.organization_type);
            axios.post('staff/StaffApprovalController/savePrincipalApproval', formData, config)
            .then((response) => {
                if(response!=""){
                    if(response.data=="No Screen"){
                        Toast.fire({
                            icon: 'error',
                            title: 'No dont have privileged to submit this application. Please contact system administrator'
                        });
                    }
                    if(response!="" && response!="No Screen"){
                        let message="Application details has been submitted for approval. System Generated application number for this transaction is: <b>"+response.data.application_number+'.</b><br> Use this application number to track your application status. <br><b>Thank You !</b>';
                        this.$router.push({name:'princiapl_recuritment_acknowledgement',params: {data:message}});
                        Toast.fire({
                            icon: 'success',
                            title: 'Application is saved successfully'
                        });
                    }
                }
            })
            .catch((err) => {
                console.log("Error:"+err)
            })
            
        },
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
        

        },
        applyselect2(){
           
        },
       

    },

    mounted() {
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
        this.loadPrincipalRecuritmentApplication(this.$route.params.data.application_number,this.$route.params.type);
    }
}
</script>
