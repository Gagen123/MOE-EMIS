<template>
   <div>
        <form @submit.prevent="save" class="bootbox-form">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Class:</label> 
                        <select class="form-control select2" id="org_class_id" v-model="form.class" :class="{ 'is-invalid': form.errors.has('org_class_id')}">
                            <option selected v-for="(item, index) in classTecherClass" :key="index" :value="[item.org_class_id,item.org_stream_id,item.org_section_id]">
                                {{ item.org_class_id }} {{ item.org_stream_id }} {{ item.org_section_id }}
                            </option>
                        </select> 
                        <has-error :form="form" field="org_class_id"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pt-1 mt-4">
                        <button type="button" class="btn btn-sm btn-primary"><i class="fa fa-download"></i> Load Student List</button>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Date:<span class="text-danger">*</span></label>
                        <input  id="attendance_date"  class="form-control" v-model="form.attendance_date" type="date">
                        <!-- <has-error :form="form" field="attendance_date"></has-error> -->
                    </div>
                </div>
                <!-- <div class="form-group row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <table id="class-teacher-table" class="table table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Student Code</th>
                                    <th>Name</th>
                                    <th>Present</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <tr  v-for="(item, index) in classTeacherList" :key="index">
                                    <td>{{ item.std_code }}</td>
                                    <td>
                                        <input v-model='form.std_student_id' type="hidden">
                                            {{ item.name }}
                                    </td>
                                    <td>
                                        <input v-model="classSubjects[index].sub_selected" :value="item.is_present" class="form-check-input" type="checkbox" id="present">
                                    </td>                                                                             
                                    <td>
                                       
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> -->
                <div class="card-footer text-right">
                    <button type="reset" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-redo"></i> Reset</button>
                    <button type="submit" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>        
            </div>
        </form>
    </div>     
</template>

<script>
export default {
    data(){
        return {
            classTecherClass:[],
            form: new form({
                std_student_id:'',
                attendance_date:new Date().toISOString().substr(0, 10),
                class:'',
                is_present:1
            })
        }
    },
    methods:{
        async getClassTeacherClasss(){
            try{
                let classSections = await axios.get('loadCommons/loadClassStreamSection/userworkingagency/NA').then(response => { return response.data})
                let classTeachers = await axios.get('academics/getClassTeacherClasss').then(response => response.data.data)
                classTeachers.forEach((classTeacher,index) => {
                    classSections.forEach(item => {
                        if(classTeacher.org_class_id == item.class && (classTeacher.org_stream_id == item.stream || (classTeacher.org_stream_id == null && item.stream == null)) && (classTeacher.org_section_id == item.org_section_id || (classTeacher.section == null && item.section == null))){
                            classTeachers[index].org_class_id = item.class;
                            classTeachers[index].org_stream_id = item.stream
                            classTeachers[index].org_section_id = item.section
                        }
                    })
                });
                this.classTecherClass = classTeachers
             }catch(e){
                if(e.toString().includes("500")){
                  $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
             }
        },
        save(){
            console.log(this.form)
            axios.post('/academics/saveStudentAttendance', this.form)
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
        },
    },
    mounted(){
    this.getClassTeacherClasss()
    }
}
</script>