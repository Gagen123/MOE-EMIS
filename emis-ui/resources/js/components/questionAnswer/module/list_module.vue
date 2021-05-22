<template>
    <div class="card">
        <div class="card-body pb-1 mb-0 pt-1 mt-0 overflow-auto">
            <table id="working-agency-table" class="table table-bordered text-sm table-striped">
                <thead>
                    <tr> 
                        <th >SL#</th>
                        <th >Moduless</th>
                        <th >Code</th>
                        <th >Status</th>
                        <th >Created Date</th>
                        <th >Action</th> 
                    </tr>
                </thead>
                <tbody id="tbody">
                    <tr v-for="(item, index) in moduleList" :key="index">
                        <td>{{ index + 1 }}</td>
                        <td>{{ item.name}}</td>
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
    </div>      
</template>
<script>
export default {
    data(){
        return{
            moduleList:[],
            dt:'',
        }
    },
    methods:{
        loadModuleList(uri = 'questionAnswers/loadQuestionaries/allData_Module'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.moduleList =  data.data.data;
            })
            .catch(function (error){
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        
        showedit(data){
            this.$router.push({name:'edit_module',params: {data:data}});
        },
    },
    mounted(){ 
        this.loadModuleList();
        this.dt =  $("#working-agency-table").DataTable()
    },
    watch: {
        moduleList() {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#working-agency-table").DataTable()
            });
        }
    },
}
</script>
