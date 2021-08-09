<template>
    <div class="card-body">
        <table id="working-agency-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Qualification Description</th>
                    <th >Status</th>
                    <th >Code</th>
                    <th >Description</th>
                    <th >Created Date</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in qualificationList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.code}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                     <td>{{ item.description}}</td>
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
            qualificationList:[],
            dt:'',
        }
    },
    methods:{
        loaddataList(uri = 'staff/loadStaffMasters/all/QualificationDescription'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.qualificationList =  data.data.data;
            })
            .catch(function (error){
                console.log('error: '+error);
            });
        },
        showedit(data){
            this.$router.push({name:'edit_qualification_description',params: {data:data}});
        },
    },
    mounted(){
        this.loaddataList();
        this.dt =  $("#working-agency-table").DataTable()
    },
    watch: {
        qualificationList() {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#working-agency-table").DataTable()
            });
        }
    },
}
</script>
