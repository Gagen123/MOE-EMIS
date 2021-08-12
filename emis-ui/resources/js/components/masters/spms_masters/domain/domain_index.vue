<template>
     <div>
        <div class="card card-primary card-outline">
            <div class="card-header pb-1 mb-0 pt-0 mt-0 bg-white"> 
                <span class="card-title pt-2 mb-0">
                    <b>Domain</b>
                </span>
                <span class="fa-pull-right pt-1">
                    <button type="button" class="btn btn-flat bg-secondary btn-sm"  @click="loadpage('list_domain')"><i class="fa fa-list"></i> List</button>
                    <button type="button" class="btn btn-flat bg-blue btn-sm" @click="loadpage('create_domain')"><i class="fa fa-plus"></i> Add New</button>
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
    methods:{
         loadpage:function(type){
            this.$router.push({name:type})
        },
    },
    mounted() {
        let routeparam=this.$route.query.data
        this.sub_mod_id=routeparam
    }
}
</script>

