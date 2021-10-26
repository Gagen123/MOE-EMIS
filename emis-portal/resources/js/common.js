try {
    Vue.mixin({
        methods: {
            reverseDate(dateData){
                const reverse =
                dateData.split("-").reverse().join("-");
                return reverse;
            },
            reverseDate1(dateData){
                if(dateData!="" && dateData!=undefined){
                    const reverse = dateData.split("-").reverse().join("/");
                    return reverse;
                }
            },
            reverseDateTime(dateData){
                if(dateData!="" && dateData!=undefined){
                    reverse = dateData.split(" ")[0].split("-").reverse().join("/")+' '+dateData.split(" ")[1];
                    return reverse;
                }
            },

            remove_error(field_id){
                if($('#'+field_id).val()!=""){
                    $('#'+field_id).removeClass('is-invalid');
                    $('#'+field_id+'_err').html('');
                }
            },
        },
    })

} catch (e) {
    console.log('error in main common js: '+e);
}

