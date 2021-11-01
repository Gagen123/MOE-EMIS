<template>
    <div>
        <div class="card card-primary card-outline">
            <div class="card-body pb-1 mb-0 pt-1 mt-0">
                <table id="meeting-table" class="table table-bordered text-sm table-striped">
                    <thead>
                        <tr>
                            <th>SL#</th>
                            <th>Body Type</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in staffcomposition" :key="index">
                            <td>{{ index+1}}</td>
                            <td>{{ item.body_type_id}}</td>
                            <td>{{ item.from_date}}</td>
                            <td>{{ item.to_date}}</td>
                            <td>
                                <a href="#" class="btn btn-xs btn-flat btn-primary" @click="openMeeting(item)"><i class="fa fa-file-signature"></i>Open</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            staffcomposition:[],
            managementbodylist:{},
        }
    },
    methods:{
        loadComposition(uri = 'staff/managementBody/loadcreatedManagementBodyComposition'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.staffcomposition = data.data;
            }).catch(function (error){console.log('Error: '+error);});
        },
        loadmgmnbodytype(){
            let uri = 'masters/loadStaffMasters/all_active_mgmn_body_type';
            axios.get(uri)
            .then(response => {
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.managementbodylist[data.data.data[i].id] = data.data.data[i].name;
                }
            }).catch(function (error) {console.log('err: '+error);});
        },
        openMeeting(item){
            this.$router.push({name:"open_meeting",params:{data:item.id}});
        }
    },
    mounted() {
        this.loadmgmnbodytype();
        this.loadComposition();
        this.dt = $("#meeting-table").DataTable();

    },
    watch: {
        staffcomposition(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#meeting-table").DataTable()
            });
        }
    },

}
</script>


