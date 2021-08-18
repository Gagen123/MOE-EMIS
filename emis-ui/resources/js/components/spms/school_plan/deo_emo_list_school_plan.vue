<template>
       <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-2">
                <table id="deo-emo-school-plan-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Dzongkhags</th>
                            <th>School</th>
                            <th>School Plan Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr v-for="(item, index) in dzongkhagWithSchools" :key="index">
                            <td>{{item.domain}}</td>
                            <td>{{item.activity}}</td>
                            <td>{{item.start_date}}</td>
                            <td>{{item.end_date}}</td>
                            <td>{{item.implementation_status}}</td>
                            <td>
                                <div v-if="item.school_plan_status==1" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-eye"></i > View</div>
                                <!-- <div v-else class="ml-2 mt-1 btn-group  btn-flat btn-group-sm"> -->
                                    <router-link v-else :to="{name:'edit_annual_school_plan', params: {data:item}}" class="btn btn-info btn-sm text-white"><i class="fa fa-edit"></i > Edit</router-link>
                                <!-- </div> -->
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
            dzongkhagWithSchools:[],
            acess_level:'',
            dzon_id:'',
            year:'',
            dt:'',
        }
    },
    methods:{
        // getSchoolPlanStatus(id){
        //     alert(id)
        //     axios.get('spms/getSchoolPlanStatus/'+id)
        //     .then(response => { 
        //         return response.data.data
        //     }).catch(function (error){
        //         if(error.toString().includes("500")){
        //             $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
        //         }
        //     });
        // },
        getSchoolPlans(){
            axios.get('spms/loadOrgList')
            .then(response => { 
                console.log(response.data.data)
            }).catch(function (error){
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        showedit(data){
            this.$router.push({name:'view_annual_school_plan',params: {data:data}});
        },
    },
    mounted(){
        this.getSchoolPlans()
        this.dt = $("#deo-emo-school-plan-table").DataTable({
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
                this.dt = $("#deo-emo-school-plan-table").DataTable({
                    columnDefs: [
                        { width: 100, targets: 0},
                    ],
                })
            });
        }
    }
}
</script>