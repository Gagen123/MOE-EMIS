<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs" id="mainform">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <a class="nav-link active" data-toggle="pill" role="tab">
                        <span class="card-title pt-2 mb-0">
                            <b id="screenName"></b>
                        </span>
                    </a>
                </ul>
            </div><br>
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <li class="nav-item organization-tab" @click="shownexttab('organization-tab')">
                        <a class="nav-link active" data-toggle="pill" role="tab">
                            <label class="mb-0.5">School Details </label>
                        </a>
                    </li>
                    <li class="nav-item merger-tab" @click="shownexttab('merger-tab')">
                        <a class="nav-link" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Merge the schools </label>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body pt-0 mt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="organization-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="form-group row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label> Year:</label>
                                <label class="text-blue text-bold">{{form.year}}</label>
                            </div><br>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Select the School to be merged to:<span class="text-danger">*</span></label>
                                <select name="orgId1" id="orgId1" v-model="form.orgId1" :class="{ 'is-invalid': form.errors.has('orgId1') }" class="form-control select2">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in orgList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Select School that will be part of the merger:<span class="text-danger">*</span></label>
                                <select name="orgId2" id="orgId2" v-model="form.orgId2" :class="{ 'is-invalid': form.errors.has('orgId2') }" class="form-control select2">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in orgList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" >
                                <div class="card card-primary card-outline">
                                    <div class="card-body">
                                        <h3 class="card-title">School/ECR/ECCD 1</h3>
                                        <hr>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Code:</label>
                                                <span class="text-blue text-bold" id="mergerCode1">{{org1_details.code}}</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Name:</label>
                                                <span class="text-blue text-bold" id="mergerName1">{{org1_details.name}}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Category:</label>
                                                <span class="text-blue text-bold" id="megerCategory1">{{org1_details.category  == 'public_school' ? "Public School" :  "Private School"}}</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Level:</label>
                                                <span class="text-blue text-bold" id="mergerLevel1">{{org1_details.level}}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Dzongkhag:</label>
                                                <span class="text-blue text-bold" id="mergerDzongkhag1">{{org1_details.dzongkhag}}</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Gewog:</label>
                                                <span class="text-blue text-bold" id="mergerGewog1">{{org1_details.gewog}}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Chiwog:</label>
                                                <span class="text-blue text-bold" id="mergerChiwog1">{{org1_details.village}}</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Location Type:</label>
                                                <span class="text-blue text-bold" id="mergerLocationtype1">{{org1_details.locationType}}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Geopolitically Located:</label>
                                                <span class="text-blue text-bold" id="mergerGeoLocated1">{{org1_details.isGeopoliticallyLocated  == 1 ? "Yes" :  "No"}}</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>SEN School:</label>
                                                <span class="text-blue text-bold" id="mergerSen1">{{org1_details.isSenSchool  == 1 ? "Yes" :  "No"}}</span>
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="card card-primary card-outline">
                                    <div class="card-body">
                                        <h3 class="card-title">School/ECR/ECCD 2</h3>
                                        <hr>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Code:</label>
                                                <span class="text-blue text-bold" id="mergerCode1">{{org2_details.code}}</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Name:</label>
                                                <span class="text-blue text-bold" id="mergerName1">{{org2_details.name}}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Category:</label>
                                                <span class="text-blue text-bold" id="megerCategory1">{{org2_details.category  == 'public_school' ? "Public School" :  "Private School"}}</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Level:</label>
                                                <span class="text-blue text-bold" id="mergerLevel1">{{org2_details.level}}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Dzongkhag:</label>
                                                <span class="text-blue text-bold" id="mergerDzongkhag1">{{org2_details.dzongkhag}}</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Gewog:</label>
                                                <span class="text-blue text-bold" id="mergerGewog1">{{org2_details.gewog}}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Chiwog:</label>
                                                <span class="text-blue text-bold" id="mergerChiwog1">{{org2_details.village}}</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Location Type:</label>
                                                <span class="text-blue text-bold" id="mergerLocationtype1">{{org2_details.locationType}}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Geopolitically Located:</label>
                                                <span class="text-blue text-bold" id="mergerGeoLocated1">{{org2_details.isGeopoliticallyLocated  == 1 ? "Yes" :  "No"}}</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>SEN School:</label>
                                                <span class="text-blue text-bold" id="mergerSen1">{{org2_details.isSenSchool  == 1 ? "Yes" :  "No"}}</span>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                        <div class="row form-group">
                           <label><u>Organization Merge Preference:</u><br><small><i>(Check the radio button before redirecting next unless if you want to create new organization)</i></small></label><br>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                                <div class="row form-group">
                                    <label>Merge To School/ECR/ECCD 1:</label>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <input type="radio" name="org1" v-model="form.newOrgType" value="org1" id="org1" @click="showNewOrg('org1')">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label>Merge To School/ECR/ECCD 2:</label>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <input type="radio" name="org2" v-model="form.newOrgType" value="org2" id="org2" @click="showNewOrg('org2')">
                                    </div>
                                </div>  
                                <div class="row form-group" >
                                    <label>Merge To New Organization: &nbsp;&nbsp;&nbsp;</label>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ">
                                        <input type="radio" name="newOrg" v-model="form.newOrgType" value="newOrg" id="newOrg" @click="showNewOrg('newOrg')">
                                    </div>
                                </div>  
                            </div> 
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" @click="shownexttab('merger-tab')"> Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                    <!-- Views for merging the organization -->
                    <div class="tab-pane fade tab-content-details" id="merger-tab" role="tabpanel" aria-labelledby="basicdetails" >
                        <div class="card card-primary card-outline" id="organization1">
                            <div class="card-body">
                                <h3 class="card-title">Merged School Details</h3>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0">Proposed Name:<span class="text-danger">*</span></label>
                                        <input type="text" v-model="form.proposedName" :class="{ 'is-invalid': form.errors.has('proposedName') }" @change="remove_error('proposedName')" class="form-control" id="proposedName" />
                                        <has-error :form="form" field="proposedName"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Code:</label>
                                        <span class="text-blue text-bold" id="mergerCode1">{{org1_details.code}}</span>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Name:</label>
                                        <span class="text-blue text-bold" id="mergerName1">{{org1_details.name}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Category:</label>
                                        <span class="text-blue text-bold" id="megerCategory1">{{org1_details.category  == 'public_school' ? "Public School" :  "Private School"}}</span>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Level:</label>
                                        <span class="text-blue text-bold" id="mergerLevel1">{{org1_details.level}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Dzongkhag:</label>
                                        <span class="text-blue text-bold" id="mergerDzongkhag1">{{org1_details.dzongkhag}}</span>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Gewog:</label>
                                        <span class="text-blue text-bold" id="mergerGewog1">{{org1_details.gewog}}</span>
                                    </div>
                                </div>   
                                <div class="form-group row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Chiwog:</label>
                                        <span class="text-blue text-bold" id="mergerChiwog1">{{org1_details.village}}</span>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Location Type:</label>
                                        <span class="text-blue text-bold" id="mergerLocationtype1">{{org1_details.locationType}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Geopolitically Located:</label>
                                        <span class="text-blue text-bold" id="mergerGeoLocated1">{{org1_details.isGeopoliticallyLocated  == 1 ? "Yes" :  "No"}}</span>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>SEN School:</label>
                                        <span class="text-blue text-bold" id="mergerSen1">{{org1_details.isSenSchool  == 1 ? "Yes" :  "No"}}</span>
                                    </div>
                                </div>
                        </div>
                    </div>
                        <!-- when selecting second organization -->
                        <div class="card card-primary card-outline" id="organization2">
                            <div class="card-body">
                                <h3 class="card-title">Merged School Details</h3>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0">Proposed Name:<span class="text-danger">*</span></label>
                                        <input type="text" v-model="form.proposedName" :class="{ 'is-invalid': form.errors.has('proposedName') }" @change="remove_error('proposedName')" class="form-control" id="proposedName" />
                                        <has-error :form="form" field="proposedName"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Code:</label>
                                        <span class="text-blue text-bold" id="mergerCode1">{{org2_details.code}}</span>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Name:</label>
                                        <span class="text-blue text-bold" id="mergerName1">{{org2_details.name}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Category:</label>
                                        <span class="text-blue text-bold" id="megerCategory1">{{org2_details.category  == 'public_school' ? "Public School" :  "Private School"}}</span>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Level:</label>
                                        <span class="text-blue text-bold" id="mergerLevel1">{{org2_details.level}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Dzongkhag:</label>
                                        <span class="text-blue text-bold" id="mergerDzongkhag1">{{org2_details.dzongkhag}}</span>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Gewog:</label>
                                        <span class="text-blue text-bold" id="mergerGewog1">{{org2_details.gewog}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Chiwog:</label>
                                        <span class="text-blue text-bold" id="mergerChiwog1">{{org2_details.village}}</span>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Location Type:</label>
                                        <span class="text-blue text-bold" id="mergerLocationtype1">{{org2_details.locationType}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Geopolitically Located:</label>
                                        <span class="text-blue text-bold" id="mergerGeoLocated1">{{org2_details.isGeopoliticallyLocated  == 1 ? "Yes" :  "No"}}</span>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>SEN School:</label>
                                        <span class="text-blue text-bold" id="mergerSen1">{{org2_details.isSenSchool  == 1 ? "Yes" :  "No"}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- when they want to create new organization -->
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" id="organization3" >
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">Create New Organization</h3>
                                </div>
                                <div class="card-body">
                                    <form class="form-horizontal">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Name:<span class="text-danger">*</span></label>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <input type="text" class="form-control currentDetails" id="name1" v-model="form.name1" :class="{ 'is-invalid': form.errors.has('name1') }" @change="remove_error('name1')"/>
                                                <has-error :form="form" field="name1"></has-error>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Level:<span class="text-danger">*</span></label>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <select name="level1" id="level1" v-model="form.level1" :class="{ 'is-invalid': form.errors.has('level1') }" class="form-control editable_fields" @change="getCategory1(),remove_error('level1')">
                                                    <option value="">--- Please Select ---</option>
                                                    <option v-for="(item, index) in levelList1" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                </select>
                                                <has-error :form="form" field="level1"></has-error>
                                            </div>
                                        </div>
                                    
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Location Category:<span class="text-danger">*</span></label>
                                            <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                                <select name="locationCategory" v-model="form.location1" :class="{ 'is-invalid': form.errors.has('locationType') }" id="location1" class="form-control editable_fields" @change="remove_error('location1')">
                                                    <option value="">--- Please Select ---</option>
                                                    <option v-for="(item, index) in locationList1" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                </select>
                                                <has-error :form="form" field="location1"></has-error>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Geo-Politically Located:<span class="text-danger">*</span></label>
                                            <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                                <label><input  type="radio" v-model="form.geoLocated1" value="1" tabindex=""/> Yes</label>
                                                <label><input  type="radio" v-model="form.geoLocated1" value="0"  tabindex=""/> No</label>
                                            </div>
                                        </div>

                                        <label class="mb-0"><i><u>Other Details</u></i></label>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Dzongkhag:<span class="text-danger">*</span></label>
                                            <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                                <select v-model="form.dzongkhag1" :class="{ 'is-invalid': form.errors.has('dzongkhag1') }" class="form-control select2" name="dzongkhag1" id="dzongkhag1">
                                                    <option value="">--- Please Select ---</option>
                                                    <option v-for="(item, index) in dzongkhagList1" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                </select>
                                                <has-error :form="form" field="dzongkhag1"></has-error>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Gewog:<span class="text-danger">*</span></label>
                                            <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                                <select v-model="form.gewog1" :class="{ 'is-invalid select2 select2-hidden-accessible':form.errors.has('gewog1') }" class="form-control select2" name="gewog1" id="gewog1">
                                                    <option value="">--- Please Select ---</option>
                                                    <option v-for="(item, index) in gewog_list1" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                </select>
                                                <has-error :form="form" field="gewog1"></has-error>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Chiwog:<span class="text-danger">*</span></label>
                                            <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                                <select v-model="form.chiwog1" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('chiwog1') }" class="form-control select2" name="chiwog1" id="chiwog1">
                                                    <option value="">--- Please Select ---</option>
                                                    <option v-for="(item, index) in villageList1" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                </select>
                                                <has-error :form="form" field="chiwog1"></has-error>
                                            </div>
                                        </div>
                                        <label class="mb-0"><i><u>Class & Stream Details</u></i></label>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                                            <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Classes</th>
                                                        <th class="strm_clas">Stream</th>
                                                        <!-- <th></th> -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(item, key, index) in  classStreamList" :key="index">
                                                        <td>
                                                            <label class="pr-4"> &nbsp;{{ item.class }} </label>
                                                        </td>
                                                        <td class="strm_clas" v-if="item.class=='Class 11' || item.class=='XI' || item.class=='Class 12' || item.class=='XII'">
                                                            {{  item.stream  }}
                                                        </td>
                                                        <td class="strm_clas" v-else>

                                                        </td>
                                                        <td v-if="item.class=='Class 11' || item.class=='XI' || item.class=='Class 12' || item.class=='XII'">
                                                            <input type="checkbox" v-model="form.stream"  :id="item.id" :value="item.id">
                                                        </td>
                                                        <td v-else>
                                                            <input type="checkbox" v-model="form.class" :value="item.classId">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" @click="shownexttab('final-tab')"> <i class="fa fa-save"></i>Submit </button>
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
            orgList:[],
            org1_details:'',
            org2_details:'',
            next_tab:false,
            form: new form({
                id: '',
                orgId1:'',
                orgId2:'',
                year:'',
                proposedName:'',
                level:'',
                category:'1',
                dzongkhag:'',
                gewog:'',
                chiwog:'',
                locationType:'',
                geoLocated:'0',
                senSchool:'0',
                parentSchool:'',
                coLocated:'0',
                cid:'',
                name:'',
                phoneNo:'',
                email:'',
                screenId:'',
                SysRoleId:'',
                Sequence:'',
                Status_Name:'',
                screen_name:'',
                class:[],
                stream:[],
                name1:'',level1:'',category1:'1',dzongkhag1:'',gewog1:'',chiwog1:'',location1:'',newOrgType:'',
                class:[],stream:[],

            }),
            levelList:[],
            levelList1:[],
            locationList1:[],
            dzongkhagList1:[],
            gewog_list1:[],
            villageList1:[],
            classStreamList:[],
            locationList:[],
            classList:[],
            streamList:[],
            dzongkhagList:[],
            gewog_list:[],
            villageList:[],
        }
    },
    methods: {
        /**
         * method to get current school unbder current user
         */
        //getOrgList(uri = '/organization/getOrgList'){
        getOrgList(uri = 'loadCommons/loadOrgList/userdzongkhagwise/NA'){
            axios.get(uri)
            .then(response => {
                this.orgList = response.data.data;
            });
        },
        getOrgDetails(id,fieldId){
            let getdet=true;
            if(fieldId=="orgId2" && id==this.form.orgId1){
                Swal.fire({
                    text: "You cannot select same school",
                    icon: 'error',
                    confirmButtonText: 'Ok!',
                });
                this.form.orgId2="";
                this.next_tab=false;
                this.org2_details='';
                getdet=false;
            }
            if(fieldId=="orgId1" && id==this.form.orgId2){
                Swal.fire({
                    text: "Sorry! You cannot select same school",
                    icon: 'error',
                    confirmButtonText: 'OK!',
                });
                getdet=false;
                this.next_tab=false;
                this.org1_details='';
                this.form.orgId1="";
            }
            if(getdet){
                this.next_tab=true;
                let uri = '/organization/loadCurrentOrgDetails/'+id;
                axios.get(uri)
                .then(response =>{
                    if(fieldId=="orgId1"){
                        this.org1_details=response.data.data;
                        this.org1_details.village=response.data.data.village.data.name;
                        this.org1_details.gewog=response.data.data.gewog.data.name;
                        this.org1_details.dzongkhag=response.data.data.dzongkhag.data.name;
                    }
                    if(fieldId=="orgId2"){
                        this.org2_details=response.data.data;
                        this.org2_details.village=response.data.data.village.data.name;
                        this.org2_details.gewog=response.data.data.gewog.data.name;
                        this.org2_details.dzongkhag=response.data.data.dzongkhag.data.name;
                    }
                });
            }
        },

        /**
         * method to get other category if the category is 'ECCD'
         */
        getCategory(){
            let level = $('#level option:selected').text();
            if(level == "ECCD"){
                $(".eccd").show();
            }
            else{
                $(".eccd").hide();
            }
        },
        getCategory1(){
            let level = $('#level1 option:selected').text();
            $('.strm_clas').hide();
            if(level.toLowerCase().includes('middle')){
                level="10";
            }
            else if(level.toLowerCase().includes('lower')){
                level="8";
            }
            else if(level.toLowerCase().includes('primary')){
                level="6";
            }
            else{
                level="12";
                $('.strm_clas').show();
            }
            axios.get('/masters/loadClassStreamMapping/school_'+level)
              .then(response => {
                this.classStreamList = response.data.data;
            });
        },
        getLevel1(uri = '/organization/getLevelInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.levelList1 = data;
            });
        },
        loadactivedzongkhagList1(uri="masters/loadGlobalMasters/all_active_dzongkhag"){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.dzongkhagList1 =  data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        getLocation1(uri = '/organization/getLocationInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.locationList1 = data;
            });
        },
        showNewOrg:function(type){
            if(type=="org1"){
                $('#organization1').show();
                $('#organization2').hide();
                $('#organization3').hide();
            }
            else if(type=="org2"){
                 $('#organization1').hide();
                $('#organization2').show();
                $('#organization3').hide();
            }
            else {
                $('#organization1').hide();
                $('#organization2').hide();
                $('#organization3').show();
            }
        },
        loadProprietorDetails(){
            axios.get('organization/loadProprietorDetails')
            .then((response) => {

                let data=response.data.data[0];
                this.form.cid           =   data.cid;
                this.form.name          =   data.fullName;
                this.form.phoneNo       =   data.phoneNo;
                this.form.email         =   data.email;
            })
            .catch((error) => {
                console.log("Error......"+error);
            });
        },

        /**
         * method to get level in dropdown
         */
        getLevel(uri = '/organization/getLevelInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.levelList = data;
            });
        },

        /**
         * method to get location in dropdown
         */
        getLocation(uri = '/organization/getLocationInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.locationList = data;
            });
        },

        /**
         * method to get class in checkbox
         */
        getClass:function(){
            axios.get('/loadCommons/getClassByType/school')
              .then(response => {
                this.classList = response.data;
            });
        },

        /**
         * method to get stream in checkbox
         */
        getStream:function(){
            axios.get('/organization/getStream')
              .then(response => {
                this.streamList = response.data;
            });
        },

        /**
         * method to get active dzongkhag list
         */
        loadactivedzongkhagList(uri="masters/loadGlobalMasters/all_active_dzongkhag"){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.dzongkhagList =  data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },

        /**
         * method to get gewog list
         */
        async getgewoglist(id){
            let dzoId=$('#dzongkhag').val();
            if(id!="" && dzoId==null){
                dzoId=id;
            }
            let uri = 'masters/all_active_dropdowns/dzongkhag/'+dzoId;
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.gewog_list = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        async getgewoglist1(id){
            let dzoId=$('#dzongkhag1').val();
            if(id!="" && dzoId==null){
                dzoId=id;
            }
            let uri = 'masters/all_active_dropdowns/dzongkhag/'+dzoId;
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.gewog_list1 = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        async getvillagelist1(id){
            let gewogId=$('#gewog1').val();
            if(id!="" && gewogId==null){
                gewogId=id;
            }
            let uri = 'masters/all_active_dropdowns/gewog/'+gewogId;
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.villageList1 = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        /**
         * method to get gewog list
         */
        async getvillagelist(id){
            let gewogId=$('#gewog').val();
            if(id!="" && gewogId==null){
                gewogId=id;
            }
            let uri = 'masters/all_active_dropdowns/gewog/'+gewogId;
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.villageList = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },

        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="orgId1"){
                this.form.orgId1 = $('#orgId1').val();
                this.getOrgDetails(this.form.orgId1,''+id);
            }
            if(id=="orgId2"){
                this.form.orgId2 = $('#orgId2').val();
                this.getOrgDetails(this.form.orgId2,''+id);
            }
            if(id=="level"){
                this.form.level=$('#level').val();
                this.getCategory();
            }
            if(id=="dzongkhag"){
                this.form.dzongkhag = $('#dzongkhag').val();
                this.getgewoglist();
            }
            if(id=="gewog"){
                this.form.gewog = $('#gewog').val();
                this.getvillagelist();
            }
            if(id=="chiwog"){
                this.form.chiwog=$('#chiwog').val();
            }
            if(id=="locationType"){
                this.form.locationType=$('#locationType').val();
            }
            if(id=="parentSchool"){
                this.form.parentSchool=$('#parentSchool').val();
            }
            if(id=="parent_id"){
                this.form.parent_id=$('#parent_id').val();
                this.getOrgDetails($('#parent_id').val());
            }
            if(id=="dzongkhag1"){
                this.form.dzongkhag1=$('#dzongkhag1').val();
                this.getgewoglist1();
            }
            if(id=="gewog1"){
                this.form.gewog1=$('#gewog1').val();
                this.getvillagelist1();
            }
            if(id=="chiwog1"){
                this.form.chiwog1=$('#chiwog1').val();
            }
        },

        /**
         * method to show next and previous tab
         */
        shownexttab(nextclass){
            if(nextclass=="final-tab"){
                Swal.fire({
                    text: "Are you sure you wish to submit this details for approval ?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        this.form.post('organization/saveMerger')
                        .then((response) => {
                            if(response!=""){
                                let message="Application for Merger has been submitted for approval. System Generated application number for this transaction is: <b>"+response.data.data.notification_appNo+'.</b><br> Use this application number to track your application status. <br><b>Thank You !</b>';
                                this.$router.push({name:'restr_acknowledgement',params: {data:message}});
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Merger details has been submitted for further action.'
                                });
                            }
                        })
                        .catch((err) => {
                            console.log("Error:"+err);
                            this.applyselect2();
                        })
                    }
                });
            }
            else{
                if(this.form.orgId2!="" && this.form.orgId1!=""){
                    this.change_tab(nextclass);
                }
                else{
                    Swal.fire({
                        text: "Form is not completely filled up. Please complete them all",
                        icon: 'error',
                        confirmButtonText: 'OK!',
                    });
                }
            }
        },
        change_tab(nextclass){
            if(this.next_tab){
                $('#tabhead >li >a').removeClass('active');
                $('#tabhead >li >a >span').addClass('bg-gradient-secondary text-white');
                $('.'+nextclass+' >a').addClass('active');
                $('.'+nextclass+' >a >span').removeClass('bg-gradient-secondary text-white');
                $('.'+nextclass+' >a').removeClass('disabled');
                $('.tab-content-details').hide();
                $('#'+nextclass).show().removeClass('fade');
            }
            else{
                Swal.fire({
                    text: "Form is not completely filled up. Please complete them all",
                    icon: 'error',
                    confirmButtonText: 'OK!',
                });
            }
        },
        applyselect2(){
            if(!$('#level').attr('class').includes('select2-hidden-accessible')){
                $('#level').addClass('select2-hidden-accessible');
            }
            if(!$('#dzongkhag').attr('class').includes('select2-hidden-accessible')){
                $('#dzongkhag').addClass('select2-hidden-accessible');
            }
            if(!$('#gewog').attr('class').includes('select2-hidden-accessible')){
                $('#gewog').addClass('select2-hidden-accessible');
            }
            if(!$('#chiwog').attr('class').includes('select2-hidden-accessible')){
                $('#chiwog').addClass('select2-hidden-accessible');
            }
            if(!$('#locationType').attr('class').includes('select2-hidden-accessible')){
                $('#locationType').addClass('select2-hidden-accessible');
            }
            if(!$('#parentSchool').attr('class').includes('select2-hidden-accessible')){
                $('#parentSchool').addClass('select2-hidden-accessible');
            }
        },

        loadScreenDetails(){
            axios.get('organizationApproval/getScreenId/Merger__'+1)
            .then(response => {
                let data = response.data.data;
                if(data!=undefined && data!="NA"){
                    $('#screenName').html('<b>Creating Application for '+data.screenName+'</b>');
                    this.form.screenId=data.screen;
                    this.form.SysRoleId=data.SysRoleId;
                    this.form.Sequence=data.Sequence;
                    this.form.Status_Name=data.Status_Name;
                    this.form.screen_name=data.screenName;
                    $('#screenPermission').hide();
                    $('#mainform').show();
                }
                else{
                    $('#message').html('<b>You are not eligible to visit this page. Please contact system administrator for further assistant</b>');
                    $('#screenPermission').show();
                    $('#mainform').hide();
                }
            })
            .catch(errors => {
                console.log(errors)
            });
        },
    },

    mounted() {
        let currentdate = new Date();
        let current_year =(currentdate.getFullYear());
        this.form.year=current_year;
        $('[data-toggle="tooltip"]').tooltip();
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

       
        this.loadScreenDetails();
        this.getOrgList();
        this.getLevel();
        this.getLevel1();
        this.getLocation1();
        this.getLocation();
        this.getClass();
        this.getStream();
        this.loadactivedzongkhagList();
        this.loadactivedzongkhagList1();
        // this.checkPendingApplication();

    },
}
</script>
