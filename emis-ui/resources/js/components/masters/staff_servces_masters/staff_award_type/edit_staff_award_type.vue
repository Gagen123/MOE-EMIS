<template>
    <div>
        <form class="bootbox-form" id="dzongkhagId">
            <div class="card-body">
                <div class="row form-group">
                    <!-- <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Award Category:<span class="text-danger">*</span></label>
                        <select class="form-control" id="parent_field" v-model="form.parent_field" :class="{ 'is-invalid': form.errors.has('parent_field') }">
                            <option v-for="(item, index) in staffCategoryList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="parent_field"></has-error>
                    </div> -->
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Award Type:<span class="text-danger">*</span></label>
                        <input class="form-control" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" id="name" @change="remove_error('name')" type="text">
                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <label>Description:</label>
                        <textarea class="form-control" v-model="form.description" :class="{ 'is-invalid': form.errors.has('description') }" id="description" @change="remove_error('description')" ></textarea>
                        <has-error :form="form" field="description"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pt-4">
                        <label>Code:<span class="text-danger">*</span></label>
                        <input class="form-control" v-model="form.code" :class="{ 'is-invalid': form.errors.has('code') }" id="code" @change="remove_error('code')" type="text">
                        <has-error :form="form" field="code"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pt-4">
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
            staffCategoryList:[],
            form: new form({
                id: '',
                parent_field:'',
                name: '',
                code:'',
                status: 1,
                model:'StaffAwardType',
                action_type:'edit',
            })
        }
    },
    methods: {
        // loadworkingagencyList(uri = 'masters/loadStaffMasters/all_active_staff_award_category_List'){
        //     axios.get(uri)
        //     .then(response => {
        //         let data = response.data.data;
        //         this.staffCategoryList =  data;
        //     })
        //     .catch(function (error) {
        //         console.log("Error:"+error)
        //     });
        // },
		formaction: function(type){
            if(type=="reset"){
                this.form.name= '';
                this.form.code='';
                this.form.status= 1;
            }
            if(type=="save"){
                this.submitstaffmaster('list_staff_award_type');
            }
		},
    },
    created() {
        // this.loadworkingagencyList();
        this.form.name=this.$route.params.data.name;
        // this.form.parent_field=this.$route.params.data.category.id;
        this.form.status=this.$route.params.data.status;
        this.form.description=this.$route.params.data.description;
        this.form.code=this.$route.params.data.code;
        this.form.id=this.$route.params.data.id;
    },

}
</script>
