<template>
    <div>
       <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-body">
               <!-- <div class="tab-content"> -->
                   <!-- <div class="tab-pane fade active show tab-content-details" id="stock-details-tabs" role="tabpanel" aria-labelledby="inventorydetails">-->
                      <div class="form-group row">
                           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                               <label>Screening:</label>
                              <select class="form-control" id="training_type" @change="removeerror('training_type','training_type_error'),showfields()">
                                 <option value="Ear">Ear</option>
                             </select>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                             <label>Date of Screening:</label>
                              <input type="date" class="form-control" name="date_id" id="month">
                            </div> 
                       </div>
                       <div class="form-group row">
                           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                             <label>Prepared by:</label>
                              <input type="text" id="preparedby" @change="remove_err('prepared_by','preparedby_error')" value="Sonam Gyeltshen" class="form-control">
                            </div>
                           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                               <label>Position Tile:</label>
                             <select class="form-control h-50 select2bs4">
                                 <option value="">--Select--</option>
                                 <option value="1">Principal</option>
                                 <option value="1">Teacher</option>
                                 <option value="1">Counsellor</option>
                                 <option value="1">Health Coordinator</option>
                             </select>
                            </div> 
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                               <label>Endorsed By:</label>
                             <select class="form-control h-50 select2bs4">
                                 <option value="">--Select--</option>
                                 <option value="1">Health Offical</option>
                             </select>
                            </div> 
                       </div>
                        <div class="row form-group">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <table id="transferoption-table" class="table w-100 table-bordered table-striped">
                                  <thead>
                                      <tr>
                                         <th>Screening Record</th>
                                         <th>Boys </th> 
                                         <th>Girls</th>
                                        
                                     </tr>
                                 </thead>
                                 <tbody id="table_data_populate">
                                    <tr>
                                         <td>
                                            Number of Students Screened
                                         </td>
                                         <td>
                                             20
                                          </td>
                                           <td>
                                             50
                                          </td>
                                         
                                       </tr>
                                       <tr>
                                         <td>
                                            Number of Students Referred for evaluation and treatment
                                         </td>
                                         <td>
                                            0
                                          </td>
                                           <td>
                                             1
                                          </td>
                                         
                                       </tr>
                                       
                                    
                                 </tbody>
                             </table>
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
    
     data() {
        return {
			count:5,
        }
    },

    methods: {
        
        shownexttab(presentclass,nextclass){  
            
            $('#tabhead >li >a').removeClass('active');
            $('#tabhead >li >a >span').addClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').addClass('active');
            $('.'+nextclass+' >a >span').removeClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').removeClass('disabled');
            //body
            $('.tab-content-details').hide();
            $('#'+nextclass).show().removeClass('fade');
            if(nextclass=="final-tab"){ 
                Swal.fire({
                    text: "Are you sure you wish to safe this details ?",
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
                        this.$router.push('/inventory_fund_management');
                    }
                });
            }
        },
    },
    mounted() {
        $('.select2').select2()
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
    },
    
}
</script>