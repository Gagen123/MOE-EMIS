<template>
    <div>
        <table id="road-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Road Type</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in roadTypeList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name}}</td>
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
            roadTypeList:[],
            rdty:'',
        }
    },
    methods:{
        // loadRoadTypeList(uri = 'masters/loadRoadType'){
        //     axios.get(uri)
        //     .then(response => {
        //         let data = response;
        //         this.roadTypeList =  data.data;
        //     })
        //     .catch(function (error) {
        //         if(error.toString().includes("500")){
        //             $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
        //         }
        //     });
        //     setTimeout(function(){
        //         $("#road-table").DataTable({
        //             "responsive": true,
        //             "autoWidth": true,
        //         }); 
        //     }, 300);  
        // },
        // viewRoadTypeList(data){
        //     data.action='edit';
        //     this.$router.push({name:'RoadTypeEdit',params: {data:data}});
        // },

        loadRoadTypeList(uri = 'masters/organizationMasterController/loadOrganizaitonmasters/all/RoadType'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.roadTypeList =  data;
            })
            .catch(function (error) {
                console.log('error: '+error);
            });
        },
        editmasters(data){
            this.$router.push({name:'RoadTypeEdit',params: {data:data}});
        },
    },
    mounted(){
        this.loadRoadTypeList();
        this.rdty =  $("#road-table").DataTable()
    },
    watch: {
        roadTypeList(){
            this.rdty.destroy();
            this.$nextTick(() => {
                this.rdty =  $("#road-table").DataTable()
            });
        }
    },

}
</script>