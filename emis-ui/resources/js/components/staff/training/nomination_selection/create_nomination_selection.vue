<template>
    <div>
        <div class="card card-success card-outline collapsed-card" id="adv_serach_ection">
            <div class="card-body pb-0 mb-0" style="display:none">
                <div class="callout callout-success">
                    <div class="form-group row"> 
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label class="mb-0">Trainig Type:</label><br>
                            <span class="text-blue text-bold">{{ trainingtypeList[form.training_type]}}</span>
                        </div> 
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label class="mb-0">Course Title:</label><br>
                            <span class="text-blue text-bold">{{form.course_title}}</span>
                        </div> 
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label class="mb-0">Organized By (Department/Division):</label><br>
                            <span class="text-blue text-bold">{{trainingtypeList[form.organizer]}}</span>
                        </div> 
                    </div>
                    <div class="form-group row"> 
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label class="mb-0">Related Programme:</label><br>
                            <span class="text-blue text-bold">{{ relatedProgrammeList[form.related_programme]}}</span>
                        </div> 
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label class="mb-0">Start Date:</label><br>
                            <span class="text-blue text-bold">{{form.start_date}}</span>
                        </div> 
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label class="mb-0">End Date:</label><br>
                            <span class="text-blue text-bold">{{form.end_date}}</span>
                        </div> 
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <table id="dynamic-table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Attachment Name</th>
                                        <th>File(Image,Doc,Excel,Pdf)</th>                           
                                    </tr>
                                </thead>
                                <tbody> 
                                    <tr v-for='(attach,count) in draft_attachments' :key="count+1">
                                        <td> 
                                            {{attach.user_defined_name}}
                                        </td>
                                        <td>    
                                            <a href="#" @click="openfile(attach)" class="fa fa-eye"> View</a>
                                        </td> 
                                    </tr>
                                </tbody>
                            </table> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-header pb-0 pt-2">
                <h3 class="card-title">Program Details</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-plus" ></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="modal fade show" id="add_modal" aria-modal="true" style="padding-right: 17px;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Participant</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="bootbox-form">
                            <div class="form-group row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label>Nominee:<span class="text-danger">*</span></label>
                                     <select class="form-control select2" @change="remove_error('participant'),getdetails()" name="participant" id="participant" v-model="form.participant">
                                        <option value="">- Please Select -</option>
                                        <option v-for="(item, index) in staff_list" :key="index" v-bind:value="item.id+'_'+item.contact_no+'_'+item.email"> {{ item.cid_work_permit }}, {{ item.name }},{{ item.position_title.name }}</option>
                                    </select>
                                    <span class="text-danger" id="participant_err"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Contact Number:<span class="text-danger">*</span></label>
                                    <input type="text" @change="remove_error('contact')" v-model="form.contact" class="form-control" id="contact">
                                    <span class="text-danger" id="contact_err"></span>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Email:<span class="text-danger">*</span></label>
                                    <input type="text" @change="remove_error('email')" v-model="form.email" class="form-control" id="email">
                                    <span class="text-danger" id="email_err"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label>Participating as:<span class="text-danger">*</span></label>
                                    <br>
                                    <span v-for="(nature, index) in nature_of_participantList" :key="index" >
                                        
                                        <input type="radio" @change="remove_error('nature_of_participant')" v-model="form.nature_of_participant" :class="{ 'is-invalid' :form.errors.has('nature_of_participant') }" name="nature_of_participant" id="nature_of_participant" :value="nature"> 
                                        <label class="pr-3"> {{ nature_of_participantListname[nature]  }} </label>
                                    </span><br>
                                    <span class="text-danger" id="nature_of_participant_err"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Attachment:</label>
                                    <input type="file"  v-on:change="onChangeFileUpload" class="form-control" id="file">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer text-right">
                        <button data-bb-handler="cancel" type="button" data-dismiss="modal" class="btn btn-danger">Cancel</button>
                        <button data-bb-handler="confirm" @click="addrecords()" type="button" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-success card-outline">
            <div class="card-header pb-0 pt-2">
                <h3 class="card-title">Nominee Details</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-dark  text-white btn-sm" @click="showadprocess()">
                        <i class="fa fa-user-plus"></i> Add Nomination
                    </button>
                </div>
            </div>
            <div class="card-body pb-0 mb-0">
                <table id="dynamic-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl#</th>
                            <th>CID/Work Permit No</th>   
                            <th>Name</th>   
                            <th>Contact</th> 
                            <th>Email</th>
                            <th>participation</th>
                            <th>Attachments</th> 
                            <th>Action</th>                                 
                        </tr>
                    </thead>
                    <tbody> 
                    </tbody>
                </table> 
            </div>
        </div>
    </div>     
