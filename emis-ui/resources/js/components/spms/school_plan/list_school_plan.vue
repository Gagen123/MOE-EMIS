<template>
    <div>
        <div class="row form-group">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label>School:</label>
                {{ school }} 
            </div>
        </div> 
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="school-plan-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Domain</th>
                            <th>Activity (What?)</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Implementation Status</th>
                            <th>Action</th> 
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr v-for="(item, index) in schoolPlans" :key="index">
                            <td>{{item.domain}}</td>
                            <td>{{item.activity}}</td>
                            <td>{{item.start_date}}</td>
                            <td>{{item.end_date}}</td>
                            <td>{{item.implementation_status}}</td>
                            <td>
                                <div v-if="item.school_plan_status==1" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-eye"></i >
                                    View
                                    <span v-if="access_level=='Org'">/ Update</span>
                                    <span v-else>/ Comment</span>
                                 </div>
                                <router-link v-else :to="{name:'edit_annual_school_plan', params: {data:item}}" class="btn btn-info btn-sm text-white"><i class="fa fa-edit"></i > Edit</router-link>
                            </td>
                            
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>  
</template>
<script>
export default {
    data(){
        return {
            access_level:'',
            schoolPlans:[],
            school:'',
            year:'',
            dt:'',
        }
    },
    methods:{
        getorgName(orgId,accessLevel){
            let type="Headquarterbyid";
            if(accessLevel=="Org"){
                type="Orgbyid";
            }
            axios.get('loadCommons/loadOrgDetails/'+type+'/'+orgId)
            .then(response => {
                let data = response.data.data;
                this.school=data['name'];
                
            })
            .catch(errors => {
                console.log(errors)
            });
        },
        getSchoolPlan(school_id){
            axios.get('spms/getSchoolPlan/'+school_id)
            .then(response => { 
                this.schoolPlans = response.data.data
            }).catch(function (error){
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        showedit(data){
            this.$router.push({name:'view_annual_school_plan',params: {data:data,school_name:this.school}});
        },
    },
    mounted(){
        axios.get('common/getSessionDetail')
            .then(response => {
                let data = response.data.data;
                this.access_level = data['acess_level'];
                if(this.$route.params.data == undefined && data['acess_level'] == 'Org'){
                    this.getSchoolPlan(data['Agency_Code'])
                    this.getorgName(data['Agency_Code'],data['acess_level']);
                }else{
                    this.getSchoolPlan(this.$route.params.data.school_id)
                    this.school = this.$route.params.data.school
                }
            })
            .catch(errors => {
                console.log(errors)
        });
        this.dt = $("#school-plan-table").DataTable({
            columnDefs: [
                { width: 30, targets: 0},
                { width: 100, targets: 2},
                { width: 100, targets: 3},
                { width: 100, targets: 4},
            ],
        })
    },
    watch: {
        schoolPlans(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#school-plan-table").DataTable({
                    columnDefs: [
                        { width: 100, targets: 0},
                    ],
                })
            });
        }
    }
}
</script>