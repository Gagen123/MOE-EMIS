<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Selection For:<span class="text-danger">*</span></label>
                        <select class="form-control select2" id="selection_type" v-model="form.selection_type" :class="{ 'is-invalid': form.errors.has('selection_type') }">
                            <option value="">--Select--</option>
                            <option v-for="(item, index) in selectionList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                            <option value="Others">Others</option>
                        </select>
                        <has-error :form="form" field="selection_type"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Position Title:<span class="text-danger">*</span></label>
                        <select class="form-control select2" id="position_title" v-model="form.position_title" :class="{ 'is-invalid': form.errors.has('position_title') }">
                            <option value="">--Select--</option>
                            <option v-for="(item, index) in positionList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="position_title"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Application Start Date:<span class="text-danger">*</span></label>
                        <input type="text" autocomplete="off" class="form-control popupDatepicker" @change="remove_erroe('from_date')" :class="{ 'is-invalid': form.errors.has('from_date') }"  name="from_date" id="from_date">
                        <has-error :form="form" field="from_date"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Application End Date:<span class="text-danger">*</span></label>
                        <input type="text" autocomplete="off" @change="remove_error('to_date')" :class="{ 'is-invalid': form.errors.has('to_date') }"  class="form-control popupDatepicker" name="to_date" id="to_date">
                        <has-error :form="form" field="to_date"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-bordered text-sm table-striped">
                            <thead>
                                <tr>
                                    <th>SL#</th>
                                    <th>Action Type</th>
                                    <th>Applicable ?</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>270 Degree Feedback</td>
                                    <td>
                                        <label><input v-model="form.feedback"  type="radio" value="1" /> Yes</label>
                                        <label class="pl-2"><input v-model="form.feedback"  type="radio" value="0" /> No</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Shortlisting</td>
                                    <td>
                                        <label><input v-model="form.shortlist"  type="radio" value="1" /> Yes</label>
                                        <label class="pl-2"><input v-model="form.shortlist"  type="radio" value="0" /> No</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Interview</td>
                                    <td>
                                        <label><input v-model="form.interview"  type="radio" value="1" /> Yes</label>
                                        <label class="pl-2"><input v-model="form.interview"  type="radio" value="0" /> No</label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>Details:</label>
                        <textarea class="form-control" :class="{ 'is-invalid': form.errors.has('reason') }" v-model="form.details" id="details"></textarea>
                        <has-error :form="form" field="details"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-for='(agent, index) in form.document_List' :key="index">
                        <label>Required Attachment:</label>
                        <input type="text" name="document" v-model="agent.document" :id="'document'+index" class="form-control">
                        <span class="text-danger" id="document_err"></span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <button type="button" class="btn btn-flat btn-sm btn-primary"
                        @click="addMoreattahcments('doc')"><i class="fa fa-plus"></i> Add</button>
                        <button type="button" class="btn btn-flat btn-sm btn-danger"
                        @click="removeattachments('doc')"><i class="fa fa-trash"></i> Remove</button>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>Eligible Applicants: </label>
                        <table class="table table-bordered text-sm table-striped">
                            <thead>
                                <tr>
                                    <th>SL#</th>
                                    <th>Position Level</th>
                                    <th>Popsition Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for='(data, index) in form.applicant_List' :key="index">
                                    <td>{{index+1}}</td>
                                    <td>
                                        <select class="form-control" @change="getpositionTitleList('',index)" :id="'position_level_id'+index" v-model="data.position_level" :class="{ 'is-invalid': form.errors.has('position_level_id') }">
                                            <option value="">--Select--</option>
                                            <option v-for="(item, index) in positionLevelList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                        </select>
                                        <has-error :form="form" field="position_level_id"></has-error>
                                    </td>
                                    <td>
                                        <select class="form-control" :id="'position_title_id'+index" v-model="data.position_title_id" :class="{ 'is-invalid': form.errors.has('position_title_id') }">
                                            <option value="">--Select--</option>
                                        </select>
                                        <has-error :form="form" field="position_title_id"></has-error>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <button type="button" class="btn btn-flat btn-sm btn-primary"
                        @click="addMoreattahcments('applicant')"><i class="fa fa-plus"></i> Add</button>
                        <button type="button" class="btn btn-flat btn-sm btn-danger"
                        @click="removeattachments('applicant')"><i class="fa fa-trash"></i> Remove</button>
                    </div>
                </div>
                <hr>
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <button class="btn btn-primary fa-pull-right" @click="submitAnnouncement('feedback-tab')"><i class="fa fa-save"></i> Save & Apply </button>
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
            applicantcount:1,
            selectionList:[],
            positionLevelList:[],
            positionList:[],
            roleList:[],
            form: new form({
                id:'',
                selection_type:'',
                position_title:'',
                from_date:'',
                to_date:'',
                feedback:1,
                interview:1,
                shortlist:1,
                details:'',
                document_List:[{document:''}],
                // applicant_List:[{applicant:''}],
                applicant_List:[{position_level:'',position_title_id:''}],
                action_type:'edit'
            }),
        }
    },
    methods: {
        submitAnnouncement(){
            if(this.validated()){
                Swal.fire({
                    text: "Are you sure you wish to save this post ?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    }).then((result) => {
                    if(result.isConfirmed){
                        this.form.from_date=this.formatYYYYMMDD($('#from_date').val());
                        this.form.to_date=this.formatYYYYMMDD($('#to_date').val());
                        this.form.post('/staff/staffLeadershipSerivcesController/createPost')
                        .then((response) =>{
                            if(response!=""){
                                Swal.fire(
                                    'Success!',
                                    'Post details has been updates and published successfully.',
                                    'success',
                                )
                                this.$router.push('/list_announcement');
                            }
                        })
                        .catch((error) =>{
                            console.log("Error: "+error);
                            this.applyselect2();
                        });
                    }
                });
            }
        },
        validated(){
            let return_type=true;
            for(let i=0;i<this.form.applicant_List.length;i++){
                if($('#position_title_id'+i).val()==""){
                    Swal.fire({
                        icon: 'error',
                        title: 'Sorry! ',
                        text: 'Please select applicable applicant',
                    });
                    return_type=false;
                }
            }
            return return_type;
        },
        removeattachments(type){
            if(type=="doc"){
                this.form.document_List.pop();
            }
            if(type=="applicant"){
                if(this.applicantcount>1){
                    this.applicantcount--;
                    this.form.applicant_List.pop();
                }
            }
        },
        addMoreattahcments(type){
            if(type=="doc"){
                this.form.document_List.push({document:''})
            }
            if(type=="applicant"){
                this.applicantcount++;
                this.form.applicant_List.push({position_level:'',position_title_id:''})
            }
        },

        getpositionTitleList(levelid,index){
            let p_levelId=$('#position_level_id'+index).val();
            if(levelid!=""){
                p_levelId=levelid;
            }
            let uri = 'staff/loadStaffMasters/byparent__position_level_id__'+p_levelId+'/PositionTitle';
            axios.get(uri)
            .then(response =>{
                $('#position_title_id'+index).empty();
                let data = response.data.data;
                let option='<option value="">--Select--</option>';
                data.forEach(itm => {
                    option+='<option value="'+itm.id+'">'+itm.name+'</option>';
                });
                $('#position_title_id'+index).append(option);
            })
            .catch(function (error){
                console.log('error in getpositionTitleList: '+error);
            });
        },

        getSelectionList(uri = 'staff/staffLeadershipSerivcesController/loadData/activeData_LeadershipType'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.selectionList =  data.data.data;
            })
            .catch(function (error){
                console.log('err in retrieving services: '+error);
            });
        },
        applyselect2(){
            if(!$('#selection_type').attr('class').includes('select2-hidden-accessible')){
                $('#selection_type').addClass('select2-hidden-accessible');
            }
            if(!$('#position_title').attr('class').includes('select2-hidden-accessible')){
                $('#position_title').addClass('select2-hidden-accessible');
            }
        },
        changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="selection_type"){
                this.form.selection_type=$('#selection_type').val();
            }
            if(id=="position_title"){
                this.form.position_title=$('#position_title').val();
            }
        },
        // loadroleList(uri = 'masters/getroles/allActiveRoles'){
        //     axios.get(uri)
        //     .then(response =>{
        //         let data = response;
        //         this.roleList =  data.data;
        //     })
        //     .catch(function (error){
        //         console.log(error);
        //     });
        // },
        loadDetials(){
            axios.get('/staff/staffLeadershipSerivcesController/loadDetials/'+this.form.id)
            .then((response) =>{
                let data=response.data.data;
                this.form.selection_type=data.selection_type;
                $('#selection_type').val(data.selection_type).trigger('change');
                this.form.position_title=data.position_title;
                $('#position_title').val(data.position_title).trigger('change');
                this.form.from_date=data.from_date;
                $('#from_date').val(this.reverseDate1(data.from_date));
                this.form.to_date=data.to_date;
                $('#to_date').val(this.reverseDate1(data.to_date));
                this.form.details=data.details;
                this.form.shortlist=data.shortlist;
                this.form.interview=data.interview;
                this.form.feedback=data.feedback;

                this.form.selection_type=data.selection_type;
                this.applicantcount=data.applicable_applicant.length;
                if(data.applicable_applicant.length>0){
                    this.form.applicant_List=[];
                    for(let i=0;i<data.applicable_applicant.length;i++){
                        this.getpositionTitleList(data.applicable_applicant[i].level_id,i);
                        this.form.applicant_List.push({position_level:data.applicable_applicant[i].level_id,position_title_id:data.applicable_applicant[i].position_title_id});
                    }
                }
                if(data.attachments.length>0){
                    this.form.document_List=[];
                    for(let i=0;i<data.attachments.length;i++){
                        this.form.document_List.push({document:data.attachments[i].attachment});
                    }
                }
            })
            .catch((error) =>{
                console.log("Error: "+error);
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
        this.getSelectionList();
        // this.loadroleList();
        this.positionList =  await this.loadstaffMasters('active','PositionTitle');
        this.positionLevelList =  await this.loadstaffMasters('active','PositionLevel');
        this.form.id=this.$route.params.id;
        this.loadDetials();
    },
}
</script>
