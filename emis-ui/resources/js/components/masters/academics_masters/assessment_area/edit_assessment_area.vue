<template>
    <div>
        <form class="bootbox-form">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Subject:<span class="text-danger">*</span></label> 
                       <select class="form-control select2" id="aca_sub_id" v-model="form.aca_sub_id" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('aca_sub_id') }" @change="onChange('aca_sub_id')">
                            <option value=""> --Select--</option>
                            <option v-for="(item, index) in subject_list" :key="index" v-bind:value="item.id" :data-category-id="item.aca_sub_category_id">
                                {{ item.name }}
                            </option>
                        </select> 
                        <has-error :form="form" field="aca_sub_id"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Assessment Area:<span class="text-danger">*</span></label>
                        <input class="form-control form-control-sm" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" id="name" @change="remove_err('name')" type="text">
                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Dzongkha Assessment Area:</label>
                        <input class="form-control form-control-sm" v-model="form.dzo_name" :class="{ 'is-invalid': form.errors.has('dzo_name') }" id="dzo_name" @change="remove_err('dzo_name')" type="text">
                        <has-error :form="form" field="dzo_name"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Assessment Area Code:<span class="text-danger">*</span></label>
                        <input class="form-control form-control-sm" v-model="form.code" :class="{ 'is-invalid': form.errors.has('name') }" id="name" @change="remove_err('name')" type="text">
                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Assessment Type:<span class="text-danger">*</span></label> 
                           <select class="form-control select2" id="aca_assmnt_type" v-model="form.aca_assmnt_type" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('aca_assmnt_type') }" @change="onChange('aca_assmnt_type')">
                            <option value="">--Select--</option>
                            <option value="0">Continuous Assessment</option>
                            <option value="1">Term Examination</option>
                        </select> 
                        <has-error :form="form" field="aca_assmnt_type"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Rating Type:</label> 
                         <select v-model="form.aca_rating_type_id" class="form-control select2" id="aca_rating_type_id" :class="{ 'is-invalid': form.errors.has('aca_rating_type_id') }"> -->
                           <option v-for="(item, index) in filterRating(1)" :key="index" :value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="aca_sub_group_id"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Display Order:<span class="text-danger">*</span></label>
                        <input class="form-control form-control-sm text-right" v-model="form.display_order" :class="{ 'is-invalid': form.errors.has('display_order') }" id="display_order" @change="remove_err('display_order')" type="number">
                        <has-error :form="form" field="order"></has-error>
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
            subject_list:[],
            rating_type_list:[],
            form: new form({
                aca_sub_id:'',
                aca_rating_type_id:'',
                aca_assmnt_type:'',
                name: '',
                dzo_name:'',
                code:'',
                display_order:'',
                status: 1,
                record_type:'assessment_area',
                action_type:'edit',
            })
        }
    },
    methods: {
        loadSubList(uri = 'masters/loadAcademicMasters/all_active_subject_and_sub_subject'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.subject_list =  data.data.data
              
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        onChange(field_id){
              if($('#' + field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid select2');
                $('#'+field_id).addClass('select2');
            }
            this.filterRating()
        },
        loadRatingTypeList(uri = 'masters/loadAcademicMasters/all_active_rating_type'){
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.rating_type_list = data.data.data
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        filterRating(){
           var aca_sub_category_id = $('#aca_sub_id option:selected').data('category-id')
            var ratingtypes = ""
            this.rating_type_list.forEach((item,index)=>{
                if(item.input_type != 1 && (item.aca_sub_category_id == aca_sub_category_id || item.aca_sub_category_id === null )){
                    ratingtypes += ("<option value='" + item.id + "'>" + item.name + "</option>")
                }
            })
            $("#aca_rating_type_id").html(ratingtypes) 
        },
		formaction: function(type){
            if(type=="reset"){
                this.form.aca_sub_id = '';
                this.form.aca_rating_type_id = '';
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
                    console.log(this.form);
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
        this.loadRatingTypeList()
        this.filterRating();
    },
      created() {
        this.form.aca_sub_id=this.$route.params.data.aca_sub_id;
        this.form.aca_rating_type_id=this.$route.params.data.aca_rating_type_id;
        this.form.aca_assmnt_type=this.$route.params.data.aca_assmnt_type;
        this.form.display_order = this.$route.params.data.display_order;
        this.form.name=this.$route.params.data.assessment_area_name;
        this.form.dzo_name =this.$route.params.data.area_dzo_name;
        this.form.code = this.$route.params.data.assessment_area_name
        this.form.code =this.$route.params.data.code;
        this.form.status=this.$route.params.data.status;
        this.form.id=this.$route.params.data.id;
    },
}
</script>