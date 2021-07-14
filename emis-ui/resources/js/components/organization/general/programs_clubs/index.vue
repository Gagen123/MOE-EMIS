<template>
    <div>
        <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="form-inline "><h5 class="pt-1">Organizational Programs and Clubs Information</h5></li>
        </ol>
        <div class="container-fluid">
            <ul class="nav nav-pills mb-2" role="tablist">
                <li class="nav-item pr-1" @click="activatelink('programs')">
                    <router-link to ="/student_programs_list" id="programs" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-edit"></span>
                        Programs & Clubs
                    </router-link>
                </li>
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
        // activatelink(btnid){
        //     $('#mainmenu >li >router-link >a').removeClass('btn-primary text-white');
        //     $('#'+btnid).addClass('btn-primary text-white');
        // }
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
    },
    mounted(){
        let routeparam=this.$route.query.data;
        this.sub_mod_id=routeparam;
        this.getmenus(routeparam);
    },
}
</script>
