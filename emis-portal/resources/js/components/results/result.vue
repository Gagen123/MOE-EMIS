<template>
  <div>
    <div class="col-8 center">
      <div class="card card-success card-outline">
        <table class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <tr class="bg-cyan">
                <td colspan="2"><b>View Results</b></td>
            </tr>
        </table>
        <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12 mt-4">
                <table id="consolidated-result-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Term</th>
                            <th>Result Status</th>
                            <th>Action</th> 
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr v-for="(item, index) in studentConsolidatedResultList" :key="index">
                            <td>{{ item.term }}</td>
                            <td>
                                <span v-if="item.pubblished">
                                    <strong>Published</strong> on {{ item.published_date }}
                                </span>
                                <span v-else-if="item.class_teacher_finalized">
                                    <strong>Consolidated and finalized by class teacher</strong> on {{ item.class_teacher_finalized_date }} 
                                </span>
                                <span v-else-if="item.aca_assmt_term_id && item.subject_teachers_finalized">
                                    <strong>Finalized by subject teachers</strong> on {{ item.subject_teachers_finalized_date }} 
                                </span>
                                <span v-else-if="!item.aca_assmt_term_id">
                                    <strong>Under process with class teacher</strong>  
                                </span>
                                <span v-else>
                                    <strong>Under process with subject teachers</strong>
                                </span>
                            </td>
                            <td>
                                <div v-if="item.is_class_teacher && item.subject_teachers_finalized && !item.class_teacher_finalized" class="btn-group btn-group-sm">
                                    <div class="btn btn-info btn-sm btn-flat text-white" @click="showedit('edit_consolidated_result',item)"> <i class="fas fa-edit"></i > Edit</div>
                                </div>
                                <div v-if="item.is_class_teacher && item.class_teacher_finalized && !item.published" class="btn-group btn-group-sm">
                                    <div class="btn btn-info btn-sm btn-flat text-white" @click="unlockForEditForConsolidated(item.aca_assmt_term_id)"><i class="fa fa-unlock-alt mr-1"></i > Undo Finalize </div>
                                </div>
                                 <div v-if="item.is_class_teacher && item.class_teacher_finalized && !item.published" class="btn-group btn-group-sm">
                                    <div class="btn btn-info btn-sm btn-flat text-white" @click="showedit('',item)"><i class="fas fa-cloud-upload-alt"></i > Publish</div>
                                </div>
                                <div class="btn-group btn-group-sm">
                                    <div class="btn btn-info btn-sm btn-flat text-white" @click="showedit('view_consolidated_result',item)"> <i class="fas fa-eye"></i > View</div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
      </div>
    </div>
  </div>
</template>

<script>
import VueTagsInput from "@johmun/vue-tags-input";

export default {
  components: {
    VueTagsInput,
  },
  data() {
    return {
      form: new form({
        id: "",
      
      }),
     
    };
  },
  methods: {
  },
  created() {
  },
  watch: {
        studentConsolidatedResultList(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#consolidated-result-table").DataTable({
                "order": [[ 0, "asc" ]],
                "lengthChange": false,
                "searching": false,
                })
            });
        }
    }
};
</script>
