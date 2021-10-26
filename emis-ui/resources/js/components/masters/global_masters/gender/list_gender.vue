<template>
    <div class="card-body">
        <table id="dzongkhag-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Sex/Gender</th>
                    <th >Code</th>
                    <th >Status</th>
                    <th >Created At</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in genderList" :key="index">
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
            genderList:[],
            dt:'',
        }
    },
    methods:{
        loadgenderList(uri = 'masters/loadGlobalMasters/all_gender'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.genderList =  data.data.data;
            })
            .catch(function (error) {
                console.log('error:'+error);
            });
        },
        showedit(data){
            this.$router.push({name:'edit_gender',params: {data:data}});
        },
    },
    mounted(){
        this.loadgenderList();
        this.dt =  $("#dzongkhag-table").DataTable()
    },
     watch: {
        genderList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#dzongkhag-table").DataTable()
            });
        }
    },
}
</script>
