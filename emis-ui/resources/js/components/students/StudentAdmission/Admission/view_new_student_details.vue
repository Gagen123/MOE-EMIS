<template>
    <div>
        <div class="card-body">
            <div class="form-group" id="main_form">
                <h6><u>Student Details</u></h6><br>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label class="required" >CID No/Reference  : </label>
                        <label class="text-primary">{{std_admission_details.student_code ? std_admission_details.student_code : std_admission_details.CidNo}}</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label class="required" >Name of Student :</label>
                        <label class="text-primary">{{std_admission_details.Name ? std_admission_details.Name : std_admission_details.FirstName+' '+std_admission_details.MiddleName+' '+std_admission_details.LastName}}</label>
                    </div>
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
                <label>Present School Details: </label>
                <div class="row form-group">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <label class="required" >Class : </label>
                        <label class="text-primary">{{ }}</label>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                        <label class="required" >School : </label>
                        <label class="text-primary"><span id="gewogid"></span>{{std_admission_details.organization_name}}</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label class="required" >Dzongkhag :</label>
                        <label class="text-primary"><span id="vilageId"></span> {{dzongkhagArray[std_admission_details.organization_dzo]}}</label>
                    </div>
                </div>
            </div>
            <hr><br>
            <div class="form-group" id="main_form">
                <h6><u>Parents Details</u></h6><br>
                <table id="list-student-left" class="table table-bordered table-striped table-head-fixed">
                    <thead>
                        <tr>
                            <th >No.</th>
                            <th >Name</th>
                            <th >Relation</th>
                            <th >CID</th>
                            <th >Occupation</th>
                            <th >Permanent Address</th>
                            <th >Working Address</th>
                            <th >Residence Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, count) in parents_details" :key="count">
                            <td>{{ count + 1 }} </td>
                            <td>{{ item.Name }}</td>
                            <td>{{ item.Relationship }}</td>
                            <td>{{ item.CidNo }}</td>
                            <td>{{ item.CmnOccupationId }}</td>
                            <td>{{  }}</td>
                            <td>{{ item.WorkAddress }}</td>
                            <td>{{ item.ResidenceAddress }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            student_id:'',
            student_code:'',
            std_admission_details:'',
            parents_details:[],
            genderArray:{},
            dzongkhagArray:{},
            gewogArray:{},
            villageArray:{},
            sex_idList:[],
            countryList:[],
            dzongkhagList:[],
            std_gewog_list:[],
            std_villageList:[],
            motherTongueList:[],
        }
    },

    methods:{

        /**
         * method to remove error
         */
        removeerror(fieldid){
			if($('#'+fieldid).val()!=""){
				$('#'+fieldid).removeClass('is-invalid');
				$('#'+errid).html(''); 
			}
		},

        loadAllActiveMasters(type){
            axios.get('masters/loadGlobalMasters/'+type)
            .then(response =>{
                let data = response;
                if(type=="active_mother_tongue"){
                    this.motherTongueList = data.data.data;
                }
                if(type=="all_active_dzongkhag"){
                    this.dzongkhagList = data.data.data;
                }
                if(type=="all_active_gender"){
                    this.sex_idList = data.data.data;
                }
                if(type=="all_country"){
                    this.countryList = data.data.data;
                }
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        getdzongkhagList(uri ='masters/loadGlobalMasters/all_active_dzongkhag'){
			axios.get(uri)
			.then(Response =>{
			let data = Response.data.data;
			for(let i=0;i<data.length;i++){
                    this.dzongkhagArray[data[i].id] = data[i].name;
                }
                $('#dzongkhag').prop('disabled',false);  
            }).catch(error => console.log(error));

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
        loadAdmissionDetails(std_id, std_code){
            var uri='';
            if(std_code == null){
                uri = '/students/admission/getStudentDetails/admission_'+std_id;
            } else{
                uri = '/students/admission/getStudentDetails/'+std_id;
            }
			axios.get(uri)
			.then(response => {
                let data = response.data.data;
                if(data != ""){
                    this.std_admission_details = data;
                    this.parents_details = data.parents;
                }
			});
		},
    },
    mounted() { 
        this.loadAllActiveMasters('all_country');
        this.loadAllActiveMasters('all_active_gender');
        this.loadAllActiveMasters('active_mother_tongue');
        this.getdzongkhagList();
        this.loadGenderList();
      
        $('.select2').select2();
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id')); 
        });
        
        Fire.$on('changefunction',(id)=> {
            this.changefunction(id);
        });
        this.student_id = this.$route.params.data.id;
        this.student_code = this.$route.params.data.std_code;
        this.loadAdmissionDetails(this.$route.params.data.id, this.$route.params.data.std_code);
        
    }
}
</script>