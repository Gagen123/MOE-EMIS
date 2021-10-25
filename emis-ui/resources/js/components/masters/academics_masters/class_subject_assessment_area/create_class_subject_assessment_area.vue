<template>
    <div>
        <form @submit.prevent="save" class="bootbox-form" id="subjectGroup">
            <div class="ml-0 row form-group">
                <div class="mr-3">
                    <strong>Class: </strong> {{ class_stream }} 
                </div>
                <div class="mr-3">
                    <strong>Term: </strong> {{term_name}} 
                    <span v-if="sub_dzo_name && term_dzo_name">( {{term_dzo_name}} )</span>
                </div>
                <div class="mr-3">
                    <strong>Subject: </strong> {{sub_name}}
                    <span v-if="sub_dzo_name">( {{sub_dzo_name}} )</span>
                </div>
            </div>      
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table id="class_subject_assessment_area-create-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Assessment Area</th>
                                <th v-if="input_type==1">Weightage (%)</th>
                                <th>Display Order</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                             <tr v-for="(item, index) in classSubAssessmentList" :key="index">
                                <td>
                                    <div class="form-check">
                                        <input v-model="classSubAssessmentList[index].assmt_area_selected" :value="item.aca_assmt_area_id" class="form-check-input" type="checkbox" id="assessment_area">
                                        <label class="form-check-label" for="assessment_area">
                                            <span style="display:none;">{{item.display_order}}</span>
                                          {{item.assessment_area}} <span v-if="item.dzo_name">( {{item.dzo_name}} )</span>
                                        </label>
                                    </div>
                                </td>
                                <td v-if="input_type==1">
                                    <div v-if="classSubAssessmentList[index].input_type==1" class="input-group">
                                        <input :disabled="!classSubAssessmentList[index].assmt_area_selected" v-model="classSubAssessmentList[index].weightage" type="number" step="0.1" max="100" min="0" class="form-control text-right" required aria-label="weightage">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </td>
                                 <td>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                       <input class="form-control text-right" :disabled="!classSubAssessmentList[index].assmt_area_selected" v-model="classSubAssessmentList[index].display_order" type="number" max="100" min="0" required> 
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="reset" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-redo"></i> Reset</button>
                <button type="submit" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
    </div>     
</template>
<script>
export default {
    data() {
        return {
            errors:'',
            org_class_id:'',
            org_stream_id:'',
            aca_sub_id:'',
            aca_assmt_term_id:'',
            class_stream:'',
            term_name:'',
            sub_name:'',
            sub_dzo_name:'',
            term_dzo_name:'',
            input_type:'',
            classSubAssessmentList:[],
            dt:''
        }
    },
    methods: {
         remove_err(field_id){
            if($('#' + field_id).val()!=""){
                $('#' + field_id).removeClass('is-invalid')
            }
        },
         loadclassSubjectAssessment(){
            let uri = 'masters/loadclassSubjectAssessment/'+this.aca_assmt_term_id+'/'+this.aca_sub_id+'/'+this.org_class_id 
            if(this.org_stream_id !== null){
                uri += ('/'+this.org_stream_id)
            }
            axios.get(uri)
            .then(response => {
                this.classSubAssessmentList =  response.data.data;

            })
            .catch(function (error){
                console.log('Error..... '+error)
            });
        },
        save(){
            let selectedclassSubAssessment = this.classSubAssessmentList.filter(classSubAssessment=>classSubAssessment.assmt_area_selected)
            axios.post('/masters/saveclassSubjectAssessment', {aca_assmt_term_id:this.aca_assmt_term_id,aca_sub_id:this.aca_sub_id,class_stream:this.class_stream, org_class_id:this.org_class_id,org_stream_id:this.org_stream_id,data:selectedclassSubAssessment})
                 .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details updated successfully'
                    })
                    this.$router.push('/list-subject-assessment-area');
                })
                .catch(function (error){
                    if(error.response.status === 422){
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'All fields are required for a selected Assessment Area.',
                        })
                    }
            });
        },
	 
    },
    mounted(){ 
        this.loadclassSubjectAssessment();
        this.dt =  $("#class_subject_assessment_area-create-table").DataTable({
            "ordering": false,
        })
        
    },
    created() {
        this.org_class_id=this.$route.params.data.org_class_id;
        this.org_stream_id=this.$route.params.data.org_stream_id;
        this.aca_sub_id=this.$route.params.data.aca_sub_id;
        this.aca_assmt_term_id = this.$route.params.data.aca_assmt_term_id;
        this.class_stream = this.$route.params.data.class_stream;
        this.sub_name = this.$route.params.data.sub_name;
        this.sub_dzo_name = this.$route.params.data.sub_dzo_name;
        this.term_dzo_name = this.$route.params.data.term_dzo_name;
        this.term_name = this.$route.params.data.term_name;
        this.term_name = this.$route.params.data.term_name;
        this.input_type = this.$route.params.data.input_type;
    },
    watch: {
        classSubAssessmentList(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#class_subject_assessment_area-create-table").DataTable({
                    "ordering": false,
                })
            });
        }
    }
    
}
</script>