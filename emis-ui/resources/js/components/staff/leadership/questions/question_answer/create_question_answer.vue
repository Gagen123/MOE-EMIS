<template>
    <div>
        <form class="bootbox-form">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Leadership Type:</label>
                        <select class="form-control select2" id="leadership_type" v-model="form.leadership_type" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('leadership_type') }">
                            <option value=""> --Select--</option>
                            <option v-for="(item, index) in leadershipe_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="leadership_type"></has-error>
                        <span class="text-danger" id="leadership_type_err"></span>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Category:</label>
                        <select class="form-control select2" id="category_type_id" v-model="form.category_type_id" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('category_type_id') }">
                            <option value=""> --Select--</option>
                            <option v-for="(item, index) in category_type_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="category_type_id"></has-error>
                        <span class="text-danger" id="category_type_id_err"></span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label class="required">Question:<span class="text-danger">*</span></label>
                        <textarea class="form-control" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" id="name" @change="remove_err('name')"></textarea>
                        <has-error :form="form" field="name"></has-error>
                        <span class="text-danger" id="name_err"></span>
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
                        <span class="text-danger" id="answer_type_err"></span>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="required">Question Status:</label>
                        <br>
                        <label><input v-model="form.status"  type="radio" value="1" /> Active</label>
                        <label><input v-model="form.status"  type="radio" value="0" /> Inactive</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="required">Display Order:</label>
                        <input type="number" name="display_order" v-model="form.display_order" id="display_order" class="form-control">
                    </div>
                </div>
                <div class="row form-group" v-if="is_answer_option">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <table id="answer-table" class="table table-bordered text-sm table-striped">
                            <thead>
                                <tr>
                                    <th >SL#</th>
                                    <th >Answer <span id="anstype"></span></th>
                                    <th >Answer Status</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <tr id="answer" v-for='(answer, index) in form.answer' :key="index">
                                    <td>
                                        {{index+1}}
                                    </td>
                                    <td>
                                        <input class="form-control" v-model="answer.name" :class="{ 'is-invalid': form.errors.has('name') }" :id="'answer'+(index+1)" type="text">
                                        <span class="text-danger" :id="'answer_err'+(index+1)"></span>
                                    </td>
                                    <td>
                                        <label><input v-model="answer.status"  type="radio" value="1" /> Active</label>
                                        <label><input v-model="answer.status"  type="radio" value="0" /> In Active</label>
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
                        <span class="text-danger" id="answer_err"></span>
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
            category_type_list:[],
            leadershipe_list:[],
            is_answer_option:false,
            form: new form({
                id: '',
                category_type_id:'',
                leadership_type:'',
                name: '',
                status: 1,
                answer_type:'',
                display_order:'',
                answer:[{name:'',status:1}],
                record_type:'Question',
                action_type:'add',
            })
        }
    },
    methods: {
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
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
        loadcategorylist(){
            let uri = 'staff/staffLeadershipSerivcesController/loadData/activeData_FeedbackCategory';
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.category_type_list=data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },

        leadershipelist(){
            let uri = 'staff/staffLeadershipSerivcesController/loadData/activeData_LeadershipType';
            axios.get(uri)
            .then(response =>{
                let data = response.data.data;
                this.leadershipe_list=data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },

        checkanswers(){
            let returntype=true;
            if($('#leadership_type').val()==""){
                $('#leadership_type').addClass('is-invalid');
                $('#leadership_type_err').html('Please select leadership type');
                returntype=false;
            }
             if($('#category_type_id').val()==""){
                $('#category_type_id').addClass('is-invalid');
                $('#category_type_id_err').html('Please select category');
                returntype=false;
            }

            if($('#name').val()==""){
                $('#name').addClass('is-invalid');
                $('#name_err').html('Please mention question');
                returntype=false;
            }
            if($('#answer_type').val()==""){
                $('#answer_type').addClass('is-invalid');
                $('#answer_type_err').html('Please select answer type');
                returntype=false;
            }
            if(this.is_answer_option){
                let has_error=false;
                this.form.answer.forEach(item => {
                    if(item.name==""){
                        $('#answer').addClass('is-invalid');
                        $('#answer_err').html('Please mention all answer you wish to add');
                        returntype=false;
                        has_error=true;
                    }
                });
                if(has_error==false){
                    $('#answer_err').html('');
                }
            }
            return returntype;
        },
		formaction: function(type){
            if(type=="reset"){
                this.form.name= '';
                this.form.status= 1;
            }
            if(type=="save"){
                let save=true;
                save=this.checkanswers();

                if(save){
                    this.form.post('/staff/staffLeadershipSerivcesController/saveData',this.form)
                        .then(() => {
                        Toast.fire({
                            icon: 'success',
                            title: 'Details added successfully'
                        })
                        this.$router.push('/list_question_answer');
                    })
                    .catch((error) => {
                        console.log("Error:"+error);
                        this.applyselect2();
                    })
                }
            }
		},
        applyselect2(){
            if(!$('#category_type_id').attr('class').includes('select2-hidden-accessible')){
                $('#category_type_id').addClass('select2-hidden-accessible');
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
            if(id=="category_type_id"){
                this.form.category_type_id=$('#category_type_id').val();
            }
            if(id=="leadership_type"){
                this.form.leadership_type=$('#leadership_type').val();
            }
            if(id=="answer_type"){
                this.form.answer_type=$('#answer_type').val();
                if($('#answer_type').val()=="Dropdown" || $('#answer_type').val()=="Radio" || $('#answer_type').val()=="Checkbox"){
                    this.is_answer_option=true;
                }
            }
        }
    },
    mounted(){
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        this.loadcategorylist();
        this.leadershipelist();
        $('.select2').on('select2:select', function (){
            Fire.$emit('changeval',$(this).attr('id'))
        });
        Fire.$on('changeval',(id)=> {
            this.changefunction(id);
        });
    },

}
</script>
