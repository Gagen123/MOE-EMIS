<template>
<div class="container-fluid">
    <div class="content-header pb-0">
        <div class="content-header pt-1 pb-0">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-9">
					<h5><b>Request for Admission with Regard to Transfer of Parents etc.</b></h5>
					</div>
				</div>
			</div>
		</div>
    </div>
    <div class="card">
      	<div class="card-body">
			<form id="" class="form-horizontal" enctype="multipart/form-data" action="#" method="POST">
				<div class="form-group" id="main_form">
					<h5><u>Student Details</u></h5><br>
					<div class="row form-group">
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<label class="required" >CID No/Reference  : </label>
							<label class="text-primary">{{std_admission_details.CidNo}}</label>
						</div>
						<template v-if="!is_student">
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<label class="required" >Name of Student :</label>
								<label class="text-primary">{{ std_admission_details.FirstName}} {{ std_admission_details.MiddleName=='null' ? '': std_admission_details.MiddleName}} {{ std_admission_details.LastName=='null' ? '': std_admission_details.LastName}}</label>
							</div>
						</template>
						<template v-else>
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<label class="required" >Name of Student :</label>
								<label class="text-primary">{{ std_admission_details.Name}} </label>
							</div>
						</template>
					</div>
					<div class="row form-group">
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<label class="required" >Gender :</label>
							<label class="text-primary">{{ genderArray[std_admission_details.CmnSexId]}}</label>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<label >Date of Birth :</label>
							<label class="text-primary">{{std_admission_details.DateOfBirth}}</label>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<label class="required" >Dzongkhag : </label>
							<label class="text-primary">{{dzongkhagArray[std_admission_details.CmnDzoId]}}</label>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<label class="required" >Gewog : </label>
							<label class="text-primary"><span id="gewogid"></span>{{gewogArray[std_admission_details.CmnGewogId]}}</label>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<label class="required" >Village :</label>
							<label class="text-primary"><span id="vilageId"></span> {{villageArray[std_admission_details.CmnChiwogId]}}</label>
						</div>
					</div>
				</div>
				<hr><br>
				<template v-if="!admission_requested">
					<div class="row md-12">
						<div class="form-group col-md-3">
							<label class="required">Dzongkhag/Thromde <span class="text-danger">*</span><span class="text-danger"></span></label>
							<select name="dzongkhag" v-model="student_form.dzongkhag" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('dzongkhag') }" class="form-control select2" id="dzongkhag"  >
								<option value="">--- Please Select ---</option>
								<option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{item.name}}</option>
							</select>
						</div>
						
						<div class="form-group col-md-3">
							<label>Class<span class="text-danger">*</span></label>
							<input type="text" class="form-control" @change="removeerror('class')" :class="{ 'is-invalid': student_form.errors.has('class') }" id="class" v-model="student_form.class" disabled="true">
								<has-error :form="student_form" field="class"></has-error>
						</div>
						<div class="form-group col-md-3">
							<label>Request Date:<span class="text-danger">*</span></label>
								<input type="date" class="form-control" @change="removeerror('dateOfapply')" :class="{ 'is-invalid': student_form.errors.has('dateOfapply') }" id="dateOfapply" v-model="student_form.dateOfapply" disabled="true">
								<has-error :form="student_form" field="date"></has-error>
						</div>
					</div>
					<div class="row md-12">
						<div class="form-group col-md-12" >
							<label>Reason <span class="text-danger">*</span><span class="text-danger"></span></label>
								<textarea v-model="student_form.reasons" id="reasons" type="text" name="reasons" class="form-control" :class="{ 'is-invalid': student_form.errors.has('reasons') }"   />
							<has-error :form="student_form" field="reasons"></has-error>
						</div>
					</div>
					<small><i>(Please upload any supporting documents (e.g. Transfer Order etc.))</i></small>
					<div class="form-group row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<table id="dynamic-table" class="table table-sm table-bordered table-striped">
								<thead>
									<tr>
										<th>File Name</th>
										<th>Upload File</th>
									</tr>
								</thead>
								<tbody>
									<tr id="record1" v-for='(att, index) in student_form.attachments' :key="index">
										<td>
											<input type="text" class="form-control" :class="{ 'is-invalid' :student_form.errors.has('file_name') }" v-model="att.file_name" :id="'file_name'+(index+1)">
											<span class="text-danger" :id="'fileName'+(index+1)+'_err'"></span>
										</td>
										<td>
											<input type="file" name="attachments" class="form-control application_attachment" v-on:change="onChangeFileUpload" :id="'attach'+(index+1)">
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
					<hr>                        
					<div class="footer float-right" >
						<button type="button" v-on:click="resetForm" class="btn btn-danger"><i class="fas fa-redo"></i> Reset</button>
						<button type="button" v-on:click="submitForm" class="btn btn-success"> <i class="fas fa-save"></i> Request</button>
					</div>
				</template>
				<template v-else>
					<div class="form-group" id="main_form">
						<h6><u>Admission Request Details</u></h6><br>
						<div class="row form-group">
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<label class="required" >Dzongkhag For Admission Request: </label>
								<label class="text-primary">{{dzongkhagArray[this.new_dzongkhag_admission]}}</label>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<label class="required" >Date of Application:</label>
								<label class="text-primary">{{ this.admission_request_date}}</label>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<label class="required" >Reasons :</label>
								<label class="text-primary">{{ this.admission_request_reason}}</label>
							</div>
						</div>
					</div>
				</template>
			</form>
      	</div>
    </div>
