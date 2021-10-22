<template>
    <div>
        <div class="card-body">
            <table id="working-agency-table" class="table table-bordered text-sm table-striped">
                <thead>
                    <tr>
                        <th style="width:5%">SL#</th>
                        <th style="width:15%">Name</th>
                        <th style="width:10%">Code</th>
                        <th style="width:20%">Description</th>
                        <th style="width:15%">Type</th>
                        <th style="width:10%">Status</th>
                        <th style="width:15%">Created Date</th>
                        <th style="width:10%">Action</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <tr v-for="(item, index) in dataList" :key="index">
                        <td>{{ index + 1 }}</td>
                        <td>{{ item.name}}</td>
                        <td>{{ item.code}}</td>
                        <td>{{ item.description}}</td>
                        <td>{{ item.type}}</td>
                        <td>{{ item.status ==  1 ? "Active" : "Inactive" }}</td>
                        <td>{{ reverseDateTime(item.created_at) }}</td>
                        <td>
                            <span v-if="item.type=='MOE'">
                                <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</a>
                            </span>
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
            dt:'',
        }
    },
    methods:{
        showedit(data){
            this.$router.push({name:'edit_category_category',params: {data:data}});
        },
    },
    async mounted(){
        this.dt =  $("#working-agency-table").DataTable();
        this.dataList =  await this.loadstaffMasters('all','CaseCategory');
    },
    watch: {
        dataList(){
            this.applydatatable('working-agency-table');
        }
    },
}
</script>
