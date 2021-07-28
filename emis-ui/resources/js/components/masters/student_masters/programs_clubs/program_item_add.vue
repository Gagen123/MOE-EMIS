<template>
    <div>
        <form class="bootbox-form" id="programRolesId">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>Item Variety:<span class="text-danger">*</span></label>
                        <select v-model="form.variety" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('variety') }" class="form-control" name="variety" id="variety">
                            <option v-for="(item, index) in varietyList" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                        </select>
                        <has-error :form="form" field="variety"></has-error>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>Item Name:<span class="text-danger">*</span></label>
                        <input class="form-control" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" id="name" @change="remove_err('name')" type="text">
                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label class="required">Applicable:</label>
                        <br>
                        <label><input v-model="form.central"  type="checkbox" /> Centrally Procured</label>
                        <label><input v-model="form.local"  type="checkbox"/> Locally Procured</label>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label class="required">Status:</label>
                        <br>
                        <label><input v-model="form.status"  type="radio" value="1" /> Active</label>
                        <label class="pl-2"><input v-model="form.status"  type="radio" value="0" /> Inactive</label>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>Unit:</label>
                        <select v-model="form.unit_id" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('unit_id') }" class="form-control" name="unit_id" id="unit_id">
                            <option v-for="(item, index) in measurementList" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                        </select>
                        <has-error :form="form" field="unit_id"></has-error>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>Description:</label>
                        <textarea class="form-control" v-model="form.description" id="description" type="text"/>
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
            measurementList:[],
            varietyList:[],
            form: new form({
                id: '',
                name: '',
                variety:'',
                central:'',
                unit_id:'',
                local:'',
                description:'',
                status: 1,
                record_type:'program_item',
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
		formaction: function(type){
            if(type=="reset"){
                this.form.name= '';
                this.form.description='';
                this.form.status= 1;
            }
            if(type=="save"){
                if($('#centralcheck').prop('checked')){
                    this.form.central=1;
                }
                else{
                    this.form.central=0;
                }

                if($('#localcheck').prop('checked')){
                    this.form.local=1;
                }
                else{
                    this.form.local=0;
                }
                this.form.post('/masters/saveStudentMasters',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/program_item_list');
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		},
        loadMeasurementList(uri = 'masters/loadStudentMasters/program_measurement_Active'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.measurementList =  data.data.data;
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        loadVarietyList(uri = 'masters/loadActiveStudentMasters/item_variety'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.varietyList =  data.data.data;
            })
            .catch(function (error) {
                console.log(error);
            });
        },
    },
    created() {
        this.loadMeasurementList();
        this.loadVarietyList();
    },

}
</script>
