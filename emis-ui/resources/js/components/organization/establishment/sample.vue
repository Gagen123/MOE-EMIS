<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <li class="nav-item application-tab" @click="shownexttab('application-tab')">
                        <a class="nav-link active" data-toggle="pill" role="tab"> 
                            <label class="mb-0.5">Wash </label>                              
                        </a>
                    </li>
                    <li class="nav-item service-tab" @click="shownexttab('service-tab')">
                        <a class="nav-link" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Sanitation </label>
                        </a>
                    </li>
                    <li class="nav-item undertaking-tab" @click="shownexttab('undertaking-tab')">
                        <a class="nav-link" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Hygience</label>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body pt-0 mt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="application-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <table id="waterTable" class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <thead>
                                <tr>
                                    <th width="50px">Description</th>
                                    <th width="50px">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="record1">
                                    <td>Does the school have Independent water source? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form.idependentWaterSource"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.idependentWaterSource"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record2">
                                    <td>What is the main source* of water provided at the school?</td>
                                    <td>
                                        <div class=" row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" id="pipe" v-model="form.waterSource1" name="pipe" value="1">&nbsp;
                                            <label for="pipe" > Piped water supply </label>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" id="source" v-model="form.waterSource2" name="source" value="2">&nbsp;
                                            <label for="source"> No water supply/source </label><br>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" id="river" v-model="form.waterSource3" name="river" value="3">&nbsp;
                                            <label for="river"> Surface water(Lake, river, stream) </label><br>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" id="stored" v-model="form.waterSource4" name="stored" value="4">&nbsp;
                                            <label for="stored"> Stored water </label><br>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" id="well" v-model="form.waterSource5" name="well" value="5">&nbsp;
                                            <label for="well"> Tube well /Borehole water </label><br>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" id="rainWater" v-model="form.waterSource6" name="rainWater" value="6">&nbsp;
                                            <label for="rainWater"> Rainwater </label><br>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" id="spring" v-model="form.waterSource7" name="spring" value="7">&nbsp;
                                            <label for="spring"> Unprotected spring </label><br>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" id="protected" v-model="form.waterSource8" name="protected" value="8">&nbsp;
                                            <label for="protected"> Protected spring </label><br>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" id="dug" v-model="form.waterSource9" name="dug" value="9">&nbsp;
                                            <label for="dug"> Protected dug well </label><br>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" id="oth" v-model="form.waterSource10" name="v" value="10">&nbsp;
                                            <label for="oth"> Others(Please Specify) </label><br>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="text" class="form-control" v-model="form.otherWaterSource" id="specify" name="specify" >
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record3">
                                    <td>Availability of Water from main supply/source in the school?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <select name="category" v-model="form.waterAvailability" id="category" class="form-control editable_fields">
                                                <option value="">--- Please Select ---</option>
                                                <option value="1">Yes(Always)</option>
                                                <option value="2">Mostly(Unavailable >= 30 days total)</option>
                                                <option value="3">No(Unavailable > 30 days total)</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record4">
                                    <td>The school have enough water for</td>
                                    <td>
                                        <div class=" row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" id="drinking" v-model="form.enoughWater" name="drinking" value="1">&nbsp;
                                            <label for="drinking"> Drinking </label>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" id="handWashing" v-model="form.enoughWater" name="handWashing" value="2">&nbsp;
                                            <label for="handWashing"> Hand Washing</label><br>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" id="bathing" v-model="form.enoughWater" name="bathing" value="3">&nbsp;
                                            <label for="bathing"> Bathing </label><br>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" id="sanitatio" v-model="form.enoughWater" name="sanitatio" value="4">&nbsp;
                                            <label for="sanitatio"> Sanitation need </label><br>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" id="cooking" v-model="form.enoughWater" name="cooking" value="5">&nbsp;
                                            <label for="cooking"> Cooking </label><br>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record5">
                                    <td>Does the school have functional water supply liname?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form.functionalWater"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.functionalWater"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record6">
                                    <td>Number of functional Tap Heads</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="text" name="funTape" v-model="form.functionalTap" class="form-control" id="funTape" > 
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record7">
                                    <td>Number of Non-functional Tap Heads</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="text" name="nonFunTape" v-model="form.nonFunctionalTap" class="form-control" id="nonFunTape" > 
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record8">
                                    <td>Is drinking water accessible to those with limited mobility or vision?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form.waterForLimitedVision"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.waterForLimitedVision"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record9">
                                    <td>Is drinking water accessible to the smallest children?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form.nonFunctionalTap"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.nonFunctionalTap"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record10">
                                    <td>Treatment Method(s)</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" id="filtration" v-model="form.treatmentMethod" name="filtration" value="1">&nbsp;
                                            <label for="filtration"> Filtration </label><br>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" id="boiling" v-model="form.treatmentMethod" name="boiling" value="2">&nbsp;
                                            <label for="boiling"> Boiling </label><br>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" id="chlorination" v-model="form.treatmentMethod" name="chlorination" value="3">&nbsp;
                                            <label for="chlorination"> Chlorination </label><br>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" id="solDisinfection" v-model="form.treatmentMethod" name="solDisinfection" value="4">&nbsp;
                                            <label for="solDisinfection"> Solar disinfection  </label><br>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" id="ulDisinfection" v-model="form.treatmentMethod" name="ulDisinfection" value="5">&nbsp;
                                            <label for="ulDisinfection"> Untraviolet(UV) disinfection</label><br>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" id="noTreatment" v-model="form.treatmentMethod" name="noTreatment" value="6">&nbsp;
                                            <label for="noTreatment">No Treatment</label><br>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" id="other" v-model="form.treatmentMethod" name="other" value="7">
                                            <label for="other">Other treatment method (Please specify)</label><br>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="text" id="" name="" v-model="form.otherMethod" class="form-control">
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record11">
                                    <td>Has the main water source been tested for drinking in the past 12 months?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form.waterTested"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.waterTested"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" @click="shownexttab('service-tab')">Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade tab-content-details" id="service-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <table id="dynamic-table1" class="table w-100  table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="60px">Description</th>
                                    <th width="40px">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="record1">
                                    <td>No. of USABLE (functional, accessable,private) AQUA PRIVY Toilet pots for Students(Exclusively for Girls)</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="text" name="toiletPot" v-model="form1.data1" id="toiletPot" class="form-control"> 
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record2">
                                    <td>No. of USABLE (functional, accessable,private) AQUA PRIVY Toilet pots for Students(Exclusively for Boys)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="toiletPot1" v-model="form1.data2" id="toiletPot1" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record3">
                                    <td>No. of USABLE (functional, accessable,private) AQUA PRIVY Toilet pots for Students(Common/for both Girls and Boys)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="toiletPot2" v-model="form1.data3"  id="toiletPot2" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record4">
                                    <td>No. of USABLE (functional, accessable,private) AQUA PRIVY Toilet pots for Staff(Exclusively for Female)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="toiletPotStaff" v-model="form1.data4" id="toiletPotStaff" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record5">
                                    <td>No. of USABLE (functional, accessable,private) AQUA PRIVY Toilet pots for Staff(Exclusively for Male)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="toiletPotStaff1" v-model="form1.data5"  id="toiletPotStaff1" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record6">
                                    <td>No. of USABLE (functional, accessable,private) AQUA PRIVY Toilet pots for Staff(Common/for both Male and Female)</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="toiletPotStaff2"  id="toiletPotStaff2" v-model="form1.data6" class="form-control"> 
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record7">
                                    <td>No. of USABLE (functional, accessable,private) FLUSH/POUR FLUSH Toilet pots for Students(Exclusively for Girls)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="flushStudent"  id="flushStudent" v-model="form1.data7" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record8">
                                    <td>No. of USABLE (functional, accessable,private) FLUSH/POUR FLUSH Toilet pots for Students(Exclusively for Boys)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="flushStudent1"  id="flushStudent1" v-model="form1.data8" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record9">
                                    <td>No. of USABLE (functional, accessable,private) FLUSH/POUR FLUSH Toilet pots for Students(Common/for both Girls and Boys)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="flushStudent2" v-model="form1.data9"  id="flushStudent2" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record10">
                                    <td>No. of USABLE (functional, accessable,private) FLUSH/POUR FLUSH Toilet pots for Staff(Exclusively for Female)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="flushStaff" v-model="form1.data10" id="flushStaff" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record11">
                                    <td>No. of USABLE (functional, accessable,private) FLUSH/POUR FLUSH Toilet pots for Staff(Exclusively for Male)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="flushStaff1" v-model="form1.data11" id="flushStaff1" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record12">
                                    <td>No. of USABLE (functional, accessable,private) FLUSH/POUR FLUSH Toilet pots for Staff(Common/for both Male and Female)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="flushStaff2"  id="flushStaff2" v-model="form1.data12" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record13">
                                    <td>No. of USABLE (functional, accessable,private) PIT LATRIname Toilet pots for Students(Exclusively for Girls)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="pitStudent"  id="pitStudent" v-model="form1.data13" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record14">
                                    <td>No. of USABLE (functional, accessable,private) PIT LATRIname Toilet pots for Students(Exclusively for Boys)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="pitStudent1"  id="pitStudent1" v-model="form1.data14" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record15">
                                    <td>No. of USABLE(functional, accessable,private) PIT LATRIname Toilet pots for Student(Common/for both Boys and Girls)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="pitStudent2"  id="pitStudent2" v-model="form1.data15" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record16">
                                    <td>No. of USABLE (functional, accessable,private) PIT LATRIname Toilet pots for Staff(Exclusively for Female)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="pitStaff"  id="pitStaff" v-model="form1.data16" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record17">
                                    <td>No. of USABLE (functional, accessable,private) PIT LATRIname Toilet pots for Staff(Exclusively for Male)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="pitStaff1"  id="pitStaff1" v-model="form1.data17" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record18">
                                    <td>No. of USABLE(functional, accessable,private) PIT LATRIname Toilet pots for Student(Common/for both Male and Female)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="pitForStudent"  id="pitForStudent" v-model="form1.data18" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record19">
                                    <td>No. of UN-USABLE (non-functional, in-accessable,not-private) AQUA PRIVY Toilet pots for Students(Exclusively for Girls)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="pitForStudent1"  id="pitForStudent1" v-model="form1.data19" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record20">
                                    <td>No. of UN-USABLE (non-functional, in-accessable,not-private) AQUA PRIVY Toilet pots for Students(Exclusively for Boys)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="pitForStudent2"  id="pitForStudent2" v-model="form1.data20" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record21">
                                    <td>No. of UN-USABLE (non-functional, in-accessable,not-private) AQUA PRIVY Toilet pots for Staff(Common/for both Girls and Boys)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" v-model="form1.data21" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record22">
                                    <td>No. of UN-USABLE (non-functional, in-accessable,not-private) AQUA PRIVY Toilet pots for Staff(Exclusively for Female)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" v-model="form1.data22" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record23">
                                    <td>No. of UN-USABLE (non-functional, in-accessable,not-private) AQUA PRIVY Toilet pots for Staff(Exclusively for Male)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" v-model="form1.data23" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record24">
                                    <td>No. of UN-USABLE (non-functional, in-accessable,not-private)AQUA PRIVY Toilet pots for Staft(Common/for both Male and Female)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" v-model="form1.data24" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record25">
                                    <td>No. of UN-USABLE (non-functional, in-accessable,not-private) FLUSH/POUR FLUSH Toilet pots for Students(Exclusively for Girls)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" v-model="form1.data25" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record26">
                                    <td>No. of UN-USABLE (non-functional, in-accessable,not-private) FLUSH/POUR FLUSH Toilet pots for Students(Exclusively for Boys)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" v-model="form1.data26" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record27">
                                    <td>No. of UN-USABLE (non-functional, in-accessable,not-private) FLUSH/POUR FLUSH Toilet pots for Students(Common/for both Girls and Boys)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" v-model="form1.data27" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record28">
                                    <td>No. of UN-USABLE (non-functional, in-accessable,not-private) FLUSH/POUR FLUSH Toilet pots for Staff(Exclusively for Female)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" v-model="form1.data28" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record29">
                                    <td>No. of UN-USABLE (non-functional, in-accessable,not-private) FLUSH/POUR FLUSH Toilet pots for Staff(Exclusively for Male)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" v-model="form1.data29" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record30">
                                    <td>No. of UN-USABLE (non-functional, in-accessable,not-private) FLUSH/POUR FLUSH Toilet pots for Staff(Common/for both Male and Female)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" v-model="form1.data30" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record31">
                                    <td>No. of UN-USABLE (not-functional, in-accessable,not-private) PIT LATRIname Toilet pots for Students(Exclusively for Girls)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" v-model="form1.data31" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record32">
                                    <td>No. of UN-USABLE (not-functional, in-accessable,not-private) PIT LATRIname Toilet pots for Students (Exclusively for Boys)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" v-model="form1.data32" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record33">
                                    <td>No. of UN-USABLE (not-functional, in-accessable,not-private) PIT LATRIname Toilet pots for Students(Common/for both Girls and Boys)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" v-model="form1.data33" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record34">
                                    <td>No. of UN-USABLE (not-functional, in-accessable,not-private) PIT LATRIname Toilet pots for Staff(Exclusively for Female)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" v-model="form1.data34" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record35">
                                    <td>No. of UN-USABLE (not-functional, in-accessable,not-private) PIT LATRIname Toilet pots for Staff(Exclusively for Male)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" v-model="form1.data35" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record36">
                                    <td>No. of UN-USABLE (not-functional, in-accessable,not-private) PIT LATRIname Toilet pots for Staff(Common/for both Male and Female)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" v-model="form1.data36" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record37">
                                    <td>Does the School have Washing amenities in toilets that has both water and soap available for Students (Exclusively for Girls)?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.radio1"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form1.radio1"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record38">
                                    <td>Does the School have Washing amenities in toilets that has both water and soap available for Students (Exclusively for Boys)?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.radio2"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form1.radio2"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record39">
                                    <td>Does the School have Washing amenities in toilets that has both water and soap available for Students (Common/for both Girls and Boys)?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.radio3"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form1.radio3"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record40">
                                    <td>Does the School have Washing amenities in toilets that has both water and soap available for Staff (Exclusively for Female)?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.radio4"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form1.radio4"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record41">
                                    <td>Does the School have Washing amenities in toilets that has both water and soap available for Staff (Exclusively for Male)?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.radio5"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form1.radio5"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record42">
                                    <td>Does the School have Washing amenities in toilets that has both water and soap available for Staff (Common/for both Male and Female)?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.radio6"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form1.radio6"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record43">
                                    <td>Does the School have Washing amenities in toilets that has only water but no soap for Students (Exclusively for Girls)?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.radio7"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form1.radio7"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record44">
                                    <td>Does the School have Washing amenities in toilets that has only water but no soap for Students (Exclusively for Boys)?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.radio8"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form1.radio8"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record45">
                                    <td>Does the School have Washing amenities in toilets that has only water but no soap for Students (Common/for both Girls and Boys)?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.radio9"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form1.radio9"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record46">
                                    <td>Does the School have Washing amenities in toilets that has only water but no soap for Staff (Exclusively for Female)?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.radio10"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form1.radio10"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record47">
                                    <td>Does the School have Washing amenities in toilets that has only water but no soap for Staff (Exclusively for Male)?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.radio11"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form1.radio11"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record48">
                                    <td>Does the School have Washing amenities in toilets that has only water but no soap for Staff (Common/for both Male and Female)?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.radio12"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form1.radio12"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record49">
                                    <td>Does the School have Washing amenities in toilets that has no water for Students (Exclusively for Girls)?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.radio13"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form1.radio13"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record50">
                                    <td>Does the School have Washing amenities in toilets that has no water for Students (Exclusively for Boys)?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.radio14"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form1.radio14"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record51">
                                    <td>Does the School have Washing amenities in toilets that has no water for Students (Common/for both Girls and Boys)?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.radio15"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form1.radio15"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record52">
                                    <td>Does the School have Washing amenities in toilets that has no water for Staff(Exclusively for Female)?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.radio16"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form1.radio16"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record53">
                                    <td>Does the School have Washing amenities in toilets that has no water for Staff(Exclusively for Male)?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.radio17"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form1.radio17"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record54">
                                    <td>Does the School have Washing amenities in toilets that has no water for Staff(Common/for both Male and Female)?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.radio18"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form1.radio18"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record55">
                                    <td>Is there changing room(s) for Menstrual Hygiename Management (MHM)?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.radio19"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form1.radio19"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record56">
                                    <td>Is there covered disposal bins for Menstrual Hygiename Management (MHM)?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.radio20"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form1.radio20"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record57">
                                    <td>Does the school have disposal mechanisms for menstrual hygiename wastes?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.radio21"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form1.radio21"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record58">
                                    <td>Is there at least oname usable toilet that is accessible to children with limited mobility or vision?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.radio22"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form1.radio22"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record59">
                                    <td>Is there at least oname usable toilet that is accessible to the smallest children?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.radio23"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form1.radio23"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record60">
                                    <td>Is there adequate Lighting in Girls’ Toilet?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.radio24"  value="0" tabindex=""/> All Toilets</label>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.radio24"  value="1" tabindex=""/> Some Toilets</label>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.radio24"  value="2" tabindex=""/> Non of the Toilets</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record61">
                                    <td>Is there adequate Lighting in Boys’ Toilet?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.radio25"  value="0" tabindex=""/> All Toilets</label>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.radio25"  value="1" tabindex=""/> Some Toilets</label>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.radio25"  value="2" tabindex=""/> Non of the Toilets</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record62">
                                    <td>Is there adequate Lighting in Students’ common toilet?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.radio26"  value="0" tabindex=""/> All Toilets</label>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.radio26"  value="1" tabindex=""/> Some Toilets</label>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.radio26"  value="2" tabindex=""/> Non of the Toilets</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record63">
                                    <td>How are the faecal sludge(septic tanks) managed?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.radio27"  value="0" tabindex=""/> Yes, Safely Buried/covered</label>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.radio27"  value="1" tabindex=""/> Yes, Safely Transported to a treatment plant</label>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.radio27"  value="2" tabindex=""/> No proper management</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record64">
                                    <td>How frequently are the student’s toilets cleanamed?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.radio28"  value="0" tabindex=""/> Daily</label>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.radio28"  value="1" tabindex=""/> 2-4 Days a week</label>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.radio28"  value="2" tabindex=""/> Once a week</label>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.radio28"  value="3" tabindex=""/> Less than once a week</label>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.radio28"  value="4" tabindex=""/> Not at all</label>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('application-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-primary" @click="shownexttab('undertaking-tab')"> <i class="fa fa-arrow-right"></i>Next </button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade tab-content-details" id="undertaking-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <table id="dynamic-table2" class="table w-100  table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th >Description</th>
                                    <th >Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="record1">
                                    <td>Types of hand washing facilities</td>
                                    <td>
                                       <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" id="tapePoint" name="tapePoint" value="1">&nbsp;
                                            <label for="tapePoint"> Tap Point </label><br>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" id="tippyTape" name="tippyTape" value="2">&nbsp;
                                            <label for="tippyTape"> Tippy Tap </label><br>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" id="bucketCan" name="bucketCan" value="3">&nbsp;
                                            <label for="bucketCan"> Bucket/Jerry Can </label><br>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" id="no" name="no" value="4">&nbsp;
                                            <label for="no"> No Hand Washing Facilities </label><br>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" id="others" name="others" value="5">&nbsp;
                                            <label for="others"> Others(Please Specify) </label><br>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="text" id="" name="" class="form-control">
                                        </div> 
                                    </td>
                                </tr>
                                <tr id="record2">
                                    <td>No. of FUNCTIONAL Tap points for hand washing exclusively for GIRLS</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="text" class="form-control" id="" name=""/>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record3">
                                    <td>No. of NON-FUNCTIONAL Tap points for hand washing exclusively for GIRLS</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="text" class="form-control" id="" name=""/>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record4">
                                    <td>No. of FUNCTIONAL Tap points for hand washing exclusively for BOYS</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="text" class="form-control" id="" name=""/>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record5">
                                    <td>No. of NON-FUNCTIONAL Tap points for hand washing exclusively for BOYS</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="text" class="form-control" id="" name=""/>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record6">
                                    <td>No. of FUNCTIONAL Tap points for hand washing for Communal use(for both Boys and Girls)</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="text" class="form-control" id="" name=""/>
                                        </div>
                                    </td>
                                </tr>

                                <tr id="record7">
                                    <td>No. of NON-FUNCTIONAL Tap points for hand washing exclusively for Communal use(for both Boys and Girls)</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="text" class="form-control" id="" name=""/>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record8">
                                    <td>Availability of hand washing facilities apart from toilets</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form2.radio1"  value="0" tabindex=""/> Yes, Water and Soap</label>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">                                            
                                            <label><input  type="radio" v-model="form2.radio1"  value="1" tabindex=""/>Water only</label>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">                                            
                                            <label><input  type="radio" v-model="form2.radio1"  value="2" tabindex=""/> Nither Soap nor Water</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record9">
                                    <td>Are hand washing facilities accessible to those with limited mobility or vision?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form2.radio2"  value="0" tabindex=""/>Yes</label>
                                            <label><input  type="radio" v-model="form2.radio2"  value="1" tabindex=""/>No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record10">
                                    <td>Are hand washing facilities accessible to the smallest children?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form2.radio3"  value="0" tabindex=""/>Yes</label>
                                            <label><input  type="radio" v-model="form2.radio3"  value="1" tabindex=""/>No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="recor11">
                                    <td>Where are the hand washing facilities with water and soap located?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" id="located" name="located" value="1">&nbsp;
                                            <label for="located"> Toilets </label><br>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" id="dinningHall" name="dinningHall" value="2">&nbsp;
                                            <label for="dinningHall"> Near Dining Hall </label><br>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" id="academic" name="academic" value="3">&nbsp;
                                            <label for="academic"> Academic Building </label><br>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" id="kitchen" name="kitchen" value="4">&nbsp;
                                            <label for="kitchen"> Kitchen </label><br>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" id="othersSpecify" name="othersSpecify" value="5">&nbsp;
                                            <label for="othersSpecify"> Others(Please Specify) </label><br>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="text" id="" name="" class="form-control">
                                        </div>
                                    </td>
                                </tr>
                                <tr id="recor12">
                                    <td>How many times per week are group hand washing activities conducted for all students?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">                                            
                                            <label><input  type="radio" v-model="form2.radio4"  value="0" tabindex=""/>At least once a week</label>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="activity"  value="No">2-4 days per week
                                            <label><input  type="radio" v-model="form2.radio4"  value="1" tabindex=""/>2-4 days per week</label>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">                                            
                                            <label><input  type="radio" v-model="form2.radio4"  value="2" tabindex=""/>Daily</label>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="geactivityo"  value="No">Less than once a week
                                            <label><input  type="radio" v-model="form2.radio4"  value="3" tabindex=""/>Less than once a week</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="recor13">
                                    <td>How are the solid wastes(Garbage) managed?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <select name="category" id="category" class="form-control editable_fields " @change="show()">
                                                <option value="">--- Please Select ---</option>
                                                <option value="1">Collected by municipality</option>
                                                <option value="2">Burnt on premises</option>
                                                <option value="3">Buried on premises</option>
                                                <option value="4">Openly dumped on premises</option>
                                                <option value="5">Dumped on public premises</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="recor14">
                                    <td>How many bathing areas are available for BOYS?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="text" class="form-control" id="located" name="located" value="">
                                        </div>
                                    </td>
                                </tr>
                                <tr id="recor15">
                                    <td>How many bathing areas are available for GIRLS?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="text" class="form-control" id="located" name="located" value="">
                                        </div>
                                    </td>
                                </tr>
                                <tr id="recor16">
                                    <td>Is there at least oname bathing area for those with limited mobility and vision?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form2.radio5"  value="0" tabindex=""/>Yes</label>
                                            <label><input  type="radio" v-model="form2.radio5"  value="1" tabindex=""/>No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="recor17">
                                    <td>Is there hot water available for bathing?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form2.radio6" value="0" tabindex=""/>Always</label>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="hot"  value="2">Sometimes
                                            <label><input  type="radio" v-model="form2.radio6" value="1" tabindex=""/>Sometimes</label>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form2.radio6" value="2" tabindex=""/>Never</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="recor18">
                                    <td>How frequently is hygiename education taught in the school?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <select name="category" id="category" class="form-control editable_fields " @change="show()">
                                                <option value="">--- Please Select ---</option>
                                                <option value="1">Daily</option>
                                                <option value="2">Not at all</option>
                                                <option value="3">Once a week</option>
                                                <option value="4">More than once a week</option>
                                                <option value="5">Less than once a week</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="recor19">
                                    <td>Does the school have an identified health coordinator in school?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form2.radio7" value="0" tabindex=""/>Yes</label>
                                            <label><input  type="radio" v-model="form2.radio7" value="0" tabindex=""/>No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record20">
                                    <td>Is the identified health coordinator in school trainamed?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form2.radio8" value="0" tabindex=""/>Yes</label>
                                            <label><input  type="radio" v-model="form2.radio8" value="1" tabindex=""/>Yes</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record21">
                                    <td>Does the school have an identified water caretaker?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form2.radio9" value="0" tabindex=""/>Yes</label>
                                            <label><input  type="radio" v-model="form2.radio8" value="1" tabindex=""/>No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record22">
                                    <td>Is the water caretaker trainamed?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form2.radio10" value="0" tabindex=""/>Yes</label>
                                            <label><input  type="radio" v-model="form2.radio9" value="1" tabindex=""/>No</label>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('service-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-primary" @click="shownexttab('final-tab')"> <i class="fa fa-save"></i>submit </button>
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
        return {
            form: new form({
                id: '',adequateSize:'1',waterInKitchen:'1',waterSupply:'1',dishWashing:'1',basin:'1',chinmey:'1',
                shelves:'1',concreteFloor:'1',concreteWall:'1',closedCeiling:'1',windwoProperClosure:'1',doorProperClosure:'1',
                adequateVantillation:'1',drainageSystem:'1',changingRoom:'1'
            }),
            form1: new form({
                separateStore:'1',storeFood:'1',properPallets:'1',properContainer:'1',weighingBalance:'1',
                windowProperClosure:'1',doorProperClosure:'1',properContainer:'1',
                workingTable:'1',concreteFloor:'1',concreteWall:'1',closedCeiling:'1',ventillation:'1',properRoofing:'1'
            }),
            form2: new form({
                cookingStove:'1',potForServing:'1',cookingStove:'1',ladles:'1',cutlery:'1',workingTables:'1',
                washBasins:'1'
            }),
        }
    },

    methods: {
            shownexttab(nextclass){ 
            if(nextclass=="final-tab"){ 
                Swal.fire({
                    text: "Are you sure you wish to send this detials for approval ?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Success!',
                            'Details has been saved successfully.',
                            'success',
                        )
                        this.$router.push('/list_transfer');
                    }
                });
            }
            else{
                this.change_tab(nextclass);
            }
        },
        change_tab(nextclass){
            $('#tabhead >li >a').removeClass('active');
            $('#tabhead >li >a >span').addClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').addClass('active');
            $('.'+nextclass+' >a >span').removeClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').removeClass('disabled');
            $('.tab-content-details').hide();
            $('#'+nextclass).show().removeClass('fade');
        },

    },
    mounted() {
        
    },
}
</script>