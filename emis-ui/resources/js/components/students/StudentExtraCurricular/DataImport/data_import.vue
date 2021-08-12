<template>
    <div class="">
        <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="form-inline "><h5>Data Imports</h5></li>
        </ol>
        <div class="container-fluid">
            <ul class="nav nav-pills mb-2" id="mainmenu" role="tablist">
                <li class="nav-item pr-1" @click="activatelink('student_trainings')">
                    <router-link to="/institute_index" id="rub_data_import" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-check"></span>
                        Institutes
                    </router-link>
                </li>
                 <li class="nav-item pr-1" @click="activatelink('student_trainings')">
                    <router-link to="/staff_index" id="Molhr_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-check"></span>
                         Staffs
                    </router-link>
                </li>
                 <li class="nav-item pr-1" @click="activatelink('student_trainings')">
                    <router-link to="/student_index" id="Molhr_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-check"></span>
                         Students
                    </router-link>
                </li>
                <li class="nav-item pr-1" @click="activatelink('student_trainings')">
                    <router-link to="/Dahe_index" id="Molhr_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-check"></span>
                         DAHE
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