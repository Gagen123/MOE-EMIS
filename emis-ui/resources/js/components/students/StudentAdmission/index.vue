<template>
    <div class="">
        <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="form-inline"><h5>Student Admission</h5></li>
        </ol>
        <div class="container-fluid">
            <ul class="nav nav-pills mb-2" id="mainmenu" role="tablist">
                <li class="nav-item active pr-1"  v-for="(item, index) in menubar" :key="index">
                    <router-link :to="{name: item.route, query: {data: item.actions } }" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0"  onclick="afterclick()">
                       <span :class="item.screen_icon"></span>
                       {{ item.screen_name}}
                    </router-link>
                </li>

                <li class="nav-item active pr-1" @click="activatelink('student_new_admission')">
                    <router-link to="/student_new_admission" id="student_new_admission" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-clock"></span>
                        Admission
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('student_admission_apply')">
                    <router-link to="/student_admission_apply" id="student_admission_apply" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-clock"></span>
                        Apply for Admission
                    </router-link>
                </li>

                <li class="nav-item active pr-1" @click="activatelink('student_admission_request')">
                    <router-link to="/student_admission_request" id="student_admission_request" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-clock"></span>
                        Admission Request
                    </router-link>
                </li>
                <li class="nav-item pr-1" @click="activatelink('student_reporting')">
                    <router-link id="student_reporting" to="/student_reporting" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    <span class="fa fa-user-clock"></span>
                    Reporting
                    </router-link>
                </li> 
                <li class="nav-item pr-1" @click="activatelink('student_leaving')">
                    <router-link to ="/student_leaving" id="student_leaving" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-edit"></span>
                        Transfer/Leave
                    </router-link>
                </li>
                <li class="nav-item pr-1" @click="activatelink('student_updates')">
                    <router-link to="/student_updates" id="student_updates" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-check"></span>
                        Updates
                    </router-link>
                </li>
                <li class="nav-item pr-1" @click="activatelink('student_transfers')"> 
                    <router-link to="/student_transfers" id="student_transfers" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-check"></span>
                        Admit Transferer
                    </router-link>
                </li>
                <li class="nav-item pr-1" @click="activatelink('abroad_student')">
                    <router-link to="/abroad_student" id="abroad_student" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-check"></span>
                        Student Residing Abroad 
                    </router-link>
                </li>
            </ul>
            <router-view></router-view>
        </div>
        
    </div>
</template>
<script>
export default {
    data() {
        return {
            menubar:[],
        }
    },
    methods: {
        getmenus(sub_mod_id){
            let uri = 'get_screens_on_submodules/submodule/'+sub_mod_id
            axios.get(uri)
            .then(response => {
                let data = response;
                this.menubar =  data.data;  
            })
            .catch(function (error) { 
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
    },
    mounted(){
        let routeparam=this.$route.query.data;
        this.sub_mod_id=routeparam;
        this.getmenus(routeparam);
    },
}
</script>