<template>
    <div class="card-body">
        <table id="working-agency-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <!-- <th >Qualification Type</th> -->
                    <th >Qualification Level</th>
                    <th >Qualification</th>
                    <th >Description</th>
                    <th >Code</th>
                    <th >Status</th>
                    <th >Created Date</th>
                    <th class="pr-4 pl-4">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in qualificationList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <!-- <td>{{ item.quialificationtype.name}}</td> -->
                    <td>{{ item.quialificationlevel.name}}</td>
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
            qualificationList:[],
            dt:''
        }
    },
    methods:{
        async loadqualifictionList(){
            this.qualificationList =  await this.loadstaffMasters('Qualification','Qualification');
        },
        showedit(data){
            this.$router.push({name:'edit_staff_qualification',params: {data:data}});
        },
    },
    mounted(){
        this.loadqualifictionList();
        this.dt =  $("#working-agency-table").DataTable();
    },
    watch: {
        qualificationList(val) {
            this.applydatatable('working-agency-table');
        }
    },
}
</script>
