<template>
    <div>
        <div class="card card-danger card-outline" id="error_section" style="display:none">
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
        <div id="maindiv">
            <div class="card card-success card-outline collapsed-card" id="adv_serach_ection">
                <div class="card-body pb-0 mb-0" style="display:none">
                    <div class="callout callout-success">
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Trainig Type:</label><br>
                                <span class="text-blue text-bold">{{ trainingDetails.trainingtype }}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Course Title:</label><br>
                                <span class="text-blue text-bold">{{trainingDetails.course_title}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Vanue:</label><br>
                                <span class="text-blue text-bold">{{trainingDetails.vanue}}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Related Programme:</label><br>
                                <span class="text-blue text-bold">{{ trainingDetails.related}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Start Date:</label><br>
                                <span class="text-blue text-bold">{{reverseDate1(trainingDetails.start_date)}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">End Date:</label><br>
                                <span class="text-blue text-bold">{{reverseDate1(trainingDetails.end_date)}}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Programme Type:</label><br>
                                <span class="text-blue text-bold">{{ trainingDetails.programme_type }}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Programme Level:</label><br>
                                <span class="text-blue text-bold">{{trainingDetails.programme_level}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Total Hrs:</label><br>
                                <span class="text-blue text-bold">{{trainingDetails.total_hrs}}</span>
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
                                        <tr v-for='(attach,count) in trainingDetails.attachments' :key="count+1">
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
                            <h4 class="modal-title">Add/Edit Participant</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="bootbox-form">
                                <div class="form-group row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label>Participating From:<span class="text-danger">*</span></label>
                                        <input type="radio" v-model="form.partifipant_from" @change="showSearch('Ministry')" :class="{ 'is-invalid' :form.errors.has('partifipant_from') }" name="partifipant_from" id="partifipant_from0" :value="'Ministry'">
                                        <label class="pr-3"> Ministry </label>
                                        <input type="radio" v-model="form.partifipant_from" @change="showSearch('Dzongkhag')" :class="{ 'is-invalid' :form.errors.has('partifipant_from') }" name="partifipant_from" id="partifipant_from1" :value="'Dzongkhag'">
                                        <label class="pr-3"> Dzongkhag Head Quarters </label>
                                        <input type="radio" v-model="form.partifipant_from" @change="showSearch('School')" :class="{ 'is-invalid' :form.errors.has('partifipant_from') }" name="partifipant_from" id="partifipant_from2" :value="'School'">
                                        <label class="pr-3"> Schools </label>
                                        <input type="radio" v-model="form.partifipant_from" @change="showSearch('upload')" :class="{ 'is-invalid' :form.errors.has('partifipant_from') }" name="partifipant_from" id="partifipant_from2" :value="'Excel'">
                                         <label class="pr-3"> Excel Upload </label>
                                        <span class="text-danger" id="partifipant_from_err"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="dzongkhag_section" style="display:none">
                                        <label>Dzongkhag:<span class="text-danger">*</span></label>
                                        <select class="form-control select2" v-model="form.dzongkhag" @change="remove_error('dzongkhag')" name="dzongkhag" id="dzongkhag">
                                            <option value="">- Please Select -</option>
                                            <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                        </select>
                                        <span class="text-danger" id="dzongkhag_err"></span>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="department_section" style="display:none">
                                        <label>Department:<span class="text-danger">*</span></label>
                                        <select class="form-control select2" v-model="form.department" @change="remove_error('department')" name="department" id="department">
                                            <option value="">- Please Select -</option>
                                            <option v-for="(item, index) in department_list" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                        </select>
                                        <span class="text-danger" id="department_err"></span>
                                    </div>
                                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="school_section" style="display:none">
                                        <label>Organization/Division:<span class="text-danger">*</span></label>
                                        <select class="form-control select2" v-model="form.school" @change="remove_error('school')" name="school" id="school">
                                            <option value="">- Please Select -</option>
                                            <option v-for="(item, index) in school_list" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                        </select>
                                        <span class="text-danger" id="school_err"></span>
                                    </div>
                                </div>
                                <span id="participantSection">
                                    <div class="form-group row" id="">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label>Participant:<span class="text-danger">*</span></label>
                                            <select class="form-control select2" @change="remove_error('participant'),populateDetails()" name="participant" id="participant" v-model="form.participant">
                                                <option value="">- Please Select -</option>
                                                <option v-for="(item, index) in staff_list" :key="index" v-bind:value="item.id+'_'+item.contact_no+'_'+item.email"> {{ item.emp_id }}: {{ item.name }},{{ item.position_title_name }}, {{ item.positionlevel }}</option>
                                            </select>
                                            <span class="text-danger" id="participant_err"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <label>Contact Number:<span class="text-danger">*</span></label>
                                            <input type="text" readonly @change="remove_error('contact')" v-model="form.contact" class="form-control" id="contact">
                                            <span class="text-danger" id="contact_err"></span>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <label>Email:<span class="text-danger">*</span></label>
                                            <input type="text" readonly @change="remove_error('email')" v-model="form.email" class="form-control" id="email">
                                            <span class="text-danger" id="email_err"></span>
                                        </div>
                                    </div>
                                </span>

                                <div class="form-group row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label>Participating as:<span class="text-danger">*</span></label>
                                        <br>
                                        <span v-for="(nature, index) in trainingDetails.nparticipatefortransaction" :key="index" >
                                            <input type="radio" @change="remove_error('nature_of_participant')" v-model="form.nature_of_participant" :class="{ 'is-invalid' :form.errors.has('nature_of_participant') }" name="nature_of_participant" id="nature_of_participant" :value="nature">
                                            <label class="pr-3"> {{ nature.name  }} </label>
                                        </span><br>
                                        <span class="text-danger" id="nature_of_participant_err"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Attachment:</label>
                                        <input type="file"  v-on:change="onChangeFileUpload" class="form-control" id="file">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <span v-for="(doc, index) in editdocument" :key="index" :id="'attachment'+index">
                                            <a href="#" @click="openfile(doc)"> {{ doc.original_name.split('_')[1]}}</a>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <a href="#" @click="deletefile(doc,index)" class="fa fa-times text-danger"> Delete </a><br>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer text-right">
                            <button data-bb-handler="cancel" type="button" data-dismiss="modal" class="btn btn-danger">Cancel</button>
                            <button data-bb-handler="confirm" @click="addrecords()" type="button" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-success card-outline">
                <div class="card-header pb-0 pt-2">
                    <h3 class="card-title">Participant Detail</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-dark  text-white btn-sm" @click="showadprocess()">
                            <i class="fa fa-user-plus"></i> Add Participant
                        </button>
                    </div>
                </div>
                <div class="card-body pb-0 mb-0 overflow-auto">
                    <table id="dynamic-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sl#</th>
                                <th>Name</th>
                                <th>EID</th>
                                <th>Position Title</th>
                                <th>Position Level</th>
                                <th>Working Address</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>participation</th>
                                <th>Attachments</th>
                                <th class="pl-5 pr-5"> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in participant_list" :key="index">
                                <td>{{ index+1}}</td>
                                <td>{{ item.staff_name}}</td>
                                <td>{{ item.emp_id}}</td>
                                <td>{{ item.position_title_name}}</td>
                                <td>{{ item.positionlevel}}</td>
                                <td>{{ item.working_agency_name}}</td>
                                <td>{{ item.contact}}</td>
                                <td>{{ item.email }}</td>
                                <td>{{ item.participacingas}}</td>
                                <td>
                                    <span v-for="(doc, index) in item.document" :key="index">
                                        <a href="#" @click="openfile(doc)"> {{ doc.original_name.split('_')[1]}}</a>
                                    </span>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-info btn-sm btn-flat pl-2 pr-2 text-white" @click="loadeditpage(item,'edit')">Edit</a>
                                    <a href="#" class="btn btn-danger btn-sm btn-flat text-white" @click="loadeditpage(item,'delete')">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label class="mb-0.5">Remarks:</label>
                            <textarea v-model="form.remarks" :class="{ 'is-invalid' :form.errors.has('remarks') }" class="form-control" name="remarks" id="remarks"></textarea>
                            <has-error :form="form" field="remarks"></has-error>
                        </div>
                    </div>
                    <hr>
                    <div class="row form-group fa-pull-right">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" @click="submitforapproval()"> <i class="fa fa-save"></i>Update</button>
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
            trainingDetails:[],
            draft_attachments:[],
            nature_of_participantList:[],
            nature_of_participantListname:[],
            staff_list:[],
            participant_list:[],
            editdocument:[],
            dzongkhagList:[],
            department_list:[],
            organizerList:[],
            school_list:[],
            form: new form({
                id: '',
                programId:'',
                training_type: '',
                training_type_text:'',
                course_title:'',
                organizer:'',
                related_programme:'',
                start_date:'',
                end_date:'',
                ref_docs:[],

                participant:'',
                contact:'',
                email:'',
                nature_of_participant:'',
                action_type:'add',
                remarks:'',
                statusId:''
            })
        }
    },
    methods: {
        populateDetails(){
            let part=$('#participant').val();
            if(part.includes("_")){
                formData.append('participant', );
                $('#contact').val(part.split('_')[1]);
                $('#email').val(part.split('_')[2]);
            }
        },
        showadprocess(){
            this.form.id='';
            this.form.participant='';
            this.form.contact='';
            this.form.email='';
            this.editdocument='';
            this.form.action_type='add';
            this.form.nature_of_participant='';
            $('#add_modal').modal('show');
        },
        onChangeFileUpload(e){
            if(e.target.files[0]!=undefined){
                this.form.ref_docs.push({attachment:e.target.files[0]});
            }
            else{
                this.form.ref_docs.pop();
            }
        },

        openfile(file){
            let file_path=file.path+'/'+file.original_name;
            file_path=file_path.replaceAll('/', 'SSS');
            let uri = 'common/viewFiles/'+file_path;
            window.location=uri;
        },
        // loadHrDevelopmentMasters(type){
        //     let url="masters/loadHrDevelopmentMastersData/"+type;
        //     axios.get(url)
        //     .then(response => {
        //         let data = response.data.data;
        //         if(type=="active_training_type_list"){
        //             for(let i=0;i<data.length;i++){
        //                 this.trainingtypeList[data[i].id] = data[i].name;
        //             }
        //         }
        //         if(type=="active_related_programme_list"){
        //             for(let i=0;i<data.length;i++){
        //                 this.relatedProgrammeList[data[i].id] = data[i].name;
        //             }
        //         }
        //         if(type=="active_nature_of_participant_list"){
        //             for(let i=0;i<data.length;i++){
        //                 this.nature_of_participantListname[data[i].id] = data[i].name;
        //             }
        //         }
        //     })
        //     .catch(function (error) {
        //         console.log("Error:"+error);
        //     });
        // },
        deletefile(file,count){
            Swal.fire({
                text: "Are you sure you wish to DELETE this selected file ?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
                }).then((result) => {
                if (result.isConfirmed) {
                    let file_path=file.path+'/'+file.original_name;
                    file_path=file_path.replaceAll('/', 'SSS');
                    let uri = 'common/deleteFile/'+file_path+'/'+file.id;
                    axios.get(uri)
                    .then(response => {
                        let data = response;
                        if(data.data){
                            Swal.fire(
                                'Success!',
                                'File has been deleted successfully.',
                                'success',
                            );
                            $('#attachment').remove();
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
        async showSearch(type){
            $('#dzongkhag_section').hide();
            $('#school_section').hide();
            $('#department_section').hide();
            $('#participantSection').show();
            if(type=="School"){
                $('#dzongkhag_section').show();
                $('#school_section').show();
            }
            if(type=="Dzongkhag"){
                 this.department_list=await this.getDepartmentListbydzo('DzongkhagHeadquarter','All');
                // this.getDzongkhagHeadQuarterList('all_dzongkhag_headquarters');
                $('#department_section').show();
            }
            if(type=="Ministry"){
                this.department_list=await this.getDepartmentListbydzo('Ministry',14);
                // this.getDzongkhagHeadQuarterList('all_ministry_headquarters');
                $('#department_section').show();
            }
            if(type=="upload"){
                $('#participantSection').hide();
            }

        },
        loadeditpage(item,type){
            let pro_id=item.program_id;
            if(type=="delete"){
                Swal.fire({
                    text: "Are you sure you wish to DELETE selected details ?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        let uri = 'staff/hrdevelopment/deleteParticipant/'+item.id;
                        axios.get(uri)
                        .then(response => {
                            let data = response;
                            if(data.data){
                                Swal.fire(
                                    'Success!',
                                    'Record has been deleted successfully.',
                                    'success',
                                );
                                this.getParticipantDetails(pro_id);
                            }
                            else{
                                Swal.fire(
                                    'error!',
                                    'Not able to delete this record. Please contact system adminstrator.',
                                    'error',
                                );
                            }

                        })
                        .catch(function (error) {
                            console.log("Error:"+error);
                        });
                    }
                });
            }
            else{
                this.form.id=item.id;
                this.form.participant=item.participant_id+'_'+item.contact+'_'+item.email;
                $('#participant').append('<option value="'+item.participant_id+'_'+item.contact+'_'+item.email+'">'+item.staff_details.name+'</option>');
                $('#participant').val(item.participant_id+'_'+item.contact+'_'+item.email).trigger('change');
                this.form.contact=item.contact;
                this.form.email=item.email;
                this.editdocument=item.document;
                this.form.action_type='edit';
                this.form.nature_of_participant=item.nature_of_participant;
                $('#add_modal').modal('show');
            }
        },

        async changefunction(id){
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
            if(id=="dzongkhag"){
                this.school_list=[];
                this.form.dzongkhag=$('#dzongkhag').val();
                this.school_list=await this.schoolList($('#dzongkhag').val());
                // this.getSchoolList($('#dzongkhag').val());
            }
            if(id=="department"){
                this.school_list=[];
                this.form.department=$('#department').val();
                if($('#department').val()!=""){
                    this.school_list=await this.getdivisionList($('#department').val());
                    $('#school_section').show();
                }
            }
            if(id=="school"){
                this.staff_list=[];
                this.form.school=$('#school').val();
                this.staff_list=await this.staffOrgwise($('#school').val());
                // this.loadStaffList($('#school').val());
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
                if(this.form.participant.includes("_")){
                    formData.append('participant', this.form.participant.split('_')[0]);
                }
                else{
                     formData.append('participant', this.form.participant);
                }
                formData.append('programId', this.form.programId);
                formData.append('contact', this.form.contact);
                formData.append('email', this.form.email);
                formData.append('action_type', this.form.action_type);
                formData.append('id', this.form.id);
                formData.append('nature_of_participant', this.form.nature_of_participant);
                for(let i=0;i<this.form.ref_docs.length;i++){
                    formData.append('attachments[]', this.form.ref_docs[i].attachment);
                }
                axios.post('staff/hrdevelopment/saveParticipant', formData, config)
                .then((response) =>{
                    this.form.id=response.data.data.id;
                    Toast.fire({
                        icon: 'success',
                        title: 'Data Saved Successfully'
                    });
                    this.getParticipantDetails(this.form.programId);
                    this.form.participant='';
                    this.form.contact='';
                    this.form.email='';
                    this.form.nature_of_participant='';
                    $('#file').val('');
                    $('#add_modal').modal('hide');
                })
                .catch((error) => {
                    console.log("Errors:"+error)
                });
            }
        },
        getParticipantDetails(program_id){
            axios.get('staff/hrdevelopment/getParticipantDetails/nomination/'+program_id)
            .then((response) => {
                let data=response.data.data;
                this.participant_list=data;
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

        submitforapproval(){
            Swal.fire({
                text: "Are you sure you wish to update this details ? You cannot update them once you accept",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
                }).then((result) => {
                if (result.isConfirmed) {
                    this.form.post('/staff/hrdevelopment/submitParticipants')
                    .then((response) => {
                        if(response!=null && response!=""){
                            let message='Participants for the training programmee has added and updated. <br><b>Thank You !</b>';
                            this.$router.push({name:'acknowledgement_for_nomination_success',params: {data:message}});
                            Swal.fire(
                                'Success!',
                                'Nomination details has beed submitted',
                                'success',
                            )
                        }
                    })
                    .catch((error) => {
                        console.log("Error:"+error)
                    });
                }
            });
        },
        getDzongkhagHeadQuarterList(type){
            axios.get('loadCommons/loadHeaquarterList/'+type+'/NA')
            .then((response) => {
                let data=response.data.data;
                this.department_list=data;
            })
            .catch((error) =>{
                console.log("Error in retrieving headquarters:"+error);
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
        loadorganizerList(uri = 'organization/getsAgencyList/allSSS'){
            axios.get(uri)
            .then(response =>{
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.organizerList[data[i].id] = data[i].agencyName;
                }
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
    },

    async mounted() {
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
        this.loadactivedzongkhagList();
        // this.loadHrDevelopmentMasters('active_training_type_list');
        // this.loadHrDevelopmentMasters('active_related_programme_list');
        // this.loadHrDevelopmentMasters('active_nature_of_participant_list');
        this.loadorganizerList();

        this.form.statusId=this.$route.params.statusId;
        this.form.programId=this.$route.params.data;
        axios.get('staff/hrdevelopment/loadDetails/'+this.$route.params.data)
        .then((response) => {
            let data=response.data.data;
            this.trainingDetails=data
            this.getParticipantDetails(data.id);
        })
        .catch((error) =>{
            console.log("Error:"+error);
        });
    },
}
</script>
