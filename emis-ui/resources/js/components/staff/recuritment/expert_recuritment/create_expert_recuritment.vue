<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs" >
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs">
                    <li class="nav-item organization-tab">
                        <a class="nav-link active" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Application for principal Recuritment</label>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body pt-0 mt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details"  >
                        <div class="tab-pane fade active show tab-content-details">
                            <form class="form-horizontal">
                                <input type="hidden" class="form-control" v-model="form.id" id="id"/>
                                    <div class="form-group row">
                                        <div class="col-lg-10 col-md-10 col-sm-10">
                                            <label>Passport/Emigration Number:</label>
                                                <input type="text" class="form-control"  :class="{ 'is-invalid': form.errors.has('passport') }" id="passport" v-model="form.passport" placeholder="Passport/Emigration Number">
                                                <has-error :form="form" field="passport"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                          <label>Full Name:</label>
                                            <input type="text" class="form-control" @change="removeerror('name')" :class="{ 'is-invalid': form.errors.has('name') }" id="name" v-model="form.name">
                                            <has-error :form="form" field="name"></has-error>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                          <label>Date of Birth:</label>
                                            <input type="date" class="form-control" @change="removeerror('dob')" :class="{ 'is-invalid': form.errors.has('dob') }" id="dob" v-model="form.dob">
                                            <has-error :form="form" field="dob"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <label>Country:</label>
                                             <select v-model="form.country" :class="{'is-invalid': form.errors.has('country') }" class="form-control select2" name="country" id="country">
                                                <option v-for="(item, index) in countryList" :key="index" v-bind:value="item.id">{{ item.country_name }}</option>
                                            </select>
                                            <has-error :form="form" field=""></has-error>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 ">
                                            <label>Address:</label>
                                            <input type="text" class="form-control" @change="removeerror('address')" :class="{ 'is-invalid': form.errors.has('address') }" id="address" v-model="form.address">
                                            <has-error :form="form" field="address"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        
                                        <div class="col-lg-6 col-md-6 col-sm-6 ">
                                            <label>Email Address:</label>
                                            <input type="text" class="form-control" @change="removeerror('email')" :class="{ 'is-invalid': form.errors.has('email') }" id="email" v-model="form.email">
                                            <has-error :form="form" field="email"></has-error>
                                        </div>
                                        
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <label>Contact Number:</label>
                                            <input type="number" class="form-control" @change="removeerror('contact_number')" :class="{ 'is-invalid': form.errors.has('contact_number') }" id="contact_number" v-model="form.contact_number">
                                            <has-error :form="form" field="contact_number"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label class="mb-0">Upload the Required Documents</label>
                                        </div>
                                    </div><br>
                                    <div class="form-group row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>File Name</th>
                                                        <th>Upload File</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr id="record1" v-for='(att, index) in form.attachments' :key="index">
                                                        <td>
                                                            <input type="text" class="form-control" :class="{ 'is-invalid' :form.errors.has('file_name') }" v-model="att.file_name" :id="'file_name'+(index+1)">
                                                            <span class="text-danger" :id="'fileName'+(index+1)+'_err'"></span>
                                                        </td>
                                                        <td>
                                                            <input type="file" name="attachments" class="form-control application_attachment" v-on:change="onChangeFileUpload" :id="'attach'+(index+1)">
                                                            <span class="text-danger" :id="'attach'+(index+1)+'_err'"></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5">
                                                            <button type="button" class="btn btn-flat btn-sm btn-primary" id="addMore"
                                                            @click="addMore()"><i class="fa fa-plus"></i> Add More</button>
                                                            <button type="button" class="btn btn-flat btn-sm btn-danger" id="remove"
                                                            @click="remove()"><i class="fa fa-trash"></i> Remove</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                            </form>
                            <hr>
                            <div class="row form-group fa-pull-right">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button class="btn btn-primary" @click="applyforrecuritment()">Submit </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

