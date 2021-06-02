<template>
    <div>
        <form>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Disaster Type:<i class="text-danger">*</i></label>
                    <select v-model="student_form.student" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('student') }" class="form-control select2" name="student" id="student">
                        <option v-for="(item, index) in studentList" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                    </select>
                    <has-error :form="student_form" field="student"></has-error>
                </div> 
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="mb-1">Name:<i class="text-danger">*</i></label>
                        <input type="text" @change="remove_error('last_class_attended')" v-model="student_form.last_class_attended" :class="{ 'is-invalid': student_form.errors.has('last_class_attended') }" class="form-control" name="last_class_attended" id="last_class_attended" >
                        <has-error :form="student_form" field="last_class_attended"></has-error>
                    </div> 
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="mb-1">CID:<i class="text-danger">*</i></label>
                        <input type="text" @change="remove_error('last_class_attended')" v-model="student_form.last_class_attended" :class="{ 'is-invalid': student_form.errors.has('last_class_attended') }" class="form-control" name="last_class_attended" id="last_class_attended" >
                        <has-error :form="student_form" field="last_class_attended"></has-error>
                    </div> 
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="mb-1">Email:<i class="text-danger">*</i></label>
                        <input type="text" @change="remove_error('last_class_attended')" v-model="student_form.last_class_attended" :class="{ 'is-invalid': student_form.errors.has('last_class_attended') }" class="form-control" name="last_class_attended" id="last_class_attended" >
                        <has-error :form="student_form" field="last_class_attended"></has-error>
                    </div> 
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="mb-1">Contact No:<i class="text-danger">*</i></label>
                        <input type="text" @change="remove_error('last_class_attended')" v-model="student_form.last_class_attended" :class="{ 'is-invalid': student_form.errors.has('last_class_attended') }" class="form-control" name="last_class_attended" id="last_class_attended" >
                        <has-error :form="student_form" field="last_class_attended"></has-error>
                    </div> 
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="mb-1">Serving As:<i class="text-danger">*</i></label>
                        <input type="text" @change="remove_error('last_class_attended')" v-model="student_form.last_class_attended" :class="{ 'is-invalid': student_form.errors.has('last_class_attended') }" class="form-control" name="last_class_attended" id="last_class_attended" >
                        <has-error :form="student_form" field="last_class_attended"></has-error>
                    </div> 
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <label class="mb-0.5">Place of Work and Address:</label>
                    <textarea @change="remove_error('reasons')" class="form-control" v-model="student_form.reasons" :class="{ 'is-invalid': student_form.errors.has('reasons') }" name="reasons" id="reasons"></textarea>
                    <has-error :form="student_form" field="reasons"></has-error>
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
            org_id:'2fea1ad2-824b-434a-a608-614a482e66c1',

            student_form: new form({
                id:'',
                student: '',
                last_class_attended: '',
                date: '',
                current_address: '',
                reasons: '',
                current_engagement:'',
                action_type:'add'
            }),
        }
    },
    methods: {
        //need to get the organisation id and pass it as a parameter
        
        loadStudentList(uri='students/loadStudentWhereabouts/'+this.org_id){
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
                this.student_form.post('/students/saveStudentWhereabouts',this.student_form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/student_update_list');
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
            if(id=="award_type_id"){
                this.student_form.award_type_id=$('#award_type_id').val();
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
    },
    
}
</script>