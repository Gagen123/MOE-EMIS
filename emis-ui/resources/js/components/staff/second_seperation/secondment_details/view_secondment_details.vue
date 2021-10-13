<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">Name: <span class="text-blue text-bold">{{staffList.staffName}}</span></label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">Type: <span class="text-blue text-bold">{{staffList.Type}}</span></label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">Effective Date: <span class="text-blue text-bold">{{staffList.EffectiveDate}}</span></label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">Audit Clearance Date: <span class="text-blue text-bold">{{staffList.AuditClearanceDate}}</span></label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">Audit Clearance No: <span class="text-blue text-bold">{{staffList.AuditClearanceNo}}</span></label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">Commission Order Date: <span class="text-blue text-bold">{{staffList.CommissionOrderDate}}</span></label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">Commission Order No: <span class="text-blue text-bold">{{staffList.CommissionOrderNo}}</span></label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">HRC Date: <span class="text-blue text-bold">{{staffList.HRCDate}}</span></label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">HRC No: <span class="text-blue text-bold">{{staffList.HRCNo}}</span></label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">Has Disciplinary Case: <span class="text-blue text-bold">{{staffList.HasDisciplinaryCase = 1 ? 'Yes':'No'}}</span></label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">Has Handling Properly: <span class="text-blue text-bold">{{staffList.HasHandlingProperly = 1 ? 'Yes':'No'}}</span></label>
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
        //let uri='/staff/zest/loadPromotionDetails/'+this.$route.query.data.ID;
        // axios.get(uri)
        // .then(response => {
        //     let data = response.data;
        //     this.staffList = data.data;
        // });
        this.staffList=this.$route.query.data;
    },
}
</script>
