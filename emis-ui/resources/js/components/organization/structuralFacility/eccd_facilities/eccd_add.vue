<template>
    <div>
        <form class="bootbox-form" id="sportId">
            <div class="card-body">
                <form class="form-horizontal">
                <div class="row invoice-info">
                    <div class="col-sm-2 invoice-col">
                        <label class="mb-0"><i><u>General Information</u></i></label>
                    </div>
                    <div class="col-sm-9 invoice-col">
                        <input type="hidden" class="form-control" v-model="form.organizationId"/>
                        <p>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Facility:<span class="text-danger">*</span></label>
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <select name="facility" id="facility" class="form-control editable_fields" @change="getSubFacilityDropdown(),remove_err('facility')" :class="{ 'is-invalid': form.errors.has('facility') }" v-model="form.facility">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in facilityList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="facility"></has-error>
                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Year of Establishment:<span class="text-danger">*</span></label>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <input type="text" id="yearOfEst" class="form-control editable_fields" v-model="form.yearOfEstablish"/>
                            </div>
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Supported By:<span class="text-danger">*</span></label>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <select name="supportBy" id="supportBy" class="form-control editable_fields" v-model="form.supportedBy">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in supportList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-5 col-md-5 col-sm-5 col-form-label">Present Condition of Facility:<span class="text-danger">*</span></label>
                            <div class="col-lg-3 col-md-3 col-sm-3 pt-2">
                                <label><input v-model="form.status"  type="radio" value="1"/> Usable</label>
                                <label><input v-model="form.status"  type="radio" value="0" /> Not Usable</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-5 col-md-5 col-sm-5 col-form-label">Total No. of Facilities:<span class="text-danger">*</span></label>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <input maxlength="12" v-model="form.numberOfFacility" class="form-control editable_fields " id="acessibleDisabled" type="number">
                            </div>
                        </div>
                    </div>
                </div>
                </form>
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
            facilitySubList:[],
            form: new form({
                id: '', 
                organizationId:'', 
                facility: '',
                yearOfEstablish: '',
                supportedBy: '',
                status: '1',
                numberOfFacility: '',
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
                this.form.yearOfEstablish= '';
                this.form.supportedBy= '';
                this.form.status= '1';
                this.form.numberOfFacility='';
            }
            if(type=="save"){
                this.form.post('/organization/saveEccd',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Eccd facilities added successfully'
                    })
                    this.$router.push('/eccd_list');
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
        showfield:function(type){
            let selecttype = $("#"+type+" option:selected").text();
            if(selecttype = 'standard'){
                 $('#sizeAndarea').hide();
                 $('#Nocourts').hide(); 
            }

            if(selecttype!= 'standard'){ 
                $('#sizeAndarea').show();
                $('#Nocourts').show(); 

            }

        }
    },
     mounted() { 
        this.getFacilityDropdown();
        this.getSupportDropdown();
    }
}
</script>