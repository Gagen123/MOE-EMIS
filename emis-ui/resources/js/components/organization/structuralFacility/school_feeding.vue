<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <li class="nav-item personal-details-tabs" @click="shownexttab('','personal-details-tabs')">
                        <a class="nav-link active" data-toggle="pill" role="tab"> 
                            <label>Kitchen Status </label>                              
                        </a>
                    </li>
                    <li class="nav-item appointment-tab ">
                        <a class="nav-link" data-toggle="pill" @click="shownexttab('personal-details-tabs','appointment-tab')" role="tab">
                            <label>Food Store Status</label>
                        </a>
                    </li>
                    <li class="nav-item qualification-tab">
                        <a class="nav-link " data-toggle="pill" @click="shownexttab('appointment-tab','qualification-tab')" role="tab">
                            <label>Equipment & Utensils in kitchen</label>
                        </a>
                    </li>  
                    <li class="nav-item nomination-tab">
                        <a class="nav-link" data-toggle="pill" @click="shownexttab('qualification-tab','nomination-tab')" role="tab">
                            <label>Dinning Hall </label>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="personal-details-tabs" role="tabpanel" aria-labelledby="basicdetails">
                        <table id="waterTable" class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <thead>
                                <tr>
                                    <th width="60px">Description</th>
                                    <th width="40px">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="record1">
                                    <td>Adequate size of the kitchen for the number of students? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="independent"  value="1"> Yes
                                            <input type="radio" name="independent"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record2">
                                    <td>Safe water connecion inside the kitchen? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="inside"  value="1"> Yes
                                            <input type="radio" name="inside"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record3">
                                    <td>Continuous water supply throughout the year in the kitchen? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="throughout"  value="1"> Yes
                                            <input type="radio" name="throughout"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record4">
                                    <td>Separate dish washing space in the kitchen? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="space"  value="1"> Yes
                                            <input type="radio" name="space"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record5">
                                    <td>wash basin with water connection for handwashing? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="basin"  value="1"> Yes
                                            <input type="radio" name="basin"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record6">
                                    <td>Proper functioning smoke outlet/chimney? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="smoke"  value="1"> Yes
                                            <input type="radio" name="smoke"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record7">
                                    <td>Adequate shelves in the kitchen to store utensils neatly? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="store"  value="1"> Yes
                                            <input type="radio" name="store"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record8">
                                    <td>Concrete floor? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="Concrete"  value="1"> Yes
                                            <input type="radio" name="Concrete"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record9">
                                    <td>Concrete walls? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="walls"  value="1"> Yes
                                            <input type="radio" name="walls"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record10">
                                    <td>Proper closed ceiling? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="ceiling"  value="1"> Yes
                                            <input type="radio" name="ceiling"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record11">
                                    <td>Windows with proper closures? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="proper"  value="1"> Yes
                                            <input type="radio" name="proper"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record12">
                                    <td>Doors with proper closures? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="closures"  value="1"> Yes
                                            <input type="radio" name="closures"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record13">
                                    <td>Adequate ventilations? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="ventilations"  value="1"> Yes
                                            <input type="radio" name="ventilations"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record14">
                                    <td>Functioning drainage system inside and outside of the kitchen? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="outside"  value="1"> Yes
                                            <input type="radio" name="outside"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record15">
                                    <td>Changing room? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="room"  value="1"> Yes
                                            <input type="radio" name="room"  value="2"> No
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" @click="shownexttab('personal-details-tabs','appointment-tab')">Save & Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade tab-content-details" id="appointment-tab" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab" >
                        <table id="waterTable1" class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <thead>
                                <tr>
                                    <th width="60px">Description</th>
                                    <th width="40px">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="record1">
                                    <td>Separate store exist for perishable and non-perisable items? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="independent1"  value="1"> Yes
                                            <input type="radio" name="independent1"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record2">
                                    <td>Adequate space is available to store food comodities? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="inside1"  value="1"> Yes
                                            <input type="radio" name="inside1"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record3">
                                    <td>Proper pallets are in place to store all non-perishable food items? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="throughout1"  value="1"> Yes
                                            <input type="radio" name="throughout1"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record4">
                                    <td>Proper containers are in place to store perishable food items? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="space1"  value="1"> Yes
                                            <input type="radio" name="space1"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record5">
                                    <td>Functioning weighing balance is in place? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="basin1"  value="1"> Yes
                                            <input type="radio" name="basin1"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record6">
                                    <td>Windows in proper closures? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="smoke1"  value="1"> Yes
                                            <input type="radio" name="smoke1"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record7">
                                    <td>Doors in proper closure? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="store1"  value="1"> Yes
                                            <input type="radio" name="store1"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record8">
                                    <td>Proper containers are in place to store opened non-perishable items to prevent contamination and spoilage? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="Concrete1"  value="1"> Yes
                                            <input type="radio" name="Concrete1"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record9">
                                    <td>Working tables and space is available with store? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="walls1"  value="1"> Yes
                                            <input type="radio" name="walls1"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record10">
                                    <td>Concrete floor? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="ceiling1"  value="1"> Yes
                                            <input type="radio" name="ceiling1"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record11">
                                    <td>Concrete walls? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="proper1"  value="1"> Yes
                                            <input type="radio" name="proper1"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record12">
                                    <td>Proper closed ceilings? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="closures1"  value="1"> Yes
                                            <input type="radio" name="closures1"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record13">
                                    <td>Adequate ventilations? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="ventilations1"  value="1"> Yes
                                            <input type="radio" name="ventilations1"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record14">
                                    <td>Proper roofing without leakages? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="outside1"  value="1"> Yes
                                            <input type="radio" name="outside1"  value="2"> No
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('','personal-details-tabs')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-primary" @click="shownexttab('appointment-tab','qualification-tab')">Save & Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade tab-content-details" id="qualification-tab" role="tabpanel">
                        <table id="waterTable1" class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <thead>
                                <tr>
                                    <th width="60px">Description</th>
                                    <th width="40px">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="record1">
                                    <td>Adequate number of functioning cooking stoves? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="independent2"  value="1"> Yes
                                            <input type="radio" name="independent2"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record2">
                                    <td>Adequate number of pots existing for serving? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="inside2"  value="1"> Yes
                                            <input type="radio" name="inside2"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record3">
                                    <td>Adequate number of pots/bowls/buckets exist for washing vegetables? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="throughout2"  value="1"> Yes
                                            <input type="radio" name="throughout2"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record4">
                                    <td>Adequate number of ladles exist? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="space2"  value="1"> Yes
                                            <input type="radio" name="space2"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record5">
                                    <td>Adequate separate cutlery for vegetables and meat items exist? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="basin2"  value="1"> Yes
                                            <input type="radio" name="basin2"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record6">
                                    <td>Working tables are in place with clean surface for cutting vegetables/meats etc? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="smoke2"  value="1"> Yes
                                            <input type="radio" name="smoke2"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record7">
                                    <td>Waste bins with proper lid is in place? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="store2"  value="1"> Yes
                                            <input type="radio" name="store2"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('personal-details-tabs','qualification-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-primary" @click="shownexttab('qualification-tab','nomination-tab')">Save & Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade tab-content-details" id="nomination-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <table id="waterTable1" class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <thead>
                                <tr>
                                    <th width="60px">Description</th>
                                    <th width="40px">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="record1">
                                    <td>Does the school have a dinning hall? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="independent3"  value="1"> Yes
                                            <input type="radio" name="independent3"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record2">
                                    <td>Adequate space is available to accommodate all students? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="inside3"  value="1"> Yes
                                            <input type="radio" name="inside3"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record3">
                                    <td>Adequate furniture to accommodate all students? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="throughout3"  value="1"> Yes
                                            <input type="radio" name="throughout3"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record4">
                                    <td>Windows with proper closures? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="space3"  value="1"> Yes
                                            <input type="radio" name="space3"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record5">
                                    <td>Concrete floor? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="basin3"  value="1"> Yes
                                            <input type="radio" name="basin3"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record6">
                                    <td>Concrete walls? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="smoke3"  value="1"> Yes
                                            <input type="radio" name="smoke3"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record7">
                                    <td>Proper closed ceilings? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="store3"  value="1"> Yes
                                            <input type="radio" name="store3"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record8">
                                    <td>Adequate ventilations? </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="store3"  value="1"> Yes
                                            <input type="radio" name="store3"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record9">
                                    <td>Proper roofing without leakages </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="store3"  value="1"> Yes
                                            <input type="radio" name="store3"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                                <tr id="record9">
                                    <td>Waste bins with proper lid is in place </td>
                                    <td>
                                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="radio" name="store3"  value="1"> Yes
                                            <input type="radio" name="store3"  value="2"> No
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('personal-details-tabs','appointment-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <!-- <button v-if="modalfinalactionedit" class="btn btn-primary" @click="shownexttab('qualification-tab','finalsubmit')">Upate <i class="fa fa-arrow-right"></i></button> -->
                                <button class="btn btn-primary" @click="shownexttab('qualification-tab','finalsubmit')">Save & Submit <i class="fa fa-arrow-right"></i></button>
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

        }
    },

    methods:{
        shownexttab(presentclass,nextclass){  
            // if(this.validatetabs(presentclass)){
                $('#tabhead >li >a').removeClass('active');
                $('#tabhead >li >a >span').addClass('bg-gradient-secondary text-white');
                $('.'+nextclass+' >a').addClass('active');
                $('.'+nextclass+' >a >span').removeClass('bg-gradient-secondary text-white');
                $('.'+nextclass+' >a').removeClass('disabled');
                //body
                $('.tab-content-details').hide();
                $('#'+nextclass).show().removeClass('fade');
                if(nextclass=="finalsubmit"){ 
                    Swal.fire({
                        text: "Are you sure you wish to take this action ?",
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes!',
                        }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire(
                                'Success!',
                                'Details has been saved successfully.',
                                'success',
                            )
                            window.location.reload();
                        }
                    });
                }
            // }
        },
    }
}
</script>