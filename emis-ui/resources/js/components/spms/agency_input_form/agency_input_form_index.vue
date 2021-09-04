<template>
    <div>
        <section class="content ml-n4 mr-n3">
            <div class="container-fluid">
                <div class="row"> 
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-header bg-white pt-2 pb-1 text-right">
                                <label class="fa-pull-left">Agency Input</label>
                                <span class="fa-pull-right pt-1">
                                    <button type="button" class="btn btn-flat bg-secondary btn-sm"  @click="loadpage('list_agency_input_form')"><i class="fa fa-list"></i> List</button>
                                    <button v-if="(acess_level!='Org' && agency_code != emd_id)" type="button" class="btn btn-flat bg-blue btn-sm" @click="loadpage('create_agency_input_form')"><i class="fa fa-plus"></i> Add New</button>
                                </span>
                            </div>
                            <div class="card-body pb-1 mb-0 pt-1 mt-0">  
                                <router-view></router-view> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
export default {
    data(){
        return {
            currentRoute:this.$route.name,
            acess_level:'',
            agency_code:'',
            emd_id:process.env.MIX_EMD_ID
        }
    },
    methods:{
         loadpage(type){
            this.$router.push({name:type});
        },
    },
    mounted() {
        axios.get('common/getSessionDetail')
        .then(response => {
            let data = response.data.data;
            let roleName="";
            for(let i=0;i<data['roles'].length;i++){
                if(i==data['roles'].length-1){
                    roleName+=data['roles'][i].roleName;
                }
                else{
                    roleName+=data['roles'][i].roleName+', ';
                }
            }
            this.roles=roleName;
            this.acess_level = data['acess_level']
            this.agency_code =  data['Agency_Code'];
        })
        .catch(errors =>{
            console.log(errors)
        });
        let routeparam=this.$route.query.data;
        this.sub_mod_id=routeparam;
    },
}
</script>

