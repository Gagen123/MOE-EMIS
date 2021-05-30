<template>
    <div>
        <div class="card card-primary card-outline">
            <div class="card-header pt-0 mt-0 pb-0"> 
                <span class="fa-pull-right pr-2 py-1">
                    <button type="button" class="btn btn-primary text-white btn-sm" @click="showadprocess('slocation_list')"><i class="fa fa-plus"></i> Edit Location Details</button>
                    <button type="button" class="btn btn-primary text-white btn-sm" @click="showadprocess('slocation_list')"><i class="fa fa-plus"></i> Edit Connectivity Details</button>
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
            if(type=="slocation_add" || type=="slocation_edit"){
                this.$router.push("/"+type);
            }
            if(type=="slocation_list"){
                this.$router.push("/slocation_list");
            }
		},
    },
}
</script>