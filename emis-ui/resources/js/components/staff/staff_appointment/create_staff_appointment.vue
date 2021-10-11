<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-body pt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="personal-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="callout callout-success">
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-1">Year:<i class="text-danger">*</i></label>
                                    <input type="text" v-model="Year" class="form-control" name="Year" id="Year">
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
                                            <th>Apointment Date</th>
                                            <th>CID</th>
                                            <th>Contract End Date</th>
                                            <th>Emp Id</th>
                                            <th>Employee Type</th>
                                            <th>First Name</th>
                                            <th>Middle Name</th>
                                            <th>Last Name</th>
                                            <th> Master Group</th>
                                            <th> Position</th>
                                            <th> RCSC Selected</th>
                                            <th>Full Working Agency</th>
                                            <th>Sub Group</th>
                                            <th>Super Structure</th>
                                            <th>Work Agency Top Node</th>
                                            <th>positionLevel</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) in staffList" :key="index">
                                            <td>{{ item.ApointmentDate}}</td>
                                            <td>{{ item.CID}}</td>
                                            <td>{{ item.ContractEndDate}}</td>
                                            <td>{{ item.EmpID}}</td>
                                            <td>{{ item.EmployeeType}}</td>
                                            <td>{{ item.FirstName}}</td>
                                            <td>{{ item.MiddleName}}</td>
                                            <td>{{ item.LastName}}</td>
                                            <td>{{ item.MasterGroup}}</td>
                                            <td>{{ item.Position}}</td>
                                            <td>{{ item.RCSCSelected}}</td>
                                            <td>{{ item.FullWorkingAgency}}</td>
                                            <td>{{ item.SubGroup}}</td>
                                            <td>{{ item.SuperStructure}}</td>
                                            <td>{{ item.WorkAgencyTopNode}}</td>
                                            <td>{{ item.positionLevel}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" @click="saveappointment()"> <i class="fa fa-save"></i>Save </button>
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
            dt:'',
            staffList:[],
            form: new form({
                staffList:[],
                Year:'',
            }),
        }
    },
    methods: {
        fetchstaff(){
            let year=$('#Year').val();
            if (year!= ""){
                this.form.Year=year;
                axios.get('staff/zest/getAppointment/'+ year)
                .then(response => {
                    let detail = response.data;
                    this.form.staffList=detail;
                    this.staffList=detail;
                })
                .catch((e) => {
                    Swal.fire({
                        html: "No data found for this input "+e,
                        icon: 'error'
                    });
                });
            }
        },
        saveappointment: function(type){
            Swal.fire({
                text: "Are you sure you wish to save this staff details ?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
                }).then((result) => {
                if (result.isConfirmed) {
                    this.form.post('staff/zest/saveAppointmentDetails')
                    .then(() => {
                        Toast.fire({
                            icon: 'success',
                            title: 'Details added successfully'
                        })
                        this.$router.push('/list_staff_appointment');
                    })
                    .catch(() => {
                        console.log("Error:")
                    })
                }
            });
		},
    },
    async mounted() {
        Fire.$on('changefunction',(id)=> {
            this.changefunction(id);
        });
        this.dt =  $("#data-table").DataTable();
    },
    watch: {
        staffList(){
            this.applydatatable('training-table');
        }
    },
}
</script>
