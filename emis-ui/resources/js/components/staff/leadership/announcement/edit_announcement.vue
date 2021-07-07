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
                        <input type="date" class="form-control" @change="remove_err('from_date')" :class="{ 'is-invalid': form.errors.has('from_date') }"  name="from_date" id="from_date" v-model="form.from_date">
                        <has-error :form="form" field="from_date"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Application End Date:<span class="text-danger">*</span></label>
                        <input type="date" @change="remove_err('to_date')" :class="{ 'is-invalid': form.errors.has('to_date') }"  class="form-control" name="to_date" id="to_date" v-model="form.to_date">
                        <has-error :form="form" field="to_date"></has-error>
                    </div>
                </div>
                <div class="row form-group">
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
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-for='(app, index) in form.applicant_List' :key="index">
                        <label>Applicable Applicant:<span class="text-danger">*</span></label>
                        <select name="applicant" :id="'applicant'+(index)" class="form-control" v-model="app.applicant">
                            <option value="">--- Please Select ---</option>
                            <option v-for="(item, index) in roleList" :key="index" v-bind:value="item.Id">{{ item.Name }}</option>
                        </select>
                        <span class="text-danger" id="applicant_err"></span>
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
            selectionList:[],
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
                applicant_List:[{applicant:''}],
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
                this.form.applicant_List.pop();
            }
        },
        addMoreattahcments(type){
            if(type=="doc"){
                this.form.document_List.push({document:''})
            }
            if(type=="applicant"){
                this.form.applicant_List.push({applicant:''})
            }
        },
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },
        loadPositionTitleList(uri = 'masters/loadStaffMasters/all_active_position_title'){
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.positionList =  data.data.data;
            })
            .catch(function (error){
                console.log(error);
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
        loadroleList(uri = 'masters/getroles/allActiveRoles'){
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.roleList =  data.data;
            })
            .catch(function (error){
                console.log(error);
            });
        },
        loadDetials(){
            axios.get('/staff/staffLeadershipSerivcesController/loadDetials/'+this.form.id)
            .then((response) =>{
                let data=response.data.data;
                this.form.selection_type=data.selection_type;
                $('#selection_type').val(data.selection_type).trigger('change');
                this.form.position_title=data.position_title;
                $('#position_title').val(data.position_title).trigger('change');
                this.form.from_date=data.from_date;
                this.form.to_date=data.to_date;
                this.form.details=data.details;
                this.form.shortlist=data.shortlist;
                this.form.interview=data.interview;
                this.form.feedback=data.feedback;

                this.form.selection_type=data.selection_type;
                if(data.applicable_applicant.length>0){
                    this.form.applicant_List=[];
                    for(let i=0;i<data.applicable_applicant.length;i++){
                        this.form.applicant_List.push({applicant:data.applicable_applicant[i].role_id});
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
    mounted(){
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
        this.loadroleList();
        this.loadPositionTitleList();
        this.form.id=this.$route.params.id;
        this.loadDetials();
    },
}
</script>
