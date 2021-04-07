<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <li class="nav-item application-tab" @click="shownexttab('application-tab')">
                        <a class="nav-link active" data-toggle="pill" role="tab"> 
                            <label class="mb-0.5">Kitchen Status </label>                              
                        </a>
                    </li>
                    <li class="nav-item service-tab" @click="shownexttab('service-tab')">
                        <a class="nav-link" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Food Store Status </label>
                        </a>
                    </li>
                    <li class="nav-item service1-tab" @click="shownexttab('service1-tab')">
                        <a class="nav-link" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Equipment & Utensils in kitchen</label>
                        </a>
                    </li>
                    <li class="nav-item undertaking-tab" @click="shownexttab('undertaking-tab')">
                        <a class="nav-link" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Dinning Hall</label>
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
                                    <th width="60px">Description</th>
                                    <th width="40px">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="record1">
                                    <td>Adequate size of the kitchen for the number of students? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form.adequateSize"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.adequateSize"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record2">
                                    <td>Safe water connecion inside the kitchen? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form.waterInKitchen"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.waterInKitchen"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record3">
                                    <td>Continuous water supply throughout the year in the kitchen? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form.waterSupply"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.waterSupply"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record4">
                                    <td>Separate dish washing space in the kitchen? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form.dishWashing"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.dishWashing"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record5">
                                    <td>wash basin with water connection for handwashing? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form.basin"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.basin"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record6">
                                    <td>Proper functioning smoke outlet/chimney? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form.chinmey"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.chinmey"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record7">
                                    <td>Adequate shelves in the kitchen to store utensils neatly? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form.shelves"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.shelves"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record8">
                                    <td>Concrete floor? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form.concreteFloor"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.concreteFloor"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record9">
                                    <td>Concrete walls? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form.concreteWall"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.concreteWall"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record10">
                                    <td>Proper closed ceiling? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form.closedCeiling"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.closedCeiling"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record11">
                                    <td>Windows with proper closures? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form.windwoProperClosure"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.windowProperClosure"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record12">
                                    <td>Doors with proper closures? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form.doorProperClosure"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.doorProperClosure"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record13">
                                    <td>Adequate ventilations? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form.adequateVantillation"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.adequateVantillation"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record14">
                                    <td>Functioning drainage system inside and outside of the kitchen? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form.drainageSystem"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.drainageSystem"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record15">
                                    <td>Changing room? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form.changingRoom"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.changingRoom"  value="0" tabindex=""/> No</label>
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
                        <table id="waterTable1" class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <thead>
                                <tr>
                                    <th width="60px">Description</th>
                                    <th width="40px">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="record1">
                                    <td>Separate store exist for perishable and non-perisable items? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.separateStore"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form1.separateStore"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record2">
                                    <td>Adequate space is available to store food comodities? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.storeFood"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form1.storeFood"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record3">
                                    <td>Proper pallets are in place to store all non-perishable food items? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.properPallets"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form1.properPallets"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record4">
                                    <td>Proper containers are in place to store perishable food items? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.properContainer"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form1.properContainer"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record5">
                                    <td>Functioning weighing balance is in place? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.weighingBalance"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form1.weighingBalance"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record6">
                                    <td>Windows in proper closures? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.windowProperClosure"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form1.windowProperClosure"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record7">
                                    <td>Doors in proper closure? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.doorProperClosure"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form1.doorProperClosure"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record8">
                                    <td>Proper containers are in place to store opened non-perishable items to prevent contamination and spoilage? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.properContainer"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form1.properContainer"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record9">
                                    <td>Working tables and space is available with store? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.workingTable"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form1.workingTable"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record10">
                                    <td>Concrete floor? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.concreteFloor"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form1.concreteFloor"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record11">
                                    <td>Concrete walls? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.concreteWall"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form1.concreteWall"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record12">
                                    <td>Proper closed ceilings? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.closedCeiling"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form1.closedCeiling"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record13">
                                    <td>Adequate ventilations? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.ventillation"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form1.ventillation"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record14">
                                    <td>Proper roofing without leakages? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form1.properRoofing"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form1.properRoofing"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('application-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-primary" @click="shownexttab('service1-tab')"> <i class="fa fa-arrow-right"></i>Next </button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade tab-content-details" id="service1-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <table id="waterTable1" class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <thead>
                                <tr>
                                    <th width="60px">Description</th>
                                    <th width="40px">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="record1">
                                    <td>Adequate number of functioning cooking stoves? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form2.cookingStove"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form2.cookingStove"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record2">
                                    <td>Adequate number of pots existing for serving? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form2.potForServing"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form2.prtForServing"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record3">
                                    <td>Adequate number of pots/bowls/buckets exist for washing vegetables? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form2.cookingStove"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form2.cookingStove"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record4">
                                    <td>Adequate number of ladles exist? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form2.ladles"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form2.ladles"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record5">
                                    <td>Adequate separate cutlery for vegetables and meat items exist? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form2.cutlery"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form2.cutlery"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record6">
                                    <td>Working tables are in place with clean surface for cutting vegetables/meats etc? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form2.workingTables"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form2.workingTables"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record7">
                                    <td>Waste bins with proper lid is in place? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form2.washBasins"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form2.washBasins"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('service-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-primary" @click="shownexttab('undertaking-tab')"> <i class="fa fa-arrow-right"></i>Next </button>
                            </div>
                        </div>
                    </div> 
                    <div class="tab-pane fade tab-content-details" id="undertaking-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <table id="waterTable1" class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <thead>
                                <tr>
                                    <th width="60px">Description</th>
                                    <th width="40px">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="record1">
                                    <td>Does the school have a dinning hall? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form3.dinningHall"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form3.dinningHall"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record2">
                                    <td>Adequate space is available to accommodate all students? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form3.spaceAvailable"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form3.spaceAvailable"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record3">
                                    <td>Adequate furniture to accommodate all students? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form3.adequateFurniture"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form3.adequateFurniture"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record4">
                                    <td>Windows with proper closures? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form3.windowsWithClosure"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form3.windowsWithClosure"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record5">
                                    <td>Concrete floor? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form3.washBasins"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form3.washBasins"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record6">
                                    <td>Concrete walls? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form3.concreteWall"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form3.concreteWall"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record7">
                                    <td>Proper closed ceilings? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form3.closedCeiling"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form3.closedCeiling"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record8">
                                    <td>Adequate ventilations? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form3.adequateVentillation"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form3.adequateVentillation"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record9">
                                    <td>Proper roofing without leakages </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form3.roofingWithoutLeakages"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form3.roofingWithoutLeakages"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record9">
                                    <td>Waste bins with proper lid is in place </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="form3.wasteBins"  value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form3.wasteBins"  value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('service1-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
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
            form3: new form({
                dinningHall:'1',spaceAvailable:'1',adequateFurniture:'1',windowsWithClosure:'1',washBasins:'1',concreteWall:'1',
                closedCeiling:'1',adequateVentillation:'1',roofingWithoutLeakages:'1',wasteBins:'1'
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