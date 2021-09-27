const routes = [
    { path: '/', component: require('./components/common/dashboard.vue').default },
    { path: '/view_notification_message', name:'view_notification_message', component: require('./components/common/view_notification_message.vue').default },
    { path: '/profile', name:'profile', component: require('./components/common/profile.vue').default },
    { path: '/tasklist', name:'tasklist', component: require('./components/common/taskList.vue').default },
    { path: '/track_application',  name:'track_application',component: require('./components/common/track_application.vue').default },
    { path: '/happiness_index',  name:'happiness_index',component: require('./components/common/hapiness/happiness_index.vue').default },
    { path: '/eccd_approval_index',
    component: require('./components/organization/establishment/eccd/eccd_index.vue').default,
        children: [
            { path: '/', name:'eccd_approval_index', component: require('./components/organization/establishment/eccd/list_eccd.vue').default },
            { path: '/create_eccd',name:"create_eccd", component: require('./components/organization/establishment/eccd/create_eccd.vue').default },
            { path: '/list_eccd', name:'list_eccd', component: require('./components/organization/establishment/eccd/list_eccd.vue').default },
            { path: '/show_eccd',  name:'show_eccd',component: require('./components/organization/establishment/eccd/show_eccd.vue').default },
            { path: '/acknowledgement_eccd',  name:'acknowledgement_eccd',component: require('./components/organization/establishment/eccd/acknowledgement.vue').default },
        ]
    },

];
export default routes
