<template>
    <div>
        <div class="card-body">
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                     <small>(You will be provided the list of previous academic year)</small><br>
                     <label>Class:</label>
                    <select v-model="student_form.std_class" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('std_class') }" @change="aboveClass10()"  class="form-control select2" name="std_class" id="std_class">
                        <option v-for="(item, index) in classList" :key="index" v-bind:value="item.id">{{ item.class }}</option>
                    </select>
                    <has-error :form="student_form" field="std_class"></has-error>
                </div>
            </div>
            <hr>
            <form>
                <div>
                    <table id="allocation-list-table" class="table table-bordered text-sm table-striped">
                        <thead>
                            <tr>
                                <th >SL#</th>
                                <th >Student Name</th>
                                <th >Student Code</th>
                                <th >Class</th>
                                <th >Stream</th>
                                <th >Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr v-for="(item, index) in studentList" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ item.Name}}</td>
                                <td>{{ item.student_code}}</td>
                                <td>{{ item.student_code}}</td>
                                <td>{{ item.student_code}}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-eye"></i > View</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
export default {
   data(){
        return{
            dt:'',
            orgDetails:'',
            classStreamSections:[],
            classList:[],
            sectionList:[],
            streamList:[],
            byClass:[],
            studentList:[],
            cat_data:'',
            student_form: new form({
                std_class: '',
                std_stream: '',
                std_section: '',
                class_section_stream:[],
                date: '',
                std_id: [],
                std_class:[],
                std_section:[],
                std_meals:[],
                std_finance:[],
                std_boarder:[]
            }),
        }
    },

    methods: {
        /**
         * to load the class list
         */
        loadClassList(uri="loadCommons/getOrgClassStream"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.classList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },

        
        getAge(DateOfBirth){
            let date_of_birth = new Date(DateOfBirth);
            var diff_ms = Date.now() - date_of_birth.getTime();
            var age_dt = new Date(diff_ms);
            return Math.abs(age_dt.getUTCFullYear()-1970);
        },
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="std_class"){
                this.student_form.std_class=$('#std_class').val();
                let class_selected = $("#std_class").val();

                axios.get('/students/loadStudentByType/CE/'+$('#std_class').val())
                .then((response) => {
                    this.studentList = response.data; 
                })
                .catch(() => {
                    consoele.log("Error:"+e)
                });
            }
            
        },
        showedit(data){
            this.$router.push({name:'student_profile',params: {data:data}});
        },
    },
    mounted() {
        $('.select2').select2()
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
        $('[data-toggle="tooltip"]').tooltip();
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id')); 
        });
        
        Fire.$on('changefunction',(id)=> {
            this.changefunction(id);
        });

        //get the session details to find out private or public
        axios.get('common/getSessionDetail')
            .then(response => {
                let data = response.data.data;
                let roleName="";
                for(let i=0;i<data['roles'].length;i++){
                    if(i==data['roles'].length-1){
                        roleName+=data['roles'][i].roleName;
                    }
                    else{
                        roleName+=data['roles'][i].roleName+', ';
                    }
                }

                this.getorgName(data['Agency_Code'],data['acess_level']);
            })    
            .catch(errors => { 
                console.log(errors)
            });
        
        this.loadClassList();
        this.dt =  $("#allocation-list-table").DataTable()
    },
    watch: {
        studentList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#allocation-list-table").DataTable();
            });
        }
    },
    
}
</script>