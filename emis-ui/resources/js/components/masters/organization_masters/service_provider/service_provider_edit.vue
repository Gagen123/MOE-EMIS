<template>
    <div>
        <form class="bootbox-form" id="serviceProviderId">
            <div class="card-body">
                <div class="row form-group">
                    <input type="hidden" class="form-control" v-model="form.id"/>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Service Type:<span class="text-danger">*</span></label> 
                        <input class="form-control" v-model="form.serviceType" :class="{ 'is-invalid': form.errors.has('serviceType') }" id="serviceType" @change="remove_err('serviceType')" type="text" tabindex="1" autofocus="true">
                        <has-error :form="form" field="serviceType"></has-error>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Service Name:<span class="text-danger">*</span></label> 
                        <input class="form-control" v-model="form.serviceName" :class="{ 'is-invalid': form.errors.has('serviceName') }" id="serviceName" @change="remove_err('serviceName')" type="text" tabindex="1" autofocus="true">
                        <has-error :form="form" field="serviceName"></has-error>
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
                serviceType: '',
                serviceName: '',
                status: 1,
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
                this.form.serviceType= '';
                this.form.serviceName= '';
                this.form.status= 1;
            }
            if(type=="save"){
                this.form.post('masters/saveServiceProvider',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Service provoder details updated successfully'
                    })
                    this.$router.push('/service_provider_list');
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		},
    },

    created() {
        alert("m here");
        this.form.serviceType=this.$route.params.data.serviceType;
        this.form.serviceName=this.$route.params.data.name;
        this.form.status=this.$route.params.data.status;
        this.form.id=this.$route.params.data.id;
        // this.form.action_type=this.$route.params.data.action;
    },
}
</script>