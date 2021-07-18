<template>
    <div>
        <form>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 overflow-auto">
                    <table id="food-table" class="table table-bordered text-sm table-striped">
                        <thead>
                            <tr class="text-center bg-gradient-green">
                                <th colspan="14" class="pt-1 pb-1"> SCHOOL FEEDING PROGRAMME, WEEKLY DIETARY DIVERSITY CHART</th>
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
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <template v-for="(itm, record_date) in dates">
                                <tr :key="record_date" class="text-left">
                                    <td colspan="14" class="pt-1 pb-0 bg-cyan">
                                        <span>Date: {{ itm.record_date }}, <b>Total Score: {{itm.total_score}}</b></span>
                                    </td>
                                </tr>
                                <tr v-for="(det, count) in itm.details" :key="count">
                                    <td>{{det.meal_type}}</td>
                                    <td>
                                        <span v-if="det.cereal ==1">
                                            <span class='fa fa-check'></span>
                                        </span>
                                        <span v-else>
                                            <span class='fa fa-times text-danger'></span>
                                        </span>
                                    <td>
                                        <span v-if="det.root ==1">
                                            <span class='fa fa-check'></span>
                                        </span>
                                        <span v-else>
                                            <span class='fa fa-times text-danger'></span>
                                        </span>
                                    </td>
                                    <td>
                                        <span v-if="det.veg ==1">
                                            <span class='fa fa-check'></span>
                                        </span>
                                        <span v-else>
                                            <span class='fa fa-times text-danger'></span>
                                        </span>
                                    </td>
                                    <td>
                                        <span v-if="det.meat ==1">
                                            <span class='fa fa-check'></span>
                                        </span>
                                        <span v-else>
                                            <span class='fa fa-times text-danger'></span>
                                        </span>
                                    </td>
                                    <td>
                                        <span v-if="det.egg ==1">
                                            <span class='fa fa-check'></span>
                                        </span>
                                        <span v-else>
                                            <span class='fa fa-times text-danger'></span>
                                        </span>
                                    </td>
                                    <td>
                                        <span v-if="det.fish ==1">
                                            <span class='fa fa-check'></span>
                                        </span>
                                        <span v-else>
                                            <span class='fa fa-times text-danger'></span>
                                        </span>
                                    </td>
                                    <td>
                                        <span v-if="det.pulse ==1">
                                            <span class='fa fa-check'></span>
                                        </span>
                                        <span v-else>
                                            <span class='fa fa-times text-danger'></span>
                                        </span>
                                    </td>
                                    <td>
                                        <span v-if="det.milk ==1">
                                            <span class='fa fa-check'></span>
                                        </span>
                                        <span v-else>
                                            <span class='fa fa-times text-danger'></span>
                                        </span>
                                    </td>
                                    <td>
                                        <span v-if="det.fruit ==1">
                                            <span class='fa fa-check'></span>
                                        </span>
                                        <span v-else>
                                            <span class='fa fa-times text-danger'></span>
                                        </span>
                                    </td>
                                    <td>
                                        <span v-if="det.oil ==1">
                                            <span class='fa fa-check'></span>
                                        </span>
                                        <span v-else>
                                            <span class='fa fa-times text-danger'></span>
                                        </span>
                                    </td>
                                    <td>
                                        <span v-if="det.sugar ==1">
                                            <span class='fa fa-check'></span>
                                        </span>
                                        <span v-else>
                                            <span class='fa fa-times text-danger'></span>
                                        </span>
                                    </td>
                                    <td>
                                        <span v-if="det.chilli ==1">
                                            <span class='fa fa-check'></span>
                                        </span>
                                        <span v-else>
                                            <span class='fa fa-times text-danger'></span>
                                        </span>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                        <tr>
                            <td colspan="12" class="text-right text-bold averate_score_bg">
                                <span id="average_text">
                                    Average Total Score
                                </span>
                            </td>
                            <td class="text-bold">
                                <span>{{basic_detials.average_score}}</span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row form-group" v-if="basic_detials.remarks!=''">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="mb-0">Remarks from Incharge</label>
                    <span>{{basic_detials.remarks}}</span>
                </div>
            </div>
            <div class="row form-group" v-if="action_type=='verify' && basic_detials.status=='Submitted'">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="mb-0">Remarks if any</label>
                    <textarea class="form-control" v-model="form.remarks" id="veriremarks"></textarea>
                    <span class="text-danger" id="remarks_err"></span>
                </div>
            </div>
            <div class="row form-group" v-else>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="mb-0">Verification / approval Reamrks:</label>
                    <span>{{basic_detials.approve_reject_remarks}}</span>
                </div>
            </div>

            <div class="card-footer text-right" v-if="action_type=='verify' && basic_detials.status=='Submitted'" >
                <button type="button" @click="formaction('approve')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-check"></i> Approve</button>
                <button type="button" @click="formaction('reject')" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-times"></i> Reject</button>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    data(){
        return {
            action_type:'',
            basic_detials:[],
            dates:[],
            form: new form({
                id:'',
                action:'',
                remarks:'',
            }),
        }
    },
    methods: {
        loadDietaryDetails(id){
            let uri="diatery/getdiateryDetails/"+id;
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.form.id=data.id;
                this.basic_detials=data;
                this.dates=data.dates;
            })
            .catch(function (error) {
                console.log("Error:"+error)
            });
        },
        formaction(action){
            let submit=true;
            if(action=="reject" && $('#veriremarks').val()==""){
                $('#remarks_err').html('Please mention reason for rejecting this application');
                submit=false;
            }
            if(submit){
                Swal.fire({
                    text: "Are you sure you wish to "+action+" this details ?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        this.form.action=action;
                        this.form.post('/diatery/approvereject')
                        .then(() => {
                            Toast.fire({
                                icon: 'success',
                                title: 'Dietary details has been updated'
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
        this.action_type=this.$route.query.type;
        this.loadDietaryDetails(this.$route.query.id);
    },
}
</script>
