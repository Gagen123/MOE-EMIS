<template>
    <div>
        <div class="card-body">
            <div class="row form-group">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Selection For:<span class="text-danger">*</span></label><br>
                    <span class="text-blue text-bold">{{selectionList[data_list.selection_type]}}</span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Position:<span class="text-danger">*</span></label><br>
                    <span class="text-blue text-bold">{{ data_list.position_title }}</span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Last Date for Feedback:<span class="text-danger">*</span></label><br>
                    <span class="text-blue text-bold">{{ data_list.to_date }}</span>
                </div>
            </div>
            <label><u>Nominee</u></label>
            <div class="row form-group">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Name:<span class="text-danger">*</span></label><br>
                    <span class="text-blue text-bold">{{data_list.nominee_name}}</span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Current Position:<span class="text-danger">*</span></label><br>
                    <span class="text-blue text-bold">{{ data_list.nominee_position_title }}</span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Working Agency:<span class="text-danger">*</span></label><br>
                    <span class="text-blue text-bold">{{ data_list.working_agency }}</span>
                </div>
            </div>
            <hr />
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            selectionList:{},
            data_list:[],
        }
    },
    methods: {
        getSelectionList(uri = 'questionAnswerController/loadQuestionaries/loadServices_Leadership_Service'){
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
        loadFeedbackQuestion(question_category_type_id,question_service_id){
            axios.get('questionAnswerController/loadQuestionaries/getleadership_'+question_service_id+'_'+question_category_type_id)
            .then(response => {
                let data = response;
            })
            .catch(function (error){
                console.log('err: '+error);
            });
        },
        getFeedbackTypeList(uri = 'questionAnswerController/loadQuestionaries/loadcategoryType_Leadership_CategoryType'){
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
    },
    mounted(){
        this.getSelectionList();
        axios.get('/staff/staffLeadershipSerivcesController/getleadershipDetailsForFeedback/'+this.$route.params.nomination_id)
        .then((response) =>{
            let data=response.data.data;
            this.data_list=data;
            this.loadFeedbackQuestion(data.feedback_id,data.selection_type);
        })
        .catch((error) =>{
            console.log("Error: "+error);
        });
    },
}
</script>
