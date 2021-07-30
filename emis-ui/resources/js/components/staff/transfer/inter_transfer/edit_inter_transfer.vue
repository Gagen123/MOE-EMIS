<template>
    <div>
        <div class="card card-danger card-outline" id="invalidsection" style="display:none">
            <div class="card-body pb-0 mb-0">
                <div class="callout callout-danger">
                    <div class="form-group row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label class="mb-0" id="err_message"></label><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-primary card-outline card-outline-tabs" id="t_form_details">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <li class="nav-item application-tab" @click="shownexttab('application-tab')">
                        <a class="nav-link active" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Application Details </label>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body pt-0 mt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="application-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0.5">Applicant Name:</label>
                                <span class="text-blue text-bold">{{this.form.name}}</span>
                                <has-error :form="form" field="name"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0.5">Transfer Reason:<i class="text-danger">*</i></label>
                                <br/>
                                <span v-for="(item, key, index) in  reasonList" :key="index">
                                    <input type="radio" v-model="form.reason_id" :class="{ 'is-invalid': form.errors.has('reason_id') }" :value="item.id"><label class="pr-4"> &nbsp;{{ item.name }}</label>
                                </span>
                                <has-error :form="form" field="reason_id"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0.5">Brief description for seeking transfer</label>
                                <textarea class="form-control" v-model="form.description" id="description"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0.5">Transfer Preferences</label>
                                <table id="participant-table" class="table w-100 table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SlNo</th>
                                            <th>Preferences</th>
                                            <th>Dzongkhag/Thromde</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Preferences 1</td>
                                            <td>
                                                <select v-model="form.preference_dzongkhag1" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('preference_dzongkhag1') }" class="form-control select2" name="preference_dzongkhag1" id="preference_dzongkhag1">
                                                    <option value=""> -- Select-- </option>
                                                    <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                </select>
                                                <has-error :form="form" field="preference_dzongkhag1"></has-error>
                                                <span class="text-danger" id="preference_dzongkhag1_err"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Preferences 2</td>
                                            <td>
                                                <select v-model="form.preference_dzongkhag2" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('preference_dzongkhag2') }" class="form-control select2" name="preference_dzongkhag2" id="preference_dzongkhag2">
                                                  <option value=""> -- Select-- </option>
                                                    <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                </select>
                                                <has-error :form="form" field="preference_dzongkhag2"></has-error>
                                                <span class="text-danger" id="preference_dzongkhag2_err"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Preferences 3</td>
                                            <td>
                                                <select v-model="form.preference_dzongkhag3" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('preference_dzongkhag3') }" class="form-control select2" name="preference_dzongkhag3" id="preference_dzongkhag3">
                                                   <option value=""> -- Select-- </option>
                                                    <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                </select>
                                                <has-error :form="form" field="preference_dzongkhag3"></has-error>
                                               <span class="text-danger" id="preference_dzongkhag3_err"></span>
                                            </td> 
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0.5">Organization Details</label>
                                <table id="participant-table" class="table w-100 table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SlNo</th>
                                            <th>Dzongkhag/Thromde</th>
                                            <th>School</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>
                                               <span class="text-blue text-bold">{{form.dzoName}}</span>
                                            </td>
                                            <td>
                                               <span class="text-blue text-bold">{{form.schoolName}} {{form.level}}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0.5">Approved Transfer Details</label>
                                <table id="participant-table" class="table w-100 table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SlNo</th>
                                            <th>Dzongkhag/Thromde</th>
                                            <th>School</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>
                                               <span class="text-blue text-bold">{{dzoArray[form.dzongkhagApproved]}}</span>
                                            </td>
                                            <td>
                                               <span class="text-blue text-bold">{{orgArray[form.preference_school]}}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0.5">Attachments</label>
                                <table id="participant-table" class="table w-100 table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Attachment Name</th>
                                            <th>File</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for='(attach,count) in draft_attachments' :key="count+1">
                                            <td>
                                                <input type="text" class="form-control" readonly :value="attach.user_defined_name">
                                            </td>
                                            <td>
                                                <a href="#" @click="openfile(attach)" class="fa fa-eye"> View</a>
                                                <span>
                                                    <a href="#" class="pl-4 fa fa-times text-danger" @click="deletefile(attach)"> Delete </a>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr id="record1" v-for='(att, index) in form.attachments' :key="index">
                                            <td>
                                                <input type="text" class="form-control" @change="remove_err('file_name'+(index+1))" :class="{ 'is-invalid' :form.errors.has('file_name') }" v-model="att.file_name" :id="'file_name'+(index+1)">
                                                <span class="text-danger" :id="'file_name'+(index+1)+'_err'"></span>
                                            </td>
                                            <td>
                                                <input type="file" class="form-control" @change="remove_err('attach'+(index+1))" v-on:change="onChangeFileUpload" :id="'attach'+(index+1)">
                                                <span class="text-danger" :id="'attach'+(index+1)+'_err'"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <button type="button" class="btn btn-flat btn-sm btn-primary" id="addMore"
                                                @click="addMoreattachments()"><i class="fa fa-plus"></i> Add More</button>
                                                <button type="button" class="btn btn-flat btn-sm btn-danger" id="addMore"
                                                @click="removeattachments()"><i class="fa fa-trash"></i> Remove</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div  class="row form-group fa-pull-right">
                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="tbName">
                            <button type="submit" id="button" class="btn btn-primary" @click="shownexttab('final-tab')"> <i class="fa fa-save"></i>Update </button>
                         </div>
                        </div>
                    </div>
                    <hr>
                 </div>
                </div>
            </div>
        </div>
