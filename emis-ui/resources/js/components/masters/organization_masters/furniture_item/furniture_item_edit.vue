<template>
    <div>
        <form class="bootbox-form" id="equipmentItemId">
            <div class="card-body">
                <div class="row form-group">
                    <input type="hidden" class="form-control" v-model="form.id"/>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>Equipment Item:<span class="text-danger">*</span></label> 
                        <input class="form-control" v-model="form.equipmentItem" :class="{ 'is-invalid': form.errors.has('sub_name') }" id="equipmentItem" @change="remove_err('equipmentItem')" type="text">

                        <has-error :form="form" field="spo_name"></has-error>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>Equipment Type:<span class="text-danger">*</span></label> 
                        <select name="type" class="form-control" v-model="form.equipmentType" :class="{ 'is-invalid': form.errors.has('spo_name') }" id="equipmentType" @change="remove_err('equipmentType')">
                            <option value="">--- Please Select ---</option>
                            <option v-for="(item, index) in equipmentTypeList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
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
            equipmentTypeList:[],
            count:10,
            form: new form({
                id: '',
                equipmentItem : '',
                equipmentType: '',
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
                this.form.equipmentItem= '';
                this.form.equipmentType= '';
                this.form.description= '';
                this.form.status= 1;
            }
            if(type=="save"){
                this.form.post('/masters/saveEquipmentItem',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Equipment Item details is updated successfully'
                    })
                    this.$router.push('/equipment_item_list');
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		},
        getEquipmentType(uri = '/masters/getEquipmentTypeDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.equipmentTypeList = data;
            });
        },
    },
        
    
     created() {
        this.getEquipmentType();
    },

    mounted(){
        this.form.equipmentItem=this.$route.params.data.equipmentItem;
        this.form.equipmentType=this.$route.params.data.equipmentTypeId;
        this.form.description=this.$route.params.data.description;
        this.form.status=this.$route.params.data.status;
        this.form.id=this.$route.params.data.id;
    },
   
    
}
</script>