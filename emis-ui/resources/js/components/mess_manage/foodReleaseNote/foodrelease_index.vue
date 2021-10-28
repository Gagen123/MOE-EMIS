<template>
    <div>
        <div class="card card-primary card-outline"> 
            <div class="card-header pb-1 mb-0 pt-0 mt-0"> 
                <span class="card-title">
                    <b>Food Release</b>
                </span>
                <span class="fa-pull-right pr-2">
                    <button type="button" class="btn btn-primary text-white btn-sm" @click="loadpage('FoodReleaseList')"><i class="fa fa-list"></i> List</button>
                    <button  v-if="showadd"  type="button" class="btn btn-dark text-white btn-sm" @click="loadpage('FoodReleaseAdd')"><i class="fa fa-plus"></i> Add New </button>
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
             access_level:'',
             showadd:false,
        } 
    },
    methods:{
        loadpage:function(type){
            if(type=="FoodReleaseAdd" || type=="FoodReleaseList"){
                this.$router.push({name:type,params: {data:null}});
            }
        },
    
    },
    
    mounted() {
        axios.get('common/getSessionDetail')
        .then(response =>{
            let data = response.data.data;
          //  this.form.org_id=data['Agency_Code'];
            this.access_level = data['acess_level'];
            if(data['acess_level']=="Ministry"){
                this.showadd=true;
            }
            
            
        })
        .catch(errors =>{
            console.log(errors)
        });
    },
    
}
</script>























