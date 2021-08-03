<template>
   <div>
        <form class="bootbox-form" autocomplete="off">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Domain :<span class="text-danger">*</span></label> 
                        <select class="form-control select2" id="spm_domain_id" v-model="spm_domain_id" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('spm_domain_id') }" @change="getAreas(); remove_err('spm_domain_id')">
                            <option value=""> ---Select---</option>
                            <option v-for="(item, index) in domains" :key="index" v-bind:value="item.id">
                                {{ item.name }}
                            </option>
                        </select> 
                        <has-error :form="form" field="spm_domain_id"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Area :<span class="text-danger">*</span></label> 
                        <select class="form-control select2" id="spm_area_id" v-model="spm_area_id" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('spm_area_id') }" @change="getParameters(); remove_err('spm_area_id')">
                            <option value=""> ---Select---</option>
                            <option v-for="(item, index) in areas" :key="index" v-bind:value="item.id">
                                {{ item.name }}
                            </option>
                        </select> 
                        <has-error :form="form" field="spm_area_id"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Parameter :<span class="text-danger">*</span></label> 
                        <select class="form-control select2" id="spm_parameter_id" v-model="spm_parameter_id" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('spm_parameter_id') }" @change="getIndicators(); remove_err('spm_parameter_id')">
                            <option value=""> ---Select---</option>
                            <option v-for="(item, index) in parameters" :key="index" v-bind:value="item.id">
                                {{ item.name }}
                            </option>
                        </select> 
                        <has-error :form="form" field="spm_parameter_id"></has-error>
                    </div>
                </div> 
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>Indicator :<span class="text-danger">*</span></label> 
                        <select class="form-control select2" id="spm_indicator_id" v-model="form.spm_indicator_id" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('spm_indicator_id') }" @change="remove_err('spm_indicator_id')">
                            <option value=""> ---Select---</option>
                            <option v-for="(item, index) in indicators" :key="index" v-bind:value="item.id">
                                {{ item.name }}
                            </option>
                        </select> 
                        <has-error :form="form" field="spm_indicator_id"></has-error>
                    </div>
                </div> 
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Score:<span class="text-danger">*</span></label> 
                        <input class="form-control form-control-sm text-right" v-model="form.score" :class="{ 'is-invalid': form.errors.has('score') }" id="score" @change="remove_err('score')" min="0" type="number">
                        <has-error :form="form" field="score"></has-error>
                    </div>
                </div> 
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>Description:<span class="text-danger">*</span></label> 
                        <textarea class="form-control" v-model="form.description" :class="{ 'is-invalid': form.errors.has('description') }" id="description" @change="remove_err('description')"></textarea>
                        <has-error :form="form" field="description"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="required">Status:</label>
                        <br>
                        <label><input v-model="form.status"  type="radio" value="1" /> Active</label>
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
        return {
            domains:[],
            spm_domain_id:'',
            areas:[],
            spm_area_id:'',
            parameters:[],
            spm_parameter_id:'',
            indicators:[],
            form: new form({
                score: '',
                description:'',
                spm_indicator_id:'',
                status:1,
                record_type:'rating',
                action_type:'add',
            })
        }
    },
    methods: {
        getDomains(){
            axios.get('masters/loadSpmMasters/all_active_domains')
            .then(response => {
                let data = response 
                this.domains =  data.data.data
            })
            .catch(function (error){
                console.log("Error"+error)
            });
        },
        getAreas(){
            axios.get('masters/loadSpmMasters/all_active_areas_'+this.spm_domain_id)
            .then(response => {
                let data = response 
                this.areas =  data.data.data
            })
            .catch(function (error){
                console.log("Error"+error)
            });
        },
        getParameters(){
            axios.get('masters/loadSpmMasters/all_active_parameters_'+this.spm_area_id)
            .then(response => {
                let data = response 
                this.parameters =  data.data.data
            })
            .catch(function (error){
                console.log("Error"+error)
            });
        },
        getIndicators(){
            axios.get('masters/loadSpmMasters/all_active_indicators_'+this.spm_parameter_id)
            .then(response => {
                let data = response 
                this.indicators = data.data.data
            })
            .catch(function (error){
                console.log("Error"+error)
            });
        },
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid')
            }
        },
		formaction: function(type){
            if(type=="reset"){
                this.form.score= ''
                this.form.description = ''
                this.form.spm_indicator_id = ''
                this.form.status= 1
            }
            if(type=="save"){
                this.form.post('/masters/saveSpmMasters',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/list-parameter')
                })
                .catch(() => {
                    console.log("Error.")
                })
            }
		}, 
    },
    mounted(){
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').select2().
        on("select2:select", e => {
            const event = new Event("change", { bubbles: true, cancelable: true })
            e.params.data.element.parentElement.dispatchEvent(event)
        })
        .on("select2:unselect", e => {
        const event = new Event("change", { bubbles: true, cancelable: true })
        e.params.data.element.parentElement.dispatchEvent(event)
        });
        this.getDomains()
        this.getAreas()
        this.getParameters()
    }
}
</script>