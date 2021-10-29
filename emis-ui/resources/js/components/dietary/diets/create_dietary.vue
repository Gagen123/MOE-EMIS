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
                                <th colspan="14" class="pt-1 pb-1"> SCHOOL FEEDING PROGRAMME, DAILY DIETARY DIVERSITY CHART</th>
                            </tr>
                            <tr class="text-center bg-gradient-green">
                                <th colspan="14" class="pt-0 pb-0"> Food Group</th>
                            </tr>
                            <tr class="bg-gradient-warning">
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
                        <tbody id="tbody">
                            <tr v-for='(itm, index) in form.items1' :key="index">
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
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0">Date: </label>
                    <input type="text" autocomplete="off" @change="checkdata('record_data')" class="form-control popupDatepicker" id="record_date1" name="record_date1"/>
                    <span id="esist_message" class="text-danger"></span>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="mb-0">Remarks if any</label>
                    <textarea class="form-control" v-model="form.remarks" id="remarks"></textarea>
                    <span class="text-danger" id="remarks_err"></span>
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
            cereal:0,
            veg:0,
            meat:0,
            pulse:0,
            milk:0,
            fruit:0,
            oil:0,
            form: new form({
                action_type:'add',
                id:'',
                total_score1:0,
                record_date1:'',
                remarks:'',
                items1:
                [
                    { meal:'Breakfast',cereal:0,root:0,veg:0,meat:0,egg:0,fish:0,pulse:0,milk:0,fruit:0,oil:0,sugar:0,chilli:0,},
                    { meal:'Lunch',cereal:0,root:0,veg:0,meat:0,egg:0,fish:0,pulse:0,milk:0,fruit:0,oil:0,sugar:0,chilli:0,},
                    { meal:'Tea',cereal:0,root:0,veg:0,meat:0,egg:0,fish:0,pulse:0,milk:0,fruit:0,oil:0,sugar:0,chilli:0,},
                    { meal:'Dinner',cereal:0,root:0,veg:0,meat:0,egg:0,fish:0,pulse:0,milk:0,fruit:0,oil:0,sugar:0,chilli:0,}
                ],

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
        formaction(action){
            if(action=="save"){
                this.form.record_date1=this.formatYYYYMMDD($('#record_date1').val());
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
        },
    },
    mounted() {
        let currentdate = new Date();
        let month=currentdate.getMonth()+1;
        if(month.toString().length==1){
            month='0'+month;
        }
        let curr_date=currentdate.getFullYear()+'-'+month+'-'+currentdate.getDate();
        this.form.record_date1=curr_date;
        this.checkdata(curr_date);
    },
}
</script>
