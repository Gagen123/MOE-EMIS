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
            questionList:[],
            ketchen_form: new form({
            }),
            foodstore_form: new form({
                
            }),
            equipment_form: new form({
              
            }),
            dinning_form: new form({
                
            }),
        }
    },

    methods: {
        shownexttab(nextclass){ 
        },
        loadQuestionList(param){
            axios.get('questionAnswers/loadQuestionaries/withwhere_'+param+'_Question')
            .then(response => {
                let data = response.data.data;
                this.questionList =  data;
            }) 
            .catch(function (error){
                console.log(error.toString());
            });
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
    mounted(){
        this.loadQuestionList('Kitchen');  
    },
}
</script>