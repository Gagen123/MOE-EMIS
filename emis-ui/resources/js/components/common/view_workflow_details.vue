<template>
    <div>
        <table id="tableLearner" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Sl_No</th>
                    <th>Status</th>
                    <th>Remarks</th>
                    <th>Action By</th>
                    <th>Action Date </th>
                </tr>
            </thead>  
            <tbody>
                <tr v-for="(item, index) in workflow_detail_list" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.status_name }}</td>
                    <td>{{ item.remarks }}</td>
                    <td>{{ item.user_name}} ({{ item.role_name}})</td>
                    <td>{{ item.action_date }}</td>
                </tr>
            </tbody>
        </table> 
    </div>
</template>
<script>
export default {
    data() {
        return {
            workflow_detail_list:[],
        };
    },
    props: {
        appNo: {
            type: String,
            default: "",
        },
    },
    methods:{
        getworkflow(appNo){
            axios.get('common/getApplicationDetials/'+appNo)
            .then(response => {
                let data = response;
                this.workflow_detail_list = data.data;
            });
        }
    },
    created(){ 
        this.getworkflow(this.$route.params.data.application_number);
    }
}
</script>