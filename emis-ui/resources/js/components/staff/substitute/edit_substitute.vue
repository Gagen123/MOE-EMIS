<template>
    <div>
        <form class="bootbox-form">
            <!-- <div class="row form-group">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="mb-0.5">CID:<i class="text-danger">*</i></label>
                    <input v-model="form.cid" :class="{ 'is-invalid': form.errors.has('cid') }" type="text" id="cid" class="form-control" @change="remove_err('cid')">
                    <has-error :form="form" field="cid"></has-error>
                    <span class="text-danger" id="cid_err"></span>
                </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="mb-0.5"> Full Name:<i class="text-danger">*</i></label>
                    <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" type="text" id="name" class="form-control" @change="remove_err('name')">
                    <has-error :form="form" field="name"></has-error>
                    <span class="text-danger" id="name_err"></span>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="mb-0.5">Gender:<i class="text-danger">*</i></label>
                    <select v-model="form.gender" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('gender') }" class="form-control select2" name="gender" id="gender">
                        <option value=""> --Select--</option>
                        <option v-for="(item, index) in sex_idList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <has-error :form="form" field="gender"></has-error>
                    <span class="text-danger" id="gender_err"></span>
                </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="mb-0.5"> DOB:<i class="text-danger">*</i></label>
                    <input v-model="form.dob" :class="{ 'is-invalid': form.errors.has('dob') }" type="text" id="dob" class="form-control" @change="remove_err('dob')">
                    <has-error :form="form" field="dob"></has-error>
                    <span class="text-danger" id="dob_err"></span>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="mb-0.5">Dzongkhag:<i class="text-danger">*</i></label>
                    <select v-model="form.dzongkhag" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('dzongkhag') }" class="form-control select2" name="dzongkhag" id="dzongkhag">
                        <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <has-error :form="form" field="dzongkhag"></has-error>
                    <span class="text-danger" id="dzongkhag_err"></span>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                   <button type="button" id="updatebtn" @click="getDetailsbyCID()" class="btn btn-primary"> Update Personal Details</button>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="mb-0.5">Qualification:<i class="text-danger">*</i></label>
                    <input v-model="form.qualification" :class="{ 'is-invalid': form.errors.has('qualification') }" type="text" id="qualification" class="form-control" @change="remove_err('qualification')">
                    <has-error :form="form" field="qualification"></has-error>
                    <span class="text-danger" id="designation_err"></span>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="mb-0.5">Contact Number:<i class="text-danger">*</i></label>
                    <input v-model="form.contact" :class="{ 'is-invalid': form.errors.has('contact') }" type="text" id="contact" class="form-control" @change="remove_err('contact')">
                    <has-error :form="form" field="contact"></has-error>
                    <span class="text-danger" id="contact_err"></span>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="mb-0.5"> Email:<i class="text-danger">*</i></label>
                    <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" type="text" id="email" class="form-control" @change="remove_err('email')">
                    <has-error :form="form" field="email"></has-error>
                    <span class="text-danger" id="email_err"></span>
                </div>
            </div>
            <div class="row form-group fa-pull-right">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button type="button" class="btn btn-primary" @click="submitDetails()"> <i class="fa fa-save"></i>Save </button>
                </div>
            </div> -->
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Name: <span class="text-blue text-bold">{{emp_idList.staff_name}}</span></label>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">EID: <span class="text-blue text-bold">{{emp_idList.EID}}</span></label>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Appointment Date: <span class="text-blue text-bold">{{emp_idList.Appointment_Date}}</span></label>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Position Title: <span class="text-blue text-bold">{{emp_idList.Position_Title}}</span></label>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Position Level: <span class="text-blue text-bold">{{emp_idList.Position_Level}}</span></label>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Sub Level: <span class="text-blue text-bold">{{emp_idList.Sub_Level}}</span></label>
                </div>
            </div>
            <hr>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Substituted for: <span class="text-blue text-bold">{{emp_idList.substitutee_det.name}}</span></label>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">EID: <span class="text-blue text-bold">{{emp_idList.substitutee_det.emp_id}}</span></label>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Appointment Date: <span class="text-blue text-bold">{{emp_idList.substitutee_det.initial_appointment_date}}</span></label>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Position Title: <span class="text-blue text-bold">{{emp_idList.substitutee_det.Position_Title}}</span></label>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Position Level: <span class="text-blue text-bold">{{emp_idList.substitutee_det.Position_Level}}</span></label>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Sub Level: <span class="text-blue text-bold">{{emp_idList.substitutee_det.position_sub_level_id}}</span></label>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    data(){
        return {
            emp_idList:[],
        }
    },

    async mounted(){
        axios.get('staff/zest/loadSubstitution/by_id__'+this.$route.params.data.Id)
        .then((response) => {
            let data=response.data.data;
            this.emp_idList=data;
        })
        .catch((error) => {
            console.log("Error......"+error);
        });
    },
}
</script>
