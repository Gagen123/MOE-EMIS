<template>
    <div>
        <form @submit.prevent="save" class="bootbox-form" id="consolidated-result">
            <div class="ml-1 row form-group">
              <div class="mr-3">
                <strong>Class: </strong> {{form.class_stream_section }}
              </div>
               <div class="mr-3">
                <strong>Instructional Days: </strong> {{ instructional_days }}
              </div>
            </div>          
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table id="edit-table" cellspacing="0" width="100%" class="stripe cell-bordered order-column">
                        <thead>
                            <tr>
                                <th rowspan="3">Roll No.</th>
                                <th rowspan="3">Name</th>
                                <th v-for="(item,index) in terms" :key="index" :colspan="areasPerTerm(item.aca_assmt_term_id)" class="text-center">
                                    {{item.term}}
                                </th>
                                
                            </tr>
                            <tr>
                                <template v-for="(item1,index1) in subjects">
                                    <th :rowspan="item1.is_aggregate ? 2 : 1" :key="index1" :colspan="areasPerSubject(item1.aca_sub_id)" class="text-center">
                                        {{item1.subject}} <span v-if="item1.sub_dzo_name">( {{item1.sub_dzo_name }} )</span>
                                    </th>
                                </template>
                            </tr>
                             <tr>
                                <template v-for="(item2,index2) in areas">
                                    <th v-if="item2.assessment_area" :key="index2" class="text-center">
                                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" :title="item2.assessment_area_hint">
                                            {{item2.assessment_area}} <span v-if="item2.assmt_area_dzo_name">( {{item2.assmt_area_dzo_name }} )</span>
                                            <span v-if="item2.input_type==1 && item2.weightage">({{item2.weightage}}%)</span>
                                        </span>
                                    </th> 
                                </template>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item3, index3) in consolidatedResultList" :key="index3">
                                <td>{{item3.roll_no}}</td>
                                <td>
                                    {{ item3.Name }}
                                </td>
                                 <td v-for="(item4,index4) in areas" :key="index4" :class="{'text-right':(item4.input_type==1)}">
                                    <span v-if="item4['aca_sub_id']=='remarks'">
                                        <input type="text" v-model="consolidatedResultList[index3][item4['aca_assmt_term_id']][item4['aca_sub_id']][item4['aca_assmt_area_id']]['score']" class="form-control form-control-sm">
                                    </span>
                                    <span v-else-if="!(consolidatedResultList[index3][item4['aca_assmt_term_id']] === undefined) && !(consolidatedResultList[index3][item4['aca_assmt_term_id']][item4['aca_sub_id']] === undefined) && !(consolidatedResultList[index3][item4['aca_assmt_term_id']][item4['aca_sub_id']][item4['aca_assmt_area_id']] === undefined)">
                                        <span v-if="item4['aca_sub_id']=='result'">
                                            <span v-if="consolidatedResultList[index3][item4['aca_assmt_term_id']][item4['aca_sub_id']][item4['aca_assmt_area_id']]['score']==1">
                                                Promoted
                                            </span>
                                            <span v-else class="text-danger">
                                                Detained
                                            </span>
                                        </span>
                                       <span v-else-if="item4.input_type==0" :class="{'text-danger underline' :
                                            consolidatedResultList[index3][item4['aca_assmt_term_id']][item4['aca_sub_id']][item4['aca_assmt_area_id']]['score']
                                            < consolidatedResultList[index3][item4['aca_assmt_term_id']][item4['aca_sub_id']][item4['aca_assmt_area_id']]['pass_score']}"
                                        >
                                            {{ratings.find(rating => rating.aca_rating_type_id == consolidatedResultList[index3][item4['aca_assmt_term_id']][item4['aca_sub_id']][item4['aca_assmt_area_id']]['aca_rating_type_id'] && rating.score == consolidatedResultList[index3][item4["aca_assmt_term_id"]][item4["aca_sub_id"]][item4["aca_assmt_area_id"]]['score']).name}}
                                       </span>
                                       <span v-else 
                                            :class="{'text-danger underline' : (item4.input_type==1
                                            && ((consolidatedResultList[index3][item4['aca_assmt_term_id']][item4['aca_sub_id']][item4['aca_assmt_area_id']]['score']
                                                    / areas.find(areaItem => areaItem.aca_assmt_term_id == item4['aca_assmt_term_id'] && areaItem.aca_assmt_area_id == item4['aca_assmt_area_id']).weightage)*100) 
                                                    < consolidatedResultList[index3][item4['aca_assmt_term_id']][item4['aca_sub_id']][item4['aca_assmt_area_id']]['pass_score'])}"
                                        >
                                            {{consolidatedResultList[index3][item4["aca_assmt_term_id"]][item4["aca_sub_id"]][item4["aca_assmt_area_id"]]['score']}}
                                       </span>
                                    </span>                                  
                                </td> 
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div v-if="$route.name =='edit_consolidated_result'" class="card-footer text-right">
                <button type="submit" value="save" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
                <button  class="btn btn-flat btn-sm btn-primary" @click.prevent="save('finalize')"><i class="fa fa-check"></i> Finalize & Submit for Approval </button>
                <!-- <button type="submit" value="save" class="btn btn-flat btn-sm btn-primary" @click="save('publish')"><i class="fa fa-cloud-upload-alt"></i> Publish</button> -->
            </div>
            <footer v-if="assessmentAreaCode.length">
                <ul class="list-inline">
                    <strong>Abbreviations:</strong>
                    <li v-for ="(item,index) in assessmentAreaCode" :key="index" class="list-inline-item">
                        <small class="text-justify">  <b>{{item.code}}  </b>- {{ item.name }}</small>
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
            consolidatedResultList:[],
            instructional_days:'',
            terms:[],
            subjects:[],
            areas:[],
            ratings:[],
            assessmentAreaCode:[],
            form: new form({
                class_stream_section:'',
                aca_assmt_term_id:'',
                org_class_id:'',
                org_stream_id:'',
                org_section_id:'',
                remarks:[]

            }),
        }
      
    },
    methods:{
        rating(rating_type_id){
             return this.ratingList.filter(item => item.aca_rating_type_id == rating_type_id)
        },
       async loadConsolidatedResult(){
         let uri = 'academics/loadConsolidatedResult'
           uri += ('?OrgClassStreamId='+this.OrgClassStreamId+'&classId='+this.form.org_class_id)
          if(this.form.org_stream_id !== null){
                uri += ('&streamId='+this.form.org_stream_id)
            }
            if(this.form.org_section_id !== null){
                uri += ('&sectionId='+this.form.org_section_id)
            }
             if(this.form.aca_assmt_term_id !== null){
                uri += ('&aca_assmt_term_id='+this.form.aca_assmt_term_id)
            }
            try{
                let consolidatedResult = await axios.get(uri).then(response => response.data)
                this.instructional_days = consolidatedResult.overAllInstructionalDays
                this.terms = consolidatedResult.terms
                this.assessmentAreaCode = consolidatedResult.abbreviations
                this.subjects = consolidatedResult.subjects
                this.areas = consolidatedResult.areas
                this.consolidatedResultList = consolidatedResult.results
                this.ratings = consolidatedResult.ratings
            }catch(e){
                if(e.toString().includes("500")){
                  $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            }
            setTimeout(function(){
                $("#edit-table").DataTable({
                    "responsive": false,
                    "autoWidth": true,
                    scrollY:        "300px",
                    scrollX:        true,
                    scrollCollapse: true,
                    paging:         false,
                    searching: false,
                    fixedColumns:   {
                        leftColumns: 2
                    },
                    
                }); 
            }, 300);                      
           
        },
        areasPerTerm(term_id){
           return this.areas.filter(item=>item.aca_assmt_term_id == term_id).length
        },
         areasPerSubject(sub_id){
            return this.areas.filter(item=>item.aca_sub_id == sub_id).length
        },
        save(action=""){
            const aca_assmt_term_id = this.form.aca_assmt_term_id ? this.form.aca_assmt_term_id : 'final-result'
            this.consolidatedResultList.forEach(item=>{
                if(item[aca_assmt_term_id].remarks.area_total.score){
                    this.form.remarks[item.std_student_id] = item[aca_assmt_term_id].remarks.area_total.score
                }
            })
            if(action == "finalize"){
                let finalize = { finalize:1 }
                const newForm = Object.assign(this.form,finalize)
                Swal.fire({
                    title: 'You cannot edit the result after finalizing. Are you sure you want to finalize?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    }).then((result) => {
                        if(result.isConfirmed) {
                            axios.post('/academics/saveConsolidatedResut', this.form)
                                .then(() => {
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Data saved successfully.'
                                    })
                                    this.$router.push('/list-consolidated-result');
                                })
                                .catch(function(error){
                                this.errors = error;
                            });
                        }
                    })
            }else{
                axios.post('/academics/saveConsolidatedResut', this.form)
                    .then(() => {
                        Toast.fire({
                            icon: 'success',
                            title: 'Data saved successfully.'
                        })
                        this.$router.push('/list-consolidated-result');
                    })
                    .catch(function(error){
                    this.errors = error;
                });
            }
        }
    },
    mounted(){ 
        this.loadConsolidatedResult()
    },
    created() {
        this.form.aca_assmt_term_id=this.$route.params.data.aca_assmt_term_id;
        this.form.org_class_id=this.$route.params.data.org_class_id;
        this.form.org_stream_id=this.$route.params.data.org_stream_id;
        this.form.org_section_id=this.$route.params.data.org_section_id;
        this.form.class_stream_section=this.$route.params.class_stream_section[4];
        this.OrgClassStreamId=this.$route.params.class_stream_section[0];

    },
}
</script>
<style scoped>
  th, td { white-space: nowrap; }
    div.dataTables_wrapper {
        width: 900px;
        margin: 0 auto;
    }

    
table.DTFC_Cloned thead,table.DTFC_Cloned tfoot{background-color:white}div.DTFC_Blocker{background-color:white}div.DTFC_LeftWrapper table.dataTable,div.DTFC_RightWrapper table.dataTable{margin-bottom:0;z-index:2}div.DTFC_LeftWrapper table.dataTable.no-footer,div.DTFC_RightWrapper table.dataTable.no-footer{border-bottom:none}table.dataTable.display tbody tr.DTFC_NoData{background-color:transparent}div.DTFC_LeftBodyLiner{overflow-x: hidden}
.underline {
  text-decoration: underline;
}
</style>
