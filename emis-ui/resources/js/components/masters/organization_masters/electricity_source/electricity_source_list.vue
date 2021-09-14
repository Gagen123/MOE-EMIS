<template>
    <div>
        <table id="source-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Electricity Source</th>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in electricitySourceList" :key="index">
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

,<script>
export default {
    data(){
        return{
            electricitySourceList:[],
            dt:'',
        }
    },
    methods:{
        // loadSourceList(uri = 'masters/loadElectricitySource'){
        //     axios.get(uri)
        //     .then(response => {
        //         let data = response;
        //         this.electricitySourceList =  data.data;
        //     })
        //     .catch(function (error) {
        //         if(error.toString().includes("500")){
        //             $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
        //         }
        //     });
        //     setTimeout(function(){
        //         $("#source-table").DataTable({
        //             "responsive": true,
        //             "autoWidth": true,
        //         }); 
        //     }, 300);  
        // },

        // viewElectricitySourceList(data){
        //     data.action='edit';
        //     this.$router.push({name:'ElectricitySourceEdit',params: {data:data}});
        // },
        loadSourceList(uri = 'masters/organizationMasterController/loadOrganizaitonmasters/all/ElectricitySource'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.electricitySourceList =  data;
            })
            .catch(function (error) {
                console.log('error: '+error);
            });
        },
        editmasters(data){
            this.$router.push({name:'ElectricitySourceEdit',params: {data:data}});
        },
    },
    mounted(){
        this.loadSourceList();
        this.dt =  $("#source-table").DataTable();
    },
    watch: {
        electricitySourceList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#source-table").DataTable()
            });
        }
    },
}
</script>