</template>
<script>
export default {
    data(){
        return {
            trainingtypeList:[],
            relatedProgrammeList:[],
            draft_attachments:[],
            nature_of_participantList:[],
            nature_of_participantListname:[],
            staff_list:[],
            form: new form({
                id: '', 
                training_type: '',
                training_type_text:'',
                course_title:'',
                organizer:'',
                related_programme:'',
                start_date:'',
                end_date:'',
                ref_docs:'',

                participant:'',
                contact:'',
                email:'',
                nature_of_participant:'',
            })
        }
    },
    methods: {
        showadprocess(){
            $('#add_modal').modal('show');
        },
        onChangeFileUpload(e){
            this.form.ref_docs.push({attachment:e.target.files[0]});
        },
        openfile(file){ 
            let file_path=file.path+'/'+file.original_name;
            window.location=file_path;
        },
        loadHrDevelopmentMasters(type){
            let url="masters/loadHrDevelopmentMastersData/"+type;
            axios.get(url)
            .then(response => {
                let data = response.data.data;
                if(type=="active_training_type_list"){
                    for(let i=0;i<data.length;i++){
                        this.trainingtypeList[data[i].id] = data[i].name; 
                    }
                }
                if(type=="active_related_programme_list"){
                    for(let i=0;i<data.length;i++){
                        this.relatedProgrammeList[data[i].id] = data[i].name; 
                    }
                }
                if(type=="active_nature_of_participant_list"){
                    for(let i=0;i<data.length;i++){
                        this.nature_of_participantListname[data[i].id] = data[i].name; 
                    }
                }
            })
            .catch(function (error) {
                console.log("Error:"+error);
            });
        },
        
        loadDetails(id,type){
            this.action_param_type=type;
            axios.get('staff/hrdevelopment/loadDetails/'+id)
            .then((response) => {   
                let data=response.data.data;
                this.form.id=data.id;
                this.getParticipantDetails(data.id);
                this.form.training_type=data.training_type;
                $('#training_type').val(data.training_type).trigger('change');
                this.form.course_title=data.course_title;
                this.form.organizer=data.organizer;
                $('#organizer').val(data.organizer).trigger('change');
                this.form.related_programme=data.related_programme;
                $('#related_programme').val(data.related_programme).trigger('change');
                this.form.start_date=data.start_date;
                this.form.end_date=data.end_date;
                this.draft_attachments=JSON.parse(response.data.documents).data;
                this.nature_of_participantList=data.nature_of_participant.split(', ');
            })
            .catch((error) =>{  
                console.log("Error:"+error);
            });
        },
        loadStaffList(){
            axios.get('staff/loadStaff/workingagency')
            .then((response) => {   
                let data=response.data.data;
                this.staff_list=data;
            })
            .catch((error) => {  
                console.log("Error:"+error);
            });
        },
        changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="participant"){ 
                let valu=$('#participant').val();
                this.form.participant=valu.split('_')[0];
                this.form.email=valu.split('_')[2];
                this.form.contact=valu.split('_')[1];
            }
        },
        addrecords(){
            if(this.validateaddform()){
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }
                let formData = new FormData();
                formData.append('programId', this.form.id);
                formData.append('participant', this.form.participant);
                formData.append('contact', this.form.contact);
                formData.append('email', this.form.email);
                formData.append('nature_of_participant', this.form.nature_of_participant);
                formData.append('attachment', this.form.ref_docs);
                axios.post('staff/hrdevelopment/saveParticipant', formData, config)
                .then((response) =>{  
                    this.form.id=response.data.data.id;
                    Toast.fire({
                        icon: 'success',
                        title: 'Data Saved Successfully'
                    });
                    this.getParticipantDetails(this.form.id);
                })
                .catch((error) => { 
                    console.log("Errors:"+error)
                });
            }
        },
        getParticipantDetails(program_id){
            axios.get('staff/loadStaff/workingagency')
            .then((response) => {   
                let data=response.data.data;
                this.staff_list=data;
            })
            .catch((error) =>{  
                console.log("Error:"+error);
            });
        },
        validateaddform(){
            let retval=true;
            if($('#participant').val()==""){
                retval=false;   
            }
            if($('#participant').val()==""){
                $('#participant_err').html('Please select participant');
                $('#participant').focus();
                $('#participant').addClass('is-invalid');
                retval=false;
            }
            if($('#contact').val()==""){
                $('#contact_err').html('mention contact number');
                $('#contact').focus();
                $('#contact').addClass('is-invalid');
                retval=false;
            }
            if($('#email').val()==""){
                $('#email_err').html('mention email');
                $('#email').focus();
                $('#email').addClass('is-invalid');
                retval=false;
            }
            if($("input[type='radio'][name='nature_of_participant']:checked").val()==undefined){
                $('#nature_of_participant_err').html('this field is requred');
                $('#nature_of_participant').addClass('is-invalid');
                retval=false;
            }
            return retval;
        },
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        }, 
    },
    
    mounted() {
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
        this.loadHrDevelopmentMasters('active_training_type_list');
        this.loadHrDevelopmentMasters('active_related_programme_list');
        this.loadHrDevelopmentMasters('active_nature_of_participant_list');
        this.loadDetails(this.$route.params.data,this.$route.params.type);
        this.loadStaffList();
    },
}
</script>