<template>
    <div>
        <form class="bootbox-form">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Transfer Window for:</label>
                        <input class="form-control" v-model="form.year" :class="{ 'is-invalid': form.errors.has('year') }" id="year" @change="remove_err('year')" type="text" readonly>
                        <has-error :form="form" field="year"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>From date:<span class="text-danger">*</span></label>
                        <input class="form-control" v-model="form.from_date" :class="{ 'is-invalid': form.errors.has('from_date') }" id="from_date" @change="remove_err('from_date'),checkdate('from_date')" type="date">
                        <has-error :form="form" field="from_date"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>To date:<span class="text-danger">*</span></label>
                        <input class="form-control" v-model="form.to_date" :class="{ 'is-invalid': form.errors.has('to_date') }" id="to_date" @change="remove_err('to_date'),checkdate('to_date')" type="date">
                        <has-error :form="form" field="to_date"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Calander For:</label>
                        <select class="form-control select2" id="type" v-model="form.type" :class="{ 'is-invalid': form.errors.has('type') }">
                            <option value="">--Select--</option>
                            <option value="Staff Transfer">Staff Transfer</option>
                        </select>
                        <has-error :form="form" field="type"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>Remarks:</label>
                        <textarea class="form-control" @change="remove_err('remarks')" v-model="form.remarks" :class="{ 'is-invalid': form.errors.has('remarks') }" id="remarks"></textarea>
                        <has-error :form="form" field="remarks"></has-error>
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
            form: new form({
                id: '',
                year: '',
                from_date: '',
                to_date:'',
                type:'',
                status: '',
                remarks:'',
                action_type:'edit',
                record_type:'calender',
            })
        }
    },
    methods: {
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },
		formaction: function(type){
            if(type=="reset"){
                this.form.from_date= '';
                this.form.to_date= '';
                this.remarks='';
            }
            if(type=="save"){
                this.form.post('/masters/saveGlobalMasters',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details updated successfully'
                    })
                    this.$router.push('/list_calender');
                })
                .catch(() => {
                    console.log("Error.")
                })
            }
		},
        changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="type"){
                this.form.type=$('#type').val();
            }
        }
    },
    created() {
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
        this.form.id=this.$route.params.data.id;
        this.form.year=this.$route.params.data.year;
        this.form.from_date=this.$route.params.data.from_date;
        this.form.to_date=this.$route.params.data.to_date;
        this.form.remarks=this.$route.params.data.remarks;

        this.form.type=this.$route.params.data.type;
        $('#type').val(this.$route.params.data.type).trigger('change');
        this.form.status=this.$route.params.data.status;
    },
}
</script>
