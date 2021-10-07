<template>
    <div class="card-body overflow-auto">
        <table id="road-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th style="width:5%">SL#</th>
                    <th style="width:20%">Road Type</th>
                    <th style="width:10%">Code</th>
                    <th style="width:25%">Description</th>
                    <th style="width:10%">Status</th>
                    <th style="width:25%">Created At </th>
                    <th style="width:10%">Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in roadTypeList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.code}}</td>
                    <td>{{ item.description}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <td>{{ item.created_at}}</td>
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