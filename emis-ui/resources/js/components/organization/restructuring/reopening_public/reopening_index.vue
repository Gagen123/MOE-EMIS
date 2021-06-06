<template>
    <div>
        <div class="callout callout-danger" style="display:none" id="screenPermission">
            <h5 class="bg-gradient-danger">Sorry!</h5>
            <div id="existmessage"></div>
        </div>
        <div class="card card-primary card-outline" id="mainform">
            <div class="card-header">
                <span class="fa-pull-right">
                    <button type="button" class="btn btn-primary btn-flat text-white btn-xs" @click="showadprocess('reopening_list')"><i class="fa fa-list"></i> List</button>
                    <button type="button" class="btn btn-primary btn-flat text-white btn-xs" @click="showadprocess('reopening_add')"><i class="fa fa-list"></i> Re-Open Organization</button>
                </span>
            </div>
            <div class="card-body">  
                <router-view></router-view> 
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{

        }
    },
    methods:{
        showadprocess(type){
            this.$router.push(type);
		},

        // getScreenAccess(){
        //     axios.get('common/getSessionDetail')
        //     .then(response => {
        //         let data = response.data.data.acess_level;
        //         if(data == "Org" || data == "Ministry"){
        //             $('#mainform').hide();
        //             $('#screenPermission').show();
        //             $('#existmessage').html('You have no access to this page.');
        //         }
                
        //     })    
        //     .catch(errors => { 
        //         console.log(errors)
        //     });
        // }
    },

    mounted(){
        this.getScreenAccess();
    }
}
</script>