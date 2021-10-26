<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs" id="mainform">
            <div class="card-body pt-0 mt-1">
                <form class="form-horizontal">
                    <input type="hidden" class="form-control" v-model="form.id" id="id"/>
                    <div class="form-group row bg-gray-light">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <span id="screenName"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Organization Name:<span class="text-danger">*</span></label>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <select name="organizationId" v-model="form.organizationId" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('organizationId') }" id="organizationId" class="form-control select2" @change="remove_error('organizationId')">
                                <option value="">--- Please Select ---</option>
                                <option v-for="(item, index) in eccdList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                            </select>
                            <has-error :form="form" field="organizationId"></has-error>
                            <span class="text-danger" id="organizationId_err"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label>Current Name:</label>
                            <input type="text" readonly :value="organization_details.name"  class="form-control" id="proposedName" @click="remove_error('proposedName')"/>
                            <span class="text-danger" id="proposedname_err"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label>Dzongkhag:</label>
                            <input type="text" readonly :value="dzongkhagArray[organization_details.dzongkhagId]"  class="form-control" id="dzongkhagId"/>
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
                            <input type="text" readonly :value="organization_details.location_type_name"  class="form-control" id="location_type_name"/>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label>Is Co-located with Parent Schoo:</label>
                            <input type="text" readonly :value="organization_details.isColocated==1? 'yes':'No'" class="form-control" id="gewogid"/>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label>Parent School:</label>
                            <input type="text" readonly :value="organization_details.parentSchoolName" class="form-control" id="vilageId"/>
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
                            <span class="text-danger" id="gewog_err"></span>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label>Chiwog: <span class="text-danger">*</span></label>
                            <select v-model="form.chiwog" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('chiwog') }" class="form-control select2" name="chiwog" id="chiwog">
                                <option value="">--- Please Select ---</option>
                                <option v-for="(item, index) in villageList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                            </select>
                            <has-error :form="form" field="chiwog"></has-error>
                            <span class="text-danger" id="chiwog_err"></span>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label>Location Type: <span class="text-danger">*</span></label>
                            <select name="locationCategory" v-model="form.locationType" :class="{ 'is-invalid': form.errors.has('locationType') }" id="locationType" class="form-control select2" @change="remove_error('locationType')">
                                <option value="">--- Please Select ---</option>
                                <option v-for="(item, index) in locationList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                            </select>
                            <span class="text-danger" id="locationType_err"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Is Co-located with Parent School: <span class="text-danger">*</span></label><br>
                            <label><input  type="radio" v-model="form.coLocatedParent" value="1" tabindex=""/> Yes</label>
                            <label><input  type="radio" v-model="form.coLocatedParent" value="0" tabindex=""/> No</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Parent School: <span class="text-danger">*</span></label>
                            <select v-model="form.parentSchool" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('parentSchool') }" class="form-control select2" name="parentSchool" id="parentSchool">
                                <option value="">--- Please Select ---</option>
                                <option v-for="(item, index) in orgList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                            </select>
                            <has-error :form="form" field="parentSchool"></has-error>
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
                                            <input type="text" class="form-control" :class="{ 'is-invalid' :form.errors.has('file_name') }" v-model="att.file_name" :id="'file_name'+(index+1)" @change="remove_error('attach'+(index+1))">
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
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label class="mb-0">Remarks</label>
                            <textarea class="form-control" @change="remove_error('remarks')" v-model="form.remarks" id="remarks"></textarea>
                            <span class="text-danger" id="remarks_err"></span>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="row form-group fa-pull-right">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <button class="btn btn-primary" @click="shownexttab()">Submit </button>
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
            eccdList:[],
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
                organization_category:'',
                dzongkhag:'',
                gewog:'',
                chiwog:'0',
                locationType:'',
                coLocatedParent:'',
                parentSchool:'',
                remarks:'',
                proposedName:'',
                status:'Submitted',
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

        async loadactivedzongkhagList(){
            let data= await this.loadactivedzongkhags();
            for(let i=0;i<data.length;i++){
                this.dzongkhagArray[data[i].id] = data[i].name;
            }
        },

        async getvillagelist(gewogId,vil_id){
            let data = await this.loadvillageList(gewogId);
            for(let i=0;i<data.length;i++){
                this.villageArray[data[i].id] = data[i].name;
            }
            $('#vilageId').val(this.villageArray[vil_id])
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
        shownexttab(){
            if(this.validateForm()){
                Swal.fire({
                    text: "Are you sure you wish to submit this application details for further action ?",
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
                        formData.append('ref_docs[]', this.form.ref_docs);
                        for(let i=0;i<this.form.ref_docs.length;i++){
                            formData.append('attachments[]', this.form.ref_docs[i].attach);
                            formData.append('attachmentname[]', this.form.ref_docs[i].name);
                        }
                        formData.append('organizationId', this.form.organizationId);
                        formData.append('dzongkhag', this.form.dzongkhag);
                        formData.append('gewog', this.form.gewog);
                        formData.append('chiwog', this.form.chiwog);
                        formData.append('coLocatedParent', this.form.coLocatedParent);
                        formData.append('parentSchool', this.form.parentSchool);
                        formData.append('establishment_type', 'Location Change Services');
                        formData.append('application_type', 'Location Change');
                        formData.append('category', this.form.organization_category);
                        formData.append('proposedName', this.form.proposedName); //for workflow
                        formData.append('service_name', 'Location Change of ECCD Centres');

                        formData.append('locationType', this.form.locationType);
                        formData.append('remarks', this.form.remarks);
                        formData.append('status', this.form.status);

                        formData.append('screenId', this.screenId);
                        formData.append('SysRoleId', this.SysRoleId);
                        formData.append('Sequence', this.Sequence);
                        formData.append('Status_Name', this.Status_Name);

                        axios.post('organizationApproval/saveLocationChange', formData, config)
                        // this.form.post('organization/saveChangeBasicDetails')
                        .then((response) => {
                            if(response!=""){
                                let message="Application for Location Change has been submitted for approval. System Generated application number for this transaction is: <b>"+response.data.data.notification_appNo+'.</b><br> Use this application number to track your application status. <br><b>Thank You !</b>';
                                this.$router.push({name:'location_change_acknowledgement',params: {data:message}});
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Change details is saved successfully'
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
            if(id=="parentSchool"){
                this.form.parentSchool=$('#parentSchool').val();
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
        validateForm(){
            let returntype=true;
            if($('#organizationId').val()=="" || $('#organizationId').val()==undefined){
                $('#organizationId_err').html('Please select Organization for location change');
                returntype=false;
            }
            if($('#proposedName').val()==""){
                $('#proposedname_err').html('This name is not able to populate. Please contact with system administrator');
                returntype=false;
            }
            if($('#gewog').val()==""){
                $('#gewog_err').html('Please select new gewog');
                returntype=false;
            }
            if($('#chewog').val()==""){
                $('#chewog_err').html('Please select new chewog');
                returntype=false;
            }
            if($('#locationType').val()==""){
                $('#locationType_err').html('Please select new location type');
                returntype=false;
            }

            return returntype;
        },
        getorgdetials(org_id){
            axios.get('loadCommons/loadOrgDetails/Orgbyid/'+org_id)
            .then(response => {
                this.form.organization_category=response.data.data.category; //this is required to check the screen while submitting
                this.form.proposedName=response.data.data.name;
                this.organization_details=response.data.data;
                this.category=this.organization_details.category.replace('_', " ").charAt(0).toUpperCase()+ this.organization_details.category.replace('_', " ").slice(1);
                this.getGewogList(response.data.data.dzongkhagId,response.data.data.gewogId);
                this.getvillagelist(response.data.data.gewogId,response.data.data.chiwogId);
            });
        },

        applyselect2(){
            this.applyselect2field('organizationId');
            this.applyselect2field('gewog');
            this.applyselect2field('chiwog');
            this.applyselect2field('locationType');
        },

        loadScreenDetails(){
            axios.get('organizationApproval/getScreenId/'+'Location Change of ECCD Centres__'+1)
            .then(response => {
                // let data = response.data[0];
                let data = response.data.data;
                if(data!=undefined && data!="NA"){
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
        this.eccdList= await this.eccdListUnderUserDzongkhag();
        this.orgList= await this.schoolListUnderUserDzongkhag();

        axios.get('common/getSessionDetail')
        .then(response => {
            let data = response.data.data;
            this.form.organizationId=data['Agency_Code'];
            // this.getorgdetials(data['Agency_Code']);
            $('#organizationId').val(data['Agency_Code']).trigger('change');

            this.form.dzongkhag=data['Dzo_Id'];
            this.getGewogList(data['Dzo_Id']);
        })
        .catch(errors => {
            console.log(errors)
        });
    }
}
</script>
