<template>
    <div>
        <form>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Disaster Type:<i class="text-danger">*</i></label>
                    <select v-model="form.diaster_id" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('diaster_id') }" class="form-control select2" name="diaster_id" id="diaster_id">
                        <option v-for="(item, index) in dataList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <has-error :form="form" field="diaster_id"></has-error>
                </div> 
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="mb-1">Name:<i class="text-danger">*</i></label>
                        <input type="text" @change="remove_error('name')" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" name="name" id="name" >
                        <has-error :form="form" field="name"></has-error>
                    </div> 
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="mb-1">CID:<i class="text-danger">*</i></label>
                        <input type="text" @change="remove_error('cid')" v-model="form.cid" :class="{ 'is-invalid': form.errors.has('cid') }" class="form-control" name="cid" id="cid" >
                        <has-error :form="form" field="cid"></has-error>
                    </div> 
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="mb-1">Email:<i class="text-danger">*</i></label>
                        <input type="text" @change="remove_error('email')" v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" name="email" id="email" >
                        <has-error :form="form" field="email"></has-error>
                    </div> 
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="mb-1">Contact No:<i class="text-danger">*</i></label>
                        <input type="text" @change="remove_error('contact_no')" v-model="form.contact_no" :class="{ 'is-invalid': form.errors.has('contact_no') }" class="form-control" name="contact_no" id="contact_no" >
                        <has-error :form="form" field="contact_no"></has-error>
                    </div> 
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="mb-1">Serving As:<i class="text-danger">*</i></label>
                        <input type="text" @change="remove_error('servining_as')" v-model="form.servining_as" :class="{ 'is-invalid': form.errors.has('servining_as') }" class="form-control" name="servining_as" id="servining_as" >
                        <has-error :form="form" field="servining_as"></has-error>
                    </div> 
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <label class="mb-0.5">Place of Work and Address:</label>
                    <textarea @change="remove_error('address')" class="form-control" v-model="form.address" :class="{ 'is-invalid': form.errors.has('address') }" name="address" id="address"></textarea>
                    <has-error :form="form" field="address"></has-error>
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
            org_id:'2fea1ad2-824b-434a-a608-614a482e66c1',

            form: new form({
                id:'',
                name: '',
                serving_as: '',
                address: '',
                cid: '',
                contact_no: '',
                email:'',
                serving_as:'',
                action_type:'add'
            }),
        }
    },
    methods: {
        //need to get the organisation id and pass it as a parameter
        
        loadDataList(uri='organization/loadMasters'){
            axios.get(uri)
            .then(response => {
                let data = response;
                console.log(data);
                this.dataList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
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
                this.form.student= '';
                this.form.remarks='';
                this.form.status= 1;
            }
            if(type=="save"){
                this.form.post('/organization/saveDisasterInformation',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/list_disasters_information');
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
            if(id=="student"){
                this.form.student=$('#student').val();
            }
            if(id=="award_type_id"){
                this.form.award_type_id=$('#award_type_id').val();
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

        this.loadStudentList();
    },
    
}
</script>