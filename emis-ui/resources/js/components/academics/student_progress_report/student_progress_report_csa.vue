<template>
    <div>
        <table id="csa-student-progress-report-table" cellspacing="0" width="100%" class="table table-sm table-bordered table-striped">
            <thead>
                <tr>
                    <th colspan="8" class="fw-bolder text-center" style="font-size:15px;"> Academic Transcript (Class {{org_and_class_details.class}})</th>
                </tr>
                <tr>
                    <th colspan="8" class="fw-bolder text-center" style="font-size:15px;"> SUBJECT WISE ACADEMIC TRANSCRIPT</th>
                </tr>
                 <tr>
                    <th rowspan="2" class="text-center">
                        Subject
                    </th>
                    <th colspan="3" class="text-center">
                        TERM I
                    </th>
                    <th colspan="3" class="text-center">
                        TERM II
                    </th>
                     <th rowspan="2" class="text-center">
                        GRAND TOTAL (Total I + Total II)
                    </th>
                </tr>
                <tr>
                    <th class="text-center">
                        CA
                    </th>
                    <th class="text-center">
                        Mid Term Examination
                    </th>
                     <th class="text-center">
                        Total I
                    </th>
                    <th class="text-center">
                        CA
                    </th>
                    <th class="text-center">
                        Annual Examination
                    </th>
                     <th class="text-center">
                        Total II
                    </th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item,i) in academic_result" :key="i">
                    <td>
                        <strong>{{item.subject}}</strong>
                    </td>
                    <td class="text-center">
                        {{parseInt(item.t1_ca_score)}}
                    </td>
                    <td class="text-center">
                        {{parseInt(item.t1_exam_score)}}
                    </td>
                    <td class="text-center">
                        {{parseInt(item.t1_ca_score+item.t1_exam_score)}}
                    </td>
                    <td class="text-center">
                        {{parseInt(item.t2_ca_score)}}
                    </td>
                    <td>
                        {{parseInt(item.t2_exam_score)}}
                    </td>
                    <td class="text-center">
                        {{parseInt(item.t2_ca_score+item.t2_exam_score)}}
                    </td>
                    <td class="text-center">
                        {{parseInt(item.t1_ca_score+item.t1_exam_score+item.t2_ca_score+item.t2_exam_score)}}
                    </td>
                </tr>
                <tr>
                    <td rowspan="4"></td>
                    <td colspan="2">
                        <span style="display: inline-block; width:130px;"><strong>Percentage</strong> </span>
                    </td>
                    <td class="text-center">
                        {{student_details.t1_marks_percent}}
                    </td>
                    <td colspan="2">
                        <span style="display: inline-block; width:130px;"><strong>Percentage</strong> </span>
                    </td>
                    <td class="text-center">
                         {{student_details.t2_marks_percent}}
                    </td>
                    <td class="text-center">
                        {{student_details.marks_percent}}
                        
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <span style="display: inline-block; width:130px;"><strong>Position</strong> </span>
                    </td>
                    <td class="text-center">
                        {{student_details.t1_position}}
                    </td>
                    <td colspan="2">
                        <span style="display: inline-block; width:130px;"><strong>Position</strong> </span>
                    </td>
                    <td class="text-center">
                         {{student_details.t2_position}}
                    </td>
                    <td class="text-center">
                          {{student_details.position}}
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <span style="display: inline-block; width:130px;"><strong>Attendance</strong> </span>
                    </td>
                    <td class="text-center">
                       {{student_details.t1_attendance_percent}}
                    </td>
                    <td colspan="2">
                        <span style="display: inline-block; width:130px;"><strong>Attendance</strong> </span>
                    </td>
                    <td class="text-center">
                        {{student_details.t2_attendance_percent}}
                    </td>
                    <td class="text-center">
                        {{student_details.attendance_percent}}
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <span style="display: inline-block; width:130px;"><strong>Total no. of students</strong> </span>
                    </td>
                    <td  class="text-center">
                        {{org_and_class_details.no_of_students}}
                    </td>
                    <td colspan="2">
                        <span style="display: inline-block; width:130px;"><strong>Total no. of students</strong> </span>
                    </td>
                    <td  class="text-center">
                       {{org_and_class_details.no_of_students}}
                    </td>
                    <td  class="text-center">
                        {{org_and_class_details.no_of_students}}
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
                <tr>
                    <td colspan="4">
                        <br/>
                        <span style="display: inline-block; width:220px; height:28px;"><strong>Signature of Parent/Guardian:  </strong> </span>
                    </td>
                    <td colspan="4">
                        <br/>
                        <span style="display: inline-block; width:220px; height:28px;"><strong>Signature of Parent/Guardian:  </strong> </span>
                    </td>
                </tr> 
                <tr>
                    <td colspan="4">
                        <br/>
                        <span style="display: inline-block; width:220px; height:30px;"><strong>Signature of Class Teacher: </strong> </span>
                    </td>
                    <td colspan="4">
                        <br/>
                        <span style="display: inline-block; width:220px; height:30px;"><strong>Signature of Class Teacher:  </strong> </span>
                    </td>
                </tr> 
            </tbody>
        </table>
    </div>  
</template>
<script>
export default {
    data(){
        return{
            others_result:[],
            student_details:{},
            org_and_class_details:{},
            academic_result:[],
            non_academic_result:[],
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
               
            })
            setTimeout(function(){
                $("#csa-student-progress-report-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 300);  
        },
   
    },
    mounted(){ 
        this.getProgressReport()
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
 