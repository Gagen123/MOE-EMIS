<template>
    <div>
        <table id="location-table" class="table table-bordered text-sm table-striped">
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
            <tbody id="locationdata">
                <tr v-for="(item, index) in locationList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.organization}}</td>
                    <td>{{item.category  == 1 ? "public" :  "private"}}</td>
                    <td>{{ item.level}}</td>
                    <td>{{ item.status}} </td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="viewLocationList(item.id)"><i class="fas fa-edit"></i ></a>
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
            locationList:[],
            dt:'',
        }
    },
    methods:{
        loadLocationList(uri = 'organization/getOrgList'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.locationList =  data.data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#locationdata').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#location-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 3000);  
        },
        viewLocationList(data){
            this.$router.push({name:'LocationAdd',query: {data:data}});
        },
    },
    mounted(){
        this.loadLocationList();
        this.dt =  $("#location-table").DataTable();

    },
    watch: {
        locationList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#location-table").DataTable()
            });
        }
    },
}
</script>