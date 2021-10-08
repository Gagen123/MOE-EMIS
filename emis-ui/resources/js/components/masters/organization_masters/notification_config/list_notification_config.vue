<template>
    <div class="card-body">
        <table id="working-agency-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Leave Type</th>
                    <th >Submitter</th>
                    <th>Created At </th>
                    <th >Action</th> 
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in leaveConfigurationList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ leavetypeList[item.leave_type_id]}}</td>
                    <td>{{ roleList[item.submitter_role_id]}}</td>
                    <td>{{ item.created_at}}</td>
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
        loadleaveTypeList(uri = 'masters/loadStaffMasters/all_leave_type_list'){
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.leavetypeList =  data.data.data;
                for(let i=0;i<data.data.data.length;i++){
                    this.leavetypeList[data.data.data[i].id] = data.data.data[i].name; 
                }
            })
            .catch(function (error){
                console.log(error);
            });
        },
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
        loadcoursemodeList(uri = 'masters/loadAllLeaveConfigMasters'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.leaveConfigurationList =  data.data.data;
            })
            .catch(function (error){
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        showedit(data){
            this.$router.push({name:'edit_leave_config',params: {data:data.id}});
        },
    },
    mounted(){ 
        this.loadleaveTypeList();
        this.loadroleList();
        this.loadcoursemodeList();
        this.dt =  $("#working-agency-table").DataTable()
    },
    watch:{
        leaveConfigurationList() {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#working-agency-table").DataTable()
            });
        }
    },
}
</script>
