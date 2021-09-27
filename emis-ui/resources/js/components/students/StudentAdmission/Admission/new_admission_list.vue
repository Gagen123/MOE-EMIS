<template>
    <div>
        <table id="list-student-left" class="table table-bordered table-striped table-head-fixed">
            <thead>
                <tr>
                     <th >No.</th>
                     <th >Student Code</th>
                     <th >Student Name</th>
                     <th >CID</th>
                     <th >Gender</th>
                     <th >Type of Admission</th>
                     <th >School Decision</th>
                     <th >Student Decision</th>
                     <th >Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- <tr v-for="(std, index) in stdList" :key="index">
                    <td>{{ index + 1 }} </td>
                    <td>{{ std.student_code }}</td>
                    <td>{{ std.Name }}</td>
                    <td>{{ std.CidNo }}</td>
                    <td>{{ sex_idList[std.CmnSexId] }} </td>
                    <td>Transfer Student</td>
                    <td></td>
                    <td></td>

                    <td>
                        <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="loadeditpage('transfer',std.id)"><span clas="fa fa-edit"></span>Admit</a>
                    </td>
                </tr> -->
                <tr v-for="(std, count) in newAdmissionList" :key="count">
                    <td>{{ count + 1 }} </td>
                    <td>{{ std.admisiondet.student_code}}</td>
                    <td>{{ std.admisiondet.FirstName }} {{ std.admisiondet.LastName }} {{std.admisiondet.Name}} </td>
                    <td>{{ std.admisiondet.CidNo }}</td>
                    <td>{{ sex_idList[std.admisiondet.CmnSexId] }} </td>
                    <td>{{ std.admisiondet.student_code ? "Transfer" : "New Admission"}}</td>
                    <td>{{ std.school_decision }} </td>
                    <td>{{ std.student_decision }} </td>
                    <!-- <td>
                        <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="loadeditpage('admission',std.id)"><span clas="fa fa-edit"></span>Veiw/Update</a>
                    </td> -->
                    <td>
                        <a href="#" class="btn bg-orange btn-sm btn-flat text-white" @click="loadviewpage(std.admisiondet.id, std.admisiondet.student_code)"><span clas="fa fa-edit"></span>Veiw</a>
                        <a v-if="(std.student_decision !== 'Accepted') || (std.school_decision !== 'Accepted')" href="#" class="btn btn-success btn-sm btn-flat text-white" @click="loadeditpage('Accepted',std.id)"><span clas="fa fa-edit"></span>Accept</a>
                        <a v-else href="#" class="btn btn-primary btn-sm btn-flat text-white" @click="loadeditpage('admission',std.admisiondet.id, std.admisiondet.student_code)"><span clas="fa fa-edit"></span>Admit</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    components: {
    },
    data() {
        return {
            dt:'',
            stdList:[],
            newAdmissionList:[],
            sex_idList:{},

            student_form: new form({
                id:'',
                actionType:'',
            }),
        }
    },
    methods: {
        loadAllActiveMasters(type){
            axios.get('masters/loadGlobalMasters/'+type)
            .then(response =>{
                let data = response;
                if(type=="all_active_gender"){
                    for(let i=0;i<data.data.data.length;i++){
                        this.sex_idList[data.data.data[i].id] = data.data.data[i].name;
                    }
                }
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        addrecords: function(){
            let tablestr="";
            this.count++;
            let today = new Date();
            let dd = String(today.getDate()).padStart(2, '0');
            let mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            let yyyy = today.getFullYear();
            today =   yyyy+'-'+mm+'-'+dd;
            tablestr="<tr id='record"+this.count+"'><td>"+this.count+"</td><td>"+$('#newlevelname').val()+"</td><td><span class='label label-success label-sm'>Active</span></td><td>"+today+"</td><td> <button class='btn btn-primary btn-xs'><i class='fa fa-edit'></i> Edit</button><button class='btn btn-danger btn-xs'><i class='fa fa-trash'></i> Delete</button></td></tr>";
            $('#dynamic-table').append(tablestr);
            $('#samplemodal').modal('hide');
        },
        loadviewpage(id, std_code){
            let data = {
                id: id,
                std_code: std_code
            }
            this.$router.push({name:'view_new_student_details',params: {data:data}});
        },

        loadeditpage(type,id, std_code){
            this.student_form.id = id;
            if(type=="admission"){
                    let data = {
                    id: id,
                    std_code: std_code
                }
                this.$router.push({name:'admit_new_student',params: {data:data}});
                // this.student_form.post('students/admission/updateStudentAdmission',this.student_form)
                // .then((response) => {
                //     Toast.fire({
                //         icon: 'success',
                //         title: 'Data saved Successfully'
                //     });
                // })
                // .catch((error) => {
                //     console.log("Error:"+error)
                // });
            }
            else if(type=="Accepted"){
                this.student_form.actionType=type;
                this.student_form.post('students/admission/updateStudentAdmission',this.student_form)
                .then((response) => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data saved Successfully'
                    });
                    this.loadStudentAdmissionList('session');
                })
                .catch((error) => {
                    console.log("Error:"+error)
                });
            }
            else{
                this.student_form.post('students/admission/updateStudentTransfer',this.student_form)
                .then((response) => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data saved Successfully'
                    });
                })
                .catch((error) => {
                    console.log("Error:"+error)
                });

            }
        },
        // loadStudentList(param){
        //     this.stdList =[];
        //     let uri="";
        //     uri='students/admission/loadStudentList/transfered';
        //     axios.get(uri)
        //     .then(response => {
        //         let data = response.data;
        //         this.stdList = data.data;
        //     });
        // },
        loadStudentAdmissionList(param){
            this.newAdmissionList =[];
            let uri="";
            uri='students/admission/loadStudentList/admission';
            axios.get(uri)
            .then(response =>{
                let data = response.data;
                this.newAdmissionList = data;
            });
        },
        getorgProfile(org_id){
            axios.get('loadCommons/loadOrgDetails/fullOrgDetbyid/'+org_id)
            .then(response => {
                let response_data=response.data.data;
                this.orgDetails=response_data;

            })
            .catch((error) => {
                console.log("Error: "+error);
            });
        },

    },
    mounted() {
        this.loadAllActiveMasters('all_active_gender');
        this.dt = $("#list-student-left").DataTable();
        // this.loadStudentList('session');
        this.loadStudentAdmissionList('session');
        // $("#list-student-left").DataTable({
        //     "responsive": true,
        //     "autoWidth": false,
        // });
        // $('.dataTables_filter').addClass('fa-pull-right');
        // $('#student-table_paginate').addClass('fa-pull-right');
        axios.get('common/getSessionDetail')
        .then(response =>{
            let data = response.data.data;
            this.form.org_id=data['Agency_Code'];
            this.getorgProfile(data['Agency_Code']);
        })
        .catch(errors =>{
            console.log(errors)
        });
    },
    watch: {
        newAdmissionList(val){
            this.dt.destroy();
            this.$nextTick(()=>{
                this.dt = $("#list-student-left").DataTable();
            });
        }
    },
}
</script>
