<template>
    <div>
         <form class="bootbox-form" id="closureId">
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Code:</label>
                    <input type="text" id="name" class="form-control" v-model="form.code" readonly/>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Name:</label>
                    <input type="text" class="form-control" v-model="form.name" readonly/>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Category:</label>
                    <br>
                    <label><input  type="radio" v-model="form.category" value="1" tabindex=""/> Public</label>
                    <label><input  type="radio" v-model="form.category" value="0" tabindex=""/> Private</label>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Level:</label>
                    <input type="text" class="form-control" v-model="form.level" readonly/>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Dzongkhag:</label>
                    <input type="text" class="form-control" v-model="form.dzongkhag" readonly/>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Gewog:</label>
                    <input type="text" class="form-control" v-model="form.gewog" readonly/>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Chiwog:</label>
                    <input type="text" class="form-control" v-model="form.chiwog" readonly/>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Location Type:</label>
                    <input type="text" class="form-control" v-model="form.location" readonly/>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Geopolitically Located:</label>
                    <br>
                    <label><input  type="radio" v-model="form.geoLocated" value="1" tabindex=""/> Yes</label>
                    <label><input  type="radio" v-model="form.geoLocated" value="0" tabindex=""/> No</label>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>SEN School:</label>
                    <br>
                    <label><input  type="radio" v-model="form.senSchool" value="1" tabindex="" /> Yes</label>
                    <label><input  type="radio" v-model="form.senSchool" value="0" tabindex=""/> No</label>
                </div>
                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0">Reason:<span class="text-danger">*</span></label>
                    <textarea class="form-control" v-model="form.reason" :class="{ 'is-invalid': form.errors.has('reason') }" @change="remove_error('reason')"></textarea>
                    <has-error :form="form" field="reason"></has-error>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
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
                code:'',name:'YHSS',category:'1',level:'HSS',dzongkhag:'Thimphu',
                gewog:'Babesa',chiwog:'Babesa',location:'Urban',
                geoLocated:'1',senSchool:'0',reason:'',remark:''
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
                this.form.post('/organization/saveClosure',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Application for School Closure has been submitted successfully.'
                    })
                    this.$router.push('/closure_list');
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
        this.form.dzongkhag=this.$route.params.data.dzongkhag;
        this.form.gewog=this.$route.params.data.gewog;
        this.form.chiwog=this.$route.params.data.chiwog;
        this.form.location=this.$route.params.data.location;
        this.form.geoLocated=this.$route.params.data.geoLocated;
        this.form.senSchool=this.$route.params.data.senSchool;
        this.form.reason=this.$route.params.data.reason;
        this.form.remark=this.$route.params.data.remark;
    }
}
</script>