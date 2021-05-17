<template>
    <div>
        <form @submit.prevent="save" class="bootbox-form" id="subjectTeacher">
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table id="subject-teacher-table" class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sl#</th>
                                <th>Class</th>
                                <th>Subject</th>
                                <th>Teacher</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr  v-for="(item, index) in subjectTeacherList" :key="index">
                                 <td>{{ index+1}}</td>
                                <td>
                                    <input v-model="subjectTeacherList[index].org_class_id" class="form-control" type="hidden">
                                    <input v-model="subjectTeacherList[index].org_stream_id" class="form-control" type="hidden">
                                    <input v-model="subjectTeacherList[index].org_section_id" class="form-control" type="hidden">
                                    {{ item.class }} {{item.stream}} {{ item.section }}
                                </td> 
                                <td>
                                    <input v-model="subjectTeacherList[index].aca_sub_id" class="form-control" type="hidden">
                                    {{ item.subject }}
                                </td>                                                                               
                                <td>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                        <select  v-model="subjectTeacherList[index].stf_staff_id" class="form-control  editable_fields" id="class_teacher_id"> 
                                            <option  selected="selected" value="">NOT OFFERRED IN THE SCHOOL</option>
                                            <option v-for="(item, index) in teacherList" :key="index" :value="item.stf_staff_id">
                                                <span v-if="item.employee_code">{{item.employee_code}}: </span> 
                                                {{ item.name }}, {{item.position}} 
                                            </option>
                                        </select>
                                        <!-- <has-error :form='form' field="aca_assmnt_frequency_id"></has-error> -->
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="reset" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-redo"></i> Reset</button>
                <button type="submit" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
    </div>     
</template>
<script>
export default {
    data() {
        return {
            subjectTeacherList: [],
            teacherList:[]
        }
    },
    methods: {
        remove_err(field_id){
            if($('#' + field_id).val()!=""){
                $('#' + field_id).removeClass('is-invalid')
            }
        },
        getTeacher(uri = 'academics/getTeacher'){
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.teacherList = data.data.data;
            })
            .catch(function (error){
                 if(error.toString().includes("500")){
                  $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            })
            setTimeout(function(){
                $("#subject-teacher-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 3000);
        },
         async getsubjectTeachers(){
             let finalSubjectTeachers =[];
             try{
                let classSections = await axios.get('academics/getclassSections').then(response => response.data)
                let subjectTeachers = await axios.get('academics/getSubjectTeacher').then(response => response.data.data)
                classSections.forEach((classSection) => {
                    subjectTeachers["classSubjects"].forEach(item => {
                        let aa = [];
                        if(classSection.org_class_id == item.org_class_id && (classSection.org_stream_id == item.org_stream_id || (classSection.org_stream_id == null && item.org_stream_id == null))){
                            aa["org_class_id"] = classSection.org_class_id;
                            aa["org_stream_id"] = classSection.org_stream_id;
                            aa["org_section_id"] = classSection.org_section_id;
                            aa["aca_sub_id"] = item.aca_sub_id;
                            aa["class"] = classSection.class;
                            aa["org_id"] = classSection.org_id;
                            aa["stream"] = classSection.stream;
                            aa["section"] = classSection.section;
                            aa["subject"] = item.name;
                            aa["stf_staff_id"] = "";
                            const obj = {...aa};
                            finalSubjectTeachers.push(obj);
                        }
                    });
                });
                finalSubjectTeachers.forEach((finalSubjectTeacher,index) => {
                    subjectTeachers["classSubjectTeachers"].forEach(classSubjectTeacher => {
                        if(finalSubjectTeacher.aca_sub_id == classSubjectTeacher.aca_sub_id && finalSubjectTeacher.org_class_id == classSubjectTeacher.org_class_id && (finalSubjectTeacher.org_stream_id == classSubjectTeacher.org_stream_id || (finalSubjectTeacher.org_stream_id == null && classSubjectTeacher.org_stream_id == null)) && (finalSubjectTeacher.org_section_id == classSubjectTeacher.org_section_id || (finalSubjectTeacher.org_section_id == null && classSubjectTeacher.org_section_id == null))){
                            finalSubjectTeachers[index].stf_staff_id = classSubjectTeacher.stf_staff_id
                        }
                    });
                });
                this.subjectTeacherList = finalSubjectTeachers;

                setTimeout(function(){
                    $("#subject-teacher-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                    }); 
                }, 3000);
             }catch(e){
                if(e.toString().includes("500")){
                  $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
             }                           
        },
        save(){
             axios.post('/academics/saveSubjectTeacher', {data:this.subjectTeacherList})
                 .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data saved successfully.'
                    })
                    this.$router.push('/create-subject-teacher');
                })
                .catch(function(error){
                this.errors = response.error;
            });
        },
	 
    },
    mounted(){ 
        this.getsubjectTeachers()
        this.getTeacher()
        
    },
    
}
</script>