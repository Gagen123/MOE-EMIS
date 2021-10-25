<template>
    <div class="card-body">
        <table id="mother_tongue-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Mother Tongue</th>
                    <th >Code</th>
                    <th >Status</th>
                    <th >Created At</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in mothertongueList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.code}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <td>{{reverseDateTime(item.created_at)}}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</a>
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
            mothertongueList:[],
            dt:'',
        }
    },
    methods:{
        loadmothertongueList(uri = 'masters/loadGlobalMasters/all_mother_tongue'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.mothertongueList =  data.data.data;
            })
            .catch(function (error) {
                console.log('error: '+error);
            });
        },
        showedit(data){
            this.$router.push({name:'edit_mother_tongue',params: {data:data}});
        },
    },
    mounted(){
        this.loadmothertongueList();
        this.dt =  $("#mother_tongue-table").DataTable();
    },
     watch: {
        mothertongueList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#mother_tongue-table").DataTable()
            });
        }
    },
}
</script>
