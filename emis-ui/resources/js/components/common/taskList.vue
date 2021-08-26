<template>
    <div>
        <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="form-inline "><h6 class="pt-1">Application List</h6></li>
        </ol>
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header bg-white pb-0">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>Common Task List</label>
                    </div>
                </div>
                <div class="card-body table-responsive p-2">
                    <table id="common-task-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Application Number</th>
                                <th>Service Name</th>
                                <th>Name</th>
                                <th>Submitted By</th>
                                <th>Submitted On</th>
                                <th>Last Action By</th>
                                <th>Last Action Date</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(commontask, index) in commonTaskList" :key="index">
                                <td>{{ index + 1 }} </td>
                                <td>
                                    <a href="#" data-toggle="tooltip" title="Click here to open and claim application" @click="loadApplicationDetals(commontask,'claim')"> {{ commontask.application_number }}</a>
                                </td>
                                <td>{{ commontask.service_name }}</td>
                                <td>{{ commontask.name }}</td>
                                <td>{{ commontask.applicant_name }} ({{ commontask.applicant_role }})</td>
                                <td>{{ commontask.applied_on }}</td>
                                <td>{{ commontask.user_name }} ({{ commontask.role_name }})</td>
                                <td>{{ commontask.last_action_date }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card card-success card-outline">
                <div class="card-header bg-white pb-0">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>My/Own Task List</label>
                    </div>
                </div>
                <div class="card-body table-responsive p-2">
                    <table id="own-task-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Application Number</th>
                                <th>Service Name</th>
                                <th>Name</th>
                                <th>Submitted By</th>
                                <th>Submitted On</th>
                                <th>Last Action By</th>
                                <th>Last Action Date</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(mytask, index) in myTaskList" :key="index">
                                <td>{{ index + 1 }}
                                    <a href="#" class="text-danger" data-toggle="tooltip" title="Click here to release this application" @click="loadApplicationDetals(mytask,'release')"> <span class="fa fa-times"></span></a>
                                </td>
                                <td>
                                    <a href="#" data-toggle="tooltip" title="Click here to open application" @click="loadApplicationDetals(mytask,'open')"> {{ mytask.application_number }}</a>
                                </td>
                                <td>{{ mytask.service_name }}</td>
                                <td>{{ mytask.name }}</td>
                                <td>{{ mytask.applicant_name }} ({{ mytask.applicant_role }})</td>
                                <td>{{ mytask.applied_on }}</td>
                                <td>{{ mytask.user_name }} ({{ mytask.role_name }})</td>
                                <td>{{ mytask.last_action_date }}</td>
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
            commonTaskList:[],
            myTaskList:[],

        }
    },
    methods: {
        loadcommontask(){
            axios.get('common/getTaskList/common')
            .then(response => {
                let data = response.data;
                if(data!="Not Found"){
                    this.commonTaskList=data;
                }
            });
        },
        loadowntask(){
            axios.get('common/getTaskList/own')
            .then(response => {
                let data = response.data;
                if(data!="Not Found"){
                    this.myTaskList=data;
                }
            });
        },
        loadApplicationDetals(data,actiontype){
            if(actiontype=="release"){
                Swal.fire({
                    text: "Are you sure you wish to release this application back to group?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        axios.get('common/releaseApplication/'+data.application_number)
                        .then((response) =>{
                            Toast.fire({
                                icon: 'success',
                                title: 'Application has been release to group task'
                            });
                            this.loadcommontask();
                            this.loadowntask();
                        })
                        .catch((error) =>{
                            console.log("Errors:"+error)
                        });
                    }
                });
            }
            else{
                if(data.application_number.includes('Estb') && data.service_name.includes('ECCD')){
                    this.$router.push({name:"eccd_verification",params:{data:data,type:actiontype}});
                }
                if(data.application_number.includes('Estb') && data.service_name.includes('School')){
                    this.$router.push({name:"establishment_verification",params:{data:data,type:actiontype}});
                }
                if(data.application_number.includes('Mer')){
                    this.$router.push({name:"merger_verification",params:{data:data,type:actiontype}});
                }
                if(data.application_number.includes('Bif')){
                    this.$router.push({name:"bifurcation_verification",params:{data:data,type:actiontype}});
                }
                if(data.application_number.includes('Ch')){
                    this.$router.push({name:"change_basic_details_verification",params:{data:data,type:actiontype}});
                }
                if(data.service_name.includes('Closure')){
                    this.$router.push({name:"closure_verification",params:{data:data,type:actiontype}});
                }
                if(data.service_name.includes('Intra Transfer')){
                    this.$router.push({name:"intra_transfer_verification",params:{data:data,type:actiontype}});
                }
                if(data.service_name.includes('Inter Transfer')){
                    this.$router.push({name:"inter_transfer_verification",params:{data:data,type:actiontype}});
                }
                if(data.application_number.includes('TRA')){
                    this.$router.push({name:"transferAppeal_verification ",params:{data:data,type:actiontype}});
                }
                if(data.service_name.includes('Leave')){
                    this.$router.push({name:"leave_verification",params:{data:data,type:actiontype}});
                }
                if(data.service_name.includes('Reopen')){
                    this.$router.push({name:"reopening_verification",params:{data:data,type:actiontype}});
                }
                 if(data.application_number.includes('Recu')){
                    this.$router.push({name:"view_principal_recuritment",params:{data:data,type:actiontype}});
                }
                if(data.application_number.includes('Expat')){
                    this.$router.push({name:"open_expatriate_verification",params:{data:data,type:actiontype}});
                }
                if(data.application_number.includes('STF_REC')){
                    this.$router.push({name:"open_staff_recruitment_verification",params:{data:data,type:actiontype}});
                }
            }

        }
    },
    mounted(){
        $('[data-toggle="tooltip"]').tooltip();
        this.dt =  $("#common-task-table").DataTable();
        this.dt1 =  $("#own-task-table").DataTable()
        this.loadcommontask();
        this.loadowntask();
    },
    watch:{
        commonTaskList() {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#common-task-table").DataTable()
            });
        },
        myTaskList() {
            this.dt1.destroy();
            this.$nextTick(() => {
                this.dt =  $("#own-task-table").DataTable()
            });
        }
    },
}
</script>
