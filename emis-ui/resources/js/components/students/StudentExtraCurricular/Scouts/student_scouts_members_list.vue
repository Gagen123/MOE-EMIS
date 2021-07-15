<template>
    <div>
        <table id="list-student-initiatives" class="table table-bordered table-striped table-head-fixed">
            <thead>
                <tr>
                    <th >No.</th>
                    <th >Student Name </th>
                    <th >Student ID </th>
                    <th >Scout</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in dataList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.student_name}}</td>
                    <td>{{ item.student_code}}</td>
                    <td>{{ item.scout_name}}</td>
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
            dataList:[],
        }
    },
    methods:{
        loadDataList(uri='students/loadScoutMembers/'+this.id){
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
                $("#list-student-initiative").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                });
            }, 3000);
        },
        showedit(data){
            this.$router.push({name:'edit_student_projects_members',params: {data:data}});
        },
    },
    mounted(){
        this.loadDataList();
    },
}
</script>
