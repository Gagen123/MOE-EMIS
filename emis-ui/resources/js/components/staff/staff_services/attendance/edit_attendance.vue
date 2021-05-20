<template>
    <div>
        <form>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Attendace for: <span class="text-blue">{{months[attendance_form.month]}}, {{attendance_form.year}} </span> </label>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Created By: <span class="text-blue">{{attendance_form.created_by}}</span> </label>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Created At: <span class="text-blue">{{attendance_form.created_at}}</span> </label>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table id="responsible-table" class="table table-bordered text-sm table-striped">
                        <thead>
                            <tr>  
                                <th>SL#</th>
                                <th>CID</th>
                                <th>Name</th>
                                <th>Position title</th>
                                <th>No of present day/s</th>
                                <th>No of absent day/s</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in attendance_form.staffList" :key="index">
                                <td>{{ index+1}}</td>
                                <td>{{ item.cid_work_permit}}</td>
                                <td>{{ item.name}}</td>
                                <td>{{ item.position_title}}</td>
                                <td>
                                    <input type="number" v-model="item.no_absent_days" :id="'presentDay'+index"  @change="remove_err('presentDay')" class="form-control">
                                </td>
                                <td>
                                    <input type="number" v-model="item.no_present_days" :id="'absentDay'+index" @change="remove_err('absentDay')" class="form-control">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div> 
            </div>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="mb-0.5">Remarks:</label>
                    <textarea @change="remove_error('remarks')" class="form-control" v-model="attendance_form.remarks" :class="{ 'is-invalid': attendance_form.errors.has('remarks') }" name="remarks" id="remarks"></textarea>
                    <has-error :form="attendance_form" field="remarks"></has-error>
                </div>
            </div>
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
            months:{1:'January',2:'Febuary',3:'March',4:'April',5:'May',6:'June',
            7:'July',8:'August',9:'September',10:'October',11:'November',12:'December'},
            attendance_form: new form({
                id:'',
                year:'',
                month:'',
                created_at:'',
                created_by:'',
                monthName:'',
                remarks:'',
                staffList:[],
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
                this.attendance_form.post('staff/staffServices/saveStaffAttendance')
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push({name:'list_attendance',query: {data:this.screen_id}});
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
                this.attendance_form.staff=$('#staff').val();
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
        this.attendance_form.id=this.$route.params.data;
        axios.get('staff/staffServices/loadattendanceDetails/'+this.$route.params.data)
        .then(response => {
            let data = response.data.data;
            // this.attendance_form=data;
            this.attendance_form.staffList = data.details;
            this.attendance_form.month = data.month;
            this.attendance_form.year=data.year;
            this.attendance_form.created_at=data.created_at;
            this.attendance_form.created_by=response.data.created_by;
            this.attendance_form.remarks=data.remarks;
        })
        .catch(function (error){
            console.log('Error: '+error);
        });
        
    },
    watch: {
        staffList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#responsible-table").DataTable()
            });
        }
    },
    
}
</script>