<template>
    <div>
        <table id="sportSupporter-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Sport Supporter</th>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Created At </th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in sportSupporterList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.code}}</td>
                    <td>{{ item.description}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <td>{{ item.created_at}}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="editmasters(item)"><i class="fas fa-edit"></i ></a>
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
            sportSupporterList:[],
            dt:'',
        }
    },

    methods:{
        // loadSportSupporterList(uri = 'masters/loadSportSupporter'){
        //     axios.get(uri)
        //     .then(response => {
        //         let data = response;
        //         this.sportSupporterList =  data.data;
        //     })
        //     .catch(function (error) {
        //         if(error.toString().includes("500")){
        //             $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
        //         }
        //     });
        //     setTimeout(function(){
        //         $("#sportSupporter-table").DataTable({
        //             "responsive": true,
        //             "autoWidth": true,
        //         }); 
        //     }, 300);  
        // },
        // viewSportSupporterList(data){
        //     data.action='edit';
        //     this.$router.push({name:'SportSupporterEdit',params: {data:data}});
        // },

        loadSportSupporterList(uri = 'masters/organizationMasterController/loadOrganizaitonmasters/all/SportSupporter'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.sportSupporterList =  data;
            })
            .catch(function (error) {
                console.log('error: '+error);
            });
        },
        editmasters(data){
            this.$router.push({name:'SportSupporterEdit',params: {data:data}});
        },
    },
    mounted(){
        this.loadSportSupporterList();
        this.dt =  $("#sportSupporter-table").DataTable();
    },
    watch: {
        sportSupporterList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#sportSupporter-table").DataTable()
            });
        }
    },
}
</script>