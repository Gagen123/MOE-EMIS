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
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 overflow-auto">
                    <table id="assessment-term-table" cellspacing="0" width="100%" class="stripe table-bordered order-column">
                        <thead>
                            <tr>
                                 <th>Roll No.
                                    <!-- <span v-if="term_dzo_name && sub_dzo_name"> ( སློབ་ཕྲུག་གི་གསང་ཡིག )</span> -->
                                </th> 
                                <th>Name 
                                    <!-- <span v-if="term_dzo_name && sub_dzo_name"> ( མིང་། )</span> -->
                                </th>
                                <th v-for="(item, index) in assessmentAreaList" :key="index">{{item.assessment_area}} 
                                    <span v-if="item.assmt_area_dzo_name">( {{item.assmt_area_dzo_name}} )</span>
                                    <span v-if="item.input_type==1"> ({{item.weightage}}%)</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr v-for="(item1, index1) in  studentAssessmentList" :key="index1">
                                <td>{{index1 + 1}}</td>
                                <td>{{ item1.Name }}</td>
                                <td v-for="(item2, index2) in assessmentAreaList" :key="index2">
                                    <span v-if="!(studentAssessmentList[index1][item2.aca_assmt_area_id] === undefined)">
                                        <input v-model="studentAssessmentList[index1][item2.aca_assmt_area_id]['aca_assmt_area_id']" type="hidden">
                                        <input v-model="studentAssessmentList[index1][item2.aca_assmt_area_id]['aca_rating_type_id']" type="hidden">
                                        <input v-if="item2.input_type==1" v-model="studentAssessmentList[index1][item2.aca_assmt_area_id]['score']" 
                                            @change="validate(index2,studentAssessmentList[index1][item2.aca_assmt_area_id]['weightage'],'0',studentAssessmentList[index1][item2.aca_assmt_area_id]['score'])" 
                                            class="form-control form-control-sm text-right num" :id="'assmt_area_'+index2" 
                                            type="number" step="0.01" :max="studentAssessmentList[index1][item2.aca_assmt_area_id]['weightage']" min="0"
                                            data-bs-container="body" data-bs-toggle="popover" data-bs-placement="buttom" :data-bs-content="error">
                                        <input v-else-if="item2.input_type==2" v-model="studentAssessmentList[index1][item2.aca_assmt_area_id]['descriptive_score']"  class="form-control form-control-sm assmt_area_des" id="assmt_area_des" type="text">
                                        <select v-else v-model="studentAssessmentList[index1][item2.aca_assmt_area_id]['score']"  class="form-control form-control-sm ditable_fields select2" :id="item1.assessment_area"> 
                                            <option selected value="null">--SELECT--</option>
                                            <option v-for="(item3, index3) in  rating(item2.aca_rating_type_id)" :key="index3" :value="item3.score">
                                                 <span v-if="item3.dzo_name && sub_dzo_name">{{ item3.dzo_name }}</span>
                                                 <span v-else> {{ item3.name }}</span>
                                            </option>
                                        </select>
                                    </span>
                                    <span class="text-danger"  :id="'assmt_area_'+index2+'_err'" >
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
             <footer>
                <ul class="list-inline">
                    <strong>Abbreviations:</strong>
                    <li v-for ="(item4,index4) in assessmentAreaList" :key="index4" class="list-inline-item text-justify">
                        <small v-if="item4.code"> <b>{{item4.code}} </b> - {{ item4.name }} </small>
                    </li>
                </ul>
            </footer>
            <div class="card-footer text-right">
                <button type="reset" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-redo"></i> Reset</button>
                <button type="submit" value="save" id="save" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
                <button  class="btn btn-flat btn-sm btn-primary" id="finalize" @click.prevent="save('finalize')"><i class="fa fa-check"></i> Finalize & Submit to Class Teacher</button>
            </div>
        </form>
    </div>  

