<template>
   <div>
        <form @submit.prevent="save" class="bootbox-form">
            <div class="ml-0 row form-inline">
                <div class="mr-3">
                    <strong>Class:  </strong> {{ class_stream_section }} 
                </div>
                <div>
                    <strong>Date: </strong>
                    <input :class="{'is-invalid': attendance_dateError }" type="text" id="attendance_date_id" placeholder="dd/mm/yyyy" class="form-control form-control-sm popupDatepicker" @change="remove_error('attendance_date_id','err_id')">
                    <span id= "err_id" class="text-danger">{{ attendance_dateError }}</span>
                </div>
            </div>  
            <div v-if="studentList.length" class="form-group row mt-4">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table id="student-attendance-table" class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Roll No.</th>
                                <th>Name</th>
                                <th>Present</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr v-for="(item, index) in studentList" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>
                                    <input v-model='studentList[index].std_student_id' type="hidden">
                                    {{ item.Name }}
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input  v-model="item.is_present" class="form-check-input" type="checkbox" id="present">
                                    </div>
                                </td>   
                                <td>
                                    <div v-if="item.is_present == 0">
                                        <select class="form-control form-control-sm select2" v-model="studentList[index].aca_absence_reason_id">
                                            <option selected="selected" value="">---SELECT---</option>
                                            <option selected v-for="(item1, index1) in remarkList" :key="index1" :value="item1.id">
                                                {{ item1.name }}
                                            </option>
                                        </select> 
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
            remarkList:[],
            remarks_id:'',
            class_stream_section:'',
            attendance_date:'',
            attendance_dateError:'',
            classError:'',
            dt:'',
            action:'edit'
        }
    },
    methods:{
        getStudents(){
            this.studentList =[]
            $('#attendance_date_id').val(this.attendance_date)
            if(this.attendance_date ==''){
                this.attendance_dateError = "This field is required"
            }else if(this.class_stream_section==''){
                this.classError = "This field is required"
            }else{
                let uri = 'academics/getStudentsForAttendance'
                uri += ('?action='+this.action+'&OrgClassStreamId='+this.OrgClassStreamId+'&attendance_date='+this.formatYYYYMMDD($('#attendance_date_id').val())+'&classId='+this.classId)
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
                                students[index].aca_absence_reason_id = attendanceDetail.aca_absence_reason_id
                            }
                        })
                    })
                this.studentList = students

                }).catch(function (error) {
                    if(error.toString().includes("500")){
                        $('#tbody').html('<tr><td colspan="7" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                    }
                });
            }
            
        },
        loadReasonsForAbsentList(uri = 'masters/loadAcademicMasters/all_active_reasons_for_absent'){
            axios.get(uri)
            .then(response => {
                this.remarkList =  response.data.data;
            })
            .catch(function (error){
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        save(){
            this.attendance_date = this.formatYYYYMMDD($('#attendance_date_id').val());
            axios.post('academics/saveStudentAttendance', {action:this.action,org_class_id:this.classId,org_stream_id:this.streamId,org_section_id:this.sectionId,class_stream_section:this.class_stream_section,attendance_date:this.attendance_date,data:this.studentList, old_date:this.old_attendance_date})
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
        this.loadReasonsForAbsentList()
        this.dt = $("#student-attendance-table").DataTable({
            columnDefs: [
                { width: 20, targets: 0},
            ],
            "lengthChange": false,
            "searching": false,
            drawCallback: function(dt) {
                $('.select2').select2().
                on("select2:select", e => {
                    const event = new Event("change", { bubbles: true, cancelable: true });
                    e.params.data.element.parentElement.dispatchEvent(event);
                })
                .on("select2:unselect", e => {
                const event = new Event("change", { bubbles: true, cancelable: true });
                e.params.data.element.parentElement.dispatchEvent(event);
                });
            },
        })
    }, 
    created() {
        this.class_stream_section =this.$route.params.data.class_stream_section;
        this.attendance_date = this.formatDateToddmmyyyy(this.$route.params.data.attendance_date);
        this.old_attendance_date = this.$route.params.data.attendance_date;
        this.classId=this.$route.params.data.org_class_id;
        this.streamId=this.$route.params.data.org_stream_id;
        this.sectionId=this.$route.params.data.org_section_id;
        this.OrgClassStreamId=this.$route.params.data.OrgClassStreamId;
    },
    watch: {
        studentList(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#student-attendance-table").DataTable({
                    "lengthChange": false,
                    "searching": false,
                    drawCallback: function(dt) {
                        $('.select2').select2().
                        on("select2:select", e => {
                            const event = new Event("change", { bubbles: true, cancelable: true });
                            e.params.data.element.parentElement.dispatchEvent(event);
                        })
                        .on("select2:unselect", e => {
                        const event = new Event("change", { bubbles: true, cancelable: true });
                        e.params.data.element.parentElement.dispatchEvent(event);
                        });
                    },
                })
            });
        }
    }
}
</script>