<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Name: {{staffList.staff_name}}</label>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Promotion Type: {{staffList.PromotionTypeID}}</label>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                   <label class="mb-0.5">Effective Date: {{staffList.EffectiveDate}}</label>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Superstructure: {{staffList.superstructure}}</label>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Position Title: {{staffList.position_title_name}}</label>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                   <label class="mb-0.5">Position Level: {{staffList.positionlevel}}</label>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Sub Level: {{staffList.SubLevel}}</label>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">By Order No: {{staffList.ByOrderNo}}</label>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                   <label class="mb-0.5">By Order Date: {{staffList.ByOrderDate}}</label>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Security Clearance No: {{staffList.SecurityClearanceNo}}</label>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Audit Clearance No: {{staffList.AuditClearanceNo}}</label>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                   <label class="mb-0.5">Joining Order No: {{staffList.JoiningOrderNo}}</label>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Is Promotion: {{staffList.IsPromotion}}</label>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Is Qualify: {{staffList.IsQualify}}</label>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                   <label class="mb-0.5">Is Spl Request: {{staffList.IsSplRequest}}</label>
                </div>
            </div>
        </div>
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
        let uri='/staff/zest/loadPromotionDetails/'+this.$route.params.data.ID;
        axios.get(uri)
        .then(response => {
            let data = response.data;
            this.staffList = data.data;
        });
    },
}
</script>
