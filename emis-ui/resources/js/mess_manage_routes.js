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
            { path: '/unit_index', 
                component: require('./components/masters/mess_management/unit/unit_index.vue').default ,
                children: 
                [
                    { path: '', component: require('./components/masters/mess_management/unit/unit_list.vue').default },
                    { path: '/unit_add', name:'UnitAdd', component: require('./components/masters/mess_management/unit/unit_add.vue').default },
                    { path: '/unit_edit', name:'UnitEdit', component: require('./components/masters/mess_management/unit/unit_edit.vue').default },
                    { path: '/unit_list', name:'UnitList', component: require('./components/masters/mess_management/unit/unit_list.vue').default },
                ]    
            },
            { path: '/item_index', 
                component: require('./components/masters/mess_management/item/item_index.vue').default ,
                children: 
                [
                    { path: '', component: require('./components/masters/mess_management/item/item_list.vue').default },
                    { path: '/unit_add', name:'UnitAdd', component: require('./components/masters/mess_management/item/item_add.vue').default },
                    { path: '/unit_edit', name:'UnitEdit', component: require('./components/masters/mess_management/item/item_edit.vue').default },
                    { path: '/unit_list', name:'UnitList', component: require('./components/masters/mess_management/item/item_list.vue').default },
                ]    
            },
        ],
    },
    // Mess Management Transaction 
    { path: '/messManage_index', 
        component: require('./components/mess_manage/messManage_Index.vue').default,
        children:[
            { path: '/stock_received_index', 
                component: require('./components/mess_manage/stockReceived/stock_received_index.vue').default ,
                children: 
                [
                    { path: '', component: require('./components/mess_manage/stockReceived/stock_received_list.vue').default },
                    { path: '/stock_received_add', name:'StockReceivedAdd', component: require('./components/mess_manage/stockReceived/stock_received_add.vue').default },
                    { path: '/stock_received_edit', name:'StockReceivedEdit', component: require('./components/mess_manage/stockReceived/stock_received_edit.vue').default },
                    { path: '/stock_received_list', name:'StockReceivedList', component: require('./components/mess_manage/stockReceived/stock_received_list.vue').default },
                ]    
            },
            { path: '/stock_issued_index', 
                component: require('./components/mess_manage/stockIssue/stock_issued_index.vue').default ,
                children: 
                [
                    { path: '', component: require('./components/mess_manage/stockIssue/stock_issued_list.vue').default },
                    { path: '/stock_issued_add', name:'UnitAdd', component: require('./components/mess_manage/stockIssue/stock_issued_add.vue').default },
                    { path: '/stock_issued_edit', name:'UnitEdit', component: require('./components/mess_manage/stockIssue/stock_issued_edit.vue').default },
                    { path: '/stock_issued_list', name:'UnitList', component: require('./components/mess_manage/stockIssue/stock_issued_list.vue').default },
                ]    
            },
            { path: '/foodrelease_index', 
                component: require('./components/mess_manage/foodReleaseNote/foodrelease_index.vue').default ,
                children: 
                [
                    { path: '', component: require('./components/mess_manage/foodReleaseNote/foodrelease_list.vue').default },
                    { path: '/foodrelease_add', name:'FoodReleaseAdd', component: require('./components/mess_manage/foodReleaseNote/foodrelease_add.vue').default },
                    { path: '/foodrelease_edit', name:'FoodReleaseEdit', component: require('./components/mess_manage/foodReleaseNote/foodrelease_edit.vue').default },
                    { path: '/foodrelease_list', name:'FoodReleaseList', component: require('./components/mess_manage/foodReleaseNote/foodrelease_list.vue').default },
                ]    
            },
        ],
    },
];
export default routes