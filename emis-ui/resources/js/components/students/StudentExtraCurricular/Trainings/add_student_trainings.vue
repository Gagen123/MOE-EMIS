<template>
    <div>
        <form>
            <div class="row">
                <div class="col-sm-8">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Training/Workshop/Seminar Title:</label>
                        <input class="form-control" v-model="student_form.name" :class="{ 'is-invalid': student_form.errors.has('name') }" id="name" @change="remove_err('name')" type="text">
                        <has-error :form="student_form" field="name"></has-error>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label> Training Type</label>
                        <select v-model="student_form.training_type" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('training_type') }" class="form-control select2" name="training_type" id="training_type">
                        <option v-for="(item, index) in trainingList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <has-error :form="student_form" field="training_type"></has-error>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Program</label>
                        <select v-model="student_form.program_id" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('program_id') }" class="form-control select2" name="program_id" id="program_id">
                        <option v-for="(item, index) in programList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <has-error :form="student_form" field="program_id"></has-error>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label> Place</label>
                        <input class="form-control" v-model="student_form.place" :class="{ 'is-invalid': student_form.errors.has('place') }" id="place" @change="remove_err('place')" type="text">
                        <has-error :form="student_form" field="place"></has-error>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Country</label>
                        <select v-model="student_form.country" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('country') }" class="form-control select2" name="country" id="country">
                        <option v-for="(item, index) in countryList" :key="index" v-bind:value="item.country">{{ item.country }}</option>
                    </select>
                    <has-error :form="student_form" field="country"></has-error>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>From Date:<span class="text-danger">*</span></label> 
                    <input class="form-control" v-model="student_form.from_date" :class="{ 'is-invalid': student_form.errors.has('from_date') }" id="from_date" @change="remove_err('from_date')" type="date">
                    <has-error :form="student_form" field="from_date"></has-error>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>To Date:<span class="text-danger">*</span></label> 
                    <input class="form-control" v-model="student_form.to_date" :class="{ 'is-invalid': student_form.errors.has('to_date') }" id="to_date" @change="remove_err('to_date')" type="date">
                    <has-error :form="student_form" field="to_date"></has-error>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <label class="mb-0.5">Details:</label>
                    <textarea @change="remove_error('details')" class="form-control" v-model="student_form.details" :class="{ 'is-invalid': student_form.errors.has('details') }" name="details" id="details"></textarea>
                    <has-error :form="student_form" field="details"></has-error>
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
            programList:[],
            trainingList:[],
            countryList:[{country:"Bhutan"}],
            id:'2fea1ad2-824b-434a-a608-614a482e66c1',

            student_form: new form({
                name:'',
                country: '',
                place: '',
                from_date: '',
                to_date: '',
                details:'',
            }),
        }
    },
    methods: {
        loadActiveProgramList(uri="masters/loadActiveStudentMasters/program_name"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.programList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadActiveTrainingList(uri="masters/loadActiveStudentMasters/training_type"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.trainingList =  data.data.data;
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
                this.student_form.place= '';
                this.student_form.name='';
            }
            if(type=="save"){
                this.student_form.post('/students/saveStudentTraining',this.student_form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/student_trainings_list');
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
            if(id=="country"){
                this.student_form.country=$('#country').val();
            }
            if(id=="training_type"){
                this.student_form.training_type=$('#training_type').val();
            }
            if(id=="program_id"){
                this.student_form.program_id=$('#program_id').val();
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

        this.loadActiveProgramList();
        this.loadActiveTrainingList();
        //load country list
        //this.loadActiveTrainingList();
    },
    
}
</script>