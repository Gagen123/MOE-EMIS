<template>
   <div>
        <form @submit.prevent="save" class="bootbox-form">
            <div class="ml-0 row form-inline">
                <div class="mr-3">
                    <strong>Class: </strong> {{ class_stream_section }} 
                </div>
                <div>
                    <strong>Date:</strong>
                    <input v-model="attendance_date" type="date" class="form-control form-control-sm" id="dateInput">
                </div>
            </div>  
            <div v-if="studentList.length" class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table id="student-attendance-table" class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Student Code</th>
                                <th>Name</th>
                                <th>Present</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr v-for="(item, index) in studentList" :key="index">
                                <td>{{ item.CidNo }}</td>
                                <td>
                                    <input v-model='studentList[index].std_student_id' type="hidden">
                                    {{ item.Name }}
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input  v-model="item.is_present" class="form-check-input" type="checkbox" id="present">
                                    </div>
                                </td>                                                                             
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-right">
                <button v-if="studentList.length" type="reset" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-redo"></i> Reset</button>
                <button v-if="studentList.length" type="submit" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>        
        </form>
    </div>     
</template>

<script>
export default {
    data(){
        return {
            studentList:[],
            class_stream_section:'',
            attendance_date:'',
            dt:'',
            action:'edit'
        }
    },
    methods:{
        getStudents(){
           let uri = 'academics/getStudentsForAttendance'
           uri += ('?classId='+this.classId)
           if(this.streamId !== null){
                    uri += ('&streamId='+this.streamId)
                }
                if(this.sectionId !== null){
                    uri += ('&sectionId='+this.sectionId)
                }
                axios.get(uri)
                .then(response => {
                    let students = response.data.student
                    let studentAttendanceDetail = response.data.studentAttendanceDetail
                    students.forEach((item,index)=>{
                        students[index].is_present = 1
                        studentAttendanceDetail.forEach((attendanceDetail)=>{
                            if(item.std_student_id == attendanceDetail.std_student_id){
                                students[index].is_present = 0
                            }
                        })
                    })
                   this.studentList = students

                }).catch(function (error) {
                    if(error.toString().includes("500")){
                        $('#tbody').html('<tr><td colspan="7" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                    }
                });
        },
        save(){
            axios.post('academics/saveStudentAttendance', {action:this.action,org_class_id:this.classId,org_stream_id:this.streamId,org_section_id:this.sectionId,class_stream_section:this.class_stream_section,attendance_date:this.attendance_date,data:this.studentList})
                .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data saved successfully.'
                    })
                    this.$router.push('/list-student-attendance');
                })
                .catch(function(error){
                this.errors = response.error;
            });
        }
       
    },
    mounted(){
        this.getStudents()
        this.dt = $("#student-attendance-table").DataTable({
            columnDefs: [
                { width: 20, targets: 0},
            ],
        })
    }, 
    created() {
        this.class_stream_section =this.$route.params.data.class_stream_section;
        this.attendance_date = this.$route.params.data.attendance_date;
        this.classId=this.$route.params.data.org_class_id;
        this.streamId=this.$route.params.data.org_stream_id;
        this.sectionId=this.$route.params.data.org_section_id;
        this.id=this.$route.params.data.id;
    },
    watch: {
        studentList(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#student-attendance-table").DataTable()
            });
        }
    }
}
</script>