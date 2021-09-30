<template>
    <div class="card-body">
        <table id="working-agency-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Institute</th>
                    <th >Description</th>
                    <th >Code</th>
                    <th >Status</th>
                    <th >Created Date</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in qualificationTypeList" :key="index">
                    <td>{{ index + 1 }}</td>
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
            qualificationTypeList:[],
            dt:'',
        }
    },
    methods:{
        loadqualificationtype(uri = 'staff/loadStaffMasters/all/Institute'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.qualificationTypeList =  data.data.data;
            })
            .catch(function (error) {
                console.log('error:'+error);
            });
        },
        showedit(data){
            this.$router.push({name:'edit_qualification_institute',params: {data:data}});
        },
    },
    mounted(){
        this.loadqualificationtype();
        this.dt =  $("#working-agency-table").DataTable()
    },
    watch: {
        qualificationTypeList(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#working-agency-table").DataTable();
                $("#working-agency-table >tbody >tr >td ").addClass('p-1');
                $(".paginate_button").addClass('small');
            });
        }
    },
}
</script>