export default {
    data(){
        return{
            countryList:[],
            form: new form({
                passport:'',
                name:'', 
                dob:'',
                country:'',
                address:'',
                email:'',
                contact_number:'',
                application_for:'Expatriate Recuritment',
                application_type:'Expatriate_Recuritment',
                action_type:'add', 
                status:'Submitted',
                organization_type:'',
                status:'Submitted',
                attachments:
                [{
                    file_name:'',attachment:''
                }],
                ref_docs:[],
            }),
        }
    },
    methods: {
        onChangeFileUpload(e){
            let currentcount=e.target.id.match(/\d+/g)[0];
            if($('#fileName'+currentcount).val()!=""){
                this.form.ref_docs.push({name:$('#file_name'+currentcount).val(), attach: e.target.files[0]});
                $('#fileName'+currentcount).prop('readonly',true);
            }
            else{
                $('#fileName'+currentcount+'_err').html('Please mention file name');
                $('#'+e.target.id).val('');
            }
        },
        addMore: function(){
            this.form.attachments.push({file_name:'', file_upload:''})
        },
        remove(index){
            if(this.form.attachments.length>1){
                this.form.attachments.pop();
            }
        },
       
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },

        loadcountryList(uri ='masters/loadGlobalMasters/all_country'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.countryList =  data.data.data;
            })
            .catch(function (error) {
                console.log('error: '+error);
            });
        },

        applyforrecuritment(){
            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }
            
            let formData = new FormData();
            formData.append('id', this.form.id);
            formData.append('ref_docs[]', this.form.ref_docs);
            for(let i=0;i<this.form.ref_docs.length;i++){
                formData.append('attachments[]', this.form.ref_docs[i].attach);
                formData.append('attachmentname[]', this.form.ref_docs[i].name);
            }
            formData.append('organizationId', this.form.organizationId);
            formData.append('passport', this.form.passport);
            formData.append('name', this.form.name);
            formData.append('dob', this.form.dob);
            formData.append('country', this.form.country);
            formData.append('address', this.form.address);
            formData.append('email', this.form.email);
            formData.append('contact_number', this.form.contact_number);
            formData.append('application_type', this.form.application_type);
            formData.append('application_for', this.form.application_for);
            formData.append('action_type', this.form.action_type);
            formData.append('status', this.form.status);
            axios.post('staff/StaffApprovalController/saveExpatriateRecuritment', formData, config)
            .then((response) => {
                if(response!=""){
                    if(response.data=="No Screen"){
                        Toast.fire({
                            icon: 'error',
                            title: 'No dont have privileged to submit this application. Please contact system administrator'
                        });
                    }
                    if(response!="" && response!="No Screen"){
                        let message="Application details has been submitted for approval. System Generated application number for this transaction is: <b>"+response.data.application_number+'.</b><br> Use this application number to track your application status. <br><b>Thank You !</b>';
                        this.$router.push({name:'expert_recuritment_acknowledgement',params: {data:message}});
                        Toast.fire({
                            icon: 'success',
                            title: 'Application is saved successfully'
                        });
                    }
                }
            })
            .catch((err) => {
                if(!$('#country').attr('class').includes('select2-hidden-accessible')){
                    $('#country').addClass('select2-hidden-accessible');
                }
                console.log("Error:"+err);
                this.form.errors.errors = err.response.data.errors;
            })
        },
         
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                
                $('#'+id).addClass('select2');
            }
            if(id=="country"){
                this.form.country=$('#country').val();
            }
        },
        getAttachmentType(type){
            this.form.attachments=[];
            axios.get('masters/organizationMasterController/loadOrganizaitonmasters/'+type+'/DocumentType')
            .then(response => {
                let data = response.data;
                data.forEach((item => {
                    this.form.attachments.push({file_name:item.name, file_upload:''});
                }));
            })
            .catch(errors => {
                console.log(errors)
            });
        },

    },

    mounted() {
        this.getAttachmentType('ForTransaction__Application_for_Principal_Recruitment');
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
        
        axios.get('common/getSessionDetail')
        .then(response => {
            let data = response.data.data;
            if(data['acess_level']=="Org"){
                this.form.organizationId=data['Agency_Code'];
                this.getorgdetials(data['Agency_Code']);
                $('#organizationId').val(data['Agency_Code']).trigger('change');
                $('#organizationId').prop('disabled',true);
            }
        })
        .catch(errors => {
            console.log(errors)
        });
    },
     created() {
         this.loadcountryList();
       
    },
}
</script>
