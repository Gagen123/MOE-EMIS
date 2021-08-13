<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs" id="t_form_details">
            <div class="card-body pt-0 mt-1">
                <div class="row">
                    <div class="form-row">
                        <div class="col-md-12">
                        <label class="form-control-label"  for="input-file-import">Upload Data<span class="text-danger">(Excel,CSV)</span></label>
                        <input type="file" class="form-control" :class="{ ' is-invalid' : error.message }" id="input-file-import" name="file_import" ref="import_file"   @change="onFileChange">
                        </div>
                    </div>
                </div><br>
                <div class="tab-content">
                     <div class="tab-pane fade active show tab-content-details" id="application-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="row form-group">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Name of Institutes:<span class="text-danger">*</span></label> 
                                    <select v-model="form.institutes_id" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('institutes_id') }" class="form-control select2" name="institutes_id" id="institutes_id">
                                        <option value=""> -- Select-- </option>
                                        <option v-for="(item, index) in collegeList" :key="index" v-bind:value="item.id">{{ item.collegeName }}</option>
                                    </select>
                                    <has-error :form="form" field="institutes_id"></has-error>
                                <span class="text-danger" id="institutes_id_err"></span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Years:<span class="text-danger">*</span></label> 
                                    <input class="form-control" v-model="form.year" :class="{ 'is-invalid': form.errors.has('year') }" id="year"  type="date">
                                    <has-error :form="form" field="institutes_id"></has-error>
                                <span class="text-danger" id="institutes_id_err"></span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Student Number is Added As?:<span class="text-danger">*</span></label> <br>
                                        <label><input v-model="form.addAs"  type="radio" value="Add to Total" /> Add with Total Numbers</label> &nbsp;&nbsp;
                                        <label><input v-model="form.addAs"  type="radio" value="new Enrollment" /> New Enrollment</label>
                            </div>
                         </div>
                    </div>
                </div>
                <div class="tab-content">
                 <label class="form-control-label"  for="input-file-import">Student Details</label>
                        <div class="form-group row">
                            <div class="card-body col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Number of Male<span class="text-danger">*</span></th>
                                            <th>Number of Female<span class="text-danger">*</span></th>
                                            <th>Total Number<span class="text-danger">*</span></th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                 <input type="number" name="male" id="male" value="0" class="form-control" v-model="form.studentMale"  :class="{ 'is-invalid': form.errors.has('male') }" @change="calculateTotal()"/>    
                                            </td>
                                            <td>                          
                                                <input type="number" name="female" id="female" value="0" class="form-control" v-model="form.studentFemale" :class="{ 'is-invalid': form.errors.has('female') }" @change="calculateTotal()"/>
                                            </td>
                                            <td>
                                                 <input type="number" name="Total"  id="Total"   class="form-control" v-model="form.studentTotal" :class="{ 'is-invalid': form.errors.has('total') }" disabled />
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
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return {
          error: {},
          import_file: '',
           collegeList:[],
            form: new form({
                collegeName:'',
                institutes_id:'',
                addAs:'',
                remarks:'',
                year:'',
                action_type:'add',
                type:'student',
                studentMale:'',studentFemale:'',studentTotal:'',
            })
        }
    },
    methods: {
        LoadInstitutesName(uri="students/ExternalDataImport/loadInstitues/all_institutes"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.collegeList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error:"+error)
            });
        },
        calculateTotal(){
            let total= parseInt($('#male').val()) + parseInt($('#female').val());
                $('#Total').val(total);
                this.form.studentTotal=total;

        },
        onFileChange(e) {
           this.import_file = e.target.files[0];
       },
       formaction: function(type){ 
            if(type=="reset"){
                this.restForm();
            }
             if(type=="save"){
                     this.form.post('students/ExternalDataImport/saveImported/',this.form)
                    .then(() => {
                        Toast.fire({
                            icon: 'success',
                            title: 'Details added successfully'
                        })
                        this.$router.push('/list_student');
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		},
         changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="institutes_id"){
                this.form.institutes_id=$('#institutes_id').val();
            }
        },
     },
    mounted() {
        this.LoadInstitutesName();
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
    },
}
</script>
