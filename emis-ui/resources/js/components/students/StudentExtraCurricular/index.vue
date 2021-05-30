<template>
    <div class="">
        <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="form-inline "><h5>Student Extra-Curricular</h5></li>
        </ol>
        <div class="container-fluid">
            <ul class="nav nav-pills mb-2" id="mainmenu" role="tablist">
                <li class="nav-item pr-1" @click="activatelink('programs')">
                    <router-link to ="/student_programs" id="programs" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-edit"></span>
                        Programs & Clubs
                    </router-link>
                </li>
                <li class="nav-item pr-1" @click="activatelink('programs')">
                    <router-link to ="/student_programs" id="programs" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-edit"></span>
                        Programs & Clubs Members
                    </router-link>
                </li>
                <li class="nav-item pr-1" @click="activatelink('projects')">
                    <router-link to="/student_projects" id="projects" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-check"></span>
                        Projects
                    </router-link>
                </li>
                <li class="nav-item pr-1" @click="activatelink('programs')">
                    <router-link to ="/student_programs" id="programs" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-edit"></span>
                        Project Members
                    </router-link>
                </li>
                <li class="nav-item pr-1" @click="activatelink('trainings')">
                    <router-link to="/student_trainings" id="student_trainings" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-check"></span>
                        Trainings & Workshops
                    </router-link>
                </li>
                <li class="nav-item pr-1" @click="activatelink('programs')">
                    <router-link to ="/student_programs" id="programs" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-edit"></span>
                        Training/Workshops Participants
                    </router-link>
                </li>
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