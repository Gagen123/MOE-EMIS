<template>
    <div class="card">
        <div class="card-body pb-1 mb-0 pt-1 mt-0 overflow-auto">
            <table id="data-table" class="table table-bordered text-sm table-striped">
                <thead>
                    <tr>
                        <th >SL#</th>
                        <th >Module</th>
                        <th >Category Type</th>
                        <th >Status</th>
                        <th >Created Date</th>
                        <th >Action</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <tr v-for="(item, index) in dataList" :key="index">
                        <td>{{ index + 1 }}</td>
                        <td>{{ moduleArray[item.module_id]}}</td>
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
            dataList:[],dt:'',
            moduleArray:{},
        }
    },
    methods:{
        loadModuleList(uri = 'questionAnswerController/loadQuestionaries/allData_Module'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.moduleList =  data.data.data;
                for(let i=0;i<data.data.data.length;i++){
                    this.moduleArray[data.data.data[i].id] = data.data.data[i].name;
                }
            })
            .catch(function (error){
                console.log(error);
            });
        },

        loadcategoryTypeList(uri = 'questionAnswerController/loadQuestionaries/allData_CategoryType'){
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
            this.$router.push({name:'edit_category_type',params: {data:data}});
        },
    },
    mounted(){
        this.loadModuleList();
        this.loadcategoryTypeList();
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
