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
                        <input class="form-control" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" id="name" @change="remove_err('name')" type="text" >
                        <has-error :form="form" field="name"></has-error>
                    </div>
                     <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Code:<span class="text-danger">*</span></label> 
                        <input class="form-control" v-model="form.code" :class="{ 'is-invalid': form.errors.has('code') }" id="code" @change="remove_err('code')" type="text" >
                        <has-error :form="form" field="code"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Description:</label> 
                        <textarea class="form-control" v-model="form.description" id="description" type="text"/>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="required">Status:</label>
                        <br>
                        <label><input v-model="form.status"  type="radio" value="1" /> Active</label>
                        <label><input v-model="form.status"  type="radio" value="0" /> Inactive</label>
                    </div>
                </div>          
            </div>
            <div class="card-footer text-right">
                <button type="button" @click="formaction('reset')" class="btn btn-flat btn-sm btn-danger" ><i class="fa fa-redo"></i> Reset</button>
                <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary" ><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data(){
        return{
            count:10,
            eccdStructureTypeList:[],
            form: new form({
                id: '',
                name: '',
                code:'',
                description:'',
                status: 1,
                structuretype:'',
                action_type:'edit',
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
                this.form.code= '';
                this.form.description= '';
                this.form.structuretype= '';
                this.form.status= 1;
            }
            if(type=="save"){
                Swal.fire({
                    title: 'Are you sure you wish to submit this form ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    }).then((result) =>{
                    if (result.isConfirmed){
                        this.form.post('masters/organizationMasterController/saveOrganizationMaster',this.form)
                        .then((response) =>{
                            Toast.fire({
                            icon: 'success',
                            title: 'Details added successfully'
                        })
                        this.$router.push('/list_eccdfacility_type');
                        })
                        .catch((error) => {
                            Toast.fire({
                                icon: 'error',
                                title: 'Unexpected error occured. Try again.'
                            });
                            console.log("Error:"+error);
                        })
                    }
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
    created() {
        this.getEccdStructureType();
        this.form.name=this.$route.params.data.name;
        this.form.code=this.$route.params.data.code;
        this.form.description=this.$route.params.data.description;
        this.form.status=this.$route.params.data.status;
        this.form.structuretype=this.$route.params.data.structuretype;
        this.form.id=this.$route.params.data.id;
    },
}
</script>