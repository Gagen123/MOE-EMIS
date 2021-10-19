<template>
    <div>
        <div id="mainformid">
            <div class="card card-primary card-outline">
                <div class="card-header pb-1 mb-0 pt-0 mt-0"> 
                    <span class="fa-pull-right pr-2">
                        <button type="button" class="btn btn-primary text-white btn-sm" @click="showadprocess('list_feeder_student')"><i class="fa fa-list"></i> List</button>
                        <button type="button" class="btn btn-dark text-white btn-sm" @click="showadprocess('add_feeder_student')"><i class="fa fa-plus"></i> New Student For Parent School</button>
                    </span>
                </div>
                <div class="card-body pb-1 mb-0 pt-1 mt-0">  
                    <router-view></router-view> 
                </div>
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
            if(type=="add_feeder_student" || type=="edit_feeder_student"){
                this.$router.push("/"+type);
            }
            if(type=="list_feeder_student"){
                this.$router.push("/list_feeder_student");
            }
		},
    },
    mounted(){

    }
    
}
</script>


