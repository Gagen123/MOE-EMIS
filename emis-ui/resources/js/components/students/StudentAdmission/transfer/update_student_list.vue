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
                     <th >Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(std, index) in stdList" :key="index">
                    <td>{{ index + 1 }} </td>
                    <td>{{ std.student_code }}</td>
                    <td>{{ std.Name }}</td>
                    <td>{{ std.CidNo }}</td>
                    <td>{{ sex_idList[std.CmnSexId] }}</td>
                    <td>Transfer Student</td>
                    <td>
                        <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="loadeditpage(std.id)"><span clas="fa fa-edit"></span>Veiw/Update</a>
                    </td>
                </tr>
                <tr v-for="(std, index) in newAdmissionList" :key="index">
                    <td>{{ index + 1 }} </td>
                    <td>{{ }}</td>
                    <td>{{ std.first_name }} {{ std.last_name }} </td>
                    <td>{{ std.CidNo }}</td>
                    <td>{{ sex_idList[std.CmnSexId] }}</td>
                    <td>New Admission</td>
                    <td>
                        <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="loadeditpage(std.id)"><span clas="fa fa-edit"></span>Veiw/Update</a>
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
        
        loadeditpage(id){
            this.$router.push({name:'update_student_transfer',params: {data:id}});
        },
        loadStudentList(param){
            this.stdList =[];
            let uri="";
            uri='students/admission/loadStudentList/transfered';
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.stdList = data.data;
            });
        },
        loadStudentAdmissionList(param){
            this.newAdmissionList =[];
            let uri="";
            uri='students/admission/loadStudentList/admission';
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.newAdmissionList = data;
            });
        },
    
    },
    mounted() {
        this.dt = $("#list-student-left").DataTable();
        this.loadStudentList('session');
        this.loadStudentAdmissionList('session');
        this.loadAllActiveMasters('all_active_gender');

        // $("#list-student-left").DataTable({
        //     "responsive": true,
        //     "autoWidth": false,
        // }); 
        // $('.dataTables_filter').addClass('fa-pull-right');
        // $('#student-table_paginate').addClass('fa-pull-right');
    },
    watch: {
        stdList(val){
            this.dt.destroy();
            this.$nextTick(()=>{
                this.dt = $("#list-student-left").DataTable();
            });
        }

    },
}
</script>