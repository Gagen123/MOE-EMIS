<template>
    <div class="card">
        <div class="card-body pb-1 mb-0 pt-1 mt-0 overflow-auto">
            <table id="data-table" class="table table-bordered text-sm table-striped">
                <thead>
                    <tr>
                        <th >SL#</th>
                        <th >Feedback Category</th>
                        <th >Status</th>
                        <th >Created Date</th>
                        <th >Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in dataList" :key="index">
                        <td>{{ index + 1 }}</td>
                        <td>{{ item.name}}</td>
                        <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                        <td>{{reverseDateTime(item.created_at)}}</td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            dataList:[],dt:'',
            moduleArray:{},
        }
    },
    methods:{
        loadcategoryList(uri = 'staff/staffLeadershipSerivcesController/loadData/allData_FeedbackCategory'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dataList =  data.data.data;
            })
            .catch(function (error){
                console.log(error);
            });
        },
        showedit(data){
            this.$router.push({name:'edit_feedback_category',params: {data:data}});
        },
    },
    mounted(){
        this.loadcategoryList();
        this.dt =  $("#data-table").DataTable()
    },
    watch: {
        dataList() {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#data-table").DataTable()
            });
        }
    },
}
</script>
