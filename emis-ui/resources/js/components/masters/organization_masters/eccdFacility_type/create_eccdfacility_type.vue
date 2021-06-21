<template>
    <div>
        <form class="bootbox-form" id="eccdfacilityId">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>Facility Type:<span class="text-danger">*</span></label> 
                        <input class="form-control" v-model="form.faciltytype" :class="{ 'is-invalid': form.errors.has('faciltytype') }" id="faciltytype" @change="remove_err('faciltytype')" type="text">

                        <has-error :form="form" field="faciltytype"></has-error>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>ECCD Structure Type:<span class="text-danger">*</span></label> 
                        <select name="type" class="form-control" v-model="form.structuretype" :class="{ 'is-invalid': form.errors.has('structuretype') }" id="structuretype" @change="remove_err('structuretype')">
                            <option value="">--- Please Select ---</option>
                            <option v-for="(item, index) in eccdStructureTypeList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="structuretype"></has-error>
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
            eccdStructureTypeList:[],
            count:10,
            form: new form({
                id: '',
                faciltytype : '',
                structuretype: '',
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
                this.form.faciltytype= '';
                this.form.structuretype= '';
                this.form.description= '';
                this.form.status= 1;
            }
            if(type=="save"){
                this.form.post('/masters/saveEccdFacility',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Eccd Facility is added successfully'
                    })
                    this.$router.push('/list_eccdfacility_type');
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		},

        getEccdStructureType(uri = 'masters/getEccdStructureType'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.eccdStructureTypeList = data;
            });
        },
    },

    mounted(){
        this.getEccdStructureType();
    }
}
</script>