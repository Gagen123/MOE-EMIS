<template>
    <div>
        <form>
            <div class="form-group row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <label class="mb-0.5">Top Five Common Issues that came as a result of the Needs Assessment Conducted:</label>
                    <textarea @change="remove_error('issues')" class="form-control" v-model="form.issues" :class="{ 'is-invalid': form.errors.has('issues') }" name="issues" id="issues"></textarea>
                    <has-error :form="form" field="issues"></has-error>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <label class="mb-0.5">Comprehensive School Guidance and Counselling Programs and Activities Conducted:</label>
                    <textarea @change="remove_error('activities')" class="form-control" v-model="form.activities" :class="{ 'is-invalid': form.errors.has('activities') }" name="activities" id="activities"></textarea>
                    <has-error :form="form" field="activities"></has-error>
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
            dataList:[],
            counsellingTypeList:[],
            counsellingAgeList:[],
            counsellingClassList:[],

            org_id:'2fea1ad2-824b-434a-a608-614a482e66c1',

            form: new form({
                id:'',
                activities: '',
                issues: '',
                action_type:'add'
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
                this.form.counselling_type= '';
                this.form.number='';
                this.form.remarks= '';
            }
            if(type=="save"){
                this.form.post('/students/saveCounsellingProgram',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/list_counselling_programs');
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		},
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="counselling_type"){
                this.form.counselling_type=$('#counselling_type').val();
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

    },
    
}
</script>