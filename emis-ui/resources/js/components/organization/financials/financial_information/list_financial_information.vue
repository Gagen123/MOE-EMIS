<template>
    <div>
        <table id="award-list-table" class="table table-bordered text-sm table-striped">
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
                    <td>{{ typeArry[item.incomeFacilitiesId]}}</td>
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
            typeArry:{},
            dataList:[], 
        }
    },
    methods:{
        loadtypeList(){
            axios.get('masters/organizationMasterController/loadFinacialtype')
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.typeArry[data[i].id] = data[i].name; 
                }
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });

        },
        loadDataList(uri='organization/loadFinancialInformation/'){
            axios.get(uri)
            .then(response => {
                
                let data = response;
                this.dataList =  data.data;

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
        this.loadtypeList();
        this.loadDataList();
        
    },
}
</script>
