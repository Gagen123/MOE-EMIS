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
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-bordered text-sm table-striped">
                            <thead>
                                <tr>
                                    <th>SL#</th>
                                    <th>Action Type</th>
                                    <th>Applicable ?</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>270 Degree Feedback</td>
                                    <td>
                                        <label>{{form.feedback==1 ? 'Yes':'No'}}</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Shortlisting</td>
                                    <td>
                                        <label>{{form.shortlist==1 ? 'Yes':'No'}}</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Interview</td>
                                    <td>
                                        <label>{{form.interview==1 ? 'Yes':'No'}}</label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>Applicable Applicants: </label>
                        <table class="table table-bordered text-sm table-striped">
                            <thead>
                                <tr>
                                    <th>SL#</th>
                                    <th>Position Level</th>
                                    <th>Popsition Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for='(data, index) in form.applicant_List' :key="index">
                                    <td>{{index+1}}</td>
                                    <td>
                                        {{data.position_level}}
                                    </td>
                                    <td>
                                        {{data.position_title}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!--<select name="applicant" :id="'applicant'+(index)" class="form-control" v-model="app.applicant">
                                <option value="">--- Please Select ---</option>
                                <option v-for="(item, index) in roleList" :key="index" v-bind:value="item.Id">{{ item.Name }}</option>
                            </select>
                        <span class="text-danger" id="applicant_err"></span> -->
                    </div>
                    <!-- <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <label>Applicable Applicant:</label>
                        <span class="text-blue text-bold">{{form.applicant}}</span>
                    </div> -->
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
                applicant_List:[],
                id:'',
                selection_type:'',
                position_title:'',
                feedback:1,
                interview:1,
                shortlist:1,
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

        loadPositionTitleList(uri = 'staff/loadStaffMasters/active/PositionTitle'){
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
        getSelectionList(uri = 'staff/staffLeadershipSerivcesController/loadData/activeData_LeadershipType'){
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
            axios.get('/staff/staffLeadershipSerivcesController/loadDetials/'+this.form.id)
            .then((response) =>{
                let data=response.data.data;
                this.form.selection_type=data.selection_type;
                $('#selection_type').val(data.selection_type).trigger('change');
                this.form.position_title=data.position_title;
                $('#position_title').val(data.position_title).trigger('change');
                this.form.from_date=data.from_date;
                this.form.to_date=data.to_date;
                this.form.details=data.details;
                this.form.shortlist=data.shortlist;
                this.form.interview=data.interview;
                this.form.feedback=data.feedback;
                this.form.selection_type=data.selection_type;
                this.form.applicant_List=data.applicable_applicant;
                // if(data.applicable_applicant.length>0){
                //     for(let i=0;i<data.applicable_applicant.length;i++){
                //         this.form.applicant+=this.roleList[data.applicable_applicant[i].role_id]+', ';
                //     }
                // }
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
        this.form.id=this.$route.params.id;
        this.loadDetials();
    },
}
</script>
