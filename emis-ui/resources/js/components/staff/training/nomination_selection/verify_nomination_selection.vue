<template>
    <div>
        <div id="maindiv">
            <div class="card card-success card-outline collapsed-card" id="adv_serach_ection">
                <div class="card-body pb-0 mb-0" style="display:none">
                    <div class="callout callout-success">
                        <div class="form-group row"> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Trainig Type:</label><br>
                                <span class="text-blue text-bold">{{ trainingtypeList[form.training_type]}}</span>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Course Title:</label><br>
                                <span class="text-blue text-bold">{{form.course_title}}</span>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Organized By (Department/Division):</label><br>
                                <span class="text-blue text-bold">{{trainingtypeList[form.organizer]}}</span>
                            </div> 
                        </div>
                        <div class="form-group row"> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Related Programme:</label><br>
                                <span class="text-blue text-bold">{{ relatedProgrammeList[form.related_programme]}}</span>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Start Date:</label><br>
                                <span class="text-blue text-bold">{{form.start_date}}</span>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">End Date:</label><br>
                                <span class="text-blue text-bold">{{form.end_date}}</span>
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
                                        <tr v-for='(attach,count) in draft_attachments' :key="count+1">
                                            <td> 
                                                {{attach.user_defined_name}}
                                            </td>
                                            <td>    
                                                <a href="#" @click="openfile(attach)" class="fa fa-eye"> View</a>
                                            </td> 
                                        </tr>
                                    </tbody>
                                </table> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-header pb-0 pt-2">
                    <h3 class="card-title">Program Details</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-plus" ></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card card-success card-outline">
                <div class="card-header pb-0 pt-2">
                    <h3 class="card-title">Nominee Details</h3>
                </div>
                <div class="card-body pb-0 mb-0">
                    <div class="modal fade show" id="applicant_modal" aria-modal="true" style="padding-right: 17px;">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Participant Details</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table id="participant-table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Sl#</th>
                                                <th>CID/Work Permit Id</th>
                                                <th>Name</th> 
                                                <th>Contact No</th>  
                                                <th>Email</th> 
                                                <th>Participating As</th>    
                                                <th>Attachments</th>
                                                <th></th>
                                                <th></th>                     
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(item, index) in tempparticipantform.participant_list" :key="index">
                                                <td>{{ index+1}}</td>
                                                <td>{{ item.staff_details.cid_work_permit}}</td>
                                                <td>{{ item.staff_details.name}}</td> 
                                                <td>{{ item.contact}}</td>
                                                <td>{{ item.email }}</td> 
                                                <td>{{ nature_of_participantListname[item.nature_of_participant]}}</td>
                                                <td>
                                                    <span v-for="(doc, index) in item.document" :key="index">
                                                        <a href="#" @click="openfile(doc)"> {{ doc.original_name.split('_')[1]}}</a>
                                                    </span> 
                                                </td>
                                                <td>
                                                    <select :id="'selectpar'+index" v-model="item.status" @change="remove_error('selectpar',index)" class="form-control">
                                                        <option value="">Choose</option>
                                                        <option value="Selected">Select</option>
                                                        <option value="Rejected">Reject</option>
                                                    </select>
                                                    <span class="text-danger" :id="'selectpar_err'+index"></span>
                                                </td>
                                                <td>
                                                    <textarea v-model="item.remarks" class="from-control"></textarea>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="form-group row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label class="mb-0.5">Remarks:</label>
                                            {{tempparticipantform.remarks}}
                                        </div>
                                    </div> 
                                </div>
                                <div class="modal-footer text-right">
                                    <button data-bb-handler="cancel" type="button" data-dismiss="modal" class="btn btn-danger "><i class="fa fa-times"></i> Cancel</button>
                                    <button data-bb-handler="confirm" type="button" class="btn btn-primary " @click="updateParticipant()"><i class="fa fa-edit"></i>Done</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table id="dynamic-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sl#</th>
                                <th>AppNo</th> 
                                <th>Dzongkhag</th>   
                                <th>Organization</th>  
                                <th>Action</th> 
                            </tr>
                        </thead>
                        <tbody> 
                            <tr v-for="(item, index) in org_list" :key="index">
                                <td>
                                    {{ index+1}}
                                    <input type="checkbox" class="form-checkbox ml-2" name="participantcheck" disabled :id="'check_tr_app_'+index">
                                </td>
                                <td>{{ item.app_no}}</td>
                                <td>{{ item.dzo_details.name}}</td> 
                                <td>{{ item.org_details.name}}</td>
                                <td>
                                    <button class="btn btn-xs  btn-primary" @click="getParticipantDetails(item,item.org_id,index)"><i class="fa fa-eye"></i> View</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
                            <button class="btn btn-primary" @click="submitforapproval()"> <i class="fa fa-save"></i> Update</button>
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
            trainingtypeList:[],
            relatedProgrammeList:[],
            draft_attachments:[],
            nature_of_participantList:[],
            nature_of_participantListname:[],
            org_list:[],
            
            editdocument:[],
            orgcount:0,
            tempparticipantform:new form({
                participant_list:[],
                remarks:''
            }),
            form: new form({
                id: '', 
                programId:'',
                statusId:'',
                remarks:''
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
        loadHrDevelopmentMasters(type){
            let url="masters/loadHrDevelopmentMastersData/"+type;
            axios.get(url)
            .then(response => {
                let data = response.data.data;
                if(type=="active_training_type_list"){
                    for(let i=0;i<data.length;i++){
                        this.trainingtypeList[data[i].id] = data[i].name; 
                    }
                }
                if(type=="active_related_programme_list"){
                    for(let i=0;i<data.length;i++){
                        this.relatedProgrammeList[data[i].id] = data[i].name; 
                    }
                }
                if(type=="active_nature_of_participant_list"){
                    for(let i=0;i<data.length;i++){
                        this.nature_of_participantListname[data[i].id] = data[i].name; 
                    }
                }
            })
            .catch(function (error) {
                console.log("Error:"+error);
            });
        },
        updateParticipant(){
            if(this.validateparticilant()){
                this.tempparticipantform.post('staff/hrdevelopment/updateParticipant')
                .then((response) =>{  
                    Toast.fire({
                        icon: 'success',
                        title: 'Data updated Successfully'
                    });
                })
                .catch((error) => { 
                    console.log("Errors:"+error)
                });
                $('#check_tr_app_'+this.orgcount).prop('checked',true);
                $('#applicant_modal').modal('hide');
            }
        },
        validateparticilant(){
            let returntype=true;
            for(let i=0;i<this.tempparticipantform.participant_list.length;i++){
                if($('#selectpar'+i).val()==""){
                    $('#selectpar_err'+i).html('Select this');
                    $('#selectpar'+i).addClass('is-invalid');
                    returntype=false;
                }
            }
            return returntype;
        },
        remove_error(field_id,index){
            if($('#'+field_id+index).val()!=""){
                $('#'+field_id+index).removeClass('is-invalid');
                $('#'+field_id+'_err'+index).html('');
            }
        }, 
        loadDetails(id,statusId){
            
            axios.get('staff/hrdevelopment/getParticipantDetails/orgdetails/'+id)
            .then((response) =>{   
                let data=response.data.data;
                this.org_list=data;
            })
            .catch((error) =>{  
                console.log("Error:"+error);
            });
        },

        getParticipantDetails(program_id,orgId,count){
            axios.get('staff/hrdevelopment/getParticipantDetails/verification/'+program_id.program_id+'SSS'+orgId)
            .then((response) =>{   
                let data=response.data.data;
                this.tempparticipantform.participant_list=data;
                this.tempparticipantform.remarks=program_id.remarks;
                this.orgcount=count;
                $('#applicant_modal').modal('show');
            })
            .catch((error) =>{  
                console.log("Error:"+error);
            });
        },
        validated(){
            let returnt=true;
            if(this.org_list.length<1){
                Swal.fire(
                    'error!',
                    'No application detial to take action',
                    'error',
                ); 
                returnt=false;
            }
            for(let i=0;i<this.org_list.length;i++){
                if(!$('#check_tr_app_'+this.orgcount).prop('checked')){
                    Swal.fire(
                        'error!',
                        'Some of the records doesnot viewed. Please visit them and take action',
                        'error',
                    ); 
                    returnt=false;
                }
            }
            return returnt;
        },
        submitforapproval(){
            if(this.validated()){
                Swal.fire({
                    text: "Are you sure you wish to update this details ?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        this.form.post('/staff/hrdevelopment/updateapplication')
                        .then((response) => {  
                            if(response!=null && response!=""){
                                let message="Application details has been updated.  <br><b>Thank You !</b>";
                                this.$router.push({name:'acknowledgement',params: {data:message}});
                                Swal.fire(
                                    'Success!',
                                    'Nomination details has beed submitted',
                                    'success',
                                )
                            }
                        })
                        .catch((error) => {  
                            console.log("Error:"+error)
                        });
                    }
                });
            }
            
        }
    },
    
    mounted() {
        $('[data-toggle="tooltip"]').tooltip();
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        this.loadHrDevelopmentMasters('active_training_type_list');
        this.loadHrDevelopmentMasters('active_related_programme_list');
        this.loadHrDevelopmentMasters('active_nature_of_participant_list');
        this.form.statusId=this.$route.params.statusId;
        this.form.programId=this.$route.params.data;
        this.loadDetails(this.$route.params.data,this.$route.params.statusId);
    },
}
</script>