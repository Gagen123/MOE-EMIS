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
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <label>Cid Number:</label>
                                            <input type="text" class="form-control" @keyup.enter="getDetailsbyCID('cid')"   :class="{ 'is-invalid': form.errors.has('cid') }" id="cid" v-model="form.cid_passport" placeholder="Ref/cid No">
                                            <has-error :form="form" field="cid"></has-error>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <label>Name:</label>
                                            <input type="text" readonly :value="form.name"  class="form-control" id="name"/>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <label>Date of Birth:</label>
                                            <input type="text" readonly :value="form.dob"  class="form-control" id="dob"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <label>Dzongkhag:</label>
                                            <input type="text" readonly :value="form.dzongkhag"  class="form-control" id="dzongkhag"/>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <label>Gewog:</label>
                                            <input type="text" readonly :value="form.gewog"  class="form-control" id="gewog"/>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <label>Village:</label>
                                            <input type="text" readonly :value="form.village"  class="form-control" id="village"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <label>Present Address:</label>
                                             <input type="text" class="form-control" @change="removeerror('paddress')" :class="{ 'is-invalid': form.errors.has('paddress') }" id="paddress" v-model="form.paddress">
                                            <has-error :form="form" field="paddress"></has-error>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Email Address:</label>
                                            <input type="text" class="form-control" @change="removeerror('email')" :class="{ 'is-invalid': form.errors.has('email') }" id="email" v-model="form.email">
                                            <has-error :form="form" field="email"></has-error>
                                        </div>
                                        
                                        <div class="col-lg-4 col-md-4 col-sm-4">
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
            form: new form({
                name:'', 
                dob:'',
                dzongkhag:'',
                gewog:'',
                village:'',
                paddress:'',
                email:'',
                contact_number:'',
                application_for:'Principal Recruitment',
                application_type:'principal_recruitment',
                action_type:'add', 
                status:'Submitted',
                organization_type:'',
                status:'Submitted',
                applicationNo:'',

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

        loadPrincipalRecuritmentApplication(appId,type){
            axios.get('staff/StaffApprovalController/loadPrincipalRecuritmentApplication/'+appId+'/'+type)
            .then((response) => {
                // alert(JSON.stringify(response.data))
                let data=response.data.data;
                this.appicationDetails=data;
                this.form.sequence=response.data.sequence;
                this.form.screen_id=response.data.screen_id;
                this.form.establishment_type=data.establishment_type;
                this.isfeedingschool=data.change_details.proposedChange;
                this.senSchool=data.change_details.proposedChange;
               
                if(response.data.app_stage.toLowerCase().includes('verifi')){
                    $('#verifyId').show();
                }

                if(response.data.app_stage.toLowerCase().includes('approve')){
                    $('#approveId').show();
                }
                
            })
            .catch((error) => {
                console.log("Error......"+error);
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
            formData.append('name', this.form.name);
            formData.append('dob', this.form.dob);
            formData.append('dzongkhag', this.form.dzongkhag);
            formData.append('gewog', this.form.gewog);
            formData.append('village', this.form.village);
            formData.append('paddress', this.form.paddress);
            formData.append('email', this.form.email);
            formData.append('contact_number', this.form.contact_number);
            formData.append('application_type', this.form.application_type);
            formData.append('application_for', this.form.application_for);
            formData.append('action_type', this.form.action_type);
            formData.append('status', this.form.status);
            formData.append('organization_type', this.form.organization_type);
            axios.post('staff/StaffApprovalController/savePrincipalApproval', formData, config)
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
                        this.$router.push({name:'princiapl_recuritment_acknowledgement',params: {data:message}});
                        Toast.fire({
                            icon: 'success',
                            title: 'Application is saved successfully'
                        });
                    }
                }
            })
            .catch((err) => {
                console.log("Error:"+err)
            })
            
        },
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
        

        },
        applyselect2(){
           
        },
       

    },

    mounted() {
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
        // this.form.applicationNo=this.$route.params.data.application_number;
        this.loadPrincipalRecuritmentApplication(this.$route.params.data.application_number,this.$route.params.type);
    }
}
</script>
