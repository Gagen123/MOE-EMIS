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
                    console.log('error loadLevelList '+e);
                }
            },
        },
    })

} catch (e) {
    console.log('error in main common js: '+e);
}

