<template>
    <div>
        <form class="bootbox-form" id="dzongkhagId">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Major Group:<span class="text-danger">*</span></label> 
                        <select class="form-control select2" id="gr_parent_field" v-model="form.gr_parent_field" :class="{ 'is-invalid': form.errors.has('gr_parent_field') }">
                            <option v-for="(item, index) in groupList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select> 
                        <has-error :form="form" field="gr_parent_field"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Sub Major Group Name:<span class="text-danger">*</span></label> 
                        <select class="form-control select2" id="parent_field" v-model="form.parent_field" :class="{ 'is-invalid': form.errors.has('parent_field') }">
                            <option v-for="(item, index) in subgroupList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select> 
                        <has-error :form="form" field="parent_field"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Position Level:<span class="text-danger">*</span></label>
                         <select class="form-control select2" id="position_level" v-model="form.position_level" :class="{ 'is-invalid': form.errors.has('position_level') }">
                            <option v-for="(item, index) in positionLevelList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select> 
                        <has-error :form="form" field="position_level"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Position Title:<span class="text-danger">*</span></label>
                        <input class="form-control" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" id="name" @change="remove_err('name')" type="text">
                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Code:<span class="text-danger">*</span></label> 
                        <input class="form-control" v-model="form.code" readonly :class="{ 'is-invalid': form.errors.has('code') }" id="code" @change="remove_err('code')" type="text">
                        <has-error :form="form" field="code"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="required">Status:</label>
                        <br>
                        <label><input v-model="form.status"  type="radio" value="1" /> Active</label>
                        <label><input v-model="form.status"  type="radio" value="0" /> Inactive</label>
                    </div>
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
    data() {
        return {
            groupList:[],
            subgroupList:[],
            positionLevelList:[],
            form: new form({
                id: '',
                gr_parent_field:'',
                parent_field:'',
                position_level:'',
                name: '',
                code:'',
                status: 1,
                record_type:'position_title',
                action_type:'edit',
            })
        }
    },
    methods: {
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },
        loadMajorGroupList(uri = 'masters/loadStaffMasters/all_active_staff_major_groupList'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.groupList =  data.data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        getSubGroup(id){
            let uri="masters/loadStaffDropdownMasters/StaffSubMajorGrop/"+id;
            axios.get(uri)
            .then(response => {
                let data = response;
                this.subgroupList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error: ."+error)
            });
        },
        loadPositionLevelList(uri = 'masters/loadStaffMasters/all_active_position_level_List'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.positionLevelList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error: "+error)
            });
        },
		formaction: function(type){
            if(type=="reset"){
                this.form.name= '';
                this.form.code='';
                this.form.status= 1;
            }
            if(type=="save"){
                this.form.post('/masters/saveStaffMasters',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details updated successfully'
                    })
                    this.$router.push('/list_position_title');
                })
                .catch(() => { 
                    console.log("Error......")
                })
            }
		}, 
        changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="gr_parent_field"){
                this.form.gr_parent_field=$('#gr_parent_field').val();
                this.getSubGroup($('#gr_parent_field').val());
            }
            if(id=="parent_field"){
                this.form.parent_field=$('#parent_field').val();
            }
            if(id=="position_level"){
                this.form.position_level=$('#position_level').val();
            }
            
        },
    },
    created() {
        this.loadMajorGroupList();
        this.loadPositionLevelList();

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
        this.form.gr_parent_field=this.$route.params.data.submajorgroup.group_id;
        this.form.parent_field=this.$route.params.data.submajorgroup.id;
        this.getSubGroup(this.$route.params.data.submajorgroup.group_id);
        if(this.$route.params.data.level){
            this.form.position_level=this.$route.params.data.level.id;
        }
        this.form.name=this.$route.params.data.name;
        this.form.status=this.$route.params.data.status;
        this.form.code=this.$route.params.data.code;
        this.form.id=this.$route.params.data.id;

    },
    
}
</script>