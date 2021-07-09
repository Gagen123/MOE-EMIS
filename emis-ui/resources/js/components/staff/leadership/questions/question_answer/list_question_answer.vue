<template>
    <div class="card">
        <div class="card-body pb-1 mb-0 pt-1 mt-0 overflow-auto">
            <table id="data-table" class="table table-bordered text-sm table-striped">
                <thead>
                    <tr>
                        <th >SL#</th>
                        <th >Category</th>
                        <th >Question</th>
                        <th >Status</th>
                        <th >Created Date</th>
                        <th class="pl-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in dataList" :key="index">
                        <td>{{ index + 1 }}</td>
                        <td>{{ categoryList[item.category_type_id]}}</td>
                        <td>{{ item.name}}</td>
                        <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                        <td>{{ item.created_at }}</td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > View & Edit</a>
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
            dataList:[],
            dt:'',
            categoryList:{},
        }
    },
    methods:{
        loadcategoryList(uri = 'staff/staffLeadershipSerivcesController/loadData/allData_FeedbackCategory'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.categoryList[data[i].id] = data[i].name;
                }
            })
            .catch(function (error){
                console.log(error);
            });
        },
        loadquestionList(uri = 'staff/staffLeadershipSerivcesController/loadData/allData_Question'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.dataList=data;
            })
            .catch(function (error){
                console.log(error);
            });
        },

        showedit(data){
            this.$router.push({name:'edit_question_answer',params: {data:data.id}});
        },
    },
    mounted(){
        this.loadcategoryList();
        this.loadquestionList();
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
