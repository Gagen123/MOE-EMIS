<template>
    <div>
        <div class="card card-primary card-outline">
            <div class="card-header pt-0 mt-0 pb-0">
                <span class="card-title pt-2 mb-0">
                        <b>Applications for New Establishment</b>
                </span>
                <span class="fa-pull-right pr-2 py-1">
                    <button type="button" class="btn btn-primary text-white btn-sm" @click="showadprocess('establishment_index_list')"><i class="fa fa-list"></i> List</button>
                    <button type="button" class="btn btn-dark text-white btn-sm" @click="showadprocess('establishment')"><i class="fa fa-plus"></i> Apply for New Establishment</button>
                </span>
            </div>
            <div class="card-body pt-1 pb-0">  
                <router-view></router-view> 
            </div>
        </div>
    </div>
</template>
<script>
export default {
    methods: {
        showadprocess(type){
            if(type=="establishment" || type=="edit_establishment"){
                this.$router.push("/"+type);
            }
            if(type=="establishment_index_list"){
                this.$router.push("/establishment_index_list");
            }
		},
    },
}
</script>


