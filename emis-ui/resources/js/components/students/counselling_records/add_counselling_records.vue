<template>
    <div>
        <form>
            <div class="form-group row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <label class="mb-1">Counselling Type:<i class="text-danger">*</i></label>
                    <select v-model="form.counselling_type" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('counselling_type') }" class="form-control select2" name="counselling_type" id="counselling_type">
                        <option v-for="(item, index) in counsellingTypeList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <has-error :form="form" field="counselling_type"></has-error>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Number of Studnets:<span class="text-danger">*</span></label> 
                    <input class="form-control" v-model="form.number" :class="{ 'is-invalid': form.errors.has('number') }" id="number" @change="remove_err('number')" type="number">
                    <has-error :form="form" field="number"></has-error>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <label class="mb-0.5">Remarks:</label>
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

            org_id:'2fea1ad2-824b-434a-a608-614a482e66c1',

            form: new form({
                id:'',
                remarks: '',
                counselling_type: '',
                number: '',
               // action_type:'add'
            }),
        }
    },
    methods: {
        //need to get the organisation id and pass it as a parameter
        
        // loadList(uri='organization/loadVisitorInformation'){
        //     axios.get(uri)
        //     .then(response => {
        //         let data = response;
        //         console.log(data);
        //         this.dataList =  data.data.data;
        //     })
        //     .catch(function (error) {
        //         console.log("Error......"+error)
        //     });
        // },
        getCounsellingTypeDropdown(uri = '/students/getCounsellingTypeDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.counsellingTypeList = data;
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
        },
    },
     mounted() {
        this.getCounsellingTypeDropdown();
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