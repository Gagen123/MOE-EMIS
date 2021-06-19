<template>
<div>
    <div class="card">
        <h4 class="card-header">Questionnaire</h4>
        <div class="card-body">
            <div class="row-12">
                <div class="col-md-12">
                    <div class="jumbotron p-3">
                        <h4>Selected Student</h4>
                        <div class="col-md-4"><b>Name: </b> <span>{{ student.studentName }}</span></div>
                        <div class="col-md-4"><b>Student Code:</b> {{ student.studentName }}</div>
                    </div>
                </div>
                <div class="card">
                    <form @submit.prevent="saveAnswerData()">
                        <div  v-for="(qtype, index) in QuestionAnswers" :key="index">
                            <h5 class="card-header">
                                {{ index + 1 }} {{ qtype.category }}
                            </h5>
                            <div class="card-body">
                                <table id="sen-student-list-table" class="table table-bordered text-sm table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL#</th>
                                            <th>Question and Answer</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(q, indx) in qtype.question" :key="index + '.' + indx">
                                            <td>{{ (index + 1) + '.' + indx }}</td>
                                            <td>
                                                {{ q.question}} <br />
                                                <div class="col-md-12">
                                                    <textarea 
                                                        v-if="q.data_type == 0"  
                                                        v-model="frmQA['q_' + q.q_id].default.display_text"  
                                                        class="form-control required" 
                                                        rows="3" 
                                                        required 
                                                        aria-required="true" 
                                                    ></textarea>

                                                    <input type="number" 
                                                        v-if="q.data_type == 1" 
                                                        v-model="frmQA['q_' + q.q_id].default.display_text"
                                                        class="form-control required" 
                                                        rows="3" 
                                                        required 
                                                        aria-required="true" 
                                                    /> 
                                                    
                                                    <div class="form-group" v-if="q.data_type == 2">
                                                        <select class="form-control" 
                                                            v-model="frmQA['q_' + q.q_id].default.answer_id" 
                                                            required 
                                                            aria-required="true">
                                                            <option v-for="(ao, indd) in q.answer_options" 
                                                                :key="index + '.' + indx + '.' + indd" 
                                                                v-bind:value="ao.ao_id + '__' + ao.display_text"
                                                                :selected="ao.selected"
                                                            >
                                                                {{ ao.display_text }}
                                                            </option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group" v-if="q.data_type == 3">
                                                        <div v-for="(ao, indd) in q.answer_options" :key="index + '.' + indx + '.' + indd">
                                                            <input type="radio" class ="radio-option {rolesRadioBox: true}" autocomplete="off" 
                                                                :id="'required_'+ao.ao_id" 
                                                                v-model="frmQA['q_' + q.q_id].default.answer_id"
                                                                v-bind:value="ao.ao_id + '__' + ao.display_text " 
                                                                required 
                                                                aria-required="true"
                                                            /> {{ ao.display_text }}
                                                        </div>
                                                    </div>

                                                    <div class="form-check" v-if="q.data_type == 4">
                                                        <div v-for="(ao, indd) in q.answer_options" :key="q.q_id + 'chk' + indx + '.' + indd">
                                                            <input type="checkbox" class="form-check-input" 
                                                                v-model="frmQA['q_' + q.q_id].chk_val" 
                                                                required 
                                                                aria-required="true"
                                                                :checked="ao.checked"
                                                                v-bind:value="ao.ao_id + '__' + ao.display_text" 
                                                            /> {{ ao.display_text }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="footer">
                                <div class="row form-group fa-pull-right">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit Data</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</template>
<script>
export default {
    data(){
        return{
            student: {
                studentName: this.$route.params.Name,
                studentCode: this.$route.params.student_code,
            },
            QuestionAnswers:[],
            frmQA: new form({}),
        }
    },
    methods:{
        async getQuestions(){
            this.QuestionAnswers = [];
            axios.get('students/sen/getquestionnaire/' + this.$route.params.id)
            .then(response =>{
                // alert(JSON.stringify(response));
                let std_id = this.$route.params.id;
                let resData = response.data;
                let questionnaire = [];
                let frmData = [];

                // let ab = this.abcdefgh();
                // alert(ab);
                resData.forEach((q_Type) => {
                    let qType = {
                        category: q_Type.name,
                        question: []
                    };
                    
                    q_Type.questions.forEach((q) => {
                        let ad = q.answer_data_type;
                        let _q = {
                            q_id:q.id,
                            question: q.questions,
                            data_type: ad,
                            answer_options: [],
                        };

                        let questionAns = q.question_answers; 
                        let a_frm = {
                            qu_id: q.id,
                            default: {
                                id: '',
                                answer_id: '',
                                display_text: '',
                            },
                            chk_val:[],
                            remarks:'',
                            org_id : '',
                            staff_id: '',
                            student_id: std_id,
                        };

                        q.answer_options.forEach((a_o) => {
                            let ao_id = a_o.id;
                            //String = 0
                            //Numbers = 1
                            //Dropdown = 2
                            //Radio = 3
                            //MultiCheckbox = 4 
                            //MultiSelectList = 5
                            
                            let ao = {
                                id: questionAns.length > 0 ? 
                                                this.hasAnswer(qans, ao_id) ? 
                                                    this.filterAnswer(qans, ao_id).id : '' : '',
                                ao_id:ao_id,
                                display_text:a_o.answer,
                                has_remarks:a_o.can_hav_remarks,
                                checked:(ad == 3 || ad == 4) ? 'false' : 
                                            questionAns.length > 0 ? 
                                                this.hasAnswer(qans, ao_id) ?  'true' : 'false' : 'false',
                                selected:(ad == 3 || ad == 4 || ad == 5) ? 
                                            questionAns.length > 0 ? 
                                                this.hasAnswer(qans, ao_id) ? 'true' : 'false' : 'false' : 'false',
                                remarks: a_o.can_hav_remarks ? 
                                            questionAns.length > 0 ?  
                                                this.hasAnswer(qans, ao_id) ? 
                                                    this.filterAnswer(qans, ao_id).remarks : '' : '' : '',
                            };

                            _q.answer_options.push(ao);
                            
                            a_frm.remarks = a_o.can_hav_remarks ? 
                                                        questionAns.length > 0 ?  
                                                            this.hasAnswer(qans, ao_id) ? 
                                                                this.filterAnswer(qans, ao_id).remarks : '' : '' : '';

                            if ((ad == 0 || ad == 1 || ad == 2   || ad == 3)  &&  (questionAns.length > 0)) {
                                if (this.hasAnswer(qans, ao_id)) {
                                    a_frm.default.id = this.filterAnswer(qans, ao_id).id;
                                    a_frm.default.answer_id =  (ad == 0   || ad == 1) ? ao_id : ao_id + '__' + this.filterAnswer(qans, ao_id).answer;
                                    a_frm.default.display_text = (ad == 2   || ad == 3) ? '' : this.filterAnswer(qans, ao_id).answer;
                                }
                            }else if (ad == 4  &&  (questionAns.length > 0)){
                                if (this.hasAnswer(qans, ao_id)) {
                                    a_frm.chk_val.push(ao_id + '__' + this.filterAnswer(qans, ao_id).answer);
                                }
                            }
                        }); 
                        
                        let dy_id = 'q_' + q.id;
                        this.$set(this.frmQA, dy_id, a_frm);
                        qType.question.push(_q);
                        _q="";

                    });

                    questionnaire.push(qType);
                    qType = "";

                });

                this.QuestionAnswers = questionnaire;

                

            }).catch(function (error){
                //
            });
        },
        hasAnswer: function(qans, ao_id) {
            let valObj = qans.filter(function(elem){
                return elem.answer_id == ao_id;
            }); 
            if(valObj.length > 0)
                return true;

            return false;
        },

        filterAnswer: function(qans, ao_id) {
            let valObj = qans.filter(function(elem){
                return elem.answer_id == ao_id;
            }); 
            return valObj[0];
        },

        saveAnswerData: function(){

        },
    },
    mounted(){
        this.getQuestions();
    },
    watch: {
        //
    }
}

</script>
