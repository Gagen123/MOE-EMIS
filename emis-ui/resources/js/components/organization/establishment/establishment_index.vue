<template>
<div>
    <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
        <li class="form-inline "><h5 class="pt-1">Creation of A New Establishment</h5></li>
    </ol>
    <div class="container-fluid">
        <ul class="nav nav-pills mb-3" id="mainmenu" role="tablist">
            <li class="nav-item pr-1">
                <router-link to="/public_school_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                   <span class=""></span>
                   Public School
                </router-link>
            </li>
            <li class="nav-item pr-1">
                <router-link to="/private_school_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                   <span class=""></span>
                    Private School
                </router-link>
            </li>
            <!-- <li class="nav-item pr-1">
                <router-link to="/public_eccd_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                   <span class=""></span>
                    Public ECCD
                </router-link>
            </li>
            <li class="nav-item pr-1">
                <router-link to="/private_eccd_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                   <span class=""></span>
                    Private ECCD
                </router-link>
            </li> -->
            <li class="nav-item pr-1">
                <router-link to="/eccd_approval_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                   <span class=""></span>
                    ECCD
                </router-link>
            </li>
            <li class="nav-item pr-1">
                <router-link to="/ecr_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                   <span class=""></span>
                    Public ECR
                </router-link>
            </li>
            <li class="nav-item pr-1">
                <router-link to ="/register" id="register" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    <span class=""></span>
                    Register
                </router-link>
            </li>
            <li class="nav-item pr-1">
                <router-link to="/headquaters_index" id="head_quater_office" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    <span class=""></span>
                    New HQ/Dzongkhag Office
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
        // this.getmenus(routeparam);
    },
}
</script>
