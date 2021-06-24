<template>
    <div>
        <div class="callout callout-danger" style="display:none" id="screenPermission">
            <h5 class="bg-gradient-danger">Sorry!</h5>
            <div id="existmessage"></div>
        </div>
        <div class="card card-primary card-outline card-outline-tabs" id="mainform">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead" role="tablist">
                    <li class="nav-item outdoor-tabs" @click="shownexttab('outdoor-tabs')">
                        <a class="nav-link active" data-toggle="pill" role="tab">
                            <label> OUTDOOR SPACE & EQUIPMENTS </label>
                        </a>
                    </li>
                    <li class="nav-item indoor-tab">
                        <a class="nav-link" data-toggle="pill" @click="shownexttab('indoor-tab')" role="tab">
                            <label> INDOOR SPACE & EQUIPMENTS </label>
                        </a>
                    </li>
                    <li class="nav-item indoorspace-tab">
                        <a class="nav-link" data-toggle="pill" @click="shownexttab('indoorspace-tab')" role="tab">
                            <label> INDOOR SPACE </label>
                        </a>
                    </li>
                    <li class="nav-item building-tab">
                        <a class="nav-link" data-toggle="pill" @click="shownexttab('building-tab')" role="tab">
                            <label> BUILDINGS </label>
                        </a>
                    </li>
                    <li class="nav-item location-tab">
                        <a class="nav-link" data-toggle="pill" @click="shownexttab('location-tab')" role="tab">
                            <label> LOCATION</label>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="outdoor-tabs" role="tabpanel" aria-labelledby="basicdetails">
                        <table id="waterTable" class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <thead>
                                <tr>
                                    <th style="width:60%">Description</th>
                                    <th style="width:40%">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in outdoor_form.questionList" :key="index">
                                    <td>{{ item.name}}</td>
                                    <td v-if="item.answer_type=='TextArea'">
                                        <textarea class="form-control" :name="'outdoor_textarea'+index" v-model="item.answered" :id="item.id" @change="remove_err(item.id)"></textarea>
                                        <label class="text-danger" :id="item.id+'err'"></label>
                                    </td>

                                    <td v-if="item.answer_type=='Text'">
                                        <input class="form-control" :name="'outdoor_text'+index" type="text" v-model="item.answered" :id="item.id" @change="remove_err(item.id)">
                                        <label class="text-danger" :id="item.id+'err'"></label>
                                    </td>

                                    <td v-if="item.answer_type=='Number'">
                                        <input class="form-control" :name="'outdoor_number'+index" type="number" v-model="item.answered" :id="item.id" @change="remove_err(item.id)">
                                        <label class="text-danger" :id="item.id+'err'"></label>
                                    </td>

                                    <td v-if="item.answer_type=='Radio'">
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <span v-for="(ans, index1) in item.ans_list" :key="index1">
                                                <input type="radio" :name="'outdoor_radio'+index" v-model="ans.answered" :id="item.id+'_'+ans.id" @change="remove_err(item.id+'_'+ans.id)" class="ml-4" :value="ans.id"> <label>  {{ans.name}} </label>
                                            </span>
                                        </div>
                                        <label class="ml-4 text-danger" :id="item.id+'err'"></label>
                                    </td>

                                    <td v-if="item.answer_type=='Dropdown'">
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <select name="category" v-model="item.answered" :id="item.id" @change="remove_err(item.id)" class="form-control">
                                                <option value="">--- Please Select ---</option>
                                                <option v-for="(item, index) in item.ans_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                            </select>
                                            <label class="text-danger" :id="item.id+'err'"></label>
                                        </div>
                                    </td>

                                    <td v-if="item.answer_type=='Checkbox'">
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <span v-for="(ans, index1) in item.ans_list" :key="index1">
                                                <input type="checkbox" :name="'outdoor_check'+index" v-model="ans.answered" :id="item.id+'_'+ans.id" class="ml-4" :value="ans.id" @change="remove_err(item.id+'_'+ans.id)">
                                                <label>{{ans.name}} </label>
                                            </span>
                                        </div>
                                        <label class="ml-4 text-danger" :id="item.id+'err'"></label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" @click="shownexttab('indoor-tab')">Save & Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade tab-content-details" id="indoor-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <table id="dynamic-table1" class="table w-100  table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width:60%">Description</th>
                                    <th style="width:40%">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in indoor_form.questionList" :key="index">
                                    <td>{{ item.name}}</td>
                                    <td v-if="item.answer_type=='TextArea'">
                                        <textarea class="form-control" :name="'indoor_textarea'+index" v-model="item.answered" :id="item.id" @change="remove_err(item.id)"></textarea>
                                        <label class="text-danger" :id="item.id+'err'"></label>
                                    </td>

                                    <td v-if="item.answer_type=='Text'">
                                        <input class="form-control" :name="'indoor_text'+index" type="text" v-model="item.answered" :id="item.id" @change="remove_err(item.id)">
                                        <label class="text-danger" :id="item.id+'err'"></label>
                                    </td>

                                    <td v-if="item.answer_type=='Number'">
                                        <input class="form-control" :name="'indoor_number'+index" type="number" v-model="item.answered" :id="item.id" @change="remove_err(item.id)">
                                        <label class="text-danger" :id="item.id+'err'"></label>
                                    </td>

                                    <td v-if="item.answer_type=='Radio'">
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <span v-for="(ans, index1) in item.ans_list" :key="index1">
                                                <input type="radio" :name="'indoor_radio'+index" v-model="ans.answered" :id="item.id+'_'+ans.id" @change="remove_err(item.id+'_'+ans.id)" class="ml-4" :value="ans.id"> <label>  {{ans.name}} </label>
                                            </span>
                                        </div>
                                        <label class="text-danger" :id="item.id+'err'"></label>
                                    </td>

                                    <td v-if="item.answer_type=='Dropdown'">
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <select name="category" v-model="item.answered" :id="item.id" @change="remove_err(item.id)" class="form-control">
                                                <option value="">--- Please Select ---</option>
                                                <option v-for="(item, index) in item.ans_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                            </select>
                                            <label class="text-danger" :id="item.id+'err'"></label>
                                        </div>
                                    </td>

                                    <td v-if="item.answer_type=='Checkbox'">
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <span v-for="(ans, index1) in item.ans_list" :key="index1">
                                                <input type="checkbox" :name="'indoor_check'+index" v-model="ans.answered" :id="item.id+'_'+ans.id" @change="remove_err(item.id+'_'+ans.id)" class="ml-4" :value="ans.id">
                                                <label>{{ans.name}} </label>
                                            </span>
                                        </div>
                                        <label class="text-danger" :id="item.id+'err'"></label>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('outdoor-tabs')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-primary" @click="shownexttab('indoorspace-tab')"> <i class="fa fa-arrow-right"></i>Next </button>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade tab-content-details" id="indoorspace-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <table id="dynamic-table1" class="table w-100  table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width:60%">Description</th>
                                    <th style="width:40%">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in indoorspace_form.questionList" :key="index">
                                    <td>{{ item.name}}</td>
                                    <td v-if="item.answer_type=='TextArea'">
                                        <textarea class="form-control" :name="'indoorspace_textarea'+index" v-model="item.answered" :id="item.id" @change="remove_err(item.id)"></textarea>
                                        <label class="text-danger" :id="item.id+'err'"></label>
                                    </td>

                                    <td v-if="item.answer_type=='Text'">
                                        <input class="form-control" :name="'indoorspace_text'+index" type="text" v-model="item.answered" :id="item.id" @change="remove_err(item.id)">
                                        <label class="text-danger" :id="item.id+'err'"></label>
                                    </td>

                                    <td v-if="item.answer_type=='Number'">
                                        <input class="form-control" :name="'indoorspace_number'+index" type="number" v-model="item.answered" :id="item.id" @change="remove_err(item.id)">
                                        <label class="text-danger" :id="item.id+'err'"></label>
                                    </td>

                                    <td v-if="item.answer_type=='Radio'">
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <span v-for="(ans, index1) in item.ans_list" :key="index1">
                                                <input type="radio" :name="'indoorspace_radio'+index" v-model="ans.answered" :id="item.id+'_'+ans.id" @change="remove_err(item.id+'_'+ans.id)" class="ml-4" :value="ans.id"> <label>  {{ans.name}} </label>
                                            </span>
                                        </div>
                                        <label class="text-danger" :id="item.id+'err'"></label>
                                    </td>

                                    <td v-if="item.answer_type=='Dropdown'">
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <select name="category" v-model="item.answered" :id="item.id" @change="remove_err(item.id)" class="form-control">
                                                <option value="">--- Please Select ---</option>
                                                <option v-for="(item, index) in item.ans_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                            </select>
                                            <label class="text-danger" :id="item.id+'err'"></label>
                                        </div>
                                    </td>

                                    <td v-if="item.answer_type=='Checkbox'">
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <span v-for="(ans, index1) in item.ans_list" :key="index1">
                                                <input type="checkbox" :name="'indoorspace_check'+index" v-model="ans.answered" :id="item.id+'_'+ans.id" @change="remove_err(item.id+'_'+ans.id)" class="ml-4" :value="ans.id">
                                                <label>{{ans.name}} </label>
                                            </span>
                                        </div>
                                        <label class="text-danger" :id="item.id+'err'"></label>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('indoor-tabs')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-primary" @click="shownexttab('building-tab')"> <i class="fa fa-arrow-right"></i>Next </button>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade tab-content-details" id="building-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <table id="dynamic-table1" class="table w-100  table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width:60%">Description</th>
                                    <th style="width:40%">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in building_form.questionList" :key="index">
                                    <td>{{ item.name}}</td>
                                    <td v-if="item.answer_type=='TextArea'">
                                        <textarea class="form-control" :name="'building_textarea'+index" v-model="item.answered" :id="item.id" @change="remove_err(item.id)"></textarea>
                                        <label class="text-danger" :id="item.id+'err'"></label>
                                    </td>

                                    <td v-if="item.answer_type=='Text'">
                                        <input class="form-control" :name="'building_text'+index" type="text" v-model="item.answered" :id="item.id" @change="remove_err(item.id)">
                                        <label class="text-danger" :id="item.id+'err'"></label>
                                    </td>

                                    <td v-if="item.answer_type=='Number'">
                                        <input class="form-control" :name="'building_number'+index" type="number" v-model="item.answered" :id="item.id" @change="remove_err(item.id)">
                                        <label class="text-danger" :id="item.id+'err'"></label>
                                    </td>

                                    <td v-if="item.answer_type=='Radio'">
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <span v-for="(ans, index1) in item.ans_list" :key="index1">
                                                <input type="radio" :name="'building_radio'+index" v-model="ans.answered" :id="item.id+'_'+ans.id" @change="remove_err(item.id+'_'+ans.id)" class="ml-4" :value="ans.id"> <label>  {{ans.name}} </label>
                                            </span>
                                        </div>
                                        <label class="text-danger" :id="item.id+'err'"></label>
                                    </td>

                                    <td v-if="item.answer_type=='Dropdown'">
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <select name="category" v-model="item.answered" :id="item.id" @change="remove_err(item.id)" class="form-control">
                                                <option value="">--- Please Select ---</option>
                                                <option v-for="(item, index) in item.ans_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                            </select>
                                            <label class="text-danger" :id="item.id+'err'"></label>
                                        </div>
                                    </td>

                                    <td v-if="item.answer_type=='Checkbox'">
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <span v-for="(ans, index1) in item.ans_list" :key="index1">
                                                <input type="checkbox" :name="'building_check'+index" v-model="ans.answered" :id="item.id+'_'+ans.id" @change="remove_err(item.id+'_'+ans.id)" class="ml-4" :value="ans.id">
                                                <label>{{ans.name}} </label>
                                            </span>
                                        </div>
                                        <label class="text-danger" :id="item.id+'err'"></label>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('indoorspace-tabs')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-primary" @click="shownexttab('location-tab')"> <i class="fa fa-arrow-right"></i>Next </button>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade tab-content-details" id="location-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <table id="dynamic-table2" class="table w-100  table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width:60%">Description</th>
                                    <th style="width:40%">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in location_form.questionList" :key="index">
                                    <td>{{ item.name}}</td>
                                    <td v-if="item.answer_type=='TextArea'">
                                        <textarea class="form-control" :name="'location_textarea'+index" v-model="item.answered" :id="item.id" @change="remove_err(item.id)"></textarea>
                                        <label class="text-danger" :id="item.id+'err'"></label>
                                    </td>
                                    <td v-if="item.answer_type=='Text'">
                                        <input class="form-control" :name="'location_text'+index" type="text" v-model="item.answered" :id="item.id" @change="remove_err(item.id)">
                                        <label class="text-danger" :id="item.id+'err'"></label>
                                    </td>
                                    <td v-if="item.answer_type=='Number'">
                                        <input class="form-control" :name="'location_number'+index" type="number" v-model="item.answered" :id="item.id" @change="remove_err(item.id)">
                                        <label class="text-danger" :id="item.id+'err'"></label>
                                    </td>
                                    <td v-if="item.answer_type=='Radio'">
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <span v-for="(ans, index1) in item.ans_list" :key="index1">
                                                <input type="radio" :name="'location_radio'+index" v-model="ans.answered" :id="item.id+'_'+ans.id" @change="remove_err(item.id+'_'+ans.id)" class="ml-4" :value="ans.id"> <label>  {{ans.name}} </label>
                                            </span>
                                        </div>
                                        <label class="text-danger" :id="item.id+'err'"></label>
                                    </td>
                                    <td v-if="item.answer_type=='Dropdown'">
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <select name="category" v-model="item.answered" :id="item.id" @change="remove_err(item.id)" class="form-control">
                                                <option value="">--- Please Select ---</option>
                                                <option v-for="(item, index) in item.ans_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                            </select>
                                            <label class="text-danger" :id="item.id+'err'"></label>
                                        </div>
                                    </td>
                                    <td v-if="item.answer_type=='Checkbox'">
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <span v-for="(ans, index1) in item.ans_list" :key="index1">
                                                <input type="checkbox" :name="'location_check'+index" v-model="ans.answered" :id="item.id+'_'+ans.id" @change="remove_err(item.id+'_'+ans.id)" class="ml-4" :value="ans.id">
                                                <label>{{ans.name}} </label>
                                            </span>
                                        </div>
                                        <label class="text-danger" :id="item.id+'err'"></label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('building-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
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
            outdoor_form: new form({
                type:'outdoor',
                questionList:[],
            }),
            indoor_form: new form({
                type:'indoor',
                questionList:[],
            }),
            indoorspace_form: new form({
                type:'indoorspace',
                questionList:[],
            }),
            building_form: new form({
                type:'building',
                questionList:[],
            }),
            location_form: new form({
                type:'location',
                questionList:[],
            })
        }
    },

    methods:{ 
        shownexttab(nextclass){
            if(nextclass=="indoor-tab"){
                let validated=true;
                for(let i=0;i<this.outdoor_form.questionList.length;i++){
                    if(this.outdoor_form.questionList[i].answer_type=="Checkbox" || this.outdoor_form.questionList[i].answer_type=="Radio"){
                        let valid=false;
                        for(let j=0;j<this.outdoor_form.questionList[i].ans_list.length;j++){
                            if($('#'+this.outdoor_form.questionList[i].id+'_'+this.outdoor_form.questionList[i].ans_list[j].id).prop('checked')){
                                valid=true;
                                // alert($('#'+this.outdoor_form.questionList[i].id+'_'+this.outdoor_form.questionList[i].ans_list[j].id).val());
                                this.outdoor_form.questionList[i].ans_list[j].answered=$('#'+this.outdoor_form.questionList[i].id+'_'+this.outdoor_form.questionList[i].ans_list[j].id).val();
                            }
                            else{
                                this.outdoor_form.questionList[i].ans_list[j].answered='';
                            }
                        }
                        if(!valid){
                            $('#'+this.outdoor_form.questionList[i].id+'err').html('Please answer this');
                            $('#'+this.outdoor_form.questionList[i].id).addClass('is-invalid');
                            validated=false;
                        }
                    }
                    else if(this.outdoor_form.questionList[i].answer_type=="Text" || this.outdoor_form.questionList[i].answer_type=="Number" || this.outdoor_form.questionList[i].answer_type=="TextArea" || this.outdoor_form.questionList[i].answer_type=="Dropdown"){
                        if($('#'+this.outdoor_form.questionList[i].id).val()==null || $('#'+this.outdoor_form.questionList[i].id).val()==""){
                            $('#'+this.outdoor_form.questionList[i].id+'err').html('Please answer this');
                            $('#'+this.outdoor_form.questionList[i].id).addClass('is-invalid');
                            validated=false;
                        }
                        else{
                            this.outdoor_form.questionList[i].answered =$('#'+this.outdoor_form.questionList[i].id).val();
                        }
                    }
                }
                if(validated==true){
                    this.outdoor_form.post('organization/structural/saveOutdoorInfo')
                    .then((response) => {
                        if(response.data!=""){
                            Toast.fire({
                                icon: 'success',
                                title: 'Data saved Successfully'
                            });
                            this.loadOutdoorList('indoor');
                            this.change_tab(nextclass);
                        }
                    })
                    .catch((error) => {
                        console.log("Error: "+error)
                    });
                }
            }

            if(nextclass=="indoorspace-tab"){
                let validated=true;
                for(let i=0;i<this.indoor_form.questionList.length;i++){
                    if(this.indoor_form.questionList[i].answer_type=="Checkbox" || this.indoor_form.questionList[i].answer_type=="Radio"){
                        let valid=false;
                        for(let j=0;j<this.indoor_form.questionList[i].ans_list.length;j++){
                            if($('#'+this.indoor_form.questionList[i].id+'_'+this.indoor_form.questionList[i].ans_list[j].id).prop('checked')){
                                valid=true;
                                // alert($('#'+this.wash_form.questionList[i].id+'_'+this.wash_form.questionList[i].ans_list[j].id).val());
                                this.indoor_form.questionList[i].ans_list[j].answered=$('#'+this.indoor_form.questionList[i].id+'_'+this.indoor_form.questionList[i].ans_list[j].id).val();
                            }
                            else{
                                this.indoor_form.questionList[i].ans_list[j].answered='';
                            }
                        }
                        if(!valid){
                            $('#'+this.indoor_form.questionList[i].id+'err').html('Please answer this');
                            $('#'+this.indoor_form.questionList[i].id).addClass('is-invalid');
                            validated=false;
                        }
                    }
                    else if(this.indoor_form.questionList[i].answer_type=="Text" || this.indoor_form.questionList[i].answer_type=="Number" || this.indoor_form.questionList[i].answer_type=="TextArea" || this.indoor_form.questionList[i].answer_type=="Dropdown"){
                        if($('#'+this.indoor_form.questionList[i].id).val()==null || $('#'+this.indoor_form.questionList[i].id).val()==""){
                            $('#'+this.indoor_form.questionList[i].id+'err').html('Please answer this');
                            $('#'+this.indoor_form.questionList[i].id).addClass('is-invalid');
                            validated=false;
                        }
                        else{
                            this.indoor_form.questionList[i].answered =$('#'+this.indoor_form.questionList[i].id).val();
                        }
                    }
                }
                if(validated==true){
                    this.indoor_form.post('organization/structural/saveIndoorInfo')
                    .then((response) => {
                        if(response.data!=""){
                            Toast.fire({
                                icon: 'success',
                                title: 'Data saved Successfully'
                            });
                            this.loadIndoorList('indoorspace');
                            this.change_tab(nextclass);
                        }
                    })
                    .catch((error) => {
                        console.log("Error: "+error)
                    });
                }
            }

            if(nextclass=="building-tab"){
                let validated=true;
                for(let i=0;i<this.indoorspace_form.questionList.length;i++){
                    if(this.indoorspace_form.questionList[i].answer_type=="Checkbox" || this.indoorspace_form.questionList[i].answer_type=="Radio"){
                        let valid=false;
                        for(let j=0;j<this.indoorspace_form.questionList[i].ans_list.length;j++){
                            if($('#'+this.indoorspace_form.questionList[i].id+'_'+this.indoorspace_form.questionList[i].ans_list[j].id).prop('checked')){
                                valid=true;
                                // alert($('#'+this.wash_form.questionList[i].id+'_'+this.wash_form.questionList[i].ans_list[j].id).val());
                                this.indoorspace_form.questionList[i].ans_list[j].answered=$('#'+this.indoorspace_form.questionList[i].id+'_'+this.indoorspace_form.questionList[i].ans_list[j].id).val();
                            }
                            else{
                                this.indoorspace_form.questionList[i].ans_list[j].answered='';
                            }
                        }
                        if(!valid){
                            $('#'+this.indoorspace_form.questionList[i].id+'err').html('Please answer this');
                            $('#'+this.indoorspace_form.questionList[i].id).addClass('is-invalid');
                            validated=false;
                        }
                    }
                    else if(this.indoorspace_form.questionList[i].answer_type=="Text" || this.indoorspace_form.questionList[i].answer_type=="Number" || this.indoorspace_form.questionList[i].answer_type=="TextArea" || this.indoorspace_form.questionList[i].answer_type=="Dropdown"){
                        if($('#'+this.indoorspace_form.questionList[i].id).val()==null || $('#'+this.indoorspace_form.questionList[i].id).val()==""){
                            $('#'+this.indoorspace_form.questionList[i].id+'err').html('Please answer this');
                            $('#'+this.indoorspace_form.questionList[i].id).addClass('is-invalid');
                            validated=false;
                        }
                        else{
                            this.indoorspace_form.questionList[i].answered =$('#'+this.indoorspace_form.questionList[i].id).val();
                        }
                    }
                }
                if(validated==true){
                    this.indoorspace_form.post('organization/structural/saveIndoorSpace')
                    .then((response) => {
                        if(response.data!=""){
                            Toast.fire({
                                icon: 'success',
                                title: 'Data saved Successfully'
                            });
                            this.loadIndoorSpaceList('building');
                            this.change_tab(nextclass);
                        }
                    })
                    .catch((error) => {
                        console.log("Error: "+error)
                    });
                }
            }

            if(nextclass=="location-tab"){
                let validated=true;
                for(let i=0;i<this.building_form.questionList.length;i++){
                    if(this.building_form.questionList[i].answer_type=="Checkbox" || this.building_form.questionList[i].answer_type=="Radio"){
                        let valid=false;
                        for(let j=0;j<this.building_form.questionList[i].ans_list.length;j++){
                            if($('#'+this.building_form.questionList[i].id+'_'+this.building_form.questionList[i].ans_list[j].id).prop('checked')){
                                valid=true;
                                // alert($('#'+this.sanitation_form.questionList[i].id+'_'+this.sanitation_form.questionList[i].ans_list[j].id).val());
                                this.building_form.questionList[i].ans_list[j].answered=$('#'+this.building_form.questionList[i].id+'_'+this.building_form.questionList[i].ans_list[j].id).val();
                            }
                            else{
                                this.building_form.questionList[i].ans_list[j].answered='';
                            }
                        }
                        if(!valid){
                            $('#'+this.building_form.questionList[i].id+'err').html('Please answer this');
                            $('#'+this.building_form.questionList[i].id).addClass('is-invalid');
                            validated=false;
                        }
                    }
                    else if(this.building_form.questionList[i].answer_type=="Text" || this.building_form.questionList[i].answer_type=="Number" || this.building_form.questionList[i].answer_type=="TextArea" || this.building_form.questionList[i].answer_type=="Dropdown"){
                        if($('#'+this.building_form.questionList[i].id).val()==null || $('#'+this.building_form.questionList[i].id).val()==""){
                            $('#'+this.building_form.questionList[i].id+'err').html('Please answer this');
                            $('#'+this.building_form.questionList[i].id).addClass('is-invalid');
                            validated=false;
                        }
                        else{
                            this.building_form.questionList[i].answered =$('#'+this.building_form.questionList[i].id).val();
                        }
                    }
                }
                if(validated==true){
                    this.building_form.post('organization/structural/saveBuildingInfo')
                    .then((response) => {
                        if(response.data!=""){
                            Toast.fire({
                                icon: 'success',
                                title: 'Data saved Successfully'
                            });
                            this.loadBuildingInfoList('location');
                            this.change_tab(nextclass);
                        }
                    })
                    .catch((error) => {
                        console.log("Error: "+error)
                    });
                }

            }
            if(nextclass=="final-tab"){
                let validated=true;
                for(let i=0;i<this.location_form.questionList.length;i++){
                    if(this.location_form.questionList[i].answer_type=="Checkbox" || this.location_form.questionList[i].answer_type=="Radio"){
                        let valid=false;
                        for(let j=0;j<this.location_form.questionList[i].ans_list.length;j++){
                            if($('#'+this.location_form.questionList[i].id+'_'+this.location_form.questionList[i].ans_list[j].id).prop('checked')){
                                valid=true;
                                // alert($('#'+this.hygiene_form.questionList[i].id+'_'+this.hygiene_form.questionList[i].ans_list[j].id).val());
                                this.location_form.questionList[i].ans_list[j].answered=$('#'+this.location_form.questionList[i].id+'_'+this.location_form.questionList[i].ans_list[j].id).val();
                            }
                            else{
                                this.location_form.questionList[i].ans_list[j].answered='';
                            }
                        }
                        if(!valid){
                            $('#'+this.location_form.questionList[i].id+'err').html('Please answer this');
                            $('#'+this.location_form.questionList[i].id).addClass('is-invalid');
                            validated=false;
                        }
                    }
                    else if(this.location_form.questionList[i].answer_type=="Text" || this.location_form.questionList[i].answer_type=="Number" || this.location_form.questionList[i].answer_type=="TextArea" || this.location_form.questionList[i].answer_type=="Dropdown"){
                        if($('#'+this.location_form.questionList[i].id).val()==null || $('#'+this.location_form.questionList[i].id).val()==""){
                            $('#'+this.location_form.questionList[i].id+'err').html('Please answer this');
                            $('#'+this.location_form.questionList[i].id).addClass('is-invalid');
                            validated=false;
                        }
                        else{
                            this.location_form.questionList[i].answered =$('#'+this.location_form.questionList[i].id).val();
                        }
                    }
                }
                if(validated==true){
                    Swal.fire({
                        text: "Are you sure you wish to save these details ?",
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes!',
                        }).then((result) => {
                        if (result.isConfirmed) {
                            this.location_form.post('organization/structural/saveECCDLocationInfo')
                            .then((response) => {
                                if(response.data!=""){
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Data saved Successfully. Thank You! '
                                    });
                                    this.$router.push({path:'/structural_index'});
                                }
                            })
                            .catch((error) => {
                                console.log("Error: "+error)
                            });
                        }
                    });
                }

            }
            if(nextclass=="outdoor-tabs"){
               this.loadOutdoorList('outdoor');
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
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                if(field_id.includes('_')){
                    $('#'+field_id.split('_')[0]+'err').html('');
                }
                $('#'+field_id+'err').html('');
            }
        },
        loadQuestionList(param){
            axios.get('questionAnswerController/loadQuestionaries/washAndOthers_'+param+'_Question')
            .then(response => {
                let data = response.data.data;
                if(param=="outdoor"){
                    this.outdoor_form.questionList =  data;
                }
                if(param=="indoor"){
                    this.indoor_form.questionList =  data;
                }
                if(param=="indoorspace"){
                    this.indoorspace_form.questionList =  data;
                }
                if(param=="building"){
                    this.building_form.questionList =  data;
                }
                if(param=="location"){
                    this.location_form.questionList =  data;
                }
            })
            .catch(function (error){
                console.log(error.toString());
            });
        },
        loadOutdoorList(param){
            let uri = 'organization/structural/getloadOutdoorList/'+param;
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    if(data[i].ans_type=="Checkbox" || data[i].ans_type=="Radio"){
                        $('#'+data[i].questionId+'_'+data[i].answer).prop('checked',true);
                    }
                    else if(data[i].ans_type=="Text" || data[i].ans_type=="Number" || data[i].ans_type=="TextArea" || data[i].ans_type=="Dropdown"){
                        $('#'+data[i].questionId).val(data[i].answer);
                    }
                    else{
                        $('#'+data[i].questionId+'_'+data[i].answer).val(data[i].answer);
                    }
                }
            })
            .catch(function (error){
                console.log(error.toString());
            });
        },

        getScreenAccess(){
            axios.get('common/getSessionDetail')
            .then(response => {
                let data = response.data.data.acess_level;
                if(data != "Org"){
                    $('#mainform').hide();
                    $('#screenPermission').show();
                    $('#existmessage').html('You have no access to this page.');
                }

            })
            .catch(errors => {
                console.log(errors)
            });
        }
    },

    mounted(){
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        // this.getScreenAccess();
        this.loadQuestionList('outdoor');
        this.loadQuestionList('indoor');
         this.loadQuestionList('indoorspace');
          this.loadQuestionList('building');
        this.loadQuestionList('location');

        this.loadOutdoorList('outdoor');
        //this.loadWashDetialsList('sanitation');




    },
}
</script>
