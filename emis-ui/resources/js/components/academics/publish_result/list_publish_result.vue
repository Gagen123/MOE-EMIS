<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label>Term:<span class="text-danger">*</span></label> 
                <select class="form-control form-control-sm select2" id="aca_term_id" v-model="aca_term_id" :class="{'is-invalid select2 select2-hidden-accessible': errorMessage  }" @change="loadConsolidatedResultForPublish(); remove_err('aca_term_id')">
                    <option selected="selected" value="">---Select---</option>
                    <option v-for="(item1, index1) in terms" :key="index1" :value="item1.id">
                        {{ item1.name }}
                        <span v-if="item1.dzo_name">{{item1.dzo_name}}</span>
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
                        <tr v-for="(item, index) in studentConsolidatedResultList" :key="index">
                            <td>{{ item.class_stream_section }}</td>
                            <td>
                                <span v-if="item.pubblished">
                                    <strong>Published</strong> on {{ item.published_date }}
                                </span>
                                 <span v-else-if="item.approved">
                                    <strong>Approved</strong> on {{ item.approved_date }}
                                </span>
                                <span v-else-if="item.class_teacher_finalized">
                                    <strong>Consolidated and submitted by class teacher</strong> on {{ item.class_teacher_finalized_date }} 
                                </span>
                            </td>
                            <td>
                                <span v-if="item.class_teacher_finalized && !item.approved">
                                    <div  class="btn-group btn-group-sm">
                                        <button class="btn btn-info btn-sm btn-flat text-white" to="" @click="updateStatus('approve',item.aca_result_consolidated_id)"><i class="fa fa-unlock-alt mr-1"></i > Approve </button>
                                    </div> 
                                </span>
                                 <!-- <div v-if="item.approved && !item.published" class="btn-group btn-group-sm">
                                    <div class="btn btn-info btn-sm btn-flat text-white" @click="updateStatus('approve',item.aca_result_consolidated_id)"><i class="fas fa-cloud-upload-alt"></i > Publish </div>
                                </div> -->
                                <div class="btn-group btn-group-sm">
                                    <div class="btn btn-info btn-sm btn-flat text-white" @click="showedit('view_publish_result',item)"> <i class="fas fa-eye"></i > 
                                        <span v-if="item.approved">
                                            View
                                        </span>
                                        <span v-else>
                                            View/Edit
                                        </span>
                                    </div>
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
        return {
            aca_assmt_frequency_id:'',
            aca_term_id:'',
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
        getTerms(){
            axios.get('academics/getTermsForPublish')
            .then((response)=>{
                this.terms = response.data.data
            }).catch(function (error){
                console.log(error)
            })
        },
        async loadConsolidatedResultForPublish(){
            if(this.aca_term_id !=''){
                let classSections = await axios.get('loadCommons/loadClassStreamSection/userworkingagency/NA').then(response => { return response.data})
                let studentsConsolidatedResult = await axios.get('academics/loadConsolidatedResultListForPublish/'+this.aca_term_id).then(response => {return response.data.data})
                studentsConsolidatedResult.forEach((item,index) => {
                    classSections.forEach(item1 => {
                        const stream_id = item.org_stream_id == "" ? null : item.org_stream_id
                        const section_id = item.org_section_id == "" ? null : item.org_section_id
                        const stream_id1 = item1.org_stream_id == "" ? null : item1.org_stream_id
                        const section_id1 = item1.org_section_id == "" ? null : item1.org_section_id
                        if(item.org_class_id == item1.org_class_id && (stream_id == stream_id1 || (stream_id == null && stream_id1 == null)) && (section_id == section_id1 || (section_id == null && section_id1 == null))){
                            studentsConsolidatedResult[index]['class_stream_section'] = item1.class
                            if(item1.stream){
                                studentsConsolidatedResult[index]['class_stream_section'] += (' '+ item1.stream);
                            }
                            if(item1.section){
                                studentsConsolidatedResult[index]['class_stream_section'] += (' '+ item1.section);
                            }
                            studentsConsolidatedResult[index]['OrgClassStreamId'] = item1.OrgClassStreamId;
                        }
                    })
            })
            this.studentConsolidatedResultList = studentsConsolidatedResult
           
            }else{
                this.errorMessage = "This field is required"
            }  
        },
        showedit(route,data){
            this.$router.push({name:route,params: {data:data}});
        },
        //Status like Approve, Publich
        updateStatus(action = "",Id = ""){
            let not_published = this.studentConsolidatedResultList.filter(item => item.published == 0)
            if(action == "approve"){
                let approve = 1;
                Swal.fire({
                title: 'Are you sure you want approve?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                }).then((result) => {
                    if(result.isConfirmed) {
                        axios.post('/academics/updateStatus/'+Id,{approve})
                            .then(() => {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Successfully approved.'
                                })
                            })
                            .catch(function(error){
                            this.errors = error;
                        });
                    }
                })
            }else{
                Swal.fire({
                title: 'Are you sure you want approve?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                }).then((result) => {
                    if(result.isConfirmed) {
                        axios.post('/academics/updateStatus/',not_published)
                            .then(() => {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Successfully published.'
                                })
                            })
                            .catch(function(error){
                            this.errors = error;
                        });
                    }
                })
            }
           
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
        this.dt = $("#consolidated-result-table").DataTable({
            "order": [[ 0, "asc" ]],
            "lengthChange": false,
            "searching": false,
            columnDefs: [
                { width: 100, targets: 0},
            ],
        })
        this.getTerms()

    },
    watch: {
        studentConsolidatedResultList(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#consolidated-result-table").DataTable({
                "order": [[ 0, "asc" ]],
                "lengthChange": false,
                "searching": false,
                columnDefs: [
                    { width: 100, targets: 0},
                ],
                })
                
            });
        }
    }
}
</script>