<template>
    <div>
        <table id="service-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Service Type</th>
                    <th>Service Provider</th>
                    <th>Status</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in serviceList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.serviceType == 1 ? "Internet" : "Telephone"}}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
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
        }
    },

    methods:{
        loadServiceList(uri = 'masters/loadServiceProvider'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.serviceList =  data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#service-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 300);  
        },
        viewServiceList(data){
            data.action='edit';
            this.$router.push({name:'ServiceProviderEdit',params: {data:data}});
        },
    },
    mounted(){
        this.loadServiceList();
    },
}
</script>