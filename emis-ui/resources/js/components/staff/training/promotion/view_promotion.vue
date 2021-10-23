<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">Name: <span class="text-blue text-bold">{{staffList.staff_name}}</span></label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">Promotion Type: <span class="text-blue text-bold">{{staffList.protype}}</span></label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">Effective Date: <span class="text-blue text-bold">{{staffList.EffectiveDate}}</span></label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">Superstructure: <span class="text-blue text-bold">{{staffList.superstructure}}</span></label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">Position Title: <span class="text-blue text-bold">{{staffList.position_title_name}}</span></label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">Position Level: <span class="text-blue text-bold">{{staffList.positionlevel}}</span></label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">Sub Level: <span class="text-blue text-bold">{{staffList.SubLevel}}</span></label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">By Order No: <span class="text-blue text-bold">{{staffList.ByOrderNo}}</span></label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">By Order Date: <span class="text-blue text-bold">{{reverseDate1(staffList.ByOrderDate)}}</span></label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">Security Clearance No: <span class="text-blue text-bold">{{staffList.SecurityClearanceNo}}</span></label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">Audit Clearance No: <span class="text-blue text-bold">{{staffList.AuditClearanceNo}}</span></label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">Joining Order No: <span class="text-blue text-bold">{{staffList.JoiningOrderNo}}</span></label>
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
    mounted(){
        let uri='/staff/zest/loadPromotionDetails/'+this.$route.query.data.ID;
        axios.get(uri)
        .then(response => {
            let data = response.data;
            this.staffList = data.data;
        });
    },
}
</script>
