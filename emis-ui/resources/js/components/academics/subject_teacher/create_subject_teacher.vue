<template>
    <div>
        <form @submit.prevent="save" class="bootbox-form" id="subjectTeacher">
             <div class="ml-0 row form-group">
                <div class="mr-3">
                    <strong>Class: </strong> {{ class_stream_section }} 
                </div>
            </div>  
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table id="subject-teacher-table" class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sl#</th>
                                <th>Subject</th>
                                <th>Teacher</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr  v-for="(item, index) in subjectTeacherList" :key="index">
                                <td>{{ index+1}}</td>
                                <td>
                                    <input v-model="subjectTeacherList[index].aca_sub_id" class="form-control" type="hidden">
                                    {{ item.name }} 
                                    <span v-if="item.dzo_name">( {{ item.dzo_name }} )</span>
                                </td>                                                                               
                                <td>
                                        <select v-model="subjectTeacherList[index].stf_staff_id" class="form-control select2"> 
                                            <option selected="selected" value="">---Select---</option>
                                            <option v-for="(item1, index1) in getSubjectWiseTeachers(item.aca_sub_id)" :key="index1" :value="item1.stf_staff_id">
                                                {{ item1.name }}, {{item1.position}} [ {{item1.emp_id}} ]
                                            </option>
                                        </select>
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
            teacherList:[],
            dt:''
        }
    },
    methods: {
        remove_err(field_id){
            if($('#' + field_id).val()!=""){
                $('#' + field_id).removeClass('is-invalid')
            }
        },
         async getsubjectTeachers(){
            let uri = 'academics/getSubjectTeacher'
            uri += ('?org_class_id='+this.org_class_id)
            if(this.org_stream_id !== null){
                    uri += ('&org_stream_id='+this.org_stream_id)
            }
            if(this.org_section_id !== null){
                uri += ('&org_section_id='+this.org_section_id)
            }
             try{
                let data = await axios.get(uri).then(response => response.data)
                let subjectTeachers = data.subjectTeachers
                let staffList = data.staffs
                subjectTeachers["classSubjects"].forEach((finalSubjectTeacher,index) => {
                    subjectTeachers["classSubjectTeachers"].forEach(classSubjectTeacher => {
                        if(finalSubjectTeacher.aca_sub_id == classSubjectTeacher.aca_sub_id && finalSubjectTeacher.org_class_id == classSubjectTeacher.org_class_id && (finalSubjectTeacher.org_stream_id == classSubjectTeacher.org_stream_id || ((finalSubjectTeacher.org_stream_id == null || finalSubjectTeacher.org_stream_id == "") && (classSubjectTeacher.org_stream_id == null)|| classSubjectTeacher.org_stream_id == ""))){
                            subjectTeachers["classSubjects"][index].stf_staff_id = classSubjectTeacher.stf_staff_id
                            
                        }
                    });
                });
                 subjectTeachers["subjectMappingForTre"].forEach((mappedSubject,i) => {
                    staffList.forEach(staff => {
                        if((mappedSubject.aca_teacher_sub_id == staff.comp_sub_id) || (mappedSubject.aca_teacher_sub_id == staff.elective_sub_id1) || (mappedSubject.aca_teacher_sub_id == staff.elective_sub_id2)){
                            subjectTeachers["subjectMappingForTre"][i]['stf_staff_id'] = staff.id
                            subjectTeachers["subjectMappingForTre"][i]['emp_id'] = staff.emp_id
                            subjectTeachers["subjectMappingForTre"][i]['name'] = staff.name
                            subjectTeachers["subjectMappingForTre"][i]['position'] = staff.position
                        }
                    })
                })
                this.subjectTeacherList = subjectTeachers["classSubjects"];
                this.teacherList = subjectTeachers["subjectMappingForTre"]
             }catch(e){
                if(e.toString().includes("500")){
                  $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
             }                           
        },
        getSubjectWiseTeachers(aca_sub_id){
            return this.teacherList.filter(item => item.aca_sub_id == aca_sub_id);
        },
        save(){
             axios.post('/academics/saveSubjectTeacher', {org_class_id:this.org_class_id,org_stream_id:this.org_stream_id,org_section_id:this.org_section_id,class_stream_section:this.class_stream_section,data:this.subjectTeacherList})
                 .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data saved successfully.'
                    })
                    this.$router.push('/create-subject-teacher');
                }).catch(function(errors){
                    if(errors.response.status === 422){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'You have not selected subject teacher!',
                        })
                    }
                });
        },
	 
    },
    mounted(){ 
        this.getsubjectTeachers();
        this.dt = $("#subject-teacher-table").DataTable({
            columnDefs: [
                { width: 2, targets: 0},
                { width: 200, targets: [1,2]},
            ],
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
        this.org_class_id=this.$route.params.data.org_class_id;
        this.org_stream_id=this.$route.params.data.org_stream_id;
        this.org_section_id = this.$route.params.data.org_section_id;
        this.class_stream_section =this.$route.params.data.class_stream_section;
        this.id=this.$route.params.data.id;
    },
    watch: {
        subjectTeacherList(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#subject-teacher-table").DataTable({
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