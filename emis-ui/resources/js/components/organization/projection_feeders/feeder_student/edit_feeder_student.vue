<template>
    <div>
        <form>
            <div class="form-group" id="main_form">
                <h6><u>Student Details</u></h6><br>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label class="required" >Name of Student :</label>
                        <label class="text-primary">{{this.StdName}}</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label class="required" >Student Code: </label>
                        <label class="text-primary">{{this.StdCode}}</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                  <label>Select Parent School:<span class="text-danger">*</span></label>
                     <select v-model="form.parent_school" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('parent_school') }" class="form-control " name="parent_school" id="parent_school">
                        <option value=""> -- Select-- </option>
                        <option v-for="(item, index) in parentSchool" :key="index" v-bind:value="item.parent_school">{{ item.parent_name }}</option>
                     </select>
                    <has-error :form="form" field="parent_school"></has-error>
                    <span class="text-danger" id="parent_school_err"></span>
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
            parentSchool:[],
            StdName:'',
            StdCode:'',
            form: new form({
                id:'',
                parent_school:'',
                action_type:'edit',
            }),
        }
    },
    methods: {
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },
        formaction: function(type){
            if(type=="reset"){
                this.form.student= '';
                this.form.remarks='';
                this.form.status= 1;
            }
            if(type=="save"){
                this.form.post('/organization/editFeederStudents',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/list_feeder_student');
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		},
        loadParentSchool(uri="organization/listParentSchool"){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.parentSchool = data;
            })
        },
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
           
        },
        
    },
     mounted() {
        $('[data-toggle="tooltip"]').tooltip();
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
        this.loadParentSchool();
        this.form.id=this.$route.params.data.id;
        this.form.parent_school=this.$route.params.data.parentschool;
        this.StdName=this.$route.params.data.StdName;
        this.StdCode=this.$route.params.data.StdCode;
    },
    
}
</script>