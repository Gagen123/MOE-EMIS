<template>
    <div>
        <form class="bootbox-form">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Major Group:<span class="text-danger">*</span></label>
                        <select class="form-control select2" id="group_id" v-model="form.group_id" :class="{ 'is-invalid': form.errors.has('group_id') }">
                            <option v-for="(item, index) in groupList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="group_id"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Sub Major Group Name:<span class="text-danger">*</span></label>
                        <select class="form-control select2" id="sub_group_id" v-model="form.sub_group_id" :class="{ 'is-invalid': form.errors.has('sub_group_id') }">
                            <option v-for="(item, index) in subgroupList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="sub_group_id"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Child Group Name:<span class="text-danger">*</span></label>
                        <select class="form-control select2" id="child_group_id" v-model="form.child_group_id" :class="{ 'is-invalid': form.errors.has('child_group_id') }">
                            <option v-for="(item, index) in childgroupList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="child_group_id"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Position Title:<span class="text-danger">*</span></label>
                        <select class="form-control select2" id="position_title" v-model="form.position_title" :class="{ 'is-invalid': form.errors.has('position_title') }">
                            <option v-for="(item, index) in positionTitleList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="position_title"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Super Structure:<span class="text-danger">*</span></label>
                        <select class="form-control select2" id="superstructure_id" v-model="form.superstructure_id" :class="{ 'is-invalid': form.errors.has('superstructure_id') }">
                            <option v-for="(item, index) in superstructureList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="superstructure_id"></has-error>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>Description:</label>
                        <textarea class="form-control" v-model="form.description" :class="{ 'is-invalid': form.errors.has('description') }" id="description" @change="remove_err('description')" ></textarea>
                        <has-error :form="form" field="description"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Code:<span class="text-danger">*</span></label>
                        <input class="form-control" v-model="form.code" :class="{ 'is-invalid': form.errors.has('code') }" id="code" @change="remove_err('code')" type="text">
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
            childgroupList:[],
            positionTitleList:[],
            superstructureList:[],
            form: new form({
                id: '',
                name:'NA',
                group_id:'',
                sub_group_id:'',
                position_level_id:'',
                child_group_id:'',
                superstructure_id:'',
                position_title:'',
                code:'',
                description:'',
                status:1,
                model:'ChildGroupPosition',
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
        async loadMajorGroupList(){
            this.groupList =  await this.loadstaffMasters('active','StaffMajorGrop');
        },
        async getSubGroup(id){
            this.subgroupList =  await this.loadstaffMasters('byparent__group_id__'+id,'StaffSubMajorGrop');
        },
        async getChildGroup(id){
            this.childgroupList =  await this.loadstaffMasters('byparent__sub_group_id__'+id,'ChildGroup');
        },
        async loadPositiontitleList(){
            this.positionTitleList =  await this.loadstaffMasters('active','PositionTitle');
        },
        async getSurstructureList(){
            this.superstructureList =  await this.loadstaffMasters('active','SuperStructure');
        },

		formaction: function(type){
            if(type=="reset"){
                this.form.name= '';
                this.form.status= 1;
            }
            if(type=="save"){
                this.form.post('staff/saveStaffMasters',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/list_child_group_position');
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
            if(id=="group_id"){
                this.form.group_id=$('#group_id').val();
                this.getSubGroup($('#group_id').val());
            }
            if(id=="sub_group_id"){
                this.form.sub_group_id=$('#sub_group_id').val();
                this.getChildGroup($('#sub_group_id').val());
            }
            if(id=="position_level_id"){
                this.form.position_level_id=$('#position_level_id').val();
            }
            if(id=="position_title"){
                this.form.position_title=$('#position_title').val();
            }
            if(id=="superstructure_id"){
                this.form.superstructure_id=$('#superstructure_id').val();
            }
            if(id=="child_group_id"){
                this.form.child_group_id=$('#child_group_id').val();
            }
        },
    },
    mounted(){
        this.loadMajorGroupList();
        this.loadPositiontitleList();
        this.getSurstructureList();
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

        this.form.group_id=this.$route.params.data.groupid;
        this.getSubGroup(this.$route.params.data.groupid);
        this.form.sub_group_id=this.$route.params.data.subgroupid;
        this.getChildGroup(this.$route.params.data.subgroupid);
        this.form.child_group_id=this.$route.params.data.child_group_id;

        this.form.position_title=this.$route.params.data.position_title_id;
        this.form.superstructure_id=this.$route.params.data.superstructure_id;
        this.form.description=this.$route.params.data.description;
        this.form.status=this.$route.params.data.status;
        this.form.code=this.$route.params.data.code;
        this.form.id=this.$route.params.data.id;
    },
}
</script>
