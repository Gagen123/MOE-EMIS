<template>
    <div>
        <ol class="mb-1 ml-xl-n3 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="pl-2 form-inline "><h6 class="pt-1">Hr Development (Training) Masters</h6></li>
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
                    <router-link :to="{name: 'training_type_master'}" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                       Training Type
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link :to="{name: 'related_programme'}" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                       Related Programme
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link :to="{name: 'programme_level'}" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                       Programme Level(PDP)
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link :to="{name: 'programme_type'}" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                       Programme Type(PDP)
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link :to="{name: 'course_type'}" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                       Course Type(PDP)
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link :to="{name: 'financial_source'}" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                       Financial Source(PDP)
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link :to="{name: 'category'}" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                       Category (QU)
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link :to="{name: 'donor_agency'}" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                       Donor Agency (QU)
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link :to="{name: 'project_donor_agency'}" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                       Project of Donor Agency (QU)
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link :to="{name: 'degree'}" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                       Degree (QU)
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link :to="{name: 'nature_of_participation'}" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                       Nature of participation
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link :to="{name: 'target_group'}" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                       Target Group
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
            let uri = 'get_screens_on_submodules/module/'+sub_mod_id
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
        populate_pate(data,action){
            this.$router.push({name:data,query: {data:action}});
        },
    },
    mounted(){
        let routeparam=this.$route.query.data;
        this.sub_mod_id=routeparam;
        this.getmenus(routeparam);
    },
}
</script>

