<template>
    <div class="card">
        <div class="card-body pb-1 mb-0 pt-1 mt-0 overflow-auto">
            <table id="data-table" class="table table-bordered text-sm table-striped">
                <thead>
                    <tr>
                        <th style="width:5%">SL#</th>
                        <th style="width:10%">Leadership</th>
                        <th style="width:10%">Category</th>
                        <th style="width:40%">Question</th>
                        <th style="width:10%">Status</th>
                        <th style="width:15%">Created Date</th>
                        <th style="width:10%" class="pl-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in dataList" :key="index">
                        <td>{{ index + 1 }}</td>
                        <td>{{ leadershipe_list[item.leadership_type_id]}}</td>
                        <td>{{ categoryList[item.category_type_id]}}</td>
                        <td>{{ item.name}}</td>
                        <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                        <td>{{ item.created_at }}</td>
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
            dataList:[],
            dt:'',
            categoryList:{},
            leadershipe_list:{},
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
        leadershipelist(){
            let uri = 'staff/staffLeadershipSerivcesController/loadData/activeData_LeadershipType';
            axios.get(uri)
            .then(response =>{
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.leadershipe_list[data[i].id] = data[i].name;
                }
            })
            .catch(function (error){
                console.log("Error:"+error)
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
        this.leadershipelist();
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
