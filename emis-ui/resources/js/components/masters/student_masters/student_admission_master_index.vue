<template>
    <div>
        <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="form-inline "><h6 class="pt-1">Student Admission Masters</h6></li>
        </ol>
        <div class="container-fluid">
            <ul class="nav nav-pills mb-2" role="tablist">
                <li class="nav-item active pr-1"  v-for="(item, index) in menubar" :key="index">
                    <router-link :to="{name: item.route, query: {data: item.actions } }" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0"  onclick="afterclick()">
                       {{ item.screen_name}}
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link to="/student_type" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                       Student Type
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link to="/scholar" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                       Scholarship
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link to="/spbenefit" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                       Special Benefits
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link to="/dropout_type" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                       Drop Out Type
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link to="/streamclass" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Stream Subject & Bench Marks
                    </router-link>
                </li>
                <!-- Cross check with Chimi Thinley -->
                <!-- <li class="nav-item active pr-1">
                    <router-link to="/admission_date_school" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Admission Date For Schools
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
        },
        populate_pate(data,action){
            this.$router.push({name:data,query: {data:action}});
        },
    },
    mounted() {
        let routeparam=this.$route.query.data;
        this.sub_mod_id=routeparam;
        this.getmenus(routeparam);
    },

}
</script>

