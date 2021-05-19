this asdf<template>
    <div>
        <form class="bootbox-form">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Leave Type:</label> 
                        <select class="form-control select2" id="leave_type_id" v-model="form.leave_type_id" :class="{ 'is-invalid': form.errors.has('leave_type_id') }">
                            <option v-for="(item, index) in leavetypeList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select> 
                        <has-error :form="form" field="leave_type_id"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Date of Application:</label>
                        <input type="date" format="dd/mm/yyyy"  class="form-control" v-model="form.date_of_application"> 
                    </div>
                </div>  
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pt-4 pb-4">
                        <label class="mb-0.5">Applicant:</label>
                        <select v-model="form.staff_id" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('staff_id') }" class="form-control select2" name="staff_id" id="staff_id">
                            <option value=""> --Select--</option>
                            <option v-for="(item, index) in staffList" :key="index" v-bind:value="item.id">{{ item.cid_work_permit }}: {{ item.name }}, {{item.position_title}}</option>
                        </select>
                        <has-error :form="form" field="staff_id"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>From Date:</label> 
                        <input type="date" class="form-control" :class="{ 'is-invalid': form.errors.has('from_date') }"  name="from_date" id="from_date" v-model="form.from_date">
                        <has-error :form="form" field="from_date"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>To Date:</label> 
                        <input type="date" :class="{ 'is-invalid': form.errors.has('to_date') }"  class="form-control" name="to_date" id="to_date" v-model="form.to_date">
                        <has-error :form="form" field="to_date"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>No. of Days:</label> 
                        <input type="number" readonly class="form-control" :class="{ 'is-invalid': form.errors.has('no_days') }"  name="no_days" id="no_days" v-model="form.no_days">
                        <has-error :form="form" field="no_days"></has-error>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pt-4">
                        <label>Details:</label> 
                        <textarea class="form-control" :class="{ 'is-invalid': form.errors.has('reason') }" v-model="form.reason" id="reason"></textarea>
                        <has-error :form="form" field="reason"></has-error>
                    </div>
                </div>   
            </div>
        </form>
    </div>     
</template>
<script>
export default {
    data(){
        return {
            leavetypeList:[],
            staffList:[],
            form: new form({
                staff_id:'',
                leave_type_id:'',
                year:'',
                date_of_application:'',
                from_date:'',
                to_date:'',
                no_days:'',
                reason:'',
            })
        }
    },
    methods: {
        loadleaveTypeList(uri = 'masters/loadStaffMasters/all_leave_type_list'){
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.leavetypeList =  data.data.data;
            })
            .catch(function (error){
                console.log(error);
            });
        },
        loadstaff(){
            let uri = 'loadCommons/loadFewDetailsStaffList/userworkingagency/NA';
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.staffList = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        }, 
    },
    mounted(){
        this.loadleaveTypeList();
        this.loadstaff();
        this.form.staff_id=this.$route.params.data.staff_id;
        this.form.leave_type_id=this.$route.params.data.leave_type_id;
        this.form.year=this.$route.params.data.year;
        this.form.date_of_application=this.$route.params.data.date_of_application;
        this.form.from_date=this.$route.params.data.from_date;
        this.form.to_date=this.$route.params.data.to_date;
        this.form.no_days=this.$route.params.data.no_days;
        this.form.reason=this.$route.params.data.reason;
    },
}
</script>