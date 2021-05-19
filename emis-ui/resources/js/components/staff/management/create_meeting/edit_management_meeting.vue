<template>
<div>
    <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="tabhead">
                <li class="nav-item personal-details-tabs" @click="shownexttab('','Time-Attendance-tab')">
                    <a class="nav-link active" data-toggle="pill" role="tab">
                        <label>1. Time and Attendence </label>
                    </a>
                </li>
                <li class="nav-item appointment-tab">
                    <a class="nav-link disabled" data-toggle="pill" @click="shownexttab('Time-Attendance-tab','meetings-resolutions-tab')" role="tab">
                        <label>2. Minutes and Resolutions</label>
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
                            <input type="date" v-model="form.meeting_date" @change="remove_err('meeting_date', 'meetingdate_error')" id="meetingdate" name="meeting_date" class="form-control">
                            <has-error :form="form" field="meeting_date"></has-error>
                            <span class="text-danger" id="meetingdate_error"></span>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                            <label>Start Time :<span class="text-danger">*</span></label>
                            <input type="time" v-model="form.start_time" @change="remove_err('start_time','starttime_error')" id="starttime" name="start_time" class="form-control">
                            <has-error :form="form" field="start_time"></has-error>
                            <span class="text-danger" id="starttime_error"></span>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                            <label>End Time :<span class="text-danger">*</span></label>
                            <input type="time" v-model="form.end_time" @change="remove_err('end_time','endtime_error')" id="endtime" name="end_time" class="form-control">
                            <has-error :form="form" field="end_time"></has-error>
                            <span class="text-danger" id="endtime_error"></span>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                            <label>Venue :<span class="text-danger">*</span></label>
                            <input type="text" v-model="form.venue" @change="remove_err('venue', 'venue_error')" id="venue" name="venue" class="form-control">
                            <has-error :form="form" field="venue"></has-error>
                            <span class="text-danger" id="venue_error"></span>
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
                                            <td><input type="checkbox" :value="item.id" :checked="item.meeting_member_id" @change="onChangeMemberList(item, $event)"></td>
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
                    <hr>
                    <div class="row form-group fa-pull-right">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn  btn-primary" @click="shownexttab('Time-Attendance-tab','meetings-resolutions-tab')">Save & Next <i class="fa fa-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade tab-content-details" id="meetings-resolutions-tab" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab" >
                    <div class="form-group row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <table id="minutes-table" class="table table-sm table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Minute/Resulotions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr  id="record1" v-for='(res, index) in resolutions' :key="index">
                                        <td>{{index+1}}</td>
                                        <td>
                                            <textarea class="form-control" v-model="res.resolutions"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <button type="button" class="btn  btn-xs btn-primary" id="addMore"
                                            @click="addMore()"><i class="fa fa-plus"></i> Add More</button>
                                            <button type="button" class="btn  btn-xs btn-danger" id="addMore"
                                            @click="remove()"><i class="fa fa-trash"></i> Remove</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="row form-group fa-pull-right">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn  btn-success" @click="shownexttab('','Time-Attendance-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
                            <button class="btn  btn-primary" @click="shownexttab('meetings-resolutions-tab','finalsubmit')"> <i class="fa fa-save"></i> Save </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</template>

<script>
export default {

}
</script>
