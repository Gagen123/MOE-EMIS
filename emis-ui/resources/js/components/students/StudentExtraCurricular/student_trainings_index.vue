<template>
    <div class="">
        <ol class="mb-1 ml-xl-n3 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="pl-2 form-inline "><h5>S</h5><h6 class="pt-1">TUDENT</h6>&nbsp;<h5>T</h5><h6 class="pt-1">RAININGS-</h6><h5>& W</h5><h6 class="pt-1">ORKSHOPS</h6></li>
        </ol>
        <ul class="nav nav-pills mb-2" id="mainmenu" role="tablist">
            <li class="nav-item pr-1" @click="activatelink('trainings')">
                <router-link to="/student_trainings" id="student_trainings" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    <span class="fa fa-user-check"></span>
                    Trainings & Workshops
                </router-link>
            </li>
            <li class="nav-item pr-1" @click="activatelink('programs')">
                <router-link to ="/student_trainings_participants" id="student_trainings_participants" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    <span class="fa fa-user-edit"></span>
                    Training/Workshops Participants
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