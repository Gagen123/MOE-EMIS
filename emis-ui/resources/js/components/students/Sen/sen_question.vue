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
                                {{ index + 1 }} {{ qtype.name }}
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
                                        <tr v-for="(q, indx) in qtype.questions" :key="index + '.' + indx">
                                            <td>{{ (index + 1) + '.' + indx }}</td>
                                            <td>
                                                {{ q.questions}} <br />
                                                <div class="col-md-12">
                                                    <textarea v-if="q.answer_data_type == 1" class="form-control required" rows="3" required aria-required="true">
                                                    </textarea>
                                                    <select v-if="q.answer_data_type == 2" class="form-control" required aria-required="true">
                                                        <option value="">-- Select One -- </option>
                                                        <option v-for="(ao, ind) in q.answer_options" :key="index + '.' + indx + '.' + ind" :value="ao.id">{{ ao.answer }}</option>
                                                    </select>
                                                    <div class="col-xs-12" v-if="q.answer_data_type == 3">
                                                        <div v-for="(ao, indd) in q.answer_options" :key="index + '.' + indx + '.' + indd">
                                                            <input type="radio" class="radio-option" :name="'answer['+ q.id+'][answer]'" :value="ao.id+'_'+ao.answer" required aria-required="true"/>
                                                            <label class="lable-for-control" :for="'answer['+ q.id+'][answer]'">{{ ao.answer }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12" v-if="q.answer_data_type == 4">
                                                        <div v-for="(ao, indd) in q.answer_options" :key="index + '1.' + indx + '.' + indd">
                                                            <input type="checkbox" class="form-check-input" :name="'answer['+q.id + '_' + indd +'][answer]'" :value="ao.id+'_'+ao.answer" required aria-required="true"/>
                                                            <label class="lable-for-control" :for="'answer['+q.id + '_' + indd +'][answer]'">{{ ao.answer }}</label>
                                                        </div>
                                                    </div>
                                                    <select v-if="q.answer_data_type == 5" class="form-control" required aria-required="true" multiple>
                                                        <option value="">-- Select One -- </option>
                                                        <option v-for="(ao, ind) in q.answer_options" :key="index + '.' + indx + '.' + ind" :value="ao.id">{{ ao.answer }}</option>
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
        getQuestions(){
            axios.get('students/sen/getquestionnaire/' + this.$route.params.id)
            .then(response =>{
                alert(JSON.stringify(response));
                this.QuestionAnswers = response.data;
            }).catch(function (error){
                //
            });
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
