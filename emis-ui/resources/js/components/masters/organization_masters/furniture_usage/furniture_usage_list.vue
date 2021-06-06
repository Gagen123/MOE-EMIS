<template>
    <div>
        <table id="equipmentItem-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Equipment Item</th>
                    <th>Equipment Type</th>
                    <th>Description</th>
                    <th>Status</th>
                    <!-- <th>Created Date</th> -->
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in equipmentItemList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.equipmentItem}}</td>
                    <td>{{ item.equipmentType}}</td>
                    <td>{{ item.description}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <!-- <td>{{ item.Created_At }}</td> -->
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="viewEquipmentItemList(item)"><i class="fas fa-edit"></i ></a>
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
            equipmentItemList:[],
            dt:'',
        }
    },

    methods:{
        loadEquipmentItemList(uri = 'masters/loadEquipmentItem'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.equipmentItemList =  data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#equipmentItem-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 300);  
        },
        viewEquipmentItemList(data){
            data.action='edit';
            this.$router.push({name:'EquipmentItemEdit',params: {data:data}});
        },
    },

    mounted(){
        this.loadEquipmentItemList();
        this.dt =  $("#equipmentItem-table").DataTable();
    },
    watch: {
        equipmentItemList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#equipmentItem-table").DataTable()
            });
        }
    },
}
</script>