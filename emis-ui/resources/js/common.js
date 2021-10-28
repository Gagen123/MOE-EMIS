try {
    Vue.mixin({
        mounted(){
            $('.popupDatepicker').datepick({
                onSelect: function() {
                    if($('#'+$(this).attr("id")).val()!=""){
                        $('#'+$(this).attr("id")).removeClass('is-invalid');
                        $('#'+$(this).attr("id")+'_err').html('');
                    }
                    Fire.$emit('firedatechangefunction',$(this).attr('id'));
                },
                dateFormat: 'dd/mm/yyyy',
            });
        },
        methods: {

            //parameter:id-field id, type: min, max, num:number to check, btnid:action button id
            checkminmax: function (id, type,num,btnid) {
                if(type=='min' && parseInt($('#'+id).val())<num){
                    $('#'+id+'_err').html('This value cannot be less than '+num);
                    $('#'+btnid).prop('disabled',true);
                }
                else if(type=='max' && parseInt($('#'+id).val())>num){
                    $('#'+id+'_err').html('This value cannot be greater than '+num);
                    $('#'+btnid).prop('disabled',true);
                }
                else{
                    $('#'+id+'_err').html('');
                    $('#'+btnid).prop('disabled',false);
                }
            },
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
            formatDateToddmmyyyy(dateData){
                let formatteddate = new Date(dateData);
                let month=formatteddate.getMonth()+1;
                if(month.toString().length==1){
                    month='0'+month;
                }
                //formatting the date to dd/mm/yyyy
                let curr_date=formatteddate.getDate()+'/'+month+'/'+formatteddate.getFullYear();
                return curr_date;
            },

            formatYYYYMMDD(dateData){
                if(dateData!=""){
                    dateData=dateData.replaceAll('/', '-');
                    dateData=dateData.split("-").reverse().join("-");
                    let formatteddate = new Date(dateData.replaceAll('/', '-'));
                    let month=formatteddate.getMonth()+1;
                    if(month.toString().length==1){
                        month='0'+month;
                    }
                    //formatting the date to yyyy-mm-dd
                    let curr_date=formatteddate.getFullYear()+'-'+month+'-'+formatteddate.getDate();
                    return curr_date;
                }
            },
            applyselect2field(id){
                if(!$('#'+id).attr('class').includes('select2-hidden-accessible')){
                    $('#'+id).addClass('select2-hidden-accessible');
                }
            },

            remove_error(field_id){
                if($('#'+field_id).val()!=""){
                    $('#'+field_id).removeClass('is-invalid');
                    $('#'+field_id+'_err').html('');
                }
            },

            change_tab(nextclass){
                $('#tabhead >li >a').removeClass('active');
                $('#tabhead >li >a >span').addClass('bg-gradient-secondary text-white');
                $('.'+nextclass+' >a').addClass('active');
                $('.'+nextclass+' >a >span').removeClass('bg-gradient-secondary text-white');
                $('.'+nextclass+' >a').removeClass('disabled');
                $('.tab-content-details').hide();
                $('#'+nextclass).show().removeClass('fade');
                this.applyselect2();
            },

            getDepartmentListbydzo(type,dzoId){
                let uri = 'loadCommons/loadHeaquarterList/all_ministry_departments/'+type.toLowerCase();
                if(type=="DzongkhagHeadquarter"){
                    uri = 'loadCommons/loadHeaquarterList/all_ministry_departments/dzongkhag';
                }
                if(type=="Dzongkhag"){
                    uri = 'loadCommons/loadHeaquarterList/user_dzongkhag/'+dzoId;
                }
                try{
                    return  axios.get(uri).then(response => { return response.data.data});
                }catch(e){
                    console.log('error getdepartmentList '+e);
                }
            },

            loadactivedzongkhags(uri="masters/loadGlobalMasters/all_active_dzongkhag"){
                try{
                    return  axios.get(uri).then(response => { return response.data.data});
                }catch(e){
                   console.log('error loadactivedzongkhags '+e);
                }
            },

            loadgewogList(dzongkhag){
                let uri='masters/all_active_dropdowns/dzongkhag/'+dzongkhag;
                try{
                    return  axios.get(uri).then(response => { return response.data.data});
                }catch(e){
                   console.log('error loadgewogList '+e);
                }
            },

            loadvillageList(gewog){
                let uri='masters/all_active_dropdowns/gewog/'+gewog;
                try{
                    return  axios.get(uri).then(response => { return response.data.data});
                }catch(e){
                   console.log('error loadvillageList '+e);
                }
            },

            loadlocationList(){
                let uri='organization/getLocationInDropdown';
                try{
                    return  axios.get(uri).then(response => { return response.data});
                }catch(e){
                   console.log('error loadlocationList '+e);
                }
            },

            loadproposedByList(){
                let uri='masters/organizationMasterController/loadOrganizaitonmasters/active/ProposedBy';
                try{
                    return  axios.get(uri).then(response => { return response.data.data});
                }catch(e){
                   console.log('error loadproposedByList '+e);
                }
            },

            schoolList(dzo_id){
                let uri = 'loadCommons/loadOrgList/dzongkhagwise/'+dzo_id;
                try{
                    return  axios.get(uri).then(response => { return response.data.data});
                }catch(e){
                    console.log('error schoolList '+e);
                }
            },

            loadLevelList(){
                let uri = 'organization/getLevelInDropdown';
                try{
                    return  axios.get(uri).then(response => { return response.data});
                }catch(e){
                    console.log('error loadLevelList '+e);
                }
            },

            orgListUnderUserDzongkhag(){
                let uri = 'loadCommons/loadOrgList/userdzongkhagwise/NA';
                try{
                    return  axios.get(uri).then(response => { return response.data.data});
                }catch(e){
                    console.log('error orgListUnderUserDzongkhag '+e);
                }
            },
            eccdListUnderUserDzongkhag(){
                let uri = 'loadCommons/loadOrgList/all_eccds_dzogkhag_wise/eccds';
                try{
                    return  axios.get(uri).then(response => { return response.data.data});
                }catch(e){
                    console.log('error eccdListUnderUserDzongkhag '+e);
                }
            },
            schoolListUnderUserDzongkhag(){
                let uri = 'loadCommons/loadOrgList/school/schools';
                try{
                    return  axios.get(uri).then(response => { return response.data.data});
                }catch(e){
                    console.log('error schoolListUnderUserDzongkhag '+e);
                }
            },
            getClassStreamMappings(type){
                let uri = '/masters/loadClassStreamMapping/'+type;
                try{
                    return  axios.get(uri).then(response => { return response.data.data});
                }catch(e){
                    console.log('error getClassStreamMappings '+e);
                }
            },

            getdivisionList(departmentId){
                let uri = 'loadCommons/loadHeaquarterList/all_division/'+departmentId;
                try{
                    return  axios.get(uri).then(response => { return response.data.data});
                }catch(e){
                    console.log('error getdivisionList '+e);
                }
            },
            staffSchoolwise(org_id){
                let uri = 'loadCommons/loadStaffList/staffSchoolwise/'+org_id;
                try{
                    return  axios.get(uri).then(response => { return response.data.data});
                }catch(e){
                    console.log('error staffSchoolwise '+e);
                }
            },
            staffDzongkhagwise(dzo_id){
                let uri = 'loadCommons/loadStaffList/staffDzongkhagwise/'+dzo_id;
                try{
                    return  axios.get(uri).then(response => { return response.data.data});
                }catch(e){
                    console.log('error staffDzongkhagwise '+e);
                }
            },
            staffOrgwise(orgId){
                let uri = 'loadCommons/loadStaffList/staffOrgwise/'+orgId;
                try{
                    return  axios.get(uri).then(response => { return response.data.data});
                }catch(e){
                    console.log('error staffDzongkhagwise '+e);
                }
            },
            loadTeacher(dzoId){
                let uri = 'loadCommons/loadProjectionStaffList/ALL/'+dzoId;
                try{
                    return  axios.get(uri).then(response => { return response.data.data});
                }catch(e){
                    console.log('error staffDzongkhagwise '+e);
                }
            },

            loadpositionTitleList(){
                let uri = 'staff/loadStaffMasters/active/PositionTitle';
                try{
                    return  axios.get(uri).then(response => { return response.data.data});
                }catch(e){
                    console.log('error loadpositionTitleList '+e);
                }
            },
            loadactiveGlobalList(type){
                let uri = "masters/loadGlobalMasters/"+type;
                try{
                    return  axios.get(uri).then(response => { return response.data.data});
                }catch(e){
                    console.log('error loadactiveGlobalList '+e);
                }
            },
            getRequiredDocument(type){
                let uri = 'masters/organizationMasterController/loadOrganizaitonmasters/ForTransaction__'+type+'/DocumentType';
                try{
                    return  axios.get(uri).then(response => { return response.data});
                }catch(e){
                    console.log('error loadpositionTitleList '+e);
                }
            },
            getEnvValues(type){
                let uri = 'common/getEnvValues/'+type;
                try{
                    return  axios.get(uri).then(response => { return response.data});
                }catch(e){
                    console.log('error getEnvValues '+e);
                }
            },
            isvalidfile(filename) {
                if(filename!=undefined){
                    let returnt=false;
                    let fileext=this.getExtension(filename);
                    if('jpg, png, docx, pdf, xlsx'.includes(fileext.toLowerCase())){
                        returnt= true;
                    }
                    return returnt;
                }
            },
            getExtension(filename) {
                if(filename!=undefined){
                    var parts = filename.split('.');
                    return parts[parts.length - 1];
                }
            },
            validfile() {
                return 'jpg, png, docx, pdf, xlsx';
            },
            customfilevalidation(filename,filetype){
                if(filename!=undefined){
                    let returnt=false;
                    let fileext=this.getExtension(filename);
                    if(filetype.includes(fileext.toLowerCase())){
                        returnt= true;
                    }
                    return returnt;
                }
            },
            downloadsample(type){
                let uri = 'common/downloadSampleFiles/'+type;
                window.location=uri;
            }
        },
    })

} catch (e) {
    console.log('error in main common js: '+e);
}

