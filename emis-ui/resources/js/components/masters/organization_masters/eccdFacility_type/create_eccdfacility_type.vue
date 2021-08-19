<template>
    <div>
        <form class="bootbox-form" id="contactTypeId">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>ECCD Structure Type:<span class="text-danger">*</span></label> 
                        <select name="type" class="form-control" v-model="form.structuretype" :class="{ 'is-invalid': form.errors.has('structuretype') }" id="structuretype" @change="remove_err('structuretype')">
                            <option value="">--- Please Select ---</option>
                            <option v-for="(item, index) in eccdStructureTypeList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="structuretype"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Facility Type:<span class="text-danger">*</span></label> 
                        <input class="form-control" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" id="name" @change="remove_err('name')" type="text" tabindex="1" autofocus="true">
                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Description:</label> 
                        <textarea class="form-control" v-model="form.description" :class="{ 'is-invalid': form.errors.has('description') }" id="description" type="text"/>
                        <has-error :form="form" field="description"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="required">Status:</label>
                        <br>
                        <label><input v-model="form.status"  type="radio" value="1" tabindex="2"/> Active</label>
                        <label><input v-model="form.status"  type="radio" value="0" tabindex="3"/> Inactive</label>
                    </div>
                </div>          
            </div>
            <div class="card-footer text-right">
                <button type="button" @click="formaction('reset')" class="btn btn-flat btn-sm btn-danger" tabindex="5"><i class="fa fa-redo"></i> Reset</button>
                <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary" tabindex="4"><i class="fa fa-save"></i> Save</button>
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
                name: '',
                description:'',
                status: 1,
                structuretype:'',
                action_type:'add',
                model:'ECCDFacilities'
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
                this.form.description= '';
                this.form.structuretype= '';
                this.form.status= 1;
            }
            if(type=="save"){
                this.form.post('masters/organizationMasterController/saveOrganizationMaster')
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Detail is added successfully'
                    })
                    this.$router.push('/list_eccdfacility_type');
                })
                .catch((err) => {
                    console.log("Error:"+err)
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
    created(){
        this.getEccdStructureType();
    }
}
</script>