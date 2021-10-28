<template>
    <div>
        <div class="form-group row">
            <div class="pl-4 pt-4 col-sm">
                <table id="front-student-progress-report-table" class="table table-sm table-bordered table-striped">
                    <thead>
                         <tr>
                            <th colspan="3" class="fw-bolder" style="font-size:15px;">Personal Characteristics</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr v-for="(characteristic,i) in personal_characteristics" :key="i+'*'+i">
                            <td colspan="3"><strong>{{characteristic.rating}}:</strong> {{characteristic.description}}</td>
                        <tr>
                            <td ><strong>Sl.#</strong></td>
                            <td ><strong>Qualities</strong></td>
                            <td ><strong>Level</strong></td>
                        </tr>
                        <tr v-for="(item,index) in others_result" :key="index">
                            <td >{{index + 1 }}</td>
                            <td >{{item.assessment_area}}</td>
                            <td >{{item.score_description}}</td>
                        </tr>
                         <tr>
                            <td colspan="3"><strong>Special Awards/Responsibilities:</strong><br/> {{student_details.special_award}} </td>
                        </tr>
                        <tr>
                            <td colspan="3"><strong>General Comments:</strong><br/> {{student_details.general_comment}}</td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <br/><strong>Signature of the Class Teacher:</strong><br/><br/>
                                <strong>Name of the Class Teacher:</strong> {{org_and_class_details.stf_class_tecaher_name}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="pr-4 pt-4 col-sm">
                <table id="front1-student-progress-report-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <td colspan="8" rowspan="10" class="text-center" style="font-size:20px;">
                                <strong>Royal Government of Bhutan <br>
                                Ministry of Education <br></strong>
                                <img src="../../../../../public/img/MoE_Logo.png" alt="Logo"> <br>
                                <span style="font-size:12px;"><strong>STUDENT PROGRESS REPORT</strong></span> <br>
                                <span style="font-size:13px;"><strong>Year:</strong> {{ new Date().getFullYear() }}</span>
                            </td>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr>
                            <td colspan="3">
                                <br/>
                                <strong>Name of the School:</strong> {{org_and_class_details.school_name}} <br/><br/>
                                <strong>Gewog:</strong> {{org_and_class_details.gewog}} <br/><br/>
                                <strong>Dzongkhag:</strong> {{org_and_class_details.dzongkhag}}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <br/>
                                <strong>Name of the Student:</strong> {{student_details.name}}<br/><br/>
                                <span style="display: inline-block; width:220px;"><strong>Class:</strong> {{org_and_class_details.class}} </span><strong> Section: </strong> {{org_and_class_details.section}} <br/><br/>
                                <span style="display: inline-block; width:220px;"><strong>Student Code:</strong> {{student_details.student_code}}</span> <strong> CID No.: </strong> {{student_details.cid}} <br/><br/>
                                <strong>Date of Birth:</strong> {{student_details.dob}} 
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <strong>Promoted to/Detained in:</strong><span v-if="student_details.promoted"> {{student_details.promoted}}</span> 
                            </td>
                        </tr>
                         <tr>
                            <td colspan="3">
                                <br/><br/>
                                {{org_and_class_details.stf_principal_name}}
                                <br/>
                                <span style="display: inline-block; width:220px; height:28px;"><strong>Name of the Principal</strong></span><strong> Signature </strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <p style="page-break-after: always;">&nbsp;</p>
        <p style="page-break-before: always;">&nbsp;</p>
        <div class="row">
            <div class="col-sm px-4">
                <student-progress-report-cfa v-if="transcript_format==1" :id="id" :aca_result_id="aca_result_id"></student-progress-report-cfa>
                <student-progress-report-csa v-else :id="id" :aca_result_id="aca_result_id"></student-progress-report-csa>
            </div>
        </div>

    </div>  
</template>
<script>
import StudentProgressReportCfa from './student_progress_report_cfa.vue';
import StudentProgressReportCsa from './student_progress_report_csa.vue';
export default {
    components: {
        'student-progress-report-cfa': StudentProgressReportCfa,
        'student-progress-report-csa': StudentProgressReportCsa
    },
    data(){
        return{
            others_result:[],
            student_details:{},
            org_and_class_details:{},
            personal_characteristics:[],
            id:'',
            aca_result_id:'',
            transcript_format:0
        }
    },
    methods:{
        getProgressReport(){
            axios.get('academics/getProgressReport/'+this.id+'/'+this.aca_result_id).then(response => {
                this.others_result = response.data.data.others_result
                this.org_and_class_details = response.data.data.org_and_class_details
                this.student_details = response.data.data.student_details               
                this.personal_characteristics = response.data.data.personal_characteristics               
            })
        },
   
    },
    mounted(){ 
        this.getProgressReport()
    },
    created(){
        this.id=this.$route.params.data.id;
        this.aca_result_id=this.$route.params.data.aca_result_id;
        this.transcript_format=this.$route.params.transcript_format;
    },
}
</script>
<style scoped>
.col-sm{
    padding-right: 0px;
    padding-left: 0px;
}
</style>
 