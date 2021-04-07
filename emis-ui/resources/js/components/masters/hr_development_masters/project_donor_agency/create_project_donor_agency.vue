<template>
    <div>
        <form class="bootbox-form" id="dzongkhagId">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Donor Agency:<span class="text-danger">*</span></label> 
                        <select v-model="form.parent_field" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('parent_field') }" class="form-control select2" name="parent_field" id="parent_field">
                            <option value=""> --Select--</option>
                            <option v-for="(item, index) in donorAgencyLis" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="parent_field"></has-error>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Project of Donor Agency:<span class="text-danger">*</span></label> 
                        <input class="form-control" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" id="name" @change="remove_err('name')" type="text">
                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Code:</label> 
                        <input class="form-control" v-model="form.code"  :class="{ 'is-invalid': form.errors.has('code') }" id="code" @change="remove_err('code')" type="number">
                        <has-error :form="form" field="code" ></has-error>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
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
                parent_field: '',
                name: '',
                code:'',
                status: 1,
                record_type:'project_donor_agency',
                action_type:'add',
            })
        }
    },
    methods: {
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },
        loaddonorList(uri = 'masters/loadHrDevelopmentMastersData/active_donor_list'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.donorAgencyLis =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error:"+error);
            });
        },
		formaction: function(type){
            if(type=="reset"){
                this.form.name= '';
                this.form.code='';
                this.form.status= 1;
            }
            if(type=="save"){
                this.form.post('/masters/saveHrDevelopmentMasters',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/list_project_donor_agency');
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		}, 
    },
    mounted(){
        this.loaddonorList();
    },
}
</script>