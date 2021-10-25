<template>
    <div>
        <form class="bootbox-form" id="dzongkhagId">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Donor Agency:<span class="text-danger">*</span></label>
                        <select v-model="form.doner_agency" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('doner_agency') }" class="form-control select2" name="doner_agency" id="doner_agency">
                            <option value=""> --Select--</option>
                            <option v-for="(item, index) in donorAgencyLis" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="doner_agency"></has-error>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
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
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Code:</label>
                        <input class="form-control" v-model="form.code" :class="{ 'is-invalid': form.errors.has('code') }" id="dzongkhagcode" @change="remove_error('dzongkhagcode')" type="text">
                        <has-error :form="form" field="code" ></has-error>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label class="required">status:</label>
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
                doner_agency:'',
                name: '',
                description:'',
                code:'',
                status:'',
                model:'hr_development_masters___ProjectDonerAgency',
                action_type:'edit',
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
    async created() {
        this.donorAgencyLis =  await this.loadstaffMasters('active','hr_development_masters___Donor');
        if(this.$route.params.data.donor!=null){
            this.form.doner_agency=this.$route.params.data.donor.id;
        }
        $('#doner_agency').val('this.$route.params.data.majorgroup.id');
        this.form.name=this.$route.params.data.name;
        this.form.code=this.$route.params.data.code;
        this.form.description=this.$route.params.data.description;
        this.form.status=this.$route.params.data.status;
        this.form.id=this.$route.params.data.id;
    },
}
</script>
