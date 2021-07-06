<template>
    <div>
        <div class="card card-primary card-outline">
            <div class="card-header pb-1 mb-0 pt-0 mt-0"> 
                <span class="fa-pull-right pr-2">
                    <button type="button" class="btn btn-primary text-white btn-sm" @click="showadprocess('updated_guardian_list')"><i class="fa fa-list"></i> List</button>
                    <button type="button" class="btn btn-dark text-white btn-sm" @click="showadprocess('update_guardian')"><i class="fa fa-plus"></i> Update Guardian Details</button>
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
        } 
    },
    methods: {
        showadprocess(type){
            if(type=="update_guardian" || type=="edit_updated_guardian"){
                this.$router.push("/"+type);
            }
            if(type=="updated_guardian_list"){
                this.$router.push("/updated_guardian_list");
            }
		},
    },
    mounted() {
    },
    
}
</script>


