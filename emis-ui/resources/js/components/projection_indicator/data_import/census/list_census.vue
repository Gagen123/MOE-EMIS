<template>
    <div>
        <table id="studentlist_table" class="table table-bordered table-striped table-head-fixed">
            <thead>
                <tr>
                     <th >Sl#</th>
                     <th >Age</th>
                     <th >Year</th>
                     <th >Male </th>
                     <th >Female </th>
                     <th >Total</th>
                     <th >Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in dataList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.age}}</td>
                    <td>{{ item.year}}</td>
                    <td>{{ item.male}}</td>
                    <td>{{ item.female}}</td>
                    <td>{{ parseInt(item.male)+parseInt(item.female)}}</td>
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
        loadDataList(uri="students/ExternalDataImport/loadInstitues/all/CensusModel"){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.dataList =  data;
            })
            .catch(function (error) {
                console.log("Error:"+error)
            });
        },
        showedit(data){
            this.$router.push({name:'edit_census',params: {data:data}});
        },
    },
    mounted(){
        this.loadDataList();
        this.dt =  $("#studentlist_table").DataTable()
    },
    watch: {
        dataList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#studentlist_table").DataTable()
            });
        }
    },
}
</script>
