<template>
    <div>
        <form @submit.prevent="save" class="bootbox-form" id="subjectGroup">
            <div class="ml-1 row form-group">
              <div class="mr-3">
                <strong>Class: </strong> {{ className}} {{streamName}} {{section}}
              </div>
            </div>          
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table id="view-consolidated-result-table" cellspacing="0" width="100%" class="stripe table-bordered order-column">
                        <thead>
                            <tr>
                                <th rowspan="3">Roll No.</th>
                                <th rowspan="3">Name</th>
                                <th v-for="(item,index) in terms" :key="index" :colspan="areasPerTerm(item.aca_assmt_term_id)" class="text-center">
                                    {{item.term}}
                                </th>
                            </tr>
                            <tr>
                                <th v-for="(item1,index1) in subjects" :key="index1" :colspan="areasPerSubject(item1.aca_sub_id)" class="text-center">
                                    {{item1.subject}}
                                </th> 
                            </tr>
                             <tr>
                                <th v-for="(item2,index2) in areas" :key="index2" class="text-center">
                                    {{item2.assessment_area}} 
                                    <span v-if="item2.input_type==1">({{item2.weightage}}%)</span>
                                </th> 
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item3, index3) in consolidatedResultList" :key="index3">
                                <td>{{item3.CidNo}}</td>
                                <td>{{ item3.Name }}</td>
                                 <td v-for="(item4,index4) in areas" :key="index4" :class="{'text-right':(item4.input_type==1)}">
                                     {{consolidatedResultList[index3][item4["aca_assmt_term_id"]][item4["aca_sub_id"]][item4["aca_assmt_area_id"]]['score']}}
                                    <!-- <input type="hidden" :value="totalScore += (item2.input_type==1 && studentAssessmentList[index1][item2.aca_assmt_area_id]['score'] != null ? parseFloat(studentAssessmentList[index1][item2.aca_assmt_area_id]['score']) : 0)"> -->
                                </td> 
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div v-if="$route.name =='edit_consolidated_result'" class="card-footer text-right">
                <button type="submit" value="save" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
                <button  class="btn btn-flat btn-sm btn-primary" @click.prevent="save('finalize')"><i class="fa fa-check"></i> Finalize</button>
                <button type="submit" value="save" class="btn btn-flat btn-sm btn-primary" @click="save('publish')"><i class="fa fa-cloud-upload-alt"></i> Publish</button>

            </div>
        </form>
    </div>  

</template>
 <script>
 export default {
    data(){
           return{
            consolidatedResultList:[],
            terms:[],
            subjects:[],
            areas:[],
            dt:''
        }
      
    },
    methods:{
        rating(rating_type_id){
             return this.ratingList.filter(item => item.aca_rating_type_id == rating_type_id)
        },
       async loadConsolidatedResult(){
         let uri = 'academics/loadConsolidatedResult'
           uri += ('?classId='+this.classId)
          if(this.streamId !== null){
                uri += ('&streamId='+this.streamId)
            }
            if(this.sectionId !== null){
                uri += ('&sectionId='+this.sectionId)
            }
             if(this.aca_assmt_term_id !== null){
                uri += ('&aca_assmt_term_id='+this.aca_assmt_term_id)
            }
            try{
                let consolidatedResult = await axios.get(uri).then(response => response.data)
                this.terms = consolidatedResult.terms
                this.subjects = consolidatedResult.subjects
                this.areas = consolidatedResult.areas
                this.consolidatedResultList = consolidatedResult.results
            }catch(e){
                if(e.toString().includes("500")){
                  $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
             }                    
        },
        areasPerTerm(term_id){
           return this.areas.filter(item=>item.aca_assmt_term_id == term_id).length
        },
         areasPerSubject(sub_id){
            return this.areas.filter(item=>item.aca_sub_id == sub_id).length
        },
        save(action=""){
        let params = {org_class_id:this.classId,org_stream_id:this.streamId,org_section_id:this.sectionId,aca_assmt_term_id:this.aca_assmt_term_id};
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
                        axios.post('/academics/saveConsolidatedResut', params)
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
            }else if(action == "publish") {
                params.publish = 1
                Swal.fire({
                title: ' Are you sure you want to publish?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                }).then((result) => {
                    if(result.isConfirmed) {
                        axios.post('/academics/saveConsolidatedResut', params)
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
            }
            else{
                axios.post('/academics/saveConsolidatedResut', params)
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
        this.dt = $("#view-consolidated-result-table").DataTable({
            scrollX: true,
            scrollCollapse: true,
            "fixedColumns":   {
                leftColumns: 2
            },
            columnDefs: [
                { width: 2, targets: 0},
            ],
        })

    },
    created() {
        this.aca_assmt_term_id=this.$route.params.data.aca_assmt_term_id;
        this.aca_sub_id = this.$route.params.data.aca_sub_id
        this.classId=this.$route.params.data.org_class_id;
        this.streamId=this.$route.params.data.org_stream_id;
        this.sectionId=this.$route.params.data.org_section_id;
        this.className=this.$route.params.data.class;
        this.streamName=this.$route.params.data.stream;
        this.section=this.$route.params.data.section;
    },
    watch: {
        consolidatedResultList(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#view-consolidated-result-table").DataTable()
            });
        }
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
