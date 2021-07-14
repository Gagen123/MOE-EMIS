<template>
    <div>
        <form>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 overflow-auto">
                    <table id="food-table" class="table table-bordered text-sm table-striped">
                        <thead>
                            <tr class="text-center bg-gradient-green">
                                <th colspan="15" class="pt-1 pb-1"> SCHOOL FEEDING PROGRAMME, DAILY DIETARY DIVERSITY CHART</th>
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
                        <tbody id="tbody">
                            <tr>
                                <td rowspan="4" class="pt-5 ">
                                    <!-- <input type="date" class="form-control" v-model="form.record_date" name="record_date"/> -->
                                    <input type="date" @change="checkdata('record_data')" id="record_data" class="form-control" v-model="form.record_date" name="record_date"/>
                                    <span id="esist_message" class="text-danger"></span>
                                </td>
                                <td>
                                    Breakfast
                                </td>
                                <td>
                                    <input type="checkbox" name="breakfast" id="cereal1" v-model="form.b_cereal" class="form-control-range" @click="calculatescore('cereal')">
                                </td>
                                <td>
                                    <input type="checkbox" name="breakfast" id="cereal2" v-model="form.b_root" class="form-control-range" @click="calculatescore('cereal')">
                                </td>
                                <td>
                                    <input type="checkbox" name="breakfast" id="veg1" v-model="form.b_veg" class="form-control-range" @click="calculatescore('veg')">
                                </td>
                                <td>
                                    <input type="checkbox" name="breakfast" id="meat1" v-model="form.b_meat" class="form-control-range" @click="calculatescore('meat')">
                                </td>
                                <td>
                                    <input type="checkbox" name="breakfast" id="meat2" v-model="form.b_egg" class="form-control-range" @click="calculatescore('meat')">
                                </td>
                                <td>
                                    <input type="checkbox" name="breakfast" id="meat3" v-model="form.b_fish" class="form-control-range" @click="calculatescore('meat')">
                                </td>
                                <td>
                                    <input type="checkbox" name="breakfast" id="pulse1" v-model="form.b_pulse" class="form-control-range" @click="calculatescore('pulse')">
                                </td>
                                 <td>
                                    <input type="checkbox" name="breakfast" id="milk1" v-model="form.b_milk" class="form-control-range" @click="calculatescore('milk')">
                                </td>
                                 <td>
                                    <input type="checkbox" name="breakfast" id="fruit1" v-model="form.b_fruit" class="form-control-range" @click="calculatescore('fruit')">
                                </td>
                                 <td>
                                    <input type="checkbox" name="breakfast" id="oil1" v-model="form.b_oil" class="form-control-range" @click="calculatescore('oil')">
                                </td>
                                 <td>
                                    <input type="checkbox" name="breakfast" v-model="form.b_sugar" class="form-control-range" @click="calculatescore('sugar')">
                                </td>
                                <td>
                                    <input type="checkbox" name="breakfast" v-model="form.b_chilli" class="form-control-range" @click="calculatescore('chilli')">
                                </td>
                                <td rowspan="4" class="text-center pt-5 text-bold">
                                    <span>{{form.total_score}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Lunch
                                </td>
                                <td>
                                    <input type="checkbox" name="lunch"  id="cereal3" v-model="form.l_cereal" class="form-control-range" @click="calculatescore('cereal')">
                                </td>
                                <td>
                                    <input type="checkbox" name="lunch" id="cereal4" v-model="form.l_root" class="form-control-range" @click="calculatescore('cereal')">
                                </td>
                                <td>
                                    <input type="checkbox" name="lunch" id="veg2" v-model="form.l_veg" class="form-control-range" @click="calculatescore('veg')">
                                </td>
                                <td>
                                    <input type="checkbox" name="lunch" id="meat4" v-model="form.l_meat" class="form-control-range" @click="calculatescore('meat')">
                                </td>
                                <td>
                                    <input type="checkbox" name="lunch" id="meat5" v-model="form.l_egg" class="form-control-range" @click="calculatescore('meat')">
                                </td>
                                <td>
                                    <input type="checkbox" name="lunch" id="meat6" v-model="form.l_fish" class="form-control-range" @click="calculatescore('meat')">
                                </td>
                                <td>
                                    <input type="checkbox" name="lunch" id="pulse2" v-model="form.l_pulse" class="form-control-range" @click="calculatescore('pulse')">
                                </td>
                                 <td>
                                    <input type="checkbox" name="lunch" id="milk2" v-model="form.l_milk" class="form-control-range" @click="calculatescore('milk')">
                                </td>
                                 <td>
                                    <input type="checkbox" name="lunch" id="fruit2" v-model="form.l_fruit" class="form-control-range" @click="calculatescore('fruit')">
                                </td>
                                 <td>
                                    <input type="checkbox" name="lunch" id="oil2" v-model="form.l_oil" class="form-control-range" @click="calculatescore('oil')">
                                </td>
                                <td>
                                    <input type="checkbox" name="lunch" v-model="form.l_sugar" class="form-control-range" @click="calculatescore('sugar')">
                                </td>
                                <td>
                                    <input type="checkbox" name="lunch" v-model="form.l_chilli" class="form-control-range" @click="calculatescore('tea')">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tea
                                </td>
                                <td>
                                    <input type="checkbox" name="tea" id="cereal5" v-model="form.t_cereal" class="form-control-range" @click="calculatescore('cereal')">
                                </td>
                                <td>
                                    <input type="checkbox" name="tea" id="cereal6" v-model="form.t_root" class="form-control-range" @click="calculatescore('cereal')">
                                </td>
                                <td>
                                    <input type="checkbox" name="tea" id="veg3" v-model="form.t_veg" class="form-control-range" @click="calculatescore('veg')">
                                </td>
                                <td>
                                    <input type="checkbox" name="tea" id="meat7" v-model="form.t_meat" class="form-control-range" @click="calculatescore('meat')">
                                </td>
                                <td>
                                    <input type="checkbox" name="tea" id="meat8" v-model="form.t_egg" class="form-control-range" @click="calculatescore('meat')">
                                </td>
                                <td>
                                    <input type="checkbox" name="tea" id="meat9" v-model="form.t_fish" class="form-control-range" @click="calculatescore('meat')">
                                </td>
                                <td>
                                    <input type="checkbox" name="tea" id="pulse3" v-model="form.t_pulse" class="form-control-range" @click="calculatescore('pulse')">
                                </td>
                                 <td>
                                    <input type="checkbox" name="tea" id="milk3" v-model="form.t_milk" class="form-control-range" @click="calculatescore('milk')">
                                </td>
                                 <td>
                                    <input type="checkbox" name="tea" id="fruit3" v-model="form.t_fruit" class="form-control-range" @click="calculatescore('fruit')">
                                </td>
                                 <td>
                                    <input type="checkbox" name="tea" id="oil3" v-model="form.t_oil" class="form-control-range" @click="calculatescore('oil')">
                                </td>
                                 <td>
                                    <input type="checkbox" name="tea" v-model="form.t_sugar" class="form-control-range" @click="calculatescore('sugar')">
                                </td>
                                <td>
                                    <input type="checkbox" name="tea" v-model="form.t_chilli" class="form-control-range" @click="calculatescore('chilli')">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Dinner
                                </td>
                                <td>
                                    <input type="checkbox" name="dinner" id="cereal7" v-model="form.d_cereal" class="form-control-range" @click="calculatescore('cereal')">
                                </td>
                                <td>
                                    <input type="checkbox" name="dinner" id="cereal8" v-model="form.d_root" class="form-control-range" @click="calculatescore('cereal')">
                                </td>
                                <td>
                                    <input type="checkbox" name="dinner" id="veg4" v-model="form.d_veg" class="form-control-range" @click="calculatescore('veg')">
                                </td>
                                <td>
                                    <input type="checkbox" name="dinner" id="meat10" v-model="form.d_meat" class="form-control-range" @click="calculatescore('meat')">
                                </td>
                                <td>
                                    <input type="checkbox" name="dinner" id="meat11" v-model="form.d_egg" class="form-control-range" @click="calculatescore('meat')">
                                </td>
                                <td>
                                    <input type="checkbox" name="dinner" id="meat12" v-model="form.d_fish" class="form-control-range" @click="calculatescore('meat')">
                                </td>
                                <td>
                                    <input type="checkbox" name="dinner" id="pulse4" v-model="form.d_pulse" class="form-control-range" @click="calculatescore('pulse')">
                                </td>
                                 <td>
                                    <input type="checkbox" name="dinner" id="milk4" v-model="form.d_milk" class="form-control-range" @click="calculatescore('milk')">
                                </td>
                                 <td>
                                    <input type="checkbox" name="dinner" id="fruit4" v-model="form.d_fruit" class="form-control-range" @click="calculatescore('fruit')">
                                </td>
                                 <td>
                                    <input type="checkbox" name="dinner" id="oil4" v-model="form.d_oil" class="form-control-range" @click="calculatescore('oil')">
                                </td>
                                 <td>
                                    <input type="checkbox" name="dinner" v-model="form.d_sugar" class="form-control-range" @click="calculatescore('sugar')">
                                </td>
                                <td>
                                    <input type="checkbox" name="dinner" v-model="form.d_chilli" class="form-control-range" @click="calculatescore('chilli')">
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
                action_type:'edit',
                id:'',
                total_score:0,
                record_date:'',
                b_cereal:'',
                b_root:'',
                b_veg:'',
                b_meat:'',
                b_egg:'',
                b_fish:'',
                b_pulse:'',
                b_milk:'',
                b_fruit:'',
                b_oil:'',
                b_sugar:'',
                b_chilli:'',
                l_cereal:'',
                l_root:'',
                l_veg:'',
                l_meat:'',
                l_egg:'',
                l_fish:'',
                l_pulse:'',
                l_milk:'',
                l_fruit:'',
                l_oil:'',
                l_sugar:'',
                l_chilli:'',
                t_cereal:'',
                t_root:'',
                t_veg:'',
                t_meat:'',
                t_egg:'',
                t_fish:'',
                t_pulse:'',
                t_milk:'',
                t_fruit:'',
                t_oil:'',
                t_sugar:'',
                t_chilli:'',
                d_cereal:'',
                d_root:'',
                d_veg:'',
                d_meat:'',
                d_egg:'',
                d_fish:'',
                d_pulse:'',
                d_milk:'',
                d_fruit:'',
                d_oil:'',
                d_sugar:'',
                d_chilli:'',
                remarks:'',
            }),
        }
    },
    methods: {
        calculatescore(type){
            if(type!="sugar" && type!="chilli"){
                if(type=="cereal"){
                    let cereal=0;
                    for(let i=1;i<9;i++){
                        if($('#'+type+i).prop('checked')){
                            cereal=1;
                        }
                    }
                    this.cereal=cereal;
                }
                if(type=="veg"){
                    let veg=0;
                    for(let i=1;i<5;i++){
                        if($('#'+type+i).prop('checked')){
                            veg=1;
                        }
                    }
                    this.veg=veg;
                }
                if(type=="pulse"){
                    let pulse=0;
                    for(let i=1;i<5;i++){
                        if($('#'+type+i).prop('checked')){
                            pulse=1;
                        }
                    }
                    this.pulse=pulse;
                }
                if(type=="milk"){
                    let milk=0;
                    for(let i=1;i<5;i++){
                        if($('#'+type+i).prop('checked')){
                            milk=1;
                        }
                    }
                    this.milk=milk;
                }
                if(type=="fruit"){
                    let fruit=0;
                    for(let i=1;i<5;i++){
                        if($('#'+type+i).prop('checked')){
                            fruit=1;
                        }
                    }
                    this.fruit=fruit;
                }
                if(type=="oil"){
                    let oil=0;
                    for(let i=1;i<5;i++){
                        if($('#'+type+i).prop('checked')){
                            oil=1;
                        }
                    }
                    this.oil=oil;
                }
                if(type=="meat"){
                    let meat=0;
                    for(let i=1;i<13;i++){
                        if($('#'+type+i).prop('checked')){
                            meat=1;
                        }
                    }
                    this.meat=meat;
                }
                this.form.total_score=this.cereal+this.veg+this.meat+this.pulse+this.milk+this.fruit+this.oil;
            }
        },
        formaction(action){
            if(action=="save"){
                this.form.post('/diatery/savediatery')
                .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details has been updated successfully'
                    });
                    this.$router.push('/dietary_records_list');
                })
                .catch((error) => {
                    console.log("Error:"+error)
                })
            }
        },
        loadDietaryDetails(id){
            let uri="diatery/getdiateryDetails/"+id;
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.form.date=data.date;
                this.form.id=data.id;
                this.form.total_score=data.score;
                this.form.remarks=data.remarks;
                this.form.b_cereal=data.details.b_cereal;
                this.form.b_chilli=data.details.b_chilli;
                this.form.b_egg=data.details.b_egg;
                this.form.b_fish=data.details.b_fish;
                this.form.b_fruit=data.details.b_fruit;
                this.form.b_meat=data.details.b_meat;
                this.form.b_milk=data.details.b_milk;
                this.form.b_oil=data.details.b_oil;
                this.form.b_pulse=data.details.b_pulse;
                this.form.b_root=data.details.b_root;
                this.form.b_sugar=data.details.b_sugar;
                this.form.b_veg=data.details.b_veg;

                this.form.l_cereal=data.details.l_cereal;
                this.form.l_chilli=data.details.l_chilli;
                this.form.l_egg=data.details.l_egg;
                this.form.l_fish=data.details.l_fish;
                this.form.l_fruit=data.details.l_fruit;
                this.form.l_meat=data.details.l_meat;
                this.form.l_milk=data.details.l_milk;
                this.form.l_oil=data.details.l_oil;
                this.form.l_pulse=data.details.l_pulse;
                this.form.l_root=data.details.l_root;
                this.form.l_sugar=data.details.l_sugar;
                this.form.l_veg=data.details.l_veg;

                this.form.t_cereal=data.details.t_cereal;
                this.form.t_chilli=data.details.t_chilli;
                this.form.t_egg=data.details.t_egg;
                this.form.t_fish=data.details.t_fish;
                this.form.t_fruit=data.details.t_fruit;
                this.form.t_meat=data.details.t_meat;
                this.form.t_milk=data.details.t_milk;
                this.form.t_oil=data.details.t_oil;
                this.form.t_pulse=data.details.t_pulse;
                this.form.t_root=data.details.t_root;
                this.form.t_sugar=data.details.t_sugar;
                this.form.t_veg=data.details.t_veg;

                this.form.d_cereal=data.details.d_cereal;
                this.form.d_chilli=data.details.d_chilli;
                this.form.d_egg=data.details.d_egg;
                this.form.d_fish=data.details.d_fish;
                this.form.d_fruit=data.details.d_fruit;
                this.form.d_meat=data.details.d_meat;
                this.form.d_milk=data.details.d_milk;
                this.form.d_oil=data.details.d_oil;
                this.form.d_pulse=data.details.d_pulse;
                this.form.d_root=data.details.d_root;
                this.form.d_sugar=data.details.d_sugar;
                this.form.d_veg=data.details.d_veg;
                if(data.details.d_cereal==1 || data.details.t_cereal==1 || data.details.l_cereal==1 || data.details.b_cereal==1 ||
                data.details.d_root==1 || data.details.t_root==1 || data.details.l_root==1 || data.details.b_root==1){
                    this.cereal=1;
                }
                if(data.details.d_veg==1 || data.details.t_veg==1 || data.details.l_veg==1 || data.details.b_veg==1){
                    this.veg=1;
                }
                if(data.details.d_meat==1 || data.details.t_meat==1 || data.details.l_meat==1 || data.details.b_meat==1 ||
                data.details.d_egg==1 || data.details.t_egg==1 || data.details.l_egg==1 || data.details.b_eggt==1 ||
                data.details.d_fish==1 || data.details.t_fish==1 || data.details.l_fish==1 || data.details.b_fish==1){
                    this.meat=1;
                }
                if(data.details.d_pulse==1 || data.details.t_pulse==1 || data.details.l_pulse==1 || data.details.b_pulse==1){
                    this.pulse=1;
                }
                if(data.details.d_milk==1 || data.details.t_milk==1 || data.details.l_milk==1 || data.details.b_milk==1){
                    this.milk=1;
                }
                if(data.details.d_fruit==1 || data.details.t_fruit==1 || data.details.l_fruit==1 || data.details.b_fruit==1){
                    this.fruit=1;
                }
                if(data.details.d_oil==1 || data.details.t_oil==1 || data.details.l_oil==1 || data.details.b_oil==1){
                    this.oil=1;
                }
            })
            .catch(function (error) {
                console.log("Error:"+error)
            });
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
    },
    mounted() {
        let currentdate = new Date();
        let month=currentdate.getMonth()+1;
        if(month.toString().length==1){
            month='0'+month;
        }
        let curr_date=currentdate.getFullYear()+'-'+month+'-'+currentdate.getDate();
        this.form.record_date=curr_date;
        this.loadDietaryDetails(this.$route.query.id);

    },
}
</script>
