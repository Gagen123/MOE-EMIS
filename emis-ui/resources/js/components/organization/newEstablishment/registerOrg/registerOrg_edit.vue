<template>
    <div>
        <div class="card" id="mainform">
            <div class="card-body" >
                <div id="org_details">
                    <div class="callout callout-success">
                        <h5><u>Organization Details</u></h5>
                        <div class="form-group row"> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Proposed Name:</label>
                                <span class="text-blue text-bold">{{orgDetails.name}}</span>
                            </div>  
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Level:</label>
                                <span class="text-blue text-bold">{{levelArray[orgDetails.levelId]}}</span>
                            </div>  
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Category:</label>
                                <span class="text-blue text-bold"> {{ orgDetails.category == 'public_school' ? "Public School" : orgDetails.category == 'public_eccd' ? "Public ECCD" : orgDetails.category == 'private_school' ? "Private School" : orgDetails.category == 'private_eccd' ? "Private ECCD" :  "ECR" }}</span>
                            </div> 
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Dzongkhag:</label>
                                <span class="text-blue text-bold">{{dzoArray[orgDetails.dzongkhagId]}}</span>
                            </div>  
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Gewog:</label>
                                <span class="text-blue text-bold">{{selected_gewog}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Chiwog:</label>
                                <span class="text-blue text-bold">{{selected_village}}</span>
                            </div>                 
                        </div>
                        <div v-if="orgDetails.category=='private_school'">
                            <div class="row pb-2">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <h5><u>Proprietor Details</u></h5>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">CID:</label>
                                    <span class="text-blue text-bold">{{orgDetails.proprioter.cid}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Full Name:</label>
                                    <span class="text-blue text-bold">{{orgDetails.proprioter.fullName}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Mobile No:</label>
                                    <span class="text-blue text-bold">{{orgDetails.proprioter.phoneNo}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Email:</label>
                                    <span class="text-blue text-bold">{{orgDetails.proprioter.email}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="callout callout-success" v-if="orgDetails.classes">
                        <h5><u>Class Section Details</u></h5>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                            <span v-for="(item, index) in  orgDetails.classes" :key="index">
                                <br>
                                <input type="checkbox" checked="true"><label class="pr-4"> &nbsp;{{ calssArray[item.classId] }}<span v-if="item.streamId"> - {{ streamArray[item.streamId] }}</span> </label>
                            </span> 
                        </div> 
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            levelArray:{},
            calssArray:{},
            streamArray:{},
            dzoArray:{},
            gewogArray:{},
            selected_gewog:'',
            villageArray:{},
            selected_village:'',
            orgDetails:[],
            
        }
    },
    methods:{
        getClass:function(){
            axios.get('/organization/getClass')
              .then(response => {
                let data = response.data;
                for(let i=0;i<data.length;i++){
                    this.calssArray[data[i].id] = data[i].class; 
                }
            });
        },

        getStream:function(){
            axios.get('/organization/getStream')
              .then(response => {
                let data = response.data;
                for(let i=0;i<data.length;i++){
                    this.streamArray[data[i].id] = data[i].stream; 
                }
            });
        },
        getLevel(uri = '/organization/getLevelInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                for(let i=0;i<data.length;i++){
                    this.levelArray[data[i].id] = data[i].name; 
                }
            });
        },
        loaddzongkhagList(uri = 'masters/loadGlobalMasters/all_dzongkhag'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.dzoArray[data[i].id] = data[i].name; 
                }
            })
            .catch(function (error) {
                console.log('err: '+error);
            });
        },
        getgewog(dzoId,gewogId){
            axios.get('masters/all_active_dropdowns/dzongkhag/'+dzoId)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.gewogArray[data[i].id] = data[i].name; 
                }
                this.selected_gewog=this.gewogArray[gewogId];
            })
            .catch(function (error) {
                console.log('err: '+error);
            });
        },
        getVillage(gewogId,villageId){
            axios.get('masters/all_active_dropdowns/gewog/'+gewogId)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.villageArray[data[i].id] = data[i].name; 
                }
                this.selected_village=this.villageArray[villageId];
            })
            .catch(function (error) {
                console.log('err: '+error);
            });
        }

    },
    mounted() {
        this.getLevel();
        this.getClass();
        this.getStream();
        this.loaddzongkhagList();
        axios.get('loadCommons/loadOrgDetails/fullOrgDetbyid/'+this.$route.query.org_id)
        .then((response) => {  
            let data=response.data.data;
            this.getgewog(data.dzongkhagId,data.gewogId);
            this.getVillage(data.gewogId,data.chiwogId);
            this.orgDetails=data;
        })
        .catch((error) =>{  
            $("#org_details").hide();
            console.log("Error:"+error);
        });
    },
}
</script>