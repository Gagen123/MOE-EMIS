const routes = [ 
    { path: '/', component: require('./components/common/dashboard.vue').default },
    { path: '/profile', name:'profile', component: require('./components/common/profile.vue').default },
    { path: '/tasklist', name:'tasklist', component: require('./components/common/taskList.vue').default },
    { path: '/track_application',  name:'track_application',component: require('./components/common/track_application.vue').default },
];
export default routes