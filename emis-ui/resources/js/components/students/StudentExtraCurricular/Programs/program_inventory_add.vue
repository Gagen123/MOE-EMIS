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
                    <li class="nav-item qualification-tab" @click="shownexttab('qualification-tab')">
                        <a class="nav-link" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Production & Revenue </label>
                        </a>
                    </li>
                    <li class="nav-item nomination-tab" @click="shownexttab('nomination-tab')">
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
                                <select v-model="inventory_form.dzongkhag" :class="{ 'is-invalid select2 select2-hidden-accessible': inventory_form.errors.has('dzongkhag') }" class="form-control select2" name="dzongkhag" id="dzongkhag">
                                    <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="inventory_form" field="dzongkhag"></has-error>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Month:</label>
                                <select v-model="inventory_form.gewog" :class="{ 'is-invalid select2 select2-hidden-accessible': inventory_form.errors.has('gewog') }" class="form-control select2" name="gewog" id="gewog">
                                    <option v-for="(item, index) in gewog_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="inventory_form" field="gewog"></has-error>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><b>Add Inventory For the Month</b><br>
                                <div class="card-body col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th rowspan="2" width="20%">Item</th>
                                                <th rowspan="2" width="20%">Previous Month Balance</th>
                                                <th colspan="2" width="35%">For the Month</th>
                                                <th rowspan="2" width="25%">Remarks</th>                       
                                            </tr>
                                            <tr>
                                                <th>Increase in Quantity</th>
                                                <th>Decrease in Quantity</th>                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr id="record" v-for='(user, index) in inventory_form.inventory_details' :key="index">
                                                <td>
                                                    <select name="inventory" id="inventory" class="form-control editable_fields" v-model="inventory_details.item_id">
                                                        <option value="">--- Please Select ---</option>
                                                        <option v-for="(item, index) in itemList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                    </select>
                                                </td>
                                                
                                                <td>                                
                                                    <input type="text" name="previous_balance" class="form-control" v-model="inventory_details.previous_balance"/>
                                                </td>
                                                <td>                                
                                                    <input type="text" name="increase_quantity" class="form-control" v-model="inventory_details.increase_quantity"/>
                                                </td>
                                                <td>                                
                                                    <input type="number" name="decrease_quantity" class="form-control" v-model="inventory_details.decrease_quantity"/>
                                                </td>
                                                <td>
                                                    <input type="number" name="remarks" class="form-control" v-model="inventory_details.remarks"/>
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
                                <button class="btn btn-primary" @click="shownexttab('qualification-tab')">Save & Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                    <!-- Next Tab/ 2nd Tab-->
                    <div class="tab-pane fade tab-content-details" id="qualification-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><b>Add Production & Revenue for the Month</b><br>
                                <div class="card-body col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>Quantity Produced</th>
                                                <th>Quantity Unit</th>
                                                <th>No. of Varieties</th>
                                                <th>Amount Generated from Sales</th>
                                                <th>Remarks</th>                         
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr id="record1" v-for='(user, index) in production_form.production_details' :key="index">
                                                <td>
                                                    <select name="item_produced" id="item_produced" class="form-control editable_fields" v-model="production_details.item_produced">
                                                        <option value="">--- Please Select ---</option>
                                                        <option v-for="(item, index) in itemList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                    </select>
                                                </td>
                                                <td>                                
                                                    <input type="text" name="quantity_produced" class="form-control" v-model="production_details.quantity_produced"/>
                                                </td>
                                                <td>                                
                                                    <input type="text" name="quantity_unit" class="form-control" v-model="production_details.quantity_produced"/>
                                                </td>
                                                <td>                                
                                                    <input type="text" name="no_varieties" class="form-control" v-model="production_details.no_varieties"/>
                                                </td>
                                                <td>                                
                                                    <input type="number" name="amount_generated" class="form-control" v-model="production_details.amount_generated"/>
                                                </td>
                                                <td>
                                                    <input type="number" name="production_remarks" class="form-control" v-model="production_details.production_remarks"/>
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
                                <button class="btn btn-primary" @click="shownexttab('nomination-tab')"> <i class="fa fa-arrow-right"></i>Save & Next </button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade tab-content-details" id="nomination-tab" role="tabpanel" aria-labelledby="basicdetails">
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
                                            <tr id="record2" v-for='(user, index) in expenditure_form.expenditure_details' :key="index">
                                                <td>                                
                                                    <input type="text" name="expenditure_details" class="form-control" v-model="expenditure_details.expenditure_details"/>
                                                </td>
                                                <td>                                
                                                    <input type="number" name="expenditure_amount" class="form-control" v-model="expenditure_details.expenditure_amount"/>
                                                </td>
                                                <td>                                
                                                    <input type="text" name="expenditure_remarks" class="form-control" v-model="expenditure_details.expenditure_remarks"/>
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
                                <button class="btn btn-success" @click="shownexttab('qualification-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
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
            grand_total:0,
            qualification_tbl_row_count:0,
            sex_idList:[],
            marital_statusList:[],
            positiontitleList:[],
            countryList:[],
            dzongkhagList:[],
            gewog_list:[],
            villageList:[],
            subjectList:[],
            cureerstageList:[],
            qualificationDescription:[],
            staffqualificationlist:[],
            coursemodeList:[],
            repationshipList:[],
            staff_nomination_list:[],
            inventory_details: [],
            production_details: [],
            expenditure_details: [],
            
            inventory_form: new form({
                inventory_details: [],
                remarks:'',
                status:'Pending',
            }),
            production_form: new form({
                production_details: [],
            }),
            expenditure_form: new form({
                expenditure_details: [],
            }),  
            staff_qualification_list:'',
        } 
    },
    methods: {
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        }, 
        showemptypedtab(type){
            if(type){
                $('#empidcid').html('Emp Id/CID');
                $('#position').prop('readonly',true);
                $('#working').prop('readonly',true);
            }
            else{
                $('#empidcid').html('CID/Work Permit No.');
                $('#position').prop('readonly',false);
                $('#working').prop('readonly',false);
            }
        },
        /**
         * method to add more fields
         */
        addMoreInventory: function(){
            this.inventoryCount++;
            this.inventory_form.inventory_details.push({
                previous_balance:'', increase_quantity:'',decrease_quantity:'',remarks:'',}) 
        },
        addMoreProduction: function(){
            this.prodcutionCount++;
            this.production_form.production_details.push({
                item_produced:'', quantity_produced:'', quantity_unit:'', no_varieties:'',amount_generated:'',production_remarks:''})
        },
        addMoreExpenditure: function(){
            this.expenditureCount++;
            this.expenditure_form.expenditure_details.push({
                expenditure_details:'', expenditure_amount:'',expenditure_remarks:''})    
        }, 
        /**
         * method to remove fields
         */
        remove(index){    
             if(this.inventory_form.inventory_details.length>1){
                this.count--;
                this.inventory_form.inventory_details.splice(index,1); 
            }
        },
        loadqualication(staff_id){
            if(staff_id!=null && staff_id!=""){
                let uri = 'staff/loadQualification/'+staff_id;
                axios.get(uri)
                .then(response =>{
                    let data = response;
                    this.staff_qualification_list = data.data.data;
                })
                .catch(function (error){
                    console.log("Error:"+error)
                });
            }
        },
        shownexttab(nextclass){ 
            this.change_tab(nextclass);
                if(nextclass=="personal-tab"){
                    
                }  
                // else{
                //     if(nextclass=="nomination-tab" && this.staff_qualification_list.length<1){
                //         Swal.fire(
                //             'error!',
                //             'Please provide qualification details.',
                //             'error',
                //         );
                //         this.change_tab('qualification-tab');
                //     }
                //     else{
                //         this.change_tab(nextclass);
                //         this.loadnomination(this.inventory_form.personal_id);
                //     }
                // }
        },
        change_tab(nextclass){
            $('.personname').html(this.inventory_form.name);
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
            if(id=="position_title"){
                this.inventory_form.position_title=$('#position_title').val();
            }
            if(id=="sex_id"){
                this.inventory_form.sex_id=$('#sex_id').val();
            }
            if(id=="marital_status"){ 
                this.inventory_form.marital_status=$('#marital_status').val();
            }
        },
        
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
        this.loadactivemaritalList();
        this.loaddraftpersonalDetails();
        this.loadactivesex_idList();
        this.loadpositiontitleList();
        this.loadactivecountryList();
        this.loadactivedzongkhagList();
        this.loadactivesubjectList();
        this.loadactivecureerstageList();
        this.loadrelationshipList();
        
    },
}
</script>
