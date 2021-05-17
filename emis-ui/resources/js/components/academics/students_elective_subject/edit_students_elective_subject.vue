<template>
    <div>
        <form @submit.prevent="save" class="bootbox-form" id="studentsElectiveSubject">
            <div class="row form-group">
              <div class="ml-3 row form-group">
              <div class="mr-3">
                <strong>Class: </strong> {{ className}} {{streamName}} {{section}}
              </div>
            </div>  
            </div>  
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table id="students-elective-subject-table" class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Roll No</th>
                                <th>Name</th>
                                <th v-for="(item0, index0) in electiveSubjectList" :key="index0">{{item0.subject}}</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr  v-for="(item, index) in studentElectiveSubjectList" :key="index">
                                <td>
                                    {{ item.roll_no }}
                                </td> 
                                  <td>
                                    <input v-model="studentElectiveSubjectList[index].std_student_id" class="form-control" type="hidden">
                                    {{ item.name}}
                                </td> 
                                <td v-for="(item1, index1) in electiveSubjectList" :key="index1">
                                    <input type="checkbox" v-model="studentElectiveSubjectList[index][item1.aca_sub_id]" :true-value="item1.aca_sub_id" :false-value="false">
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
            studentElectiveSubjectList: [],
            electiveSubjectList:[]
        }
    },
    methods: {
        remove_err(field_id){
            if($('#' + field_id).val()!=""){
                $('#' + field_id).removeClass('is-invalid')
            }
        },      
       async studentElectiveSubject(){
          let uri = 'academics/getStudentElectiveSubjects'
          uri += ('?classId='+this.classId)
          if(this.streamId !== null){
                uri += ('&streamId='+this.streamId)
            }
            if(this.section_id !== null){
                uri += ('&sectionId='+this.section_id)
            }
            try{
                let studentElectiveSubjects = await axios.get(uri).then(response => response.data)
                this.studentElectiveSubjectList = studentElectiveSubjects.students
                 this.electiveSubjectList = studentElectiveSubjects.electiveSubjects.data

                setTimeout(function(){
                    $("#students-elective-subject-table").DataTable({
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
             axios.post('/academics/saveStudentElectiveSubject', {data:this.studentElectiveSubjectList})
                 .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data saved successfully.'
                    })
                    this.$router.push('/edit-student-elective-subject');
                })
                .catch(function(error){
                this.errors = response.error;
            });
        },
	 
    },
    mounted(){ 
        this.studentElectiveSubject()
    },
    created() {

        this.className=this.$route.params.data.class;
        this.classId=this.$route.params.data.org_class_id;
        this.streamId=this.$route.params.data.org_stream_id;
        this.section_id=this.$route.params.data.org_section_id;
        this.streamName=this.$route.params.data.stream;
        this.section=this.$route.params.data.section;

        this.id=this.$route.params.data.id;
    },
    
}
</script>