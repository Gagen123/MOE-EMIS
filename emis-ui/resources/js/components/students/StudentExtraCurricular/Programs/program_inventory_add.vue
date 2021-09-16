<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <li class="nav-item personal-tab" @click="shownexttab('personal-tab')">
                        <a class="nav-link active" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Inventory </label>
                        </a>
                    </li>
                    <li class="nav-item production-tab" @click="shownexttab('production-tab')">
                        <a class="nav-link" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Production & Revenue </label>
                        </a>
                    </li>
                    <li class="nav-item expenditure-tab" @click="shownexttab('expenditure-tab')">
                        <a class="nav-link" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Expenditure</label>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body pt-0 mt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="personal-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="form-group row" id="bhutanese_address">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Program:</label>
                                <select v-model="form.program" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('program') }" class="form-control select2" name="program" id="program">
                                    <option v-for="(item, index) in programList" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                                </select>
                                <has-error :form="form" field="program"></has-error>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Month:</label>
                                <input type="date" :min="getEndDate" :max="nowDate" name="month" id="month" class="form-control" v-model="form.month" :class="{ 'is-invalid': form.errors.has('month') }" @change="remove_error('month')"/>
                                <has-error :form="form" field="month"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><b>Add Inventory For the Month</b><br>
                                <div class="card-body col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th rowspan="2" width="20%">Variety</th>
                                                <th rowspan="2" width="20%">Item</th>
                                                <th rowspan="2" width="15%">Previous Month Balance</th>
                                                <th colspan="3" width="25%">For the Month</th>
                                                <th rowspan="2" width="25%">Remarks</th>
                                            </tr>
                                            <tr>
                                                <th>Quantity Produced</th>
                                                <th>Damaged</th>
                                                <th>Unit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr id="record" v-for='(inventory, index) in form.inventoryDetails' :key="index">
                                                <td>
                                                    <select name="variety" :id="'variety'+index" class="form-control editable_fields" v-model="inventory.variety" @change="loadItemList('inventory',index)">
                                                        <option value="">--- Please Select ---</option>
                                                        <option v-for="(item, index) in varietyList" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="inventory" :id="'inventory'+index" class="form-control editable_fields" v-model="inventory.item_id" @change="selectunit('inventory',index)">
                                                        <option value="">--- Please Select ---</option>
                                                        <!-- <option v-for="(item, index) in itemList" :key="index" v-bind:value="item.id+'_'+item.Unit_id">{{ item.name }}</option> -->
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" min="0" name="previous_balance" class="form-control" v-model="inventory.previous_balance"/>
                                                </td>
                                                <td>
                                                    <input type="number" min="0" name="increase_quantity" class="form-control" v-model="inventory.increase_quantity"/>
                                                </td>
                                                <td>
                                                    <input type="number" min="0" name="decrease_quantity" class="form-control" v-model="inventory.decrease_quantity"/>
                                                </td>
                                                <td>
                                                    <!-- <select name="measurement_unit" :id="'measurement_unit'+index" class="form-control editable_fields" v-model="inventory.measurement_unit">
                                                        <option value="">--- Please Select ---</option>
                                                        <option v-for="(item, index) in unitList" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                                                    </select> -->
                                                    <span :id="'measurement_unit'+index"></span>
                                                </td>
                                                <td>
                                                    <input type="text" name="remarks" class="form-control" v-model="inventory.remarks"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=7>
                                                    <button type="button" class="btn btn-flat btn-sm btn-primary" id="addMoreInventory"
                                                    @click="addMoreInventory()"><i class="fa fa-plus"></i> Add More</button>
                                                    <button type="button" class="btn btn-flat btn-sm btn-danger" id="removeInventory"
                                                    @click="removeInventory()"><i class="fa fa-trash"></i> Remove</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" @click="shownexttab('production-tab')">Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                    <!-- Next Tab/ 2nd Tab-->
                    <div class="tab-pane fade tab-content-details" id="production-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><b>Add Production & Revenue for the Month</b><br>
                                <div class="card-body col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <table id="dynamic-table" class="table table-sm table-bordered table-striped">
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
                                        <tbody>
                                            <tr id="record2" v-for='(production, index) in form.productionDetails' :key="index">
                                                <td>
                                                    <select name="produced_variety" :id="'produced_variety'+index" class="form-control editable_fields" v-model="production.variety" @change="loadItemList('production',index)">
                                                        <option value="">--- Please Select ---</option>
                                                        <option v-for="(item, index) in varietyList" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="item_produced" :id="'item_produced'+index" class="form-control editable_fields" v-model="production.item_produced" @change="selectunit('production',index)">
                                                        <option value="">--- Please Select ---</option>
                                                        <!-- <option v-for="(item, index) in itemList" :key="index" v-bind:value="item.id+'_'+item.Unit_id">{{ item.name }}</option> -->
                                                    </select>
                                                </td>
                                                <td>
                                                    <!-- <select name="quantity_unit" id="quantity_unit" class="form-control editable_fields" v-model="production.quantity_unit">
                                                        <option value="">--- Please Select ---</option>
                                                        <option v-for="(item, index) in unitList" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                                                    </select> -->
                                                    <span :id="'production_measurement_unit'+index"></span>
                                                </td>
                                                <td>
                                                    <input type="text" name="quantity_produced" class="form-control" v-model="production.quantity_produced"/>
                                                </td>
                                                <!-- <td>
                                                    <input type="number" min="0" name="no_varieties" class="form-control" v-model="production.no_varieties"/>
                                                </td> -->
                                                <td>
                                                    <input type="number" min="0" name="amount_generated" class="form-control" v-model="production.amount_generated"/>
                                                </td>
                                                <td>
                                                    <input type="text" name="production_remarks" class="form-control" v-model="production.production_remarks"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=7>
                                                    <button type="button" class="btn btn-flat btn-sm btn-primary" id="addMoreProduction"
                                                    @click="addMoreProduction()"><i class="fa fa-plus"></i> Add More</button>
                                                    <button type="button" class="btn btn-flat btn-sm btn-danger" id="removeProduction"
                                                    @click="removeProduction()"><i class="fa fa-trash"></i> Remove</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('personal-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-primary" @click="shownexttab('expenditure-tab')"> <i class="fa fa-arrow-right"></i>Next </button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade tab-content-details" id="expenditure-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><b>Facility</b><br>
                                <div class="card-body col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Details of Expenditure</th>
                                                <th>Amount</th>
                                                <th>Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr id="record3" v-for='(expenditure, index) in form.expenditureDetails' :key="index">
                                                <td>
                                                    <input type="text" name="expenditure_details" class="form-control" v-model="expenditure.expenditure_details"/>
                                                </td>
                                                <td>
                                                    <input type="number" name="expenditure_amount" class="form-control" v-model="expenditure.expenditure_amount"/>
                                                </td>
                                                <td>
                                                    <input type="text" name="expenditure_remarks" class="form-control" v-model="expenditure.expenditure_remarks"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=7>
                                                    <button type="button" class="btn btn-flat btn-sm btn-primary" id="addMore"
                                                    @click="addMoreExpenditure()"><i class="fa fa-plus"></i> Add More</button>
                                                    <button type="button" class="btn btn-flat btn-sm btn-danger" id="remove"
                                                    @click="removeExpenditure()"><i class="fa fa-trash"></i> Remove</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('production-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
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
            //set the minimum date
            nowDate: new Date().toISOString().slice(0,10),
            date: new Date(),
            picker: new Date().toISOString().substr(0, 10),
            landscape: false,
            reactive: false,

            programList:[],
            itemList:[],
            varietyList:[],
            unitList:[],
            unitArray:{},
            inventoryDetails: [],
            productionDetails: [],
            expenditureDetails: [],
            organisation_id:'',

            form: new form({
                program:'',
                month:'',
                organisation_id:'1',
                inventoryDetails: [],
                productionDetails: [],
                expenditureDetails: [],
                actionType:'add',
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
        loadItemList(type, index){
            if(type=="inventory"){
                let itemval=$('#variety'+index).val();

                axios.get('/masters/getProgramItems/'+itemval)
                    .then((response) => {
                        let itemList = response.data;
                        let option='';
                        itemList.forEach(itm => {
                            option+='<option value="'+itm.id+'_'+itm.Unit_id+'">'+itm.name+'</option>';
                        });
                        $('#inventory'+index).append(option);
                    })
                    .catch((e) => {
                        console.log("Error:"+e)
                });
            }
            else{
                let itemval=$('#produced_variety'+index).val();

                axios.get('/masters/getProgramItems/'+itemval)
                    .then((response) => {
                        let itemList = response.data;
                        let option='';
                        itemList.forEach(itm => {
                            option+='<option value="'+itm.id+'_'+itm.Unit_id+'">'+itm.name+'</option>';
                        });
                        $('#item_produced'+index).append(option);
                    })
                    .catch((e) => {
                        console.log("Error:"+e)
                });
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
        addMoreInventory: function(){
            this.inventoryCount++;
            this.form.inventoryDetails.push({
                item_id:'', previous_balance:'', increase_quantity:'', decrease_quantity:'',measurement_unit:'', remarks:'',})
        },
        addMoreProduction: function(){
            this.productionCount++;
            this.form.productionDetails.push({
                item_produced:'', quantity_produced:'', quantity_unit:'', no_varieties:'',amount_generated:'',production_remarks:''})
        },
        addMoreExpenditure: function(){
            this.expenditureCount++;
            this.form.expenditureDetails.push({
                expenditure_details:'', expenditure_amount:'',expenditure_remarks:''})
        },
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
        loadActiveProgramList(uri="masters/loadActiveStudentMasters/CeaProgram"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.programList =  data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadActiveVarietyList(uri="masters/loadActiveStudentMasters/CeaProgramItemVariety"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.varietyList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        // loadActiveItemList(uri="masters/loadActiveStudentMasters/CeaProgramItem"){
        //     axios.get(uri)
        //     .then(response => {
        //         let data = response;
        //         this.itemList =  data.data.data;
        //     })
        //     .catch(function (error) {
        //         console.log("Error......"+error)
        //     });
        // },
        loadActiveUnitList(uri="masters/loadActiveStudentMasters/CeaProgramMeasurement"){
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
        shownexttab(nextclass){
            if(nextclass=="final-tab"){
                Swal.fire({
                    text: "Are you sure you wish to save the  details ?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        this.form.post('students/saveProgramInventory')
                        .then((response) => {
                            Swal.fire(
                                'Success!',
                                'Details has been saved successfully.',
                                'success',
                            )
                            this.$router.push('/program_inventory_list');
                        })
                        .catch((error) => {
                            console.log("Error......"+error)
                        });
                    }
                });

            } else{
                this.change_tab(nextclass);
            }
        },
        change_tab(nextclass){
            $('.personname').html(this.form.name);
            $('#tabhead >li >a').removeClass('active');
            $('#tabhead >li >a >span').addClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').addClass('active');
            $('.'+nextclass+' >a >span').removeClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').removeClass('disabled');
            $('.tab-content-details').hide();
            $('#'+nextclass).show().removeClass('fade');
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
        this.loadActiveVarietyList();
        //this.loadActiveItemList();
        this.loadActiveUnitList();

    },
}
</script>
