<template>
    <div> 
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <li class="nav-item basic-tabs" @click="shownexttab('basic-tabs')">  
                        <a class="nav-link active" id="basic-tabs-head" data-toggle="pill"  href="#basic-tabs" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true"> 
                            <label> Basic Details </label>                               
                        </a>
                    </li>   
                    <li class="nav-item guardians-tab"  @click="shownexttab('guardians-tab')">
                        <a class="nav-link" id="guardians-tab-head" data-toggle="pill" href="#guardians-tab" role="tab" aria-controls="custom-tabs-four-guardians" aria-selected="false">
                            <label>Student Guardian Details</label>
                        </a>
                    </li>
                    <li class="nav-item details-tab"  @click="shownexttab('details-tab')">
                        <a class="nav-link"  id="details-tab-head" data-toggle="pill" href="#details-tab" role="tab" aria-controls="custom-tabs-four-details" aria-selected="false">
                            <label>Other Details</label>
                        </a>  
                    </li>  
                </ul>
            </div>  
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="basic-tabs" role="tabpanel" aria-labelledby="basicdetails">
                        <form id="admission_form" class="form-horizontal" enctype="multipart/form-data" action="#" method="POST">
                            <div class="row form-group">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label> Student Nationality:</label><br>
                                    <input type="radio" name="snationality" v-model="personal_form.snationality" value="Bhutanese" id="s-bhutanese" @click="showstdidentity('Student-Bhutanese')" checked> Bhutanese <br>
                                    <input type="radio" name="snationality" v-model="personal_form.snationality" value="Bhutanese Under Process" id="s-bhutanese-underprocess" @click="showstdidentity('Student-Bhutanese-underprocess')" checked> Bhutanese (under process)<br>
                                    <input type="radio" name="snationality" v-model="personal_form.snationality" value="Foreign" id="s-foreign" @click="showstdidentity('Student-Non-Bhutanese')"> Non-Bhutanese 
                                    <span class="text-danger" id="snationality_err"></span>
                                </div>
                                <div class="row form-group col-lg-9 col-md-9 col-sm-9">
                                    <div class="card card-primary">
                                        <div class="card-body">
                                            <div class="row form-group">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <label id="level_name"></label>
                                                    <input type="text" class="form-control" @keyup.enter="getDetailsbyCID('cid_passport','std')" @blur="getDetailsbyCID('cid_passport','std')" @change="removeerror('cid_passport')" :class="{ 'is-invalid': personal_form.errors.has('cid_passport') }" id="cid_passport" v-model="personal_form.cid_passport" placeholder="Identification No">
                                                    <has-error :form="personal_form" field="cid_passport"></has-error>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label >First Name:<span class="text-danger">*</span> </label>
                                                    <input type="text" class="form-control" @change="removeerror('first_name')" :class="{ 'is-invalid': personal_form.errors.has('first_name') }" id="first_name" v-model="personal_form.first_name" placeholder="First Name">
                                                    <has-error :form="personal_form" field="first_name"></has-error>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label > Middle Name: </label>
                                                    <input type="text" class="form-control" @change="removeerror('middle_name')" :class="{ 'is-invalid': personal_form.errors.has('middle_name') }" id="middle_name" v-model="personal_form.middle_name" placeholder="Middle Name">
                                                    <has-error :form="personal_form" field="middle_name"></has-error>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label >Last Name: </label>
                                                    <input type="text" class="form-control" @change="removeerror('last_name')" :class="{ 'is-invalid': personal_form.errors.has('last_name') }" id="last_name" v-model="personal_form.last_name" placeholder="Last Name">
                                                    <has-error :form="personal_form" field="last_name"></has-error>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Date of Birth:<span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control" @change="removeerror('dob')" :class="{ 'is-invalid': personal_form.errors.has('dob') }" id="dob" v-model="personal_form.dob" placeholder="Date of Birth">
                                                    <has-error :form="personal_form" field="dob"></has-error>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Gender:<span class="text-danger">*</span></label>
                                                    <select v-model="personal_form.sex_id" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('sex_id') }" class="form-control select2" name="sex_id" id="sex_id">
                                                        <option value=""> --Select--</option>
                                                        <option v-for="(item, index) in sex_idList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                    </select>
                                                    <has-error :form="personal_form" field="sex_id"></has-error>
                                                </div>
                                            </div>
                                            <div class="row form-group" id="dzo_gewog_village">
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label>Dzongkhag/Thromde: </label>
                                                    <select v-model="personal_form.dzongkhag" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('dzongkhag') }" class="form-control select2" name="dzongkhag" id="dzongkhag">
                                                        <option value=""> --Select--</option>
                                                        <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                    </select>
                                                    <has-error :form="personal_form" field="dzongkhag"></has-error>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label> Gewog:</label>
                                                    <select v-model="personal_form.gewog" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('gewog') }" class="form-control select2" name="gewog" id="gewog">
                                                        <option value=""> --Select--</option>
                                                        <option v-for="(item, index) in gewog_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                    </select>
                                                    <has-error :form="personal_form" field="gewog"></has-error>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label>Village: </label>
                                                    <select v-model="personal_form.village_id" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('village_id') }" class="form-control select2" name="village_id" id="village_id">
                                                        <option value=""> --Select--</option>
                                                        <option v-for="(item, index) in villageList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                    </select>
                                                    <has-error :form="personal_form" field="village_id"></has-error>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <label >Permanent Address: </label>
                                                    <textarea class="form-control" rows="3" @change="removeerror('fulladdress')" :class="{ 'is-invalid': personal_form.errors.has('fulladdress') }" id="fulladdress" v-model="personal_form.fulladdress" placeholder="Permanent Address"></textarea>
                                                    <has-error :form="personal_form" field="fulladdress"></has-error>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <span class="text-danger">*All fields will be auto-completed depending on CID No.</span><br> -->
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
                                    <label>Student Code:</label>
                                    <input type="text" @change="removeerror('studentcode','studentcode_err')" class="form-control" id="studentcode" v-model="personal_form.studentcode" readonly placeholder="generated automatically"/>
                                    <has-error :form="personal_form" field="studentcode"></has-error>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Mother Tongue</label>
                                    <select v-model="personal_form.mother_tongue" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('mother_tongue') }" class="form-control select2" name="mother_tongue" id="mother_tongue">
                                        <option value=""> --Select--</option>
                                        <option v-for="(item, index) in motherTongueList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                    </select>
                                    <has-error :form="personal_form" field="mother_tongue"></has-error>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Upload Photo</label>
                                    <input type="file" class="form-control" v-on:change="onChangeFileUpload">
                                    <has-error :form="personal_form" field="attachments"></has-error>
                                </div>
                            </div>
                            <hr>
                            <div class="row form-group fa-pull-right">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button class="btn btn-flat btn-primary" type="button" @click="shownexttab('guardians-tab')"> Next <i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!--Student Guardain Info-->
                    <div class="tab-pane fade tab-content-details" id="guardians-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="row form-group">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Parent's Marital Status:</label>
                                <select v-model="guardian_form.merital_status" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('merital_status') }" class="form-control select2" name="merital_status" id="merital_status">
                                    <option value=""> --Select--</option>
                                    <option value="Divorse">Divorse</option>
                                    <option value="Single">Single</option>
                                </select>
                                <has-error :form="guardian_form" field="merital_status"></has-error>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label> Student Primary Contact:</label><br>
                                <input type="radio" v-model="guardian_form.pcontact" name="pcontact" id="pcontact" @click="showidentity('primary-contact-father')" checked> Father
                                <input type="radio" v-model="guardian_form.pcontact" name="pcontact" id="pcontact1" @click="showidentity('primary-contact-mother')" > Mother
                                <input type="radio" v-model="guardian_form.pcontact" name="pcontact" id="pcontact2" @click="showidentity('primary-contact-guardian')"> Guardian 
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="card card-primary">
                                    <div class="card-body">
                                        <dt>Father's Details</dt>
                                        <hr>
                                        <div class="row form-group">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>  Nationality:</label><br>
                                                <input type="radio" v-model="guardian_form.father_nationality" value="Bhutanese" @click="showfathersidentity('bhutanese')" name="father-nationality" id="father-nationality" checked> Bhutanese
                                                <input type="radio" v-model="guardian_form.father_nationality" value="Foreign" @click="showfathersidentity('foreign')" name="father-nationality" id="father-nationality"> Non-Bhutanese
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Father's CID, Immigration ID/Other Document ID  </label>
                                                <input type="text" v-model="guardian_form.father_cid_passport" class="form-control" @keyup.enter="getDetailsbyCID('father_cid_passport','father')" @blur="getDetailsbyCID('father_cid_passport','father')" @change="removeerror('cid_passport')" :class="{ 'is-invalid': guardian_form.errors.has('cid_passport') }" id="father_cid_passport" placeholder="Identification No">
                                                <has-error :form="guardian_form" field="cid_passport"></has-error>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label >Name:<span class="text-danger">*</span> </label>
                                                <input type="text" v-model="guardian_form.father_first_name" class="form-control" @change="removeerror('first_name')" :class="{ 'is-invalid': guardian_form.errors.has('first_name') }" id="f_first_name" placeholder="Name">
                                                <has-error :form="guardian_form" field="first_name"></has-error>
                                            </div>
                                        </div>
                                        <!-- <div class="row form-group" id="father_type" style="display:none">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <label >Please Specify Type:</label>
                                                <input type="text" class="form-control" @change="removeerror('first_name')" :class="{ 'is-invalid': guardian_form.errors.has('type') }" id="type" v-model="guardian_form.parent_details.type" placeholder="Country Diplomat, Expriate etc">
                                                <has-error :form="guardian_form" field="type"></has-error>
                                            </div>
                                        </div> -->
                                        <div class="row form-group" id="father_dzo_gewog_village" style="display:none">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Dzongkhag/Thromde: </label>
                                                <select v-model="guardian_form.father_dzongkhag" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('dzongkhag') }" class="form-control select2" name="fdzongkhag" id="fdzongkhag">
                                                    <option value=""> --Select--</option>
                                                    <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                </select>
                                                <has-error :form="guardian_form" field="dzongkhag"></has-error>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label> Gewog:</label>
                                                <select v-model="guardian_form.father_gewog" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('gewog') }" class="form-control select2" name="fgewog" id="fgewog">
                                                    <option value=""> --Select--</option>
                                                    <option v-for="(item, index) in gewog_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                </select>
                                                <has-error :form="guardian_form" field="gewog"></has-error>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label>Village: </label>
                                                <select v-model="guardian_form.father_village_id" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('village_id') }" class="form-control select2" name="fvillage_id" id="fvillage_id">
                                                    <option value=""> --Select--</option>
                                                    <option v-for="(item, index) in villageList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                </select>
                                                <has-error :form="guardian_form" field="village_id"></has-error>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label >Permanent Address: </label>
                                                <textarea class="form-control" @change="removeerror('fulladdress')" :class="{ 'is-invalid': guardian_form.errors.has('fulladdress') }" id="fulladdress" v-model="guardian_form.father_fulladdress" placeholder="Permanent Address"></textarea>
                                                <has-error :form="guardian_form" field="fulladdress"></has-error>
                                            </div>
                                        </div>
                                        <br>
                                        <label><u> Present Address:</u></label>
                                        <div class="row form-group">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Dzongkhag/Thromde: </label>
                                                <select v-model="guardian_form.father_present_dzongkhag" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('present_dzongkhag') }" class="form-control select2" name="fpresent_dzongkhag" id="fpresent_dzongkhag">
                                                    <option value=""> --Select--</option>
                                                    <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                </select>
                                                <has-error :form="guardian_form" field="present_dzongkhag"></has-error>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label> Gewog:</label>
                                                <select v-model="guardian_form.father_present_gewog" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('present_gewog') }" class="form-control select2" name="fpresent_gewog" id="fpresent_gewog">
                                                    <option value=""> --Select--</option>
                                                    <option v-for="(item, index) in gewog_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                </select>
                                                <has-error :form="guardian_form" field="present_gewog"></has-error>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label>Village: </label>
                                                <select v-model="guardian_form.father_present_village_id" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('present_village_id') }" class="form-control select2" name="fpresent_village_id" id="fpresent_village_id">
                                                    <option value=""> --Select--</option>
                                                    <option v-for="(item, index) in villageList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                </select>
                                                <has-error :form="guardian_form" field="present_village_id"></has-error>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label>Work Address: </label>
                                                <textarea class="form-control" @change="removeerror('work_address')" :class="{ 'is-invalid': guardian_form.errors.has('work_address') }" id="work_address" v-model="guardian_form.father_work_address" placeholder="Working Address"></textarea>
                                                <has-error :form="guardian_form" field="work_address"></has-error>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label>Residence Address: </label>
                                                <textarea class="form-control" @change="removeerror('residence_address')" :class="{ 'is-invalid': guardian_form.errors.has('residence_address') }" id="residence_address" v-model="guardian_form.father_residence_address" placeholder="Residence Address"></textarea>
                                                <has-error :form="guardian_form" field="residence_address"></has-error>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label>Occupation: </label>
                                                <select v-model="guardian_form.father_occupation" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('occupation') }" class="form-control select2" name="occupation" id="occupation">
                                                    <option value=""> --Select--</option>
                                                    <option value="Civil Servant"> Civil Servant</option>
                                                    <option value="Private Employee"> Private Employee</option>
                                                    <option value="Business"> Business</option>
                                                    <option value="Farmer"> Farmer</option>
                                                </select>
                                                <has-error :form="guardian_form" field="occupation"></has-error>
                                            </div>
                                            
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Email Address:</label>
                                                <input type="text" class="form-control" @change="removeerror('email')" :class="{ 'is-invalid': guardian_form.errors.has('email') }" id="email" v-model="guardian_form.father_email" placeholder="Email Address">
                                                <has-error :form="guardian_form" field="email"></has-error>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Contact No:</label>
                                                <input type="text" class="form-control" @change="removeerror('conact_no')" :class="{ 'is-invalid': guardian_form.errors.has('conact_no') }" id="conact_no" v-model="guardian_form.father_conact_no" placeholder="Contact No">
                                                <has-error :form="guardian_form" field="conact_no"></has-error>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="card card-primary">
                                    <div class="card-body">
                                        <dt>Mother's Details</dt>
                                        <hr>
                                        <div class="row form-group">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <label>  Nationality:</label><br>
                                                <input type="radio" value="Bhutanese" v-model="guardian_form.mother_nationality" @click="showmothersidentity('bhutanese')" name="mother-nationality" id="mother-nationality" checked> Bhutanese
                                                <input type="radio" value="Foreign" v-model="guardian_form.mother_nationality" @click="showmothersidentity('foreign')" name="mother-nationality" id="mother-nationality1"> Non-Bhutanese
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Mother's CID, Immigration ID/Other Document ID  </label>
                                                <input type="text" guardian_form.mother_cid_passport class="form-control" @keyup.enter="getDetailsbyCID('mother_cid_passport','mother')" @blur="getDetailsbyCID('mother_cid_passport','mother')" @change="removeerror('cid_passport')" :class="{ 'is-invalid': guardian_form.errors.has('cid_passport') }" id="mother_cid_passport" placeholder="Identification No">
                                                <has-error :form="guardian_form" field="cid_passport"></has-error>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label >Name:<span class="text-danger">*</span> </label>
                                                <input type="text" class="form-control" @change="removeerror('first_name')" :class="{ 'is-invalid': guardian_form.errors.has('first_name') }" id="mother_first_name" v-model="guardian_form.mother_first_name" placeholder="Name">
                                                <has-error :form="guardian_form" field="first_name"></has-error>
                                            </div>
                                        </div>
                                        <!-- <div class="row form-group" id="father_type" style="display:none">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <label >Please Specify Type:</label>
                                                <input type="text" class="form-control" @change="removeerror('first_name')" :class="{ 'is-invalid': guardian_form.errors.has('type') }" id="type" v-model="guardian_form.parent_details.type" placeholder="Country Diplomat, Expriate etc">
                                                <has-error :form="guardian_form" field="type"></has-error>
                                            </div>
                                        </div> -->
                                        <div class="row form-group" id="mothers_dzo_gewog_village" style="display:none">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Dzongkhag/Thromde: </label>
                                                <select v-model="guardian_form.mother_dzongkhag" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('dzongkhag') }" class="form-control select2" name="mother_dzongkhag" id="mother_dzongkhag">
                                                    <option value=""> --Select--</option>
                                                    <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                </select>
                                                <has-error :form="guardian_form" field="dzongkhag"></has-error>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label> Gewog:</label>
                                                <select v-model="guardian_form.mother_gewog" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('gewog') }" class="form-control select2" name="mother_gewog" id="mother_gewog">
                                                    <option value=""> --Select--</option>
                                                    <option v-for="(item, index) in gewog_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                </select>
                                                <has-error :form="guardian_form" field="gewog"></has-error>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label>Village: </label>
                                                <select v-model="guardian_form.mother_village_id" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('village_id') }" class="form-control select2" name="mother_village_id" id="mother_village_id">
                                                    <option value=""> --Select--</option>
                                                    <option v-for="(item, index) in villageList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                </select>
                                                <has-error :form="guardian_form" field="village_id"></has-error>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label>Permanent Address: </label>
                                                <textarea class="form-control" @change="removeerror('fulladdress')" :class="{ 'is-invalid': guardian_form.errors.has('fulladdress') }" id="mother_fulladdress" v-model="guardian_form.mother_fulladdress" placeholder="Permanent Address"></textarea>
                                                <has-error :form="guardian_form" field="fulladdress"></has-error>
                                            </div>
                                        </div>
                                        <br>
                                        <label><u> Present Address</u></label>
                                        <div class="row form-group">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Dzongkhag/Thromde: </label>
                                                <select v-model="guardian_form.mother_present_dzongkhag" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('present_dzongkhag') }" class="form-control select2" name="mother_present_dzongkhag" id="mother_present_dzongkhag">
                                                    <option value=""> --Select--</option>
                                                    <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                </select>
                                                <has-error :form="guardian_form" field="present_dzongkhag"></has-error>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label> Gewog:</label>
                                                <select v-model="guardian_form.mother_present_gewog" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('present_gewog') }" class="form-control select2" name="mother_present_gewog" id="mother_present_gewog">
                                                    <option value=""> --Select--</option>
                                                    <option v-for="(item, index) in gewog_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                </select>
                                                <has-error :form="guardian_form" field="present_gewog"></has-error>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label>Village: </label>
                                                <select v-model="guardian_form.mother_present_village_id" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('present_village_id') }" class="form-control select2" name="mother_present_village_id" id="mother_present_village_id">
                                                    <option value=""> --Select--</option>
                                                    <option v-for="(item, index) in villageList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                </select>
                                                <has-error :form="guardian_form" field="present_village_id"></has-error>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label>Work Address: </label>
                                                <textarea class="form-control" @change="removeerror('work_address')" :class="{ 'is-invalid': guardian_form.errors.has('work_address') }" id="mother_work_address" v-model="guardian_form.mother_work_address" placeholder="Working Address"></textarea>
                                                <has-error :form="guardian_form" field="work_address"></has-error>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label>Residence Address: </label>
                                                <textarea class="form-control" @change="removeerror('residence_address')" :class="{ 'is-invalid': guardian_form.errors.has('residence_address') }" id="mother_residence_address" v-model="guardian_form.mother_residence_address" placeholder="Residence Address"></textarea>
                                                <has-error :form="guardian_form" field="residence_address"></has-error>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label>Occupation: </label>
                                                <select v-model="guardian_form.mother_occupation" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('occupation') }" class="form-control select2" name="mother_occupation" id="mother_occupation">
                                                    <option value=""> --Select--</option>
                                                    <option value="Civil Servant"> Civil Servant</option>
                                                    <option value="Private Employee"> Private Employee</option>
                                                    <option value="Business"> Business</option>
                                                    <option value="Farmer"> Farmer</option>
                                                </select>
                                                <has-error :form="guardian_form" field="occupation"></has-error>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Email Address:</label>
                                                <input type="text" class="form-control" @change="removeerror('email')" :class="{ 'is-invalid': guardian_form.errors.has('email') }" id="mother_email" v-model="guardian_form.mother_email" placeholder="Email Address">
                                                <has-error :form="guardian_form" field="email"></has-error>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Contact No:</label>
                                                <input type="text" class="form-control" @change="removeerror('conact_no')" :class="{ 'is-invalid': guardian_form.errors.has('conact_no') }" id="mother_conact_no" v-model="guardian_form.mother_conact_no" placeholder="Contact No">
                                                <has-error :form="guardian_form" field="conact_no"></has-error>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group" style="display:none" id="gardain_section">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card card-primary">
                                    <div class="card-body">
                                        <dt>Guardian's Details</dt>
                                        <hr>
                                        <div class="row form-group">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <label>Nationality:</label><br>
                                                <input type="radio" value="Bhutanese" v-model="guardian_form.gardain_nationality" @click="showgardainsidentity('bhutanese')" name="gardain-nationality" id="gardain_nationality" checked> Bhutanese
                                                <input type="radio" value="Foreign" v-model="guardian_form.gardain_nationality" @click="showgardainsidentity('foreign')" name="gardain-nationality" id="gardain_nationality1"> Non-Bhutanese
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>CID, Immigration ID/Other Document ID  </label>
                                                <input type="text" guardian_form.gardain_cid_passport class="form-control" @keyup.enter="getDetailsbyCID('gardain_cid_passport','gardain')" @blur="getDetailsbyCID('gardain_cid_passport','gardain')" @change="removeerror('cid_passport')" :class="{ 'is-invalid': guardian_form.errors.has('cid_passport') }" id="gardain_cid_passport" placeholder="Identification No">
                                                <has-error :form="guardian_form" field="cid_passport"></has-error>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <label >Name:<span class="text-danger">*</span> </label>
                                                <input type="text" class="form-control" @change="removeerror('first_name')" :class="{ 'is-invalid': guardian_form.errors.has('first_name') }" id="gardain_first_name" v-model="guardian_form.gardain_first_name" placeholder="Name">
                                                <has-error :form="guardian_form" field="first_name"></has-error>
                                            </div>
                                        </div>
                                        <div class="row form-group" id="gardain_dzo_gewog_village" style="display:none">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <label>Dzongkhag/Thromde: </label>
                                                <select v-model="guardian_form.gardain_dzongkhag" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('dzongkhag') }" class="form-control select2" name="gardain_dzongkhag" id="gardain_dzongkhag">
                                                    <option value=""> --Select--</option>
                                                    <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                </select>
                                                <has-error :form="guardian_form" field="dzongkhag"></has-error>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <label> Gewog:</label>
                                                <select v-model="guardian_form.gardain_gewog" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('gewog') }" class="form-control select2" name="gardain_gewog" id="gardain_gewog">
                                                    <option value=""> --Select--</option>
                                                    <option v-for="(item, index) in gewog_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                </select>
                                                <has-error :form="guardian_form" field="gewog"></has-error>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <label>Village: </label>
                                                <select v-model="guardian_form.gardain_village_id" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('village_id') }" class="form-control select2" name="gardain_village_id" id="gardain_village_id">
                                                    <option value=""> --Select--</option>
                                                    <option v-for="(item, index) in villageList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                </select>
                                                <has-error :form="guardian_form" field="village_id"></has-error>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label >Permanent Address: </label>
                                                <textarea class="form-control" @change="removeerror('fulladdress')" :class="{ 'is-invalid': guardian_form.errors.has('fulladdress') }" id="gardain_fulladdress" v-model="guardian_form.gardain_fulladdress" placeholder="Permanent Address"></textarea>
                                                <has-error :form="guardian_form" field="fulladdress"></has-error>
                                            </div>
                                        </div>
                                        <br>
                                        <label> Present Address:</label>
                                         <hr>
                                        <div class="row form-group">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <label>Dzongkhag/Thromde: </label>
                                                <select v-model="guardian_form.gardain_present_dzongkhag" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('present_dzongkhag') }" class="form-control select2" name="gardain_present_dzongkhag" id="gardain_present_dzongkhag">
                                                    <option value=""> --Select--</option>
                                                    <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                </select>
                                                <has-error :form="guardian_form" field="present_dzongkhag"></has-error>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <label> Gewog:</label>
                                                <select v-model="guardian_form.gardain_present_gewog" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('present_gewog') }" class="form-control select2" name="gardain_present_gewog" id="gardain_present_gewog">
                                                    <option value=""> --Select--</option>
                                                    <option v-for="(item, index) in gewog_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                </select>
                                                <has-error :form="guardian_form" field="present_gewog"></has-error>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <label>Village: </label>
                                                <select v-model="guardian_form.gardain_present_village_id" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('present_village_id') }" class="form-control select2" name="gardain_present_village_id" id="gardain_present_village_id">
                                                    <option value=""> --Select--</option>
                                                    <option v-for="(item, index) in villageList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                </select>
                                                <has-error :form="guardian_form" field="present_village_id"></has-error>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label>Work Address: </label>
                                                <textarea class="form-control" @change="removeerror('work_address')" :class="{ 'is-invalid': guardian_form.errors.has('work_address') }" id="gardain_work_address" v-model="guardian_form.gardain_work_address" placeholder="Working Address"></textarea>
                                                <has-error :form="guardian_form" field="work_address"></has-error>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label>Residence Address: </label>
                                                <textarea class="form-control" @change="removeerror('residence_address')" :class="{ 'is-invalid': guardian_form.errors.has('residence_address') }" id="gardain_residence_address" v-model="guardian_form.gardain_residence_address" placeholder="Residence Address"></textarea>
                                                <has-error :form="guardian_form" field="residence_address"></has-error>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <label>Occupation: </label>
                                                <select v-model="guardian_form.gardain_occupation" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('occupation') }" class="form-control select2" name="occupation" id="gardain_occupation">
                                                    <option value=""> --Select--</option>
                                                    <option value="Civil Servant"> Civil Servant</option>
                                                    <option value="Private Employee"> Private Employee</option>
                                                    <option value="Business"> Business</option>
                                                    <option value="Farmer"> Farmer</option>
                                                </select>
                                                <has-error :form="guardian_form" field="occupation"></has-error>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <label>Email Address:</label>
                                                <input type="text" class="form-control" @change="removeerror('email')" :class="{ 'is-invalid': guardian_form.errors.has('email') }" id="gardain_email" v-model="guardian_form.gardain_email" placeholder="Email Address">
                                                <has-error :form="guardian_form" field="email"></has-error>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <label>Contact No:</label>
                                                <input type="text" class="form-control" @change="removeerror('conact_no')" :class="{ 'is-invalid': guardian_form.errors.has('conact_no') }" id="gardain_conact_no" v-model="guardian_form.gardain_conact_no" placeholder="Contact No">
                                                <has-error :form="guardian_form" field="conact_no"></has-error>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-flat btn-success"  @click="shownexttab('basic-tabs')"><i class="fa fa-arrow-left"></i> Previous </button>
                                <button class="btn btn-flat btn-primary" @click="shownexttab('details-tab')"> Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade tab-content-details" id="details-tab" role="tabpanel" aria-labelledby="custom-tabs-four-details">
                        <div id="schoolsections">
                            <dt>Class Details</dt>
                            <hr>
                            <div class="row form-group">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Student Class: <span class="text-danger">*</span></label>
                                    <select v-model="class_form.class" :class="{ 'is-invalid select2 select2-hidden-accessible': class_form.errors.has('class') }" class="form-control select2" name="class" id="class">
                                        <option value=""> --Select--</option>
                                        <option v-for="(item, index) in clasList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                    </select>
                                    <has-error :form="class_form" field="class"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Stream:</label>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Section: <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Student Type: <span class="text-danger">*</span></label>
                                    <select v-model="class_form.student_type" :class="{ 'is-invalid select2 select2-hidden-accessible': class_form.errors.has('student_type') }" class="form-control select2" name="student_type" id="student_type">
                                        <option value=""> --Select--</option>
                                        <option v-for="(item, index) in studentTypeList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                    </select>
                                    <has-error :form="class_form" field="student_type"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>No of Meals: <span class="text-danger">*</span></label>
                                    <select class="select2bs4" id="studentmeals" v-model="class_form.no_meals" >
                                        <option value="">- Please Select Meals -</option>
                                        <option value="1">1</option><option value="2">2</option><option value="3">3</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <label>Scholarship</label>
                            <div class="row form-group">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" v-model="class_form.no_meals" type="checkbox" id="customCheckbox1" value="option1">
                                        <label for="customCheckbox1" class="font-weight-normal custom-control-label">Scholarship1</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="customCheckbox2">
                                        <label for="customCheckbox2" class="font-weight-normal custom-control-label">Scholarship2</label>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="customCheckbox3" value="option1">
                                        <label for="customCheckbox3" class="font-weight-normal custom-control-label">Scholarship3</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="customCheckbox4">
                                        <label for="customCheckbox4" class="font-weight-normal custom-control-label">Scholarship4</label>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="customCheckbox5" value="option1">
                                        <label for="customCheckbox5" class="font-weight-normal custom-control-label">Scholarship5</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="customCheckbox6">
                                        <label for="customCheckbox6" class="font-weight-normal custom-control-label">Scholarship6</label>
                                    </div>
                                </div>
                            </div>
                            <label>Special Benefits</label>
                            <div class="row form-group">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="benefits1" value="option1">
                                        <label for="benefits1" class="font-weight-normal custom-control-label">Benefits1</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="benefits2">
                                        <label for="benefits2" class="font-weight-normal custom-control-label">Benefits2</label>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="benefits3" value="option1">
                                        <label for="benefits3" class="font-weight-normal custom-control-label">Benefits3</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="benefits4">
                                        <label for="benefits4" class="font-weight-normal custom-control-label">Benefits4</label>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="benefits5" value="option1">
                                        <label for="benefits5" class="font-weight-normal custom-control-label">Benefits5</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="benefits6">
                                        <label for="benefits6" class="font-weight-normal custom-control-label">Benefits6</label>
                                    </div>
                                </div>
                            </div>
                            <label> Do you think the children/student has a disability? (Eg: difficulty seeing, hearing, walking, 
                                learning or remembering, focusing, with fine motor skills, self care, being understood, controlling behavior, socializing or playing) </label>
                            <div class="row form-group">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="sen1" value="option1">
                                        <label for="sen1" class="font-weight-normal custom-control-label">Yes</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="sen1">
                                        <label for="sen1" class="font-weight-normal custom-control-label">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-flat btn-success" @click="shownexttab('guardians-tab')"><i class="fa fa-arrow-left"></i> Previous </button>
                                <button class="btn btn-flat btn-primary" @click="submitfinalform('')"> Submit <i class="fa fa-arrow-save"></i></button>
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
    components: {
    },
    data() {
        return {
            sex_idList:[],
            dzongkhagList:[],
            gewog_list:[],
            villageList:[],
            motherTongueList:[],
            clasList:[],
            studentTypeList:[],
            personal_form: new form({
                snationality:'',
                cid_passport:'',
                first_name:'',
                middle_name:'',
                last_name:'',
                dob:'',
                sex_id:'',
                dzongkhag:'',
                gewog:'',
                village_id:'',
                fulladdress:'',
                mother_tongue:'',
                studentcode:'',
                attachments:'',
            }),
            guardian_form: new form({
                merital_status:'',
                primary_contact:'',
                
                father_nationality:'',
                father_cid_passport:'',
                father_first_name:'',
                father_dob:'',
                father_sex_id:'',
                father_dzongkhag:'',
                father_gewog:'',
                father_village_id:'',
                father_fulladdress:'',
                father_present_dzongkhag:'',
                father_present_gewog:'',
                father_present_village_id:'',
                father_work_address:'',
                father_residence_address:'',
                father_occupation:'',
                father_email:'',
                father_cntct_no:'',

                mother_nationality:'',
                mother_cid_passport:'',
                mother_first_name:'',
                mother_dob:'',
                mother_sex_id:'',
                mother_dzongkhag:'',
                mother_gewog:'',
                mother_village_id:'',
                mother_fulladdress:'',
                mother_present_dzongkhag:'',
                mother_present_gewog:'',
                mother_present_village_id:'',
                mother_work_address:'',
                mother_residence_address:'',
                mother_occupation:'',
                mother_email:'',
                mother_cntct_no:'',

                gardain_nationality:'',
                gardain_cid_passport:'',
                gardain_first_name:'',
                gardain_dob:'',
                gardain_sex_id:'',
                gardain_dzongkhag:'',
                gardain_gewog:'',
                gardain_village_id:'',
                gardain_fulladdress:'',
                gardain_present_dzongkhag:'',
                gardain_present_gewog:'',
                gardain_present_village_id:'',
                gardain_work_address:'',
                gardain_residence_address:'',
                gardain_occupation:'',
                gardain_email:'',
                gardain_cntct_no:'',

                
            }),
            class_form: new form({
                class:'',
                stream:'',
                section:'',
                student_type:'',
                no_meals:'',
                scholarship:[],
                special_benifit:[],
                disability:'',
            }),
        }
    },
    methods: {
        onChangeFileUpload(e){
            this.personal_form.attachments = e.target.files[0];
        },
        getDetailsbyCID(fieldId,type){
            let selectedVal="";
            let selected ="";
            if(type=="std"){
                selected = $("input[type='radio'][name='snationality']:checked");
            }
            
            if(type=="father"){
                selected = $("input[type='radio'][name='father-nationality']:checked");
            }
            if(type=="mother"){
                selected = $("input[type='radio'][name='mother-nationality']:checked");
            }
            if(type=="gardain"){
                selected = $("input[type='radio'][name='gardain-nationality']:checked");
            }
            if(selected.length > 0) {
                selectedVal = selected.val();
            }
            else{
                Swal.fire({
                    html: "Please select nationality",
                    icon: 'error'
                }); 
            }
            if(selectedVal.includes('Bhutan')){
                if ($('#'+fieldId).val().length != 11){
                    Swal.fire({
                        html: "Please ender 11 digit CID",
                        icon: 'error'
                    });
                }
                else{
                    axios.get('getpersonbycid/'+ $('#'+fieldId).val())
                    .then(response => {
                        if (JSON.stringify(response.data)!='{}'){
                            let personal_detail = response.data.citizenDetail[0];
                            if(type=="std"){
                                this.personal_form.first_name = personal_detail.firstName;
                                $('#first_name').prop('readonly',true);
                                this.personal_form.middle_name=personal_detail.middleName;
                                $('#middle_name').prop('readonly',true);
                                this.personal_form.last_name=personal_detail.lastName;
                                $('#last_name').prop('readonly',true);
                                let date_of_birth = new Date(personal_detail.dob);
                                let month =(date_of_birth .getMonth() + 1);
                                let day = date_of_birth .getDate();
                                if(day<10){
                                    day='0'+day;
                                }
                                if(month<10){
                                    month='0'+month;
                                }
                                let year =date_of_birth .getFullYear();
                                this.personal_form.dob = year+ "-"+month + "-" + day;
                                $('#dob').val(year+ "-"+month + "-" + day);
                                $('#dob').prop('readonly',true);
                                if(personal_detail.gender=="M"){
                                    personal_detail.gender="male";
                                }
                                else if(personal_detail.gender=="F"){
                                    personal_detail.gender="female";
                                }
                                else{
                                    personal_detail.gender="others";
                                }
                                for(let i=0; i<this.sex_idList.length;i++){
                                    if(this.sex_idList[i].name.toLowerCase()==personal_detail.gender){
                                        $('#sex_id').val(this.sex_idList[i].id).trigger('change');
                                        this.personal_form.sex_id =  this.sex_idList[i].id;
                                        $('#sex_id').prop('disabled',true);
                                    }  
                                }
                                this.personal_form.dzongkhag =personal_detail.dzongkhagId;
                                $('#dzongkhag').val(personal_detail.dzongkhagId).trigger('change');
                                $('#dzongkhag').prop('disabled',true);
                                this.getgewoglist(personal_detail.dzongkhagId);
                                this.personal_form.gewog = personal_detail.gewogId;
                                $('#gewog').prop('disabled',true);
                                this.getvillagelist(personal_detail.gewogId);
                                $('#village_id').val(personal_detail.villageSerialNo).trigger('change');
                                this.personal_form.village_id = personal_detail.villageSerialNo;
                                $('#village_id').prop('disabled',true);
                            }
                            
                            if(type=="father"){
                                let full_anme=personal_detail.firstName;
                                if(personal_detail.middleName!="" && personal_detail.middleName!=null){
                                    full_anme+=' '+personal_detail.middleName;
                                }
                                full_anme+=' '+personal_detail.lastName;
                                this.guardian_form.father_first_name = full_anme;
                                $('#f_first_name').prop('readonly',true);
                                this.guardian_form.father_dzongkhag =personal_detail.dzongkhagId;
                                $('#fdzongkhag').val(personal_detail.dzongkhagId).trigger('change');
                                $('#fdzongkhag').prop('disabled',true);
                                this.getgewoglist(personal_detail.dzongkhagId);
                                this.guardian_form.father_gewog = personal_detail.gewogId;
                                $('#fgewog').val(personal_detail.gewogId).trigger('change');
                                $('#fgewog').prop('disabled',true);
                                this.getvillagelist(personal_detail.gewogId);
                                this.guardian_form.father_village_id = personal_detail.villageSerialNo;
                                $('#fvillage_id').val(personal_detail.villageSerialNo).trigger('change');
                                $('#fvillage_id').prop('disabled',true);
                            }
                            if(type=="mother"){
                                let full_anme=personal_detail.firstName;
                                if(personal_detail.middleName!="" && personal_detail.middleName!=null){
                                    full_anme+=' '+personal_detail.middleName;
                                }
                                full_anme+=' '+personal_detail.lastName;
                                this.guardian_form.mother_first_name = full_anme;
                                $('#mother_first_name').prop('readonly',true);
                                this.guardian_form.mother_dzongkhag =personal_detail.dzongkhagId;
                                $('#mother_dzongkhag').val(personal_detail.dzongkhagId).trigger('change');
                                $('#mother_dzongkhag').prop('disabled',true);
                                this.getgewoglist(personal_detail.dzongkhagId);
                                this.guardian_form.mother_gewog = personal_detail.gewogId;
                                $('#mother_gewog').val(personal_detail.gewogId).trigger('change');
                                $('#mother_gewog').prop('disabled',true);
                                this.getvillagelist(personal_detail.gewogId);
                                this.guardian_form.mother_village_id = personal_detail.villageSerialNo;
                                $('#mother_village_id').val(personal_detail.villageSerialNo).trigger('change');
                                $('#mother_village_id').prop('disabled',true);
                            }
                            if(type=="gardain"){
                                let full_anme=personal_detail.firstName;
                                if(personal_detail.middleName!="" && personal_detail.middleName!=null){
                                    full_anme+=' '+personal_detail.middleName;
                                }
                                full_anme+=' '+personal_detail.lastName;
                                this.guardian_form.gardain_first_name = full_anme;
                                $('#gardain_first_name').prop('readonly',true);
                                this.guardian_form.gardain_dzongkhag =personal_detail.dzongkhagId;
                                $('#gardain_dzongkhag').val(personal_detail.dzongkhagId).trigger('change');
                                $('#gardain_dzongkhag').prop('disabled',true);
                                this.getgewoglist(personal_detail.dzongkhagId);
                                this.guardian_form.gardain_gewog = personal_detail.gewogId;
                                $('#gardain_gewog').val(personal_detail.gewogId).trigger('change');
                                $('#gardain_gewog').prop('disabled',true);
                                this.getvillagelist(personal_detail.gewogId);
                                this.guardian_form.gardain_village_id = personal_detail.villageSerialNo;
                                $('#gardain_village_id').val(personal_detail.villageSerialNo).trigger('change');
                                $('#gardain_village_id').prop('disabled',true);
                            }
                            
                        }else{
                            Swal.fire({
                                html: "No data found for this CID",
                                icon: 'error'
                            });
                        }
                    })
                    .catch((exception) => {
                        Swal.fire({
                            html: "No data found for matching CID/service down"+exception,
                            icon: 'error'
                        });
                    });
                }
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
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        loadAllStudentMasters(type){
            axios.get('masters/loadStudentMasters/'+type)
            .then(response =>{
                let data = response;
                if(type=="StudentType_Active"){
                    this.studentTypeList = data.data.data;
                }
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        getgewoglist(id){
            let dzoId=$('#dzongkhag').val();
            if(id!="" && dzoId==null){
                dzoId=id;
            }
            let uri = 'masters/all_active_dropdowns/dzongkhag/'+dzoId;
            this.gewog_list =[];
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.gewog_list = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        getvillagelist(id){
            let gewogId=$('#gewog').val();
            if(id!="" && (gewogId==null || gewogId=="")){
                gewogId=id;
            }
            let uri = 'masters/all_active_dropdowns/gewog/'+gewogId;
            this.villageList =[];
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.villageList = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        loadclasses(id){
            let uri = 'organization/getFullSchoolDetials/sessionDet';
            axios.get(uri)
            .then(response =>{
                let data = response;
                alert(data.data.class_section.lenght);
                this.clasList=data.data.class_section;
                // this.streamList1=data.sections;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        
        shownexttab(nextclass){
            this.changetab(nextclass);
            if(nextclass=="guardians-tab"){
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                } 
                let formData = new FormData();
                formData.append('snationality', this.personal_form.snationality);
                formData.append('cid_passport', this.personal_form.cid_passport);
                formData.append('first_name', this.personal_form.first_name);
                formData.append('middle_name', this.personal_form.middle_name);
                formData.append('last_name', this.personal_form.last_name);
                formData.append('dob', this.personal_form.dob); 
                formData.append('sex_id', this.personal_form.sex_id);
                formData.append('dzongkhag', this.personal_form.dzongkhag);
                formData.append('gewog', this.personal_form.gewog);
                formData.append('village_id', this.personal_form.village_id);
                formData.append('mother_tongue', this.personal_form.mother_tongue);
                formData.append('fulladdress', this.personal_form.fulladdress);
                formData.append('attachments', this.personal_form.attachments);
                //this.personal_form.post('students/admission/saveStudentDetials',formData.serialize(), config)
                axios.post('students/admission/saveStudentDetails',formData, config)
                .then((response) => {
                    alert(response.data);
                    this.ciderror = '';
                    Fire.$emit('AftercreateInstruList')
                    Toast.fire({
                        icon: 'success',
                        title: 'Instructor Registration  successful'
                    })
                    this.$Progress.finish();
                    this.changetab(nextclass);
                })
                .catch((error) => {
                    Toast.fire({
                        icon: 'error',
                        title: 'Unexpected error occured. Try again.'
                    });
                    this.applyselect()
                    console.log("Error......")
                })
            }
        },
        changetab(nextclass){
            $('#tabhead >li >a').removeClass('active');
            $('#tabhead >li >a >span').addClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').addClass('active');
            $('.'+nextclass+' >a >span').removeClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').removeClass('disabled');
            $('.tab-content-details').hide();
            $('#'+nextclass).show().removeClass('fade');
        },
        applyselect(){
            if(!$('#sex_id').attr('class').includes('select2-hidden-accessible')){
                $('#sex_id').addClass('select2-hidden-accessible');
            }
            if(!$('#dzongkhag').attr('class').includes('select2-hidden-accessible')){
                $('#dzongkhag').addClass('select2-hidden-accessible');
            }
            if(!$('#gewog').attr('class').includes('select2-hidden-accessible')){
                $('#gewog').addClass('select2-hidden-accessible');
            }
            if(!$('#village_id').attr('class').includes('select2-hidden-accessible')){
                $('#village_id').addClass('select2-hidden-accessible');
            }
            if(!$('#mother_tongue').attr('class').includes('select2-hidden-accessible')){
                $('#mother_tongue').addClass('select2-hidden-accessible');
            }
        },
        submitfinalform(){
            Swal.fire({
                title: 'Are you sure you wish to submit the entire information mention in the form?',
                text: "You won't be able to revert this back once you submit!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
                }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Submitted!',
                        'Your Applicaiton details has been submitted. System generated application number for this transaction is: #02234. You may use this application nunber to track application status.',
                        'success',
                        this.$router.push('/student_admission')
                    )
                }
            })
        },
        removeerror(fieldid,errid){
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
            if(id=="sex_id"){
                this.personal_form.sex_id=$('#sex_id').val();
            }
            if(id=="dzongkhag"){
                this.personal_form.dzongkhag=$('#dzongkhag').val();
                this.getgewoglist();
            }
            if(id=="gewog"){
                this.personal_form.gewog=$('#gewog').val();
                this.getvillagelist();
            }
            if(id=="village_id"){
                this.personal_form.village_id=$('#village_id').val();
            }
            if(id=="mother_tongue"){
                this.personal_form.mother_tongue=$('#mother_tongue').val();
            }
            
        },
        showstdidentity:function(type){
            $('#dzo_gewog_village').hide();
            if(type=="Student-Non-Bhutanese"){
                $('#level_name').html('Immigration/Passport/Other Identification No: *');
            }
            if(type=="Student-Bhutanese"){
                $('#level_name').html('CID No: *');
                $('#dzo_gewog_village').show();
            }
            if(type=="Student-Bhutanese-underprocess"){
                $('#level_name').html('Identification No: *');
                $('#dzo_gewog_village').show();
            }
        },
        showfathersidentity(type){
            $('#father_dzo_gewog_village').hide();
            if(type=="bhutanese"){
                $('#father_dzo_gewog_village').show();
            }
        },
        showmothersidentity(type){
            $('#mothers_dzo_gewog_village').hide();
            if(type=="bhutanese"){
                $('#mothers_dzo_gewog_village').show();
            }
        },
        showgardainsidentity(type){
            $('#gardain_dzo_gewog_village').hide();
            if(type=="bhutanese"){
                $('#gardain_dzo_gewog_village').show();
            }
        },

        showidentity:function(type){
            $('#gardain_section').hide();
            if(type=="primary-contact-guardian"){
                $('#gardain_section').show();
            } 
        }

    },

    mounted() {
        this.loadAllActiveMasters('all_active_gender');
        this.loadAllActiveMasters('all_active_dzongkhag');
        this.loadAllActiveMasters('active_mother_tongue');
        this.loadAllStudentMasters('StudentType_Active');
        
        this.loadclasses('clasList');
         
        $('.select2').select2();
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id')); 
        });
        
        Fire.$on('changefunction',(id)=> {
            this.changefunction(id);
        });
    },
}
</script>
 