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
                        <label>Master/Compulsory Subject<span class="text-danger">*</span></label> 
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
            subjectList:[],
            form: new form({
                name: '',
                code: '',
                subjecttype:'',
                displayorder: '',
                description: '',
                status: 1,
                record_type:'teaching_subject',
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
		formaction: function(type){
            if(type=="reset"){
                this.form.name= '';
                this.form.code = '';
                this.form.subjecttype = '';
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
        loadsubjectgroupList(uri = 'masters/loadAcademicMasters/all_subject'){
            axios.get(uri)
            .then(response => {
                let data = response
                this.subjectList =  data.data.data;
            })
            .catch(function (error){
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        applyselect(){
             if(!$('#subjecttype').attr('class').includes('select2-hidden-accessible')){
                $('#subjecttype').addClass('select2-hidden-accessible');
            }
        },
        changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
          
            if(id=="subjecttype"){
                this.form.subjecttype=$('#subjecttype').val();
            }
        
           
        },
    },
    mounted(){
        this.loadsubjectgroupList();
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
    }
}
</script>