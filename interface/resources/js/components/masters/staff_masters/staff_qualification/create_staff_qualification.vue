<template>
    <div>
        <form class="bootbox-form">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Qualification Type:<span class="text-danger">*</span></label> 
                        <select class="form-control" id="parent_field" v-model="form.parent_field" :class="{ 'is-invalid': form.errors.has('parent_field') }">
                            <option v-for="(item, index) in qualificationtypeList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select> 
                        <has-error :form="form" field="parent_field"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Qualification Level:<span class="text-danger">*</span></label>
                        <select class="form-control" id="parent_field1" v-model="form.parent_field1" :class="{ 'is-invalid': form.errors.has('parent_field1') }">
                            <option v-for="(item, index) in qualificationlevelList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select> 
                        <has-error :form="form" field="parent_field1"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Qualification:<span class="text-danger">*</span></label>
                        <input class="form-control" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" id="name" @change="remove_err('name')" type="text">
                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Code:<span class="text-danger">*</span></label> 
                        <input class="form-control" v-model="form.code" :class="{ 'is-invalid': form.errors.has('code') }" id="code" @change="remove_err('code')" type="text">
                        <has-error :form="form" field="code"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
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
                parent_field:'',
                parent_field1:'',
                name: '',
                code:'',
                status: 1,
                record_type:'staff_qualification',
                action_type:'add',
            })
        }
    },
    methods: {
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },
        loadQualificationTypeList(uri = 'masters/load_staff_masters/active_qualification_type_List'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.qualificationtypeList =  data.data.data;
            })
            .catch(function (error){
                console.log("Error......"+error)
            });
        },
        
        loadQualificationLevelList(uri = 'masters/load_staff_masters/active_qualification_level_List'){
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
                this.form.status= 1;
            }
            if(type=="save"){
                this.form.post('/masters/save_sfatt_masters',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/list_staff_qualification');
                })
                .catch((error) => {
                    console.log("Error......"+error)
                })
            }
		}, 
    },
    mounted(){ 
        this.loadQualificationTypeList();
        this.loadQualificationLevelList();
    },
    
}
</script>