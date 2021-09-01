<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs" id="mainform">
            <div class="card-body pt-0 mt-1">
                <form class="form-horizontal">
                    <input type="hidden" class="form-control" v-model="form.id" id="id"/>
                    <div class="form-group row bg-gray-light">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <span id="screenName"></span>
                            {{screenId}}
                            {{SysRoleId}}
                            {{Sequence}}
                            {{Status_Name}}
                        </div>
                    </div>
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
                            <label>Current Name:</label>
                            <input type="text" readonly :value="organization_details.name"  class="form-control" id="proposedName"/>
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
                            <input type="text" readonly :value="organization_details.location_type_name"  class="form-control" id="proposedName"/>
                        </div>
                    </div>
                    <label class="mb-0"><i><u>Proposed Location Details</u></i></label>
                    <div class="form-group row">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label>Gewog: <span class="text-danger">*</span></label>
                            <select v-model="form.gewog" :class="{ 'is-invalid select2 select2-hidden-accessible':form.errors.has('gewog') }" class="form-control select2" name="gewog" id="gewog">
                                <option value="">--- Please Select ---</option>
                                <option v-for="(item, index) in gewog_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                            </select>
                            <has-error :form="form" field="gewog"></has-error>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label>Chiwog: <span class="text-danger">*</span></label>
                            <select v-model="form.chiwog" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('chiwog') }" class="form-control select2" name="chiwog" id="chiwog">
                                <option value="">--- Please Select ---</option>
                                <option v-for="(item, index) in villageList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                            </select>
                            <has-error :form="form" field="chiwog"></has-error>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label>Location Type: <span class="text-danger">*</span></label>
                            <select name="locationCategory" v-model="form.locationType" :class="{ 'is-invalid': form.errors.has('locationType') }" id="locationType" class="form-control select2" @change="remove_error('locationType')">
                                <option value="">--- Please Select ---</option>
                                <option v-for="(item, index) in locationList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="card-body col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>File Name</th>
                                        <th>Upload File</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="record1" v-for='(att, index) in form.fileUpload' :key="index">
                                        <td>
                                            <input type="text" class="form-control" :class="{ 'is-invalid' :form.errors.has('file_name') }" v-model="att.file_name" :id="'file_name'+(index+1)">
                                            <span class="text-danger" :id="'file_name'+(index+1)+'_err'"></span>
                                        </td>
                                        <td>
                                            <input type="file" name="attachments" class="form-control" v-on:change="onChangeFileUpload" :id="'attach'+(index+1)">
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
</template>
<script>

export default {
    data(){
        return{
            count:0,
            organization_details:'',
            proposed_by_list:[],
            gewog_list:[],
            villageList:[],
            orgList:'',
            locationList:[],
            streamList:[],
            category:'',
            dzongkhagArray:{},
            gewogArray:{},
            villageArray:{},

            screenId:'',
            SysRoleId:'',
            Sequence:'',
            Status_Name:'',

            form: new form({
                organizationId:'',
                gewog:'',
                chiwog:'0',
                locationType:'',
                service_name:'',
                application_type:'location_type_change',
                application_for:'Change in Location Type',
                status:'Submitted',
                organization_type:'',
                fileUpload: [],
                attachments:
                [{
                    file_name:'',attachment:''
                }],
                ref_docs:[],
            }),
        }
    },
    methods: {
        /**
         * method to remove error
         */
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },

        async getGewogList(dzongkhag,gewogId){
            let data = await this.loadgewogList(dzongkhag);
            this.gewog_list = data;
            for(let i=0;i<data.length;i++){
                this.gewogArray[data[i].id] = data[i].name;
            }
            $('#gewogid').val(this.gewogArray[gewogId]);
        },

        //getOrgList(uri = '/organization/getOrgList'){
        getOrgList(uri = 'loadCommons/loadOrgList/all_eccds_dzogkhag_wise/NA'){
            axios.get(uri)
            .then(response => {
                this.orgList = response.data.data;
            });
        },

        async getproposedvillagelist(id){
            let gewogId=$('#gewog').val();
            if(id!=""){
                gewogId=id;
            }
            this.villageList =await this.loadvillageList(gewogId);
        },

        addMore: function(){
            this.count++;
            this.form.fileUpload.push({file_name:'', file_upload:''})
        },

        /**
         * method to remove fields
         */
        remove(){
            if(this.form.fileUpload.length>1){
                this.count--;
                this.form.fileUpload.pop();
            }
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
                        this.form.post('organization/saveChangeBasicDetails')
                        .then((response) => {
                            if(response!=""){
                                if(response.data=="No Screen"){
                                    Toast.fire({
                                        icon: 'error',
                                        title: 'No dont have privileged to submit this application. Please contact system administrator'
                                    });
                                }
                                if(response!="" && response!="No Screen"){
                                    let message="Application for Change basic details has been submitted for approval. System Generated application number for this transaction is: <b>"+response.data.application_number+'.</b><br> Use this application number to track your application status. <br><b>Thank You !</b>';
                                    this.$router.push({name:'location_change_acknowledgement',params: {data:message}});
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
            if(id=="gewog"){
                this.form.gewog=$('#gewog').val();
                this.getproposedvillagelist($('#gewog').val());
            }
            if(id=="chiwog"){
                this.form.chiwog=$('#chiwog').val();
            }
            if(id=="locationType"){
                this.form.locationType=$('#locationType').val();
            }
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

        applyselect2(){
            this.applyselect2field('level');
            this.applyselect2field('gewog');
            this.applyselect2field('chiwog');
            this.applyselect2field('locationType');
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

        loadScreenDetails(){
            axios.get('organizationApproval/getScreenId/'+'Location Change of ECCD Centres__'+1)
            .then(response => {
                let data = response.data[0];
                if(data!=undefined){
                    $('#screenName').html('<b>Creating Application for '+data.screenName+'</b>');
                    this.screenId=data.screen;
                    this.SysRoleId=data.SysRoleId;
                    this.Sequence=data.Sequence;
                    this.Status_Name=data.Status_Name;
                    this.form.service_name=data.screenName;
                }else{
                    $('#screenPermission').show();
                    $('#mainform').hide();
                    $('#message').html('You dont have priviletes to create new application for this service. Please contact with system administrator. <br> Thank you!');
                }
            })
            .catch(errors => {
                console.log(errors)
            });
        },
        async loadattachments(type){
            let data = await this.getRequiredDocument(type);
            if(data!=""){
                data.forEach((item =>{
                    this.count++;
                    this.form.fileUpload.push({file_name:item.name, file_upload:''})
                }));
            }
        },
    },

    async mounted() {
        this.loadScreenDetails();
        this.locationList =await this.loadlocationList();
        this.proposed_by_list =  await this.loadproposedByList();
        this.loadactivedzongkhagList();
        this.getOrgList();
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

        this.loadattachments('Application_for_Location_Change');

        axios.get('common/getSessionDetail')
        .then(response => {
            let data = response.data.data;
            this.form.organizationId=data['Agency_Code'];
            this.getorgdetials(data['Agency_Code']);
            $('#organizationId').val(data['Agency_Code']).trigger('change');

            this.dzongkhag=data['Dzo_Id'];
            this.form.dzongkhag=data['Dzo_Id'];
            this.getGewogList(data['Dzo_Id']);
        })
        .catch(errors => {
            console.log(errors)
        });
    }
}
</script>
