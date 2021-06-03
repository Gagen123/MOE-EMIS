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
        getClassStreamList(uri = 'loadCommons/loadClassStreamSection/userworkingagency/NA'){
            axios.get(uri)
            .then(response => {
                let datas = response.data;
                let classStreamSection = []
                let renameId = [] 
                datas.forEach(element => {
                    if(element.stream && element.section){
                       renameId['class_stream_section'] = element.class+' '+element.stream+' '+element.section
                    }else if(element.stream){
                        renameId['class_stream_section'] = element.class+' '+element.stream
                    } else if(element.section){
                        renameId['class_stream_section'] = element.class+' '+element.section
                    }
                    else{
                        renameId['class_stream_section'] = element.class
                    }
                    renameId['org_class_id'] = element.org_class_id
                    renameId['org_stream_id'] = element.org_stream_id
                    renameId['org_section_id'] = element.org_section_id
                    renameId['OrgClassStreamId'] = element.OrgClassStreamId
                    
                    const obj = {...renameId};
                    classStreamSection.push(obj);
                });
                this.classesStreamSectionList = classStreamSection;
            })
            .catch(function (error){
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        showedit(data){
            this.$router.push({name:'edit_students_elective_subject',params: {data:data}});
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
