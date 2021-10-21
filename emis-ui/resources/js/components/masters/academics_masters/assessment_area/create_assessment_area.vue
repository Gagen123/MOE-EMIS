<template>
    <div>
        <form class="bootbox-form" autocomplete="off">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Subject :<span class="text-danger">*</span></label> 
                        <select class="form-control select2" id="aca_sub_id" v-model="form.aca_sub_id" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('aca_sub_id') }" @change="onChange('aca_sub_id')">
                            <option value=""> --Select--</option>
                            <option v-for="(item, index) in subject_list" :key="index" v-bind:value="item.id" :data-category-id="item.aca_sub_category_id">
                                {{ item.name }}
                                <span v-if="item.dzo_name">( {{item.dzo_name}} )</span>
                            </option>
                        </select> 
                        <has-error :form="form" field="aca_sub_id"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Assessment Area:<span class="text-danger">*</span></label>
                        <input class="form-control form-control-sm" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" id="name" @change="onChange('name')" type="text">
                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Assessment Area (In Dzongkha Text):</label>
                        <input class="form-control form-control-sm" v-model="form.dzo_name" :class="{ 'is-invalid': form.errors.has('dzo_name') }" id="dzo_name" @change="onChange('dzo_name')" type="text">
                        <has-error :form="form" field="dzo_name"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Assessment Area Abbreviation:<span class="text-danger">*</span></label>
                        <input class="form-control form-control-sm" id="code" v-model="form.code" :class="{ 'is-invalid': form.errors.has('code') }" @change="onChange('code')" type="text">
                        <has-error :form="form" field="code"></has-error>
                    </div>
                     <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Assessment Type:<span class="text-danger">*</span></label> 
                           <select class="form-control select2" id="aca_assmnt_type" v-model="form.aca_assmnt_type" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('aca_assmnt_type') }" @change="onChange('aca_assmnt_type')">
                             <option value="">--Select--</option>
                            <option value="0">Continuous Assessment</option>
                            <option value="1">Term Examination</option>
                            <option value="2">Others (Personal Traits, SUPW, Non-Academic Subject)</option>
                        </select> 
                        <has-error :form="form" field="aca_assmnt_type"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                         <label>Is Descriptive Comment:</label> 
                        <div class="form-check">
                            <input v-model="form.is_descriptive" class="form-check-input" type="checkbox" true-value="1" false-value="0" checked>
                        </div>
                    </div>
                </div>  
                <div class="row form-group">
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Display Order:<span class="text-danger">*</span></label>
                        <input class="form-control form-control-sm text-right" v-model="form.display_order" :class="{ 'is-invalid': form.errors.has('display_order') }" id="display_order" @change="onChange('display_order')" type="number" min="0">
                        <has-error :form="form" field="display_order"></has-error>
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
            subject_list:[],
            descriptive_rating_type:'',
            filtered_rating_type:[],
            form: new form({
                aca_sub_id:'',
                aca_assmnt_type:'',
                is_descriptive:0,
                name: '',
                dzo_name: '',
                code:'',
                display_order:'',
                status: 1,
                record_type:'assessment_area',
                action_type:'add',
            })
        }
    },
    methods: {
        loadSubList(uri = 'masters/loadAcademicMasters/all_active_subject'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.subject_list =  data.data.data
              
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        onChange(id){
            if($('#' + id).val()!=""){
               $('#'+id).removeClass('is-invalid select2');
               $('#'+id).addClass('select2');
            }
        },
		formaction: function(type){
            if(type=="reset"){
                this.form.aca_sub_id = '';
                this.form.is_descriptive = 0;
                this.form.aca_assmnt_type = '';
                this.form.name = '';
                this.form.dzo_name = '';
                this.form.name = '';
                this.form.code = '';
                this.form.display_order = '';
                this.form.status= 1;
            }
            if(type=="save"){
                this.form.post('/masters/saveAcademicMasters',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/list-assessment-area');
                })
                .catch(() => {
                    console.log("Error......")
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
            const event = new Event("change", { bubbles: true, cancelable: true });
            e.params.data.element.parentElement.dispatchEvent(event);
        })
        .on("select2:unselect", e => {
        const event = new Event("change", { bubbles: true, cancelable: true });
        e.params.data.element.parentElement.dispatchEvent(event);
        });
        this.loadSubList()
    },
}
</script>
