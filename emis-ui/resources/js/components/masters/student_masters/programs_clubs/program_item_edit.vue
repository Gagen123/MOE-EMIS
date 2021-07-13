<template>
    <div>

        <form class="bootbox-form" id="programRolesId">
            <div class="card-body">
                <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Award Name:<span class="text-danger">*</span></label>
                        <input class="form-control" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" id="award_name" @change="remove_err('name')" type="text">
                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="required">Applicable:</label>
                        <br>
                        <label><input v-model="form.central" id="centralcheck" type="checkbox" /> Centrally Procured</label>
                        <label><input v-model="form.local" id="localcheck" type="checkbox"/> Locally Procured</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="required">Status:</label>
                        <br>
                        <label><input v-model="form.status"  type="radio" value="1" /> Active</label>
                        <label><input v-model="form.status"  type="radio" value="0" /> Inactive</label>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>Description:</label>
                        <textarea class="form-control" v-model="form.description" id="description" type="text"/>
                    </div>
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
                central:0,
                local:0,
                description:'',
                status:'',
                record_type:'program_item',
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
                this.form.description='';
                this.form.status= 1;
            }
            if(type=="save"){
                if($('#centralcheck').prop('checked')){
                    this.form.central=1;
                }
                else{
                    this.form.central=0;
                }

                if($('#localcheck').prop('checked')){
                    this.form.local=1;
                }
                else{
                    this.form.local=0;
                }
                this.form.post('/masters/saveStudentMasters',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Program details updated successfully'
                    })
                    this.$router.push('/program_item_list');
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		},
    },
    mounted() {
        this.form.name=this.$route.params.data.Name;
        this.form.description=this.$route.params.data.Description;
        this.form.status=this.$route.params.data.Status;
        if(this.$route.params.data.Central==1){
            this.form.central=this.$route.params.data.Central;
            $('#centralcheck').prop('checked',true);
        }
        if(this.$route.params.data.Local==1){
            this.form.local=this.$route.params.data.Local;
            $('#localcheck').prop('checked',true);
        }
        this.form.id=this.$route.params.data.id;
    },

}
</script>
