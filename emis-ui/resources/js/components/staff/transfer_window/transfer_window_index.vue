<template>
    <div>
        <div class="card card-primary card-outline">
            <div class="card-header pb-1 mb-0 pt-0 mt-0 bg-white"> 
                <span class="card-title">
                    <b>Transfer Time Schedule</b>
                </span>
                <span class="fa-pull-right pt-1">
                    <button type="button" class="btn btn-primary text-white btn-sm" @click="showadprocess('list_transfer_window')"><i class="fa fa-list"></i> List</button>
                    <button type="button" class="btn btn-dark text-white btn-sm" @click="showadprocess('create_transfer_window')"><i class="fa fa-plus"></i> Add New</button>
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
            this.$router.push("/"+type);
		},
    },
    mounted() {
    },
    
}
</script>


