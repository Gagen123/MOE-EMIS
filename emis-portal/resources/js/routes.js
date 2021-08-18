export default [
    { path: '/admissionRequest', component: require('./components/admissions/requestadmission.vue').default },
    // { path: '/chage_password', component: require('./components/profile/change_password.vue').default },

    { path: '/track_application', component: require('./components/admissions/track_application.vue').default },
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/userprofile', component: require('./components/Profile/Userprofile.vue').default },
    { path: '/result', component: require('./components/results/result.vue').default },
    { path: '/classxi_student', name:'classxi_student', component: require('./components/admissions/classxi_student.vue').default },
    // { path: '*', component: require('./components/NotFound.vue').default },

    { path: '/new_admission_page',name:'new_admission_page', component: require('./components/new_admission_transfer/new_registration_for_admission.vue').default },
    { path: '/admission_initiated',name:'admission_initiated', component: require('./components/admissions/admission_initiated.vue').default },
    { path: '/new_application', name:'new_application', component: require('./components/admissions/new_application.vue').default },
    { path: '/acknowledgement',name:'acknowledgement', component: require('./components/admissions/acknowledgement.vue').default },

    { path: '/admission',  name:'admission',  component: require('./components/admissions/admission.vue').default ,
        children:[
            { path: '/notenrolled_student',name:'notenrolled_student', component: require('./components/admissions/notenrolled_student.vue').default },
            { path: '/enrolled_student',name:'enrolled_student', component: require('./components/admissions/enrolled_student.vue').default },
            { path: '/admission_initiated',name:'admission_initiated', component: require('./components/admissions/admission_initiated.vue').default },
        ]
    },

    { path: '/admission_transfer_index', component: require('./components/new_admission_transfer/new_admission_transfer_index.vue').default ,
        children:[
            { path: '/',name:'admission_transfer_index', component: require('./components/new_admission_transfer/list_new_admission_transfer.vue').default },
            { path: '/create_new_admission_transfer',name:'create_new_admission_transfer', component: require('./components/new_admission_transfer/create_new_admission_transfer.vue').default },
            { path: '/new_registration_for_admission',name:'new_registration_for_admission', component: require('./components/new_admission_transfer/new_registration_for_admission.vue').default },
            { path: '/edit_new_admission_transfer',name:'edit_new_admission_transfer', component: require('./components/new_admission_transfer/edit_new_admission_transfer.vue').default },
            { path: '/list_new_admission_transfer',name:'list_new_admission_transfer', component: require('./components/new_admission_transfer/list_new_admission_transfer.vue').default },
        ]
    },
    { path: '/track_application',  name:'track_application',  component: require('./components/admissions/track_application.vue').default ,
        children:[
                { path: '/applicationLists',name:'applicationLists', component: require('./components/admissions/applicationLists.vue').default },
        ]
    }
];
