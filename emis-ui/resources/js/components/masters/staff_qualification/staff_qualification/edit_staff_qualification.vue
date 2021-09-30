<template>
    <div>
        <form class="bootbox-form" id="dzongkhagId">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Qualification Type:<span class="text-danger">*</span></label>
                        <select class="form-control" id="qualification_type" v-model="form.qualification_type" :class="{ 'is-invalid': form.errors.has('qualification_type') }">
                            <option v-for="(item, index) in qualificationtypeList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="qualification_type"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Qualification Level:<span class="text-danger">*</span></label>
                        <select class="form-control" id="qualification_level" v-model="form.qualification_level" :class="{ 'is-invalid': form.errors.has('qualification_level') }">
                            <option v-for="(item, index) in qualificationlevelList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="qualification_level"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Qualification:<span class="text-danger">*</span></label>
                        <input class="form-control" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" id="name" @change="remove_err('name')" type="text">
                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <label>Description:</label>
                        <textarea class="form-control" v-model="form.description" :class="{ 'is-invalid': form.errors.has('description') }" id="description" @change="remove_err('description')" ></textarea>
                        <has-error :form="form" field="description"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pt-2">
                        <label>Code:<span class="text-danger">*</span></label>
                        <input class="form-control" v-model="form.code" :class="{ 'is-invalid': form.errors.has('code') }" id="code" @change="remove_err('code')" type="text">
                        <has-error :form="form" field="code"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pt-2">
                        <label class="required">Status:</label>
                        <br>
                        <label><input v-model="form.status"  type="radio" value="1" /> Active</label>
                        <label><input v-model="form.status"  type="radio" value="0" /> Inactive</label>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="button" @click="formaction('reset')" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-redo"></i> Reset</button>
                <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    data() {
        return {
            qualificationtypeList:[],
            qualificationlevelList:[],
            form: new form({
                id: '',
                name: '',
                qualification_type:'',
                qualification_level:'',
                code:'',
                status:'',
                description:'',
                model:'Qualification',
                action_type:'edit',
            })
        }
    },
    methods: {
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },
        loadQualificationTypeList(uri = 'staff/loadStaffMasters/active/QualificationType'){
        // loadQualificationTypeList(uri = 'masters/loadStaffMasters/active_qualification_type_List'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.qualificationtypeList =  data.data.data;
            })
            .catch(function (error){
                console.log("Error......"+error)
            });
        },

        loadQualificationLevelList(uri = 'staff/loadStaffMasters/active/QualificationLevel'){
        // loadQualificationLevelList(uri = 'masters/loadStaffMasters/active_qualification_level_List'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.qualificationlevelList =  data.data.data;
            })
            .catch(function (error){
                console.log("Error......"+error)
            });
        },
		formaction: function(type){
            if(type=="reset"){
                this.form.name= '';
                this.form.code='';
                this.form.status= 1;
            }
            if(type=="save"){
                this.form.post('staff/saveStaffMasters',this.form)
                // this.form.post('/masters/saveStaffMasters',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details updated successfully'
                    })
                    this.$router.push('/list_staff_qualification');
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		},
    },
    created() {
        this.loadQualificationTypeList();
        this.loadQualificationLevelList();
        this.form.name=this.$route.params.data.name;
        this.form.qualification_type=this.$route.params.data.quialificationtype.id;
        this.form.qualification_level=this.$route.params.data.quialificationlevel.id;
        this.form.status=this.$route.params.data.status;
        this.form.code=this.$route.params.data.code;
        this.form.description=this.$route.params.data.description;
        this.form.id=this.$route.params.data.id;
        $('#qualification_type').val(this.$route.params.data.quialificationtype.id);
        $('#qualification_level').val(this.$route.params.data.quialificationlevel.id);
    },

}
</script>
