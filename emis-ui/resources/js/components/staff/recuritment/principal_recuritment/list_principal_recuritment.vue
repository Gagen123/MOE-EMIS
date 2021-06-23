<template>
    <div>
        <table id="change-list-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th style="width:5%">SL#</th>
                    <th style="width:20%">Application No.</th>
                    <th style="width:20%">Application For</th>
                    <th style="width:20%">Date of Application</th>
                    <th style="width:15%">Status</th>
                    <th style="width:20%">Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in dataList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td><span class="badge badge-success">{{ item.application_no}}</span></td>
                    <td>{{ item.application_for}}</td>
                     <td>{{ reverseDate(item.created_at.substring(0,10))}}</td>
                    <td><span class="badge badge-success">{{ item.status}}</span></td>
                    <td>
                        <a href="#"  class="btn btn-success btn-sm text-white" @click="showview(item)"><i class="fas fa-eye"></i > View</a>
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
        reverseDate(dateData){
            const reverse =
            dateData.split("-").reverse().join("-");
            return reverse;
        },
        loadDataList(uri='staff/StaffApprovalController/loadPrincipalApprovalApplication/principal_recruitment'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dataList =  data.data.data;
            })
            .catch(function (error) {
                console.log('error: '+error);
            });
        },
       
        showview(data){
            this.$router.push({name:'principal_recuritment_details',params: {data:data}});
        },

    },
    mounted(){
        this.loadDataList();
        this.dt =  $("#change-list-table").DataTable();
    },
    watch:{
        dataList() {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#change-list-table").DataTable();
            });
        },
    },
}
</script>
