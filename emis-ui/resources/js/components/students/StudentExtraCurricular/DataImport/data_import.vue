<template>
    <div class="">
        <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="form-inline "><h5>Student Trainings/Workshops/Seminars</h5></li>
        </ol>
        <div class="container-fluid">
            <ul class="nav nav-pills mb-2" id="mainmenu" role="tablist">
                <li class="nav-item pr-1" @click="activatelink('student_trainings')">
                    <router-link to="/rub_data_import" id="rub_data_import" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-check"></span>
                        Data Import For RUB
                    </router-link>
                </li>
                <li class="nav-item pr-1" @click="activatelink('student_trainings')">
                    <router-link to="/rub_data_import" id="rub_data_import" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-check"></span>
                        Data Import For MOLHR
                    </router-link>
                </li>
                 <li class="nav-item pr-1" @click="activatelink('student_trainings')">
                    <router-link to="/rub_data_import" id="rub_data_import" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-check"></span>
                        Data Import For NFCED DAHE
                    </router-link>
                </li>
                <li class="nav-item pr-1" @click="activatelink('student_trainings')">
                    <router-link to="/rub_data_import" id="rub_data_import" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-check"></span>
                        Data Import For NSB
                    </router-link>
                </li>
                <li class="nav-item pr-1" @click="activatelink('student_trainings')">
                    <router-link to="/rub_data_import" id="rub_data_import" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-check"></span>
                        Data Import For DCRC
                    </router-link>
                </li>
                <li class="nav-item pr-1" @click="activatelink('student_trainings')">
                    <router-link to="/rub_data_import" id="rub_data_import" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-check"></span>
                        Data Import For DCRC
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