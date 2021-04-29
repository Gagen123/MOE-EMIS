<template>
    <div>
        <table id="list-action-plan" class="table table-bordered table-striped table-head-fixed">
            <thead>
                <tr>

                     <th >No.</th>
                     <th >Program</th>
                     <th >Activity</th>
                     <th >Description</th>
                     <th >From</th>
                     <th >To</th>
                     <th >Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in dataList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.program_name}}</td>
                    <td>{{ item.Title}}</td>
                    <td>{{ item.Description}}</td>
                    <td>{{ item.FromDate}}</td>
                    <td>{{ item.ToDate}}</td>
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
            id:'2',
            dataList:[], 
        }
    },
    methods:{
        loadDataList(uri='students/loadProgramActionPlan/'+this.id){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dataList =  data.data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#list-action-plan").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 3000);  
        },
        showedit(data){
            this.$router.push({name:'program_action_plan_edit',params: {data:data}});
        },
    },
    mounted(){
        this.loadDataList();
    },
}
</script>