<template>
    <div>
        <div class="form-group row">
           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label>Assessment Frequency:<span class="text-danger">*</span></label> 
                <select v-model="aca_assmt_frequency_id" class="form-control select2" :class="{'is-invalid select2 select2-hidden-accessible': errorMessage  }" @change="getTerms(); remove_err('aca_assmt_frequency_id')"> 
                    <option selected="selected" value="">---Select---</option>
                    <option v-for="(item, index) in assesmentFrequencyList" :key="index" :value="item.id">{{ item.name }}</option>
                </select>
                <span id= "errorId" class="text-anger">{{ errorMessage }}</span>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label>Term:<span class="text-danger">*</span></label> 
                <select class="form-control form-control-sm select2" id="aca_term_id" v-model="aca_term_id" :class="{'is-invalid select2 select2-hidden-accessible': errorMessage  }" @change="loadConsolidatedResultForPublish(); remove_err('aca_term_id')">
                    <option selected="selected" value="">---Select---</option>
                    <option selected v-for="(item1, index1) in terms" :key="index1" :value="item1.id">
                        {{ item.class_stream_section }}
                    </option>
                </select> 
                <span id= "errorId" class="text-danger">{{ errorMessage }}</span>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-4">
                <table id="consolidated-result-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Class</th>
                            <th>Result Status</th>
                            <th>Action</th> 
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <!-- <tr v-for="(item, index) in studentConsolidatedResultList" :key="index">
                            <td>{{ item.term }}</td>
                            <td>
                                <span v-if="item.pubblished">
                                    <strong>Published</strong> on {{ item.published_date }}
                                </span>
                                <span v-else-if="item.class_teacher_finalized">
                                    <strong>Consolidated and finalized by class teacher</strong> on {{ item.class_teacher_finalized_date }} 
                                </span>
                                <span v-else-if="item.aca_assmt_term_id && item.subject_teachers_finalized">
                                    <strong>Finalized by subject teachers</strong> on {{ item.subject_teachers_finalized_date }} 
                                </span>
                                <span v-else-if="!item.aca_assmt_term_id">
                                    <strong>Under process with class teacher</strong>  
                                </span>
                                <span v-else>
                                    <strong>Under process with subject teachers</strong>
                                </span>
                            </td>
                            <td>
                                <div v-if="item.is_class_teacher && item.subject_teachers_finalized && !item.class_teacher_finalized" class="btn-group btn-group-sm">
                                    <div class="btn btn-info btn-sm btn-flat text-white" @click="showedit('edit_consolidated_result',item)"> <i class="fas fa-edit"></i > Edit</div>
                                </div>
                                <div v-if="item.is_class_teacher && item.class_teacher_finalized && !item.published" class="btn-group btn-group-sm">
                                    <div class="btn btn-info btn-sm btn-flat text-white" @click="unlockForEditForConsolidated(item.aca_assmt_term_id)"><i class="fa fa-unlock-alt mr-1"></i > Undo Finalize </div>
                                </div>
                                 <div v-if="item.is_class_teacher && item.class_teacher_finalized && !item.published" class="btn-group btn-group-sm">
                                    <div class="btn btn-info btn-sm btn-flat text-white" @click="showedit('',item)"><i class="fas fa-cloud-upload-alt"></i > Publish</div>
                                </div>
                                <div class="btn-group btn-group-sm">
                                    <div class="btn btn-info btn-sm btn-flat text-white" @click="showedit('view_consolidated_result',item)"> <i class="fas fa-eye"></i > View</div>
                                </div>
                            </td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>  
