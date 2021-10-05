<template>
    <div>
        <form class="bootbox-form" id="counsellingId">
           <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pt-2">
                        <label>Training Type:<span class="text-danger">*</span></label> 
                        <input class="form-control" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" id="name" @change="remove_err('name')" type="text" autocomplete="off">
                        <has-error :form="form" field="name"></has-error>
                    </div><br>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pt-2">
                        <label>Description:</label>
                        <textarea class="form-control" v-model="form.description" :class="{ 'is-invalid': form.errors.has('description') }" id="description" @change="remove_err('description')" autocomplete="off"></textarea>
                        <has-error :form="form" field="description"></has-error>
                    </div><br>
                     <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pt-2">
                        <label>Code:<span class="text-danger">*</span></label> 
                        <input class="form-control" v-model="form.code" :class="{ 'is-invalid': form.errors.has('code') }" id="code" @change="remove_err('code')" type="text" autocomplete="off">
                        <has-error :form="form" field="code"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pt-2">
                        <label class="required">Status:</label><br>
                        <label><input v-model="form.status"  type="radio" value="1" /> Active</label>
                        <label><input v-model="form.status"  type="radio" value="0" /> Inactive</label>
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
                name: '',
                description: '',
                code:'',
                status: 1,
                model:'CeaTrainingType',
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
                this.form.name= '';
                this.form.description='';
                this.form.status= 1;
            }
            if(type=="save"){
                this.submitstudentmaster('training_type_list');
            }
		}, 
    },
    created() {
    },
    
}
</script>