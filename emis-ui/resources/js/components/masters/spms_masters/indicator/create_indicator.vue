<template>
    <div>
        <form class="bootbox-form" autocomplete="off">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Sequence No.:<span class="text-danger">*</span></label>
                        <input class="form-control form-control-sm text-right" v-model="form.sequence_no" :class="{ 'is-invalid': form.errors.has('sequence_no') }" id="sequence_no" @change="remove_err('sequence_no')" type="text">
                        <has-error :form="form" field="sequence_no"></has-error>
                    </div>
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
                </div>
                 <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Parameter :<span class="text-danger">*</span></label> 
                        <select class="form-control select2" id="spm_parameter_id" v-model="form.spm_parameter_id" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('spm_parameter_id') }" @change="remove_err('spm_parameter_id')">
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
                        <label>Indicator:<span class="text-danger">*</span></label> 
                        <textarea class="form-control" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" id="name" @change="remove_err('name')"></textarea>
                        <has-error :form="form" field="name"></has-error>
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
            form: new form({
                name: '',
                sequence_no:'',
                spm_parameter_id:'',
                status:1,
                record_type:'indicator',
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
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid')
            }
        },
		formaction: function(type){
            if(type=="reset"){
                this.form.name= ''
                this.form.spm_parameter_id = ''
                this.form.sequence_no = ''
                this.form.status= 1
            }
            if(type=="save"){
                this.form.post('/masters/saveSpmMasters',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/list-indicator')
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

    }
}
</script>