const global_routes = [ 
    { path:'/global_master',
    component: require('./components/masters/global_masters/global_master_index.vue').default, 
    children:[
    { path: '/',name:'global_master', component: require('./components/masters/global_masters/global_masters_list.vue').default },
    { path: '/nationality_master', 
        component: require('./components/masters/global_masters/nationality/nationality_index.vue').default,
        children:[
        { path: '/',name:'nationality_master', component: require('./components/masters/global_masters/nationality/nationality_list.vue').default },
        { path: '/list_nationality',name:'list_nationality', component: require('./components/masters/global_masters/nationality/nationality_list.vue').default },
        { path: '/create_nationality',name:'create_nationality', component: require('./components/masters/global_masters/nationality/create_nationality.vue').default },
        { path: '/edit_nationality', name:'edit_nationality', component: require('./components/masters/global_masters/nationality/edit_nationality.vue').default },
        ],
    },
    { path: '/dzongkhag_master', 
        component: require('./components/masters/global_masters/dzongkhag/dzongkhag_master.vue').default,
        children:[
        { path: '/',name:'dzongkhag_master', component: require('./components/masters/global_masters/dzongkhag/list_dzongkhag_master.vue').default },
        { path: '/list_dzongkhag',name:'list_dzongkhag', component: require('./components/masters/global_masters/dzongkhag/list_dzongkhag_master.vue').default },
        { path: '/create_dzongkhag', name:'create_dzongkhag', component: require('./components/masters/global_masters/dzongkhag/create_dzongkhag.vue').default },
        { path: '/edit_dzongkhag', name:'edit_dzongkhag', component: require('./components/masters/global_masters/dzongkhag/edit_dzongkhag.vue').default },
        ],
    },
    
    { path: '/gewog_master', 
        component: require('./components/masters/global_masters/gewog/gewog_index.vue').default,
        children:[
        { path: '/',name:'gewog_master', component: require('./components/masters/global_masters/gewog/list_gewog.vue').default },
        { path: '/list_gewog',name:'list_gewog', component: require('./components/masters/global_masters/gewog/list_gewog.vue').default },
        { path: '/create_gewog', name:'create_gewog', component: require('./components/masters/global_masters/gewog/create_gewog.vue').default },
        { path: '/edit_gewog', name:'edit_gewog', component: require('./components/masters/global_masters/gewog/edit_gewog.vue').default },
        ],
    },
    
    { path: '/village_master', 
        component: require('./components/masters/global_masters/village/village_index.vue').default,
        children:[
        { path: '/',name:'village_master', component: require('./components/masters/global_masters/village/list_village.vue').default },
        { path: '/list_village',name:'list_village', component: require('./components/masters/global_masters/village/list_village.vue').default },
        { path: '/create_village', name:'create_village', component: require('./components/masters/global_masters/village/create_village.vue').default },
        { path: '/edit_village', name:'edit_village', component: require('./components/masters/global_masters/village/edit_village.vue').default },
        ],
    },
    
    { path: '/gender_master', 
        component: require('./components/masters/global_masters/gender/gender_index.vue').default,
        children:[
        { path: '/',name:'gender_master', component: require('./components/masters/global_masters/gender/list_gender.vue').default },
        { path: '/list_gender',name:'list_gender', component: require('./components/masters/global_masters/gender/list_gender.vue').default },
        { path: '/create_gender', name:'create_gender', component: require('./components/masters/global_masters/gender/create_gender.vue').default },
        { path: '/edit_gender', name:'edit_gender', component: require('./components/masters/global_masters/gender/edit_gender.vue').default },
        ], 
    },
    { path: '/mother_tongue_master', 
        component: require('./components/masters/global_masters/mother_tongue/mother_tongue_index.vue').default,
        children:[
        { path: '/',name:'mother_tongue_master', component: require('./components/masters/global_masters/mother_tongue/list_mother_tongue.vue').default },
        { path: '/list_mother_tongue',name:'list_mother_tongue', component: require('./components/masters/global_masters/mother_tongue/list_mother_tongue.vue').default },
        { path: '/create_mother_tongue', name:'create_mother_tongue', component: require('./components/masters/global_masters/mother_tongue/create_mother_tongue.vue').default },
        { path: '/edit_mother_tongue', name:'edit_mother_tongue', component: require('./components/masters/global_masters/mother_tongue/edit_mother_tongue.vue').default },
        ], 
    },
    ]
}
];
export default global_routes
