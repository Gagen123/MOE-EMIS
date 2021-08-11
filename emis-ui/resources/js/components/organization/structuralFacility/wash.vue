<template>
    <div>
        <div class="callout callout-danger" style="display:none" id="screenPermission">
            <h5 class="bg-gradient-danger">Sorry!</h5>
            <div id="existmessage"></div>
        </div>
        <div class="card card-primary card-outline card-outline-tabs" id="mainform">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead" role="tablist">
                    <li class="nav-item wash-tabs" @click="shownexttab('wash-tabs')">
                        <a class="nav-link active" data-toggle="pill" role="tab">
                            <label> Water </label>
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
                                    <th style="width:60%">Description</th>
                                    <th style="width:40%">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in wash_form.questionList" :key="index">
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
                                <button class="btn btn-primary" @click="shownexttab('sanitation-tab')">Save & Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade tab-content-details" id="sanitation-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <table id="dynamic-table1" class="table w-100  table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width:60%">Description</th>
                                    <th style="width:40%">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in sanitation_form.questionList" :key="index">
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
                                                <input type="checkbox" :name="'wash_check'+index" v-model="ans.answered" :id="item.id+'_'+ans.id" @change="remove_err(item.id+'_'+ans.id)" class="ml-4" :value="ans.id">
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
                                <button class="btn btn-success" @click="shownexttab('wash-tabs')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-primary" @click="shownexttab('hygience-tab')"> <i class="fa fa-arrow-right"></i>Next </button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade tab-content-details" id="hygience-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <table id="dynamic-table2" class="table w-100  table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width:60%">Description</th>
                                    <th style="width:40%">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in hygiene_form.questionList" :key="index">
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
                                                <input type="checkbox" :name="'wash_check'+index" v-model="ans.answered" :id="item.id+'_'+ans.id" @change="remove_err(item.id+'_'+ans.id)" class="ml-4" :value="ans.id">
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
            }),
            sanitation_form: new form({
                type:'sanitation',
                questionList:[],
            }),
            hygiene_form: new form({
                type:'hygiene',
                questionList:[],
            })
        }
    },

    methods:{
        shownexttab(nextclass){
            if(nextclass=="sanitation-tab"){
                let validated=true;
                for(let i=0;i<this.wash_form.questionList.length;i++){
                    if(this.wash_form.questionList[i].answer_type=="Checkbox" || this.wash_form.questionList[i].answer_type=="Radio"){
                        let valid=false;
                        for(let j=0;j<this.wash_form.questionList[i].ans_list.length;j++){
                            if($('#'+this.wash_form.questionList[i].id+'_'+this.wash_form.questionList[i].ans_list[j].id).prop('checked')){
                                valid=true;
                                // alert($('#'+this.wash_form.questionList[i].id+'_'+this.wash_form.questionList[i].ans_list[j].id).val());
                                this.wash_form.questionList[i].ans_list[j].answered=$('#'+this.wash_form.questionList[i].id+'_'+this.wash_form.questionList[i].ans_list[j].id).val();
                            }
                            else{
                                this.wash_form.questionList[i].ans_list[j].answered='';
                            }
                        }
                        if(!valid){
                            $('#'+this.wash_form.questionList[i].id+'err').html('Please answer this');
                            $('#'+this.wash_form.questionList[i].id).addClass('is-invalid');
                            validated=false;
                        }
                    }
                    else if(this.wash_form.questionList[i].answer_type=="Text" || this.wash_form.questionList[i].answer_type=="Number" || this.wash_form.questionList[i].answer_type=="TextArea" || this.wash_form.questionList[i].answer_type=="Dropdown"){
                        if($('#'+this.wash_form.questionList[i].id).val()==null || $('#'+this.wash_form.questionList[i].id).val()==""){
                            $('#'+this.wash_form.questionList[i].id+'err').html('Please answer this');
                            $('#'+this.wash_form.questionList[i].id).addClass('is-invalid');
                            validated=false;
                        }
                        else{
                            this.wash_form.questionList[i].answered =$('#'+this.wash_form.questionList[i].id).val();
                        }
                    }
                }
                if(validated==true){
                    this.wash_form.post('organization/structural/saveWashFeeding')
                    .then((response) => {
                        if(response.data!=""){
                            Toast.fire({
                                icon: 'success',
                                title: 'Data saved Successfully'
                            });
                            this.loadWashDetialsList('sanitation');
                            this.change_tab(nextclass);
                        }
                    })
                    .catch((error) => {
                        console.log("Error: "+error)
                    });
                }
            }

            if(nextclass=="hygience-tab"){
                let validated=true;
                for(let i=0;i<this.sanitation_form.questionList.length;i++){
                    if(this.sanitation_form.questionList[i].answer_type=="Checkbox" || this.sanitation_form.questionList[i].answer_type=="Radio"){
                        let valid=false;
                        for(let j=0;j<this.sanitation_form.questionList[i].ans_list.length;j++){
                            if($('#'+this.sanitation_form.questionList[i].id+'_'+this.sanitation_form.questionList[i].ans_list[j].id).prop('checked')){
                                valid=true;
                                // alert($('#'+this.sanitation_form.questionList[i].id+'_'+this.sanitation_form.questionList[i].ans_list[j].id).val());
                                this.sanitation_form.questionList[i].ans_list[j].answered=$('#'+this.sanitation_form.questionList[i].id+'_'+this.sanitation_form.questionList[i].ans_list[j].id).val();
                            }
                            else{
                                this.sanitation_form.questionList[i].ans_list[j].answered='';
                            }
                        }
                        if(!valid){
                            $('#'+this.sanitation_form.questionList[i].id+'err').html('Please answer this');
                            $('#'+this.sanitation_form.questionList[i].id).addClass('is-invalid');
                            validated=false;
                        }
                    }
                    else if(this.sanitation_form.questionList[i].answer_type=="Text" || this.sanitation_form.questionList[i].answer_type=="Number" || this.sanitation_form.questionList[i].answer_type=="TextArea" || this.sanitation_form.questionList[i].answer_type=="Dropdown"){
                        if($('#'+this.sanitation_form.questionList[i].id).val()==null || $('#'+this.sanitation_form.questionList[i].id).val()==""){
                            $('#'+this.sanitation_form.questionList[i].id+'err').html('Please answer this');
                            $('#'+this.sanitation_form.questionList[i].id).addClass('is-invalid');
                            validated=false;
                        }
                        else{
                            this.sanitation_form.questionList[i].answered =$('#'+this.sanitation_form.questionList[i].id).val();
                        }
                    }
                }
                if(validated==true){
                    this.sanitation_form.post('organization/structural/saveWashFeeding')
                    .then((response) => {
                        if(response.data!=""){
                            Toast.fire({
                                icon: 'success',
                                title: 'Data saved Successfully'
                            });
                            this.loadWashDetialsList('hygiene');
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
                for(let i=0;i<this.hygiene_form.questionList.length;i++){
                    if(this.hygiene_form.questionList[i].answer_type=="Checkbox" || this.hygiene_form.questionList[i].answer_type=="Radio"){
                        let valid=false;
                        for(let j=0;j<this.hygiene_form.questionList[i].ans_list.length;j++){
                            if($('#'+this.hygiene_form.questionList[i].id+'_'+this.hygiene_form.questionList[i].ans_list[j].id).prop('checked')){
                                valid=true;
                                // alert($('#'+this.hygiene_form.questionList[i].id+'_'+this.hygiene_form.questionList[i].ans_list[j].id).val());
                                this.hygiene_form.questionList[i].ans_list[j].answered=$('#'+this.hygiene_form.questionList[i].id+'_'+this.hygiene_form.questionList[i].ans_list[j].id).val();
                            }
                            else{
                                this.hygiene_form.questionList[i].ans_list[j].answered='';
                            }
                        }
                        if(!valid){
                            $('#'+this.hygiene_form.questionList[i].id+'err').html('Please answer this');
                            $('#'+this.hygiene_form.questionList[i].id).addClass('is-invalid');
                            validated=false;
                        }
                    }
                    else if(this.hygiene_form.questionList[i].answer_type=="Text" || this.hygiene_form.questionList[i].answer_type=="Number" || this.hygiene_form.questionList[i].answer_type=="TextArea" || this.hygiene_form.questionList[i].answer_type=="Dropdown"){
                        if($('#'+this.hygiene_form.questionList[i].id).val()==null || $('#'+this.hygiene_form.questionList[i].id).val()==""){
                            $('#'+this.hygiene_form.questionList[i].id+'err').html('Please answer this');
                            $('#'+this.hygiene_form.questionList[i].id).addClass('is-invalid');
                            validated=false;
                        }
                        else{
                            this.hygiene_form.questionList[i].answered =$('#'+this.hygiene_form.questionList[i].id).val();
                        }
                    }
                }
                if(validated==true){
                    Swal.fire({
                        text: "Are you sure you wish to save this details ?",
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes!',
                        }).then((result) => {
                        if (result.isConfirmed) {
                            this.hygiene_form.post('organization/structural/saveWashFeeding')
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
            if(nextclass=="wash-tabs"){
               this.loadWashDetialsList('wash');
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
                if(param=="Wash"){
                    this.wash_form.questionList =  data;
                }
                if(param=="Sanitation"){
                    this.sanitation_form.questionList =  data;
                }
                if(param=="Hygiene"){
                    this.hygiene_form.questionList =  data;
                }
            })
            .catch(function (error){
                console.log(error.toString());
            });
        },
        loadWashDetialsList(param){
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
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        // this.getScreenAccess();
        this.loadQuestionList('Wash');
        this.loadQuestionList('Sanitation');
        this.loadQuestionList('Hygiene');

        this.loadWashDetialsList('wash');
        //this.loadWashDetialsList('sanitation');




    },
}
</script>
