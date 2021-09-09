<template>
    <div>
        <form>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Program/Club:<i class="text-danger">*</i></label>
                    <select v-model="student_form.program" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('program') }" class="form-control select2" name="program" id="program">
                        <option v-for="(item, index) in programList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
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
                        <option v-for="(item, index) in supportList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
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
            org_id:'2fea1ad2-824b-434a-a608-614a482e66c1',

            student_form: new form({
                id:'',
                program: '',
                year: '',
                supporter:'',
                remarks:'',
                assigned_staff: [],
                record_type:'edit'
            }),
        }
    },
    methods: {
        //need to get the organisation id and pass it as a parameter
        loadStudentList(uri='students/loadStudentList/'+this.org_id){
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
       
        loadActiveProgramList(uri="masters/loadActiveStudentMasters/program_name"){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.programList =  data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadActiveSupportList(uri="masters/loadActiveStudentMasters/program_support"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.supportList =  data.data.data;
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
        /**
         * method to get program details by id
        */
        getStudentProgramDetails(id){
            axios.get('students/getProgramDetails/'+id)
            .then((response) => {  
             alert(JSON.stringify(response.data.data));
                let data=response.data.data;
                this.student_form.id= data.id;
                this.student_form.name= data.StdStudentId;
                this.student_form.program= data.CeaProgrammeId;
                this.student_form.year = data.EstablishmentYear;
                this.student_form.supporter= data.CeaProgrammeSupporterId;
                this.student_form.remarks= data.Remarks;

                let prop=data.roles;
                let rolesAssigned=[];
                for(let i=0;i<prop.length;i++){
                    rolesAssigned.push({teacher:prop[i].StfStaffId, role:prop[i].CeaRoleId, remarks:prop[i].Remarks});
                }
                this.count=data.length;
                this.student_form.assigned_staff = rolesAssigned;
            })
            .catch((error) =>{  
                console.log("Error:"+error);
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

        this.loadTeacherList();
        this.loadActiveProgramList();
        this.loadActiveSupportList();
        this.loadActiveRolesList();
    },
    created() {
        this.getStudentProgramDetails(this.$route.params.data.id);
    },
}
</script>