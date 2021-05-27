<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <li class="nav-item nomination-tab" @click="shownexttab('nomination-tab')">
                        <a class="nav-link active" data-toggle="pill" role="tab"> 
                            <label class="mb-0.5">Nomination Details </label>                              
                        </a>
                    </li>
                    <li class="nav-item feedback-tab" @click="shownexttab('feedback-tab')">
                        <a class="nav-link" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Feedback Provider </label>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body pt-0 mt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="nomination-tab" role="tabpanel" aria-labelledby="nomination">
                        <form class="bootbox-form">
                            <div class="card-body">
                                <div class="row form-group">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Selection For:<span class="text-danger">*</span></label> 
                                        <select class="form-control select2" id="selection_type" v-model="form.selection_type" :class="{ 'is-invalid': form.errors.has('selection_type') }">
                                            <option v-for="(item, index) in selectionList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                        </select> 
                                        <has-error :form="form" field="selection_type"></has-error>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Position:<span class="text-danger">*</span></label> 
                                        <select class="form-control select2" id="position_title" v-model="form.position_title" :class="{ 'is-invalid': form.errors.has('position_title') }">
                                            <option v-for="(item, index) in positionList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                        </select> 
                                        <has-error :form="form" field="position_title"></has-error>
                                    </div>
                                </div>  
                                <div class="row form-group">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Feed back Start Date:<span class="text-danger">*</span></label> 
                                        <input type="date" class="form-control" @change="remove_err('from_date')" :class="{ 'is-invalid': form.errors.has('from_date') }"  name="from_date" id="from_date" v-model="form.from_date">
                                        <has-error :form="form" field="from_date"></has-error>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Feed back End Date:<span class="text-danger">*</span></label> 
                                        <input type="date" @change="remove_err('to_date')" :class="{ 'is-invalid': form.errors.has('to_date') }"  class="form-control" name="to_date" id="to_date" v-model="form.to_date">
                                        <has-error :form="form" field="to_date"></has-error>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pt-4">
                                        <label>Details:</label> 
                                        <textarea class="form-control" :class="{ 'is-invalid': form.errors.has('reason') }" v-model="form.details" id="details"></textarea>
                                        <has-error :form="form" field="details"></has-error>
                                    </div>
                                </div> 
                                <hr>
                                <div class="row form-group">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label><b><u>Nominees</u></b></label> 
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>CID/Passport/Emp Id:</label> 
                                        <input type="text" name="emp_deails" id="emp_deails" class="form-control">
                                        <span class="text-danger" id="emp_deails_err"></span>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pt-4 mt-2">
                                        <button type="button" @click="getEmpDetails()" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> Search</button>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pt-4">
                                        <table id="nomination-list-table" class="table table-sm table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>CID/Passport</th>
                                                    <th>Position Title</th>
                                                    <th>Organizaiton</th>  
                                                    <th>Dzongkhag</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for='(user, index) in form.nomi_staffList' :key="index">
                                                    <td> {{user.name}}</td>
                                                    <td> {{user.cid}}</td>
                                                    <td> {{user.po_title}}</td>
                                                    <td> {{user.org}}</td>
                                                    <td> {{user.dzo}}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5">
                                                        <button type="button" class="btn btn-flat btn-sm btn-danger" id="removeId" 
                                                        @click="remove('nomination')"><i class="fa fa-trash"></i> Remove</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <span id="nminees_error" class="text-danger"></span>
                                        </table>
                                    </div>
                                </div> 
                            </div>
                        </form>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" @click="shownexttab('feedback-tab')">Save & Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade show tab-content-details" id="feedback-tab" role="tabpanel" aria-labelledby="feedback">
                        <form class="bootbox-form">
                            <div class="row form-group">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div v-for='(nom, index) in nominees' :key="index">
                                        <label class="text-blue text-bold"><b><u> Select/Choose Feedback Provider for {{nom.name}}</u></b></label> 
                                        <span class="pr-1 pl-1" v-for='(feedback, index1) in feedbackTypeList' :key="index1">
                                            <button type="button" class="btn btn-primary btn-flat btn-sm fa-pull-right" @click="showmodel(nom.name,nom.id,feedback.name,feedback.id)"><i class="fa fa-plus"></i> Add  {{feedback.name}}</button>
                                        </span>
                                        <br>
                                        <table id="nomination-list-table" class="table table-sm table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>CID/Passport</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Type</th>
                                                    <th>Staff Type</th>
                                                </tr>
                                            </thead>
                                            <tbody v-for='(user, index) in feedbackProviderList' :key="index">
                                                <tr v-if="user.nominees_id==nom.id">
                                                    <td> {{user.cid}}</td>
                                                    <td> {{user.name}}</td>
                                                    <td> {{user.email}}</td>
                                                    <td> {{feedbackArray[user.feedback_id]}}</td>
                                                    <td> {{user.staff_type}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="feedback-modal" tabindex="-1" role="dialog">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Feedback provider</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="bootbox-body">
                                                <label class="text-blue text-bold">Adding <span id="feedbacktype"></span> feedback provider for <span id="feedbackprovidername"></span> </label> 
                                                <div class="row form-group">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                        <label>Select type:<span class="text-danger">*</span></label> 
                                                        <select class="form-control" @change="showfield()" id="staff_type" v-model="feedback.staff_type" :class="{ 'is-invalid': feedback.errors.has('staff_type') }">
                                                            <option value="">--Select--</option>
                                                            <option value="Internal">Internal</option>
                                                            <option value="External">External</option>
                                                        </select>
                                                        <has-error :form="feedback" field="staff_type"></has-error>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-if="internalstaff">
                                                        <label>CID/Passport/Emp Id:</label> 
                                                        <input type="text" name="emp_deails_forfeedback" id="emp_deails_forfeedback" class="form-control">
                                                        <span class="text-danger" id="emp_deails_forfeedback_err"></span>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pt-4 mt-2" v-if="internalstaff">
                                                        <button type="button" @click="getEmpDetailsForFeedback()" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> Search</button>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                        <label>CID:<span class="text-danger">*</span></label> 
                                                        <input type="text" v-model="feedback.cid" :class="{ 'is-invalid': feedback.errors.has('cid') }" name="cid" id="cid" class="form-control">
                                                        <has-error :form="feedback" field="cid"></has-error>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                        <label>Name:<span class="text-danger">*</span></label> 
                                                        <input type="text" v-model="feedback.name" :class="{ 'is-invalid': feedback.errors.has('name') }" name="name" id="name" class="form-control">
                                                        <has-error :form="feedback" field="name"></has-error>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                        <label>Emial:<span class="text-danger">*</span></label> 
                                                        <input type="text" v-model="feedback.email" :class="{ 'is-invalid': feedback.errors.has('email') }" name="email" id="email" class="form-control">
                                                        <has-error :form="feedback" field="email"></has-error>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button data-bb-handler="cancel" type="button" data-dismiss="modal" class="btn btn-flat btn-danger">Cancel</button>
                                            <button  @click="addFeedbackProvider('nomination')" type="button" class="btn btn-flat btn-primary">Add</button>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('nomination-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-primary" @click="shownexttab('final-tab')"> <i class="fa fa-save"></i>Save & Apply </button>
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
            details:'',
            selectionList:[],
            positionList:[],
            feedbackTypeList:[],
            feedbackArray:{},
            nominees:[],
            feedbackProviderList:[],
            internalstaff:false,
            form: new form({
                id:'',
                selection_type:'',
                position_title:'',
                from_date:'',
                to_date:'',
                details:'',
                nomi_staffList:[],
                action_type:'create'
            }),
            feedback: new form({
                id:'',
                leadership_id:'',
                nominees_id:'',
                feedback_id:'',
                staff_id:'',
                cid:'',
                name:'',
                email:'',
                staff_type:'',
            }),
        }
    },
    methods: {
        getEmpDetails(){
            if($('#emp_deails').val()==""){
                $('#emp_deails_err').html('Please provide this field');
            }
            else{
                $('#emp_deails_err').html('');
                let type="";
                if($('#emp_deails').val().length==11){
                    type="cid";
                }
                else{
                    type="emp_id";
                }
                let uri="loadCommons/viewStaffDetails/"+type+'/'+$('#emp_deails').val();
                axios.get(uri)
                .then((response) => {  
                    let data=response.data.data;
                    $('#emp_deails').val('');
                    $('#nminees_error').html('');
                    if(data==null){
                        Swal.fire({
                            text: "No details are found with this input!",
                            icon: 'error',
                        }); 
                    }
                    else{
                        this.form.nomi_staffList.push({id:'NA',staff_id:data.id, name:data.name, cid:data.cid_work_permit, po_title:data.position_title, org_id:data.working_agency_id,org:data.working_agency, dzo_id:data.dzo_id,dzo:data.dzongkhag})
                    }
                })
                .catch(function (error){
                    console.log(error);
                });
            }
        },
        getEmpDetailsForFeedback(){
            if($('#emp_deails_forfeedback').val()==""){
                $('#emp_deails_forfeedback_err').html('Please provide this field');
            }
            else{
                $('#emp_deails_forfeedback_err').html('');
                let type="";
                if($('#emp_deails_forfeedback').val().length==11){
                    type="cid";
                }
                else{
                    type="emp_id";
                }
                let uri="loadCommons/viewStaffDetails/"+type+'/'+$('#emp_deails_forfeedback').val();
                axios.get(uri)
                .then((response) => {  
                    let data=response.data.data;
                    $('#emp_deails').val('');
                    if(data==null){
                        Swal.fire({
                            text: "No details are found with this input!",
                            icon: 'error',
                        }); 
                    }
                    else{
                        this.feedback.staff_id=data.id;
                        this.feedback.cid=data.cid_work_permit;
                        this.feedback.name=data.name;
                        this.feedback.email=data.email;
                    }
                })
                .catch(function (error){
                    console.log(error);
                });
            }
        },
        showfield(){
            this.internalstaff=false;
            if($('#staff_type').val()=="Internal"){
                this.internalstaff=true;
            }
        },
        shownexttab(nextclass){ 
            if(nextclass=="feedback-tab" && this.validatednomination()){ 
                $('#emp_deails_err').html('');
                this.form.post('/staff/staffLeadershipSerivcesController/createLeadershipSelection')
                .then((response) => {
                    if(response.data.data!=undefined){
                        this.form.id=response.data.data.id;
                        this.loadDraft();
                        this.loadfeedbackProvider();
                        this.change_tab(nextclass);
                    }
                })
                .catch((err) =>{
                    console.log("Error: "+err);
                    this.applyselect2();
                });
            }
            else if(nextclass=="final-tab"){
                Swal.fire({
                    text: "Are you sure you wish to safe and publish this details ?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        this.form.post('/staff/staffLeadershipSerivcesController/publishleadership')
                        .then((response) => {  
                            Swal.fire(
                                'Success!',
                                'Details has been saved successfully.',
                                'success',
                            )
                            this.$router.push('/list_leadership_nomination');
                        })
                        .catch((error) => {  
                            console.log("Error......"+error)
                        });
                    }
                });
            }
            else{
                this.change_tab(nextclass);
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
        validatednomination(){
            let returntype=true;
            if(this.form.nomi_staffList.length<1){
                Swal.fire({
                    text: "Please select Nominees",
                    icon: 'error',
                });
                $('#nminees_error').html('Please select Nominees');
                returntype=false;
            }
            return returntype;
        },
        remove(type,index){ 
            if(type=="nomination"){
                // this.form.nomi_staffList.splice(index,1); 
                this.form.nomi_staffList.pop();
            }
        },
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },
        loadPositionTitleList(uri = 'masters/loadStaffMasters/all_active_position_title'){
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.positionList =  data.data.data;
                for(let i=0;i<data.data.data.length;i++){
                    this.positionarray[data.data.data[i].id] = data.data.data[i].name; 
                }
            })
            .catch(function (error){
                console.log(error);
            });
        },
        showmodel(name,id,feedback,feedback_id){
            this.feedback.nominees_id=id;
            this.feedback.feedback_id=feedback_id;
            $('#feedbacktype').html(feedback);
            $('#feedbackprovidername').html(name);
            $('#feedback-modal').modal('show');
        },
		addFeedbackProvider(){
            this.feedback.post('/staff/staffLeadershipSerivcesController/createNominationForLeadershipSelection')
            .then((response) => {
                this.loadfeedbackProvider();
                $('#feedback-modal').modal('hide');
                this.feedback.nominees_id='';
                this.feedback.feedback_id='';
                this.feedback.staff_id='';
                this.feedback.cid='';
                this.feedback.name='';
                this.feedback.email='';
                this.feedback.staff_type='';
            })
            .catch((err) =>{
                console.log("Error: "+err);
            });
		}, 
        loadDraft(){
            this.form.nomi_staffList=[];
            axios.get('/staff/staffLeadershipSerivcesController/loadLeadershipSelection/draft/NA')
            .then((response) =>{  
                let data=response.data.data;
                this.form.id=data.id;
                this.feedback.leadership_id=data.id;
                this.form.selection_type=data.selection_type;
                $('#selection_type').val(data.selection_type).trigger('change');
                this.form.position_title=data.position_title;
                $('#position_title').val(data.position_title).trigger('change');
                this.form.from_date=data.from_date;
                this.form.to_date=data.to_date;
                this.form.details=data.details;
                this.nominees=data.NominationDetails;
                for(let i=0;i<data.NominationDetails.length;i++){
                    this.form.nomi_staffList.push({
                        id:data.NominationDetails[i].id,
                        staff_id:data.NominationDetails[i].staff_id,
                        name:data.NominationDetails[i].name,
                        cid:data.NominationDetails[i].cid,
                        po_title:data.NominationDetails[i].position_title,
                        org_id:data.NominationDetails[i].org_id,
                        org:data.NominationDetails[i].working_agency,
                        dzo_id:data.NominationDetails[i].dzongkhag_id,
                        dzo:data.NominationDetails[i].dzongkhag,
                    });
                }
            })
            .catch((error) =>{  
                console.log("Error: "+error);
            });
        },
        loadfeedbackProvider(){
            axios.get('/staff/staffLeadershipSerivcesController/loadNominationForLeadershipSelection/'+this.feedback.leadership_id)
            .then((response) =>{  
                let data=response.data.data;
                this.feedbackProviderList=data;
            })
            .catch((error) =>{  
                console.log("Error: "+error);
            });
        },
        changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="selection_type"){
                this.form.selection_type=$('#selection_type').val();
            }
            if(id=="position_title"){
                this.form.position_title=$('#position_title').val();
            }
        },
        getSelectionList(uri = 'questionAnswers/loadQuestionaries/loadServices_Leadership_Service'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.selectionList =  data.data.data;
            })
            .catch(function (error){
                console.log('err: '+error);
            });
        },
        getFeedbackTypeList(uri = 'questionAnswers/loadQuestionaries/loadcategoryType_Leadership_CategoryType'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.feedbackTypeList =  data.data.data;
                for(let i=0;i<data.data.data.length;i++){
                    this.feedbackArray[data.data.data[i].id] = data.data.data[i].name; 
                }
                
            })
            .catch(function (error){
                console.log('err: '+error);
            });
        },
        
        applyselect2(){ 
            if(!$('#selection_type').attr('class').includes('select2-hidden-accessible')){
                $('#selection_type').addClass('select2-hidden-accessible');
            }
            if(!$('#position_title').attr('class').includes('select2-hidden-accessible')){
                $('#position_title').addClass('select2-hidden-accessible');
            }
        }, 

    },
    mounted(){
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').on('select2:select', function (){
            Fire.$emit('changeval',$(this).attr('id'))
        });
        Fire.$on('changeval',(id)=>{
            this.changefunction(id);
        });
        this.getSelectionList();
        this.getFeedbackTypeList();
        this.loadPositionTitleList();
        this.loadDraft();
    },
}
</script>