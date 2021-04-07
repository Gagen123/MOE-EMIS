<template>
    <div class="">
        <ol class="mb-1 ml-xl-n3 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="pl-2 form-inline "><h5>S</h5><h6 class="pt-1">TUDENT</h6>&nbsp;<h5>E</h5><h6 class="pt-1">XTRA-</h6><h5>C</h5><h6 class="pt-1">URRICULAR</h6></li>
        </ol>
        <ul class="nav nav-pills mb-2" id="mainmenu" role="tablist">
            <li class="nav-item active pr-1" @click="activatelink('responsibilities')">
                <router-link to="/student_responsibilities" id="responsibilities" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    <span class="fa fa-user-clock"></span>
                    Roles & Responsibilities
                </router-link>
            </li>
            <li class="nav-item pr-1"  @click="activatelink('awards')">
                <router-link to="/student_awards" id="awards" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                   <span class="fa fa-user-clock"></span>
                   Awards
                </router-link>
            </li> 
            <li class="nav-item pr-1" @click="activatelink('programs')">
                <router-link to ="/student_programs" id="programs" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    <span class="fa fa-user-edit"></span>
                    Programs & Clubs
                </router-link>
            </li>
            <li class="nav-item pr-1" @click="activatelink('projects')">
                <router-link to="/student_projects" id="projects" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    <span class="fa fa-user-check"></span>
                    Projects
                </router-link>
            </li>
            <li class="nav-item pr-1" @click="activatelink('trainings')">
                <router-link to="/student_trainings" id="student_trainings" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    <span class="fa fa-user-check"></span>
                    Trainings & Workshops
                </router-link>
            </li>
            <li class="nav-item pr-1" @click="activatelink('scouts')">
                <router-link to="/student_scouts" id="student_scouts" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    <span class="fa fa-user-check"></span>
                    Scouts
                </router-link>
            </li>
        </ul>
        <router-view></router-view>
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