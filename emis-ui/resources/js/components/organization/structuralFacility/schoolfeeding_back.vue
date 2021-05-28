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
                                <tr id="record1" v-for='(kit, index) in form.kitchen_status' :key="index">
                                    <td>
                                        <input type="text" class="form-control" v-model="kit.question" :id="'question'+(index+1)" readonly>
                                        <span class="text-danger" :id="'question'+(index+1)"></span>
                                    </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="kit.value" value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="kit.value" value="0" tabindex=""/> No</label>
                                        </div>
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
                                <tr id="record1" v-for='(food, index) in form1.food_status' :key="index">
                                    <td>
                                        <input type="text" class="form-control" v-model="food.question" :id="'question'+(index+1)" readonly>
                                        <span class="text-danger" :id="'question'+(index+1)"></span>
                                    </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="food.value" value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="food.value" value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
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
                                <tr id="record1" v-for='(equi, index) in form2.equipment_kitchen' :key="index">
                                    <td>
                                        <input type="text" class="form-control" v-model="equi.question" :id="'question'+(index+1)" readonly>
                                        <span class="text-danger" :id="'question'+(index+1)"></span>
                                    </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="equi.value" value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="equi.value" value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
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
                                <tr id="record1" v-for='(din, index) in form3.dinning_hall' :key="index">
                                    <td>
                                        <input type="text" class="form-control" v-model="din.question" :id="'question'+(index+1)" readonly>
                                        <span class="text-danger" :id="'question'+(index+1)"></span>
                                    </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label><input  type="radio" v-model="din.value" value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="din.value" value="0" tabindex=""/> No</label>
                                        </div>
                                    </td>
                                </tr>
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
            form: new form({
                kitchen_status:[
                    {question:'Adequate size of the kitchen for the number of students?',value:'1'},
                    {question:'save water connecion inside the kitchen?',value:'1'},
                    {question:'Continuous water supply throughout the year in the kitchen?',value:'1'},
                    {question:'Separate dish washing space in the kitchen?',value:'1'},
                    {question:'wash basin with water connection for handwashing?',value:'1'},
                    {question:'Proper functioning smoke outlet/chimney?',value:'1'},
                    {question:'Adequate shelves in the kitchen to store utensils neatly?',value:'1'},
                    {question:'Concrete floor?',value:'1'},
                    {question:'Concrete walls?',value:'1'},
                    {question:'Proper closed ceiling?',value:'1'},
                    {question:'Windows with proper closures?',value:'1'},
                    {question:'Doors with proper closures?',value:'1'},
                    {question:'Adequate ventilations?',value:'1'},
                    {question:'Functioning drainage system inside and outside of the kitchen?',value:'1'},
                    {question:'Changing room?',value:'1'},
                ],
                type: '',status:'pending'
                
            }),
            form1: new form({
                food_status:[
                    {question:'Separate store exist for perishable and non-perisable items?',value:'1'},
                    {question:'Adequate space is available to store food comodities?',value:'1'},
                    {question:'Proper pallets are in place to store all non-perishable food items?',value:'1'},
                    {question:'Proper containers are in place to store perishable food items?',value:'1'},
                    {question:'Functioning weighing balance is in place?',value:'1'},
                    {question:'Windows in proper closures?',value:'1'},
                    {question:'Doors in proper closure?',value:'1'},
                    {question:'Proper containers are in place to store opened non-perishable items to prevent contamination and spoilage?',value:'1'},
                    {question:'Working tables and space is available with store?',value:'1'},
                    {question:'Concrete floor?',value:'1'},
                    {question:'Concrete walls?',value:'1'},
                    {question:'Proper closed ceilings?',value:'1'},
                    {question:'Adequate ventilations?',value:'1'},
                    {question:'Proper roofing without leakages?',value:'1'},
                ],
                type: '',status:'pending'
            }),
            form2: new form({
                equipment_kitchen:[
                    {question:'Adequate number of functioning cooking stoves?',value:'1'},
                    {question:'Adequate number of pots existing for serving?',value:'1'},
                    {question:'Adequate number of pots/bowls/buckets exist for washing vegetables?',value:'1'},
                    {question:'Adequate number of ladles exist?',value:'1'},
                    {question:'Adequate separate cutlery for vegetables and meat items exist?',value:'1'},
                    {question:'Working tables are in place with clean surface for cutting vegetables/meats etc?',value:'1'},
                    {question:'Waste bins with proper lid is in place?',value:'1'},
                ],
                type: '',status:'pending'
            }),
            form3: new form({
                dinning_hall:[
                    {question:'Does the school have a dinning hall?',value:'1'},
                    {question:'Adequate space is available to accommodate all students?',value:'1'},
                    {question:'Adequate furniture to accommodate all students?',value:'1'},
                    {question:'Windows with proper closures?',value:'1'},
                    {question:'Concrete floor?',value:'1'},
                    {question:'Concrete walls?',value:'1'},
                    {question:'Proper closed ceilings?',value:'1'},
                    {question:'Adequate ventilations?',value:'1'},
                    {question:'Proper roofing without leakages?',value:'1'},
                    {question:'Waste bins with proper lid is in place?',value:'1'},
                ],
                type: '',status:'submitted'
            }),
        }
    },

    methods: {
        shownexttab(nextclass){ 
            if(nextclass=="final-tab"){ 
                Swal.fire({
                    text: "Are you sure you wish to save this detials?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        this.form3.post('organization/saveDinningHall')
                        .then((response) => { 
                            Toast.fire({
                                icon: 'success',
                                title: 'Data saved Successfully'
                            });
                        })
                        .catch((error) => {  
                            console.log("Error: "+error)
                        });
                    }
                });
            }else {
                if(nextclass=="service-tab"){
                    this.form.post('organization/saveKitchenStatus')
                    .then((response) => { 
                        Toast.fire({
                            icon: 'success',
                            title: 'Data saved Successfully'
                        });
                    })
                    .catch((error) => {  
                        console.log("Error: "+error)
                    });
                }else if(nextclass=="service1-tab"){
                    this.form1.post('organization/saveFoodStoreStatus')
                    .then((response) => { 
                        Toast.fire({
                            icon: 'success',
                            title: 'Data saved Successfully'
                        });
                    })
                    .catch((error) => {  
                        console.log("Error: "+error)
                    });
                }else if(nextclass=="undertaking-tab"){
                    this.form2.post('organization/saveUtensilKitchen')
                    .then((response) => { 
                        Toast.fire({
                            icon: 'success',
                            title: 'Data saved Successfully'
                        });
                    })
                    .catch((error) => {  
                        console.log("Error: "+error)
                    });
                }   
                this.change_tab(nextclass);
            }
            
        },
        /**
         * method to change tabs
         */
        change_tab(nextclass){
            $('#tabhead >li >a').removeClass('active');
            $('#tabhead >li >a >span').addClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').addClass('active');
            $('.'+nextclass+' >a >span').removeClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').removeClass('disabled');
            $('.tab-content-details').hide();
            $('#'+nextclass).show().removeClass('fade');
        },

        /**
         * method to load kitchen status details
         */
         loadKitchenStatus(){
            axios.get('organization/loadKitchenStatus')
            .then((response) => {  
                let data=response.data.data;
                if(data.length>0){
                    this.form.kitchen_status=[];
                    for(let i=0;i<data.length;i++){
                        this.form.kitchen_status.push(
                            {question:data[i].description,value:data[i].value},
                        );
                    }
                }
                
            })
            .catch((error) => {  
                console.log("Error......"+error);
            });
        },

        /**
         * method to load food store status details
         */
         loadFoodStoreStatus(){
            axios.get('organization/loadFoodStoreStatus')
            .then((response) => {  
                let data=response.data.data;
                if(data.length>0){
                    this.form1.food_status=[];
                    for(let i=0;i<data.length;i++){
                        this.form1.food_status.push(
                            {question:data[i].description,value:data[i].value},
                        );
                    }
                }
                
            })
            .catch((error) => {  
                console.log("Error......"+error);
            });
        },

        /**
         * method to load utensil kitchen details
         */
         loadUtensilKitchenStatus(){
            axios.get('organization/loadUtensilKitchenStatus')
            .then((response) => {  
                let data=response.data.data;
                if(data.length>0){
                    this.form2.equipment_kitchen=[];
                    for(let i=0;i<data.length;i++){
                        this.form2.equipment_kitchen.push(
                            {question:data[i].description,value:data[i].value},
                        );
                    }
                }
                
            })
            .catch((error) => {  
                console.log("Error......"+error);
            });
        },

    },
    mounted() {
        this.loadKitchenStatus();
        this.loadFoodStoreStatus();
        this.loadUtensilKitchenStatus();
    },
}
</script>