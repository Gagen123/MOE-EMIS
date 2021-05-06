<template>
    <div>
        <form>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Student:<i class="text-danger">*</i></label>
                    <select v-model="student_form.student" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('student') }" class="form-control select2" name="student" id="student">
                        <option v-for="(item, index) in studentList" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                    </select>
                    <has-error :form="student_form" field="student"></has-error>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label> Scout</label>
                        <select v-model="student_form.scout" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('scout') }" class="form-control select2" name="scout" id="scout">
                        <option v-for="(item, index) in scoutList" :key="index" v-bind:value="item.id">{{ item.scout_name }}</option>
                    </select>
                    <has-error :form="student_form" field="scout"></has-error>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Joining Date:</label>
                        <input class="form-control" v-model="student_form.date" :class="{ 'is-invalid': student_form.errors.has('date') }" id="date" @change="remove_err('date')" type="date">
                        <has-error :form="student_form" field="date"></has-error>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="button" @click="formaction('reset')" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-redo"></i> Reset</button>
                <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    data(){
        return {
            studentList:[],
            scoutList:[],
            org_id:'2fea1ad2-824b-434a-a608-614a482e66c1',

            student_form: new form({
                id:'',
                student: '',
                scout:'',
                date: '',
                action_type:'add',
            }),
        }
    },
    methods: {
        //need to get the organisation id and pass it as a parameter
        loadStudentList(uri='students/loadStudentList/'+this.org_id){
            axios.get(uri)
            .then(response => {
                let data = response;
                console.log(data);
                this.studentList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadActiveScoutList(uri='students/listStudentScouts/'+this.org_id){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.scoutList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadActiveRoleList(uri="masters/loadActiveStudentMasters/program_role"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.roleList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },
        formaction: function(type){
            if(type=="reset"){
                this.student_form.student= '';
                this.student_form.remarks='';
                this.student_form.status= 1;
            }
            if(type=="save"){
                this.student_form.post('/students/saveScoutParticipants',this.student_form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/student_scouts_members_list');
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		},
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="student"){
                this.student_form.student=$('#student').val();
            }
            if(id=="scout"){
                this.student_form.scout=$('#scout').val();
            }
        },
    },
     mounted() {
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

        this.loadStudentList();
        this.loadActiveScoutList();
        this.loadActiveRoleList();
    },
    
}
</script>