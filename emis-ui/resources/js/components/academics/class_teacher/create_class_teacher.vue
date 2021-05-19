<template>
    <div>
        <form @submit.prevent="save" class="bootbox-form" id="classTeacher">
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table id="class-teacher-table" class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sl#</th>
                                <th>Class</th>
                                <th>Class Teacher</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr  v-for="(item, index) in classTeacherList" :key="index">
                                 <td>{{ index+1}}</td>
                                <td>
                                    <input v-model="classTeacherList[index].org_class_id" class="form-control" type="hidden">
                                    <input v-model="classTeacherList[index].org_stream_id" class="form-control" type="hidden">
                                    <input v-model="classTeacherList[index].org_section_id" class="form-control" type="hidden">
                                    {{ item.class }} {{item.stream}} {{ item.section }}
                                </td>                                                                              
                                <td>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                        <select  v-model="classTeacherList[index].stf_staff_id" class="form-control editable_fields" id="class_teacher_id"> 
                                            <option selected value="">--SELECT--</option>
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
            classTeacherList: [],
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
        getTeacher(uri = 'loadCommons/loadFewDetailsStaffList/userworkingagency/NA'){
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
                $("#class-teacher-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 3000);
        },
        async classTeacher(){ 
            try{
                let classSections = await axios.get('academics/getclassSections').then(response => { return response.data})
                let classTeachers = await axios.get('academics/getClassTeacher').then(response => response.data.data)

                console.log(classTeachers);
                classSections.forEach((classSection,index) => {
                    classTeachers.forEach(item => {
                        if(classSection.org_class_id == item.org_class_id && (classSection.org_stream_id == item.org_stream_id || (classSection.org_stream_id == null && item.org_stream_id == null)) && (classSection.org_section_id == item.org_section_id || (classSection.org_section_id == null && item.org_section_id == null))){
                            classSections[index].stf_staff_id = item.stf_staff_id
                        }
                    })
                })
                this.classTeacherList = classSections
             }catch(e){
                if(e.toString().includes("500")){
                  $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
             }                           
        },
        save(){
             axios.post('/academics/saveClassTeacher', {data:this.classTeacherList})
                 .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data saved successfully.'
                    })
                    this.$router.push('/create-class-teacher');
                })
                .catch(function(error){
                this.errors = response.error;
            });
        },
	 
    },
    mounted(){ 
        this.classTeacher();
        this.getTeacher();
        this.dt = $("#class-teacher-table").DataTable()
    }, 
    watch: {
        classTeacherList(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#class-teacher-table").DataTable()
            });
        }
    }
   
}
</script>