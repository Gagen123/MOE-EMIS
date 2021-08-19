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
                                            <label class="pl-3"><input  type="radio" v-model="form.newConstruction" value="1" tabindex=""/> Yes</label>
                                            <label class="pl-3"><input  type="radio" v-model="form.newConstruction" value="0" tabindex=""/> No</label>
                                            <label class="pl-3"><input  type="radio" v-model="form.newConstruction" value="No New Buildings" tabindex=""/> No New Buildings</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record2">
                                    <td> 2. Have you made adjustments to the existing buildings to accommodate the needs of children/students with disabilities?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label class="pl-3"><input  type="radio" v-model="form.adjustmentsAccomodatte" value="1" tabindex=""/> Yes</label>
                                            <label class="pl-3"><input  type="radio" v-model="form.adjustmentsAccomodatte" value="0" tabindex=""/> No</label>
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
                                        9. Have you had to turn children/students away due to their disability this year? 
                                    </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label class="pl-3"><input  type="radio" v-model="form.enrollment" value="1" tabindex="" @click="showtextbox('1')"/> Yes</label>
                                            <label class="pl-3"><input  type="radio" v-model="form.enrollment" value="0" tabindex="" @click="showtextbox('0')"/> No</label>
                                        </div>
                                       
                                    </td>
                                </tr>
                                <tr id="enrollment" style="display:none">
                                    <td> 9.1 what were the barriers to admitting them? </td>
                                    <td>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                                            <textarea v-model="form.proprietorName" class="form-control" id="proprietorName"></textarea>
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
                                            <label class="pl-3"><input  type="radio" v-model="form.communityWithDisablities" value="1" tabindex="" @click="showtextbox2('1')"/> Yes</label>
                                            <label class="pl-3"><input  type="radio" v-model="form.communityWithDisablities" value="0" tabindex="" @click="showtextbox2('0')"/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr style="display:none" id="communitydiv">
                                     <td>
                                        10.1 How many of them?
                                    </td>
                                    <td>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                                            <input type="number" v-model="form.community" class="form-control" id="community" />
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
                                            <label class="pl-3"><input  type="radio" v-model="form.senProgram" @change="showSendDetails(1)" value="1" tabindex=""/> Yes</label>
                                            <label class="pl-3"><input  type="radio" v-model="form.senProgram" @change="showSendDetails(0)" value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record11">
                                    <td>12. Does your school have children with disabilities?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label class="pl-3"><input  type="radio" v-model="form.studentDisabilities" @change="showSendDetails(1)" value="1" tabindex=""/> Yes</label>
                                            <label class="pl-3"><input  type="radio" v-model="form.studentDisabilities" @change="showSendDetails(0)" value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            
                            <tbody id="senDetailSection" style="display:none">
                                <tr class="bg-cyan">
                                    <td colspan="2"><b>  Other Support Services and student1</b></td>
                                </tr>
                                <tr id="questiond1">
                                    <td>13. Do any other professionals support children/students with disabilities within your ECCD centre/school? (select all that applies) </td>
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
                                    <td>14. Do you currently have other adults working in the classroom with children/students with disabilities? (select all that applies) </td>
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
                                    <td>15. Do you have any support from the community to support the education of children/students with disabilities? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <textarea v-model="form.supportDisabilitycommunity" class="form-control" id="supportDisabilitycommunity"></textarea>
                                            <has-error :form="form" field="supportDisabilitycommunity"></has-error>
                                        </div>
                                    </td>
                                </tr>

                                <tr id="questiond4">
                                    <td>16. What other support services are there? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <textarea v-model="form.supportService" class="form-control" id="supportService"></textarea>
                                            <has-error :form="form" field="supportService"></has-error>
                                        </div>
                                    </td>
                                </tr>

                                <tr id="questiond5">
                                    <td>17. When was the school endorsed for Inclusive and SEN program? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <textarea v-model="form.schoolEndrosed" class="form-control" id="schoolEndrosed"></textarea>
                                            <has-error :form="form" field="schoolEndrosed"></has-error>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="bg-cyan">
                                    <td colspan="2"><b>Achievement/Transition of Children/Student with disabilities</b></td>
                                </tr>
                                <tr id="questiond6">
                                    <td>18 How many students with disabilities have successfully graduated from the highest grade in your school last year? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="number" min="0" v-model="form.disabledGraduated" class="form-control" id="disabledGraduated"/>
                                            <has-error :form="form" field="disabledGraduated"></has-error>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="questiond6">
                                    <td>19 How many students with disabilities have moved to another educational institution last year? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="number" min="0" v-model="form.disabledMovedToOtherSchool" class="form-control" id="disabledMovedToOtherSchool"/>
                                            <has-error :form="form" field="disabledMovedToOtherSchool"></has-error>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="questiond7">
                                    <td>20 How many students with disabilities have transitioned to post-school education or training programs last year? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="number" min="0" v-model="form.disabledTransaction" class="form-control" id="disabledTransaction"/>
                                            <has-error :form="form" field="disabledTransaction"></has-error>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="questiond8">
                                    <td>21 How many students with disabilities dropped out last year? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="number" min="0" v-model="form.disabledDropOut" class="form-control" id="disabledDropOut"/>
                                            <has-error :form="form" field="disabledDropOut"></has-error>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="questiond5">
                                    <td>22 what are the children/students with disabilities who dropped out, currently doing? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <textarea v-model="form.disabilitiesDropoutCurrenly" class="form-control" id="disabilitiesDropoutCurrenly"></textarea>
                                            <has-error :form="form" field="disabilitiesDropoutCurrenly"></has-error>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="questiond9">
                                    <td>23 How many children with disabilities have transitioned to school last year? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="number" min="0" v-model="form.disabledTransactionLastYear" class="form-control" id="disabledTransactionLastYear"/>
                                            <has-error :form="form" field="disabledTransactionLastYear"></has-error>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="bg-cyan">
                                    <td colspan="2"><b>Hostels</b></td>
                                </tr>
                                <!-- <tr id="questiond6">
                                    <td>3.1 How many matrons are there in your school? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input v-model="form.matrons" class="form-control" id="matrons"/>
                                            <has-error :form="form" field="matrons"></has-error>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="questiond6">
                                    <td>3.2 How many wardens are there in your school? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input v-model="form.wardens" class="form-control" id="wardens"/>
                                            <has-error :form="form" field="wardens"></has-error>
                                        </div>
                                    </td>
                                </tr> -->
                                <tr id="questiond7">
                                    <td>24 How many caregivers are there in your school? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="number" min="0" v-model="form.caregivers" class="form-control" id="caregivers"/>
                                            <has-error :form="form" field="caregivers"></has-error>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="questiond8">
                                    <td>25 How many students with disabilities reside in hostels? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input  type="number" min="0" v-model="form.disabilitiesInHostal" class="form-control" id="disabilitiesInHostal"/>
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
                    adjustmentsAccomodatte:'',

                    outdoorPlayground:  '',
                    outdoorRoutes:  '',

                    girlsHostelAccessible:  '',
                    diningHall:  '',
                    hostelWash:  '',
                    boysHostelAccessible:  '',

                    enrollment:  '',
                    proprietorName :  '',
                    communityWithDisablities:  '',
                    community :  '',

                    senProgram:  '',
                    studentDisabilities:  '',

                    professionalsSupportChildren:[],
                    adultWorkingwithChildren:[],
                    supportDisabilitycommunity:'',
                    supportService:'',
                    schoolEndrosed:'',
                    disabledGraduated:'',
                    disabledMovedToOtherSchool:'',
                    disabledTransaction:'',
                    disabledDropOut:'',
                    disabilitiesDropoutCurrenly:'',
                    disabledTransactionLastYear:'',
                    caregivers:'',
                    disabilitiesInHostal:'',
                }) 
            }
        },
        methods:{
            getCurrentSenDetials(org_id){
               
                axios.get('/organization/loadSeenDetailsByOrgId/'+ org_id)
                .then(response => {
                    let response_data=response.data.data;
                   // alert(JSON.stringify(response.data.data));
                    this.form.newConstruction=response_data.newConstruction;
                    this.form.adjustmentsAccomodatte=response_data.adjustmentsAccomodatte;
                    this.form.enrollment=response_data.enrollment;
                    this.showtextbox(response_data.enrollment);
                    this.form.proprietorName=response_data.proprietorName;
                    this.form.accessibleToilet=response_data.accessibleToilet;
                    this.form.accessibleWash=response_data.accessibleWash;
                    this.form.outdoorPlayground=response_data.outdoorPlayground;
                    this.form.outdoorRoutes=response_data.outdoorRoutes;
                    this.form.girlsHostelAccessible=response_data.girlsHostelAccessible;
                    this.form.diningHall=response_data.diningHall;
                    this.form.hostelWash=response_data.hostelWash;
                    this.form.boysHostelAccessible=response_data.boysHostelAccessible;
                  
                    this.form.communityWithDisablities=response_data.communityWithDisablities;
                    this.showtextbox2(response_data.communityWithDisablities);
                    this.form.community=response_data.community;
                    this.form.senProgram=response_data.senProgram;
                    this.form.studentDisabilities=response_data.studentDisabilities;
                    if(response_data.senProgram==1 || response_data.studentDisabilities==1){
                        this.showSendDetails(1);
                    }
                    this.form.supportDisabilitycommunity=response_data.supportDisabilitycommunity;
                    this.form.supportService=response_data.supportService;
                    this.form.caregivers=response_data.caregivers;
                    this.form.schoolEndrosed=response_data.schoolEndrosed;
                    this.form.disabledGraduated=response_data.disabledGraduated;
                    this.form.disabilitiesInHostal=response_data.disabilitiesInHostal;
                    this.form.disabledMovedToOtherSchool=response_data.disabledMovedToOtherSchool;
                    this.form.disabledTransaction=response_data.disabledTransaction;
                    this.form.disabledDropOut=response_data.disabledDropOut;
                    this.form.disabledTransactionLastYear=response_data.disabledTransactionLastYear;
                    this.form.disabilitiesDropoutCurrenly=response_data.disabilitiesDropoutCurrenly;
                    for(let i=0;i<response_data.professionalsSupportChildren.split(', ').length;i++){
                        this.form.professionalsSupportChildren.push(response_data.professionalsSupportChildren.split(', ')[i]);
                    }
                    for(let i=0;i<response_data.adultWorkingwithChildren.split(', ').length;i++){
                        this.form.adultWorkingwithChildren.push(response_data.adultWorkingwithChildren.split(', ')[i]);
                    }
                })
                .catch((error) => {  
                    console.log("Error: "+error);
                });
            },
            shownexttab(){
                if(this.form.senProgram==0 && this.form.studentDisabilities==0){
                    this.form.professionalsSupportChildren=[];
                    this.form.adultWorkingwithChildren=[];
                    this.form.supportDisabilitycommunity='';
                    this.form.supportService='';
                    this.form.schoolEndrosed='';
                    this.form.disabledGraduated='';
                    this.form.disabledMovedToOtherSchool='';
                    this.form.disabledTransaction='';
                    this.form.disabledDropOut='';
                    this.form.disabilitiesDropoutCurrenly='';
                    this.form.disabledTransactionLastYear='';
                    this.form.caregivers='';
                    this.form.disabilitiesInHostal='';
                }
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
                    this.getcurrentSenDetails();
                })
            },
            showtextbox(value){
                $('#enrollment').hide();
                this.form.proprietorName='';
                if(value=="1"){
                    $('#enrollment').show();
                }
            },
            showtextbox2(value){
                this.form.community='';
                $('#communitydiv').hide();
                if(value=="1"){
                    $('#communitydiv').show();
                }
            },
            showSendDetails(param){
                $('#senDetailSection').hide();
                if(param==1){
                    $('#senDetailSection').show();
                }
            },
            getcurrentSenDetails(){
                // let org_id=this.form.org_id;
                // axios.get('organization/getcurrentSenDetails/'+org_id)
                // .then(response =>{
                //     let data = response.data.data;
                //     this.form.org_id=data['Agency_Code'];
                //     this.form.org_id=data['Agency_Code'];
                //     this.getCurrentSenDetials(data['Agency_Code']);
                // })    
                // .catch(errors =>{ 
                //     console.log(errors)
                // });
            }
            
        },

        mounted(){
            this.getcurrentSenDetails();
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