<template>
    <div>
        <div id="maindiv">
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-body">
                    <!-- Post Details -->
                    <template v-if="post_detail!=''">
                        <div class="callout callout-success">
                            <span><label><u>Post Detials</u></label></span>
                            <div class="row form-group">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Leadership Selection For:</label>
                                    <span class="text-blue text-bold">{{response_data.leadership_for}}</span>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Position Title:</label>
                                    <span class="text-blue text-bold">{{response_data.position_title}}</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Application Start Date:</label>
                                    <span class="text-blue text-bold">{{post_detail.from_date}}</span>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Application End Date:</label>
                                    <span class="text-blue text-bold">{{post_detail.to_date}}</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label>Details:</label>
                                    <span class="text-blue text-bold">{{post_detail.details}}</span>
                                </div>
                            </div>
                        </div>
                    </template>
                    <!-- Application Detauils -->
                    <div class="callout callout-success">
                        <span><label><u>Applicant Detials</u></label></span>
                        <div class="row form-group">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Application Status:</label>
                                <span class="text-blue text-bold">{{form.current_status}}</span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Application Number:</label>
                                <span class="text-blue text-bold">{{form.application_number}}</span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Application Date:</label>
                                <span class="text-blue text-bold">{{form.application_date}}</span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Applicant CID:</label>
                                <span class="text-blue text-bold">{{form.aplicant_cid}}</span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Applicant:</label>
                                <input type="hidden" id="applicant" :value="form.applicant">
                                <span class="text-blue text-bold">{{form.applicant}}</span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Position Title:</label>
                                <span class="text-blue text-bold">{{form.aplicant_position_title}}</span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Working Agency:</label>
                                <span class="text-blue text-bold">{{form.aplicant_working_agency}}</span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Dzongkhag:</label>
                                <span class="text-blue text-bold">{{form.aplicant_working_dzo}}</span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                <label>Remarks:</label>
                                <span class="text-blue text-bold">{{form.remarks}}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-1">Effective Date:<i class="text-danger">*</i></label>
                                <input type="date" @change="remove_error('effective_date')" v-model="form.effective_date" :class="{ 'is-invalid': form.errors.has('effective_date') }" class="form-control" name="effective_date" id="effective_date">
                                <has-error :form="form" field="effective_date"></has-error>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                <label class="mb-0.5">Remarks:</label>
                                <textarea @change="remove_error('record_remarks')" class="form-control" v-model="form.record_remarks" :class="{ 'is-invalid': form.errors.has('record_remarks') }" name="record_remarks" id="record_remarks"></textarea>
                                <has-error :form="form" field="record_remarks"></has-error>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row form-group fa-pull-right">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" @click="shownexttab()"> <i class="fa fa-save"></i> Update </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return {
            post_detail:[],
            response_data:[],
            form: new form({
                id:'',
                application_number:'',
                application_date:'',
                from_date:'',
                to_date:'',
                remarks:'',
                applicant:'',
                staff_id:'',
                current_status:'',
                aplicant_cid:'',
                aplicant_position_title:'',
                aplicant_working_agency:'',
                aplicant_working_dzo:'',
                aplicant_working_gewog:'',
                effective_date:'',
                record_remarks:'',
                action_type:'Leadership Update',
            }),
        }
    },
    methods: {

        loadPositionTitleList(uri = 'staff/loadStaffMasters/active/PositionTitle'){
            axios.get(uri)
            .then(response =>{
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.positionList[data[i].id] = data[i].name;
                }
            })
            .catch(function (error){
                console.log(error);
            });
        },

        loadApplicationDetils(appNo,type){
            axios.get('/staff/staffLeadershipSerivcesController/loadapplicaitontDetialsforVerification/'+appNo+'/'+type)
            .then((response) =>{
                let data=response.data.data;
                this.response_data=data;
                this.post_detail=data.Post_details;
                this.form.id=data.id;
                this.form.remarks=data.remarks;
                this.form.applicant=data.aplicant_name;
                this.form.staff_id=data.staff_id;
                this.form.aplicant_cid=data.aplicant_cid;
                this.form.aplicant_position_title=data.aplicant_position_title;
                this.form.aplicant_working_agency=data.aplicant_working_agency;
                this.form.aplicant_working_dzo=data.aplicant_working_dzo;
                this.form.aplicant_working_gewog=data.aplicant_working_gewog;
                this.form.application_number=data.application_number;
                this.form.current_status=data.status;
                this.form.application_date=data.created_at;
            })
            .catch((error) =>{
                console.log("Error: "+error);
            });
        },


        shownexttab(type){
            Swal.fire({
                text: "Are you sure you wish to this details ?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
                }).then((result) => {
                if(result.isConfirmed){
                    this.form.post('/staff/updateStaffDetails')
                    .then(response =>{
                            if(response!=""){
                            Toast.fire({
                                icon: 'success',
                                title: 'Details has been updated.'
                            });
                            this.$router.push({path:'/reporting_list'});
                        }
                    })
                    .catch(function (error){
                        console.log(error);
                    });
                }
            });
        },

    },
    created(){
        $('[data-toggle="tooltip"]').tooltip();
    },
    mounted(){
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id'));
        });

        Fire.$on('changefunction',(id)=> {
            this.changefunction(id);
        });
        this.form.application_number=this.$route.params.data.aplication_number;
        this.loadApplicationDetils(this.$route.params.data.aplication_number,this.$route.params.type);
    },

}
</script>
