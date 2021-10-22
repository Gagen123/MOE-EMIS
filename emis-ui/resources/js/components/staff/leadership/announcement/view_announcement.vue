<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label class="mb-0">Selection For:</label>
                        <span class="text-blue text-bold">{{response_data.selection_type_name}}</span>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Position Title:</label>
                        <span class="text-blue text-bold">{{response_data.position_name}}</span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Application Start Date:</label>
                        <span class="text-blue text-bold">{{reverseDate1(response_data.from_date)}}</span>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Application End Date:</label>
                        <span class="text-blue text-bold">{{reverseDate1(response_data.to_date)}}</span>
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
                                        <label>{{response_data.feedback==1 ? 'Yes':'No'}}</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Shortlisting</td>
                                    <td>
                                        <label>{{response_data.shortlist==1 ? 'Yes':'No'}}</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Interview</td>
                                    <td>
                                        <label>{{response_data.interview==1 ? 'Yes':'No'}}</label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>Details:</label>
                        <span class="text-blue text-bold">{{response_data.details}}</span>
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
                        <label>Eligible Applicants: </label>
                        <table class="table table-bordered text-sm table-striped">
                            <thead>
                                <tr>
                                    <th>SL#</th>
                                    <th>Position Level</th>
                                    <th>Popsition Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for='(data, index) in response_data.applicable_applicant' :key="index">
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
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 overflow-auto">
                        <label>Application List: </label>
                        <table class="table table-bordered text-sm table-striped">
                            <thead>
                                <tr>
                                    <th>SL#</th>
                                    <th>App No</th>
                                    <th>Name</th>
                                    <th>Emp Id</th>
                                    <th>Position Title</th>
                                    <th>Position Level</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Feedback Score</th>
                                    <th>Interview Score</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for='(data, index) in response_data.applications' :key="index">
                                    <td>{{index+1}}</td>
                                    <td>{{data.application_number}}</td>
                                    <td>{{data.aplicant_name}}</td>
                                    <td>{{data.eid}}</td>
                                    <td>{{data.positiontitle}}</td>
                                    <td>{{data.positionlevel}}</td>
                                    <td>
                                        {{data.org_id=='External Application'? 'Out of Ministry': 'Within Ministry'}}
                                    </td>
                                    <td> {{data.status}} </td>
                                    <td> {{data.totalwatage}} </td>
                                    <td> {{data.interniew_score}} </td>
                                    <td> {{data.status}} </td>
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
            response_data:[],
            form: new form({
                applicant_List:[],
                id:'',
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
        loadDetials(){
            axios.get('/staff/staffLeadershipSerivcesController/loadDetials/'+this.form.id)
            .then((response) =>{
                let data=response.data.data;
                this.response_data=data;
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
        this.form.id=this.$route.params.id;
        this.loadDetials();
    },
}
</script>
