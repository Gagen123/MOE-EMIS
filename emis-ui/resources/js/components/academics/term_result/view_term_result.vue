<template>
    <div>
        <form @submit.prevent="save" class="bootbox-form" id="subjectGroup">
                <div class="ml-1 row form-group">
              <div class="mr-3">
                <strong>Class: </strong> {{ class_stream_section }}
              </div>
              <div class="mr-3">
                <strong>Term: </strong> {{term}} <span v-if="term_dzo_name && sub_dzo_name">( {{term_dzo_name}} )</span>
              </div>
              <div class="mr-3">
                <strong>Subject: </strong> {{subject}} <span v-if="sub_dzo_name">( {{sub_dzo_name}} )</span>
              </div>
            </div>           
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table id="term-result-view-table" style="width:100%" class="stripe cell-border order-column">
                        <thead>
                            <tr>
                                <th>Roll No.
                                </th> 
                                <th>Name 
                                    <span v-if="term_dzo_name && sub_dzo_name"> ( མིང་། )</span>
                                </th>
                                 <th v-for="(item, index) in assessmentAreaList" :key="index">
                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" :title="item.name">
                                        {{item.assessment_area}} 
                                        <span v-if="item.assmt_area_dzo_name"> ( {{item.assmt_area_dzo_name}} ) </span>
                                        <span v-if="item.input_type==1"> ({{item.weightage}}%)</span>
                                    </span>
                                </th>
                                <th v-if="totalWeightage>=1">
                                    Total 
                                    <span v-if="term_dzo_name && sub_dzo_name"> ( བསྡོམས། ) </span> 
                                    ({{totalWeightage}}%)
                                </th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr v-for="(item1, index1) in  studentAssessmentList" :key="index1">
                                <td>{{item1.roll_no}}<input type="hidden" :value="totalScore = 0"></td>
                                <td>{{ item1.Name }}</td>
                                <td v-for="(item2, index2) in assessmentAreaList" :key="index2" :class="{'text-right':(item2.input_type==1)}">
                                    <span v-if="!(studentAssessmentList[index1][item2.aca_assmt_area_id] === undefined)">
                                        <!-- <span v-if="item3.dzo_name">{{ item3.dzo_name }}</span>
                                                 <span v-else> {{ item3.name }}</span> -->
                                        {{studentAssessmentList[index1][item2.aca_assmt_area_id]['score_text']}} 
                                        <input type="hidden" :value="totalScore += (item2.input_type==1 && studentAssessmentList[index1][item2.aca_assmt_area_id]['score'] != null ? parseFloat(studentAssessmentList[index1][item2.aca_assmt_area_id]['score']) : 0)">
                                    </span>
                                </td>
                                <td v-if="totalWeightage>0" class="text-right"><span v-if="totalScore!=0">{{totalScore}}</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <footer>
                <ul class="list-inline">
                    <strong>Abbreviations:</strong>
                    <li v-for ="(item,index) in assessmentAreaList" :key="index" class="list-inline-item text-justify">
                        <small v-if="item.code"> <b>{{item.code}} </b> - {{ item.name }} </small>
                    </li>
                </ul>
            </footer>
        </form>
    </div>  

</template>
 <script>
 export default {
    data(){
        return{
            totalScore:0,
            assessmentAreaList:[],
            ratingList:[],
            studentAssessmentList:[],
            dt:''
        }
    },
    methods:{
       async loadStudentAssessments(){
         var printCounter = 0;
         let uri = 'academics/loadStudentAssessments'
            uri += ('?aca_assmt_term_id='+this.aca_assmt_term_id+'&aca_sub_id='+this.aca_sub_id+'&OrgClassStreamId='+this.OrgClassStreamId+'&classId='+this.classId)

          if(this.streamId !== null){
                uri += ('&streamId='+this.streamId)
            }
            if(this.sectionId !== null){
                uri += ('&sectionId='+this.sectionId)
            }
            try{
                let studentAssesssments = await axios.get(uri).then(response => response.data)
                this.assessmentAreaList = studentAssesssments.assessmentAreas
                this.ratingList = studentAssesssments.ratings
                this.studentAssessmentList = studentAssesssments.studentAssessments
            }catch(e){
                if(e.toString().includes("500")){
                  $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
             }  
            setTimeout(function(){
                $('#term-result-view-table').append('<caption style="caption-side: bottom">Term Result</caption>');
                $("#term-result-view-table").DataTable({
                    scrollY: "300px",
                    paging:  false,
                    scrollX: true,
                    scrollCollapse: true,
                    fixedColumns:   {
                        leftColumns: 2
                    },
                    columnDefs: [
                        { width: 50, targets: 0},
                        { width: 200, targets: 1},
                        { width: 100, targets: 2},
                    ],  
                    dom: 'Bfrtip',
                    buttons: [
                        'copy',
                        {
                            extend: 'excel', 
                            messageTop: 'Class '+this.class_stream_section+ ' '+'Term '+this.term+' '+'Subject '+this.subject
                        },
                        {
                            extend: 'pdf',
                            messageTop: 'Class '+this.class_stream_section+ ' '+'Term '+this.term+' '+'Subject '+this.subject
                        },
                        {
                            extend: 'print',
                            messageTop: function () {
                                printCounter++;
                                return 'Printed '+printCounter+' times';
                            },
                            messageBottom: null
                        }
                    ]
                   
                }); 
            }, 300);  
       }
    },
    computed:{
        totalWeightage(){
           let totalWeightage = 0;
           if(this.assessmentAreaList.length>0){
                this.assessmentAreaList.forEach((item) => {
                    if(item.input_type==1){
                        return totalWeightage+=(item.weightage)
                    }
                })
           }
           return totalWeightage
        },
    },

    created() {
            this.aca_assmt_term_id=this.$route.params.data.aca_assmt_term_id;
            this.aca_sub_id = this.$route.params.data.aca_sub_id
            this.classId=this.$route.params.class_stream_section[1];
            this.streamId=this.$route.params.class_stream_section[2];
            this.sectionId=this.$route.params.class_stream_section[3];
            this.class_stream_section=this.$route.params.class_stream_section[4];
            this.subject=this.$route.params.data.sub_name;
            this.sub_dzo_name=this.$route.params.data.sub_dzo_name;
            this.term=this.$route.params.data.term_name;
            this.term_dzo_name=this.$route.params.data.term_dzo_name;
            this.OrgClassStreamId=this.$route.params.class_stream_section[0];

    },
    mounted(){ 
        this.loadStudentAssessments()
    }
    
 }
</script>
<style scoped>
    th, td { white-space: nowrap; }
    div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
    }
    table.DTFC_Cloned thead,table.DTFC_Cloned tfoot{background-color:white}div.DTFC_Blocker{background-color:white}div.DTFC_LeftWrapper table.dataTable,div.DTFC_RightWrapper table.dataTable{margin-bottom:0;z-index:2}div.DTFC_LeftWrapper table.dataTable.no-footer,div.DTFC_RightWrapper table.dataTable.no-footer{border-bottom:none}table.dataTable.display tbody tr.DTFC_NoData{background-color:transparent}
</style>
