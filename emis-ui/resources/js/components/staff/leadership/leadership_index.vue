<template>
    <div>
        <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="form-inline "><h6 class="pt-1">270 Feedback (Leadership Selection)</h6></li>
        </ol>
        <div class="container-fluid">
            <ul class="nav nav-pills mb-2" role="tablist">
                <li class="nav-item active pr-1"  v-for="(item, index) in menubar" :key="index">
                    <router-link :to="{name: item.route, query: {data: item.actions } }" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0"  onclick="afterclick()">
                       <span :class="item.screen_icon"></span>
                       {{ item.screen_name}}
                    </router-link>
                </li>
            </ul>
            <ul class="nav nav-pills mb-2 developemntEnv" role="tablist">
                <li class="nav-item active pr-1" id="feedback_link">
                    <router-link id="service" to="/leadership_type_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Leadership Selection Type
                    </router-link>
                </li>
                <li class="nav-item active pr-1" id="feedback_link">
                    <router-link id="service" to="/feedback_category" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Feedback Category
                    </router-link>
                </li>
                <li class="nav-item active pr-1" id="feedback_link">
                    <router-link id="service" to="/question_answer" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Feedback Questions & Answers
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link id="service" to="/announcement" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Vacancy Announcement
                    </router-link>
                </li>

                <li class="nav-item active pr-1">
                    <router-link id="service" to="/apply_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Apply for Post
                    </router-link>
                </li>

                <!-- This menu should be static as its checked through the user id -->
                <li class="nav-item active pr-1" id="feedback_link">
                    <router-link id="service" to="/leadership_feedback" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Feedback
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
        }
    },
    methods: {
        checkfeedbackMenu(){
            let uri = '/staff/staffLeadershipSerivcesController/checkforfeedbackLink'
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                if(data!=undefined && data!=""){
                    $('#feedback_link').show();
                }
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        populate_pate(data,action){
            this.$router.push({name:data,query: {data:action}});
        },
    },
    async mounted(){
        this.checkfeedbackMenu();
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

