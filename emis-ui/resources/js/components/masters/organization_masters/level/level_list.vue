<template>
<div class="card-body overflow-auto">
    <table id="level-table" class="table table-bordered text-sm table-striped">
        <thead>
            <tr>
                <th style="width:5%">SL#</th>
                <th style="width:20%">Level</th>
                <th style="width:10%">Code</th>
                <th style="width:25%">Description</th>
                <th style="width:10%">Status</th>
                <th style="width:25%">Created Date</th>
                <th style="width:10%">Action</th> 
            </tr>
        </thead>
        <tbody id="tbody">
            <tr v-for="(item, index) in levelList" :key="index">
                <td>{{ index + 1 }}</td>
                <td>{{ item.name}}</td>
                <td>{{ item.code}}</td>
                <td>{{ item.description}}</td>
                <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                <td>{{ item.created_at }}</td> -->
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
            levelList:[],
            lev:'',
        }
    },

    methods:{
        // loadLevelList(uri = 'masters/loadLevel'){
        //     axios.get(uri)
        //     .then(response => {
        //         let data = response;
        //         this.levelList =  data.data;
        //     })
        //     .catch(function (error) {
        //         if(error.toString().includes("500")){
        //             $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
        //         }
        //     });
        //     setTimeout(function(){
        //         $("#level-table").DataTable({
        //             "responsive": true,
        //             "autoWidth": true,
        //         }); 
        //     }, 300);  
        // },
        // viewLevelList(data){
        //     data.action='edit';
        //     this.$router.push({name:'LevelEdit',params: {data:data}});
        // },

        loadLevelList(uri = 'masters/organizationMasterController/loadOrganizaitonmasters/all/Level'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.levelList =  data;
            })
            .catch(function (error) {
                console.log('error: '+error);
            });
        },
        editmasters(data){
            this.$router.push({name:'LevelEdit',params: {data:data}});
        },
    },
    mounted(){
        this.loadLevelList();
        this.lev =  $("#level-table").DataTable()
    },
    watch: {
        levelList(){
            this.lev.destroy();
            this.$nextTick(() => {
                this.lev =  $("#level-table").DataTable()
            });
        }
    },
}
</script>