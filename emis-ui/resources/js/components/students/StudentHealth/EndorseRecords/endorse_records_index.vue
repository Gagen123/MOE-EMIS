<template>
    <div>
        <div class="card card-primary card-outline">
            <div class="card-header pb-1 mb-0 pt-0 mt-0"> 
                <span class="fa-pull-right pr-2">
                    <button type="button" class="btn btn-primary text-white btn-sm" @click="showadprocess('endorse_records_list')"><i class="fa fa-list"></i> List</button>
                    <button type="button" class="btn btn-dark text-white btn-sm" @click="showadprocess('endorse_records_add')"><i class="fa fa-plus"></i> Prepare Health Record</button>
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
    methods: {
        showadprocess(type){
            if(type=="endorse_records_add" || type=="endorse_records_edit"){
                this.$router.push("/"+type);
            }
            if(type=="endorse_records_list"){
                this.$router.push("/endorse_records_list");
            }
		},
    },
    mounted() {
    },
    
}
</script>