<template>
    <div>
        <table id="clubs-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Program Name</th>
                    <th >Code</th>
                    <th >Description</th>
                    <th >Status</th>
                    <th >Created At</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in programNameList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.Name}}</td>
                    <td>{{ item.Code}}</td>
                    <td>{{ item.Description}}</td>
                    <td>{{ item.Status==  1 ? "Active" : "Inactive" }}</td>
                    <td>{{ item.created_at }}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</a>
                        </div>
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
            dt:'',
            programNameList:[],
        }
    },
    methods:{
        //we use club_name and not CeaProgram as we need to pull only clubs
        loadProgramNameList(uri = 'masters/loadStudentMasters/club_name'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.programNameList =  data.data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        showedit(data){
            this.$router.push({name:'ProgramNameEdit',params: {data:data}});
        },
    },
    mounted(){
        this.loadProgramNameList();
        this.dt =  $("#clubs-table").DataTable()
    },
    watch: {
        programNameList() {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#clubs-table").DataTable()
            });
        }
    },
}
</script>
