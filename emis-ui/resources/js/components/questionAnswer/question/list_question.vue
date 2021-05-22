<template>
    <div class="card">
        <div class="card-body pb-1 mb-0 pt-1 mt-0 overflow-auto">
            <div class="row form-group">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label>Module:<span class="text-danger">*</span></label> 
                    <select class="form-control select2" id="grant_parent_field" v-model="form.grant_parent_field">
                        <option value=""> --Select--</option>
                        <option v-for="(item, index) in module_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select> 
                    <span class="text-danger" id="grant_parent_field_err"></span>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label>Service:<span class="text-danger">*</span></label> 
                    <select class="form-control select2" id="parent_field" v-model="form.parent_field">
                        <option value=""> --Select--</option>
                        <option v-for="(item, index) in service_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select> 
                    <span class="text-danger" id="parent_field_err"></span>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label>Category:</label>
                    <select class="form-control select2" id="category" v-model="form.category" >
                        <option value=""> --Select--</option>
                        <option v-for="(item, index) in category_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select> 
                    <span class="text-danger" id="category_err"></span>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 pt-2">
                    <br/>
                    <button class="btn btn-primary btn-sm" type="button" @click="getquestions()"> <i class="fa fa-search">&nbsp;Search</i> &nbsp;&nbsp; </button>
                </div>
            </div>
            <hr>
            <table id="working-agency-table" class="table table-bordered text-sm table-striped">
                <thead>
                    <tr>
                        <th style="width:5%">SL#</th>
                        <th style="width:10%">Module</th>
                        <th style="width:20%">Service</th>
                        <th style="width:45%">Question</th>
                        <!-- <th >Answer Type</th>
                        <th >Code</th>
                        <th >Status</th>
                        <th >Created Date</th> -->
                        <th style="width:10%">Action</th> 
                    </tr>
                </thead>
                <tbody id="tbody">
                    <tr v-for="(item, index) in questionList" :key="index">
                        <td>{{ index + 1 }}</td>
                        <td>{{ moduleArray[item.service.parent_id] }}</td>
                        <td>{{ item.service.name}}</td>
                        <td>{{ item.name}}</td>
                        <!-- <td>{{ item.answer_type}}</td>
                        <td>{{ item.code}}</td>
                        <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                        <td>{{ item.created_at }}</td> -->
                        <td>
                            <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>      
</template>
<script>
export default {
    data(){
        return{
            module_list:[],
            service_list:[],
            category_list:[],
            moduleArray:{},
            questionList:[],dt:'',
            form: new form({
                grant_parent_field:'',
                parent_field:'',
                category:'',
                question:'',
                name: '',
                code:'',
                status: 1,
                record_type:'Asnwer',
                action_type:'add',
            })
            
        }
    },
    methods:{ 
        loadQuestionList(uri = 'questionAnswers/loadQuestionaries/all_with_service_Question'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.questionList =  data.data.data;
            })
            .catch(function (error){
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="9" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        loadModuleList(uri = 'questionAnswers/loadQuestionaries/allData_Module'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.module_list=data.data.data;
                for(let i=0;i<data.data.data.length;i++){
                    this.moduleArray[data.data.data[i].id] = data.data.data[i].name; 
                }
            })
            .catch(function (error){
                console.log('error:' +error);
            });
        },
        showedit(data){
            this.$router.push({name:'edit_question',params: {data:data}});
        },
        getdropdowns(id,type){
            if(type=="Service"){
                this.service_list=[];
            }
            if(type=="Category"){
                this.category_list=[];
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
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="grant_parent_field"){
                this.getdropdowns($('#grant_parent_field').val(),'Service');
                this.form.grant_parent_field=$('#grant_parent_field').val();
            }
            if(id=="parent_field"){
                this.getdropdowns($('#parent_field').val(),'Category');
                this.form.parent_field=$('#parent_field').val();
            } 
            if(id=="category"){
                this.form.category=$('#category').val();
            }  
        },
        validate(){
            let retval=true;
            if($('#grant_parent_field').val()==""){
                $('#grant_parent_field_err').html('Please select this field');
                 $('#grant_parent_field').removeClass('is-invalid');
                retval=false;
            }
            if($('#parent_field').val()==""){
                $('#parent_field_err').html('Please select this field');
                $('#parent_field').removeClass('is-invalid');
                retval=false;
            }
            return retval;
        },
        getquestions(){
            let uri = 'questionAnswers/loadQuestionaries/loadQuestion';
            if(this.validate()){
                $('#anstype').html(this.form.question.split('_')[1]);
                axios.get(uri)
                .then(response => { 
                    let data = response;
                    this.questionList=data.data.data;
                })
                .catch(function (error){
                    console.log('error:' +error);
                });
            }
        },
    },
    created(){
        this.loadModuleList();
    },
    mounted(){ 
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        }); 
        this.loadQuestionList();

        $('.select2').on('select2:select', function (){
            Fire.$emit('changeval',$(this).attr('id'))
        });
        Fire.$on('changeval',(id)=>{
            this.changefunction(id);
        });
        this.dt =  $("#working-agency-table").DataTable();

    },
    watch: {
        questionList() {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#working-agency-table").DataTable()
            });
        }
    },
}
</script>
