<template>
    <div>
        <table id="award-list-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Feeder School</th>
                    <th >Class(VI-VII)</th>
                    <th >Class (VIII-IX)</th>
                    <th >Class (X-XI)</th>
                    <th >Parent School</th>
                    <th >Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in dataList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{SchoolList[item.feederschool]}}</td>
                    <td><span class="badge badge-success">{{ item.classix==  1 ? "Checked" : "Unchecked" }}</span></td>
                    <td><span class="badge badge-success">{{ item.classvii==  1 ? "Checked ": "Unchecked"}}</span></td>
                    <td><span class="badge badge-success">{{ item.classxi==  1 ? "Checked" : "UnChecked"}}</span></td>
                    <td>{{SchoolList[item.parentschool]}}</td>
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
            dataList:[], 
            SchoolList:{},
        }
    },
    methods:{
        loadDataList(uri='organization/loadFeeders'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dataList =  data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        loadOrgList(uri ='staff/transfer/LoadSchoolByDzoId/userdzongkhagwise/NA'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                // alert(JSON.stringify(data));
                 for(let i=0;i<data.length;i++){
                    this.SchoolList[data[i].id] =data[i].name;
                }
            })
            .catch(function (error) {
                console.log("Error:"+error)
            });
        },
        showedit(data){
            this.$router.push({name:'edit_feeder',params: {data:data}});
        },
    },
    mounted(){
        this.loadOrgList();
        this.loadDataList();
        this.dt =  $("#award-list-table").DataTable()
    },
      watch: {
        dataList(){
            this.dt.destroy();
            this.$nextTick(() => {
            this.dt =  $("#award-list-table").DataTable()
            });
        }
    },
}
</script>
