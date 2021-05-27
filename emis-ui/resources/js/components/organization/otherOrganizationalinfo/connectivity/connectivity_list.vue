<template>
    <div>
        <table id="connectivity-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>School Name</th>
                    <th>category</th>
                    <th>Level</th>
                    <th>Status</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="connectivitydata">
                <tr v-for="(item, index) in connectivityList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.organization}}</td>
                    <td>{{item.category  == 1 ? "public" :  "private"}}</td>
                    <td>{{ item.level}}</td>
                    <td>{{ item.status}} </td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="viewConnectivityList(item.id)"><i class="fas fa-edit"></i ></a>
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
            connectivityList:[],
            dt:'',
        }
    },
    methods:{
        loadConnectivityList(uri = 'organization/getOrgList'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.connectivityList =  data.data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#connectivitydata').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#connectivity-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 3000);  
        },
        viewConnectivityList(data){
            this.$router.push({name:'MergerAdd',query: {data:data}});
        },
    },
    mounted(){
        this.loadConnectivityList();
        this.dt =  $("#connectivity-table").DataTable();

    },
    watch: {
        connectivityList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#connectivity-table").DataTable()
            });
        }
    },
}
</script>