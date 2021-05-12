<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <li class="nav-item programme-tab" @click="shownexttab('Time-Attendance-tab')">
                        <a class="nav-link active" data-toggle="pill" role="tab">
                            <label class="mb-0.5">1.Time and Attendance </label>
                        </a>
                    </li>
                    <li class="nav-item eligibility-tab" @click="shownexttab('meetings-resolutions-tab')">
                        <a class="nav-link" data-toggle="pill" role="tab">
                            <label class="mb-0.5">2. Minutes and Resolutions</label>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="Time-Attendance-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="form-group row">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                <label>Meeting Date :<span class="text-danger">*</span></label>
                                <input type="date" v-model="form.meeting_date" @change="remove_err('meeting_date')" id="meeting_date" name="meeting_date" class="form-control">
                                <has-error :form="form" field="meeting_date"></has-error>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                <label>Start Time :<span class="text-danger">*</span></label>
                                <input type="time" v-model="form.start_time" @change="remove_err('start_time')" id="start_time" name="start_time" class="form-control">
                                <has-error :form="form" field="start_time"></has-error>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                <label>End Time :<span class="text-danger">*</span></label>
                                <input type="time" v-model="form.end_time" @change="remove_err('end_time')" id="end_time" name="end_time" class="form-control">
                                <has-error :form="form" field="end_time"></has-error>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                <label>Venue :<span class="text-danger">*</span></label>
                                <input type="text" v-model="form.venue" @change="remove_err('venue')" id="venue" name="venue" class="form-control">
                                <has-error :form="form" field="venue"></has-error>
                            </div>
                        </div>
                        <div class="row-12">
                            <div class="card card-primary card-outline">
                                <div class="card-body pb-1 mb-0 pt-1 mt-0">
                                    <table id="list-table" class="table table-bordered text-sm table-striped">
                                        <thead>
                                            <tr>
                                                <th>SL#</th>
                                                <th></th>
                                                <th>Name</th>
                                                <th>Designation</th>
                                                <th>Emp Type</th>
                                                <th>From Date</th>
                                                <th>To Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(item, index) in managementbodylist" :key="index">
                                                <td>{{ index+1}}</td>
                                                <td><input type="checkbox"/></td>
                                                <td>{{ item.name }}</td>
                                                <td>{{ item.designation_name }}</td>
                                                <td>{{ item.emptye }}</td>
                                                <td>{{ item.from_date}}</td>
                                                <td>{{ item.to_date}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content">

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                managementbodylist:[],
                meeting:[],
                form: new form({
                    meeting_date:'',
                    start_time:'',
                    end_time:'',
                    venue:''
                }),
                member: new form({
                    meeting_id:'',
                    member_id:[],
                }),
            }
        },
        methods:{
            loadMeetingData(){
                axios.get('staff/managementBody/loadCurrentMeeting')
                .then(response => {
                    let data = response.data;
                    if(data){
                        this.form.meeting_date = data.meeting_date;
                        this.form.start_time = data.meeting.start_time;
                        this.form.end_time = data.meeting.end_time;
                        this.form.venue = data.meeting.venue;
                    }
                }).catch(function (error) {console.log('error: '+error); });
            },
            shownexttab(nextclass){
                if(nextclass=="meetings-resolutions-tab"){
                    this.form.post('staff/managementBody/saveManagementMeeting')
                        .then((response) => {
                            if(response.data!=""){
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Data saved Successfully'
                                });
                                // 74a9f84c-fb90-4cfa-96bc-3a9731620691
                            }
                        }).catch((error) => {
                            Toast.fire({
                                icon: 'error',
                                title: 'Not able to save data. Please try again'
                            });
                            console.log("Error:"+error)
                        });
                }

            },
            loadComposition(uri = 'staff/managementBody/loadcreatedManagementBodyComposition'){
                axios.get(uri)
                .then(response => {
                    this.management_id = response.data.data[0].id;
                    this.getStaffComposition();
                }).catch(function (error){console.log('Error: '+error);});
            },
            getStaffComposition(){
                axios.get('staff/managementBody/loadManagementBodyComposition/' + this.management_id)
                    .then(response => {
                        this.managementbodylist = response.data.data;
                    }).catch(error => console.log(error));
            },

            remove_err(fieldId,errorId){
                if($('#'+fieldId).val()!=""){
                    $('#'+errorId).html('');
                    $('#'+fieldId).removeClass('is-invalid');
                }
            },

        },
        mounted() {
            this.loadComposition();
            this.loadMeetingData();
            $("#list-table").DataTable({
                "responsive": true,
                "autoWidth": true,
            });
        },
    }
</script>
