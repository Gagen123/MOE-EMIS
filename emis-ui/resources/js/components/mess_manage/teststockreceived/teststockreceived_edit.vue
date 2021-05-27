<template>
    <div>
        <form>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Stock received for: <span class="text-blue">{{foodrelease_form.quarter}}</span> </label>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Date of Food Released: <span class="text-blue">{{foodrelease_form.dateOfreceive}}</span> </label>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table id="responsible-table" class="table table-bordered text-sm table-striped">
                        <thead>
                            <tr>  
                                <th>SL#</th>
                                <th>Date of Food Received</th>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Unit</th>
                                <th>Received Quantity</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in foodrelease_form.releaseList" :key="index">
                                <td>{{ index+1}}</td>
                                <td>
                                    <input type="date" v-model="item.dateOfreceive" value="0" @change="remove_err('dateOfreceive')" class="form-control">
                                </td>
                               
                                <td>{{item.item}}</td>
                                <td>{{item.quantity}}</td> 
                                <td>{{item.unit}}</td>
                                <td>
                                    <input type="number" v-model="item.quantityReceive" :id="'quantityReceive'+index"  @change="remove_err('quantityReceive')" class="form-control">
                                </td>
                                <td>
                                    <input type="number" v-model="item.remarks" id="remarks" @change="remove_err('remarks')" class="form-control">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div> 
            </div>
        <!--    <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="mb-0.5">Remarks:</label>
                    <textarea @change="remove_error('remarks')" class="form-control" v-model="attendance_form.remarks" :class="{ 'is-invalid': attendance_form.errors.has('remarks') }" name="remarks" id="remarks"></textarea>
                    <has-error :form="attendance_form" field="remarks"></has-error>
                </div>
            </div>-->
            <!-- <div class="card-footer text-right">
                <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
            </div> -->
        </form>
    </div>
</template>
<script>
export default {
    data(){
        return {
            screen_id:'',
            quarter: [],
            dateOfrelease:'',
            
            foodrelease_form: new form({ 
                id:'',
                releaseList:'',
                dateOfreceive:'',
                quantity:'',
                unit:'',
                quantityReceive:'',
                remarks:'',
                action_type:'edit',
            }),
        }
    },
    methods: {
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },
        formaction: function(type){
            if(type=="save"){
                this.foodrelease_form.post('mess_manage/getfoodreleasedList')
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push({name:'stockreceived_list',query: {data:this.screen_id}});
                })
                .catch(() => {
                    console.log("Error:")
                })
            }
		},
        changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="staff"){
                this.foodrelease_form.quarter=$('#quarter').val();
            }
        },
        
    },
     mounted(){
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
        this.screen_id=this.$route.query.data;
        this.foodrelease_form.id=this.$route.params.data;
        axios.get('mess_manage/loadfoodReceivedDetails/'+this.$route.params.data)
        .then(response => {
            let data = response.data.data;
            // this.attendance_form=data;
            this.foodrelease_form.releaseList = data.details;
            this.foodrelease_form.month = data.month;
            this.foodrelease_form.quarter=data.quarter;
            this.foodrelease_form.dateOfreceive=data.dateOfreceive;
           
        })
        .catch(function (error){
            console.log('Error: '+error); 
        });
        
    },
    watch: {
        releaseList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#responsible-table").DataTable()
            });
        }
    },
    
}
</script>