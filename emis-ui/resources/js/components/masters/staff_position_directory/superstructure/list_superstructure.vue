<template>
    <div class="card-body">
        <table id="working-agency-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Name</th>
                    <th >Description</th>
                    <th >Status</th>
                    <th >Code</th>
                    <th >Created Date</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in data_list" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.description}}</td>
                    <td>{{ item.code}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <td>{{ item.created_at }}</td>
                    <td>
                        <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</a>
                        <!-- <a v-if="item.status==  1" href="#" @click="changestatus(item.id,'0')" class="btn btn-danger btn-sm btn-flat text-white"><i class="fas fa-times"></i> Deactivate</a>
                        <a v-if="item.status==  0" href="#" @click="changestatus(item.id,'1')" class="btn btn-primary btn-sm btn-flat text-white"><i class="fas fa-check"></i> Activate</a> -->
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
            data_list:[],
            dt:'',
        }
    },
    methods:{
        loadworkingagencyList(uri = 'staff/loadStaffMasters/all/SuperStructure'){
        // loadworkingagencyList(uri = 'masters/loadStaffMasters/all_staff_major_data_list'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.data_list =  data.data.data;
            })
            .catch(function (error) {
                console.log('error: '+error);
            });
        },
        showedit(data){
            this.$router.push({name:'edit_superstructure',params: {data:data}});
        },

    },
    mounted(){
        this.loadworkingagencyList();
        this.dt =  $("#working-agency-table").DataTable();
    },
    watch: {
        data_list(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#working-agency-table").DataTable()
            });
        }
    },
}
</script>
