<template>
    <div class="card">
        <div class="card-body pb-1 mb-0 pt-1 mt-0 overflow-auto">
            <div class="card card-primary card-outline" id="adv_serach_ection">
                <div class="card-body" style="display:none">
                    <div class="row form-group">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Module:<span class="text-danger">*</span></label>
                            <select class="form-control select2" id="module_id" v-model="form.module_id">
                                <option value=""> --Select--</option>
                                <option v-for="(item, index) in module_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                            </select>
                            <span class="text-danger" id="module_id_err"></span>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Service:<span class="text-danger">*</span></label>
                            <select class="form-control select2" id="service_id" v-model="form.service_id">
                                <option value=""> --Select--</option>
                                <option v-for="(item, index) in service_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                            </select>
                            <span class="text-danger" id="service_id_err"></span>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Category:<span class="text-danger">*</span></label>
                            <select class="form-control select2" id="category" v-model="form.category" >
                                <option value=""> --Select--</option>
                                <option v-for="(item, index) in category_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                            </select>
                            <span class="text-danger" id="category_err"></span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <label>Question:<span class="text-danger">*</span></label>
                            <select class="form-control select2" :id="'question_field'" v-model="form.question" name="question">
                                <option value=""> --Select--</option>
                                <option v-for="(item, index) in question_list" :key="index" v-bind:value="item.id+'_'+item.answer_type">{{ item.name }}</option>
                            </select>
                            <span class="text-danger" id="question_err"></span>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pt-2">
                            <br/>
                            <button class="btn btn-primary btn-sm" type="button" @click="getanswers()"> <i class="fa fa-search">&nbsp;Search</i> &nbsp;&nbsp; </button>
                        </div>
                    </div>
                </div>
                <div class="card-header">
                    <h3 class="card-title">Answer Type: <label id="anstype"></label></h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus" ></i>
                        </button>
                    </div>
                </div>
            </div>
            <table id="working-agency-table" class="table table-bordered text-sm table-striped">
                <thead>
                    <tr>
                        <th >SL#</th>
                        <th >Answer</th>
                        <th >Status</th>
                        <th >Created Date</th>
                        <th >Action</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <tr v-for="(item, index) in answerList" :key="index">
                        <td>{{ index + 1 }}</td>
                        <td>{{ item.name}}</td>
                        <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                        <td>{{ item.created_at }}</td>
                        <td>
                            <!-- <a href="#" class="btn btn-info btnsm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</a> -->
                            <a href="#" class="btn btn-danger btn-sm btn-flat text-white" @click="showdelete(item)"><i class="fas fa-times"></i > Delete</a>
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
            moduleArray:{},
            module_list:[],
            service_list:[],
            category_list:[],
            question_list:[],
            answerList:[],
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
        loadModuleList(uri = 'questionAnswerController/loadQuestionaries/all_active_Module'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.module_list=data.data.data;
            })
            .catch(function (error){
                console.log('error:' +error);
            });
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
            if($('#question_field').val()==""){
                $('#question_err').html('Please select this field');
                $('#question_field').removeClass('is-invalid');
                retval=false;
            }
            if($('#category').val()==""){
                $('#category_err').html('Please select this field');
                $('#category').removeClass('is-invalid');
                retval=false;
            }
            return retval;
        },
        getanswers(uri = 'questionAnswerController/loadQuestionaries/byparentId_Answer_'+this.form.question.split('_')[0]){
            if(this.validate()){
                $('#anstype').html(this.form.question.split('_')[1]);
                axios.get(uri)
                .then(response => {
                    let data = response;
                    this.answerList=data.data.data;
                })
                .catch(function (error){
                    console.log('error:' +error);
                });
            }

        },
        async getdropdowns(id,type,identification){
            // let uri = 'questionAnswerController/loadQuestionaries/getquestionList_'+type+'_'+id;
            // axios.get(uri)
            // .then(response =>{
            //     let data = response;
            //     if(type=="Service"){
            //         this.service_list = data.data.data;
            //     }
            //     if(type=="Category"){
            //         this.category_list = data.data.data;
            //     }
            //     if(type=="Question"){
            //         this.question_list = data.data.data;
            //     }
            // })
            // .catch(function (error){
            //     console.log("Error:"+error)
            // });
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
                    this.question_list = data.data.data;
                }
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        showedit(data){
            this.$router.push({name:'edit_question',params: {data:data}});
        },
        showdelete(data){
            let record_id=data.id;
             Swal.fire({
                text: "Are you sure you wish to delete "+data.name+" details ?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
                }).then((result) => {
                if (result.isConfirmed) {
                     this.form.delete('/questionAnswerController/deleteAns/'+record_id)
                    .then(() => {
                        Swal.fire(
                            'Success!',
                            'Details has been deleted.',
                            'success',
                        )
                        window.reload();
                    })
                    .catch((error) => {
                        console.log("Error:"+error);
                    })
                }
            });
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
                this.form.question=$('#question_field').val();
            }
        }
    },
    created(){
        this.loadModuleList();
    },
    mounted(){
        $('#adv_serach_ection').show();
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').on('select2:select', function (){
            Fire.$emit('changeval',$(this).attr('id'))
        });
        Fire.$on('changeval',(id)=>{
            this.changefunction(id);
        });
        this.dt =  $("#working-agency-table").DataTable()
    },
    watch: {
        answerList() {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#working-agency-table").DataTable()
            });
        }
    },
}
</script>
