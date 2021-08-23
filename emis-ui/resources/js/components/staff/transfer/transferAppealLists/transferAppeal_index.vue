<template>
    <div>
        <div class="card card-primary card-outline">
            <div class="card-header pb-1 mb-0 pt-0 mt-0 bg-white">
                <span class="card-title">
                    <b>Transfer Appeal Lists</b>
                </span>
            
                <span class="fa-pull-right pt-1">
                 <div class="btn-group">
                    <button type="button" class="btn btn-outline-primary btn-sm" v-on:click="reloadPage">
                        <i class="fas fa-redo"></i>
                    </button>
                 </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-outline-primary btn-sm" v-on:click="printInstructorRegistration">
                        <i class="fas fa-print"></i>
                    </button>
                </div>
                    <button type="button" class="btn btn-primary text-white btn-sm" @click="showadprocess('list_transferAppealLists')"><i class="fa fa-list"></i> List</button>
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
    methods:{
        showadprocess(type){
            this.$router.push("/"+type);
		},
        reloadPage(){
            window.location.reload()
            },
        printInstructorRegistration(){
            window.print();
        },
    },
    mounted(){

    },
}
</script>


