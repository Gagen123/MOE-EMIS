<template>
    <div>
        <div class="card card-danger card-outline" id="invalidsection" style="display:none">
            <div class="card-body pb-0 mb-0">
                <div class="callout callout-danger">
                    <div class="form-group row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label class="mb-0" id="err_message"></label><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="card-body pt-0 mt-1">
                <div class="tab-content"><br>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <label class="mb-0.5">Applicant Name:</label>
                                <span class="text-blue text-bold">{{this.form.name}}</span>
                                <has-error :form="form" field="name"></has-error>
                            </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <label class="mb-0.5">Application Number:</label>
                                <span class="text-blue text-bold">{{this.form.aplication_number}}</span>
                                <has-error :form="form" field="aplication_number"></has-error>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <label class="mb-0.5">Transfer Type:</label>
                                <span class="text-blue text-bold">{{this.form.transferType}}</span>
                                <has-error :form="form" field="transferType"></has-error>
                            </div>
                        </div>
                         <div class="form-group row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <label class="mb-0.5">Reason For Transfer:</label>
                                <span class="text-blue text-bold">{{this.form.description}}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0.5">PPreference Organization Details:</label>
                                <table id="participant-table" class="table w-100 table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SlNo</th>
                                            <th>Preferences</th>
                                            <th>School</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>
                                                <span class="text-blue text-bold">{{orgArray[form.preference_school1]}}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>2</td>
                                            <td>
                                               <span class="text-blue text-bold">{{orgArray[form.preference_school2]}}</span>                                               
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>3</td>
                                            <td>
                                                <span class="text-blue text-bold">{{orgArray[form.preference_school3]}}</span>                                               
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="form-group row" id="approvedDetails">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0.5">Selected Organization Details</label>
                                <table id="participant-table" class="table w-100 table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SlNo</th>
                                            <th>Dzongkhag/Thromde</th>
                                            <th>School</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>
                                               <span class="text-blue text-bold">{{dzoArray[form.dzongkhagApproved]}}</span>
                                            </td>
                                            <td>
                                               <span class="text-blue text-bold">{{orgArray[form.preference_school]}}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                         <!-- subject -->
                         <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0.5">Subjects Specification:</label>
                                <table id="participant-table" class="table w-100 table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SlNo</th>
                                            <th>Preferences</th>
                                            <th>Subject</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>
                                                <span class="text-blue text-bold">{{staffArray[form.preference_subject1]}}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>2</td>
                                            <td>
                                               <span class="text-blue text-bold">{{staffArray[form.preference_subject2]}}</span>                                               
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>3</td>
                                            <td>
                                                <span class="text-blue text-bold">{{staffArray[form.preference_subject3]}}</span>                                               
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0.5">Attachments Details:</label>
                                <table id="participant-table" class="table w-100 table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Attachment Name</th>
                                            <th>File</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for='(attach,count) in draft_attachments' :key="count+1">
                                            <td>
                                                <input type="text" class="form-control" readonly :value="attach.user_defined_name">
                                            </td>
                                            <td>
                                                <a href="#" @click="openfile(attach)" class="fa fa-eye"> View</a>
                                            </td>
                                        </tr>
                                        <tr v-for='(att, index) in form.attachments' :key="index">
                                            <td>
                                                <span class="text-danger" :id="'file_name'+(index+1)+'_err'"></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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
            filecount:1,
            button:true,
            t_warning:false,
            t_warning_message:'',
            reasonArray:{},
            orgArray:{},
            dzoArray:{},
            staffArray:{},
            draft_attachments:[],
            transfertypeList:[],
            intratransfer:[],
            applicationNo:[],
            form: new form({
                staff_id: '',
                reason_id:'',
                name:'',
                transfer_type_id:'',
                description:'',
                aplication_number:'',
                status:'',
                dzongkhagApproved:'',
                preference_school:'',
                preference_subject1:'',
                preference_subject2:'',
                preference_subject3:'',
                attachments:
                [{
                    file_name:'',attachment:''
                }],
                ref_docs:[],
            })
        }
    },
    methods: {
         loadactivedzongkhagList(uri="masters/loadGlobalMasters/all_active_dzongkhag"){
            axios.get(uri)
            .then(response => {
                let data = response.data.data
                this.dzongkhagList =  data;
                for(let i=0;i<data.length;i++){
                 this.dzoArray[data[i].id] = data[i].name;
                }
            })
            .catch(function (error) {
                console.log("Error:"+error)
            });
        },
        loadOrgList(uri ='staff/transfer/LoadSchoolByDzoId/userdzongkhagwise/NA'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.SchoolList =  data;
                for(let i=0;i<data.length;i++){
                 this.orgArray[data[i].id] = data[i].name;
                }
            })
            .catch(function (error) {
                console.log("Error:"+error)
            });
        },
         loadattachementDetails(appId){
             axios.get('staff/transfer/loadattachementDetails/'+appId)
            .then((response) =>{
                let data = response.data.data;
                //school lists looping
                   for(let i=0;i<data.preferences.length;i++){
                        if(i==0){
                            this.form.preference_school1     =   data.preferences[i].school_id;
                            $('#preference_school1').val(data.preferences[i].school_id).trigger('change');
                        }
                        if(i==1){
                            this.form.preference_school2     =   data.preferences[i].school_id;
                            $('#preference_school2').val(data.preferences[i].school_id).trigger('change');
                        }
                        if(i==2){
                            this.form.preference_school3     =   data.preferences[i].school_id;
                            $('#preference_school3').val(data.preferences[i].school_id).trigger('change');
                        }
                    //subject lists looping
                     for(let i=0;i<data.preferences.length;i++){
                         if(i==0){
                            this.form.preference_subject1     =   data.preferences[i].subject_id;
                            $('#preference_subject1').val(data.preferences[i].subject_id).trigger('change');
                        }
                        if(i==1){
                            this.form.preference_subject2     =   data.preferences[i].subject_id;
                            $('#preference_subject2').val(data.preferences[i].subject_id).trigger('change');
                        }
                        if(i==2){
                            this.form.preference_subject3     =   data.preferences[i].subject_id;
                            $('#preference_subject3').val(data.preferences[i].subject_id).trigger('change');
                        }
                     }
                }
                this.draft_attachments=data.documents;
            })
            .catch(errors =>{
                console.log('error loadattachementDetails: '+errors)
            });
        },
        loadApplicationDetails(id){
            axios.get('staff/transfer/loadApplicationDetails/' +id)
            .then((response) =>{
                let data=response.data;
                this.form.id=data.id;
                this.form.transferType=data.transferType;
                this.form.dzongkhagApproved=data.dzongkhagApproved;
                this.form.preference_school=data.preference_school;
          })
        },
        profile_details(){
            axios.get('common/getSessionDetail')
            .then(response => {
                this.form.name = response.data.data.Full_Name;
                this.form.user_id = response.data.data.User_Id;
                // this.LoadApplicationDetailsByUserId(response.data.data.User_Id);
            })
            .catch(errors =>{
                console.log(errors)
            });
        },
        loadAcademicMasters(uri="masters/loadAcademicMasters/all_active_subject"){
            axios.get(uri)
            .then(response =>{
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                 this.staffArray[data[i].id] = data[i].name;
                }
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        openfile(file){
            let file_path=file.path+'/'+file.original_name;
            file_path=file_path.replaceAll('/', 'SSS');
            let uri = 'common/viewFiles/'+file_path;
            window.location=uri;
        },
        },
        mounted() {
            let currentdate = new Date();
            this.form.year=currentdate.getFullYear();
            this.form.current_date=currentdate.getFullYear()+'-'+(currentdate.getMonth() + 1)+'-'+currentdate.getDate();
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
            this.profile_details();
            this.loadAcademicMasters();
            this.loadactivedzongkhagList();
            this.loadOrgList();
            this.loadApplicationDetails(this.$route.params.data.id)
            this.form.id=this.$route.params.data.id;
            this.form.transfer_type_id=this.$route.params.data.transferType;
            this.form.description=this.$route.params.data.description;
            this.form.aplication_number=this.$route.params.data.aplication_number;
            this.form.transferType=this.$route.params.data.transferType;
            this.loadattachementDetails(this.$route.params.data.aplication_number);
        },
}
</script>
