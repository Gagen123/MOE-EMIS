<template>
    <div>
        <form @submit.prevent="save" class="bootbox-form" id="subjectGroup">
            <div class="ml-2 row form-group">
                <div class="mr-3">
                    <strong>Class: </strong> {{ class_name}} {{stream_name}}
                </div>
                <div class="mr-3">
                    <strong>Term: </strong> {{term_name}}
                </div>
                <div class="mr-3">
                    <strong>Subject: </strong> {{sub_name}}
                </div>
            </div>      
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table id="class_subject_assessment_area-create-table" class="table table-sm table-bordered table-striped">
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
                                            {{item.assessment_area}}
                                        </label>
                                    </div>
                                </td>
                                <td v-if="input_type==1">
                                    <div v-if="classSubAssessmentList[index].input_type==null" class="input-group">
                                        <input v-model="classSubAssessmentList[index].weightage" type="number" step="0.1" max="100" min="0" class="form-control text-right" aria-label="weightage">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </td>
                                 <td>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                       <input class="form-control text-right" v-model="classSubAssessmentList[index].display_order" type="number" max="100" min="0"> 
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
            class_name:'',
            stream_name:'',
            term_name:'',
            sub_name:'',
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
            axios.post('/masters/saveclassSubjectAssessment', {aca_assmt_term_id:this.aca_assmt_term_id,aca_sub_id:this.aca_sub_id, org_class_id:this.org_class_id,org_stream_id:this.org_stream_id,data:selectedclassSubAssessment})
                 .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details updated successfully'
                    })
                    this.$router.push('/list-subject-assessment-area');
                })
                .catch(function (error){
                this.errors = response.error;
            });
        },
	 
    },
    mounted(){ 
        this.loadclassSubjectAssessment();
        this.dt =  $("#class_subject_assessment_area-create-table").DataTable()
        
    },
    created() {
        this.org_class_id=this.$route.params.data.org_class_id;
        this.org_stream_id=this.$route.params.data.org_stream_id;
        this.aca_sub_id=this.$route.params.data.aca_sub_id;
        this.aca_assmt_term_id = this.$route.params.data.aca_assmt_term_id
        this.class_name=this.$route.params.data.class;
        this.stream_name=this.$route.params.data.stream;
        this.sub_name = this.$route.params.data.sub_name;
        this.term_name = this.$route.params.data.term_name;
        this.input_type = this.$route.params.data.input_type;
    },
    watch: {
        classSubAssessmentList(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#class_subject_assessment_area-create-table").DataTable()
            });
        }
    }
    
}
</script>