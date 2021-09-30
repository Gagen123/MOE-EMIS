<template>
<div class="container-fluid">
    <div class="card card-primary card-outline">
           <table class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <tr class="bg-cyan">
                  <td colspan="2"><b>View Results</b></td>
              </tr>
           </table>
        <div class="card-body">
          <div class="form-group row">
            <!-- <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label>Year:<span class="text-danger">*</span></label> 
                  <select class="form-control select2" id="class_stream_section_id" v-model="class_stream_section_id" @change="getTerms(); getTermResult();">
                      <option value=""> --Select--</option>
                      <option v-for="(item, index) in classList" :key="index" v-bind:value="[item.OrgClassStreamId,item.org_class_id,item.org_stream_id,item.org_section_id,item.class_stream_section]">
                          {{ item.class_stream_section }} 
                      </option>
                  </select> 
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label>Class:<span class="text-danger">*</span></label> 
                  <select class="form-control select2" id="class_stream_section_id" v-model="class_stream_section_id" @change="getTerms(); getTermResult();">
                      <option value=""> --Select--</option>
                      <option v-for="(item, index) in classList" :key="index" v-bind:value="[item.OrgClassStreamId,item.org_class_id,item.org_stream_id,item.org_section_id,item.class_stream_section]">
                          {{ item.class_stream_section }} 
                      </option>
                  </select> 
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label>Term:<span class="text-danger">*</span></label> 
                  <select class="form-control select2" id="aca_assmt_term_id" v-model="aca_assmt_term_id"  @change="getTermResult()">
                      <option value=""> --Select--</option>
                      <option v-for="(item, index) in terms" :key="index" v-bind:value="item.id">
                          {{ item.name }} <span v-if="item.term_dzo_name">( {{ item.term_dzo_name }} )</span>
                      </option>
                  </select> 
            </div> -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-4">
                <table id="result-term-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                        <th>Term</th>
                        <th>Result Status</th> 
                        <th>Action</th> 
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <!-- <tr v-for="(item, index) in TermsResultList" :key="index">
                            <td>{{ item.sub_name }} <span v-if="item.sub_dzo_name">( {{ item.sub_dzo_name }} )</span></td>
                            <td>
                                <span v-if="item.finalized"><strong>Finalized</strong> by
                                    <span v-if="item.assessed_by_class_teacher">class</span>
                                    <span v-else>subject</span> teacher on {{item.finalized_date}}
                                </span>
                                <span v-else-if="item.std_assmt_id"><strong>Under process</strong> with 
                                    <span v-if="item.assessed_by_class_teacher">class</span>
                                    <span v-else>subject</span> teacher
                                </span>
                                <span v-else><strong>Not added</strong></span>
                            </td>
                            <td>
                                 <div v-if="item.finalized && item.is_class_teacher" class="ml-2 btn-group btn-group-sm">
                                    <div class="btn btn-info btn-sm btn-flat text-white" @click="unlockForEdit(item.std_assmt_id)"><i class="fa fa-unlock-alt"></i > Undo Finalize </div>
                                </div>
                                <div v-else-if="item.is_subject_teacher && !item.finalized" class="ml-2 btn-group btn-group-sm">
                                    <div class="btn btn-info btn-sm btn-default text-white" width="500" @click="showedit('edit_term_result',item)">
                                        <span v-if="item.std_assmt_id"><i class="fas fa-edit"></i > Edit</span>
                                        <span v-else><i class="fas fa-plus"></i > Add</span>
                                    </div>
                                </div>
                                <div v-if="item.std_assmt_id" class="ml-2 mt-1 btn-group btn-group-sm">
                                    <div class="btn btn-info btn-sm btn-flat text-white" @click="showedit('view_term_result',item)"> <i class="fas fa-eye"></i > View</div>
                                </div>
                            </td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
          </div>
        </div>
    </div>
</div>
</template>
<script>
export default {
    data(){
        return{
            ResultLists:[],
        }
    },
    methods:{
        LoadResultByStudentId(std_id){
          axios.get('results/LoadResultByStudentId/' +std_id)
                .then(response => {
                  if(response.data.data!="" && response.data.data!=null){
                    let data = response.data.data;
                    this.ResultLists=data;
                  }
                  else{
                    Swal.fire({
                      text: "Your result is not pubished yet, Please wait until it is publish from concern person!",
                      icon: 'warning',
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Okay!',
                      })
                  }
                });
        },
    },
    mounted(){ 
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').select2().
        on("select2:select", e => {
            const event = new Event("change", { bubbles: true, cancelable: true });
            e.params.data.element.parentElement.dispatchEvent(event);
        })
        .on("select2:unselect", e => {
        const event = new Event("change", { bubbles: true, cancelable: true });
        e.params.data.element.parentElement.dispatchEvent(event);
        });
        
        this.dt = $("#result-term-table").DataTable({
            "order": [[ 0, "asc" ]],
            "lengthChange": false,
            "searching": false,
        })
        // session data
        axios.get('getSessionDetail')
        .then(response => {
            let data = response.data.data;
            this.cid=data['std_id'];
            this.code=data['std_code'];
            this.type=data['user_type'];
            this.email=data['email'];
            this.name=data['full_name'];
            this.contact=data['phone_number'];
            this.LoadResultByStudentId(this.cid);
            if(data['user_type']!="Parent" && data['user_type']!="Feedback" && data['user_type']!="Leadership"){
                this.is_student=true;
            }
        })
        .catch(errors => {
            console.log(errors)
        });

    },
    created(){
    },
    watch: {
        TermsResultList(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#result-term-table").DataTable({
                    "order": [[ 0, "asc" ]],
                    "lengthChange": false,
                    "searching": false,
                })
            });
        }
    }
        
}
</script>
