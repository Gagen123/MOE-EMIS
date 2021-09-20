<template>
     <div>
        <div class="card card-primary card-outline">
            <div class="card-header bg-white pt-2 pb-1 text-right">
                <label class="fa-pull-left">Remedial Class</label>
                <button type="button" class="btn btn-flat bg-secondary btn-sm"  @click="loadpage('list_remedial_class')"><i class="fa fa-list"></i> List</button>
                <button type="button" class="btn btn-flat bg-blue btn-sm" @click="loadpage('create_remedial_class')"><i class="fa fa-plus"></i> Add New</button>
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
        loadpage(type){
        this.$router.push({name:type});
    },
    },
    mounted() {
        let routeparam=this.$route.query.data;
        this.sub_mod_id=routeparam;
    }
}
</script>

