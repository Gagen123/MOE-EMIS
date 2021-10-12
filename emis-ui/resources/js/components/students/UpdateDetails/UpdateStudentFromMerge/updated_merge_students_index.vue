<template>
    <div>
        <div class="card card-primary card-outline">
            <div class="card-header pb-1 mb-0 pt-0 mt-0"> 
                <span class="fa-pull-right pr-2">
                    <button type="button" class="btn btn-primary text-white btn-sm" @click="showadprocess('list_updated_merge_students')"><i class="fa fa-list"></i> List</button>
                    <button type="button" class="btn btn-dark text-white btn-sm" @click="showadprocess('create_updated_merge_students')"><i class="fa fa-plus"></i> Register Student</button>
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
            if(type=="create_updated_merge_students" || type=="edit_updated_merge_students"){
                this.$router.push("/"+type);
            }
            if(type=="list_updated_merge_students"){
                this.$router.push("/list_updated_merge_students");
            }
		},
    },
    mounted() {
    },
    
}
</script>


