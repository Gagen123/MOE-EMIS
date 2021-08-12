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
            schoolList(dzo_id){
                let uri = 'loadCommons/loadOrgList/dzongkhagwise/'+dzo_id;
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

        },
    })

} catch (e) {
    console.log('error in main common js: '+e);
}

