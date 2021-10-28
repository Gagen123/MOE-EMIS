<template>
    <div>
        <table id="back-student-progress-report-table" class="table table-sm table-bordered table-striped">
            <thead>
                    <tr>
                        
                    <th :colspan="(no_subjects)*2" class="fw-bolder text-center" style="font-size:15px;"> Academic Transcript (Class {{org_and_class_details.class}})</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr>
                    <td :colspan="(no_subjects)*2">
                        <span style="display: inline-block; width:130px;"><strong>Exceeding  (རྨད་བྱུང་།):</strong></span> 
                            The student demonstrates competencies beyond expectations and targets
                        </td>
                </tr>
                    <tr>
                    <td :colspan="(no_subjects)*2">
                        <span style="display: inline-block; width:130px;"><strong>Meeting (རེ་མཐུན།):</strong></span>
                            The student demonstrates competencies that meet the expected competencies
                    </td>
                </tr>
                    <tr>
                    <td :colspan="(no_subjects)*2">
                        <span style="display: inline-block; width:130px;"><strong>Approaching (ཉེ་འབྱོར།):</strong> </span>
                            The student demonstrates competencies that are towards the expected competencies
                    </td>
                </tr>
                    <tr>
                    <td :colspan="(no_subjects)*2"><span style="display: inline-block; width:130px;">
                        <strong>Beginning (གཞི་འཛུགས།):</strong> </span> 
                        The student demonstrates competencies that are below expectations
                    </td>
                </tr>
                <tr>
                    <template v-for="(item,index) in academic_result">
                        <td :key="index">
                                <strong v-if="item.sub_dzo">{{item.sub_dzo}} ({{index}})</strong>
                                <strong v-else>{{index}}</strong>
                        </td>
                        <td :key="index+1">
                            <strong v-if="item.sub_dzo">གནས་ཚད།</strong>
                            <strong v-else>Level</strong>
                        </td>
                    </template>
                </tr>
                <tr v-for="i in maxNoOfAssessmentAreas" :key="i+'_'+i">
                    <template v-for="(item,index) in academic_result">
                        <td :key="index+'_'">
                            {{item.scores[i-1] ? item.scores[i-1].assessment_area : ""}}
                        </td>
                        <td :key="index+'_'+1">
                            {{item.scores[i-1] ? item.scores[i-1].score_description : ""}}
                        </td>
                    </template>
                </tr>
                <tr v-for="j in maxNoOfAssmntAreasDescriptive" :key="j+j">
                    <template v-for="(item1,index1) in academic_result">
                        <td colspan="2" :key="index1+'_'+3" >
                            <div v-for="(descriptive,i) in academic_result_descriptive" :key="i">
                                <span v-if="i == index1">
                                    <strong>
                                        <span v-if="descriptive.assmnt_area_dzo != null">{{descriptive.assmnt_area_dzo}}</span>
                                        {{descriptive.scores[j-1].assessment_area}}
                                    </strong><br/>
                                    {{descriptive.scores[j-1].score_description}}<br/><br/>
                                </span> 
                            </div>
                        </td>
                    </template>
                </tr>
                <tr>
                    <td colspan="2" v-for="(item2,index2) in academic_result" :key="index2+'-'+1">
                        <br/> <br/><br/><br/>  
                        {{item2.sub_teacher}} <br/>                   
                        <strong>Name & Signature of Subject Teacher</strong>                    
                    </td>
                </tr>
                <tr>
                    <template v-for="(item3,index3) in non_academic_result">
                        <td :key="index3">
                                <strong>{{item3.subject}}</strong>
                        </td>
                        <td :key="index3+'_'+2">
                            {{item3.score_description}}
                        </td>
                    </template>
                </tr>
            </tbody>
        </table>
    </div>  
</template>
<script>
export default {
    data(){
        return{
            subCategNonAcademics:[],
            others_result:[],
            student_details:{},
            org_and_class_details:{},
            no_subjects:0,
            academic_result:[],
            non_academic_result:[],
            academic_result_descriptive:[],
            maxNoOfAssessmentAreas:0,
            maxNoOfAssmntAreasDescriptive:0,
            id:'',
            dt:''
        }
    },
    methods:{
        getProgressReport(){
            axios.get('academics/getProgressReport/'+this.id+'/'+this.aca_result_id).then(response => {
                this.others_result = response.data.data.others_result
                this.org_and_class_details = response.data.data.org_and_class_details
                this.student_details = response.data.data.student_details
                this.academic_result = response.data.data.academic_result
                this.non_academic_result = response.data.data.non_academic_result
                this.academic_result_descriptive = response.data.data.academic_result_descriptive
                this.no_subjects = Object.keys(this.academic_result).length
                this.no_subjects = Object.keys(this.academic_result).length
                this.maxNoOfAssessmentAreas = response.data.data.maxNoOfAssessmentAreas
                this.maxNoOfAssmntAreasDescriptive = response.data.data.maxNoOfAssmntAreasDescriptive
                this.maxNoOfAssmntAreasDescriptive = response.data.data.maxNoOfAssmntAreasDescriptive
               
            })
        },
   
    },
    mounted(){ 
        this.getProgressReport()
        // this.dt =  $("#final-result-table").DataTable();
    },
    created(){
            this.id=this.$route.params.data.id;
            this.aca_result_id=this.$route.params.data.aca_result_id;
    },
    // watch: {
    //     subCategNonAcademics(val) {
    //         this.dt.destroy();
    //         this.$nextTick(() => {
    //             this.dt = $("#final-result-table").DataTable()
    //         });
    //     }
    // }
}
</script>
<style scoped>
.col-sm{
    padding-right: 0px;
    padding-left: 0px;
}
</style>
 