<template>
    <div>
        <div class="card card-primary card-outline">
            <div class="card-header pt-0 mt-0 pb-0">
                <span class="card-title pt-2 mb-0">
                        <b>Applications for New Public ECCD Establishment</b>
                </span>
                <span class="fa-pull-right pr-2 py-1">
                    <button type="button" class="btn btn-primary text-white btn-sm" @click="showadprocess('list_public_eccd')"><i class="fa fa-list"></i> List</button>
                    <button type="button" class="btn btn-dark text-white btn-sm" @click="showadprocess('create_public_eccd')"><i class="fa fa-plus"></i> Apply for New Establishment</button>
                    <button type="button" class="btn btn-dark text-white btn-sm"><i class="fa fa-print"></i> Print</button>
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
            this.$router.push({name:type});
		},
    },
}
</script>


