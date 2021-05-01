<template>
    <div>
        <div class="callout callout-danger" style="display:none" id="screenPermission">
            <h5 class="bg-gradient-danger">Sorry!</h5>
            <div id="existmessage"></div>
        </div>
        <div class="card " id="mainform">
            <div class="card-body">   
                <div class="form-group row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <table id="training-table" class="table w-100 table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sl#</th>
                                    <th>Name</th>
                                    <th>Agency Type</th>    
                                    <th>Status</th> 
                                    <th width="10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                               <tr v-for="(item, index) in orgList" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ item.agencyName }}</td>
                                    <td>{{ item.organizationType  == 1 ? "Agency in HQ" :  "Dzongkhag Education Office"}}</td>
                                    <td>{{ item.status }}</td>
                                    <td>
                                        <button type="button" class="btn btn-flat btn-primary" @click="showfulldetails(item.id)"> <i class="fa fa-eye"></i> View</button>                                                
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
        }
    },
    methods:{
        loadSchool(){
            axios.get('organization/getsAgencyList')
            .then(response => {
                let data = response;
                this.orgList = data.data.data;
            });
        },
        showfulldetails(id){
            this.$router.push({name:'org_details',query: {data:id}});
        },
        getScreenAccess(){
            axios.get('common/getSessionDetail')
            .then(response => {
                let data = response.data.data.acess_level;
                if(data != "Ministry"){
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
    created(){
        this.getScreenAccess();
        this.loadSchool();
    }
}
</script>