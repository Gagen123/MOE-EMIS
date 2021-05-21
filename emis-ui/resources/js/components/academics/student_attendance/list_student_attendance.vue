<template>
    <div>
        <form @submit.prevent="save" class="bootbox-form" id="subjectTeacher">
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table id="list-student-attendence-table" class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sl#</th>
                                <th>Class</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr  v-for="(item, index) in classStremSectionList" :key="index">
                                 <td>{{ index+1 }}</td>
                                 <td> {{ item.org_class_id }} {{ item.org_stream_id }}  {{ item.org_section_id}} </td>
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
                let studentAttendance = await axios.get('academics/getClassTeacherClasss').then(response => response.data.data)
                studentAttendance.forEach((classTeacher,index) => {
                    classSections.forEach(item => {
                        if(classTeacher.org_class_id == item.class && (classTeacher.org_stream_id == item.stream || (classTeacher.org_stream_id == null && item.stream == null)) && (classTeacher.org_section_id == item.org_section_id || (classTeacher.section == null && item.section == null))){
                            classTeachers[index].org_class_id = item.class;
                            classTeachers[index].org_stream_id = item.stream
                            classTeachers[index].org_section_id = item.section
                            // classTeachers[index].class = item.class;
                            // classTeachers[index].stream = item.stream
                            // classTeachers[index].section = item.section
                        }
                    })
                });
                this.classStremSectionList = classTeachers
                console.log(this.classStremSectionList)
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
        this.dt = $("#list-student-attendence-table").DataTable()
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