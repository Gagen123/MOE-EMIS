<template>
    <div>
        <div class="card card-primary card-outline">
            <div class="card-body">
                <div class="callout callout-success">
                    <div class="form-group row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Agency Type:</label>
                            <span class="text-blue text-bold">{{ orgDetails.organizationType == 1 ? "Public" :  "private & Other"}}</span>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>ZEST Working Agency Code:</label>
                            <span class="text-blue text-bold">{{orgDetails.zestAgencyCode}}</span>
                        </div>   
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Agency Name:</label>
                            <span class="text-blue text-bold">{{orgDetails.agencyName}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Dzongkhag:</label>
                            <span class="text-blue text-bold">{{ orgDetails.dzongkhag}}</span>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Gewog:</label>
                            <span class="text-blue text-bold">{{orgDetails.gewog}}</span>
                        </div>   
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Chiwog:</label>
                            <span class="text-blue text-bold">{{orgDetails.village}}</span>
                        </div>
                    </div>
                </div>
                <div class="callout callout-success">
                    <table id="contactDetails" class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name/Description</th>
                                <th>Phone</th>
                                <th>Fax</th>
                                <th>Mobile</th>
                                <th>Email</th>                            
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="record1" v-for='(contact, index) in orgDetails.contactDetails' :key="index">
                                <td>{{contact.typename}}</td>
                                <td>{{contact.phone}}</td>
                                <td>{{contact.fax}}</td>
                                <td>{{contact.mobile}}</td>
                                <td>{{contact.email}}</td>
                            </tr> 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{ 
            orgDetails:'',
        } 
    },
    methods: {
        getOrgDetails(id){
            axios.get('/organization/getHeadQuarterDetails/'+id)
            .then(response => {
                let data = response.data;
                this.orgDetails = data.data;
            });
        },
    },

       
    mounted() {
        this.getOrgDetails(this.$route.query.data);
    },
}
</script>
