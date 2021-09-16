<template>
    <div>
         <ol class="mb-1 ml-xl-n3 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="pl-2 form-inline "><h5>O</h5><h6 class="pt-1">RGANIZATION APPROVAL MASTER</h6></li>
        </ol>
     <div class="container-fluid">
            <ul class="nav nav-pills mb-2" role="tablist">
                <li class="nav-item active pr-1"  v-for="(item, index) in menubar" :key="index">
                    <router-link :to="{name: item.route, query: {data: item.actions } }" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0"  onclick="afterclick()">
                       {{ item.screen_name}}
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/org_service_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Services
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/department_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Department
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/proposed_by_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Proposed By
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/document_type_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Document Type
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('notificationconfig')">
                    <router-link to="/notification_config_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Notification Config
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
        activatelink(btnid){
            $('#mainmenu >li >router-link >a').removeClass('btn-primary text-white');
            $('#'+btnid).addClass('btn-primary text-white');
        }
    },
    mounted() {
        let routeparam=this.$route.query.data;
        this.sub_mod_id=routeparam;
        this.getmenus(routeparam);
    },
}
</script>

