<template>
    <div>
         <form class="p-4 bootbox-form">
            <div class="row form-group">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <label>Training/Workshop/Seminar Title:<span class="text-danger">*</span></label>
                    <input class="form-control" v-model="student_form.name" :class="{ 'is-invalid': student_form.errors.has('name') }" id="name" @change="remove_error('name')" type="text">
                    <has-error :form="student_form" field="name"></has-error>
                </div>
            </div>
             <div class="row form-group">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label> Training Type:<span class="text-danger">*</span></label>
                    <select v-model="student_form.training_type" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('training_type') }" class="form-control select2" name="training_type" id="training_type">
                        <option v-for="(item, index) in trainingList" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                    </select>
                    <has-error :form="student_form" field="training_type"></has-error>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Program:<span class="text-danger">*</span></label>
                    <select v-model="student_form.program" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('program') }" class="form-control select2" name="program" id="program">
                        <option v-for="(item, index) in programList" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                    </select>
                    <has-error :form="student_form" field="program"></has-error>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label> Place:<span class="text-danger">*</span></label>
                        <input class="form-control" v-model="student_form.place" :class="{ 'is-invalid': student_form.errors.has('place') }" id="place" @change="remove_error('place')" type="text">
                        <has-error :form="student_form" field="place"></has-error>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Country<span class="text-danger">*</span></label>
                        <select v-model="student_form.country" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('country') }" class="form-control select2" name="country" id="country">
                        <option v-for="(item, index) in countryList" :key="index" v-bind:value="item.id">{{ item.country_name }}</option>
                    </select>
                    <has-error :form="student_form" field="country"></has-error>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>From Date:<span class="text-danger">*</span></label> 
                    <input class="form-control" v-model="student_form.from_date" :class="{ 'is-invalid': student_form.errors.has('from_date') }" id="from_date" @change="remove_error('from_date')" type="date">
                    <has-error :form="student_form" field="from_date"></has-error>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>To Date:<span class="text-danger">*</span></label> 
                    <input class="form-control" v-model="student_form.to_date" :class="{ 'is-invalid': student_form.errors.has('to_date') }" id="to_date" @change="remove_error('to_date')" type="date">
                    <has-error :form="student_form" field="to_date"></has-error>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
            countryList:[],
            student_form: new form({
                name:'',
                training_type:'',
                program:'',
                country: '',
                place: '',
                from_date: '',
                to_date: '',
                details:'',
                form_type:'add',
            }),
        }
    },
    methods: {
        loadActiveProgramList(uri="masters/loadActiveStudentMasters/CeaProgram"){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.programList =  data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadActiveTrainingList(uri="masters/loadActiveStudentMasters/CeaTrainingType"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.trainingList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadcountryList(uri = 'masters/loadGlobalMasters/all_country'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.countryList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            })
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
                console.log(this.student_form);
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
            if(id=="program"){
                this.student_form.program=$('#program').val();
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
        this.loadcountryList();
        //load country list
        //this.loadActiveTrainingList();
    },
    
}
</script>