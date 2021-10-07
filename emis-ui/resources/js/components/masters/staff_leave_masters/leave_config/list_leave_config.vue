<template>
    <div class="card-body">
        <table id="working-agency-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Leave Type</th>
                    <th >Submitter</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in leaveConfigurationList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.leave_details.name }}</td>
                    <td>{{ roleList[item.submitter_role_id]}}</td>
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
            leaveConfigurationList:[],
            leavetypeList:{},
            roleList:{},
            dt:'',
        }
    },
    methods:{
        loadroleList(uri = 'masters/getroles/allActiveRoles'){
            axios.get(uri)
            .then(response =>{
                let data = response;
                for(let i=0;i<data.data.length;i++){
                    this.roleList[data.data[i].Id] = data.data[i].Name;
                }
            })
            .catch(function (error){
                console.log(error);
            });
        },
        showedit(data){
            this.$router.push({name:'edit_leave_config',params: {data:data.id}});
        },
    },
    async mounted(){
        this.leavetypeList =  await this.loadstaffMasters('active','LeaveType');
        this.loadroleList();
        this.leaveConfigurationList =  await this.loadstaffMasterconfig('all','LeaveConfiguration');
        this.dt =  $("#working-agency-table").DataTable()
    },
    watch:{
        leaveConfigurationList() {
            this.applydatatable('working-agency-table');
        }
    },
}
</script>
