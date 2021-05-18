<template>
    <div>
        <form class="bootbox-form">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Leave Type:<span class="text-danger">*</span></label> 
                        <select class="form-control select2" id="leave_type_id" v-model="form.leave_type_id" :class="{ 'is-invalid': form.errors.has('leave_type_id') }">
                            <option v-for="(item, index) in leavetypeList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select> 
                        <has-error :form="form" field="leave_type_id"></has-error>
                    </div>
                </div>  
                <div class="row form-group" id="form_details" style="display:none">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Date of Application:</label> 
                        <span class="text-blue">{{current_date}}</span>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>No of days/months you can avail:</label> 
                        <span class="text-blue">{{total_leave_apply}}</span>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pt-4 pb-4">
                        <label class="mb-0.5">Applicant:<i class="text-danger">*</i></label>
                        <select v-model="form.staff_id" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('staff_id') }" class="form-control select2" name="staff_id" id="staff_id">
                            <option value=""> --Select--</option>
                            <option v-for="(item, index) in staffList" :key="index" v-bind:value="item.id">{{ item.cid_work_permit }}: {{ item.name }}, {{item.position_title}}</option>
                        </select>
                        <has-error :form="form" field="staff_id"></has-error>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>From Date:<span class="text-danger">*</span></label> 
                        <input type="date" class="form-control" :class="{ 'is-invalid': form.errors.has('from_date') }"  name="from_date" id="from_date" v-model="form.from_date">
                        <has-error :form="form" field="from_date"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>To Date:<span class="text-danger">*</span></label> 
                        <input type="date" @change="calculateNoDays()" :class="{ 'is-invalid': form.errors.has('to_date') }"  class="form-control" name="to_date" id="to_date" v-model="form.to_date">
                        <has-error :form="form" field="to_date"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>No. of Days:</label> 
                        <input type="number" readonly class="form-control" :class="{ 'is-invalid': form.errors.has('no_days') }"  name="no_days" id="no_days" v-model="form.no_days">
                        <has-error :form="form" field="no_days"></has-error>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pt-4">
                        <label>Details:<span class="text-danger">*</span></label> 
                        <textarea class="form-control" :class="{ 'is-invalid': form.errors.has('reason') }" v-model="form.reason" id="reason"></textarea>
                        <has-error :form="form" field="reason"></has-error>
                    </div>
                </div>   
            </div>
            <div class="card-footer text-right">
                <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary" style="display:none" id="applyId"><i class="fa fa-save"></i> Submit</button>
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
            roleList:[],
            count:1,
            current_date:'',
            total_leave_apply:'',
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
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },
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
        calculateNoDays(){
            if($('#from_date').val()==""){
                alert($('#from_date').val());
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
            if($('#from_date').val()!="" && $('#to_date').val()!="" && $('#from_date').val() < $('#to_date').val()){
                let date1 = new Date($('#from_date').val());
                let date2 = new Date($('#to_date').val());
                let Difference_In_Time = date2.getTime() - date1.getTime();
                let Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
                // $('#no_days').val(Difference_In_Days);
                this.form.no_days=Difference_In_Days;
            }
        },
		formaction: function(type){
            if(type=="save"){
                Swal.fire({
                    text: "Are you sure you wish to submit for further approval ?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.form.post('/staff/staffServices/submitLeaveApplication',this.form)
                        .then((response) => {
                            if(response!=null && response!=""){
                                let message="Leave Application has been submitted for approval. System Generated application number for this transaction is: <b>"+response.data.data.application_number+'.</b><br> Use this application number to track your application status. <br><b>Thank You !</b>';
                                this.$router.push({name:'Leave_acknowledgement',params: {data:message}});
                                Swal.fire(
                                    'Success!',
                                    'Leave Applicaiton has been submitted for approval',
                                    'success',
                                )
                            }
                        })
                        .catch((err) =>{
                            this.applyselect2();
                            console.log("Error: "+err)
                        })
                    }
                })
            
            }
		}, 
        changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="leave_type_id"){
                this.form.leave_type_id=$('#leave_type_id').val();
                this.getLeave_details();
            }
            if(id=="staff_id"){
                this.form.staff_id=$('#staff_id').val();
            }
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
        getLeave_details(){
            axios.get('staff/staffServices/checkEligibility/'+$('#leave_type_id').val())
            .then(response =>{
                let data = response;
                if(data.data.data!=""){
                    //need to handle for multiple role later, for now it will take for first role at the index 0
                    this.total_leave_apply=data.data.data[0].leave_details.no_days+' ('+data.data.data[0].leave_details.category+')';
                    $('#form_details').show();
                    $('#applyId').show();
                }
                else{
                    Swal.fire({
                        title: 'No Leave Configuration ! ',
                        text: "Sorry! System cannot find leave configuration for this role. Please contact system administrator",
                        icon: 'error',
                    })
                }
            })
            .catch(function (error){
                console.log(error);
            });
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
        let currentdate = new Date();
        this.form.year=currentdate.getFullYear();
        this.current_date=currentdate.getDate()+'/'+currentdate.toLocaleString('default', { month: 'long' })+'/'+currentdate.getFullYear();
        this.form.date_of_application=currentdate.getFullYear()+'-'+('0' + (currentdate.getMonth() + 1)).slice(-2)+'-'+('0' + currentdate.getDate()).slice(-2);
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').on('select2:select', function (){
            Fire.$emit('changeval',$(this).attr('id'))
        });
        Fire.$on('changeval',(id)=>{
            this.changefunction(id);
        });
        this.loadleaveTypeList();
        this.loadstaff();
    },
}
</script>