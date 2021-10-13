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
                                <span class="text-blue text-bold">{{ trainingtypeList[form.training_type]}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Course Title:</label><br>
                                <span class="text-blue text-bold">{{form.course_title}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Organized By (Department/Division):</label><br>
                                <span class="text-blue text-bold">{{organizerList[form.organizer]}}</span>
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
            <div class="card card-success card-outline">
                <div class="card-header pb-0 pt-2">
                    <h3 class="card-title">Nominee Details</h3>
                </div>
                <div class="card-body pb-0 mb-0">
                    <table id="dynamic-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>CID/Work Permit No</th>
                                <th>Dzongkhag</th>
                                <th>Working Agency</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>participation</th>
                                <th>Attachments</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in participant_list" :key="index">
                                <td>{{ item.staff_details.cid_work_permit}}</td>
                                <td>{{ dzongkhagArray[item.staff_details.dzongkhagId]}}</td>
                                <td>{{ item.staff_details.working_agency_name}}</td>
                                <td>{{ item.staff_details.name}}</td>
                                <td>{{ item.contact}}</td>
                                <td>{{ item.email }}</td>
                                <td>{{ nature_of_participantListname[item.nature_of_participant]}}</td>
                                <td>
                                    <span v-for="(doc, index) in item.document" :key="index">
                                        <a href="#" @click="openfile(doc)"> {{ doc.original_name.split('_')[1]}}</a>
                                    </span>
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
                </div>
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
            participant_list:[],
            editdocument:[],
            dzongkhagList:[],
            department_list:[],
            school_list:[],
            organizerList:[],
            dzongkhagArray:{},
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
        openfile(file){
            let file_path=file.path+'/'+file.original_name;
            file_path=file_path.replaceAll('/', 'SSS');
            let uri = 'common/viewFiles/'+file_path;
            window.location=uri;
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

        loadDetails(id,statusId){
            this.form.statusId=statusId;
            this.form.programId=id;
            axios.get('staff/hrdevelopment/loadDetails/'+id)
            .then((response) => {
                let data=response.data.data;
                let from = new Date(data.nomination_start_date);
                let to   = new Date(data.nomination_end_date);
                let currentfulldate = new Date();
                let check = new Date(currentfulldate.getFullYear(),(currentfulldate.getMonth() + 1), currentfulldate.getDate());
                if(check < from){
                    $('#err_message').html('The nomination date is not yet approached');
                    $('#error_section').show();
                    $('#maindiv').hide();
                }
                // else if(check > to){
                //     $('#err_message').html('Sorry! Nomination date is over');
                //     $('#error_section').show();
                //     $('#maindiv').hide();
                // }
                else{
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
                    // if(data.nature_of_participant.includes(', ')){
                    //    this.nature_of_participantList=data.nature_of_participant.split(', ');
                    // }
                    // else{
                    //     this.nature_of_participantList.add(data.nature_of_participant);
                    // }
                }
            })
            .catch((error) =>{
                console.log("Error:"+error);
            });
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
        loadactivedzongkhagList(uri="masters/loadGlobalMasters/all_active_dzongkhag"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dzongkhagList =  data.data.data;
                for(let i=0;i<data.data.data.length;i++){
                    this.dzongkhagArray[data.data.data[i].id] = data.data.data[i].name;
                }
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
              //  this.organizerList = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
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
        this.loadactivedzongkhagList();
        this.loadHrDevelopmentMasters('active_training_type_list');
        this.loadHrDevelopmentMasters('active_related_programme_list');
        this.loadHrDevelopmentMasters('active_nature_of_participant_list');
        this.loadorganizerList();
        this.loadDetails(this.$route.params.data,this.$route.params.statusId);
    },
}
</script>
