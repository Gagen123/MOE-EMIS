<template>
    <div class="card-body">
        <table id="dzongkhag-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Dzongkhag</th>
                    <th >Code</th>
                    <th >Status</th>
                    <th >Created At</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in dzongkhagList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.code}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <td>{{reverseDateTime(item.created_at)}}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</a>
                            <!-- <a href="#" @click="deleteLeaveRequest(item.id)" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a> -->
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
            dzongkhagList:[],
            dt:'',
        }
    },
    methods:{
        loaddzongkhagList(uri = 'masters/loadGlobalMasters/all_dzongkhag'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dzongkhagList =  data.data.data;
            })
            .catch(function (error) {
                console.log('error in retrieve: '+error);
            });
        },
        showedit(data){
            this.$router.push({name:'edit_dzongkhag',params: {data:data}});
        },
    },
    mounted(){
        this.loaddzongkhagList();
        this.dt =  $("#dzongkhag-table").DataTable();
    },
    watch: {
        dzongkhagList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#dzongkhag-table").DataTable()
            });
        }
    },
}
</script>
