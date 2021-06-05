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
                            <option v-for="(item, index) in itemList" :key="index" v-bind:value="item.id">{{ item.equipmentItem }}</option>
                        </select>
                        <has-error :form="form" field="item"></has-error>
                    </div>
                </div>  
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Location/Use:<span class="text-danger">*</span></label> 
                        <select name="location" class="form-control" v-model="form.location" :class="{ 'is-invalid': form.errors.has('location') }" id="location" @change="remove_err('location')">
                            <option value="">--- Please Select ---</option>
                            <option v-for="(item, index) in locationUse" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="location"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Number:<span class="text-danger">*</span></label> 
                        <input name="number" class="form-control" v-model="form.number" :class="{ 'is-invalid': form.errors.has('number') }" id="number" @change="remove_err('number')" type="number">
                        <has-error :form="form" field="number"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Date of Receipt of Furniture:<span class="text-danger">*</span></label> 
                        <input name="date" class="form-control" v-model="form.number" :class="{ 'is-invalid': form.errors.has('number') }" id="number" @change="remove_err('number')" type="date">
                        <has-error :form="form" field="number"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Cost:<span class="text-danger">*</span></label> 
                        <input name="number" class="form-control" v-model="form.number" :class="{ 'is-invalid': form.errors.has('number') }" id="number" @change="remove_err('number')" type="number">
                        <has-error :form="form" field="number"></has-error>
                    </div>
                </div> 
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Life Expectancy:<span class="text-danger">*</span></label> 
                        <input name="date" class="form-control" v-model="form.number" :class="{ 'is-invalid': form.errors.has('number') }" id="number" @change="remove_err('number')" type="number">
                        <has-error :form="form" field="number"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="required">Condition of Furniture:</label>
                        <br>
                        <label><input v-model="form.status"  type="radio" value="1" tabindex="2"/> Usable</label>
                        <label><input v-model="form.status"  type="radio" value="0" tabindex="3"/> Not Usable</label>
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
                location: '',
                number: '',
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
                this.form.location= '';
                this.form.number= '';
            }
            if(type=="save"){
                this.form.post('/organization/saveEquipment',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Equipment & Furniture is added successfully'
                    })
                    this.$router.push('/equipment_list');
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		},

        /**
         * method to get equipment type
         */
        getType(uri = '/organization/getType'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.typeList = data;
            });
        },

        /**
         * method to get item by type
         */
        getItem(uri = '/organization/getItem/'+this.form.type){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.itemList = data;
            });
        },

        /**
         * method to get equipment usage location
         */
        getLocationUse(uri = '/organization/getLocationUse'){
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
    }
}
</script>