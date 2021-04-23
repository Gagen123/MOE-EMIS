const routes = [  
    //Mess Masters
    { path: '/mess_management_master', 
        component: require('./components/masters/mess_management/mess_master_index.vue').default,
        children:[
            { path: '/quater_index', 
                component: require('./components/masters/mess_management/quater_type/quater_index.vue').default ,
                children: 
                [
                    { path: '', component: require('./components/masters/mess_management/quater_type/quater_list.vue').default },
                    { path: '/quater_add', name:'QuaterAdd', component: require('./components/masters/mess_management/quater_type/quater_add.vue').default },
                    { path: '/quater_edit', name:'QuaterEdit', component: require('./components/masters/mess_management/quater_type/quater_edit.vue').default },
                    { path: '/quater_list', name:'QuaterList', component: require('./components/masters/mess_management/quater_type/quater_list.vue').default },
                ]    
            },
        ],
    },
];
export default routes