<template>
    <div>
       <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-body">

              
                      <div class="form-group row">
                           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                               <label>Vaccine:</label>
                             <select name="vaccine" id="vaccine" class="form-control editable_fields" @change="show()">
                                 <option value="">--Select--</option>
                                 <option value="1" >TD Vaccine</option>
                                 <option value="2">HPV Vaccine</option>
                                
                             </select>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                             <label>Date of Vacination:</label>
                              <input type="date" class="form-control" name="date_id" id="month">
                            </div> 
                       </div>
                       <div class="form-group row">
                           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                               <label>Class:</label>
                              <select name="classes" id="classes" class="form-control editable_fields" @change="shownew()">
                                 <option value="">--Select--</option>
                                 <option value="1">PP</option>
                                 <option value="2">I</option>
                                 <option value="3">II</option>
                                 <option value="4">III</option>
                                 <option value="5">IV</option>
                                 <option value="6">V</option>
                                 <option value="7">VI</option>
                                 <option value="8">VII</option>
                                 <option value="9">VIII</option>
                                 <option value="10">IX</option>
                                 <option value="11">X</option>
                                 <option value="12">XI</option>
                                 <option value="13">XII</option>
                             </select> 
                           </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 hidden" id="stream">
                                <label>Streams:</label>
                                <select class="form-control">
                                    <option value="">--Select--</option>
                                    <option value="1">Science</option>
                                    <option value="2">Arts</option>
                                    <option value="3">Commerce</option>
                                </select>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Section:</label>
                                <select class="form-control">
                                 <option value="">--Select--</option>
                                 <option value="1">A</option>
                                 <option value="2">B</option>
                                 <option value="3">C</option>
                                 <option value="4">D</option>
                                 <option value="5">E</option>
                                 <option value="6">F</option>
                                </select>
                            </div> 
                       </div>
                       <div class="hidden" id="TDvaccine">
                           <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <table id="transferoption-table" class="table w-100 table-bordered table-striped">
                                  <thead>
                                      <tr>
                                         <th>Student vaccinated with TD</th>
                                         <th>Boys</th> 
                                         <th>Girls</th>
                                     </tr>
                                 </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                          Number of Student who received TD at 6 years
                                        </td>
                                        <td>
                                             <input type="number" name="number" class="form-control"/>
                                        </td>
                                         <td>
                                             <input type="number" name="number1" class="form-control"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                          Number of Student who received TD 12 years
                                        </td>
                                        <td>
                                             <input type="number" name="number" class="form-control"/>
                                        </td>
                                         <td>
                                             <input type="number" name="number1" class="form-control"/>
                                        </td>
                                     </tr>
                                 </tbody>
                     
                             </table>
                            </div>
                           </div>
                        </div>
                         <div class="hidden" id="HPVvaccine">
                            <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <table id="transferoption-table" class="table w-100 table-bordered table-striped">
                                  <thead>
                                      <tr>
                                         <th>Number of Girls who received 1st Dose</th>
                                         <th>Number of Girls who received 2nd Dose</th> 
                                         <th>Number of Girls who received 3rd Dose</th>
                                     </tr>
                                 </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="number" name="number" class="form-control"/>
                                        </td>
                                        <td>
                                             <input type="number" name="number" class="form-control"/>
                                        </td>
                                         <td>
                                             <input type="number" name="number1" class="form-control"/>
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
                                
                                <button class="btn btn-primary" @click="shownexttab('expenditure-tab','final-tab')"> <i class="fa fa-save"></i>Save </button>
                            </div>
                        </div>
                <!--    </div>-->
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

    methods: {
     show: function()  {
         let vaccine = $("#vaccine").val();
         if(vaccine == 1) {
             $("#TDvaccine").show();
             $("#HPVvaccine").hide();
       
        }else {
         $("#HPVvaccine").show();
         $("#TDvaccine").hide();
         }
     },

     shownew: function()  {
         let classes = $("#classes").val();
         if(classes == 12 || classes == 13) {
             $("#stream").show();
             }
              else{
                 $("#stream").hide();
              }
     },
        
        shownexttab(presentclass,nextclass){  
            
          //  $('#tabhead >li >a').removeClass('active');
          //  $('#tabhead >li >a >span').addClass('bg-gradient-secondary text-white');
          //  $('.'+nextclass+' >a').addClass('active');
          //  $('.'+nextclass+' >a >span').removeClass('bg-gradient-secondary text-white');
         //   $('.'+nextclass+' >a').removeClass('disabled');
            //body
            $('.tab-content-details').hide();
            $('#'+nextclass).show().removeClass('fade');
            if(nextclass=="final-tab"){ 
                Swal.fire({ 
                    text: "Are you sure you wish to save this details ?",
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
                        this.$router.push('/vaccination_link');
                    }
                });
            }
        },
    },
    mounted() {
         
    },
    
}
</script>