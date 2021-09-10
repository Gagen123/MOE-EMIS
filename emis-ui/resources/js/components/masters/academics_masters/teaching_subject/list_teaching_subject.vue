<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="teaching_subject_table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>SL#</th>
                            <th>Subject Name</th>
                            <th>Subject Code</th>
                            <th>Status</th>
                            <th>Action</th> 
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr v-for="(item, index) in teachingSubList" :key="index">
                            <td>{{ index + 1 }}</td>
                            <td>{{ item.name }}</td>
                            <td>{{ item.code }}</td>
                            <td>{{ item.status ==  1 ? "Active" : "Inactive" }}</td>

                            <td>
                                <div class="btn-group btn-group-sm">
                                    <div class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>  
</template>
<script>
export default {
    data(){
        return{
            teachingSubList:[],
            dt:''
        }
    },
    methods:{
        loadteachingSubjectList(uri = 'masters/loadAcademicMasters/all_teaching_subject'){
            axios.get(uri)
            .then(response => {
                this.teachingSubList =  response.data.data;
            })
            .catch(function (error){
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        showedit(data){
            this.$router.push({name:'edit_teaching_subject',params: {data:data}});
        },
    },
    mounted(){ 
        this.loadteachingSubjectList();
        this.dt =  $("#teaching_subject_table").DataTable({
            columnDefs: [
                { width: 50, targets: 0},
            ],
        })
    },
    watch: {
        teachingSubList(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#teaching_subject_table").DataTable()
            });
        }
    }
}
</script>
