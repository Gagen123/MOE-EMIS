const routes = [
    //TRE Routes
    { path: '/tre',  component: require('./components/TRE/tre_index.vue').default,
        children:[
         //   { path: '',name:'tre', component: require('./components/TRE/tre_guidelines.vue').default },
            { path: '/subsitute_teacher_index', component: require('./components/TRE/manage_subTeacher/substitute_teacher_index.vue').default,
                children: [
                    { path:'', name:'manage_subsitute_teacher', component: require('./components/TRE/manage_subTeacher/list_substitute_teacher.vue').default },
                    { path: '/list_substitute_teacher', name: 'list_substitute_teacher', component: require('./components/TRE/manage_subTeacher/list_substitute_teacher.vue').default },
                    { path: '/create_substitute_teacher', name: 'create_substitute_teacher', component: require('./components/TRE/manage_subTeacher/create_substitute_teacher.vue').default },
                    { path: '/edit_substitute_teacher', name: 'edit_substitute_teacher', component: require('./components/TRE/manage_subTeacher/edit_substitute_teacher.vue').default },
                 //   { path: '/view_subsitute_teacher', name: 'view_subsitute_teacher', component: require('./components/TRE/manage_subTeacher/view_subsitute_teacher.vue').default },

                ]
            },
        ],
    },
];
export default routes
