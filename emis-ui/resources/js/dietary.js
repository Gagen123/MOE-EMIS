const routes = [
    //Mess Masters
    { path: '/dietary', component: require('./components/dietary/dietary_index.vue').default,
        children:[
            { path: '',name:'', component: require('./components/dietary/dietary_guidelines.vue').default },
            { path: '/dietary_records', component: require('./components/dietary/diets/dietary_index.vue').default,
                children: [
                    { path:'', name:'dietary_records', component: require('./components/dietary/diets/dietary_list.vue').default },
                    { path: '/dietary_records_list', name: 'dietary_records_list', component: require('./components/dietary/diets/dietary_list.vue').default },
                    { path: '/create_dietary_records', name: 'create_dietary_records', component: require('./components/dietary/diets/create_dietary.vue').default },
                    { path: '/edit_dietary_records', name: 'edit_dietary_records', component: require('./components/dietary/diets/edit_dietary.vue').default },
                    { path: '/view_dietary_records', name: 'view_dietary_records', component: require('./components/dietary/diets/view_dietary.vue').default },

                ]
            },
        ],
    },
];
export default routes
