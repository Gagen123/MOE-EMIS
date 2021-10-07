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
                            <th>
                                <div v-if="approved && !published" class="form-group form-check">
                                    <input v-model="selectAll" class="form-check-input" type="checkbox" id="selected">
                                </div>
                            </th>
                            <th>Class</th>
                            <th>Result Status</th>
                            <th>Action</th> 
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr v-for="(item, index) in studentConsolidatedResultList" :key="index">
                            <td>
                                <div v-if="item.approved" class="form-group form-check ml-2">
                                     <input type="checkbox" v-model="selected_row_id" :value="item.aca_result_consolidated_id" class="form-check-input">
                                </div>
                            </td>
                            <td>{{ item.class }} {{ item.stream }} {{ item.section }}</td>
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
                                <div v-if="item.class_teacher_finalized && !item.approved"  class="btn-group btn-group-sm">
                                    <button class="btn btn-info btn-sm btn-flat text-white" to="" @click="updateStatus('approve',item)"><i class="fa fa-check-circle mr-1"></i > Approve </button>
                                </div> 
                                 <div v-if="item.approved && !item.published" class="btn-group btn-group-sm">
                                    <div class="btn btn-info btn-sm btn-flat text-white" @click="updateStatus('publish',item.aca_result_consolidated_id)"><i class="fas fa-cloud-upload-alt"></i > Publish </div>
                                </div>

                                <div class="btn-group btn-group-sm">
                                    <div class="btn btn-info btn-sm btn-flat text-white" @click="showedit('view','view_publish_result',item)"> <i class="fas fa-eye"></i > View </div>
                                </div>
                                <div v-if="item.approved && item.can_edit_approved" class="btn-group btn-group-sm">
                                    <div class="btn btn-info btn-sm btn-flat text-white" @click="showedit('edit_approved','view_publish_result',item)"> <i class="fas fa-edit"></i > Edit Approved</div> 
                                </div>
                                <div v-else class="btn-group btn-group-sm">
                                    <div class="btn btn-info btn-sm btn-flat text-white" @click="showedit('edit','view_publish_result',item)"> <i class="fas fa-edit"></i > Edit</div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                  <div v-if="approved && !published" class="card-footer mt-2">
                    <button :disabled="!selected_row_id.length" type="button" @click="updateStatus('publish','Na')" class="btn btn-flat btn-sm btn-primary" data-toggle="tooltip" data-placement="buttom" title="Please select one or more to publish."><i class="fas fa-check-circle"></i> Publish Selected</button>
                </div>
            </div>
        </div>
    </div>  
</template>
<script>

export default {
   
    data(){
        return {
            selected_row_id:[],
            aca_assmt_frequency_id:'',
            aca_term_id:'',
            terms:[],
            studentConsolidatedResultList:[],
            errorMessage:'',
            dt:'',
            published:false,
            approved:false,
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
            this.published = false
            this.approved = false
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
                            studentsConsolidatedResult[index]['class'] = item1.class
                            if(item1.stream){
                                studentsConsolidatedResult[index]['stream'] = item1.stream;
                            }
                            if(item1.section){
                                studentsConsolidatedResult[index]['section'] = item1.section;
                            }
                            studentsConsolidatedResult[index]['OrgClassStreamId'] = item1.OrgClassStreamId;
                            if(item.approved){
                                this.approved = true
                            }
                            if(item.published){
                                this.published = true
                            }
                        }
                    })
            })
            this.studentConsolidatedResultList = studentsConsolidatedResult
           
            }else{
                this.errorMessage = "This field is required"
            }  
        },
        showedit(action,route,data){
            if(action =='edit_approved'){
                Swal.fire({
                title: 'Are you sure you want approve? You cannot make changes to the result after approving.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                }).then((result) => {
                    if(result.isConfirmed) {
                        this.$router.push({name:route,params: {data:data,action:action}});
                    }
                })
            }else{
                this.$router.push({name:route,params: {data:data,action:action}});
            }
            
        },
        //Status like Approve, Publich
        updateStatus(action = "",item){
            let not_published = this.selected_row_id
            if(action == "approve" && item !='Na'){
                let approve = 1;
                Swal.fire({
                title: 'Are you sure you want approve? You cannot make changes to the result after approving.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                }).then((result) => {
                    if(result.isConfirmed) {
                        axios.post('/academics/updateStatus',{action,approve,item})
                            .then(() => {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Successfully approved.'
                                })
                            })
                            // window.location.reload()
                            .catch(function(error){
                            this.errors = error;
                        });
                    }
                })
            }else if(not_published != '' && action == "publish"){
                let publish = 1;
                Swal.fire({
                title: 'Are you sure you want publish? You cannot make changes to the result after published.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                }).then((result) => {
                    if(result.isConfirmed) {
                        axios.post('/academics/updateStatus',{action,publish,item:not_published})
                            .then(() => {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Successfully approved.'
                                })
                            })
                            // window.location.reload()
                            .catch(function(error){
                            this.errors = error;
                        });
                    }
                })
            }
        }
    },
    computed: {
        selectAll: {
            get () {
                return this.selected_row_id.length === (this.studentConsolidatedResultList.length > 0 )
            },
            set(value) {
                var selected = [];
                if (value) {
                    this.studentConsolidatedResultList.forEach(function (result) {
                        selected.push(result.aca_result_consolidated_id);
                    });
                }
                this.selected_row_id = selected;
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
                { width:10 , targets: 0},
                { width:100 , targets: 1},
            ],
        })
        $('#consolidated-result-table').on( 'click', 'tr', function () {
            $(this).toggleClass('selected');
        });
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
                    { width: 10, targets: 0},
                    { width:100 , targets: 1},
                ],
                })
                
            });
        }
    }
}
</script>