<template>
    <div class="card-body">
        <table id="working-agency-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Qualification Level</th>
                    <th >description</th>
                    <th >Status</th>
                    <th >Code</th>
                    <th >Created Date</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in qualificationLevelList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.description }}</td>
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
            qualificationLevelList:[],
            dt:'',
        }
    },
    methods:{
        async loadqualificationLevelList(){
            this.qualificationLevelList =  await this.loadstaffMasters('all','QualificationLevel');
        },
        showedit(data){
            this.$router.push({name:'edit_qualification_level',params: {data:data}});
        },
    },
    mounted(){
        this.loadqualificationLevelList();
        this.dt =  $("#working-agency-table").DataTable()
    },
    watch: {
        qualificationLevelList(val) {
            this.applydatatable('working-agency-table');
        }
    },
}
</script>
