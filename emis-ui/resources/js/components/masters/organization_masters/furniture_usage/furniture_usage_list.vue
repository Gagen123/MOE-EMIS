<template>
    <div>
        <table id="equipmentUsage-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Furniture Usage</th>
                    <th>Description</th>
                    <th>Status</th>
                    <!-- <th>Created Date</th> -->
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in furnitureUsageList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.description}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <!-- <td>{{ item.Created_At }}</td> -->
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="viewFurnitureUsageList(item)"><i class="fas fa-edit"></i ></a>
                            <!-- <a href="#" @click="deleteLeaveRequest(item.id)" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a> -->
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
            furnitureUsageList:[],
            dt:'',
        }
    },
    methods:{
        loadFurnitureUsageList(uri = 'masters/loadFurnitureUsage'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.furnitureUsageList =  data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#equipmentUsage-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 300);  
        },
        viewFurnitureUsageList(data){
            data.action='edit';
            this.$router.push({name:'furniture_usage_edit',params: {data:data}});
        },
    },
    mounted(){
        this.loadFurnitureUsageList();
        this.dt =  $("#equipmentUsage-table").DataTable()
    },
    watch: {
        furnitureUsageList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#equipmentUsage-table").DataTable()
            });
        }
    },
}
</script>