<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs" id="t_form_details">
            <div class="card-body pt-0 mt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="application-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="row form-group">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Years:<span class="text-danger">*</span></label>
                                <input class="form-control" v-model="form.year" :class="{ 'is-invalid': form.errors.has('year') }" id="year"  type="text">
                                <has-error :form="form" field="institutes_id"></has-error>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Age Group:<span class="text-danger">*</span></label>
                                <select v-model="form.agegroup" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('agegroup') }" class="form-control select2" name="agegroup" id="agegroup">
                                    <option value=""> -- Select-- </option>
                                    <option value="3-5"> 3-5 </option>
                                    <option value="5-12"> 5-12 </option>
                                    <option value="5-16"> 5-16 </option>
                                    <option value="13-18"> 13-18 </option>
                                </select>
                                <has-error :form="form" field="agegroup"></has-error>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Total Male:<span class="text-danger">*</span></label>
                                <input class="form-control" @change="calculateTotal()" v-model="form.male" :class="{ 'is-invalid': form.errors.has('male') }" id="male"  type="number">
                                <has-error :form="form" field="male"></has-error>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Total Female:<span class="text-danger">*</span></label>
                                <input class="form-control" @change="calculateTotal()" v-model="form.female" :class="{ 'is-invalid': form.errors.has('female') }" id="female"  type="number">
                                <has-error :form="form" field="female"></has-error>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Total:<span class="text-danger">*</span></label>
                                <input class="form-control" v-model="form.total" :class="{ 'is-invalid': form.errors.has('total') }" id="total" readonly type="number">
                                <has-error :form="form" field="total"></has-error>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
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
                year:'',
                agegroup:'',
                male:'',
                female:'',
                total:0,
                action_type:'add',
                model:'NsbModel',
            })
        }
    },
    methods: {
        calculateTotal(){
            let total= parseInt($('#male').val()) + parseInt($('#female').val());
            $('#total').val(total);
            this.form.total=total;
        },

        formaction: function(type){
            if(type=="save"){
                this.form.post('students/ExternalDataImport/saveImported/',this.form)
                .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/list_nsb');
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
            if(id=="agegroup"){
                this.form.agegroup=$('#agegroup').val();
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
    },
}
</script>
