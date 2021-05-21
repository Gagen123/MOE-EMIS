<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="consolidated-result-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Class</th>
                            <th>Term</th>
                            <th>Result Status</th>
                            <th>Action</th> 
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr v-for="(item, index) in studentConsolidatedResultList" :key="index">
                            <td>{{ item.class }} {{item.stream}} {{item.section}}</td>
                            <td>{{ item.term }}</td>
                            <td>
                                <span v-if="item.pubblished">
                                    <strong>Published</strong> on {{ item.published_date }}
                                </span>
                                <span v-else-if="item.class_teacher_finalized">
                                    <strong>Consolidated and finalized by class teacher</strong> on {{ item.class_teacher_finalized_date }} 
                                </span>
                                <span v-else-if="item.subject_teachers_finalized">
                                    <strong>Finalized by subject teachers</strong> on {{ item.subject_teachers_finalized_date }} 
                                </span>
                                <span v-else>
                                    <strong>Under process with subject teachers</strong>
                                </span>
                            </td>
                            <td>
                                <div v-if="item.is_class_teacher && item.subject_teachers_finalized && !item.class_teacher_finalized" class="btn-group btn-group-sm">
                                    <div class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</div>
                                </div>
                                  <div v-if="item.is_class_teacher && item.class_teacher_finalized && !item.published" class="btn-group btn-group-sm">
                                    <div class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-cloud-upload-alt"></i > Publish</div>
                                </div>
                                <div class="btn-group btn-group-sm">
                                    <router-link :to="{name:'view_consolidated_result', params: {data:item}}" class="btn btn-info btn-sm btn-flat text-white"><i class="fa fa-eye"></i > View</router-link>
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
            studentConsolidatedResultList:[],
            dt:''
        }
    },
    methods:{
        async loadConsolidatedResultList(){
            try{
                let classSections = await axios.get('academics/getclassSections').then(response => { return response.data})
                let studentsConsolidatedResult = await axios.get('academics/loadConsolidatedResultList').then(response => {return response.data.data})
                studentsConsolidatedResult.forEach((item,index) => {
                    classSections.forEach(item1 => {
                        if(item.org_class_id == item1.org_class_id && (item.org_stream_id == item1.org_stream_id || (item.org_stream_id == null && item1.org_stream_id == null)) && (item.org_section_id == item1.org_section_id || (item.org_section_id == null && item1.org_section_id == null))){
                            studentsConsolidatedResult[index].result_consolidated_id = item.result_consolidated_id
                            studentsConsolidatedResult[index].class = item1.class
                            studentsConsolidatedResult[index].stream = item1.stream
                            studentsConsolidatedResult[index].section = item1.section
                        }
                    })
            })
            this.studentConsolidatedResultList = studentsConsolidatedResult
           
            }catch(e){
                if(e.toString().includes("500")){
                  $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
             }   
           },
        showedit(data){
            this.$router.push({name:'edit_consolidated_result',params: {data:data}});
        },
        unlockForEdit(Id){
            Swal.fire({
                title: 'Are you sure you want to unlock for editing?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                }).then((result) => {
                    if(result.isConfirmed) {
                        axios.post('/academics/unlockForEdit/'+Id)
                            .then(() => {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Result unlocked for editing by subject teacher.'
                                })
                                this.$router.push('/list-term-assessment');
                            })
                            .catch(function(error){
                            this.errors = error;
                        });
                    }
            })
        }
    },
    mounted(){ 
        this.loadConsolidatedResultList()   
        this.dt = $("#consolidated-result-table").DataTable({
            "order": [[ 0, "asc" ]]
        })
    },
    watch: {
        studentConsolidatedResultList(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#consolidated-result-table").DataTable()
            });
        }
    }
}
</script>