<template>
<div>
    <form class="bootbox-form" id="termId">
            <div class="card-body">
                
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Term Name:<span class="text-danger">*</span></label> 
                        <input class="form-control" v-model="form.termName" :class="{ 'is-invalid': form.errors.has('ter_name') }" id="termName" @change="remove_err('termName')" type="text" tabindex="1" autofocus="true">
                        <has-error :form="form" field="ter_name"></has-error>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="required">Status:</label>
                        <br>
                        <label><input v-model="form.status"  type="radio" value="1" tabindex="2"/> Active</label>
                        <label><input v-model="form.status"  type="radio" value="0" tabindex="3"/> Inactive</label>
                    </div>
                </div>          
            </div>
            <div class="card-footer text-right">
                <button type="button" @click="formaction('reset')" class="btn btn-flat btn-sm btn-danger" tabindex="5"><i class="fa fa-redo"></i> Reset</button>
                <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary" tabindex="4"><i class="fa fa-save"></i> Save</button>
            </div>
    </form>
</div>
    
</template>

<script>
export default {
    data(){
        return{
            count:10,
            form: new form({
                id: '',
                termName: '',
                status: 1,
                // action_type:'add',
            })
        }
    },

    methods:{
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },
        formaction: function(type){
            if(type=="reset"){
                this.form.termName= '';
                this.form.status= 1;
            }
            if(type=="save"){
                this.form.post('masters/saveTerm',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Term is added successfully'
                    })
                    this.$router.push('/term_list');
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		},
    }
}
</script>