<template>
    <div>
        <div class="card card-primary card-outline">
            <div class="card-header pb-1 mb-0 pt-0 mt-0 bg-white">
                <span class="card-title">
                    <b>Create Transfer Order</b>
                </span>
                <span class="fa-pull-right pt-1">
                    <button type="button" class="btn btn-primary text-white btn-sm" @click="showadprocess('list_transfer_order')" id="listnewbtn"><i class="fa fa-list"></i> List</button>
                    <button type="button" class="btn btn-dark text-white btn-sm" @click="showadprocess('create_transfer_order')" id="addnewbtn"><i class="fa fa-plus"></i> Apply </button>
                    <button type="button" id="appList" style="display:none" class="btn btn-dark text-white btn-sm" @click="showadprocess('list_transfer_order_for_verification')"><i class="fa fa-plus"></i> List for Approval </button>
                </span>
            </div>
            <div class="card-body pb-1 mb-0 pt-1 mt-0">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            screen_id:'',
        }
    },
    methods: {
       showadprocess(type){
            this.$router.push({name:type,query: {list:this.list,deleteopt:this.deleteopt,editopt:this.editopt}});
		},
    },
    mounted() {
        this.screen_id=this.$route.query.data;
        axios.get('common/getSessionDetail')
        .then(response => {
            let data = response.data.data;
            for(let i=0;i<data['roles'].length;i++){
                if(response.data.hrdRole.includes(data['roles'][i].Id)){
                    $('#appList').show();
                }
            }
        })
        .catch(errors => {
            console.log(errors);
        });
    },
}
</script>


