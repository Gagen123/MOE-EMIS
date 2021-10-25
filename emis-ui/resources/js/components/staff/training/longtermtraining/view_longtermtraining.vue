<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">Name: {{staffList.staff_name}}</label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">Course: {{staffList.Course}}</label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">Email ID: {{staffList.EmailID}}</label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">Start Date: {{staffList.StartDate}}</label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">End Date: {{staffList.EndDate}}</label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">Training Status: {{staffList.training_status}}</label>
            </div>
        </div>
        <!-- <div class="form-group row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">HRC No: {{staffList.HRCNo}}</label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">HRC Date: {{staffList.HRCDate}}</label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">HRC Reason: {{staffList.HRCReason}}</label>
            </div>
        </div> -->
        <!-- <div class="form-group row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">Is Other Verified: {{staffList.IsOtherVerified=1?'Yes':'No'}}</label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">Is Training Verified: {{staffList.IsTrainingVerified =1?'Yes':'No'}}</label>
            </div>
        </div> -->
        <!-- <div class="form-group row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">PDBCC: {{staffList.PDBCC}}</label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">PDB Date: {{staffList.PDBDate}}</label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">PDB Focal Officer: {{staffList.PDBFocalOfficer}}</label>
            </div>
        </div> -->
        <!-- <div class="form-group row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">PDB Location: {{staffList.PDBLocation}}</label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">PDB Remarks: {{staffList.PDBRemarks}}</label>
            </div>
        </div> -->
    </div>
</template>
<script>
export default {
    data(){
        return {
            staffList:[],
        }
    },

    mounted() {
        let uri='/staff/zest/loadLongTermTraining/byId__'+this.$route.query.data.ID;
        axios.get(uri)
        .then(response => {
            this.staffList = response.data.data;
        });
    },
}
</script>
