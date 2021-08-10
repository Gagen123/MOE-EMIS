<template>
    <div>
        <form>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="mb-0.5">Staff: {{staffdet}}</label>
                    <!-- <select v-model="resp_form.staff" :class="{ 'is-invalid select2 select2-hidden-accessible': resp_form.errors.has('staff') }" class="form-control select2" name="staff" id="staff">
                        <option v-for="(item, index) in staffList" :key="index" v-bind:value="item.id">{{ item.cid_work_permit }} : {{ item.name }}, {{item.position_title.name}}</option>
                    </select>
                    <has-error :form="resp_form" field="staff"></has-error> -->
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Offence Date:<span class="text-danger">*</span></label>
                    <input class="form-control" v-model="resp_form.offence_date" :class="{ 'is-invalid': resp_form.errors.has('offence_date') }" id="date" @change="remove_error('offence_date')" type="date">
                    <has-error :form="resp_form" field="offence_date"></has-error>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Offence Type:<span class="text-danger">*</span></label>
                    <select class="form-control select2" id="offence_type_id" v-model="resp_form.offence_type_id" :class="{ 'is-invalid select2 select2-hidden-accessible': resp_form.errors.has('offence_type_id') }">
                        <option v-for="(item, index) in offenceTypeList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <has-error :form="resp_form" field="offence_type_id"></has-error>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Offence severity:<span class="text-danger">*</span></label>
                    <select class="form-control select2" id="offence_severity_id" v-model="resp_form.offence_severity_id" :class="{ 'is-invalid select2 select2-hidden-accessible': resp_form.errors.has('offence_severity_id') }">
                        <option v-for="(item, index) in offenceSeverityList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <has-error :form="resp_form" field="offence_type_id"></has-error>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="mb-0.5">Description of Offence:</label>
                    <textarea @change="remove_error('offence_description')" class="form-control" v-model="resp_form.offence_description" :class="{ 'is-invalid': resp_form.errors.has('offence_description') }" name="offence_description" id="offence_description"></textarea>
                    <has-error :form="resp_form" field="offence_description"></has-error>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Action Taken:<span class="text-danger">*</span></label>
                    <select class="form-control select2" id="offence_action_id" v-model="resp_form.offence_action_id" :class="{ 'is-invalid select2 select2-hidden-accessible': resp_form.errors.has('offence_action_id') }">
                        <option v-for="(item, index) in offenceActionList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <has-error :form="resp_form" field="offence_action_id"></has-error>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <label class="mb-0.5">Description of Action Taken:</label>
                    <textarea @change="remove_error('description_on_action')" class="form-control" v-model="resp_form.description_on_action" :class="{ 'is-invalid': resp_form.errors.has('description_on_action') }" name="description_on_action" id="description_on_action"></textarea>
                    <has-error :form="resp_form" field="description_on_action"></has-error>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="button" @click="formaction('reset')" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-redo"></i> Reset</button>
                <!-- <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button> -->
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
            offenceTypeList:[],
            offenceSeverityList:[],
            offenceActionList:[],
            staffdet:'',
            resp_form: new form({
                id:'',
                staff: '',
                offence_date:'',
                offence_type_id:'',
                offence_severity_id:'',
                offence_action_id:'',
                offence_description:'',
                description_on_action:'',
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
        loadoffenceTypeList(type){
            axios.get("masters/loadStaffMasters/"+type)
            .then(response => {
                let data = response.data.data;
                if(type=="all_active_staff_offence_type_List"){
                    this.offenceTypeList =  data;
                }
                if(type=="all_active_staff_offence_severity_List"){
                    this.offenceSeverityList =  data;
                }
                if(type=="all_active_staff_offence_action_List"){
                    this.offenceActionList =  data;
                }
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
                this.resp_form.staff= '';
                this.resp_form.offence_type_id='';
                this.resp_form.offence_severity_id='';
                this.resp_form.offence_action_id= '';
                this.resp_form.offence_description= '';
                this.resp_form.description_on_action= '';
            }
            if(type=="save"){
                this.resp_form.post('staff/staffServices/saveStaffDisaplinary')
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    });
                    this.applyselect();
                    this.$router.push({name:'list_staff_disciplinary',query: {data:this.screen_id}});
                })
                .catch(() => {
                    console.log("Error:")
                })
            }
		},
        applyselect(){
            if(!$('#staff').attr('class').includes('select2-hidden-accessible')){
                $('#staff').addClass('select2-hidden-accessible');
            }
            if(!$('#offence_type_id').attr('class').includes('select2-hidden-accessible')){
                $('#offence_type_id').addClass('select2-hidden-accessible');
            }
            if(!$('#offence_severity_id').attr('class').includes('select2-hidden-accessible')){
                $('#offence_severity_id').addClass('select2-hidden-accessible');
            }
            if(!$('#offence_action_id').attr('class').includes('select2-hidden-accessible')){
                $('#offence_action_id').addClass('select2-hidden-accessible');
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
            if(id=="offence_type_id"){
                this.resp_form.offence_type_id=$('#offence_type_id').val();
            }
            if(id=="offence_severity_id"){
                this.resp_form.offence_severity_id=$('#offence_severity_id').val();
            }
            if(id=="offence_action_id"){
                this.resp_form.offence_action_id=$('#offence_action_id').val();
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
        this.loadoffenceTypeList('all_active_staff_offence_type_List');
        this.loadoffenceTypeList('all_active_staff_offence_severity_List');
        this.loadoffenceTypeList('all_active_staff_offence_action_List');

        this.resp_form.id=this.$route.params.data.id;
        this.resp_form.staff=this.$route.params.data.staff_id;
        this.staffdet=this.$route.params.data.staff.name;
        this.resp_form.offence_date=this.$route.params.data.offence_date;
        this.resp_form.offence_type_id=this.$route.params.data.offence_type_id;
        this.resp_form.offence_severity_id=this.$route.params.data.offence_severity_id;
        this.resp_form.offence_action_id=this.$route.params.data.offence_action_id;
        this.resp_form.offence_description=this.$route.params.data.offence_description;
        this.resp_form.description_on_action=this.$route.params.data.description_on_action;
    },
}
</script>
