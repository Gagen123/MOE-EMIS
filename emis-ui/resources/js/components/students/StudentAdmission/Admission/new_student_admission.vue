<template>
    <div> 
        <div class="col-12"> 
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
                            <div class="row form-group">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label class="font-weight-normal"> Student Nationality:</label><br>
                                        <input type="radio" name="connecgtion" id="connecgtion" @click="showidentity('Bhutanese')" checked> Bhutanese <br>
                                        <input type="radio" name="connecgtion" id="connecgtion" @click="showidentity('Bhutanese')" checked> Bhutanese (under process)<br>
                                        <input type="radio" name="connecgtion" id="connecgtion" @click="showidentity('Non-Bhutanese')"> Non-Bhutanese 
                                </div>
                                <div class="row form-group col-lg-9 col-md-9 col-sm-9">
                                    <div class="col-lg-9 col-md-9 col-sm-9" style="display:none" id="non-national">
                                        <div class="card card-primary">
                                            <div class="card-body">
                                                <div class="row form-group">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <label >Immigration/Passport/Other Identification No: *  </label>
                                                        <input type="text" class="form-control" @click="remove_err('error_Telephone')" id="Telephone" v-model="nationality" placeholder="Identification No">
                                                        <span class="text-danger" id="error_Telephone"></span>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                        <label >First Name </label>
                                                        <input type="text" class="form-control" @click="remove_err('error_Telephone')" id="Telephone" v-model="nationality" placeholder="First Name" disabled>
                                                        <span class="text-danger" id="error_Telephone"></span>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                        <label > Middle Name </label>
                                                        <input type="text" class="form-control" @click="remove_err('error_Telephone')" id="Telephone" v-model="nationality" placeholder="Middle Name" disabled>
                                                        <span class="text-danger" id="error_Telephone"></span>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                        <label >Last Name </label>
                                                        <input type="text" class="form-control" @click="remove_err('error_Telephone')" id="Telephone" v-model="nationality" placeholder="Last Name" disabled>
                                                        <span class="text-danger" id="error_Telephone"></span>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label >Date of Birth </label>
                                                        <input type="date" class="form-control" @click="remove_err('error_Telephone')" id="Telephone" v-model="nationality" placeholder="Date of Birth">
                                                        <span class="text-danger" id="error_Telephone"></span>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label>Select</label>
                                                            <select class="form-control">
                                                                <option>Male</option>
                                                                <option>Female</option>
                                                            </select>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label >Nationality </label>
                                                        <input type="text" class="form-control" @click="remove_err('error_Telephone')" id="Telephone" v-model="nationality" placeholder="Nationality" disabled>
                                                        <span class="text-danger" id="error_Telephone"></span>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <label >Permanent Address </label>
                                                        <textarea class="form-control" rows="3" placeholder="Permanent Address" disabled></textarea>
                                                        <span class="text-danger" id="error_Telephone"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12" id="national">
                                        <div class="card card-primary">
                                            <div class="card-body">
                                                <div class="row form-group">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <label >Citizenship ID No: *  </label>
                                                        <input type="text" class="form-control" @click="remove_err('error_Telephone')" id="Telephone" v-model="nationality" placeholder="Citizenship ID">
                                                        <span class="text-danger" id="error_Telephone"></span>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                        <label >First Name </label>
                                                        <input type="text" class="form-control" @click="remove_err('error_Telephone')" id="Telephone" v-model="nationality" placeholder="First Name" disabled>
                                                        <span class="text-danger" id="error_Telephone"></span>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                        <label > Middle Name </label>
                                                        <input type="text" class="form-control" @click="remove_err('error_Telephone')" id="Telephone" v-model="nationality" placeholder="Middle Name" disabled>
                                                        <span class="text-danger" id="error_Telephone"></span>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                        <label >Last Name </label>
                                                        <input type="text" class="form-control" @click="remove_err('error_Telephone')" id="Telephone" v-model="nationality" placeholder="Last Name" disabled>
                                                        <span class="text-danger" id="error_Telephone"></span>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label >Date of Birth </label>
                                                        <input type="text" class="form-control" @click="remove_err('error_Telephone')" id="Telephone" v-model="nationality" placeholder="Date of Birth" disabled>
                                                        <span class="text-danger" id="error_Telephone"></span>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label > Sex </label>
                                                        <input type="text" class="form-control" @click="remove_err('error_Telephone')" id="Telephone" v-model="nationality" placeholder="Sex" disabled>
                                                        <span class="text-danger" id="error_Telephone"></span>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <label >Permanent Address </label>
                                                        <textarea class="form-control" rows="2" placeholder="Permanent Address" disabled></textarea>
                                                        <span class="text-danger" id="error_Telephone"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="text-danger">*All fields will be auto-completed depending on CID No.</span><br>
                                </div>
                            </div>
                            
                            <div class="row form-group">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
                                    <label class="font-weight-normal">Student Code:</label>
                                    <input type="text" @change="removeerror('studentcode','studentcode_err')" class="form-control font-weight-bolder" id="studentcode" v-model="studentcode" style="width: 100%;" disabled="disabled" placeholder="generated automatically"/>
                                    <span id="studentcode_err" class="text-danger"></span>
                                </div>
                            </div>
                            <div id="schoolsections">
                                <div class="row form-group">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="font-weight-normal">Mother Tongue</label>
                                        <select class="select2bs4 font-weight-bolder" id="schoolstatus" v-model="schoolstatus" style="width: 100%;">
                                            <option value="" label="- Please Select -">- Please Select -</option>
                                            <option value="1" label="Dzongkha">Dzongkha</option>
                                            <option value="2" label="Tshangla">Tshangla</option>
                                            <option value="3" label="Lhotshampkha">Lhotshampkha</option>
                                            <option value="4" label="Kurtokha">Kurtokha</option>
                                            <option value="4" label="Bumthangkha">Bumthangkha</option>
                                            <option value="4" label="Chalikha">Chalikha</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-normal">Upload Photo</label>
                                <div class="input-group">
                                    <div class="custom-file col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <input type="file" class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Upload Photo</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                            </div>
                            <!--next button--> 
                            <div class="row form-group fa-pull-right">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button class="btn btn-flat btn-primary" @click="shownexttab('guardians-tab')"> Next <i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>
                        </div>

                        <!--Student Guardain Info-->
                        <div class="tab-pane fade tab-content-details" id="guardians-tab" role="tabpanel" aria-labelledby="basicdetails">
                            <div class="row form-group">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label class="font-weight-normal">Parent's Marital Status</label>
                                        <select class="form-control">
                                            <option>Divorced</option>
                                            <option>Single</option>
                                        </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
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
                                        <select class="select2bs4 font-weight-bolder" id="studentclass" v-model="studentclass" style="width: 100%;">
                                            <option value="" label="- First Select Class -">- Please Select Class -</option>
                                            <option value="1">PP</option><option value="2">I</option><option value="3">II</option><option value="4">III</option>
                                            <option value="5">IV</option><option value="6">V</option><option value="7">VI</option><option value="8">VII</option>
                                            <option value="9">VIII</option><option value="10">IX</option><option value="11">X</option><option value="12">XI</option><option value="13">XII</option>
                                    </select>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="font-weight-normal">Student Section: <span class="text-danger">*</span></label>
                                        <select class="select2bs4 font-weight-bolder" id="studentsection" v-model="studentsection" style="width: 100%;">
                                            <option value="" label="- First Select Section -">- Please Select Section -</option>
                                            <option value="1">A</option><option value="2">B</option><option value="3">C</option><option value="4">D</option>
                                            <option value="5">E</option><option value="6">F</option><option value="7">G</option><option value="8">H</option>
                                            <option value="9">I</option><option value="10">J</option><option value="11">K</option><option value="12">L</option><option value="13">M</option>
                                    </select>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="font-weight-normal">Student Stream: <span class="text-danger">*</span></label>
                                        <select class="select2bs4 font-weight-bolder" id="studentstream" v-model="studentstream" style="width: 100%;">
                                            <option value="" label="- First Select Stream -">- Please Select Stream -</option>
                                            <option value="1">General</option><option value="2">Science</option><option value="3">Arts</option>
                                            <option value="4">Commerce</option>
                                            
                                    </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="font-weight-normal">Student Type: <span class="text-danger">*</span></label>
                                        <select class="select2bs4 font-weight-bolder" id="studenttype" v-model="studentclass" style="width: 100%;">
                                            <option value="" label="- First Select Class -">- Please Select Type -</option>
                                            <option value="1">Regular</option><option value="2">Supplementary</option><option value="3">Repeater</option>
                                            <option value="1">Private Candidate</option><option value="2">CE Candidate</option><option value="3">In-Service</option>
                                    </select>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="font-weight-normal">No of Meals: <span class="text-danger">*</span></label>
                                        <select class="select2bs4 font-weight-bolder" id="studentmeals" v-model="studentsection" style="width: 100%;">
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
    </div>
