<template>
    <div> 
        <div class="invoice p-3 mb-6">
            <div class="row">
                <div class="col-12">
                    <h5>Program Fund and Inventory Management Details</h5>
                </div>
            </div>
            <div class="row invoice-info">
                <div class="col-sm-10 invoice-col">
                    <div class="table-responsive">
                        <table>
                        <tr>
                            <th style="width:50%">Program Name:</th>
                            <td>{{program_name}}</td>
                        </tr>
                        <tr>
                            <th>For the Month:</th>
                            <td>{{program_date}}</td>
                        </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <h6>Inventory Details</h6>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <table id="list-screening" class="table table-sm table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="20%">Variety</th>
                        <th width="20%">Item</th>
                        <th width="5%">Unit</th>
                        <th width="15%">Previous Month Balance</th>
                        <th width="10%">Increase in Quantity</th>
                        <th width="10%">Decrease in Quantity</th>
                        <th width="25%">Remarks</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <tr v-for="(item, index) in inventoryDetails" :key="index">
                        <td>{{ item.variety_name }}</td>
                        <td>{{ item.item_name }}</td>
                        <td>{{ item.unit_name }}</td>
                        <td>{{ item.PreviousQty }}</td>
                        <td>{{ item.DecreaseInQuantity }}</td>
                        <td>{{ item.IncreaseInQuantity }}</td>
                        <td>{{ item.Remarks }}</td>
                        <!-- <td>
                            <div class="btn-group btn-group-sm">
                                <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showaddmodal(item.id+'__'+item.StdStudentId)"><i class="fas fa-edit"></i > Edit</a>
                            </div>
                        </td> -->
                    </tr>
                </tbody>
            </table>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <h6>Production and Revenue Details</h6>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <table id="list-screening" class="table table-sm table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Variety</th>
                        <th>Item</th>
                        <th>Quantity Unit</th>
                        <th>Quantity Produced</th>
                        <th>Amount Generated from Sales</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <tr v-for="(item, index) in productionDetails" :key="index">
                        <td>{{ item.variety_name }}</td>
                        <td>{{ item.item_name }}</td>
                        <td>{{ item.unit_name }}</td>
                        <td>{{ item.QuantityProduced }}</td>
                        <td>{{ item.AmountGenerated }}</td>
                        <td>{{ item.Remarks }}</td>
                        <!-- <td>
                            <div class="btn-group btn-group-sm">
                                <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showaddmodal(item.id+'__'+item.StdStudentId)"><i class="fas fa-edit"></i > Edit</a>
                            </div>
                        </td> -->
                    </tr>
                </tbody>
            </table>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <h6>Expenditure Details</h6>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <table id="list-screening" class="table table-sm table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Details of Expenditure</th>
                        <th>Amount</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <tr v-for="(item, index) in expenditureDetails" :key="index">
                        <td>{{ item.Particular }}</td>
                        <td>{{ item.Amount }}</td>
                        <td>{{ item.Remarks }}</td>
                        <!-- <td>
                            <div class="btn-group btn-group-sm">
                                <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showaddmodal(item.id+'__'+item.StdStudentId)"><i class="fas fa-edit"></i > Edit</a>
                            </div>
                        </td> -->
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="modal fade" id="screening-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Student Vaccination Details</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="bootbox-body">
                            <form class="bootbox-form">
                                <div class="card-body">
                                    <div class="col-sm-10 invoice-col">
                                        <div class="table-responsive">
                                            <table v-for="(item, index) in inventoryDetails" :key="index">
                                            <tr>
                                                <th style="width:50%">Name:</th>
                                                <td>{{item.Name}}</td>
                                            </tr>
                                            <tr>
                                                <th>Student Code:</th>
                                                <td>{{item.student_code}}</td>
                                            </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group rp=0.5">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0.5">Vaccinated/Not Vaccinated:<i class="text-danger">*</i></label>
                                        <!-- <label><input  type="radio" v-model="form.vaccinated" value="1" tabindex=""/> Yes</label>
                                        <label><input  type="radio" v-model="form.vaccinated" value="0" tabindex=""/> No</label> -->
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" v-model="form.action_type">
                        <button data-bb-handler="cancel" type="button" data-dismiss="modal" class="btn btn-flat btn-danger">Cancel</button>
                        <button  @click="addMore('nomination')" type="button" class="btn btn-flat btn-primary">Update</button>
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
            //set the minimum date
            nowDate: new Date().toISOString().slice(0,10),
            date: new Date(),
            picker: new Date().toISOString().substr(0, 10),
            landscape: false,
            reactive: false,

            programList:[],
            itemList:[],
            unitList:[],
            unitArray:{},
            program_name:'',
            program_date:'',
            inventoryDetails: [],
            productionDetails: [],
            expenditureDetails: [],
            organisation_id:'',
            inventoryDetails:[],

            form: new form({
                id:'',
                actionType:'edit',
            }),
        }
    },
    methods: {
        selectunit(type,index){
            if(type=="inventory"){
                let itemval=$('#inventory'+index).val();
                $('#measurement_unit'+index).html(this.unitArray[itemval.split('_')[1]]);
            }
            else{
                let itemval=$('#item_produced'+index).val();
                $('#production_measurement_unit'+index).html(this.unitArray[itemval.split('_')[1]]);
            }

        },
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },
        /**
         * method to add more fields
         */
        // addMoreInventory: function(){
        //     this.inventoryCount++;
        //     this.form.inventoryDetails.push({
        //         item_id:'', previous_balance:'', increase_quantity:'', decrease_quantity:'',measurement_unit:'', remarks:'',})
        // },
        // addMoreProduction: function(){
        //     this.productionCount++;
        //     this.form.productionDetails.push({
        //         item_produced:'', quantity_produced:'', quantity_unit:'', no_varieties:'',amount_generated:'',production_remarks:''})
        // },
        // addMoreExpenditure: function(){
        //     this.expenditureCount++;
        //     this.form.expenditureDetails.push({
        //         expenditure_details:'', expenditure_amount:'',expenditure_remarks:''})
        // },
        /**
         * method to remove fields
         */
        removeInventory(index){
             if(this.form.inventoryDetails.length>1){
                this.inventoryCount--;
                this.form.inventoryDetails.pop();
            }
        },

        remove(index){
             if(this.form.expenditureDetails.length>1){
                this.expenditureCount--;
                this.form.expenditureDetails.splice(index,1);
            }
        },
        loadActiveProgramList(uri="masters/loadActiveStudentMasters/program_name"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.programList =  data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadActiveItemList(uri="masters/loadActiveStudentMasters/program_item"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.itemList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadActiveUnitList(uri="masters/loadActiveStudentMasters/program_measurement"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.unitList =  data.data.data;
                for(let i=0;i<data.data.data.length;i++){
                    this.unitArray[data.data.data[i].id] = data.data.data[i].Name;
                }
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },

        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="program"){
                this.form.program=$('#program').val();
            }
            if(id=="month"){
                this.form.month=$('#month').val();
            }
            if(id=="measurement_unit"){
                this.form.measurement_unit=$('#measurement_unit').val();
            }
        },
    },
    formaction: function(type){
            if(type=="reset"){
                this.form.program= '';
                this.form.month='';
            }
            if(type=="save"){
                this.form.post('/students/saveProgramInventory',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/student_programs_list');
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		},
    computed: {
        getEndDate() {
        var endDate = new Date(this.date.getFullYear(), this.date.getMonth() - 1, 10);
        return endDate.toISOString().slice(0,10)
        }
    },
    mounted() {
        $('[data-toggle="tooltip"]').tooltip();
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id'));
        });

        Fire.$on('changefunction',(id)=> {
            this.changefunction(id);
        });
        this.loadActiveProgramList();
        this.loadActiveItemList();
        this.loadActiveUnitList();
        this.form.id=this.$route.params.data.id;
        let uri='students/loadInventoryDetials/'+this.form.id;
        axios.get(uri)
        .then(response =>{
            let data = response.data.data;
            this.program_name =  data.program_name;
            this.program_date =  data.ForMonth;
            if(data.details && data.details.length>0){
                this.inventoryDetails = data.details;
            }
            if(data.production && data.production.length>0){
                this.productionDetails = data.production;
            }
            if(data.expenditure && data.expenditure.length>0){
                this.expenditureDetails = data.expenditure;
            }
        })
        .catch(function (error) {
            console.log(error);
        });
    },
}
</script>
