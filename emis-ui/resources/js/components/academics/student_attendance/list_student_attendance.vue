<template>
    <div>
        <form class="bootbox-form" id="subjectTeacher">
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table id="list-student-attendence-table" class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sl#</th>
                                <th>Class</th>
                                <th>Attendance Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr  v-for="(item, index) in classStremSectionList" :key="index">
                                <td>{{ index+1 }}</td>
                                <td> {{ item.class_stream_section}}</td>
                                <td> {{ item.attendance_date}}</td>
                                <td>
                                    <div class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</div>
                                </td>                                                                               
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>     
</template>
<script>
export default {
    data() {
        return {
            classStremSectionList: [],
            dt:''
        }
    },
    methods: {
        remove_err(field_id){
            if($('#' + field_id).val()!=""){
                $('#' + field_id).removeClass('is-invalid')
            }
        },
        async loadClassStreamSection(){
             try{
                let classSections = await axios.get('loadCommons/loadClassStreamSection/userworkingagency/NA').then(response => { return response.data})
                let studentsAttendance = await axios.get('academics/loadStudentAttendance').then(response => response.data.data)
                studentsAttendance.forEach((attendance,index) => {
                    classSections.forEach(item => {
                        if(attendance.org_class_id == item.org_class_id && (attendance.org_stream_id == item.org_stream_id || (attendance.org_stream_id == null && item.org_stream_id == null)) && (attendance.org_section_id == item.org_section_id || (attendance.org_section_id == null && item.org_section_id == null))){
                            if(item.stream && item.section){
                                studentsAttendance[index]['class_stream_section'] = item.class+' '+item.stream+' '+item.section
                            }else if(item.stream){
                                studentsAttendance[index]['class_stream_section'] = item.class+' '+item.stream
                            }else if(item.section){
                                studentsAttendance[index]['class_stream_section'] = item.class+' '+item.section
                            }
                            else{
                                studentsAttendance[index]['class_stream_section'] = item.class
                            }
                            studentsAttendance[index]['OrgClassStreamId'] = item.OrgClassStreamId
                            // studentsAttendance[index]['aca_absence_reason_id'] = item.aca_absence_reason_id

                        }
                    })
                });
                this.classStremSectionList = studentsAttendance
             }catch(e){
                if(e.toString().includes("500")){
                  $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
             } 

        },
        showedit(data){
            this.$router.push({name:'edit_student_attendance',params: {data:data}});
        },
	 
    },
    mounted(){ 
        this.loadClassStreamSection();
        this.dt = $("#list-student-attendence-table").DataTable({
               columnDefs: [
                { width: 2, targets: 0},
            ],
        })
    },
    watch: {
        classStremSectionList(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#list-student-attendence-table").DataTable()
            });
        }
    }
    
}
</script>