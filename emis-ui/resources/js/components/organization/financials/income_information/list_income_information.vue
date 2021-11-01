<template>
    <div>
        <table id="income-list-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Income Facilities</th>
                    <th >Amount generated</th>
                    <th >Date</th>
                    <th >Remarks</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in dataList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.amountGenerated}}</td>
                    <td>{{ reverseDate1(item.date)}}</td>
                    <td>{{ item.remarks}}</td>
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
        loadIncomeList(uri='organization/loadIncomeInformation/'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dataList =  data.data;
            })
            .catch(function (error) {
                console.log(error);
            });
            setTimeout(function(){
                $("#award-list-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                });
            }, 3000);
        },
        showedit(data){
            this.$router.push({name:'edit_income_information',params: {data:data}});
        },
    },
    mounted(){
        this.loadIncomeList();
         this.dt =  $("#finacial-list-table").DataTable();
    },
      watch:{
        dataList() {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#income-list-table").DataTable();
            });
        },
    },
}
</script>
