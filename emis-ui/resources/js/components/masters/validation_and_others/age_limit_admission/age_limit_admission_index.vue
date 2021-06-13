<template>
    <div>
        <div class="card card-primary card-outline">
            <div class="card card-body">
                <section class="content ml-n4 mr-n3">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card">
                                    <div class="card-header bg-white pt-2 pb-1 text-right">
                                        <span class="card-title pt-2 mb-0">
                                            <b>Age Limit Validation for ECCD</b>
                                        </span>
                                    </div>
                                    <div class="card-body">
                                        <div class="row form-group">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <label>Date:<span class="text-danger">*</span></label>
                                                <input class="form-control" v-model="form.date" :class="{ 'is-invalid': form.errors.has('date') }" id="date" @change="remove_err('name')" type="date">
                                                <has-error :form="form" field="date"></has-error>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <label class="required">Total Months:</label>
                                                <input class="form-control" v-model="form.no_months" :class="{ 'is-invalid': form.errors.has('no_months') }" id="no_months" @change="remove_err('no_months')" type="number" min="1">
                                                <has-error :form="form" field="no_months"></has-error>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-header bg-white pt-2 pb-1 text-right">
                                        <span class="card-title pt-2 mb-0">
                                            <b>Age Limit Validation for PP</b>
                                        </span>
                                    </div>
                                    <div class="card-body">
                                        <div class="row form-group">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <label>Date:<span class="text-danger">*</span></label>
                                                <input class="form-control" v-model="form.date1" :class="{ 'is-invalid': form.errors.has('date1') }" id="date1" @change="remove_err('date1')" type="date">
                                                <has-error :form="form" field="date1"></has-error>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <label class="required">Total Months:</label>
                                                <input class="form-control" v-model="form.no_months1" :class="{ 'is-invalid': form.errors.has('no_months1') }" id="no_months1" @change="remove_err('no_months1')" type="number" min="1">
                                                <has-error :form="form" field="no_months1"></has-error>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button type="button" @click="formaction('reset')" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-redo"></i> Reset</button>
                                        <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            form: new form({
                id: '',
                date: '',
                date1: '',
                status: 1,
                no_months:'',
                no_months1:'',
            })
        }
    },
    methods: {
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },
        restForm(){
            this.form.id= '';
            this.form.date= '';
            this.form.date1= '';
            this.form.status=1;
            this.form.no_months='';
            this.form.no_months1='';
        },
        formaction(type){
            if(type=="reset"){
                this.restForm();
            }
            if(type=="save"){
                this.form.post('/masters/saveValidationcondition')
                .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: ' Detail is added successfully'
                    })
                })
                .catch((err)=>{
                    console.log("Error:"+err);
                    this.applyselect();
                })
            }
		},
        loadexistinglist(){
            let uri='masters/loadValidationcondition';
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.form.date=data.date;
                this.form.date1=data.date1;
                this.form.status=data.status;
                this.form.no_months=data.no_months;
                this.form.no_months1=data.no_months1;
            })
            .catch(function (error) {
                console.log('error: '+error);
            });
        }
    },
    mounted(){
        this.loadexistinglist();
    },
}
</script>

