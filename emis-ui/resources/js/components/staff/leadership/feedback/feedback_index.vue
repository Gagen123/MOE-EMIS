<template>
    <div>
        <div class="card card-primary card-outline">
            <div class="card-header pb-1 mb-0 pt-0 mt-0 bg-white"> 
                <span class="card-title">
                    <b>Feedback</b>
                </span>
                <span class="fa-pull-right pt-1">
                    <button type="button" class="btn btn-dark text-white btn-sm" @click="showadprocess('list_feedback')" id="addnewbtn"><i class="fa fa-list"></i> List</button>
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
    methods: {
       showadprocess(type){
            this.$router.push({name:type,query: {list:this.list,deleteopt:this.deleteopt,editopt:this.editopt}});
		},
    },
}
</script>


