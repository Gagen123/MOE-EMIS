<template>
    <div>
        <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="form-inline "><h6 class="pt-1">SEN Module</h6></li>
        </ol>
        <div class="card card-primary card-outline">
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
            if(type=="add_student_awards" || type=="edit_student_awards"){
                this.$router.push("/"+type);
            }
            if(type=="student_awards_list"){
                this.$router.push("/student_awards_list");
            }
		},
    },
    mounted() {
    },
    
}
</script>


