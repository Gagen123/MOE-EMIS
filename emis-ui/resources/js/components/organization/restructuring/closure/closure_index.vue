<template>
    <div>
        <div class="card card-primary card-outline">
        <div class="card-header">
            <span class="fa-pull-right">
                <button type="button" class="btn btn-primary btn-flat text-white btn-xs" @click="showadprocess('closure_list')"><i class="fa fa-list"></i> List</button>
            </span>
        </div>
        <div class="card-body">  
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
    methods:{
        showadprocess(type){
            this.$router.push(type);
		},
    }
}
</script>