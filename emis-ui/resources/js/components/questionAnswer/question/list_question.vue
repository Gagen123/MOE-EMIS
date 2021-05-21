<template>
    <div>
        <!-- filteration is required by Module, Service and category  -->
        <table id="working-agency-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Module</th>
                    <th >Service</th>
                    <th >Category</th>
                    <th >Question</th>
                    <th >Answer Type</th>
                    <th >Code</th>
                    <th >Status</th>
                    <th >Created Date</th>
                    <th >Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in questionListt" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ moduleArray[item.service.parent_id] }}</td>
                    <td>{{ item.service.name}}</td>
                    <td>{{ item.category.name}}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.answer_type}}</td>
                    <td>{{ item.code}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <td>{{ item.created_at }}</td>
                    <td>
                        <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</a>
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
            moduleArray:{},
            questionListt:[],dt:''
        }
    },
    methods:{ 
        loadQuestionList(uri = 'questionAnswers/loadQuestionaries/all_2with_service_category_Question'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.questionListt =  data.data.data;
            })
            .catch(function (error){
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="9" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        loadModuleList(uri = 'questionAnswers/loadQuestionaries/allData_Module'){
            axios.get(uri)
            .then(response => {
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.moduleArray[data.data.data[i].id] = data.data.data[i].name; 
                }
            })
            .catch(function (error){
                console.log('error:' +error);
            });
        },
        showedit(data){
            this.$router.push({name:'edit_question',params: {data:data}});
        },
    },
    created(){
        this.loadModuleList();
    },
    mounted(){ 
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        }); 
        this.loadQuestionList();
        this.dt =  $("#working-agency-table").DataTable()
    },
    watch: {
        questionListt() {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#working-agency-table").DataTable()
            });
        }
    },
}
</script>
