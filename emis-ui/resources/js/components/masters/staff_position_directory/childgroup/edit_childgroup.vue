<template>
    <div>
        <form class="bootbox-form" id="dzongkhagId">
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
                        <input class="form-control" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" id="name" @change="remove_err('name')" type="text">
                        <has-error :form="form" field="name"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>Description:</label>
                        <textarea class="form-control" v-model="form.description" :class="{ 'is-invalid': form.errors.has('description') }" id="description" @change="remove_err('description')" ></textarea>
                        <has-error :form="form" field="description"></has-error>
                    </div>
                </div>
                <div class="row form-group">
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
            form: new form({
                id: '',
                group_id:'',
                sub_group_id:'',
                name: '',
                code:'',
                status: 1,
                description:'',
                model:'ChildGroup',
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
        loadMajorGroupList(uri = 'staff/loadStaffMasters/active/StaffMajorGrop'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.groupList =  data.data.data;
            })
            .catch(function (error) {
                console.log('error: '+error);
            });
        },
        getSubGroup(id){
            let uri="staff/loadStaffMasters/byparent__group_id__"+id+"/StaffSubMajorGrop";
            axios.get(uri)
            .then(response => {
                let data = response;
                this.subgroupList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error: ."+error)
            });
        },
		formaction: function(type){
            if(type=="reset"){
                this.group_id= '';
                this.sub_group_id= '';
                this.form.name= '';
                this.form.description='';
                this.form.status= 1;
            }
            if(type=="save"){
                this.form.post('staff/saveStaffMasters',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/list_childgroup');
                })
                .catch((e) => {
                    console.log("Error:"+e)
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
            }
        },
    },
    created() {
        this.loadMajorGroupList();
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

        this.form.name=this.$route.params.data.name;
        this.form.group_id=this.$route.params.data.sub_det.group_id;
        this.getSubGroup(this.$route.params.data.sub_det.group_id);
        this.form.sub_group_id=this.$route.params.data.sub_det.id;
        this.form.status=this.$route.params.data.status;
        this.form.description=this.$route.params.data.description;
        this.form.code=this.$route.params.data.code;
        this.form.id=this.$route.params.data.id;
    },

}
</script>
