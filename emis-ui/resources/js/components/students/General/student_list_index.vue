<template>
    <div>
        <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
            <!-- <li class="form-inline "><h5 class="pt-1">Equipment and Furniture</h5></li> -->
        </ol>
        <div class="container-fluid">
            <ul class="nav nav-pills mb-2" role="tablist">
                <li class="nav-item active pr-1"  v-for="(item, index) in menubar" :key="index">
                    <router-link :to="{name: item.route, query: {data: item.actions } }" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0"  onclick="afterclick()">
                        <span :class="item.screen_icon"></span>
                        {{ item.screen_name}}
                    </router-link>
                </li>
                <!-- <li class="nav-item active pr-1" @click="activatelink('counselling_index')">
                    <router-link id="student_list_index" to="/student_list_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class=""></span>
                        Regular Student 
                    </router-link>
                </li> -->
               <!-- <li class="nav-item active pr-1" @click="activatelink('counselling_index')">
                    <router-link id="ce_student_list" to="/ce_student_list" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class=""></span>
                        Continuing Education (CE) Student 
                    </router-link>
                </li> -->
            </ul>
        <router-view></router-view>
        </div>

    </div>
</template>

<script>
export default {
    data(){
        return{
              menubar:[],
        }
    },

    methods:{
        getmenus(sub_mod_id){
            let uri = 'get_screens_on_submodules/submodule/'+sub_mod_id
            axios.get(uri)
            .then(response => {
                let data = response;
                this.menubar =  data.data;
            })
            .catch(function (error) {
                console.log("Error:"+error)
            });
        },
        activatelink(btnid){
            $('#mainmenu >li >router-link >a').removeClass('btn-primary text-white');
            $('#'+btnid).addClass('btn-primary text-white');
        }
    },
    mounted(){
        let routeparam=this.$route.query.data;
        this.sub_mod_id=routeparam;
        this.getmenus(routeparam);
    },
}
</script>
