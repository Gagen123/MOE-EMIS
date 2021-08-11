<template>
    <div>
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header bg-white pt-2 pb-1 text-right">
                    <label class="fa-pull-left">Admission and Transfer</label>
                    <!-- <button type="button" class="btn btn-flat bg-secondary btn-sm"  @click="loadpage('list_new_admission_transfer')"><i class="fa fa-list"></i> List</button>
                    <button type="button" class="btn btn-flat bg-blue btn-sm" @click="loadpage('create_new_admission_transfer')"><i class="fa fa-plus"></i> Apply New</button> -->
                </div>
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    methods:{
         loadpage:function(type){
            this.$router.push({name:type});
        },
    },
    mounted() {
        let routeparam=this.$route.query.data;
        this.sub_mod_id=routeparam;
    },

}
</script>

