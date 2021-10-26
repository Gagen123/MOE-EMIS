<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs" id="mainform">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <li class="nav-item organization-tab" @click="shownexttab('organization-tab')">
                        <a class="nav-link active" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Application For Autonomous</label>
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
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <label>Current Name:</label>
                                        <input type="text" readonly :value="organization_details.name"  class="form-control" id="proposedName"/>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
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
                                    <div class="col-lg-4 col-md-4 col-sm-4 pt-3">
                                        <label>Autonomy:</label>
                                         <label>{{organization_details.isAutonomy==1 ? 'Yes':'No'}}</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 pt-3">
                                        <label>Propose for Autonomy:<span class="text-danger">*</span></label>
                                        <label><input  type="radio" v-model="form.isAutonomy" value="1" tabindex=""/> Yes</label>
                                        <label><input  type="radio" v-model="form.isAutonomy" value="0" tabindex=""/> No</label>
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
            orgList:'',
            classList:[],
            locationList:[],
            streamList:[],
            category:'',
            levelArray:{},
            dzongkhagArray:{},
            gewogArray:{},
            villageArray:{},
            locationArray:{},
            calssArray:{},
            streamArray:{},
            record_id:'',
            applicationdetailsatt:'',
            form: new form({
                id:'',organizationId:'',isAutonomy:1, application_type:'autonomus_change',
                application_for:'Change in Autonomy', action_type:'edit', status:'Submitted',organization_type:'',
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
                        this.form.errors.errors = error.response.data;
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
                        formData.append('isAutonomy', this.form.isAutonomy);
                        formData.append('application_type', this.form.application_type);
                        formData.append('application_for', this.form.application_for);
                        formData.append('action_type', this.form.action_type);
                        formData.append('status', this.form.status);
                        formData.append('organization_type', this.form.organization_type);
                        axios.post('organization/saveChangeBasicDetails', formData, config)
                        //this.form.post('organization/saveChangeBasicDetails')
                        .then((response) => {
                            if(response!=""){
                                if(response.data=="No Screen"){
                                    Toast.fire({
                                        icon: 'error',
                                        title: 'No dont have privileged to submit this application. Please contact system administrator'
                                    });
                                }
                                if(response!="" && response!="No Screen"){
                                    let message="Application for Aotonomy details has been updated and submitted for further approval. <br><b>Thank You !</b>";
                                    this.$router.push({name:'autonomous_acknowledgement',params: {data:message}});
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Change details is saved successfully'
                                    });
                                }
                            }
                        })
                        .catch((err) => {
                            console.log("Error:"+err)
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
            if(id=="locationType"){
                this.form.locationType=$('#locationType').val();
            }


        },
        getorgdetials(org_id){
            $('#organizationId').val(org_id).trigger('change');

            this.form.organizationId=org_id;
            axios.get('loadCommons/loadOrgDetails/Orgbyid/'+org_id)
            .then(response => {
                 this.form.organization_type=response.data.data.category; //this is required to check the screen while submitting
                this.organization_details=response.data.data;
                this.category=this.organization_details.category.replace('_', " ").charAt(0).toUpperCase()+ this.organization_details.category.replace('_', " ").slice(1);
                this.getGewogList(response.data.data.dzongkhagId,response.data.data.gewogId);
                this.getvillagelist(response.data.data.gewogId,response.data.data.chiwogId);
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
                this.locationList = data;
                for(let i=0;i<data.length;i++){
                    this.locationArray[data[i].id] = data[i].name;
                }
            });
        },
        loadApplicationDetials(){
            axios.get('organization/getChangeBasicDetails/'+this.record_id)
            .then(response => {
                let response_data=response.data.data;
                this.getorgdetials(response_data.change_details.organizationId);
                this.form.id=response_data.change_details.id;
                this.form.isAutonomy=response_data.change_details.proposedChange;
                this.applicationdetailsatt=response_data.attachments;
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
        this.getLocation();
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
        this.getAttachmentType('ForTransaction__Application_for_Change_in_Autonomy');
        $('#organizationId').prop('disabled',true);
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
        this.record_id=this.$route.params.data.application_no;
        this.loadApplicationDetials();
    }
}
</script>
