<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">Name: <span class="text-blue text-bold">{{staffList.staff_name}}</span></label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">Type: <span class="text-blue text-bold">{{staffList.Type}}</span></label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0.5">Effective Date: <span class="text-blue text-bold">{{reverseDateTime(staffList.EffectiveDate)}}</span></label>
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
