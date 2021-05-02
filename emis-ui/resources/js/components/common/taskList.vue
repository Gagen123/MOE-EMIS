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
                if(data.service_name.includes('New Establishment')){
                    this.$router.push({name:"establishment_verification",params:{data:data,type:actiontype}});
                }
                if(data.service_name.includes('Merge')){
                    this.$router.push({name:"merger_verification",params:{data:data,type:actiontype}});
                }
                if(data.service_name.includes('Bifur')){
                    this.$router.push({name:"bifurcation_verification",params:{data:data,type:actiontype}});
                }
                if(data.service_name.includes('Change Basic Details')){
                    this.$router.push({name:"change_basic_details_verification",params:{data:data,type:actiontype}});
                }
                if(data.service_name.includes('Closure')){
                    this.$router.push({name:"closure_verification",params:{data:data,type:actiontype}});
                }
                if(data.service_name.includes('Transfer')){
                    this.$router.push({name:"transfer_verification",params:{data:data,type:actiontype}});
                }
            }   
        }
    },
    mounted(){
        $('[data-toggle="tooltip"]').tooltip();
        this.loadcommontask();
        this.loadowntask();
    }
}
</script>