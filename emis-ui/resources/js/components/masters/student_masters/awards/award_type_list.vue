<template>
    <div>
        <table id="award-type-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Student Award Type</th>
                    <th >Code</th>
                    <th >Description</th>
                    <th >Status</th>
                    <th >Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in dataList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.Name}}</td>
                    <td>{{ item.Code }}</td>
                    <td>{{ item.Description }}</td>
                    <td>{{ item.Status==  1 ? "Active" : "Inactive" }}</td>
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
        }
    },
    methods:{
        loadDataList(uri = 'masters/loadStudentMasters/StudentAwardType'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dataList =  data.data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                }
            });
        },
        showedit(data){
            this.$router.push({name:'award_type_edit',params: {data:data}});
        },
    },
    mounted(){
        this.loadDataList();
    },
}
</script>
