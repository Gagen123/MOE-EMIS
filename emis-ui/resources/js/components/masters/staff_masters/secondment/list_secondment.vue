<template>
    <div class="card-body">
        <table id="working-agency-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Name</th>
                    <th >Description</th>
                    <th >Code</th>
                    <th >Status</th>
                    <th >Created Date</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in dataList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.code}}</td>
                    <td>{{ item.description}}</td>
                    <td>{{ item.status ==  1 ? "Active" : "Inactive" }}</td>
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
            dataList:[],
            dt:'',
        }
    },
    methods:{
        async loaddataList(){
            this.dataList =  await this.loadstaffMasters('all','SecondmentMaster');
        },
        showedit(data){
            this.$router.push({name:'edit_secondment',params: {data:data}});
        },

    },
    mounted(){
        this.loaddataList();
        this.dt =  $("#working-agency-table").DataTable()
    },
    watch: {
        dataList() {
            this.applydatatable('working-agency-table');
        }
    },
}
</script>
