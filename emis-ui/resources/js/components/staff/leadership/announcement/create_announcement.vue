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
                        <input type="text" autocomplete="off" class="form-control popupDatepicker" @change="remove_error('from_date')" :class="{ 'is-invalid': form.errors.has('from_date') }"  name="from_date" id="from_date">
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
                                        <label><input v-model="form.feedback" @click="showQuestion('1')" type="radio" value="1" /> Yes</label>
                                        <label class="pl-2"><input v-model="form.feedback" @click="showQuestion('0')" type="radio" value="0" /> No</label>
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

                <div class="row form-group" id="leadershipquestionsec">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Select Feedback Question Category: </label>
                        <select class="form-control select2" @change="getfeedbackquestions()" id="question_category" v-model="form.question_category" :class="{ 'is-invalid': form.errors.has('question_category') }">
                            <option value="">--Select--</option>
                            <option v-for="(item, index) in questionCategoryList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="question_category"></has-error>
                    </div>
                </div>
                <!-- <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend pr-2">
                                <span class="img-bordered bg-black">1</span>
                            </div>
                            <div class="input-group-append pt-1">
                                <label class="pr-3">Shortlisting:<span class="text-danger">*</span></label><br />
                                <label><input v-model="form.shortlist"  type="radio" value="1" /> Yes</label>
                                <label class="pl-2"><input v-model="form.shortlist"  type="radio" value="0" /> No</label>
                                <has-error :form="form" field="shortlist"></has-error>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend pr-2">
                                <span class="img-bordered bg-black">2</span>
                            </div>
                            <div class="input-group-append pt-1">
                                <label class="pr-3">270 Degree Feedback:<span class="text-danger">*</span></label><br />
                                <label><input v-model="form.feedback"  type="radio" value="1" /> Yes</label>
                                <label class="pl-2"><input v-model="form.feedback"  type="radio" value="0" /> No</label>
                                <has-error :form="form" field="feedback"></has-error>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend pr-2">
                                <span class="img-bordered bg-black">3</span>
                            </div>
                            <div class="input-group-append pt-1">
                                <label class="pr-3">Interview:<span class="text-danger">*</span></label><br />
                                <label><input v-model="form.interview"  type="radio" value="1" /> Yes</label>
                                <label class="pl-2"><input v-model="form.interview"  type="radio" value="0" /> No</label>
                                <has-error :form="form" field="shortlist"></has-error>
                            </div>
                        </div>
                    </div>
                </div> -->
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
                                        <select class="form-control" @change="getpositionTitleList(index)" :id="'position_level_id'+index" v-model="data.position_level_id" :class="{ 'is-invalid': form.errors.has('position_level_id') }">
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
                        <!--<select name="applicant" :id="'applicant'+(index)" class="form-control" v-model="app.applicant">
                                <option value="">--- Please Select ---</option>
                                <option v-for="(item, index) in roleList" :key="index" v-bind:value="item.Id">{{ item.Name }}</option>
                            </select>
                        <span class="text-danger" id="applicant_err"></span> -->
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
            positionList:[],
            questionCategoryList:[],
            // roleList:[],
            positionLevelList:[],
            form: new form({
                id:'',
                selection_type:'',
                position_title:'',
                question_category:'',
                from_date:'',
                to_date:'',
                details:'',
                document_List:[{document:''}],
                applicant_List:[{position_level:'',position_title:''}],
                feedback:1,
                interview:1,
                shortlist:1,
                action_type:'created'
            }),
        }
    },
    methods: {
        submitAnnouncement(){
            if(this.validated()){
                Swal.fire({
                    text: "Are you sure you wish to save and publish this post ?",
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
                                    'Post details has been created and published successfully.',
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
                if($('#applicant'+i).val()==""){
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
                this.form.applicant_List.push({position_level:'',position_title:''})
            }
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
            this.applyselect2field('selection_type');
            this.applyselect2field('position_title');
            this.applyselect2field('question_category');
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

        getpositionTitleList(index){
            let uri = 'staff/loadStaffMasters/byparent__position_level_id__'+$('#position_level_id'+index).val()+'/PositionTitle';
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
                console.log(error);
            });
        },
        showQuestion(type){
            if(type==1){
                $('#leadershipquestionsec').show();
            }else{
                $('#question_category').val();
                this.form.question_category='';
                $('#leadershipquestionsec').hide();
            }
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

        this.positionList =  await this.loadstaffMasters('active','PositionTitle');
        this.positionLevelList =  await this.loadstaffMasters('active','PositionLevel');
        this.questionCategoryList =  await this.loadstaffMasters('active','staff_leadership___QuestionCategory');
        this.getSelectionList();
        // this.loadroleList();
        // this.loadPositionLevelList();
        // this.loadPositionTitleList();
    },
}
</script>
