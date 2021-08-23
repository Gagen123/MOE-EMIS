<template>
    <div>
        <div class="card-body">
            <div class="callout callout-success">
                <span><label><u>Position and Feedback Detials</u></label></span>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Selection For:</label><br>
                        <span class="text-blue text-bold">{{selectionList[feedback_form.selection_type_id]}}</span>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Position:</label><br>
                        <span class="text-blue text-bold">{{positionList[feedback_form.position_title_id] }}</span>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Last Date for Feedback:</label><br>
                        <span class="text-blue text-bold">{{ feedback_end_data }}</span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>Remarks:</label><br>
                        <span class="text-blue text-bold">{{ feedback_details }}</span>
                    </div>
                </div>
            </div>
            <div class="callout callout-success">
                <span><label><u>Nominee Detials</u></label></span>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Name:</label><br>
                        <span class="text-blue text-bold">{{data_list.aplicant_name}}</span>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Current Position:</label><br>
                        <span class="text-blue text-bold">{{ data_list.aplicant_position_title }}</span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Working Agency:</label><br>
                        <span class="text-blue text-bold">{{data_list.aplicant_working_agency}}</span>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Dzongkhag:</label><br>
                        <span class="text-blue text-bold">{{data_list.aplicant_working_dzo}}</span>
                    </div>
                    <!-- <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Gewog:</label><br>
                        <span class="text-blue text-bold">{{data_list.aplicant_working_gewog}}</span>
                    </div> -->
                </div>
            </div>
            <div class="callout callout-success">
                <span><label><u>Feedback</u></label></span>
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  You are providing <b>{{feedbackArray[feedback_category_id]}}</b> feedback to {{data_list.aplicant_name}}
                </div>
                <table id="waterTable" class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <thead>
                        <tr>
                            <th style="width:5%">Sl#</th>
                            <th style="width:55%">Question</th>
                            <th style="width:40%">Answers</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in feedback_form.questionList" :key="index">
                            <td>{{ index+1}}</td>
                            <td>{{ item.name}}</td>
                            <td v-if="item.answer_type=='TextArea'">
                                <textarea class="form-control" :name="'answer_textarea'+index" v-model="item.answered" :id="item.id" @change="remove_err(item.id)"></textarea>
                                <label class="text-danger" :id="item.id+'err'"></label>
                            </td>

                            <td v-if="item.answer_type=='Text'">
                                <input class="form-control" :name="'answer_text'+index" type="text" v-model="item.answered" :id="item.id" @change="remove_err(item.id)">
                                <label class="text-danger" :id="item.id+'err'"></label>
                            </td>

                            <td v-if="item.answer_type=='Number'">
                                <input class="form-control" :name="'answer_number'+index" type="number" v-model="item.answered" :id="item.id" @change="remove_err(item.id)">
                                <label class="text-danger" :id="item.id+'err'"></label>
                            </td>

                            <td v-if="item.answer_type=='Radio'">
                                <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <span v-for="(ans, index1) in item.answers" :key="index1">
                                        <input type="radio" :name="'answer_radio'+index" v-model="ans.answered" :id="item.id+'_'+ans.id" @change="remove_err(item.id+'_'+ans.id)" class="ml-4" :value="ans.id"> <label>  {{ans.name}} </label>
                                    </span>
                                </div>
                                <label class="ml-4 text-danger" :id="item.id+'err'"></label>
                            </td>

                            <td v-if="item.answer_type=='Dropdown'">
                                <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <select name="category" v-model="item.answered" :id="item.id" @change="remove_err(item.id)" class="form-control">
                                        <option value="">--- Please Select ---</option>
                                        <option v-for="(item, index) in item.answers" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                    </select>
                                    <label class="text-danger" :id="item.id+'err'"></label>
                                </div>
                            </td>

                            <td v-if="item.answer_type=='Checkbox'">
                                <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <span v-for="(ans, index1) in item.answers" :key="index1">
                                        <input type="checkbox" :name="'answer_check'+index" v-model="ans.answered" :id="item.id+'_'+ans.id" class="ml-4" :value="ans.id" @change="remove_err(item.id+'_'+ans.id)">
                                        <label>{{ans.name}} </label>
                                    </span>
                                </div>
                                <label class="ml-4 text-danger" :id="item.id+'err'"></label>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row form-group fa-pull-right">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button class="btn btn-primary" @click="submitForm()">Submit <i class="fa fa-arrow-right"></i></button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            selectionList:{},
            positionList:{},
            feedbackArray:{},
            data_list:[],

            feedback_end_data:'',
            feedback_details:'',

            feedback_category_id:'',
            feedback_form: new form({
                feedback_id:'',
                application_number:'',
                selection_type_id:'',
                position_title_id:'',
                questionList:[],
            }),
        }
    },
    methods: {
        //get position details to populate form
        getSelectionList(uri = 'staff/staffLeadershipSerivcesController/loadData/activeData_LeadershipType'){
            axios.get(uri)
            .then(response => {
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.selectionList[data.data.data[i].id] = data.data.data[i].name;
                }
            })
            .catch(function (error){
                console.log('err: '+error);
            });
        },

        //get position title to populate form
        loadPositionTitleList(uri = 'staff/loadStaffMasters/active/PositionTitle'){
            axios.get(uri)
            .then(response =>{
                let data = response;
                // this.positionList =  data.data.data;
                for(let i=0;i<data.data.data.length;i++){
                    this.positionList[data.data.data[i].id] = data.data.data[i].name;
                }
            })
            .catch(function (error){
                console.log(error);
            });
        },

        //loadFeedback qeustion according to the type and position
        loadFeedbackQuestion(feedback_category_id,leadership_selection_id){
            axios.get('staff/staffLeadershipSerivcesController/loadData/allQuestionUnderCat_Question_'+feedback_category_id+'_'+leadership_selection_id)
            .then(response => {
                let data = response.data.data;
                this.feedback_form.questionList=data;
            })
            .catch(function (error){
                console.log('err: '+error);
            });
        },

        //load Feedback category
        getFeedbackCategoryList(uri = 'staff/staffLeadershipSerivcesController/loadData/activeData_FeedbackCategory'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.feedbackTypeList =  data.data.data;
                for(let i=0;i<data.data.data.length;i++){
                    this.feedbackArray[data.data.data[i].id] = data.data.data[i].name;
                }
            })
            .catch(function (error){
                console.log('err: '+error);
            });
        },
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                if(field_id.includes('_')){
                    $('#'+field_id.split('_')[0]+'err').html('');
                }
                $('#'+field_id+'err').html('');
            }
        },
        submitForm(){
            let validated=true;
            for(let i=0;i<this.feedback_form.questionList.length;i++){
                if(this.feedback_form.questionList[i].answer_type=="Checkbox" || this.feedback_form.questionList[i].answer_type=="Radio"){
                    let valid=false;
                    for(let j=0;j<this.feedback_form.questionList[i].answers.length;j++){
                        if($('#'+this.feedback_form.questionList[i].id+'_'+this.feedback_form.questionList[i].answers[j].id).prop('checked')){
                            valid=true;
                            this.feedback_form.questionList[i].answers[j].answered=$('#'+this.feedback_form.questionList[i].id+'_'+this.feedback_form.questionList[i].answers[j].id).val();
                        }
                        else{
                            this.feedback_form.questionList[i].answers[j].answered='';
                        }
                    }
                    if(!valid){
                        $('#'+this.feedback_form.questionList[i].id+'err').html('Please answer this');
                        $('#'+this.feedback_form.questionList[i].id).addClass('is-invalid');
                        validated=false;
                    }
                }
                else if(this.feedback_form.questionList[i].answer_type=="Text" || this.feedback_form.questionList[i].answer_type=="Number" || this.feedback_form.questionList[i].answer_type=="TextArea" || this.feedback_form.questionList[i].answer_type=="Dropdown"){
                    if($('#'+this.feedback_form.questionList[i].id).val()==null || $('#'+this.feedback_form.questionList[i].id).val()==""){
                        $('#'+this.feedback_form.questionList[i].id+'err').html('Please answer this');
                        $('#'+this.feedback_form.questionList[i].id).addClass('is-invalid');
                        validated=false;
                    }
                    else{
                        this.feedback_form.questionList[i].answered =$('#'+this.feedback_form.questionList[i].id).val();
                    }
                }
            }
            if(validated==true){
                Swal.fire({
                    text: 'Are you sure you wish to submit this feedback details ? ',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        this.feedback_form.post('staff/staffLeadershipSerivcesController/saveFeedback')
                        .then((response) => {
                            if(response.data!=""){
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Data saved Successfully'
                                });
                                this.$router.push({name:"list_feedback"});
                            }
                        })
                        .catch((error) => {
                            console.log("Error: "+error)
                        });
                    }
                });
            }
        }
    },
    mounted(){
        this.getSelectionList();
        this.loadPositionTitleList();
        this.getFeedbackCategoryList();
        axios.get('/staff/staffLeadershipSerivcesController/getleadershipDetailsForFeedback/'+this.$route.params.nomination_id)
        .then((response) =>{
            let data=response.data.data;
            this.data_list=data;
            this.feedback_form.feedback_id=data.id;
            this.feedback_form.application_number=data.application_details.application_number;
            this.feedback_end_data=data.application_details.feedback_end_date;
            this.feedback_details=data.application_details.feedback_details;
            this.feedback_form.selection_type_id=data.post_details.selection_type;
            this.feedback_form.position_title_id=data.post_details.position_title;
            this.feedback_category_id=data.feedback_type;
            this.loadFeedbackQuestion(data.feedback_type,data.post_details.selection_type);
        })
        .catch((error)=>{
            console.log("Error: "+error);
        });
    },
}
</script>
