<template>
    <div>
        <div class="callout callout-danger" style="display:none" id="screenPermission">
            <h5 class="bg-gradient-danger">Sorry!</h5>
            <div id="existmessage"></div>
        </div>
        <section class="content ml-n4 mr-n3">
            <div class="container-fluid" id="mainform">
                <div class="row"> 
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-header bg-white pt-2 pb-1 text-right">
                                <button type="button" class="btn btn-flat bg-secondary btn-sm"  @click="loadpage('SportList')"><i class="fa fa-list"></i> List</button>
                                <button type="button" class="btn btn-flat bg-blue btn-sm" @click="loadpage('SportAdd')"><i class="fa fa-plus"></i> Add New</button>
                            </div>
                            <router-view></router-view>
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
        return{

        }
    },

    methods:{
        loadpage:function(type){
            if(type=="SportAdd" || type=="SportList"){
                this.$router.push({name:type,params: {data:null}});
            }
        },

        getScreenAccess(){
            axios.get('common/getSessionDetail')
            .then(response => {
                let data = response.data.data.acess_level;
                if(data != "Org"){
                    $('#mainform').hide();
                    $('#screenPermission').show();
                    $('#existmessage').html('You have no access to this page.');
                }
                
            })    
            .catch(errors => { 
                console.log(errors)
            });
        }
    },

    mounted(){
        this.getScreenAccess();
    }
}
</script>