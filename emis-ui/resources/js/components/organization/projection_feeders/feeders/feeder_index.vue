<template>
    <div>
         <div class="callout callout-danger" style="display:none" id="screenPermission">
            <h5 class="bg-gradient-danger">Sorry!</h5>
            <div id="message"></div>
        </div>
        <div id="mainformid">
            <div class="card card-primary card-outline">
                <div class="card-header pb-1 mb-0 pt-0 mt-0"> 
                    <span class="fa-pull-right pr-2">
                        <button type="button" class="btn btn-primary text-white btn-sm" @click="showadprocess('list_feeder')"><i class="fa fa-list"></i> List</button>
                        <button type="button" class="btn btn-dark text-white btn-sm" @click="showadprocess('add_feeder')"><i class="fa fa-plus"></i> New Feeder School</button>
                    </span>
                </div>
                <div class="card-body pb-1 mb-0 pt-1 mt-0">  
                    <router-view></router-view> 
                </div>
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
    methods: {
        showadprocess(type){
            if(type=="add_feeder" || type=="edit_feeder"){
                this.$router.push("/"+type);
            }
            if(type=="list_feeder"){
                this.$router.push("/list_feeder");
            }
		},
    },
    mounted(){
        axios.get('common/getSessionDetail')
        .then(response => {
            let data = response.data.data;
            if(data['acess_level']=="Org"){
                $('#screenPermission').show();
                $('#mainformid').hide();
                $('#message').html('This page is not accessible to you');
            }
        })    
        .catch(errors => { 
            console.log(errors)
        });
    }
    
}
</script>


