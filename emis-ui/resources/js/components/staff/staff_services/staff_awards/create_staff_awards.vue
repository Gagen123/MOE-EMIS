<template>
    <div>
        <form>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="mb-0.5">Staff:<i class="text-danger">*</i></label>
                    <select v-model="award_form.staff" :class="{ 'is-invalid select2 select2-hidden-accessible': award_form.errors.has('staff') }" class="form-control select2" name="staff" id="staff">
                        <option v-for="(item, index) in staffList" :key="index" v-bind:value="item.id">{{ item.cid_work_permit }} : {{ item.name }}, {{item.position_title.name}}</option>
                    </select>
                    <has-error :form="award_form" field="staff"></has-error>
                </div> 
            </div>
            <div class="row form-group">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Award Category:<span class="text-danger">*</span></label> 
                    <select class="form-control select2" id="award_category" v-model="award_form.award_category" :class="{ 'is-invalid select2 select2-hidden-accessible': award_form.errors.has('award_category') }">
                        <option v-for="(item, index) in awardCategoryList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select> 
                    <has-error :form="award_form" field="award_category"></has-error>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Aardw Type:<span class="text-danger">*</span></label>
                     <select v-model="award_form.award_type_id" :class="{ 'is-invalid select2 select2-hidden-accessible': award_form.errors.has('award_type_id') }" class="form-control select2" name="award_type_id" id="award_type_id">
                        <option v-for="(item, index) in awardTypeList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <has-error :form="award_form" field="award_type_id"></has-error>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="mb-1">Award Given By:<i class="text-danger">*</i></label>
                        <input type="text" @change="remove_error('award_given_by')" v-model="award_form.award_given_by" :class="{ 'is-invalid': award_form.errors.has('award_given_by') }" class="form-control" name="award_given_by" id="award_given_by" >
                        <has-error :form="award_form" field="award_given_by"></has-error>
                    </div> 
                </div>
            </div>
            
            <div class="row form-group">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Place:<span class="text-danger">*</span></label> 
                    <input class="form-control" v-model="award_form.place" :class="{ 'is-invalid': award_form.errors.has('place') }" id="place" @change="remove_err('place')" type="text">
                    <has-error :form="award_form" field="place"></has-error>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Date:<span class="text-danger">*</span></label> 
                    <input class="form-control" v-model="award_form.date" :class="{ 'is-invalid': award_form.errors.has('date') }" id="date" @change="remove_err('date')" type="date">
                    <has-error :form="award_form" field="date"></has-error>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="mb-0.5">Remarks:</label>
                    <textarea @change="remove_error('remarks')" class="form-control" v-model="award_form.remarks" :class="{ 'is-invalid': award_form.errors.has('remarks') }" name="remarks" id="remarks"></textarea>
                    <has-error :form="award_form" field="remarks"></has-error>
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
            staffList:[],
            awardCategoryList:[],
            awardTypeList:[],
            id:'',
            award_form: new form({
                id:'',
                staff: '',
                award_given_by: '',
                award_category:'',
                award_type_id: '',
                place: '',
                date: '',
                remarks:'',
                action_type:'add'
            }),
        }
    },
    methods: {
        loadStaffList(uri='loadCommons/loadStaffList/userdzongkhagwise/NA'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.staffList =  data;
            })
            .catch(function (error){
                console.log("Error: "+error)
            });
        },
        loadActiveAwardList(uri="masters/loadStaffMasters/all_active_staff_award_category_List"){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.awardCategoryList =  data;
            })
            .catch(function (error) {
                console.log("Error:"+error)
            });
        },
        loadAwardType(id){
            let uri="masters/loadStaffDropdownMasters/StaffAwardType/"+id;
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.awardTypeList =  data;
            })
            .catch(function (error) {
                console.log("Error:"+error)
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
                this.award_form.staff= '';
                this.award_form.award_given_by='';
                this.award_form.award_type_id= '';
                $('#award_category').val('');
                $('#award_type_id').val('');
                this.award_form.place= '';
                this.award_form.date= '';
                this.award_form.remarks='';
                this.award_form.status= 1;
            }
            if(type=="save"){
                this.award_form.post('staff/staffServices/saveStaffAward')
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/student_awards_list');
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
            if(id=="award_category"){
                this.award_form.award_category=$('#award_category').val();
                this.loadAwardType($('#award_category').val());
            }
            if(id=="award_type_id"){
                this.award_form.award_type_id=$('#award_type_id').val();
            }
            if(id=="staff"){
                this.award_form.staff=$('#staff').val();
            }
            
        },
        
        
    },
     mounted(){
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

        this.loadStaffList();
        this.loadActiveAwardList();
    },
    
}
</script>