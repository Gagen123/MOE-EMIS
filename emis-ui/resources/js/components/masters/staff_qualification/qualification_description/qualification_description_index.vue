<template>
    <div>
        <section class="content ml-n4 mr-n3">
            <div class="container-fluid">
                <div class="row"> 
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-header bg-white pt-2 pb-1 text-right">
                                <label class="fa-pull-left">Qualification Description</label>
                                <button type="button" class="btn btn-flat bg-secondary btn-sm"  @click="loadpage('list_qualification_description')"><i class="fa fa-list"></i> List</button>
                                <button type="button" class="btn btn-flat bg-blue btn-sm" @click="loadpage('create_qualification_description')"><i class="fa fa-plus"></i> Add New</button>
                            </div>
                            <router-view></router-view>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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

