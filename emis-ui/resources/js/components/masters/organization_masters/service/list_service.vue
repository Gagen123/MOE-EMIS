<template>
    <div class="card-body"> 
        <table id="org-masters-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Serivce</th>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Created At </th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in data_list" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.code}}</td>
                    <td>{{ item.description}}</td>
                    <td>{{ item.service_type}}</td>
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
            data_list:[],
            dt:'',
        }
    },

    methods:{
        loadContactList(uri = 'masters/organizationMasterController/loadOrganizaitonmasters/all/Service'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.data_list =  data;
            })
            .catch(function (error) {
                console.log('error: '+error);
            });
        },
        editmasters(data){
            this.$router.push({name:'edit_org_service',query: {data:data}});
        },
    },
    mounted(){
        this.loadContactList();
        this.dt =  $("#org-masters-table").DataTable();
    },
    watch: {
        data_list(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#org-masters-table").DataTable()
            });
        }
    },
}
</script>