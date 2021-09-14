<template>
    <div>
        <div class="callout callout-danger" style="display:none" id="screenPermission">
            <h5 class="bg-gradient-danger">Sorry!</h5>
            <div id="message"></div>
        </div>
        <div class="card card-primary card-outline" id="mainform">
            <div class="card-header pt-0 mt-0 pb-0">
                <!-- <span class="card-title pt-2 mb-0">
                    <b>Applications for Change in SEN details</b>
                </span> -->
                <span class="fa-pull-right pr-2 py-1">
                    <button type="button" class="btn btn-primary text-white btn-sm" @click="showadprocess('list_sen_change')"><i class="fa fa-list"></i> List</button>
                    <button type="button" class="btn btn-dark text-white btn-sm" @click="showadprocess('create_sen_change')"><i class="fa fa-plus"></i> Apply for Change in SEN</button>
                </span>
            </div>
            <div class="card-body pt-1 pb-0">
                <router-view></router-view>
            </div>
            <!-- <div class="callout callout-danger" v-else>
                <div class="form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                         <h5 class="bg-gradient-danger">Sorry!</h5>
                        <div>You are not accessible to this page! Only DEO/TEO can access here</div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
        }
    },
    methods: {
        showadprocess(type){
            this.$router.push({name:type});
		},
    },
    mounted() {
        axios.get('common/getScreenAccess/workflow__change_in_sen_details')//workflow will specify that the process have workflow
        .then(response => {
            let data = response.data[0].total_count;
            // if(data<1){
            //     $('#screenPermission').show();
            //     $('#mainform').hide();
            //     $('#message').html('This page is not accessible to you. Only DET/TEO can avail this services<br> Thank you');
            // }
        })
        .catch(errors => {
            console.log(errors)
        });
    }
}
</script>


