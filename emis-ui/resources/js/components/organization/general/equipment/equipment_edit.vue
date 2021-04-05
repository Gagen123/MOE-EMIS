<template>
    <div>
        <form class="bootbox-form" id="equipmentId">
            <div class="card-body">
                <div class="row form-group">
                    <input type="hidden" class="form-control" v-model="form.id"/>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Type:<span class="text-danger">*</span></label> 
                            <select name="type" class="form-control" v-model="form.type" :class="{ 'is-invalid': form.errors.has('spo_name') }" id="type" @change="remove_err('type')">
                                <option value="">--- Please Select ---</option>
                                <option v-for="(item, index) in typeList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                            </select>
                            <has-error :form="form" field="str_name"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Item:<span class="text-danger">*</span></label> 
                        <select name="type" class="form-control" v-model="form.item" :class="{ 'is-invalid': form.errors.has('spo_name') }" id="item" @change="remove_err('item')">
                            <option value="">--- Please Select ---</option>
                            <option v-for="(item, index) in itemList" :key="index" v-bind:value="item.id">{{ item.equipmentItem }}</option>
                        </select>
                        <has-error :form="form" field="str_name"></has-error>
                    </div>
                </div>  
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Location/Use:<span class="text-danger">*</span></label> 
                        <select name="type" class="form-control" v-model="form.location" :class="{ 'is-invalid': form.errors.has('spo_name') }" id="location" @change="remove_err('location')">
                            <option value="">--- Please Select ---</option>
                            <option v-for="(item, index) in locationUse" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="str_name"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Number:<span class="text-danger">*</span></label> 
                        <input class="form-control" v-model="form.number" :class="{ 'is-invalid': form.errors.has('str_name') }" id="number" @change="remove_err('number')" type="text">
                        <has-error :form="form" field="str_name"></has-error>
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
                type: '',
                item: '',
                location: '',
                number: '',
                action_type:'edit',
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
                this.form.type= '';
                this.form.item= '';
                this.form.location= '';
                this.form.number= '';
            }
            if(type=="save"){
                this.form.post('/masters/saveEquipment',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Equipment & Furniture details is updated successfully'
                    })
                    this.$router.push('/equipment_list');
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		},

        getType(uri = '/organization/getType'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.typeList = data;
            });
        },

        getItem(uri = '/organization/getItem/'+this.form.type){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.itemList = data;
            });
        },

        getLocationUse(uri = '/organization/getLocationUse'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.locationUse = data;
            });
        },
    },

    created() {
        this.getType();
        this.getLocationUse();
    },

    mounted(){
        this.form.type=this.$route.params.data.typeId;
        this.form.item=this.$route.params.data.itemId;
        this.form.location=this.$route.params.data.locationUsageId;
        this.form.number=this.$route.params.data.number;
        this.form.id=this.$route.params.data.id;
    }
}
</script>