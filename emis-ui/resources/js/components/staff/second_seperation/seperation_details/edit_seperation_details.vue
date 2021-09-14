<template>
    <div>
        <form>
            <div class="form-group row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <label class="mb-0.5">Staff:<i class="text-danger">*</i></label><br>
                    <input type="text" class="form-control" name="staff" readonly id="staff" v-model="form.staffname">
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <label class="mb-0.5">Secondment type:<i class="text-danger">*</i></label><br>
                    <select @change="remove_error('seperation_type')" v-model="form.seperation_type" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('seperation_type') }" class="form-control select2" name="seperation_type" id="seperation_type">
                        <option value=""> --Select--</option>
                        <option v-for="(item, index) in seperationList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <has-error :form="form" field="seperation_type"></has-error>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-1">From Date:<i class="text-danger">*</i></label>
                    <input type="date" @change="remove_error('start_date')" v-model="form.start_date" :class="{ 'is-invalid': form.errors.has('start_date') }" class="form-control" name="start_date" id="start_date">
                    <has-error :form="form" field="start_date"></has-error>
                </div>
                <!-- <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-1">To Date:<i class="text-danger">*</i></label>
                    <input type="date" @change="remove_error('end_date')" v-model="form.end_date" :class="{ 'is-invalid': form.errors.has('end_date') }" class="form-control" name="end_date" id="end_date">
                    <has-error :form="form" field="end_date"></has-error>
                </div> -->
            </div>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
            seperationList:[],
            cureerstageList:[],
            positiontitleList:{},
            position_title:'',name:'',emp_id:'',
            form: new form({
                id:'',
                staff_id:'',
                staffname:'',
                seperation_type: '',
                start_date:'',
                end_date:'',
                remarks:'',
                model:'Seperation',
                action_type:'edit'
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
                this.form.staff_id= '';
                this.form.seperation_type= '';
                this.form.start_date= '';
                this.form.end_date= '';
                this.form.remarks= '';
                $('#staff_id').val('').trigger('change');
            }
            if(type=="save"){
                this.form.post('staff/staffSepSecController/saveSecondmentSeperation')
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details updaetd successfully'
                    })
                    this.$router.push('/list_seperation_details');
                })
                .catch(() =>{
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

        loadactiveseperationListList(uri="staff/loadStaffMasters/active/SeperationMaster"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.seperationList=data.data.data;
            })
            .catch(function (error) {
                console.log(error);
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

        this.loadactiveseperationListList();
        this.form.staffname=this.$route.query.data.staff_detials.name;
        this.form.seperation_type=this.$route.query.data.seperation_type_id;
        this.form.from_date=this.$route.query.data.from_date;
        this.form.to_date=this.$route.query.data.to_date;
        this.form.id=this.$route.query.data.id;
        this.form.staff_id=this.$route.query.data.staff_id;
        this.form.remarks=this.$route.query.data.remarks;
    },
}
</script>
