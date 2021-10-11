<template>
    <div>
        <div class="alert alert-warning alert-dismissible" style="display:none" id="warning">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-exclamation-triangle"></i> Information!</h5>
            <div id="message"></div>
        </div>
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
                <div class="col-sm-4">
                    <div class="form-group">
                        <label> Program</label>
                        <select v-model="student_form.program" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('program') }" class="form-control select2" name="program" id="program">
                        <option v-for="(item, index) in programList" :key="index" v-bind:value="item.programme_id">{{ item.name }}</option>
                    </select>
                    <has-error :form="student_form" field="program"></has-error>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Joining Date:</label>
                        <input class="form-control" v-model="student_form.date" :class="{ 'is-invalid': student_form.errors.has('date') }" id="date" @change="remove_error('date')" type="date">
                        <has-error :form="student_form" field="date"></has-error>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <!-- textarea -->
                    <div class="form-group">
                        <label>Responsibilities:</label>
                        <textarea @change="remove_error('responsibilities')" class="form-control" v-model="student_form.responsibilities" :class="{ 'is-invalid': student_form.errors.has('responsibilities') }" name="responsibilities" id="responsibilities"></textarea>
                    <has-error :form="student_form" field="responsibilities"></has-error>
                    </div>
                </div>
            </div>
            <!-- Need to fix the roles-->
            <!-- <div class="row">
                <div class="col-sm-6">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <label >Roles:</label><br>
                        <span v-for="(item, index) in  roleList" :key="index">
                            <input type="checkbox" :id="'role'+(index)" v-model="student_form.role" :value="item.id"><label class="pr-4"> &nbsp;{{ item.Name }}</label>
                        </span>
                    </div>
                </div>
            </div>-->
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
            is_classTeacher:'1',
            studentList:[],
            roleList:[],
            programList:[],
            roles: [],
            classSection:[],
            id:'2',
            // type:programmem,

            student_form: new form({
                student: '',
                program: '',
                date: '',
                role: [],
                responsibilities:'',
            }),
        }
    },
    methods: {
        getClassTeacher(){
            axios.get('academics/getClassTeacherClasss')
            .then(response =>{
                let data = response.data.data
                this.classSection = data;
                if(data != null && data !=''){
                    this.is_classTeacher='1';
                } else {
                    this.is_classTeacher='0';
                    $('#warning').show();
                    $('#message').html('User is not assigned as Class Teacher. Please assign class teacher to proceed');
                }
            })
        },
        // loadStudentList(uri='students/loadStudentList/' +this.id){
        //     axios.get(uri)
        //     .then(response => {
        //         let data = response;
        //         this.studentList =  data.data.data;
        //     })
        //     .catch(function (error) {
        //         console.log("Error......"+error)
        //     });
        // },
        
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
                        this.student_form.post('/students/saveProgramMembers',this.student_form)
                            .then(() => {
                            Toast.fire({
                                icon: 'success',
                                title: 'Details added successfully'
                            })
                            this.$router.push('/student_programs_members');
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
        
        this.getClassTeacher();
        this.loadActiveProgramList();
        this.loadActiveRolesList();

    },

}
</script>
