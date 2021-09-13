<template>
    <div>
        <table id="supply-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Electricity Supply</th>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in supplyList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.code}}</td>
                    <td>{{ item.description}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="editmasters(item)"><i class="fas fa-edit"></i ></a>
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
            supplyList:[],
            dt:'',
        }
    },

    methods:{
        // loadSupplyList(uri = 'masters/loadElectricitySupply'){
        //     axios.get(uri)
        //     .then(response => {
        //         let data = response;
        //         this.supplyList =  data.data;
        //     })
        //     .catch(function (error) {
        //         if(error.toString().includes("500")){
        //             $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
        //         }
        //     });
        //     setTimeout(function(){
        //         $("#supply-table").DataTable({
        //             "responsive": true,
        //             "autoWidth": true,
        //         }); 
        //     }, 300);  
        // },
        // viewElectricitySupplyList(data){
        //     data.action='edit';
        //     this.$router.push({name:'ElectricitySupplyEdit',params: {data:data}});
        // },
        loadSupplyList(uri = 'masters/organizationMasterController/loadOrganizaitonmasters/all/ElectricitySupply'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.supplyList =  data;
            })
            .catch(function (error) {
                console.log('error: '+error);
            });
        },
        editmasters(data){
            this.$router.push({name:'ElectricitySupplyEdit',params: {data:data}});
        },
    },
    mounted(){
        this.loadSupplyList();
        this.dt =  $("#supply-table").DataTable();
    },
    watch: {
        supplyList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#supply-table").DataTable()
            });
        }
    },
}
</script>