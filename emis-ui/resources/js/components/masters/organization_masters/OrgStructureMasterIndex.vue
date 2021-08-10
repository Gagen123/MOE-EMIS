<template>
    <div>
         <ol class="mb-1 ml-xl-n3 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="pl-2 form-inline "><h5>O</h5><h6 class="pt-1">RGANIZATION STRUCTURE MASTER</h6></li>
        </ol>
     <div class="container-fluid">
            <ul class="nav nav-pills mb-2" role="tablist">
                <li class="nav-item active pr-1"  v-for="(item, index) in menubar" :key="index">
                    <router-link :to="{name: item.route, query: {data: item.actions } }" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0"  onclick="afterclick()">
                       {{ item.screen_name}}
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/structure_category_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Structure Category
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/str_sub_category_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Structure Sub Category
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/structure_facility_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Structure Facility
                    </router-link>
                </li>
               
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/structure_designer_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Structure Designer
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/construction_type_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                       Construction Type
                    </router-link>
                </li>
                 <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/eccdStructure_type_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                      ECCD Structure Type
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/eccdfacility_type_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                      ECCD Facility Type
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

