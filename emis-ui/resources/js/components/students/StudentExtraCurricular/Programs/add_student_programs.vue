<template>
    <div>
        <form>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Program/Club:<i class="text-danger">*</i></label>
                    <select v-model="student_form.program" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('program') }" class="form-control select2" name="program" id="program">
                        <option v-for="(item, index) in programList" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                    </select>
                    <has-error :form="student_form" field="program"></has-error>
                </div> 
            </div>
            <div class="row form-group">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Year of Establishment:<span class="text-danger">*</span></label> 
                    <input class="form-control" v-model="student_form.year" :class="{ 'is-invalid': student_form.errors.has('year') }" id="year" @change="remove_err('year')" type="number">
                    <has-error :form="student_form" field="year"></has-error>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Supported By:<span class="text-danger">*</span></label> 
                    <select v-model="student_form.supporter" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('supporter') }" class="form-control select2" name="supporter" id="supporter">
                        <option v-for="(item, index) in supportList" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                    </select>
                    <has-error :form="student_form" field="supporter"></has-error>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <label class="mb-0.5">Remarks:</label>
                    <textarea @change="remove_error('remarks')" class="form-control" v-model="student_form.remarks" :class="{ 'is-invalid': student_form.errors.has('remarks') }" name="remarks" id="remarks"></textarea>
                    <has-error :form="student_form" field="remarks"></has-error>
                </div>
            </div>
            <!-- fix this after getting the staff list -->
            <!-- <label>Roles Assigned to Staff </label>
            <div class="card">
                <div class="form-group row">
                    <div class="card-body col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Teacher</th>
                                    <th>Role</th>
                                    <th>Remarks</th>                     
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="record1" v-for='(role, index) in student_form.assigned_staff' :key="index">
                                    <td>
                                        <select name="teacher" id="teacher" class="form-control" v-model="role.teacher" :class="{ 'is-invalid': student_form.errors.has('teacher') }">
                                            <option value="">--- Please Select ---</option>
                                            <option v-for="(item, index) in teacherList" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                                        </select>
                                    </td>
                                    <td>                                
                                        <select name="role" id="role" class="form-control" v-model="role.role" :class="{ 'is-invalid': student_form.errors.has('role') }">
                                            <option value="">--- Please Select ---</option>
                                            <option v-for="(item, index) in teacherRoles" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                                        </select>
                                    </td>
                                    <td>                                
                                        <input type="text" name="remarks" id="remarks" class="form-control" v-model="role.remarks" :class="{ 'is-invalid': student_form.errors.has('remarks') }" @change="remove_err('remarks')"/>
                                        <has-error :student_form="form" field="remarks"></has-error>
                                    </td>
                                </tr> 
                                <tr>
                                    <td colspan="5"> 
                                        <button type="button" class="btn btn-flat btn-sm btn-primary" id="addMore" 
                                        @click="addMore()"><i class="fa fa-plus"></i> Add More</button>
                                        <button type="button" class="btn btn-flat btn-sm btn-danger" id="remove" 
                                        @click="remove()"><i class="fa fa-trash"></i> Remove</button>
                                    </td>
                                </tr>                                          
                            </tbody>
                        </table>
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
            teacherList:[],
            programList:[],
            supportList:[],
            teacherRoles:[],
            assigned_staff: [],
            id:'2fea1ad2-824b-434a-a608-614a482e66c1',

            student_form: new form({
                id:'',
                program: '',
                year: '',
                supporter:'',
                remarks:'',
                assigned_staff: [],
                record_type:'add'
            }),
        }
    },
    methods: {
        //need to get the organisation id and pass it as a parameter
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
        loadTeacherList(uri='students/loadStudentList/'+this.id){
            axios.get(uri)
            .then(response => {
                let data = response;
                console.log(data);
                this.teacherList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadActiveProgramList(uri="masters/loadActiveStudentMasters/CeaProgram"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.programList =  data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadActiveSupportList(uri="masters/loadActiveStudentMasters/CeaProgramSupporter"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.supportList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadActiveRolesList(uri="masters/loadActiveStudentMasters/program_teacher_roles"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.teacherRoles =  data.data.data;
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
            this.student_form.assigned_staff.push({teacher:'',role:'', remarks:''})
        },
        addMoreStudents: function(){
            this.count++;
            this.student_form.assigned_student.push({student:'',std_role:'', remarks:''})   
        }, 
        /**
         * method to remove fields
         */
        remove(index){    
             if(this.student_form.roles.length>1){
                this.count--;
                this.student_form.roles.splice(index,1); 
            }
        },
        removeStudents(index){    
             if(this.student_form.assigned_student.length>1){
                this.count--;
                this.student_form.assigned_student.splice(index,1); 
            }
        },
        formaction: function(type){
            if(type=="reset"){
                this.student_form.student= '';
                this.student_form.remarks='';
                this.student_form.status= 1;
            }
            if(type=="save"){
                this.student_form.post('/students/saveStudentProgram',this.student_form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/student_programs_list');
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		},
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="program"){
                this.student_form.program=$('#program').val();
            }
            if(id=="supporter"){
                this.student_form.supporter=$('#supporter').val();
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

        this.loadTeacherList();
        this.loadActiveProgramList();
        this.loadActiveSupportList();
        this.loadActiveRolesList();
    },
    
}
</script>