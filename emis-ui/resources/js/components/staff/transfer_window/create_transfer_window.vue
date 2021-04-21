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
                status: 1,
                remarks:'',
                action_type:'add',
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
                this.form.post('/staff/saveTransferWindow')
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/list_transfer_window');
                })
                .catch(() => {
                    console.log("Error.")
                })
            }
		}, 
    },
}
</script>