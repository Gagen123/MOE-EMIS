<template>
<div class="container-fluid">
    <div class="card card-primary card-outline">
           <table class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <tr class="bg-cyan">
                  <td colspan="2"><b>View Your Results</b></td>
              </tr>
           </table>

          <div class="card-body">
            <div class="form-group row">
                <button type="button" class="btn btn-outline-primary btn-sm" v-on:click="printResult">
                    <i class="fas fa-print">Print</i>
                </button>
            </div>
          <div class="form-group row">
            <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> -->
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Student Name:</label>
                    <span class="text-blue text-bold">{{this.form.name}}</span>
                    <has-error :form="form" field="name"></has-error>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Student Code:</label>
                    <span class="text-blue text-bold">{{this.form.code}}</span>
                    <has-error :form="form" field="code"></has-error>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Academic Year:</label>
                    <span class="text-blue text-bold">{{this.form.aca_year}}</span>
                    <has-error :form="form" field="code"></has-error>
                </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mt-4">
                <label class="text-blue text-bold">Term I Result (སློབ་དུས་ ༡ པ།):</label>  
                <table  class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                        <th style="width:10%">SlNo</th>
                        <th style="width:30%">Subjects</th> 
                        <th style="width:20%">Term I CA</th> 
                        <th style="width:20%">Term I Exam</th> 
                        <th style="width:20%">Position</th> 
                        </tr>
                    </thead>
                     <tbody>
                        <tr v-for="(item, index) in ResultLists" :key="index">
                            <td>{{ index + 1 }}</td>
                            <td>{{item.subject}} ({{item.sub_dzo_name}})</td>
                            <td>{{ item.t1_ca_score}}</td>
                            <td>{{ item.t1_exam_score}}</td>
                            <td>{{ item.t1_position}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mt-4">
                <label class="text-blue text-bold">Term II Result (སློབ་དུས་ ༢ པ།):</label>  
                <table  class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                        <th style="width:10%">SlNo</th>
                        <th style="width:30%">Subjects</th> 
                        <th style="width:20%">Term II CA</th> 
                        <th style="width:20%">Term II Exam</th> 
                        <th style="width:20%">Position</th> 
                        </tr>
                    </thead>
                     <tbody>
                        <tr v-for="(item, index) in ResultLists" :key="index">
                            <td>{{ index + 1 }}</td>
                            <td>{{item.subject}}({{item.sub_dzo_name}})</td>
                            <td>{{ item.t2_ca_score}}</td>
                            <td>{{ item.t2_exam_score}}</td>
                            <td>{{ item.t2_position}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-4">
                  <label class="text-blue text-bold">Final Result ({{this.form.term_dzo_name}})</label>  
                <table  class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                        <th style="width:10%">SlNo</th>
                        <th style="width:20%">Subjects</th> 
                        <th style="width:15%">CA Result</th> 
                        <th style="width:15%">Written Exam Marks</th> 
                        <th style="width:15%">Final Marks</th> 
                        <th style="width:15%">Position</th> 
                        <th style="width:10%">Status</th> 
                        </tr>
                    </thead>
                     <tbody>
                        <tr v-for="(item, index) in ResultLists" :key="index">
                            <td>{{ index + 1 }}</td>
                            <td>{{item.subject}}({{item.sub_dzo_name}})</td>
                            <td>{{ item.ca_score}}</td>
                            <td>{{ item.exam_score}}</td>
                            <td>{{ item.score}}</td>
                            <td>{{ item.position}}</td>
                            <td><span>{{ item.promoted==  1 ? "Pass" : "Fail" }}</span></td>
                        </tr>
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
            TermIResultLists:[],
            TermIIResultLists:[],
              form: new form({
                  name:'',
                  term:'',
                  code:'',
                  aca_year:'',
              })
        }

    },
    methods:{
        LoadFinalResultByStudentId(std_code){
          axios.get('results/LoadFinalResultByStudentId/' +std_code)
                .then(response => {
                  if(response.data.data!="" && response.data.data!=null){
                    let data = response.data.data;
                    this.ResultLists=data;
                    this.form.aca_year=data[0].academic_year;
                    this.form.term_dzo_name=data[0].term_dzo_name;
                  }
                  else{
                    Swal.fire({
                      text: "Your result is not pubished yet, Please wait until it is publish from your organization!",
                      icon: 'warning',
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Okay!',
                      })
                  }
                });
        },
        printResult(){
            window.print();
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
            this.form.code=data['std_id'];
            // this.code=data['std_code'];
            this.type=data['user_type'];
            this.email=data['email'];
            this.form.name=data['full_name'];
            this.contact=data['phone_number'];
            this.LoadFinalResultByStudentId(this.form.code);
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
    // watch: {
    //     ResultLists(val) {
    //         this.dt.destroy();
    //         this.$nextTick(() => {
    //             this.dt = $("#result-term-table").DataTable({
    //                 "order": [[ 0, "asc" ]],
    //                 "lengthChange": false,
    //                 "searching": false,
    //             })
    //         });
    //     }
    // }
        
}
</script>
