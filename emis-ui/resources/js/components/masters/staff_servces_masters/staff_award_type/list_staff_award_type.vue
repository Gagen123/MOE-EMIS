<template>
    <div class="card-body">
        <table id="working-agency-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th style="width:5%">SL#</th>
                    <th style="width:15%">Name</th>
                    <th style="width:10%">Code</th>
                    <th style="width:20%">Description</th>
                    <th style="width:10%">Status</th>
                    <th style="width:10%">Type</th>
                    <th style="width:20%">Created Date</th>
                    <th style="width:10%">Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in subjectList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <!-- <td>{{ item.category.name}}</td> -->
                    <td>{{ item.name}}</td>
                    <td>{{ item.code}}</td>
                    <td>{{ item.description}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <td>{{ item.type}}</td>
                    <td>{{ item.created_at }}</td>
                    <td v-if="item.type=='MOE'">
                        <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</a>
                    </td>
                    <td v-else></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    data(){
        return{
            subjectList:[],
            dt:'',
        }
    },
    methods:{
        showedit(data){
            this.$router.push({name:'edit_staff_award_type',params: {data:data}});
        },
    },
    async mounted(){
        this.subjectList =  await this.loadstaffMasters('all','StaffAwardType');
        this.dt =  $("#working-agency-table").DataTable();
    },
    watch: {
        subjectList(){
            this.applydatatable('working-agency-table');
        }
    },
}
</script>
