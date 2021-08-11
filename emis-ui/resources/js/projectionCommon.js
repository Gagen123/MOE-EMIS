try {
    Vue.mixin({
        methods: {
            loadEccdChildrens(type,dzoId){
                let uri = 'projections/projectionController/loadEccdChildren/'+type+'/'+dzoId;
                try{
                    return  axios.get(uri).then(response => { return response.data[0]});
                }catch(e){
                    console.log('error getdepartmentList '+e);
                }
            },
        },
    })

} catch (e) {
    console.log('error in main common js: '+e);
}

