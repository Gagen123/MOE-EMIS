<template>
    <div>
        <form class="bootbox-form" id="dzongkhagId">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Module:<span class="text-danger">*</span></label>
                        <select class="form-control select2" id="module_id" v-model="form.module_id">
                            <option v-for="(item, index) in module_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="module_id"></has-error>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Serivce:<span class="text-danger">*</span></label>
                        <select class="form-control" id="service_id" v-model="form.service_id" :class="{ 'is-invalid': form.errors.has('service_id') }">
                            <option v-for="(item, index) in service_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="service_id"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Category:<span class="text-danger">*</span></label>
                        <input class="form-control" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" id="name" @change="remove_err('name')" type="text">
                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Code:<span class="text-danger">*</span></label>
                        <input readonly class="form-control" v-model="form.code" :class="{ 'is-invalid': form.errors.has('code') }" id="code" @change="remove_err('code')" type="text">
                        <has-error :form="form" field="code"></has-error>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
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
            module_list:[],
            service_list:[],
            form: new form({
                id: '',
                name: '',
                module_id:'',
                service_id:'',
                code:'',
                status:'',
                record_type:'Category',
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
        loadmodulelist(uri = 'questionAnswerController/loadQuestionaries/all_active_Module'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.module_list =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error:"+error)
            });
        },
        async getservicelist(id){
            let uri = 'questionAnswerController/loadQuestionaries/byparentId_Service_'+id;
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.service_list = data.data.data;
            })
            .catch(function (error){
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
                    this.$router.push('/list_question_category');
                })
                .catch((E) => {
                    console.log("Error:"+E)
                })
            }
		},
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="module_id"){
                this.getservicelist($('#module_id').val());
                this.form.module_id=$('#module_id').val();
            }
            if(id=="service_id"){
                this.form.service_id=$('#service_id').val();
            }
        }
    },
    created() {
        this.loadmodulelist();
        $('.select2').on('select2:select', function (){
            Fire.$emit('changeval',$(this).attr('id'))
        });
        Fire.$on('changeval',(id)=> {
            this.changefunction(id);
        });

        this.getservicelist(this.$route.params.data.module.id);
        this.form.module_id=this.$route.params.data.module.id;
        this.form.service_id=this.$route.params.data.service.id;
        this.form.name=this.$route.params.data.name;
        this.form.status=this.$route.params.data.status;
        this.form.code=this.$route.params.data.code;
        this.form.id=this.$route.params.data.id;
    },
    mounted(){
        this.loadmodulelist();
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').on('select2:select', function (){
            if($(this).attr('id')=="dzo_id"){
                Fire.$emit('changeval')
            }
        });
        Fire.$on('changeval',()=> {
            this.getgewoglist();
        });
    }

}
</script>
