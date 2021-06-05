<template>
    <div>
        <div class="card card-primary card-outline">
            <div class="card-header pt-0 mt-0 pb-0">
                <span class="card-title pt-2 mb-0">
                        <b>Applications for New Establishment</b>
                </span>
            </div>
            <div class="card-body pt-1 pb-0">  
                <establishment_index_listVue />
            </div>
        </div>
    </div>
</template>
<script>
import establishment_index_listVue from './establishment_index_list.vue';

export default {
    components: {establishment_index_listVue},
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


