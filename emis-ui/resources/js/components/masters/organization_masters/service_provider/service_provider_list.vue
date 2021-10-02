<template>
    <div>
        <table id="service-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Service Type</th>
                    <th>Service Provider</th>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Created At </th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in serviceList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.serviceType == 1 ? "Internet" : "Telephone"}}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.code}}</td>
                    <td> {{item.description}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <td>{{ item.created_at}}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="viewServiceList(item)"><i class="fas fa-edit"></i ></a>
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
            serviceList:[],
            srvpdv:'',
        }
    },

    methods:{
        loadServiceList(uri = 'masters/organizationMasterController/loadOrganizaitonmasters/all/ServiceProvider'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.serviceList =  data;
            })
            .catch(function (error) {
                console.log('error: '+error);
            });
        },
        viewServiceList(data){
            data.action='edit';
            this.$router.push({name:'ServiceProviderEdit',params: {data:data}});
        },
    },
    mounted(){
        this.loadServiceList();
        this.srvpdv =  $("#service-table").DataTable()
    
    },
    watch: {
        serviceList(){
            this.srvpdv.destroy();
            this.$nextTick(() => {
            this.srvpdv =  $("#service-table").DataTable()
            });
        }
    },
}
</script>