<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs" id="mainform">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <li class="nav-item organization-tab" @click="shownexttab('organization-tab')">
                        <a class="nav-link active" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Downgradation</label>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body pt-0 mt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="organization-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="tab-pane fade active show tab-content-details" id="organization-tab" role="tabpanel" aria-labelledby="basicdetails">
                            <form class="form-horizontal">
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
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <label>Org Type:</label>
                                        <span class="text-blue text-bold">
                                            {{category}}
                                        </span>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <label>Level:</label>
                                         <span class="text-blue text-bold">{{levelArray[organization_details.levelId]}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <label>Dzongkhag: </label>
                                        <span class="text-blue text-bold">
                                            {{dzongkhagArray[organization_details.dzongkhagId]}}
                                        </span>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <label>Gewog:</label>
                                       <span class="text-blue text-bold" id="gewogid"></span>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <label>Village:</label>
                                        <span class="text-blue text-bold" id="vilageId"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <label>Location:</label>
                                        <span class="text-blue text-bold">
                                            {{locationArray[organization_details.locationId]}}
                                        </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label class="mb-0">Classes and streams:<span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Classes</th>
                                                    <th class="existstrm_clas">Stream</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(item, key, index) in  organization_details.classes" :key="index">
                                                    <td>
                                                        <label class="pr-4"> &nbsp;{{ calssArray[item.classId] }} </label>
                                                    </td>
                                                    <td class="existstrm_clas" v-if="calssArray[item.classId]=='Class 11' || calssArray[item.classId]=='XI' || calssArray[item.classId]=='Class 12' || calssArray[item.classId]=='XII'">
                                                        {{  streamArray[item.streamId]  }}
                                                    </td>
                                                    <td class="existstrm_clas" v-else> </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">New Level of Organization:<span class="text-danger">*</span></label>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <select name="level" v-model="form.level" :class="{ 'is-invalid': form.errors.has('level') }" id="level" class="form-control select2" @change="remove_error('level')">
                                            <option value="">--- Please Select ---</option>
                                            <option v-for="(item, index) in levelList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                        </select>
                                        <has-error :form="form" field="level"></has-error>
                                    </div>
                                </div>

                                    <!--
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                                    <span v-for="(item, key, index) in  classStreamList" :key="index">
                                        <span v-if="item.class!='Class 11' && item.class!='XI' && item.class!='Class 12' && item.class!='XII'">
                                            <input type="checkbox" v-model="form.class" :value="item.classId">
                                            <label class="pr-4"> &nbsp;{{ item.class }} </label>
                                        </span>
                                    </span>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                                    <span v-for="(item, key, index) in  classStreamList" :key="index">
                                        <span v-if="item.class=='Class 11' || item.class=='XI' || item.class=='Class 12' || item.class=='XII'">
                                            <input type="checkbox" v-model="form.stream"  :id="item.id" :value="item.id">
                                            <label class="pr-3">
                                                {{ item.class }}
                                                <span v-if="item.stream"> -
                                                    {{  item.stream  }}
                                                </span>
                                            </label>
                                        </span>
                                    </span>
                                </div> -->
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                                    <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Classes</th>
                                                <th class="strm_clas">Stream</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(item, key, index) in  classStreamList" :key="index">
                                                <td>
                                                    <label class="pr-4"> &nbsp;{{ item.class }} </label>
                                                </td>
                                                <td class="strm_clas" v-if="item.class=='Class 11' || item.class=='XI' || item.class=='Class 12' || item.class=='XII'">
                                                    {{  item.stream  }}
                                                </td>
                                                <td class="strm_clas" v-else>

                                                </td>
                                                <td v-if="item.class=='Class 11' || item.class=='XI' || item.class=='Class 12' || item.class=='XII'">
                                                    <input type="checkbox" v-model="form.stream"  :id="item.id" :value="item.id">
                                                </td>
                                                <td v-else>
                                                    <input type="checkbox" v-model="form.class" :value="item.classId">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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
            category:'',
            classList:[],
            streamList:[],
            classStreamList:[],
            levelList:[],
            levelArray:{},
            dzongkhagArray:{},
            locationArray:{},
            gewogArray:{},
            villageArray:{},
            calssArray:{},
            streamArray:{},
            organization_details:'',
            form: new form({
                organizationId:'', level:'', application_type:'downgradation', class:[], stream:[],
                application_for:'Downgradation', action_type:'add', status:'Submitted',organization_type:'',
                attachments:
                [{
                    file_name:'',attachment:''
                }],
                ref_docs:[],
            })
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

        /**
         * method to get level in dropdown
         */
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

        //getOrgList(uri = '/organization/getOrgList'){
        getOrgList(uri = 'loadCommons/loadOrgList/school/NA'){
            axios.get(uri)
            .then(response => {
                this.orgList = response.data.data;
            });
        },

        getorgdetials(org_id){
            axios.get('loadCommons/loadOrgDetails/Orgbyid/'+org_id)
            .then(response => {
                this.form.organization_type=response.data.data.category; //this is required to check the screen while submitting
                this.organization_details=response.data.data;
                this.category=this.organization_details.category.replace('_', " ").charAt(0).toUpperCase()+ this.organization_details.category.replace('_', " ").slice(1);
                this.getGewogList(response.data.data.dzongkhagId,response.data.data.gewogId);
                this.getvillagelist(response.data.data.gewogId,response.data.data.chiwogId);
            });
        },

        /**
         * method to populate dropdown
         */
        async changefunction(id,text){
            if(id=="organizationId"){
                this.form.organizationId=$('#organizationId').val();
                this.getorgdetials($('#organizationId').val());
            }
             if(id=="level"){
                this.form.level=$('#level').val();
                this.getClassStream(text);
            }
        },
        getClassStream(text){
            $('.strm_clas').hide();
            let level = text;
            if(level.toLowerCase().includes('middle')){
                level="10";
            }
            else if(level.toLowerCase().includes('lower')){
                level="8";
            }
            else if(level.toLowerCase().includes('primary')){
                level="6";
            }
            else{
                level="12";
                $('.strm_clas').show();
            }
            axios.get('/masters/loadClassStreamMapping/school_'+level)
            .then(response => {
                this.classStreamList = response.data.data;
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
                        formData.append('level', this.form.level);
                        for(let i=0;i<this.form.class.length;i++){
                            formData.append('class[]', this.form.class[i]);
                        }
                        for(let i=0;i<this.form.stream.length;i++){
                            formData.append('stream[]', this.form.stream[i]);
                        }
                        // formData.append('class', this.form.class);
                        // formData.append('stream', this.form.stream);
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
                                    let message="Application for Change basic details has been submitted for approval. System Generated application number for this transaction is: <b>"+response.data.data.notification_appNo+'.</b><br> Use this application number to track your application status. <br><b>Thank You !</b>';
                                    this.$router.push({name:'level_change_acknowledgement',params: {data:message}});
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Change details is saved successfully'
                                    });
                                }
                            }
                        })
                        .catch((err) => {
                            console.log("Error on submit:"+err)
                        })
                    }
                });
            }
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
                console.log("Error getting Village:"+error)
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
                    this.calssArray[data[i].id] = data[i].class;
                }
            });
        },

        getStream:function(){
            axios.get('/organization/getStream')
              .then(response => {
                let data = response.data;
                for(let i=0;i<data.length;i++){
                    this.streamArray[data[i].id] = data[i].stream;
                }
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
        loadScreenDetails(){
            axios.get('organizationApproval/getScreenId/Application For Upgrade And Downgrade__'+1)
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


        // /**
        //  * method to get class stream in checkbox
        //  */
        // getClassStream:function(){
        //     axios.get('/masters/loadClassStreamMapping/school')
        //       .then(response => {
        //         this.classStreamList = response.data.data;
        //     });
        // },

    },

    mounted() {
        this.loadScreenDetails();
        this.getOrgList();
        this.loadactivedzongkhagList();
        this.getClass();
        this.getStream();
        // this.getClassStream();
        this.getLevel();
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id'),$(this).find('option:selected').text());
        });
        this.getAttachmentType('ForTransaction__Application_for_Downgradation');
        Fire.$on('changefunction',(id,text)=> {
            this.changefunction(id,text);
        });

        axios.get('common/getSessionDetail')
        .then(response => {
            let data = response.data.data;
            if(data['acess_level']=="Org"){
                this.form.organizationId=data['Agency_Code'];
                this.getorgdetials(data['Agency_Code']);
                $('#organizationId').val(data['Agency_Code']).trigger('change');
            }
        })
        .catch(errors => {
            console.log(errors)
        });

    }
}
</script>
