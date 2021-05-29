<template>
    <div>
        <form class="bootbox-form" id="subjectGroup">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Subject Group Name:<span class="text-danger">*</span></label> 
                        <input class="form-control form-control-sm" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" id="name" @change="remove_err('dzongkhag_name')" type="text">
                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Dzongkha Name:</label> 
                        <input class="form-control form-control-sm" v-model="form.dzo_name" :class="{ 'is-invalid': form.errors.has('name') }" id="name" @change="remove_err('name')" type="text">
                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Display Order:<span class="text-danger">*</span></label>
                        <input class="form-control form-control-sm text-right" v-model="form.display_order" :class="{ 'is-invalid': form.errors.has('display_order') }" id="display_order" @change="remove_err('display_order')" type="number">
                        <has-error :form="form" field="display_order"></has-error>
                    </div>
                </div>  
                 <div class="row form-group">
                     <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="required">status:</label>
                        <br>
                        <label><input v-model="form.status" type="radio" value="1" /> Active</label>
                        <label><input v-model="form.status" type="radio" value="0" /> Inactive</label>
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
                dzo_name:'',
                display_order:'',
                status:'',
                record_type:'subject_group',
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
                this.form.name = '';
                this.form.dzo_name = '';
                this.form.display_order = '';
                this.form.status= 1;
            }
            if(type=="save"){
                this.form.post('/masters/saveAcademicMasters',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details updated successfully'
                    })
                    this.$router.push('/list-subject-group');
                })
                .catch(() => { 
                    console.log("Error.")
                })
            }
		}, 
    },
    created() {
        this.form.name=this.$route.params.data.name;
        this.form.dzo_name=this.$route.params.data.dzo_name;
        this.form.display_order = this.$route.params.data.display_order
        this.form.status=this.$route.params.data.status;
        this.form.id=this.$route.params.data.id;
    },
    
}
</script>