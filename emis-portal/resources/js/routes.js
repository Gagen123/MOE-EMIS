export default [

    

    { path: '/track_application', component: require('./components/admissions/track_application.vue').default },
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/profile', component: require('./components/Profile.vue').default },
    { path: '/Userprofile', component: require('./components/Profile/Userprofile.vue').default },
    { path: '/Profile/tag', component: require('./components/Profile/Tag.vue').default },
    { path: '/Profile/category', component: require('./components/Profile/Category.vue').default },
    { path: '/result', component: require('./components/results/result.vue').default },
    { path: '*', component: require('./components/NotFound.vue').default },

    
    { path: '/admission',  name:'admission',  component: require('./components/admissions/admission.vue').default ,
     children:[
            { path: '/notenrolled_student',name:'notenrolled_student', component: require('./components/admissions/notenrolled_student.vue').default },
            { path: '/enrolled_student',name:'enrolled_student', component: require('./components/admissions/enrolled_student.vue').default },
            { path: '/classxi_student',name:'classxi_student', component: require('./components/admissions/classxi_student.vue').default },
           
             ]
    },

    { path: '/track_application',  name:'track_application',  component: require('./components/admissions/track_application.vue').default ,
    children:[
           { path: '/applicationLists',name:'applicationLists', component: require('./components/admissions/applicationLists.vue').default },
          
            ]
   }
];
