<template>
    <div>
        <table id="private-eccd-list-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th style="width:5%">SL#</th>
                    <th style="width:20%">Application No.</th>
                    <th style="width:20%">Establishment Type</th>
                    <th style="width:20%">Date of Application</th>
                    <th style="width:15%">Status</th>
                    <th style="width:20%">Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in dataList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.application_no}}</td>
                    <td>{{ item.establishment_type}}</td>
                    <td>{{ reverseDate(item.created_at.substring(0,10))}}</td>
                    <td>{{ item.status}}</td>
                    <td>
                        <a href="#"  class="btn btn-success btn-sm text-white" @click="showview(item)"><i class="fas fa-eye"></i > View</a>
                        <a href="#" v-if="item.status=='submitted' || item.status=='Submitted'" class="btn btn-info btn-sm text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</a>
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
            dt:''
        }
    },
    methods:{
        reverseDate(dateData){
            const reverse =
            dateData.split("-").reverse().join("-");
            return reverse;
        },
        loadDataList(uri='organization/loadOrgApplications/Private_ECCD'){
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
                
            }, 3000);  
        },
        showedit(data){
            this.$router.push({name:'edit_private_eccd',params: {id:data.id}});
        },
        showview(data){
            this.$router.push({name:'show_public_school',query: {id:data.application_no}});
        },
        
    },
    mounted(){
        this.loadDataList();
        this.dt =  $("#private-eccd-list-table").DataTable();
    },
    watch:{
        dataList() {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#private-eccd-list-table").DataTable();
            });
        },
    },
}
</script>
