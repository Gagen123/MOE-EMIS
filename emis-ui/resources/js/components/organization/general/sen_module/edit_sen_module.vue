<template>
    <div>
        <form>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Student:<i class="text-danger">*</i></label>
                    <select v-model="student_award_form.student" :class="{ 'is-invalid select2 select2-hidden-accessible': student_award_form.errors.has('student') }" class="form-control select2" name="student" id="student">
                        <option v-for="(item, index) in studentList" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                    </select>
                    <has-error :form="student_award_form" field="student"></has-error>
                </div> 
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="mb-1">Award Given By:<i class="text-danger">*</i></label>
                        <input type="text" @change="remove_error('award_given_by')" v-model="student_award_form.award_given_by" :class="{ 'is-invalid': student_award_form.errors.has('award_given_by') }" class="form-control" name="award_given_by" id="award_given_by" >
                        <has-error :form="student_award_form" field="award_given_by"></has-error>
                    </div> 
                </div>
                <div class="col-sm-4">
                    <!-- select -->
                    <div class="form-group">
                        <label class="mb-0.5">Award Type:<i class="text-danger">*</i></label>
                            <select v-model="student_award_form.award_type_id" :class="{ 'is-invalid select2 select2-hidden-accessible': student_award_form.errors.has('award_type_id') }" class="form-control select2" name="award_type_id" id="award_type_id">
                                <option v-for="(item, index) in awardList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                            </select>
                            <has-error :form="student_award_form" field="award_type_id"></has-error>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Place:<span class="text-danger">*</span></label> 
                    <input class="form-control" v-model="student_award_form.place" :class="{ 'is-invalid': student_award_form.errors.has('place') }" id="place" @change="remove_err('place')" type="text">
                    <has-error :form="student_award_form" field="place"></has-error>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Date:<span class="text-danger">*</span></label> 
                    <input class="form-control" v-model="student_award_form.date" :class="{ 'is-invalid': student_award_form.errors.has('date') }" id="date" @change="remove_err('date')" type="date">
                    <has-error :form="student_award_form" field="date"></has-error>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <label class="mb-0.5">Remarks:</label>
                    <textarea @change="remove_error('remarks')" class="form-control" v-model="student_award_form.remarks" :class="{ 'is-invalid': student_award_form.errors.has('remarks') }" name="remarks" id="remarks"></textarea>
                    <has-error :form="student_award_form" field="remarks"></has-error>
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
            awardList:[],
            id:'2fea1ad2-824b-434a-a608-614a482e66c1',

            student_award_form: new form({
                id:'',
                student: '',
                award_given_by: '',
                award_type_id: '',
                place: '',
                date: '',
                remarks:'',
                action_type:'edit'
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
        loadActiveAwardList(uri="masters/loadActiveStudentMasters/StudentAwards"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.awardList =  data.data.data;
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
                this.student_award_form.student= '';
                this.student_award_form.remarks='';
                this.student_award_form.status= 1;
            }
            if(type=="save"){
                this.student_award_form.post('/students/saveStudentAward',this.student_award_form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/student_awards_list');
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
                this.student_award_form.student=$('#student').val();
            }
            if(id=="award_type_id"){
                this.student_award_form.award_type_id=$('#award_type_id').val();
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

        this.student_award_form.student=this.$route.params.data.StdStudentId;
        $('#student').val(this.$route.params.data.StdStudentId).trigger('change');

        
        this.loadActiveAwardList();
    },
    created() {
        this.loadStudentList();
        
        this.student_award_form.award_type_id=this.$route.params.data.CeaAwardId;
        this.student_award_form.award_given_by=this.$route.params.data.awarded_by;
        this.student_award_form.place=this.$route.params.data.Place;
        this.student_award_form.date=this.$route.params.data.AwardDate;
        this.student_award_form.remarks=this.$route.params.data.Remarks;
        this.student_award_form.id=this.$route.params.data.id;
    },
    
}
</script>