</template>
<script>
export default {
    data(){
        return {
            attact:false,
            filecount:1,
            t_warning:false,
            t_warning_message:'',
            staffList:'',
            reasonList:'',
            undertakingList:[],
            dzongkhagList:[],
            dzoArray:{},
            orgArray:{},
            reasonArray:{},
            working_history_list:[],
            training_details_list:[],
            draft_attachments:[],
            intratransfer:[],
            form: new form({
                id: '',
                t_year:'',
                t_from_date:'',
                t_to_date:'',
                t_remarks:'',
                transferwindow_id:'',
                name: '',
                reason_id:'',
                description:'',
                current_date:'',
                type_id:'',
                dzoName:'',
                schoolName:'',
                status:'',
                remarks:'',
                dzongkhagApproved:'',
                application_number:'',
                preference_school:'',
                preference_dzongkhag1:'',
                preference_dzongkhag2:'',
                preference_dzongkhag3:'',
              
                attachments:
                [{
                    file_name:'',attachment:''
                }],
                ref_docs:[],
            })
        }
    },
    methods: {
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },
        addMoreattachments: function(){
            this.filecount++;
            this.form.attachments.push({file_name:'',attachment:''})
        },
        removeattachments(index){
            if(this.form.attachments.length>1){
                this.filecount--;
                this.form.attachments.pop();
                this.form.ref_docs.pop();
            }
        },
        onChangeFileUpload(e){
            let currentcount=e.target.id.match(/\d+/g)[0];
            if($('#file_name'+currentcount).val()!=""){
                this.form.ref_docs.push({file_name:$('#file_name'+currentcount).val(),attachment:e.target.files[0]});
                $('#file_name'+currentcount).prop('readonly',true);
            }
            else{
                $('#file_name'+currentcount+'_err').html('Please mention file name');
                $('#'+e.target.id).val('');
            }
        },
        loadApplicationDetails(id){
            axios.get('staff/transfer/loadApplicationDetails/' +id)
            .then((response) =>{
                let data=response.data;
                this.form.id=data.id;
                this.form.transfer_reason_id=data.transfer_reason_id;
                this.form.description=data.description;
                this.form.staff_id=data.staff_id;
                this.form.transferType=data.transferType;
                this.form.dzongkhagApproved=data.dzongkhagApproved;
                this.form.preference_school=data.preference_school;
                this.form.application_number = data.aplication_number;
                this.form.status=data.status;
                this.loadattachementDetails(data.aplication_number);
                $(document).ready(function() {
                    $('#tbName').on('input change', function() {
                    if(this.form.status =="verify" || this.form.status == "approve" || this.form.status =="forward" || this.form.status =="Transfer Approved" ){
                        alert(this.form.status);
                       $('#button').prop('disabled', false);
                       this.attact=true;
                    }else{
                        $('#button').prop('enabled', true);
                    }
                    });
                });
          })
        },
        loadstaff(){
            let uri ='loadCommons/loadFewDetailsStaffList/userworkingagency/NA';
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.staffList = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        loadreasons(uri = 'masters/loadStaffMasters/active_transfer'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.reasonList =  data;
                 for(let i=0;i<data.length;i++){
                 this.reasonArray[data[i].id] = data[i].name;
                }
            })
            .catch(function (error) {
               console.log("Error:"+error)
            });
        },
        loadactivedzongkhagList(uri="masters/loadGlobalMasters/all_active_dzongkhag"){
            axios.get(uri)
            .then(response => {
                let data = response.data.data
                this.dzongkhagList =  data;
                for(let i=0;i<data.length;i++){
                 this.dzoArray[data[i].id] = data[i].name;
                }
            })
            .catch(function (error) {
                console.log("Error:"+error)
            });
        },
        loadOrgList(uri ='staff/transfer/LoadSchoolByDzoId/userdzongkhagwise/NA'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                for(let i=0;i<data.length;i++){
                 this.orgArray[data[i].id] = data[i].name;
                }
            })
            .catch(function (error) {
                console.log("Error:"+error)
            });
        },
        loadundertakingList(uri = 'masters/loadStaffMasters/active_transfer_undertakingr'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.undertakingList =  data.data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        LoadTransferType(uri = 'masters/loadGlobalMasters/inter'){
            axios.get(uri)
            .then(response =>{
                this.form.type_id = response.data.data.id;

            })
            .catch(function (error){
                console.log(error);
            });
        },
        validated_final_form(){
            let returntue=true;
            if($('#preference_dzongkhag1').val()==null){
                $('#preference_dzongkhag1_err').html('Please select this dzongkhag');
                $('#preference_dzongkhag1').focus();
                $('#preference_dzongkhag1').addClass('is-invalid');
                returntue=false;
            }
            for(let i=0;i<this.undertakingList.length;i++){
                if($('#undertaking'+i).prop('checked')==false){
                    $('#undertaking_err').html('You need to accept all of the undertakings');
                    $('#undertaking').focus();
                    $('#undertaking').addClass('is-invalid');
                    returntue=false;
                }
            }
            return returntue;
        },
         shownexttab(nextclass){
            if(nextclass=="final-tab"){
                if(this.form.t_to_date <=this.form.current_date || this.form.t_from_date >this.form.current_date){
                    Swal.fire({
                        text: "Are you sure you wish to submit for further approval ?",
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
                            formData.append('reason_id', this.form.reason_id);
                            formData.append('description', this.form.description);
                            formData.append('application_number', this.form.application_number);
                            formData.append('preference_dzongkhag1', this.form.preference_dzongkhag1);
                            formData.append('preference_dzongkhag2', this.form.preference_dzongkhag2);
                            formData.append('preference_dzongkhag3', this.form.preference_dzongkhag3);
                            for(let i=0;i<this.form.ref_docs.length;i++){
                                formData.append('attachments[]', this.form.ref_docs[i].attachment);
                                formData.append('attachmentname[]', this.form.ref_docs[i].file_name);
                            }
                            axios.post('/staff/transfer/UpdatedApplicantDetails', formData, config)
                             .then((response) =>{
                                if(response.data!="" && response!="No Screen"){
                                    let message=" Your transfer application has been updated successfully for applicaiton number: "+ this.form.application_number;
                                    this.$router.push({name:'intra_transfer_acknowledgement',params: {data:message}});
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Application for Transfer has been submitted for further action'
                                    });
                                }
                            })
                            .catch((error) => {
                                console.log("Errors:"+error)
                            });
                        }
                    });
                }
                else{
                Swal.fire({
                    text: "Time period for applying intra transfer is closed for the moment!",
                    icon: 'error',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Okay!',
                    })
                }
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

        profile_details(){
            axios.get('common/getSessionDetail')
            .then(response => {
                this.form.name = response.data.data.Full_Name;
                this.getDzongkhagName(response.data.data.Dzo_Id)
                this.getOrgaName(response.data.data.Agency_Code);
                

            })
            .catch(errors =>{
                console.log(errors)
            });
        },
        getDzongkhagName(id){
            axios.get('common/getDzoNameById/' +id)
            .then(response => {
                this.form.dzoName = response.data.name;

            })
            .catch(errors =>{
                console.log(errors)
            });
        },
        getOrgaName(id){
            axios.get('organization/getOrgProfile/' +id)
            .then(response => {
                this.form.schoolName = response.data.data.orgName;
                this.form.level = response.data.data.level;

            })
            .catch(errors =>{
                console.log(errors)
            });
        },
        loadattachementDetails(appId){
             axios.get('staff/transfer/loadattachementDetails/'+appId)
            .then((response) =>{
                let data = response.data.data;
                for(let i=0;i<data.preferences.length;i++){
                    if(i==0){
                        this.form.preference_dzongkhag1     =   data.preferences[i].dzongkhag_id;
                        $('#preference_dzongkhag1').val(data.preferences[i].dzongkhag_id).trigger('change');
                    }
                    if(i==1){
                        this.form.preference_dzongkhag2     =   data.preferences[i].dzongkhag_id;
                        $('#preference_dzongkhag2').val(data.preferences[i].dzongkhag_id).trigger('change');
                    }
                    if(i==2){
                        this.form.preference_dzongkhag3     =   data.preferences[i].dzongkhag_id;
                        $('#preference_dzongkhag3').val(data.preferences[i].dzongkhag_id).trigger('change');
                    }
                }
                this.draft_attachments=data.documents;
                
        })
            .catch(errors =>{
                console.log(errors)
            });
        },
        changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="staff_id"){
                this.form.staff_id=$('#staff_id').val();
            }
            if(id=="preference_dzongkhag1"){
                this.form.preference_dzongkhag1=$('#preference_dzongkhag1').val();
                this.checkforselectedval(1);
            }
            if(id=="preference_dzongkhag2"){
                this.form.preference_dzongkhag2=$('#preference_dzongkhag2').val();
                this.checkforselectedval(2);
            }
            if(id=="preference_dzongkhag3"){
                this.form.preference_dzongkhag3=$('#preference_dzongkhag3').val();
                this.checkforselectedval(3);
            }

        },
        checkforselectedval(cout){
            if($('#preference_dzongkhag1').val()!="" && $('#preference_dzongkhag2').val()!="" && $('#preference_dzongkhag1').val()==$('#preference_dzongkhag2').val()){
                $('#preference_dzongkhag'+cout+'_err').html('This dzongkhag is already selected');
                $('#preference_dzongkhag'+cout).val('').trigger('change');
            }
            if($('#preference_dzongkhag2').val()!="" && $('#preference_dzongkhag3').val()!="" && $('#preference_dzongkhag2').val()==$('#preference_dzongkhag3').val()){
                $('#preference_dzongkhag'+cout+'_err').html('This dzongkhag is already selected');
                $('#preference_dzongkhag'+cout).val('').trigger('change');
            }
            if($('#preference_dzongkhag1').val()!="" && $('#preference_dzongkhag3').val()!="" && $('#preference_dzongkhag1').val()==$('#preference_dzongkhag3').val()){
                $('#preference_dzongkhag'+cout+'_err').html('This dzongkhag is already selected');
                $('#preference_dzongkhag'+cout).val('').trigger('change');
            }
        },
        openfile(file){
            let file_path=file.path+'/'+file.original_name;
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
        getDraftDetails(){
            axios.get('staff/transfer/getDraftDetails')
            .then(response => {
                let data = response.data.data;
                if(data!=null){
                    this.form.id=data.id;
                    this.form.staff_id=data.staff_id;
                    this.form.reason_id=data.transfer_reason_id;
                    this.form.description=data.description;
                }
            })
            .catch(errors =>{
                console.log(errors)
            });
        }
    },
    mounted() {
        let currentdate = new Date();
        this.form.year=currentdate.getFullYear();
        this.form.current_date=currentdate.getFullYear()+'-'+(currentdate.getMonth() + 1)+'-'+currentdate.getDate();
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
        this.getDraftDetails();
        this.profile_details();
        this.loadstaff();
        this.loadreasons();
        this.loadactivedzongkhagList();
        this.loadundertakingList();
        this.LoadTransferType();
        this.loadOrgList();
        this.loadreasons(this.$route.params.data.transfer_reason_id);
        this.loadApplicationDetails(this.$route.params.data.id)
        this.form.id=this.$route.params.data.id;
        this.form.staff_id=this.$route.params.data.staff_id;
        this.form.reason_id=this.$route.params.data.transfer_reason_id;
        this.form.description=this.$route.params.data.description;
        this.form.status=this.$route.params.data.status;
        this.form.dzongkhag_id=this.$route.params.data.dzongkhag_id;
    },
}
</script>
