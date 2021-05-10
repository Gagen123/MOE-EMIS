<template>
    <div>
        <div class="callout callout-danger" style="display:none" id="screenPermission">
            <h5 class="bg-gradient-danger">Sorry!</h5>
            <div id="existmessage"></div>
        </div>
        <div class="card card-primary card-outline card-outline-tabs" id="mainform">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <li class="nav-item kitchen-tab" @click="shownexttab('kitchen-tab')">
                        <a class="nav-link active" data-toggle="pill" role="tab"> 
                            <label class="mb-0.5">Kitchen Status </label>                              
                        </a>
                    </li>
                    <li class="nav-item foodstore-tab" @click="shownexttab('foodstore-tab')">
                        <a class="nav-link" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Food Store Status </label>
                        </a>
                    </li>
                    <li class="nav-item equipment-tab" @click="shownexttab('equipment-tab')">
                        <a class="nav-link" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Equipment & Utensils in kitchen</label>
                        </a>
                    </li>
                    <li class="nav-item dinning-tab" @click="shownexttab('dinning-tab')">
                        <a class="nav-link" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Dinning Hall</label>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body pt-0 mt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="kitchen-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <table class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <thead>
                                <tr>
                                    <th width="60px">Description</th>
                                    <th width="40px">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in questionList" :key="index">
                                    <td>{{ item.name}}</td>
                                    <td v-if="item.answer_type=='TextArea'">
                                        <textarea class="form-control" :name="'wash_textarea'+index" v-model="item.answered" :id="item.id" @change="remove_err(item.id)"></textarea>
                                        <label class="text-danger" :id="item.id+'err'"></label>
                                    </td>
                                    <td v-if="item.answer_type=='Text'">
                                        <input class="form-control" :name="'wash_text'+index" type="text" v-model="item.answered" :id="item.id" @change="remove_err(item.id)">
                                        <label class="text-danger" :id="item.id+'err'"></label>
                                    </td>
                                    <td v-if="item.answer_type=='Number'">
                                        <input class="form-control" :name="'wash_number'+index" type="number" v-model="item.answered" :id="item.id" @change="remove_err(item.id)">
                                        <label class="text-danger" :id="item.id+'err'"></label>
                                    </td>
                                    <td v-if="item.answer_type=='Radio'">
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <span v-for="(ans, index1) in item.ans_list" :key="index1">
                                                <input type="radio" :name="'wash_radio'+index" v-model="ans.answered" :id="item.id+'_'+ans.id" @change="remove_err(item.id+'_'+ans.id)" class="ml-4" :value="ans.id"> <label>  {{ans.name}} </label>
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
                                                <input type="checkbox" :name="'wash_check'+index" v-model="ans.answered" :id="item.id+'_'+ans.id" class="ml-4" :value="ans.id" @change="remove_err(item.id+'_'+ans.id)">
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
                                <button class="btn btn-primary" @click="shownexttab('foodstore-tab')">Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade tab-content-details" id="foodstore-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <table class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <thead>
                                <tr>
                                    <th width="60px">Description</th>
                                    <th width="40px">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in foodquestionList" :key="index">
                                    <td>{{ item.name}}</td>
                                    <td v-if="item.answer_type=='TextArea'">
                                        <textarea class="form-control" :name="'wash_textarea'+index" v-model="item.answered" :id="item.id" @change="remove_err(item.id)"></textarea>
                                        <label class="text-danger" :id="item.id+'err'"></label>
                                    </td>
                                    <td v-if="item.answer_type=='Text'">
                                        <input class="form-control" :name="'wash_text'+index" type="text" v-model="item.answered" :id="item.id" @change="remove_err(item.id)">
                                        <label class="text-danger" :id="item.id+'err'"></label>
                                    </td>
                                    <td v-if="item.answer_type=='Number'">
                                        <input class="form-control" :name="'wash_number'+index" type="number" v-model="item.answered" :id="item.id" @change="remove_err(item.id)">
                                        <label class="text-danger" :id="item.id+'err'"></label>
                                    </td>
                                    <td v-if="item.answer_type=='Radio'">
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <span v-for="(ans, index1) in item.ans_list" :key="index1">
                                                <input type="radio" :name="'wash_radio'+index" v-model="ans.answered" :id="item.id+'_'+ans.id" @change="remove_err(item.id+'_'+ans.id)" class="ml-4" :value="ans.id"> <label>  {{ans.name}} </label>
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
                                                <input type="checkbox" :name="'wash_check'+index" v-model="ans.answered" :id="item.id+'_'+ans.id" class="ml-4" :value="ans.id" @change="remove_err(item.id+'_'+ans.id)">
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
                                <button class="btn btn-success" @click="shownexttab('kitchen-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-primary" @click="shownexttab('equipment-tab')"> <i class="fa fa-arrow-right"></i>Next </button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade tab-content-details" id="equipment-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <table class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:none" id="equipment-tab-table">
                            <thead>
                                <tr>
                                    <th width="60px">Description</th>
                                    <th width="40px">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in equipquestionList" :key="index">
                                    <td>{{ item.name}}</td>
                                    <td v-if="item.answer_type=='TextArea'">
                                        <textarea class="form-control" :name="'wash_textarea'+index" v-model="item.answered" :id="item.id" @change="remove_err(item.id)"></textarea>
                                        <label class="text-danger" :id="item.id+'err'"></label>
                                    </td>
                                    <td v-if="item.answer_type=='Text'">
                                        <input class="form-control" :name="'wash_text'+index" type="text" v-model="item.answered" :id="item.id" @change="remove_err(item.id)">
                                        <label class="text-danger" :id="item.id+'err'"></label>
                                    </td>
                                    <td v-if="item.answer_type=='Number'">
                                        <input class="form-control" :name="'wash_number'+index" type="number" v-model="item.answered" :id="item.id" @change="remove_err(item.id)">
                                        <label class="text-danger" :id="item.id+'err'"></label>
                                    </td>
                                    <td v-if="item.answer_type=='Radio'">
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <span v-for="(ans, index1) in item.ans_list" :key="index1">
                                                <input type="radio" :name="'wash_radio'+index" v-model="ans.answered" :id="item.id+'_'+ans.id" @change="remove_err(item.id+'_'+ans.id)" class="ml-4" :value="ans.id"> <label>  {{ans.name}} </label>
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
                                                <input type="checkbox" :name="'wash_check'+index" v-model="ans.answered" :id="item.id+'_'+ans.id" class="ml-4" :value="ans.id" @change="remove_err(item.id+'_'+ans.id)">
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
                                <button class="btn btn-success" @click="shownexttab('foodstore-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-primary" @click="shownexttab('dinning-tab')"> <i class="fa fa-arrow-right"></i>Next </button>
                            </div>
                        </div>
                    </div> 
                    <div class="tab-pane fade tab-content-details" id="dinning-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <table class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:none" id="dinning-tab-table">
                            <thead>
                                <tr>
                                    <th width="60px">Description</th>
                                    <th width="40px">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in dinningquestionList" :key="index">
                                    <td>{{ item.name}}</td>
                                    <td v-if="item.answer_type=='TextArea'">
                                        <textarea class="form-control" :name="'wash_textarea'+index" v-model="item.answered" :id="item.id" @change="remove_err(item.id)"></textarea>
                                        <label class="text-danger" :id="item.id+'err'"></label>
                                    </td>
                                    <td v-if="item.answer_type=='Text'">
                                        <input class="form-control" :name="'wash_text'+index" type="text" v-model="item.answered" :id="item.id" @change="remove_err(item.id)">
                                        <label class="text-danger" :id="item.id+'err'"></label>
                                    </td>
                                    <td v-if="item.answer_type=='Number'">
                                        <input class="form-control" :name="'wash_number'+index" type="number" v-model="item.answered" :id="item.id" @change="remove_err(item.id)">
                                        <label class="text-danger" :id="item.id+'err'"></label>
                                    </td>
                                    <td v-if="item.answer_type=='Radio'">
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <span v-for="(ans, index1) in item.ans_list" :key="index1">
                                                <input type="radio" :name="'wash_radio'+index" v-model="ans.answered" :id="item.id+'_'+ans.id" @change="remove_err(item.id+'_'+ans.id)" class="ml-4" :value="ans.id"> <label>  {{ans.name}} </label>
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
                                                <input type="checkbox" :name="'wash_check'+index" v-model="ans.answered" :id="item.id+'_'+ans.id" class="ml-4" :value="ans.id" @change="remove_err(item.id+'_'+ans.id)">
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
                                <button class="btn btn-success" @click="shownexttab('equipment-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
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
            questionList:[],
            foodquestionList:[],
            equipquestionList:[],
            dinningquestionList:[],
            ketchen_form: new form({
                type:'kitchen',
                questionList:[],
            }),
            foodstore_form: new form({
                type:'food',
                questionList:[],
            }),
            equipment_form: new form({
                type:'equipment',
                questionList:[],
            }),
            dinning_form: new form({
                type:'dinning',
                questionList:[],
            }),
        }
    },

    methods: {
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                if(field_id.includes('_')){
                    $('#'+field_id.split('_')[0]+'err').html('');
                }
                $('#'+field_id+'err').html('');
            }
        },
        shownexttab(nextclass){
            if(nextclass=="kitchen-tab"){
                this.loadQuestionList('Kitchen');  
                this.loadWashDetialsList('kitchen');
                this.change_tab(nextclass);
            } 
            else{
                if(nextclass=="foodstore-tab" ){
                    let validated=true;
                    for(let i=0;i<this.questionList.length;i++){
                        if(this.questionList[i].answer_type=="Checkbox" || this.questionList[i].answer_type=="Radio"){
                            let valid=false;
                            for(let j=0;j<this.questionList[i].ans_list.length;j++){
                                if($('#'+this.questionList[i].id+'_'+this.questionList[i].ans_list[j].id).prop('checked')){
                                    valid=true;
                                    this.questionList[i].ans_list[j].answered=$('#'+this.questionList[i].id+'_'+this.questionList[i].ans_list[j].id).val();
                                }
                                else{
                                    this.questionList[i].ans_list[j].answered='';
                                }
                            }
                            if(!valid){
                                $('#'+this.questionList[i].id+'err').html('Please answer this');
                                $('#'+this.questionList[i].id).addClass('is-invalid');
                                validated=false;
                            }
                        }
                        else if(this.questionList[i].answer_type=="Text" || this.questionList[i].answer_type=="Number" || this.questionList[i].answer_type=="TextArea" || this.questionList[i].answer_type=="Dropdown"){
                            if($('#'+this.questionList[i].id).val()==null || $('#'+this.questionList[i].id).val()==""){
                                $('#'+this.questionList[i].id+'err').html('Please answer this');
                                $('#'+this.questionList[i].id).addClass('is-invalid');
                                validated=false;
                            }
                            else{
                                this.questionList[i].answered =$('#'+this.questionList[i].id).val();
                            }
                        } 
                    }
                    if(validated){
                        this.ketchen_form.questionList=this.questionList;
                        this.ketchen_form.post('organization/structural/saveWashFeeding')
                        .then((response) => { 
                            if(response.data!=""){
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Data saved Successfully'
                                });
                                this.loadQuestionList('Food'); 
                                this.loadWashDetialsList('food');
                                this.change_tab(nextclass);
                                $("#tabcontentstable").detach().appendTo('#tabcontents_foodstore');
                            }
                        })
                        .catch((error) => {  
                            console.log("Error: "+error)
                        });
                    }
                }
                if(nextclass=="equipment-tab"){
                    let validated=true;
                    for(let i=0;i<this.foodquestionList.length;i++){
                        if(this.foodquestionList[i].answer_type=="Checkbox" || this.foodquestionList[i].answer_type=="Radio"){
                            let valid=false;
                            for(let j=0;j<this.foodquestionList[i].ans_list.length;j++){
                                if($('#'+this.foodquestionList[i].id+'_'+this.foodquestionList[i].ans_list[j].id).prop('checked')){
                                    valid=true;
                                    this.foodquestionList[i].ans_list[j].answered=$('#'+this.foodquestionList[i].id+'_'+this.foodquestionList[i].ans_list[j].id).val();
                                }
                                else{
                                    this.foodquestionList[i].ans_list[j].answered='';
                                }
                            }
                            if(!valid){
                                $('#'+this.foodquestionList[i].id+'err').html('Please answer this');
                                $('#'+this.foodquestionList[i].id).addClass('is-invalid');
                                validated=false;
                            }
                        }
                        else if(this.foodquestionList[i].answer_type=="Text" || this.foodquestionList[i].answer_type=="Number" || this.foodquestionList[i].answer_type=="TextArea" || this.foodquestionList[i].answer_type=="Dropdown"){
                            if($('#'+this.foodquestionList[i].id).val()==null || $('#'+this.foodquestionList[i].id).val()==""){
                                $('#'+this.foodquestionList[i].id+'err').html('Please answer this');
                                $('#'+this.foodquestionList[i].id).addClass('is-invalid');
                                validated=false;
                            }
                            else{
                                this.foodquestionList[i].answered =$('#'+this.foodquestionList[i].id).val();
                            }
                        } 
                    }
                    if(validated){
                        this.foodstore_form.questionList=this.foodquestionList;
                        this.foodstore_form.post('organization/structural/saveWashFeeding')
                        .then((response) => { 
                            if(response.data!=""){
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Data saved Successfully'
                                });
                                this.loadQuestionList('Equipment'); 
                                this.loadWashDetialsList('equipment');
                                this.change_tab(nextclass);
                            }
                        })
                        .catch((error) => {  
                            console.log("Error: "+error)
                        });
                    }
                    
                }
                if(nextclass=="dinning-tab"){
                    let validated=true;
                    for(let i=0;i<this.equipquestionList.length;i++){
                        if(this.equipquestionList[i].answer_type=="Checkbox" || this.equipquestionList[i].answer_type=="Radio"){
                            let valid=false;
                            for(let j=0;j<this.equipquestionList[i].ans_list.length;j++){
                                if($('#'+this.equipquestionList[i].id+'_'+this.equipquestionList[i].ans_list[j].id).prop('checked')){
                                    valid=true;
                                    this.equipquestionList[i].ans_list[j].answered=$('#'+this.equipquestionList[i].id+'_'+this.equipquestionList[i].ans_list[j].id).val();
                                }
                                else{
                                    this.equipquestionList[i].ans_list[j].answered='';
                                }
                            }
                            if(!valid){
                                $('#'+this.equipquestionList[i].id+'err').html('Please answer this');
                                $('#'+this.equipquestionList[i].id).addClass('is-invalid');
                                validated=false;
                            }
                        }
                        else if(this.equipquestionList[i].answer_type=="Text" || this.equipquestionList[i].answer_type=="Number" || this.equipquestionList[i].answer_type=="TextArea" || this.equipquestionList[i].answer_type=="Dropdown"){
                            if($('#'+this.equipquestionList[i].id).val()==null || $('#'+this.equipquestionList[i].id).val()==""){
                                $('#'+this.equipquestionList[i].id+'err').html('Please answer this');
                                $('#'+this.equipquestionList[i].id).addClass('is-invalid');
                                validated=false;
                            }
                            else{
                                this.equipquestionList[i].answered =$('#'+this.equipquestionList[i].id).val();
                            }
                        } 
                    }
                    if(validated){
                        this.equipment_form.questionList=this.equipquestionList;
                        this.equipment_form.post('organization/structural/saveWashFeeding')
                        .then((response) => { 
                            if(response.data!=""){
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Data saved Successfully'
                                });
                                this.loadQuestionList('Dinning'); 
                                this.loadWashDetialsList('dinning');
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
                    for(let i=0;i<this.dinningquestionList.length;i++){
                        if(this.dinningquestionList[i].answer_type=="Checkbox" || this.dinningquestionList[i].answer_type=="Radio"){
                            let valid=false;
                            for(let j=0;j<this.dinningquestionList[i].ans_list.length;j++){
                                if($('#'+this.dinningquestionList[i].id+'_'+this.dinningquestionList[i].ans_list[j].id).prop('checked')){
                                    valid=true;
                                    this.dinningquestionList[i].ans_list[j].answered=$('#'+this.dinningquestionList[i].id+'_'+this.dinningquestionList[i].ans_list[j].id).val();
                                }
                                else{
                                    this.dinningquestionList[i].ans_list[j].answered='';
                                }
                            }
                            if(!valid){
                                $('#'+this.dinningquestionList[i].id+'err').html('Please answer this');
                                $('#'+this.dinningquestionList[i].id).addClass('is-invalid');
                                validated=false;
                            }
                        }
                        else if(this.dinningquestionList[i].answer_type=="Text" || this.dinningquestionList[i].answer_type=="Number" || this.dinningquestionList[i].answer_type=="TextArea" || this.dinningquestionList[i].answer_type=="Dropdown"){
                            if($('#'+this.dinningquestionList[i].id).val()==null || $('#'+this.dinningquestionList[i].id).val()==""){
                                $('#'+this.dinningquestionList[i].id+'err').html('Please answer this');
                                $('#'+this.dinningquestionList[i].id).addClass('is-invalid');
                                validated=false;
                            }
                            else{
                                this.dinningquestionList[i].answered =$('#'+this.dinningquestionList[i].id).val();
                            }
                        } 
                    }
                    if(validated){
                        Swal.fire({
                            text: "Are you sure you wish to save this details ?",
                            icon: 'info',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes!',
                            }).then((result) => {
                            if (result.isConfirmed) {
                                this.dinning_form.questionList=this.dinningquestionList;
                                this.dinning_form.post('organization/structural/saveWashFeeding')
                                .then((response) => { 
                                    if(response.data!=""){
                                        Toast.fire({
                                            icon: 'success',
                                            title: 'Data saved Successfully'
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
            }
        },
        change_tab(nextclass){
            $('#kitchen-tab-table').hide();
            $('#foodstore-tab-table').hide();
            $('#equipment-tab-table').hide();
            $('#dinning-tab-table').hide();

            $('#tabhead >li >a').removeClass('active');
            $('#tabhead >li >a >span').addClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').addClass('active');
            $('.'+nextclass+' >a >span').removeClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').removeClass('disabled');
            $('.tab-content-details').hide();
            $('#'+nextclass).show().removeClass('fade');
            $('#'+nextclass+'-table').show();
        },
        loadQuestionList(param){
            this.questionList=[];
            axios.get('questionAnswers/loadQuestionaries/withwhere_'+param+'_Question')
            .then(response => {
                let data = response.data.data;
                if(param=="Kitchen"){
                    this.questionList =  data;
                }
                if(param=="Food"){
                    this.foodquestionList =  data;
                }
                if(param=="Equipment"){
                    this.equipquestionList =  data;
                }
                if(param=="Dinning"){
                    this.dinningquestionList =  data;
                }
                
            }) 
            .catch(function (error){
                console.log(error.toString());
            });
        },
        loadWashDetialsList(param){
            this.ketchen_form.questionList=[];
            let uri = 'organization/structural/getWashFeeding/'+param;
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
        // this.getScreenAccess();
        this.loadQuestionList('Kitchen');  
        this.loadWashDetialsList('kitchen');
    },
}
</script>