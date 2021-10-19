<template>
    <div>
        <div class="ml-1 row form-group">
              <div class="mr-3">
                <strong>Class: </strong> {{class_stream_section}}
              </div>
               <div class="mr-3">
                <strong>Academic Year: </strong> {{ academic_year }}
              </div>
            </div>  
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="view-stduent-progress-report-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Roll No.</th>
                            <th>Name</th>
                            <th>Student Code</th>
                            <th>Citizenship ID No.  </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr v-for="(item, index) in students" :key="index">
                            <td>{{ item.roll_no }}</td>
                            <td> {{ item.name }}</td>
                            <td> {{ item.student_code }}</td>
                            <td> {{ item.cid }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <div class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"> <i class="fas fa-eye"></i > View/Print Progress Report</div>
                                </div>
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
            students:[],
            id:'',
            class_stream_section:'',
            academic_year:0,
            term_name:'',
            transcript_format:'',
            dt:''
        }
    },
    methods:{
        getStudentsForProgressReport(){
            axios.get('academics/getStudentsForProgressReport/'+this.id).then(response => {
                this.students = response.data.data
            })
        },
        showedit(data){
            if(this.transcript_format == 1){
                this.$router.push({name:'student_progress_report_cfa',params: {data:data}});
            }else if(this.transcript_format == 2){
                this.$router.push({name:'student_progress_report_csa',params: {data:data}});
            }
        },
    },
    mounted(){ 
        this.getStudentsForProgressReport()
        this.dt =  $("#view-stduent-progress-report-table").DataTable({
            columnDefs: [
                { width: 20, targets: 0},
                { width: 200, targets: 2},
                { width: 200, targets: 3},

            ],
        });
    },
    created(){
        this.id=this.$route.params.data.id;
        this.class_stream_section=this.$route.params.data.class;
        this.academic_year=this.$route.params.data.academic_year;
        this.term_name=this.$route.params.data.term_name;
        this.transcript_format=this.$route.params.data.transcript_format;
    },
    watch: {
        students(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#view-stduent-progress-report-table").DataTable({
                    columnDefs: [
                        { width: 20, targets: 0},
                        { width: 200, targets: 2},
                        { width: 200, targets: 3},
                    ],
                })
            });
        }
    }
}
</script>
 