const routes = [
    { path:'/question_answer_index',
    component: require('./components/questionAnswer/question_answer_index.vue').default,
    children:[
        { path: '/',name:'question_answer_index', component: require('./components/questionAnswer/question_answer_list.vue').default },
        { path: '/module',
        component: require('./components/questionAnswer/module/module_index.vue').default,
        children:[
            { path: '/',name:'module', component: require('./components/questionAnswer/module/list_module.vue').default },
            { path: '/list_module',name:'list_module', component: require('./components/questionAnswer/module/list_module.vue').default },
            { path: '/create_module', name:'create_module', component: require('./components/questionAnswer/module/create_module.vue').default },
            { path: '/edit_module', name:'edit_module', component: require('./components/questionAnswer/module/edit_module.vue').default },
        ],
        },
        { path: '/service',
        component: require('./components/questionAnswer/service/service_index.vue').default,
        children:[
            { path: '/',name:'service', component: require('./components/questionAnswer/service/list_service.vue').default },
            { path: '/list_service',name:'list_service', component: require('./components/questionAnswer/service/list_service.vue').default },
            { path: '/create_service', name:'create_service', component: require('./components/questionAnswer/service/create_service.vue').default },
            { path: '/edit_service', name:'edit_service', component: require('./components/questionAnswer/service/edit_service.vue').default },
        ],
        },
        { path: '/question_category',
            component: require('./components/questionAnswer/category/category_index.vue').default,
            children:[
                { path: '/',name:'question_category', component: require('./components/questionAnswer/category/list_category.vue').default },
                { path: '/list_question_category',name:'list_question_category', component: require('./components/questionAnswer/category/list_category.vue').default },
                { path: '/create_question_category', name:'create_question_category', component: require('./components/questionAnswer/category/create_category.vue').default },
                { path: '/edit_question_category', name:'edit_question_category', component: require('./components/questionAnswer/category/edit_category.vue').default },
            ],
        },
        { path: '/category_type',
            component: require('./components/questionAnswer/category_type/category_type_index.vue').default,
            children:[
                { path: '/',name:'category_type', component: require('./components/questionAnswer/category_type/list_category_type.vue').default },
                { path: '/list_category_type',name:'list_category_type', component: require('./components/questionAnswer/category_type/list_category_type.vue').default },
                { path: '/create_category_type', name:'create_category_type', component: require('./components/questionAnswer/category_type/create_category_type.vue').default },
                { path: '/edit_category_type', name:'edit_category_type', component: require('./components/questionAnswer/category_type/edit_category_type.vue').default },
            ],
        },
        { path: '/question',
        component: require('./components/questionAnswer/question/question_index.vue').default,
        children:[
            { path: '/',name:'question', component: require('./components/questionAnswer/question/list_question.vue').default },
            { path: '/list_question',name:'list_question', component: require('./components/questionAnswer/question/list_question.vue').default },
            { path: '/create_question', name:'create_question', component: require('./components/questionAnswer/question/create_question.vue').default },
            { path: '/edit_question', name:'edit_question', component: require('./components/questionAnswer/question/edit_question.vue').default },
        ],
        },
        { path: '/answer',
        component: require('./components/questionAnswer/answer/answer_index.vue').default,
        children:[
            { path: '/',name:'answer', component: require('./components/questionAnswer/answer/list_answer.vue').default },
            { path: '/list_answer',name:'list_answer', component: require('./components/questionAnswer/answer/list_answer.vue').default },
            { path: '/create_answer', name:'create_answer', component: require('./components/questionAnswer/answer/create_answer.vue').default },
        ],
        },
    ]
    },
];
export default routes
