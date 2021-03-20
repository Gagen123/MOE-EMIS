<template>
    <div>
        <form class="bootbox-form" id="equipmentId">
            <div class="card-body">
                <div class="row form-group">
                    <input type="hidden" class="form-control" v-model="form.id"/>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Type:<span class="text-danger">*</span></label> 
                            <select name="type" class="form-control" v-model="form.type" :class="{ 'is-invalid': form.errors.has('spo_name') }" id="type" @change="remove_err('type')">
                                <option selected value="">--- Please Select ---</option>
                            </select>
                            <has-error :form="form" field="str_name"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Item:<span class="text-danger">*</span></label> 
                        <select name="type" class="form-control" v-model="form.item" :class="{ 'is-invalid': form.errors.has('spo_name') }" id="item" @change="remove_err('item')">
                            <option selected value="">--- Please Select ---</option>
                        </select>
                        <has-error :form="form" field="str_name"></has-error>
                    </div>
                </div>  
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Location/Use:<span class="text-danger">*</span></label> 
                        <select name="type" class="form-control" v-model="form.location" :class="{ 'is-invalid': form.errors.has('spo_name') }" id="location" @change="remove_err('location')">
                            <option selected value="">--- Please Select ---</option>
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
    },
    created() {
        this.form.type=this.$route.params.data.type;
        this.form.item=this.$route.params.data.item;
        this.form.location=this.$route.params.data.location;
        this.form.number=this.$route.params.data.number;
        this.form.id=this.$route.params.data.id;
    },
}
</script>