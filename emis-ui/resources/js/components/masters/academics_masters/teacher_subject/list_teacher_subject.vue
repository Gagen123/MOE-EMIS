<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="teacher-subject-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Techer's Subject</th>
                            <th>Code</th>
                            <th>Is Special Educational Needs (SEN) </th>
                            <th>Status</th>
                            <th>Action</th> 
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr v-for="(item, index) in mainSubject" :key="index">
                            <td>{{ item.name }}</td>
                            <td>{{ item.code }}</td>
                             <td>{{ item.is_special_educational_needs ==  1 ? "Yes" : "No" }}</td>
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
            mainSubject:[],
            dt:''
        }
    },
    methods:{
        loadMainSubjects(uri = 'masters/loadAcademicMasters/all_teacher_subject'){
            axios.get(uri)
            .then(response => {
                this.mainSubject = response.data.data
            })
            .catch(function (error){
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        showedit(data){
            this.$router.push({name:'edit_teacher_subject_master',params: {data:data}});
        },
    },
    mounted(){ 
        this.loadMainSubjects();
        this.dt =  $("#teacher-subject-table").DataTable({
             columnDefs: [
                { width: 200, targets: 0},
            ],
        })
    },
    watch: {
        mainSubject(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#teacher-subject-table").DataTable()
            });
        }
    }
}
</script>
