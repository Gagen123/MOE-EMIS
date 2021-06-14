<template>
    <div>
        <form class="bootbox-form" id="equipmentId">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Furniture Type:<span class="text-danger">*</span></label> 
                            <select name="type" class="form-control" v-model="form.type" :class="{ 'is-invalid': form.errors.has('type') }" id="type" @change="remove_err('type'),getItem()">
                                <option value="">--- Please Select ---</option>
                                <option v-for="(item, index) in typeList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                            </select>
                            <has-error :form="form" field="type"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Furniture Name:<span class="text-danger">*</span></label> 
                        <select name="item" class="form-control" v-model="form.item" :class="{ 'is-invalid': form.errors.has('item') }" id="item" @change="remove_err('item')">
                            <option value="">--- Please Select ---</option>
                            <option v-for="(item, index) in itemList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="item"></has-error>
                    </div>
                </div>  
               
                <br>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                     <label class="required">Condition of Equipment:</label>
                    </div>
                </div>
                    <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Usuable:<span class="text-danger">*</span></label> 
                           <input name="usable" class="form-control" v-model="form.usable" :class="{ 'is-invalid': form.errors.has('usable') }" id="usable" @change="remove_err('usable')" type="number">
                            <has-error :form="form" field="usable"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Not Usable:<span class="text-danger">*</span></label> 
                        <input name="notusable" class="form-control" v-model="form.notusable" :class="{ 'is-invalid': form.errors.has('notusable') }" id="notusable" @change="remove_err('notusable')" type="number">
                        <has-error :form="form" field="notusable"></has-error>
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
            typeList:[],
            itemList:[],
            locationUse:[],
            form: new form({
                id: '',
                organizationId:'',
                type: '',
                item: '',
                usable: '',
                notusable:'',
                action_type:'add',
            })
        }
    },

    methods:{
        /**
         * method to remove error
         */
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },

        /**
         * method to save data
         */
        formaction: function(type){ 
            if(type=="reset"){
                this.form.type= '';
                this.form.item= '';
                this.form.usable= '';
                this.form.notusable= '';
            }
            if(type=="save"){
                this.form.post('/organization/saveFurniture',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Furniture is added successfully'
                    })
                    this.$router.push('/furniture_list');
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		},

        /**
         * method to get equipment type
         */
        getType(uri = '/organization/getFurnitureType'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.typeList = data;
            });
        },

        /**
         * method to get item by type
         */
        getItem(uri = '/organization/getFurnitureItem/' +this.form.type){
            axios.get(uri)
            .then(response => {
                // alert(JSON.stringify(response));
                let data = response.data;
                this.itemList = data;
            });
        },

        /**
         * method to get equipment usage location
         */
        getLocationUse(uri = '/organization/getFurnitureUse'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.locationUse = data;
            });
        },
    },

    mounted() { 
        this.getType();
        this.getLocationUse();
        this.getItem();
    }
}
</script>