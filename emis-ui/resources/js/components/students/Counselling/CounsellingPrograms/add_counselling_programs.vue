<template>
    <div>
        <form>
            <div class="form-group row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <label class="mb-0.5">Top Five Common Issues that came as a result of the Needs Assessment Conducted:</label>
                    <textarea @change="remove_error('remarks')" class="form-control" v-model="form.remarks" :class="{ 'is-invalid': form.errors.has('remarks') }" name="remarks" id="remarks"></textarea>
                    <has-error :form="form" field="remarks"></has-error>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <label class="mb-0.5">Comprehensive School Guidance and Counselling Programs and Activities Conducted:</label>
                    <textarea @change="remove_error('remarks')" class="form-control" v-model="form.remarks" :class="{ 'is-invalid': form.errors.has('remarks') }" name="remarks" id="remarks"></textarea>
                    <has-error :form="form" field="remarks"></has-error>
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
                remarks: '',
                counselling_type: '',
                class_range:'',
                age_range:'',
                male: '',
                female:'',
                action_type:'add'
            }),
        }
    },
    methods: {
        getCounsellingTypeDropdown(uri = '/students/getCounsellingTypeDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.counsellingTypeList = data;
            });
        },
        getCounsellingAgeRangeDropdown(uri = '/masters/loadActiveStudentMasters/counselling_age_range'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.counsellingAgeList = data;
            });
        },
        getCounsellingClassRangeDropdown(uri = '/masters/loadActiveStudentMasters/counselling_class_range'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.counsellingClassList = data;
            });
        },
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
                this.form.post('/students/saveCounsellingInformation',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/list_counselling_records');
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
            if(id=="age_range"){
                this.form.age_range=$('#age_range').val();
            }
            if(id=="class_range"){
                this.form.class_range=$('#class_range').val();
            }
        },
    },
     mounted() {
        this.getCounsellingTypeDropdown();
        this.getCounsellingAgeRangeDropdown();
        this.getCounsellingClassRangeDropdown();
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

        // this.loadMasterList();
    },
    
}
</script>