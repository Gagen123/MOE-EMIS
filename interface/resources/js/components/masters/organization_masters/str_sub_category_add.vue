<template>
    <div>
        <form class="bootbox-form" id="sportSupporterId">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>Structure Category:<span class="text-danger">*</span></label> 
                        <select name="type" class="form-control" v-model="form.structureCategory" :class="{ 'is-invalid': form.errors.has('spo_name') }" id="structureCategory" @change="remove_err('structureCategory')">
                            <option selected value="">--- Please Select ---</option>
                        </select>
                        <has-error :form="form" field="spo_name"></has-error>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>Sub Category Name:<span class="text-danger">*</span></label> 
                        <input class="form-control" v-model="form.subCategoryName" :class="{ 'is-invalid': form.errors.has('sub_name') }" id="subCategoryName" @change="remove_err('subCategoryName')" type="text">
                        <has-error :form="form" field="sub_name"></has-error>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                        <label>Description:</label> 
                        <textarea class="form-control" v-model="form.description" id="description" type="text"/>
                    </div>
                </div>
                <div class="row form-group">
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
                        title: 'Structure sub category is added successfully'
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
        getStructureCategory:function(){
            axios.get('masters/getStrCategoryDropdown')
            .then(response => {
                let structureCategoryList = response.data;
                let innerhtml='<option value ="">--- Please Select --- </option>';
                for(var i=0;i < structureCategoryList.length;i++){
                    innerhtml+= '<option value='+ structureCategoryList[i].id+'>'+ structureCategoryList[i].name +'</option>'
                }
                $("#structureCategory").html(innerhtml);
            })
        }
    },

    created(){
        this.getStructureCategory();
    }
}
</script>