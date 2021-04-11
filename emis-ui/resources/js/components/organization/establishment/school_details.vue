<template>
    <div>
        <div class="card card-primary card-outline">
            <div class="card-body" >
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Category:</label>
                        <span class="text-blue text-bold">{{ data.category == 1 ? "Public" :  "private & Other"}}</span>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>Year of Establishment:</label>
                         <span class="text-blue text-bold">{{data.yearOfEstablishment}}</span>
                    </div>   
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>ZEST Working Agency Code:</label>
                        <span class="text-blue text-bold">{{data.code}}</span>
                    </div>
                </div>
                <div>
                    <div class="callout callout-success">
                        <h4><u>Organization Details</u></h4>
                        <div class="form-group row"> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Proposed Name:</label>
                                <span class="text-blue text-bold">{{data.name}}</span>
                            </div>  
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Level:</label>
                                <span class="text-blue text-bold">{{data.level}}</span>
                            </div>  
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Category:</label>
                                <span class="text-blue text-bold">
                                    {{ data.category  == 1 ? "public" :  "private"}}
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Dzongkhag:</label>
                                <span class="text-blue text-bold">{{data.dzongkhag}}</span>
                            </div>  
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Gewog:</label>
                                <span class="text-blue text-bold">{{data.gewog}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Chiwog:</label>
                                <span class="text-blue text-bold">{{data.village}}</span>
                            </div>                 
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Location Type:</label>
                                <span class="text-blue text-bold">{{data.locationType}}</span>
                            </div>   
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Geopolitically Located:</label>
                                <span class="text-blue text-bold">
                                    {{ data.isGeopoliticallyLocated  == 1 ? "Yes" :  "No"}}
                                </span>
                            </div> 
                        </div>

                        <div class="form-group row" v-if="data.senSchool==1">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                                <label class="mb-0">Parent School:</label>
                                <span class="text-blue text-bold">{{data.parentSchool}}</span>
                            </div>   
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Co-located with Parent School</label>
                                <span class="text-blue text-bold">
                                    {{ data.coLocated  == 1 ? "Yes" :  "No"}}
                                </span>
                            </div> 
                        </div>
                        <div v-if="data.category==0">
                            <div class="row pb-2">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <h4><u>Proprietor Details</u></h4>
                                </div>
                            </div>
                            <div v-for="(pro, index) in data.proprietor" :key="index">
                                <div class="form-group row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="mb-0">CID:</label>
                                        <span class="text-blue text-bold">{{pro.cid}}</span>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="mb-0">Full Name:</label>
                                        <span class="text-blue text-bold">{{pro.fullName}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="mb-0">Phone No:</label>
                                        <span class="text-blue text-bold">{{pro.phoneNo}}</span>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="mb-0">Email:</label>
                                        <span class="text-blue text-bold">{{pro.email}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="callout callout-success">
                        <h4><u>Class Section Details</u></h4>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                            <span v-for="(item, index) in  data.class_section" :key="index">
                                <br>
                                <input type="checkbox" checked="true"><label class="pr-4"> &nbsp;{{ item.class_name }}</label>
                                <span v-for="(stm, key, index) in data.sections" :key="index" >
                                    <span v-if="item.classId==stm.classId">
                                        <br>
                                        <input type="checkbox" checked="true"> <label class="pr-3"> {{ stm.section_name }}</label>
                                    </span>
                                </span>
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
            orgList:[],
            data:'',
        }
    },
    methods:{
        getOrgDetails(id){
            axios.get('organization/getFullSchoolDetials/'+id)
            .then((response) => {  
                let data=response.data.data;
                this.data=data;
            })
            .catch((error) =>{  
                console.log("Error:"+error);
            }); 
        },
    },
    created(){
        this.getOrgDetails(this.$route.query.data);
    }
}
</script>