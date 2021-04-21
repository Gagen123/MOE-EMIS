<template>
    <div>
        <table id="dzongkhag-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Donor Agency</th>
                    <th >Project of Donor</th>
                    <th >Code</th>
                    <th >Status</th>
                    <th >Created At</th>
                    <th >Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in projectOfDonorList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.donor.name}}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.code}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <td>{{ item.created_at }}</td>
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
            projectOfDonorList:[], 
        }
    },
    methods:{
        loadprojectOfDonorList(uri = 'masters/loadHrDevelopmentMastersData/all_project_donor_list'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.projectOfDonorList =  data.data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="7" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#dzongkhag-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 3000);  
        },
        showedit(data){ 
            this.$router.push({name:'edit_project_donor_agency',params: {data:data}});
        },
    },
    mounted(){
        this.loadprojectOfDonorList();
    },
}
</script>
