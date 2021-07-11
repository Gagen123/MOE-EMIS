<template>
    <div>
        <form class="bootbox-form" id="foodreleaseId">
            <div class="card-body">
                <div class="form-group row"> 
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Date of Food Release:<span class="text-danger">*</span></label> 
                        <span class="text-blue text-bold">{{form.dateOfrelease}}</span>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Dzongkhag:<span class="text-danger">*</span></label> 
                        <span class="text-blue text-bold">{{form.dzongkhag}}</span>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">School Name:<span class="text-danger">*</span></label> 
                        <span class="text-blue text-bold">{{form.organizaiton}}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                       <label class="">Quarter:<span class="text-danger">*</span></label> 
                        <span class="text-blue text-bold">{{form.quarter}}</span>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <label class="mb-0.5">Remarks:</label>
                        <span class="text-blue text-bold">{{form.remarks}}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label class="mb-0.5">Attachments</label>
                        <table id="participant-table" class="table w-100 table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Attachment Name</th> 
                                    <th>File</th> 
                                </tr> 
                            </thead> 
                            <tbody>
                                <tr id="record1" v-for='(attach, count) in attachments' :key="count+1">
                                    <template>
                                    <td>
                                        {{attach.user_defined_file_name}}
                                    </td>
                                    <td>                                
                                        <a href="#" @click="openfile(attach)" class="fa fa-eye"> View</a>
                                    </td>
                                    </template>
                                </tr> 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data(){
        return{
            attachments:'',
          //  itemrelease:[],
            // items_released: [],
          
            form: new form({
                 id: '', dateOfrelease: '', dzongkhag: '', organizaiton: '',quarter: '', remarks: '',
                 attachments:
                [{
                    file_name:'',attachment:''
                }],
                ref_docs:[],
            }),
        }
    },

    methods:{
        openfile(file){
            let file_path=file.path+'/'+file.name;
            file_path=file_path.replaceAll('/', 'SSS');
            let uri = 'common/viewFiles/'+file_path;
            window.location=uri;
        },
        loadFoodReleaseDetials(){
            axios.get('mess_manage/loadFoodReleaseDetials/'+this.applicationNo)
            .then((response) => {
                let data=response.data.data
                this.form.name=data.name;
                this.form.dob=data.DateOfBirth;
                this.form.country=data.CountryOfExpatriate;
                this.form.gewog=data.gewog;
                this.form.Address=data.AddressOfExpatriate;
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
        /**
         * method to reset form
         */
        /**
         * method to save data
         */
        
        
        
       

        /**
         * method to remove error
         */
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },

        /**
         * method to get term in dropdown
         */
        

        /**
         * method to get unit in dropdown
         */
       
        

        /**
         * method to get item in dropdown
         */
        
        
        /**f
         * method to get dzongkhag in dropdown
         */
        
    },
    mounted() { 
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
       
        this.loadactivedzongkhagList();
        this.loadActiveQuarterList();
        this.loadActiveItemList();
        this.loadActiveUnitList(); 
        this.allOrgList();
        
        //this.$route.params.data.dateOfprocure;
      //  this.student_form.cid_passport=this.$route.query.data[0].CidNo;
    },
    created() {
        this.form.id=this.$route.params.data.id;
        this.form.dateOfrelease=this.$route.params.data.dateOfrelease;
        this.form.dzongkhag=this.$route.params.data.dzongkhag_id;
        this.form.organizaiton=this.$route.params.data.org_id;
        this.form.quarter=this.$route.params.data.quarter;
        this.form.remarks=this.$route.params.data.remarks;
        this.attachments.file_name=this.$route.params.data.file_name;
        this.attachment.attachment=this.$route.params.data.attachment;
    }
}
</script>