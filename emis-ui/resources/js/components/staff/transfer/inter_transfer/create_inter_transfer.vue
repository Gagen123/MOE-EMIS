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
                    <li class="nav-item undertaking-tab" @click="shownexttab('undertaking-tab')">
                        <a class="nav-link" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Options & Undertaking</label>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body pt-0 mt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="application-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="card card-success card-outline collapsed-card" id="adv_serach_ection">
                            <div class="card-body pb-0 mb-0" style="display:none">
                                <div class="callout callout-success">
                                    <div class="form-group row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label class="mb-0">Year:</label>
                                            <span class="text-blue text-bold">{{form.t_year}}</span>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label class="mb-0">From Date:</label>
                                            <span class="text-blue text-bold">{{form.t_from_date}}</span>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label class="mb-0">End Date:</label>
                                            <span class="text-blue text-bold">{{form.t_to_date}}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label class="mb-0">Remarks:</label>
                                            <span class="text-blue text-bold">{{ form.t_remarks}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header pb-0 pt-2">
                                <h3 class="card-title">Transfer Window Details <span v-if="t_warning" class="text-danger">({{t_warning_message}})</span></h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-plus" ></i>
                                    </button>
                                </div>
                            </div>
                        </div>
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
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" @click="shownexttab('undertaking-tab')">Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade tab-content-details" id="undertaking-tab" role="tabpanel" aria-labelledby="basicdetails">
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
                        <!-- subject specification -->
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0.5">Subject specialization</label>
                                <table id="participant-table" class="table w-100 table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SlNo</th>
                                            <th>Specialization</th>
                                            <th>Select Subject</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td class="mb-0.5">Specialization Subject</td>
                                            <td>
                                                <select v-model="form.spSubject" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('spSubject') }" class="form-control select2" name="spSubject" id="spSubject">
                                                    <option value=""> -- Select-- </option>
                                                    <option v-for="(item, index) in subjectList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                </select>
                                                <has-error :form="form" field="spSubject"></has-error>
                                                <span class="text-danger" id="spSubject_err"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Optional Teaching Subject 1</td>
                                            <td>
                                                <select v-model="form.optional1sub" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('optional1sub') }" class="form-control select2" name="optional1sub" id="optional1sub">
                                                  <option value=""> -- Select-- </option>
                                                    <option v-for="(item, index) in subjectList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                </select>
                                                <has-error :form="form" field="optional1sub"></has-error>
                                                <span class="text-danger" id="optional1sub_err"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Optional Teaching Subject 2</td>
                                            <td>
                                                <select v-model="form.optional2sub" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('optional2sub') }" class="form-control select2" name="optional2sub" id="optional2sub">
                                                   <option value=""> -- Select-- </option>
                                                    <option v-for="(item, index) in subjectList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                </select>
                                                <has-error :form="form" field="optional2sub"></has-error>
                                               <span class="text-danger" id="optional2sub_err"></span>
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
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('application-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-primary" @click="shownexttab('final-tab')"> <i class="fa fa-save"></i>submit </button>
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
        return {
            filecount:1,
            t_warning:false,
            t_warning_message:'',
            staffList:'',
            reasonList:'',
            undertakingList:[],
            dzongkhagList:[],
            subjectList:[],
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
                reason_id:'',
                description:'',
                current_date:'',
                type_id:'',
                name:'',
                preference_dzongkhag:[],
                status: 'pending',
                transferType:"Inter Transfer",
                service_name:"Inter Transfer",
                preference_dzongkhag1:'',
                preference_dzongkhag2:'',
                preference_dzongkhag3:'',
                spSubject:'',
                optional1sub:'',
                optional2sub:'',
                user_id:'',
                transfer_list:'',
                attachments:
                [],
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
                let data = response;
                this.reasonList =  data.data.data;
            })
            .catch(function (error) {
               console.log("Error:"+error)
            });
        },
        loadactivedzongkhagList(uri="masters/loadGlobalMasters/all_active_dzongkhag"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dzongkhagList =  data.data.data;
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
        LoadTransferType(uri = 'masters/loadStaffMasters/inter'){
            axios.get(uri)
            .then(response =>{
                this.form.type_id = response.data.data[0].id;

            })
            .catch(function (error){
                console.log(error);
            });
        },
        loadtransferDetails(){
            axios.get('staff/transfer/loadtransferDetails/inter_transfer')
            .then((response) => {
                this.form.transfer_list =  response.data;
             })
            .catch((error) => {
                console.log("Error in retrieving ."+error);
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
            if(this.form.transfer_list =="" || this.form.transfer_list == null){
                if(nextclass=="undertaking-tab"){
                    if(this.form.t_to_date >=this.form.current_date || this.form.t_from_date <=this.form.current_date){
                        let formData = new FormData();
                            formData.append('type_id', this.form.type_id);
                            formData.append('transferwindow_id', this.form.transferwindow_id);
                            formData.append('name', this.form.name);
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
                                formData.append('spSubject', this.form.spSubject);
                                formData.append('optional1sub', this.form.optional1sub);
                                formData.append('optional2sub', this.form.optional2sub);
                                formData.append('transferType', this.form.transferType);
                                for(let i=0;i<this.form.ref_docs.length;i++){
                                    formData.append('attachments[]', this.form.ref_docs[i].attachment);
                                    formData.append('attachmentname[]', this.form.ref_docs[i].file_name);
                                }
                                axios.post('/staff/transfer/submitFinalapplicantDetails', formData, config)
                                .then((response) =>{
                                    if(response.data!="" && response!="No Screen"){
                                    let message=" Your transfer application has been submitted with the system generated applicaiton number: "+response.data.application_number;
                                    this.$router.push({name:'inter_transfer_acknowledgement',params: {data:message}});
                                    
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
            }else{
                   Swal.fire({
                    text: "Sorry! you have already submitted your transfer application and  you are not allowed to apply again ",
                    icon: 'warning',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'okay!',
                    })
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
                this.form.user_id = response.data.data.User_Id;
            })
            .catch(errors =>{
                console.log(errors)
            });
        },
        
        loadtransferwindow(){
            axios.get('masters/loadGlobalMasters/inter_transfer')
           .then((response) => {
                let data=response.data.data[0];
                 if(data!=null){
                    this.form.transferwindow_id=data.id;
                    this.form.t_from_date=data.from_date;
                    this.form.t_to_date=data.to_date;
                    this.form.t_year=data.year;
                    this.form.t_remarks=data.remarks;
                    this.form.t_id=data.id;
                  
                    let todate=new Date(data.to_date);
                    let formdate = new Date();
                    // One day in milliseconds
                    const oneDay = 1000 * 60 * 60 * 24;
                    // Calculating the time difference between two dates
                    const diffInTime = todate.getTime() - formdate.getTime();

                    // Calculating the no. of days between two dates
                    const diffInDays =(diffInTime / oneDay);
                    if(diffInDays<=5 && diffInDays>0){
                        this.t_warning_message="Only "+Math.ceil(diffInDays)+" day(s) left to apply";
                        this.t_warning=true;
                    }
                    else if(diffInDays<=0){
                        $('#err_message').html("<b>Sorry!</b><br> Tranfer period is over for this year");
                        $('#invalidsection').show();
                        $('#t_form_details').hide();
                    }
                }
                 else{
                    $('#err_message').html('<b>Sorry!</b><br> System cannot find a valid Transfer configuration. Might be the tranfer period is over for this year or might not yet reach for the period');
                    $('#invalidsection').show();
                    $('#t_form_details').hide();
                }
             })
            .catch((error) => {
                console.log("Error."+error);
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
            if(id=="spSubject"){
                this.form.spSubject=$('#spSubject').val();
            }
            if(id=="optional1sub"){
                this.form.optional1sub=$('#optional1sub').val();
            }
            if(id=="optional2sub"){
                this.form.optional2sub=$('#optional2sub').val();
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
        },
         loadAcademicMasters(uri="masters/loadAcademicMasters/all_active_subject"){
            axios.get(uri)
            .then(response =>{
                let data = response.data.data;
                this.subjectList = data;
            })
            .catch(function (error) {
                console.log(error);
            });
        },

    },
    async mounted() {
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
        this.loadtransferDetails();
        this.getDraftDetails();
        this.profile_details();
        this.loadstaff();
        this.loadreasons();
        this.loadactivedzongkhagList();
        this.loadAcademicMasters();
        this.loadundertakingList();
        this.loadtransferwindow();
        this.LoadTransferType();
        
        let data = await this.getRequiredDocument("Inter_Transfer_attachment");
        data.forEach((item => {
            this.form.attachments.push({file_name:item.name, file_upload:''})
        }));
    },
}
</script>
