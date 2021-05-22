const routes = [
    //STAFF Masters 
    { path: '/staff_link',
        component: require('./components/masters/staff_masters/staff_master_index.vue').default,
        children:[
            {path: '/',name:'staff_link', component: require('./components/masters/staff_masters/staff_master_list.vue').default },
            { path: '/marital_status',
                component: require('./components/masters/staff_masters/marital_status/marital_status_index.vue').default,
                children:[
                    { path: '/',name:'marital_status', component: require('./components/masters/staff_masters/marital_status/list_marital_status.vue').default },
                    { path: '/list_marital_status',name:'list_marital_status', component: require('./components/masters/staff_masters/marital_status/list_marital_status.vue').default },
                    { path: '/create_marital_status',name:'create_marital_status', component: require('./components/masters/staff_masters/marital_status/create_marital_status.vue').default },
                    { path: '/edit_marital_status', name:'edit_marital_status', component: require('./components/masters/staff_masters/marital_status/edit_marital_status.vue').default },
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
            { path: '/teaching_subjects',
                component: require('./components/masters/staff_masters/subject/marital_status_index.vue').default,
                children:[
                    { path: '/',name:'teaching_subjects', component: require('./components/masters/staff_masters/subject/list_subject.vue').default },
                    { path: '/list_subject',name:'list_subject', component: require('./components/masters/staff_masters/subject/list_subject.vue').default },
                    { path: '/create_subject',name:'create_subject', component: require('./components/masters/staff_masters/subject/create_subject.vue').default },
                    { path: '/edit_subject', name:'edit_subject', component: require('./components/masters/staff_masters/subject/edit_subject.vue').default },
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
            { path: '/qualification_description',
                component: require('./components/masters/staff_masters/qualification_description/qualification_description_index.vue').default,
                children:[
                    { path: '/',name:'qualification_description', component: require('./components/masters/staff_masters/qualification_description/list_qualification_description.vue').default },
                    { path: '/list_qualification_description',name:'list_qualification_description', component: require('./components/masters/staff_masters/qualification_description/list_qualification_description.vue').default },
                    { path: '/create_qualification_description',name:'create_qualification_description', component: require('./components/masters/staff_masters/qualification_description/create_qualification_description.vue').default },
                    { path: '/edit_qualification_description', name:'edit_qualification_description', component: require('./components/masters/staff_masters/qualification_description/edit_qualification_description.vue').default },
                ],
            },
            { path: '/course_mode',
                component: require('./components/masters/staff_masters/course_mode/course_mode_index.vue').default,
                children:[
                    { path: '/',name:'course_mode', component: require('./components/masters/staff_masters/course_mode/list_course_mode.vue').default },
                    { path: '/list_course_mode',name:'list_course_mode', component: require('./components/masters/staff_masters/course_mode/list_course_mode.vue').default },
                    { path: '/create_course_mode',name:'create_course_mode', component: require('./components/masters/staff_masters/course_mode/create_course_mode.vue').default },
                    { path: '/edit_course_mode', name:'edit_course_mode', component: require('./components/masters/staff_masters/course_mode/edit_course_mode.vue').default },
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
        ],
    },

    //Staff Transfer Masters
    { path: '/qualification_index',
        component: require('./components/masters/staff_qualification/staff_qualification_index.vue').default,
        children:[
            {path: '/',name:'qualification_index', component: require('./components/masters/staff_qualification/staff_qualification_list.vue').default },

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
                    // { path: '/create_civil_staff',name:'create_civil_staff',  component: require('./components/staff/civil/create_staff.vue').default },
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

            { path: '/transfer_window_index',
                component: require('./components/staff/transfer_window/transfer_window_index.vue').default,
                children:[
                    { path: '/', name:'transfer_window_index',  component: require('./components/staff/transfer_window/transfer_window_list.vue').default },
                    { path: '/list_transfer_window',name:'list_transfer_window',  component: require('./components/staff/transfer_window/transfer_window_list.vue').default },
                    { path: '/create_transfer_window',name:'create_transfer_window', component: require('./components/staff/transfer_window/create_transfer_window.vue').default },
                    { path: '/edit_transfer_window', name:'edit_transfer_window', component: require('./components/staff/transfer_window/edit_transfer_window.vue').default },
                ],
            },
            { path: '/transfer_index',
                component: require('./components/staff/transfer/transfer_index.vue').default,
                children:[
                    { path: '/', name:'transfer_index',  component: require('./components/staff/transfer/transfer_list.vue').default },
                    { path: '/list_transfer',name:'list_transfer',  component: require('./components/staff/transfer/transfer_list.vue').default },
                    { path: '/create_transfer',name:'create_transfer', component: require('./components/staff/transfer/create_transfer.vue').default },
                    { path: '/edit_transfer', name:'edit_transfer', component: require('./components/staff/transfer/edit_transfer.vue').default },
                ],
            },

            { path: '/transfer_acknowledgement', name:'transfer_acknowledgement',
            component: require('./components/staff/transfer/acknowledgement.vue').default },
        ]
    },

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
                ],
            },

        ]
    },

    { path: '/transfer_verification',name:'transfer_verification', component: require('./components/staff/transfer/transfer_verification.vue').default },

    //Management Body Transactions
    { path:'/management_body',
        component: require('./components/staff/management/management_body_index.vue').default,
        children:[
            { path: '/', name:'management_body', component: require('./components/staff/management/management_body_list.vue').default },

            { path: '/create_management_body_index',
                component: require('./components/staff/management/create_body/management_body_index.vue').default,
                children:[
                    { path: '/', name:'create_management_body_index',  component: require('./components/staff/management/create_body/list_management_body.vue').default },
                    { path: '/list_management_body',name:'list_management_body',  component: require('./components/staff/management/create_body/list_management_body.vue').default },
                    { path: '/create_management_body',name:'create_management_body',  component: require('./components/staff/management/create_body/create_management_body.vue').default },
                    { path: '/edit_management_body',name:'edit_management_body',  component: require('./components/staff/management/create_body/edit_management_body.vue').default },
                ],
            },

            { path:'/management_meeting',
                component: require('./components/staff/management/create_meeting/meeting_body_index.vue').default,
                children:[
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
    { path: '/leave_verification',name:'leave_verification', component: require('./components/staff/leave_services/apply_leave/leave_verification.vue').default },

    //Leadership Selection
    { path:'/staff_leadership_selection_index',
        component: require('./components/staff/leadership/leadership_index.vue').default,
        children:[
            { path: '/', name:'staff_leadership_selection_index', component: require('./components/staff/leadership/leadership_list.vue').default },

            { path: '/nomination_for_leadership', 
                component: require('./components/staff/leadership/leadership_nomination/leadership_nomination_index.vue').default,
                children:[
                    { path: '/', name:'nomination_for_leadership',  component: require('./components/staff/leadership/leadership_nomination/list_leadership_nomination.vue').default },
                    { path: '/list_leadership_nomination',name:'list_leadership_nomination',  component: require('./components/staff/leadership/leadership_nomination/list_leadership_nomination.vue').default },
                    { path: '/create_leadership_nomination',name:'create_leadership_nomination', component: require('./components/staff/leadership/leadership_nomination/create_leadership_nomination.vue').default },
                    { path: '/edit_leadership_nomination', name:'edit_leadership_nomination', component: require('./components/staff/leadership/leadership_nomination/edit_leadership_nomination.vue').default },
                ],
            },
        ]
    },
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
