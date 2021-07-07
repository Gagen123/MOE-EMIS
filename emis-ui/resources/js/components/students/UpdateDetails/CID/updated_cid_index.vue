<template>
    <div>
        <div class="card card-primary card-outline">
            <div class="card-header pb-1 mb-0 pt-0 mt-0"> 
                <span class="fa-pull-right pr-2">
                    <button type="button" class="btn btn-primary text-white btn-sm" @click="showadprocess('updated_cid_list')"><i class="fa fa-list"></i> List</button>
                    <button type="button" class="btn btn-dark text-white btn-sm" @click="showadprocess('update_cid')"><i class="fa fa-plus"></i> Update Student CID</button>
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
            if(type=="update_cid" || type=="edit_updated_cid"){
                this.$router.push("/"+type);
            }
            if(type=="updated_cid_list"){
                this.$router.push("/updated_cid_list");
            }
		},
    },
    mounted() {
    },
    
}
</script>


