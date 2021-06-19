<template>
    <div class="card">
        <div class="card-body pb-1 mb-0 pt-1 mt-0 overflow-auto">
            <div class="row form-group">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label>Module:<span class="text-danger">*</span></label>
                    <select class="form-control select2" id="module_id" v-model="form.module_id">
                        <option value=""> --Select--</option>
                        <option v-for="(item, index) in module_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <span class="text-danger" id="module_id_err"></span>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label>Service:<span class="text-danger">*</span></label>
                    <select class="form-control select2" id="service_id" v-model="form.service_id">
                        <option value=""> --Select--</option>
                        <option v-for="(item, index) in service_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <span class="text-danger" id="service_id_err"></span>
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
                        <th style="width:45%">Question</th>
                        <th style="width:10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in questionList" :key="index">
                        <td>{{ index + 1 }}</td>
                        <td>{{ item.name}}</td>
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
            questionList:[],
            dt:'',
            form: new form({
                module_id:'',
                service_id:'',
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
        loadQuestionList(uri = 'questionAnswerController/loadQuestionaries/all_with_service_Question'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.questionList =  data.data.data;
            })
            .catch(function (error){
                console.log('error in retrieve: '+error);
            });
        },
        loadModuleList(uri = 'questionAnswerController/loadQuestionaries/allData_Module'){
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
            let uri = 'questionAnswerController/loadQuestionaries/actlistbyparent_'+type+'_'+id;
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
            if(id=="module_id"){
                this.getdropdowns($('#module_id').val(),'Service');
                this.form.module_id=$('#module_id').val();
            }
            if(id=="service_id"){
                this.getdropdowns($('#service_id').val(),'Category');
                this.form.service_id=$('#service_id').val();
            }
            if(id=="category"){
                this.form.category=$('#category').val();
            }
        },
        validate(){
            let retval=true;
            if($('#module_id').val()==""){
                $('#module_id_err').html('Please select this field');
                 $('#module_id').removeClass('is-invalid');
                retval=false;
            }
            if($('#service_id').val()==""){
                $('#service_id_err').html('Please select this field');
                $('#service_id').removeClass('is-invalid');
                retval=false;
            }
            return retval;
        },
        getquestions(){
            let uri = 'questionAnswerController/loadQuestionaries/loadQuestion';
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
