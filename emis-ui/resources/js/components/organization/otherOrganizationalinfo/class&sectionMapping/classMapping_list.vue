<template>
    <div>
        <table id="classMapping-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>School Name</th>
                    <th>Level</th>
                    <th>Classes </th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="classMappingdata">
                <tr v-for="(item, index) in classMappingList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.organization}}</td>
                    <td>{{ item.level}}</td>
                    <td>{{ item.Classes}} </td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="viewClassMappingList(item.id)"><i class="fas fa-edit"></i ></a>
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
            classMappingList:[],
            dt:'',
        }
    },
    methods:{
        loadClassMappingList(uri = 'organization/getOrgList'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.classMappingList =  data.data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#classMappingdata').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#classMapping-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 3000);  
        },
        viewClassMappingList(data){
            this.$router.push({name:'MergerAdd',query: {data:data}});
        },
    },
    mounted(){
        this.loadClassMappingList();
        this.dt =  $("#classMapping-table").DataTable();

    },
    watch: {
        classMappingList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#classMapping-table").DataTable()
            });
        }
    },
}
</script>