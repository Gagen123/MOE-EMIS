<template>
    <div>
        <form class="bootbox-form" id="contactTypeId">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                       <label>Sport Facility:<span class="text-danger">*</span></label> 
                        <select name="sportFacility" class="form-control" v-model="form.sportFacility" :class="{ 'is-invalid': form.errors.has('sportFacility') }" id="sportFacility" @change="remove_err('sportFacility')">
                            <option value="">--- Please Select ---</option>
                            <option v-for="(item, index) in sportFacilityList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="sportFacility"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Sport Facility Sub-Type:<span class="text-danger">*</span></label> 
                        <input class="form-control" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" id="name" @change="remove_err('name')" type="text" tabindex="1" autofocus="true">
                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Description:</label> 
                        <textarea class="form-control" v-model="form.description" id="description" type="text"/>
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
            count:10,
            sportFacilityList:[],
            form: new form({
                id: '',
                name: '',
                description:'',
                status: 1,
                sportFacility:'',
                action_type:'edit',
                model:'SportFacilitySubtype'
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
                this.form.sportFacility= '';
                this.form.status= 1;
            }
            if(type=="save"){
                this.form.post('masters/organizationMasterController/saveOrganizationMaster')
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Detail is edited successfully'
                    })
                    this.$router.push('/sport_facility_subtype_list');
                })
                .catch((err) => {
                    console.log("Error:"+err)
                })
            }
		},
        getFacilityDropdown(uri = '/organization/getFacilityInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.sportFacilityList = data;
            });
        },
    },
    created() {
        this.getFacilityDropdown();
        this.form.name=this.$route.params.data.name;
        this.form.description=this.$route.params.data.description;
        this.form.status=this.$route.params.data.status;
        this.form.sportFacility=this.$route.params.data.sportFacilityId;
        this.form.id=this.$route.params.data.id;
    },
}
</script>