<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-body pt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="personal-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="callout callout-success">
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">From Year:<i class="text-danger">*</i></label>
                                    <input type="text" @change="remove_error('cid_work_permit')" class="form-control" name="cid_work_permit" id="cid_work_permit">
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-1">To Year:<i class="text-danger">*</i></label>
                                    <input type="text" @change="remove_error('cid_work_permit')" class="form-control" name="cid_work_permit" id="cid_work_permit">
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pt-4 mt-1">
                                    <button type="button" class="btn btn-sm btn-primary" @click="fetchstaff()"><i class="fa fa-download"></i> Fetch</button>
                                </div>
                            </div>
                            <hr>
                            <span class="text-blue"><label><u>List of Staff</u></label></span>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 overflow-auto">
                                <table id="training-table" class="table table-sm table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Category/ Desciption</th>
                                            <th>Doner Agency</th>
                                            <th>Project Doner Agency</th>
                                            <th>Field/Typ</th>
                                            <th>Degree/level</th>
                                            <th>First Subject</th>
                                            <th>Second subject</th>
                                            <th>Course Mode/Type</th>
                                            <th>Course Title</th>
                                            <th>Country</th>
                                            <th>Institute</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Remarkse</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) in staffList" :key="index">
                                            <td>{{ item.categoryname}}</td>
                                            <td>{{ item.doneragencyname}}</td>
                                            <td>{{ item.projectdoneragencyname}}</td>
                                            <td>{{ item.fieldname}}</td>
                                            <td>{{ item.degreename}}</td>
                                            <td>{{ item.sub1name}}</td>
                                            <td>{{ item.sub2name}}</td>
                                            <td>{{ item.coursemodename}}</td>
                                            <td>{{ item.coursetitle}}</td>
                                            <td>{{ item.country.country_name}}</td>
                                            <td>{{ item.institutename}}</td>
                                            <td>{{ item.startdate}}</td>
                                            <td>{{ item.enddate}}</td>
                                            <td>{{ item.remarks}}</td>
                                            <td>
                                                <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)">Edit</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" @click="shownexttab('final-tab')"> <i class="fa fa-save"></i>Save </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return {
            sex_idList:[],
            staffList:[],
        }
    },
    methods: {
        fetchstaff(){
            let cid_empid=$('#cideid').val();
            if (cid_empid!= ""){
                axios.get('staff/getEmployeeDetials/'+ this.personal_form.emp_type+'/'+cid_empid)
                .then(response => {
                    this.ciderror = '';
                    let detail = response.data;
                    if (detail!=""){
                        this.personal_form.cid_work_permit=detail.cidNumber;
                        this.personal_form.emp_id=detail.employeeNumber;
                        let fullname=detail.firstName;
                        if(detail.middleName!=""){
                            fullname=fullname+' '+detail.middleName;
                        }
                        if(detail.lastName!=""){
                            fullname=fullname+' '+detail.lastName;
                        }
                        this.personal_form.name= fullname;
                        let dob=detail.dateOfBirth;
                        if(dob.includes('-')){
                            dob=dob.split('-')[2]+'-'+dob.split('-')[1]+'-'+dob.split('-')[0];
                        }
                        if(dob.includes('/')){
                            dob=dob.split('/')[2]+'-'+dob.split('/')[1]+'-'+dob.split('/')[0];
                        }
                        this.personal_form.dob=dob;
                        this.personal_form.email=detail.Email;
                        this.personal_form.initial_appointment_date=detail.dateOfAppointment;

                        this.personal_form.contact_number=detail.MobileNo;
                        axios.get('getpersonbycid/'+ detail.cidNumber)
                        .then(response => {
                            this.ciderror = '';
                            let personal_detail = response.data;
                            this.personal_form.p_dzongkhag=personal_detail.dzongkhagId;
                            let gen='Others';
                            if(personal_detail.gender=='M'){
                                gen='Male';
                            }
                            if(personal_detail.gender=='F'){
                                gen='Female';
                            }
                            this.personal_form.sex_id=this.sex_Array[gen];
                            $('#sex_id').val(this.sex_Array[gen]).trigger('change');

                            $('#p_dzongkhag').val(personal_detail.dzongkhagId).trigger('change');
                            $('#p_dzongkhag').prop('disabled',true);
                            $('#dob').prop('disabled',true);
                            $('#sex_id').prop('disabled',true);
                            $('#cid_work_permit').prop('disabled',true);
                            $('#name').prop('disabled',true);
                            this.getPgewoglist(personal_detail.dzongkhagId,personal_detail.gewogId);
                            this.getPvillagelist(personal_detail.gewogId,personal_detail.villageSerialNo);
                        })
                    }else{
                        this.ciderror = 'Invalid CID.';
                        Swal.fire({
                            html: "No data found for matching CID",
                            icon: 'info'
                        });
                    }

                })
                .catch((e) => {
                    this.ciderror = 'Invalid CID / service down.';
                    Swal.fire({
                        html: "No data found for this eid "+e,
                        icon: 'error'
                    });
                });
            }
        },
    },
    async mounted() {
        Fire.$on('changefunction',(id)=> {
            this.changefunction(id);
        });
    },

}
</script>
