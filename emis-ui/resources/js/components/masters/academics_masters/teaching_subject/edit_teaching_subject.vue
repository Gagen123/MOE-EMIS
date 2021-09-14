<template>
    <div>
        <form class="bootbox-form" autocomplete="off">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Subject<span class="text-danger">*</span></label> 
                        <select name="subjecttype" class="form-control select2" v-model="form.subjecttype" :class="{ 'is-invalid': form.errors.has('subjecttype') }" id="subjecttype" @change="remove_err('subjecttype')">
                            <option value="">--- Please Select ---</option>
                            <option v-for="(item, index) in subjectList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Subject Name<span class="text-danger">*</span></label> 
                        <input class="form-control form-control-sm" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" id="name" @change="remove_err('name')" type="text">
                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Subject Code<span class="text-danger">*</span></label> 
                        <input class="form-control form-control-sm" v-model="form.code" :class="{ 'is-invalid': form.errors.has('code') }" id="code" @change="remove_err('code')" type="text">
                        <has-error :form="form" field="code"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Display Order<span class="text-danger">*</span></label> 
                        <input class="form-control form-control-sm" v-model="form.displayorder" :class="{ 'is-invalid': form.errors.has('displayorder') }" id="displayorder" @change="remove_err('displayorder')" type="text">
                        <has-error :form="form" field="displayorder"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Description<span class="text-danger">*</span></label> 
                        <input class="form-control form-control-sm" v-model="form.description" :class="{ 'is-invalid': form.errors.has('description') }" id="description" @change="remove_err('description')" type="text">
                        <has-error :form="form" field="description"></has-error>
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
    data(){
        return {
            subject_category_list:[],
            form: new form({
                name: '',
                code: '',
                subjecttype:'',
                displayorder: '',
                description: '',
                status: 1,
                record_type:'teaching_subject',
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
		formaction: function(type){
            if(type=="reset"){
                this.form.name= '';
                this.form.code = '';
                this.form.subjecttype='',
                this.form.displayorder = '';
                this.form.description = '';
                this.form.status= 1;
            }
            if(type=="save"){
                this.form.post('/masters/saveAcademicMasters',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/list_teaching_subject');
                })
                .catch(() => {
                    console.log("Error.")
                })
            }
		}, 
    },
    created() {
        this.form.name=this.$route.params.data.name;
        this.form.subjecttype=this.$route.params.data.subjecttype;
        this.form.code=this.$route.params.data.code;
        this.form.displayorder=this.$route.params.data.displayorder;
        this.form.description=this.$route.params.data.description;
        this.form.status=this.$route.params.data.status;
        this.form.id=this.$route.params.data.id;
    },
}
</script>