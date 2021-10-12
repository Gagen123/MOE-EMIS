const routes = [
    //STAFF Masters
    { path: '/staff_link',
        component: require('./components/masters/staff_masters/staff_master_index.vue').default,
        children:[
            {path: '/',name:'staff_link', component: require('./components/masters/staff_masters/staff_master_list.vue').default },
            { path: '/contract_category',
                component: require('./components/masters/staff_masters/contract_category/contract_category_index.vue').default,
                children:[
                    { path: '/',name:'contract_category', component: require('./components/masters/staff_masters/contract_category/list_contract_category.vue').default },
                    { path: '/list_contract_category',name:'list_contract_category', component: require('./components/masters/staff_masters/contract_category/list_contract_category.vue').default },
                    { path: '/create_contract_category',name:'create_contract_category', component: require('./components/masters/staff_masters/contract_category/create_contract_category.vue').default },
                    { path: '/edit_contract_category', name:'edit_contract_category', component: require('./components/masters/staff_masters/contract_category/edit_contract_category.vue').default },
                ],
            },
            { path: '/subject_area_masters',
                component: require('./components/masters/staff_masters/subject_area/subject_area_index.vue').default,
                children:[
                    { path: '/',name:'subject_area_masters', component: require('./components/masters/staff_masters/subject_area/list_subject_area.vue').default },
                    { path: '/list_subject_area',name:'list_subject_area', component: require('./components/masters/staff_masters/subject_area/list_subject_area.vue').default },
                    { path: '/create_subject_area',name:'create_subject_area', component: require('./components/masters/staff_masters/subject_area/create_subject_area.vue').default },
                    { path: '/edit_subject_area', name:'edit_subject_area', component: require('./components/masters/staff_masters/subject_area/edit_subject_area.vue').default },
                ],
            },

            { path: '/marital_status',
                component: require('./components/masters/staff_masters/marital_status/marital_status_index.vue').default,
                children:[
                    { path: '/',name:'marital_status', component: require('./components/masters/staff_masters/marital_status/list_marital_status.vue').default },
                    { path: '/list_marital_status',name:'list_marital_status', component: require('./components/masters/staff_masters/marital_status/list_marital_status.vue').default },
                    { path: '/create_marital_status',name:'create_marital_status', component: require('./components/masters/staff_masters/marital_status/create_marital_status.vue').default },
                    { path: '/edit_marital_status', name:'edit_marital_status', component: require('./components/masters/staff_masters/marital_status/edit_marital_status.vue').default },
                ],
            },
            { path: '/currier_stage',
                component: require('./components/masters/staff_masters/currier_stage/currier_stage_index.vue').default,
                children:[
                    { path: '/',name:'currier_stage', component: require('./components/masters/staff_masters/currier_stage/list_currier_stage.vue').default },
                    { path: '/list_currier_stage',name:'list_currier_stage', component: require('./components/masters/staff_masters/currier_stage/list_currier_stage.vue').default },
                    { path: '/create_currier_stage',name:'create_currier_stage', component: require('./components/masters/staff_masters/currier_stage/create_currier_stage.vue').default },
                    { path: '/edit_currier_stage', name:'edit_currier_stage', component: require('./components/masters/staff_masters/currier_stage/edit_currier_stage.vue').default },
                ],
            },

            { path: '/CourseMode',
                component: require('./components/masters/staff_masters/CourseMode/CourseMode_index.vue').default,
                children:[
                    { path: '/',name:'CourseMode', component: require('./components/masters/staff_masters/CourseMode/list_CourseMode.vue').default },
                    { path: '/list_CourseMode',name:'list_CourseMode', component: require('./components/masters/staff_masters/CourseMode/list_CourseMode.vue').default },
                    { path: '/create_CourseMode',name:'create_CourseMode', component: require('./components/masters/staff_masters/CourseMode/create_CourseMode.vue').default },
                    { path: '/edit_CourseMode', name:'edit_CourseMode', component: require('./components/masters/staff_masters/CourseMode/edit_CourseMode.vue').default },
                ],
            },

            { path: '/staff_relationship',
                component: require('./components/masters/staff_masters/relationship/relationship_index.vue').default,
                children:[
                { path: '/',name:'staff_relationship', component: require('./components/masters/staff_masters/relationship/list_relationship.vue').default },
                { path: '/list_relationship',name:'list_relationship', component: require('./components/masters/staff_masters/relationship/list_relationship.vue').default },
                { path: '/create_relationship',name:'create_relationship', component: require('./components/masters/staff_masters/relationship/create_relationship.vue').default },
                { path: '/edit_relationship', name:'edit_relationship', component: require('./components/masters/staff_masters/relationship/edit_relationship.vue').default },
                ],
            },

            { path: '/SecondmentMaster',
                component: require('./components/masters/staff_masters/SecondmentMaster/SecondmentMaster_index.vue').default,
                children:[
                    { path: '/',name:'SecondmentMaster', component: require('./components/masters/staff_masters/SecondmentMaster/list_SecondmentMaster.vue').default },
                    { path: '/list_SecondmentMaster',name:'list_SecondmentMaster', component: require('./components/masters/staff_masters/SecondmentMaster/list_SecondmentMaster.vue').default },
                    { path: '/create_SecondmentMaster',name:'create_SecondmentMaster', component: require('./components/masters/staff_masters/SecondmentMaster/create_SecondmentMaster.vue').default },
                    { path: '/edit_SecondmentMaster', name:'edit_SecondmentMaster', component: require('./components/masters/staff_masters/SecondmentMaster/edit_SecondmentMaster.vue').default },
                ],
            },
            { path: '/SeperationMaster',
                component: require('./components/masters/staff_masters/SeperationMaster/SeperationMaster_index.vue').default,
                children:[
                    { path: '/',name:'SeperationMaster', component: require('./components/masters/staff_masters/SeperationMaster/list_SeperationMaster.vue').default },
                    { path: '/list_SeperationMaster',name:'list_SeperationMaster', component: require('./components/masters/staff_masters/SeperationMaster/list_SeperationMaster.vue').default },
                    { path: '/create_SeperationMaster',name:'create_SeperationMaster', component: require('./components/masters/staff_masters/SeperationMaster/create_SeperationMaster.vue').default },
                    { path: '/edit_SeperationMaster', name:'edit_SeperationMaster', component: require('./components/masters/staff_masters/SeperationMaster/edit_SeperationMaster.vue').default },
                ],
            },

            //duplicate route
            // { path: '/contract_category',
            //     component: require('./components/masters/staff_masters/contract_category/contract_category_index.vue').default,
            //     children:[
            //         { path: '/', name:'contract_category',  component: require('./components/masters/staff_masters/contract_category/list_contract_category.vue').default },
            //         { path: '/list_contract_category',name:'list_contract_category',  component: require('./components/masters/staff_masters/contract_category/list_contract_category.vue').default },
            //         { path: '/create_contract_category',name:'create_contract_category', component: require('./components/masters/staff_masters/contract_category/create_contract_category.vue').default },
            //         { path: '/edit_contract_category', name:'edit_contract_category', component: require('./components/masters/staff_masters/contract_category/edit_contract_category.vue').default },
            //     ],
            // },

        ],
    },

    //Staff Transfer Masters
    { path: '/qualification_index',
        component: require('./components/masters/staff_qualification/staff_qualification_index.vue').default,
        children:[
            {path: '/',name:'qualification_index', component: require('./components/masters/staff_qualification/staff_qualification_list.vue').default },
            { path: '/qualification_category',
                component: require('./components/masters/staff_qualification/qualification_category/qualification_category_index.vue').default,
                children:[
                    { path: '/',name:'qualification_category', component: require('./components/masters/staff_qualification/qualification_category/list_qualification_category.vue').default },
                    { path: '/list_qualification_category',name:'list_qualification_category', component: require('./components/masters/staff_qualification/qualification_category/list_qualification_category.vue').default },
                    { path: '/create_qualification_category',name:'create_qualification_category', component: require('./components/masters/staff_qualification/qualification_category/create_qualification_category.vue').default },
                    { path: '/edit_qualification_category', name:'edit_qualification_category', component: require('./components/masters/staff_qualification/qualification_category/edit_qualification_category.vue').default },
                ],
            },
            { path: '/qualification_type',
                component: require('./components/masters/staff_qualification/qualification_type/qualification_type_index.vue').default,
                children:[
                    { path: '/',name:'qualification_type', component: require('./components/masters/staff_qualification/qualification_type/list_qualification_type.vue').default },
                    { path: '/list_qualification_type',name:'list_qualification_type', component: require('./components/masters/staff_qualification/qualification_type/list_qualification_type.vue').default },
                    { path: '/create_qualification_type',name:'create_qualification_type', component: require('./components/masters/staff_qualification/qualification_type/create_qualification_type.vue').default },
                    { path: '/edit_qualification_type', name:'edit_qualification_type', component: require('./components/masters/staff_qualification/qualification_type/edit_qualification_type.vue').default },
                ],
            },
            { path: '/qualification_level',
                component: require('./components/masters/staff_qualification/qualification_level/qualification_level_index.vue').default,
                children:[
                    { path: '/',name:'qualification_level', component: require('./components/masters/staff_qualification/qualification_level/list_qualification_level.vue').default },
                    { path: '/list_qualification_level',name:'list_qualification_level', component: require('./components/masters/staff_qualification/qualification_level/list_qualification_level.vue').default },
                    { path: '/create_qualification_level',name:'create_qualification_level', component: require('./components/masters/staff_qualification/qualification_level/create_qualification_level.vue').default },
                    { path: '/edit_qualification_level', name:'edit_qualification_level', component: require('./components/masters/staff_qualification/qualification_level/edit_qualification_level.vue').default },
                ],
            },
            { path: '/staff_qualification',
                component: require('./components/masters/staff_qualification/staff_qualification/staff_qualification_index.vue').default,
                children:[
                    { path: '/',name:'staff_qualification', component: require('./components/masters/staff_qualification/staff_qualification/list_staff_qualification.vue').default },
                    { path: '/list_staff_qualification',name:'list_staff_qualification', component: require('./components/masters/staff_qualification/staff_qualification/list_staff_qualification.vue').default },
                    { path: '/create_staff_qualification',name:'create_staff_qualification', component: require('./components/masters/staff_qualification/staff_qualification/create_staff_qualification.vue').default },
                    { path: '/edit_staff_qualification', name:'edit_staff_qualification', component: require('./components/masters/staff_qualification/staff_qualification/edit_staff_qualification.vue').default },
                ],
            },

            { path: '/qualification_institute',
                component: require('./components/masters/staff_qualification/qualification_institute/qualification_institute_index.vue').default,
                children:[
                    { path: '/',name:'qualification_institute', component: require('./components/masters/staff_qualification/qualification_institute/list_qualification_institute.vue').default },
                    { path: '/list_qualification_institute',name:'list_qualification_institute', component: require('./components/masters/staff_qualification/qualification_institute/list_qualification_institute.vue').default },
                    { path: '/create_qualification_institute',name:'create_qualification_institute', component: require('./components/masters/staff_qualification/qualification_institute/create_qualification_institute.vue').default },
                    { path: '/edit_qualification_institute', name:'edit_qualification_institute', component: require('./components/masters/staff_qualification/qualification_institute/edit_qualification_institute.vue').default },
                ],
            },

            { path: '/doner_agency',
                component: require('./components/masters/staff_qualification/doner_agency/doner_agency_index.vue').default,
                children:[
                    { path: '/',name:'doner_agency', component: require('./components/masters/staff_qualification/doner_agency/list_doner_agency.vue').default },
                    { path: '/list_doner_agency',name:'list_doner_agency', component: require('./components/masters/staff_qualification/doner_agency/list_doner_agency.vue').default },
                    { path: '/create_doner_agency',name:'create_doner_agency', component: require('./components/masters/staff_qualification/doner_agency/create_doner_agency.vue').default },
                    { path: '/edit_doner_agency', name:'edit_doner_agency', component: require('./components/masters/staff_qualification/doner_agency/edit_doner_agency.vue').default },
                ],
            },

            { path: '/project_doner_agency',
                component: require('./components/masters/staff_qualification/project_doner_agency/project_doner_agency_index.vue').default,
                children:[
                    { path: '/',name:'project_doner_agency', component: require('./components/masters/staff_qualification/project_doner_agency/list_project_doner_agency.vue').default },
                    { path: '/list_project_doner_agency',name:'list_project_doner_agency', component: require('./components/masters/staff_qualification/project_doner_agency/list_project_doner_agency.vue').default },
                    { path: '/create_project_doner_agency',name:'create_project_doner_agency', component: require('./components/masters/staff_qualification/project_doner_agency/create_project_doner_agency.vue').default },
                    { path: '/edit_project_doner_agency', name:'edit_project_doner_agency', component: require('./components/masters/staff_qualification/project_doner_agency/edit_project_doner_agency.vue').default },
                ],
            },

        ]
    },

    //Position Directory
    { path: '/position_directory_index',
        component: require('./components/masters/staff_position_directory/staff_position_directory_index.vue').default,
        children:[
            {path: '/',name:'position_directory_index', component: require('./components/masters/staff_position_directory/staff_position_directory_list.vue').default },
            { path: '/major_group_master',
                component: require('./components/masters/staff_position_directory/major_group/major_group_index.vue').default,
                children:[
                    { path: '/',name:'major_group_master', component: require('./components/masters/staff_position_directory/major_group/list_major_group.vue').default },
                    { path: '/list_major_group',name:'list_major_group', component: require('./components/masters/staff_position_directory/major_group/list_major_group.vue').default },
                    { path: '/create_major_group',name:'create_major_group', component: require('./components/masters/staff_position_directory/major_group/create_major_group.vue').default },
                    { path: '/edit_major_group', name:'edit_major_group', component: require('./components/masters/staff_position_directory/major_group/edit_major_group.vue').default },
                ],
            },
            { path: '/sub_major_group_master',
            component: require('./components/masters/staff_position_directory/major_sub_group/subgroup_index.vue').default,
                children:[
                { path: '/',name:'sub_major_group_master', component: require('./components/masters/staff_position_directory/major_sub_group/list_sub_group.vue').default },
                { path: '/list_sub_major_group_master',name:'list_sub_major_group_master', component: require('./components/masters/staff_position_directory/major_sub_group/list_sub_group.vue').default },
                { path: '/create_sub_major_group_master',name:'create_sub_major_group_master', component: require('./components/masters/staff_position_directory/major_sub_group/create_sub_group.vue').default },
                { path: '/edit_sub_major_group_master', name:'edit_sub_major_group_master', component: require('./components/masters/staff_position_directory/major_sub_group/edit_sub_group.vue').default },
                ],
            },
            { path: '/position_title_master',
                component: require('./components/masters/staff_position_directory/position_title/position_title_index.vue').default,
                children:[
                { path: '/',name:'position_title_master', component: require('./components/masters/staff_position_directory/position_title/list_position_title.vue').default },
                { path: '/list_position_title',name:'list_position_title', component: require('./components/masters/staff_position_directory/position_title/list_position_title.vue').default },
                { path: '/create_position_title',name:'create_position_title', component: require('./components/masters/staff_position_directory/position_title/create_position_title.vue').default },
                { path: '/edit_position_title', name:'edit_position_title', component: require('./components/masters/staff_position_directory/position_title/edit_position_title.vue').default },
                ],
            },
            { path: '/position_level_master',
                component: require('./components/masters/staff_position_directory/position_level/position_level_index.vue').default,
                children:[
                { path: '/',name:'position_level_master', component: require('./components/masters/staff_position_directory/position_level/list_position_level.vue').default },
                { path: '/list_position_level_master',name:'list_position_level_master', component: require('./components/masters/staff_position_directory/position_level/list_position_level.vue').default },
                { path: '/create_position_level_master',name:'create_position_level_master', component: require('./components/masters/staff_position_directory/position_level/create_position_level.vue').default },
                { path: '/edit_position_level_master', name:'edit_position_level_master', component: require('./components/masters/staff_position_directory/position_level/edit_position_level.vue').default },
                ],
            },

            { path: '/position_sub_level_master',
                component: require('./components/masters/staff_position_directory/position_sub_level_master/position_sub_level_master_index.vue').default,
                children:[
                { path: '/',name:'position_sub_level_master', component: require('./components/masters/staff_position_directory/position_sub_level_master/list_position_sub_level_master.vue').default },
                { path: '/list_position_sub_level_master',name:'list_position_sub_level_master', component: require('./components/masters/staff_position_directory/position_sub_level_master/list_position_sub_level_master.vue').default },
                { path: '/create_position_sub_level_master',name:'create_position_sub_level_master', component: require('./components/masters/staff_position_directory/position_sub_level_master/create_position_sub_level_master.vue').default },
                { path: '/edit_position_sub_level_master', name:'edit_position_sub_level_master', component: require('./components/masters/staff_position_directory/position_sub_level_master/edit_position_sub_level_master.vue').default },
                ],
            },
            { path: '/superstructure',
                component: require('./components/masters/staff_position_directory/superstructure/superstructure_index.vue').default,
                children:[
                { path: '/',name:'superstructure', component: require('./components/masters/staff_position_directory/superstructure/list_superstructure.vue').default },
                { path: '/list_superstructure',name:'list_superstructure', component: require('./components/masters/staff_position_directory/superstructure/list_superstructure.vue').default },
                { path: '/create_superstructure',name:'create_superstructure', component: require('./components/masters/staff_position_directory/superstructure/create_superstructure.vue').default },
                { path: '/edit_superstructure', name:'edit_superstructure', component: require('./components/masters/staff_position_directory/superstructure/edit_superstructure.vue').default },
                ],
            },
            { path: '/childgroup',
                component: require('./components/masters/staff_position_directory/childgroup/childgroup_index.vue').default,
                children:[
                { path: '/',name:'childgroup', component: require('./components/masters/staff_position_directory/childgroup/list_childgroup.vue').default },
                { path: '/list_childgroup',name:'list_childgroup', component: require('./components/masters/staff_position_directory/childgroup/list_childgroup.vue').default },
                { path: '/create_childgroup',name:'create_childgroup', component: require('./components/masters/staff_position_directory/childgroup/create_childgroup.vue').default },
                { path: '/edit_childgroup', name:'edit_childgroup', component: require('./components/masters/staff_position_directory/childgroup/edit_childgroup.vue').default },
                ],
            },
            { path: '/child_group_position',
                component: require('./components/masters/staff_position_directory/child_group_position/child_group_position_index.vue').default,
                children:[
                { path: '/',name:'child_group_position', component: require('./components/masters/staff_position_directory/child_group_position/list_child_group_position.vue').default },
                { path: '/list_child_group_position',name:'list_child_group_position', component: require('./components/masters/staff_position_directory/child_group_position/list_child_group_position.vue').default },
                { path: '/create_child_group_position',name:'create_child_group_position', component: require('./components/masters/staff_position_directory/child_group_position/create_child_group_position.vue').default },
                { path: '/edit_child_group_position', name:'edit_child_group_position', component: require('./components/masters/staff_position_directory/child_group_position/edit_child_group_position.vue').default },
                ],
            },


        ]
    },
    //Staff Transfer Masters
    { path: '/transfer_master_index',
        component: require('./components/masters/staff_transfer/staff_transfer_index.vue').default,
        children:[
            {path: '/',name:'transfer_master_index', component: require('./components/masters/staff_transfer/staff_transfer_list.vue').default },
            { path: '/transfer_reason',
                component: require('./components/masters/staff_transfer/transfer_reason/transfer_reason.vue').default,
                children:[
                    { path: '/',name:'transfer_reason', component: require('./components/masters/staff_transfer/transfer_reason/list_transfer_reason.vue').default },
                    { path: '/List_transfer_reason',name:'List_transfer_reason', component: require('./components/masters/staff_transfer/transfer_reason/list_transfer_reason.vue').default },
                    { path: '/create_transfer_reason',name:'create_transfer_reason', component: require('./components/masters/staff_transfer/transfer_reason/create_transfer_reason.vue').default },
                    { path: '/edit_transfer_reason', name:'edit_transfer_reason', component: require('./components/masters/staff_transfer/transfer_reason/edit_transfer_reason.vue').default },
                ],
            },
            { path: '/transfer_undertaking',
                component: require('./components/masters/staff_transfer/transfer_undertaking/transfer_undertaking_index.vue').default,
                children:[
                { path: '/',name:'transfer_undertaking', component: require('./components/masters/staff_transfer/transfer_undertaking/list_transfer_undertaking.vue').default },
                { path: '/list_transfer_undertaking',name:'list_transfer_undertaking', component: require('./components/masters/staff_transfer/transfer_undertaking/list_transfer_undertaking.vue').default },
                { path: '/create_transfer_undertaking',name:'create_transfer_undertaking', component: require('./components/masters/staff_transfer/transfer_undertaking/create_transfer_undertaking.vue').default },
                { path: '/edit_transfer_undertaking', name:'edit_transfer_undertaking', component: require('./components/masters/staff_transfer/transfer_undertaking/edit_transfer_undertaking.vue').default },
                ],
            },
            { path: '/transfer_type',
                component: require('./components/masters/staff_transfer/transfer_type/transfer_type_index.vue').default,
                children:[
                { path: '/',name:'transfer_type', component: require('./components/masters/staff_transfer/transfer_type/list_transfer_type.vue').default },
                { path: '/list_transfer_type',name:'list_transfer_type', component: require('./components/masters/staff_transfer/transfer_type/list_transfer_type.vue').default },
                { path: '/create_transfer_type',name:'create_transfer_type', component: require('./components/masters/staff_transfer/transfer_type/create_transfer_type.vue').default },
                { path: '/edit_transfer_type', name:'edit_transfer_type', component: require('./components/masters/staff_transfer/transfer_type/edit_transfer_type.vue').default },
                ],
            },
            { path: '/transfer_config',
                component: require('./components/staff/transfer/transfer_config/transfer_config_index.vue').default,
                    children:[
                        { path: '/',name:'transfer_config', component: require('./components/staff/transfer/transfer_config/list_transfer_config.vue').default },
                        { path: '/list_transfer_config',name:'list_transfer_config', component: require('./components/staff/transfer/transfer_config/list_transfer_config.vue').default },
                        { path: '/create_transfer_config',name:'create_transfer_config', component: require('./components/staff/transfer/transfer_config/create_transfer_config.vue').default },
                        { path: '/edit_transfer_config', name:'edit_transfer_config', component: require('./components/staff/transfer/transfer_config/edit_transfer_config.vue').default },
                    ],
                },

        ]
    },

    { path: '/management_body_link',
        component: require('./components/masters/management_body/management_body_index.vue').default,
        children:[
            {path: '/',name:'management_body_link', component: require('./components/masters/management_body/management_body_list.vue').default },

            { path: '/management_body_designation',
                component: require('./components/masters/management_body/mgmn_body_desig/mgmn_designation.vue').default,
                children:[
                { path: '/',name:'management_body_designation', component: require('./components/masters/management_body/mgmn_body_desig/list_mgmn_designation.vue').default },
                { path: '/list_mgmn_desig',name:'list_mgmn_desig', component: require('./components/masters/management_body/mgmn_body_desig/list_mgmn_designation.vue').default },
                { path: '/create_mgmn_desig',name:'create_mgmn_desig', component: require('./components/masters/management_body/mgmn_body_desig/create_mgmn_desig.vue').default },
                { path: '/edit_mgmn_desig', name:'edit_mgmn_desig', component: require('./components/masters/management_body/mgmn_body_desig/edit_mgmn_desig.vue').default },
                ],
            },
            { path: '/management_body_type',
                component: require('./components/masters/management_body/body_type/body_type_index.vue').default,
                children:[
                { path: '/',name:'management_body_type', component: require('./components/masters/management_body/body_type/list_body_type.vue').default },
                { path: '/list_body_type',name:'list_body_type', component: require('./components/masters/management_body/body_type/list_body_type.vue').default },
                { path: '/create_body_type',name:'create_body_type', component: require('./components/masters/management_body/body_type/create_body_type.vue').default },
                { path: '/edit_body_type', name:'edit_body_type', component: require('./components/masters/management_body/body_type/edit_body_type.vue').default },
                ],
            },
        ]
    },

    //Staff Leave Masters
    { path: '/leave_index',
        component: require('./components/masters/staff_leave_masters/staff_leave_index.vue').default,
        children:[
            {path: '/',name:'leave_index', component: require('./components/masters/staff_leave_masters/list_staff_leave_list.vue').default },

            { path: '/leave_type_index',
                component: require('./components/masters/staff_leave_masters/leave_type/staff_leave_type_index.vue').default,
                children:[
                { path: '/',name:'leave_type_index', component: require('./components/masters/staff_leave_masters/leave_type/list_staff_leave_type.vue').default },
                { path: '/list_leave_type',name:'list_leave_type', component: require('./components/masters/staff_leave_masters/leave_type/list_staff_leave_type.vue').default },
                { path: '/create_leave_type',name:'create_leave_type', component: require('./components/masters/staff_leave_masters/leave_type/create_staff_leave_type.vue').default },
                { path: '/edit_leave_type', name:'edit_leave_type', component: require('./components/masters/staff_leave_masters/leave_type/edit_staff_leave_type.vue').default },
                ],
            },

            { path: '/leave_config_index',
                component: require('./components/masters/staff_leave_masters/leave_config/leave_config_index.vue').default,
                children:[
                    { path: '/',name:'leave_config_index', component: require('./components/masters/staff_leave_masters/leave_config/list_leave_config.vue').default },
                    { path: '/list_leave_config',name:'list_leave_config', component: require('./components/masters/staff_leave_masters/leave_config/list_leave_config.vue').default },
                    { path: '/create_leave_config',name:'create_leave_config', component: require('./components/masters/staff_leave_masters/leave_config/create_leave_config.vue').default },
                    { path: '/edit_leave_config', name:'edit_leave_config', component: require('./components/masters/staff_leave_masters/leave_config/edit_leave_config.vue').default },
                ],
            },
        ]
    },

    //HR Developemnt (Training) Masters
    { path: '/traing_master',
        component: require('./components/masters/hr_development_masters/hr_development_index.vue').default,
        children:[
            { path: '/',name:'traing_master', component: require('./components/masters/hr_development_masters/hr_development_list.vue').default },
            { path: '/training_type_master',
                component: require('./components/masters/hr_development_masters/training_type/training_type_index.vue').default,
                children:[
                    { path: '/',name:'training_type_master', component: require('./components/masters/hr_development_masters/training_type/training_type_list.vue').default },
                    { path: '/list_training_type', name:'list_training_type', component: require('./components/masters/hr_development_masters/training_type/training_type_list.vue').default },
                    { path: '/create_training_type',name:'create_training_type', component: require('./components/masters/hr_development_masters/training_type/create_training_type.vue').default },
                    { path: '/edit_training_type', name:'edit_training_type', component: require('./components/masters/hr_development_masters/training_type/edit_training_type.vue').default },
                ],
            },

            { path: '/related_programme',
                component: require('./components/masters/hr_development_masters/related_programme/related_programme_index.vue').default,
                children:[
                    { path: '/',name:'related_programme', component: require('./components/masters/hr_development_masters/related_programme/related_programme_list.vue').default },
                    { path: '/list_related_programme', name:'list_related_programme', component: require('./components/masters/hr_development_masters/related_programme/related_programme_list.vue').default },
                    { path: '/create_related_programme',name:'create_related_programme', component: require('./components/masters/hr_development_masters/related_programme/create_related_programme.vue').default },
                    { path: '/edit_related_programme', name:'edit_related_programme', component: require('./components/masters/hr_development_masters/related_programme/edit_related_programme.vue').default },
                ],
            },
            { path: '/programme_level',
                component: require('./components/masters/hr_development_masters/programme_level/programme_level_index.vue').default,
                children:[
                    { path: '/',name:'programme_level', component: require('./components/masters/hr_development_masters/programme_level/programme_level_list.vue').default },
                    { path: '/list_programme_level', name:'list_programme_level', component: require('./components/masters/hr_development_masters/programme_level/programme_level_list.vue').default },
                    { path: '/create_programme_level',name:'create_programme_level', component: require('./components/masters/hr_development_masters/programme_level/create_programme_level.vue').default },
                    { path: '/edit_programme_level', name:'edit_programme_level', component: require('./components/masters/hr_development_masters/programme_level/edit_programme_level.vue').default },
                ],
            },
            { path: '/programme_type',
                component: require('./components/masters/hr_development_masters/programme_type/programme_type_index.vue').default,
                children:[
                    { path: '/',name:'programme_type', component: require('./components/masters/hr_development_masters/programme_type/programme_type_list.vue').default },
                    { path: '/list_programme_type', name:'list_programme_type', component: require('./components/masters/hr_development_masters/programme_type/programme_type_list.vue').default },
                    { path: '/create_programme_type',name:'create_programme_type', component: require('./components/masters/hr_development_masters/programme_type/create_programme_type.vue').default },
                    { path: '/edit_programme_type', name:'edit_programme_type', component: require('./components/masters/hr_development_masters/programme_type/edit_programme_type.vue').default },
                ],
            },
            { path: '/course_type',
                component: require('./components/masters/hr_development_masters/course_type/course_type_index.vue').default,
                children:[
                    { path: '/',name:'course_type', component: require('./components/masters/hr_development_masters/course_type/course_type_list.vue').default },
                    { path: '/list_course_type', name:'list_course_type', component: require('./components/masters/hr_development_masters/course_type/course_type_list.vue').default },
                    { path: '/create_course_type',name:'create_course_type', component: require('./components/masters/hr_development_masters/course_type/create_course_type.vue').default },
                    { path: '/edit_course_type', name:'edit_course_type', component: require('./components/masters/hr_development_masters/course_type/edit_course_type.vue').default },
                ],
            },

            { path: '/financial_source',
                component: require('./components/masters/hr_development_masters/financial_source/financial_source_index.vue').default,
                children:[
                    { path: '/',name:'financial_source', component: require('./components/masters/hr_development_masters/financial_source/financial_source_list.vue').default },
                    { path: '/list_financial_source', name:'list_financial_source', component: require('./components/masters/hr_development_masters/financial_source/financial_source_list.vue').default },
                    { path: '/create_financial_source',name:'create_financial_source', component: require('./components/masters/hr_development_masters/financial_source/create_financial_source.vue').default },
                    { path: '/edit_financial_source', name:'edit_financial_source', component: require('./components/masters/hr_development_masters/financial_source/edit_financial_source.vue').default },
                ],
            },

            { path: '/category',
                component: require('./components/masters/hr_development_masters/category/category_index.vue').default,
                children:[
                    { path: '/',name:'category', component: require('./components/masters/hr_development_masters/category/category_list.vue').default },
                    { path: '/list_category', name:'list_category', component: require('./components/masters/hr_development_masters/category/category_list.vue').default },
                    { path: '/create_category',name:'create_category', component: require('./components/masters/hr_development_masters/category/create_category.vue').default },
                    { path: '/edit_category', name:'edit_category', component: require('./components/masters/hr_development_masters/category/edit_category.vue').default },
                ],
            },
            { path: '/donor_agency',
                component: require('./components/masters/hr_development_masters/donor_agency/donor_agency_index.vue').default,
                children:[
                    { path: '/',name:'donor_agency', component: require('./components/masters/hr_development_masters/donor_agency/donor_agency_list.vue').default },
                    { path: '/list_donor_agency', name:'list_donor_agency', component: require('./components/masters/hr_development_masters/donor_agency/donor_agency_list.vue').default },
                    { path: '/create_donor_agency',name:'create_donor_agency', component: require('./components/masters/hr_development_masters/donor_agency/create_donor_agency.vue').default },
                    { path: '/edit_donor_agency', name:'edit_donor_agency', component: require('./components/masters/hr_development_masters/donor_agency/edit_donor_agency.vue').default },
                ],
            },
            { path: '/project_donor_agency',
                component: require('./components/masters/hr_development_masters/project_donor_agency/project_donor_agency_index.vue').default,
                children:[
                    { path: '/',name:'project_donor_agency', component: require('./components/masters/hr_development_masters/project_donor_agency/project_donor_agency_list.vue').default },
                    { path: '/list_project_donor_agency', name:'list_project_donor_agency', component: require('./components/masters/hr_development_masters/project_donor_agency/project_donor_agency_list.vue').default },
                    { path: '/create_project_donor_agency',name:'create_project_donor_agency', component: require('./components/masters/hr_development_masters/project_donor_agency/create_project_donor_agency.vue').default },
                    { path: '/edit_project_donor_agency', name:'edit_project_donor_agency', component: require('./components/masters/hr_development_masters/project_donor_agency/edit_project_donor_agency.vue').default },
                ],
            },
            { path: '/degree',
                component: require('./components/masters/hr_development_masters/degree/degree_index.vue').default,
                children:[
                    { path: '/',name:'degree', component: require('./components/masters/hr_development_masters/degree/degree_list.vue').default },
                    { path: '/list_degree', name:'list_degree', component: require('./components/masters/hr_development_masters/degree/degree_list.vue').default },
                    { path: '/create_degree',name:'create_degree', component: require('./components/masters/hr_development_masters/degree/create_degree.vue').default },
                    { path: '/edit_degree', name:'edit_degree', component: require('./components/masters/hr_development_masters/degree/edit_degree.vue').default },
                ],
            },
            { path: '/nature_of_participation',
                component: require('./components/masters/hr_development_masters/nature_of_participation/nature_of_participation_index.vue').default,
                children:[
                    { path: '/',name:'nature_of_participation', component: require('./components/masters/hr_development_masters/nature_of_participation/nature_of_participation_list.vue').default },
                    { path: '/list_nature_of_participation', name:'list_nature_of_participation', component: require('./components/masters/hr_development_masters/nature_of_participation/nature_of_participation_list.vue').default },
                    { path: '/create_nature_of_participation',name:'create_nature_of_participation', component: require('./components/masters/hr_development_masters/nature_of_participation/create_nature_of_participation.vue').default },
                    { path: '/edit_nature_of_participation', name:'edit_nature_of_participation', component: require('./components/masters/hr_development_masters/nature_of_participation/edit_nature_of_participation.vue').default },
                ],
            },
            { path: '/target_group',
                component: require('./components/masters/hr_development_masters/target_group/target_group_index.vue').default,
                children:[
                    { path: '/',name:'target_group', component: require('./components/masters/hr_development_masters/target_group/target_group_list.vue').default },
                    { path: '/list_target_group', name:'list_target_group', component: require('./components/masters/hr_development_masters/target_group/target_group_list.vue').default },
                    { path: '/create_target_group',name:'create_target_group', component: require('./components/masters/hr_development_masters/target_group/create_target_group.vue').default },
                    { path: '/edit_target_group', name:'edit_target_group', component: require('./components/masters/hr_development_masters/target_group/edit_target_group.vue').default },
                ],
            },
        ]
    },

    //Staff services master link
    { path: '/staff_award_index',
        component: require('./components/masters/staff_servces_masters/staff_service_master_index.vue').default,
        children:[
            {path: '/',name:'staff_award_index', component: require('./components/masters/staff_servces_masters/staff_service_master_list.vue').default },

            { path: '/staff_award_category_index',
                component: require('./components/masters/staff_servces_masters/staff_award_category/staff_award_category_index.vue').default,
                children:[
                { path: '/',name:'staff_award_category_index', component: require('./components/masters/staff_servces_masters/staff_award_category/list_staff_award_category.vue').default },
                { path: '/list_staff_award_category',name:'list_staff_award_category', component: require('./components/masters/staff_servces_masters/staff_award_category/list_staff_award_category.vue').default },
                { path: '/create_staff_award_category',name:'create_staff_award_category', component: require('./components/masters/staff_servces_masters/staff_award_category/create_staff_award_category.vue').default },
                { path: '/edit_staff_award_category', name:'edit_staff_award_category', component: require('./components/masters/staff_servces_masters/staff_award_category/edit_staff_award_category.vue').default },
                ],
            },
            { path: '/staff_award_type_index',
                component: require('./components/masters/staff_servces_masters/staff_award_type/staff_award_type_index.vue').default,
                children:[
                { path: '/',name:'staff_award_type_index', component: require('./components/masters/staff_servces_masters/staff_award_type/list_staff_award_type.vue').default },
                { path: '/list_staff_award_type',name:'list_staff_award_type', component: require('./components/masters/staff_servces_masters/staff_award_type/list_staff_award_type.vue').default },
                { path: '/create_staff_award_type',name:'create_staff_award_type', component: require('./components/masters/staff_servces_masters/staff_award_type/create_staff_award_type.vue').default },
                { path: '/edit_staff_award_type', name:'edit_staff_award_type', component: require('./components/masters/staff_servces_masters/staff_award_type/edit_staff_award_type.vue').default },
                ],
            },
            { path: '/staff_responsibilities_index',
                component: require('./components/masters/staff_servces_masters/staff_responsibility/staff_responsibility_index.vue').default,
                children:[
                { path: '/',name:'staff_responsibilities_index', component: require('./components/masters/staff_servces_masters/staff_responsibility/list_staff_responsibility.vue').default },
                { path: '/list_staff_responsibility',name:'list_staff_responsibility', component: require('./components/masters/staff_servces_masters/staff_responsibility/list_staff_responsibility.vue').default },
                { path: '/create_staff_responsibility',name:'create_staff_responsibility', component: require('./components/masters/staff_servces_masters/staff_responsibility/create_staff_responsibility.vue').default },
                { path: '/edit_staff_responsibility', name:'edit_staff_responsibility', component: require('./components/masters/staff_servces_masters/staff_responsibility/edit_staff_responsibility.vue').default },
                ],
            },
            { path: '/offence_type_index',
                component: require('./components/masters/staff_servces_masters/offence_type/offence_type_index.vue').default,
                children:[
                { path: '/',name:'offence_type_index', component: require('./components/masters/staff_servces_masters/offence_type/list_offence_type.vue').default },
                { path: '/list_offence_type',name:'list_offence_type', component: require('./components/masters/staff_servces_masters/offence_type/list_offence_type.vue').default },
                { path: '/create_offence_type',name:'create_offence_type', component: require('./components/masters/staff_servces_masters/offence_type/create_offence_type.vue').default },
                { path: '/edit_offence_type', name:'edit_offence_type', component: require('./components/masters/staff_servces_masters/offence_type/edit_offence_type.vue').default },
                ],
            },
            { path: '/offence_severity_index',
                component: require('./components/masters/staff_servces_masters/offence_severity/offence_severity_index.vue').default,
                children:[
                { path: '/',name:'offence_severity_index', component: require('./components/masters/staff_servces_masters/offence_severity/list_offence_severity.vue').default },
                { path: '/list_offence_severity',name:'list_offence_severity', component: require('./components/masters/staff_servces_masters/offence_severity/list_offence_severity.vue').default },
                { path: '/create_offence_severity',name:'create_offence_severity', component: require('./components/masters/staff_servces_masters/offence_severity/create_offence_severity.vue').default },
                { path: '/edit_offence_severity', name:'edit_offence_severity', component: require('./components/masters/staff_servces_masters/offence_severity/edit_offence_severity.vue').default },
                ],
            },
            { path: '/offence_action_index',
                component: require('./components/masters/staff_servces_masters/offence_action/offence_action_index.vue').default,
                children:[
                { path: '/',name:'offence_action_index', component: require('./components/masters/staff_servces_masters/offence_action/list_offence_action.vue').default },
                { path: '/list_offence_action',name:'list_offence_action', component: require('./components/masters/staff_servces_masters/offence_action/list_offence_action.vue').default },
                { path: '/create_offence_action',name:'create_offence_action', component: require('./components/masters/staff_servces_masters/offence_action/create_offence_action.vue').default },
                { path: '/edit_offence_action', name:'edit_offence_action', component: require('./components/masters/staff_servces_masters/offence_action/edit_offence_action.vue').default },
                ],
            },

        ]
    },
    //STAFF PROFILE (Detailed Profile)

    { path: '/staff_profile',name:'staff_profile', component: require('./components/staff/staff_profile/staff_profile.vue').default },

    //STAFF Transactions
    { path:'/staff_registration',
        component: require('./components/staff/index.vue').default,
        children:[
            { path: '/',name:'staff_registration', component: require('./components/staff/staff_default_page.vue').default },
            { path: '/civil_staff',
                component: require('./components/staff/civil/civil_index.vue').default,
                children:[
                    { path: '/',name:'civil_staff',  component: require('./components/staff/civil/civil_list.vue').default },
                    { path: '/list_civil_staff',name:'list_civil_staff',  component: require('./components/staff/civil/civil_list.vue').default },
                    { path: '/create_civil_staff',name:'create_civil_staff',  component: require('./components/staff/civil/create_civil_staff.vue').default },
                    { path: '/edit_civil_staff',name:'edit_civil_staff',  component: require('./components/staff/civil/edit_civil_staff.vue').default },
                    { path: '/view_civil_staff',name:'view_civil_staff',  component: require('./components/staff/civil/view_civil_staff.vue').default },
                ],
            },

            { path: '/private_staff',
                component: require('./components/staff/private/private_staff_index.vue').default,
                children:[
                    { path: '/',name:'private_staff',  component: require('./components/staff/private/private_staff_list.vue').default },
                    { path: '/list_private_staff',name:'list_private_staff',  component: require('./components/staff/private/private_staff_list.vue').default },
                    { path: '/create_private_staff',name:'create_private_staff', component: require('./components/staff/private/create_private_staff.vue').default },
                    { path: '/edit_private_staff', name:'edit_private_staff', component: require('./components/staff/private/edit_private_staff.vue').default },
                ],
            },
            { path: '/staff_appointment',
                component: require('./components/staff/staff_appointment/staff_appointment_index.vue').default,
                children:[
                    { path: '/',name:'staff_appointment',  component: require('./components/staff/staff_appointment/staff_appointment_list.vue').default },
                    { path: '/list_staff_appointment',name:'list_staff_appointment',  component: require('./components/staff/staff_appointment/staff_appointment_list.vue').default },
                    { path: '/create_staff_appointment',name:'create_staff_appointment', component: require('./components/staff/staff_appointment/create_staff_appointment.vue').default },
                    { path: '/view_staff_appointment',name:'view_staff_appointment', component: require('./components/staff/staff_appointment/view_staff_appointment.vue').default },
                ],
            },
            //Transfer reporting from staff transfer
            { path: '/reporting',
            component: require('./components/staff/reporting/report_index.vue').default,
                children:[
                    { path: '/',name:'reporting', component: require('./components/staff/reporting/report_list.vue').default },
                    { path: '/view_report_transfer',name:'view_report_transfer', component: require('./components/staff/transfer/transfer_report/view_report_transfer.vue').default },
                    { path: '/reporting_list',name:'reporting_list', component: require('./components/staff/reporting/report_list.vue').default },
                    { path: '/update_leadership_reporting',name:'update_leadership_reporting', component: require('./components/staff/reporting/update_leadership_reporting.vue').default },
                ],
            },

            { path: '/transfer_window_index',
                component: require('./components/staff/transfer_window/transfer_window_index.vue').default,
                children:[
                    { path: '/', name:'transfer_window_index',  component: require('./components/staff/transfer_window/transfer_window_list.vue').default },
                    { path: '/list_transfer_window',name:'list_transfer_window',  component: require('./components/staff/transfer_window/transfer_window_list.vue').default },
                    { path: '/create_transfer_window',name:'create_transfer_window', component: require('./components/staff/transfer_window/create_transfer_window.vue').default },
                    { path: '/edit_transfer_window', name:'edit_transfer_window', component: require('./components/staff/transfer_window/edit_transfer_window.vue').default },
                ],
            },

            { path: '/seperation_details',
                component: require('./components/staff/second_seperation/seperation_details/seperation_index.vue').default,
                children:[
                    { path: '/', name:'seperation_details',  component: require('./components/staff/second_seperation/seperation_details/list_seperation_details.vue').default },
                    { path: '/list_seperation_details',name:'list_seperation_details',  component: require('./components/staff/second_seperation/seperation_details/list_seperation_details.vue').default },
                    { path: '/create_seperation_details',name:'create_seperation_details', component: require('./components/staff/second_seperation/seperation_details/create_seperation_details.vue').default },
                    { path: '/edit_seperation_details', name:'edit_seperation_details', component: require('./components/staff/second_seperation/seperation_details/edit_seperation_details.vue').default },
                ],
            },
        ]
    },

    //Transfer Applicaiton
    { path:'/transfer_service_index', component: require('./components/staff/transfer/transfer_index.vue').default,
        children:[
            { path: '/',name:'transfer_service_index', component: require('./components/staff/transfer/transfer_list.vue').default },
            { path: '/intra_transfer',
                component: require('./components/staff/transfer/intra_transfer/intra_transfer_index.vue').default,
                children:[
                    { path: '/', name:'intra_transfer',  component: require('./components/staff/transfer/intra_transfer/intra_transfer_list.vue').default },
                    { path: '/list_intra_transfer',name:'list_intra_transfer',  component: require('./components/staff/transfer/intra_transfer/intra_transfer_list.vue').default },
                    { path: '/create_intra_transfer',name:'create_intra_transfer', component: require('./components/staff/transfer/intra_transfer/create_intra_transfer.vue').default },
                    { path: '/edit_intra_transfer', name:'edit_intra_transfer', component: require('./components/staff/transfer/intra_transfer/edit_intra_transfer.vue').default },
                    { path: '/intra_transfer_acknowledgement', name:'intra_transfer_acknowledgement', component: require('./components/staff/transfer/intra_transfer/acknowledgement.vue').default },
                ],
            },
            { path: '/inter_transfer',
                component: require('./components/staff/transfer/inter_transfer/inter_transfer_index.vue').default,
                children:[
                    { path: '/', name:'inter_transfer',  component: require('./components/staff/transfer/inter_transfer/inter_transfer_list.vue').default },
                    { path: '/list_inter_transfer',name:'list_inter_transfer',  component: require('./components/staff/transfer/inter_transfer/inter_transfer_list.vue').default },
                    { path: '/create_inter_transfer',name:'create_inter_transfer', component: require('./components/staff/transfer/inter_transfer/create_inter_transfer.vue').default },
                    { path: '/edit_inter_transfer', name:'edit_inter_transfer', component: require('./components/staff/transfer/inter_transfer/edit_inter_transfer.vue').default },
                    { path: '/inter_transfer_acknowledgement', name:'inter_transfer_acknowledgement', component: require('./components/staff/transfer/inter_transfer/acknowledgement.vue').default },
                ],
            },

            { path: '/transfer_appeal',
            component: require('./components/staff/transfer/transfer_appeal/transfer_appeal_index.vue').default,
                children:[
                    { path: '/',name:'transfer_appeal', component: require('./components/staff/transfer/transfer_appeal/list_transfer_appeal.vue').default },
                    { path: '/list_transfer_appeal',name:'list_transfer_appeal', component: require('./components/staff/transfer/transfer_appeal/list_transfer_appeal.vue').default },
                    { path: '/create_transfer_appeal',name:'create_transfer_appeal', component: require('./components/staff/transfer/transfer_appeal/create_transfer_appeal.vue').default },
                    { path: '/edit_transfer_appeal', name:'edit_transfer_appeal', component: require('./components/staff/transfer/transfer_appeal/edit_transfer_appeal.vue').default },
                ],
            },

            { path: '/transfer_list',
            component: require('./components/staff/transfer/transfer_lists/transfer_list_index.vue').default,
                children:[
                    { path: '/',name:'transfer_list', component: require('./components/staff/transfer/transfer_lists/list_transfer.vue').default },
                    { path: '/view_transfer',name:'view_transfer', component: require('./components/staff/transfer/transfer_lists/view_transfer.vue').default },
                ],
            },
            { path: '/appealList',
                component: require('./components/staff/transfer/transferAppealLists/transferAppeal_index.vue').default,
                children:[
                    { path: '/',name:'appealList',  component: require('./components/staff/transfer/transferAppealLists/list_transferAppealLists.vue').default },
                    { path: '/list_transferAppealLists',name:'list_transferAppealLists',  component: require('./components/staff/transfer/transferAppealLists/list_transferAppealLists.vue').default },
                    { path: '/view_transferAppealDetails',name:'view_transferAppealDetails',  component: require('./components/staff/transfer/transferAppealLists/view_transferAppealDetails.vue').default },
                ],
            },

            { path: '/secondment_details',
                component: require('./components/staff/second_seperation/secondment_details/secondment_index.vue').default,
                children:[
                    { path: '/', name:'secondment_details',  component: require('./components/staff/second_seperation/secondment_details/list_secondment_details.vue').default },
                    { path: '/list_secondment_details',name:'list_secondment_details',  component: require('./components/staff/second_seperation/secondment_details/list_secondment_details.vue').default },
                    { path: '/create_secondment_details',name:'create_secondment_details', component: require('./components/staff/second_seperation/secondment_details/create_secondment_details.vue').default },
                    { path: '/edit_secondment_details', name:'edit_secondment_details', component: require('./components/staff/second_seperation/secondment_details/edit_secondment_details.vue').default },
                ],
            },




        ]
    },

    { path: '/inter_transfer_verification',name:'inter_transfer_verification', component: require('./components/staff/transfer/inter_transfer_verification.vue').default },
    { path: '/intra_transfer_verification',name:'intra_transfer_verification', component: require('./components/staff/transfer/intra_transfer_verification.vue').default },
    { path: '/transferAppeal_verification',name:'transferAppeal_verification', component: require('./components/staff/transfer/transferAppeal_verification .vue').default },

    // Recuritment by gagen
    //principal recuritment
    { path: '/recuritment_index', component: require('./components/staff/recuritment/recuritment_index.vue').default,
      children:[
        { path: '/recuritment_index',name:"recuritment_index", component: require('./components/staff/recuritment/principal_recuritment/recuritment_list.vue').default },
        //principal recuritment
        { path: '/pricipal_recuritment_index',
            component: require('./components/staff/recuritment/principal_recuritment/recuritment_index.vue').default ,
            children: [
                { path: '/',name:'pricipal_recuritment_index', component: require('./components/staff/recuritment/principal_recuritment/list_principal_recuritment.vue').default },
                { path: '/list_principal_recuritment',name:'list_principal_recuritment', component: require('./components/staff/recuritment/principal_recuritment/list_principal_recuritment.vue').default },
                { path: '/create_principal_recuritment',name:'create_principal_recuritment', component: require('./components/staff/recuritment/principal_recuritment/create_principal_recuritment.vue').default },
                { path: '/princiapl_recuritment_acknowledgement', name:'princiapl_recuritment_acknowledgement', component: require('./components/staff/recuritment/principal_recuritment/princiapl_recuritment_acknowledgement.vue').default },
                { path: '/principal_recuritment_details',name:'principal_recuritment_details', component: require('./components/staff/recuritment/principal_recuritment/view_principal_recuritment.vue').default },
            ]
        },
        //Expert teacher recuritment
        { path: '/expert_recuritment_index',
            component: require('./components/staff/recuritment/expert_recuritment/recuritment_index.vue').default ,
            children: [
                { path: '/',name:'expert_recuritment_index', component: require('./components/staff/recuritment/expert_recuritment/list_expert_recuritment.vue').default },
                { path: '/list_expert_recuritment',name:'list_expert_recuritment', component: require('./components/staff/recuritment/expert_recuritment/list_expert_recuritment.vue').default },
                { path: '/create_expert_recuritment',name:'create_expert_recuritment', component: require('./components/staff/recuritment/expert_recuritment/create_expert_recuritment.vue').default },
                { path: '/expert_recuritment_acknowledgement', name:'expert_recuritment_acknowledgement', component: require('./components/staff/recuritment/expert_recuritment/expert_recuritment_acknowledgement.vue').default },
                { path: '/expert_recuritment_details',name:'expert_recuritment_details', component: require('./components/staff/recuritment/expert_recuritment/view_application_details.vue').default },
            ]
        },
      ]
    },
    { path: '/open_expatriate_verification',name:'open_expatriate_verification', component: require('./components/staff/recuritment/expatriate_verification.vue').default },
    { path: '/view_principal_recuritment',name:'view_principal_recuritment', component: require('./components/staff/recuritment/view_principal_recuritment.vue').default },

    //Staff Training
    { path:'/create_inset',
        component: require('./components/staff/training/inset_index.vue').default,
        children:[
            { path: '/',name:'create_inset', component: require('./components/staff/training/inset_list.vue').default },
            { path: '/programme_index',
                component: require('./components/staff/training/create_programme/programme_index.vue').default,
                children:[
                    { path: '/',name:'programme_index',  component: require('./components/staff/training/create_programme/list_programme.vue').default },
                    { path: '/list_programme',name:'list_programme',  component: require('./components/staff/training/create_programme/list_programme.vue').default },
                    { path: '/create_training_programme',name:'create_training_programme',  component: require('./components/staff/training/create_programme/create_training_programme.vue').default },
                    { path: '/edit_training_programme',name:'edit_training_programme',  component: require('./components/staff/training/create_programme/edit_training_programme.vue').default },
                    { path: '/view_training_programme',name:'view_training_programme',  component: require('./components/staff/training/create_programme/view_training_programme.vue').default },
                ],
            },

            { path: '/nomination_selection',
                component: require('./components/staff/training/nomination_selection/nomination_selection_index.vue').default,
                children:[
                    { path: '/',name:'nomination_selection',  component: require('./components/staff/training/nomination_selection/list_nomination_selection.vue').default },
                    { path: '/list_nomination_selection',name:'list_nomination_selection',  component: require('./components/staff/training/nomination_selection/list_nomination_selection.vue').default },
                    { path: '/create_nomination_selection',name:'create_nomination_selection',  component: require('./components/staff/training/nomination_selection/create_nomination_selection.vue').default },
                    { path: '/edit_nomination_selection',name:'edit_nomination_selection',  component: require('./components/staff/training/nomination_selection/edit_nomination_selection.vue').default },
                    { path: '/verify_nomination_selection',name:'verify_nomination_selection',  component: require('./components/staff/training/nomination_selection/verify_nomination_selection.vue').default },
                    { path: '/acknowledgement_for_nomination', name:'acknowledgement_for_nomination', component: require('./components/staff/acknowledgement_for_errors.vue').default },
                    { path: '/acknowledgement_for_nomination_success', name:'acknowledgement_for_nomination_success', component: require('./components/staff/acknowledgement.vue').default },
                ],
            },

            { path: '/participant',
                component: require('./components/staff/training/participant/participant_index.vue').default,
                children:[
                    { path: '/',name:'participant',  component: require('./components/staff/training/participant/list_participant.vue').default },
                    { path: '/list_participant',name:'list_participant',  component: require('./components/staff/training/participant/list_participant.vue').default },
                    { path: '/create_participant',name:'create_participant',  component: require('./components/staff/training/participant/create_participant.vue').default },
                    { path: '/view_participant',name:'view_participant',  component: require('./components/staff/training/participant/view_participant.vue').default },
                    { path: '/acknowledgement_for_participant', name:'acknowledgement_for_participant', component: require('./components/staff/acknowledgement_for_errors.vue').default },
                ],
            },

            { path: '/promotion',
                component: require('./components/staff/training/promotion/promotion_index.vue').default,
                children:[
                    { path: '/',name:'promotion',  component: require('./components/staff/training/promotion/list_promotion.vue').default },
                    { path: '/list_promotion',name:'list_promotion',  component: require('./components/staff/training/promotion/list_promotion.vue').default },
                    { path: '/view_promotion',name:'view_promotion',  component: require('./components/staff/training/promotion/view_promotion.vue').default },
                ],
            },

            { path: '/longtermtraining',
                component: require('./components/staff/training/longtermtraining/longtermtraining_index.vue').default,
                children:[
                    { path: '/',name:'longtermtraining',  component: require('./components/staff/training/longtermtraining/list_longtermtraining.vue').default },
                    { path: '/list_longtermtraining',name:'list_longtermtraining',  component: require('./components/staff/training/longtermtraining/list_longtermtraining.vue').default },
                    { path: '/view_longtermtraining',name:'view_longtermtraining',  component: require('./components/staff/training/longtermtraining/view_longtermtraining.vue').default },
                ],
            },
        ]
    },

    //Management Body Transactions
    { path:'/management_body',
        component: require('./components/staff/management/management_body_index.vue').default,
        children:[
            { path: '/', name:'management_body', component: require('./components/staff/management/management_body_list.vue').default },

            { path: '/create_management_body_index',
                component: require('./components/staff/management/create_body/management_body_index.vue').default,
                children:[
                    { path: '/', name:'create_management_body_index',  component: require('./components/staff/management/create_body/list_management_body.vue').default },
                    { path: '/list_management_body',name:'list_management_89body',  component: require('./components/staff/management/create_body/list_management_body.vue').default },
                    { path: '/create_management_body',name:'create_management_body',  component: require('./components/staff/management/create_body/create_management_body.vue').default },
                    { path: '/edit_management_body',name:'edit_management_body',  component: require('./components/staff/management/create_body/edit_management_body.vue').default },
                ],
            },


            { path:'/management_meeting',
                component: require('./components/staff/management/create_meeting/meeting_body_index.vue').default,
                children:[
                    { path: '/', name:'management_meeting',  component: require('./components/staff/management/create_meeting/list_management_body_for_meeting.vue').default },
                    { path: '/', name:'list_management_body_for_meeting',  component: require('./components/staff/management/create_meeting/list_management_body_for_meeting.vue').default },
                    { path: '/open_meeting',name:'open_meeting', component: require('./components/staff/management/create_meeting/open_meeting.vue').default},
                    { path: '/create_management_meeting',name:'create_management_meeting', component: require('./components/staff/management/create_meeting/create_management_meeting.vue').default},
                ],
            },
            { path: '/acknowledgement', name:'acknowledgement', component: require('./components/staff/acknowledgement.vue').default },
            { path: '/acknowledgement_for_errors', name:'acknowledgement_for_errors', component: require('./components/staff/acknowledgement_for_errors.vue').default },
        ]
    },

    //Leave Services
    { path:'/leave_service_index',
        component: require('./components/staff/leave_services/leave_index.vue').default,
        children:[
            { path: '/', name:'leave_service_index', component: require('./components/staff/leave_services/leave_list.vue').default },

            { path: '/apply_leave',
                component: require('./components/staff/leave_services/apply_leave/leave_index.vue').default,
                children:[
                    { path: '/', name:'apply_leave',  component: require('./components/staff/leave_services/apply_leave/list_leave.vue').default },
                    { path: '/list_leave',name:'list_leave',  component: require('./components/staff/leave_services/apply_leave/list_leave.vue').default },
                    { path: '/create_leave',name:'create_leave', component: require('./components/staff/leave_services/apply_leave/create_leave.vue').default },
                    { path: '/edit_leave', name:'edit_leave', component: require('./components/staff/leave_services/apply_leave/edit_leave.vue').default },
                    { path: '/Leave_acknowledgement', name:'Leave_acknowledgement', component: require('./components/staff/leave_services/apply_leave/leave_acknowledgement.vue').default },
                ],
            },
        ]
    },
     //Staff Update Services
    { path:'/staff_update_services',
        component: require('./components/staff/staff_updates/staff_update_index.vue').default,
        children:[
            { path: '/', name:'staff_update_services', component: require('./components/staff/staff_updates/staff_update_list.vue').default },

            { path: '/career_stage',
                component: require('./components/staff/staff_updates/career_stage/career_stage_index.vue').default,
                children:[
                    { path: '/', name:'career_stage',  component: require('./components/staff/staff_updates/career_stage/list_career_stage.vue').default },
                    { path: '/list_career_stage',name:'list_career_stage',  component: require('./components/staff/staff_updates/career_stage/list_career_stage.vue').default },
                    { path: '/create_career_stage',name:'create_career_stage', component: require('./components/staff/staff_updates/career_stage/create_career_stage.vue').default },
                    { path: '/edit_career_stage', name:'edit_career_stage', component: require('./components/staff/staff_updates/career_stage/edit_career_stage.vue').default },
                ],
            },
            { path: '/teacher_subject',
                component: require('./components/staff/staff_updates/teacher_subject/teacher_subject_index.vue').default,
                children:[
                    { path: '/', name:'teacher_subject',  component: require('./components/staff/staff_updates/teacher_subject/list_teacher_subject.vue').default },
                    { path: '/list_teacher_subject',name:'list_teacher_subject',  component: require('./components/staff/staff_updates/teacher_subject/list_teacher_subject.vue').default },
                    { path: '/create_teacher_subject',name:'create_teacher_subject', component: require('./components/staff/staff_updates/teacher_subject/create_teacher_subject.vue').default },
                    { path: '/edit_teacher_subject', name:'edit_teacher_subject', component: require('./components/staff/staff_updates/teacher_subject/edit_teacher_subject.vue').default },
                ],
            },
            { path: '/staff_sen',
                component: require('./components/staff/staff_updates/sen/sen_index.vue').default,
                children:[
                    { path: '/', name:'staff_sen',  component: require('./components/staff/staff_updates/sen/list_sen.vue').default },
                    { path: '/list_sen',name:'list_sen',  component: require('./components/staff/staff_updates/sen/list_sen.vue').default },
                    { path: '/view_sen',name:'view_sen', component: require('./components/staff/staff_updates/sen/view_sen.vue').default },
                    { path: '/edit_sen', name:'edit_sen', component: require('./components/staff/staff_updates/sen/edit_sen.vue').default },
                ],
            },

            { path: '/contact_details',
                component: require('./components/staff/staff_updates/contact_details/contact_details_index.vue').default,
                children:[
                    { path: '/', name:'contact_details',  component: require('./components/staff/staff_updates/contact_details/list_contact_details.vue').default },
                    { path: '/list_contact_details',name:'list_contact_details',  component: require('./components/staff/staff_updates/contact_details/list_contact_details.vue').default },
                    { path: '/create_contact_details',name:'create_contact_details', component: require('./components/staff/staff_updates/contact_details/create_contact_details.vue').default },
                    { path: '/edit_contact_details', name:'edit_contact_details', component: require('./components/staff/staff_updates/contact_details/edit_contact_details.vue').default },
                ],
            },
            { path: '/relative_details',
                component: require('./components/staff/staff_updates/relative_details/relative_details_index.vue').default,
                children:[
                    { path: '/', name:'relative_details',  component: require('./components/staff/staff_updates/relative_details/list_relative_details.vue').default },
                    { path: '/list_relative_details',name:'list_relative_details',  component: require('./components/staff/staff_updates/relative_details/list_relative_details.vue').default },
                    { path: '/create_relative_details',name:'create_relative_details', component: require('./components/staff/staff_updates/relative_details/create_relative_details.vue').default },
                    { path: '/edit_relative_details', name:'edit_relative_details', component: require('./components/staff/staff_updates/relative_details/edit_relative_details.vue').default },
                ],
            },
            { path: '/maritial_status',
                component: require('./components/staff/staff_updates/maritial_status/maritial_status_index.vue').default,
                children:[
                    { path: '/', name:'maritial_status',  component: require('./components/staff/staff_updates/maritial_status/list_maritial_status.vue').default },
                    { path: '/list_maritial_status',name:'list_maritial_status',  component: require('./components/staff/staff_updates/maritial_status/list_maritial_status.vue').default },
                    { path: '/create_maritial_status',name:'create_maritial_status', component: require('./components/staff/staff_updates/maritial_status/create_maritial_status.vue').default },
                    { path: '/edit_maritial_status', name:'edit_maritial_status', component: require('./components/staff/staff_updates/maritial_status/edit_maritial_status.vue').default },
                ],
            },
        ]
    },

    //Staff Update Services (done by individual staff for their profile)
    { path:'/staff_self_update',
        component: require('./components/staff/staff_self_update/staff_self_update_index.vue').default,
        children:[
            { path: '/', name:'staff_self_update', component: require('./components/staff/staff_self_update/staff_self_update_list.vue').default },
            { path: '/self_contact_details',
                component: require('./components/staff/staff_self_update/self_contact_details/self_contact_details_index.vue').default,
                children:[
                    { path: '/', name:'self_contact_details',  component: require('./components/staff/staff_self_update/self_contact_details/list_self_contact_details.vue').default },
                    { path: '/list_self_contact_details',name:'list_self_contact_details',  component: require('./components/staff/staff_self_update/self_contact_details/list_self_contact_details.vue').default },
                    { path: '/create_self_contact_details',name:'create_self_contact_details', component: require('./components/staff/staff_self_update/self_contact_details/create_self_contact_details.vue').default },
                    { path: '/edit_self_contact_details', name:'edit_self_contact_details', component: require('./components/staff/staff_self_update/self_contact_details/edit_self_contact_details.vue').default },
                ],
            },
            { path: '/self_relative_details',
                component: require('./components/staff/staff_self_update/self_relative_details/self_relative_details_index.vue').default,
                children:[
                    { path: '/', name:'self_relative_details',  component: require('./components/staff/staff_self_update/self_relative_details/list_self_relative_details.vue').default },
                    { path: '/list_self_relative_details',name:'list_self_relative_details',  component: require('./components/staff/staff_self_update/self_relative_details/list_self_relative_details.vue').default },
                    { path: '/create_self_relative_details',name:'create_self_relative_details', component: require('./components/staff/staff_self_update/self_relative_details/create_self_relative_details.vue').default },
                    { path: '/edit_self_relative_details', name:'edit_self_relative_details', component: require('./components/staff/staff_self_update/self_relative_details/edit_self_relative_details.vue').default },
                ],
            },
            { path: '/self_maritial_status',
                component: require('./components/staff/staff_self_update/self_maritial_status/self_maritial_status_index.vue').default,
                children:[
                    { path: '/', name:'self_maritial_status',  component: require('./components/staff/staff_self_update/self_maritial_status/list_self_maritial_status.vue').default },
                    { path: '/list_self_maritial_status',name:'list_self_maritial_status',  component: require('./components/staff/staff_self_update/self_maritial_status/list_self_maritial_status.vue').default },
                    { path: '/create_self_maritial_status',name:'create_self_maritial_status', component: require('./components/staff/staff_self_update/self_maritial_status/create_self_maritial_status.vue').default },
                    { path: '/edit_self_maritial_status', name:'edit_self_maritial_status', component: require('./components/staff/staff_self_update/self_maritial_status/edit_self_maritial_status.vue').default },
                ],
            },
        ]
    },

     //Secondment & Seperation
    { path:'/staff_second_seperation',
        component: require('./components/staff/second_seperation/second_seperation_index.vue').default,
        children:[
            { path: '/', name:'staff_second_seperation', component: require('./components/staff/second_seperation/second_seperation_list.vue').default },



        ]
    },
        // { path: '/self_contact_details',
        //     component: require('./components/staff/staff_self_update/self_contact_details/self_contact_details_index.vue').default,
        //     children:[
        //         { path: '/', name:'self_contact_details',  component: require('./components/staff/staff_self_update/self_contact_details/create_self_contact_details.vue').default },
        //         { path: '/list_self_contact_details',name:'list_self_contact_details',  component: require('./components/staff/staff_self_update/self_contact_details/list_self_contact_details.vue').default },
        //         { path: '/create_self_contact_details',name:'create_self_contact_details', component: require('./components/staff/staff_self_update/self_contact_details/create_self_contact_details.vue').default },
        //         { path: '/edit_self_contact_details', name:'edit_self_contact_details', component: require('./components/staff/staff_self_update/self_contact_details/edit_self_contact_details.vue').default },
        //     ],
        // },
        // { path: '/self_relative_details',
        //     component: require('./components/staff/staff_self_update/self_relative_details/self_relative_details_index.vue').default,
        //     children:[
        //         { path: '/', name:'self_relative_details',  component: require('./components/staff/staff_self_update/self_relative_details/create_self_relative_details.vue').default },
        //         { path: '/list_self_relative_details',name:'list_self_relative_details',  component: require('./components/staff/staff_self_update/self_relative_details/list_self_relative_details.vue').default },
        //         { path: '/create_self_relative_details',name:'create_self_relative_details', component: require('./components/staff/staff_self_update/self_relative_details/create_self_relative_details.vue').default },
        //         { path: '/edit_self_relative_details', name:'edit_self_relative_details', component: require('./components/staff/staff_self_update/self_relative_details/edit_self_relative_details.vue').default },
        //     ],
        // },
        // { path: '/self_maritial_status',
        //     component: require('./components/staff/staff_self_update/self_maritial_status/self_maritial_status_index.vue').default,
        //     children:[
        //         { path: '/', name:'self_maritial_status',  component: require('./components/staff/staff_self_update/self_maritial_status/create_self_maritial_status.vue').default },
        //         { path: '/list_self_maritial_status',name:'list_self_maritial_status',  component: require('./components/staff/staff_self_update/self_maritial_status/list_self_maritial_status.vue').default },
        //         { path: '/create_self_maritial_status',name:'create_self_maritial_status', component: require('./components/staff/staff_self_update/self_maritial_status/create_self_maritial_status.vue').default },
        //         { path: '/edit_self_maritial_status', name:'edit_self_maritial_status', component: require('./components/staff/staff_self_update/self_maritial_status/edit_self_maritial_status.vue').default },
        //     ],
        // },
        //     ]
        // },

    { path: '/leave_verification',name:'leave_verification', component: require('./components/staff/leave_services/apply_leave/leave_verification.vue').default },

    //Leadership Selection
    { path:'/staff_leadership_selection_index',
        component: require('./components/staff/leadership/leadership_index.vue').default,
        children:[
            { path: '/', name:'staff_leadership_selection_index', component: require('./components/staff/leadership/leadership_list.vue').default },
            { path: '/announcement',
                component: require('./components/staff/leadership/announcement/announcement_index.vue').default,
                children:[
                    { path: '/', name:'announcement',  component: require('./components/staff/leadership/announcement/list_announcement.vue').default },
                    { path: '/list_announcement',name:'list_announcement',  component: require('./components/staff/leadership/announcement/list_announcement.vue').default },
                    { path: '/create_announcement',name:'create_announcement', component: require('./components/staff/leadership/announcement/create_announcement.vue').default },
                    { path: '/edit_announcement', name:'edit_announcement', component: require('./components/staff/leadership/announcement/edit_announcement.vue').default },
                    { path: '/view_announcement', name:'view_announcement', component: require('./components/staff/leadership/announcement/view_announcement.vue').default },
                ],
            },
            { path: '/apply_index',
                component: require('./components/staff/leadership/application/application_index.vue').default,
                children:[
                    { path: '/', name:'apply_index',  component: require('./components/staff/leadership/application/list_application.vue').default },
                    { path: '/list_application',name:'list_application',  component: require('./components/staff/leadership/application/list_application.vue').default },
                    { path: '/create_application',name:'create_application', component: require('./components/staff/leadership/application/create_application.vue').default },
                    { path: '/edit_application', name:'edit_application', component: require('./components/staff/leadership/application/edit_application.vue').default },
                    { path: '/view_application', name:'view_application', component: require('./components/staff/leadership/application/view_application.vue').default },
                    { path: '/application_acknowledgement', name:'application_acknowledgement', component: require('./components/staff/leadership/application/acknowledgement.vue').default },
                ],
            },

            { path: '/nomination_index',
                component: require('./components/staff/leadership/leadership_nomination/leadership_nomination_index.vue').default,
                children:[
                    { path: '/', name:'nomination_index',  component: require('./components/staff/leadership/leadership_nomination/list_leadership_nomination.vue').default },
                    { path: '/list_leadership_nomination',name:'list_leadership_nomination',  component: require('./components/staff/leadership/leadership_nomination/list_leadership_nomination.vue').default },
                    { path: '/create_leadership_nomination',name:'create_leadership_nomination', component: require('./components/staff/leadership/leadership_nomination/create_leadership_nomination.vue').default },
                    { path: '/edit_leadership_nomination', name:'edit_leadership_nomination', component: require('./components/staff/leadership/leadership_nomination/edit_leadership_nomination.vue').default },
                ],
            },
            { path: '/leadership_feedback',
                component: require('./components/staff/leadership/feedback/feedback_index.vue').default,
                children:[
                    { path: '/', name:'leadership_feedback',  component: require('./components/staff/leadership/feedback/feedback_list.vue').default },
                    { path: '/list_feedback', name:'list_feedback',  component: require('./components/staff/leadership/feedback/feedback_list.vue').default },
                    { path: '/open_feedback', name:'open_feedback',  component: require('./components/staff/leadership/feedback/open_feedback.vue').default },
                ],
            },

            { path: '/leadership_type_index',
                component: require('./components/staff/leadership/questions/leadership_type/leadership_type_index.vue').default,
                children:[
                    { path: '/',name:'leadership_type_index',  component: require('./components/staff/leadership/questions/leadership_type/list_leadership_type.vue').default },
                    { path: '/list_leadership_type',name:'list_leadership_type',  component: require('./components/staff/leadership/questions/leadership_type/list_leadership_type.vue').default },
                    { path: '/create_leadership_type',name:'create_leadership_type',  component: require('./components/staff/leadership/questions/leadership_type/create_leadership_type.vue').default },
                    { path: '/edit_leadership_type',name:'edit_leadership_type',  component: require('./components/staff/leadership/questions/leadership_type/edit_leadership_type.vue').default },
                ],
            },
            { path: '/feedback_category',
                component: require('./components/staff/leadership/questions/feedback_category/feedback_category_index.vue').default,
                children:[
                    { path: '/',name:'feedback_category',  component: require('./components/staff/leadership/questions/feedback_category/list_feedback_category.vue').default },
                    { path: '/list_feedback_category',name:'list_feedback_category',  component: require('./components/staff/leadership/questions/feedback_category/list_feedback_category.vue').default },
                    { path: '/create_feedback_category',name:'create_feedback_category',  component: require('./components/staff/leadership/questions/feedback_category/create_feedback_category.vue').default },
                    { path: '/edit_feedback_category',name:'edit_feedback_category',  component: require('./components/staff/leadership/questions/feedback_category/edit_feedback_category.vue').default },
                ],
            },
            { path: '/question_answer',
                component: require('./components/staff/leadership/questions/question_answer/question_answer_index.vue').default,
                children:[
                    { path: '/',name:'question_answer',  component: require('./components/staff/leadership/questions/question_answer/list_question_answer.vue').default },
                    { path: '/list_question_answer',name:'list_question_answer',  component: require('./components/staff/leadership/questions/question_answer/list_question_answer.vue').default },
                    { path: '/create_question_answer',name:'create_question_answer',  component: require('./components/staff/leadership/questions/question_answer/create_question_answer.vue').default },
                    { path: '/edit_question_answer',name:'edit_question_answer',  component: require('./components/staff/leadership/questions/question_answer/edit_question_answer.vue').default },
                ],
            },

        ]
    },
    { path: '/open_staff_recruitment_verification', name:'open_staff_recruitment_verification', component: require('./components/staff/leadership/verify_approve_leadership_selection_application.vue').default },
    //Staff Services
    { path:'/staff_services_index',
        component: require('./components/staff/staff_services/staff_service_index.vue').default,
        children:[
            { path: '/', name:'staff_services_index', component: require('./components/staff/staff_services/staff_service_list.vue').default },

            { path: '/staff_awards',
                component: require('./components/staff/staff_services/staff_awards/staff_awards_index.vue').default,
                children:[
                    { path: '/', name:'staff_awards',  component: require('./components/staff/staff_services/staff_awards/staff_awards_list.vue').default },
                    { path: '/list_staff_awards',name:'list_staff_awards',  component: require('./components/staff/staff_services/staff_awards/staff_awards_list.vue').default },
                    { path: '/create_staff_awards',name:'create_staff_awards', component: require('./components/staff/staff_services/staff_awards/create_staff_awards.vue').default },
                    { path: '/edit_staff_awards', name:'edit_staff_awards', component: require('./components/staff/staff_services/staff_awards/edit_staff_awards.vue').default },
                    { path: '/view_staff_awards', name:'view_staff_awards', component: require('./components/staff/staff_services/staff_awards/view_staff_awards.vue').default },
                ],
            },
            { path: '/staff_responsibilities',
                component: require('./components/staff/staff_services/roles_responsibilities/roles_responsibilities_index.vue').default,
                children:[
                    { path: '/', name:'staff_responsibilities',  component: require('./components/staff/staff_services/roles_responsibilities/list_roles_responsibilities.vue').default },
                    { path: '/list_roles_responsibilities',name:'list_roles_responsibilities',  component: require('./components/staff/staff_services/roles_responsibilities/list_roles_responsibilities.vue').default },
                    { path: '/create_roles_responsibilities',name:'create_roles_responsibilities', component: require('./components/staff/staff_services/roles_responsibilities/create_roles_responsibilities.vue').default },
                    { path: '/edit_roles_responsibilities', name:'edit_roles_responsibilities', component: require('./components/staff/staff_services/roles_responsibilities/edit_roles_responsibilities.vue').default },
                ],
            },
            { path: '/staff_disciplinary',
                component: require('./components/staff/staff_services/staff_disciplinary/staff_disciplinary_index.vue').default,
                children:[
                    { path: '/', name:'staff_disciplinary',  component: require('./components/staff/staff_services/staff_disciplinary/list_staff_disciplinary.vue').default },
                    { path: '/list_staff_disciplinary',name:'list_staff_disciplinary',  component: require('./components/staff/staff_services/staff_disciplinary/list_staff_disciplinary.vue').default },
                    { path: '/create_staff_disciplinary',name:'create_staff_disciplinary', component: require('./components/staff/staff_services/staff_disciplinary/create_staff_disciplinary.vue').default },
                    { path: '/edit_staff_disciplinary', name:'edit_staff_disciplinary', component: require('./components/staff/staff_services/staff_disciplinary/edit_staff_disciplinary.vue').default },
                ],
            },
            { path: '/staff_attendance',
                component: require('./components/staff/staff_services/attendance/attendance_index.vue').default,
                children:[
                    { path: '/', name:'staff_attendance',  component: require('./components/staff/staff_services/attendance/list_attendance.vue').default },
                    { path: '/list_attendance',name:'list_attendance',  component: require('./components/staff/staff_services/attendance/list_attendance.vue').default },
                    { path: '/create_attendance',name:'create_attendance', component: require('./components/staff/staff_services/attendance/create_attendance.vue').default },
                    { path: '/edit_attendance', name:'edit_attendance', component: require('./components/staff/staff_services/attendance/edit_attendance.vue').default },
                ],
            },


        ]
    },


];
export default routes
