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
            loadstaffMasters(type,model){
                let uri = 'staff/loadStaffMasters/'+type+'/'+model;
                try{
                    return  axios.get(uri).then(response => { return response.data.data});
                }catch(e){
                    console.log('error loadstaffMasters '+e);
                }
            },
            submitstaffmaster(list_route){
                Swal.fire({
                    title: 'Are you sure you wish to submit this form ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    }).then((result) =>{
                    if (result.isConfirmed){
                        this.form.post('staff/saveStaffMasters',this.form)
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
            },

            loadstaffMasterconfig(type,model){
                let uri = 'staff/loadConfigMasters/'+type+'/'+model;
                try{
                    return  axios.get(uri).then(response => { return response.data.data});
                }catch(e){
                    console.log('error loadConfigMasters '+e);
                }
            },

            submitstaffmasterconfig(list_route){
                Swal.fire({
                    title: 'Are you sure you wish to submit this form details ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    }).then((result) =>{
                    if (result.isConfirmed){
                        this.form.post('staff/saveConfigMasters',this.form)
                        .then((response) =>{
                            Toast.fire({
                            icon: 'success',
                            title: 'Details updated successfully'
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

