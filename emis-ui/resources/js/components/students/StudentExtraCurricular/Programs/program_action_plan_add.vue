<template>
    <div>
        <form>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Program/Club:<i class="text-danger">*</i></label>
                    <select v-model="student_form.program" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('program') }" class="form-control select2" name="program" id="program">
                        <option v-for="(item, index) in programList" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                    </select>
                    <has-error :form="student_form" field="program"></has-error>
                </div>
            </div>
            <label>Plan for the Period:</label>
            <div class="row form-group">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>From:<span class="text-danger">*</span></label>
                    <input class="form-control" v-model="student_form.from_date" :class="{ 'is-invalid': student_form.errors.has('from_date') }" id="from_date" @change="remove_err('from_date')" type="date">
                    <has-error :form="student_form" field="from_date"></has-error>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>To:<span class="text-danger">*</span></label>
                    <input class="form-control" v-model="student_form.to_date" :class="{ 'is-invalid': student_form.errors.has('to_date') }" id="to_date" @change="remove_err('to_date')" type="date">
                    <has-error :form="student_form" field="to_date"></has-error>
                </div>
            </div>
            <div class="card">
                <div class="form-group row">
                    <div class="card-body col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Activity</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="record1" v-for='(plan, index) in student_form.action_plan' :key="index">
                                    <td>
                                        <input type="text" name="title" id="title" class="form-control" v-model="plan.title" :class="{ 'is-invalid': student_form.errors.has('title') }" @change="remove_err('title')"/>
                                        <has-error :student_form="form" field="title"></has-error>
                                    </td>
                                    <td>
                                        <textarea @change="remove_error('description')" class="form-control" v-model="plan.description" :class="{ 'is-invalid': student_form.errors.has('description') }" name="description" id="description"></textarea>
                                        <has-error :student_form="form" field="description"></has-error>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5">
                                        <button type="button" class="btn btn-flat btn-sm btn-primary" id="addMore"
                                        @click="addMore()"><i class="fa fa-plus"></i> Add More</button>
                                        <button type="button" class="btn btn-flat btn-sm btn-danger" id="remove"
                                        @click="remove()"><i class="fa fa-trash"></i> Remove</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
            teacherList:[],
            programList:[],
            supportList:[],
            action_plan: [],
            id:'2fea1ad2-824b-434a-a608-614a482e66c1',

            student_form: new form({
                program: '',
                from_date: '',
                to_date:'',
                action_plan: [],
            }),
        }
    },
    methods: {
        //need to get the organisation id and pass it as a parameter
        loadStudentList(uri='students/loadStudentList/'+this.id){
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
        loadTeacherList(uri='students/loadStudentList/'+this.id){
            axios.get(uri)
            .then(response => {
                let data = response;
                console.log(data);
                this.teacherList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadActiveProgramList(uri="masters/loadActiveStudentMasters/CeaProgram"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.programList =  data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadActiveSupportList(uri="masters/loadActiveStudentMasters/CeaProgramSupporter"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.supportList =  data.data.data;
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
        /**
         * method to add more fields
         */
        addMore: function(){
            this.count++;
            this.student_form.action_plan.push({title:'', description:''})
        },
        /**
         * method to remove fields
         */
        removeStudents(index){
             if(this.student_form.action_plan.length>1){
                this.count--;
                this.student_form.action_plan.splice(index,1);
            }
        },
        formaction: function(type){
            if(type=="reset"){
                this.student_form.student= '';
                this.student_form.remarks='';
                this.student_form.status= 1;
            }
            if(type=="save"){
                this.student_form.post('/students/saveProgramActionPlan',this.student_form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/program_action_plan_list');
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
            if(id=="program"){
                this.student_form.program=$('#program').val();
            }
            if(id=="supporter"){
                this.student_form.supporter=$('#supporter').val();
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
        this.loadTeacherList();
        this.loadActiveProgramList();
        this.loadActiveSupportList();
    },

}
</script>
