<template>
<div>
    <div class="card">
        <h4 class="card-header">Questionnaire</h4>
        <div class="card-body">
            <div class="row-12">
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
                                                    <textarea v-if="q.data_type == 1" class="form-control required" rows="3" required aria-required="true">
                                                    </textarea>
                                                    <select v-if="q.data_type == 2" class="form-control" required aria-required="true">
                                                        <option value="">-- Select One -- </option>
                                                        <option v-for="(ao, ind) in q.answer_options" :key="index + '.' + indx + '.' + ind" :value="ao.ao_id">{{ ao.text }}</option>
                                                    </select>
                                                    <div class="col-xs-12" v-if="q.data_type == 3">
                                                        <div v-for="(ao, indd) in q.answer_options" :key="index + '.' + indx + '.' + indd">
                                                            <input type="radio" class="radio-option" :name="'answer['+ q.q_id+'][answer]'" :value="ao.ao_id+'_'+ao.text" required aria-required="true"/>
                                                            <label class="lable-for-control" :for="'answer['+ q.q_id+'][answer]'">{{ ao.text }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12" v-if="q.data_type == 4">
                                                        <div v-for="(ao, indd) in q.answer_options" :key="index + '1.' + indx + '.' + indd">
                                                            <input type="checkbox" class="form-check-input" :name="'answer['+q.q_id + '_' + indd +'][answer]'" :value="ao.ao_id+'_'+ao.text" required aria-required="true"/>
                                                            <label class="lable-for-control" :for="'answer['+q.q_id + '_' + indd +'][answer]'">{{ ao.text }}</label>
                                                        </div>
                                                    </div>
                                                    <select v-if="q.data_type == 5" class="form-control" required aria-required="true" multiple>
                                                        <option value="">-- Select One -- </option>
                                                        <option v-for="(ao, ind) in q.answer_options" :key="index + '.' + indx + '.' + ind" :value="ao.ao_id">{{ ao.text }}</option>
                                                    </select>
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
            QuestionAnswers:[]
        }
    },
    methods:{
        async getQuestions(){
            this.QuestionAnswers = [];
            axios.get('students/sen/getquestionnaire/' + this.$route.params.id)
            .then(response =>{
                // alert(JSON.stringify(response));
                let resData = response.data;
                let questionnaire = [];

                // let ab = this.abcdefgh();
                // alert(ab);
                $.each(resData, function(k, qt) {
                    let qType = {
                        category: qt.name,
                        question: []
                    };
                    $.each(qt.questions, function(kk, q) {
                        let ad = q.answer_data_type;
                        let _q = {
                            q_id:q.id,
                            question: q.questions,
                            data_type: ad,
                            answer_options: [],
                        };
                        let questionAns = q.question_answers; 
                        $.each(q.answer_options, function(kkk, a_o) {
                            //String = 0
                            //Numbers = 1
                            //Dropdown = 2
                            //Radio/Checkbox = 3
                            //MultiCheckbox = 4 
                            //MultiSelectList = 5
                            
                            let ao = {
                                ao_id:a_o.id,
                                text:a_o.answer,
                                has_remarks:a_o.can_hav_remarks,
                                checked:(ad == 0 || ad == 1 || ad == 5) ? 'false' : 
                                            questionAns.length > 0 ? 
                                                this.hasAnswer('abc') ?  'true' : 'false' : 'false',
                                ans_text:(ad == 0 || ad == 1) ? 
                                            questionAns.length > 0 ? 
                                                hasAnswer('abc') ? 'answer text here' : '' : '' : '',
                                selected:(ad == 3 || ad == 4 || ad == 5) ? 
                                            questionAns.length > 0 ? 'true' : 'false' : 'false',
                                remarks: a_o.can_hav_remarks ? 
                                            questionAns.length > 0 ? 'this is a remarks' : '' : '',
                                // test: ,
                            };
                            // let ab = this.hasAnswer('abc');
                            _q.answer_options.push(ao);
                            ao = "";

                            function name(qans) {
                                let valObj = qans.filter(function(elem){
                                    return elem.answer_id == 1;
                                }); 
                                if(valObj.length > 0)
                                    alert('true');
                                
                            }
                        });   
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

        hasAnswer(qans) {
            alert('hi');
            // let valObj = qans.filter(function(elem){
            //     return elem.answer_id == 1;
            // });
            // return tempDzo['0'];

            // if(valObj.length > 0)
            //     alert('true');
            
            // let tmpAns = qa.filter(
            //     qa => qa.answer_id === aoid
            // );
            // // alert(tmpAns.length > 0);
            // return tmpAns;
            return true;
        },

        abcdefgh : function(){
            alert('asas');
            return 'abc123';
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
