<template>
    <div class="card-body">
        <table id="working-agency-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Sub Group Name</th>
                    <th >Name</th>
                    <th >Description</th>
                    <th >Code</th>
                    <th >Status</th>
                    <th >Created Date</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in suggroupList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.sub_det.name}}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.description}}</td>
                    <td>{{ item.code}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <td>{{reverseDateTime(item.created_at)}}</td>
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
            suggroupList:[],
            dt:'',
        }
    },
    methods:{
        async loadworkingagencyList(){
            this.suggroupList =  await this.loadstaffMasters('joinall__StaffSubMajorGrop__sub_group_id','ChildGroup');
        },
        showedit(data){
            this.$router.push({name:'edit_childgroup',params: {data:data}});
        },

    },
    mounted(){
        this.loadworkingagencyList();
        this.dt =  $("#working-agency-table").DataTable()
    },
    watch: {
        suggroupList(val) {
            this.applydatatable('working-agency-table');
        }
    },
}
</script>
