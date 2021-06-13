<template>
<div class="container-fluid">
    <div class="content-header pb-0">
        <div class="content-header pt-1 pb-0">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h5><b>Admission for Enrolled Student</b></h5>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row-12">
                 <!-- <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <input type="radio" name="snationality" v-model="std_admission_details.snationality" value="Bhutanese" id="s-bhutanese" @click="showstdidentity('Student-Bhutanese')" checked> Bhutanese <br>
                    <input type="radio" name="snationality" v-model="std_admission_details.snationality" value="Foreign" id="s-foreign" @click="showstdidentity('Student-Non-Bhutanese')"> Non-Bhutanese
                    <span class="text-danger" id="snationality_err"></span>
                  </div> -->
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label class="required" >CID No/Reference  : </label>
                        <label class="text-primary">{{std_admission_details.CidNo}}</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label class="required" >Student Code : </label>
                        <label class="text-primary">{{ std_admission_details.student_code}}</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label class="required" >Name of Student :</label>
                        <label class="text-primary">{{ std_admission_details.first_name}} {{ std_admission_details.middle_name}} {{ std_admission_details.last_name}}</label>
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
                 <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label class="required" >Dzongkhag : </label>
                        <label class="text-primary">{{dzongkhagArray[std_admission_details.dzongkhag]}}</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label class="required" >Gewog : </label>
                        <label class="text-primary"><span id="gewogid"></span>{{gewogArray[std_admission_details.CmnGewogId]}}</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label class="required" >Village :</label>
                        <label class="text-primary"><span id="vilageId"></span> {{villageArray[std_admission_details.village_id]}}</label>
                    </div>
                </div>
            </div>

            <div class="row-12">
                <div class="card">
                    <label class="card-header"><strong>Parent/Guardian Details</strong></label>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>CID</th>
                                <th>Name</th>
                                <th>Relation</th>
                                <th>Contact Number</th>
                                <th>Email</th>
                                <th>Occupation</th>
                                <th>Residence Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in std_parents" :key="index">
                                <td>{{ item.cid_passport}}</td>
                                <td>{{ item.name}}</td>
                                <td>{{ item.contact_type}}</td>
                                <td>{{ item.cntct_no}}</td>
                                <td>{{ item.email}}</td>
                                <td>{{ item.occupation}}</td>
                                <td>{{ item.residence_address}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row md-12">
                <div class="form-group col-md-4">
                    <h5><b>Class Stream </b></h5>
                </div>
            </div>
            <div class="row md-12">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Class: <span class="text-danger">*</span></label>
                    <select v-model="std_admission_details.class_id" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('class') }" class="form-control select2" name="class" id="std_class_id">
                        <option value="">--- Please Select ---</option>
                        <option v-for="(item, index) in classList  " :key="index" v-bind:value="item.id">{{item.class}}</option>
                    </select>
                </div>
            </div>
            <div class="row md-12">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label>Remarks</label>
                    <textarea v-model="student_form.remarks" id="remarks" type="text" name="remarks"  placeholder=" Enter Remarks"
                    class="form-control" :class="{ 'is-invalid': student_form.errors.has('remarks') }" />
                    <has-error :form="student_form" field="remarks"></has-error>
                </div>
            </div>
            <hr>
            <div class="footer float-right" >
                <button type="button" @click="submitForm('reject')" class="btn btn-danger"><i class="fas fa-times"></i> Reject</button>
                <button type="button" @click="submitForm('accept')" class="btn btn-success"> <i class="fas fa-save"></i> Admit</button>
            </div>
        </div>
    </div>
</div>

</template>

<script>
export default {
    data(){
        return{
            std_admission_details:[],
            std_parents:[],
            instructor_details:[],
            dzongkhagList:[],
            schoolList:[],
            classList:[],
            genderArray:{},
            dzongkhagArray:{},
            gewogArray:{},
            villageArray:{},
            class_id:'',
            student_form: new form({
                id:'',
                student_id:'',
                dzongkhag:'',
                school:'',
                class:'',
                stream:'',
                action_type:'',
                remarks:'',
            })
        }
    },
    methods:{
        getstudentPersonalDetails(id){
            axios.get('students/admission/getStudentDetails/admission_'+id)
            .then(response => {
                let data = response.data.data;
                if(data != ""){
                    this.std_admission_details=data;
                    this.student_form.id=data.id;
                    this.std_parents=data.parents;
                    this.getGewogList(data.dzongkhag,data.CmnGewogId);
                    this.getvillagelist(data.CmnGewogId,data.village_id);
                    this.getClassId(data.class_id);
                }
            });
        },
        getClassId(mappId){
            axios.get('/organization/getClassMappingDetails/'+mappId)
            .then(response => {
                let data = response.data;
                this.std_admission_details.class_id=data.classId;
                $('#std_class_id').val(data.classId).trigger('change');
            })
            .catch(function (error){
               console.log('Error: '+error);
            });
        },
        loadgenderList(uri = 'masters/loadGlobalMasters/all_active_gender'){
            axios.get(uri)
            .then(response => {
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.genderArray[data.data.data[i].id] = data.data.data[i].name;
                }
            })
            .catch(function (error){
               console.log('Error: '+error);
            });
        },

        resetForm: function(){
            this.form.reset();
        },
        submitForm(type){
            this.student_form.action_type=type;
            this.student_form.post('students/admission/updateAdmissionStd')
            .then((response) => {
                if(response!=null && response!=""){
                    let message="Application details has been updated.  <br><b>Thank You !</b>";
                    this.$router.push({name:'acknowledgement',params: {data:message}});
                    Swal.fire(
                        'Success!',
                        'Data  updated successfully',
                        'success',
                    );
                }
            })
            .catch((error) => {
                console.log("Error:"+error)
            });
        },

        loadactivedzongkhagList(uri="masters/loadGlobalMasters/all_active_dzongkhag"){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.dzongkhagArray[data[i].id] = data[i].name;
                }
            })
            .catch(function (error) {
                console.log("Error:"+error)
            });
        },

        getGewogList(dzongkhag,gewog_id){
            let uri = 'masters/all_active_dropdowns/dzongkhag/'+dzongkhag;
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.gewogArray[data[i].id] = data[i].name;
                }
                $('#gewogid').html(this.gewogArray[gewog_id]);
            });
        },

        getvillagelist(gewogId,vilId){
            let uri = 'masters/all_active_dropdowns/gewog/'+gewogId;
            axios.get(uri)
            .then(response =>{
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.villageArray[data[i].id] = data[i].name;
                }
                $('#vilageId').html(this.villageArray[vilId]);
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
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

        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }

            if(id=="dzongkhag"){
                this.form.dzongkhag=$('#dzongkhag').val();
                this.getschoolList($('#dzongkhag').val());
            }
            if(id=="school"){
                this.form.school=$('#school').val();
                // this.getclassList($('#school').val());
            }
            if(id=="class"){
                this.form.class=$('#class').val();
            }
        },
        getClass:function(){
            axios.get('/organization/getClass')
              .then(response => {
                this.classList = response.data;
            });
        },

    },
    mounted() {
        this.loadgenderList();
        this.getClass();
        this.loadactivedzongkhagList();
        // this.getschoolList();
        // this.getStudentdetials();
        $('.select2').select2();
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id'));
        });

        Fire.$on('changefunction',(id)=> {
            this.changefunction(id);
        });
        this.getstudentPersonalDetails(this.$route.params.data);

        // this.getclassList();
    },


}
</script>
