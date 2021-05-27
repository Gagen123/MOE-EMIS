<template>
    <div>
        <div class="card card-primary card-outline">
            <div class="card-header pt-0 mt-0 pb-0"> 
                <span class="fa-pull-right pr-2 py-1">
                    <button type="button" class="btn btn-primary text-white btn-sm" @click="showadprocess('bifurcation_list')"><i class="fa fa-list"></i> List</button>
                    <button type="button" class="btn btn-dark text-white btn-sm" @click="showadprocess('bifurcation_add')"><i class="fa fa-plus"></i> Add New </button>
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
    methods: {
        showadprocess(type){
            if(type=="bifurcation_add" || type=="bifurcation_edit"){
                this.$router.push("/"+type);
            }
            if(type=="bifurcation_list"){
                this.$router.push("/bifurcation_list");
            }
		},
    },

    mounted(){
        // this.getScreenAccess();
    }
}
</script>