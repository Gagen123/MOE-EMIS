<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs" id="t_form_details">
            <div class="card-body pt-0 mt-1">
                <div class="row">
                    <div class="form-row">
                        <div class="col-md-12">
                        <label class="form-control-label"  for="input-file-import">Upload Data<span class="text-danger">(Excel,CSV)</span></label>
                        <input type="file" class="form-control" :class="{ ' is-invalid' : error.message }" id="input-file-import" name="file_import" ref="import_file"   @change="onFileChange">
                        </div>
                    </div>
                </div><br>
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="application-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="row form-group">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Name of Institute:<span class="text-danger">*</span></label> 
                                <input class="form-control" v-model="form.collegeName" :class="{ 'is-invalid': form.errors.has('year') }" id="year"  type="text">
                                <has-error :form="form" field="year"></has-error>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Dzongkhag/Thromde:<span class="text-danger">*</span></label> 
                                    <select v-model="form.dzongkhag" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('dzongkhag') }" class="form-control select2" name="dzongkhag" id="dzongkhag">
                                        <option value=""> -- Select-- </option>
                                        <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                    </select>
                                    <has-error :form="form" field="dzongkhag"></has-error>
                                <span class="text-danger" id="dzongkhag_err"></span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Institutes Type:<span class="text-danger">*</span></label> 
                                    <select class="form-control editable_fields" v-model="form.institutes_type">
                                        <option  value="Monastic Insitute">Monastic Insitutes</option>
                                        <option value="Tertiary Institutes">Tertiary Institutes</option>
                                        <option value="Technical/Vocational Institues">Technical/Vocational Institues</option>
                                        <option  value="Zorig Chusum">Zorig Chusum</option>
                                    </select> 
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Institutes own by:<span class="text-danger">*</span></label> <br>
                                    <label><input v-model="form.own_by"  type="radio" value="Govt" /> Government</label> &nbsp;&nbsp;
                                    <label><input v-model="form.own_by"  type="radio" value="Pvt" /> Private</label>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="required">Status:<span class="text-danger">*</span></label>
                                <br>
                                    <label><input v-model="form.status"  type="radio" value="1" /> Active</label>
                                    <label><input v-model="form.status"  type="radio" value="0" /> Inactive</label>
                            </div>
                         </div>
                    </div>
                </div>
                    <div class="form-group row">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <label class="mb-0.5">Remarks:<span class="text-danger">*</span></label>
                            <textarea  class="form-control" v-model="form.remarks" :class="{ 'is-invalid': form.errors.has('remarks') }" name="remarks" id="remarks"></textarea>
                            <has-error :form="form" field="remarks"></has-error>
                        </div>
                    </div>
                <div class="card-footer text-right">
                    <button type="button" @click="formaction('reset')" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-redo"></i> Reset</button>
                    <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>                                               
                </div> 
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return {
          error: {},
          import_file: '',
           dzongkhagList:[],
            form: new form({
                collegeName:'',
                dzongkhag:'',
                own_by:'',
                status:'',
                remarks:'',
                institutes_type:'',
                action_type:'add',
                type:'institutes',
               
            })
        }
    },
    methods: {
         //staff addmore
        staffremove_err(field_id){
        if($('#'+field_id).val()!=""){
            $('#'+field_id).staffremoveClass('is-invalid');
        }
        },
        loadactivedzongkhagList(uri="masters/loadGlobalMasters/all_active_dzongkhag"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dzongkhagList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error:"+error)
            });
        },
        onFileChange(e) {
           this.import_file = e.target.files[0];
       },
       formaction: function(type){ 
            if(type=="reset"){
                this.restForm();
            }
             if(type=="save"){
                     this.form.post('students/ExternalDataImport/saveImported/',this.form)
                    .then(() => {
                        Toast.fire({
                            icon: 'success',
                            title: 'Details added successfully'
                        })
                        this.$router.push('/list_instittute');
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		},
         changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="dzongkhag"){
                this.form.dzongkhag=$('#dzongkhag').val();
            }
        },
     },
    mounted() {
        this.loadactivedzongkhagList();
       $('[data-toggle="tooltip"]').tooltip();
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id'));
        });

        Fire.$on('changefunction',(id)=> {
            this.changefunction(id);
        });
    },
}
</script>
