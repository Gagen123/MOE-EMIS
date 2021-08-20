<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs" >
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs">
                    <li class="nav-item organization-tab">
                        <a class="nav-link active" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Application Details</label>
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
                                            <label>Name:</label>
                                             <span class="text-blue text-bold">{{form.name}}</span>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <label>Date of Birth:</label>
                                            <span class="text-blue text-bold">{{form.dob}}</span>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <label>Dzongkhag:</label>
                                             <span class="text-blue text-bold">{{form.dzongkhag}}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <label>Gewog:</label>
                                            <span class="text-blue text-bold">{{form.gewog}}</span>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <label>Village:</label>
                                            <span class="text-blue text-bold">{{form.village}}</span>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <label>Present Address:</label>
                                             <span class="text-blue text-bold">{{form.paddress}}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Email Address:</label>
                                            <span class="text-blue text-bold">{{form.email}}</span>
                                        </div>
                                        
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <label>Contact Number:</label>
                                            <span class="text-blue text-bold">{{form.contact_number}}</span>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <label>Applcation For:</label>
                                            <span class="text-blue text-bold">{{form.application_for}}</span>
                                        </div>
                                         
                                    </div>
                                   
                                    <div class="row pb-2" id="team_verificationAttachment">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <h5><u>Attachments</u></h5>
                                        <table id="participant-table" class="table w-100 table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Attachment Name</th>
                                                    <th>Attachment</th>
                                                    <th>File</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for='(attach,count) in attachments' :key="count+1">
                                                    <template>
                                                        <td>{{attach.user_defined_file_name}} </td>
                                                        <td class="text-blue text-bold">  {{attach.name}}</td>
                                                        <td>
                                                            <a href="#" @click="openfile(attach)" class="fa fa-eye"> View</a>
                                                        </td>
                                                    </template>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-group row">
                                </div>
                            </form>
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
            attachments:'',
            form: new form({
                name:'', 
                dob:'',
                dzongkhag:'',
                gewog:'',
                village:'',
                paddress:'',
                email:'',
                contact_number:'',
                remarks:'',
                application_no:'',
                screen_id:'',
                sequence:'',
                application_no:'',
                attachments:
                
                [{
                    file_name:'',attachment:''
                }],
                ref_docs:[],
            }),
        }
    },
    methods: {
        openfile(file){
            let file_path=file.path+'/'+file.name;
            file_path=file_path.replaceAll('/', 'SSS');
            let uri = 'common/viewFiles/'+file_path;
            window.location=uri;
        },
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },
        loadApplicationDetials(){
            axios.get('staff/StaffApprovalController/loadPrincipalApplicationDetials/'+this.form.application_no)
            .then((response) => {
                let data=response.data.data
                this.form.name=data.name;
                this.form.dob=data.DateOfBirth;
                this.form.dzongkhag=data.dzongkhag;
                this.form.gewog=data.gewog;
                this.form.village=data.village;
                this.form.paddress=data.presentAddress;
                this.form.email=data.EmailAddress;
                this.form.contact_number=data.contact_number;
                this.form.application_for=data.application_for;
                 this.attachments=data.attachments;
            })
            .catch((error) => {
                console.log("Error......"+error);
            });

        },
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
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
        this.form.application_no=this.$route.params.data.application_no;
        this.id=this.$route.params.data.id;
        this.loadApplicationDetials();
        // this.LoadAttachmentDetails();
    }
}
</script>
