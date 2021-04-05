<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <li class="nav-item application-tab" @click="shownexttab('application-tab')">
                        <a class="nav-link active" data-toggle="pill" role="tab"> 
                            <label class="mb-0.5">Application Details </label>                              
                        </a>
                    </li>
                    <li class="nav-item service-tab" @click="shownexttab('service-tab')">
                        <a class="nav-link" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Service Details </label>
                        </a>
                    </li>
                    <li class="nav-item undertaking-tab" @click="shownexttab('undertaking-tab')">
                        <a class="nav-link" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Options & Undertaking</label>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body pt-0 mt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="application-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0.5">Applicant:<i class="text-danger">*</i></label>
                                <select v-model="form.staff_id" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('staff_id') }" class="form-control select2" name="staff_id" id="staff_id">
                                    <option value=""> --Select--</option>
                                    <option v-for="(item, index) in staffList" :key="index" v-bind:value="item.id">{{ item.cid_work_permit }}: {{ item.name }}, {{item.position_title.name}}</option>
                                </select>
                                <has-error :form="form" field="staff_id"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0.5">Transfer Reason:<i class="text-danger">*</i></label>
                                <br/>
                                <span v-for="(item, key, index) in  reasonList" :key="index">
                                    <input type="radio" v-model="form.reason_id" :class="{ 'is-invalid': form.errors.has('reason_id') }" :value="item.id"><label class="pr-4"> &nbsp;{{ item.name }}</label>
                                </span>
                                <has-error :form="form" field="reason_id"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0.5">Brif description for seeking transfer</label>
                                <textarea class="form-control" v-model="form.description" id="description"></textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" @click="shownexttab('service-tab')">Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade tab-content-details" id="service-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0.5">Previous Working History</label>
                                <table id="participant-table" class="table w-100 table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SlNo</th> 
                                            <th>Working Agency</th> 
                                            <th>Dzongkhag</th> 
                                            <th>year</th> 
                                            <th>Position Title</th>
                                        </tr>
                                    </thead> 
                                    <tbody>
                                        <tr>
                                            <td>1</td> 
                                            <td>Yangchenphug HSS</td> 
                                            <td>Thimphu</td> 
                                            <td>2019</td> 
                                            <td>Teacher</td>
                                        </tr> 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0.5">Training Area</label>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('application-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-primary" @click="shownexttab('undertaking-tab')"> <i class="fa fa-arrow-right"></i>Next </button>
                            </div>
                        </div>
                    </div> 
                    <div class="tab-pane fade tab-content-details" id="undertaking-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0.5">Transfer Preferences</label>
                                <table id="participant-table" class="table w-100 table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SlNo</th> 
                                            <th>Preferences</th> 
                                            <th>Dzongkhag/Thromde</th> 
                                        </tr>
                                    </thead> 
                                    <tbody>
                                        <tr>
                                            <td>1</td> 
                                            <td>Preferences 1</td> 
                                            <td>
                                                <select v-model="form.preference_dzongkhag" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('preference_dzongkhag') }" class="form-control select2" name="preference_dzongkhag" id="preference_dzongkhag">
                                                    <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                </select>
                                                <has-error :form="form" field="preference_dzongkhag"></has-error>
                                            </td> 
                                        </tr> 
                                        <tr>
                                            <td>2</td> 
                                            <td>Preferences 2</td> 
                                            <td>
                                                <select v-model="form.preference_dzongkhag" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('preference_dzongkhag') }" class="form-control select2" name="preference_dzongkhag" id="preference_dzongkhag">
                                                    <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                </select>
                                                <has-error :form="form" field="preference_dzongkhag"></has-error>
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td>3</td> 
                                            <td>Preferences 3</td> 
                                            <td>
                                                <select v-model="form.preference_dzongkhag" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('preference_dzongkhag') }" class="form-control select2" name="preference_dzongkhag" id="preference_dzongkhag">
                                                    <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                </select>
                                                <has-error :form="form" field="preference_dzongkhag"></has-error>
                                            </td>
                                        </tr> 
                                    </tbody>
                                </table>
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
                                        <tr id="record1" v-for='(file, index) in form.attachments' :key="index">
                                            <td>
                                                <input type="text" class="form-control" @change="remove_err('attachment_name'+(index+1))" v-model="file.attachment_name" :id="'attachment_name'+(index+1)"/>
                                                <span class="text-danger" :id="'attachment_name'+(index+1)"></span>
                                            </td>
                                            <td>
                                                <input type="file" class="form-control" @change="remove_err('attach_file'+(index+1))" :id="'attach_file'+(index+1)"/>
                                                <span class="text-danger" :id="'attach_file'+(index+1)"></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0.5"><u>Undertaking</u></label><br />
                                <label>I hereby declare that the information given herein is true to the best of my knowledge and I also certify that:</label>
                            </div>
                        </div>
                        <span v-for="(item, key, index) in  undertakingList" :key="index">
                            <div class="form-group row">
                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                    <input type="checkbox" v-model="form.undertaking" class="icheck-success d-inline" :id="{index}" :class="{ 'is-invalid': form.errors.has('undertaking') }" :value="item.id">
                                </div> 
                                <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
                                    <label class="pr-4"> &nbsp;{{ item.name }}</label><br />
                                </div> 
                            </div> 
                        </span>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('service-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-primary" @click="shownexttab('final-tab')"> <i class="fa fa-save"></i>submit </button>
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
        return {
            staffList:'',
            reasonList:'',
            undertakingList:[],
            form: new form({
                id: '',
                staff_id: '',
                reason_id:'',
                description:'',
                preference_dzongkhag:[],
                status: 1,
                remarks:'',
                action_type:'add',
            })
        }
    },
    methods: {
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },
		formaction: function(type){
            if(type=="reset"){
                this.form.from_date= '';
                this.form.to_date= '';
                this.remarks='';
            }
            if(type=="save"){
                this.form.post('/staff/saveTransferWindow')
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/list_transfer_window');
                })
                .catch(() => {
                    console.log("Error.")
                })
            }
		}, 
        loadstaff(){
            let uri = 'staff/loadStaff/';
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.staffList = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        loadreasons(uri = 'masters/loadStaffMasters/active_transfer'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.reasonList =  data.data.data;
            })
            .catch(function (error) {
               console.log("Error:"+error)
            });
        },
        loadactivedzongkhagList(uri="masters/loadGlobalMasters/all_active_dzongkhag"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dzongkhagList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadundertakingList(uri = 'masters/loadStaffMasters/active_transfer_undertakingr'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.undertakingList =  data.data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        shownexttab(nextclass){ 
            if(nextclass=="final-tab"){ 
                Swal.fire({
                    text: "Are you sure you wish to send this detials for approval ?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Success!',
                            'Details has been saved successfully.',
                            'success',
                        )
                        this.$router.push('/list_transfer');
                    }
                });
            }
            else{
                this.change_tab(nextclass);
            }
        },
        change_tab(nextclass){
            $('#tabhead >li >a').removeClass('active');
            $('#tabhead >li >a >span').addClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').addClass('active');
            $('.'+nextclass+' >a >span').removeClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').removeClass('disabled');
            $('.tab-content-details').hide();
            $('#'+nextclass).show().removeClass('fade');
        },

    },
    mounted() {
        $('[data-toggle="tooltip"]').tooltip();
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        this.loadstaff();
        this.loadreasons();
        this.loadactivedzongkhagList();
        this.loadundertakingList();
    },
}
</script>