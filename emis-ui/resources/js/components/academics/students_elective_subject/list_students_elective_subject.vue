<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="student-elective-subject-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                         <th>SL#</th>
                        <th>Class</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr v-for="(item, index) in classesStreamSectionList" :key="index">
                            <td>{{ index + 1 }}</td>
                            <td>{{ item.class_stream_section }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <div class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</div>
                                    <!-- <a href="#" @click="deleteLeaveRequest(item.id)" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a> -->
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            classesStreamSectionList:[],
            dt:''
        }
    },
    methods:{
       async getClassStreamList(){
          try{
              let classes = []
              let  classStreamSections = await axios.get('loadCommons/loadClassStreamSection/userworkingagency/NA').then(response => {return response.data});
              let classWithElectiveSubjects = await axios.get('academics/getClassWithElectiveSubject').then(response => {return response.data.data});
              let aa = []
               classWithElectiveSubjects.forEach((classWithElectiveSubject,index)=>{
                    classStreamSections.forEach((classStreamSection) =>{
                        if(classStreamSection.org_class_id == classWithElectiveSubject.org_class_id && (classStreamSection.org_stream_id == classWithElectiveSubject.org_stream_id || ((classStreamSection.org_stream_id == null || classStreamSection.org_stream_id == "") && (classWithElectiveSubject.org_stream_id == null || classWithElectiveSubject.org_stream_id == "")))){
                            if(classStreamSection.stream && classStreamSection.section){
                                aa["class_stream_section"] =  classStreamSection.class+' '+classStreamSection.stream+' '+classStreamSection.section
                            }else if(classStreamSection.stream){
                                aa['class_stream_section'] = classStreamSection.class+' '+classStreamSection.stream
                            } else if(classStreamSection.section){
                                aa['class_stream_section'] = classStreamSection.class+' '+classStreamSection.section
                            }
                            aa['OrgClassStreamId'] = classStreamSection.OrgClassStreamId
                            aa['org_class_id'] = classStreamSection.org_class_id
                            aa['org_id'] = classStreamSection.org_id
                            aa['org_section_id'] = classStreamSection.org_section_id
                            aa['org_stream_id'] = classStreamSection.org_stream_id
                            const obj = {...aa};
                            classes.push(obj);
                        }
                    })
                })
                this.classesStreamSectionList = classes;
            }catch(error){
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            };
        },
        showedit(data){
            this.$router.push({name:'create_students_elective_subject',params: {data:data}});
        },
    },
    mounted(){
        this.getClassStreamList();
        this.dt = $("#student-elective-subject-table").DataTable({
             columnDefs: [
                { width: 5, targets: 0},
            ],
        })
    },
    watch: {
        classesStreamSectionList(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#student-elective-subject-table").DataTable()
            });
        }
    }
}
</script>
