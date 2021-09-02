<template>
    <div>
        <div class="card card-primary card-outline" id="mainform">
            <div class="card-header pt-0 mt-0 pb-0">
                <span class="card-title pt-2 mb-0">
                        <b>Applications for New ECCD</b>
                </span>
                <span class="fa-pull-right pr-2 py-1">
                    <button type="button" class="btn btn-primary text-white btn-sm" @click="showadprocess('list_eccd')"><i class="fa fa-list"></i> List</button>
                    <button type="button" class="btn btn-dark text-white btn-sm" @click="showadprocess('create_eccd','Private')"><i class="fa fa-plus"></i>New Private</button>
                    <button type="button" class="btn btn-dark text-white btn-sm" @click="showadprocess('create_eccd','Public')"><i class="fa fa-plus"></i>New Public</button>
                    <button type="button" class="btn btn-dark text-white btn-sm" @click="showadprocess('create_eccd','NGO')"><i class="fa fa-plus"></i>New NGO</button>
                    <button type="button" class="btn btn-dark text-white btn-sm" @click="showadprocess('create_eccd','Corporate')"><i class="fa fa-plus"></i>New Coorporate</button>
                    <!-- <button type="button" class="btn btn-dark text-white btn-sm"><i class="fa fa-print"></i> Print</button> -->
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
        showadprocess(uri,type){
            this.$router.push({name:uri,query: {type:type}}).catch(()=>{});
		},
    },
}
</script>


