<template>
    <div>
        <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="form-inline "><h6 class="pt-1">Organization Programs & Clubs</h6></li>
        </ol>
        <div class="card card-primary card-outline">
            <div class="card-header pb-1 mb-0 pt-0 mt-0"> 
                <span class="fa-pull-right pr-2">
                    <button type="button" class="btn btn-primary text-white btn-sm" @click="showadprocess('list_org_programs')"><i class="fa fa-list"></i> List</button>
                    <button type="button" class="btn btn-dark text-white btn-sm" @click="showadprocess('add_org_programs')"><i class="fa fa-plus"></i> Add Program/Club</button>
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
            if(type=="add_org_programs" || type=="edit_org_programs"){
                this.$router.push("/"+type);
            }
            if(type=="register_student_programs"){
                this.$router.push("/register_student_programs");
            }
            if(type=="student_programs_list"){
                this.$router.push("/student_programs_list");
            }
		},
    },
    mounted() {
    },
    
}
</script>


