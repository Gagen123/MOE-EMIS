<template>
    <div> 
       <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-body">
                      <div class="form-group row">
                           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                               <label>Term:</label>
                             <select name="vaccine" id="vaccine" class="form-control editable_fields">
                                 <option value="">--Select--</option>
                                 <option value="1" >First Term</option>
                                 <option value="2">Second Term</option>
                                
                             </select>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                             <label>Date of Measurement:</label>
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
                                <select name="stream" id="stream" class="form-control editable_fields" >
                                    <option value="">--Select--</option>
                                    <option value="1">Science</option>
                                    <option value="2">Arts</option>
                                    <option value="3">Commerce</option>
                                </select>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Section:</label>
                               <select name="section" id="section" class="form-control editable_fields" @change="show()">
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
                       <div class="hidden" id="PP_A">
                           <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <table id="transferoption-table" class="table w-100 table-bordered table-striped">
                                  <thead>
                                      <tr>
                                         <th>Student ID</th>
                                         <th>Name</th> 
                                         <th>Sex</th>
                                         <th>DOB</th>
                                         <th>Age</th>
                                         <th>Height</th>
                                         <th>Weight</th>
                                         <th>BMI</th>
                                         <th>Remarks</th>
                                     </tr>
                                 </thead>
                                <tbody>
                                    <tr>
                                       <td>123</td>
                                        <td>Sonam Dorji</td>
                                        <td>Male</td>
                                        <td>2010-12-12</td>
                                        <td>10</td>
                                        <td>
                                            <input type="number" name="number" class="form-control"/>
                                       </td>
                                       <td>
                                         <input type="number" name="number" class="form-control"/>
                                      </td>
                                      <td>
                                         <input type="number" name="number1" class="form-control"/>
                                      </td>
                                      <td>
                                          <input type="text" name="remark" class="form-control"/>
                                      </td>
                                    </tr>
                                    <tr>
                                         <td>345</td>
                                         <td>Tshering Dema</td>
                                         <td>Female</td>
                                         <td>2011-10-13</td>
                                         <td>9</td>
                                      <td>
                                          <input type="number" name="number" class="form-control"/>
                                     </td>
                                     <td>
                                          <input type="number" name="number" class="form-control"/>
                                     </td>
                                     <td>
                                         <input type="number" name="number1" class="form-control"/>
                                      </td>
                                      <td>
                                         <input type="text" name="remark" class="form-control"/>
                                     </td>
                                   </tr>
                                 </tbody>
                             </table>
                            </div>
                           </div>
                        </div>
                         <div class="hidden" id="XI_SCI_A">
                            <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <table id="transferoption-table" class="table w-100 table-bordered table-striped">
                                  <thead>
                                       <tr>
                                         <th>Student ID</th>
                                         <th>Name</th> 
                                         <th>Sex</th>
                                         <th>DOB</th>
                                         <th>Age</th>
                                         <th>Height</th>
                                         <th>Weight</th>
                                         <th>BMI</th>
                                         <th>Remarks</th>
                                     </tr>
                                 </thead>
                                <tbody>
                                    <tr>
                                        <td>126</td>
                                        <td>Pema Lham</td>
                                        <td>Female</td>
                                        <td>2010-12-24</td>
                                        <td>10</td>
                                        <td>
                                         <input type="number" name="number" class="form-control"/>
                                        </td>
                                        <td>
                                          <input type="number" name="number" class="form-control"/>
                                        </td>
                                        <td>
                                         <input type="number" name="number1" class="form-control"/>
                                        </td>
                                        <td>
                                            <input type="text" name="remark" class="form-control"/>
                                        </td>
                                    </tr>
                                    <tr>
                                      <td>125</td>
                                        <td>Lekdrup Phuntsho</td>
                                        <td>Male</td>
                                        <td>2010-07-12</td>
                                        <td></td>
                                        <td>
                                         <input type="number" name="number" class="form-control"/>
                                        </td>
                                        <td>
                                          <input type="number" name="number" class="form-control"/>
                                        </td>
                                        <td>
                                          <input type="number" name="number1" class="form-control"/>
                                        </td>
                                        <td>
                                          <input type="text" name="remark" class="form-control"/>
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
         let classes = $("#classes").val();
         let stream = $("#stream").val();
         let section = $("#section").val();
         if(classes == 12 && stream == 1 && section == 1) {
             $("#XI_SCI_A").show();
             $("#PP_A").hide();
       
        }else {
         $("#PP_A").show();
         $("#XI_SCI_A").hide();
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
                        this.$router.push('/bmi_link');
                    }
                });
            }
        },
    },
    mounted() {
         
    },
    
}
</script>