</template>
 <script>
 export default {
    data(){
        return{
            assessmentAreaList:[],
            ratingList:[],
            studentAssessmentList:[],
            dt:'',
            error:''
        }
    },
    methods:{
        rating(rating_type_id){
             return this.ratingList.filter(item => item.aca_rating_type_id == rating_type_id)
        },
        async loadStudentAssessments(){
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
                $("#assessment-term-table").DataTable({
                    // "responsive": false,
                    // "autoWidth": true,
                    scrollY:"300px",
                    scrollX: true,
                    scrollCollapse: true,
                    paging: false,
                    searching: false,
                    fixedColumns:   {
                        leftColumns: 2
                    },
                    columnDefs: [
                        { width: 50, targets: 0},
                        { width: 200, targets: 1},
                        { width: 100, targets: 2},
                    ],
                    drawCallback: function(dt) {
                        $('.select2').select2({tags: true, width: "150"}).on("select2:select", e => {
                            const event = new Event("change", { bubbles: true, cancelable: true });
                            e.params.data.element.parentElement.dispatchEvent(event);
                        })
                        .on("select2:unselect", e => {
                        const event = new Event("change", { bubbles: true, cancelable: true });
                        e.params.data.element.parentElement.dispatchEvent(event);
                        });
                        $('.assmt_area_des').css("width", "150");
                        $('.num').css("width", "150");
                    }
                }); 
            }, 50);                     
        },
        validate(index,max,min,score){
            if(score > max){
                $("#"+'assmt_area_'+index+'_err').text("The mark cannot be greater than "+max)
                $('#save').prop('disabled',true);
                $('#finalize').prop('disabled',true);
            }
            else if (score < min){
                $("#"+'assmt_area_'+index+'_err').text("The mark cannot be less than "+min)
                $('#save').prop('disabled',true);
                $('#finalize').prop('disabled',true);
            } else{
                
            }
        },
        save(action=""){
            let params = {class_stream_section:this.class_stream_section,org_class_id:this.classId,org_stream_id:this.streamId,org_section_id:this.sectionId,aca_sub_id:this.aca_sub_id, aca_assmt_term_id:this.aca_assmt_term_id,data:this.studentAssessmentList};
            if(action == "finalize"){
                params.finalize = 1
                Swal.fire({
                    title: 'You cannot edit the result after finalizing. Are you sure you want to finalize?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    }).then((result) => {
                        if(result.isConfirmed) {
                            axios.post('/academics/saveStudentAssessment', params)
                                .then(() => {
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Data saved successfully.'
                                    })
                                    this.$router.push('/list-term-result');
                                })
                                .catch(function(error){
                                this.errors = error;
                            });
                        }
                    })
                }else{
                    axios.post('/academics/saveStudentAssessment', params)
                        .then(() => {
                            Toast.fire({
                                icon: 'success',
                                title: 'Data saved successfully.'
                            })
                            this.$router.push('/list-term-result');
                        })
                        .catch(function(error){
                        this.errors = error;
                    });
                }
            }
        },
        mounted(){
            this.loadStudentAssessments()
            },
        created() {
            this.aca_assmt_term_id=this.$route.params.data.aca_assmt_term_id;
            this.aca_sub_id = this.$route.params.data.aca_sub_id
            this.classId=this.$route.params.data.org_class_id;
            this.streamId=this.$route.params.data.org_stream_id;
            this.sectionId=this.$route.params.data.org_section_id;
            this.class_stream_section=this.$route.params.data.class_stream_section;
            this.subject=this.$route.params.data.sub_name;
            this.sub_dzo_name=this.$route.params.data.sub_dzo_name;
            this.term=this.$route.params.data.term_name;
            this.term_dzo_name=this.$route.params.data.term_dzo_name;
            this.OrgClassStreamId=this.$route.params.data.OrgClassStreamId;

        },
  
}
</script>
<style scoped>
   th, td { white-space: nowrap; }
    div.dataTables_wrapper {
        width: 800px;
        margin: 0 auto;
    }
    table.DTFC_Cloned thead,table.DTFC_Cloned tfoot{background-color:white}div.DTFC_Blocker{background-color:white}div.DTFC_LeftWrapper table.dataTable,div.DTFC_RightWrapper table.dataTable{margin-bottom:0;z-index:2}div.DTFC_LeftWrapper table.dataTable.no-footer,div.DTFC_RightWrapper table.dataTable.no-footer{border-bottom:none}table.dataTable.display tbody tr.DTFC_NoData{background-color:transparent}
</style>
