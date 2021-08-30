<template>
    <div>
        <form class="bootbox-form" autocomplete="off">
            <strong class="ml-3">Create Agency Input</strong>
            <div class="card-body">
                <div class="row form-group">
                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Division:</label> 
                           <input class="form-control form-control-sm" type="text" v-model="form.name" readonly>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Year:<span class="text-danger">*</span></label> 
                        <select class="form-control select2" id="year" v-model="form.year">
                                <option :value="form.year">{{form.year}}</option>
                                <option :value="form.year-1">{{form.year-1}}</option>
                                <option :value="form.year-2">{{form.year-2}}</option>
                                <option :value="form.year+1">{{form.year+1}}</option>
                                <option :value="form.year+2">{{form.year+2}}</option>
                        </select> 
                        <has-error :form="form" field="year"></has-error>
                    </div>
                </div>  
                <div class="row form-group">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>Input:<span class="text-danger">*</span></label> 
                        <textarea class="form-control form-control-sm" v-model="form.input" :class="{ 'is-invalid': form.errors.has('input') }" id="input" @change="onChange('input')"></textarea>
                        <small class="form-text text-muted">Resources & trainings provided by the agency.</small>
                        <has-error :form="form" field="input"></has-error>
                    </div>
                </div>          
                <div class="row form-group">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>Process/Activities:<span class="text-danger">*</span></label> 
                        <textarea class="form-control form-control-sm" v-model="form.activity" :class="{ 'is-invalid': form.errors.has('activity') }" id="activity" @change="onChange('activity')"></textarea>
                        <small class="form-text text-muted">What schools are expected to do using input provided.</small>
                        <has-error :form="form" field="activity"></has-error>
                    </div>
                </div>  
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label>Output:<span class="text-danger">*</span></label> 
                    <textarea class="form-control form-control-sm" v-model="form.output" :class="{ 'is-invalid': form.errors.has('output') }" id="output" @change="onChange('output')"></textarea>
                    <small class="form-text text-muted">What are the expected products/services to be achieved by schools.</small>
                    <has-error :form="form" field="output"></has-error>
                </div>
                </div>  
            </div>
            <div class="card-footer text-right">
                <button type="button" @click="save" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
    </div>     
</template>
<script>
export default {
    data() {
        return {
            acess_level:'',
            form: new form({
                name:'',
                org_division_id:'',
                year:new Date().getFullYear(),
                input:'',
                activity: '',
                output:'',
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
        getorgName(orgId,accessLevel){
            let type="Headquarterbyid";
            if(accessLevel=="Org"){
                type="Orgbyid";
            }
            axios.get('loadCommons/loadOrgDetails/'+type+'/'+orgId)
            .then(response => {
                let data = response.data.data;
                this.form.name=data['name'];
                this.form.org_division_id=data['id'];
            })
            .catch(errors => {
                console.log(errors)
            });
        },
		save(){
            this.form.post('/spms/saveAgencyInputForm',this.form)
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
    mounted(){ 
        axios.get('common/getSessionDetail')
            .then(response => {
                let data = response.data.data;
                this.getorgName(data['Agency_Code'],data['acess_level']);
            })
            .catch(errors => {
                console.log(errors)
            });
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