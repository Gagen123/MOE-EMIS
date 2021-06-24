<template>
    <div>
        <form class="bootbox-form">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Calander for:</label>
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
                                <template v-if="form.user_type=='Dzongkhag'">
                                    <option value="Intra Transfer">Intra Transfer</option>
                                    <option value="Intra Transfer Appeal">Intra Transfer Appeal</option>
                                </template>
                                <template v-if="form.user_type=='Ministry'">
                                    <option value="Inter Transfer">Inter Transfer</option>
                                    <option value="Inter Transfer Appeal">Inter Transfer Appeal</option>
                                </template>
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
                year: new Date().getFullYear(),
                from_date: '',
                to_date:'',
                type:'',
                status: 1,
                remarks:'',
                user_type:'',
                action_type:'add',
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
                        title: 'Details added successfully'
                    })
                    this.$router.push('/list_calender');
                })
                .catch((error) => {
                    console.log("Error:"+error);
                    if(!$('#type').attr('class').includes('select2-hidden-accessible')){
                        $('#type').addClass('select2-hidden-accessible');
                    }
                })
            }
		},
        checkdate(){
            let date1=$('#from_date').val();
            let date12=$('#to_date').val();
            if(date1!="" && date12!=""){
                if(date1>=date12){
                    Swal.fire({
                        html: "Form date cannot be greater to equal to from date. Please provide correct to date",
                        icon: 'error'
                    });
                    $('#to_date').val('');
                }
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
    mounted(){
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id'));
        });
        Fire.$on('changefunction',(id)=>{
            this.changefunction(id);
        });
        axios.get('common/getSessionDetail')
        .then(response => {
            let data = response.data.data;
            this.form.user_type=data['acess_level'];
        })
        .catch(errors => {
            console.log(errors)
        });
    },
}
</script>
