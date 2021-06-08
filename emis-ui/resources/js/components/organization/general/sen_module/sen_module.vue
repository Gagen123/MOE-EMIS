<template>
    <div>
        <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="form-inline "><h6 class="pt-1">SEN Module</h6></li>
        </ol>
        <div class="card card-primary card-outline card-outline-tabs">
            <!-- <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead" role="tablist">
                    <li class="nav-item personal-details-tabs">
                        <a class="nav-link active" data-toggle="pill" role="tab"> 
                            <label class="pl-3"> SEN Module</label>                              
                        </a>
                    </li>
                </ul>
            </div> -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="personal-details-tabs" role="tabpanel" aria-labelledby="basicdetails">
                        <table id="waterTable" class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <thead>
                                <tr>
                                    <th style="width:60%">Description</th>
                                    <th style="width:40%">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <tr>
                                    <b>WASH</b>
                                </tr>
                                <tr id="record1">
                                    <td> 1.Are there accessible toilet for children/student with disabilities? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label class="pl-3"><input  type="radio" v-model="form.accessibleToilet" value="Yes" tabindex=""/> Yes</label>
                                            <label class="pl-3"><input  type="radio" v-model="form.accessibleToilet" value="No" tabindex=""/> No</label>
                                            <label class="pl-3"><input  type="radio" v-model="form.accessibleToilet" value="No New Buildings" tabindex=""/> No New Buildings</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record2">
                                    <td> 2.Are there accessible WASH facilities (water taps, basins, bathrooms, etc,) for children/students with disabilities?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label class="pl-3"><input  type="radio" v-model="form.accessibleWash" value="Yes" tabindex=""/> Yes</label>
                                            <label class="pl-3"><input  type="radio" v-model="form.accessibleWash" value="No" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr> -->
                                <tr class="bg-cyan">
                                    <td colspan="2"><b>BUILDING</b></td>
                                </tr>
                                <tr id="record1">
                                    <td> 1. If you had new buildings constructed this year, were they built to consider the need for children/students with disabilities? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label class="pl-3"><input  type="radio" v-model="form.newConstruction" value="Yes" tabindex=""/> Yes</label>
                                            <label class="pl-3"><input  type="radio" v-model="form.newConstruction" value="No" tabindex=""/> No</label>
                                            <label class="pl-3"><input  type="radio" v-model="form.newConstruction" value="No New Buildings" tabindex=""/> No New Buildings</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record2">
                                    <td> 2. Have you made adjustments to the existing buildings to accommodate the needs of children/students with disabilities?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label class="pl-3"><input  type="radio" v-model="form.adjustmentsAccomodatte" value="Yes" tabindex=""/> Yes</label>
                                            <label class="pl-3"><input  type="radio" v-model="form.adjustmentsAccomodatte" value="No" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                               
                                <tr class="bg-cyan">
                                    <td colspan="2"><b>Outdoor Spaces</b></td>
                                </tr>
                                <tr id="record3">
                                    <td> 3.Are outdoor play and recreation areas accessible for children/students with disabilities?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label class="pl-3"><input  type="radio" v-model="form.outdoorPlayground" value="Yes" tabindex=""/> Yes</label>
                                            <label class="pl-3"><input  type="radio" v-model="form.outdoorPlayground" value="Partially" tabindex=""/> Partially</label>
                                            <label class="pl-3"><input  type="radio" v-model="form.outdoorPlayground" value="No" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record4">
                                    <td> 4. Are routes between classes and buildings accessible for children/students with disabilities?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label class="pl-3"><input  type="radio" v-model="form.outdoorRoutes" value="Yes" tabindex=""/> Yes</label>
                                            <label class="pl-3"><input  type="radio" v-model="form.outdoorRoutes" value="Partially" tabindex=""/> Partially</label>
                                            <label class="pl-3"><input  type="radio" v-model="form.outdoorRoutes" value="No" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                
                                <tr class="bg-cyan">
                                    <td colspan="2"><b>Hostels</b></td>
                                </tr>
                                <tr id="record12">
                                    <td> 5. Are girls hostels accessible for students with disabilities?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label class="pl-3"><input  type="radio" v-model="form.girlsHostelAccessible" value="Yes" tabindex=""/> Yes</label>
                                            <label class="pl-3"><input  type="radio" v-model="form.girlsHostelAccessible" value="No" tabindex=""/> No</label>
                                            <label class="pl-3"><input  type="radio" v-model="form.girlsHostelAccessible" value="Partially" tabindex=""/> Partially</label>
                                            <label class="pl-3"><input  type="radio" v-model="form.girlsHostelAccessible" value="No Hostel" tabindex=""/> No Hostel</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record5">
                                    <td> 6. Are dining halls accessible for children/students with disabilities?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label class="pl-3"><input  type="radio" v-model="form.diningHall" value="Yes" tabindex=""/> Yes</label>
                                            <label class="pl-3"><input  type="radio" v-model="form.diningHall" value="No" tabindex=""/> No</label>
                                            <label class="pl-3"><input  type="radio" v-model="form.diningHall" value="Partially" tabindex=""/> Partially</label>
                                            <label class="pl-3"><input  type="radio" v-model="form.diningHall" value="No Dining Hall" tabindex=""/> No Dining Hall</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record6">
                                    <td> 7. Are hostel WASH facilities accessible for students with disabilities?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label class="pl-3"><input  type="radio" v-model="form.hostelWash" value="Yes" tabindex=""/> Yes</label>
                                            <label class="pl-3"><input  type="radio" v-model="form.hostelWash" value="No" tabindex=""/> No</label>
                                            <label class="pl-3"><input  type="radio" v-model="form.hostelWash" value="Partially" tabindex=""/> Partially</label>
                                            <label class="pl-3"><input  type="radio" v-model="form.hostelWash" value="No Hostel" tabindex=""/> No Hostel</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record7">
                                    <td> 8. Are boys hostels accessible for students with disabilities?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label class="pl-3"><input  type="radio" v-model="form.boysHostelAccessible" value="Yes" tabindex=""/> Yes</label>
                                            <label class="pl-3"><input  type="radio" v-model="form.boysHostelAccessible" value="No" tabindex=""/> No</label>
                                            <label class="pl-3"><input  type="radio" v-model="form.boysHostelAccessible" value="Partially" tabindex=""/> Partially</label>
                                            <label class="pl-3"><input  type="radio" v-model="form.boysHostelAccessible" value="No Hostel" tabindex=""/> No Hostel</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="bg-cyan">
                                    <td colspan="2"><b>Enrollment</b></td>
                                </tr>
                                <tr id="record8">
                                    <td>
                                        9.Have you had to turn children/students away due to their disability this year? 
                                        If yes, what were the barriers to admitting them?
                                    </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label class="pl-3"><input  type="radio" v-model="form.enrollment" value="Yes" tabindex="" @click="showtextbox('1')"/> Yes</label>
                                            <label class="pl-3"><input  type="radio" v-model="form.enrollment" value="No" tabindex="" @click="showtextbox('0')"/> No</label>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:none" id="enrollment">
                                            <textarea v-model="form.proprietorName" class="form-control editable_fields" id="proprietorName"></textarea>
                                            <has-error :form="form" field="proprietorName"></has-error>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record9">
                                    <td>
                                        10. Are you aware of any ECCD centre/school aged children/students with disabilities in your community 
                                        who are not attending ECCD centre/school? If yes, how many of them?
                                    </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label class="pl-3"><input  type="radio" v-model="form.communityWithDisablities" value="Yes" tabindex="" @click="showtextbox2('1')"/> Yes</label>
                                            <label class="pl-3"><input  type="radio" v-model="form.communityWithDisablities" value="No" tabindex="" @click="showtextbox2('0')"/> No</label>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:none" id="communitydiv">
                                            <textarea v-model="form.community" class="form-control editable_fields" id="community"></textarea>
                                            <has-error :form="form" field="community"></has-error>
                                        </div>
                                    </td>
                                </tr>
                               
                                <tr class="bg-cyan">
                                    <td colspan="2"><b>Others</b></td>
                                </tr>
                                <tr id="record10">
                                    <td>11. Does your school have SEN program?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label class="pl-3"><input  type="radio" v-model="form.senProgram" @change="showSendDetails(1)" value="Yes" tabindex=""/> Yes</label>
                                            <label class="pl-3"><input  type="radio" v-model="form.senProgram" @change="showSendDetails(0)" value="No" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record11">
                                    <td>12. Does your school have children with disabilities?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label class="pl-3"><input  type="radio" v-model="form.studentDisabilities" @change="showSendDetails(1)" value="Yes" tabindex=""/> Yes</label>
                                            <label class="pl-3"><input  type="radio" v-model="form.studentDisabilities" @change="showSendDetails(0)" value="No" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            
                            <tbody id="senDetailSection" style="display:none">
                                <tr class="bg-cyan">
                                    <td colspan="2"><b>  Questionnaire</b></td>
                                </tr>
                                <hr>
                                <tr class="bg-cyan">
                                    <td colspan="2"><b>  Other Support Services and student1</b></td>
                                </tr>
                                <tr id="questiond1">
                                    <td>1.1 Do any other professionals support children/students with disabilities within your ECCD centre/school? (select all that applies) </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label class="pl-3"><input  type="checkbox" v-model="form.professionalsSupportChildren" value="Physiotherapist and abc" tabindex=""/> Physiotherapist and abc</label>
                                            <label class="pl-3"><input  type="checkbox" v-model="form.professionalsSupportChildren" value="Speech Pathologist" tabindex=""/> Speech Pathologist</label>
                                            <label class="pl-3"><input  type="checkbox" v-model="form.professionalsSupportChildren" value="Audiologist" tabindex=""/> Audiologist</label>
                                            <label class="pl-3"><input  type="checkbox" v-model="form.professionalsSupportChildren" value="Ophthalmologist" tabindex=""/> Ophthalmologist</label>
                                            <label class="pl-3"><input  type="checkbox" v-model="form.professionalsSupportChildren" value="Occupational Therapist" tabindex=""/> Occupational Therapist</label>
                                            <label class="pl-3"><input  type="checkbox" v-model="form.professionalsSupportChildren" value="ENT Technicians" tabindex=""/> ENT Technicians</label>
                                            <label class="pl-3"><input  type="checkbox" v-model="form.professionalsSupportChildren" value="School Counselor" tabindex=""/> School Counselor</label>
                                            <label class="pl-3"><input  type="checkbox" v-model="form.professionalsSupportChildren" value="Psychologist" tabindex=""/> Psychologist</label>
                                            <label class="pl-3"><input  type="checkbox" v-model="form.professionalsSupportChildren" value="Vocational Trainers" tabindex=""/> Vocational Trainers</label>
                                            <label class="pl-3"><input  type="checkbox" v-model="form.professionalsSupportChildren" value="Others" tabindex=""/> Others</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="questiond2">
                                    <td>1.2. Do you currently have other adults working in the classroom with children/students with disabilities? (select all that applies) </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label class="pl-3"><input  type="checkbox" v-model="form.adultWorkingwithChildren" value=" Additional Teachers" tabindex=""/>  Additional Teachers</label>
                                            <label class="pl-3"><input  type="checkbox" v-model="form.adultWorkingwithChildren" value="Trained Teacher-assistants" tabindex=""/> Trained Teacher-assistants</label>
                                            <label class="pl-3"><input  type="checkbox" v-model="form.adultWorkingwithChildren" value="Parent/care-giver of student with disability" tabindex=""/> Parent/care-giver of student with disability</label>
                                            <label class="pl-3"><input  type="checkbox" v-model="form.adultWorkingwithChildren" value="Other parent volunteers" tabindex=""/> Other parent volunteers</label>
                                            <label class="pl-3"><input  type="checkbox" v-model="form.adultWorkingwithChildren" value="Others" tabindex=""/> Others</label>
                                        </div>
                                    </td>
                                </tr>

                                <tr id="questiond3">
                                    <td>1.3. Do you have any support from the community to support the education of children/students with disabilities? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <textarea v-model="form.support_disabilitycommunity" class="form-control editable_fields" id="support_disabilitycommunity"></textarea>
                                            <has-error :form="form" field="support_disabilitycommunity"></has-error>
                                        </div>
                                    </td>
                                </tr>

                                <tr id="questiond4">
                                    <td>1.4. What other support services are there? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <textarea v-model="form.support_service" class="form-control editable_fields" id="support_service"></textarea>
                                            <has-error :form="form" field="support_service"></has-error>
                                        </div>
                                    </td>
                                </tr>

                                <tr id="questiond5">
                                    <td>1.5. When was the school endorsed for Inclusive and SEN program? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <textarea v-model="form.school_endrosed" class="form-control editable_fields" id="school_endrosed"></textarea>
                                            <has-error :form="form" field="school_endrosed"></has-error>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="bg-cyan">
                                    <td colspan="2"><b>Achievement/Transition of Children/Student with disabilities</b></td>
                                </tr>
                                <tr id="questiond6">
                                    <td>2.1 How many students with disabilities have successfully graduated from the highest grade in your school last year? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input v-model="form.disabledGraduated" class="form-control editable_fields" id="disabledGraduated"/>
                                            <has-error :form="form" field="disabledGraduated"></has-error>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="questiond6">
                                    <td>2.2 How many students with disabilities have moved to another educational institution last year? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input v-model="form.disabledMovedToOtherSchool" class="form-control editable_fields" id="disabledMovedToOtherSchool"/>
                                            <has-error :form="form" field="disabledMovedToOtherSchool"></has-error>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="questiond7">
                                    <td>2.3 How many students with disabilities have transitioned to post-school education or training programs last year? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input v-model="form.disabledTransaction" class="form-control editable_fields" id="disabledTransaction"/>
                                            <has-error :form="form" field="disabledTransaction"></has-error>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="questiond8">
                                    <td>2.4 How many students with disabilities dropped out last year? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input v-model="form.disabledTransaction" class="form-control editable_fields" id="disabledTransaction"/>
                                            <has-error :form="form" field="disabledTransaction"></has-error>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="questiond5">
                                    <td>2.5. what are the children/students with disabilities who dropped out, currently doing? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <textarea v-model="form.disabilitiesDropout" class="form-control editable_fields" id="disabilitiesDropout"></textarea>
                                            <has-error :form="form" field="disabilitiesDropout"></has-error>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="questiond9">
                                    <td>2.6 How many children with disabilities have transitioned to school last year? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input v-model="form.disabledTransactionLastYear" class="form-control editable_fields" id="disabledTransactionLastYear"/>
                                            <has-error :form="form" field="disabledTransactionLastYear"></has-error>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="bg-cyan">
                                    <td colspan="2"><b>Hostels</b></td>
                                </tr>
                                <tr id="questiond6">
                                    <td>3.1 How many matrons are there in your school? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input v-model="form.matrons" class="form-control editable_fields" id="matrons"/>
                                            <has-error :form="form" field="matrons"></has-error>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="questiond6">
                                    <td>3.2 How many wardens are there in your school? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input v-model="form.wardens" class="form-control editable_fields" id="wardens"/>
                                            <has-error :form="form" field="wardens"></has-error>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="questiond7">
                                    <td>3.3 How many caregivers are there in your school? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input v-model="form.caregivers" class="form-control editable_fields" id="caregivers"/>
                                            <has-error :form="form" field="caregivers"></has-error>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="questiond8">
                                    <td>3.4 How many students with disabilities reside in hostels? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input v-model="form.disabilitiesInHostal" class="form-control editable_fields" id="disabilitiesInHostal"/>
                                            <has-error :form="form" field="disabilitiesInHostal"></has-error>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" @click="shownexttab()"> <i class="fa fa-save"></i>Save </button>
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
            return{
                form: new form({
                    org_id: '',
                    newConstruction:'',
                    accessibleToilet: '',
                    accessibleWash:  '',
                    outdoorPlayground :  '',
                    outdoorRoutes :  '',
                    girlsHostelAccessible :  '',
                    diningHall :  '',
                    hostelWash   :  '',
                    boysHostelAccessible :  '',
                    enrollment  :  '',
                    communityWithDisablities:  '',
                    community :  '',
                    senProgram:  '',
                    studentDisabilities:  '',
                    proprietorName :  '',
                    professionalsSupportChildren:[],
                    adultWorkingwithChildren:[],
                    support_disabilitycommunity:'',
                    support_service:'',matrons:'',wardens:'',caregivers:'',disabilitiesInHostal:''
                }) 
            }
        },
        methods:{
            getCurrentSenDetials(org_id){
                axios.get('organization/loadSeenDetailsByOrgId/'+org_id)
                .then(response => {
                    let response_data=response.data.data;
                    this.form.isAspNetSchool=response_data.isAspNetSchool;
                    this.form.isColocated=response_data.isColocated;
                    this.form.isGeoPoliticallyLocated=response_data.isGeoPoliticallyLocated;
                    this.form.isResourceCenter=response_data.isResourceCenter;
                    this.form.isSenSchool=response_data.isSenSchool;
                    this.form.hasCounselingRoom=response_data.hasCounselingRoom;
                    this.form.hasShiftSystem=response_data.hasShiftSystem;
                    this.form.hasCE=response_data.hasCE;
                    this.form.mofCode=response_data.mofCode;
                    this.form.zestAgencyCode=response_data.zestAgencyCode;
                })
                .catch((error) => {  
                    console.log("Error: "+error);
                });
            },
            shownexttab(){
                this.form.post('organization/updateSenDetials')
                .then((response) => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Basic Details has been saved successfully'
                    })
                })
                .catch((error) => {
                    Toast.fire({
                        icon: 'error',
                        title: 'Unexpected error occured:'+error
                    });
                })
            },
            showtextbox(value){
                $('#enrollment').hide();
                if(value=="Yes"){
                    $('#enrollment').show();
                }
            },
            showtextbox2(value){
                $('#communitydiv').hide();
                if(value=="Yes"){
                    $('#communitydiv').show();
                }
            },
            showSendDetails(param){
                $('#senDetailSection').hide();
                if(param==1){
                    $('#senDetailSection').show();
                }
            }
            
        },

        mounted(){
            axios.get('common/getSessionDetail')
            .then(response =>{
                let data = response.data.data;
                this.form.org_id=data['Agency_Code'];
                this.getCurrentSenDetials(data['Agency_Code']);
            })    
            .catch(errors =>{ 
                console.log(errors)
            });
            
        }
    }
</script>