<template>
    <div>
       <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-body">
               <!-- <div class="tab-content"> -->
                   <!-- <div class="tab-pane fade active show tab-content-details" id="stock-details-tabs" role="tabpanel" aria-labelledby="inventorydetails">-->
                      <div class="form-group row">
                           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                               <label>Term:</label>
                             <select class="form-control h-50 select2bs4">
                                 <option value="">--Select--</option>
                                 <option value="1">Term I</option>
                                 <option value="1">Term II</option>
                                 <option value="1">Term III</option>
                             </select>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                             <label>Date of Deworming Issued:</label>
                              <input type="date" class="form-control" name="date_id" id="month">
                            </div> 
                       </div>
                        <div class="row form-group">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <table id="transferoption-table" class="table w-100 table-bordered table-striped">
                                  <thead>
                                      <tr>
                                         <th>Class</th>
                                         <th>Boys </th> 
                                         <th>Girls</th>

                                        
                                     </tr>
                                 </thead>
                                <tbody id="table_data_populate">
                                    <tr id="record1" v-for='(user, index) in users' :key="index">
                                         <td>
                                             <select name="class" id="class" class="form-control editable_fields" v-model="user.class">
                                                 <option value="">--Select class--</option>
                                                 <option value="1">PP</option>
                                                 <option>I</option>
                                                 <option>II</option>
                                                 <option>III</option>
                                                 <option>IV</option>
                                                 <option>V</option>
                                                 <option>VI</option>
                                                 <option>VII</option>
                                                 <option>VIII</option>
                                                 <option>IX</option>
                                                 <option>X</option>
                                                 <option>XI</option>
                                                 <option>XII</option>
                                             </select>
                                         </td>
                                         <td>
                                             <input type="number" name="number" class="form-control" v-model="user.number"/>
                                          </td>
                                           <td>
                                             <input type="number" name="number1" class="form-control" v-model="user.number1"/>
                                          </td>
                                       </tr>
                                       
                                     <tr>
                                          <td colspan="9"> 
                                             <button type="button" class="btn btn-xs btn-primary" id="addMore" @click="addMore('qua')"><i class="fa fa-plus"></i> Add More</button>
                                             <button type="button" class="btn btn-xs btn-danger" id="addMore"  @click="remove('qua')"><i class="fa fa-trash"></i> Remove</button>
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
             users:
            [{
                class:'',number:'',number1:''
            }] 
        }
    },

    methods: {
        addMore: function(){
            this.users.push({class:'',number:'',number:''})
        },
        remove(index){    
             this.users.splice(index,1);             
        },
        
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