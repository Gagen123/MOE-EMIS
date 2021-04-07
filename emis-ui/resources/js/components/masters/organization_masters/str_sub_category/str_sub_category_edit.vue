<template>
    <div>
        <form class="bootbox-form" id="sportSupporterId">
        <div class="card-body">
            <div class="row form-group">
                <input type="hidden" class="form-control" v-model="form.id"/>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Structure Category:<span class="text-danger">*</span></label> 
                    <select name="type" class="form-control" v-model="form.structureCategory" :class="{ 'is-invalid': form.errors.has('spo_name') }" id="structureCategory" @change="remove_err('structureCategory')">
                        <option value="">--- Please Select ---</option>
                            <option v-for="(item, index) in structureCategoryList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <has-error :form="form" field="spo_name"></has-error>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Sub Category Name:<span class="text-danger">*</span></label> 
                    <input class="form-control" v-model="form.subCategoryName" :class="{ 'is-invalid': form.errors.has('sub_name') }" id="subCategoryName" @change="remove_err('subCategoryName')" type="text">
                    <has-error :form="form" field="sub_name"></has-error>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Description:</label> 
                    <textarea class="form-control" v-model="form.description" id="description" type="text"/>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="required">Status:</label>
                    <br>
                    <label><input v-model="form.status"  type="radio" value="1"/> Active</label>
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
    data(){
        return{
            structureCategoryList:[],
            count:10,
            form: new form({
                id: '',
                structureCategory : '',
                subCategoryName: '',
                description: '',
                status: 1,
                action_type:'add',
            })
        }
    },

    methods:{
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },
        formaction: function(type){
            if(type=="reset"){
                this.form.structureCategory= '';
                this.form.subCategoryName= '';
                this.form.description= '';
                this.form.status= 1;
            }
            if(type=="save"){
                this.form.post('/masters/saveStrSubCategory',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Structure sub category details is updated successfully'
                    })
                    this.$router.push('/str_sub_category_list');
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		},
         /**
         * method to get structure category dropdown
         */
        getStructureCategory(uri = '/masters/getStrCategoryDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.structureCategoryList = data;
            });
        },
    },

    created() {
        this.getStructureCategory();
    },
    mounted(){
        this.form.structureCategory=this.$route.params.data.structureCategoryId;
        this.form.subCategoryName=this.$route.params.data.subCategoryName;
        this.form.description=this.$route.params.data.description;
        this.form.status=this.$route.params.data.status;
        this.form.id=this.$route.params.data.id;
        this.form.action_type=this.$route.params.data.action;
    }
}
</script>