this asdf<template>
    <div>
        <form class="bootbox-form">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Leave Type:</label> 
                        <select disabled class="form-control select2" id="leave_type_id" v-model="form.leave_type_id" :class="{ 'is-invalid': form.errors.has('leave_type_id') }">
                            <option v-for="(item, index) in leavetypeList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select> 
                        <has-error :form="form" field="leave_type_id"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Date of Application:</label>
                        <input disabled type="date" format="dd/mm/yyyy"  class="form-control" v-model="form.date_of_application"> 
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Current Status:</label>
                        <input disabled type="text" format="dd/mm/yyyy"  class="form-control" v-model="form.status"> 
                    </div>
                </div>  
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pt-4 pb-4">
                        <label class="mb-0.5">Applicant:</label>
                        <select disabled v-model="form.staff_id" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('staff_id') }" class="form-control select2" name="staff_id" id="staff_id">
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
                        <input type="date" @change="calculateNoDays()" :class="{ 'is-invalid': form.errors.has('to_date') }"  class="form-control" name="to_date" id="to_date" v-model="form.to_date">
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
                <div class="card-footer text-right">
                    <button type="button" id="updatebtn" style="display:none" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Update</button>
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
            total_leave_apply:'',
            leave_balance:'',
            form: new form({
                staff_id:'',
                leave_type_id:'',
                year:'',
                date_of_application:'',
                from_date:'',
                to_date:'',
                no_days:'',
                reason:'',
                status:'',
                action_type:'edit'
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
        calculateNoDays(){
            if($('#from_date').val()==""){
                Swal.fire({
                    icon: 'error',
                    title: 'Sorry! ',
                    text: 'Please provide From Date first!',
                });
                $('#to_date').val('');
            }
            
            if($('#from_date').val()!="" && $('#from_date').val() > $('#to_date').val()){
                Swal.fire({
                    icon: 'error',
                    title: 'Sorry! ',
                    text: 'Please mention valid To Date. To Date should be greater then from date!',
                });
                $('#to_date').val('');
            }
            if($('#from_date').val()!="" && $('#to_date').val()!="" && $('#from_date').val() <= $('#to_date').val()){
                let date1 = new Date($('#from_date').val());
                let date2 = new Date($('#to_date').val());
                let Difference_In_Time = date2.getTime() - date1.getTime();
                let Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
                // $('#no_days').val(Difference_In_Days);
                Difference_In_Days++;
                this.form.no_days=Difference_In_Days;
            }
        },
        validated(){
            let returntype=true;
            if(this.total_leave_apply.toLowerCase().includes('day') && this.form.no_days>this.leave_balance){
                Swal.fire({
                    icon: 'error',
                    title: 'Sorry! ',
                    text: 'You can avail maximum of '+this.leave_balance +' Days',
                });
                returntype=false; 
            }
            return returntype;
        },
        getLeave_details(){
            axios.get('staff/staffServices/checkEligibility/'+$('#leave_type_id').val())
            .then(response =>{
                let data = response;
                if(data.data.data!=""){
                    this.total_leave_apply=' ('+data.data.data[0].leave_details.category+')';
                    this.actual_leave_avail=data.data.data[0].leave_details.no_days;
                    this.leave_balance=data.data.data[0].leave_details.no_days;
                }
            })
            .catch(function (error){
                console.log(error);
            });
        },
        getApprovedLeaveCount(){
            if(this.total_leave_apply.toLowerCase().includes('day')){
                axios.get('staff/staffServices/getApprovedLeaveCount/'+this.form.staff_id+'/'+$('#leave_type_id').val())
                .then(response =>{
                    let totlaApprovedleave=0;
                    let data = response.data.data;
                    for(let i=0;i<data.length;i++){
                        totlaApprovedleave+=parseInt(data[i].no_days);
                    }
                    let leavebalance=0;
                    leavebalance=this.actual_leave_avail-totlaApprovedleave;
                    this.leave_balance=leavebalance;
                })
                .catch(function (error){
                    console.log(error);
                });
            }
            
        }, 
        formaction: function(type){
            if(type=="save" && this.validated()){
                Swal.fire({
                    text: "Are you sure you wish to updateinformation ?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                }).then((result) => {
                    if (result.isConfirmed) { 
                        this.form.post('/staff/staffServices/editLeaveApplication',this.form)
                        .then((response) => {
                            if(response.data.data!=undefined){
                                let message="Leave Application has been submitted for approval. System Generated application number for this transaction is: <b>"+response.data.data.application_number+'.</b><br> Use this application number to track your application status. <br><b>Thank You !</b>';
                                this.$router.push({name:'Leave_acknowledgement',params: {data:message}});
                                Swal.fire(
                                    'Success!',
                                    'Leave Applicaiton has been submitted for approval',
                                    'success',
                                ) 
                            }
                            else{
                                if(response.data.includes('No role mapping found for this selected use')){
                                    Swal.fire({
                                        title: 'No Role Configuration ! ',
                                        text: "Sorry! "+response.data,
                                        icon: 'error',
                                    });
                                } 
                            }
                            // 
                        })
                        .catch((err) =>{
                            console.log("Error: "+err);
                            this.applyselect2();
                            
                        })
                    }
                })
            
            }
		}, 
        applyselect2(){
            if(!$('#leave_type_id').attr('class').includes('select2-hidden-accessible')){
                $('#leave_type_id').addClass('select2-hidden-accessible');
            }
            if(!$('#role_id').attr('class').includes('select2-hidden-accessible')){
                $('#role_id').addClass('select2-hidden-accessible');
            }
        },
    },
    mounted(){
        this.loadleaveTypeList();
        this.loadstaff();
        this.form.id=this.$route.params.data.id;
        this.form.staff_id=this.$route.params.data.staff_id;
        this.form.leave_type_id=this.$route.params.data.leave_type_id;
        this.form.year=this.$route.params.data.year;
        this.form.date_of_application=this.$route.params.data.date_of_application;
        this.form.from_date=this.$route.params.data.from_date;
        this.form.to_date=this.$route.params.data.to_date;
        this.form.no_days=this.$route.params.data.no_days;
        this.form.reason=this.$route.params.data.reason;
        this.form.status=this.$route.params.data.status;
        if(this.$route.params.data.status!="Approved" && this.$route.params.data.status!="Rejected"){
            $('#updatebtn').show();
        }
        this.getLeave_details();
        this.getApprovedLeaveCount();
    },
}
</script>