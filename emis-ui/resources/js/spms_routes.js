const routes = [
    //spms Masters Route
    { path: '/spms-master', component: require('./components/masters/spms_masters/spms_master_index.vue').default,
        children:
        [
            { path: '/',name:'spms-master', component: require('./components/masters/spms_masters/spms_master_list.vue').default,},
            { path: '/domain-master', component: require('./components/masters/spms_masters/domain/domain_index.vue').default,
                children: [
                    { path: '', component: require('./components/masters/spms_masters/domain/list_domain.vue').default },
                    { path: '/list-domain', name: 'list_domain', component: require('./components/masters/spms_masters/domain/list_domain.vue').default },
                    { path: '/create-domain', name: 'create_domain', component: require('./components/masters/spms_masters/domain/create_domain.vue').default },
                    { path: '/edit-domain', name: 'edit_domain', component: require('./components/masters/spms_masters/domain/edit_domain.vue').default },
                ]
            },
            

        ]
    },
 




];
export default routes
