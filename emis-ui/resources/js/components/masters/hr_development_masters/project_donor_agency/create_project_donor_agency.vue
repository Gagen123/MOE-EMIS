<template>
    <div>
        <form class="bootbox-form" id="dzongkhagId">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Donor Agency:<span class="text-danger">*</span></label>
                        <select v-model="form.doner_agency" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('doner_agency') }" class="form-control select2" name="doner_agency" id="doner_agency">
                            <option value=""> --Select--</option>
                            <option v-for="(item, index) in donorAgencyLis" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="doner_agency"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Project of Donor Agency:<span class="text-danger">*</span></label>
                        <input class="form-control" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" id="name" @change="remove_error('name')" type="text">
                        <has-error :form="form" field="name"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <label>Description:</label>
                        <textarea class="form-control" v-model="form.description" :class="{ 'is-invalid': form.errors.has('description') }" id="description" @change="remove_error('description')" ></textarea>
                        <has-error :form="form" field="description"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Code:</label>
                        <input class="form-control" v-model="form.code"  :class="{ 'is-invalid': form.errors.has('code') }" id="code" @change="remove_error('code')" type="text">
                        <has-error :form="form" field="code" ></has-error>
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
                <button type="button" @click="formaction('reset')" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-redo"></i> Reset</button>
                <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    data() {
        return {
            donorAgencyLis:[],
            form: new form({
                id: '',
                doner_agency: '',
                name: '',
                description:'',
                code:'',
                status: 1,
                model:'hr_development_masters___ProjectDonerAgency',
                action_type:'add',
            })
        }
    },
    methods: {
		formaction: function(type){
            if(type=="reset"){
                this.form.name= '';
                this.form.code='';
                this.form.description='';
                this.form.status= 1;
            }
            if(type=="save"){
                this.submitstaffmaster('list_project_donor_agency');
            }
		},
    },
    async mounted(){
        this.donorAgencyLis =  await this.loadstaffMasters('active','hr_development_masters___Donor');
    },
}
</script>
