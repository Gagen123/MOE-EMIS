<template>
    <div>
        <div class="callout callout-danger" style="display:none" id="screenPermission">
            <h5 class="bg-gradient-danger">Sorry!</h5>
            <div id="message"></div>
        </div>
        <div id="mainformid">
            <div class="card card-primary card-outline">
                <div class="card-header pt-0 mt-0 pb-0">  
                    <label class="fa-pull-left">Section</label>
                    <span class="fa-pull-right pr-2 py-1">
                        <button type="button" class="btn btn-primary text-white btn-sm" @click="showadprocess('list_section')"><i class="fa fa-list"></i> List</button>
                        <button type="button" class="btn btn-dark text-white btn-sm" @click="showadprocess('create_section')"><i class="fa fa-plus"></i> Add New </button>
                    </span>
                </div>
                <div class="card-body pt-1 pb-0">  
                    <router-view></router-view> 
                </div>
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
    mounted(){
        axios.get('common/getSessionDetail')
        .then(response => {
            let data = response.data.data;
            if(data['acess_level']=="Org"){
                this.form.school=data['Agency_Code'];
                this.getCurrentClassStream(data['Agency_Code']);
            }
            else{
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