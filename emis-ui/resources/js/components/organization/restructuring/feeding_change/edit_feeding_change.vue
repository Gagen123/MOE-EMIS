<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs" id="mainform">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <li class="nav-item organization-tab" @click="shownexttab('organization-tab')">
                        <a class="nav-link active" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Change Feeding Details of Organization</label>
                        </a>
                    </li>
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
                                <!-- <div class="col-lg-4 col-md-4 col-sm-4">
                                    <label>Organization Type{{category}}</label>
                                </div> -->
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Is Feeding School(Curent):<span class="text-danger">*</span></label>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <label><input  type="radio" disabled v-model="existing_details.isFeedingSchool" value="1" tabindex=""/> Yes</label>
                                    <label><input  type="radio" disabled v-model="existing_details.isFeedingSchool" value="0" tabindex=""/> No</label>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4" v-if="existing_details.isFeedingSchool==1">
                                    <label><input  type="checkbox" id="exisfed1" disabled value="1" tabindex=""/> One Meal</label>
                                    <label><input  type="checkbox" id="exisfed2" disabled value="2" tabindex=""/> Two Meals</label>
                                    <label><input  type="checkbox" id="exisfed3" disabled value="3" tabindex=""/> Three Meals</label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Is Feeding School:<span class="text-danger">*</span></label>
                                <div class="col-lg-3 col-md-3 col-sm-3 pt-3">
                                    <label><input  type="radio" @change="show_feeding_details(true)" v-model="form.isfeedingschool" value="1" tabindex=""/> Yes</label>
                                    <label><input  type="radio" @change="show_feeding_details(false)" v-model="form.isfeedingschool" value="0" tabindex=""/> No</label>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"  id="feedingDetails" style="display:none">
                                    <label class="mb-0">Feeding Modality:</label><br>
                                    <label><input  type="checkbox" v-model="form.feeding" name="feeding" id="feeding1" value="1" tabindex=""/> One Meal</label>
                                    <label><input  type="checkbox" v-model="form.feeding" name="feeding" id="feeding2" value="2" tabindex=""/> Two Meals</label>
                                    <label><input  type="checkbox" v-model="form.feeding" name="feeding" id="feeding3" value="3" tabindex=""/> Three Meals</label>
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
                                            <tr v-for='(attach,count) in applicationdetailsatt' :key="count+1">
                                                <td>  {{attach.user_defined_file_name}} ({{attach.name}})</td>
                                                <td>
                                                    <a href="#" @click="openfile(attach)" class="fa fa-eye"> View</a>
                                                    <span>
                                                        <a href="#" class="pl-4 fa fa-times text-danger" @click="deletefile(attach)"> Delete </a>
                                                    </span>
                                                </td>
                                            </tr>
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
                            <br>
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
            orgList:[],
            classList:[],
            streamList:[],
            existing_details:'',
            category:'',
            record_id:'',
            applicationdetailsatt:'',
            form: new form({
                organizationId:'',feeding:[],  application_type:'feeding_change', isfeedingschool:'0',
                application_for:'Change in Feeding Details', action_type:'edit', status:'Submitted',organization_type:'',
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
        openfile(file){
            let file_path=file.path+'/'+file.name;
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
         * method to get location in dropdown
         */
        getLocation(uri = '/organization/getLocationInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.locationList = data;
            });
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

        getorgdetials(org_id){
            $('#organizationId').val(org_id).trigger('change');
            this.form.organizationId=org_id;
            axios.get('loadCommons/loadOrgDetails/Orgbyid/'+org_id)
            .then(response => {
                this.form.organization_type=response.data.data.category; //this is required to check the screen while submitting
                this.existing_details=response.data.data;
                this.category=this.existing_details.category.replace('_', " ").charAt(0).toUpperCase()+ this.existing_details.category.replace('_', " ").slice(1);

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
                        let clasArray=[];
                        $("input[name='feeding']:checked").each( function () {
                            clasArray.push($(this).val());
                        });
                        this.form.feeding=clasArray;
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
                        formData.append('isfeedingschool', this.form.isfeedingschool);
                        for(let i=0;i<this.form.feeding.length;i++){
                            formData.append('feeding[]', this.form.feeding[i]);
                        }
                        formData.append('application_type', this.form.application_type);
                        formData.append('application_for', this.form.application_for);
                        formData.append('action_type', this.form.action_type);
                        formData.append('status', this.form.status);
                        formData.append('organization_type', this.form.organization_type);
                        axios.post('organization/saveChangeBasicDetails', formData, config)
                        .then((response) => {
                            if(response!=""){
                                if(response.data=="No Screen"){
                                    Toast.fire({
                                        icon: 'error',
                                        title: 'Technical Errors: please contact system admimnistrator for further details'
                                    });
                                }
                                if(response!="" && response!="No Screen"){
                                    let message="Application for Feeding details has been updated and send for approval. <br><b>Thank You !</b>";
                                    this.$router.push({name:'feeding_change_acknowledgement',params: {data:message}});
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Change details is saved successfully'
                                    });
                                }
                            }
                        })
                        .catch((err) => {
                            console.log("Error:"+err);
                            this.form.errors.errors = err.response.data.errors;
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


        /**
         * method to get class in checkbox
         */
        getClass:function(){
            axios.get('/organization/getClass')
              .then(response => {
                this.classList = response.data;
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
         * Show feeding details options
         */
        show_feeding_details(param){
            if(param){
                $('#feedingDetails').show();
            }
            else{
                $('#feedingDetails').hide();
            }
        },

        loadApplicationDetials(){
            axios.get('organization/getChangeBasicDetails/'+this.record_id)
            .then(response => {
                let response_data=response.data.data;
                this.getorgdetials(response_data.change_details.organizationId);
                this.form.id=response_data.change_details.id;
                this.form.isfeedingschool=response_data.change_details.proposedChange;
                this.applicationdetailsatt=response_data.attachments;
                if(response_data.change_details.proposedChange==1){
                    $('#feedingDetails').show();
                    for(let i=0;i<response_data.feed_det.length;i++){
                        $('#feeding'+response_data.feed_det[i].noOfMeals).prop('checked',true);
                    }
                }
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
        $('[data-toggle="tooltip"]').tooltip();
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('#organizationId').prop('disabled',true);
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id'));
        });
        this.getAttachmentType('ForTransaction__Application_for_Change_in_Feeding_Details');
        Fire.$on('changefunction',(id)=> {
            this.changefunction(id);
        });
        this.record_id=this.$route.params.data.application_no;
        this.loadApplicationDetials();
    }
}
</script>
