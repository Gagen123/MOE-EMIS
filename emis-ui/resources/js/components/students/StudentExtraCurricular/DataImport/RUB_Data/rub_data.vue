<template>
    <div>
        <div class="card card-primary card-outline">
            <div class="card-header pb-1 mb-0 pt-0 mt-0"> 
                <span class="fa-pull-right pr-2">
                    <button type="button" class="btn btn-primary text-white btn-sm" @click="showadprocess('list_instittute')"><i class="fa fa-list"></i> List Institute</button>
                    <button type="button" class="btn btn-dark text-white btn-sm" @click="showadprocess('add_institute')"><i class="fa fa-plus"></i> Import Institute </button>
                    <button type="button" class="btn btn-primary text-white btn-sm" @click="showadprocess('list_staff')"><i class="fa fa-list"></i> List Staff </button>
                    <button type="button" class="btn btn-dark text-white btn-sm" @click="showadprocess('add_staff')"><i class="fa fa-plus"></i> Import Staff </button>
                    <button type="button" class="btn btn-primary text-white btn-sm" @click="showadprocess('list_student')"><i class="fa fa-list"></i> List Student</button>
                    <button type="button" class="btn btn-dark text-white btn-sm" @click="showadprocess('add_student')"><i class="fa fa-plus"></i> Import Student</button>
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
            if(type=="add_institute" || type=="edit_rub_data"){
                this.$router.push("/"+type);
            }
            if(type=="add_staff" || type=="edit_rub_data"){
                this.$router.push("/"+type);
            }
            if(type=="add_student" || type=="edit_rub_data"){
                this.$router.push("/"+type);
            }
            if(type=="list_instittute"){
                this.$router.push("/list_instittute");
            }
            if(type=="list_staff"){
                this.$router.push("/list_staff");
            }
            if(type=="list_student"){
                this.$router.push("/list_student");
            }
            
		},
    },
    mounted() {
    },
    
}
</script>


