<template>
    <div class="container-fluid">
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
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="basic-tabs" role="tabpanel" aria-labelledby="basicdetails">
                        <form id="admission_form" class="form-horizontal" enctype="multipart/form-data" action="#" method="POST">
                            <div class="row form-group">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label> Student Nationality:<span class="text-danger">*</span></label><br>
                                    <input type="radio" name="snationality" v-model="student_form.snationality" value="Bhutanese" id="s-bhutanese" @click="showstdidentity('Student-Bhutanese')" checked> Bhutanese <br>
                                    <input type="radio" name="snationality" v-model="student_form.snationality" value="Bhutanese Under Process" id="s-bhutanese-underprocess" @click="showstdidentity('Student-Bhutanese-underprocess')" checked> Bhutanese (under process)<br>
                                    <input type="radio" name="snationality" v-model="student_form.snationality" value="Foreign" id="s-foreign" @click="showstdidentity('Student-Non-Bhutanese')"> Non-Bhutanese
                                    <span class="text-danger" id="snationality_err"></span>
                                </div>
                                <div class="row form-group col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                    <div class="card card-primary">
                                        <div class="card-body">
                                            <div class="row form-group">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <label id="level_name"></label>
                                                    <input type="text" class="form-control"  @change="removeerror('cid_passport')" :class="{ 'is-invalid': student_form.errors.has('cid_passport') }" id="cid_passport" v-model="student_form.cid_passport" placeholder="Identification No">
                                                    <has-error :form="student_form" field="cid_passport"></has-error>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label >First Name:<span class="text-danger">*</span> </label>
                                                    <input type="text" class="form-control" @change="removeerror('first_name')" :class="{ 'is-invalid': student_form.errors.has('first_name') }" id="first_name" v-model="student_form.first_name" placeholder="First Name">
                                                    <has-error :form="student_form" field="first_name"></has-error>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label > Middle Name: </label>
                                                    <input type="text" class="form-control" @change="removeerror('middle_name')" :class="{ 'is-invalid': student_form.errors.has('middle_name') }" id="middle_name" v-model="student_form.middle_name" placeholder="Middle Name">
                                                    <has-error :form="student_form" field="middle_name"></has-error>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label >Last Name: </label>
                                                    <input type="text" class="form-control" @change="removeerror('last_name')" :class="{ 'is-invalid': student_form.errors.has('last_name') }" id="last_name" v-model="student_form.last_name" placeholder="Last Name">
                                                    <has-error :form="student_form" field="last_name"></has-error>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Date of Birth:<span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control" @change="removeerror('dob')" :class="{ 'is-invalid': student_form.errors.has('dob') }" id="dob" v-model="student_form.dob" placeholder="Date of Birth">
                                                    <has-error :form="student_form" field="dob"></has-error>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Gender:<span class="text-danger">*</span></label>
                                                    <select v-model="student_form.sex_id" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('sex_id') }" class="form-control select2" name="sex_id" id="sex_id">
                                                        <option value=""> --Select--</option>
                                                        <option v-for="(item, index) in sex_idList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                    </select>
                                                    <has-error :form="student_form" field="sex_id"></has-error>
                                                </div>
                                            </div>
                                            <div class="row form-group" id="dzo_gewog_village">
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label>Dzongkhag/Thromde: </label>
                                                    <select v-model="student_form.dzongkhag" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('dzongkhag') }" class="form-control select2" name="dzongkhag" id="dzongkhag">
                                                        <option value=""> --Select--</option>
                                                        <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                    </select>
                                                    <has-error :form="student_form" field="dzongkhag"></has-error>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label> Gewog:</label>
                                                    <select v-model="student_form.gewog" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('gewog') }" class="form-control select2" name="gewog" id="gewog">
                                                        <option value=""> --Select--</option>
                                                        <option v-for="(item, index) in std_gewog_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                    </select>
                                                    <has-error :form="student_form" field="gewog"></has-error>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

                                            <label>Village: </label>
                                                    <select v-model="student_form.village_id" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('village_id') }" class="form-control select2" name="village_id" id="village_id">
                                                        <option value=""> --Select--</option>
                                                        <option v-for="(item, index) in std_villageList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                    </select>
                                                    <has-error :form="student_form" field="village_id"></has-error>
                                                </div>
                                            </div>
                                            <div class="row form-group" id="permanentAddr">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <label >Permanent Address: </label>
                                                    <textarea class="form-control" rows="3" @change="removeerror('fulladdress')" :class="{ 'is-invalid': student_form.errors.has('fulladdress') }" id="fulladdress" v-model="student_form.fulladdress" placeholder="Permanent Address"></textarea>
                                                    <has-error :form="student_form" field="fulladdress"></has-error>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Upload Photo</label>
                                    <input type="file" class="form-control" v-on:change="onChangeFileUpload">
                                    <has-error :form="student_form" field="attachments"></has-error>
                                </div>
                            </div>
                            <hr>
                             <div class="form-group">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label>School Information</label><br>
                                    <div class="row form-group" id="dzo_gewog_village">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Admission for:  <span class="text-danger">*</span> </label>
                                            <select v-model="school_form.orgType" :class="{ 'is-invalid select2 select2-hidden-accessible': school_form.errors.has('orgType') }" class="form-control select2" name="orgType" id="orgType">
                                                <option value="ECCD"> ECCD</option>
                                                <option value="School"> School/ Class PP / ECR</option>
                                            </select>
                                            <has-error :form="school_form" field="orgType"></has-error>
                                        </div>
                                    </div>
                                    <div class="row form-group" id="dzo_gewog_village">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Dzongkhag/Thromde:  <span class="text-danger">*</span> </label>
                                            <select v-model="school_form.s_dzongkhag" :class="{ 'is-invalid select2 select2-hidden-accessible': school_form.errors.has('s_dzongkhag') }" class="form-control select2" name="s_dzongkhag" id="s_dzongkhag">
                                                <option value=""> --Select--</option>
                                                <option v-for="(item, index) in s_dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                            </select>
                                            <has-error :form="school_form" field="s_dzongkhag"></has-error>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label> School/ECR/ECCD:  <span class="text-danger">*</span></label>
                                            <select v-model="school_form.s_school" :class="{ 'is-invalid select2 select2-hidden-accessible': school_form.errors.has('s_school') }" class="form-control select2" name="s_school" id="s_school">
                                                <option value=""> --Select--</option>
                                                <option v-for="(item, index) in s_schoolList" :key="index" v-bind:value="item.id">{{ item.name }} ({{item.category}})</option>
                                            </select>
                                            <has-error :form="school_form" field="s_school"></has-error>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Class:  <span class="text-danger">*</span></label>
                                            <select v-model="school_form.s_class" :class="{ 'is-invalid select2 select2-hidden-accessible': school_form.errors.has('s_class') }" class="form-control select2" name="s_class" id="s_class">
                                                <option value=""> --Select--</option>
                                                <option v-for="(item, index) in s_classList" :key="index" v-bind:value="item.OrgClassStreamId">{{ item.class }}</option>
                                            </select>
                                            <has-error :form="school_form" field="s_class"></has-error>
                                        </div>
                                    </div>
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
                                    <input type="radio" value="Father" v-model="guardian_form.primary_contact" :class="{ 'is-invalid': guardian_form.errors.has('primary_contact') }" name="primary_contact" id="primary_contact" @click="showidentity('primary-contact-father')" checked> Father
                                    <input type="radio" value="Mother" v-model="guardian_form.primary_contact" :class="{ 'is-invalid': guardian_form.errors.has('primary_contact') }" name="primary_contact" id="primary_contact1" @click="showidentity('primary-contact-mother')" > Mother
                                    <input type="radio" value="Others" v-model="guardian_form.primary_contact" :class="{ 'is-invalid': guardian_form.errors.has('primary_contact') }" name="primary_contact" id="primary_contact2" @click="showidentity('primary-contact-guardian')"> Guardian
                                <has-error :form="guardian_form" field="primary_contact"></has-error>
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
                                                <input type="radio" v-model="guardian_form.father_nationality" value="Bhutanese" @click="showfathersidentity('bhutanese')" name="father_nationality" id="father_nationality" checked> Bhutanese
                                                <input type="radio" v-model="guardian_form.father_nationality" value="Foreign" @click="showfathersidentity('foreign')" name="father_nationality" id="father_nationality1"> Non-Bhutanese
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Father's CID, Immigration ID/Other Document ID  </label>
                                                <input type="text" v-model="guardian_form.father_cid_passport" class="form-control" @keyup.enter="getChildDetailsbyCID('father_cid_passport','father')" @blur="getChildDetailsbyCID('father_cid_passport','father')" @change="removeerror('father_cid_passport')" :class="{ 'is-invalid': guardian_form.errors.has('father_cid_passport') }" id="father_cid_passport" placeholder="Identification No">
                                                <has-error :form="guardian_form" field="father_cid_passport"></has-error>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label >Name:<span class="text-danger">*</span> </label>
                                                <input type="text" v-model="guardian_form.father_first_name" class="form-control" @change="removeerror('father_first_name')" :class="{ 'is-invalid': guardian_form.errors.has('father_first_name') }" id="father_first_name" placeholder="Name">
                                                <has-error :form="guardian_form" field="father_first_name"></has-error>
                                            </div>
                                        </div>
                                        <div class="row form-group" id="father_dzo_gewog_village">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Dzongkhag/Thromde: </label>
                                                <select v-model="guardian_form.father_dzongkhag" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('father_dzongkhag') }" class="form-control select2" name="father_dzongkhag" id="father_dzongkhag">
                                                    <option value=""> --Select--</option>
                                                    <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                </select>
                                                <has-error :form="guardian_form" field="father_dzongkhag"></has-error>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label> Gewog:</label>
                                                <select v-model="guardian_form.father_gewog" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('father_gewog') }" class="form-control select2" name="father_gewog" id="father_gewog">
                                                    <option value=""> --Select--</option>
                                                    <option v-for="(item, index) in p_father_gewog_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                </select>
                                                <has-error :form="guardian_form" field="father_gewog"></has-error>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label>Village: </label>
                                                <select v-model="guardian_form.father_village_id" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('father_village_id') }" class="form-control select2" name="father_village_id" id="father_village_id">
                                                    <option value=""> --Select--</option>
                                                    <option v-for="(item, index) in p_father_villageList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                </select>
                                                <has-error :form="guardian_form" field="father_village_id"></has-error>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label >Permanent Address: </label>
                                                <textarea class="form-control" @change="removeerror('father_fulladdress')" :class="{ 'is-invalid': guardian_form.errors.has('father_fulladdress') }" id="father_fulladdress" v-model="guardian_form.father_fulladdress" placeholder="Permanent Address"></textarea>
                                                <has-error :form="guardian_form" field="father_fulladdress"></has-error>
                                            </div>
                                        </div>
                                        <br>
                                        <label><u> Present Address:</u></label>
                                        <div class="row form-group">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Dzongkhag/Thromde: </label>
                                                    <select v-model="guardian_form.father_present_dzongkhag" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('father_present_dzongkhag') }" class="form-control select2" name="father_present_dzongkhag" id="father_present_dzongkhag">
                                                        <option value=""> --Select--</option>
                                                        <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                    </select>
                                                <has-error :form="guardian_form" field="father_present_dzongkhag"></has-error>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label> Gewog:</label>
                                                    <select v-model="guardian_form.father_present_gewog" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('father_present_gewog') }" class="form-control select2" name="father_present_gewog" id="father_present_gewog">
                                                        <option value=""> --Select--</option>
                                                        <option v-for="(item, index) in father_gewog_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                    </select>
                                                <has-error :form="guardian_form" field="father_present_gewog"></has-error>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label>Village: </label>
                                                    <select v-model="guardian_form.father_present_village_id" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('father_present_village_id') }" class="form-control select2" name="father_present_village_id" id="father_present_village_id">
                                                        <option value=""> --Select--</option>
                                                        <option v-for="(item, index) in father_villageList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                    </select>
                                                <has-error :form="guardian_form" field="father_present_village_id"></has-error>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label>Work Address: </label>
                                                <textarea class="form-control" @change="removeerror('father_work_address')" :class="{ 'is-invalid': guardian_form.errors.has('father_work_address') }" id="father_work_address" v-model="guardian_form.father_work_address" placeholder="Working Address"></textarea>
                                                <has-error :form="guardian_form" field="father_work_address"></has-error>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label>Residence Address: </label>
                                                <textarea class="form-control" @change="removeerror('father_residence_address')" :class="{ 'is-invalid': guardian_form.errors.has('father_residence_address') }" id="father_residence_address" v-model="guardian_form.father_residence_address" placeholder="Residence Address"></textarea>
                                                <has-error :form="guardian_form" field="father_residence_address"></has-error>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label>Occupation: </label>
                                                    <select v-model="guardian_form.father_occupation" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('father_occupation') }" class="form-control select2" name="father_occupation" id="father_occupation">
                                                        <option value=""> --Select--</option>
                                                        <option value="Civil Servant"> Civil Servant</option>
                                                        <option value="Private Employee"> Private Employee</option>
                                                        <option value="Business"> Business</option>
                                                        <option value="Farmer"> Farmer</option>
                                                    </select>
                                                <has-error :form="guardian_form" field="father_occupation"></has-error>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Email Address:</label>
                                                <input type="text" class="form-control" @change="removeerror('father_email')" :class="{ 'is-invalid': guardian_form.errors.has('father_email') }" id="father_email" v-model="guardian_form.father_email" placeholder="Email Address">
                                                <has-error :form="guardian_form" field="father_email"></has-error>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Contact No:</label>
                                                <input type="number" class="form-control" @change="removeerror('father_conact_no')" :class="{ 'is-invalid': guardian_form.errors.has('father_cntct_no') }" id="father_conact_no" v-model="guardian_form.father_cntct_no" placeholder="Contact No">
                                                <has-error :form="guardian_form" field="father_conact_no"></has-error>
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
                                                <input type="radio" value="Bhutanese" v-model="guardian_form.mother_nationality" @click="showmothersidentity('bhutanese')" name="mother_nationality" id="mother_nationality" checked> Bhutanese
                                                <input type="radio" value="Foreign" v-model="guardian_form.mother_nationality" @click="showmothersidentity('foreign')" name="mother_nationality" id="mother_nationality1"> Non-Bhutanese
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Mother's CID, Immigration ID/Other Document ID  </label>
                                                <input type="text" v-model="guardian_form.mother_cid_passport" class="form-control" @keyup.enter="getChildDetailsbyCID('mother_cid_passport','mother')" @blur="getChildDetailsbyCID('mother_cid_passport','mother')" @change="removeerror('mother_cid_passport')" :class="{ 'is-invalid': guardian_form.errors.has('mother_cid_passport') }" id="mother_cid_passport" placeholder="Identification No">
                                                <has-error :form="guardian_form" field="mother_cid_passport"></has-error>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label >Name:<span class="text-danger">*</span> </label>
                                                <input type="text" class="form-control" @change="removeerror('mother_first_name')" :class="{ 'is-invalid': guardian_form.errors.has('mother_first_name') }" id="mother_first_name" v-model="guardian_form.mother_first_name" placeholder="Name">
                                                <has-error :form="guardian_form" field="mother_first_name"></has-error>
                                            </div>
                                        </div>
                                        <div class="row form-group" id="mothers_dzo_gewog_village">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Dzongkhag/Thromde: </label>
                                                    <select v-model="guardian_form.mother_dzongkhag" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('mother_dzongkhag') }" class="form-control select2" name="mother_dzongkhag" id="mother_dzongkhag">
                                                        <option value=""> --Select--</option>
                                                        <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                    </select>
                                                <has-error :form="guardian_form" field="mother_dzongkhag"></has-error>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label> Gewog:</label>
                                                    <select v-model="guardian_form.mother_gewog" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('mother_gewog') }" class="form-control select2" name="mother_gewog" id="mother_gewog">
                                                        <option value=""> --Select--</option>
                                                        <option v-for="(item, index) in p_mother_gewog_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                    </select>
                                                <has-error :form="guardian_form" field="mother_gewog"></has-error>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label>Village: </label>
                                                    <select v-model="guardian_form.mother_village_id" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('mother_village_id') }" class="form-control select2" name="mother_village_id" id="mother_village_id">
                                                        <option value=""> --Select--</option>
                                                        <option v-for="(item, index) in p_mother_villageList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                    </select>
                                                <has-error :form="guardian_form" field="mother_village_id"></has-error>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label>Permanent Address: </label>
                                                <textarea class="form-control" @change="removeerror('mother_fulladdress')" :class="{ 'is-invalid': guardian_form.errors.has('mother_fulladdress') }" id="mother_fulladdress" v-model="guardian_form.mother_fulladdress" placeholder="Permanent Address"></textarea>
                                                <has-error :form="guardian_form" field="mother_fulladdress"></has-error>
                                            </div>
                                        </div>
                                        <br>
                                        <label><u> Present Address</u></label>
                                        <div class="row form-group">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Dzongkhag/Thromde: </label>
                                                    <select v-model="guardian_form.mother_present_dzongkhag" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('mother_present_dzongkhag') }" class="form-control select2" name="mother_present_dzongkhag" id="mother_present_dzongkhag">
                                                        <option value=""> --Select--</option>
                                                        <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                    </select>
                                                <has-error :form="guardian_form" field="mother_present_dzongkhag"></has-error>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label> Gewog:</label>
                                                    <select v-model="guardian_form.mother_present_gewog" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('mother_present_gewog') }" class="form-control select2" name="mother_present_gewog" id="mother_present_gewog">
                                                        <option value=""> --Select--</option>
                                                        <option v-for="(item, index) in mother_gewog_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                    </select>
                                                <has-error :form="guardian_form" field="mother_present_gewog"></has-error>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label>Village: </label>
                                                    <select v-model="guardian_form.mother_present_village_id" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('mother_present_village_id') }" class="form-control select2" name="mother_present_village_id" id="mother_present_village_id">
                                                        <option value=""> --Select--</option>
                                                        <option v-for="(item, index) in mother_villageList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                    </select>
                                                <has-error :form="guardian_form" field="mother_present_village_id"></has-error>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label>Work Address: </label>
                                                <textarea class="form-control" @change="removeerror('mother_work_address')" :class="{ 'is-invalid': guardian_form.errors.has('mother_work_address') }" id="mother_work_address" v-model="guardian_form.mother_work_address" placeholder="Working Address"></textarea>
                                                <has-error :form="guardian_form" field="mother_work_address"></has-error>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label>Residence Address: </label>
                                                <textarea class="form-control" @change="removeerror('mother_residence_address')" :class="{ 'is-invalid': guardian_form.errors.has('mother_residence_address') }" id="mother_residence_address" v-model="guardian_form.mother_residence_address" placeholder="Residence Address"></textarea>
                                                <has-error :form="guardian_form" field="mother_residence_address"></has-error>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label>Occupation: </label>
                                                    <select v-model="guardian_form.mother_occupation" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('mother_occupation') }" class="form-control select2" name="mother_occupation" id="mother_occupation">
                                                        <option value=""> --Select--</option>
                                                        <option value="Civil Servant"> Civil Servant</option>
                                                        <option value="Private Employee"> Private Employee</option>
                                                        <option value="Business"> Business</option>
                                                        <option value="Farmer"> Farmer</option>
                                                    </select>
                                                <has-error :form="guardian_form" field="mother_occupation"></has-error>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Email Address:</label>
                                                <input type="text" class="form-control" @change="removeerror('mother_email')" :class="{ 'is-invalid': guardian_form.errors.has('mother_email') }" id="mother_email" v-model="guardian_form.mother_email" placeholder="Email Address">
                                                <has-error :form="guardian_form" field="mother_email"></has-error>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Contact No:</label>
                                                <input type="number" class="form-control" @change="removeerror('mother_cntct_no')" :class="{ 'is-invalid': guardian_form.errors.has('mother_cntct_no') }" id="mother_cntct_no" v-model="guardian_form.mother_cntct_no" placeholder="Contact No">
                                                <has-error :form="guardian_form" field="mother_cntct_no"></has-error>
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
                                                <input type="radio" value="Bhutanese" v-model="guardian_form.gardain_nationality" @click="showgardainsidentity('bhutanese')" name="gardain_nationality" id="gardain_nationality" checked> Bhutanese
                                                <input type="radio" value="Foreign" v-model="guardian_form.gardain_nationality" @click="showgardainsidentity('foreign')" name="gardain_nationality" id="gardain_nationality1"> Non-Bhutanese
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>CID, Immigration ID/Other Document ID  </label>
                                                <input type="text" v-model="guardian_form.gardain_cid_passport" class="form-control" @keyup.enter="getChildDetailsbyCID('gardain_cid_passport','gardain')" @blur="getChildDetailsbyCID('gardain_cid_passport','gardain')" @change="removeerror('gardain_cid_passport')" :class="{ 'is-invalid': guardian_form.errors.has('gardain_cid_passport') }" id="gardain_cid_passport" placeholder="Identification No">
                                                <has-error :form="guardian_form" field="gardain_cid_passport"></has-error>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <label >Name:<span class="text-danger">*</span> </label>
                                                <input type="text" class="form-control" @change="removeerror('gardain_first_name')" :class="{ 'is-invalid': guardian_form.errors.has('gardain_first_name') }" id="gardain_first_name" v-model="guardian_form.gardain_first_name" placeholder="Name">
                                                <has-error :form="guardian_form" field="gardain_first_name"></has-error>
                                            </div>
                                        </div>
                                        <div class="row form-group" id="gardain_dzo_gewog_village">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <label>Dzongkhag/Thromde: </label>
                                                <select v-model="guardian_form.gardain_dzongkhag" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('gardain_dzongkhag') }" class="form-control select2" name="gardain_dzongkhag" id="gardain_dzongkhag">
                                                    <option value=""> --Select--</option>
                                                    <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                </select>
                                                <has-error :form="guardian_form" field="gardain_dzongkhag"></has-error>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <label> Gewog:</label>
                                                    <select v-model="guardian_form.gardain_gewog" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('gardain_gewog') }" class="form-control select2" name="gardain_gewog" id="gardain_gewog">
                                                        <option value=""> --Select--</option>
                                                        <option v-for="(item, index) in p_gardain_gewog_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                    </select>
                                                <has-error :form="guardian_form" field="gardain_gewog"></has-error>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <label>Village: </label>
                                                    <select v-model="guardian_form.gardain_village_id" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('gardain_village_id') }" class="form-control select2" name="gardain_village_id" id="gardain_village_id">
                                                        <option value=""> --Select--</option>
                                                        <option v-for="(item, index) in p_gardain_villageList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                    </select>
                                                <has-error :form="guardian_form" field="gardain_village_id"></has-error>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label >Permanent Address: </label>
                                                <textarea class="form-control" @change="removeerror('gardain_fulladdress')" :class="{ 'is-invalid': guardian_form.errors.has('gardain_fulladdress') }" id="gardain_fulladdress" v-model="guardian_form.gardain_fulladdress" placeholder="Permanent Address"></textarea>
                                                <has-error :form="guardian_form" field="gardain_fulladdress"></has-error>
                                            </div>
                                        </div>
                                        <br>
                                        <label> Present Address:</label>
                                         <hr>
                                        <div class="row form-group">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <label>Dzongkhag/Thromde: </label>
                                                    <select v-model="guardian_form.gardain_present_dzongkhag" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('gardain_present_dzongkhag') }" class="form-control select2" name="gardain_present_dzongkhag" id="gardain_present_dzongkhag">
                                                        <option value=""> --Select--</option>
                                                        <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                    </select>
                                                <has-error :form="guardian_form" field="gardain_present_dzongkhag"></has-error>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <label> Gewog:</label>
                                                    <select v-model="guardian_form.gardain_present_gewog" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('gardain_present_gewog') }" class="form-control select2" name="gardain_present_gewog" id="gardain_present_gewog">
                                                        <option value=""> --Select--</option>
                                                        <option v-for="(item, index) in gardain_gewog_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                    </select>
                                                <has-error :form="guardian_form" field="gardain_present_gewog"></has-error>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <label>Village: </label>
                                                    <select v-model="guardian_form.gardain_present_village_id" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('gardain_present_village_id') }" class="form-control select2" name="gardain_present_village_id" id="gardain_present_village_id">
                                                        <option value=""> --Select--</option>
                                                        <option v-for="(item, index) in gardain_villageList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                    </select>
                                                <has-error :form="guardian_form" field="gardain_present_village_id"></has-error>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label>Work Address: </label>
                                                <textarea class="form-control" @change="removeerror('gardain_work_address')" :class="{ 'is-invalid': guardian_form.errors.has('gardain_work_address') }" id="gardain_work_address" v-model="guardian_form.gardain_work_address" placeholder="Working Address"></textarea>
                                                <has-error :form="guardian_form" field="gardain_work_address"></has-error>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label>Residence Address: </label>
                                                <textarea class="form-control" @change="removeerror('gardain_residence_address')" :class="{ 'is-invalid': guardian_form.errors.has('gardain_residence_address') }" id="gardain_residence_address" v-model="guardian_form.gardain_residence_address" placeholder="Residence Address"></textarea>
                                                <has-error :form="guardian_form" field="gardain_residence_address"></has-error>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <label>Occupation: </label>
                                                    <select v-model="guardian_form.gardain_occupation" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('gardain_occupation') }" class="form-control select2" name="occupation" id="gardain_occupation">
                                                        <option value=""> --Select--</option>
                                                        <option value="Civil Servant"> Civil Servant</option>
                                                        <option value="Private Employee"> Private Employee</option>
                                                        <option value="Business"> Business</option>
                                                        <option value="Farmer"> Farmer</option>
                                                    </select>
                                                <has-error :form="guardian_form" field="gardain_occupation"></has-error>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <label>Email Address:</label>
                                                <input type="text" class="form-control" @change="removeerror('gardain_email')" :class="{ 'is-invalid': guardian_form.errors.has('gardain_email') }" id="gardain_email" v-model="guardian_form.gardain_email" placeholder="Email Address">
                                                <has-error :form="guardian_form" field="gardain_email"></has-error>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <label>Contact No:</label>
                                                <input type="number" class="form-control" @change="removeerror('gardain_cntct_no')" :class="{ 'is-invalid': guardian_form.errors.has('gardain_cntct_no') }" id="gardain_cntct_no" v-model="guardian_form.gardain_cntct_no" placeholder="Contact No">
                                                <has-error :form="guardian_form" field="gardain_cntct_no"></has-error>
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
                                <button class="btn btn-flat btn-primary" @click="shownexttab('details-tab')"> submit <i class="fa fa-arrow-right"></i></button>
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
            s_dzongkhagList:[],
            s_schoolList:[],
            s_classList:[],
            sex_idList:[],
            dzongkhagList:[],
            std_gewog_list:[],
            std_school_list:[],
            std_class_list:[],
            p_father_gewog_list:[],
            father_gewog_list:[],
            p_mother_gewog_list:[],
            mother_gewog_list:[],
            p_gardain_gewog_list:[],
            gardain_gewog_list:[],
            std_villageList:[],
            p_father_villageList:[],
            father_villageList:[],
            p_mother_villageList:[],
            mother_villageList:[],
            p_gardain_villageList:[],
            gardain_villageList:[],
            motherTongueList:[],
            clasList:[],
            streamList:[],
            streamListSelected:[],
            studentTypeList:[],
            studentscholarshipList:[],
            studentbenefitList:[],
            sectionList:[],
            ppdob:'',
            eccddob:'',
            ppmonth:'',
            eccdmonth:'',
            student_form: new form({
                student_id:'',
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
                studentcode:'',
                attachments:'',
                orgType:'',
            }),

            school_form: new form({
                s_dzongkhag:'',
                s_school:'',
                s_class:'',
            }),


            guardian_form: new form({
                student_id:'',
                merital_status:'',
                primary_contact:'',
                type:'new',
                father_nationality:'Bhutanese',
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
                mother_nationality:'Bhutanese',
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
                gardain_nationality:'Bhutanese',
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
        }
    },
    methods: {
        onChangeFileUpload(e){
            this.student_form.attachments = e.target.files[0];
        },
        getChildDetailsbyCID(cid,type){
            this.student_form.cid_passport = cid;
            $('#cid_passport').prop('readonly',true);
            if(type=="std"){
                cid=  $('#cid').val();
            }
            this.getPersonalDetailsbyCID(cid,type);
            let fatherCid="";
            let motherCid="";
            if(type=='std'){
                axios.get('adminstratorController/getchildDetailsOncid/'+ cid)
                .then(response => {
                    fatherCid=response.data[0].fatherCID;
                    motherCid=response.data[0].motherCID;
                    this.getPersonalDetailsbyCID(fatherCid,'father');
                    this.getPersonalDetailsbyCID(motherCid,'mother');
                });
            }
        },
        getPersonalDetailsbyCID(cid,type){
            axios.get('adminstratorController/getpersonbycid/'+ cid)
            .then(res => {
                if(JSON.stringify(res.data)!='{}'){
                    alert(res);
                    if(type=="std" && res!=""){
                        $('#snationality').prop('checked',true);
                        this.form.snationality='Bhutanese';
                        let student_detail = res.data.citizenDetail[0];
                        this.student_form.first_name = student_detail.firstName;
                        $('#first_name').prop('readonly',true);
                        this.student_form.middle_name=student_detail.middleName;
                        $('#middle_name').prop('readonly',true);
                        this.student_form.last_name=student_detail.lastName;
                        $('#last_name').prop('readonly',true);
                        let date_of_birth = new Date(student_detail.dob);
                        let month =(date_of_birth .getMonth() + 1);
                        let day = date_of_birth .getDate();
                        if(day<10){
                            day='0'+day;
                        }
                        if(month<10){
                            month='0'+month;
                        }
                        let year =date_of_birth .getFullYear();
                        this.student_form.dob = year+ "-"+month + "-" + day;
                        $('#dob').val(year+ "-"+month + "-" + day);
                        $('#dob').prop('readonly',true);

                        if(student_detail.genter=="M"){
                            student_detail.genter="male";
                        }
                        else if(student_detail.genter=="F"){
                            student_detail.genter="female";
                        }
                        else{
                            student_detail.genter="others";
                        }
                        for(let i=0; i<this.sex_idList.length;i++){
                            if(this.sex_idList[i].name.toLowerCase()==student_detail.genter){
                                $('#sex_id').val(this.sex_idList[i].id).trigger('change');
                                this.student_form.sex_id =  this.sex_idList[i].id;
                                $('#sex_id').prop('disabled',true);
                            }
                        }

                        this.student_form.dzongkhag =student_detail.dzongkhagId;
                        $('#dzongkhag').val(student_detail.dzongkhagId).trigger('change');
                        $('#dzongkhag').prop('disabled',true);

                        this.getgewoglist(student_detail.dzongkhagId,'std');
                        this.student_form.gewog = student_detail.gewogId;
                        $('#gewog').prop('disabled',true);

                        this.getvillagelist(student_detail.gewogId,'std');
                        $('#village_id').val(student_detail.villageSerialNo).trigger('change');
                        this.student_form.village_id = student_detail.villageSerialNo;
                        $('#village_id').prop('disabled',true);
                    }
                    if(type=="father"){
                        if(personal_detail.genter=="F"){
                            Swal.fire({
                                html: "Genter of this person Female. Please provide correct CID",
                                icon: 'error'
                            });
                            this.guardian_form.father_first_name = "";
                            this.guardian_form.father_dzongkhag ="";
                            this.guardian_form.father_gewog = "";
                            this.guardian_form.father_village_id = "";
                        }
                        else{
                            let full_anme=personal_detail.firstName;
                            if(personal_detail.middleName!="" && personal_detail.middleName!=null){
                                full_anme+=' '+personal_detail.middleName;
                            }
                            full_anme+=' '+personal_detail.lastName;
                            this.guardian_form.father_first_name = full_anme;
                            $('#father_first_name').prop('readonly',true);
                            this.guardian_form.father_dzongkhag =personal_detail.dzongkhagId;
                            $('#father_dzongkhag').val(personal_detail.dzongkhagId).trigger('change');
                            $('#father_dzongkhag').prop('disabled',true);
                            this.getgewoglist(personal_detail.dzongkhagId,'p_father');
                            this.guardian_form.father_gewog = personal_detail.gewogId;
                            $('#father_gewog').val(personal_detail.gewogId).trigger('change');
                            $('#father_gewog').prop('disabled',true);
                            this.getvillagelist(personal_detail.gewogId,'p_father');
                            this.guardian_form.father_village_id = personal_detail.villageSerialNo;
                            $('#father_village_id').val(personal_detail.villageSerialNo).trigger('change');
                            $('#father_village_id').prop('disabled',true);
                        }
                            }
                    if(type=="mother"){

                    }
                }
            });
        },

        loadAllActiveMasters(type){
            axios.get('masters/loadGlobalMasters/'+type)
            .then(response =>{
                let data = response;
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

         getdzongkhagList(uri ='masters/loadGlobalMasters/all_active_dzongkhag'){
              axios.get(uri)
              .then(Response =>{
                let data = Response.data.data;
                this.s_dzongkhagList = data;

              }).catch(error => console.log(error));

          },
         getschoolList(id){
            let type=$('#orgType').val();
            let dzoId=$('#s_dzongkhag').val();
            if(id!=""){
                dzoId=id;
            }
            this.s_schoolList = [];
            let date2=new Date($('#dob').val());
            let year2=date2.getFullYear();
            let month2=date2.getMonth();
            let numberOfMonths;
            let isvalid=true;
            let messages="";
            alert(type+this.ppmonth);
            if(type=="ECCD"){
                let date1=new Date(this.eccddob);
                let year1=date1.getFullYear();
                let month1=date1.getMonth();
                if(month1===0){ //Have to take into account
                    month1++;
                    month2++;
                }
                //numberOfMonths = (year2 - year1) * 12 + (month2 - month1) - 1;//excluding both month1 and month2
                numberOfMonths = (year2 - year1) * 12 + (month2 - month1);//include either of the months
                //numberOfMonths = (year2 - year1) * 12 + (month2 - month1)+1;//include both of the months
                if(this.eccdmonth>numberOfMonths){
                    isvalid=false;
                }
                messages="From your DOB, you are just "+numberOfMonths+' months old. You are eligible to register only at the total month of '+this.eccdmonth;
            }
            else{
                let date1=new Date(this.ppdob);
                let year1=date1.getFullYear();
                let month1=date1.getMonth();
                if(month1===0){ //Have to take into account
                    month1++;
                    month2++;
                }
               // numberOfMonths = (year2 - year1) * 12 + (month2 - month1) - 1;//excluding both month1 and month2
                numberOfMonths = (year2 - year1) * 12 + (month2 - month1);//include either of the months
                //numberOfMonths = (year2 - year1) * 12 + (month2 - month1)+1;//include both of the months
                if(this.ppmonth> numberOfMonths){
                    isvalid=false;
                }
                messages="From your DOB, you are just "+numberOfMonths+' months old. You are eligible to register only at the total month of '+this.ppmonth;
            }
            if(isvalid==false){
                Swal.fire(
                    'Sorry',
                    messages,
                    'error',
                );
            }
            else{
                axios.get('/masters/getOrgList/'+dzoId+'/'+type)
                .then(Response =>{
                    let data = Response.data.data;
                    this.s_schoolList = data;
                })
            }
          },
         getclassList(id){
            let orgId=$('#school').val();
                if(id!=""){
                orgId=id;
            }
            this.classList = [];
              axios.get('/masters/loadClassStreamSection/school/' +orgId)
              .then(Response =>{
                let data = Response.data.data;
                this.s_classList = data;
            })
          },
          applyselect()
            {
                if(!$('#s_dzongkhag').attr('class').includes('select2-hidden-accessible')){
                 $('#s_dzongkhag').addClass('select2-hidden-accessible');
                }
                if(!$('#s_school').attr('class').includes('select2-hidden-accessible')){
                 $('#s_school').addClass('select2-hidden-accessible');
                }
                if(!$('#s_class').attr('class').includes('select2-hidden-accessible')){
                 $('#s_class').addClass('select2-hidden-accessible');
                }
            },
            removeerror(fieldid,errid){
            if($('#'+fieldid).val()!=""){
                $('#'+fieldid).removeClass('is-invalid');
                $('#'+errid).html('');
            }
        },
        getgewoglist(id,type){
            let dzoId=$('#dzongkhag').val();
            if(id!=""){
                dzoId=id;
            }
            let uri = 'masters/all_active_dropdowns/dzongkhag/'+dzoId;
            if(type=="std"){
                this.std_gewog_list =[];
            }
            if(type=="p_father"){
                this.p_father_gewog_list=[];
            }
            if(type=="father"){
                this.father_gewog_list=[];
            }
            if(type=="p_mother"){
                this.p_mother_gewog_list=[];
            }
            if(type=="mother"){
                this.mother_gewog_list=[];
            }
            if(type=="p_gardain"){
                this.p_gardain_gewog_list=[];
            }
            if(type=="gardain"){
                this.gardain_gewog_list=[];
            }
            axios.get(uri)
            .then(response =>{
                let data = response;
                if(type=="std"){
                    this.std_gewog_list = data.data.data;
                }
                if(type=="p_father"){
                    this.p_father_gewog_list=data.data.data;
                }
                if(type=="father"){
                    this.father_gewog_list=data.data.data;
                }
                if(type=="p_mother"){
                    this.p_mother_gewog_list=data.data.data;
                }
                if(type=="mother"){
                    this.mother_gewog_list=data.data.data;
                }
                if(type=="p_gardain"){
                    this.p_gardain_gewog_list=data.data.data;
                }
                if(type=="gardain"){
                    this.gardain_gewog_list=data.data.data;
                }
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        getvillagelist(id,type){
            let gewogId=$('#gewog').val();
            if(id!=""){
                gewogId=id;
            }
            let uri = 'masters/all_active_dropdowns/gewog/'+gewogId;
            if(type=="std"){
                this.std_villageList =[];
            }
            if(type=="p_father"){
                this.p_father_villageList=[];
            }
            if(type=="father"){
                this.father_villageList=[];
            }
            if(type=="p_mother"){
                this.p_mother_villageList=[];
            }
            if(type=="mother"){
                this.mother_villageList=[];
            }
            if(type=="p_gardain"){
                this.p_gardain_villageList=[];
            }
            if(type=="gardain"){
                this.gardain_villageList=[];
            }
            axios.get(uri)
            .then(response =>{
                let data = response;
                if(type=="std"){
                    this.std_villageList = data.data.data;
                }
                if(type=="p_father"){
                    this.p_father_villageList=data.data.data;
                }
                if(type=="father"){
                    this.father_villageList=data.data.data;
                }
                if(type=="p_mother"){
                    this.p_mother_villageList=data.data.data;
                }
                if(type=="mother"){
                    this.mother_villageList=data.data.data;
                }
                if(type=="p_gardain"){
                    this.p_gardain_villageList=data.data.data;
                }
                if(type=="gardain"){
                    this.gardain_villageList=data.data.data;
                }

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
                this.clasList=data.data.data.class_section;
                this.streamList=data.data.data.sections;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },

        shownexttab(nextclass){
            // if(nextclass=="basic-tabs"){
            //     this.changetab('basic-tabs');
            // }
            if(nextclass=="guardians-tab"){
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }
                let formData = new FormData();
                formData.append('snationality', this.student_form.snationality);
                formData.append('student_id', this.student_form.student_id);
                formData.append('cid_passport', this.student_form.cid_passport);
                formData.append('first_name', this.student_form.first_name);
                formData.append('middle_name', this.student_form.middle_name);
                formData.append('last_name', this.student_form.last_name);
                formData.append('dob', this.student_form.dob);
                formData.append('sex_id', this.student_form.sex_id);
                formData.append('dzongkhag', this.student_form.dzongkhag);
                formData.append('gewog', this.student_form.gewog);
                formData.append('village_id', this.student_form.village_id);
                formData.append('s_dzongkhag', this.school_form.s_dzongkhag);
                formData.append('s_school', this.school_form.s_school);
                formData.append('s_class', this.school_form.s_class);
                formData.append('type','new');
                formData.append('Status', 'pending');
                axios.post('/saveStudentDetailsFromPortal',formData, config)
                .then((response) => {
                    this.guardian_form.student_id=response.data.id;
                    Toast.fire({
                        icon: 'success',
                        title: 'Student student Details has been saved successfully'
                    })
                    this.changetab(nextclass);
                })
                .catch((error) => {
                    Toast.fire({
                        icon: 'error',
                        title: 'Unexpected error occured. Please provide all fields marked with *.'
                    });
                    this.applyselect('std');
                    console.log("Error:"+error);
                    this.changetab('basic-tabs');
                })
            }
            if(nextclass=="details-tab"){
                this.guardian_form.primary_contact=$("input[type='radio'][name='primary_contact']:checked").val();
                this.guardian_form.post('/saveStudentGardianDetails')
                .then((response) => {
                    Swal.fire(
                        'Submitted!',
                        'The details has been saved successfully.',
                        'success',
                    );
                    this.$Progress.start();
                    this.$router.push({name:'list_new_admission_transfer'});
                    this.$Progress.finish();
                })
                .catch((error) => {
                    Toast.fire({
                        icon: 'error',
                        title: 'Unexpected error occured. Try again.'
                    });
                    this.changetab('guardians-tab');
                    this.applyselect('guardian');
                    console.log("Error:"+error);
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
        applyselect(type){
            if(type=="std"){
                if(!$('#sex_id').attr('class').includes('select2-hidden-accessible')){
                    $('#sex_id').addClass('select2-hidden-accessible');
                }
                if(!$('#dzongkhag').attr('class').includes('select2-hidden-accessible')){
                    $('#dzongkhag').addClass('select2-hidden-accessible');
                }
                if(!$('#gewog').attr('class').includes('select2-hidden-accessible')){
                    $('#gewog').addClass('select2-hidden-accessible');
                }
                if(!$('#class').attr('class').includes('select2-hidden-accessible')){
                    $('#class').addClass('select2-hidden-accessible');
                }
            }
            if(type=="guardian"){
                if(!$('#merital_status').attr('class').includes('select2-hidden-accessible')){
                    $('#merital_status').addClass('select2-hidden-accessible');
                }
                if(!$('#father_dzongkhag').attr('class').includes('select2-hidden-accessible')){
                    $('#father_dzongkhag').addClass('select2-hidden-accessible');
                }
                if(!$('#father_gewog').attr('class').includes('select2-hidden-accessible')){
                    $('#father_gewog').addClass('select2-hidden-accessible');
                }
                if(!$('#father_village_id').attr('class').includes('select2-hidden-accessible')){
                    $('#father_village_id').addClass('select2-hidden-accessible');
                }
                if(!$('#father_present_dzongkhag').attr('class').includes('select2-hidden-accessible')){
                    $('#father_present_dzongkhag').addClass('select2-hidden-accessible');
                }
                if(!$('#father_present_gewog').attr('class').includes('select2-hidden-accessible')){
                    $('#father_present_gewog').addClass('select2-hidden-accessible');
                }
                if(!$('#father_present_village_id').attr('class').includes('select2-hidden-accessible')){
                    $('#father_present_village_id').addClass('select2-hidden-accessible');
                }
                if(!$('#father_occupation').attr('class').includes('select2-hidden-accessible')){
                    $('#father_occupation').addClass('select2-hidden-accessible');
                }

                if(!$('#mother_dzongkhag').attr('class').includes('select2-hidden-accessible')){
                    $('#mother_dzongkhag').addClass('select2-hidden-accessible');
                }
                if(!$('#mother_gewog').attr('class').includes('select2-hidden-accessible')){
                    $('#mother_gewog').addClass('select2-hidden-accessible');
                }
                if(!$('#mother_village_id').attr('class').includes('select2-hidden-accessible')){
                    $('#mother_village_id').addClass('select2-hidden-accessible');
                }
                if(!$('#mother_present_dzongkhag').attr('class').includes('select2-hidden-accessible')){
                    $('#mother_present_dzongkhag').addClass('select2-hidden-accessible');
                }
                if(!$('#mother_present_gewog').attr('class').includes('select2-hidden-accessible')){
                    $('#mother_present_gewog').addClass('select2-hidden-accessible');
                }
                if(!$('#mother_present_village_id').attr('class').includes('select2-hidden-accessible')){
                    $('#mother_present_village_id').addClass('select2-hidden-accessible');
                }
                if(!$('#mother_occupation').attr('class').includes('select2-hidden-accessible')){
                    $('#mother_occupation').addClass('select2-hidden-accessible');
                }

                if(!$('#gardain_dzongkhag').attr('class').includes('select2-hidden-accessible')){
                    $('#gardain_dzongkhag').addClass('select2-hidden-accessible');
                }
                if(!$('#gardain_gewog').attr('class').includes('select2-hidden-accessible')){
                    $('#gardain_gewog').addClass('select2-hidden-accessible');
                }
                if(!$('#gardain_village_id').attr('class').includes('select2-hidden-accessible')){
                    $('#gardain_village_id').addClass('select2-hidden-accessible');
                }
                 if(!$('#gardain_present_dzongkhag').attr('class').includes('select2-hidden-accessible')){
                    $('#gardain_present_dzongkhag').addClass('select2-hidden-accessible');
                }
                if(!$('#gardain_present_gewog').attr('class').includes('select2-hidden-accessible')){
                    $('#gardain_present_gewog').addClass('select2-hidden-accessible');
                }
                if(!$('#gardain_present_village_id').attr('class').includes('select2-hidden-accessible')){
                    $('#gardain_present_village_id').addClass('select2-hidden-accessible');
                }
                if(!$('#gardain_occupation').attr('class').includes('select2-hidden-accessible')){
                    $('#gardain_occupation').addClass('select2-hidden-accessible');
                }
            }

        },


        removeerror(fieldid,errid){
            if($('#'+fieldid).val()!=""){
                $('#'+fieldid).removeClass('is-invalid');
                $('#'+errid).html('');
            }
        },
        changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="s_dzongkhag"){
                this.school_form.s_dzongkhag=$('#s_dzongkhag').val();
                this.getschoolList($('#s_dzongkhag').val());

            }
            if(id=="s_school"){
                this.school_form.s_school=$('#s_school').val();
                this.getclassList($('#s_school').val());
            }
            if(id=="s_class"){
                this.school_form.s_class=$('#s_class').val();

            }

            if(id=="sex_id"){
                this.student_form.sex_id=$('#sex_id').val();
            }
            if(id=="dzongkhag"){
                this.student_form.dzongkhag=$('#dzongkhag').val();
                this.getgewoglist($('#dzongkhag').val(),'std');
            }
            if(id=="gewog"){
                this.student_form.gewog=$('#gewog').val();
                this.getvillagelist($('#gewog').val(),'std');
            }
            if(id=="village_id"){
                this.student_form.village_id=$('#village_id').val();
            }


            if(id=="merital_status"){
                this.guardian_form.merital_status=$('#merital_status').val();
            }
            if(id=="father_dzongkhag"){
                this.guardian_form.father_dzongkhag=$('#father_dzongkhag').val();
                this.getgewoglist($('#father_dzongkhag').val(),'p_father');
            }

            if(id=="father_gewog"){
                this.guardian_form.father_gewog=$('#father_gewog').val();
                this.getvillagelist($('#father_gewog').val(),'p_father');
            }
            if(id=="father_village_id"){
                this.guardian_form.father_village_id=$('#father_village_id').val();
            }
            if(id=="father_present_dzongkhag"){
                this.guardian_form.father_present_dzongkhag=$('#father_present_dzongkhag').val();
                this.getgewoglist($('#father_present_dzongkhag').val(),'father');
            }
            if(id=="father_present_gewog"){
                this.guardian_form.father_present_gewog=$('#father_present_gewog').val();
                this.getvillagelist($('#father_present_gewog').val(),'father');
            }
            if(id=="father_present_village_id"){
                this.guardian_form.father_present_village_id=$('#father_present_village_id').val();
            }
            if(id=="father_occupation"){
                this.guardian_form.father_occupation=$('#father_occupation').val();
            }

            if(id=="mother_dzongkhag"){
                this.guardian_form.mother_dzongkhag=$('#mother_dzongkhag').val();
                this.getgewoglist($('#mother_dzongkhag').val(),'p_mother');
            }
            if(id=="mother_gewog"){
                this.guardian_form.mother_gewog=$('#mother_gewog').val();
                this.getvillagelist($('#mother_gewog').val(),'p_mother');
            }
            if(id=="mother_village_id"){
                this.guardian_form.mother_village_id=$('#mother_village_id').val();
            }
            if(id=="mother_present_dzongkhag"){
                this.guardian_form.mother_present_dzongkhag=$('#mother_present_dzongkhag').val();
                this.getgewoglist($('#mother_present_dzongkhag').val(),'mother');
            }
            if(id=="mother_present_gewog"){
                this.guardian_form.mother_present_gewog=$('#mother_present_gewog').val();
                this.getvillagelist($('#mother_present_gewog').val(),'mother');
            }
            if(id=="mother_present_village_id"){
                this.guardian_form.mother_present_village_id=$('#mother_present_village_id').val();
            }
            if(id=="mother_occupation"){
                this.guardian_form.mother_occupation=$('#mother_occupation').val();
            }

            if(id=="gardain_dzongkhag"){
                this.guardian_form.gardain_dzongkhag=$('#gardain_dzongkhag').val();
                this.getgewoglist($('#gardain_dzongkhag').val(),'p_gardain');
            }
            if(id=="gardain_gewog"){
                this.guardian_form.gardain_gewog=$('#gardain_gewog').val();
                this.getvillagelist($('#gardain_gewog').val(),'p_gardain');
            }
            if(id=="gardain_village_id"){
                this.guardian_form.gardain_village_id=$('#gardain_village_id').val();
            }
            if(id=="gardain_present_dzongkhag"){
                this.guardian_form.gardain_present_dzongkhag=$('#gardain_present_dzongkhag').val();
                this.getgewoglist($('#gardain_present_dzongkhag').val(),'gardain');
            }
            if(id=="gardain_present_gewog"){
                this.guardian_form.gardain_present_gewog=$('#gardain_present_gewog').val();
                this.getvillagelist($('#gardain_present_gewog').val(),'gardain');
            }
            if(id=="gardain_present_village_id"){
                this.guardian_form.gardain_present_village_id=$('#gardain_present_village_id').val();
            }
            if(id=="gardain_occupation"){
                this.guardian_form.gardain_occupation=$('#gardain_occupation').val();
            }
            if(id=="orgType"){
                this.guardian_form.orgType=$('#orgType').val();
            }

        },
        showstdidentity:function(type){
            $('#dzo_gewog_village').hide();
            $('#permanentAddr').hide();
            if(type=="Student-Non-Bhutanese"){
                $('#level_name').html('Immigration/Passport/Other Identification No: *');
                $('#permanentAddr').show();
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
        },
        loadVlidation(){
            let uri='masters/loadValidationcondition';
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.ppdob=data.date;
                this.eccddob=data.date1;
                this.ppmonth=data.no_months;
                this.eccdmonth=data.no_months1;
            })
            .catch(function (error) {
                console.log('error: '+error);
            });
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
        this.loadAllActiveMasters('all_active_gender');
        this.loadAllActiveMasters('all_active_dzongkhag');
        this.getdzongkhagList();
    },

    created() {
        this.loadVlidation();
         let cid=this.$route.query.cid;
         this.getChildDetailsbyCID(cid,'std');
         this.getdzongkhagList();
        //  this.getschoolList();
         this.getclassList();
    }

}
</script>
