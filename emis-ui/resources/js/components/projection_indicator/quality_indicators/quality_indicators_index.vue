<template>
<div>
    <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
        <li class="form-inline "><h5 class="pt-1">Quality Indicators</h5></li>
    </ol>
    <div class="container-fluid">
        <ul class="nav nav-pills mb-3" id="mainmenu" role="tablist">
            <li class="nav-item pr-1">
                <router-link to="/qi_str_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                   <span class=""></span>
                   Student Teacher Ratio 
                </router-link>
            </li>
            <li class="nav-item pr-1">
                <router-link to="/qi_teacher_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                   <span class=""></span>
                    Teacher/Facilitator
                </router-link>
            </li>
            <li class="nav-item pr-1">
                <router-link to="/qi_cs_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                   <span class=""></span>
                   Class Size
                </router-link>
            </li>
            <li class="nav-item pr-1">
                <router-link to="/qi_counsellor_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                   <span class=""></span>
                    Counsellors 
                </router-link>
            </li>
            <li class="nav-item pr-1">
                <router-link to="/qi_scouts_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                   <span class=""></span>
                    Scouts 
                </router-link>
            </li>
            <li class="nav-item pr-1">
                <router-link to="/qi_sen_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                   <span class=""></span>
                    Special Educational Needs 
                </router-link>
            </li>
            <li class="nav-item pr-1">
                <router-link to="/qi_exams_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                   <span class=""></span>
                    Examination Results 
                </router-link>
            </li>
        </ul>
        <router-view></router-view>
    </div>
</div>

</template>

<script>
export default {
    data(){
        return{
            menubar:[],
        }
    },

    methods:{
    },
    mounted(){
        let routeparam=this.$route.query.data;
        this.sub_mod_id=routeparam;
    },
}
</script>
