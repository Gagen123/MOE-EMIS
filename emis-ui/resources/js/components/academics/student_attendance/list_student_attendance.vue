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
                                <th>Stream</th>
                                <th>Section</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr  v-for="(item, index) in classStremSectionList" :key="index">
                                 <td>{{ index+1 }}</td>
                                 <td> {{ item.class }} </td>
                                 <td> {{ item.stream }}  </td>
                                 <td> {{ item.section }} </td>
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
                let classTeachers = await axios.get('academics/getClassTeacher').then(response => response.data.data)

                classSections.forEach((classSection,index) => {
                    classSection.org_class_id = classSection.class
                    classSection.org_stream_id = classSection.stream
                    classSection.org_section_id = classSection.section
                    classTeachers.forEach(item => {
                        if(classSection.org_class_id == item.org_class_id && (classSection.org_stream_id == item.org_stream_id || (classSection.org_stream_id == null && item.org_stream_id == null)) && (classSection.org_section_id == item.org_section_id || (classSection.org_section_id == null && item.org_section_id == null))){
                            classSections[index].stf_staff_id = item.stf_staff_id
                        }
                    })
                })
                this.classStremSectionList = classSections
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