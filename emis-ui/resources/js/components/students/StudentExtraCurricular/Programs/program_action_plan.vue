<template>
    <div>
        <div class="card card-primary card-outline">
            <div class="card-header pb-1 mb-0 pt-0 mt-0"> 
                <span class="fa-pull-right pr-2">
                    <button type="button" class="btn btn-primary text-white btn-sm" @click="showadprocess('program_action_plan_list')"><i class="fa fa-list"></i> List</button>
                    <button type="button" class="btn btn-dark text-white btn-sm" @click="showadprocess('program_action_plan_add')"><i class="fa fa-plus"></i> Add Program/Club Action Plan</button>
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
            if(type=="program_action_plan_add" || type=="program_action_plan_edit"){
                this.$router.push("/"+type);
            }
            if(type=="program_action_plan_list"){
                this.$router.push("/program_action_plan_list");
            }
		},
    },
    mounted() {
    },
    
}
</script>


