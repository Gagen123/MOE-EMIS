<template>
    <div>
         <form class="bootbox-form" id="closureId">
            <div class="form-group row">
                <input type="hidden" v-model="form.organizationId"/>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Code:</label>
                    <span class="text-blue text-bold" id="code">{{form.code}}</span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Name:</label>
                    <span class="text-blue text-bold" id="name">{{form.name}}</span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Category:</label>
                    <span class="text-blue text-bold" id="name">{{form.category == 1 ? "public" : "private"}}</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Level:</label>
                    <span class="text-blue text-bold" id="level">{{form.level}}</span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Dzongkhag:</label>
                    <span class="text-blue text-bold" id="dzongkhag">{{form.dzongkhag}}</span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Gewog:</label>
                    <span class="text-blue text-bold" id="gewog">{{form.gewog}}</span>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Chiwog:</label>
                    <span class="text-blue text-bold" id="chiwog">{{form.chiwog}}</span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Location Type:</label>
                    <span class="text-blue text-bold" id="chiwog">{{form.location}}</span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Geopolitically Located:</label>
                    <span class="text-blue text-bold" id="geoLocated">{{form.geoLocated == 1 ? "Yes" : "No"}}</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>SEN School:</label>
                    <span class="text-blue text-bold" id="geoLocated">{{form.senSchool == 1 ? "Yes" : "No"}}</span>
                </div>
            </div>
            <div class="form-group row">
                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0">Reason:<span class="text-danger">*</span></label>
                    <textarea class="form-control" v-model="form.reason" :class="{ 'is-invalid': form.errors.has('reason') }" @change="remove_error('reason')"></textarea>
                    <has-error :form="form" field="reason"></has-error>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <label>Remarks:</label>
                    <textarea class="form-control" v-model="form.remark"></textarea>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="button" @click="formaction('reset')" class="btn btn-flat btn-sm btn-danger" tabindex="5"><i class="fa fa-redo"></i> Reset</button>
                <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary" tabindex="4"><i class="fa fa-save"></i> Close School</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data(){
        return{
            form: new form({
                code:'',organizationId:'',name:'',category:'',level:'',dzongkhag:'',gewog:'',chiwog:'',location:'',
                geoLocated:'',senSchool:'',reason:'',remark:'',status:'submitted'
            })
        }
    },

    methods:{
        /**
         * method to remove error
         */
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },
        
        formaction: function(type){
            if(type=="reset"){
                this.form.reason = '';
                this.form.remark = '';
            }
            if(type=="save"){
                this.form.post('/organization/saveClosure')
                    .then((response) => {
                    if(response!=""){
                        let message="Applicaiton for Closure details has been submitted for approval. System Generated application number for this transaction is: <b>"+response.data.data.application_number+'.</b><br> Use this application number to track your application status. <br><b>Thank You !</b>';
                        this.$router.push({name:'acknowledgement',params: {data:message}});
                        Toast.fire({  
                            icon: 'success',
                            title: 'Closure details is saved successfully'
                        });
                    }
                    // this.$router.push('/closure_list');
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		},

    },
    mounted(){
        this.form.code=this.$route.params.data.code;
        this.form.name=this.$route.params.data.name;
        this.form.category=this.$route.params.data.category;
        this.form.level=this.$route.params.data.level;
        this.form.dzongkhag=this.$route.params.data.dzongkhagId;
        this.form.gewog=this.$route.params.data.gewogId;
        this.form.chiwog=this.$route.params.data.chiwogId;
        this.form.location=this.$route.params.data.locationId;
        this.form.geoLocated=this.$route.params.data.isGeopoliticallyLocated;
        this.form.senSchool=this.$route.params.data.isSenSchool;
        this.form.organizationId=this.$route.params.data.id;
    }
}
</script>