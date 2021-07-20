<template>
    <div>
        <div class="card card-primary card-outline">
            <div class="card-header pb-1 mb-0 pt-1 mt-0">
                <span class="fa-pull-right pr-2">
                    <button type="button" class="btn btn-primary text-white btn-sm" @click="showadprocess('list_civil_staff')"><i class="fa fa-list"></i> List</button>
                    <button type="button" class="btn btn-dark text-white btn-sm" @click="showadprocess('create_civil_staff')"><i class="fa fa-plus"></i> Add New</button>
                </span>
            </div>
            <div class="pb-1 mb-0 pt-1 mt-0">
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
            this.$router.push({name:type});
		},
    },

}
</script>


