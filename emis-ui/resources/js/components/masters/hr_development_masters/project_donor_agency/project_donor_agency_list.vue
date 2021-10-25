<template>
    <div class="card-body">
        <table id="dzongkhag-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Donor Agency</th>
                    <th >Project of Donor</th>
                    <th >Code</th>
                    <th >Description</th>
                    <th >Status</th>
                    <th >Created At</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in projectOfDonorList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td><span v-if="item.donor!=null">{{ item.donor.name}}</span></td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.code}}</td>
                    <td>{{ item.description}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <td>{{ reverseDateTime(item.created_at) }}</td>
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
            projectOfDonorList:[],dt:[],
        }
    },
    methods:{
        showedit(data){
            this.$router.push({name:'edit_project_donor_agency',params: {data:data}});
        },
    },
    async mounted(){
        this.projectOfDonorList =  await this.loadstaffMasters('allwith__donor','hr_development_masters___ProjectDonerAgency');
        this.dt =  $("#dzongkhag-table").DataTable();
    },
    watch:{
        projectOfDonorList(){
            this.applydatatable('dzongkhag-table');
        }
    },
}
</script>
