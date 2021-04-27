<template>
    <div>
       <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Date of Receipt:</label>
                        <input type="date" class="form-control" name="date_id" id="month">
                    </div> 
                </div>
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <table id="transferoption-table" class="table w-100 table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Quantity Received</th> 
                                    <th>Quantity Damaged </th> 
                                    <th>Remarks</th>  
                                </tr>
                            </thead>
                            <tbody id="table_data_populate">
                                <tr id="record1" v-for='(user, index) in users' :key="index">
                                    <td>
                                        <select name="names" id="names" class="form-control editable_fields" v-model="user.names">
                                            <option value="">--Select item--</option>
                                            <option value="1">Potatoes</option>
                                            <option>Onions</option>
                                            <option>Raddish</option>
                                            <option>Cabbage</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="number" class="form-control" v-model="user.number"/>
                                    </td>
                                    <td>
                                        <input type="text" name="remarks" class="form-control" v-model="user.remarks"/>
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
                names:'',number:'',remarks:''
            }] 
        }
    },


    methods: {
        addMore: function(){
            this.users.push({names:'',number:'',remarks:''})
        },
        remove(type,index){ 
            if(type=="qua"){
                this.qualificationlist.splice(index,1); 
            } 
            else{
                this.nominies.splice(index,1); 
            }            
        },
        
        shownexttab(presentclass,nextclass){  
            
            // $('#tabhead >li >a').removeClass('active');
            // $('#tabhead >li >a >span').addClass('bg-gradient-secondary text-white');
            // $('.'+nextclass+' >a').addClass('active');
            // $('.'+nextclass+' >a >span').removeClass('bg-gradient-secondary text-white');
            // $('.'+nextclass+' >a').removeClass('disabled');
            // //body
            // $('.tab-content-details').hide();
            // $('#'+nextclass).show().removeClass('fade');
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
                        this.$router.push('/stockreceipt');
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