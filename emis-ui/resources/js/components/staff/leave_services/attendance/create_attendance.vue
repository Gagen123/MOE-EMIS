<template>
    <div>
        <div class="form-group row bg-red" id="submitted_msg" style="display:none">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pt-1">
                <label>Your organizaiton has already submitted attendance for this month. You cannot submit agian!</label>
            </div>
        </div>
        <form id="att_form">
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label>Attendace for: <span class="text-blue">{{attendance_form.monthName}}, {{attendance_form.year}}</span></label>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Enter total Working day:<span class="text-danger">*</span></label>
                    <input type="number" id="total_work_days" onfocus="if(this.value == '0') this.value = '';" onblur="if(this.value == '') this.value = '0';" value="0"
                    @change="remove_error('total_work_days'),allocatedays()" class="form-control">
                    <span class="text-danger" id="total_work_days_err"></span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table id="responsible-table" class="table table-bordered text-sm table-striped">
                        <thead>
                            <tr>
                                <th>SL#</th>
                                <th>Name</th>
                                <th>EID</th>
                                <th>Position title</th>
                                <th>Position Level</th>
                                <th>No of day/s absent</th>
                                <th>No of day/s present</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in attendance_form.staffList" :key="index">
                                <td>{{ index+1}}</td>
                                <td>{{ item.name}}</td>
                                <td>{{ item.emp_id}}</td>
                                <td>{{ item.position_title_name}}</td>
                                <td>{{ item.positionlevel}}</td>
                                <td>
                                    <input type="number" onfocus="if(this.value == '0') this.value = '';" onblur="if(this.value == '') this.value = '0';" value="0"
                                     @change="remove_error('absentDay'+index),calculatePresentDay(index)" :id="'absentDay'+index" class="form-control">
                                     <span class="text-danger" :id="'absentDay'+index+'_err'"></span>
                                </td>
                                <td>
                                    <span :id="'presentday'+index"></span>
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
            <div class="card-footer text-right">
                <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Submit</button>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    data(){
        return {
            screen_id:'',
            months:'',
            attendance_form: new form({
                id:'',
                total_work_days:'',
                year:'',
                month:'',
                monthName:'',
                remarks:'',
                staffList:[],
                action_type:'add',
            }),
        }
    },
    methods: {
        calculatePresentDay(count){
            let valid=true;
            if($('#total_work_days').val()=="0"){
                $('#absentDay'+count).val(0);
                $('#total_work_days_err').html('Please mention total working days');
                valid=false;
            }
            if($('#total_work_days').val()!="0" && parseInt($('#absentDay'+count).val()) > parseInt($('#total_work_days').val())){
                $('#absentDay'+count+'_err').html('Absent days cannot be greater then total working days');
                $('#absentDay'+count).val(0);
                valid=false;
            }
            if(valid){
                let presentday=parseInt($('#total_work_days').val())-parseInt($('#absentDay'+count).val())
                $('#presentday'+count).html(presentday);
                this.attendance_form.staffList[count].no_absent_days=$('#absentDay'+count).val();
                this.attendance_form.staffList[count].no_present_days=presentday;
            }
        },
        allocatedays(){
            for(let i=0;i<this.attendance_form.staffList.length;i++){
                $('#presentday'+i).html($('#total_work_days').val());
            }
        },
        loadStaffList(uri='loadCommons/loadFewDetailsStaffList/userworkingagency/NA'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.attendance_form.staffList =  data;
            })
            .catch(function (error){
                console.log("Error: "+error)
            });
        },
        validated(){
            let retruntrype=true;
            if($('#total_work_days').val()=="0"){
                $('#total_work_days_err').html('Please mention total working days');
                retruntrype=false;
            }
            return retruntrype;
        },
        formaction: function(type){
            if(this.validated() && type=="save"){
                Swal.fire({
                    title: 'Are you sure you wish to submit attendance for this month ?',
                    text: "Once submitted, you cannot revert or edit details",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    cancelButtonText:'No',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        this.attendance_form.total_work_days=$('#total_work_days').val();
                        this.attendance_form.post('staff/staffServices/saveStaffAttendance')
                            .then(() => {
                            Toast.fire({
                                icon: 'success',
                                title: 'Thank you! Attendance details has been sugmitted'
                            })
                            this.$router.push({name:'list_attendance',query: {data:this.screen_id}});
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
            if(id=="staff"){
                this.attendance_form.staff=$('#staff').val();
            }
        },

    },
     mounted(){
         let currentdate = new Date();
        // let day = currentdate.getDate();
        this.attendance_form.year=(currentdate.getFullYear());
        this.attendance_form.monthName=currentdate.toLocaleString('default', { month: 'long' });
        this.attendance_form.month=(currentdate.getMonth() + 1);

        axios.get('staff/staffServices/checkAttendanceDetailsByDate/'+currentdate.getFullYear()+'/'+(currentdate.getMonth()+1))
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

        this.loadStaffList();
        this.screen_id=this.$route.query.data;
    },
    watch: {
        staffList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#responsible-table").DataTable()
            });
        }
    }
}
</script>
