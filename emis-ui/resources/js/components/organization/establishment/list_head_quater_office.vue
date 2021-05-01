<template>
    <div>
        <div class="card ">
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
            axios.get('organization/getsAgencyList/session')
            .then(response => {
                let data = response;
                this.orgList = data.data.data;
            });
        },
        showfulldetails(id){
            this.$router.push({name:'org_details',query: {data:id}});
        }
    },
    created(){
        this.loadSchool();
    }
}
</script>