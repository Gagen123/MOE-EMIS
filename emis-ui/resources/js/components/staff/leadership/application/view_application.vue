<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-body">
                <template v-if="post_detail!=''">
                    <div class="row form-group">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Position Title:</label>
                            <span class="text-blue text-bold">{{positionList[post_detail.position_title]}}</span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Application Start Date:</label>
                            <span class="text-blue text-bold">{{post_detail.from_date}}</span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Application End Date:</label>
                            <span class="text-blue text-bold">{{post_detail.to_date}}</span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <label>Details:</label>
                            <span class="text-blue text-bold">{{post_detail.details}}</span>
                        </div>
                    </div>
                </template>
                <div class="row form-group">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <label>Applicant:</label>
                        <span class="text-blue text-bold">{{staffList[form.applicant]}}</span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <label>Remarks:</label>
                        <span class="text-blue text-bold">{{form.remarks}}</span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label class="mb-0">Documents<span class="text-danger">*</span></label>
                        <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>File Name</th>
                                    <th>Upload File</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for='(attach,count) in applicationdetailsatt' :key="count+1">
                                    <template>
                                        <td>{{attach.user_defined_name}} </td>
                                        <td>  {{attach.original_name}}</td>
                                        <td>
                                            <a href="#" @click="openfile(attach)" class="fa fa-eye"> View</a>
                                        </td>
                                    </template>
                                </tr>
                            </tbody>
                        </table>
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
            post_detail:'',
            staffList:{},
            applicationdetailsatt:'',
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
        openfile(file){
            let file_path=file.path+'/'+file.original_name;
            file_path=file_path.replaceAll('/', 'SSS');
            let uri = 'common/viewFiles/'+file_path;
            window.location=uri;
        },
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
        loadPostDetials(id){
            axios.get('/staff/staffLeadershipSerivcesController/loadapplicaitontDetials/'+id)
            .then((response) =>{
                let data=response.data.data[0];
                this.post_detail=data;
                this.form.id=data.id;
                this.form.remarks=data.remarks;
                this.form.applicant=data.staff_id;
                this.form.post_id=data.post_id;
                this.require_count=data.attachments.length;
                this.count=data.attachments.length;
                this.applicationdetailsatt=data.attachments;
            })
            .catch((error) =>{
                console.log("Error: "+error);
            });
        },
        loadstaff(){
            let uri = 'loadCommons/loadFewDetailsStaffList/userworkingagency/NA';
            axios.get(uri)
            .then(response =>{
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.staffList[data[i].id] = data[i].name;
                }
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },

    },
    mounted(){
        this.getSelectionList();
        this.loadroleList();
        this.loadstaff();
        this.loadPositionTitleList();
        this.loadPostDetials(this.$route.params.id);
    },
}
</script>
