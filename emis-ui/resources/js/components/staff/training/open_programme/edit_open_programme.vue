<template>
    <div>
        <form class="bootbox-form">
            <div class="card-body">
                <search />
                <div class="form-group row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label class="mb-0.5">Staff:<i class="text-danger">*</i></label>
                        <select v-model="form.staff" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('staff') }" class="form-control select2" name="staff" id="staff">
                            <option v-for="(item, index) in staffList" :key="index" v-bind:value="item.id">{{ item.emp_id }} : {{ item.name }}, {{item.position_title_name}}, {{item.positionlevel}}</option>
                        </select>
                        <has-error :form="form" field="staff"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>From date:<span class="text-danger">*</span></label>
                        <input type="text" autocomplete="off" class="form-control popupDatepicker" @change="remove_error('from_date')" :class="{ 'is-invalid' :form.errors.has('from_date') }" id="from_date">
                        <has-error :form="form" field="from_date"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>To date:<span class="text-danger">*</span></label>
                        <input type="text" autocomplete="off" class="form-control popupDatepicker" @change="remove_error('to_date')" :class="{ 'is-invalid' :form.errors.has('to_date') }" id="to_date">
                        <has-error :form="form" field="to_date"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>Remarks:</label>
                        <textarea class="form-control" @change="remove_error('remarks')" v-model="form.remarks" :class="{ 'is-invalid': form.errors.has('remarks') }" id="remarks"></textarea>
                        <has-error :form="form" field="remarks"></has-error>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
    </div>
</template>
<script>
import search from "../../searchpage.vue";
export default {
    components: {
        search,
    },
    data(){
        return {
            staffList:[],
            form: new form({
                id: '',
                staff:'',
                from_date: '',
                to_date:'',
                status: 1,
                remarks:'',
                model:'hr_development_masters___OpenProgramme',
                action_type:'edit',
            })
        }
    },
    methods: {
		formaction: function(type){
            if(type=="save"){
                Swal.fire({
                    text: "Are you sure you wish to save this configuration ?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    cancelButtonText:'No',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        this.form.from_date= this.formatYYYYMMDD($('#from_date').val());
                        this.form.to_date= this.formatYYYYMMDD($('#to_date').val());
                        this.form.post('/staff/hrdevelopment/saveprogramOpenDetail')
                        .then((response) => {
                            if(response!=null && response!=""){
                                console.log(response)
                                if(JSON.stringify(response.data).includes('This person doesnot have valid user')){
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: response,
                                    })
                                }else{
                                    Swal.fire(
                                        'Success!',
                                        'Details has been saved successfully.',
                                        'success',
                                    );
                                    this.$router.push('/list_open_programme');
                                }
                            }
                        })
                        .catch((error) => {
                            console.log("Errorss:"+error);
                        });
                    }
                });
            }
		},
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="staff"){
                this.form.staff=$('#staff').val();
            }
            if(id=="org_id"){
                this.staffList = [];
                this.staffList=await this.staffOrgwise($('#org_id').val());
            }
        },
        async loadRespectiveDataData(org_id){
            this.staffList = [];
            this.staffList=await this.staffOrgwise(org_id);
        },
    },
    created() {
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
        Fire.$on('loadRespectiveDataData',(id)=>{
            this.loadRespectiveDataData(id);
        });
        // console.log(this.$route.params.data);
        this.form.id=this.$route.params.data.id;
        let data='<option value="'+this.$route.params.data.StaffID+'">'+this.$route.params.data.staff_name+'</option>';
        $('#staff').append(data);
        this.form.staff=this.$route.params.data.StaffID;
        $('#staff').val(this.$route.params.data.StaffID).trigger('change');
        this.form.from_date=this.$route.params.data.start_date;
        $('#from_date').val(this.reverseDate1(this.$route.params.data.start_date));
        this.form.to_date=this.$route.params.data.end_date;
        $('#to_date').val(this.reverseDate1(this.$route.params.data.end_date));
        this.form.remarks=this.$route.params.data.remarks;
    },
}
</script>
