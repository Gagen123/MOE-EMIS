<template>
    <div>
        <form class="bootbox-form" id="equipmentItemId">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>Furniture Item:<span class="text-danger">*</span></label> 
                        <input class="form-control" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" id="name" @change="remove_err('name')" type="text">

                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>Furniture Type:<span class="text-danger">*</span></label> 
                        <select name="type" class="form-control" v-model="form.furnitureType" :class="{ 'is-invalid': form.errors.has('furnitureType') }" id="furnitureType" @change="remove_err('furnitureType')">
                            <option value="">--- Please Select ---</option>
                            <option v-for="(item, index) in furnitureTypeList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="furnitureType"></has-error>
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
            furnitureTypeList:[],
            count:10,
            form: new form({
                id: '',
                name : '',
                furnitureType: '',
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
                this.form.name= '';
                this.form.furnitureType= '';
                this.form.description= '';
                this.form.status= 1;
            }
            if(type=="save"){
                this.form.post('/masters/saveFurnitureItem',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: ' Item is added successfully'
                    })
                    this.$router.push('/furniture_item_list');
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		},

        getFurnitureType(uri = 'masters/getFurnitureTypeDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.furnitureTypeList = data;
            });
        },
    },

    mounted(){
        this.getFurnitureType();
    },
    created(){
        this.form.name=this.$route.params.data.name;
        this.form.furnitureType=this.$route.params.data.furnitureType;
        this.form.description=this.$route.params.data.description;
        this.form.status=this.$route.params.data.status;
        this.form.id=this.$route.params.data.id;
    },


}
</script>