try {
    Vue.mixin({
        methods: {
            applydatatable(id){
                this.dt.destroy();
                this.$nextTick(() => {
                    this.dt =  $("#"+id).DataTable();
                    $("#"+id+" >tbody >tr >td ").addClass('p-1');
                    $(".paginate_button").addClass('small');
                });
            },

            loadStudentMasters(type,model){
                let uri = 'masters/loadStudentMasters/'+type+'/'+model;
                try{
                    return  axios.get(uri).then(response => {
                     return response.data.data});
                }catch(e){
                    console.log('error loadLevelList '+e);
                }
            },

            loadActiveAwardList(uri='masters/loadActiveStudentMasters/StudentAwardType'){
                axios.get(uri)
                .then(response => {
                    let data = response;
                    this.awardList =  data.data.data;
                })
                .catch(function (error) {
                    console.log("Error......"+error)
                });
            },
            loadActiveOffenceList(uri="masters/loadActiveStudentMasters/OffenceSeverity"){
                axios.get(uri)
                .then(response => {
                    let data = response;
                    this.offenceSeverity =  data.data.data;
                })
                .catch(function (error) {
                    console.log("Error......"+error)
                });
            },
            loadMeasurementList(uri = 'masters/loadActiveStudentMasters/CeaProgramMeasurement'){
                axios.get(uri)
                .then(response => {
                    let data = response;
                    this.measurementList =  data.data.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },


            loadActiveProgramList(uri="masters/loadActiveStudentMasters/CeaProgram"){
                axios.get(uri)
                .then(response => {
                    let data = response;
                    this.programList =  data.data;
                })
                .catch(function (error) {
                    console.log("Error......"+error)
                });
            },
            submitstudentmaster(list_route){
                Swal.fire({
                    title: 'Are you sure you wish to submit this form ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    }).then((result) =>{
                    if (result.isConfirmed){
                        this.form.post('masters/saveStudentMasters',this.form)
                        .then((response) =>{
                            Toast.fire({
                            icon: 'success',
                            title: 'Details added successfully'
                        })
                        this.$router.push('/'+list_route);
                        })
                        .catch((error) => {
                            console.log("Error:"+e);
                        })
                    }
                })
            }
        },
    })

} catch (e) {
    console.log('error in main common js: '+e);
}

