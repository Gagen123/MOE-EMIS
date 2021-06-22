<template>
    <div>
        <div class="card card-primary card-outline">
            <div class="card-header pt-0 mt-0 pb-0">
                <span class="card-title pt-2 mb-0">
                    <b>Application for Autonomy</b>
                </span>
                <span class="fa-pull-right pr-2 py-1">
                    <button type="button" class="btn btn-primary text-white btn-sm" @click="showadprocess('list_autonomous')"><i class="fa fa-list"></i> List</button>
                    <button type="button" class="btn btn-dark text-white btn-sm" @click="showadprocess('create_autonomous')"><i class="fa fa-plus"></i> Apply for Aotunomy</button>
                </span>
            </div>
            <div class="card-body pt-1 pb-0" v-if="isvalid">
                <router-view></router-view>
            </div>
            <div class="callout callout-danger" v-else>
                <div class="form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                         <h5 class="bg-gradient-danger">Sorry!</h5>
                        <div>You are not accessible to this page! Only DEO/TEO can access here</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            isvalid:false,
        }
    },
    methods: {
        showadprocess(type){
            this.$router.push({name:type});
		},
    },
    mounted(){
        axios.get('common/getSessionDetail')
        .then(response => {
            let data = response.data.data;
            if(data['acess_level']=="Dzongkhag"){
                this.isvalid=true;
            }
        })
    }
}
</script>


