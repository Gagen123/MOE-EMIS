<template>
    <div>
        <div class="callout callout-success">
            <span><label><u>Applicant Detials</u></label></span>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label for="inputName" class="col-form-label">Full Name: </label>
                    <span class="text-blue text-bold">{{staff_details.name}}</span>
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
                    <label for="inputName" class="col-form-label">Gewog: </label>
                    <span class="text-blue text-bold">{{staff_details.gewog}}</span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label for="inputName" class="col-form-label">Working Address: </label>
                    <span class="text-blue text-bold">{{staff_details.working_agency}}</span>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="mb-0">Reason</label>
                    <textarea class="form-control" v-model="form.reason" :class="{ 'is-invalid': form.errors.has('reason') }" id="reason" name="reason"></textarea>
                    <has-error :form="form" field="reason"></has-error>
                </div>
            </div>
            <hr>
            <div class="row form-group">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button class="btn btn-primary fa-pull-right" @click="submitApplication()"><i class="fa fa-save"></i> Submit </button>
                </div>
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
                office_order_type:'NOC',
                model:'TransferOrder',
                action_type:'edit'
            }),
        }
    },
    methods: {
        submitApplication(){
            Swal.fire({
                text: 'Are you sure you wish to submit this application ? ',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
                cancelButtonText:'No',
                }).then((result) => {
                if (result.isConfirmed) {
                    this.form.post('/staff/staffOfficeorderController/submitApplication')
                    .then((response) => {
                        if(response.data!=""){
                            if(response!=""){
                                let res='Your have submitted request for Transfer Order and system generated order number is: '+response.data.data.order_no+'. <br><b>Thank You !</b>';
                                this.$router.push({name:'noc_acknowledgement',params: {data:res }});
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Request has been send for further action'
                                });
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
        this.form.reason=this.$route.query.data.reason;
        axios.get('common/getSessionDetail')
        .then(response => {
            let data = response.data.data;
            this.form.staff_id=data['staff_id'];
            let uri = 'loadCommons/viewStaffDetails/by_id/'+data['staff_id'];
            axios.get(uri)
            .then(response =>{
                let data = response.data.data;
                this.staff_details=data;
            })
        })
        .catch(errors => {
            console.log(errors);
        });
    },
}
</script>
