<template>
    <div>
        <div class="card-body">
            <table id="working-agency-table" class="table table-bordered text-sm table-striped">
                <thead>
                    <tr>
                        <th style="width:5%">SL#</th>
                        <th style="width:20%">Name</th>
                        <th style="width:10%">Code</th>
                        <th style="width:25%">Description</th>
                        <th style="width:10%">Status</th>
                        <th style="width:20%">Created Date</th>
                        <th style="width:10%">Action</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <tr v-for="(item, index) in dataList" :key="index">
                        <td>{{ index + 1 }}</td>
                        <td>{{ item.name}}</td>
                        <td>{{ item.code}}</td>
                        <td>{{ item.description}}</td>
                        <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                        <td>{{ item.created_at }}</td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            dataList:[],
            dt:''
        }
    },
    methods:{
        showedit(data){
            this.$router.push({name:'edit_staff_responsibility',params: {data:data}});
        },
    },
    async mounted(){
        this.dataList =  await this.loadstaffMasters('all','StaResponsiblity');
        this.dt =  $("#working-agency-table").DataTable();
    },
    watch: {
        dataList(){
            this.applydatatable('working-agency-table');
        }
    },
}
</script>
