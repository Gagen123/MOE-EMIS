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
            </div>
            <div class="card-body pt-0 mt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details"  >
                        <div class="tab-pane fade active show tab-content-details">
                            <form class="form-horizontal">
                                <input type="hidden" class="form-control" v-model="form.id" id="id"/>
                                   <div class="form-group">
                                        <div class="row form-group">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label id="level_name"></label>
                                                <input type="text" class="form-control border border-success" :class="{ 'is-invalid': form.errors.has('cid') }" id="cid" v-model="form.cid" placeholder="Enter CID Number">
                                                <has-error :form="form" field="cid"></has-error>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pt-4 ">
                                                <button class="btn btn-primary" @click="getDetailsbyCID('cid')"><i class="fa fa-search"></i> Search</button>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group row ">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <label>Full Name:</label>
                                            <input type="text"  :value="form.name"  class="form-control" id="name" disabled/>
                                            <has-error :form="form" field="name"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <label>Date of Birth:</label>
                                            <input type="date"  :value="form.dob"  class="form-control" id="dob" disabled/>
                                            <has-error :form="form" field="dob"></has-error>
                                        </div>
                                         <div class="col-lg-6 col-md-6 col-sm-6">
                                            <label>Gender:</label>
                                            <input type="text"  :value="form.gender"  class="form-control" id="gender" disabled/>
                                            <has-error :form="form" field="gender"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <label>Dzongkhag:</label>
                                            <input type="text"  :value="form.dzongkhag"  class="form-control" id="dzongkhag" disabled/>
                                            <has-error :form="form" field="dzongkhag"></has-error>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <label>Gewog:</label>
                                            <input type="text"  :value="form.gewog"  class="form-control" id="gewog" disabled/>
                                             <has-error :form="form" field="gewog"></has-error>
                                        </div>
                                       
                                    </div>
                                    <div class="form-group row">
                                         <div class="col-lg-6 col-md-6 col-sm-6">
                                            <label>Village:</label>
                                            <input type="text"  :value="form.village"  class="form-control" id="village" disabled/>
                                            <has-error :form="form" field="village"></has-error>
                                        </div>
                                        
                                    </div>
                                    <div class="form-group row">
                                       <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
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
                                        <div class="col-lg-10 col-md-10 col-sm-10">
                                            <label>Present Address:<i class="text-danger">*</i></label>
                                             <textarea type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('paddress') }" id="paddress" v-model="form.paddress"/>
                                            <has-error :form="form" field="paddress"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label class="mb-0">Upload the Required Documents<i class="text-danger">*</i></label> 
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                       
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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

            form: new form({
                cid:'',
                passport:'',
                name:'',
                dob:'',
                dzongkhag:'',
                gewog:'',
                village:'',
                paddress:'',
                email:'',
                gender:'',
                contact_number:'',
                application_for:'Principal Recruitment',
                application_type:'principal_recruitment',
                action_type:'add',
                status:'Submitted',
                organization_type:'',
                attachments:[],
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

        getDetailsbyCID(cid){
        if ($('#'+cid).val().length!= 11){
            Swal.fire({
                html: "Please enter 11 digit CID",
                icon: 'error'
            });
        }
        else {
             axios.get('getpersonbycid/'+ $('#'+cid).val())
            .then(response => {
                let data=response.data;
                this.form.name = data.firstName +' '+ data.lastName;
                let dob = data.dob;
                if(dob.includes('-')){
                    dob=dob.split('-')[2]+'-'+dob.split('-')[1]+'-'+dob.split('-')[0];
                }
                if(dob.includes('/')){
                    dob=dob.split('/')[2]+'-'+dob.split('/')[1]+'-'+dob.split('/')[0];
                }
                this.form.dob = dob;
                 $('#dob').val(dob);

                  if(data.gender=="M"){
                    this.form.gender ="Male";
                    }
                  else if(data.gender=="F"){
                    this.form.gender ="Female";
                    }
                  else{
                    this.form.gender ="Others";
                    }
                this.form.dzongkhag = data.dzongkhagName;
                this.form.gewog = data.gewogName;
                this.form.village = data.villageName;
                }).catch(function (error){
                    console.log("Retrieving error: "+error)
                });
            }
        },
        loadDataList(uri='staff/StaffApprovalController/loadPrincipalApprovalApplication/principal_recruitment'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.form.passport=  data.data.data.passport;
            })
            .catch(function (error) {
                console.log('error: '+error);
            });
        },
        applyforrecuritment(){
             Swal.fire({
                text: "Are you sure you want to submit principal recuritment application for further further approval ?",
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
            formData.append('organizationId', this.form.organizationId);
            formData.append('name', this.form.name);
            formData.append('cid', this.form.cid);
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
            formData.append('screenId', this.screenId);
            formData.append('SysRoleId', this.SysRoleId);
            formData.append('Sequence', this.Sequence);
            formData.append('Status_Name', this.Status_Name);
            formData.append('screen_name', this.screen_name);
            formData.append('organization_type', this.form.organization_type);
            for(let i=0;i<this.form.ref_docs.length;i++){
                formData.append('attachments[]', this.form.ref_docs[i].attach);
                formData.append('attachmentname[]', this.form.ref_docs[i].name);
            }
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
                        let message="Application details has been submitted for approval. System Generated application number for this transaction is: <b>"+response.data.data.notification_appNo+'.</b><br> Use this application number to track your application status. <br><b>Thank You !</b>';
                        this.$router.push({name:'princiapl_recuritment_acknowledgement',params: {data:message}});
                    }
                     Toast.fire({
                            icon: 'success',
                            title: 'Application for Principal recruitment has been submitted for further action'
                        });
                }
            })
            .catch((err) => {
                console.log("Error:"+err);
                this.form.errors.errors = err.response.data.errors;
            })
            }
         });
        // else{
        //     Swal.fire({
        //         text: "You have already submitted the application for principal recuritment for cid number: " +this.form.cid,
        //         icon: 'warning',
        //         confirmButtonText: 'okay!',
        //     })
        // }
        },
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="cid"){
                this.form.cid=$('#cid').val();
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
         loadScreenDetails(){
            axios.get('organizationApproval/getScreenId/Principal Recuritment__'+1)
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
        axios.get('common/getSessionDetail')
        .then(response => {
            let data = response.data.data;
            if(data['acess_level']=="Org"){
                this.form.organizationId=data['Agency_Code'];
                this.getorgdetials(data['Agency_Code']);
                $('#organizationId').val(data['Agency_Code']).trigger('change');
                $('#organizationId').prop('disabled',true);
            }
        })
        .catch(errors => {
            console.log(errors)
        });
         let data = await this.getRequiredDocument("Attachment_For_Principal_Recruitment");
            data.forEach((item => {
                this.form.attachments.push({file_name:item.name, file_upload:''})
            }));
    },
      created() {
        this.loadScreenDetails();
        this.loadDataList();

    },
    
}
</script>
