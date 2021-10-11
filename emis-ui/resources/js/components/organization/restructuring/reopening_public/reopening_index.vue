<template>
    <div>
        <div class="callout callout-danger" style="display:none" id="screenPermission">
            <h5 class="bg-gradient-danger">Sorry!</h5>
            <div id="message"></div>
        </div>
        <div class="card card-primary card-outline" id="mainform">
            <div class="card-header pt-0 mt-0 pb-0">
                <span class="fa-pull-right pr-2 py-1">
                    <button type="button" class="btn btn-primary text-white btn-sm" @click="showadprocess('reopening_list')"><i class="fa fa-list"></i> List</button>
                    <button type="button" class="btn btn-dark text-white btn-sm" @click="showadprocess('reopening_add')"><i class="fa fa-list"></i> Re-Open Organization</button>
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
     methods:{
        showadprocess(type){
            // this.$router.push(type);
            this.$router.push({name:type});
		},

        getScreenAccess(){
            axios.get('common/getSessionDetail')
            .then(response => {
                let data = response.data.data.acess_level;
                if(data == "Org" || data == "Ministry"){
                    $('#mainform').hide();
                    $('#screenPermission').show();
                    $('#existmessage').html('You have no access to this page.');
                }

            })
            .catch(errors => {
                console.log(errors)
            });
        }
    },
     mounted(){
        this.getScreenAccess();
    }
}
</script>


