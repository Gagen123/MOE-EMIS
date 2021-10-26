<template>
    <div>
        <div class="card">
            <div class="card-body pb-1 mb-0 pt-1 mt-0 small overflow-auto">
                <table id="responsible-table" class="table table-bordered text-sm table-striped">
                    <thead>
                        <tr>
                            <th>Application Number</th>
                            <th>Applicant</th>
                            <th>EID</th>
                            <th>Position Title</th>
                            <th>Position Level</th>
                            <th>Working Address</th>
                            <th>Leave Type</th>
                            <th>No. of Day(s)</th>
                            <th>Date of Application</th>
                            <th>Status</th>
                            <th class="pl-4 pr-5">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in leave_list" :key="index">
                            <td>{{ item.application_number}}</td>
                            <td>{{ item.name}}</td>
                            <td>{{ item.emp_id}}</td>
                            <td>{{ item.position_title_name}}</td>
                            <td>{{ item.positionlevel}}</td>
                            <td>{{ item.working_agency_name}}</td>
                            <td>{{ item.leave_details.name}}</td>
                            <td>{{ item.no_days}}</td>
                            <td>{{ reverseDate1(item.date_of_application)}}</td>
                            <td>{{ item.status}}</td>
                            <td>
                                <a href="#" class="btn btn-success btn-sm btn-flat text-white" @click="loadeditpage(item)"> <span class="fa fa-eye"></span> View/Edit</a>
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
        return{
            leave_list:[],
            leavetypeList:{},
        }
    },
    methods: {
        getallLeaves(){
            let uri = 'staff/staffServices/getallLeaves';
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.leave_list = data;
            })
            .catch(function (error){
               console.log('Error: '+error);
            });
        },
        loadeditpage(item){
            this.$router.push({name:"edit_leave",params:{data:item}});
        }
    },
    mounted(){
        this.getallLeaves();
        this.dt = $("#responsible-table").DataTable();
    },
    watch: {
        leave_list(){
            this.applydatatable('responsible-table');
        }
    },
}
</script>
