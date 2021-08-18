<template>
    <div>
        <form class="bootbox-form" id="dzongkhagId">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Major Group Name:<span class="text-danger">*</span></label>
                        <select class="form-control" id="group_id" v-model="form.group_id" :class="{ 'is-invalid': form.errors.has('group_id') }">
                            <option v-for="(item, index) in groupList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="group_id"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Major Sub Group Name:<span class="text-danger">*</span></label>
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
                        <input class="form-control" readonly v-model="form.code" :class="{ 'is-invalid': form.errors.has('code') }" id="code" @change="remove_err('code')" type="text">
                        <has-error :form="form" field="code"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="required">status:</label>
                        <br>
                        <label><input v-model="form.status" type="radio" value="1" /> Active</label>
                        <label><input v-model="form.status" type="radio" value="0" /> Inactive</label>
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
            form: new form({
                id: '',
                name: '',
                group_id:'',
                code:'',
                status:'',
                model:'StaffSubMajorGrop',
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
        loadworkingagencyList(uri = 'masters/loadStaffMasters/all_active_staff_major_groupList'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.groupList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
		formaction: function(type){
            if(type=="reset"){
                this.form.name= '';
                this.form.code='';
                this.form.status= 1;
            }
            if(type=="save"){
                this.form.post('staff/saveStaffMasters',this.form)
                // this.form.post('/masters/saveStaffMasters',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details updated successfully'
                    })
                    this.$router.push('/list_sub_major_group_master');
                })
                .catch((e) => {
                    console.log("Error:"+e)
                })
            }
		},
    },
    created() {
        this.loadworkingagencyList();
        this.form.name=this.$route.params.data.name;
        this.form.group_id=this.$route.params.data.majorgroup.id;
        this.form.status=this.$route.params.data.status;
        this.form.description=this.$route.params.data.description;
        this.form.code=this.$route.params.data.code;
        this.form.id=this.$route.params.data.id;
        $('#group_id').val(this.$route.params.data.majorgroup.id);
    },

}
</script>
