<template>
    <div class="card-body">
        <table id="working-agency-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Marital Status</th>
                    <th >Code</th>
                    <th >Description</th>
                    <th >Status</th>
                    <th >Created Date</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in maritalList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.code}}</td>
                    <td>{{ item.description}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <td>{{reverseDateTime(item.created_at)}}</td>
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
            maritalList:[],
            dt:'',
        }
    },
    methods:{
        async loaddataList(){
            this.maritalList =  await this.loadstaffMasters('all','MaritalStatus');
        },
        showedit(data){
            this.$router.push({name:'edit_marital_status',params: {data:data}});
        },
    },
    mounted(){
        this.loaddataList();
        this.dt =  $("#working-agency-table").DataTable()
    },
    watch: {
        maritalList() {
            this.applydatatable('working-agency-table');
        }
    },
}
</script>
