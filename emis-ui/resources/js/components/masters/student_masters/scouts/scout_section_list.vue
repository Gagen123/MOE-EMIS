<template>
    <div class="card-body overflow-auto">
        <table id="working-agency-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th style="width:5%">SL#</th>
                    <th style="width:20%">Scout</th>
                    <th style="width:10%">Code</th>
                    <th style="width:25%">Description</th>
                    <th style="width:10%">Status</th>
                    <th style="width:20%">Created Date</th>
                    <th style="width:10%">Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in data_list" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.Name}}</td>
                    <td>{{ item.Code}}</td>
                    <td>{{ item.Description}}</td>
                    <td>{{ item.Status==  1 ? "Active" : "Inactive" }}</td>
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
            data_list:[],
            dt:'',
        }
    },
    methods:{
        async loadworkingagencyList(){
            this.data_list =  await this.loadStudentMasters('all','CeaScoutSection');
        },
        showedit(data){
              this.$router.push({name:'scout_section_edit',params: {data:data}});
        },
        
    },
    mounted(){
        this.loadworkingagencyList();
        this.dt =  $("#working-agency-table").DataTable();
    },
    watch: {
        data_list(val) {
            this.applydatatable('working-agency-table');
        }
    },
}
</script>

