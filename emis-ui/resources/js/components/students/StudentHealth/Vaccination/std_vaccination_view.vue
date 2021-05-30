<template>
    <div>
       <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Vaccine:</label>
                        <select v-model="student_form.screening" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('screening') }" class="form-control select2" name="screening" id="screening">
                            <option v-for="(item, index) in screeningList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="student_form" field="screening"></has-error>
                    </div> 
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Date of Vacination:</label>
                        <input class="form-control" v-model="student_form.date" :class="{ 'is-invalid': student_form.errors.has('date') }" id="date" @change="remove_err('date')" type="date">
                        <has-error :form="student_form" field="date"></has-error>
                    </div> 
                </div>
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Class:</label>
                            <select v-model="student_form.std_class" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('std_class') }" class="form-control select2" name="std_class" id="std_class">
                                <option v-for="(item, index) in screeningList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                            </select>
                            <has-error :form="student_form" field="std_class"></has-error>
                    </div>
                </div>
                <div class="hidden" id="TDvaccine">
                    <div class="form-group row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <table id="transferoption-table" class="table w-100 table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Student vaccinated with TD</th>
                                        <th>Boys</th> 
                                        <th>Girls</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                          Number of Student who received TD at 6 years
                                        </td>
                                        <td>
                                            <input class="form-control" v-model="student_form.td_at6_boys" :class="{ 'is-invalid': student_form.errors.has('td_at6_boys') }" id="td_at6_boys" @change="remove_err('td_at6_boys')" type="number">
                                            <has-error :form="student_form" field="td_at6_boys"></has-error>
                                        </td>
                                         <td>
                                            <input class="form-control" v-model="student_form.td_at6_girls" :class="{ 'is-invalid': student_form.errors.has('td_at6_girls') }" id="td_at6_girls" @change="remove_err('td_at6_girls')" type="number">
                                            <has-error :form="student_form" field="td_at6_girls"></has-error>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                          Number of Student who received TD at 12 years
                                        </td>
                                        <td>
                                            <input class="form-control" v-model="student_form.td_at12_boys" :class="{ 'is-invalid': student_form.errors.has('td_at12_boys') }" id="td_at12_boys" @change="remove_err('td_at12_boys')" type="number">
                                            <has-error :form="student_form" field="date"></has-error>
                                        </td>
                                         <td>
                                            <input class="form-control" v-model="student_form.td_at12_girls" :class="{ 'is-invalid': student_form.errors.has('td_at12_girls') }" id="td_at12_girls" @change="remove_err('td_at12_girls')" type="number">
                                            <has-error :form="student_form" field="td_at12_girls"></has-error>
                                        </td>
                                     </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="hidden" id="HPVvaccine">
                    <div class="form-group row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <table id="transferoption-table" class="table w-100 table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Number of Girls who received 1st Dose</th>
                                        <th>Number of Girls who received 2nd Dose</th> 
                                        <th>Number of Girls who received 3rd Dose</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input class="form-control" v-model="student_form.dose_1" :class="{ 'is-invalid': student_form.errors.has('dose_1') }" id="dose_1" @change="remove_err('dose_1')" type="number">
                                            <has-error :form="student_form" field="dose_1"></has-error>
                                        </td>
                                        <td>
                                            <input class="form-control" v-model="student_form.dose_2" :class="{ 'is-invalid': student_form.errors.has('dose_2') }" id="dose_2" @change="remove_err('dose_2')" type="number">
                                            <has-error :form="student_form" field="dose_2"></has-error>
                                        </td>
                                        <td>
                                            <input class="form-control" v-model="student_form.dose_3" :class="{ 'is-invalid': student_form.errors.has('dose_3') }" id="dose_3" @change="remove_err('dose_3')" type="number">
                                            <has-error :form="student_form" field="dose_3"></has-error>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
    
    data() {
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

            users:
            [{
                class:'',number:'',number1:''
            }] 
        }
    },

    methods: {
        addMore: function(){
            this.users.push({class:'',number:'',number:''})
        },
        remove(index){    
             this.users.splice(index,1);             
        },
    },
    mounted() {
        $('.select2').select2()
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
    },
    
}
</script>