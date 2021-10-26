<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-body pt-0 mt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="programme-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Trainig Type:<i class="text-danger">*</i></label>
                                <select v-model="form.training_type" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('training_type') }" class="form-control select2" name="training_type" id="training_type">
                                    <option value="">--Select--</option>
                                    <option v-for="(item, index) in trainingtypeList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="training_type"></has-error>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Course Title:<i class="text-danger">*</i></label>
                                <input type="text" class="form-control" @change="remove_error('course_title')" :class="{ 'is-invalid' :form.errors.has('course_title') }" v-model="form.course_title" id="course_title"/>
                                <has-error :form="form" field="course_title"></has-error>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Organized By (Department/Division):<i class="text-danger">*</i></label>
                                <select v-model="form.organizer" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('organizer') }" class="form-control select2" name="organizer" id="organizer">
                                    <option value=""> --Select--</option>
                                    <option v-for="(item, index) in organizerList" :key="index" v-bind:value="item.id"> {{ item.agencyName }}</option>
                                </select>
                                <has-error :form="form" field="organizer"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Related Programme:</label>
                                <select v-model="form.related_programme" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('related_programme') }" class="form-control select2" name="related_programme" id="related_programme">
                                    <option value=""> --Select--</option>
                                    <option v-for="(item, index) in relatedProgrammeList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="related_programme"></has-error>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Start Date:<i class="text-danger">*</i></label>
                                <input type="text" autocomplete="off" class="form-control popupDatepicker" @change="remove_error('start_date')" :class="{ 'is-invalid' :form.errors.has('start_date') }" id="start_date"/>
                                <has-error :form="form" field="start_date"></has-error>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">End Date:<i class="text-danger">*</i></label>
                                <input type="text" autocomplete="off" class="form-control popupDatepicker" @change="remove_error('end_date')" :class="{ 'is-invalid' :form.errors.has('end_date') }" id="end_date"/>
                                <has-error :form="form" field="end_date"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Financial Source:<i class="text-danger">*</i></label>
                                <select v-model="form.financial_source" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('financial_source') }" class="form-control select2" name="financial_source" id="financial_source">
                                    <option value=""> --Select--</option>
                                    <option v-for="(item, index) in financialSourceList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="financial_source"></has-error>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Total Estimated Budget:</label>
                                <input type="text" class="form-control" @change="remove_error('total_budget')" :class="{ 'is-invalid' :form.errors.has('total_budget') }" v-model="form.total_budget" id="total_budget"/>
                                <has-error :form="form" field="total_budget"></has-error>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Total Expenditure:</label>
                                <input type="text" class="form-control" @change="remove_error('expenditurel_budget')" :class="{ 'is-invalid' :form.errors.has('expenditurel_budget') }" v-model="form.expenditurel_budget" id="expenditurel_budget"/>
                                <has-error :form="form" field="expenditurel_budget"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Institute/Venue:<i class="text-danger">*</i></label>
                                <input type="text" class="form-control" @change="remove_error('vanue')" :class="{ 'is-invalid' :form.errors.has('vanue') }" v-model="form.vanue" id="vanue"/>
                                <has-error :form="form" field="vanue"></has-error>
                            </div>
                        </div>
                        <span id="professional_development_section">
                        <hr/>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Programme Level:<i class="text-danger">*</i></label>
                                <select v-model="form.programme_level" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('programme_level') }" class="form-control select2" name="programme_level" id="programme_level">
                                    <option value=""> --Select--</option>
                                    <option v-for="(item, index) in programmeLevelList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="programme_level"></has-error>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Programme Type:<i class="text-danger">*</i></label>
                                <select v-model="form.programme_type" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('programme_type') }" class="form-control select2" name="programme_type" id="programme_type">
                                    <option value=""> --Select--</option>
                                    <option v-for="(item, index) in programmeTypeList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="programme_type"></has-error>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Course Type:<i class="text-danger">*</i></label>
                                <select v-model="form.course_type" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('course_type') }" class="form-control select2" name="course_type" id="course_type">
                                    <option value=""> --Select--</option>
                                    <option v-for="(item, index) in courseTypeList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="course_type"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Course Provider:<i class="text-danger">*</i></label>
                                <input type="text" class="form-control" @change="remove_error('course_provider')" :class="{ 'is-invalid' :form.errors.has('course_provider') }" v-model="form.course_provider" id="course_provider"/>
                                <has-error :form="form" field="course_provider"></has-error>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Total Hours:<span id="hrsmandatory"></span></label>
                                <input type="number" class="form-control" @change="remove_error('total_hrs')" :class="{ 'is-invalid' :form.errors.has('total_hrs') }" v-model="form.total_hrs" id="total_hrs"/>
                                <has-error :form="form" field="total_hrs"></has-error>
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0.5">Nature of participation:<i class="text-danger">*</i></label><br/>
                                <span v-for="(nature, index) in nature_of_participantList" :key="index" >
                                    <input type="checkbox"  @change="remove_error('nature_of_participant'+index)" v-model="form.nature_of_participant" :class="{ 'is-invalid' :form.errors.has('nature_of_participant') }" name="nature_of_participant" :id="'nature_of_participant'+index" :value="nature.id">
                                    <label class="pr-3"> {{ nature.name  }}</label>
                                </span>
                            </div>
                        </div>
                    </span>
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0">Upload the Required Documents ({{validfile()}})</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <table id="dynamic-table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Attachment Name</th>
                                            <th>File(Image,Doc,Excel,Pdf)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for='(attach,count) in draft_attachments' :key="count+1" :id="'attachview'+count">
                                            <td>
                                                <input type="text" class="form-control" readonly :value="attach.user_defined_name">
                                            </td>
                                            <td>
                                                <a href="#" @click="openfile(attach)" class="fa fa-eye"> View</a>
                                                <span v-if="dis_status==true">
                                                    <a href="#" class="pl-4 fa fa-times text-danger" @click="deletefile(attach,count)"> Delete </a>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr id="record1" v-for='(att, index) in form.attachments' :key="index">
                                            <td>
                                                <input type="text" class="form-control" @change="remove_error('file_name'+(index+1))" :class="{ 'is-invalid' :form.errors.has('file_name') }" v-model="att.file_name" :id="'file_name'+(index+1)">
                                                <span class="text-danger" :id="'file_name'+(index+1)+'_err'"></span>
                                            </td>
                                            <td>
                                                <input type="file" class="form-control" @change="remove_error('attach'+(index+1))" v-on:change="onChangeFileUpload" :id="'attach'+(index+1)">
                                                <span class="text-danger" :id="'attach'+(index+1)+'_err'"></span>
                                            </td>
                                        </tr>
                                        <tr class="addmoredoc">
                                            <td colspan="3">
                                                <button type="button" class="btn btn-flat btn-sm btn-primary" id="addMore"
                                                @click="addMoreattachments()"><i class="fa fa-plus"></i> Add More</button>
                                                <button type="button" class="btn btn-flat btn-sm btn-danger" id="addMore"
                                                @click="removeattachments()"><i class="fa fa-trash"></i> Remove</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0.5">Remarks:</label>
                                <textarea v-model="form.remarks" :class="{ 'is-invalid' :form.errors.has('remarks') }" class="form-control" name="remarks" id="remarks"></textarea>
                                <has-error :form="form" field="remarks"></has-error>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button id="finalsubbtn" class="btn btn-primary" @click="shownexttab('final-tab')"> <i class="fa fa-save"></i>Save & Apply </button>
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
            count:1,
            action_param_type:'',
            dis_status:true,
            filecount:1,
            organizerList:[],
            trainingtypeList:[],
            relatedProgrammeList:[],
            programmeLevelList:[],
            programmeTypeList :[],
            courseTypeList:[],
            financialSourceList:[],
            categoryList:[],
            projectofdonorList:[],
            study_countryList:[],
            coursemodeList:[],
            nature_of_participantList:[],
            target_groupList:[],
            org_levelList:[],
            roleList:[],
            draft_attachments:[],
            form: new form({
                id: '',
                training_type: '',
                training_type_text:'',
                course_title:'',
                organizer:'',
                related_programme:'',
                start_date:'',
                end_date:'',

                programme_level:'',
                programme_type:'',
                course_type:'',
                course_provider:'',
                vanue:'',
                total_budget:0,
                total_hrs:'',
                financial_source:'',

                category:'',
                donor_agency:'',
                projectofdonor:'',
                study_country:'',
                coursemode:'',
                degree:'',
                subject1:'',
                subject2:'',
                thesis_title:'',
                attachments:
                [{
                    file_name:'',attachment:''
                }],
                ref_docs:[],

                nomination_start_date:'',
                nomination_end_date:'',
                nature_of_participant:[],
                target_group:[],
                org_level:[],
                role_action_mapp:
                [{
                    sequence:1,authority:'',role:''
                }],
                remarks:'',
            })
        }
    },
    methods: {
        openfile(file){
            let file_path=file.path+'/'+file.original_name;
            file_path=file_path.replaceAll('/', 'SSS');
            let uri = 'common/viewFiles/'+file_path;
            window.location=uri;
        },
        deletefile(file,count){
            Swal.fire({
                text: "Are you sure you wish to DELETE this selected file ?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
                cancelButtonText:'No',
                }).then((result) => {
                if (result.isConfirmed) {
                    let file_path=file.path+'/'+file.original_name;
                    file_path=file_path.replaceAll('/', 'SSS');
                    let uri = 'common/deleteFile/'+file_path+'/'+file.id;
                    axios.get(uri)
                    .then(response => {
                        let data = response;
                        if(data.data){
                            Swal.fire(
                                'Success!',
                                'File has been deleted successfully.',
                                'success',
                            );
                            $('#attachview'+count).remove();
                            this.loadDetails();
                        }
                        else{
                        Swal.fire(
                                'error!',
                                'Not able to delete this file. Please contact system adminstrator.',
                                'error',
                            );
                        }

                    })
                    .catch(function (error) {
                        console.log("Error:"+error);
                    });
                }
            });

        },
        addMore: function(){
            this.count++;
            this.form.role_action_mapp.push({sequence:this.count,authority:'',role:''})
        },
        addMoreattachments: function(){
            this.filecount++;
            this.form.attachments.push({file_name:'',attachment:''})
        },
        remove(index){
            if(this.form.role_action_mapp.length>1){
                this.count--;
                this.form.role_action_mapp.pop();
            }
        },
        removeattachments(index){
            if(this.form.attachments.length>1){
                this.filecount--;
                this.form.attachments.pop();
                this.form.ref_docs.pop();
            }
        },

        onChangeFileUpload(e){
            let currentcount=e.target.id.match(/\d+/g)[0];
            if($('#file_name'+currentcount).val()!=""){
                this.form.ref_docs.push({file_name:$('#file_name'+currentcount).val(),attachment:e.target.files[0]});
                $('#file_name'+currentcount).prop('readonly',true);
            }
            else{
                $('#file_name'+currentcount+'_err').html('Please mention file name');
                $('#'+e.target.id).val('');
            }
        },
        loadHrDevelopmentMasters(type){
            let url="masters/loadHrDevelopmentMastersData/"+type;
            axios.get(url)
            .then(response => {
                let data = response.data.data;
                if(type=="active_training_type_list"){
                    this.trainingtypeList=data;
                }
                if(type=="active_related_programme_list"){
                    this.relatedProgrammeList=data;
                }
                if(type=="active_programme_level_list"){
                    this.programmeLevelList=data;
                }
                if(type=="active_programme_type_list"){
                    this.programmeTypeList=data;
                }
                if(type=="active_course_type_list"){
                    this.courseTypeList=data;
                }
                if(type=="active_financial_source_list"){
                    this.financialSourceList=data;
                }
                if(type=="active_category_list"){
                    this.categoryList=data;
                }

                if(type=="active_nature_of_participant_list"){
                    this.nature_of_participantList=data;
                }
                if(type=="active_target_group_list"){
                    this.target_groupList=data;
                }
                //this.loadHrDevelopmentMasters('active_target_group_list');

            })
            .catch(function (error) {
                console.log("Error:"+error);
            });
        },

        shownexttab(nextclass){
            if(nextclass=="final-tab" && this.validateFileform()){
                Swal.fire({
                    text: "Are you sure you wish to save and publish ?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        const config = {
                            headers: {
                                'content-type': 'multipart/form-data'
                            }
                        }

                        let formData = new FormData();
                        formData.append('id', this.form.id);
                        formData.append('ref_docs[]', this.form.ref_docs);
                        for(let i=0;i<this.form.ref_docs.length;i++){
                            formData.append('attachments[]', this.form.ref_docs[i].attachment);
                            // formData.append('attachmentname[]', this.form.ref_docs[i].attachment.name+', '+this.form.ref_docs[i].file_name);
                            formData.append('attachmentname[]', this.form.ref_docs[i].file_name);
                        }
                        formData.append('training_type', this.form.training_type);
                        formData.append('training_type_text', $('#training_type option:selected').text());
                        formData.append('course_title', this.form.course_title);
                        formData.append('organizer', this.form.organizer);
                        formData.append('related_programme', this.form.related_programme);
                        formData.append('start_date', this.formatYYYYMMDD($('#start_date').val()));
                        formData.append('end_date', this.formatYYYYMMDD($('#end_date').val()));
                        formData.append('programme_level', this.form.programme_level);
                        formData.append('programme_type', this.form.programme_type);
                        formData.append('course_type', this.form.course_type);
                        formData.append('course_provider', this.form.course_provider);
                        formData.append('vanue', this.form.vanue);
                        formData.append('total_budget', this.form.total_budget);
                        formData.append('total_hrs', this.form.total_hrs);
                        formData.append('financial_source', this.form.financial_source);
                        formData.append('expenditurel_budget', this.form.expenditurel_budget);

                        formData.append('status', 'Created');
                        formData.append('nature_of_participant', this.form.nature_of_participant);
                        formData.append('remarks', this.form.remarks);
                        if(this.action_param_type=="edit"){
                            axios.post('/staff/hrdevelopment/saveprogramDetails', formData, config)
                            .then((response) => {
                                if(response!=null && response!=""){
                                    Swal.fire(
                                        'Success!',
                                        'Details has been saved successfully.',
                                        'success',
                                    )
                                    this.$router.push('/list_programme');
                                }
                            })
                            .catch((error) => {
                                this.change_tab('programme-tab');
                                this.applyselect2field('training_type');
                                this.applyselect2field('organizer');
                                this.applyselect2field('financial_source');
                                this.applyselect2field('programme_level');
                                this.applyselect2field('programme_type');
                                this.applyselect2field('course_type');
                            });
                        }
                    }
                });
            }
        },
        validateFileform(){
            let returnvariable=true;
            for(let i=0;i<this.filecount;i++){
                if($('#file_name'+(i+1)).val()==""){
                    $('#file_name'+(i+1)+'_err').html('Please mention file name');
                    returnvariable=false;
                }
                if($('#attach'+(i+1)).val()==""){
                    $('#attach'+(i+1)+'_err').html('Please mention file');
                    returnvariable=false;
                }
                if($('#attach'+(i+1)).val()!=undefined && $('#attach'+(i+1)).val()!="" && !this.isvalidfile($('#attach'+(i+1)).val())){
                    $('#attach'+(i+1)+'_err').html('This file is not accepted. The accepted files are: ' +this.validfile());
                    returnvariable=false;
                }
            }
            return returnvariable;
        },
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="training_type"){
                this.form.training_type=$('#training_type').val();
            }
            if(id=="related_programme"){
                this.form.related_programme=$('#related_programme').val();
            }
            if(id=="organizer"){
                this.form.organizer=$('#organizer').val();
            }
            if(id=="programme_level"){
                this.form.programme_level=$('#programme_level').val();
            }
            if(id=="programme_type"){
                this.form.programme_type=$('#programme_type').val();
            }
            if(id=="course_type"){
                this.form.course_type=$('#course_type').val();
            }
            if(id=="financial_source"){
                this.form.financial_source=$('#financial_source').val();
            }
            if(id=="category"){
                this.form.category=$('#category').val();
            }
            if(id=="donor_agency"){
                this.form.donor_agency=$('#donor_agency').val();
            }
            if(id=="projectofdonor"){
                this.form.projectofdonor=$('#projectofdonor').val();
            }
            if(id=="study_country"){
                this.form.study_country=$('#study_country').val();
            }
            if(id=="coursemode"){
                this.form.coursemode=$('#coursemode').val();
            }

        },
        loadDetails(id,type){
            this.action_param_type=type;
            axios.get('staff/hrdevelopment/loadDetails/'+id)
            .then((response) => {
                let data=response.data.data;
                this.form.id=data.id;
                this.form.training_type=data.training_type;
                $('#training_type').val(data.training_type).trigger('change');
                this.form.course_title=data.course_title;
                this.form.organizer=data.organizer;
                $('#organizer').val(data.organizer).trigger('change');
                this.form.related_programme=data.related_programme;
                $('#related_programme').val(data.related_programme).trigger('change');
                this.form.start_date=data.start_date;
                this.form.end_date=data.end_date;
                $('#start_date').val(this.reverseDate1(data.start_date));
                $('#end_date').val(this.reverseDate1(data.end_date));

                this.form.programme_level=data.programme_level_id;
                $('#programme_level').val(data.programme_level_id).trigger('change');
                this.form.programme_type=data.programme_type_id;
                $('#programme_type').val(data.programme_type_id).trigger('change');
                this.form.course_type=data.course_type_id;
                $('#course_type').val(data.course_type_id).trigger('change');
                this.form.course_provider=data.course_provider;
                this.form.vanue=data.vanue;
                this.form.total_budget=data.total_budget;
                this.form.expenditurel_budget=data.expenditurel_budget;
                this.form.total_hrs=data.total_hrs;
                this.form.financial_source=data.financial_source_id;
                $('#financial_source').val(data.financial_source_id).trigger('change');
                this.form.category=data.category;
                this.form.coursemode=data.coursemode;
                this.draft_attachments=data.attachments;
                this.form.attachments=[];
                this.form.remarks=data.remarks;
                for(let i=0;i<this.nature_of_participantList.length;i++){
                    if(data.nature_of_participant.includes(this.nature_of_participantList[i].id)){
                        $("input[value='" + this.nature_of_participantList[i].id + "']").prop('checked', true);
                        this.form.nature_of_participant.push(this.nature_of_participantList[i].id);
                    }
                }
            })
            .catch((error) => {
                console.log("Error......"+error);
            });
        },
        loadorganizerList(uri = 'organization/getsAgencyList/allSSS'){
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.organizerList = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
    },

    async mounted() {
        this.count=1,
        $('[data-toggle="tooltip"]').tooltip();
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id'));
        });
        this.loadorganizerList();
        Fire.$on('changefunction',(id)=> {
            this.changefunction(id);
        });

        this.trainingtypeList =  await this.loadstaffMasters('active','hr_development_masters___TrainingType');
        this.relatedProgrammeList =  await this.loadstaffMasters('all','hr_development_masters___RelatedProgramme');
        this.nature_of_participantList =  await this.loadstaffMasters('all','hr_development_masters___NatureOfParticipant');
        this.financialSourceList =  await this.loadstaffMasters('all','hr_development_masters___FinancialSource');
        this.programmeLevelList =  await this.loadstaffMasters('all','hr_development_masters___ProgrammeLevel');
        this.programmeTypeList =  await this.loadstaffMasters('all','hr_development_masters___ProgrammeType');
        this.courseTypeList =  await this.loadstaffMasters('all','hr_development_masters___CourseType');
        this.coursemodeList =  await this.loadstaffMasters('all','CourseMode');

        this.loadDetails(this.$route.params.data,this.$route.params.type);
    },
}
</script>
