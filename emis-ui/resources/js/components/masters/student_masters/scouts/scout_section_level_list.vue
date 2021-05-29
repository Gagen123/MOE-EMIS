<template>
    <div>
        <table id="scout-type-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Scout</th>
                    <th >Status</th>
                    <th >Created At</th>
                    <th >Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in dataList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.Name}}</td>
                    <td>{{ item.Status==  1 ? "Active" : "Inactive" }}</td>
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
            dataList:[], 
        }
    },
    methods:{
        loadDataList(uri = 'masters/loadStudentMasters/scout_section_level'){
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
                $("#scout-type-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 3000);  
        },
        showedit(data){
            this.$router.push({name:'scout_edit',params: {data:data}});
        },
    },
    mounted(){
        this.loadDataList();
    },
}
</script>
