<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead" role="tablist">
                    <li class="nav-item wash-tabs" @click="shownexttab('wash-tabs')">
                        <a class="nav-link active" data-toggle="pill" role="tab"> 
                            <label> Wash </label>                              
                        </a>
                    </li>
                    <li class="nav-item sanitation-tab">
                        <a class="nav-link" data-toggle="pill" @click="shownexttab('sanitation-tab')" role="tab">
                            <label> Sanitation </label>
                        </a>
                    </li>
                    <li class="nav-item hygience-tab">
                        <a class="nav-link" data-toggle="pill" @click="shownexttab('hygience-tab')" role="tab">
                            <label> Hygience</label>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="wash-tabs" role="tabpanel" aria-labelledby="basicdetails">
                        <table id="waterTable" class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <thead>
                                <tr>
                                    <th width="50px">Description</th>
                                    <th width="50px">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in wash_form.questionList" :key="index">
                                    <td>{{ item.name}}</td>
                                    <td v-if="item.answer_type=='TextArea'">
                                        <textarea class="form-control" v-model="item.answered"></textarea>
                                    </td>
                                    
                                    <td v-if="item.answer_type=='Text'">
                                        <input type="text" v-model="item.answered" class="form-control">
                                    </td>

                                    <td v-if="item.answer_type=='Number'">
                                        <input type="number" v-model="item.answered" class="form-control">
                                    </td>

                                    <td v-if="item.answer_type=='Radio'">
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <span v-for="(ans, index1) in item.ans_list" :key="index1">
                                                <input type="radio" v-model="ans.answered" class="ml-4" :value="ans.id"> <label for="pipe" >  {{ans.name}} </label>
                                            </span>
                                        </div>
                                    </td>

                                    <td v-if="item.answer_type=='Dropdown'">
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <select name="category" id="category" v-model="item.answered" class="form-control">
                                                <option value="">--- Please Select ---</option>
                                                <option v-for="(item, index) in item.ans_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                            </select>
                                        </div>
                                    </td>

                                    <td v-if="item.answer_type=='Checkbox'">
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <span v-for="(ans, index1) in item.ans_list" :key="index1">
                                                <input type="checkbox" v-model="ans.answered" class="ml-4" id="pipe" name="pipe" :value="ans.id">
                                                <label>{{ans.name}} </label>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" @click="shownexttab('wash-tabs')">Save & Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade tab-content-details" id="sanitation-tab" role="tabpanel" aria-labelledby="basicdetails">
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
                                            <input type="text" name="name1"  id="name1" class="form-control"> 
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record2">
                                    <td>No. of USABLE (functional, accessable,private) AQUA PRIVY Toilet pots for Students(Exclusively for Boys)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record3">
                                    <td>No. of USABLE (functional, accessable,private) AQUA PRIVY Toilet pots for Students(Common/for both Girls and Boys)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record4">
                                    <td>No. of USABLE (functional, accessable,private) AQUA PRIVY Toilet pots for Staff(Exclusively for Female)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record5">
                                    <td>No. of USABLE (functional, accessable,private) AQUA PRIVY Toilet pots for Staff(Exclusively for Male)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record6">
                                    <td>No. of USABLE (functional, accessable,private) AQUA PRIVY Toilet pots for Staff(Common/for both Male and Female)</td>
                                    
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" class="form-control"> 
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record7">
                                    <td>No. of USABLE (functional, accessable,private) FLUSH/POUR FLUSH Toilet pots for Students(Exclusively for Girls)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record8">
                                    <td>No. of USABLE (functional, accessable,private) FLUSH/POUR FLUSH Toilet pots for Students(Exclusively for Boys)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record9">
                                    <td>No. of USABLE (functional, accessable,private) FLUSH/POUR FLUSH Toilet pots for Students(Common/for both Girls and Boys)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record10">
                                    <td>No. of USABLE (functional, accessable,private) FLUSH/POUR FLUSH Toilet pots for Staff(Exclusively for Female)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record11">
                                    <td>No. of USABLE (functional, accessable,private) FLUSH/POUR FLUSH Toilet pots for Staff(Exclusively for Male)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record12">
                                    <td>No. of USABLE (functional, accessable,private) FLUSH/POUR FLUSH Toilet pots for Staff(Common/for both Male and Female)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record13">
                                    <td>No. of USABLE (functional, accessable,private) PIT LATRIname Toilet pots for Students(Exclusively for Girls)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record14">
                                    <td>No. of USABLE (functional, accessable,private) PIT LATRIname Toilet pots for Students(Exclusively for Boys)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record15">
                                    <td>No. of USABLE(functional, accessable,private) PIT LATRIname Toilet pots for Student(Common/for both Boys and Girls)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record16">
                                    <td>No. of USABLE (functional, accessable,private) PIT LATRIname Toilet pots for Staff(Exclusively for Female)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record17">
                                    <td>No. of USABLE (functional, accessable,private) PIT LATRIname Toilet pots for Staff(Exclusively for Male)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record18">
                                    <td>No. of USABLE(functional, accessable,private) PIT LATRIname Toilet pots for Student(Common/for both Male and Female)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record19">
                                    <td>No. of UN-USABLE (non-functional, in-accessable,not-private) AQUA PRIVY Toilet pots for Students(Exclusively for Girls)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record20">
                                    <td>No. of UN-USABLE (non-functional, in-accessable,not-private) AQUA PRIVY Toilet pots for Students(Exclusively for Boys)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record21">
                                    <td>No. of UN-USABLE (non-functional, in-accessable,not-private) AQUA PRIVY Toilet pots for Staff(Common/for both Girls and Boys)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record22">
                                    <td>No. of UN-USABLE (non-functional, in-accessable,not-private) AQUA PRIVY Toilet pots for Staff(Exclusively for Female)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record23">
                                    <td>No. of UN-USABLE (non-functional, in-accessable,not-private) AQUA PRIVY Toilet pots for Staff(Exclusively for Male)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record24">
                                    <td>No. of UN-USABLE (non-functional, in-accessable,not-private)AQUA PRIVY Toilet pots for Staft(Common/for both Male and Female)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record25">
                                    <td>No. of UN-USABLE (non-functional, in-accessable,not-private) FLUSH/POUR FLUSH Toilet pots for Students(Exclusively for Girls)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record26">
                                    <td>No. of UN-USABLE (non-functional, in-accessable,not-private) FLUSH/POUR FLUSH Toilet pots for Students(Exclusively for Boys)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record27">
                                    <td>No. of UN-USABLE (non-functional, in-accessable,not-private) FLUSH/POUR FLUSH Toilet pots for Students(Common/for both Girls and Boys)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record28">
                                    <td>No. of UN-USABLE (non-functional, in-accessable,not-private) FLUSH/POUR FLUSH Toilet pots for Staff(Exclusively for Female)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record29">
                                    <td>No. of UN-USABLE (non-functional, in-accessable,not-private) FLUSH/POUR FLUSH Toilet pots for Staff(Exclusively for Male)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record30">
                                    <td>No. of UN-USABLE (non-functional, in-accessable,not-private) FLUSH/POUR FLUSH Toilet pots for Staff(Common/for both Male and Female)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record31">
                                    <td>No. of UN-USABLE (not-functional, in-accessable,not-private) PIT LATRIname Toilet pots for Students(Exclusively for Girls)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record32">
                                    <td>No. of UN-USABLE (not-functional, in-accessable,not-private) PIT LATRIname Toilet pots for Students (Exclusively for Boys)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record33">
                                    <td>No. of UN-USABLE (not-functional, in-accessable,not-private) PIT LATRIname Toilet pots for Students(Common/for both Girls and Boys)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record34">
                                    <td>No. of UN-USABLE (not-functional, in-accessable,not-private) PIT LATRIname Toilet pots for Staff(Exclusively for Female)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record35">
                                    <td>No. of UN-USABLE (not-functional, in-accessable,not-private) PIT LATRIname Toilet pots for Staff(Exclusively for Male)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record36">
                                    <td>No. of UN-USABLE (not-functional, in-accessable,not-private) PIT LATRIname Toilet pots for Staff(Common/for both Male and Female)</td>
                                    <td>
                                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name1"  id="name1" class="form-control"> 
                                    </div>
                                    </td>
                                </tr>
                                <tr id="record37">
                                    <td>Does the School have Washing amenities in toilets that has both water and soap available for Students (Exclusively for Girls)?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="amenities"  value="1"> Yes
                                            <input type="radio" name="amenities"  value="2"> No
                                        </div>
                                    </td>
                                    
                                </tr>
                                <tr id="record38">
                                    <td>Does the School have Washing amenities in toilets that has both water and soap available for Students (Exclusively for Boys)?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="amenities1"  value="1"> Yes
                                            <input type="radio" name="amenities1"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record39">
                                    <td>Does the School have Washing amenities in toilets that has both water and soap available for Students (Common/for both Girls and Boys)?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="amenities2"  value="1"> Yes
                                            <input type="radio" name="amenities2"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record40">
                                    <td>Does the School have Washing amenities in toilets that has both water and soap available for Staff (Exclusively for Female)?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="amenities3"  value="1"> Yes 
                                            <input type="radio" name="amenities3"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record41">
                                    <td>Does the School have Washing amenities in toilets that has both water and soap available for Staff (Exclusively for Male)?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="amenities4"  value="1"> Yes
                                            <input type="radio" name="amenities4"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record42">
                                    <td>Does the School have Washing amenities in toilets that has both water and soap available for Staff (Common/for both Male and Female)?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="amenities5"  value="1"> Yes
                                            <input type="radio" name="amenities5"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record43">
                                    <td>Does the School have Washing amenities in toilets that has only water but no soap for Students (Exclusively for Girls)?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="amenities6"  value="1"> Yes
                                            <input type="radio" name="amenities6"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record44">
                                    <td>Does the School have Washing amenities in toilets that has only water but no soap for Students (Exclusively for Boys)?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="amenities7"  value="1"> Yes
                                            <input type="radio" name="amenities7"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record45">
                                    <td>Does the School have Washing amenities in toilets that has only water but no soap for Students (Common/for both Girls and Boys)?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="amenities8"  value="1"> Yes
                                            <input type="radio" name="amenities8"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record46">
                                    <td>Does the School have Washing amenities in toilets that has only water but no soap for Staff (Exclusively for Female)?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="amenities9"  value="1"> Yes
                                            <input type="radio" name="amenities9"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record47">
                                    <td>Does the School have Washing amenities in toilets that has only water but no soap for Staff (Exclusively for Male)?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="amenities10"  value="1"> Yes
                                            <input type="radio" name="amenities10"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record48">
                                    <td>Does the School have Washing amenities in toilets that has only water but no soap for Staff (Common/for both Male and Female)?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="amenities11"  value="1"> Yes
                                            <input type="radio" name="amenities11"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record49">
                                    <td>Does the School have Washing amenities in toilets that has no water for Students (Exclusively for Girls)?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="amenities12"  value="1"> Yes
                                            <input type="radio" name="amenities12"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record50">
                                    <td>Does the School have Washing amenities in toilets that has no water for Students (Exclusively for Boys)?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="amenities13"  value="1"> Yes
                                            <input type="radio" name="amenities13"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record51">
                                    <td>Does the School have Washing amenities in toilets that has no water for Students (Common/for both Girls and Boys)?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="amenities14"  value="1"> Yes
                                            <input type="radio" name="amenities14"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record52">
                                    <td>Does the School have Washing amenities in toilets that has no water for Staff(Exclusively for Female)?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="amenities15"  value="1"> Yes
                                            <input type="radio" name="amenities15"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record53">
                                    <td>Does the School have Washing amenities in toilets that has no water for Staff(Exclusively for Male)?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="amenities16"  value="1"> Yes
                                            <input type="radio" name="amenities16"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record54">
                                    <td>Does the School have Washing amenities in toilets that has no water for Staff(Common/for both Male and Female)?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="amenities17"  value="1"> Yes
                                            <input type="radio" name="amenities17"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record55">
                                    <td>Is there changing room(s) for Menstrual Hygiename Management (MHM)?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="menstrual"  value="1"> Yes
                                            <input type="radio" name="menstrual"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record56">
                                    <td>Is there covered disposal bins for Menstrual Hygiename Management (MHM)?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="menstrual1"  value="1"> Yes
                                            <input type="radio" name="menstrual1"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record57">
                                    <td>Does the school have disposal mechanisms for menstrual hygiename wastes?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="menstrual2"  value="1"> Yes
                                            <input type="radio" name="menstrual2"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record58">
                                    <td>Is there at least oname usable toilet that is accessible to children with limited mobility or vision?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="oname"  value="1"> Yes
                                            <input type="radio" name="oname"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record59">
                                    <td>Is there at least oname usable toilet that is accessible to the smallest children?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="oname1"  value="1"> Yes
                                            <input type="radio" name="oname1"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record60">
                                    <td>Is there adequate Lighting in Girls’ Toilet?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="adequate"  value="1"> All Toilets
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="adequate"  value="2"> Some Toilets
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="adequate"  value="3"> Non of the Toilets
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record61">
                                    <td>Is there adequate Lighting in Boys’ Toilet?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="toilet1"  value="1"> All Toilets
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="toilet1"  value="2"> Some Toilets
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="toilet1"  value="3"> Non of the Toilets
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record62">
                                    <td>Is there adequate Lighting in Students’ common toilet?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="toilet2"  value="1"> All Toilets
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="toilet2"  value="2"> Some Toilets
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="toilet2"  value="3"> Non of the Toilets
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record63">
                                    <td>How are the faecal sludge(septic tanks) managed?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="tanks"  value="1"> Yes, savely Buried/covered
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="tanks"  value="2"> Yes, savely Transported to a treatment plant
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="tanks"  value="3"> No proper management
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record64">
                                    <td>How frequently are the student’s toilets cleanamed?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="cleanamed"  value="1"> Daily
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="cleanamed"  value="2"> 2-4 Days a week
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="cleanamed"  value="3"> Once a week
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="cleanamed"  value="4"> Less than once a week
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="cleanamed"  value="5"> Not at all
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('wash-tabs')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-primary" @click="shownexttab('hygience-tab')"> <i class="fa fa-arrow-right"></i>Next </button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade tab-content-details" id="hygience-tab" role="tabpanel" aria-labelledby="basicdetails">
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
                                            <input type="checkbox" id="tapePoint" name="tapePoint" value="1">
                                            <label for="tapePoint"> Tap Point </label><br>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" id="tippyTape" name="tippyTape" value="2">
                                            <label for="tippyTape"> Tippy Tap </label><br>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" id="bucketCan" name="bucketCan" value="3">
                                            <label for="bucketCan"> Bucket/Jerry Can </label><br>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" id="no" name="no" value="4">
                                            <label for="no"> No Hand Washing Facilities </label><br>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" id="others" name="others" value="5">
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
                                            <input type="radio" name="handWashing"  value="1"> Yes, Water and Soap
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="handWashing"  value="2"> Water Only
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="handWashing"  value="3"> Nither Soap nor Water
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record9">
                                    <td>Are hand washing facilities accessible to those with limited mobility or vision?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="vision"  value="1"> Yes
                                            <input type="radio" name="vision"  value="2">No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record10">
                                    <td>Are hand washing facilities accessible to the smallest children?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="child"  value="1"> Yes
                                            <input type="radio" name="child"  value="2">No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="recor11">
                                    <td>Where are the hand washing facilities with water and soap located?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" id="located" name="located" value="1">
                                            <label for="located"> Toilets </label><br>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" id="dinningHall" name="dinningHall" value="2">
                                            <label for="dinningHall"> Near Dining Hall </label><br>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" id="academic" name="academic" value="3">
                                            <label for="academic"> Academic Building </label><br>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" id="kitchen" name="kitchen" value="4">
                                            <label for="kitchen"> Kitchen </label><br>
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" id="othersSpecify" name="othersSpecify" value="5">
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
                                            <input type="radio" name="activity"  value="Yes"> At least once a week
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="activity"  value="No">2-4 days per week
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="activity"  value="No">Daily
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="geactivityo"  value="No">Less than once a week
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
                                            <input type="radio" name="bathing"  value="1"> Yes
                                            <input type="radio" name="bathing"  value="2">No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="recor17">
                                    <td>Is there hot water available for bathing?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="hot"  value="1"> Always
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="hot"  value="2">Sometimes
                                        </div>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="hot"  value="3">namever
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
                                            <input type="radio" name="health"  value="1"> Yes
                                            <input type="radio" name="health"  value="2">No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record20">
                                    <td>Is the identified health coordinator in school trainamed?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="trainamed"  value="1"> Yes
                                            <input type="radio" name="trainamed"  value="2">No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record21">
                                    <td>Does the school have an identified water caretaker?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="caretaker"  value="1"> Yes
                                            <input type="radio" name="caretaker"  value="2">No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record22">
                                    <td>Is the water caretaker trainamed?</td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="waters"  value="1"> Yes
                                            <input type="radio" name="waters"  value="2">No
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('sanitation-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-primary" @click="shownexttab('final-tab')"> <i class="fa fa-save"></i>Save </button>
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
            wash_counter:0,
            wash_form: new form({
                type:'wash',
                questionList:[],
            })
        }
    },

    methods:{
        increment(num){
            if(num<10){
                return this.wash_counter+=1;
            }
        },
        shownexttab(nextclass){  
            if(nextclass=="final-tab"){ 
                Swal.fire({
                    text: "Are you sure you wish to save this details ?",
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
                        window.location.reload();
                    }
                });
            }
            else{
                this.wash_form.post('organization/structural/saveWashFeeding')
                .then((response) => { 
                    Toast.fire({
                        icon: 'success',
                        title: 'Data saved Successfully'
                    });
                })
                .catch((error) => {  
                    console.log("Error: "+error)
                });
            }
        },
        loadQuestionList(uri = 'questionAnswers/loadQuestionaries/withwhere_Wash_Question'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.wash_form.questionList =  data;
            }) 
            .catch(function (error){
                console.log(error.toString());
            });
        },
        loadWashDetialsList(uri = 'organization/structural/getWashFeeding/wash'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                for(let i=o;i<data.length;i++){
                    
                }
            }) 
            .catch(function (error){
                console.log(error.toString());
            });
        },
    },
  
    mounted(){ 
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        }); 
        this.loadQuestionList();
        this.loadWashDetialsList();
    },
}
</script>