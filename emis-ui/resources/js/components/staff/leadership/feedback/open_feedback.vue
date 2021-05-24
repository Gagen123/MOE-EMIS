<template>
    <div>
        <div class="card-body">
            <div class="row form-group">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Selection For:<span class="text-danger">*</span></label> 
                    <span class="text-blue text-bold">{{selectionList[data_list.selection_type]}}</span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Position:<span class="text-danger">*</span></label> 
                    <span class="text-blue text-bold">{{ data_list.position_title }}</span>
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
            data_list:[],
        } 
    },
    methods: {
        getSelectionList(uri = 'questionAnswers/loadQuestionaries/loadServices_Leadership_Service'){
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
    },
    mounted(){
        this.getSelectionList();
        axios.get('/staff/staffLeadershipSerivcesController/getleadershipDetailsForFeedback/'+this.$route.params.data)
        .then((response) =>{  
            let data=response.data.data;
            this.data_list=data;
            this.form.id=data.id;
        })
        .catch((error) =>{  
            console.log("Error: "+error);
        });
    },
}
</script>