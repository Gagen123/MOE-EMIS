<template>
    <div>
        <table id="list-student-programs" class="table table-bordered table-striped table-head-fixed">
            <thead>
                <tr>
                     <th >No.</th>
                     <th >Class</th>
                     <th >Subject</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in dataList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ classArray[item.classId]}}</td>
                    <td>{{ subArray[item.subjectId]}}</td>
                    <!-- <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</a>
                        </div>
                    </td> -->
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    data(){
        return{
            dataList:[],
            classArray:{},
            subArray:{},
        }
    },
    methods:{
        loadClassList(uri="loadCommons/getOrgClassStream"){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                 for(let i=0;i<data.length;i++){
                    this.classArray[data[i].id] = data[i].class;
                }
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },

        loadAcademicMasters(uri="masters/loadAcademicMasters/all_active_subject"){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.subjectList =  data;
                for(let i=0;i<data.length;i++){
                    this.subArray[data[i].id] = data[i].name;
                }

            })
            .catch(function (error) {
                console.log(error);
            });
        },
        loadDataList(uri='organization/getSubjectMapping'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dataList =  data.data;
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        showedit(data){
            this.$router.push({name:'edit_org_programs',params: {data:data}});
        },
    },
    mounted(){
        this.loadAcademicMasters();
        this.loadClassList();
        this.loadDataList();
    },
}
</script>