</template>
<script>
export default {
    data(){
        return {
            aca_assmt_frequency_id:'',
            aca_term_id:'',
            Classes:[],
            terms:[],
            studentConsolidatedResultList:[],
            errorMessage:'',
            dt:''
        }
    },
    methods:{
        remove_err(id){
            if($('#' + id).val()!=""){
               $('#'+id).removeClass('is-invalid select2');
               $('#'+id).addClass('select2');
               $('#errorId').remove()
            }
        },
        getAssessmentFrequencyList(uri = 'masters/loadAcademicMasters/all_assessment_frequency'){
            axios.get(uri)
            .then(response =>{
                this.assesmentFrequencyList = response.data.data;
            })
            .catch(function (error){
                 if(error.toString().includes("500")){
                  $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            })
        },
        getTerms(){
            if(this.aca_assmt_frequency_id != ""){
                axios.get('academics/getTermsByFrequencyId/'+this.aca_assmt_frequency_id)
                .then((response)=>{
                    this.terms = response.data.data
                }).catch(function (error){
                    console.log(error)
                })
            }else{
                this.errorMessage = "This field is required";
            }
        },
        async loadConsolidatedResultForPublish(){
            if(this.aca_term_id !=''){
                let classSections = await axios.get('loadCommons/loadClassStreamSection/userworkingagency/NA').then(response => { return response.data})
                let studentsConsolidatedResult = await axios.get('academics/loadConsolidatedResultForPublish/'+this.aca_term_id).then(response => {return response.data.data})
                studentsConsolidatedResult.forEach((item,index) => {
                    classSections.forEach(item1 => {
                        if(item.org_class_id == item1.org_class_id && (item.org_stream_id == item1.org_stream_id || ((item.org_stream_id == null || item.org_stream_id == "") && (item1.org_stream_id == null || item.org_stream_id == ""))) && (item.org_section_id == item1.org_section_id || ((item.org_section_id == null || item.org_section_id == "") && (item1.org_section_id == null || item.org_section_id == "")))){
                            studentsConsolidatedResult[index].result_consolidated_id = item.result_consolidated_id
                            if(item1.stream && item1.section){
                                 studentsConsolidatedResult[index]['class_stream_section'] = item1.class+' '+item1.stream+' '+item1.section
                            }else if(item1.stream){
                                studentsConsolidatedResult[index]['class_stream_section'] = item1.class+' '+item1.stream
                            }else if(item1.section){
                                studentsConsolidatedResult[index]['class_stream_section'] = item1.class+' '+item1.section
                            }
                            else{
                                studentsConsolidatedResult[index]['class_stream_section'] = item1.class
                            }
                            studentsConsolidatedResult[index].OrgClassStreamId = item1.OrgClassStreamId
                        }
                    })
            })
            this.studentConsolidatedResultList = studentsConsolidatedResult
           
            }else{
                this.errorMessage = "This field is required"
            }  
        },
        showedit(route,data){
            this.$router.push({name:route,params: {data:data,class_stream_section:this.class_stream_section_id}});
        },
        unlockForEditForConsolidated (Id){
            Swal.fire({
                title: 'Are you sure you want to unlock for editing?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                }).then((result) => {
                    if(result.isConfirmed) {
                        axios.post('/academics/unlockForEditForConsolidated/'+Id)
                            .then(() => {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Result unlocked for editing by class teacher.'
                                })
                                this.$router.push('/list-consolidated-result');
                            })
                            .catch(function(error){
                            this.errors = error;
                        });
                    }
            })
        }
    },
    mounted(){ 
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').select2().
        on("select2:select", e => {
            const event = new Event("change", { bubbles: true, cancelable: true });
            e.params.data.element.parentElement.dispatchEvent(event);
        })
        .on("select2:unselect", e => {
        const event = new Event("change", { bubbles: true, cancelable: true });
        e.params.data.element.parentElement.dispatchEvent(event);
        });
        this.getAssessmentFrequencyList()
        this.dt = $("#consolidated-result-table").DataTable({
            "order": [[ 0, "asc" ]],
            "lengthChange": false,
            "searching": false,
        })
    },
    watch: {
        studentConsolidatedResultList(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#consolidated-result-table").DataTable({
                "order": [[ 0, "asc" ]],
                "lengthChange": false,
                "searching": false,
                })
            });
        }
    }
}
</script>