<template>
    <div>
        <div class="card card-primary card-outline">
            <div class="card-header pb-1 mb-0 pt-0 mt-0"> 
                <span class="card-title">
                    <b>Local Procurement</b>
                </span> 
                <span class="fa-pull-right pr-2">
                    <button type="button" class="btn btn-primary text-white btn-sm" @click="loadpage('LocalProcureList')"><i class="fa fa-list"></i> List</button>
                    <button v-if="showadd" type="button" class="btn btn-dark text-white btn-sm" @click="loadpage('LocalProcureAdd')"><i class="fa fa-plus"></i> Add New </button>
                </span>
            </div>
            <div class="card-body">  
                <router-view></router-view> 
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{ 
             showadd:false,
        } 
    },
    methods:{
        loadpage:function(type){
            if(type=="LocalProcureAdd" || type=="LocalProcureList"){
                this.$router.push({name:type,params: {data:null}});
            }
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
            if(roleName.toLowerCase().includes('mess')){
                this.showadd=true;
            }

        })
        .catch(errors =>{
            console.log(errors)
        });
    },
    
}
</script>























