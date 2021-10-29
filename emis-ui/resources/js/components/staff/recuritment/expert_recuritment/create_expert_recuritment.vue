<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs" >
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <li class="nav-item organization-tab" @click="shownexttab('organization-tab')">
                        <a class="nav-link active" data-toggle="pill" role="tab">
                             <span id="screenName"></span>
                        </a>
                    </li>
                </ul>
            </div><br>
            <div class="card-body pt-0 mt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details"  >
                        <div class="tab-pane fade active show tab-content-details">
                            <form class="form-horizontal">
                                <input type="hidden" class="form-control" v-model="form.id" id="id"/>
                                    <div class="form-group row">
                                        <div class="col-lg-10 col-md-10 col-sm-10">
                                            <label>Passport/Emigration Number:<i class="text-danger">*</i></label>
                                                <input type="text" class="form-control"  :class="{ 'is-invalid': form.errors.has('passport') }" id="passport" v-model="form.passport" placeholder="Passport/Emigration Number">
                                                <has-error :form="form" field="passport"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                          <label>Full Name:<i class="text-danger">*</i></label>
                                            <input type="text" class="form-control"  :class="{ 'is-invalid': form.errors.has('name') }" id="name" v-model="form.name">
                                            <has-error :form="form" field="name"></has-error>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                          <label>Date of Birth:<i class="text-danger">*</i></label>
                                            <input type="date" class="form-control" :class="{ 'is-invalid': form.errors.has('dob') }" id="dob" v-model="form.dob">
                                            <has-error :form="form" field="dob"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <label>Country:<i class="text-danger">*</i></label>
                                             <select v-model="form.country" :class="{'is-invalid': form.errors.has('country') }" class="form-control select2" name="country" id="country">
                                                <option v-for="(item, index) in countryList" :key="index" v-bind:value="item.id">{{ item.country_name }}</option>
                                            </select>
                                            <has-error :form="form" field="country"></has-error>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 ">
                                            <label>Address:<i class="text-danger">*</i></label>
                                            <input type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('address') }" id="address" v-model="form.address">
                                            <has-error :form="form" field="address"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <div class="col-lg-6 col-md-6 col-sm-6 ">
                                            <label>Email Address:<i class="text-danger">*</i></label>
                                            <input type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('email') }" id="email" v-model="form.email">
                                            <has-error :form="form" field="email"></has-error>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <label>Contact Number:<i class="text-danger">*</i></label>
                                            <input type="number" class="form-control" :class="{ 'is-invalid': form.errors.has('contact_number') }" id="contact_number" v-model="form.contact_number">
                                            <has-error :form="form" field="contact_number"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label class="mb-0">Upload the Required Documents</label>
                                        </div>
                                    </div>
                                     <div class="form-group row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label class="mb-0.5">Attachments</label>
                                            <table id="participant-table" class="table w-100 table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Fike Name</th>
                                                        <th>File</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr id="record1" v-for='(att, index) in form.attachments' :key="index">
                                                        <td>
                                                            <input type="text" class="form-control" @change="remove_err('file_name'+(index+1))" :class="{ 'is-invalid' :form.errors.has('file_name') }" v-model="att.file_name" :id="'file_name'+(index+1)">
                                                            <span class="text-danger" :id="'file_name'+(index+1)+'_err'"></span>
                                                        </td>
                                                        <td>
                                                            <input type="file" class="form-control" @change="remove_err('attach'+(index+1))" v-on:change="onChangeFileUpload" :id="'attach'+(index+1)" >
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
                            </form>
                            <hr>
                            <div class="row form-group fa-pull-right">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button class="btn btn-primary" @click="applyforrecuritment()">Apply </button>
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
            countryList:[],
            form: new form({
                passport:'',
                name:'',
                dob:'',
                country:'',
                address:'',
                email:'',
                contact_number:'',
                application_for:'Expatriate Recruitment',
                application_type:'Expatriate_Recruitment',
                action_type:'add', 
                status:'Submitted',
                organization_type:'',
                attachments: [],
                ref_docs:[],
            }),
        }
    },
    methods: {
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
        addMoreattachments: function(){
            this.form.attachments.push({file_name:'', file_upload:''})
        },
        removeattachments(index){
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

        loadcountryList(uri ='masters/loadGlobalMasters/all_country'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.countryList =  data.data.data;
            })
            .catch(function (error) {
                console.log('error: '+error);
            });
        },
        applyforrecuritment(){
              Swal.fire({
                text: "Are you sure you want to submit Expatriate recuritment application for further further approval ?",
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
            formData.append('ref_docs[]', this.form.ref_docs);
            for(let i=0;i<this.form.ref_docs.length;i++){
                formData.append('attachments[]', this.form.ref_docs[i].attach);
                formData.append('attachmentname[]', this.form.ref_docs[i].name);
            }
            formData.append('passport', this.form.passport);
            formData.append('name', this.form.name);
            formData.append('dob', this.form.dob);
            formData.append('country', this.form.country);
            formData.append('address', this.form.address);
            formData.append('email', this.form.email);
            formData.append('contact_number', this.form.contact_number);
            formData.append('application_type', this.form.application_type);
            formData.append('application_for', this.form.application_for);
            formData.append('action_type', this.form.action_type);
            formData.append('status', this.form.status);
            formData.append('screenId', this.screenId);
            formData.append('SysRoleId', this.SysRoleId);
            formData.append('Sequence', this.Sequence);
            formData.append('Status_Name', this.Status_Name);
            formData.append('screen_name', this.screen_name);
            formData.append('organization_type', this.form.organization_type);
            axios.post('staff/StaffApprovalController/saveExpatriateRecuritment', formData, config)
            .then((response) => {
                if(response!=""){
                    if(response.data=="No Screen"){
                        Toast.fire({
                            icon: 'error',
                            title: 'No dont have privileged to submit this application. Please contact system administrator'
                        });
                    }
                if(response!="" && response!="No Screen"){
                        let message="Application details has been submitted for approval. System Generated application number for this transaction is: <b>"+response.data.data.notification_appNo+'.</b><br> Use this application number to track your application status. <br><b>Thank You !</b>';
                        this.$router.push({name:'expert_recuritment_acknowledgement',params: {data:message}});
                        Toast.fire({
                            icon: 'success',
                            title: 'Application for Expariate Recruitment has sumbmitted successfully'
                        });
                    }
                }
                 })
              .catch((err) => {
                this.form.errors.errors = err.response.data;
                this.validateFileform();
            })
            }
            })
        },
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');

                $('#'+id).addClass('select2');
            }
            if(id=="country"){
                this.form.country=$('#country').val();
            }
        },
        getAttachmentType(type){
            this.form.attachments=[];
            axios.get('masters/organizationMasterController/loadOrganizaitonmasters/'+type+'/DocumentType')
            .then(response => {
                let data = response.data;
                data.forEach((item => {
                    this.form.attachments.push({file_name:item.name, file_upload:''});
                }));
            })
            .catch(errors => {
                console.log(errors)
            });
        },
        validateFileform(){
            let returnvariable=true;
            for(let i=0;i<this.form.attachments.length;i++){
                if($('#file_name'+(i+1)).val()==""){
                    $('#file_name'+(i+1)+'_err').html('Please mention file name');
                    returnvariable=false;
                }
                if($('#attach'+(i+1)).val()==""){
                    $('#attach'+(i+1)+'_err').html('Please mention file');
                    returnvariable=false;
                }
                if($('#attach'+(i+1)).val()!="" && !this.isvalidfile($('#attach'+(i+1)).val())){
                    $('#attach'+(i+1)+'_err').html('This file is not accepted. The accepted files are: ' +this.validfile());
                    returnvariable=false;
                }
            }
            return returnvariable;
        },
        loadScreenDetails(){
            axios.get('organizationApproval/getScreenId/Expatriate Recuritment__'+1)
            .then(response => {
                let data = response.data.data;
                if(data!=undefined && data!="NA"){
                    $('#screenName').html('<b>Creating Application for '+data.screenName+'</b>');
                    this.screenId=data.screen;
                    this.SysRoleId=data.SysRoleId;
                    this.Sequence=data.Sequence;
                    this.Status_Name=data.Status_Name;
                    this.screen_name=data.screenName;
                    $('#screenPermission').hide();
                    $('#mainform').show();
                }
                else{
                    $('#message').html('<b>You are not eligible to visit this page. Please contact system administrator for further assistant</b>');
                    $('#screenPermission').show();
                    $('#mainform').hide();
                }
            })
            .catch(errors => {
                console.log(errors)
            });
        },

    },

    async mounted() {
        this.getAttachmentType('ForTransaction__Application_for_Principal_Recruitment');
        let data = await this.getRequiredDocument("Attachment_For_Expatriate_Recruitment");
        data.forEach((item => {
            this.form.attachments.push({file_name:item.name, file_upload:''})
        }));
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

       
    },
     created() {
         this.loadScreenDetails();
         this.loadcountryList();

    },
}
</script>
