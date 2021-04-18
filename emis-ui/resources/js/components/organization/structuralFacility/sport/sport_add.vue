<template>
    <div>
        <form class="bootbox-form" id="sportId">
            <div class="card-body">
                <div class="form-group row">
                    <input type="hidden" class="form-control" v-model="form.organizationId"/>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Facility:<span class="text-danger">*</span></label> 
                        <select name="facility" id="facility" class="form-control editable_fields" @change="remove_err('facility')" :class="{ 'is-invalid': form.errors.has('facility') }" v-model="form.facility">
                            <option value="">--- Please Select ---</option>
                            <option v-for="(item, index) in facilityList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="facility"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Type:<span class="text-danger">*</span></label> 
                        <select name="type" id="type" class="form-control editable_fields" v-model="form.type" :class="{ 'is-invalid': form.errors.has('type') }" @change="remove_err('type')">
                            <option value="">--- Please Select ---</option>
                            <option value="1">Standard</option>
                            <option value="2">Indoor</option>
                            <option value="3">Outdoor</option>
                        </select>
                        <has-error :form="form" field="type"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Year of Establishment:</label> 
                        <input type="text" id="yearOfEst" class="form-control editable_fields" v-model="form.yearOfEstablish"/>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Supported by:</label> 
                        <select name="supportBy" id="supportBy" class="form-control editable_fields" v-model="form.supportedBy">
                            <option value="">--- Please Select ---</option>
                            <option v-for="(item, index) in supportList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Current Status:<span class="text-danger">*</span></label> 
                        <br>
                        <label><input v-model="form.status"  type="radio" value="1"/> Usable</label>
                        <label><input v-model="form.status"  type="radio" value="0" /> Not Usable</label>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class=" col-md-8">Total number of facility:</label> 
                        <input maxlength="12" v-model="form.numberOfFacility" class="form-control editable_fields " id="acessibleDisabled" type="number">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class=" col-md-12">No. of facility accessible to Disabled:</label> 
                        <input  class="form-control editable_fields" v-model="form.facilityAccessibleToDisabled" id="notAcessibleDisabled" type="number">
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
            facilityList:[],
            supportList:[],
            form: new form({
                id: '', organizationId:'1', facility: '',type: '',yearOfEstablish: '',supportedBy: '',status: '1',
                numberOfFacility: '',facilityAccessibleToDisabled: '',
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

        formaction: function(type){
            if(type=="reset"){
                this.form.facility= '';
                this.form.type= '';
                this.form.yearOfEstablish= '';
                this.form.supportedBy= '';
                this.form.status= '1';
                this.form.numberOfFacility='';
                this.form.facilityAccessibleToDisabled='';
            }
            if(type=="save"){
                this.form.post('/organization/saveSport',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Sport is added successfully'
                    })
                    this.$router.push('/sport_list');
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		},

        getFacilityDropdown(uri = '/organization/getFacilityInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.facilityList = data;
            });
        },
        getSupportDropdown(uri = '/organization/getSupportInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.supportList = data;
            });
        },
    },
     mounted() { 
        this.getFacilityDropdown();
        this.getSupportDropdown();
    }
}
</script>