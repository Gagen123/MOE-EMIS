<template>
    <div>
        <ol class="mb-1 ml-xl-n3 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="pl-2 form-inline "><h6 class="pt-1">Application List</h6></li>
        </ol>
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
                            <td>{{ commontask.user_name }}</td>
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
                            <th>Last Action By</th>
                            <th>Last Action Date</th>
                        </tr>
                    </thead>
                    <tbody>
                       <tr v-for="(mytask, index) in myTaskList" :key="index">
                            <td>{{ index + 1 }}</td>
                            <td>
                                <a href="#" data-toggle="tooltip" title="Click here to open application" @click="loadApplicationDetals(mytask,'open')"> {{ mytask.application_number }}</a>
                            </td> 
                            <td>{{ mytask.service_name }}</td>
                            <td>{{ mytask.user_name }}</td>
                            <td>{{ mytask.last_action_date }}</td>
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
                this.commonTaskList=data;
            });
        },
        loadowntask(){
            axios.get('common/getTaskList/own')
            .then(response => {
                let data = response.data;
                this.myTaskList=data;
            });
        },
        loadApplicationDetals(data,actiontype){
            if(data.service_name.includes('New Establishment')){
                this.$router.push({name:"establishment_verification",params:{data:data,type:actiontype}});
            }
            if(data.service_name.includes('Merge')){
                this.$router.push({name:"merger_verification",params:{data:data,type:actiontype}});
            }
            if(data.service_name.includes('Bifur')){
                this.$router.push({name:"bifurcation_verification",params:{data:data,type:actiontype}});
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
