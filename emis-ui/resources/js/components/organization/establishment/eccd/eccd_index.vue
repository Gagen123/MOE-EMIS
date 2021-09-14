<template>
    <div>
        <div class="callout callout-danger" style="display:none" id="screenPermission">
            <h5 class="bg-gradient-danger">Sorry!</h5>
            <div id="message"></div>
        </div>
        <div class="card card-primary card-outline" id="mainform">
            <div class="card-header pt-0 mt-0 pb-0">
                <span class="card-title pt-2 mb-0">
                    <b><span id="screenName"></span></b>
                </span>
                <span class="fa-pull-right pr-2 py-1">
                    <button type="button" class="btn btn-primary text-white btn-sm" @click="showadprocess('list_eccd')"><i class="fa fa-list"></i> List</button>
                    <button type="button" class="btn btn-dark text-white btn-sm" @click="showadprocess('create_eccd','Private')"><i class="fa fa-plus"></i>New Private</button>
                    <button type="button" class="btn btn-dark text-white btn-sm" @click="showadprocess('create_eccd','Public')"><i class="fa fa-plus"></i>New Public</button>
                    <button type="button" class="btn btn-dark text-white btn-sm" @click="showadprocess('create_eccd','NGO')"><i class="fa fa-plus"></i>New NGO</button>
                    <button type="button" class="btn btn-dark text-white btn-sm" @click="showadprocess('create_eccd','Corporate')"><i class="fa fa-plus"></i>New Coorporate</button>
                </span>
            </div>
            <div class="card-body pt-1 pb-0">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    methods: {
        showadprocess(uri,type){
            this.$router.push({name:uri,query: {type:type}}).catch(()=>{});
		},
    },
    mounted() {
        axios.get('organizationApproval/getScreenId/'+'ECCD Centre__'+1)
        .then(response => {
            let data = response.data.data;
            if(data!=undefined && data!="NA"){
                $('#screenName').html('<b>Application for '+data.screenName);
            }else{
                $('#screenPermission').show();
                $('#mainform').hide();
                $('#message').html("You don't have privileges to create new application for this service. Please contact with system administrator for further enquiry. <br> Thank you!");
            }
        })
        .catch(errors => {
            console.log(errors)
        });
    }
}
</script>


