<template>
    <div>
        <div class="form-group row">
           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label>Class:<span class="text-danger">*</span></label> 
                <select class="form-control form-control-sm select2" id="class_stream_section_id" v-model="class_stream_section_id" :class="{'is-invalid select2 select2-hidden-accessible': errorMessage  }" @change="loadConsolidatedResultList(); remove_err('class_stream_section_id')">
                    <option selected="selected" value="">---Select---</option>
                    <option selected v-for="(item, index) in Classes" :key="index" :value="[item.org_class_id,item.org_stream_id,item.org_section_id,item.class_stream_section]">
                        {{ item.class_stream_section }}
                    </option>
                </select> 
                <span id= "errorId" class="text-danger">{{ errorMessage }}</span>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-4">
                <table id="consolidated-result-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Term</th>
                            <th>Result Status</th>
                            <th>Action</th> 
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr v-for="(item, index) in studentConsolidatedResultList" :key="index">
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
                                    <router-link :to="{name:'edit_consolidated_result', params: {data:item}}" class="btn btn-info btn-sm btn-flat text-white"><i class="fas fa-edit"></i > Edit</router-link>
                                </div>
                                <div v-if="item.is_class_teacher && item.class_teacher_finalized && !item.published" class="btn-group btn-group-sm">
                                    <div class="btn btn-info btn-sm btn-flat text-white" @click="unlockForEditForConsolidated(item.aca_assmt_term_id)"><i class="fa fa-unlock-alt mr-1"></i > Undo Finalize </div>
                                </div>
                                 <div v-if="item.is_class_teacher && item.class_teacher_finalized && !item.published" class="btn-group btn-group-sm">
                                    <div class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-cloud-upload-alt"></i > Publish</div>
                                </div>
                                <div class="btn-group btn-group-sm">
                                    <router-link :to="{name:'view_consolidated_result', params: {data:item,classes:class_stream_section_id}}" class="btn btn-info btn-sm btn-flat text-white"><i class="fa fa-eye"></i > View</router-link>
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
            Classes:[],
            terms:[],
            studentConsolidatedResultList:[],
            class_stream_section_id:'',
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
       getClassses(){
           axios.get('loadCommons/loadClassStreamSection/userworkingagency/NA')
           .then(response => {
                let formData = []
                let classList = response.data
                classList.forEach(item => {
                    formData['org_class_id'] = item.org_class_id
                    formData['org_stream_id'] = item.org_stream_id
                    formData['org_section_id'] = item.org_section_id
                    if(item.stream && item.section){
                        formData['class_stream_section'] = item.class+' '+item.stream+' '+item.section
                    }else if(item.stream){
                        formData['class_stream_section'] = item.class+' '+item.stream
                    }else if(item.section){
                        formData['class_stream_section'] = item.class+' '+item.section
                    }else{
                        formData['class_stream_section'] = item.class
                    }
                    const object = {...formData}
                    this.Classes.push(object)
                });
            })
        }, 
        async loadConsolidatedResultList(){
            if($('#class_stream_section_id').val()===''){
                this.errorMessage = "This field is required"
            }
            let uri = 'academics/loadConsolidatedResultList'
            uri += ('?org_class_id='+this.class_stream_section_id[0])
           if(this.class_stream_section_id[1] !== null){
                    uri += ('&org_stream_id='+this.class_stream_section_id[1])
            }
            if(this.class_stream_section_id[2] !== null){
                uri += ('&org_section_id='+this.class_stream_section_id[2])
            }
            try{
                let classSections = await axios.get('loadCommons/loadClassStreamSection/userworkingagency/NA').then(response => { return response.data})
                let studentsConsolidatedResult = await axios.get(uri).then(response => {return response.data.data})
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
           
            }catch(e){
                if(e.toString().includes("500")){
                  $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
             }   
           },
        showedit(data){
            this.$router.push({name:'edit_consolidated_result',params: {data:data}});
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
        this.getClassses()
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