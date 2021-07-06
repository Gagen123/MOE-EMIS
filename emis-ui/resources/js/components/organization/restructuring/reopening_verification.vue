<template>
    <div>
        <ol class="mb-1 ml-xl-n3 mr-xl-n2 pl-3" style="background-color:#E5E5E5">
            <li class="pl-2 form-inline "><h6 class="pt-1">Application Verification/Approval(School Reopening)</h6></li>
        </ol>
        <div class="card card-primary card-outline card-outline-tabs">

            <div class="card-body pt-0 mt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="organization-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="callout callout-success" v-if="existing_details!=''">
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label><u>Current Details School to be re-opened:</u></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Name:</label>
                                    <span class="text-blue text-bold">{{existing_details.name}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Level:</label>
                                    <span class="text-blue text-bold">{{levelArray[existing_details.levelId]}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Year of Establishment:</label>
                                    <span class="text-blue text-bold">{{existing_details.yearOfEstablishment}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Category:</label>
                                    <span class="text-blue text-bold">{{existing_details.category}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Dzongkhag:</label>
                                    <span class="text-blue text-bold">{{dzoArray[existing_details.dzongkhagId]}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Gewog:</label>
                                    <span class="text-blue text-bold">{{selected_gewog}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Village:</label>
                                    <span class="text-blue text-bold">{{selected_village}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Classes</th>
                                                <th class="strm_clas">Stream</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(item, key, index) in  existing_details.classes" :key="index">
                                                <td>
                                                    <label class="pr-4"> &nbsp;{{ calssArray[item.classId] }} </label>
                                                </td>
                                                <td class="strm_clas" v-if="calssArray[item.classId]=='Class 11' || calssArray[item.classId]=='XI' || calssArray[item.classId]=='Class 12' || calssArray[item.classId]=='XII'">
                                                    {{  streamArray[item.streamId]  }}
                                                </td>
                                                <td class="strm_clas" v-else> </td>
                                                <td v-if="item.class=='Class 11' || item.class=='XI' || item.class=='Class 12' || item.class=='XII'">
                                                    <input type="checkbox" checked="true" disabled name="calssXIXII" :value="item.classId">
                                                </td>
                                                <td v-else>
                                                    <input type="checkbox" checked="true" disabled>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="callout callout-info" v-if="appicationDetails!=''">
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label><u>Application Details</u></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Application Number:</label>
                                    <span class="text-blue text-bold">{{appicationDetails.application_no}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Application Date:</label>
                                    <span class="text-blue text-bold">{{appicationDetails.reopening.dateOfReopening}}</span>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Type of Change:</label>
                                    <span class="text-blue text-bold">{{appicationDetails.establishment_type}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Name:</label>
                                    <span class="text-blue text-bold">{{appicationDetails.reopening.proposedName}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Level:</label>
                                    <span class="text-blue text-bold">{{levelArray[appicationDetails.reopening.levelId]}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Dzongkhag:</label>
                                    <span class="text-blue text-bold">{{dzoArray[appicationDetails.dzongkhagId]}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Gewog:</label>
                                    <span class="text-blue text-bold">{{selected_gewog1}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Village:</label>
                                    <span class="text-blue text-bold">{{selected_village1}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Classes</th>
                                                <th class="strm_clas">Stream</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(item, key, index) in  appicationDetails.change_classes" :key="index">
                                                <td>
                                                    <label class="pr-4"> &nbsp;{{ calssArray[item.classId] }} </label>
                                                </td>
                                                <td class="strm_clas" v-if="calssArray[item.classId]=='Class 11' || calssArray[item.classId]=='XI' || calssArray[item.classId]=='Class 12' || calssArray[item.classId]=='XII'">
                                                    {{  streamArray[item.streamId]  }}
                                                </td>
                                                <td class="strm_clas" v-else> </td>
                                                <td v-if="item.class=='Class 11' || item.class=='XI' || item.class=='Class 12' || item.class=='XII'">
                                                    <input type="checkbox" checked="true" disabled name="calssXIXII" :value="item.classId">
                                                </td>
                                                <td v-else>
                                                    <input type="checkbox" checked="true" disabled>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="callout callout-info">
                            <div class="form-group row">
                                <div class="card-body col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <h5><u>Attachments (if applicable)</u></h5>
                                    <table id="participant-table" class="table w-100 table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Attachment Name</th>
                                                <th>Attachment</th>
                                                <th>File</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for='(attach,count) in appicationDetails.attachments' :key="count+1">
                                                <template>
                                                    <td>{{attach.user_defined_file_name}} </td>
                                                    <td>  {{attach.name}}</td>
                                                    <td>
                                                        <a href="#" @click="openfile(attach)" class="fa fa-eye"> View</a>
                                                    </td>
                                                </template>
                                            </tr>
                                        </tbody>
                                    </table>
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
                                                    <input type="file" class="form-control" v-on:change="onChangeFileUpload" :id="'attach'+(index+1)">
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
                         </div>
                        <div class="row form-group" v-if="appicationDetails.establishment_type=='Change in Name' || appicationDetails.establishment_type=='Upgrade Downgrade'">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <input type="date" class="form-control" @change="remove_error('effective_date')" v-model="form.effective_date" id="effective_date" />
                                <span class="text-danger" id="effective_date_err"></span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Remarks</label>
                                <textarea class="form-control" @change="remove_error('remarks')" v-model="form.remarks" id="remarks"></textarea>
                                <span class="text-danger" id="remarks_err"></span>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <!-- <button class="btn btn-success" @click="shownexttab('organization-tab')"><i class="fa fa-arrow-left"></i>Previous </button> -->
                                <button class="btn btn-danger" @click="shownexttab('reject')"> <i class="fa fa-times"></i> Reject </button>
                                <button class="btn btn-primary" @click="shownexttab('verify')" style="display:none" id="verifyId"> <i class="fa fa-forward"></i>Verify </button>
                                <button class="btn btn-dark" @click="shownexttab('approve')" id="approveId"> <i class="fa fa-check"></i>Approve </button>
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
            count:1,
            proprietorList1:[],
            proprietorList:[],
            class_section:[],
            sectionList:[],
            class_section1:[],
            sectionList1:[],

            existing_details:'',
            oldOrg2:'',
            levelArray:{},
            dzoArray:{},
            gewogArray:{},
            gewogArray1:{},
            calssArray:{},
            streamArray:{},
            proposed_by_list:{},
            locationArray:{},
            selected_gewog:'',
            selected_gewog1:'',
            selected_village:'',
            selected_village1:'',
            villageArray:{},
            villageArray1:{},
            appicationDetails:[],
            isfeedingschool:'',
            senSchool:'',
            form: new form({
                id: '',applicationNo:'',actiontype:'',remarks:'',establishment_type:'',
                ref_docs:[],fileUpload: [],sequence:'',screen_id:'',effective_date:'',
            }),
        }
    },

    methods:{
        openfile(file){
            let file_path=file.path+'/'+file.name;
            file_path=file_path.replaceAll('/', 'SSS');
            let uri = 'common/viewFiles/'+file_path;
            window.location=uri;
        },
        addMore: function(){
            this.count++;
            this.form.fileUpload.push({file_name:'', file_upload:''})
        },
        remove(index){
             if(this.form.fileUpload.length>1){
                this.count--;
                this.form.fileUpload.splice(index,1);
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
                for(let i=0;i<data.length;i++){
                    this.levelArray[data[i].id] = data[i].name;
                }
            });
        },
        /**
         * method to load previous org details
         */
        loadPriviousOrgDetails(org_id){
            axios.get('loadCommons/loadOrgDetails/fullOrgDetbyid/'+org_id)
            .then(response => {
                this.existing_details=response.data.data;
                this.form.category=this.existing_details.category;
                this.getgewog(response.data.data.dzongkhagId,response.data.data.gewogId);
                this.getVillage(response.data.data.gewogId,response.data.data.chiwogId);
            })
            .catch((error) => {
                console.log("Error: "+error);
            });
        },

        /**
         * method to load previous org details
         */
        loadReopeningApplicationDetails(appId,type){
            axios.get('organization/loadReopeningForVerification/'+appId+'/'+type)
            .then((response) => {
                let data=response.data.data;
                this.loadPriviousOrgDetails(data.reopening.organizationId);
                this.appicationDetails=data;
                this.form.sequence=response.data.sequence;
                this.form.screen_id=response.data.screen_id;
                this.form.establishment_type=data.establishment_type;
                this.getgewog1(response.data.data.dzongkhagId,response.data.data.gewogId);
                this.getVillage1(response.data.data.gewogId,response.data.data.chiwogId);
                if(response.data.app_stage.toLowerCase().includes('verifi')){
                    $('#verifyId').show();
                }
                if(response.data.app_stage.toLowerCase().includes('approve')){
                    $('#approveId').show();
                }
            })
            .catch((error) => {
                console.log("Error......"+error);
            });
        },



        /**
         * method to show next tab and update application accordingly
         */
        shownexttab(nextclass){
            if(nextclass=="reject" || nextclass=="verify" || nextclass=="approve"){
                let action=true;
                if(nextclass=="reject" && this.form.remarks==""){
                    $('#remarks_err').html('Please mention remarks');
                    $('#remarks').addClass('is-invalid');
                    action=false;
                }
                if(action){
                    Swal.fire({
                        text: "Are you sure you wish to "+nextclass+" this Application ?",
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
                            formData.append('actiontype', nextclass);
                            formData.append('category', this.form.category);
                            formData.append('sequence', this.form.sequence);
                            formData.append('screen_id', this.form.screen_id);
                            formData.append('applicationNo', this.form.applicationNo);
                            formData.append('remarks', this.form.remarks);
                            formData.append('service_name', this.form.establishment_type);
                            formData.append('ref_docs[]', this.form.ref_docs);
                            for(let i=0;i<this.form.ref_docs.length;i++){
                                formData.append('attachments[]', this.form.ref_docs[i].attach);
                                formData.append('attachmentname[]', this.form.ref_docs[i].name);
                            }
                            axios.post('organization/updateReopeningApplication', formData, config)
                            .then((response) => {
                                if(response!=""){
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Application details has been updated.'
                                    });
                                    this.$router.push({path:'/tasklist'});
                                }
                            })
                            .catch((err) => {
                                Swal.fire(
                                    'error!',
                                    'Not able to update this application details. Please contact system administrator.Error: '+err,
                                    'error',
                                );
                                console.log("Error:"+err)
                            })
                        }
                    });
                }
            }
            else{
                $('#tabhead >li >a').removeClass('active');
                $('#tabhead >li >a >span').addClass('bg-gradient-secondary text-white');
                $('.'+nextclass+' >a').addClass('active');
                $('.'+nextclass+' >a >span').removeClass('bg-gradient-secondary text-white');
                $('.'+nextclass+' >a').removeClass('disabled');
                $('.tab-content-details').hide();
                $('#'+nextclass).show().removeClass('fade');
            }
        },
        loaddzongkhagList(uri = 'masters/loadGlobalMasters/all_dzongkhag'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.dzoArray[data[i].id] = data[i].name;
                }
            })
            .catch(function (error) {
                console.log('err: '+error);
            });
        },
        getgewog(dzoId,gewogId){
            axios.get('masters/all_active_dropdowns/dzongkhag/'+dzoId)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.gewogArray[data[i].id] = data[i].name;
                }
                this.selected_gewog=this.gewogArray[gewogId];
            })
            .catch(function (error) {
                console.log('err: '+error);
            });
        },
        getgewog1(dzoId,gewogId){
            axios.get('masters/all_active_dropdowns/dzongkhag/'+dzoId)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.gewogArray1[data[i].id] = data[i].name;
                }
                this.selected_gewog1=this.gewogArray1[gewogId];
            })
            .catch(function (error) {
                console.log('err: '+error);
            });
        },
        getVillage(gewogId,villageId){
            axios.get('masters/all_active_dropdowns/gewog/'+gewogId)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.villageArray[data[i].id] = data[i].name;
                }
                this.selected_village=this.villageArray[villageId];
            })
            .catch(function (error) {
                console.log('err: '+error);
            });
        },
        getVillage1(gewogId,villageId){
            axios.get('masters/all_active_dropdowns/gewog/'+gewogId)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.villageArray1[data[i].id] = data[i].name;
                }
                this.selected_village1=this.villageArray1[villageId];
            })
            .catch(function (error) {
                console.log('err: '+error);
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
        loadproposedBy(uri = 'masters/organizationMasterController/loadOrganizaitonmasters/active/ProposedBy'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.proposed_by_list[data[i].id] = data[i].name;
                }
            })
            .catch(function (error) {
                console.log('error: '+error);
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
    },

    mounted(){
        this.getLocation();
        this.loadproposedBy();
        this.getLevel();
        this.getClass();
        this.getStream();
        this.loaddzongkhagList();
        this.form.applicationNo=this.$route.params.data.application_number;
        this.loadReopeningApplicationDetails(this.$route.params.data.application_number,this.$route.params.type);

    }
}
</script>
