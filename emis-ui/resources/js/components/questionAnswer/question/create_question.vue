<template>
    <div>
        <form class="bootbox-form">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>Module:<span class="text-danger">*</span></label> 
                        <select class="form-control select2" id="grant_parent_field" v-model="form.grant_parent_field" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('grant_parent_field') }">
                            <option value=""> --Select--</option>
                            <option v-for="(item, index) in module_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select> 
                        <has-error :form="form" field="grant_parent_field"></has-error>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>Service:<span class="text-danger">*</span></label> 
                        <select class="form-control select2" id="parent_field" v-model="form.parent_field" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('parent_field') }">
                            <option value=""> --Select--</option>
                            <option v-for="(item, index) in service_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select> 
                        <has-error :form="form" field="parent_field"></has-error>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>Category:</label>
                        <select class="form-control select2" id="category" v-model="form.category" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('category') }">
                            <option value=""> --Select--</option>
                            <option v-for="(item, index) in category_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select> 
                        <has-error :form="form" field="category"></has-error>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>Category Type:</label>
                        <select class="form-control select2" id="category_type" v-model="form.category_type" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('category_type') }">
                            <option value=""> --Select--</option>
                            <option v-for="(item, index) in category_type_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select> 
                        <has-error :form="form" field="category_type"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label class="required">Question:<span class="text-danger">*</span></label>
                        <textarea class="form-control" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" id="name" @change="remove_err('name')"></textarea>
                        <has-error :form="form" field="name"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Answer Type:<span class="text-danger">*</span></label> 
                        <select class="form-control select2" id="answer_type" v-model="form.answer_type" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('answer_type') }">
                            <option value="">--Select--</option>
                            <option value="Dropdown">Dropdown</option>
                            <option value="Radio">Radio</option>
                            <option value="Checkbox">Checkbox</option>
                            <option value="Text">Text</option>
                            <option value="Number">Number</option>
                            <option value="TextArea">TextArea</option>
                        </select> 
                        <has-error :form="form" field="answer_type"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Code:<span class="text-danger">*</span></label> 
                        <input class="form-control" v-model="form.code" :class="{ 'is-invalid': form.errors.has('code') }" id="code" @change="remove_err('code')" type="text">
                        <has-error :form="form" field="code"></has-error>
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
    data() {
        return {
            module_list:[],
            service_list:[],
            category_list:[],
            category_type_list:[],
            form: new form({
                id: '',
                grant_parent_field:'',
                parent_field:'',
                category:'',
                category_type:'',
                name: '',
                answer_type:'',
                code:'',
                status: 1,
                record_type:'Question',
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
        loadmodulelist(uri = 'questionAnswers/loadQuestionaries/all_active_Module'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.module_list =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error:"+error)
            });
        },
        
        getdropdowns(id,type){
            if(type=="Service"){
                this.service_list=[];
            }
            if(type=="Category"){
                this.category_list=[];
            }
            if(type=="CategoryType"){
                this.category_type_list=[];
            }
            let uri = 'questionAnswers/loadQuestionaries/actlistbyparent_'+type+'_'+id;
            axios.get(uri)
            .then(response =>{
                let data = response;
                if(type=="Service"){
                    this.service_list = data.data.data;
                }
                if(type=="Category"){
                    this.category_list = data.data.data;
                }
                if(type=="CategoryType"){
                    this.category_type_list=data.data.data;
                }
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        
		formaction: function(type){
            if(type=="reset"){
                this.form.name= '';
                this.form.status= 1;
            }
            if(type=="save"){
                this.form.post('/questionAnswers/saveQuestionaries',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/list_question');
                })
                .catch((error) => {
                    console.log("Error:"+error);
                    this.applyselect2();
                })
            }
		},
        applyselect2(){
            if(!$('#grant_parent_field').attr('class').includes('select2-hidden-accessible')){
                $('#grant_parent_field').addClass('select2-hidden-accessible');
            }
            if(!$('#parent_field').attr('class').includes('select2-hidden-accessible')){
                $('#parent_field').addClass('select2-hidden-accessible');
            }
            if(!$('#category').attr('class').includes('select2-hidden-accessible')){
                $('#category').addClass('select2-hidden-accessible');
            }
            if(!$('#answer_type').attr('class').includes('select2-hidden-accessible')){
                $('#answer_type').addClass('select2-hidden-accessible');
            }
        }, 
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            // if(id=="grant_parent_field"){
            //     this.getservicelist($('#grant_parent_field').val());
            //     this.form.grant_parent_field=$('#grant_parent_field').val();
            // }
            // if(id=="parent_field"){
            //     this.form.parent_field=$('#parent_field').val();
            //     this.getCategoryList($('#parent_field').val());
            // } 
            if(id=="grant_parent_field"){
                this.getdropdowns($('#grant_parent_field').val(),'Service');
                this.getdropdowns($('#grant_parent_field').val(),'CategoryType');
                this.form.grant_parent_field=$('#grant_parent_field').val();
            }
            if(id=="parent_field"){
                this.getdropdowns($('#parent_field').val(),'Category');
                this.form.parent_field=$('#parent_field').val();
            } 
            if(id=="category"){
                this.form.category=$('#category').val();
            }
            if(id=="category_type"){
                this.form.category_type=$('#category_type').val();
            }
            if(id=="answer_type"){
                this.form.answer_type=$('#answer_type').val();
            }  
        }
    },
    mounted(){ 
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        this.loadmodulelist();
        $('.select2').on('select2:select', function (){
            Fire.$emit('changeval',$(this).attr('id'))
        });
        Fire.$on('changeval',(id)=> {
            this.changefunction(id);
        });
    },
    
}
</script>