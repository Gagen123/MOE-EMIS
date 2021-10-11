<template>
    <div>
        <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="form-inline "><h6 class="pt-1">Staff</h6></li>
        </ol>
        <div class="container-fluid">
            <ul class="nav nav-pills mb-2" role="tablist" id="production">
                <li class="nav-item active pr-1"  v-for="(item, index) in menubar" :key="index">
                    <router-link :to="{name: item.route, query: {data: item.actions } }" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0"  onclick="afterclick()">
                       <span :class="item.screen_icon"></span>
                       {{ item.screen_name}}
                    </router-link>
                </li>
            </ul>
            <ul class="nav nav-pills mb-2 developemntEnv" role="tablist">
                <li class="nav-item pr-1" onclick="afterclick('regularstaff')">
                    <router-link to="/civil_staff" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-edit"></span>
                        Civil Staff
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link to="/private_staff" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-edit"></span>
                        Private Staff
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link to="/substitute_staff" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-edit"></span>
                        Substitute Teacher
                    </router-link>
                </li>
                <li class="nav-item pr-1">
                    <router-link to="/seperation_details" id="secondment" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-clock"></span>
                        Seperation
                    </router-link>
                </li>
                <!-- <li class="nav-item pr-1">
                    <router-link to="/reporting" id="transfer_report" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-clock"></span>
                        Reporting
                    </router-link>
                </li> -->

                <!-- <li class="nav-item pr-1">
                    <router-link to ="/transfer_window_index" id="trainingprogram" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-clock"></span>
                        Transfer Time Schedule
                    </router-link>
                </li>
                <li class="nav-item pr-1">
                    <router-link to="/transfer_index" id="nomination" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-check"></span>
                        Transfer
                    </router-link>
                </li> -->
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

