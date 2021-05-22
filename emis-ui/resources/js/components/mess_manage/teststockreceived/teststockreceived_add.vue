<template>
    <div>
        <div class="form-group row bg-red" id="submitted_msg" style="display:none">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pt-1">
                <label>Your organizaiton has already updated Food Received for this quarter. You can only add the Pending List</label>
            </div>
        </div>
        <form id="att_form">
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label>Food Received for: <span class="text-blue">{{foodrelease_form.term}},</span></label>
                </div>
           
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label>Food Released Date: <span class="text-blue">{{foodrelease_form.dateOfrelease}},</span></label>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table id="responsible-table" class="table table-bordered text-sm table-striped">
                        <thead>
                            <tr>
                                <th>SL#</th>
                                <th>Date of Food Received</th>
                                <th>Item Released</th>
                                <th>Quantity Released</th>
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
                                <td>{{ item.item}}</td>
                                <td>{{ item.quantity}}</td>
                                <td>{{ item.unit}}</td>
                                <td>
                                    <input type="number" v-model="item.quantityReceive" value="0" @change="remove_err('quantityReceive')" class="form-control">
                                </td>
                                <td>
                                    <input type="text" v-model="item.remarks" value="0" @change="remove_err('remarks')" class="form-control">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div> 
            </div>
         <!--   <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="mb-0.5">Remarks:</label>
                    <textarea @change="remove_error('remarks')" class="form-control" v-model="attendance_form.remarks" :class="{ 'is-invalid': attendance_form.errors.has('remarks') }" name="remarks" id="remarks"></textarea>
                    <has-error :form="attendance_form" field="remarks"></has-error>
                </div>
            </div>-->
            <div class="card-footer text-right">
                <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Update</button>
            </div>
        </form>
    </div>
</template>
<script> 
export default {
    data(){ 
        return {
            screen_id:'',
            term:'',
            dateOfrelease:'',
            foodrelease_form: new form({
                id:'',
                dateOfreceive:'',
                item:'',
                remarks:'',
                quantity:'',
                unit:'',
                quantityReceive:'',
                releaseList:[],
                action_type:'add',
            }),
        } 
    },
    methods: {
        
        getfoodreleaseditemList(foodreleaseId) {
            let uri='mess_manage/getfoodreleaseditemList/'+foodreleaseId;
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.foodrelease_form.releaseList =  data;
            }) 
            .catch(function (error){
                console.log("Error: "+error)
            });
        },
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },
        formaction: function(type){
            if(type=="save"){
                Swal.fire({
                    title: 'Are you sure you wish to update Food Received for this quarter ?',
                    text: "Once submitted, you cannot revert or edit details",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, I confirm!',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        this.foodrelease_form.post('mess_manage/saveFoodReceived')
                            .then(() => {
                            Toast.fire({
                                icon: 'success',
                                title: 'Food Received has been updated'
                            })
                            this.$router.push({name:'stockreceived_list',query: {data:this.screen_id}});
                        })
                        .catch(() => {
                            console.log("Error:")
                        })
                    }
                }); 
                
            }
		},
        changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="term"){
                this.foodrelease_form.term=$('#term').val();
            }
        },
        
    },
     mounted(){
        this.foodrelease_form.term=this.$route.params.data.quarter_id;

        axios.get('mess_manage/getfoodreleasedetailbyquarter/'+this.quarter_id+ '/' +this.foodreleaseId)
        .then(response => {
            let data = response.data.data;
            if(data!=null){
                $('#att_form').hide();
                $('#submitted_msg').show();
            }
        })
        .catch(function (error){
            console.log('Error: '+error);
        });
        
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

        this.getfoodreleaseditemList();
        this.screen_id=this.$route.query.data;
    },
    watch: {
        releaseList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#responsible-table").DataTable()
            });
        }
    }
}
</script>