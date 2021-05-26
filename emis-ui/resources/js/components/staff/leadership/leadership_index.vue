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

                <li class="nav-item active pr-1">
                    <router-link id="service" to="/nomination_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Nomination 
                    </router-link>
                </li>

                <!-- This menu should be static as its checked through the user id -->
                <li class="nav-item active pr-1" style="display:none" id="feedback_link">
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
		getmenus(sub_mod_id){
            let uri = 'get_screens_on_submodules/submodule/'+sub_mod_id
            axios.get(uri)
            .then(response => {
                let data = response;
                this.menubar =  data.data;  
            })
            .catch(function (error) { 
                console.log(error);
            });
        },

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
    mounted(){
        let routeparam=this.$route.query.data;
        this.sub_mod_id=routeparam;
        this.getmenus(routeparam);
        this.checkfeedbackMenu();
    },
}
</script>

