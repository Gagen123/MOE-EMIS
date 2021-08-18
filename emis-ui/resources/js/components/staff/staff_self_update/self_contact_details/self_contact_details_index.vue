<template>
    <div>
        <div class="card card-primary card-outline">
            <div class="card-header pb-1 mb-0 pt-0 mt-0 bg-white">
                <span class="card-title">
                    <b>Updated Contact Detail</b>
                </span>
                <span class="fa-pull-right pt-1">
                    <button type="button" class="btn btn-primary text-white btn-sm" @click="showadprocess('list_contact_details')" id="listnewbtn"><i class="fa fa-list"></i> List</button>
                    <button type="button" class="btn btn-dark text-white btn-sm" @click="showadprocess('create_contact_details')" id="addnewbtn"><i class="fa fa-plus"></i> Update Contact Details</button>
                </span>
            </div>
            <div class="card-body pb-1 mb-0 pt-1 mt-0" id="errormsg">
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
    },
    mounted(){
        this.screen_id=this.$route.query.data;
    },
}
</script>


