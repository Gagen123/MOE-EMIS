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
                                    <select name="organizationId" v-model="form.organizationId" :class="{ 'is-invalid': form.errors.has('organizationId') }" id="organizationId" class="form-control select2" @change="remove_error('organizationId')">
                                        <option value="">--- Please Select ---</option>
                                        <option v-for="(item, index) in orgList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                    </select>
                                    <has-error :form="form" field="organizationId"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label><u>Current Details</u></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Current Name:</label>
                                    <span class="text-blue text-bold">{{organization_details.name}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Level:</label>
                                    <span class="text-blue text-bold">{{levelArray[organization_details.levelId]}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Org Type:</label>
                                    <span class="text-blue text-bold">{{category}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Dzongkhag:</label>
                                    <span class="text-blue text-bold">{{dzongkhagArray[organization_details.dzongkhagId]}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Gewog:</label>
                                    <span class="text-blue text-bold" id="gewogid"></span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Village:</label>
                                    <span class="text-blue text-bold" id="vilageId"></span>
                                </div>
                            </div>
                            <hr>
                            <div v-if="proprietor_details!=''">
                                <div class="form-group row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label><u>Current Proprietor</u></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>CID:</label>
                                        <span class="text-blue text-bold">{{proprietor_details.cid}}</span>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Name:</label>
                                        <span class="text-blue text-bold">{{proprietor_details.fullName}}</span>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label> <div class="card-header p-0 border-bottom-0">
                                    <ul class="nav nav-tabs" id="tabhead">
                                        <li class="nav-item organization-tab" @click="shownexttab('organization-tab')">
                                            <a class="nav-link active" data-toggle="pill" role="tab">
                                                <label class="mb-0.5">Change for Proprietor</label>
                                            </a>
                                        </li>
                                    </ul>
                                    </div>Mobile No:</label>
                                        <span class="text-blue text-bold">{{proprietor_details.mobileNo}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Phone No:</label>
                                        <span class="text-blue text-bold">{{proprietor_details.phoneNo}}</span>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Email:</label>
                                        <span class="text-blue text-bold">{{proprietor_details.email}}</span>
                                    </div>
                                </div>
                            </div>

                            <hr>
                           <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label><u>Proposed Proprietor</u></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">CID:<span class="text-danger">*</span></label>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <input type="number" @keyup.enter="getDetailsbyCID('proprietorCid')" @blur="getDetailsbyCID('proprietorCid')" v-model="form.proprietorCid" :class="{ 'is-invalid': form.errors.has('proprietorCid') }" @change="remove_error('proprietorCid')" class="form-control" id="proprietorCid" placeholder="CID No."/>
                                    <has-error :form="form" field="proprietorCid"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Name:<span class="text-danger">*</span></label>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <input type="text" v-model="form.proprietorName" :class="{ 'is-invalid': form.errors.has('proprietorName') }" @change="remove_error('proprietorName')" class="form-control" id="proprietorName" placeholder="Proprietor Name"/>
                                    <has-error :form="form" field="proprietorName"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Contact Information:<span class="text-danger">*</span></label>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <input type="number" v-model="form.proprietorPhone" :class="{ 'is-invalid': form.errors.has('proprietorPhone') }" @change="remove_error('proprietorPhone')" class="form-control" id="proprietorPhone" placeholder="Phone No" />
                                    <has-error :form="form" field="proprietorPhone"></has-error>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <input type="number" v-model="form.proprietorMobile" :class="{ 'is-invalid': form.errors.has('proprietorMobile') }" @change="remove_error('proprietorMobile')" class="form-control" id="proprietorMobile" placeholder="Mobile No"/>
                                    <has-error :form="form" field="proprietorMobile"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Email:<span class="text-danger">*</span></label>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <input type="text" v-model="form.proprietorEmail" :class="{ 'is-invalid': form.errors.has('proprietorEmail') }" @change="remove_error('proprietorEmail')" class="form-control" id="proprietorEmail" placeholder="Email"/>
                                    <has-error :form="form" field="proprietorEmail"></has-error>
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
                                                    <input type="file" name="attachments" class="form-control application_attachment" v-on:change="onChangeFileUpload" @change="remove_error('attach'+(index+1))" :id="'attach'+(index+1)">
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
            orgList:'',
            levelList:[],
            locationList:[],
            dzongkhagList:[],
            gewog_list:[],
            villageList:[],
            classList1:[],
            streamList1:[],
            classList:[],
            streamList:[],

            organization_details:'',
            proprietor_details:'',
            category:'',
            proposed_by_list:[],
            levelArray:{},
            dzongkhagArray:{},
            gewogArray:{},
            villageArray:{},
            locationArray:{},
            calssArray:{},
            streamArray:{},
            form: new form({
                organizationId:'',org_name:'',proprietorName:'',proprietorCid:' ', proprietorPhone:'', proprietorMobile:'', proprietorEmail:'',
                application_type:'proprietor_change', application_for:'Change in Proprietor', action_type:'add', organization_type:'',
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
        getDetailsbyCID(fieldId){
            axios.get('getpersonbycid/'+ $('#'+fieldId).val())
            .then(response => {
                if (JSON.stringify(response.data)!='{}'){
                    let personal_detail = response.data.citizenDetail[0];
                    this.form.proprietorName = personal_detail.firstName + " " + personal_detail.lastName;
                }else{
                    Swal.fire({
                        html: "No data found for this CID",
                        icon: 'error'
                    });
                }
            })
            .catch((exception) => {
                console.log(exception);
            });
        },

        /**
         * method to show next and previous tab
         */
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
                        formData.append('proprietorName', this.form.proprietorName);
                        formData.append('proprietorCid', this.form.proprietorCid);
                        formData.append('proprietorPhone', this.form.proprietorPhone);
                        formData.append('proprietorMobile', this.form.proprietorMobile);
                        formData.append('proprietorEmail', this.form.proprietorEmail);
                        formData.append('proposedName', this.form.proposedName);
                        formData.append('initiatedBy', this.form.initiatedBy);
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

                        axios.post('organization/saveChangeBasicDetails', formData, config)
                        //this.form.post('organization/saveChangeBasicDetails')
                        .then((response) => {
                            if(response!=""){
                                if(response.data=="No Screen"){
                                    Toast.fire({
                                        icon: 'error',
                                        title: 'Technical Errors: please contact system admimnistrator for further details'
                                    });
                                }
                                if(response!="" && response!="No Screen"){
                                    let message="Application for Change in proprietor details has been submitted for approval. System Generated application number for this transaction is: <b>"+response.data.data.notification_appNo+'.</b><br> Use this application number to track your application status. <br><b>Thank You !</b>';
                                    this.$router.push({name:'proprietor_change_acknowledgement',params: {data:message}});
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Change details is saved successfully'
                                    });
                                }
                            }
                        })
                        .catch((error) => {
                            this.form.errors.errors = error.response.data;
                            this.validateFileform();
                        })

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
        getorgdetials(org_id){
            axios.get('loadCommons/loadOrgDetails/Orgbyid/'+org_id)
            .then(response => {
                this.form.organization_type=response.data.data.category; //this is required to check the screen while submitting
                this.organization_details=response.data.data;
                this.form.org_name=response.data.data.name;
                if(response.data.data.proprietor==null){
                    this.proprietor_details="";
                }
                else{
                    this.proprietor_details=response.data.data.proprietor;
                }

                this.category=this.organization_details.category.replace('_', " ").charAt(0).toUpperCase()+ this.organization_details.category.replace('_', " ").slice(1);
                this.getGewogList(response.data.data.dzongkhagId,response.data.data.gewogId);
                this.getvillagelist(response.data.data.gewogId,response.data.data.chiwogId);
            });
        },
        loadactivedzongkhagList(uri="masters/loadGlobalMasters/all_active_dzongkhag"){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.dzongkhagArray[data[i].id] = data[i].name;
                }
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },

        getGewogList(dzongkhag,gewogId){
            let uri = 'masters/all_active_dropdowns/dzongkhag/'+dzongkhag;
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.gewogArray[data[i].id] = data[i].name;
                }
                $('#gewogid').html(this.gewogArray[gewogId]);
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
                $('#vilageId').html(this.villageArray[vil_id])
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        loadScreenDetails(){
            axios.get('organizationApproval/getScreenId/Proprietor Change__'+1)
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


        applyselect2(){
            if(!$('#level').attr('class').includes('select2-hidden-accessible')){
                $('#level').addClass('select2-hidden-accessible');
            }
            if(!$('#dzongkhag').attr('class').includes('select2-hidden-accessible')){
                $('#dzongkhag').addClass('select2-hidden-accessible');
            }
            if(!$('#gewog').attr('class').includes('select2-hidden-accessible')){
                $('#gewog').addClass('select2-hidden-accessible');
            }
            if(!$('#chiwog').attr('class').includes('select2-hidden-accessible')){
                $('#chiwog').addClass('select2-hidden-accessible');
            }
            if(!$('#locationType').attr('class').includes('select2-hidden-accessible')){
                $('#locationType').addClass('select2-hidden-accessible');
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

    },

    async mounted() {
        this.orgList =await this.orgListUnderUserDzongkhag();
        this.loadScreenDetails();
        this.loadactivedzongkhagList();
        this.getLevel();
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
        this.getAttachmentType('ForTransaction__Application_for_Proprietor_Change');
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
