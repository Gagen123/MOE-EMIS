<template>
    <div>
        <div class="card card-primary card-outline">
            <div class="card-header pb-1 mb-0 pt-0 mt-0 bg-white">
                <span class="card-title">
                    <b>Additional Roles & Responsibilities</b>
                </span>
                <span class="fa-pull-right pt-1">
                    <button type="button" class="btn btn-primary text-white btn-sm" @click="showadprocess('list_roles_responsibilities')" id="listnewbtn"><i class="fa fa-list"></i> List</button>
                    <button type="button" class="btn btn-dark text-white btn-sm" @click="showadprocess('create_roles_responsibilities')" id="addnewbtn"><i class="fa fa-plus"></i> Add New</button>
                </span>
            </div>
            <div class="card-body pb-1 mb-0 pt-1 mt-0">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            screen_id:'',
            privileges:'',
            list:'NA',
            deleteopt:'NA',
            editopt:'NA',
        }
    },
    methods: {
       showadprocess(type){
            this.$router.push({name:type,query: {list:this.list,deleteopt:this.deleteopt,editopt:this.editopt}});
		},
        getprivileges(){
            let uri = 'get_privileges/'+this.screen_id
            axios.get(uri)
            .then(response => {
                let data = response;
                this.privileges =  data.data;
                for(let i=0;i<data.data.length;i++){
                    if(data.data[i].action_name.toLowerCase().includes('add') && (data.data[i].Organization==1 || data.data[i].Dzongkhag==1 || data.data[i].National==1)){
                        $('#addnewbtn').show();
                    }
                    if(data.data[i].action_name.toLowerCase().includes('list') && (data.data[i].Organization==1 || data.data[i].Dzongkhag==1 || data.data[i].National==1)){
                        $('#listnewbtn').show();
                        if(data.data[i].Organization==1){
                            this.listAt='Org';
                        }
                        if(data.data[i].Dzongkhag==1){
                            this.listAt='Dzongkhag';
                        }
                        if(data.data[i].National==1){
                            this.listAt='National';
                        }
                    }
                    if(data.data[i].action_name.toLowerCase().includes('delete') && (data.data[i].Organization==1 || data.data[i].Dzongkhag==1 || data.data[i].National==1)){
                        this.deleteopt=1;
                        $('.deletebtn').show();
                    }
                    if(data.data[i].action_name.toLowerCase().includes('edit') && (data.data[i].Organization==1 || data.data[i].Dzongkhag==1 || data.data[i].National==1)){
                        this.editopt=1;
                        $('.editbtn').show();
                    }
                }
            })
            .catch(function (error){
                if(error.toString().includes("500")){
                    $('#errormsg').html('Server down. Please try later');
                }
            });
        }
    },
    mounted() {
        this.screen_id=this.$route.query.data;
        // $('#addnewbtn').hide();
        // $('#listnewbtn').hide();
        this.getprivileges();
    },
}
</script>


