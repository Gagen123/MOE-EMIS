<template>
    <div>
        <table id="list-student-table" class="table table-bordered table-striped table-head-fixed">
            <thead>
                <tr>
                     <th >No.</th>
                     <th >Student CID</th>
                     <th >Student Name</th>
                     <th >Class</th>
                     <th >Date of Application</th>
                     <th >Decision On Behalf of Student</th>
                     <!-- <th >Action</th> -->
                </tr>
            </thead>
            <tbody>
                <tr v-for="(std, index) in stdList" :key="index">
                    <td>{{ index + 1 }} </td>
                    <td>{{ std.CidNo }}</td>
                    <td>{{ std.FirstName }} {{ std.MiddleName }} {{ std.LastName }}</td>
                    <td>{{  }}</td>
                    <td>{{ std.dateOfapply }}</td>
                    <td>
                        <template v-if="std.school_decision=='Accepted' && std.student_decision!='Accepted' && std.student_decision!='Rejected'">
                            <button type="button" class="btn btn-flat btn-sm btn-primary" id="remove"
                            @click="remove('Accepted',std.StdAdmissionsSchoolsId)"><i class="fa fa-check"></i> Accept</button>
                            <button type="button" class="btn btn-flat btn-sm bg-success" id="remove"
                            @click="remove('Rejected',std.StdAdmissionsSchoolsId)"><i class="fa fa-times pr-2"></i> Reject</button>
                        </template>
                    </td>
                    <!-- <td>
                        <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="loadeditpage(std.id)"><span clas="fa fa-edit"></span>Veiw/Edit</a>
                    </td> -->
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    components: {
    },
    data() {
        return {
            stdList:[],
            dt:'',
            class_form: new form({
                dzongkhag:'',
                org:'',
                class:'',
                stream:'',
                section:'',
            }),
        }
    },
    methods: {
        loadeditpage(id){
            // this.$router.push({name:'edit_student_admission',params: {data:id}});
        },
        loadStudentList(param){
            this.stdList =[];
            let uri="";
            if(param=="session"){
                uri='students/admission/loadStudentList/created';
                axios.get(uri)
                .then(response => {
                    let data = response.data;
                    this.stdList = data;
                });
            }
            else{
                this.class_form.post('students/admission/loadStudentListwithsearch')
                .then((response) => {
                    this.stdList = response.data.data;
                    this.applyselect();
                })
                .catch((error) => {
                    Toast.fire({
                        icon: 'error',
                        title: 'Unexpected error occured. Try again.'
                    });
                    this.applyselect();
                    console.log("Error:"+error);
                });
            }
        },
        /**
         * method to remove fields
         */
        remove(type,id){
            Swal.fire({
                text: "Please confirm your decision",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
            }).then((result) => {
                if(result.isConfirmed){
                    axios.get('/students/admission/deleteclassDetails/'+id+'__'+type)
                    .then((response) => {
                        let data=response.data;
                        this.student_form.dzongkhag='';
                        this.student_form.school='';
                        this.student_form.class='';
                        this.loadadmissions();
                    })
                    .catch((error) => {
                        console.log("Error remove:"+error);
                    })
                }
            });
        },
        applyselect(){
            if(!$('#dzongkhag').attr('class').includes('select2-hidden-accessible')){
                $('#dzongkhag').addClass('select2-hidden-accessible');
            }
            if(!$('#org').attr('class').includes('select2-hidden-accessible')){
                $('#org').addClass('select2-hidden-accessible');
            }
            if(!$('#class').attr('class').includes('select2-hidden-accessible')){
                $('#class').addClass('select2-hidden-accessible');
            }
            if(!$('#stream').attr('class').includes('select2-hidden-accessible')){
                $('#stream').addClass('select2-hidden-accessible');
            }
            if(!$('#section').attr('class').includes('select2-hidden-accessible')){
                $('#section').addClass('select2-hidden-accessible');
            }
        },
    },
    mounted(){
        this.loadStudentList('session');
        $('.select2').select2();
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id'));
        });

        Fire.$on('changefunction',(id)=> {
            this.changefunction(id);
        });
        $("#list-student-table").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
        
        this.dt =  $("#list-student-table").DataTable();
    },

    watch: {
        stdList() {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#list-student-table").DataTable()
            });
        }
    },
}
</script>
