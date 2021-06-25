<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label class="mb-0">Selection For:</label>
                        <span class="text-blue text-bold">{{selectionList[form.selection_type]}}</span>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Position Title:</label>
                        <span class="text-blue text-bold">{{positionList[form.position_title]}}</span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Application Start Date:</label>
                        <span class="text-blue text-bold">{{form.from_date}}</span>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Application End Date:</label>
                        <span class="text-blue text-bold">{{form.to_date}}</span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <label>Details:</label>
                        <span class="text-blue text-bold">{{form.details}}</span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <label>Required Attachment:</label>
                        <span class="text-blue text-bold">{{form.document}}</span>
                    </div>
                </div>
                <hr>
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <button class="btn btn-primary fa-pull-right" @click="submitAnnouncement('feedback-tab')"><i class="fa fa-save"></i> Save & Apply </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
     data(){
        return {
            selectionList:{},
            positionList:{},
            roleList:{},
            form: new form({
                id:'',
                selection_type:'',
                position_title:'',
                from_date:'',
                to_date:'',
                details:'',
                document:'',
                applicant:'',
                action_type:'edit'
            }),
        }
    },
    methods: {
        loadPositionTitleList(uri = 'masters/loadStaffMasters/all_active_position_title'){
            axios.get(uri)
            .then(response =>{
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.positionList[data[i].id] = data[i].name;
                }
            })
            .catch(function (error){
                console.log(error);
            });
        },
        getSelectionList(uri = 'questionAnswerController/loadQuestionaries/loadServices_Leadership_Service'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.selectionList[data[i].id] = data[i].name;
                }
            })
            .catch(function (error){
                console.log('err in retrieving services: '+error);
            });
        },
        loadroleList(uri = 'masters/getroles/allActiveRoles'){
            axios.get(uri)
            .then(response =>{
                let data = response.data;
                for(let i=0;i<data.length;i++){
                    this.roleList[data[i].Id] = data[i].Name;
                }
            })
            .catch(function (error){
                console.log(error);
            });
        },
        loadDetials(){
            axios.get('/staff/staffLeadershipSerivcesController/loadPostDetials')
            .then((response) =>{
                let data=response.data.data;
                this.form.selection_type=data.selection_type;
                $('#selection_type').val(data.selection_type).trigger('change');
                this.form.position_title=data.position_title;
                $('#position_title').val(data.position_title).trigger('change');
                this.form.from_date=data.from_date;
                this.form.to_date=data.to_date;
                this.form.details=data.details;
                this.form.selection_type=data.selection_type;
                if(data.applicable_applicant.length>0){
                    for(let i=0;i<data.applicable_applicant.length;i++){
                        this.form.applicant+=this.roleList[data.applicable_applicant[i].role_id]+', ';
                    }
                }
                if(data.attachments.length>0){
                    for(let i=0;i<data.attachments.length;i++){
                        this.form.document+=data.attachments[i].attachment+', ';
                    }
                }
            })
            .catch((error) =>{
                console.log("Error: "+error);
            });
        }

    },
    mounted(){
        this.getSelectionList();
        this.loadroleList();
        this.loadPositionTitleList();
        this.loadDetials();
    },
}
</script>
