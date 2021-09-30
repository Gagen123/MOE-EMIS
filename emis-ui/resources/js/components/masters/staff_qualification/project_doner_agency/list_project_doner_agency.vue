<template>
    <div class="card-body">
        <table id="working-agency-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Doner Agency</th>
                    <th >Project Doner Agency</th>
                    <th >Description</th>
                    <th >Code</th>
                    <th >Status</th>
                    <th >Created Date</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in qualificationTypeList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.sub_det.name}}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.description}}</td>
                    <td>{{ item.code}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <td>{{ item.created_at }}</td>
                    <td>
                        <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</a>
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
            qualificationTypeList:[],
            dt:'',
        }
    },
    methods:{
        async loadqualificationtype(){
            this.qualificationTypeList =  await this.loadstaffMasters('joinall__DonerAgency__doner_agency_id','ProjectDonerAgency');
        },
        showedit(data){
            this.$router.push({name:'edit_project_doner_agency',params: {data:data}});
        },
    },
    mounted(){
        this.loadqualificationtype();
        this.dt =  $("#working-agency-table").DataTable()
    },
    watch: {
        qualificationTypeList(val) {
            this.applydatatable('working-agency-table');
        }
    },
}
</script>
