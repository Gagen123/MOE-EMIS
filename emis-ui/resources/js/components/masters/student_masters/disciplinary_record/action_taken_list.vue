<template>
    <div>
        <table id="action-taken-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Type of Action Taken</th>
                    <th >Status</th>
                    <th >Description</th>
                    <th >Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in actionTakenList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.Name}}</td>
                    <td>{{ item.Status==  1 ? "Active" : "Inactive" }}</td>
                    <td>{{ item.Description }}</td>
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
            actionTakenList:[], 
        }
    },
    methods:{
        loadActionTakenList(uri = 'masters/loadStudentMasters/disciplinary_action_taken'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.actionTakenList =  data.data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#action-taken-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 3000);  
        },
        showedit(data){
            this.$router.push({name:'ActionTakenEdit',params: {data:data}});
        },
    },
    mounted(){
        this.loadActionTakenList();
    },
}
</script>
