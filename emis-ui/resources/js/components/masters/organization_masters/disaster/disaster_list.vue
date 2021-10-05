<template>
<div class="card-body overflow-auto">
    <table id="disaster-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th style="width:5%">SL#</th>
                    <th style="width:20%">Disaster Type</th>
                    <th style="width:10%">Code</th>
                    <th style="width:25%">Description</th>
                    <th style="width:10%">Status</th>
                    <th style="width:20%">Created Date</th> 
                    <th style="width:10%">Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in disasterList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.code}}</td>
                    <td>{{ item.description}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <td>{{ item.created_at }}</td> 
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
            disasterList:[],
            dt:'',
        }
    },

    methods:{
        loadDisasterList(uri = 'masters/organizationMasterController/loadOrganizaitonmasters/all/Disaster'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.disasterList =  data;
            })
            .catch(function (error) {
                console.log('error: '+error);
            });
        },
        editmasters(data){
            this.$router.push({name:'disaster_edit',params: {data:data}});
        },
        // loadDisasterList(uri = 'masters/loadDisaster'){
        //     axios.get(uri)
        //     .then(response => {
        //         let data = response;
        //         this.disasterList =  data.data;
        //     })
        //     .catch(function (error) {
        //         if(error.toString().includes("500")){
        //             $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
        //         }
        //     });
        //     setTimeout(function(){
        //         $("#disaster-table").DataTable({
        //             "responsive": true,
        //             "autoWidth": true,
        //         }); 
        //     }, 300);  
        // },
        viewDisasterList(data){
            data.action='edit';
            this.$router.push({name:'DisasterEdit',params: {data:data}});
        },
    },
    mounted(){
        this.loadDisasterList();
        this.dt =  $("#disaster-table").DataTable();
    },
    watch: {
        disasterList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#disaster-table").DataTable()
            });
        }
    },
}
</script>