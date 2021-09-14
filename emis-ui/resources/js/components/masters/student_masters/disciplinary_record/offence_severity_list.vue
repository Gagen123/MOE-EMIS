<template>
    <div>
        <table id="dzongkhag-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Offence Severity</th>
                    <th >Code</th>
                    <th >Description</th>
                    <th >Status</th>
                    <th >Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in offenceSeverityList" :key="index">
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
            offenceSeverityList:[], 
        }
    },
    methods:{
        loadOffenceSeverityList(uri = 'masters/loadStudentMasters/OffenceSeverity'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.offenceSeverityList =  data.data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#offence-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 3000);  
        },
        showedit(data){
            this.$router.push({name:'OffenceSeverityEdit',params: {data:data}});
        },
    },
    mounted(){
        this.loadOffenceSeverityList();
    },
}
</script>
