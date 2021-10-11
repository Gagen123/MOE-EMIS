const routes = [
    { path: '/', component: require('./components/common/dashboard.vue').default },
    { path: '/view_notification_message', name:'view_notification_message', component: require('./components/common/view_notification_message.vue').default },
    { path: '/profile', name:'profile', component: require('./components/common/profile.vue').default },
    { path: '/tasklist', name:'tasklist', component: require('./components/common/taskList.vue').default },
    { path: '/track_application',  name:'track_application',component: require('./components/common/track_application.vue').default },
    { path: '/happiness_index',  name:'happiness_index',component: require('./components/common/hapiness/happiness_index.vue').default },

];
export default routes
