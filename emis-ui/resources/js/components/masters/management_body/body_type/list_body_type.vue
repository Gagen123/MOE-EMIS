<template>
    <div class="card-body">
        <table id="working-agency-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Management Body Type</th>
                    <th >Code</th>
                    <th >Status</th>
                    <th >Created Date</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in bodyTypeList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.code}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <td>{{ reverseDateTime(item.created_at) }}</td>
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
            bodyTypeList:[],
            dt:'',
        }
    },
    methods:{
        showedit(data){
            this.$router.push({name:'edit_body_type',params: {data:data}});
        },
    },
    async mounted(){
      //  alert('dd');
        this.bodyTypeList =  await this.loadstaffMasters('all','MgmntBodyType');
        this.dt =  $("#working-agency-table").DataTable();
    },
    watch: {
        bodyTypeList(){
            this.applydatatable('working-agency-table');
        }
    },
}
</script>
