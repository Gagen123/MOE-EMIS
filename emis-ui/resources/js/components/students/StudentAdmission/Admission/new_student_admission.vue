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
                        <form id="InstructorRegistrationForm" class="form-horizontal" enctype="multipart/form-data" action="#" method="POST">
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
                                                    <input type="text" class="form-control" @keyup.enter="getDetailsbyCID('cid_passport')" @blur="getDetailsbyCID('cid_passport')" @change="remove_err('cid_passport')" :class="{ 'is-invalid': personal_form.errors.has('cid_passport') }" id="cid_passport" v-model="personal_form.cid_passport" placeholder="Identification No">
                                                    <has-error :form="personal_form" field="cid_passport"></has-error>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label >First Name:<span class="text-danger">*</span> </label>
                                                    <input type="text" class="form-control" @change="remove_err('first_name')" :class="{ 'is-invalid': personal_form.errors.has('first_name') }" id="first_name" v-model="personal_form.first_name" placeholder="First Name">
                                                    <has-error :form="personal_form" field="first_name"></has-error>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label > Middle Name: </label>
                                                    <input type="text" class="form-control" @change="remove_err('middle_name')" :class="{ 'is-invalid': personal_form.errors.has('middle_name') }" id="middle_name" v-model="personal_form.middle_name" placeholder="Middle Name">
                                                    <has-error :form="personal_form" field="middle_name"></has-error>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label >Last Name: </label>
                                                    <input type="text" class="form-control" @change="remove_err('last_name')" :class="{ 'is-invalid': personal_form.errors.has('last_name') }" id="last_name" v-model="personal_form.last_name" placeholder="Last Name">
                                                    <has-error :form="personal_form" field="last_name"></has-error>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Date of Birth:<span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control" @change="remove_err('dob')" :class="{ 'is-invalid': personal_form.errors.has('dob') }" id="dob" v-model="personal_form.dob" placeholder="Date of Birth">
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
                                                    <textarea class="form-control" rows="3" @change="remove_err('fulladdress')" :class="{ 'is-invalid': personal_form.errors.has('fulladdress') }" id="fulladdress" v-model="personal_form.fulladdress" placeholder="Permanent Address"></textarea>
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
                                    <label class="font-weight-normal">Student Code:</label>
                                    <input type="text" @change="removeerror('studentcode','studentcode_err')" class="form-control" id="studentcode" v-model="personal_form.studentcode" readonly placeholder="generated automatically"/>
                                    <has-error :form="personal_form" field="studentcode"></has-error>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label class="font-weight-normal">Mother Tongue</label>
                                    <select v-model="personal_form.mother_tongue" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('mother_tongue') }" class="form-control select2" name="mother_tongue" id="mother_tongue">
                                        <option value=""> --Select--</option>
                                        <option v-for="(item, index) in motherTongueList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                    </select>
                                    <has-error :form="personal_form" field="mother_tongue"></has-error>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label class="font-weight-normal">Upload Photo</label>
                                    <input type="file" class="form-control" v-on:change="onChangeFileUpload">
                                    <has-error :form="form" field="attachments"></has-error>
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
                                <select v-model="guardian_form.merital_status" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('merital_status') }" class="form-control select2" name="merital_status" id="merital_status">
                                    <option value=""> --Select--</option>
                                    <option v-for="(item, index) in motherTongueList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="guardian_form" field="merital_status"></has-error>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="font-weight-normal"> Student Primary Contact:</label><br>
                                <input type="radio" name="connecgtion" id="connecgtion" @click="showidentity('primary-contact-father')" checked> Father
                                <input type="radio" name="connecgtion" id="connecgtion" @click="showidentity('primary-contact-mother')" > Mother
                                <input type="radio" name="connecgtion" id="connecgtion" @click="showidentity('primary-contact-guardian')"> Guardian 
                            </div>
                        </div>
                        <div class="row form-group">
                            <!--Father-->
                            <div class="row form-group col-lg-4 col-md-4 col-sm-4">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card card-primary">
                                        <div class="card-body">
                                            <dt>Father's Details</dt>
                                            <hr>
                                            <div class="row form-group">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <label class="font-weight-normal">  Nationality:</label><br>
                                                        <input type="radio" name="father-nationality" id="father-nationality" @click="showidentity('father-national')" checked> Bhutanese
                                                        <input type="radio" name="father-nationality" id="father-nationality" @click="showidentity('father-non-national')" > Non-Bhutanese
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12" style="display:none" id="father-non-national">
                                                <label class="font-weight-normal">Father's Name </label>
                                                    <input type="text" class="form-control" @click="remove_err('error_Telephone')" id="name" v-model="nationality" placeholder="Father's Name">
                                                        <span class="text-danger" id="error_Telephone"></span>
                                                <label class="font-weight-normal">Nationality </label>
                                                    <input type="text" class="form-control" @click="remove_err('error_Telephone')" id="Telephone" v-model="nationality" placeholder="Nationality">
                                                        <span class="text-danger" id="error_Telephone"></span>
                                                <label class="font-weight-normal">Please Specify Type  </label>
                                                    <input type="text" class="form-control" @click="remove_err('error_Telephone')" id="Telephone" v-model="nationality" placeholder="Country Diplomat, Expriate etc">
                                                        <span class="text-danger" id="error_Telephone"></span>
                                                <label class="font-weight-normal">Immigration ID/Other Document ID  </label>
                                                    <input type="text" class="form-control" @click="remove_err('error_Telephone')" id="Telephone" v-model="nationality" placeholder="Immigration ID/Other ID Nos">
                                                        <span class="text-danger" id="error_Telephone"></span>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12" style="display:show" id="father-national">
                                                <label class="font-weight-normal">Father's CID  </label>
                                                    <input type="text" class="form-control" @click="remove_err('error_Telephone')" id="Telephone" v-model="nationality" placeholder="Father's CID">
                                                        <span class="text-danger" id="error_Telephone"></span>
                                                <label class="font-weight-normal">Father's Name </label>
                                                    <input type="text" class="form-control" @click="remove_err('error_Telephone')" id="Telephone" v-model="nationality" placeholder="Father's Name" disabled>
                                                        <span class="text-danger" id="error_Telephone"></span>
                                                <label class="font-weight-normal">Permanent Address </label>
                                                    <textarea class="form-control" rows="2" placeholder="Permanent Address" disabled></textarea>
                                                        <span class="text-danger" id="error_Telephone"></span>
                                            </div>
                                            <br>
                                            <label class="font-weight-normal"> Present Address:</label><br>
                                            <div class="form-group row">
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label class="font-weight-normal mb-0">Dzongkhag:<span class="text-danger">*</span></label>
                                                    <select v-model="selectedDzongkhag" name="dzongkhag" id="dzongkhag" class="form-control editable_fields" @change="removeerror('dzongkhag','dzongkhag_error')">
                                                        <option value="">--- Please Select ---</option>
                                                        <option v-for="(gewog_obj, gewog) in places" :key="gewog_obj" :value="gewog">{{gewog}}</option>
                                                    </select>
                                                    <span id="dzongkhag_error" class="text-danger"></span>
                                                </div>  
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label class="font-weight-normal mb-0">Gewog:<span class="text-danger">*</span></label>
                                                    <select v-model="selectedGewog" name="gewog" id="gewog" class="form-control editable_fields" @change="removeerror('gewog','gewog_error')">
                                                        <option value="">--- Please Select ---</option>
                                                        <option v-for="(chiwog_obj, chiwog) in gewogs" :key="chiwog_obj" :value="chiwog">{{chiwog}}</option>
                                                    </select>
                                                    <span id="gewog_error" class="text-danger"></span>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label class="font-weight-normal mb-0">Chiwog:<span class="text-danger">*</span></label>
                                                    <select v-model="selectedChiwog" name="chiwog" id="chiwog" class="form-control editable_fields" @change="removeerror('chiwog','chiwog_error')">
                                                        <option value="">--- Please Select ---</option>
                                                        <option v-for="chiwog in chiwogs" :key="chiwog">{{chiwog}}</option>
                                                    </select>
                                                    <span id="chiwog_error" class="text-danger"></span>
                                                </div>                 
                                            </div>
                                            <label class="font-weight-normal">Work Address </label>
                                                <textarea class="form-control" rows="2" placeholder="Work Address"></textarea>
                                                    <span class="text-danger" id="error_Telephone"></span>
                                            <label class="font-weight-normal">Residence Address </label>
                                                <textarea class="form-control" rows="2" placeholder="Residence Address"></textarea>
                                                    <span class="text-danger" id="error_Telephone"></span>
                                            <div class="row form-group">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <label class="font-weight-normal">Occupation:</label>
                                                        <select class="form-control">
                                                            <option>Civil Servant</option>
                                                            <option>Private Employee</option>
                                                            <option>Farmer</option>
                                                        </select>
                                                </div>
                                            </div>
                                            <label class="font-weight-normal">Email Address  </label>
                                                <input type="text" class="form-control" @click="remove_err('error_Telephone')" id="Telephone" v-model="nationality" placeholder="Email Address">
                                                    <span class="text-danger" id="error_Telephone"></span>
                                            <label class="font-weight-normal">Contact No.  </label>
                                                <input type="text" class="form-control" @click="remove_err('error_Telephone')" id="Telephone" v-model="nationality" placeholder="Contact No.">
                                                    <span class="text-danger" id="error_Telephone"></span>
                                        </div>
                                        <span class="text-danger">*All fields will be auto-completed depending on CID No.</span><br>
                                    </div>
                                </div>
                            </div>
                            <!--Mother-->
                            <div class="row form-group col-lg-4 col-md-4 col-sm-4">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card card-primary">
                                        <div class="card-body">
                                            <dt>Mother's Details</dt>
                                            <hr>
                                            <div class="row form-group">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <label class="font-weight-normal"> Nationality:</label><br>
                                                        <input type="radio" name="mother-nationality" id="mother-nationality" @click="showidentity('mother-national')" checked> Bhutanese
                                                        <input type="radio" name="mother-nationality" id="mother-nationality" @click="showidentity('mother-non-national')" > Non-Bhutanese
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12" style="display:none" id="mother-non-national">
                                                <label class="font-weight-normal">Mother's Name </label>
                                                    <input type="text" class="form-control" @click="remove_err('error_Telephone')" id="name" v-model="nationality" placeholder="Mother's Name">
                                                        <span class="text-danger" id="error_Telephone"></span>
                                                <label class="font-weight-normal">Nationality </label>
                                                    <input type="text" class="form-control" @click="remove_err('error_Telephone')" id="Telephone" v-model="nationality" placeholder="Nationality">
                                                        <span class="text-danger" id="error_Telephone"></span>
                                                <label class="font-weight-normal">Please Specify Type  </label>
                                                    <input type="text" class="form-control" @click="remove_err('error_Telephone')" id="Telephone" v-model="nationality" placeholder="Country Diplomat, Expriate etc">
                                                        <span class="text-danger" id="error_Telephone"></span>
                                                <label class="font-weight-normal">Immigration ID/Other Document ID  </label>
                                                    <input type="text" class="form-control" @click="remove_err('error_Telephone')" id="Telephone" v-model="nationality" placeholder="Immigration ID/Other ID Nos">
                                                        <span class="text-danger" id="error_Telephone"></span>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12" style="display:show" id="mother-national">
                                                <label class="font-weight-normal"> CID  </label>
                                                    <input type="text" class="form-control" @click="remove_err('error_Telephone')" id="Telephone" v-model="nationality" placeholder="Mother's CID">
                                                        <span class="text-danger" id="error_Telephone"></span>
                                                <label class="font-weight-normal">Mother's Name </label>
                                                    <input type="text" class="form-control" @click="remove_err('error_Telephone')" id="Telephone" v-model="nationality" placeholder="Mother's Name" disabled>
                                                        <span class="text-danger" id="error_Telephone"></span>
                                                <label class="font-weight-normal">Permanent Address </label>
                                                    <textarea class="form-control" rows="2" placeholder="Permanent Address" disabled></textarea>
                                                        <span class="text-danger" id="error_Telephone"></span>
                                            </div>
                                            <br>
                                            <label class="font-weight-normal"> Present Address:</label><br>
                                            <div class="form-group row">
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label class="font-weight-normal mb-0">Dzongkhag:<span class="text-danger">*</span></label>
                                                    <select v-model="selectedDzongkhag" name="dzongkhag" id="dzongkhag" class="form-control editable_fields" @change="removeerror('dzongkhag','dzongkhag_error')">
                                                        <option value="">--- Please Select ---</option>
                                                        <option v-for="(gewog_obj, gewog) in places" :key="gewog_obj" :value="gewog">{{gewog}}</option>
                                                    </select>
                                                    <span id="dzongkhag_error" class="text-danger"></span>
                                                </div>  
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label class="font-weight-normal mb-0">Gewog:<span class="text-danger">*</span></label>
                                                    <select v-model="selectedGewog" name="gewog" id="gewog" class="form-control editable_fields" @change="removeerror('gewog','gewog_error')">
                                                        <option value="">--- Please Select ---</option>
                                                        <option v-for="(chiwog_obj, chiwog) in gewogs" :key="chiwog_obj" :value="chiwog">{{chiwog}}</option>
                                                    </select>
                                                    <span id="gewog_error" class="text-danger"></span>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label class="font-weight-normal mb-0">Chiwog:<span class="text-danger">*</span></label>
                                                    <select v-model="selectedChiwog" name="chiwog" id="chiwog" class="form-control editable_fields" @change="removeerror('chiwog','chiwog_error')">
                                                        <option value="">--- Please Select ---</option>
                                                        <option v-for="chiwog in chiwogs" :key="chiwog">{{chiwog}}</option>
                                                    </select>
                                                    <span id="chiwog_error" class="text-danger"></span>
                                                </div>                 
                                            </div>
                                            <label class="font-weight-normal">Work Address </label>
                                                <textarea class="form-control" rows="2" placeholder="Work Address"></textarea>
                                                    <span class="text-danger" id="error_Telephone"></span>
                                            <label class="font-weight-normal">Residence Address </label>
                                                <textarea class="form-control" rows="2" placeholder="Residence Address"></textarea>
                                                    <span class="text-danger" id="error_Telephone"></span>
                                            <div class="row form-group">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <label class="font-weight-normal">Occupation:</label>
                                                        <select class="form-control">
                                                            <option>Civil Servant</option>
                                                            <option>Private Employee</option>
                                                            <option>Farmer</option>
                                                        </select>
                                                </div>
                                            </div>
                                            <label class="font-weight-normal">Email Address  </label>
                                                <input type="text" class="form-control" @click="remove_err('error_Telephone')" id="Telephone" v-model="nationality" placeholder="Email Address">
                                                    <span class="text-danger" id="error_Telephone"></span>
                                            <label class="font-weight-normal">Contact No.  </label>
                                                <input type="text" class="form-control" @click="remove_err('error_Telephone')" id="Telephone" v-model="nationality" placeholder="Contact No.">
                                                    <span class="text-danger" id="error_Telephone"></span>
                                        </div>
                                        <span class="text-danger">*All fields will be auto-completed depending on CID No.</span><br>
                                    </div>
                                </div>
                            </div>
                            <!--Guardian-->
                            <div class="row form-group col-lg-4 col-md-4 col-sm-4" style="display:none" id="primary-contact-guardian">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="card card-primary">
                                        <div class="card-body">
                                            <dt>Guardian Details</dt>
                                            <hr>
                                            <label class="font-weight-normal">CID  </label>
                                                <input type="text" class="form-control" @click="remove_err('error_Telephone')" id="Telephone" v-model="nationality" placeholder="CID">
                                                    <span class="text-danger" id="error_Telephone"></span>
                                            <label class="font-weight-normal"> Name </label>
                                                <input type="text" class="form-control" @click="remove_err('error_Telephone')" id="Telephone" v-model="nationality" placeholder="Name" disabled>
                                                    <span class="text-danger" id="error_Telephone"></span>
                                            <label class="font-weight-normal">Permanent Address </label>
                                                <textarea class="form-control" rows="2" placeholder="Permanent Address" disabled></textarea>
                                                    <span class="text-danger" id="error_Telephone"></span>
                                        
                                            <br>
                                                <label class="font-weight-normal"> Present Address:</label><br>
                                                <div class="form-group row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                        <label class="font-weight-normal mb-0">Dzongkhag:<span class="text-danger">*</span></label>
                                                        <select v-model="selectedDzongkhag" name="dzongkhag" id="dzongkhag" class="form-control editable_fields" @change="removeerror('dzongkhag','dzongkhag_error')">
                                                            <option value="">--- Please Select ---</option>
                                                            <option v-for="(gewog_obj, gewog) in places" :key="gewog_obj" :value="gewog">{{gewog}}</option>
                                                        </select>
                                                        <span id="dzongkhag_error" class="text-danger"></span>
                                                    </div>  
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                        <label class="font-weight-normal mb-0">Gewog:<span class="text-danger">*</span></label>
                                                        <select v-model="selectedGewog" name="gewog" id="gewog" class="form-control editable_fields" @change="removeerror('gewog','gewog_error')">
                                                            <option value="">--- Please Select ---</option>
                                                            <option v-for="(chiwog_obj, chiwog) in gewogs" :key="chiwog_obj" :value="chiwog">{{chiwog}}</option>
                                                        </select>
                                                        <span id="gewog_error" class="text-danger"></span>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                        <label class="font-weight-normal mb-0">Chiwog:<span class="text-danger">*</span></label>
                                                        <select v-model="selectedChiwog" name="chiwog" id="chiwog" class="form-control editable_fields" @change="removeerror('chiwog','chiwog_error')">
                                                            <option value="">--- Please Select ---</option>
                                                            <option v-for="chiwog in chiwogs" :key="chiwog">{{chiwog}}</option>
                                                        </select>
                                                        <span id="chiwog_error" class="text-danger"></span>
                                                    </div>                 
                                                </div>
                                                <label class="font-weight-normal">Work Address </label>
                                                    <textarea class="form-control" rows="2" placeholder="Work Address"></textarea>
                                                        <span class="text-danger" id="error_Telephone"></span>
                                                <label class="font-weight-normal">Residence Address </label>
                                                    <textarea class="form-control" rows="2" placeholder="Residence Address"></textarea>
                                                        <span class="text-danger" id="error_Telephone"></span>
                                                <div class="row form-group">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <label class="font-weight-normal">Occupation:</label>
                                                            <select class="form-control">
                                                                <option>Civil Servant</option>
                                                                <option>Private Employee</option>
                                                                <option>Farmer</option>
                                                            </select>
                                                    </div>
                                                </div>
                                                <label class="font-weight-normal">Email Address  </label>
                                                    <input type="text" class="form-control" @click="remove_err('error_Telephone')" id="Telephone" v-model="nationality" placeholder="Email Address">
                                                        <span class="text-danger" id="error_Telephone"></span>
                                                <label class="font-weight-normal">Contact No.  </label>
                                                    <input type="text" class="form-control" @click="remove_err('error_Telephone')" id="Telephone" v-model="nationality" placeholder="Contact No.">
                                                        <span class="text-danger" id="error_Telephone"></span>
                                            <span class="text-danger">*All fields will be auto-completed depending on CID No.</span><br>
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
                            <div class="row form-group">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="font-weight-normal">Student Class: <span class="text-danger">*</span></label>
                                    <select class="select2bs4" id="studentclass" v-model="studentclass" style="width: 100%;">
                                        <option value="" label="- First Select Class -">- Please Select Class -</option>
                                        <option value="1">PP</option><option value="2">I</option><option value="3">II</option><option value="4">III</option>
                                        <option value="5">IV</option><option value="6">V</option><option value="7">VI</option><option value="8">VII</option>
                                        <option value="9">VIII</option><option value="10">IX</option><option value="11">X</option><option value="12">XI</option><option value="13">XII</option>
                                </select>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="font-weight-normal">Student Section: <span class="text-danger">*</span></label>
                                    <select class="select2bs4" id="studentsection" v-model="studentsection" style="width: 100%;">
                                        <option value="" label="- First Select Section -">- Please Select Section -</option>
                                        <option value="1">A</option><option value="2">B</option><option value="3">C</option><option value="4">D</option>
                                        <option value="5">E</option><option value="6">F</option><option value="7">G</option><option value="8">H</option>
                                        <option value="9">I</option><option value="10">J</option><option value="11">K</option><option value="12">L</option><option value="13">M</option>
                                </select>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="font-weight-normal">Student Stream: <span class="text-danger">*</span></label>
                                    <select class="select2bs4" id="studentstream" v-model="studentstream" style="width: 100%;">
                                        <option value="" label="- First Select Stream -">- Please Select Stream -</option>
                                        <option value="1">General</option><option value="2">Science</option><option value="3">Arts</option>
                                        <option value="4">Commerce</option>
                                        
                                </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="font-weight-normal">Student Type: <span class="text-danger">*</span></label>
                                    <select class="select2bs4" id="studenttype" v-model="studentclass" style="width: 100%;">
                                        <option value="" label="- First Select Class -">- Please Select Type -</option>
                                        <option value="1">Regular</option><option value="2">Supplementary</option><option value="3">Repeater</option>
                                        <option value="1">Private Candidate</option><option value="2">CE Candidate</option><option value="3">In-Service</option>
                                </select>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="font-weight-normal">No of Meals: <span class="text-danger">*</span></label>
                                    <select class="select2bs4" id="studentmeals" v-model="studentsection" style="width: 100%;">
                                        <option value="" label="- First Select Section -">- Please Select Meals -</option>
                                        <option value="1">1</option><option value="2">2</option><option value="3">3</option>
                                </select>
                                </div>
                            </div>
                            <br>
                            <label class="font-weight-normal">Scholarship</label>
                            <div class="row form-group">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1">
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
                            <label class="font-weight-normal">Special Benefits</label>
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
                            <label class="font-weight-normal"> Do you think the children/student has a disability? (Eg: difficulty seeing, hearing, walking, 
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
                parent_details:[
                    { 
                        cid_passport:'',
                        first_name:'',
                        middle_name:'',
                        last_name:'',
                        dob:'',
                        sex_id:'',
                        dzongkhag:'',
                        gewog:'',
                        village_id:'',
                    }
                ],
            }),
            places:{
                "Thimphu":{
                    "Chang":["Lhoongtsho Tashigang","Yoedselpang","Ramtogtog Tsangrina"],
                    "Kawang":["Boegarna Dodennang","Dazhi Zhoshuel"],
                },

                "Paro":{
                    "Dokar":["Tenchhekha Tsiphoog","Goensakha Phuchhekha","Mendrel Uesuna"],
                    "Dopshari":["olDuezhi Jipaakha","Kempa Kuduphoog"],
                },
                
            },
        }
    },
    methods: {
        onChangeFileUpload(e){
            this.personal_form.attachments = e.target.files[0];
        },
        getDetailsbyCID(fieldId){
            let selectedVal="";
            let selected = $("input[type='radio'][name='snationality']:checked");
            if (selected.length > 0) {
                selectedVal = selected.val();
            }
            else{
                Swal.fire({
                    html: "Please student nationality",
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
                            this.personal_form.first_name = personal_detail.firstName;
                            this.personal_form.middle_name=personal_detail.middleName;
                            this.personal_form.last_name=personal_detail.lastName;
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
                                }  
                            }
                            this.personal_form.dzongkhag =personal_detail.dzongkhagId;
                            $('#dzongkhag').val(personal_detail.dzongkhagId).trigger('change');
                            this.getgewoglist(personal_detail.dzongkhagId);
                            this.personal_form.gewog = personal_detail.gewogId;
                            this.getvillagelist(personal_detail.gewogId);
                            $('#village_id').val(personal_detail.villageSerialNo).trigger('change');
                            this.personal_form.village_id = personal_detail.villageSerialNo;
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
                formData.append('attachments', this.personal_form.attachments);
                //this.personal_form.post('students/admission/saveStudentDetials',formData.serialize(), config)
                axios.post('students/admission/saveStudentDetails',formData, config)
                .then((response) => {
                    alert(response.data);
                    this.ciderror = '';
                    this.form.reset();
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
        showidentity:function(type){
            if(type=="Student-Non-Bhutanese"){
                $('#level_name').html('Immigration/Passport/Other Identification No: *');
            }
            if(type=="Student-Bhutanese"){
                $('#level_name').html('CID No: *');
            }
            if(type=="Student-Bhutanese-underprocess"){
                $('#level_name').html('Identification No: *');
            }

            if(type=="father-national"){
                $('#father-national').show();
                $('#father-non-national').hide();
            }
            if(type=="father-non-national"){
                $('#father-non-national').show();
                $('#father-national').hide();
            }
            if(type=="mother-national"){
                $('#mother-national').show();
                $('#mother-non-national').hide();
            } 
            if(type=="mother-non-national"){
                $('#mother-non-national').show();
                $('#mother-national').hide();
            }
            if(type!="primary-contact-guardian"){
                $('#primary-contact-guardian').hide();
            }
            if(type=="primary-contact-guardian"){
                $('#primary-contact-guardian').show();
            }
        }

    },

    mounted() {
        this.loadAllActiveMasters('all_active_gender');
        this.loadAllActiveMasters('all_active_dzongkhag');
        this.loadAllActiveMasters('active_mother_tongue'); 
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
 