<template>
    <div>
        <div class="callout callout-danger" style="display:none" id="screenPermission">
            <h5 class="bg-gradient-danger">Sorry!</h5>
            <div id="message"></div>
        </div>
        <div class="card card-primary card-outline" id="mainform">
            <div class="card-header pt-0 mt-0 pb-0">
                <span class="card-title pt-2 mb-0">
                    <b>Applications for Establishment Name Change</b>
                </span>
                <span class="fa-pull-right pr-2 py-1">
                    <button type="button" class="btn btn-primary text-white btn-sm" @click="showadprocess('list_name_change')"><i class="fa fa-list"></i> List</button>
                    <button type="button" class="btn btn-dark text-white btn-sm" @click="showadprocess('create_name_change')"><i class="fa fa-plus"></i> Apply for Name Change</button>
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
        showadprocess(type){
            this.$router.push({name:type});
		},
    },
    mounted() {
        axios.get('common/getScreenAccess/workflow__change_in_name')//workflow will specify that the process have workflow
        .then(response => {
            let data = response.data[0].total_count;
            if(data<1){
                // $('#screenPermission').show();
                // $('#mainform').hide();
                // $('#message').html('This page is not accessible to you. Only DET/TEO can avail this services<br> Thank you');
            }
        })
        .catch(errors => {
            console.log(errors)
        });
    }
}
</script>


