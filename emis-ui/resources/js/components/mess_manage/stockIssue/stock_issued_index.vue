<template>
    <div>
        <div class="card card-primary card-outline">
            <div class="card-header pb-1 mb-0 pt-0 mt-0"> 
                <span class="fa-pull-right pr-2">
                    <button type="button" class="btn btn-primary text-white btn-sm" @click="showadprocess('stockissuelist')"><i class="fa fa-list"></i> List</button>
                    <button type="button" class="btn btn-dark text-white btn-sm" @click="showadprocess('create_new_stockissue')"><i class="fa fa-plus"></i> Add New </button>
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
            if(type=="create_new_stockissue" || type=="edit_stockissue"){
                this.$router.push("/"+type);
            }
            if(type=="stockissuelist"){
                this.$router.push("/stockissuelist");
            }
		},
    },
    mounted() {
    },
    
}
</script>























<!--<template>
    <div>
       <ul class="bg-primary mb-2">
            <li class="pl-2 text-white"><b><h5>Stock Receipt</h5></b></li>
        </ul>
        <div class="card card-primary card-outline">
            <div class="card-header">
            
                <span class="fa-pull-right">
                    <button type="button" class="btn btn-primary text-white btn-sm" @click="showadprocess('stockreceiptlist')"><i class="fa fa-list"></i> List</button>
                    <button type="button" class="btn btn-dark text-white btn-sm" @click="showadprocess('create_new_stockreceipt')"><i class="fa fa-plus"></i> New</button>
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
            if(type=="create_new_stockreceipt" || type=="edit_stockrecipt"){
                this.$router.push("/"+type);
            }
            if(type=="stockreceiptlist"){
                this.$router.push("/stockreceiptlist");
            }
		},
    },
    mounted() {
    },
    
}
</script> -->


