<template>
    <div>
        <form class="bootbox-form">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Holiday Date:<span class="text-danger">*</span></label>
                        <input class="form-control" v-model="form.holiday_date" :class="{ 'is-invalid': form.errors.has('holiday_date') }" id="holiday_date" @change="remove_err('holiday_date')" type="date">
                        <has-error :form="form" field="display_order"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Description:<span class="text-danger">*</span></label>
                        <textarea  class="form-control" v-model="form.description" :class="{ 'is-invalid': form.errors.has('description') }" id="description" @change="remove_err('description')" /></textarea >
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
    data() {
        return {
            form: new form({
                holiday_date:'',
                description:'',
                record_type:'national_holiday',
                action_type:'add',
            })
        }
    },
    methods: {
        remove_err(field_id){
            if($('#' + field_id).val()!=""){
                $('#' + field_id).removeClass('is-invalid')
            }
        },
		formaction: function(type){
            if(type=="reset"){
                this.form.holiday_date= '';
                this.form.description= '';
            }
            if(type=="save"){
                this.form.post('/masters/saveAcademicMasters',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/list-national-holiday');
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		}, 
    },
      mounted(){ 
        
    },
}
</script>