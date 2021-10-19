<template>
    <div>
        <form>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="mb-0.5">Staff: {{awarddetails.FirstName}} {{awarddetails.MiddleName}} {{awarddetails.LastName}}</label>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Award Type: {{awarddetails.awardtype}}</label>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Year: {{awarddetails.Year}}</label>
                    <label>Award Date: {{awarddetails.AwardDate}}</label>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="mb-0.5">Remarks: {{awarddetails.Remarks}}</label>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    data(){
        return {
            awarddetails:[],

        }
    },
    mounted(){
        let uri='staff/staffServices/loadStaffAwardforView/'+this.$route.params.data.id+'__'+this.$route.params.data.type;
        axios.get(uri)
        .then(response => {
            let data = response.data.data;
            this.awarddetails =  data;
        })
        .catch(function (error){
            console.log("Error: "+error)
        });
    },

}
</script>
