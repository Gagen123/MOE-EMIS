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
                                    <input type="radio" v-model="reasonArray[form.reason_id]" :class="{ 'is-invalid': form.errors.has('reason_id') }" :value="item.id"><label class="pr-4"> &nbsp;{{ item.name }}</label>
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
                                <label class="mb-0.5">Approved Transfer Preferences</label>
                                <table id="participant-table" class="table w-100 table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SlNo</th>
                                            <th>Dzongkhag/Thromde</th>
                                            <th>School</th>
                                            <th>Status</th>
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
                                             <td>
                                               <span class="text-blue text-bold">{{this.form.status}}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div v-if="attact" class="form-group row">
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
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <a href="#" @click="deletefile(attach)" class="fa fa-times text-danger"> Delete </a>
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
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0.5"><u>Undertaking</u></label><br />
                                <label>I hereby declare that the information given herein is true to the best of my knowledge and I also certify that:</label>
                            </div>
                        </div>
                        <span v-for="(item, index) in  undertakingList" :key="index">
                            <div class="form-group row">
                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                    <input type="checkbox" name="undertaking" class="icheck-success d-inline" :id="'undertaking'+index" :value="item.id">
                                </div>
                                <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
                                    <label class="pr-4"> &nbsp;{{ item.name }}</label><br />
                                </div>
                            </div>
                        </span>
                        <span class="text-danger" id="undertaking_err"></span>
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
                status:'',
                remarks:'',
                dzongkhagApproved:'',
                preference_school:'',
                transferType:"inter_transfer",
                service_name:"inter transfer",
              
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
                this.form.status=data.status;
                $(document).ready(function() {
                    $('#tbName').on('input change', function() {
                    if(this.form.status =="verify" || this.form.status == "approve" || this.form.status =="forward" || this.form.status =="Transfer Approved" ){
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
                    let formData = new FormData();
                        formData.append('type_id', this.form.type_id);
                        formData.append('transferwindow_id', this.form.transferwindow_id);
                        formData.append('staff_id', this.form.staff_id);
                        formData.append('reason_id', this.form.reason_id);
                        formData.append('description', this.form.description);
                        formData.append('transferType', this.form.transferType);
                    
                    axios.post('/staff/transfer/submitIntialapplicantDetails', formData)
                    .then((response) =>{
                        if(response!="" && response!="No Screen"){
                            this.form.id=response.data.data.id;
                            this.$router.push({name:'transfer_acknowledgement',params: {data:message}});
                            Toast.fire({
                                icon: 'success',
                                title: 'Application for Transfer has been submitted for further action'
                            });
                        }
                    })

                    .catch((error) => {
                        console.log("Errors:"+error)
                    });
                    this.change_tab(nextclass);
                    }
                   else{
                    Swal.fire({
                        text: "Time period for applying inter transfer is closed for the moment!",
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Okay!',
                        })
                    }
                }

                else if(nextclass=="final-tab"){
                    if(this.validated_final_form()){
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
                                formData.append('type_id', this.form.type_id);
                                formData.append('service_name', this.form.service_name);
                                formData.append('preference_dzongkhag1', this.form.preference_dzongkhag1);
                                formData.append('preference_dzongkhag2', this.form.preference_dzongkhag2);
                                formData.append('preference_dzongkhag3', this.form.preference_dzongkhag3);
                                formData.append('transferType', this.form.transferType);
                                for(let i=0;i<this.form.ref_docs.length;i++){
                                    formData.append('attachments[]', this.form.ref_docs[i].attachment);
                                    formData.append('attachmentname[]', this.form.ref_docs[i].file_name);
                                }
                                axios.post('/staff/transfer/submitFinalapplicantDetails', formData, config)
                                .then((response) =>{
                                    if(response!="" && response!="No Screen"){
                                        this.$router.push({name:'transfer_acknowledgement',params: {data:message}});
                                        Toast.fire({
                                            icon: 'success',
                                            title: 'Application for Transfer has been submitted for further action'
                                        });
                                    }
                                    this.applyselect2();
                                    this.$router.push('/list_inter_transfer');
                                })
                                .catch((error) => {
                                    console.log("Errors:"+error)
                                });
                            }
                        });
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
            }
            if(id=="preference_dzongkhag2"){
                this.form.preference_dzongkhag2=$('#preference_dzongkhag2').val();
            }
            if(id=="preference_dzongkhag3"){
                this.form.preference_dzongkhag3=$('#preference_dzongkhag3').val();
            }

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
        this.loadApplicationDetails();
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
