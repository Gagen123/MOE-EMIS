<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs" id="mainform">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <a class="nav-link active" data-toggle="pill" role="tab">
                            <span class="card-title pt-2 mb-0">
                            <b id="screenName"></b>
                        </span>
                    </a>
                </ul>
            </div>
            <div class="card-body pt-0 mt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="organization-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="tab-pane fade active show tab-content-details" id="organization-tab" role="tabpanel" aria-labelledby="basicdetails">
                            <form class="form-horizontal">
                                <input type="hidden" class="form-control" v-model="form.id" id="id"/>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Organization Name:<span class="text-danger">*</span></label>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <select name="organizationId" v-model="form.organizationId" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('organizationId') }" id="organizationId" class="form-control select2" @change="remove_error('organizationId')">
                                            <option value="">--- Please Select ---</option>
                                            <option v-for="(item, index) in orgList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                        </select>
                                        <has-error :form="form" field="organizationId"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <label>Current Name:</label>
                                        <input type="text" readonly :value="organization_details.name"  class="form-control" id="proposedName"/>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4" id="level">
                                        <label>Level:</label>
                                        <input type="text" readonly :value="levelArray[organization_details.levelId]"  class="form-control" id="proposedName"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <label>Dzongkhag:</label>
                                        <input type="text" readonly :value="dzongkhagArray[organization_details.dzongkhagId]"  class="form-control" id="proposedName"/>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <label>Gewog:</label>
                                        <input type="text" readonly  class="form-control" id="gewogid"/>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <label>Village:</label>
                                        <input type="text" readonly class="form-control" id="vilageId"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <label>Location:</label>
                                        <input type="text" readonly :value="locationArray[organization_details.locationId]"  class="form-control" id="proposedName"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Classes</th>
                                                    <th class="strm_clas" id="stream">Stream</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(item, key, index) in  organization_details.classes" :key="index">
                                                    <td>
                                                        <label class="pr-4"> &nbsp;{{ classArray[item.classId] }} </label>
                                                    </td>
                                                    <td class="strm_clas" v-if="classArray[item.classId]=='Class 11' || classArray[item.classId]=='XI' || classArray[item.classId]=='Class 12' || classArray[item.classId]=='XII'" id="classArray">
                                                        {{  streamArray[item.streamId]  }}
                                                    </td>
                                                    <td class="strm_clas" v-else> </td>
                                                    <td v-if="item.class=='Class 11' || item.class=='XI' || item.class=='Class 12' || item.class=='XII'">
                                                        <input type="checkbox" checked="true" disabled>
                                                    </td>
                                                    <td v-else>
                                                        <input type="checkbox" checked="true" disabled>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Proposal Initiated By:<span class="text-danger">*</span></label>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <select name="initiatedBy" id="initiatedBy" v-model="form.initiatedBy" :class="{ 'is-invalid': form.errors.has('initiatedBy') }" class="form-control" @change="remove_error('initiatedBy')">
                                            <option value="">--- Please Select ---</option>
                                            <option v-for="(item, index) in proposed_by_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                        </select>
                                        <has-error :form="form" field="initiatedBy"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Proposed Name:<span class="text-danger">*</span></label>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <input type="text" v-model="form.proposedName" :class="{ 'is-invalid': form.errors.has('proposedName') }" @change="remove_error('proposedName')" class="form-control" id="proposedName" placeholder="Proposed Name"/>
                                        <has-error :form="form" field="proposedName"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label class="mb-0">Upload the Required Documents({{validfile()}})</label>
                                    </div>
                                </div><br>
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
                                                        <input type="file" name="attachments" class="form-control application_attachment" @change="remove_error('attach'+(index+1))" v-on:change="onChangeFileUpload" :id="'attach'+(index+1)">
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
                                    <button class="btn btn-primary" @click="shownexttab('final-tab')">Submit </button>
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
            organization_details:'',
            proposed_by_list:[],
            levelArray:{},
            dzongkhagArray:{},
            gewogArray:{},
            villageArray:{},
            locationArray:{},
            classArray:{},
            streamArray:{},
            orgList:'',
            classList:[],
            streamList:[],
            form: new form({
                organizationId:'',proposedName:'',initiatedBy:' ', application_type:'name_change',
                application_for:'Change in Name', action_type:'add', status:'Submitted',organization_type:'',category:'',
                service_name:'Change in Name',
                // remarks:'',
                status:'Submitted',
                attachments:
                [{
                    file_name:'',attachment:''
                }],
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
        /**
         * method to remove error
         */
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },

        shownexttab(nextclass){
            if(nextclass=="final-tab"){
            //   if(nextclass=="final-tab"){
            //         subform=this.validateFileform();
            //    }
                    Swal.fire({
                        text: "Are you sure you wish to save this details ?",
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
                            formData.append('organizationId', this.form.organizationId);
                            formData.append('category', this.form.category);
                            formData.append('proposedName', this.form.proposedName);
                            formData.append('initiatedBy', this.form.initiatedBy);
                            formData.append('application_type', this.form.application_type);
                            formData.append('application_for', this.form.application_for);
                            formData.append('action_type', this.form.action_type);
                            formData.append('status', this.form.status);
                            formData.append('service_name', this.form.service_name);
                            formData.append('screenId', this.screenId);
                            formData.append('SysRoleId', this.SysRoleId);
                            formData.append('Sequence', this.Sequence);
                            formData.append('Status_Name', this.Status_Name);
                            formData.append('screen_name', this.screen_name);
                            formData.append('organization_type', this.form.organization_type);
                            axios.post('organization/saveChangeBasicDetails', formData, config)
                            .then((response) => {
                                if(response!=""){
                                    if(response.data=="No Screen"){
                                        Toast.fire({
                                            icon: 'error',
                                            title: 'You dont have privileged to submit this application. Please contact system administrator'
                                        });
                                    }
                                    if(response!="" && response!="No Screen"){
                                        let message="Application for Change basic details has been submitted for approval. System Generated application number for this transaction is: <b>"+response.data.data.notification_appNo+'.</b><br> Use this application number to track your application status. <br><b>Thank You !</b>';
                                        this.$router.push({name:'name_change_acknowledgement',params: {data:message}});
                                        Toast.fire({
                                            icon: 'success',
                                            title: 'Change details is saved successfully'
                                        });
                                    }
                                }
                            })
                             .catch((error) => {
                               this.applyselect2();
                               this.form.errors.errors = error.response.data;
                               this.validateFileform();
                                })
                            
                        }
                    });
            }
        },

        /**
         * method to populate dropdown
         */
        async changefunction(id){
              if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="organizationId"){
                this.form.organizationId=$('#organizationId').val();
                this.getorgdetials($('#organizationId').val());
            }
             
            if(id=="initiatedBy"){
                this.form.initiatedBy=$('#initiatedBy').val();
            }
            if(id=="proposedName"){
                this.form.organizationId=$('#proposedName').val();
            }

        },
        getorgdetials(org_id){
            axios.get('loadCommons/loadOrgDetails/Orgbyid/'+org_id)
            .then(response => {
                this.form.organization_type=response.data.data.category; //this is required to check the screen while submitting
                this.organization_details=response.data.data;
                this.form.category=this.organization_details.category.replace('_', " ").charAt(0).toUpperCase()+ this.organization_details.category.replace('_', " ").slice(1);
                this.getGewogList(response.data.data.dzongkhagId,response.data.data.gewogId);
                this.getvillagelist(response.data.data.gewogId,response.data.data.chiwogId);
                if(this.form.organization_type == "public_eccd" || this.form.organization_type == "private_eccd" ){
                   $('#level').hide();

                }
            });
        },
        getLevel(uri = '/organization/getLevelInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.levelList = data;
                 for(let i=0;i<data.length;i++){
                    this.levelArray[data[i].id] = data[i].name;
                }
            });
        },

       async loadactivedzongkhagList(){
                let data= await this.loadactivedzongkhags();
                for(let i=0;i<data.length;i++){
                    this.dzongkhagArray[data[i].id] = data[i].name;
                }
        },

        getGewogList(dzongkhag,gewogId){
            let uri = 'masters/all_active_dropdowns/dzongkhag/'+dzongkhag;
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.gewogArray[data[i].id] = data[i].name;
                }
                $('#gewogid').val(this.gewogArray[gewogId]);
            });
        },

        getvillagelist(gewogId,vil_id){
            let uri = 'masters/all_active_dropdowns/gewog/'+gewogId;
            axios.get(uri)
            .then(response =>{
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.villageArray[data[i].id] = data[i].name;
                }
                $('#vilageId').val(this.villageArray[vil_id])
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        getLocation(uri = '/organization/getLocationInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                for(let i=0;i<data.length;i++){
                    this.locationArray[data[i].id] = data[i].name;
                }
            });
        },
        getClass:function(){
            axios.get('/organization/getClass')
              .then(response => {
                let data = response.data;
                for(let i=0;i<data.length;i++){
                    this.classArray[data[i].id] = data[i].class;
                }
            });
        },
        getstream:function(){
            axios.get('/organization/getStream')
              .then(response => {
                let data = response.data;
                for(let i=0;i<data.length;i++){
                    this.streamArray[data[i].id] = data[i].stream;
                }
            });
        },
        loadScreenDetails(){
            axios.get('organizationApproval/getScreenId/Name Change__'+1)
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
        applyselect2(){
            this.applyselect2field('organizationId');
           
        },
        loadproposedBy(uri = 'masters/organizationMasterController/loadOrganizaitonmasters/active/ProposedBy'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.proposed_by_list =  data;
            })
            .catch(function (error) {
                console.log('error: '+error);
            });
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

    },

    async mounted() {
        this.orgList =await this.orgListUnderUserDzongkhag();
        this.loadScreenDetails();
        this.loadactivedzongkhagList();
        this.loadproposedBy();
        this.getLevel();
        this.getLocation();
        this.getClass();
        this.getstream();
        this.getAttachmentType('ForTransaction__Application_for_Name_Change');
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
    }
}
</script>
