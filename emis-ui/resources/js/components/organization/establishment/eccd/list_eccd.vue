<template>
    <div>
        <table id="private-school-list-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th style="width:5%">SL#</th>
                    <th style="width:20%">Application No.</th>
                    <th style="width:15%">ECCD Type</th>
                    <th style="width:15%">Date of Application</th>
                    <th style="width:25%">Status</th>
                    <th style="width:20%">Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in dataList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.application_no}}</td>
                    <td>{{ item.establishment_type}}</td>
                    <td>{{ reverseDate1(item.created_at.substring(0,10))}}</td>
                    <td>{{ item.status}}</td>
                    <td>
                        <a href="#"  class="btn btn-success btn-sm text-white" @click="showview(item)"><i class="fas fa-eye"></i > View</a>
                        <!-- <a href="#" v-if="item.status=='Submitted' || item.status=='Notified For Tentative Date' || item.status=='Submitted'" class="btn btn-info btn-sm text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</a> -->
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
        loadDataList(uri='organizationApproval/loadOrgApplications/eccd'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dataList =  data.data.data;
            })
            .catch(function (error) {
                console.log('error: '+error);
            });
        },
        showedit(data){
            this.$router.push({name:'edit_eccd',params: {id:data.id}});
        },
        showview(data){
            this.$router.push({name:'show_eccd',params: {data:data}});
        },
    },
    mounted(){
        this.loadDataList();
        this.dt =  $("#private-school-list-table").DataTable();
    },
    watch:{
        dataList() {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#private-school-list-table").DataTable();
            });
        },
    },
}
</script>
