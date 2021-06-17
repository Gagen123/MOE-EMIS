<template>
  <div>
    <form class="bootbox-form">
      <div class="form-group row">
        <div class="mr-3 col-lg-4 col-md-4 col-sm-4 col-xs-12">
          <label class="mb-0.5">Class:</label>
          <input type="text" class="form-control" v-model="class_stream_section" disabled/>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
          <label class="mb-0.5">Training:<i class="text-danger">*</i></label>
          <select v-model="student_form.training_id" :class="{'is-invalid is-invalid select2 select2-hidden-accessible':student_form.errors.has('training_id')}" class="form-control select2" name="training_id" id="training">
            <option v-for="(item1, index1) in trainingList" :key="index1" :value="item1.id">
              {{ item1.Name }}
            </option>
          </select>
          <has-error :form="student_form" field="training_id"></has-error>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <table
            id="student-list-table"
            class="table w-100 table-bordered table-striped"
          >
            <thead>
              <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Participants</th>
              </tr>
            </thead>
            <tbody id="tbody">
              <tr>
                <td>{{ student.CidNo }}</td>
                <td>{{ student.Name }}</td>
                <td>
                  <input
                    type="checkbox"
                    name="participants"
                    v-model="student_form.participant"
                    class="ml-2 form-control-input"
                  />
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <label class="mb-0.5">Remarks:</label>
          <textarea
            v-model="student_form.remarks"
            placeholder="remarks"
            class="form-control"
            rows="2"
            id="remarks"
          ></textarea>
        </div>
      </div>
      <hr />
      <div class="card-footer text-right">
        <button
          type="button"
          @click="formaction('reset')"
          class="btn btn-flat btn-sm btn-danger"
        >
          <i class="fa fa-redo"></i> Reset
        </button>
        <button
          type="button"
          @click="formaction('save')"
          class="btn btn-flat btn-sm btn-primary"
        >
          <i class="fa fa-save"></i> Save
        </button>
      </div>
    </form>
  </div>
</template>
<script>
export default {
  data() {
    return {
      dt: "",
      byClass: [],
      student: '',
      cid: "",
      trainingList: [],
      class_stream_section: "",
      student_form: new form({
        form_type: "edit",
        id: "",
        participant:"",
        student_id: "",
        std_class: "",
        std_stream: "",
        std_section: "",
        training_id: "",
        remarks: "",
      }),
    };
  },

  methods: {
    getStudents() {
      let uri = "academics/getStudentsForAttendance";
      uri += "?OrgClassStreamId=" + this.OrgClassStreamId;
      if (this.sectionId !== null) {
        uri += "&sectionId=" + this.SectionDetailsId;
      }
      axios
        .get(uri).then((response) => {
            let students = response.data.student;
            students.forEach((std) => {
                if (this.student_form.student_id == std.std_student_id) {
                  this.student_form.participant = true
                  this.student = std;
                }
            });
        })
        .catch(function (error) {
          if (error.toString().includes("500")) {
            $("#tbody").html(
              '<tr><td colspan="7" class="text-center text-danger text-bold">This server down. Please try later</td></tr>'
            );
          }
        });
    },
    loadClassStreamSection() {
      axios
        .get("loadCommons/loadClassStreamSection/userworkingagency/NA")
        .then((response) => {
          let classStreamSections = response.data;
          classStreamSections.forEach((classStreamSection) => {
            if (
              this.OrgClassStreamId == classStreamSection.OrgClassStreamId &&
              (this.SectionDetailsId == classStreamSection.org_section_id ||
                (this.SectionDetailsId == null &&
                  classStreamSection.org_section_id == null))
            ) {
              if (classStreamSection.stream && classStreamSection.section) {
                this.class_stream_section =classStreamSection.class +" " +classStreamSection.stream +" " +classStreamSection.section;
              } else if (classStreamSection.stream) {
                this.class_stream_section =
                  classStreamSection.class + " " + classStreamSection.stream;
              } else if (classStreamSection.section) {
                this.class_stream_section =
                  classStreamSection.class + " " + classStreamSection.section;
              } else {
                this.class_stream_section = classStreamSection.class;
              }
            }
          });
        });
    },
    loadTrainingList(uri = "students/listStudentTrainings/NA") {
      axios
        .get(uri)
        .then((response) => {
          let data = response;
          this.trainingList = data.data.data;
        })
        .catch(function (error) {
          console.log("Error:" + error);
        });
    },
    remove_error(field_id) {
      if ($("#" + field_id).val() != "") {
        $("#" + field_id).removeClass("is-invalid");
        $("#" + field_id + "_err").html("");
      }
    },
    formaction: function (type) {
      if (type == "reset") {
        this.student_form.std_class = "";
        this.student_form.std_stream = "";
      }
      if (type == "save") {
        if(this.student_form.participant == false){
             Swal.fire({
                title: 'Are you sure you want to remove student from this training?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                }).then((result) => {
                    if(result.isConfirmed) {
                        axios.post("/students/saveTrainingParticipants",this.student_form)
                            .then(() => {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Successfully removed student'
                                })
                                this.$router.push('/student_trainings_participants_list');

                            })
                            .catch(function(error){
                            this.errors = error;
                        });
                    }
            })
        }else {
            this.student_form.post("/students/saveTrainingParticipants", this.student_form)
            .then(() => {
              Toast.fire({
                icon: "success",
                title: "Details added successfully",
              });
              this.$router.push("/student_trainings_participants_list");
            })
            .catch(() => {
              console.log("Error......");
            });
      }
        
      }
    },
    async changefunction(id) {
      if ($("#" + id).val() != "") {
        $("#" + id).removeClass("is-invalid select2");
        $("#" + id + "_err").html("");
        $("#" + id).addClass("select2");
      }
      if (id == "training") {
        this.student_form.training_id = $("#training").val();
      }
    },
  },
  mounted() {
    $(".select2").select2();
    $(".select2bs4").select2({
      theme: "bootstrap4",
    });
    $('[data-toggle="tooltip"]').tooltip();
    $(".select2").select2();
    $(".select2").select2({
      theme: "bootstrap4",
    });
    $(".select2").on("select2:select", function (el) {
      Fire.$emit("changefunction", $(this).attr("id"));
    });

    Fire.$on("changefunction", (id) => {
      this.changefunction(id);
    });
    this.getStudents();
    this.loadClassStreamSection();
    this.loadTrainingList()
    this.dt = $("#student-list-table").DataTable();
  },
  created() {
    this.student_form.student_id = this.$route.params.data.std_student_id;
    this.OrgClassStreamId = this.$route.params.data.OrgClassStreamId;
    this.SectionDetailsId = this.$route.params.data.SectionDetailsId;
    this.student_form.training_id = this.$route.params.data.training_id;
    this.student_form.remarks = this.$route.params.data.Remarks;
    this.student_form.id = this.$route.params.data.id;
  },
  watch: {
    student() {
      this.dt.destroy();
      this.$nextTick(() => {
        this.dt = $("#student-list-table").DataTable();
      });
    },
  },
};
</script>