<template>
    <div class="card-body">
        <table id="guideline-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Guideline for</th>
                    <th >Guidelines</th>
                    <th >Status</th>
                    <th >Created At</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in dataList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.guideline_for}}</td>
                    <td>{{ item.guideline}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <td>{{ item.created_at }}</td>
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
            dataList:[],
            dt:'',
        }
    },
    methods:{
        loaddzongkhagList(uri = 'masters/loadGlobalMasters/all_guidelines'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dataList =  data.data.data;
            })
            .catch(function (error) {
                console.log('error in retrieve: '+error);
            });
        },
        showedit(data){
            this.$router.push({name:'edit_guidelines',params: {data:data}});
        },
    },
    mounted(){
        this.loaddzongkhagList();
        this.dt =  $("#guideline-table").DataTable();
    },
    watch: {
        dataList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#guideline-table").DataTable()
            });
        }
    },
}
</script>
