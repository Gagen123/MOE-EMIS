<template>
    <div>
        <table id="sportFacility-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Sport Facility Type</th>
                    <th>Description</th>
                    <th>Status</th>
                    <!-- <th>Created Date</th> -->
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in sportFacilityList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.description}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <!-- <td>{{ item.Created_At }}</td> -->
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
            sportFacilityList:[],
            spt:'',

        }
    },

    methods:{
        // loadSportFacilityList(uri = 'masters/loadSportFacility'){
        //     axios.get(uri)
        //     .then(response => {
        //         let data = response;
        //         this.sportFacilityList =  data.data;
        //     })
        //     .catch(function (error) {
        //         if(error.toString().includes("500")){
        //             $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
        //         }
        //     });
        //     setTimeout(function(){
        //         $("#sportFacility-table").DataTable({
        //             "responsive": true,
        //             "autoWidth": true,
        //         }); 
        //     }, 300);  
        // },
        // viewSportFacilityList(data){
        //     data.action='edit';
        //     this.$router.push({name:'SportFacilityEdit',params: {data:data}});
        // },
        loadSportFacilityList(uri = 'masters/organizationMasterController/loadOrganizaitonmasters/all/SportFacilityType'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.sportFacilityList =  data;
            })
            .catch(function (error) {
                console.log('error: '+error);
            });
        },
        editmasters(data){
            this.$router.push({name:'SportFacilityEdit',params: {data:data}});
        },
    },
    mounted(){
        this.loadSportFacilityList();
        this.spt =  $("#sportFacility-table").DataTable()
    
    },
    watch: {
        sportFacilityList(){
            this.spt.destroy();
            this.$nextTick(() => {
                this.spt =  $("#sportFacility-table").DataTable()
            });
        }
    },

}
</script>