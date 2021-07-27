<template>
    <div>
        <form class="bootbox-form" id="foodSourceId">
           <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Source Of Food Type:<span class="text-danger">*</span></label> 
                        <input class="form-control" v-model="form.Name" :class="{ 'is-invalid': form.errors.has('Name') }" id="Name" @change="remove_err('Name')" type="text" tabindex="1" autofocus="true">
                        <has-error :form="form" field="Name"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Description:</label> 
                        <textarea class="form-control" v-model="form.Description" :class="{ 'is-invalid': form.errors.has('Description') }" id="Description" type="text"/>
                        <has-error :form="form" field="Description"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="required">Status:</label>
                        <br>
                        <label><input v-model="form.Status"  type="radio" value="1" tabindex="2"/> Active</label>
                        <label><input v-model="form.Status"  type="radio" value="0" tabindex="3"/> Inactive</label>
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
                id: '',
                Name: '',
                Description: '',
                Status: 1,
                record_type:'FoodSourceType',
              //  action_type:'add',
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
                this.form.Name= '';
                this.form.Description='';
                this.form.Status= 1;
            }
            if(type=="save"){
                this.form.post('/masters/saveFoodSourceType',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/foodSource_type_list');
                })
                .catch((err) => {
                    console.log("Error"+err)
                })
            }
		}, 
    },
    created() {
    },
    
}
</script>