<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-body">
                <template v-if="post_detail!=''">
                    <div class="row form-group">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Selection For:</label>
                            <span class="text-blue text-bold">{{post_detail.leadership_for}}</span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Position Title:</label>
                            <span class="text-blue text-bold">{{post_detail.position_title}}</span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Application Start Date:</label>
                            <span class="text-blue text-bold">{{post_detail.from_date}}</span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Application End Date:</label>
                            <span class="text-blue text-bold">{{post_detail.to_date}}</span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Details:</label>
                            <span class="text-blue text-bold">{{post_detail.details}}</span>
                        </div>
                    </div>
                </template>
                <hr/>
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label class="mb-0">Remarks</label>
                        <textarea class="form-control" v-model="form.remarks" id="remarks" name="remarks"></textarea>
                        <span class="text-danger" id="remarks_err"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label class="mb-0">Upload the Required Documents<span class="text-danger">*</span></label>
                    </div>
                </div>
                <div class="card">
                    <div class="form-group row">
                        <div class="card-body col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                                            <span class="text-danger" :id="'file_name'+(index+1)+'_err'"></span>
                                        </td>
                                        <td>
                                            <input type="file" name="attachments" class="form-control" v-on:change="onChangeFileUpload" :id="'attach'+(index+1)">
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
                </div>
                <hr>
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <button class="btn btn-primary fa-pull-right" @click="submitApplication()"><i class="fa fa-save"></i> Submit </button>
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
            require_count:0,
            count:0,
            post_detail:'',
            form: new form({
                id:'',
                post_id:'',
                staff_id:'',
                dzo_id:'',
                org_id:'',
                accessLevel:'',
                remarks:'',
                attachments:
                [{
                    file_name:'',attachment:''
                }],
                ref_docs:[],
                applicant:'',
                action_type:'add'
            }),
        }
    },
    methods: {
        onChangeFileUpload(e){
            let currentcount=e.target.id.match(/\d+/g)[0];
            if($('#file_name'+currentcount).val()!=""){
                this.form.ref_docs.push({name:$('#file_name'+currentcount).val(), attach: e.target.files[0]});
                $('#file_name'+currentcount).prop('readonly',true);
            }
            else{
                $('#file_name'+currentcount+'_err').html('Please mention file name');
                $('#'+e.target.id).val('');
            }
        },
        addMore: function(){
            this.count++;
            this.form.attachments.push({file_name:'', attachment:''});
        },
        remove(){
            if(this.form.attachments.length>1){
                if(this.count>this.require_count){
                    this.count--;
                    this.form.attachments.pop();
                }
            }
        },

        changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="position_title"){
                this.form.position_title=$('#position_title').val();
            }
        },

        submitApplication(){
            Swal.fire({
                text: 'Are you sure you wish to submit this application ? ',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
                }).then((result) => {
                if (result.isConfirmed) {
                    let formData = new FormData();
                    formData.append('post_id', this.form.post_id);
                    formData.append('staff_id', this.form.staff_id);
                    formData.append('dzo_id', this.form.dzo_id);
                    formData.append('org_id', this.form.org_id);
                    formData.append('accessLevel', this.form.accessLevel);
                    formData.append('remarks', this.form.remarks);
                    for(let i=0;i<this.form.ref_docs.length;i++){
                        formData.append('attachments[]', this.form.ref_docs[i].attach);
                        formData.append('attachmentname[]', this.form.ref_docs[i].name);
                    }

                    const config = {
                        headers: {
                            'content-type': 'multipart/form-data'
                        }
                    }
                    axios.post('/recruitmentFeedbackController/submitApplication', formData, config)
                    .then((response) => {
                        if(response.data!=""){
                            if(response!="" && response!="No Screen"){
                                let res='Your application is submitted and system generated application number is: '+response.data.application_number+'.</b><br> Use this application number to track your application status. <br><b>Thank You !</b>';
                                this.$router.push({name:'application_acknowledgement',params: {data:res }});
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Application is submitted successfully'
                                });
                            }
                        }
                    })
                    .catch((error) => {
                        console.log("Error:"+error);
                        this.form.errors.errors = error.response.data.errors;
                    })
                }
            });
        }

    },

    async mounted(){
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').on('select2:select', function (){
            Fire.$emit('changeval',$(this).attr('id'))
        });
        Fire.$on('changeval',(id)=>{
            this.changefunction(id);
        });

        axios.get('/recruitmentFeedbackController/getpostDetails')
        .then((response) =>{
            let data=response.data.data;
            this.post_detail=data;
            this.form.post_id=data.id;
            this.form.staff_id=data.id;
            if(data.attachments.length>0){
                this.form.attachments=[];
                for(let i=0;i<data.attachments.length;i++){
                    this.form.attachments.push({file_name:data.attachments[i].attachment,attachment:''});
                }
            }
            for(let i=1;i<=(data.attachments.length+1);i++){
                $('#file_name'+i).prop('readonly',true);
            }
        })
        .catch((error)=>{
            console.log("Error: "+error);
        });
    },
}
</script>
