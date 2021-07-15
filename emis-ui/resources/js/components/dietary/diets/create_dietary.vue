<template>
    <div>
        <!-- <div class="callout callout-danger" style="display:none" id="existmessage">
            <h5 class="bg-gradient-danger">Sorry!</h5>
            <div id="message"></div>
        </div> -->
        <form id="form_data">
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 overflow-auto">
                    <table id="food-table" class="table table-bordered text-sm table-striped">
                        <thead>
                            <tr class="text-center bg-gradient-green">
                                <th colspan="15" class="pt-1 pb-1"> SCHOOL FEEDING PROGRAMME, WEEKLY DIETARY DIVERSITY CHART</th>
                            </tr>
                            <tr class="text-center bg-gradient-green">
                                <th colspan="15" class="pt-0 pb-0"> Food Group</th>
                            </tr>
                            <tr class="bg-gradient-warning">
                                <th>Date</th>
                                <th>Meal</th>
                                <th colspan="2">Cereals, root & tubers</th>
                                <th>Vegetables</th>
                                <th colspan="3">Meets, Fish & eggs</th>
                                <th>Pulses & legumes</th>
                                <th>Milk & milk products</th>
                                <th>Fruits</th>
                                <th>Oil & fats</th>
                                <th>Condiments & spices</th>
                                <td>Condiments & chillies</td>
                                <td>Scores</td>
                            </tr>
                            <tr class="bg-warning">
                                <td></td>
                                <td></td>
                                <td>Cereals</td>
                                <td>Root & tubers</td>
                                <td></td>
                                <td>Meet & poultry</td>
                                <td>Eggs</td>
                                <td>Fish</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr style="height:50px">
                                <td></td>
                                <td></td>
                                <td style="background-image: url('img/cereal.JPG');background-size: cover">
                                    <!-- <img class="img-fluid" src="img/cereal.JPG" alt="Cereal picture"> -->
                                </td>
                                <td style="background-image: url('img/potato.JPG');background-size: cover"></td>
                                <td style="background-image: url('img/veg.JPG');background-size: cover"></td>
                                <td style="background-image: url('img/meat.JPG');background-size: cover"></td>
                                <td style="background-image: url('img/egg.JPG');background-size: cover"></td>
                                <td style="background-image: url('img/fish.JPG');background-size: cover"></td>
                                <td style="background-image: url('img/palse.JPG');background-size: cover"></td>
                                <td style="background-image: url('img/milk.JPG');background-size: cover"></td>
                                <td style="background-image: url('img/fruit.JPG');background-size: cover"></td>
                                <td style="background-image: url('img/oil.JPG');background-size: cover"></td>
                                <td style="background-image: url('img/tea.JPG');background-size: cover"></td>
                                <td style="background-image: url('img/chilli.JPG');background-size: cover"></td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for='(itm, index) in form.items1' :key="index">
                                <td v-if="index==0" rowspan="4" class="pt-5 ">
                                    <input type="date" id="record_data1" class="form-control" v-model="form.record_date1" name="record_date"/>
                                    <span id="esist_message" class="text-danger"></span>
                                </td>
                                <td>{{itm.meal}}</td>
                                <td>
                                    <input type="checkbox" :id="index+'cereal1'" v-model="itm.cereal" class="form-control-range" @click="calculatescore('cereal',1)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="index+'root1'" v-model="itm.root" class="form-control-range" @click="calculatescore('cereal',1)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="index+'veg1'" v-model="itm.veg" class="form-control-range" @click="calculatescore('veg',1)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="index+'meat1'" v-model="itm.meat" class="form-control-range" @click="calculatescore('meat',1)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="index+'egg1'" v-model="itm.egg" class="form-control-range" @click="calculatescore('meat',1)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="index+'fish1'" v-model="itm.fish" class="form-control-range" @click="calculatescore('meat',1)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="index+'pulse1'" v-model="itm.pulse" class="form-control-range" @click="calculatescore('pulse',1)">
                                </td>
                                 <td>
                                    <input type="checkbox" :id="index+'milk1'" v-model="itm.milk" class="form-control-range" @click="calculatescore('milk',1)">
                                </td>
                                 <td>
                                    <input type="checkbox" :id="index+'fruit1'" v-model="itm.fruit" class="form-control-range" @click="calculatescore('fruit',1)">
                                </td>
                                 <td>
                                    <input type="checkbox" :id="index+'oil1'" v-model="itm.oil" class="form-control-range" @click="calculatescore('oil',1)">
                                </td>
                                <td>
                                    <input type="checkbox" v-model="itm.sugar" class="form-control-range">
                                </td>
                                <td>
                                    <input type="checkbox" v-model="itm.chilli" class="form-control-range">
                                </td>
                                <td  v-if="index==0" rowspan="4" class="text-center pt-5 text-bold">
                                    <span>{{form.total_score1}}</span>
                                </td>
                            </tr>
                            <br>
                            <tr v-for='(itm, iteration) in form.items2' :key="'A'+iteration">
                                <td v-if="iteration==0" rowspan="4" class="pt-5 ">
                                    <input type="date" id="record_data2" class="form-control" v-model="form.record_date2" name="record_date"/>
                                    <span id="esist_message" class="text-danger"></span>
                                </td>
                                <td>{{itm.meal}}</td>
                                <td>
                                    <input type="checkbox" :id="iteration+'cereal2'" v-model="itm.cereal" class="form-control-range" @click="calculatescore('cereal',2)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="iteration+'root2'" v-model="itm.root" class="form-control-range" @click="calculatescore('cereal',2)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="iteration+'veg2'" v-model="itm.veg" class="form-control-range" @click="calculatescore('veg',2)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="iteration+'meat2'" v-model="itm.meat" class="form-control-range" @click="calculatescore('meat',2)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="iteration+'egg2'" v-model="itm.egg" class="form-control-range" @click="calculatescore('meat',2)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="iteration+'fish2'" v-model="itm.fish" class="form-control-range" @click="calculatescore('meat',2)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="iteration+'pulse2'" v-model="itm.pulse" class="form-control-range" @click="calculatescore('pulse',2)">
                                </td>
                                 <td>
                                    <input type="checkbox" :id="iteration+'milk2'" v-model="itm.milk" class="form-control-range" @click="calculatescore('milk',2)">
                                </td>
                                 <td>
                                    <input type="checkbox" :id="iteration+'fruit2'" v-model="itm.fruit" class="form-control-range" @click="calculatescore('fruit',2)">
                                </td>
                                 <td>
                                    <input type="checkbox" :id="iteration+'oil2'" v-model="itm.oil" class="form-control-range" @click="calculatescore('oil',2)">
                                </td>
                                <td>
                                    <input type="checkbox" v-model="itm.sugar" class="form-control-range">
                                </td>
                                <td>
                                    <input type="checkbox" v-model="itm.chilli" class="form-control-range">
                                </td>
                                <td  v-if="iteration==0" rowspan="4" class="text-center pt-5 text-bold">
                                    <span>{{form.total_score2}}</span>
                                </td>
                            </tr>
                            <br>
                            <tr v-for='(itm, slNo) in form.items3' :key="'B'+slNo">
                                <td v-if="slNo==0" rowspan="4" class="pt-5 ">
                                    <input type="date" id="record_data3" class="form-control" v-model="form.record_date3" name="record_date"/>
                                    <span id="esist_message" class="text-danger"></span>
                                </td>
                                <td>{{itm.meal}}</td>
                                <td>
                                    <input type="checkbox" :id="slNo+'cereal3'" v-model="itm.cereal" class="form-control-range" @click="calculatescore('cereal',3)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="slNo+'root3'" v-model="itm.root" class="form-control-range" @click="calculatescore('cereal',3)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="slNo+'veg3'" v-model="itm.veg" class="form-control-range" @click="calculatescore('veg',3)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="slNo+'meat3'" v-model="itm.meat" class="form-control-range" @click="calculatescore('meat',3)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="slNo+'egg3'" v-model="itm.egg" class="form-control-range" @click="calculatescore('meat',3)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="slNo+'fish3'" v-model="itm.fish" class="form-control-range" @click="calculatescore('meat',3)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="slNo+'pulse3'" v-model="itm.pulse" class="form-control-range" @click="calculatescore('pulse',3)">
                                </td>
                                 <td>
                                    <input type="checkbox" :id="slNo+'milk3'" v-model="itm.milk" class="form-control-range" @click="calculatescore('milk',3)">
                                </td>
                                 <td>
                                    <input type="checkbox" :id="slNo+'fruit3'" v-model="itm.fruit" class="form-control-range" @click="calculatescore('fruit',3)">
                                </td>
                                 <td>
                                    <input type="checkbox" :id="slNo+'oil3'" v-model="itm.oil" class="form-control-range" @click="calculatescore('oil',3)">
                                </td>
                                <td>
                                    <input type="checkbox" v-model="itm.sugar" class="form-control-range">
                                </td>
                                <td>
                                    <input type="checkbox" v-model="itm.chilli" class="form-control-range">
                                </td>
                                <td  v-if="slNo==0" rowspan="4" class="text-center pt-5 text-bold">
                                    <span>{{form.total_score3}}</span>
                                </td>
                            </tr>
                            <br>
                            <tr v-for='(itm, trindex) in form.items4' :key="'C'+trindex">
                                <td v-if="trindex==0" rowspan="4" class="pt-5 ">
                                    <input type="date" id="record_data4" class="form-control" v-model="form.record_date4" name="record_date"/>
                                    <span id="esist_message" class="text-danger"></span>
                                </td>
                                <td>{{itm.meal}}</td>
                                <td>
                                    <input type="checkbox" :id="trindex+'cereal4'" v-model="itm.cereal" class="form-control-range" @click="calculatescore('cereal',4)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="trindex+'root4'" v-model="itm.root" class="form-control-range" @click="calculatescore('cereal',4)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="trindex+'veg4'" v-model="itm.veg" class="form-control-range" @click="calculatescore('veg',4)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="trindex+'meat4'" v-model="itm.meat" class="form-control-range" @click="calculatescore('meat',4)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="trindex+'egg4'" v-model="itm.egg" class="form-control-range" @click="calculatescore('meat',4)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="trindex+'fish4'" v-model="itm.fish" class="form-control-range" @click="calculatescore('meat',4)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="trindex+'pulse4'" v-model="itm.pulse" class="form-control-range" @click="calculatescore('pulse',4)">
                                </td>
                                 <td>
                                    <input type="checkbox" :id="trindex+'milk4'" v-model="itm.milk" class="form-control-range" @click="calculatescore('milk',4)">
                                </td>
                                 <td>
                                    <input type="checkbox" :id="trindex+'fruit4'" v-model="itm.fruit" class="form-control-range" @click="calculatescore('fruit',4)">
                                </td>
                                 <td>
                                    <input type="checkbox" :id="trindex+'oil4'" v-model="itm.oil" class="form-control-range" @click="calculatescore('oil',4)">
                                </td>
                                <td>
                                    <input type="checkbox" v-model="itm.sugar" class="form-control-range">
                                </td>
                                <td>
                                    <input type="checkbox" v-model="itm.chilli" class="form-control-range">
                                </td>
                                <td  v-if="trindex==0" rowspan="4" class="text-center pt-5 text-bold">
                                    <span>{{form.total_score4}}</span>
                                </td>
                            </tr>
                            <br>
                            <tr v-for='(itm, counter4) in form.items5' :key="'D'+counter4">
                                <td v-if="counter4==0" rowspan="4" class="pt-5 ">
                                    <input type="date" id="record_data5" class="form-control" v-model="form.record_date5" name="record_date"/>
                                    <span id="esist_message" class="text-danger"></span>
                                </td>
                                <td>{{itm.meal}}</td>
                                <td>
                                    <input type="checkbox" :id="counter4+'cereal5'" v-model="itm.cereal" class="form-control-range" @click="calculatescore('cereal',5)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="counter4+'root5'" v-model="itm.root" class="form-control-range" @click="calculatescore('cereal',5)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="counter4+'veg5'" v-model="itm.veg" class="form-control-range" @click="calculatescore('veg',5)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="counter4+'meat5'" v-model="itm.meat" class="form-control-range" @click="calculatescore('meat',5)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="counter4+'egg5'" v-model="itm.egg" class="form-control-range" @click="calculatescore('meat',5)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="counter4+'fish5'" v-model="itm.fish" class="form-control-range" @click="calculatescore('meat',5)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="counter4+'pulse5'" v-model="itm.pulse" class="form-control-range" @click="calculatescore('pulse',5)">
                                </td>
                                 <td>
                                    <input type="checkbox" :id="counter4+'milk5'" v-model="itm.milk" class="form-control-range" @click="calculatescore('milk',5)">
                                </td>
                                 <td>
                                    <input type="checkbox" :id="counter4+'fruit5'" v-model="itm.fruit" class="form-control-range" @click="calculatescore('fruit',5)">
                                </td>
                                 <td>
                                    <input type="checkbox" :id="counter4+'oil5'" v-model="itm.oil" class="form-control-range" @click="calculatescore('oil',5)">
                                </td>
                                <td>
                                    <input type="checkbox" v-model="itm.sugar" class="form-control-range">
                                </td>
                                <td>
                                    <input type="checkbox" v-model="itm.chilli" class="form-control-range">
                                </td>
                                <td  v-if="counter4==0" rowspan="4" class="text-center pt-5 text-bold">
                                    <span>{{form.total_score5}}</span>
                                </td>
                            </tr>
                            <br>
                            <tr v-for='(itm, counter5) in form.items6' :key="'E'+counter5">
                                <td v-if="counter5==0" rowspan="4" class="pt-5 ">
                                    <input type="date" id="record_data6" class="form-control" v-model="form.record_date6" name="record_date"/>
                                    <span id="esist_message" class="text-danger"></span>
                                </td>
                                <td>{{itm.meal}}</td>
                                <td>
                                    <input type="checkbox" :id="counter5+'cereal6'" v-model="itm.cereal" class="form-control-range" @click="calculatescore('cereal',6)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="counter5+'root6'" v-model="itm.root" class="form-control-range" @click="calculatescore('cereal',6)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="counter5+'veg6'" v-model="itm.veg" class="form-control-range" @click="calculatescore('veg',6)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="counter5+'meat6'" v-model="itm.meat" class="form-control-range" @click="calculatescore('meat',6)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="counter5+'egg6'" v-model="itm.egg" class="form-control-range" @click="calculatescore('meat',6)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="counter5+'fish6'" v-model="itm.fish" class="form-control-range" @click="calculatescore('meat',6)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="counter5+'pulse6'" v-model="itm.pulse" class="form-control-range" @click="calculatescore('pulse',6)">
                                </td>
                                 <td>
                                    <input type="checkbox" :id="counter5+'milk6'" v-model="itm.milk" class="form-control-range" @click="calculatescore('milk',6)">
                                </td>
                                 <td>
                                    <input type="checkbox" :id="counter5+'fruit6'" v-model="itm.fruit" class="form-control-range" @click="calculatescore('fruit',6)">
                                </td>
                                 <td>
                                    <input type="checkbox" :id="counter5+'oil6'" v-model="itm.oil" class="form-control-range" @click="calculatescore('oil',6)">
                                </td>
                                <td>
                                    <input type="checkbox" v-model="itm.sugar" class="form-control-range">
                                </td>
                                <td>
                                    <input type="checkbox" v-model="itm.chilli" class="form-control-range">
                                </td>
                                <td  v-if="counter5==0" rowspan="4" class="text-center pt-5 text-bold">
                                    <span>{{form.total_score6}}</span>
                                </td>
                            </tr>
                            <br>
                            <tr v-for='(itm, counter6) in form.items7' :key="'F'+counter6">
                                <td v-if="counter6==0" rowspan="4" class="pt-5 ">
                                    <input type="date" id="record_data7" class="form-control" v-model="form.record_date7" name="record_date"/>
                                    <span id="esist_message" class="text-danger"></span>
                                </td>
                                <td>{{itm.meal}}</td>
                                <td>
                                    <input type="checkbox" :id="counter6+'cereal7'" v-model="itm.cereal" class="form-control-range" @click="calculatescore('cereal',7)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="counter6+'root7'" v-model="itm.root" class="form-control-range" @click="calculatescore('cereal',7)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="counter6+'veg7'" v-model="itm.veg" class="form-control-range" @click="calculatescore('veg',7)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="counter6+'meat7'" v-model="itm.meat" class="form-control-range" @click="calculatescore('meat',7)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="counter6+'egg7'" v-model="itm.egg" class="form-control-range" @click="calculatescore('meat',7)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="counter6+'fish7'" v-model="itm.fish" class="form-control-range" @click="calculatescore('meat',7)">
                                </td>
                                <td>
                                    <input type="checkbox" :id="counter6+'pulse7'" v-model="itm.pulse" class="form-control-range" @click="calculatescore('pulse',7)">
                                </td>
                                 <td>
                                    <input type="checkbox" :id="counter6+'milk7'" v-model="itm.milk" class="form-control-range" @click="calculatescore('milk',7)">
                                </td>
                                 <td>
                                    <input type="checkbox" :id="counter6+'fruit7'" v-model="itm.fruit" class="form-control-range" @click="calculatescore('fruit',7)">
                                </td>
                                 <td>
                                    <input type="checkbox" :id="counter6+'oil7'" v-model="itm.oil" class="form-control-range" @click="calculatescore('oil',7)">
                                </td>
                                <td>
                                    <input type="checkbox" v-model="itm.sugar" class="form-control-range">
                                </td>
                                <td>
                                    <input type="checkbox" v-model="itm.chilli" class="form-control-range">
                                </td>
                                <td  v-if="counter6==0" rowspan="4" class="text-center pt-5 text-bold">
                                    <span>{{form.total_score7}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="14" class="text-right text-bold averate_score_bg">
                                    <span id="average_text"></span>
                                </td>
                                <td class="text-bold">
                                    <span>{{form.average_score}}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="mb-0">Remarks if any</label>
                    <textarea class="form-control" v-model="form.remarks" id="remarks"></textarea>
                    <span class="text-danger" id="remarks_err"></span>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="mb-0">Prepared By</label>
                    <input type="text" class="form-control" v-model="form.prepared_by" id="prepared_by" />
                    <span class="text-danger" id="prepared_by_err"></span>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="mb-0">Endrosed By</label>
                    <input type="text" class="form-control" v-model="form.endrosed_by" id="endrosed_by" />
                    <span class="text-danger" id="endrosed_by_err"></span>
                </div>
            </div>
            <div class="card-footer text-right" id="action_buttons">
                <button type="button" @click="formaction('reset')" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-redo"></i> Reset</button>
                <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    data(){
        return {
            form: new form({
                items1:
                [
                    { meal:'Breakfast',cereal:0,root:0,veg:0,meat:0,egg:0,fish:0,pulse:0,milk:0,fruit:0,oil:0,sugar:0,chilli:0,},
                    { meal:'Lunch',cereal:0,root:0,veg:0,meat:0,egg:0,fish:0,pulse:0,milk:0,fruit:0,oil:0,sugar:0,chilli:0,},
                    { meal:'Tea',cereal:0,root:0,veg:0,meat:0,egg:0,fish:0,pulse:0,milk:0,fruit:0,oil:0,sugar:0,chilli:0,},
                    { meal:'Dinner',cereal:0,root:0,veg:0,meat:0,egg:0,fish:0,pulse:0,milk:0,fruit:0,oil:0,sugar:0,chilli:0,}
                ],
                items2:
                [
                    { meal:'Breakfast',cereal:0,root:0,veg:0,meat:0,egg:0,fish:0,pulse:0,milk:0,fruit:0,oil:0,sugar:0,chilli:0,},
                    { meal:'Lunch',cereal:0,root:0,veg:0,meat:0,egg:0,fish:0,pulse:0,milk:0,fruit:0,oil:0,sugar:0,chilli:0,},
                    { meal:'Tea',cereal:0,root:0,veg:0,meat:0,egg:0,fish:0,pulse:0,milk:0,fruit:0,oil:0,sugar:0,chilli:0,},
                    { meal:'Dinner',cereal:0,root:0,veg:0,meat:0,egg:0,fish:0,pulse:0,milk:0,fruit:0,oil:0,sugar:0,chilli:0,}
                ],
                items3:
                [
                    { meal:'Breakfast',cereal:0,root:0,veg:0,meat:0,egg:0,fish:0,pulse:0,milk:0,fruit:0,oil:0,sugar:0,chilli:0,},
                    { meal:'Lunch',cereal:0,root:0,veg:0,meat:0,egg:0,fish:0,pulse:0,milk:0,fruit:0,oil:0,sugar:0,chilli:0,},
                    { meal:'Tea',cereal:0,root:0,veg:0,meat:0,egg:0,fish:0,pulse:0,milk:0,fruit:0,oil:0,sugar:0,chilli:0,},
                    { meal:'Dinner',cereal:0,root:0,veg:0,meat:0,egg:0,fish:0,pulse:0,milk:0,fruit:0,oil:0,sugar:0,chilli:0,}
                ],
                items4:
                [
                    { meal:'Breakfast',cereal:0,root:0,veg:0,meat:0,egg:0,fish:0,pulse:0,milk:0,fruit:0,oil:0,sugar:0,chilli:0,},
                    { meal:'Lunch',cereal:0,root:0,veg:0,meat:0,egg:0,fish:0,pulse:0,milk:0,fruit:0,oil:0,sugar:0,chilli:0,},
                    { meal:'Tea',cereal:0,root:0,veg:0,meat:0,egg:0,fish:0,pulse:0,milk:0,fruit:0,oil:0,sugar:0,chilli:0,},
                    { meal:'Dinner',cereal:0,root:0,veg:0,meat:0,egg:0,fish:0,pulse:0,milk:0,fruit:0,oil:0,sugar:0,chilli:0,}
                ],
                items5:
                [
                    { meal:'Breakfast',cereal:0,root:0,veg:0,meat:0,egg:0,fish:0,pulse:0,milk:0,fruit:0,oil:0,sugar:0,chilli:0,},
                    { meal:'Lunch',cereal:0,root:0,veg:0,meat:0,egg:0,fish:0,pulse:0,milk:0,fruit:0,oil:0,sugar:0,chilli:0,},
                    { meal:'Tea',cereal:0,root:0,veg:0,meat:0,egg:0,fish:0,pulse:0,milk:0,fruit:0,oil:0,sugar:0,chilli:0,},
                    { meal:'Dinner',cereal:0,root:0,veg:0,meat:0,egg:0,fish:0,pulse:0,milk:0,fruit:0,oil:0,sugar:0,chilli:0,}
                ],
                items6:
                [
                    { meal:'Breakfast',cereal:0,root:0,veg:0,meat:0,egg:0,fish:0,pulse:0,milk:0,fruit:0,oil:0,sugar:0,chilli:0,},
                    { meal:'Lunch',cereal:0,root:0,veg:0,meat:0,egg:0,fish:0,pulse:0,milk:0,fruit:0,oil:0,sugar:0,chilli:0,},
                    { meal:'Tea',cereal:0,root:0,veg:0,meat:0,egg:0,fish:0,pulse:0,milk:0,fruit:0,oil:0,sugar:0,chilli:0,},
                    { meal:'Dinner',cereal:0,root:0,veg:0,meat:0,egg:0,fish:0,pulse:0,milk:0,fruit:0,oil:0,sugar:0,chilli:0,}
                ],
                items7:
                [
                    { meal:'Breakfast',cereal:0,root:0,veg:0,meat:0,egg:0,fish:0,pulse:0,milk:0,fruit:0,oil:0,sugar:0,chilli:0,},
                    { meal:'Lunch',cereal:0,root:0,veg:0,meat:0,egg:0,fish:0,pulse:0,milk:0,fruit:0,oil:0,sugar:0,chilli:0,},
                    { meal:'Tea',cereal:0,root:0,veg:0,meat:0,egg:0,fish:0,pulse:0,milk:0,fruit:0,oil:0,sugar:0,chilli:0,},
                    { meal:'Dinner',cereal:0,root:0,veg:0,meat:0,egg:0,fish:0,pulse:0,milk:0,fruit:0,oil:0,sugar:0,chilli:0,}
                ],
                action_type:'add',
                record_date1:'',
                record_date2:'',
                record_date3:'',
                record_date4:'',
                record_date5:'',
                record_date6:'',
                record_date7:'',
                total_score1:0,total_score2:0,total_score3:0,total_score4:0,total_score5:0,total_score6:0,total_score7:0,
                average_score:0,
                remarks:'',
                prepared_by:'',
                endrosed_by:'',
            }),
        }
    },
    methods: {
        calculatescore(type,day){
            if(type!="sugar" && type!="chilli"){
                let cereal=0,veg=0,meat=0,pulse=0,milk=0,fruit=0,oil=0;
                for(let i=0;i<4;i++){
                    if($('#'+i+'cereal'+day).prop('checked') || $('#'+i+'root'+day).prop('checked')){
                       cereal=1;
                    }
                    if($('#'+i+'veg'+day).prop('checked')){
                        veg=1;
                    }
                    if($('#'+i+'meat'+day).prop('checked') || $('#'+i+'egg'+day).prop('checked')|| $('#'+i+'fish'+day).prop('checked')){
                        meat=1;
                    }
                    if($('#'+i+'pulse'+day).prop('checked')){
                        pulse=1;
                    }
                    if($('#'+i+'milk'+day).prop('checked')){
                        milk=1;
                    }
                    if($('#'+i+'fruit'+day).prop('checked')){
                        fruit=1;
                    }
                    if($('#'+i+'oil'+day).prop('checked')){
                        oil=1;
                    }
                }
                if(day==1){
                    this.form.total_score1=cereal+veg+meat+pulse+milk+fruit+oil;
                }
                if(day==2){
                    this.form.total_score2=cereal+veg+meat+pulse+milk+fruit+oil;
                }
                if(day==3){
                    this.form.total_score3=cereal+veg+meat+pulse+milk+fruit+oil;
                }
                if(day==4){
                    this.form.total_score4=cereal+veg+meat+pulse+milk+fruit+oil;
                }
                if(day==5){
                    this.form.total_score5=cereal+veg+meat+pulse+milk+fruit+oil;
                }
                if(day==6){
                    this.form.total_score6=cereal+veg+meat+pulse+milk+fruit+oil;
                }
                if(day==7){
                    this.form.total_score7=cereal+veg+meat+pulse+milk+fruit+oil;
                }
                this.form.average_score=((this.form.total_score1+this.form.total_score2+this.form.total_score3+this.form.total_score4+this.form.total_score5+this.form.total_score6+this.form.total_score7)/7).toFixed(2);
                $('.averate_score_bg').removeClass('bg-danger bg-success bg-gradient-info');
                if(this.form.average_score<4.5){
                    $('#average_text').html('Low dietary diversity');
                    $('.averate_score_bg').addClass('bg-danger');
                }
                if(this.form.average_score>=4.5 && this.form.average_score<6){
                    $('#average_text').html('Medium dietary diversity');
                    $('.averate_score_bg').addClass('bg-success');
                }
                if(this.form.average_score>=6){
                    $('#average_text').html('Good dietary diversity');
                    $('.averate_score_bg').addClass('bg-gradient-info');
                }
            }
        },
        checkdata(date){
            if(date=="record_data"){
                date=$('#'+date).val();
            }
            let uri="diatery/checkdata/"+date;
            axios.get(uri)
            .then(response => {
                let data = response.data;
                if(data==1 || data==true){
                    $('#esist_message').html('This date has already been recorded. Please click on list view to check more details');
                    $('#action_buttons').hide();
                }
                else{
                    $('#esist_message').html('');
                    $('#action_buttons').show();
                }
            })
            .catch(function (error) {
                console.log("Error:"+error)
            });
        },
        validateDate(){
            let returntype=true;
            let dates='';
            for(let i=1;i<8;i++){
                if($('#record_data'+i).val()==""){
                    returntype=false;
                }
                if($('#record_data'+i).val()!="" && dates.includes($('#record_data'+i).val())){
                    dates='duplicate';
                    returntype=false;
                    break;
                }
                if($('#record_data'+i).val()!=""){
                    dates=dates+$('#record_data'+i).val();
                }

            }
            if(returntype==false){
                Swal.fire({
                    text: "Please mention all dates",
                    icon: 'error',
                });
            }
            if(dates=="duplicate"){
                Swal.fire({
                    text: "You are mentioning same date multiple times, please check and provide unique date",
                    icon: 'error',
                });
            }
            return returntype;
        },
        formaction(action){
            if(action=="save" && this.validateDate()){
                Swal.fire({
                    text: "Are you sure you wish to save this details ?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        this.form.post('/diatery/savediatery')
                        .then(() => {
                            Toast.fire({
                                icon: 'success',
                                title: 'Details has been added successfully'
                            });
                            this.$router.push('/dietary_records_list');
                        })
                        .catch((error) => {
                            console.log("Error:"+error)
                        })
                    }
                });
            }
        },
    },
    mounted() {
        // let currentdate = new Date();
        // let month=currentdate.getMonth()+1;
        // if(month.toString().length==1){
        //     month='0'+month;
        // }
        // let curr_date=currentdate.getFullYear()+'-'+month+'-'+currentdate.getDate();
        // this.form.record_date=curr_date;
        // this.checkdata(curr_date);
    },
}
</script>
