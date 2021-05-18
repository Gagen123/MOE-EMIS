<template>
    <div>
        <div class="card card-primary card-outline">
            <div class="card-body pb-1 mb-0 pt-1 mt-0">
                <table id="managment-table" class="table table-bordered text-sm table-striped">
                    <thead>
                        <tr>
                            <th>SL#</th>
                            <th>Body Type</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Remarks</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in staffcomposition_list" :key="index">
                            <td>{{ index+1}}</td>
                            <td>{{ management_body_list[item.body_type_id]}}</td>
                            <td>{{ item.from_date}}</td>
                            <td>{{ item.to_date}}</td>
                            <td>{{ item.remarks}}</td>
                            <td>
                                <a href="#" class="btn btn-success btn-sm btn-flat text-white" @click="loadeditpage(item)">Edit</a>
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
            management_body_list:{},
            staffcomposition_list:[],

        }
    },
    methods: {
        loadgenderList(uri = 'staff/managementBody/loadcreatedManagementBodyComposition'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.staffcomposition_list = data;
            })
            .catch(function (error){
               console.log('Error: '+error);
            });
        },
        loadmanagmentBodyList(){
            let uri = 'masters/loadStaffMasters/all_active_mgmn_body_type';
            axios.get(uri)
            .then(response => {
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.management_body_list[data.data.data[i].id] = data.data.data[i].name;
                }
            })
            .catch(function (error) {
                console.log('err: '+error);
            });
        },
        loadeditpage(itme){
            this.$router.push({name:"edit_management_body",params:{data:itme}});
        }
    },
    mounted() {
        this.loadmanagmentBodyList();
        this.loadgenderList();
        $("#managment-table").DataTable({
            "responsive": true,
            "autoWidth": true,
        });
    },
}
</script>
