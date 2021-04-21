<template>
<div>
    <table id="studenthealth-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Health Name Type</th>
                    <th>Status</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in studenthealthList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="viewStudentHealthList(item)"><i class="fas fa-edit"></i ></a>
                            <!-- <a href="#" @click="deleteLeaveRequest(item.id)" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a> -->
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
            studenthealthList:[],
        }
    },

    methods:{
        loadStudentHealthList(uri = 'masters/loadStudentHealth'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.studenthealthList =  data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#studenthealth-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 300);  
        },
        viewStudentHealthList(data){
            data.action='edit';
            this.$router.push({name:'StudentHealthEdit',params: {data:data}});
        },
    },
    mounted(){
        this.loadStudentHealthList();
    },
}
</script>