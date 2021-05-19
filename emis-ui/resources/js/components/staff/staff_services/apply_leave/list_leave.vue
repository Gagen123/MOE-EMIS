<template>
    <div>
        <div class="card">
            <div class="card-body pb-1 mb-0 pt-1 mt-0 small">
                <table id="responsible-table" class="table table-bordered text-sm table-striped">
                    <thead>
                        <tr>
                            <th style="width:5%">SL#</th>
                            <th style="width:20%">Leave Type</th>
                            <th style="width:10%">Days/Months</th>
                            <th style="width:20%">Date of Applicaiton</th>
                            <th style="width:30%">Status</th>
                            <th style="width:15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in leave_list" :key="index">
                            <td>{{ index+1}}</td>
                            <td>{{ leavetypeList[item.leave_type_id]}}</td>
                            <td>{{ item.no_days}}</td>
                            <td>{{ item.date_of_application}}</td>
                            <td>{{ item.status}}</td>
                            <td>
                                <a href="#" class="btn btn-success btn-sm btn-flat text-white" @click="loadeditpage(item)"> <span class="fa fa-eye"></span> View</a>
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
        loadleaveTypeList(uri = 'masters/loadStaffMasters/all_leave_type_list'){
            axios.get(uri)
            .then(response =>{
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.leavetypeList[data.data.data[i].id] = data.data.data[i].name; 
                }
            })
            .catch(function (error){
                console.log(error);
            });
        },
        loadeditpage(item){
            this.$router.push({name:"edit_leave",params:{data:item}});
        }
    },
    mounted(){this.loadleaveTypeList();
        this.getallLeaves();
        this.dt = $("#responsible-table").DataTable();
    },
    watch: {
        leave_list(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#responsible-table").DataTable()
            });
        }
    },
}
</script>