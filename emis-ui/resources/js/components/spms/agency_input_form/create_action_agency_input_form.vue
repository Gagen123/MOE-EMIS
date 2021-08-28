<template>
    <div>
        <form class="bootbox-form" autocomplete="off">
            <strong class="ml-3">Create Action Taken</strong>
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
                        <label>Dzongkhag:</label> 
                            <br>
                            {{dzongkhag}}
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>School:</label> 
                            <br>
                            {{school}}
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>Observation:</label> 
                        <br>
                        {{observation}}
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Recommendation:</label> 
                        {{recommendation}}
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Recommendation Date:</label> 
                        {{recommendation_date}}
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>Action Taken by Agency:<span class="text-danger">*</span></label> 
                        <textarea class="form-control" v-model="form.action" :class="{ 'is-invalid': form.errors.has('action') }" id="action" @change="onChange('action')"></textarea>
                        <has-error :form="form" field="action"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Date of Action Taken:<span class="text-danger">*</span></label> 
                        <input type="date" class="form-control form-control-sm" v-model="form.action_date" :class="{ 'is-invalid': form.errors.has('action_date') }" id="action_date" @change="onChange('action_date')"/>
                        <has-error :form="form" field="action_date"></has-error>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="button" @click="save" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </form>
    </div>     
</template>
<script>
export default {
    data() {
        return {
            school:'',
            division:'',
            year:'',
            input:'',
            activity: '',
            output:'',
            observation:'',
            recommendation:'',
            recommendation_date:'',
            dzongkhag:'',
            form: new form({
                dzon_id:'',
                school_id:'',
                agency_input_id:'',
                agency_input_obs_id:'',
                action:'',
                action_date:'',
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
        async getAgencyInputFormDetail(){
            let dzongkhags = await this.loadactivedzongkhags()
            let agencyInputFormDetails = await axios.get('spms/getAgencyInputFormDetail/'+this.form.agency_input_id).then(response => { return response.data.data });
            let dzon_id = '';
            agencyInputFormDetails.forEach((item,index)  => {
                dzongkhags.forEach((item1) => {
                    if(item.dzon_id == item1.id){
                        dzon_id=item.dzon_id;
                        agencyInputFormDetails[index]['dzongkhag'] = item1.name;
                    }
                })
            });
            let schools = await this.schoolList(dzon_id);
            agencyInputFormDetails.forEach((item) => {
                schools.forEach(item1 =>{
                    if(item.school_id == item1.id){
                        this.getorgName(item['org_division_id']);
                        this.form.agency_input_id = item['agency_input_id'];
                        this.form.agency_input_obs_id = item['observation_id'];
                        this.year = item['input_year'];
                        this.input = item['input'];
                        this.activity = item['activity'];
                        this.output = item['output'];
                        this.school = item1['name'];
                        this.dzongkhag = item['dzongkhag'];
                        this.observation = item['observation'];
                        this.recommendation = item['recommendation'];
                        this.recommendation_date = item['recommendation_date'];
                    }
                })

            });
        },
		save(){
            this.form.post('/spms/saveActionAgencyInputForm',this.form)
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
        this.form.agency_input_obs_id = this.$route.params.data.observation_id
        
    },
    mounted(){ 
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