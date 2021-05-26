<template>
    <div>
        <table id="disciplinary-list-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Application No.</th>
                    <th >Type of Establishment</th>
                    <th >Date of Application</th>
                    <th >Status</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in dataList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.application_no}}</td>
                    <td>{{ item.establishment_type}}</td>
                    <td>{{ item.created_at.substring(0,10)}}</td>
                    <td>{{ item.status}}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-secondary btn-sm btn-flat text-white" @click="showview(item)"><i class="fas fa-search"></i > View</a>
                        </div>
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
        loadDataList(uri='organization/loadOrgApplications'){
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
                $("#disciplinary-list-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 3000);  
        },
        showedit(data){
            this.$router.push({name:'edit_disciplinary_record',params: {data:data}});
        },
    },
    mounted(){
        this.loadDataList();
    },
}
</script>
