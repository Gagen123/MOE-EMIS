<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="subject-assessment-type-table" class="table display table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                         <th>SL#</th>
                        <th>Class</th>
                        <th>Action</th> 
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr v-for="(item, index) in classesStreamsList" :key="index">
                            <td>{{ index + 1 }}</td>
                            <td>{{ item.class_stream }}</td>
                          
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <div class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</div>
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
            classesStreamsList:[],
            dt:'',
        }
    },
    methods:{
        getClassStreamList(uri = 'masters/loadClassStreamMapping/NA'){
            axios.get(uri)
            .then(response => {
                let datas = response.data.data;
                let classStreams = []
                let renameId = [] 
                datas.forEach(element => {
                    if(element.stream){
                       renameId['class_stream'] = element.class+' '+element.stream
                    }else{
                        renameId['class_stream'] = element.class
                    }
                    renameId['org_class_id'] = element.classId
                    renameId['org_stream_id'] = element.streamId
                     const obj = {...renameId};
                    classStreams.push(obj);
                });
                this.classesStreamsList = classStreams
            })
            .catch(function (error){
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        showedit(data){
            this.$router.push({name:'aca_edit_subject_assessment_type',params: {data:data}});
        },
    },
    mounted(){ 
        this.getClassStreamList();
        this.dt =  $("#subject-assessment-type-table").DataTable()
    },
    watch: {
        classesStreamsList(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#subject-assessment-type-table").DataTable()
            });
        }
    }
}
</script>
