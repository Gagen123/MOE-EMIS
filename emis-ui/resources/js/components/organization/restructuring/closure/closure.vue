<template>
    <div>
        <div class="callout callout-danger" style="display:none" id="ApplicationUnderProcess">
            <h5 class="bg-gradient-danger">Sorry!</h5>
            <div id="existmessage"></div>
        </div>
        <div class="card card-primary card-outline card-outline-tabs" id="mainform">
            <div class="card-header p-0 border-bottom-0">
                <div class="form-group row">
                    <label class="col-lg-3 col-md-3 col-sm-3 col-form-label pl-5">Select School:<span class="text-danger">*</span></label>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                    <select name="organizationId" id="organizationId" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('organizationId')}"  v-model="form.organizationId"  class="form-control select2" @change="getCategory(),remove_error('organizationId')">
                        <option value="">--- Please Select ---</option>
                        <option v-for="(item, index) in orgList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <has-error :form="form" field="organizationId"></has-error>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Present School Details</h3>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Name:</label>
                                    <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                        <span class="text-blue text-bold" id="name">{{data.name}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Code:</label>
                                    <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                        <span class="text-blue text-bold">{{data.code}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Level:</label>
                                    <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                        <span class="text-blue text-bold">{{levelArray[data.levelId]}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Category:</label>
                                    <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                        <span class="text-blue text-bold">{{ data.category == 'public_school' ? "Public School" :  "Private & Other"}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Geo-Politically Located:</label>
                                    <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                         <span class="text-blue text-bold"> {{ data.isGeopoliticallyLocated  == 1 ? "Yes" :  "No"}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">SEN School:</label>
                                    <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                        <span class="text-blue text-bold">{{data.isSenSchool == 1 ? "Yes" :  "No"}}</span>
                                    </div>
                                </div>
                                <label class="mb-0"><i><u>Other Details</u></i></label>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Dzongkhag:</label>
                                    <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                        <span class="text-blue text-bold">{{dzongkhagArray[data.dzongkhagId]}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Gewog:</label>
                                    <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                        <span class="text-blue text-bold" id="gewogName"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Chiwog:</label>
                                    <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                        <span class="text-blue text-bold" id="chewogName"> </span>
                                    </div>
                                </div>
                                <label class="mb-0"><i><u>Class & Stream Details</u></i></label>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                                        <span v-for="(item, index) in  data.classes" :key="index">
                                            <br>
                                            <input type="checkbox" checked="true" disabled><label class="pr-4"> &nbsp;{{ classArray[item.classId] }}</label>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Reasons/Remarks for Closure</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-horizontal">
                                <div class="form-group row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label class="mb-0">Reason:<span class="text-danger">*</span></label>
                                        <textarea class="form-control" v-model="form.reason" :class="{ 'is-invalid': form.errors.has('reason') }" @change="remove_error('reason')"></textarea>
                                        <has-error :form="form" field="reason"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label>Remarks:</label>
                                        <textarea class="form-control" v-model="form.remark"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label class="mb-0">Upload the Required Documents</label>
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
                                                        <input type="file" name="attachments" class="form-control application_attachment" v-on:change="onChangeFileUpload" :id="'attach'+(index+1)" @change="remove_error('attach'+(index+1))">
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
                                <hr>
                                <div class="row form-group fa-pull-right">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <button class="btn btn-primary" @click="shownexttab('final-tab')"> <i class="fa fa-save"></i>Submit </button>
                                    </div>
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
            data:'',
            orgList:'',
            levelList:[],
            levelArray:{},
            locationList:[],
            locationArray:{},
            dzongkhagList:[],
            dzongkhagArray:{},
            gewog_list:[],
            villageList:[],
            gewogArray:{},
            villageArray:{},
            classList:[],
            streamList:[],
            classArray:[],
            streamArray:[],
            sectionArray:[],
            classStreamList:[],

            form: new form({
                organizationId:'',
                reason:'',
                remark:'',
                application_type:'Closure',
                application_for:'Closure',
                screen_id:'',
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
        /**
         * method to get location in dropdown
         */
        getLocation(uri = '/organization/getLocationInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.locationList = data;
                for(let i=0;i<data.length;i++){
                    this.locationArray[data[i].id] = data[i].name;
                }
            });
        },

        /**
         * method to get other category if the category is 'ECCD'
         */
        getCategory(){
            let level = $('#level option:selected').text();
            if(level == "ECCD"){
                $(".eccd").show();
            }
            else{
                $(".eccd").hide();
            }
        },

        /**
         * method to get other category if the category is 'ECCD'
         */
        getCategory1(){
            let level = $('#level1 option:selected').text();
            $('.strm_clas').hide();
            // let level = text;
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
         * method to get active dzongkhag list
         */
        loadactivedzongkhagList(uri="masters/loadGlobalMasters/all_active_dzongkhag"){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.dzongkhagList =  data;
                for(let i=0;i<data.length;i++){
                    this.dzongkhagArray[data[i].id] = data[i].name;
                }
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },

        /**
         * method to get gewog list
         */
        async getgewoglist(id,gewogId){
            let dzoId=$('#dzongkhag').val();
            if(id!="" && dzoId==null){
                dzoId=id;
            }
            let uri = 'masters/all_active_dropdowns/dzongkhag/'+dzoId;
            axios.get(uri)
            .then(response =>{
                let data = response.data.data;
                this.gewog_list = data;
                for(let i=0;i<data.length;i++){
                    this.gewogArray[data[i].id] = data[i].name;
                }
                $('#gewogName').html(this.gewogArray[gewogId]);
            })
            .catch(function (error){
                console.log("Error in getting gewog:"+error)
            });
        },

        /**
         * method to get village list
         */
        async getvillagelist(id,villageId){
            let gewogId=$('#gewog').val();
            if(id!="" && gewogId==null){
                gewogId=id;
            }
            let uri = 'masters/all_active_dropdowns/gewog/'+gewogId;
            axios.get(uri)
            .then(response =>{
                let data = response.data.data;
                this.villageList = data;
                for(let i=0;i<data.length;i++){
                    this.villageArray[data[i].id] = data[i].name;
                }
                $('#chewogName').html(this.villageArray[villageId]);
            })
            .catch(function (error){
                console.log("Error in getting villages:"+error)
            });
        },
        /**
         * method to get class in checkbox
         */
        getClass:function(){
            axios.get('/organization/getClass')
              .then(response => {
                this.classList = response.data;
                let data = response.data;
                for(let i=0;i<data.length;i++){
                    this.classArray[data[i].id] = data[i].class;
                }
            });
        },

        /**
         * method to get stream in checkbox
         */
        getStream:function(){
            axios.get('/organization/getStream')
              .then(response => {
                this.streamList = response.data;
            });
        },

        /**
         * method to get other category if the category is 'ECCD'
         */
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
         * method to populate dropdown
         */
        async changefunction(id){
            if(id=="organizationId"){
                this.form.organizationId=$('#organizationId').val();
                this.getOrgDetails($('#organizationId').val());
            }
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
                        formData.append('organizationId', this.form.organizationId);
                        formData.append('reason', this.form.reason);
                        formData.append('remark', this.form.remark);
                        formData.append('application_for', this.form.application_for);
                        formData.append('screen_id', this.form.screen_id);
                        formData.append('ref_docs[]', this.form.ref_docs);
                        formData.append('screenId', this.screenId);
                        formData.append('SysRoleId', this.SysRoleId);
                        formData.append('Sequence', this.Sequence);
                        formData.append('Status_Name', this.Status_Name);
                        formData.append('screen_name', this.screen_name);
                        for(let i=0;i<this.form.ref_docs.length;i++){
                            formData.append('attachments[]', this.form.ref_docs[i].attach);
                            formData.append('attachmentname[]', this.form.ref_docs[i].name);
                        }
                        axios.post('organization/saveClosure',formData, config)
                        .then((response) => {
                            if(response.data!=""){
                                let message="Application for Closure has been submitted for approval. System Generated application number for this transaction is: <b>"+response.data.data.notification_appNo+'.</b><br> Use this application number to track your application status. <br><b>Thank You !</b>';
                                this.$router.push({name:'closure_acknowledgement',params: {data:message}});
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Closure details has been submitted for further action.'
                                });
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
            else{
                this.change_tab(nextclass);
            }
        },
        /**
         * method to change tabs
         */
        change_tab(nextclass){
            $('#tabhead >li >a').removeClass('active');
            $('#tabhead >li >a >span').addClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').addClass('active');
            $('.'+nextclass+' >a >span').removeClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').removeClass('disabled');
            $('.tab-content-details').hide();
            $('#'+nextclass).show().removeClass('fade');
        },
        getOrgDetails(id){
            // axios.get('organization/getFullSchoolDetials/'+id)
            axios.get('loadCommons/loadOrgDetails/fullOrgDetbyid/'+id)
            .then((response) => {
                let data=response.data.data;
                this.form.organizationId=data.id;
                this.getgewoglist(data.dzongkhagId,data.gewogId);
                this.getvillagelist(data.gewogId,data.chiwogId);
                this.data=data;
            })
            .catch((error) =>{
                console.log("Error in getting organization:"+error);
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
        applyselect2(){
            this.applyselect2field('organizationId');
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
            axios.get('organizationApproval/getScreenId/Closer__'+1)
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
    async mounted(){
        this.orgList =await this.orgListUnderUserDzongkhag();
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
        this.loadScreenDetails();
        this.getLevel();
        this.getLocation();
        this.getClass();
        this.getStream();
        this.loadactivedzongkhagList();
        this.getAttachmentType('ForTransaction__Application_for_Closure');
        axios.get('common/getSessionDetail')
        .then(response => {
            let data = response.data.data;
            if(data['acess_level']=="Org"){
                this.getOrgDetails(data['Agency_Code']);
                this.form.organizationId=data['Agency_Code'];
                $('#organizationId').val(data['Agency_Code']).trigger('update');
                $('#organizationId').prop('disabled', true);
            }
        })
        .catch(errors => {
            console.log(errors)
        });
    }
}
</script>
