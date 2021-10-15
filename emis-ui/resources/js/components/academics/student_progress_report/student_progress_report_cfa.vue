<template>
    <div>
        <div class="form-group row">
            <div class="col-sm">
                <table id="front-student-progress-report-table" class="table table-sm table-bordered table-striped">
                    <thead>
                         <tr>
                            <th colspan="3" class="fw-bolder" style="font-size:15px;">Personal Characteristics</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr>
                            <td colspan="3"><strong>Outstanding:</strong> Personal characteristics are beyond expectations and targets</td>
                        </tr>
                          <tr>
                            <td colspan="3"><strong>Very Good:</strong> Personal characteristics meet expectations </td>
                        </tr>
                          <tr>
                            <td colspan="3"><strong>Good:</strong> Personal characteristics are towards the expectations </td>
                        </tr>
                          <tr>
                            <td colspan="3"><strong>Need Improvement:</strong> Personal characteristics are below expectations </td>
                        </tr>
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
            <div class="col-sm">
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
                                <br/>
                                <span v-if="student_details.promoted"><strong>Result:</strong> {{student_details.promoted}}</span> 
                            </td>
                        </tr>
                         <tr>
                            <td colspan="3">
                                <br/><br/>
                                {{org_and_class_details.stf_principal_name}}
                                <br/>
                                <span style="display: inline-block; width:220px; height:30px;"><strong>Name of the Principal</strong></span><strong> Signature </strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <p style="page-break-after: always;">&nbsp;</p>
        <p style="page-break-before: always;">&nbsp;</p>
        <div class="row">
            <div class="col-sm">
                <table id="back-student-progress-report-table" class="table table-sm table-bordered table-striped">
                    <thead>
                         <tr>
                            <th :colspan="(subjects.length)*2" class="fw-bolder text-center" style="font-size:15px;"> Academic Transcript (Class {{org_and_class_details.class}})</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr>
                            <td :colspan="(subjects.length)*2">
                                <span style="display: inline-block; width:130px;"><strong>Exceeding  (རྨད་བྱུང་།):</strong></span> 
                                   The student demonstrates competencies beyond expectations and targets
                                </td>
                        </tr>
                          <tr>
                            <td :colspan="(subjects.length)*2">
                                <span style="display: inline-block; width:130px;"><strong>Meeting (རེ་མཐུན།):</strong></span>
                                  The student demonstrates competencies that meet the expected competencies
                            </td>
                        </tr>
                          <tr>
                            <td :colspan="(subjects.length)*2">
                                <span style="display: inline-block; width:130px;"><strong>Approaching (ཉེ་འབྱོར།):</strong> </span>
                                 The student demonstrates competencies that are towards the expected competencies
                            </td>
                        </tr>
                          <tr>
                            <td :colspan="(subjects.length)*2"><span style="display: inline-block; width:130px;">
                                <strong>Beginning (གཞི་འཛུགས།):</strong> </span> 
                                The student demonstrates competencies that are below expectations
                            </td>
                        </tr>
                        <tr>
                            <template v-for="(item,index) in subjects">
                            <td :key="index"><strong>{{item.subject}}</strong></td>
                            <td :key="index"><strong>Level</strong></td>
                            </template>
                        </tr>
                        <tr>
                            <td class="text-center" :colspan="(subjects.length)*2">
                              Error fetching result data.
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
            subCategNonAcademics:[],
            others_result:[],
            student_details:{},
            org_and_class_details:{},
            subjects:[],
            academic_result:[],
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
                this.subjects = response.data.data.subjects
                this.academic_result = response.data.data.academic_result
               
            })
        },
//         getSubCategNonAcademic(){
//             axios.get('academics/getSubCategNonAcademic').then(response => {
//                 academic_result: [{subject: "Dzongkha", assessment_area: "Listening & Speaking", score_description: "Meeting"},…]
// non_academic_result: [,…]
// org_and_class_details: [,…]
// others_result: [{subject: "Personal Characteristics", assessment_area: "Leadership Quality",…},…]
// student_details: []
                // this.others_result = response.data.data.others_result
//             })
//         },
   
    },
    mounted(){ 
        this.getProgressReport()
        // this.getSubCategNonAcademic()
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
 