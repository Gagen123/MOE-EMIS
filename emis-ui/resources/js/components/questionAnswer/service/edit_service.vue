<template>
    <div>
        <form class="bootbox-form" id="dzongkhagId">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Module:<span class="text-danger">*</span></label>
                        <select class="form-control" id="module_id" v-model="form.module_id" :class="{ 'is-invalid': form.errors.has('module_id') }">
                            <option v-for="(item, index) in module_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="module_id"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Service:<span class="text-danger">*</span></label>
                        <input class="form-control" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" id="name" @change="remove_err('name')" type="text">
                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Type:<span class="text-danger">*</span></label>
                        <select class="form-control" id="service_type" v-model="form.service_type" :class="{ 'is-invalid': form.errors.has('service_type') }">
                            <option value="">--Select--</option>
                            <option value="Leadership">Leadership Selection</option>
                            <option value="Others">Others</option>
                        </select>
                        <has-error :form="form" field="service_type"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                     <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Code:<span class="text-danger">*</span></label>
                        <input class="form-control" readonly v-model="form.code" :class="{ 'is-invalid': form.errors.has('code') }" id="code" @change="remove_err('code')" type="text">
                        <has-error :form="form" field="code"></has-error>
                    </div>
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
            module_list:[],
            form: new form({
                id: '',
                name: '',
                module_id:'',
                service_type:'',
                code:'',
                status:'',
                record_type:'Service',
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
        loadModuleList(uri = 'questionAnswerController/loadQuestionaries/all_active_Module'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.module_list =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error:"+error)
            });
        },
		formaction: function(type){
            if(type=="reset"){
                this.form.name= '';
                this.form.code='';
                this.form.status= 1;
            }
            if(type=="save"){
                this.form.post('/questionAnswerController/saveQuestionaries',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details updated successfully'
                    })
                    this.$router.push('/list_service');
                })
                .catch((er) => {
                    console.log("Error:"+er)
                })
            }
		},
    },
    created() {
        this.loadModuleList();
        this.form.name=this.$route.params.data.name;
        this.form.module_id=this.$route.params.data.module.id;
        this.form.status=this.$route.params.data.status;
        this.form.code=this.$route.params.data.code;
        this.form.service_type=this.$route.params.data.type;
        this.form.id=this.$route.params.data.id;
        $('#module_id').val('this.$route.params.data.majorgroup.id');
    },

}
</script>
