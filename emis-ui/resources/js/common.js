try {
    Vue.mixin({
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
                   console.log('error loadactivedzongkhags '+e);
                }
            },

            loadvillageList(gewog){
                let uri='masters/all_active_dropdowns/gewog/'+gewog;
                try{
                    return  axios.get(uri).then(response => { return response.data.data});
                }catch(e){
                   console.log('error loadactivedzongkhags '+e);
                }
            },

            loadlocationList(){
                let uri='organization/getLocationInDropdown';
                try{
                    return  axios.get(uri).then(response => { return response.data});
                }catch(e){
                   console.log('error loadactivedzongkhags '+e);
                }
            },

            loadproposedByList(){
                let uri='masters/organizationMasterController/loadOrganizaitonmasters/active/ProposedBy';
                try{
                    return  axios.get(uri).then(response => { return response.data.data});
                }catch(e){
                   console.log('error loadactivedzongkhags '+e);
                }
            },

            schoolList(dzo_id){
                let uri = 'loadCommons/loadOrgList/dzongkhagwise/'+dzo_id;
                try{
                    return  axios.get(uri).then(response => { return response.data.data});
                }catch(e){
                    console.log('error loadactivedzongkhags '+e);
                }
            },

            schoolListUnderUserDzongkhag(){
                let uri = 'loadCommons/loadOrgList/userdzongkhagwise/NA';
                try{
                    return  axios.get(uri).then(response => { return response.data.data});
                }catch(e){
                    console.log('error loadactivedzongkhags '+e);
                }
            },
            getClassStreamMappings(type){
                let uri = '/masters/loadClassStreamMapping/'+type;
                try{
                    return  axios.get(uri).then(response => { return response.data.data});
                }catch(e){
                    console.log('error loadactivedzongkhags '+e);
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
            getRequiredDocument(type){
                let uri = 'masters/organizationMasterController/loadOrganizaitonmasters/ForTransaction__'+type+'/DocumentType';
                try{
                    return  axios.get(uri).then(response => { return response.data});
                }catch(e){
                    console.log('error loadpositionTitleList '+e);
                }
            }

        },
    })

} catch (e) {
    console.log('error in main common js: '+e);
}

