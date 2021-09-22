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
                <table id="school-plan-table" class="table table-sm table-bordered table-striped ">
                    <thead>
                        <tr class="text-center">
                            <th>Plan Date</th>
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
                            <td>
                                <span v-if="item.submitted_status =='submitted'">
                                    <strong>Submitted on {{item.plan_date}}</strong>
                                  
                                </span>
                                <span v-else-if="item.submitted_status =='has_not_submit' && access_level=='Org'">
                                    <strong>Not Submitted</strong>
                                </span>
                            </td>
                            <td>{{item.domain}}</td>
                            <td>{{item.activity}}</td>
                            <td>{{item.start_date}}</td>
                            <td>{{item.end_date}}</td>
                            <td>{{item.implementation_status}}</td>
                            <td>
                                <router-link v-if="item.school_plan_status_id==2" :to="{name:'view_annual_school_plan', params: {data:item,school_name:school}}" class="btn btn-info btn-sm text-white">    
                                    <i class="fa fa-eye"></i >                           
                                        View Detail /
                                    <span v-if="access_level=='Org'">Update</span>
                                    <span v-else>Comment</span>
                                </router-link>
                                <router-link v-else :to="{name:'edit_annual_school_plan', params: {data:item}}" class="btn btn-info btn-sm text-white"><i class="fa fa-edit"></i > Edit Draft</router-link>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div v-if="(no_of_not_submitted==1 && access_level=='Org')" class="card-footer text-right mt-2">
                    <button type="button" @click="save" class="btn btn-flat btn-sm btn-primary"><i class="fas fa-check-circle"></i> Submit</button>
                </div>
            </div>
        </div>
    </div>  
</template>
<script>
export default {
    data(){
        return {
            access_level:'',
            no_of_not_submitted:'',
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
                this.schoolPlans = response.data.data.schoolPlan
                let not_submitted = response.data.data.no_of_not_submitted
                for(let i=0; not_submitted.length > i; i++){
                     this.no_of_not_submitted = not_submitted[i]['no_of_not_submitted']
                }
            }).catch(function (error){
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        save(){
            let not_submitted = this.schoolPlans.filter(item => item.school_plan_status_id == 1);
            Swal.fire({
                title: 'Do you want to submit all Not Submitted plan?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                }).then((result) => {
                    if(result.isConfirmed) {
                        axios.post('spms/updateSchoolPlanStatusId',{data:not_submitted})
                            .then(() => {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Details submitted successfully '
                                })
                                this.$router.push('/lists-annual-school-plan');
                            })
                            .catch(function(error){
                            this.errors = error;
                        });
                    }
            })
        }
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
              rowGroup: {
                dataSrc: 0 
            },
            columnDefs: [
                {targets: 0,visible: false},
                { width: 30, targets: 1},
                { width: 300, targets: 2},
                { width: 63, targets: 3},
                { width: 63, targets: 4},
                { width: 100, targets: 5},
                { width: 160, targets: 6},
            ],
        })

    },
    watch: {
        schoolPlans(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                  this.dt = $("#school-plan-table").DataTable({
                rowGroup: {
                    dataSrc: 0 
                        },
                        columnDefs: [
                            {targets: 0,visible: false},
                            { width: 30, targets: 1},
                            { width: 300, targets: 2},
                            { width: 63, targets: 3},
                            { width: 63, targets: 4},
                            { width: 100, targets: 5},
                            { width: 160, targets: 6},
                        ],
                    })
            });
        }
    }
}
</script>