<template>
    <div>
        <form>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label>Attendace for: <span class="text-blue">{{attendance_form.monthName}}, {{attendance_form.year}}</span></label>
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
                                    <input type="number" v-model="item.no_absent_days" value="0" @change="remove_err('presentDay')" class="form-control">
                                </td>
                                <td>
                                    <input type="number" v-model="item.no_present_days" value="0" @change="remove_err('absentDay')" class="form-control">
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
                <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
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
        
        loadStaffList(uri='loadCommons/loadFewDetailsStaffList/userdzongkhagwise/NA'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.attendance_form.staffList =  data;
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
         let currentdate = new Date();
        // let day = currentdate.getDate();
        this.attendance_form.year=(currentdate.getFullYear());
        this.attendance_form.monthName=currentdate.toLocaleString('default', { month: 'long' });
        this.attendance_form.month=(currentdate.getMonth() + 1);

        axios.get('staff/staffServices/checkAttendanceDetailsByDate/'+currentdate.getFullYear()+'/'+currentdate.getMonth() + 1)
        .then(response => {
            let data = response.data.data;
            // this.attendance_form=data;
            this.attendance_form.staffList = data.details;
            this.attendance_form.month = data.month;
            this.attendance_form.year=data.year;
            this.attendance_form.remarks=data.remarks;
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
    },
    
}
</script>