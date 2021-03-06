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
                [   //updated below 3 routes as it was same as above unit_add, unit_edit and unit_list
                    { path: '', component: require('./components/masters/mess_management/item/item_list.vue').default },
                    { path: '/item_add', name:'item_add', component: require('./components/masters/mess_management/item/item_add.vue').default },
                    { path: '/item_edit', name:'item_edit', component: require('./components/masters/mess_management/item/item_edit.vue').default },
                    { path: '/item_list', name:'item_list', component: require('./components/masters/mess_management/item/item_list.vue').default },
                ]
            },
        ],
    },
    // Mess Management Transaction
    { path: '/messManage_index',
        component: require('./components/mess_manage/messManage_Index.vue').default,
        children:[
            { path: '/',name:'messManage_index', component: require('./components/mess_manage/stockreceived_list.vue').default},
            { path: '/stockreceived_index',  component: require('./components/mess_manage/stockReceived/stockreceived_index.vue').default ,
                children:
                [
                    { path: '', name:'stockreceived_index', component: require('./components/mess_manage/stockReceived/stockreceived_list.vue').default },
                    { path: '/stockreceived_add', name:'StockReceivedAdd', component: require('./components/mess_manage/stockReceived/stockreceived_add.vue').default },
                    { path: '/stockreceived_edit', name:'StockReceivedEdit', component: require('./components/mess_manage/stockReceived/stockreceived_edit.vue').default },
                    { path: '/stockreceived_list', name:'StockReceivedList', component: require('./components/mess_manage/stockReceived/stockreceived_list.vue').default },
                    { path: '/stockreceived_view', name:'stockreceived_view', component: require('./components/mess_manage/stockReceived/stockreceived_view.vue').default },
                ]
            },
            { path: '/stockissued_index',
                component: require('./components/mess_manage/stockIssue/stockissued_index.vue').default ,
                children:
                [
                    { path: '', name:'stockissued_index', component: require('./components/mess_manage/stockIssue/stockissued_list.vue').default },
                    { path: '/stockissued_add', name:'StockIssuedAdd', component: require('./components/mess_manage/stockIssue/stockissued_add.vue').default },
                    { path: '/stockissued_edit', name:'StockIssuedEdit', component: require('./components/mess_manage/stockIssue/stockissued_edit.vue').default },
                    { path: '/stockissued_list', name:'StockIssuedList', component: require('./components/mess_manage/stockIssue/stockissued_list.vue').default },
                ]
            },
            { path: '/localprocure_index',
                component: require('./components/mess_manage/localProcurement/localprocure_index.vue').default ,
                children:
                [
                    { path: '', name:'localprocure_index', component: require('./components/mess_manage/localProcurement/localprocure_list.vue').default },
                    { path: '/localprocure_add', name:'LocalProcureAdd', component: require('./components/mess_manage/localProcurement/localprocure_add.vue').default },
                    { path: '/localprocure_edit', name:'LocalProcureEdit', component: require('./components/mess_manage/localProcurement/localprocure_edit.vue').default },
                    { path: '/localprocure_list', name:'LocalProcureList', component: require('./components/mess_manage/localProcurement/localprocure_list.vue').default },
                ]
            },
            { path: '/foodrelease_index',
                component: require('./components/mess_manage/foodReleaseNote/foodrelease_index.vue').default ,
                children:
                [
                    { path: '', name:'foodrelease_index', component: require('./components/mess_manage/foodReleaseNote/foodrelease_list.vue').default },
                    { path: '/foodrelease_add', name:'FoodReleaseAdd', component: require('./components/mess_manage/foodReleaseNote/foodrelease_add.vue').default },
                    { path: '/foodrelease_edit', name:'FoodReleaseEdit', component: require('./components/mess_manage/foodReleaseNote/foodrelease_edit.vue').default },
                    { path: '/foodrelease_list', name:'FoodReleaseList', component: require('./components/mess_manage/foodReleaseNote/foodrelease_list.vue').default },
                    { path: '/foodrelease_view', name:'FoodReleaseView', component: require('./components/mess_manage/foodReleaseNote/foodrelease_view.vue').default },
                ]
            },
            { path: '/stockInventory_list',  name:'stockInventory_list',component: require('./components/mess_manage/stockInventory/stockInventory_list.vue').default },

            // { path: '/teststockreceived_index',
            //     component: require('./components/mess_manage/teststockreceived/teststockreceived_index.vue').default ,
            //     children:
            //     [
            //         { path: '', component: require('./components/mess_manage/teststockreceived/teststockreceived_list.vue').default },
            //         { path: '/teststockreceived_add', name:'TestStockReceivedAdd', component: require('./components/mess_manage/teststockreceived/teststockreceived_add.vue').default },
            //         { path: '/teststockreceived_edit', name:'TestStockReceivedEdit', component: require('./components/mess_manage/teststockreceived/teststockreceived_edit.vue').default },
            //         { path: '/teststockreceived_list', name:'TestStockReceivedList', component: require('./components/mess_manage/teststockreceived/teststockreceived_list.vue').default },
            //     ]
            // },
        ],
    },
];
export default routes
