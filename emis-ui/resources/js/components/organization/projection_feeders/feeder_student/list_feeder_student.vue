<template>
    <div>
        <table id="award-list-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Student</th>
                    <th >Parent School</th>
                    <th >Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in dataList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{item.StdName}} ({{item.StdCode}})</td>
                    <td>{{item.parent_school_name}}</td>
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
            dataList:[],
        }
    },
    methods:{
        loadDataList(uri='organization/loadFeederStudents'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dataList =  data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        showedit(data){
            this.$router.push({name:'edit_feeder_student',params: {data:data}});
        },
    },
    mounted(){
        this.loadDataList();
        this.dt =  $("#award-list-table").DataTable()
    },
      watch: {
        dataList(){
            this.dt.destroy();
            this.$nextTick(() => {
            this.dt =  $("#award-list-table").DataTable()
            });
        }
    },
}
</script>
