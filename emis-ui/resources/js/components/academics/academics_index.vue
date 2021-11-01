<template>
    <div> 
        <ol class="mb-1 ml-xl-n3 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="form-inline "><h6 class="pt-1">ACADEMICS</h6></li>
        </ol>
        <div class="ml-2 container-fluid">
            <ul class="nav nav-pills mb-2" role="tablist" id="production">
                <li class="nav-item active pr-1"  v-for="(item, index) in menubar" :key="index" @click="activatelink(item.route)">
                    <router-link :to="{name: item.route, query: {data: item.actions } }" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0"  onclick="afterclick()" :id="item.route">
                       <span :class="item.screen_icon"></span>
                       {{ item.screen_name}}
                    </router-link>
                </li>
            </ul>
            <ul class="nav nav-pills mb-2 developemntEnv" id="mainmenu" role="tablist">
                <li class="nav-item active pr-1">
                    <router-link id="class_teacher" to="/class-teacher" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0" >
                       Class Teacher
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('sub_teacher')">
                    <router-link id="sub_teacher" to="/subject-teacher" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                       Subject Teacher
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('sub_assmt_type')">
                    <router-link id="sub_assmt_type" to="/student-elective-subject" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Optional Subject
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('student_attendance')">
                    <router-link id="student_attendance" to="/student-attendance" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Student Attendance 
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('remedial_class')">
                    <router-link id="remedial_class" to="/remedial-class" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                      Remedial Class
                    </router-link>
                </li>
                 <li class="nav-item active pr-1" @click="activatelink('student_attendance_special_case')">
                    <router-link id="student_attendance_special_case" to="/instructional-days-special_case" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Instructional Days for Special Case
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('term-assessment')">
                    <router-link id="term-assessment" to="/term-result" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Term Result 
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('sub_assmt_area')">
                    <router-link id="sub_assmt_area" to="/consolidated-result" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                     Consolidated Result
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('publish_result')">
                    <router-link id="publish_result" to="/publish-result" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                     Approve & Publish Result
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('student_progress_report')">
                    <router-link id="student_progress_report" to="/student-progress-report" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                      Student Progress Report
                    </router-link>
                </li>
            </ul>
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
export default {
       components: {
    },
    data() {
        return {
            menubar:[],
            menu_id:'',
        }
    },
    methods: {
        activatelink(btnid){
            $('#mainmenu >li >router-link >a').removeClass('btn-primary text-white');
            $('#'+btnid).addClass('btn-primary text-white');
        },
        populate_pate(data,action){
            this.$router.push({name:data,query: {data:action}});
        },
    },
    async mounted(){
        let uri = 'get_screens_on_submodules/submodule/'+this.$route.query.data;
        axios.get(uri)
        .then(response => {
            let data = response;
            this.menubar =  data.data;
        })
        .catch(function (error) {
            console.log(error);
        });
        let env=await this.getEnvValues('VUE_APP_ENV_TYPE');
        if(env=="Production"){
            $('.developemntEnv').hide();
        }

    },
    
}
</script>

