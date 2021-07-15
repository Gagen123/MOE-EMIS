<template>
    <div class="">
        <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="form-inline "><h5>Student Scouts</h5></li>
        </ol>
        <div class="container-fluid">
            <ul class="nav nav-pills mb-2" id="mainmenu" role="tablist">
                <li class="nav-item pr-1" @click="activatelink('student_scouts_members')">
                    <router-link to="/student_scouts_members" id="student_scouts_members" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-check"></span>
                        Scouts Members
                    </router-link>
                </li>
                <li class="nav-item pr-1" @click="activatelink('scouts_badge')">
                    <router-link to="/scouts_badge" id="scouts_badge" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-check"></span>
                        Scout Proficiency Badge
                    </router-link>
                </li>
                <!-- <li class="nav-item pr-1" @click="activatelink('scouts_leader')">
                    <router-link to="/scouts_leader" id="scouts_leader" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-check"></span>
                        Scouts Leaders
                    </router-link>
                </li> -->
            </ul>
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
export default {
    methods: {
        activatelink(btnid){
            $('#mainmenu >li >router-link >a').removeClass('btn-primary text-white');
            $('#'+btnid).addClass('btn-primary text-white');
        }
    }
}
</script>