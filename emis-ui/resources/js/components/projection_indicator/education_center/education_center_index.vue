<template>
<div>
    <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
        <li class="form-inline "><h5 class="pt-1">Educational Schools and Institues</h5></li>
    </ol>
    <div class="container-fluid">
        <ul class="nav nav-pills mb-3" id="mainmenu" role="tablist">
            <li class="nav-item pr-1">
                <router-link to="/educationcenter_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                   <span class=""></span>
                   No. of Education Center 
                </router-link>
            </li>
            <li class="nav-item pr-1">
                <router-link to="/school_center_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                   <span class=""></span>
                    Enrollment
                </router-link>
            </li>
            <!-- <li class="nav-item pr-1">
                <router-link to="/tertiary_center_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                   <span class=""></span>
                    Growth
                </router-link>
            </li> -->
            <li class="nav-item pr-1">
                <router-link to="/class_Projection_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                   <span class=""></span>
                    Class Size 
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
