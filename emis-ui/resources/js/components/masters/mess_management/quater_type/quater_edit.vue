<template>
<div>
    <form class="bootbox-form" id="quaterId">
            <div class="card-body">
                <div class="row form-group">
                    <input type="hidden" class="form-control" v-model="form.id"/>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Quater Name:<span class="text-danger">*</span></label> 
                        <input class="form-control" v-model="form.quaterName" :class="{ 'is-invalid': form.errors.has('quaterName') }" id="quaterName" @change="remove_err('quaterName')" type="text">
                        <has-error :form="form" field="quaterName"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <label>Display Order Code:</label> 
                      <input class="form-control" v-model="form.code"  id="Displaycode" type="number">
                      <has-error :form="form" field="code" ></has-error>
                    </div>
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
    data(){
        return{
            count:10,
            form: new form({
                id: '',
                quaterName: '',
                status: '',
                // action_type:'edit',
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
                this.form.quaterName= '';
                this.form.status= 1;
            }
            if(type=="save"){
                this.form.post('/masters/saveQuater',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Quater Type details updated successfully'
                    })
                    this.$router.push('/quater_list');
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		},
    },

    created() {
        this.form.quaterName=this.$route.params.data.name;
        this.form.status=this.$route.params.data.status;
        this.form.id=this.$route.params.data.id;
        // this.form.action_type=this.$route.params.data.action;
    },
}
</script>