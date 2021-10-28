<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label class="mb-0">Application Number:</label>
                        <span class="text-blue text-bold">{{response_data.application_number}}</span>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Applicant Name:</label>
                        <span class="text-blue text-bold">{{response_data.name}}</span>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <table id="waterTable" class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <thead>
                                <tr>
                                    <th style="width:5%">Sl#</th>
                                    <th style="width:55%">Category</th>
                                    <th style="width:20%">Average Score</th>
                                    <th style="width:20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in response_data.feedback" :key="index">
                                    <td>{{ index+1}}</td>
                                    <td>{{ item.feedcat}}</td>
                                    <td>{{ item.avscore}}</td>
                                    <td><button type="button" class="btn btn-success" @click="showDetails(item)"> View Details</button></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="2"><b>Average Score</b></td>
                                    <td><b>{{ response_data.tot_av}}</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade show" id="feedback_modal" aria-modal="true" style="padding-right: 17px;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Feedback Details</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                feedback_details
                                <div class="callout callout-success">
                                    <span><label><u>Feedback Provider Detial</u></label></span>
                                    <div class="row form-group">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Last Date for Feedback:</label><br>
                                            <span class="text-blue text-bold">{{ feedback_details.cid }}</span>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Name:</label><br>
                                            <span class="text-blue text-bold">{{feedback_details.name}}</span>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Position:</label><br>
                                            <span class="text-blue text-bold">{{feedback_details.positiontitle }}</span>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Feedback Category:</label><br>
                                            <span class="text-blue text-bold">{{ feedback_details.feedcat }}</span>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Contact No:</label><br>
                                            <span class="text-blue text-bold">{{feedback_details.contact}}</span>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Email:</label><br>
                                            <span class="text-blue text-bold">{{feedback_details.email }}</span>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row form-group">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <table id="waterTable" class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <thead>
                                                    <tr>
                                                        <th style="width:5%">Sl#</th>
                                                        <th style="width:55%">Question</th>
                                                        <th style="width:20%">Answers</th>
                                                        <th style="width:20%">Watage</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(item, index) in feedback_details.ansQuest" :key="index">
                                                        <td>{{ index+1}}</td>
                                                        <td>{{ item.question}}</td>
                                                        <td>{{ item.ans}}</td>
                                                        <td>{{ item.rate}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td colspan="2"><b>Average Score</b></td>
                                                        <td><b>{{ feedback_details.avscore}}</b></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-right">
                        <button data-bb-handler="close" type="button" data-dismiss="modal" class="btn btn-warning">Close</button>
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
            feedback_details:[],
        }
    },
    methods:{
        showDetails(data){
            this.feedback_details=data;
            $('#feedback_modal').modal('show');
        },
    },
    mounted(){
        axios.get('/staff/staffLeadershipSerivcesController/loadfeedbackDetials/'+this.$route.params.id)
        .then((response) =>{
            let data=response.data;
            this.response_data=data;
        })
        .catch((error) =>{
            console.log("Error: "+error);
        });
    },
}
</script>
