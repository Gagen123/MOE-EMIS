<template>
    <div>
        <table id="program-support-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Supporter (Agency etc)</th>
                    <th >Code</th>
                    <th >Description</th>
                    <th >Status</th>
                    <th >Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in programSupportList" :key="index">
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
            programSupportList:[], 
        }
    },
    methods:{
        loadProgramSupportList(uri = 'masters/loadStudentMasters/CeaProgramSupporter'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.programSupportList = data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#program-support-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 3000);  
        },
        showedit(data){
            this.$router.push({name:'ProgramSupportEdit',params: {data:data}});
        },
    },
    mounted(){
        this.loadProgramSupportList();
    },
}
</script>
