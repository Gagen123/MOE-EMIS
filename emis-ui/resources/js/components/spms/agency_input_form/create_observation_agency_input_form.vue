<template>
    <div>
        <form class="bootbox-form" autocomplete="off">
            <strong class="ml-3">Create Observation & Recommendation</strong>
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Division:</label> 
                        <br>
                        {{division}}
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Year:</label> 
                        <br>
                        {{year}}
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>Input:</label> 
                            <br>
                        {{input}}
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>Process/Activities:</label> 
                            <br>
                        {{activity}}
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>Output:</label> 
                            <br>
                        {{output}}
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Dzongkhag:<span class="text-danger">*</span></label> 
                        <select v-model="form.dzon_id"  id="dzon_id" class="form-control select2" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('dzon_id') }" @change="getSchools(); onChange('dzon_id')">
                            <option value="">---Select---</option>
                            <option v-for="(item, index) in dzongkhags" :key="index" :value="item.id" >
                                {{ item.name }}
                            </option>
                        </select>
                        <has-error :form="form" field="dzon_id"></has-error>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>School:<span class="text-danger">*</span></label> 
                        <select v-model="form.school_id"  id="school_id" class="form-control select2" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('school_id') }" @change="onChange('school_id')">
                            <option value="">---Select---</option>
                            <option v-for="(item1, index1) in schools" :key="index1" :value="item1.id"  >
                                {{ item1.name }}
                            </option>
                        </select>
                        <has-error :form="form" field="school_id"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>Observation:<span class="text-danger">*</span></label> 
                        <textarea class="form-control" v-model="form.observation" :class="{ 'is-invalid': form.errors.has('observation') }" id="observation" @change="onChange('observation')"></textarea>
                        <has-error :form="form" field="observation"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>Recommendation:<span class="text-danger">*</span></label> 
                        <textarea class="form-control" v-model="form.recommendation" :class="{ 'is-invalid': form.errors.has('recommendation') }" id="recommendation" @change="onChange('recommendation')"></textarea>
                        <has-error :form="form" field="recommendation"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Recommendation Date:<span class="text-danger">*</span></label> 
                        <input type="date" class="form-control form-control-sm" v-model="form.recommendation_date" :class="{ 'is-invalid': form.errors.has('recommendation_date') }" id="recommendation_date" @change="onChange('recommendation_date')">
                        <has-error :form="form" field="recommendation"></has-error>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="button" @click="save" class="btn btn-flat btn-sm btn-primary"  data-dismiss="modal" aria-label="Save">
                        <i class="fa fa-save"></i><span aria-hidden="true"> Save</span>
                    </button>
                </div>
            </div>
        </form>
    </div>     
</template>
<script>
export default {
    data() {
        return {
            schools:[],
            division:'',
            year:'',
            input:'',
            activity: '',
            output:'',
            dzongkhags:[],
            form: new form({
                dzon_id:'',
                school_id:'',
                agency_input_id:'',
                observation:'',
                recommendation:'',
                recommendation_date:'',
                action_type:'add'
            })
        }
    },
    methods: {
        onChange(id){
            if($('#' + id).val()!=""){
               $('#'+id).removeClass('is-invalid select2');
               $('#'+id).addClass('select2');
            }
        },
        getorgName(orgId){
            let type="Headquarterbyid";
            axios.get('loadCommons/loadOrgDetails/'+type+'/'+orgId)
            .then(response => {
                let data = response.data.data;
                this.division=data['name'];

            })
            .catch(errors => {
                console.log(errors)
            });
        },
        async getSchools(){
             this.schools = await this.schoolList(this.form.dzon_id);
        },
        getAgencyInputFormDetail(){
            axios.get('spms/getAgencyInputFormDetail/'+this.form.agency_input_id)
            .then(response => { 
                let data = response.data.data
                for(let i = 0; data.length > 0; i++){
                    this.getorgName(data[i]['org_division_id']);
                    this.form.agency_input_id = data[i]['agency_input_id'];
                    this.form.dzon_id = data[i]['dzon_id'];
                    this.year = data[i]['input_year'];
                    this.input = data[i]['input'];
                    this.activity = data[i]['activity'];
                    this.output = data[i]['output'];
                }
            }).catch(function (error){
                console.log(error)
            });
        },
		save(){
            this.form.post('/spms/saveObservationAgencyInputForm',this.form)
                .then(() => {
                Toast.fire({
                    icon: 'success',
                    title: 'Details added successfully'
                })
                this.$router.push('/list-agency-input-form');
            })
            .catch(() => {
                console.log("Error......")
            })
		}
    },
    created(){
        this.form.agency_input_id =this.$route.params.data.id
    },
    async mounted(){ 
        this.dzongkhags = await this.loadactivedzongkhags()
        this.getAgencyInputFormDetail()
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').select2().
        on("select2:select", e => {
            const event = new Event("change", { bubbles: true, cancelable: true });
            e.params.data.element.parentElement.dispatchEvent(event);
        })
        .on("select2:unselect", e => {
        const event = new Event("change", { bubbles: true, cancelable: true });
        e.params.data.element.parentElement.dispatchEvent(event);
        });
    },
}
</script>