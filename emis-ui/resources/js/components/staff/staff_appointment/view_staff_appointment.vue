<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-body pt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="personal-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="callout callout-success">
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-1">Emp Id: {{staffList.EmpID}}</label>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-1">Name: {{staffList.FirstName}} {{staffList.MiddleName}} {{staffList.LastName}}</label>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-1">Name: {{staffList.CID}}</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-1">SuperStructure: {{staffList.SuperStructure}}</label>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-1">MasterGroup: {{staffList.MasterGroup}}</label>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-1">SubGroup: {{staffList.SubGroup}}</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-1">Full Working Agency: {{staffList.FullWorkingAgency}}</label>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-1">Position: {{staffList.Position}}</label>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-1">Position Level: {{staffList.positionLevel}}</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-1">Apointment Date: {{staffList.ApointmentDate}}</label>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-1">RCSCSelected: {{staffList.RCSCSelected}}</label>
                                </div>
                            </div>
                        </div>
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
            dt:'',
            staffList:[],
        }
    },
    mounted() {
        this.staffList=this.$route.query.data;
    },
}
</script>
