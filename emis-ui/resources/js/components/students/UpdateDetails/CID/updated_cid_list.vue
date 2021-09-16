<template>
    <div>
        <table id="updatedcid-list-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Student Name</th>
                    <th >Student Code</th>
                    <th >CID</th>
                    <th >Previous CID</th>
                    <th >Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in dataList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.Name}}</td>
                    <td>{{ item.student_code}}</td>
                    <td>{{ item.CidNo}}</td>
                    <td>{{ item.previousValue}}</td>
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
        loadDataList(uri='students/loadStudentUpdatesList/cid'){
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
                $("#updatedcid-list-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 3000);  
        },
        loadActiveSeverityList(uri="masters/loadActiveStudentMasters/OffenceSeverity"){
            axios.get(uri)
            .then(response => {
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.severityList[data.data.data[i].id] = data.data.data[i].name; 
                }
                
            })
            
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        showedit(data){
            this.$router.push({name:'edit_updated_cid',params: {data:data}});
        },
    },
    mounted(){
        this.loadActiveSeverityList();
        this.loadDataList();
    },
}
</script>
