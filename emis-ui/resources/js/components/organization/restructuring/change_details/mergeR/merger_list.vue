<template>
    <div>
        <table id="merger-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>First School</th>
                    <th>Second School</th>
                    <th>category</th>
                    <th>Level</th>
                    <th>Status</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in mergerList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.schoolname1st}}</td>
                    <td>{{ item.schoolname2nd }}</td>
                    <td>{{item.category  == 1 ? "public" :  "private"}}</td>
                    <td>{{ item.level}}</td>
                    <td>{{ item.status}} </td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="viewMergerList(item.id)"><i class="fas fa-edit"></i ></a>
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
            mergerList:[],
            dt:'',
        }
    },
    methods:{
        loadMergerList(uri = 'organization/getOrgList'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.mergerList =  data.data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#merger-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 3000);  
        },
        viewBifurcationList(data){
            this.$router.push({name:'MergerAdd',query: {data:data}});
        },
    },
    mounted(){
        this.loadMergerList();
        this.dt =  $("#merger-table").DataTable();

    },
    watch: {
        mergerList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#merger-table").DataTable()
            });
        }
    },
}
</script>