</template>
<script>
export default {
    components: {
    },
    data() {
        return {
            firstname:"", middlename:"", lastname:"",
            organizationtype:"", fathername:"", mothername:"", fathercontact:"", mothercontact:"",
            schoollevel:"", guardaincontact:"", 
            schoolname:"", studentclass:"", studentsection:"", studentstream:"",
            nationality:"", dzongkhag:"", gewog:"",
            schoolLocation:"",schoolstatus:"",
            agencycode:"",rcsccode:"",mofcode:"",
            establishmentyear:"", locationroadtype:"",
            locationdzongkhag:"", locationgewog:"", locationvillage:"",thrmno:"",altitute:"",latitute:"",longitute:"", locationschool:"",
            climatetype:"",locationvillage:"",distancefromroaddays:"",distancefromroadkm:"",distancefromroadhrs:"",compoundarea:"",playgroundmeasure:"",playgrounddescription:"",
            agrriculturearea:"",usedagriculture:"",tabstandNo:"",waterproblem:"",electricremarks:"",wayofdatacollection:"",
            count:5,
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
            gewogs: [],
            chiwogs: [],
            selectedDzongkhag: "",
            selectedGewog: "",
            selectedChiwog: ""
        }
    },
    methods: {
        previoustab(preclass,presentclass){
            $('.basic-tabs>a').removeClass('active');
            $('#basic-tabs').removeClass('active show');
            $('.location-tab >a').removeClass('active');
            $('#location-tab').removeClass('active show');
            $('.schooldetails-tab >a').removeClass('active');
            $('#schooldetails-tab').removeClass('active show');
            $('.contactdetails-tab >a').removeClass('active');
            $('#contactdetails-tab').removeClass('active show');
            $('.'+preclass+'> a').addClass('active');
            $('#'+preclass).addClass('active show');
        },
        shownexttab(nextclass){
            $('#tabhead >li >a').removeClass('active');
            $('#tabhead >li >a >span').addClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').addClass('active');
            $('.'+nextclass+' >a >span').removeClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').removeClass('disabled');
            $('.tab-content-details').hide();
            $('#'+nextclass).show().removeClass('fade');
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
        validatedforms(presentclass){
            let returntype=true;
            if(presentclass=="basic-tabs"){
                if($('#organizationtype').val()==""){
                    $('#organizationtype').addClass('is-invalid');
                    $('#organizatioid_err').html('Please select organization type'); 
                    returntype=false;
                }
                
                if($('#schoolname').val()==""){
                    $('#schoolname').addClass('is-invalid');
                    $('#schoolname_err').html('Please mention the name of the school'); 
                    returntype=false;
                }

                if($('#agencycode').val()==""){
                    $('#agencycode').addClass('is-invalid');
                    $('#agencycode_err').html('Please mention agency code'); 
                    returntype=false;
                }
            }
            return returntype;
        },
        removeerror(fieldid,errid){
            if($('#'+fieldid).val()!=""){
                $('#'+fieldid).removeClass('is-invalid');
                $('#'+errid).html(''); 
            }
        },
        showidentity:function(type){
                if(type=="Non-Bhutanese"){
                    $('#non-national').show();
                    $('#national').hide();
                }
                else if(type=="Bhutanese"){
                    $('#national').show();
                    $('#non-national').hide();
                }
                else if(type=="father-national"){
                    $('#father-national').show();
                    $('#father-non-national').hide();
                }
                else if(type=="father-non-national"){
                    $('#father-non-national').show();
                    $('#father-national').hide();
                }
                else if(type=="mother-national"){
                    $('#mother-national').show();
                    $('#mother-non-national').hide();
                }
                else if(type=="mother-non-national"){
                    $('#mother-non-national').show();
                    $('#mother-national').hide();
                }
                else if(type!="primary-contact-guardian"){
                    $('#primary-contact-guardian').hide();
                }
                else if(type=="primary-contact-guardian"){
                    $('#primary-contact-guardian').show();
                }
        }

    },

    mounted() {
        $('#cardheader').html('New Student Form');
        $('#addnewstd').hide();
        $('.select2').select2()
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
        $('.select2-selection__rendered').addClass('font-weight-bolder');
        $('#organizationtype').change(function(){
            //this.removeerror('organizationtype','organizatioid_err');
            if($('#organizationtype').val()=="School"){
                $('#schoolcat').show();
            }
            else{
                $('#schoolcat').hide();
            }
        });
    },
    watch: {
        
        selectedDzongkhag: function() {
            // Clear previously selected values
            this.gewogs = [];
            this.chiwogs = [];
            this.selectedGewog = "";
            this.selectedChiwog = "";
            // Populate list of gewogs in the second dropdown
            if (this.selectedDzongkhag.length > 0) {
                this.gewogs = this.places[this.selectedDzongkhag]
            }
            
        },
        selectedGewog: function() {
            // Clear previously selected values
            this.chiwogs = [];
            this.selectedChiwog = "";
            // Now we have a Dongkhag and gewog. Populate list of chiwogs in the third dropdown
            if (this.selectedGewog.length > 0) {
                this.chiwogs = this.places[this.selectedDzongkhag][this.selectedGewog]
            }
        }
    },
    
}
</script>
 