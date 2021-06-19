<template>
    <div>
        <form class="bootbox-form">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>Module:<span class="text-danger">*</span></label>
                        <select class="form-control select2" id="module_id" v-model="form.module_id" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('module_id') }">
                            <option value=""> --Select--</option>
                            <option v-for="(item, index) in module_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="module_id"></has-error>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>Service:<span class="text-danger">*</span></label>
                        <select class="form-control select2" id="service_id" v-model="form.service_id" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('service_id') }">
                            <option value=""> --Select--</option>
                            <option v-for="(item, index) in service_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="service_id"></has-error>
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
                        <label>Question:<span class="text-danger">*</span></label>
                        <select class="form-control select2" id="question_field" v-model="form.question_field" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('question_field') }">
                            <option value=""> --Select--</option>
                            <option v-for="(item, index) in list_of_question" :key="index" v-bind:value="item.id+'_'+item.answer_type">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="question_field"></has-error>
                    </div>
                </div>
                <div class="row form-group" id="not_applicable_message" style="display:none">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>Answer is not applicable for this question</label>
                    </div>
                </div>
                <table id="answer-table" class="table table-bordered text-sm table-striped" style="display:none">
                    <thead>
                        <tr>
                            <th >SL#</th>
                            <th >Answer <span id="anstype"></span></th>
                            <th >Status</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr id="answer" v-for='(answer, index) in form.answer' :key="index">
                            <td>
                                {{index+1}}
                            </td>
                            <td>
                                <input class="form-control" v-model="answer.name" :class="{ 'is-invalid': form.errors.has('name') }" :id="'answer'+(index+1)" type="text">
                                <span class="text-danger" :id="'authority_err'+(index+1)"></span>
                            </td>
                            <td>
                                <label><input v-model="answer.status"  type="radio" value="1" /> Active</label>
                                <label>  <input v-model="answer.status"  type="radio" value="0" /> In Active</label>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <button type="button" class="btn btn-flat btn-sm btn-primary" id="addMore"
                                @click="addMore()"><i class="fa fa-plus"></i> Add More</button>
                                <button type="button" class="btn btn-flat btn-sm btn-danger" id="addMore"
                                @click="remove()"><i class="fa fa-trash"></i> Remove</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-right">
                <button type="button" id="save_btn" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    data() {
        return {
            count:0,
            module_list:[],
            service_list:[],
            category_list:[],
            category_type_list:[],
            list_of_question:[],
            form: new form({
                id: '',
                module_id:'',
                service_id:'',
                category:'',
                category_type:'',
                question_field:'',
                answer:[{name:'',status:1}],
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
        addMore: function(){
            this.count++;
            this.form.answer.push({name:'',status:1})
        },
        remove(){
            if(this.form.answer.length>1){
                this.count--;
                this.form.answer.pop();
            }
        },
        loadmodulelist(uri = 'questionAnswerController/loadQuestionaries/all_active_Module'){
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.module_list =  data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        async getdropdowns(id,type,identification){
            let uri = 'questionAnswerController/loadQuestionaries/actlistbyparent_'+type+'_'+id;
            if(type=="Service"){
                this.service_list=[];
            }
            if(type=="Category"){
                this.category_list=[];
            }
            if(type=="CategoryType"){
                this.category_type_list=[];
            }
            if(type=="Question"){
                this.list_of_question=[];
                // id=this.form.service_id+"SSS"+id+"SSS"+identification;
                uri = 'questionAnswerController/loadQuestionaries/getquestionList_'+identification+'_'+id;
            }
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
                if(type=="Question"){
                    this.list_of_question = data.data.data;
                }
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },

		formaction: function(type){
            if(type=="save"){
                this.form.question_field=$('#question_field').val().split('_')[0];
                this.form.post('/questionAnswerController/saveAnswers',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/list_answer');
                })
                .catch((error) => {
                    console.log("Error:"+error);
                    this.applyselect2();
                })
            }
		},
        applyselect2(){
            if(!$('#module_id').attr('class').includes('select2-hidden-accessible')){
                $('#module_id').addClass('select2-hidden-accessible');
            }
            if(!$('#service_id').attr('class').includes('select2-hidden-accessible')){
                $('#service_id').addClass('select2-hidden-accessible');
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
            if(id=="module_id"){
                this.form.module_id=$('#module_id').val();
                this.getdropdowns($('#module_id').val(),'Service','');
                this.getdropdowns($('#module_id').val(),'CategoryType','');
            }
            if(id=="service_id"){
                this.form.service_id=$('#service_id').val();
                this.getdropdowns($('#service_id').val(),'Category','');
            }
            if(id=="category"){
                this.list_of_question=[];
                this.form.category=$('#category').val();
                this.getdropdowns($('#category').val(),'Question','category');
            }
            if(id=="category_type"){
                this.list_of_question=[];
                this.form.category_type=$('#category_type').val();
                this.getdropdowns($('#category_type').val(),'Question','categoryType');
            }
            if(id=="question_field"){
                this.form.answer=[];
                this.form.question_field=$('#question_field').val();
                let uri = 'questionAnswerController/loadQuestionaries/byparentId_Answer_'+$('#question_field').val();
                axios.get(uri)
                .then(response =>{
                    let data = response.data.data;
                    if(data.length==0){
                        this.form.answer=[{name:'',status:1}];
                    }
                    for(let i=0;i<data.length;i++){
                        this.form.answer.push({name:data[i].name,status:data[i].status})
                    }
                })
                .catch(function (error){
                    console.log("Error:"+error)
                });

                if($('#question_field').val().split('_')[1]=="Dropdown" || $('#question_field').val().split('_')[1]=="Radio" || $('#question_field').val().split('_')[1]=="Checkbox"){
                    $('#answer-table').show();
                    $('#anstype').html('( Answer Type:'+$('#question_field').val().split('_')[1]+' )');
                    $('#save_btn').show();
                    $('#not_applicable_message').hide();
                }
                else{
                    this.form.answer=[{name:'',status:1}];
                    $('#answer-table').hide();
                    $('#save_btn').hide();
                    $('#not_applicable_message').show();
                }
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
