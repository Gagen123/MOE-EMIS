<template>
    <div>
        <search />
        <div class="form-group row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <select class="form-control select2" name="staff_id" id="staff_id">
                    <option v-for="(item, index) in staffList" :key="index" v-bind:value="item.id">{{ item.emp_id }} : {{ item.name }}, {{item.position_title_name}}, {{item.positionlevel}}</option>
                </select>
                <span class="text-danger" id="staff_err"></span>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <select class="form-control select2" name="year" id="year">
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                </select>
                <span class="text-danger" id="year_err"></span>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <button class="btn btn-primary" type="button" @click="getallLeaves()" id="generatebtn"><span class="fa fa-download"></span> Load</button>
            </div>
        </div>
        <div class="card">
            <div class="card-body pb-1 mb-0 pt-1 mt-0 small overflow-auto">
                <table id="responsible-table" class="table table-bordered text-sm table-striped">
                    <thead>
                        <tr>
                            <th>SL#</th>
                            <th>Leave Type</th>
                            <th>Leave Applicable</th>
                            <th>Leave Availed</th>
                            <th>Leave Accumulated</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in leave_list" :key="index">
                            <td>{{ index+1}}</td>
                            <td>{{ item.name}}</td>
                            <td>{{ item.no_days}}</td>
                            <td>{{ item.totalleave}}</td>
                            <td>{{ item.accumulateLeave}}</td>
                            <td>{{ item.leavebalance}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
import search from "../../searchpage.vue";
export default {
    components: {
        search,
    },
    data(){
        return{
            leave_list:[],
            leavetypeList:{},
            staffList:[],
            staff_id:'',
        }
    },
    methods: {
        getallLeaves(){
            let uri = 'staff/staffServices/getLeaveBalance/'+this.staff_id+'/'+$('#year').val();
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
        },
        loadRespectiveDataData(org_id){
            this.staffList = [];
            let uri='loadCommons/loadStaffList/staffOrgwise/'+org_id;
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.staffList = data.data;
                $('#staff_id').val(this.staff_id).trigger('change');
                $('#year').val(new Date().getFullYear()).trigger('change');
            });
        },
    },
    mounted(){

        this.dt = $("#responsible-table").DataTable();
        Fire.$on('loadRespectiveDataData',(id)=>{
            this.loadRespectiveDataData(id);
        });

        axios.get('common/getSessionDetail')
        .then(response => {
            let data = response.data.data;
            if(data['acess_level']=="Org"){
                $('#orgType').hide();
                $('#dzosection').hide();
                $('#organizationSection').hide();
            }
            if(data['acess_level']=="Dzongkhag"){
                $('#orgType').hide();
                $('#dzosection').show();
            }
            if(data['acess_level']=="Ministry"){
                $('#dzongkhag_id').show();
            }
            this.loadRespectiveDataData(data['Agency_Code']);
            this.staff_id=data['staff_id'];
            this.getallLeaves();
        })
        .catch(errors => {
            console.log(errors)
        });
    },
    watch:{
        leave_list(){
            this.applydatatable('responsible-table');
        }
    },
}
</script>
