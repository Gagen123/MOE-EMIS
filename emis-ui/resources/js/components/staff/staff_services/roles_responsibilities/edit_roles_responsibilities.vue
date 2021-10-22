<template>
    <div>
        <form>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="mb-0.5">Staff:</label>
                    <!-- <select v-model="resp_form.staff" :class="{ 'is-invalid select2 select2-hidden-accessible': resp_form.errors.has('staff') }" class="form-control select2" name="staff" id="staff">
                        <option v-for="(item, index) in staffList" :key="index" v-bind:value="item.id">{{ item.cid_work_permit }} : {{ item.name }}, {{item.position_title.name}}</option>
                    </select>
                    <has-error :form="resp_form" field="staff"></has-error> -->
                    {{staffdet}}
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Responsibility:<span class="text-danger">*</span></label>
                    <select class="form-control select2" id="responsibility" v-model="resp_form.responsibility" :class="{ 'is-invalid select2 select2-hidden-accessible': resp_form.errors.has('responsibility') }">
                        <option v-for="(item, index) in responsibilityList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <has-error :form="resp_form" field="responsibility"></has-error>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Year:<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" v-model="resp_form.year" :class="{ 'is-invalid': resp_form.errors.has('year') }">
                    <has-error :form="resp_form" field="year"></has-error>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="mb-0.5">Remarks:</label>
                    <textarea @change="remove_error('remarks')" class="form-control" v-model="resp_form.remarks" :class="{ 'is-invalid': resp_form.errors.has('remarks') }" name="remarks" id="remarks"></textarea>
                    <has-error :form="resp_form" field="remarks"></has-error>
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
            screen_id:'',
            staffList:[],
            responsibilityList:[],
            staffdet:'',
            id:'',
            resp_form: new form({
                id:'',
                staff: '',
                year:'',
                responsibility:'',
                remarks:'',
                action_type:'edit',
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
        formaction: function(type){
            if(type=="reset"){
                this.resp_form.staff= '';
                this.resp_form.responsibility='';
                this.resp_form.remarks='';
                this.resp_form.status= 1;
            }
            if(type=="save"){
                Swal.fire({
                    text: "Are you sure you wish to save this details ?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    cancelButtonText: 'No',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        this.resp_form.post('staff/staffServices/saveStaffResponsibility')
                        .then(() => {
                            Toast.fire({
                                icon: 'success',
                                title: 'Details added successfully'
                            })
                            this.$router.push({name:'list_roles_responsibilities',query: {data:this.screen_id}});
                        })
                        .catch(() => {
                            console.log("Error:")
                        })
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
                this.resp_form.staff=$('#staff').val();
            }
            if(id=="responsibility"){
                this.resp_form.responsibility=$('#responsibility').val();
            }

        },

    },
    async mounted(){
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
        this.responsibilityList =  await this.loadstaffMasters('active','StaResponsiblity');
        this.resp_form.id=this.$route.params.data.id;
        this.resp_form.staff=this.$route.params.data.staff_id;
        this.resp_form.year=this.$route.params.data.year;
        this.staffdet=this.$route.params.data.staff.name;
        this.resp_form.responsibility=this.$route.params.data.responsibility;
        this.resp_form.remarks=this.$route.params.data.remarks;
    },
}
</script>
