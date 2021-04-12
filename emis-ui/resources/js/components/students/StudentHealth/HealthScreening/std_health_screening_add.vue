<template>
    <div>
       <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Screening:</label>
                        <select v-model="student_form.screening" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('screening') }" class="form-control select2" name="screening" id="screening">
                            <option v-for="(item, index) in screeningList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="student_form" field="screening"></has-error>
                    </div> 
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Date of Screening:</label>
                        <input class="form-control" v-model="student_form.date" :class="{ 'is-invalid': student_form.errors.has('date') }" id="date" @change="remove_err('date')" type="date">
                    <has-error :form="student_form" field="date"></has-error>
                    </div> 
                </div>
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Prepared by:</label>
                        <input type="text" @change="remove_error('prepared_by')" v-model="student_form.award_given_by" :class="{ 'is-invalid': student_form.errors.has('prepared_by') }" class="form-control" name="prepared_by" id="prepared_by" >
                        <has-error :form="student_form" field="prepared_by"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Position Title:</label>
                        <select v-model="student_form.screening_position" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('screening_position') }" class="form-control select2" name="screening_position" id="screening_position">
                            <option v-for="(item, index) in screeningTitle" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="student_form" field="screening_position"></has-error>
                    </div> 
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Endorsed By:</label>
                        <select v-model="student_form.screening_endorsed_by" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('screening_endorsed_by') }" class="form-control select2" name="screening_endorsed_by" id="screening_endorsed_by">
                            <option v-for="(item, index) in screeningEndorser" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="student_form" field="screening_endorsed_by"></has-error>
                    </div> 
                </div>
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <table id="transferoption-table" class="table w-100 table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Screening Record</th>
                                    <th>Boys </th> 
                                    <th>Girls</th>
                                </tr>
                            </thead>
                            <tbody id="table_data_populate">
                                <tr>
                                    <td>
                                        Number of Students Screened
                                    </td>
                                    <td>
                                        <input type="number" @change="remove_error('boys_screened')" v-model="student_form.boys_screened" :class="{ 'is-invalid': student_form.errors.has('boys_screened') }" class="form-control" name="boys_screened" id="boys_screened" >
                                        <has-error :form="student_form" field="boys_screened"></has-error>
                                    </td>
                                    <td>
                                        <input type="number" @change="remove_error('girls_screened')" v-model="student_form.girls_screened" :class="{ 'is-invalid': student_form.errors.has('girls_screened') }" class="form-control" name="girls_screened" id="girls_screened" >
                                        <has-error :form="student_form" field="girls_screened"></has-error>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Number of Students Referred for evaluation and treatment
                                    </td>
                                    <td>
                                        <input type="number" @change="remove_error('boys_referred')" v-model="student_form.boys_referred" :class="{ 'is-invalid': student_form.errors.has('boys_referred') }" class="form-control" name="boys_referred" id="boys_referred" >
                                         <has-error :form="student_form" field="boys_referred"></has-error>
                                    </td>
                                    <td>
                                        <input type="number" @change="remove_error('girls_referred')" v-model="student_form.girls_referred" :class="{ 'is-invalid': student_form.errors.has('girls_referred') }" class="form-control" name="girls_referred" id="girls_referred" >
                                        <has-error :form="student_form" field="girls_referred"></has-error>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="card-footer text-right">
                    <button type="button" @click="formaction('reset')" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-redo"></i> Reset</button>
                    <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </div>
    </div> 
</template>
<script>
export default {
    data(){
        return {
            screeningList:[],
            screeningTitle:[],
            screeningEndorser:[],
            id:'2fea1ad2-824b-434a-a608-614a482e66c1',

            student_form: new form({
                screening: '',
                screening_position: '',
                screening_endorsed_by: '',
                date: '',
            }),
        }
    },
    methods: {
        loadActiveScreeningList(uri="masters/loadActiveStudentMasters/health_screening"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.screeningList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadActiveScreeningTitleList(uri="masters/loadActiveStudentMasters/screening_position"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.screeningTitle =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadActiveScreeningEndorserList(uri="masters/loadActiveStudentMasters/screening_endorser"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.screeningEndorser =  data.data.data;
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
                this.student_form.post('/students/saveStudentHealthScreening',this.student_form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/std_health_screening_list');
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

        this.loadActiveScreeningList();
        this.loadActiveScreeningTitleList();
        this.loadActiveScreeningEndorserList();
    },
    
}
</script>