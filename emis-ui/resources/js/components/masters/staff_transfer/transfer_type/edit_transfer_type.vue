<template>
    <div>
        <form class="bootbox-form" id="dzongkhagId">
              <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <label>Type:<span class="text-danger">*</span></label> 
                        <input class="form-control" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" id="name" @change="remove_err('name')" type="text"/>
                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <label>Code:<span class="text-danger">*</span></label> 
                        <input class="form-control" v-model="form.code" :class="{ 'is-invalid': form.errors.has('code') }" id="code" @change="remove_err('code')" type="text">
                        <has-error :form="form" field="code"></has-error>
                     </div>
                </div>  
               
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="required">Status:</label>
                        <br>
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
            count:10,
            form: new form({
                id: '',
                name: '',
                code:'',
                status:'',
                record_type:'transfer_type',
                action_type:'edit',
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
                this.form.code='';
                this.form.status= 1;
            }
            if(type=="save"){
                this.form.post('staff/saveStaffMasters',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details updated successfully'
                    })
                    this.$router.push('/list_transfer_type');
                })
                .catch(() => { 
                    console.log("Error......")
                })
            }
		}, 
    },
    created() {
        this.form.name=this.$route.params.data.name;
        this.form.status=this.$route.params.data.status;
        this.form.code=this.$route.params.data.code;
        this.form.id=this.$route.params.data.id;
    },
    
}
</script>