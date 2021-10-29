<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs" id="t_form_details">
            <div class="card-body pt-0 mt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="application-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="row form-group">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <input type="checkbox" name="data_type" id="data_type" @click="showExcel()"/>
                                <label>Import from Excel</label>
                            </div>
                        </div>
                        <span id="excel_sec" style="display: none">
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Attachment:</label>
                                    <input type="file" @change="remove_error('staff_file')" v-on:change="onChangeFileUpload" class="form-control" id="staff_file">
                                    <span class="text-danger" id="staff_file_err"></span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pt-4 mt-2">
                                    <button type="button" name="download" @click="downloadsample('institution_sample.xlsx')" class="btn btn-primary">
                                       <span class="fa fa-download"></span> Download Excel Format From Here!
                                    </button>
                                </div>
                            </div>
                        </span>
                        <span id="input_sec">
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
                        </span>
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
                    <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </div>

        <div class="modal show" id="result_data_modal" aria-modal="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Data To Be Updated</h4>
                    </div>
                    <div class="modal-body">
                        <form class="bootbox-form">
                            <div class="form-group row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label>Following are the data to be updated </label>
                                    <table id="staff-participant-table" class="table table-bordered text-sm table-striped">
                                        <thead>
                                            <tr>
                                                <th>SL#</th>
                                                <th>Name</th>
                                                <th>Dzongkhag</th>
                                                <th>Institution Type</th>
                                                <th>Own By</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(training, index) in excel_data_list" :key="index" >
                                                <td>{{ index + 1 }} </td>
                                                <td>{{ training.name }}</td>
                                                <td>{{ training.dzongkhag }}</td>
                                                <td>{{ training.institution_type }}</td>
                                                <td>{{ training.own_by}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer text-right">
                        <button data-bb-handler="cancel" @click="updateparticipant('Cancel')"  type="button" data-dismiss="modal" class="btn btn-danger">Cancel</button>
                        <button data-bb-handler="confirm" @click="updateparticipant('Save')" type="button" class="btn btn-primary">Confirm & Save Match Ones</button>
                    </div>
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
            excel_data_list:[],
            import_file: '',
            dzongkhagList:[],
            form: new form({
                collegeName:'',
                dzongkhag:'',
                own_by:'',
                status:'',
                remarks:'',
                ref_docs:[],
                institutes_type:'',
                input_type:'Input',
                action_type:'add',
                type:'institutes',

            })
        }
    },
    methods: {
        onChangeFileUpload(e){
            if(e.target.files[0]!=undefined){
                this.form.ref_docs=[];
                this.form.ref_docs.push({attachment:e.target.files[0]});
            }
            else{
                this.form.ref_docs.pop();
            }
        },
        showExcel(){
            if($('#data_type').prop('checked')){
                $('#excel_sec').show();
                $('#input_sec').hide();
            }else{
                $('#excel_sec').hide();
                $('#input_sec').show();
            }
        },
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
       validateField(){
           let returnval=true;
            if($('#data_type').prop('checked')){
                if($('#staff_file').val()==""){
                    $('#staff_file_err').html('Please attach Excel File');
                    returnval=false;
                }
                if($('#staff_file').val()!="" && !this.customfilevalidation($('#staff_file').val(),'xlsx')){
                    $('#staff_file_err').html('You are attaching invalid format. Please attach Excel File.');
                    returnval=false;
                }
            }
            return returnval;
       },
       formaction: function(type){
            if(type=="save" && this.validateField()){

                Swal.fire({
                    text: "Are you sure you wish to save this details ?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    cancelButtonText: 'No'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        if($('#data_type').prop('checked')){
                            this.form.input_type='Excel';
                        }
                        const config = {
                            headers: {
                                'content-type': 'multipart/form-data'
                            }
                        }
                        let formData = new FormData();
                        formData.append('collegeName', this.form.collegeName);
                        formData.append('dzongkhag', this.form.dzongkhag);
                        formData.append('own_by', this.form.own_by);
                        formData.append('status', this.form.status);
                        formData.append('remarks', this.form.remarks);
                        formData.append('institutes_type', this.form.institutes_type);
                        formData.append('input_type', this.form.input_type);
                        formData.append('action_type', this.form.action_type);
                        formData.append('type', this.form.type);
                        for(let i=0;i<this.form.ref_docs.length;i++){
                            formData.append('attachments[]', this.form.ref_docs[i].attachment);
                        }
                        axios.post('students/ExternalDataImport/saveImported', formData, config)
                        .then((response) => {
                            if(this.form.input_type=="Excel"){
                                this.excel_data_list=response.data;
                                $('#result_data_modal').modal('show');
                            }else{
                                $('#result_data_modal').modal('hide');
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Details added successfully'
                                })
                                this.$router.push('/list_instittute');
                            }
                        })
                        .catch(() => {
                            console.log("Error......")
                        })
                    }
                });
            }
		},
        updateparticipant(type){
            Swal.fire({
                text: "Are you sure you wish to "+type+" this selected file ?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
                cancelButtonText: 'No'
                }).then((result) => {
                if (result.isConfirmed) {
                    let uri = 'students/ExternalDataImport/updateExcelfile/'+type+'/InstitutionData';
                    axios.get(uri)
                    .then(response => {
                        let data = response;
                        if(data.data){
                            Swal.fire(
                                'Success!',
                                'Record has been Updated successfully.',
                                'success',
                            );
                            $('#participant_modal').modal('hide');
                        }
                        else{
                            Swal.fire(
                                'error!',
                                'Not able to update this record. Please try again.',
                                'error',
                            );
                        }
                    })
                    .catch(function (error) {
                        console.log("Error:"+error);
                    });
                }
            });
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
