<template>
    <div>
        <form class="bootbox-form" autocomplete="off">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Subject :<span class="text-danger">*</span></label> 
                        <select class="form-control select2 subject" id="subject_id" v-model="form.aca_sub_id" :class="{ 'is-invalid': form.errors.has('aca_sub_id') }" @change="onChange">
                            <option value=""> --Select--</option>
                            <option v-for="(item, index) in subject_list" :key="index" v-bind:value="item.id" :data-category-id="item.aca_sub_category_id">
                                {{ item.name }}
                                <span v-if="item.dzo_name">( {{item.dzo_name}} )</span>
                            </option>
                        </select> 
                        <has-error :form="form" field="aca_sub_category_id"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Assessment Area:<span class="text-danger">*</span></label>
                        <input class="form-control form-control-sm" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" id="name" @change="remove_err('name')" type="text">
                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Assessment Area (In Dzongkha Text):</label>
                        <input class="form-control form-control-sm" v-model="form.dzo_name" :class="{ 'is-invalid': form.errors.has('dzo_name') }" id="dzo_name" @change="remove_err('dzo_name')" type="text">
                        <has-error :form="form" field="dzo_name"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Assessment Area Abbreviation:<span class="text-danger">*</span></label>
                        <input class="form-control form-control-sm" v-model="form.code" :class="{ 'is-invalid': form.errors.has('name') }" id="name" @change="remove_err('name')" type="text">
                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Rating Type:</label> 
                         <select v-model="form.aca_rating_type_id" class="form-control select2" id="aca_rating_type_id"> 
                            <option value="">--Select--</option>
                        </select> 
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Display Order:<span class="text-danger">*</span></label>
                        <input class="form-control form-control-sm text-right" v-model="form.display_order" :class="{ 'is-invalid': form.errors.has('display_order') }" id="display_order" @change="remove_err('display_order')" type="number" min="0">
                        <has-error :form="form" field="display_order"></has-error>
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
            filtered_rating_type:[],
            form: new form({
                aca_sub_id:'',
                aca_rating_type_id:'',
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
        remove_err(field_id){
            if($('#' + field_id).val()!=""){
                $('#' + field_id).removeClass('is-invalid')
            }
        },
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
        onChange(){
		    var aca_sub_category_id = $('#subject_id option:selected').data('category-id')
            var ratingtypes = "<option value=''>--Select--</option>"
            this.rating_type_list.forEach((item,index)=>{
                if(item.input_type != 1 && (item.aca_sub_category_id == aca_sub_category_id || item.aca_sub_category_id === null )){
                    ratingtypes += ("<option value='" + item.id + "'>" + item.name + "</option>")
                }
            })
            $("#aca_rating_type_id").html(ratingtypes) 
        },
        loadRatingTypeList(){
            let uri = 'masters/loadAcademicMasters/all_active_rating_type'
            axios.get(uri)
            .then(response =>{
                this.rating_type_list = response.data.data
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
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
    },
}
</script>