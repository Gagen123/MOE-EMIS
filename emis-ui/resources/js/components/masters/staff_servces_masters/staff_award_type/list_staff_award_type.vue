<template>
    <div class="card-body">
        <table id="working-agency-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <!-- <th >Award Category</th> -->
                    <th >Award Type</th>
                    <th >Description</th>
                    <th >Code</th>
                    <th >Status</th>
                    <th >Created Date</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in subjectList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <!-- <td>{{ item.category.name}}</td> -->
                    <td>{{ item.name}}</td>
                    <td>{{ item.description}}</td>
                    <td>{{ item.code}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
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
            subjectList:[],
            dt:'',
        }
    },
    methods:{
        async loadsubjectList(){
            this.qualificationTypeList =  await this.loadstaffMasters('all','DonerAgency');
        },
       loadsubjectList(uri = 'masters/loadStaffMasters/all_staff_award_type_List'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.subjectList =  data.data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="7" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        showedit(data){
            this.$router.push({name:'edit_staff_award_type',params: {data:data}});
        },
    },
    mounted(){
        this.loadsubjectList();
        this.dt =  $("#working-agency-table").DataTable()
    },
    watch: {
        subjectList(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#working-agency-table").DataTable()
            });
        }
    },
}
</script>
