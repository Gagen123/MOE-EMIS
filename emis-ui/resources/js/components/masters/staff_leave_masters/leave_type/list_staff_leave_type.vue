<template>
    <div class="card-body">
        <table id="working-agency-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Leave Category</th>
                    <th >Leave Type</th>
                    <th >Carry Forward</th>
                    <th >No.</th>
                    <th >Code</th>
                    <th >Status</th>
                    <th >Created Date</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in dataList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.category}}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.carryforward==  1 ? "Yes" : "No" }}</td>
                    <td>{{ item.no_days}}</td>
                    <td>{{ item.code}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <td>{{ reverseDateTime(item.created_at) }}</td>
                    <td>
                        <span v-if="item.category=='MOE'">
                            <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</a>
                        </span>
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
            dataList:[],
            dt:'',
        }
    },
    methods:{
        showedit(data){
            this.$router.push({name:'edit_leave_type',params: {data:data}});
        },
    },
    async mounted(){
        this.dt =  $("#working-agency-table").DataTable();
        this.dataList =  await this.loadstaffMasters('all','LeaveType');
    },
    watch: {
        dataList(){
            this.applydatatable('working-agency-table');
        }
    },
}
</script>
