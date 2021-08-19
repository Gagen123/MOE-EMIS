try {
    Vue.mixin({
        methods: {
            loadEccdChildrens(type,dzoId){
                let uri = 'projections/projectionController/loadEccdChildren/'+type+'/'+dzoId;
                try{
                    return  axios.get(uri).then(response => { return response.data});
                }catch(e){
                    console.log('error getdepartmentList '+e);
                }
            },
            loadTeacher(type,dzoId){
                let uri = 'loadCommons/loadProjectionStaffList/'+type+'/'+dzoId;
                try{
                    return  axios.get(uri).then(response => { return response.data});
                }catch(e){
                    console.log('error staffDzongkhagwise '+e);
                }
            },

            loadStudents(dzoId){
                let uri = 'projections/projectionController/loadStudents/'+dzoId;
                try{
                    return  axios.get(uri).then(response => { return response.data});
                }catch(e){
                    console.log('error getdepartmentList '+e);
                }
            },
            loadeducationCenter(type,dzoId){
                let uri = 'projections/OrgProjectionController/loadOrgListProjection/'+type+'/'+dzoId;
                try{
                    return  axios.get(uri).then(response => { return response.data.data});
                }catch(e){
                    console.log('error getdepartmentList '+e);
                }
            }, 
            loadClassSize(type,dzoId){
                let uri = 'projections/OrgProjectionController/loadClassSize/'+type+'/'+dzoId;
                try{
                    return  axios.get(uri).then(response => { return response.data.data});
                }catch(e){
                    console.log('error getdepartmentList '+e);
                }
            },
           
            
        },
    })

} catch (e) {
    console.log('error in main common js: '+e);
}

