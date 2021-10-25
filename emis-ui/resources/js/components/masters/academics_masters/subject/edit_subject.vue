<template>
    <div>
        <form class="bootbox-form" id="subjectGroup" autocomplete="off"> 
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Subject :<span class="text-danger">*</span></label> 
                        <input class="form-control form-control-sm" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" id="name" @change="remove_err('dzongkhag_name')" type="text">
                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Code<span class="text-danger">*</span></label> 
                        <input class="form-control form-control-sm" v-model="form.code" :class="{ 'is-invalid': form.errors.has('code') }" id="code" @change="remove_err('code')" type="text">
                        <has-error :form="form" field="code"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Subject Category:<span class="text-danger">*</span></label> 
                        <select class="form-control form-control-sm select2" id="subject_category_id" v-model="form.aca_sub_category_id" :class="{ 'is-invalid': form.errors.has('aca_sub_category_id') }"  @change="remove_err('subject_category_id')">
                            <option value=""> --Select--</option>
                            <option v-for="(item, index) in subject_category_list" :key="index" v-bind:value="item.id">{{ item.name }} 
                                <span v-if="item.dzo_name">( {{ item.dzo_name }} )</span>
                            </option>
                        </select> 
                        <has-error :form="form" field="aca_sub_category_id"></has-error>
                    </div>
                </div>  
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Subject (In Dzongkha Text):</label>
                        <input class="form-control form-control-sm" v-model="form.dzo_name" :class="{ 'is-invalid': form.errors.has('name') }" id="name" @change="remove_err('name')" type="text">
                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Display Order:<span class="text-danger">*</span></label>
                        <input class="form-control form-control-sm text-right" v-model="form.display_order" :class="{ 'is-invalid': form.errors.has('display_order') }" id="display_order" @change="remove_err('display_order')" type="number" min="0">
                        <has-error :form="form" field="display_order"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="required">Aessessed by Class Teacher:</label>
                        <br> 
                        <label><input v-model="form.assessed_by_class_teacher"  type="radio" value="1" />Yes</label>
                        <label><input v-model="form.assessed_by_class_teacher"  type="radio" value="0" />No</label>
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
    data() {
        return {
            subject_category_list:[],
            form: new form({
                id: '',
                name: '',
                code:'',
                aca_sub_category_id:'',
                dzo_name:'',
                assessed_by_class_teacher:0,
                display_order:'',
                status:'',
                record_type:'subject',
                action_type:'edit',
            })
        }
    },
    methods: {
        loadSubcategoryList(uri = 'masters/loadAcademicMasters/all_active_subject_category'){
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.subject_category_list = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },
		formaction: function(type){
            if(type=="reset"){
                this.form.name = '';
                this.form.dzo_name = '';
                this.form.display_order = '';
                this.form.status= 1;
            }
            if(type=="save"){
                this.form.post('/masters/saveAcademicMasters',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details updated successfully'
                    })
                    this.$router.push('/list-subject');
                })
                .catch(() => { 
                    console.log("Error.")
                })
            }
		}, 
    },
    created() {
        this.form.aca_sub_category_id = this.$route.params.data.aca_sub_category_id
        this.form.name=this.$route.params.data.name;
        this.form.code=this.$route.params.data.code;
        this.form.dzo_name=this.$route.params.data.dzo_name;
        this.form.display_order = this.$route.params.data.display_order,
        this.form.assessed_by_class_teacher=this.$route.params.data.assessed_by_class_teacher;
        this.form.status=this.$route.params.data.status;
        this.form.display_order = this.$route.params.data.display_order,
        this.form.id=this.$route.params.data.id;
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
        this.loadSubcategoryList()
    }
    
}
</script>