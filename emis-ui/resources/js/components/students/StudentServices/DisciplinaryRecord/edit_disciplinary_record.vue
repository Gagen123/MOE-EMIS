<template>
    <div>
        <form>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Class & Section:<i class="text-danger">*</i></label>
                    <select v-model="student_form.class_section" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('class_section') }" class="form-control select2" name="class_section" id="class_section" >
                        <option v-for="(item, index) in classSection" :key="index" v-bind:value="[item.org_class_stream_id, item.org_stream_id, item.org_section_id]">{{ item.class_stream_section}}</option>
                    </select>
                    <has-error :form="student_form" field="class_section"></has-error>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="mb-0.5">Student:<i class="text-danger">*</i></label>
                    <select v-model="student_form.student" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('student') }" class="form-control select2" name="student" id="student">
                        <option v-for="(item, index) in studentList" :key="index" v-bind:value="item.id">{{ item.Name }} ({{item.student_code}})</option>
                    </select>
                    <has-error :form="student_form" field="student"></has-error>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Date of Offence:</label>
                        <input type="date" @change="remove_error('date')" class="form-control" v-model="student_form.date" :class="{ 'is-invalid': student_form.errors.has('date') }" name="date" id="date">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <!-- select -->
                    <div class="form-group">
                        <label class="mb-0.5">Offence Type:<i class="text-danger">*</i></label>
                        <select v-model="student_form.offence_type" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('offence_type') }" class="form-control select2" name="offence_type" id="offence_type">
                            <option v-for="(item, index) in offenceTypeList" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                        </select>
                        <has-error :form="student_form" field="offence_type"></has-error>
                    </div>
                </div>
                <div class="col-sm-6">
                    <!-- select -->
                    <div class="form-group">
                        <label class="mb-0.5">Severity:<i class="text-danger">*</i></label>
                        <select v-model="student_form.severity" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('severity') }" class="form-control select2" name="severity" id="severity">
                            <option v-for="(item, index) in severityList" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                        </select>
                        <has-error :form="student_form" field="severity"></has-error>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="mb-0.5">Description of Offence:</label>
                        <textarea @change="remove_error('offence_description')" class="form-control" v-model="student_form.offence_description" :class="{ 'is-invalid': student_form.errors.has('offence_description') }" name="offence_description" id="offence_description"></textarea>
                        <has-error :form="student_form" field="offence_description"></has-error>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <!-- select -->
                    <div class="form-group">
                        <label class="mb-0.5">Action Taken:<i class="text-danger">*</i></label>
                        <select v-model="student_form.action_taken" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('action_taken') }" class="form-control select2" name="action_taken" id="action_taken">
                            <option v-for="(item, index) in actionTakenList" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                        </select>
                        <has-error :form="student_form" field="action_taken"></has-error>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="mb-0.5">Description of Action Taken:</label>
                        <textarea @change="remove_error('remarks')" class="form-control" v-model="student_form.remarks" :class="{ 'is-invalid': student_form.errors.has('remarks') }" name="remarks" id="remarks"></textarea>
                        <has-error :form="student_form" field="remarks"></has-error>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="button" @click="formaction('reset')" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-redo"></i> Reset</button>
                    <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Update</button>
            </div>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    data(){
        return {
            studentList:[],
            classSection:[],
            offenceTypeList:[],
            actionTakenList:[],
            severityList:[],
            classId:'',
            streamId:'',
            sectionId:'',
            OrgClassStreamId:'',
            id:'2fea1ad2-824b-434a-a608-614a482e66c1',

            student_form: new form({
                id:'',
                class_section:'',
                student: '',
                offence_type: '',
                date: '',
                action_taken: '',
                severity: '',
                offence_description:'',
                remarks:'',
                action_type:'edit'
            }),
        }
    },
    methods: {
        //need to get the organisation id and pass it as a parameter
        getClassTeacher(){
            axios.get('academics/getClassTeacherClasss')
            .then(response =>{
                let data = response.data.data
                this.classSection = data;
                data.forEach((item)=>{
                    this.classId = item.org_class_id
                    if(item.org_stream_id != null){
                        this.streamId = item.org_stream_id;
                    }else if(item.org_section_id != null){
                        this.sectionId = item.org_section_id;
                    }else{
                        this.classId = item.org_class_id
                    }
                    this.OrgClassStreamId = item.org_class_stream_id;
                    this.orgId = item.org_id;
                    // this.getStudentBasedOnTeacherClassSect();
                })
            })
        },
        loadStudentList(uri='students/loadStudentList/'+this.id){
            axios.get(uri)
            .then(response => {
                let data = response;
                console.log(data);
                this.studentList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadActiveOffenceTypeList(uri="masters/loadActiveStudentMasters/OffenceType"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.offenceTypeList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadActiveActionTakenList(uri="masters/loadActiveStudentMasters/DisciplinaryActionTaken"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.actionTakenList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadActiveSeverityList(uri="masters/loadActiveStudentMasters/OffenceSeverity"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.severityList =  data.data.data;
            })
            .catch(function (error) { 
                console.log("Error......"+error)
            });
        },
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },
        formaction: function(type){
            if(type=="reset"){
                this.student_form.student= '';
                this.student_form.remarks='';
                this.student_form.status= 1;
            }
            if(type=="save"){
                Swal.fire({
                    title: 'Are you sure you wish to submit this form ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    }).then((result) =>{
                    if (result.isConfirmed){
                        this.student_form.post('/students/addStudentRecord',this.student_form)
                        .then((response) =>{
                            Toast.fire({
                            icon: 'success',
                            title: 'Details added successfully'
                        })
                        this.$router.push('/disciplinary_record_list');
                        })
                        .catch((error) => {
                            Toast.fire({
                                icon: 'error',
                                title: 'Unexpected error occured. Try again.'
                            });
                            console.log("Error:"+error);
                        })
                    }
                })
            }
		},
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="student"){
                this.student_form.student=$('#student').val();
            }
            if(id=="offence_type"){
                this.student_form.offence_type=$('#offence_type').val();
            }
            if(id=="action_taken"){
                this.student_form.action_taken=$('#action_taken').val();
            }
            if(id=="severity"){
                this.student_form.severity=$('#severity').val();
            }
            if(id=="class_section"){
               this.studentList = [];
               var classVals = $('#class_section').val().split(',');
               let class_id = classVals[0];
               let stream_id = classVals[1];
               let section_id = classVals[2];
               let route = class_id+'__'+stream_id+'__'+section_id;
               if(stream_id == ''){
                   route = class_id+'__'+"NULL"+'__'+section_id;
               }
               axios.get('/students/loadStudentBySection/'+route)
                    .then((response) => {
                        this.studentList = response.data;  
                })
                .catch(() => {
                    consoele.log("Error:"+e)
                });
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

        this.loadStudentList();
        this.getClassTeacher();
        this.loadActiveOffenceTypeList();
        this.loadActiveActionTakenList();
        this.loadActiveSeverityList();
    },
    created() {
        this.loadStudentList();  
        this.student_form.id=this.$route.params.data.Id;
        this.student_form.student=this.$route.params.data.Name;
        this.student_form.student=this.$route.params.data.StdStudentId;
        this.student_form.offence_type=this.$route.params.data.StdDisciplinaryOffenceTypeId;
        this.student_form.date=this.$route.params.data.OffenceDate;
        this.student_form.action_taken=this.$route.params.data.StdDisciplinaryActionTypeId;
        this.student_form.severity=this.$route.params.data.StdDisciplinarySeverityId;
        this.student_form.offence_description=this.$route.params.data.OffenceDescription;
        this.student_form.remarks=this.$route.params.data.ActionDescription;
       
    },
}
</script>