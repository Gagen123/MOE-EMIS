const routes = [
    { path: '/establishment_index', component: require('./components/organization/establishment/establishment_index.vue').default,
      children:[
        { path: '/',name:"establishment_index", component: require('./components/organization/establishment/estblishment_guide.vue').default },

        { path: '/eccd_approval_index',
          component: require('./components/organization/establishment/eccd/eccd_index.vue').default,
          children: [
            { path: '/', name:'eccd_approval_index', component: require('./components/organization/establishment/eccd/list_eccd.vue').default },

            { path: '/create_public_eccd',name:"create_public_eccd", component: require('./components/organization/establishment/eccd/create_public_eccd.vue').default },
            { path: '/create_private_eccd',name:"create_private_eccd", component: require('./components/organization/establishment/eccd/create_private_eccd.vue').default },
            { path: '/create_ngo_eccd',name:"create_ngo_eccd", component: require('./components/organization/establishment/eccd/create_ngo_eccd.vue').default },
            { path: '/create_coorporate_eccd',name:"create_coorporate_eccd", component: require('./components/organization/establishment/eccd/create_coorporate_eccd.vue').default },

            { path: '/list_eccd', name:'list_eccd', component: require('./components/organization/establishment/eccd/list_eccd.vue').default },
            { path: '/show_eccd',  name:'show_eccd',component: require('./components/organization/establishment/eccd/show_eccd.vue').default },
            { path: '/acknowledgement_eccd',  name:'acknowledgement_eccd',component: require('./components/organization/establishment/eccd/acknowledgement.vue').default },
          ]
        },


        { path: '/public_school_index',
          component: require('./components/organization/establishment/public_school/public_school_index.vue').default,
          children: [
            { path: '/', name:'public_school_index', component: require('./components/organization/establishment/public_school/list_public_school.vue').default },
            { path: '/list_public_school', name:'list_public_school', component: require('./components/organization/establishment/public_school/list_public_school.vue').default },
            { path: '/create_public_school',name:"create_public_school", component: require('./components/organization/establishment/public_school/create_public_school.vue').default },
            { path: '/edit_public_school',  name:'edit_public_school',component: require('./components/organization/establishment/public_school/edit_school_details.vue').default },
            { path: '/acknowledgement_public_school',  name:'acknowledgement_public_school',component: require('./components/organization/establishment/public_school/acknowledgement.vue').default },
            { path: '/show_public_school',  name:'show_public_school',component: require('./components/organization/establishment/public_school/show_public_school.vue').default },
          ]
        },
        // { path: '/public_eccd_index',
        //   component: require('./components/organization/establishment/public_eccd/public_eccd_index.vue').default,
        //   children: [
        //     { path: '/', name:'public_eccd_index', component: require('./components/organization/establishment/public_eccd/list_public_eccd.vue').default },
        //     { path: '/list_public_eccd', name:'list_public_eccd', component: require('./components/organization/establishment/public_eccd/list_public_eccd.vue').default },
        //     { path: '/create_public_eccd',name:"create_public_eccd", component: require('./components/organization/establishment/public_eccd/create_public_eccd.vue').default },
        //     { path: '/edit_public_eccd',  name:'edit_public_eccd',component: require('./components/organization/establishment/public_eccd/edit_public_eccd.vue').default },
        //     { path: '/acknowledgement_public_eccd',  name:'acknowledgement_public_eccd',component: require('./components/organization/establishment/public_eccd/acknowledgement.vue').default },
        //     { path: '/show_public_eccd',  name:'show_public_eccd',component: require('./components/organization/establishment/public_eccd/show_public_eccd.vue').default },
        //   ]
        // },

        // { path: '/private_eccd_index',
        //   component: require('./components/organization/establishment/private_eccd/private_eccd_index.vue').default,
        //   children: [
        //     { path: '/', name:'private_eccd_index', component: require('./components/organization/establishment/private_eccd/list_private_eccd.vue').default },
        //     { path: '/list_private_eccd', name:'list_private_eccd', component: require('./components/organization/establishment/private_eccd/list_private_eccd.vue').default },
        //     { path: '/create_private_eccd',name:"create_private_eccd", component: require('./components/organization/establishment/private_eccd/create_private_eccd.vue').default },
        //     { path: '/edit_private_eccd',  name:'edit_private_eccd',component: require('./components/organization/establishment/private_eccd/edit_private_eccd.vue').default },
        //     { path: '/acknowledgement_private_eccd',  name:'acknowledgement_private_eccd',component: require('./components/organization/establishment/private_eccd/acknowledgement.vue').default },
        //     { path: '/show_private_eccd',  name:'show_private_eccd',component: require('./components/organization/establishment/private_eccd/show_private_eccd.vue').default },
        //   ]
        // },

        { path: '/private_school_index',
          component: require('./components/organization/establishment/private_school/private_school_index.vue').default,
          children: [
            { path: '/', name:'private_school_index', component: require('./components/organization/establishment/private_school/list_private_school.vue').default },
            { path: '/list_private_school', name:'list_private_school', component: require('./components/organization/establishment/private_school/list_private_school.vue').default },
            { path: '/create_private_school',name:"create_private_school", component: require('./components/organization/establishment/private_school/create_private_school.vue').default },
            { path: '/edit_private_school',  name:'edit_private_school',component: require('./components/organization/establishment/private_school/edit_private_school.vue').default },
            { path: '/acknowledgement_private_school',  name:'acknowledgement_private_school',component: require('./components/organization/establishment/private_school/acknowledgement.vue').default },
            { path: '/show_private_school',  name:'show_private_school',component: require('./components/organization/establishment/private_school/show_private_school.vue').default },
          ]
        },

        { path: '/ecr_index',
            component: require('./components/organization/establishment/ecr/ecr_index.vue').default,
            children: [
            { path: '/', name:'ecr_index', component: require('./components/organization/establishment/ecr/list_ecr.vue').default },
            { path: '/list_ecr', name:'list_ecr', component: require('./components/organization/establishment/ecr/list_ecr.vue').default },
            { path: '/create_ecr',name:"create_ecr", component: require('./components/organization/establishment/ecr/create_ecr.vue').default },
            { path: '/edit_ecr',  name:'edit_ecr',component: require('./components/organization/establishment/ecr/edit_ecr.vue').default },
            { path: '/acknowledgement_ecr',  name:'acknowledgement_ecr',component: require('./components/organization/establishment/ecr/acknowledgement.vue').default },
            { path: '/show_ecr',  name:'show_ecr',component: require('./components/organization/establishment/ecr/show_ecr.vue').default },
            ]
        },
        { path: '/register',
            component: require('./components/organization/establishment/register/register_index.vue').default ,
            children: [
            { path: '/',name:'register', component: require('./components/organization/establishment/register/register_list.vue').default },
            { path: '/list_register',name:'list_register', component: require('./components/organization/establishment/register/register_list.vue').default },
            { path: '/create_register',name:'create_register', component: require('./components/organization/establishment/register/register.vue').default },
            { path: '/edit_register',name:'edit_register', component: require('./components/organization/establishment/register/edit_register.vue').default },
            ]
        },
        { path: '/headquaters_index',
            component: require('./components/organization/establishment/headquarters/headquarters_index.vue').default ,
            children: [
            { path: '/', name:'headquaters_index', component: require('./components/organization/establishment/headquarters/list_headquarters.vue').default },
            { path: '/list_headquaters',  name:'list_headquaters', component: require('./components/organization/establishment/headquarters/list_headquarters.vue').default },
            { path: '/create_headquaters',name:'create_headquaters', component: require('./components/organization/establishment/headquarters/create_headquaters.vue').default },
            { path: '/edit_headquaters',name:'edit_headquaters', component: require('./components/organization/establishment/headquarters/edit_headquarters.vue').default },
            { path: '/acknowledgement_headquarters',  name:'acknowledgement_headquarters',component: require('./components/organization/establishment/headquarters/acknowledgement.vue').default },
            ]
        },

        { path: '/establishment_acknowledgement', name:'establishment_acknowledgement', component: require('./components/organization/establishment/acknowledgement.vue').default },
      ]
    },

    { path: '/eccd_verification',  name:'eccd_verification',component: require('./components/organization/establishment/eccd/eccd_verification.vue').default },
];
export default routes
