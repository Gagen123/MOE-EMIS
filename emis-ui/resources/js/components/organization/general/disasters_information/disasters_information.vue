<template>
    <div> 
        <div class="card card-primary card-outline">
            <div class="card-header pb-1 mb-0 pt-0 mt-0"> 
                <span class="fa-pull-right pr-2">
                    <button type="button" class="btn btn-primary text-white btn-sm" @click="showadprocess('list_disasters_information')"><i class="fa fa-list"></i> List</button>
                    <button type="button" class="btn btn-dark text-white btn-sm" @click="showadprocess('add_disasters_information')"><i class="fa fa-plus"></i> Add Disaster Personnel Information</button>
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
            if(type=="add_disasters_information" || type=="edit_disasters_information"){
                this.$router.push("/"+type);
            }
            if(type=="list_disaster_information"){
                this.$router.push("/list_disaster_information");
            }
		},
    },
    mounted() {
    },
    
}
</script>


