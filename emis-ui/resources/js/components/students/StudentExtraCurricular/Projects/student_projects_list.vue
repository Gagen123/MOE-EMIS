<template>
    <div>
        <table id="list-student-projects" class="table table-bordered table-striped table-head-fixed">
            <thead>
                <tr>
                    <th >No.</th>
                    <th >Project/Initiative</th>
                    <th >Type</th>
                    <th >Under Program</th>
                    <th >Period</th>
                    <th >Place</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in dataList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.Name}}</td>
                    <td>{{ item.project_type}}</td>
                    <td>{{ item.program_name}}</td>
                    <td>{{ item.FromDate}} - {{ item.ToDate}}</td>
                    <td>{{ item.place}}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    components: {
    },
    data() {
        return {
            id:'2',
            dataList:[], 
        }
    },
    methods:{
        loadDataList(uri='students/listStudentProjects/'+this.id){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dataList =  data.data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#list-student-projects").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 3000);  
        },
        showedit(data){
            this.$router.push({name:'edit_student_projects',params: {data:data}});
        },
    },
    mounted(){
        this.loadDataList();
    },
}
</script>