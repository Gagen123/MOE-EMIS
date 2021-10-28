<template>
    <div>
        <div class="callout callout-success">
            <span><label><u>Applicant Detials</u></label></span>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label for="inputName" class="col-form-label">Full Name: </label>
                    <span class="text-blue text-bold">{{staff_details.staff_name}}</span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label for="inputName" class="col-form-label">EID: </label>
                    <span class="text-blue text-bold">{{staff_details.emp_id}}</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label for="inputName" class="col-form-label">Position Title: </label>
                    <span class="text-blue text-bold">{{staff_details.position_title_name}}</span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label for="inputName" class="col-form-label">Position Level: </label>
                    <span class="text-blue text-bold">{{staff_details.positionlevel}}</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label for="inputName" class="col-form-label">Dzongkhag: </label>
                    <span class="text-blue text-bold">{{staff_details.dzongkhag}}</span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label for="inputName" class="col-form-label">Working Address: </label>
                    <span class="text-blue text-bold">{{staff_details.working_agency}}</span>
                </div>
            </div>
             <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label for="inputName" class="col-form-label">Order Number: </label>
                    <span class="text-blue text-bold">{{staff_details.order_no}}</span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label for="inputName" class="col-form-label">Submitted On: </label>
                    <span class="text-blue text-bold">{{reverseDateTime(staff_details.created_at)}}</span>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label for="inputName" class="col-form-label">Reason: </label>
                    <span class="text-blue text-bold">{{staff_details.reason}}</span>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="mb-0">Remarks</label>
                    <textarea class="form-control" v-model="form.remarks" :class="{ 'is-invalid': form.errors.has('reason') }" id="reason" name="reason"></textarea>
                    <has-error :form="form" field="reason"></has-error>
                </div>
            </div>
            <hr>
            <div class="row form-group fa-pull-right">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                    <button class="btn btn-primary" @click="submitApplication('Approve')"><i class="fa fa-check"></i> Approve </button>
                    <button class="btn btn-danger" @click="submitApplication('Reject')"><i class="fa fa-times"></i> Not Approve </button>
                </div>
            </div>
            <div class="row form-group">
            </div>
            <div class="row form-group">
            </div>
        </div>
    </div>
</template>
<script>
export default {
     data(){
        return {
            staff_details:[],
            form: new form({
                id:'',
                staff_id:'',
                reason:'',
                remarks:'',
                model:'TransferOrder',
                action_type:'verify'
            }),
        }
    },
    methods:{
        submitApplication(actiontype){
            Swal.fire({
                text: 'Are you sure you wish to '+actiontype+' this application ? ',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
                cancelButtonText:'No',
                }).then((result) => {
                if (result.isConfirmed) {
                    this.form.action_type=actiontype;
                    this.form.post('/staff/staffOfficeorderController/verifyApprove')
                    .then((response) => {
                        if(response.data!=""){
                            if(response!=""){
                               Toast.fire({
                                    icon: 'success',
                                    title: 'Application details has been updated.'
                                });
                                this.$router.push({path:'/list_transfer_cancellation_order_for_verification'});
                            }
                        }
                    })
                    .catch((error) => {
                        console.log("Error:"+error);
                        this.form.errors.errors = error.response.data.errors;
                    })
                }
            });
        }
    },
    mounted(){
        this.form.id=this.$route.query.data.id;
        axios.get('/staff/staffOfficeorderController/loadDetForVerification/'+this.$route.query.data.id)
        .then(response => {
            let data = response.data;
            this.staff_details=data;
        })
        .catch(errors => {
            console.log(errors);
        });
    },
}
</script>
