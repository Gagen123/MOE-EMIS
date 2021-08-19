<template>
    <div>
        <form>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Emp Id:</label><br>
                    {{emp_id}}
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Name:</label><br>
                    {{name}}
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Position Title:</label><br>
                    {{position_title}}
                </div>
            </div>
            <hr>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Contact No:</label>
                    <input type="number" @change="remove_error('contact_no')" v-model="form.contact_no" :class="{ 'is-invalid': form.errors.has('contact_no') }" class="form-control" name="contact_no" id="contact_no" max='8' min='8' />
                    <has-error :form="form" field="contact_no"></has-error>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Email:</label>
                    <input type="text" @change="remove_error('email')" v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" name="email" id="email" >
                    <has-error :form="form" field="email"></has-error>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Alternative Email:</label>
                    <input type="text" @change="remove_error('alternative_email')" v-model="form.alternative_email" :class="{ 'is-invalid': form.errors.has('alternative_email') }" class="form-control" name="alternative_email" id="alternative_email" >
                    <has-error :form="form" field="alternative_email"></has-error>
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
            cureerstageArray:{},
            cureerstageList:[],
            positiontitleList:{},
            position_title:'',name:'',emp_id:'',
            form: new form({
                id:'',
                alternative_email:'',
                email: '',
                contact_no:'',
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
                this.form.currier_stage= '';
                $('#currier_stage').val('').trigger('change');
                this.form.remarks= '';
            }
            if(type=="save"){
                this.form.post('staff/staffUpdateController/saveStaffContact')
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details updaetd successfully'
                    })
                    this.$router.push('/list_contact_details');
                })
                .catch(() => {
                    console.log("Error:")
                })
            }
		},
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="currier_stage"){
                this.form.currier_stage=$('#currier_stage').val();
            }

        },

        loadpositionTitleList(positionid){
            let uri = 'staff/loadStaffMasters/active/PositionTitle';
            axios.get(uri)
            .then(response =>{
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.positiontitleList[data.data.data[i].id] = data.data.data[i].name;
                }
                this.position_title=this.positiontitleList[positionid];
            })
            .catch(function (error){
                console.log('Error: '+error);
            });
        },
    },
     mounted(){
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id'));
        });

        Fire.$on('changefunction',(id)=>{
            this.changefunction(id);
        });

        this.loadpositionTitleList(this.$route.query.data.position_title_id);
        this.name=this.$route.query.data.name;
        this.form.id=this.$route.query.data.id;
        this.emp_id=this.$route.query.data.emp_id;
        this.form.alternative_email=this.$route.query.data.alternative_email;
        this.form.contact_no=this.$route.query.data.contact_no;
        this.form.email=this.$route.query.data.email;
    },
}
</script>
