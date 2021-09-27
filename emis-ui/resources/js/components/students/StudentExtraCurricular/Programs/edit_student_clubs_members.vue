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
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Student:<i class="text-danger">*</i></label>
                    <select v-model="student_form.student" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('student') }" class="form-control select2" name="student" id="student">
                        <option v-for="(item, index) in studentList" :key="index" v-bind:value="item.id">{{ item.Name }} ({{item.student_code}})</option>
                    </select>
                    <has-error :form="student_form" field="student"></has-error>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="form-group">
                        <label> Club</label>
                        <select v-model="student_form.club" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('club') }" class="form-control select2" name="club" id="club">
                        <option v-for="(item, index) in clubList" :key="index" v-bind:value="item.programme_id">{{ item.name }}</option>
                    </select>
                    <has-error :form="student_form" field="club"></has-error>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Joining Date:<i class="text-danger">*</i></label>
                    <input class="form-control" v-model="student_form.date" :class="{ 'is-invalid': student_form.errors.has('date') }" id="date" @change="remove_err('date')" type="date">
                    <has-error :form="student_form" field="date"></has-error>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Status:<i class="text-danger">*</i></label><br>
                        <label><input  type="radio" v-model="student_form.status" value="1" /> Active</label>
                        <label><input  type="radio" v-model="student_form.status" value="0"/> InActive</label>
                    <has-error :form="student_form" field="status"></has-error>
                </div>
               
            </div>
            <!-- <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Responsibilities:</label>
                        <textarea @change="remove_error('responsibilities')" class="form-control" v-model="student_form.responsibilities" :class="{ 'is-invalid': student_form.errors.has('responsibilities') }" name="responsibilities" id="responsibilities"></textarea>
                    <has-error :form="student_form" field="responsibilities"></has-error>
                    </div>
                </div>
            </div> -->
            <!-- Need to fix this later -->
            <!-- <div class="row">
                <div class="col-sm-6">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <label >Roles:</label><br>
                        <span v-for="(item, index) in  roleList" :key="index">
                            <input type="checkbox" :id="'role'+(index)" v-model="student_form.role" :value="item.id"><label class="pr-4"> &nbsp;{{ item.name }}</label>
                        </span>
                        <label  v-for="(item, key, index) in  roleList" :key="index" class="pr-4">
                            <input  type="checkbox" v-model="form.role" :value="item.id" tabindex=""/> 
                            {{item.Name}}
                        </label>
                    </div>
                </div>
            </div> -->
          
            <div class="card-footer text-right">
                <button type="button" @click="formaction('reset')" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-redo"></i> Reset</button>
                <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    data(){
        return {
            studentList:[],
            roleList:[],
            programList:[],
            clubList:[],
            roles: [],
            classSection:[],
            classId:'',
            streamId:'',
            sectionId:'',
            OrgClassStreamId:'',
            id:'2',

            student_form: new form({
                student: '',
                club: '',
                role: [],
                date: '',
                status:'1',
                responsibilities:'',
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
        loadActiveClubList(uri='students/listStudentClubs/'+this.id){
            axios.get(uri)
            .then(response => {
                let data = response;
                // alert(JSON.stringify(response.data));
                this.clubList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadActiveProgramList(uri='students/listStudentPrograms/'+this.id){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.programList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadActiveRolesList(uri="masters/loadActiveStudentMasters/program_student_roles"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.roleList =  data.data.data;
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
        /**
         * method to add more fields
         */
        addMore: function(){
            this.count++;
            this.student_form.users.push({teacher:'',role:''})    
        }, 
        /**
         * method to remove fields
         */
        remove(index){    
             if(this.student_form.users.length>1){
                this.count--;
                this.student_form.users.splice(index,1); 
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
                        this.student_form.post('/students/saveClubMembers',this.student_form)
                            .then((response) => {
                                let data=response.data.data;
                                if(data!="" && data=="exist"){
                                    Toast.fire({
                                        icon: 'error',
                                        title: 'Tihs stuent is already registered in the club'
                                    });
                                }
                                else{
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Details has been saved successfully '
                                    });
                                }
                        
                            this.$router.push('/student_clubs_members_list');
                        })
                        .catch(() => {
                            console.log("Error......")
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
            if(id=="program"){
                this.student_form.program=$('#program').val();
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

        this.student_form.student=this.$route.params.data.StdStudentId;
        $('#student').val(this.$route.params.data.StdStudentId).trigger('change');

        this.loadActiveClubList();
        this.loadActiveRolesList();
        this.getClassTeacher();
    },
    created() {
        this.loadStudentList();
        
        this.student_form.name=this.$route.params.data.StdStudentId;
        this.student_form.program=this.$route.params.data.CeaSchoolProgrammeId;
        this.student_form.club=this.$route.params.data.CeaProgrammeId;
        this.student_form.date=this.$route.params.data.JoiningDate;
        this.student_form.responsibilities=this.$route.params.data.Responsibility;
        this.student_form.id=this.$route.params.data.id;
    },
}
</script>