</div>
</template>
<script>
export default {
	data(){
		return{
			is_student:false,
			admission_requested:false,
            std_id:'',
            std_class:'',
            org_id:'',
            parent_school_dzongkhag:'',
			std_admission_details:'',
			OrgDetails:'',
			getDzoName:'',
			getGewogName:'',
			dzongkhagList:[],
			schoolList:[],
			classList:[],
			streamList:[],
			getreasons:'',
			genderArray:{},
			dzongkhagArray:{},
            gewogArray:{},
            villageArray:{},
			dzongkhagId:'null',
			gewogId:'null',
			new_dzongkhag_admission:'',
			admission_request_date:'',
			admission_request_reason:'',
			admission_request_files:'',
			student_form: new form({
				id:'',
				student_id:'',
				dzongkhag:'',
				school:'',
				class:'',
				stream:'',
				dateOfapply:new Date().toISOString().substr(0, 10),
				reasons:'',
				status:'',
				attachments:
                [{
                    file_name:'', attachment:''
                }],
				ref_docs:[],
			})
		}
	},
	methods:{
		onChangeFileUpload(e){
            let currentcount=e.target.id.match(/\d+/g)[0];
            if($('#fileName'+currentcount).val()!=""){
                this.student_form.ref_docs.push({name:$('#file_name'+currentcount).val(), attach: e.target.files[0]});
                $('#fileName'+currentcount).prop('readonly',true);
            }
            else{
                $('#fileName'+currentcount+'_err').html('Please mention file name');
                $('#'+e.target.id).val('');
            }
        },
        addMore: function(){
            this.student_form.attachments.push({file_name:'', file_upload:''})
        },
        remove(index){
            if(this.student_form.attachments.length>1){
                this.student_form.attachments.pop();
            }
        },
		resetForm: function(event){
			this.student_form.reset();
		},

		showAndHideField:function(type){
			if(type=="classXI"){
				$('#stream').show();
			}
			
			if(type=="others"){
				$('#stream').hide();
			}
		},
		
		submitForm(){
			const config = {
				headers: {
					'content-type': 'multipart/form-data'
				}
			}
			this.$Progress.start();
			let formData = new FormData();
			formData.append('student_id', this.student_form.student_id);
			formData.append('dzongkhag', this.student_form.dzongkhag);
			formData.append('class', this.student_form.class);
			formData.append('dateOfapply', this.student_form.dateOfapply);
			formData.append('reasons', this.student_form.reasons);
			formData.append('attachments', this.student_form.attachments); 
			formData.append('ref_docs', this.student_form.ref_docs); 
			for(let i=0;i<this.student_form.ref_docs.length;i++){
				formData.append('attachments[]', this.student_form.ref_docs[i].attach);
				formData.append('attachmentname[]', this.student_form.ref_docs[i].name);
			}
			formData.append('status', 'pending'); 

			axios.post('/admissions/saveAdmissionRequest',formData,config)
			.then(()=>{
				Toast.fire({
					icon: 'success',
					title: 'you have applied successfully'
				})
			})
			.catch(()=>{console.log("Error.....")})
		},

		getdzongkhagList(uri ='masters/loadGlobalMasters/all_active_dzongkhag'){
			axios.get(uri)
			.then(Response =>{
			let data = Response.data.data;
			this.dzongkhagList = data;
			for(let i=0;i<data.length;i++){
                    this.dzongkhagArray[data[i].id] = data[i].name;
                }
                $('#dzongkhag').prop('disabled',false);  
            }).catch(error => console.log(error));

		},

		getschoolList(id){
			let dzoId=$('#dzongkhag').val();
			if(id!=""){
				dzoId=id;
			} 
			axios.get('/masters/getOrgList/' +dzoId)
				.then(response =>{
				let data = response.data.data;
				this.schoolList = data;
			})
		},
		loadGenderList(uri="masters/loadGlobalMasters/all_active_gender"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.sex_idList =  data.data.data;
                for(let i=0;i<data.data.data.length;i++){
                    this.genderArray[data.data.data[i].id] = data.data.data[i].name;
                }
            })
            .catch(function (error) {
                console.log(error);
            });
        },

		getclassList(id){
			let orgId=$('#school').val();
				if(id!=""){
				orgId=id;
			} 
			axios.get('/masters/loadClassStreamSection/NA/' +orgId)
			.then(Response =>{
				let data = Response.data;
				// console.log(data);
				this.classList = data;
			})
		},
		
		getstreamListByid(id){
			let classId=$('#class').val();
				if(id!=""){
				classId=id;
			} 
			axios.get('/masters/getStreamByclassId/' +classId)
			.then(Response =>{
				let data = Response.data;
				// console.log(data);
				this.classList = data;
			})
		},

		getstreamList(uri ='masters/loadGlobalMasters/all_active_dzongkhag'){
			axios.get(uri)
			.then(Response =>{
				let data = Response.data.data;
				this.streamList = data;
			})

		},

		getOrgDetails(id){
			axios.get('organizations/loadOrganizationDetailsbyOrgId/' +id)
			.then(response =>{
				let data = response.data.data;
				this.OrgDetails=data;
				this.getdzongkhagName(this.OrgDetails.dzongkhagId);
				this.getgewogName(this.OrgDetails.gewogId);
			})

		},
		getdzongkhagName(dzo_id){
			axios.get('masters/load_dzongkhag_details_by_id/' +dzo_id)
			.then(response =>{
				let data = response.data.data;
				this.getDzoName=data;
			
			})

		},
		getgewogName(gewog_id){
			axios.get('masters/load_gewog_details_by_id/' +gewog_id)
			.then(response =>{
				let data = response.data.data;
				this.getGewogName=data;
			})
		},

		getstudentPersonalDetails(type){
            axios.get('/admissions/getStudentDetailsFromPortal/'+type)
                .then(response => {
                let data = response.data;
                if(data != ""){
                    this.std_admission_details=data;
                    this.org_id = this.std_admission_details.OrgOrganizationId;
                    this.getStudentClass(data.id);
                    // this.student_form.student_id=data.id;
                    // this.getGewogList(data.CmnDzoId,data.CmnGewogId);
                    // this.getvillagelist(data.CmnGewogId,data.CmnChiwogId);
                }
                else{
                    $('#main_form').hide();
                    $('#message').html('You are not yet registered in the system. Please register your self first to proceed further from here. <br> Thank you!');
                    $('#screenPermission').show();
                }
            });
        },

		loadAdmissionRequest(std_id){
			axios.get('/admissions/loadAdmissionRequest/'+std_id)
			.then(response => {
                let data = response.data.data;
                if(data != ""){
					this.admission_requested = true;
                    this.new_dzongkhag_admission=data[0].dzongkhag;
                    this.admission_request_date = data[0].dateOfapply;
                    this.admission_request_reason=data[0].reasons;
					this.admission_request_files='';
                }
			});
		},

		getStudentClass(std_id){
            let uri = '/students/getStudentClassId/'+ std_id;
            try{
                axios.get(uri).then(response => {
                    let data= response.data.data;
                    this.std_class=data.class;
                    this.student_form.class = this.std_class;
                });
            }catch(e){
                console.log('error loadactivedzongkhags '+e);
            }
        },

		applyselect(){
			if(!$('#dzongkhag').attr('class').includes('select2-hidden-accessible')){
				$('#dzongkhag').addClass('select2-hidden-accessible');
			}
			if(!$('#school').attr('class').includes('select2-hidden-accessible')){
				$('#school').addClass('select2-hidden-accessible');
			}
			if(!$('#class').attr('class').includes('select2-hidden-accessible')){
				$('#class').addClass('select2-hidden-accessible');
			}
			if(!$('#stream').attr('class').includes('select2-hidden-accessible')){
				$('#stream').addClass('select2-hidden-accessible');
			}
		},
		removeerror(fieldid){
			if($('#'+fieldid).val()!=""){
				$('#'+fieldid).removeClass('is-invalid');
				$('#'+errid).html(''); 
			}
		},

		async changefunction(id){
			if($('#'+id).val()!=""){
				$('#'+id).removeClass('is-invalid select2');
				$('#'+id+'_err').html('');
				$('#'+id).addClass('select2');
			}
			
			if(id=="dzongkhag"){
				this.student_form.dzongkhag=$('#dzongkhag').val();
			}
		}
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
	},

	mounted() {
        axios.get('getSessionDetail')
        .then(response => {
            let data = response.data.data;
            this.std_id=data['std_id'];
            let user_type=data['user_type'];
            if(data['user_type']!="Parent"){
                this.is_student=true;
            }
            this.getstudentPersonalDetails(user_type);
			this.student_form.student_id=data.id;
			this.loadAdmissionRequest(data['std_id']);
        })
        .catch(errors => {
            console.log(errors)
        });

        $('.select2').select2({
        theme: 'bootstrap4'
        });
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id'));
        });
        Fire.$on('changefunction',(id)=> {
            this.changefunction(id);
        });
		
        this.getdzongkhagList();
		this.getclassList();
		this.getstreamList();
		this.getdzongkhagName();
		this.getgewogName();
        this.loadGenderList();
    },

	// created() { 
	// 	this.getdzongkhagList();
	// 	this.getclassList();
	// 	this.getstreamList();
	// 	this.getdzongkhagName();
	// 	this.getgewogName();
	// 	this.student_form.cid_passport=this.$route.query.data[0].CidNo;
	// 	this.student_form.Name=this.$route.query.data[0].Name;
	// 	this.student_form.gender=this.$route.query.data[0].CmnSexId;
	// 	this.student_form.DateOfBirth=this.$route.query.data[0].DateOfBirth; 
	// 	this.student_form.address=this.$route.query.data[0].Address;
	// 	this.getOrgDetails(this.$route.query.data[0].OrgOrganizationId);
		
	// },
}
</script>
