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
                    <!-- <li class="nav-item details-tab"  @click="shownexttab('details-tab')">
                        <a class="nav-link"  id="details-tab-head" data-toggle="pill" href="#details-tab" role="tab" aria-controls="custom-tabs-four-details" aria-selected="false">
                            <label>Other Details</label>
                        </a>
                    </li>   -->
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="basic-tabs" role="tabpanel" aria-labelledby="basicdetails">
                        <form id="admission_form" class="form-horizontal" enctype="multipart/form-data" action="#" method="POST">
                            <div class="row form-group">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label> Student Nationality:<span class="text-danger">*</span></label><br>
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
                                                    <input type="text" class="form-control" @keyup.enter="getDetailsbyCID('cid_passport','std')" @change="removeerror('cid_passport')" :class="{ 'is-invalid': personal_form.errors.has('cid_passport') }" id="cid_passport" v-model="personal_form.cid_passport" placeholder="Identification No">
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
                                                        <option v-for="(item, index) in std_gewog_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                    </select>
                                                    <has-error :form="personal_form" field="gewog"></has-error>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label>Village: </label>
                                                    <select v-model="personal_form.village_id" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('village_id') }" class="form-control select2" name="village_id" id="village_id">
                                                        <option value=""> --Select--</option>
                                                        <option v-for="(item, index) in std_villageList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
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
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Please Select the Class for Admission:<span class="text-danger">*</span></label>
                                    <select v-model="personal_form.std_class" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('std_class') }"  class="form-control select2" name="std_class" id="std_class">
                                        <option v-for="(item, index) in classList" :key="index" v-bind:value="item.id">{{ item.class }}</option>
                                    </select>
                                    <has-error :form="personal_form" field="std_class"></has-error>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Mother Tongue:<span class="text-danger">*</span></label>
                                    <select v-model="personal_form.mother_tongue" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('mother_tongue') }" class="form-control select2" name="mother_tongue" id="mother_tongue">
                                        <option value=""> --Select--</option>
                                        <option v-for="(item, index) in motherTongueList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                    </select>
                                    <has-error :form="personal_form" field="mother_tongue"></has-error>
                                </div>
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
                                    <option value="Divorce">Married</option>
                                    <option value="Divorce">Divorce</option>
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
                        <hr>
                        <div class="row form-group">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <dt><u>Father's Details</u></dt>
                                <div class="row form-group">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>  Nationality:</label><br>
                                        <input type="radio" v-model="guardian_form.father_nationality" value="Bhutanese" @click="showfathersidentity('bhutanese')" name="father_nationality" id="father_nationality" checked> Bhutanese
                                        <input type="radio" v-model="guardian_form.father_nationality" value="Foreign" @click="showfathersidentity('foreign')" name="father_nationality" id="father_nationality1"> Non-Bhutanese
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label >Name:<span class="text-danger">*</span> </label>
                                        <input type="text" v-model="guardian_form.father_first_name" class="form-control" @change="removeerror('father_first_name')" :class="{ 'is-invalid': guardian_form.errors.has('father_first_name') }" id="father_first_name" placeholder="Name">
                                        <has-error :form="guardian_form" field="father_first_name"></has-error>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Father's CID, Immigration ID/Other Document ID  </label>
                                        <input type="text" v-model="guardian_form.father_cid_passport" class="form-control" @keyup.enter="getDetailsbyCID('father_cid_passport','father')" @blur="getDetailsbyCID('father_cid_passport','father')" @change="removeerror('father_cid_passport')" :class="{ 'is-invalid': guardian_form.errors.has('father_cid_passport') }" id="father_cid_passport" placeholder="Identification No">
                                        <has-error :form="guardian_form" field="father_cid_passport"></has-error>
                                    </div>
                                </div>
                                <!-- <div class="row form-group" id="father_type" style="display:none">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label >Please Specify Type:</label>
                                        <input type="text" class="form-control" @change="removeerror('first_name')" :class="{ 'is-invalid': guardian_form.errors.has('type') }" id="type" v-model="guardian_form.parent_details.type" placeholder="Country Diplomat, Expriate etc">
                                        <has-error :form="guardian_form" field="type"></has-error>
                                    </div>
                                </div> -->
                                <div class="row form-group" id="father_dzo_gewog_village">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Dzongkhag/Thromde: </label>
                                        <select v-model="guardian_form.father_dzongkhag" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('father_dzongkhag') }" class="form-control select2" name="father_dzongkhag" id="father_dzongkhag">
                                            <option value=""> --Select--</option>
                                            <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                        </select>
                                        <has-error :form="guardian_form" field="father_dzongkhag"></has-error>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label> Gewog:</label>
                                        <select v-model="guardian_form.father_gewog" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('father_gewog') }" class="form-control select2" name="father_gewog" id="father_gewog">
                                            <option value=""> --Select--</option>
                                            <option v-for="(item, index) in p_father_gewog_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                        </select>
                                        <has-error :form="guardian_form" field="father_gewog"></has-error>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
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
                                        <label >Permanent Address: </label><small><i>(For Non-Nationals)</i></small>
                                        <textarea class="form-control" @change="removeerror('father_fulladdress')" :class="{ 'is-invalid': guardian_form.errors.has('father_fulladdress') }" id="father_fulladdress" v-model="guardian_form.father_fulladdress" placeholder="Permanent Address"></textarea>
                                        <has-error :form="guardian_form" field="father_fulladdress"></has-error>
                                    </div>
                                </div>
                                <label><u> Present Address</u></label>
                                <div class="row form-group">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Dzongkhag/Thromde: </label>
                                        <select v-model="guardian_form.father_present_dzongkhag" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('father_present_dzongkhag') }" class="form-control select2" name="father_present_dzongkhag" id="father_present_dzongkhag">
                                            <option value=""> --Select--</option>
                                            <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                        </select>
                                        <has-error :form="guardian_form" field="father_present_dzongkhag"></has-error>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label> Gewog:</label>
                                        <select v-model="guardian_form.father_present_gewog" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('father_present_gewog') }" class="form-control select2" name="father_present_gewog" id="father_present_gewog">
                                            <option value=""> --Select--</option>
                                            <option v-for="(item, index) in father_gewog_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                        </select>
                                        <has-error :form="guardian_form" field="father_present_gewog"></has-error>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
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
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
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
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Email Address:</label>
                                        <input type="text" class="form-control" @change="removeerror('father_email')" :class="{ 'is-invalid': guardian_form.errors.has('father_email') }" id="father_email" v-model="guardian_form.father_email" placeholder="Email Address">
                                        <has-error :form="guardian_form" field="father_email"></has-error>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Contact No:</label>
                                        <input type="number" class="form-control" @change="removeerror('father_conact_no')" :class="{ 'is-invalid': guardian_form.errors.has('father_cntct_no') }" id="father_conact_no" v-model="guardian_form.father_cntct_no" placeholder="Contact No">
                                        <has-error :form="guardian_form" field="father_conact_no"></has-error>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <dt><u>Mother's Details</u></dt>
                                <div class="row form-group">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>  Nationality:</label><br>
                                        <input type="radio" value="Bhutanese" v-model="guardian_form.mother_nationality" @click="showmothersidentity('bhutanese')" name="mother_nationality" id="mother_nationality" checked> Bhutanese
                                        <input type="radio" value="Foreign" v-model="guardian_form.mother_nationality" @click="showmothersidentity('foreign')" name="mother_nationality" id="mother_nationality1"> Non-Bhutanese
                                    </div>
                                    
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label >Name:<span class="text-danger">*</span> </label>
                                        <input type="text" class="form-control" @change="removeerror('mother_first_name')" :class="{ 'is-invalid': guardian_form.errors.has('mother_first_name') }" id="mother_first_name" v-model="guardian_form.mother_first_name" placeholder="Name">
                                        <has-error :form="guardian_form" field="mother_first_name"></has-error>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Mother's CID, Immigration ID/Other Document  </label>
                                        <input type="text" v-model="guardian_form.mother_cid_passport" class="form-control" @keyup.enter="getDetailsbyCID('mother_cid_passport','mother')" @blur="getDetailsbyCID('mother_cid_passport','mother')" @change="removeerror('mother_cid_passport')" :class="{ 'is-invalid': guardian_form.errors.has('mother_cid_passport') }" id="mother_cid_passport" placeholder="Identification No">
                                        <has-error :form="guardian_form" field="mother_cid_passport"></has-error>
                                    </div>
                                </div>
                                <!-- <div class="row form-group" id="father_type" style="display:none">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label >Please Specify Type:</label>
                                        <input type="text" class="form-control" @change="removeerror('first_name')" :class="{ 'is-invalid': guardian_form.errors.has('type') }" id="type" v-model="guardian_form.parent_details.type" placeholder="Country Diplomat, Expriate etc">
                                        <has-error :form="guardian_form" field="type"></has-error>
                                    </div>
                                </div> -->
                                <div class="row form-group" id="mothers_dzo_gewog_village">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Dzongkhag/Thromde: </label>
                                        <select v-model="guardian_form.mother_dzongkhag" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('mother_dzongkhag') }" class="form-control select2" name="mother_dzongkhag" id="mother_dzongkhag">
                                            <option value=""> --Select--</option>
                                            <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                        </select>
                                        <has-error :form="guardian_form" field="mother_dzongkhag"></has-error>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label> Gewog:</label>
                                        <select v-model="guardian_form.mother_gewog" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('mother_gewog') }" class="form-control select2" name="mother_gewog" id="mother_gewog">
                                            <option value=""> --Select--</option>
                                            <option v-for="(item, index) in p_mother_gewog_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                        </select>
                                        <has-error :form="guardian_form" field="mother_gewog"></has-error>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
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
                                        <label>Permanent Address: </label><small><i>(For Non-Nationals)</i></small>
                                        <textarea class="form-control" @change="removeerror('mother_fulladdress')" :class="{ 'is-invalid': guardian_form.errors.has('mother_fulladdress') }" id="mother_fulladdress" v-model="guardian_form.mother_fulladdress" placeholder="Permanent Address"></textarea>
                                        <has-error :form="guardian_form" field="mother_fulladdress"></has-error>
                                    </div>
                                </div>
                                <label><u> Present Address</u></label>
                                <div class="row form-group">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Dzongkhag/Thromde: </label>
                                        <select v-model="guardian_form.mother_present_dzongkhag" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('mother_present_dzongkhag') }" class="form-control select2" name="mother_present_dzongkhag" id="mother_present_dzongkhag">
                                            <option value=""> --Select--</option>
                                            <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                        </select>
                                        <has-error :form="guardian_form" field="mother_present_dzongkhag"></has-error>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label> Gewog:</label>
                                        <select v-model="guardian_form.mother_present_gewog" :class="{ 'is-invalid select2 select2-hidden-accessible': guardian_form.errors.has('mother_present_gewog') }" class="form-control select2" name="mother_present_gewog" id="mother_present_gewog">
                                            <option value=""> --Select--</option>
                                            <option v-for="(item, index) in mother_gewog_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                        </select>
                                        <has-error :form="guardian_form" field="mother_present_gewog"></has-error>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
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
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
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
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Email Address:</label>
                                        <input type="text" class="form-control" @change="removeerror('mother_email')" :class="{ 'is-invalid': guardian_form.errors.has('mother_email') }" id="mother_email" v-model="guardian_form.mother_email" placeholder="Email Address">
                                        <has-error :form="guardian_form" field="mother_email"></has-error>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Contact No:</label>
                                        <input type="number" class="form-control" @change="removeerror('mother_cntct_no')" :class="{ 'is-invalid': guardian_form.errors.has('mother_cntct_no') }" id="mother_cntct_no" v-model="guardian_form.mother_cntct_no" placeholder="Contact No">
                                        <has-error :form="guardian_form" field="mother_cntct_no"></has-error>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group" style="display:none" id="gardain_section">
                            <div class="card-body">
                                <dt>Guardian's Details</dt>
                                <div class="row form-group">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Nationality:</label><br>
                                        <input type="radio" value="Bhutanese" v-model="guardian_form.gardain_nationality" @click="showgardainsidentity('bhutanese')" name="gardain_nationality" id="gardain_nationality" checked> Bhutanese
                                        <input type="radio" value="Foreign" v-model="guardian_form.gardain_nationality" @click="showgardainsidentity('foreign')" name="gardain_nationality" id="gardain_nationality1"> Non-Bhutanese
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label >Name:<span class="text-danger">*</span> </label>
                                        <input type="text" class="form-control" @change="removeerror('gardain_first_name')" :class="{ 'is-invalid': guardian_form.errors.has('gardain_first_name') }" id="gardain_first_name" v-model="guardian_form.gardain_first_name" placeholder="Name">
                                        <has-error :form="guardian_form" field="gardain_first_name"></has-error>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>CID, Immigration ID/Other Document ID  </label>
                                        <input type="text" v-model="guardian_form.gardain_cid_passport" class="form-control" @keyup.enter="getDetailsbyCID('gardain_cid_passport','gardain')" @blur="getDetailsbyCID('gardain_cid_passport','gardain')" @change="removeerror('gardain_cid_passport')" :class="{ 'is-invalid': guardian_form.errors.has('gardain_cid_passport') }" id="gardain_cid_passport" placeholder="Identification No">
                                        <has-error :form="guardian_form" field="gardain_cid_passport"></has-error>
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
                                        <label >Permanent Address: </label><small><i>(For Non-Nationals)</i></small>
                                        <textarea class="form-control" @change="removeerror('gardain_fulladdress')" :class="{ 'is-invalid': guardian_form.errors.has('gardain_fulladdress') }" id="gardain_fulladdress" v-model="guardian_form.gardain_fulladdress" placeholder="Permanent Address"></textarea>
                                        <has-error :form="guardian_form" field="gardain_fulladdress"></has-error>
                                    </div>
                                </div>
                                <label><u> Present Address</u></label>
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
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-flat btn-success"  @click="shownexttab('basic-tabs')"><i class="fa fa-arrow-left"></i> Previous </button>
                                <button class="btn btn-flat btn-primary" @click="submitfinalform('details-tab')"> Submit <i class="fa fa-arrow-save"></i></button>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="tab-pane fade tab-content-details" id="details-tab" role="tabpanel" aria-labelledby="custom-tabs-four-details">
                        <div id="schoolsections">
                            <dt>Class Details</dt>
                            <hr>
                            <div class="row form-group">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Student Class: <span class="text-danger">*</span></label>
                                    <select v-model="class_form.class" :class="{ 'is-invalid select2 select2-hidden-accessible': class_form.errors.has('class') }" class="form-control select2" name="class" id="class">
                                        <option value=""> --Select--</option>
                                        <option v-for="(item, index) in clasList" :key="index" v-bind:value="item.id">{{ item.class_name }}</option>
                                    </select>
                                    <has-error :form="class_form" field="class"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="stream_section" style="display:none">
                                    <label>Stream:</label>
                                    <select v-model="class_form.stream" :class="{ 'is-invalid select2 select2-hidden-accessible': class_form.errors.has('stream') }" class="form-control select2" name="stream" id="stream">
                                        <option value=""> --Select--</option>
                                        <option v-for="(item, index) in streamListSelected" :key="index" v-bind:value="item.record_id">{{ item.stream }}</option>
                                    </select>
                                    <has-error :form="class_form" field="stream"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Section: <span class="text-danger">*</span></label>
                                     <select v-model="class_form.section" :class="{ 'is-invalid select2 select2-hidden-accessible': class_form.errors.has('section') }" class="form-control select2" name="section" id="section">
                                        <option value=""> --Select--</option>
                                        <option v-for="(item, index) in sectionList" :key="index" v-bind:value="item.id">{{ item.section }}</option>
                                    </select>
                                    <has-error :form="class_form" field="section"></has-error>
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
                                    <label>No of Meals: <span class="text-danger">*</span></label><br>
                                    <input type="radio" name="no_meals" :class="{ 'is-invalid': class_form.errors.has('no_meals') }" v-model="class_form.no_meals" value="1" id="no_meals1"> One
                                    <input type="radio" class="ml-4" :class="{ 'is-invalid': class_form.errors.has('no_meals') }" name="no_meals" v-model="class_form.no_meals" value="2" id="no_meals2"> Two
                                    <input type="radio" class="ml-4" :class="{ 'is-invalid': class_form.errors.has('no_meals') }" name="no_meals" v-model="class_form.no_meals" value="3" id="no_meals3"> Three
                                    <input type="radio" class="ml-4" :class="{ 'is-invalid': class_form.errors.has('no_meals') }" name="no_meals" v-model="class_form.no_meals" value="0" id="no_meals3"> None
                                    <has-error :form="class_form" field="no_meals"></has-error>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Category: <span class="text-danger">*</span></label><br>
                                    <input type="radio" name="meal_type" :class="{ 'is-invalid': class_form.errors.has('meal_type') }" v-model="class_form.meal_type" value="Gyalpoi Tozey" id="meal_type"> Gyalpoi Tozey
                                    <input type="radio" class="ml-4" :class="{ 'is-invalid': class_form.errors.has('meal_type') }" name="meal_type" v-model="class_form.meal_type" value="Needy Student" id="meal_type1"> Needy Student
                                    <has-error :form="class_form" field="meal_type"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Feeding Type: <span class="text-danger">*</span></label><br>
                                    <input type="radio" name="feeding_type" :class="{ 'is-invalid': class_form.errors.has('feeding_type') }" v-model="class_form.feeding_type" value="Vegeterian" id="feeding_type"> Vegeterian
                                    <input type="radio" class="ml-4" :class="{ 'is-invalid': class_form.errors.has('feeding_type') }" name="feeding_type" v-model="class_form.feeding_type" value="Non-vegeterian" id="feeding_type1"> Non-vegeterian
                                    <input type="radio" class="ml-4" :class="{ 'is-invalid': class_form.errors.has('feeding_type') }" name="feeding_type" v-model="class_form.feeding_type" value="Eggeterian" id="feeding_type2"> Eggeterian
                                    <has-error :form="class_form" field="feeding_type"></has-error>
                                </div>
                            </div>
                            <br>
                            <label>Scholarship</label>
                            <div class="row form-group">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-for="(item, index) in studentscholarshipList" :key="index">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" name="scholarship" :id="'customCheckbox'+index" v-model="class_form.scholarship" type="checkbox" :value="item.id">
                                        <label :for="'customCheckbox'+index" name="scholarship" class="font-weight-normal custom-control-label">{{item.name}}</label>
                                    </div>
                                </div>
                            </div>
                            <label>Special Benefits</label>
                            <div class="row form-group">
                                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-for="(item, index) in studentbenefitList" :key="index">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" name="special_benifit" :id="'benefits'+index" v-model="class_form.special_benifit" type="checkbox" :value="item.id">
                                        <label :for="'benefits'+index" class="font-weight-normal custom-control-label">{{item.name}}</label>
                                    </div>
                                </div>
                            </div>
                            <label> Do you think the children/student has a disability? (Eg: difficulty seeing, hearing, walking,
                                learning or remembering, focusing, with fine motor skills, self care, being understood, controlling behavior, socializing or playing) </label>
                            <div class="row form-group">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <input type="radio" name="disability" :class="{ 'is-invalid': class_form.errors.has('disability') }" v-model="class_form.disability" value="Yes" id="no_meals1"> Yes
                                    <input type="radio" class="ml-4" :class="{ 'is-invalid': class_form.errors.has('disability') }" name="disability" v-model="class_form.disability" value="No" id="no_meals2"> No
                                    <has-error :form="class_form" field="disability"></has-error>
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
                    </div> -->
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
            std_gewog_list:[],
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
            classList:[],
            clasList:[],
            streamList:[],
            streamListSelected:[],
            studentTypeList:[],
            studentscholarshipList:[],
            studentbenefitList:[],
            sectionList:[],
            personal_form: new form({
                student_id:'',
                std_class:'',
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
                student_id:'',
                merital_status:'',
                primary_contact:'',
                type:'edit',

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
            this.personal_form.attachments = e.target.files[0];
        },
        getDetailsbyCID(cid,type){
            let selectedVal="";
            let selected ="";
            if(type=="std"){
                selected = $("input[type='radio'][name='snationality']:checked");
                if(selected.length > 0) {
                    selectedVal=selected.val();
                }
                else{
                    Swal.fire({
                        html: "Please select nationality",
                        icon: 'error'
                    });
                }
            }
            if(selectedVal.includes('Bhutan')){
                if ($('#'+cid).val().length != 11){
                    Swal.fire({
                        html: "Please enter 11 digit CID",
                        icon: 'error'
                    });
                }
                else{
                    this.getPersonalDetailsbyCID($('#'+cid).val(),type);
                    let fatherCid="";
                    let motherCid="";
                    if(type=='std'){
                        axios.get('getchildDetailsOncid/'+ $('#'+cid).val())
                        .then(response => {
                            let data=response.data.data;
                            fatherCid=data.parentDetail[0].fatherCID;
                            motherCid=data.parentDetail[0].motherCID;
                            this.getPersonalDetailsbyCID(fatherCid,'father');
                            this.getPersonalDetailsbyCID(motherCid,'mother');
                        });
                    }
                }
            }            
        },
        getPersonalDetailsbyCID(cidNo,type){
            // if(type=="father"){
            //     selected = $("input[type='radio'][name='father_nationality']:checked");
            // }
            // if(type=="mother"){
            //     selected = $("input[type='radio'][name='mother_nationality']:checked");
            // }
            // if(type=="gardain"){
            //     selected = $("input[type='radio'][name='gardain_nationality']:checked");
            // }
            
            axios.get('getpersonbycid/'+ cidNo)
            .then(response => {
                if (response.data) {
                    let personal_detail = response.data;
                    if(type=="std"){
                        this.personal_form.first_name = personal_detail.firstName;
                        $('#first_name').prop('readonly',true);
                        this.personal_form.middle_name=personal_detail.middleName;
                        $('#middle_name').prop('readonly',true);
                        this.personal_form.last_name=personal_detail.lastName;
                        $('#last_name').prop('readonly',true);
                        let dob=personal_detail.dob;
                        if(dob.includes('-')){
                            dob=dob.split('-')[2]+'-'+dob.split('-')[1]+'-'+dob.split('-')[0];
                        }
                        if(dob.includes('/')){
                            dob=dob.split('/')[2]+'-'+dob.split('/')[1]+'-'+dob.split('/')[0];
                        }
                        this.personal_form.dob = dob;

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
                        this.getgewoglist(personal_detail.dzongkhagId,'std');
                        this.personal_form.gewog = personal_detail.gewogId;
                        $('#gewog').prop('disabled',true);
                        this.getvillagelist(personal_detail.gewogId,'std');
                        $('#village_id').val(personal_detail.villageSerialNo).trigger('change');
                        this.personal_form.village_id = personal_detail.villageSerialNo;
                        $('#village_id').prop('disabled',true);
                    }
                    if(type=="father"){
                        let father_detail = response.data;
                        let full_name=father_detail.firstName;
                        if(father_detail.middleName!="" && father_detail.middleName!=null){
                            full_name+=' '+father_detail.middleName;
                        }
                        full_name+=' '+father_detail.lastName;
                        this.guardian_form.father_first_name = full_name;
                        $('#father_first_name').prop('readonly',true);
                        this.guardian_form.father_cid_passport = father_detail.cid;
                        $('#father_cid_passport').prop('readonly',true);
                        let dob=personal_detail.dob;
                        if(dob.includes('-')){
                            dob=dob.split('-')[2]+'-'+dob.split('-')[1]+'-'+dob.split('-')[0];
                        }
                        if(dob.includes('/')){
                            dob=dob.split('/')[2]+'-'+dob.split('/')[1]+'-'+dob.split('/')[0];
                        }
                        this.guardian_form.father_dob = dob;
                        $('#father_dob').prop('readonly',true);

                        this.guardian_form.father_dzongkhag =father_detail.dzongkhagId;
                        $('#father_dzongkhag').val(father_detail.dzongkhagId).trigger('change');
                        $('#father_dzongkhag').prop('disabled',true);

                        this.getgewoglist(father_detail.dzongkhagId,'father');
                        this.guardian_form.father_gewog = father_detail.gewogId;
                        $('#father_gewog').prop('disabled',true);

                        this.getvillagelist(father_detail.gewogId,'father');
                        $('#father_village_id').val(father_detail.villageSerialNo).trigger('change');
                        this.guardian_form.father_village_id = father_detail.villageSerialNo;
                        $('#father_village_id').prop('disabled',true);
                    }
                    if(type=="mother"){
                        let mother_detail = response.data;
                        let full_name=mother_detail.firstName;
                        if(mother_detail.middleName!="" && mother_detail.middleName!=null){
                            full_name+=' '+mother_detail.middleName;
                        }
                        full_name+=' '+mother_detail.lastName;
                        this.guardian_form.mother_first_name = full_name;
                        $('#mother_first_name').prop('readonly',true);
                        this.guardian_form.mother_cid_passport = mother_detail.cid;
                        $('#mother_cid_passport').prop('readonly',true);
                        let dob=personal_detail.dob;
                        if(dob.includes('-')){
                            dob=dob.split('-')[2]+'-'+dob.split('-')[1]+'-'+dob.split('-')[0];
                        }
                        if(dob.includes('/')){
                            dob=dob.split('/')[2]+'-'+dob.split('/')[1]+'-'+dob.split('/')[0];
                        }
                        this.guardian_form.mother_dob = dob;
                        $('#mother_dob').prop('readonly',true);

                        this.guardian_form.mother_dzongkhag =mother_detail.dzongkhagId;
                        $('#mother_dzongkhag').val(mother_detail.dzongkhagId).trigger('change');
                        $('#mother_dzongkhag').prop('disabled',true);

                        this.getgewoglist(mother_detail.dzongkhagId,'father');
                        this.guardian_form.mother_gewog = mother_detail.gewogId;
                        $('#mother_gewog').prop('disabled',true);

                        this.getvillagelist(mother_detail.gewogId,'father');
                        $('#mother_village_id').val(mother_detail.villageSerialNo).trigger('change');
                        this.guardian_form.mother_village_id = mother_detail.villageSerialNo;
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
                        this.getgewoglist(personal_detail.dzongkhagId,'p_gardain');
                        this.guardian_form.gardain_gewog = personal_detail.gewogId;
                        $('#gardain_gewog').val(personal_detail.gewogId).trigger('change');
                        $('#gardain_gewog').prop('disabled',true);
                        this.getvillagelist(personal_detail.gewogId,'p_gardain');
                        this.guardian_form.gardain_village_id = personal_detail.villageSerialNo;
                        $('#gardain_village_id').val(personal_detail.villageSerialNo).trigger('change');
                        $('#gardain_village_id').prop('disabled',true);
                    }
                }else{
                    this.ciderror = 'Invalid CID.';
                    Swal.fire({
                        html: "No data found for matching CID",
                        icon: 'info'
                    });
                }

            })
            .catch((exception) => {
                Swal.fire({
                    html: "No data found for matching CID/service down"+exception,
                    icon: 'error'
                });
            });
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
                if(type=="ScholarType_Active"){
                    this.studentscholarshipList = data.data.data;
                }
                if(type=="SpBenefit_Active"){
                    this.studentbenefitList = data.data.data;
                }
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
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
        /**
         * to load the class list
         */
        loadClassList(uri="loadCommons/getOrgClassStream"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.classList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },

        shownexttab(nextclass){
            if(nextclass=="basic-tabs"){
                this.changetab('basic-tabs');
            }
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
                formData.append('std_class', this.personal_form.std_class);
                formData.append('mother_tongue', this.personal_form.mother_tongue);
                formData.append('fulladdress', this.personal_form.fulladdress);
                formData.append('attachments', this.personal_form.attachments);
                formData.append('type','add');
                formData.append('student_id', this.personal_form.student_id);
                //this.personal_form.post('students/admission/saveStudentDetials',formData.serialize(), config)
                axios.post('students/admission/saveStudentDetails',formData, config)
                .then((response) => {
                    this.guardian_form.student_id=response.data.data.id;
                    // this.class_form.student_id=response.data.data.id;
                    Toast.fire({
                        icon: 'success',
                        title: 'Student Personal Details has been saved successfully'
                    });
                    this.getstudentGuardainClassDetails(this.$route.params.data,'guardian');
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
                this.guardian_form.post('students/admission/saveStudentGardianDetails')
                .then((response) =>{
                    Toast.fire({
                        icon: 'success',
                        title: 'Instructor Registration  successful'
                    });
                    this.getstudentGuardainClassDetails(this.$route.params.data,'class');
                    this.changetab(nextclass);
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
        submitfinalform(){
            Swal.fire({
                title: 'Are you sure you wish to submit this form ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
                }).then((result) =>{
                if (result.isConfirmed){
                    this.guardian_form.primary_contact=$("input[type='radio'][name='primary_contact']:checked").val();
                    this.guardian_form.post('students/admission/saveStudentGardianDetails')
                    .then((response) =>{
                        Swal.fire(
                            'Submitted!',
                            'Student details has been updated successfully.',
                            'success',
                            this.$router.push('/student_admission_list')
                        );
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
                    // this.guardian_form.post('students/admission/saveStudentClassDetails')
                    // .then((response) => {
                    //     Swal.fire(
                    //         'Submitted!',
                    //         'Student details has been updated successfully.',
                    //         'success',
                    //         this.$router.push('/student_updates')
                    //     );
                    // })
                    // .catch((error) =>{
                    //     Toast.fire({
                    //         icon: 'error',
                    //         title: 'Unexpected error occured. Try again.'
                    //     });
                    //     this.applyselect('class');
                    //     console.log("Error:"+error);
                    // });
                }
            })
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
                if(!$('#village_id').attr('class').includes('select2-hidden-accessible')){
                    $('#village_id').addClass('select2-hidden-accessible');
                }
                if(!$('#mother_tongue').attr('class').includes('select2-hidden-accessible')){
                    $('#mother_tongue').addClass('select2-hidden-accessible');
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
            if(type=="class"){
                if(!$('#class').attr('class').includes('select2-hidden-accessible')){
                    $('#class').addClass('select2-hidden-accessible');
                }
                if(!$('#stream').attr('class').includes('select2-hidden-accessible')){
                    $('#stream').addClass('select2-hidden-accessible');
                }
                if(!$('#section').attr('class').includes('select2-hidden-accessible')){
                    $('#section').addClass('select2-hidden-accessible');
                }
                if(!$('#student_type').attr('class').includes('select2-hidden-accessible')){
                    $('#student_type').addClass('select2-hidden-accessible');
                }
            }

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
                this.getgewoglist($('#dzongkhag').val(),'std');
            }
            if(id=="gewog"){
                this.personal_form.gewog=$('#gewog').val();
                this.getvillagelist($('#gewog').val(),'std');
            }
            if(id=="village_id"){
                this.personal_form.village_id=$('#village_id').val();
            }
            if(id=="std_class"){
                this.personal_form.std_class=$('#std_class').val();
            }
            if(id=="mother_tongue"){
                this.personal_form.mother_tongue=$('#mother_tongue').val();
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

            if(id=="class"){
                this.class_form.class=$('#class').val();
                $('#stream_section').hide();
                if($('#class option:selected').text()=="XI" || $('#class option:selected').text()=="XII"){
                    $('#stream_section').show();
                    this.showstream($('#class').val());
                }
                else{
                    this.getExistingSection($('#class').val());
                }
            }
            if(id=="stream"){
                this.class_form.stream=$('#stream').val();
                this.getExistingSection($('#stream').val());
            }
            if(id=="section"){
                this.class_form.section=$('#section').val();
            }
            if(id=="student_type"){
                this.class_form.student_type=$('#student_type').val();
            }
        },
        showstream(valu){
            this.streamListSelected=[];
            axios.get('/organization/getStreamByClassId/'+valu)
            .then(response => {
                let data = response.data;
                this.streamListSelected = data;
            });
        },
        getExistingSection(classId){
            this.class_form.class_stream_id=classId;
            this.sectionList=[];
            axios.get('/organization/getExistingSectionByClass/'+classId)
            .then(response => {
                let data = response.data;
                if(data != ""){
                    this.sectionList=data;
                }
            });
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
        },
        getstudentPersonalDetails(id){
            axios.get('students/admission/getStudentDetails/'+id)
            .then(response => {
                let data = response.data.data;
                if(data != ""){
                    this.personal_
                    this.personal_form.student_id=id;
                    this.showstdidentity(data.CmnCountryId);
                    this.personal_form.snationality=data.CmnCountryId;
                    this.personal_form.cid_passport=data.CidNo;
                    this.personal_form.first_name=data.Name.split(' ')[0];
                    if(data.Name.split(' ').length>2){
                        this.personal_form.middle_name=data.Name.split(' ')[1];
                        this.personal_form.last_name=data.Name.split(' ')[2];
                    }
                    if(data.Name.split(' ').length<2){
                         this.personal_form.last_name=data.Name.split(' ')[1];
                    }
                    this.personal_form.dob=data.DateOfBirth;
                    this.personal_form.sex_id=data.CmnSexId;
                    // this.personal_form.dzongkhag=data.snationality;
                    // this.personal_form.gewog=data.snationality;
                    this.personal_form.village_id=data.CmnChiwogId;
                    this.personal_form.fulladdress=data.Address;
                    this.personal_form.mother_tongue=data.CmnLanguageId;
                }   // this.personal_form.attachments=data.snationality;
            });
        },
        getstudentGuardainClassDetails(id,type){
            axios.get('students/admission/getstudentGuardainClassDetails/'+id+'/'+type)
            .then(response => {
                let data = response.data.data;
                this.guardian_form.student_id=id;
                if(type=="guardian"){
                    for(let i=0;i<data.length;i++){
                        if(data[i].contact_type=="Father"){
                            this.guardian_form.father_nationality=data[i].nationality;
                            this.guardian_form.father_cid_passport=data[i].cid_passport;
                            this.guardian_form.father_first_name=data[i].name;
                            // this.guardian_form.father_dzongkhag=data[i].cid_passport;
                            // this.guardian_form.father_gewog=data[i].cid_passport;
                            // this.guardian_form.father_village_id=data[i].cid_passport;
                            this.guardian_form.father_fulladdress=data[i].address;
                            // this.guardian_form.father_present_dzongkhag=data[i].cid_passport;
                            this.guardian_form.father_present_gewog=data[i].cid_passport;
                            // this.guardian_form.father_present_village_id=data[i].cid_passport;
                            this.guardian_form.father_work_address=data[i].work_address;
                            this.guardian_form.father_residence_address=data[i].residence_address;
                            this.guardian_form.father_occupation=data[i].occupation;
                            this.guardian_form.father_email=data[i].email;
                            this.guardian_form.father_cntct_no=data[i].cntct_no;
                        }
                        if(data[i].contact_type=="Mother"){
                            this.guardian_form.mother_nationality=data[i].nationality;
                            this.guardian_form.mother_cid_passport=data[i].cid_passport;
                            this.guardian_form.mother_first_name=data[i].name;
                            // this.guardian_form.mother_dzongkhag=data[i].cid_passport;
                            // this.guardian_form.mother_gewog=data[i].cid_passport;
                            // this.guardian_form.mother_village_id=data[i].cid_passport;
                            this.guardian_form.mother_fulladdress=data[i].address;
                            // this.guardian_form.mother_present_dzongkhag=data[i].cid_passport;
                            this.guardian_form.mother_present_gewog=data[i].cid_passport;
                            // this.guardian_form.mother_present_village_id=data[i].cid_passport;
                            this.guardian_form.mother_work_address=data[i].work_address;
                            this.guardian_form.mother_residence_address=data[i].residence_address;
                            this.guardian_form.mother_occupation=data[i].occupation;
                            this.guardian_form.mother_email=data[i].email;
                            this.guardian_form.mother_cntct_no=data[i].cntct_no;
                        }
                        if(data[i].contact_type=="Others"){
                            this.guardian_form.gardain_nationality=data[i].nationality;
                            this.guardian_form.gardain_cid_passport=data[i].cid_passport;
                            this.guardian_form.gardain_first_name=data[i].name;
                            // this.guardian_form.gardain_dzongkhag=data[i].cid_passport;
                            // this.guardian_form.gardain_gewog=data[i].cid_passport;
                            // this.guardian_form.gardain_village_id=data[i].cid_passport;
                            this.guardian_form.gardain_fulladdress=data[i].address;
                            // this.guardian_form.gardain_present_dzongkhag=data[i].cid_passport;
                            this.guardian_form.gardain_present_gewog=data[i].cid_passport;
                            // this.guardian_form.gardain_present_village_id=data[i].cid_passport;
                            this.guardian_form.gardain_work_address=data[i].work_address;
                            this.guardian_form.gardain_residence_address=data[i].residence_address;
                            this.guardian_form.gardain_occupation=data[i].occupation;
                            this.guardian_form.gardain_email=data[i].email;
                            this.guardian_form.gardain_cntct_no=data[i].cntct_no;
                        }
                    }
                }
                if(type=="class"){
                    this.class_form.student_id=id;
                    this.class_form.class=data.class_stream_id;
                    this.class_form.stream=data.class_stream_id;
                    this.class_form.class_stream_id=data.class_stream_id;
                    this.class_form.section=data.section;
                    this.class_form.student_type=data.student_type;
                    this.class_form.no_meals=data.snationality;
                    this.class_form.scholarship=data.snationality;
                    this.class_form.special_benifit=data.snationality;
                    this.class_form.disability=data.disability;
                }
            });
        }

    },
    mounted() {
        this.loadAllActiveMasters('all_active_gender');
        this.loadAllActiveMasters('all_active_dzongkhag');
        this.loadAllActiveMasters('active_mother_tongue');
        this.loadAllStudentMasters('StudentType_Active');
        this.loadAllStudentMasters('ScholarType_Active');
        this.loadAllStudentMasters('SpBenefit_Active');
        this.loadclasses('clasList');
        $('.select2').select2();
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id'));
        });
        Fire.$on('changefunction',(id)=> {
            this.changefunction(id);
        });
        this.getstudentPersonalDetails(this.$route.params.data);
        this.loadClassList();

    },
}
</script>
