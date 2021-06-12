<template>
    <div>
        <table id="project-type-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Project Type</th>
                    <th >Status</th>
                    <th >Created At</th>
                    <th >Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in projectTypeList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <td>{{ item.created_at }}</td>
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
    data(){
        return{
            projectTypeList:[], 
        }
    },
    methods:{
        loadProjectTypeList(uri = 'masters/loadStudentMasters/project_type'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.projectTypeList =  data.data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#project-type-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 3000);  
        },
        showedit(data){
            this.$router.push({name:'ProjectTypeEdit',params: {data:data}});
        },
    },
    mounted(){
        this.loadProjectTypeList();
    },
}
</script>
