<template>
    <div>
        <table id="finacial-list-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Type</th>
                    <th >Amount</th>
                    <th >Date</th>
                    <th >Action</th>
                  
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in dataList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.amount}}</td>
                    <td>{{ item.date}}</td>
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
            org_id:'',
            dataList:[], 
        }
    },
    methods:{
        loadDataList(uri='organization/loadFinancialInformation/'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.dataList =  data;
            })
            .catch(function (error) {
               console.log(error);
            });
        },
        showedit(data){
            this.$router.push({name:'edit_financial_info',params: {data:data}});
        },
    },
    mounted(){
        this.loadDataList();
        this.dt =  $("#finacial-list-table").DataTable();
    },
       watch:{
        dataList() {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#finacial-list-table").DataTable();
            });
        },
    },
}
</script>
