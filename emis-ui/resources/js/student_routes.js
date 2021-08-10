const routes = [
    { path: '/StudentServicesMasterIndex', component: require('./components/masters/student_masters/StudentServicesIndex.vue').default,
        children: [

            { path: '/award_type_list',
                component: require('./components/masters/student_masters/awards/award_type_index.vue').default ,
                children: [
                    { path: '', component: require('./components/masters/student_masters/awards/award_type_list.vue').default },
                    { path: '/award_type_add', name:'award_type_add', component: require('./components/masters/student_masters/awards/award_type_add.vue').default },
                    { path: '/award_type_edit', name:'award_type_edit', component: require('./components/masters/student_masters/awards/award_type_edit.vue').default },
                    { path: '/award_type_list', name:'award_type_list', component: require('./components/masters/student_masters/awards/award_type_list.vue').default },
                ]
            },
            { path: '/student_award_index',
                component: require('./components/masters/student_masters/awards/student_award_index.vue').default ,
                children: [
                    { path: '', component: require('./components/masters/student_masters/awards/student_award_list.vue').default },
                    { path: '/student_award_add', name:'StudentAwardAdd', component: require('./components/masters/student_masters/awards/student_award_add.vue').default },
                    { path: '/student_award_edit', name:'StudentAwardEdit', component: require('./components/masters/student_masters/awards/student_award_edit.vue').default },
                    { path: '/student_award_list', name:'StudentAwardList', component: require('./components/masters/student_masters/awards/student_award_list.vue').default },
                ]
            },
            { path: '/offence_type_index',
                component: require('./components/masters/student_masters/disciplinary_record/offence_type_index.vue').default ,
                children: [
                    { path: '', component: require('./components/masters/student_masters/disciplinary_record/offence_type_index.vue').default },
                    { path: '/offence_type_add', name:'OffenceTypeAdd', component: require('./components/masters/student_masters/disciplinary_record/offence_type_add.vue').default },
                    { path: '/offence_type_edit', name:'OffenceTypeEdit', component: require('./components/masters/student_masters/disciplinary_record/offence_type_edit.vue').default },
                    { path: '/offence_type_list', name:'OffenceTypeList', component: require('./components/masters/student_masters/disciplinary_record/offence_type_list.vue').default },
                ]
            },
            { path: '/offence_severity_index',
                component: require('./components/masters/student_masters/disciplinary_record/offence_severity_index.vue').default ,
                children: [
                    { path: '', component: require('./components/masters/student_masters/disciplinary_record/offence_severity_index.vue').default },
                    { path: '/offence_severity_add', name:'OffenceSeverityAdd', component: require('./components/masters/student_masters/disciplinary_record/offence_severity_add.vue').default },
                    { path: '/offence_severity_edit', name:'OffenceSeverityEdit', component: require('./components/masters/student_masters/disciplinary_record/offence_severity_edit.vue').default },
                    { path: '/offence_severity_list', name:'OffenceSeverityList', component: require('./components/masters/student_masters/disciplinary_record/offence_severity_list.vue').default },
                ]
            },
            { path: '/action_taken_index',
                component: require('./components/masters/student_masters/disciplinary_record/action_taken_index.vue').default ,
                children: [
                    { path: '', component: require('./components/masters/student_masters/disciplinary_record/action_taken_index.vue').default },
                    { path: '/action_taken_add', name:'ActionTakenAdd', component: require('./components/masters/student_masters/disciplinary_record/action_taken_add.vue').default },
                    { path: '/action_taken_edit', name:'ActionTakenEdit', component: require('./components/masters/student_masters/disciplinary_record/action_taken_edit.vue').default },
                    { path: '/action_taken_list', name:'ActionTakenList', component: require('./components/masters/student_masters/disciplinary_record/action_taken_list.vue').default },
                ]
            },
            { path: '/roles_responsibilities_index',
                component: require('./components/masters/student_masters/roles_responsibilities/roles_responsibilities_index.vue').default ,
                children: [
                    { path: '', component: require('./components/masters/student_masters/roles_responsibilities/roles_responsibilities_index.vue').default },
                    { path: '/roles_responsibilities_add', name:'RolesResponsibilitiesAdd', component: require('./components/masters/student_masters/roles_responsibilities/roles_responsibilities_add.vue').default },
                    { path: '/roles_responsibilities_edit', name:'RolesResponsibilitiesEdit', component: require('./components/masters/student_masters/roles_responsibilities/roles_responsibilities_edit.vue').default },
                    { path: '/roles_responsibilities_list', name:'RolesResponsibilitiesList', component: require('./components/masters/student_masters/roles_responsibilities/roles_responsibilities_list.vue').default },
                ]
            },
            { path: '/counselling_type_index',
                component: require('./components/masters/student_masters/counselling_types/counselling_type_index.vue').default ,
                children: [
                    { path: '', component: require('./components/masters/student_masters/counselling_types/counselling_type_list.vue').default },
                    { path: '/counselling_type_add', name:'counselling_type_add', component: require('./components/masters/student_masters/counselling_types/counselling_type_add.vue').default },
                    { path: '/counselling_type_edit', name:'counselling_type_edit', component: require('./components/masters/student_masters/counselling_types/counselling_type_edit.vue').default },
                    { path: '/counselling_type_list', name:'counselling_type_list', component: require('./components/masters/student_masters/counselling_types/counselling_type_list.vue').default },
                ]
            },
            { path: '/counselling_age_index',
                component: require('./components/masters/student_masters/counselling_age_range/counselling_age_index.vue').default ,
                children: [
                    { path: '', component: require('./components/masters/student_masters/counselling_age_range/counselling_age_list.vue').default },
                    { path: '/counselling_age_add', name:'counselling_age_add', component: require('./components/masters/student_masters/counselling_age_range/counselling_age_add.vue').default },
                    { path: '/counselling_age_edit', name:'counselling_age_edit', component: require('./components/masters/student_masters/counselling_age_range/counselling_age_edit.vue').default },
                    { path: '/counselling_age_list', name:'counselling_age_list', component: require('./components/masters/student_masters/counselling_age_range/counselling_age_list.vue').default },
                ]
            },
            { path: '/counselling_class_index',
                component: require('./components/masters/student_masters/counselling_class_range/counselling_class_index.vue').default ,
                children: [
                    { path: '', component: require('./components/masters/student_masters/counselling_class_range/counselling_class_list.vue').default },
                    { path: '/counselling_class_add', name:'counselling_class_add', component: require('./components/masters/student_masters/counselling_class_range/counselling_class_add.vue').default },
                    { path: '/counselling_class_edit', name:'counselling_class_edit', component: require('./components/masters/student_masters/counselling_class_range/counselling_class_edit.vue').default },
                    { path: '/counselling_class_list', name:'counselling_class_list', component: require('./components/masters/student_masters/counselling_class_range/counselling_class_list.vue').default },
                ]
            },
            
        ]
    },
    //Students validation and others
    { path: '/validation_and_others', component: require('./components/masters/validation_and_others/validation_and_others_index.vue').default,
    children:
        [
            { path: '',ame:'validation_and_others', component: require('./components/masters/validation_and_others/validation_and_others_list.vue').default },
            { path: '/age_limit_admission',component: require('./components/masters/validation_and_others/age_limit_admission/age_limit_admission_index.vue').default },
        ],
    },

    //STUDENT MASTER
  { path: '/StudentCeaMasterIndex', component: require('./components/masters/student_masters/StudentCeaIndex.vue').default,
  children:
  [
    { path: '/program_type_index',
    component: require('./components/masters/student_masters/programs_clubs/program_type_index.vue').default ,
      children: [
        { path: '', component: require('./components/masters/student_masters/programs_clubs/program_type_index.vue').default },
        { path: '/program_type_add', name:'ProgramTypeAdd', component: require('./components/masters/student_masters/programs_clubs/program_type_add.vue').default },
        { path: '/program_type_edit', name:'ProgramTypeEdit', component: require('./components/masters/student_masters/programs_clubs/program_type_edit.vue').default },
        { path: '/program_type_list', name:'ProgramTypeList', component: require('./components/masters/student_masters/programs_clubs/program_type_list.vue').default },
      ]
    },
    { path: '/program_name_index',
        component: require('./components/masters/student_masters/programs_clubs/program_name_index.vue').default ,
        children: [
            { path: '', component: require('./components/masters/student_masters/programs_clubs/program_name_index.vue').default },
            { path: '/program_name_add', name:'ProgramNameAdd', component: require('./components/masters/student_masters/programs_clubs/program_name_add.vue').default },
            { path: '/program_name_edit', name:'ProgramNameEdit', component: require('./components/masters/student_masters/programs_clubs/program_name_edit.vue').default },
            { path: '/program_name_list', name:'ProgramNameList', component: require('./components/masters/student_masters/programs_clubs/program_name_list.vue').default },
        ]
    },
    { path: '/club_name_index',
        component: require('./components/masters/student_masters/programs_clubs/club_name_index.vue').default ,
        children: [
            { path: '', component: require('./components/masters/student_masters/programs_clubs/club_name_index.vue').default },
            { path: '/club_name_add', name:'club_name_add', component: require('./components/masters/student_masters/programs_clubs/club_name_add.vue').default },
            { path: '/club_name_edit', name:'club_name_edit', component: require('./components/masters/student_masters/programs_clubs/club_name_edit.vue').default },
            { path: '/club_name_list', name:'club_name_list', component: require('./components/masters/student_masters/programs_clubs/club_name_list.vue').default },
        ]
    },
    { path: '/program_support_index',
        component: require('./components/masters/student_masters/programs_clubs/program_support_index.vue').default ,
        children: [
            { path: '', component: require('./components/masters/student_masters/programs_clubs/program_support_index.vue').default },
            { path: '/program_support_add', name:'ProgramSupportAdd', component: require('./components/masters/student_masters/programs_clubs/program_support_add.vue').default },
            { path: '/program_support_edit', name:'ProgramSupportEdit', component: require('./components/masters/student_masters/programs_clubs/program_support_edit.vue').default },
            { path: '/program_support_list', name:'ProgramSupportList', component: require('./components/masters/student_masters/programs_clubs/program_support_list.vue').default },
        ]
    },
    { path: '/program_roles_index',
        component: require('./components/masters/student_masters/programs_clubs/program_roles_index.vue').default ,
        children: [
            { path: '', component: require('./components/masters/student_masters/programs_clubs/program_roles_index.vue').default },
            { path: '/program_roles_add', name:'ProgramRolesAdd', component: require('./components/masters/student_masters/programs_clubs/program_roles_add.vue').default },
            { path: '/program_roles_edit', name:'ProgramRolesEdit', component: require('./components/masters/student_masters/programs_clubs/program_roles_edit.vue').default },
            { path: '/program_roles_list', name:'ProgramRolesList', component: require('./components/masters/student_masters/programs_clubs/program_roles_list.vue').default },
        ]
    },
    { path: '/project_type_index',
        component: require('./components/masters/student_masters/projects_initiatives/project_type_index.vue').default ,
        children: [
            { path: '', component: require('./components/masters/student_masters/projects_initiatives/project_type_index.vue').default },
            { path: '/project_type_add', name:'ProjectTypeAdd', component: require('./components/masters/student_masters/projects_initiatives/project_type_add.vue').default },
            { path: '/project_type_edit', name:'ProjectTypeEdit', component: require('./components/masters/student_masters/projects_initiatives/project_type_edit.vue').default },
            { path: '/project_type_list', name:'ProjectTypeList', component: require('./components/masters/student_masters/projects_initiatives/project_type_list.vue').default },
        ]
    },
    { path: '/training_type_index',
    component: require('./components/masters/student_masters/trainings/training_type_index.vue').default ,
      children: [
        { path: '', component: require('./components/masters/student_masters/trainings/training_type_index.vue').default },
        { path: '/training_type_add', name:'StudentTrainingTypeAdd', component: require('./components/masters/student_masters/trainings/training_type_add.vue').default },
        { path: '/training_type_edit', name:'StudentTrainingTypeEdit', component: require('./components/masters/student_masters/trainings/training_type_edit.vue').default },
        { path: '/training_type_list', name:'StudentTrainingTypeList', component: require('./components/masters/student_masters/trainings/training_type_list.vue').default },
      ]
    },
    { path: '/scout_section_index',
    component: require('./components/masters/student_masters/scouts/scout_section_index.vue').default ,
      children: [
        { path: '', name:'scout_section_index', component: require('./components/masters/student_masters/scouts/scout_section_index.vue').default },
        { path: '/scout_section_add', name:'scout_section_add', component: require('./components/masters/student_masters/scouts/scout_section_add.vue').default },
        { path: '/scout_section_edit', name:'scout_section_edit', component: require('./components/masters/student_masters/scouts/scout_section_edit.vue').default },
        { path: '/scout_section_list', name:'scout_section_list', component: require('./components/masters/student_masters/scouts/scout_section_list.vue').default },
      ]
    },
    { path: '/scout_badge_index',
    component: require('./components/masters/student_masters/scouts/scout_badge_index.vue').default ,
      children: [
        { path: '', name:'scout_badge_index', component: require('./components/masters/student_masters/scouts/scout_section_index.vue').default },
        { path: '/scout_badge_add', name:'scout_badge_add', component: require('./components/masters/student_masters/scouts/scout_badge_add.vue').default },
        { path: '/scout_badge_edit', name:'scout_badge_edit', component: require('./components/masters/student_masters/scouts/scout_badge_edit.vue').default },
        { path: '/scout_badge_list', name:'scout_badge_list', component: require('./components/masters/student_masters/scouts/scout_badge_list.vue').default },
      ]
    },
    { path: '/scout_leader_index',
    component: require('./components/masters/student_masters/scouts/scout_leader_index.vue').default ,
      children: [
        { path: '', name:'scout_leader_index', component: require('./components/masters/student_masters/scouts/scout_leader_index.vue').default },
        { path: '/scout_leader_add', name:'scout_leader_add', component: require('./components/masters/student_masters/scouts/scout_leader_add.vue').default },
        { path: '/scout_leader_edit', name:'scout_leader_edit', component: require('./components/masters/student_masters/scouts/scout_leader_edit.vue').default },
        { path: '/scout_leader_list', name:'scout_leader_list', component: require('./components/masters/student_masters/scouts/scout_leader_list.vue').default },
      ]
    },
    { path: '/scout_section_level_index',
    component: require('./components/masters/student_masters/scouts/scout_section_level_index.vue').default ,
      children: [
        { path: '', name:'scout_section_level_index', component: require('./components/masters/student_masters/scouts/scout_section_level_index.vue').default },
        { path: '/scout_section_level_add', name:'scout_section_level_add', component: require('./components/masters/student_masters/scouts/scout_section_level_add.vue').default },
        { path: '/scout_section_level_edit', name:'scout_section_level_edit', component: require('./components/masters/student_masters/scouts/scout_section_level_edit.vue').default },
        { path: '/scout_section_level_list', name:'scout_section_level_list', component: require('./components/masters/student_masters/scouts/scout_section_level_list.vue').default },
      ]
    },
    { path: '/training_index',
    component: require('./components/masters/student_masters/trainings/training_index.vue').default ,
      children: [
        { path: '', component: require('./components/masters/student_masters/trainings/training_index.vue').default },
        { path: '/training_add', name:'StudentTrainingAdd', component: require('./components/masters/student_masters/trainings/training_add.vue').default },
        { path: '/training_edit', name:'StudentTrainingEdit', component: require('./components/masters/student_masters/trainings/training_edit.vue').default },
        { path: '/training_list', name:'StudentTrainingList', component: require('./components/masters/student_masters/trainings/training_list.vue').default },
      ]
    },
    { path: '/item_variety_index',
    component: require('./components/masters/student_masters/programs_clubs/item_variety_index.vue').default ,
      children: [
        { path: '', component: require('./components/masters/student_masters/programs_clubs/item_variety_list.vue').default },
        { path: '/item_variety_add', name:'ItemVarietyAdd', component: require('./components/masters/student_masters/programs_clubs/item_variety_add.vue').default },
        { path: '/item_variety_edit', name:'ItemVarietyEdit', component: require('./components/masters/student_masters/programs_clubs/item_variety_edit.vue').default },
        { path: '/item_variety_list', name:'ItemVarietyList', component: require('./components/masters/student_masters/programs_clubs/item_variety_list.vue').default },
      ]
    },
    { path: '/program_item_index',
    component: require('./components/masters/student_masters/programs_clubs/program_item_index.vue').default ,
      children: [
        { path: '', component: require('./components/masters/student_masters/programs_clubs/program_item_list.vue').default },
        { path: '/program_item_add', name:'ProgramItemAdd', component: require('./components/masters/student_masters/programs_clubs/program_item_add.vue').default },
        { path: '/program_item_edit', name:'ProgramItemEdit', component: require('./components/masters/student_masters/programs_clubs/program_item_edit.vue').default },
        { path: '/program_item_list', name:'ProgramItemList', component: require('./components/masters/student_masters/programs_clubs/program_item_list.vue').default },
      ]
    },
    { path: '/program_measurement_index',
    component: require('./components/masters/student_masters/programs_clubs/program_measurement_index.vue').default ,
      children: [
        { path: '', component: require('./components/masters/student_masters/programs_clubs/program_measurement_list.vue').default },
        { path: '/program_measurement_add', name:'ProgramMeasurementAdd', component: require('./components/masters/student_masters/programs_clubs/program_measurement_add.vue').default },
        { path: '/program_measurement_edit', name:'ProgramMeasurementEdit', component: require('./components/masters/student_masters/programs_clubs/program_measurement_edit.vue').default },
        { path: '/program_measurement_list', name:'ProgramMeasurementList', component: require('./components/masters/student_masters/programs_clubs/program_measurement_list.vue').default },
      ]
    },
    { path: '/quarter_name_index',
    component: require('./components/masters/student_masters/programs_clubs/quarter_name_index.vue').default ,
      children: [
        { path: '', component: require('./components/masters/student_masters/programs_clubs/quarter_name_list.vue').default },
        { path: '/quarter_name_add', name:'quarter_name_add', component: require('./components/masters/student_masters/programs_clubs/quarter_name_add.vue').default },
        { path: '/quarter_name_edit', name:'quarter_name_edit', component: require('./components/masters/student_masters/programs_clubs/quarter_name_edit.vue').default },
        { path: '/quarter_name_list', name:'quarter_name_list', component: require('./components/masters/student_masters/programs_clubs/quarter_name_list.vue').default },
      ]
    },

    { path: '/foodSource_type_index',
        component: require('./components/masters/student_masters/foodSource_types/foodSource_type_index.vue').default ,
        children: [
            { path: '', component: require('./components/masters/student_masters/foodSource_types/foodSource_type_list.vue').default },
            { path: '/foodSource_type_add', name:'foodSource_type_add', component: require('./components/masters/student_masters/foodSource_types/foodSource_type_add.vue').default },
            { path: '/foodSource_type_edit', name:'foodSource_type_edit', component: require('./components/masters/student_masters/foodSource_types/foodSource_type_edit.vue').default },
            { path: '/foodSource_type_list', name:'foodSource_type_list', component: require('./components/masters/student_masters/foodSource_types/foodSource_type_list.vue').default },
        ]
    },
  ]
},
{ path: '/StudentHealthMasterIndex', component: require('./components/masters/student_masters/StudentHealthIndex.vue').default,
  children:
  [
    { path: '/vaccination_index',
    component: require('./components/masters/student_masters/student_health/vaccination_index.vue').default ,
      children: [
        { path: '', component: require('./components/masters/student_masters/student_health/vaccination_list.vue').default },
        { path: '/vaccination_add', name:'VaccinationAdd', component: require('./components/masters/student_masters/student_health/vaccination_add.vue').default },
        { path: '/vaccination_edit', name:'VaccinationEdit', component: require('./components/masters/student_masters/student_health/vaccination_edit.vue').default },
        { path: '/vaccination_list', name:'VaccinationList', component: require('./components/masters/student_masters/student_health/vaccination_list.vue').default },
      ]
    },
    { path: '/health_supplementation_index',
    component: require('./components/masters/student_masters/student_health/health_supplementation_index.vue').default ,
      children: [
        { path: '', component: require('./components/masters/student_masters/student_health/health_supplementation_list.vue').default },
        { path: '/health_supplementation_add', name:'SupplementationAdd', component: require('./components/masters/student_masters/student_health/health_supplementation_add.vue').default },
        { path: '/health_supplementation_edit', name:'SupplementationEdit', component: require('./components/masters/student_masters/student_health/health_supplementation_edit.vue').default },
        { path: '/health_supplementation_list', name:'SupplementationList', component: require('./components/masters/student_masters/student_health/health_supplementation_list.vue').default },
      ]
    },
    { path: '/health_screening_index',
    component: require('./components/masters/student_masters/student_health/health_screening_index.vue').default ,
      children: [
        { path: '', component: require('./components/masters/student_masters/student_health/health_screening_list.vue').default },
        { path: '/health_screening_add', name:'ScreeningAdd', component: require('./components/masters/student_masters/student_health/health_screening_add.vue').default },
        { path: '/health_screening_edit', name:'ScreeningEdit', component: require('./components/masters/student_masters/student_health/health_screening_edit.vue').default },
        { path: '/health_screening_list', name:'ScreeningList', component: require('./components/masters/student_masters/student_health/health_screening_list.vue').default },
      ]
    },
    { path: '/screening_position_index',
    component: require('./components/masters/student_masters/student_health/screening_position_index.vue').default ,
      children: [
        { path: '', component: require('./components/masters/student_masters/student_health/screening_position_list.vue').default },
        { path: '/screening_position_add', name:'ScreeningPositionAdd', component: require('./components/masters/student_masters/student_health/screening_position_add.vue').default },
        { path: '/screening_position_edit', name:'ScreeningPositionEdit', component: require('./components/masters/student_masters/student_health/screening_position_edit.vue').default },
        { path: '/screening_position_list', name:'ScreeningPositionList', component: require('./components/masters/student_masters/student_health/screening_position_list.vue').default },
      ]
    },
    { path: '/screening_endorser_index',
    component: require('./components/masters/student_masters/student_health/screening_endorser_index.vue').default ,
      children: [
        { path: '', component: require('./components/masters/student_masters/student_health/screening_endorser_list.vue').default },
        { path: '/screening_endorser_add', name:'ScreeningEndorserAdd', component: require('./components/masters/student_masters/student_health/screening_endorser_add.vue').default },
        { path: '/screening_endorser_edit', name:'ScreeningEndorserEdit', component: require('./components/masters/student_masters/student_health/screening_endorser_edit.vue').default },
        { path: '/screening_endorser_list', name:'ScreeningEndorserList', component: require('./components/masters/student_masters/student_health/screening_endorser_list.vue').default },
      ]
    },
    { path: '/term_index',
     component: require('./components/masters/student_masters/student_health/term_index.vue').default ,
     children:  [
       { path: '', component: require('./components/masters/student_masters/student_health/term_list.vue').default },
       { path: '/term_add', name:'TermAdd', component: require('./components/masters/student_masters/student_health/term_add.vue').default },
       { path: '/term_edit', name:'TermEdit', component: require('./components/masters/student_masters/student_health/term_edit.vue').default },
       { path: '/term_list', name:'TermList', component: require('./components/masters/student_masters/student_health/term_list.vue').default },
      ]
    },
  ]
},
{ path: '/studentAdmissionMasterIndex', component: require('./components/masters/student_masters/student_admission_master_index.vue').default,
  children:
  [
    { path: '/', name:'studentAdmissionMasterIndex', component: require('./components/masters/student_masters/student_admission_master_list.vue').default },
    { path: '/student_type', component: require('./components/masters/student_masters/student_type/student_type_index.vue').default ,
      children: [
        { path: '', name:'student_type', component: require('./components/masters/student_masters/student_type/student_type_list.vue').default },
        { path: '/student_type_list', name:'student_type_list', component: require('./components/masters/student_masters/student_type/student_type_list.vue').default },
        { path: '/student_type_add', name:'student_type_add', component: require('./components/masters/student_masters/student_type/student_type_add.vue').default },
        { path: '/student_type_edit', name:'student_type_edit', component: require('./components/masters/student_masters/student_type/student_type_edit.vue').default },
      ]
    },
    // stream class setting
    { path: '/streamclass', component: require('./components/masters/student_masters/streamclass_setup/streamclass_index.vue').default ,
    children: [
      { path: '', name:'streamclass', component: require('./components/masters/student_masters/streamclass_setup/streamclass_list.vue').default },
      { path: '/streamclass_list', name:'streamclass_list', component: require('./components/masters/student_masters/streamclass_setup/streamclass_list.vue').default },
      { path: '/streamclass_add', name:'streamclass_add', component: require('./components/masters/student_masters/streamclass_setup/streamclass_add.vue').default },
      { path: '/streamclass_edit', name:'streamclass_edit', component: require('./components/masters/student_masters/streamclass_setup/streamclass_edit.vue').default },
    ]
  },
    { path: '/scholar', component: require('./components/masters/student_masters/scholar/scholar_index.vue').default ,
      children: [
        { path: '', name:'scholar', component: require('./components/masters/student_masters/scholar/scholar_list.vue').default },
        { path: '/scholar_list', name:'scholar_list', component: require('./components/masters/student_masters/scholar/scholar_list.vue').default },
        { path: '/scholar_add', name:'scholar_add', component: require('./components/masters/student_masters/scholar/scholar_add.vue').default },
        { path: '/scholar_edit', name:'scholar_edit', component: require('./components/masters/student_masters/scholar/scholar_edit.vue').default },
      ]
    },
    { path: '/spbenefit', component: require('./components/masters/student_masters/spbenefit/spbenefit_index.vue').default ,
      children: [
        { path: '', name:'spbenefit', component: require('./components/masters/student_masters/spbenefit/spbenefit_list.vue').default },
        { path: '/spbenefit_list', name:'spbenefit_list', component: require('./components/masters/student_masters/spbenefit/spbenefit_list.vue').default },
        { path: '/spbenefit_add', name:'spbenefit_add', component: require('./components/masters/student_masters/spbenefit/spbenefit_add.vue').default },
        { path: '/spbenefit_edit', name:'spbenefit_edit', component: require('./components/masters/student_masters/spbenefit/spbenefit_edit.vue').default },
      ]
    },
    { path: '/spbenefit', component: require('./components/masters/student_masters/spbenefit/spbenefit_index.vue').default ,
      children: [
        { path: '', name:'spbenefit', component: require('./components/masters/student_masters/spbenefit/spbenefit_list.vue').default },
        { path: '/spbenefit_list', name:'spbenefit_list', component: require('./components/masters/student_masters/spbenefit/spbenefit_list.vue').default },
        { path: '/spbenefit_add', name:'spbenefit_add', component: require('./components/masters/student_masters/spbenefit/spbenefit_add.vue').default },
        { path: '/spbenefit_edit', name:'spbenefit_edit', component: require('./components/masters/student_masters/spbenefit/spbenefit_edit.vue').default },
      ]
    },
  ]
},

//STUDENT SEN DETAILS
{ path: '/student_sen_list',name:'student_sen_list', component: require('./components/students/Sen/sen_student_list.vue').default },
{ path: '/sen_questions',name:'sen_questions', component: require('./components/students/Sen/sen_question.vue').default },

    //Student Profile
    { path: '/student_profile',name:'student_profile', component: require('./components/students/General/student_profile.vue').default },
    // { path: '/student_list',name:'student_list', component: require('./components/students/General/student_list.vue').default },

    //Student List
    { path: '/student_list_index', component: require('./components/students/General/student_list_index.vue').default,
        children: [
            { path: '/', name:'regular_student_list', component: require('./components/students/General/Regular/student_list.vue').default },
            { path: '/ce_student_list', name:'ce_student_list', component: require('./components/students/General/CE/ce_student_list.vue').default},
        ]
    },


    //Student Admission Related Routes
    { path: '/student_admission', component: require('./components/students/StudentAdmission/index.vue').default,
        children: [
            { path: '/', name:'student_admission', component: require('./components/students/StudentAdmission/student_admission_list.vue').default },
            { path: '/student_new_registration', component: require('./components/students/StudentAdmission/Registration/student_registration.vue').default,
                children: [
                    { path: '/', name:'student_new_registration', component: require('./components/students/StudentAdmission/Registration/student_registration_list.vue').default },
                    { path: '/student_registration_list',name:'student_registration_list', component: require('./components/students/StudentAdmission/Registration/student_registration_list.vue').default },
                    { path: '/new_student_registration',name:'new_student_registration', component: require('./components/students/StudentAdmission/Registration/new_student_registration.vue').default },
                    { path: '/edit_student_registration', name:'edit_student_registration', component: require('./components/students/StudentAdmission/Registration/edit_student_registration.vue').default },
                ]
            },
            { path: '/student_new_admission', component: require('./components/students/StudentAdmission/Admission/student_admission.vue').default,
                children: [
                    { path: '/', name:'student_new_admission', component: require('./components/students/StudentAdmission/Admission/student_admission_list.vue').default },
                    { path: '/student_admission_list',name:'student_admission_list', component: require('./components/students/StudentAdmission/Admission/student_admission_list.vue').default },
                    { path: '/new_student_admission',name:'new_student_admission', component: require('./components/students/StudentAdmission/Admission/new_student_admission.vue').default },
                    { path: '/edit_student_admission', name:'edit_student_admission', component: require('./components/students/StudentAdmission/Admission/edit_student_admission.vue').default },
                ]
            },
            { path: '/student_admission_request', component: require('./components/students/StudentAdmission/Request/student_admission_request.vue').default,
                children: [
                    { path: '/', name:'student_admission_request', component: require('./components/students/StudentAdmission/Request/request_admission_list.vue').default },
                    { path: '/request_admission_list', name:'request_admission_list', component: require('./components/students/StudentAdmission/Request/request_admission_list.vue').default },
                    { path: '/request_admission_view', name:'request_admission_view', component: require('./components/students/StudentAdmission/Request/request_admission_view.vue').default },
                ]
            },
            { path: '/student_admission_apply', component: require('./components/students/StudentAdmission/Admission/student_admission.vue').default,
                children: [
                    { path: '/', name:'student_admission_apply', component: require('./components/students/StudentAdmission/Admission/student_admission_list.vue').default },
                    { path: '/student_admission_list', name:'student_admission_list', component: require('./components/students/StudentAdmission/Admission/student_admission_list.vue').default },
                    { path: '/new_student_admission', name:'new_student_admission', component: require('./components/students/StudentAdmission/Admission/new_student_admission.vue').default },
                    { path: '/edit_student_admission', name:'edit_student_admission', component: require('./components/students/StudentAdmission/Admission/edit_student_admission.vue').default },
                ]
            },
            // Student => Reporting
            { path: '/student_reporting',
            component: require('./components/students/StudentAdmission/Reporting/student_reporting.vue').default,
                children: [
                    { path: '/', name:'student_reporting', component: require('./components/students/StudentAdmission/Reporting/reported_student_list.vue').default },
                    { path: '/reported_student_list', name:'reported_student_list', component: require('./components/students/StudentAdmission/Reporting/reported_student_list.vue').default },
                    { path: '/report_student', name:'report_student', component: require('./components/students/StudentAdmission/Reporting/report_student.vue').default },
                    { path: '/edit_reported_student', name:'edit_reported_student', component: require('./components/students/StudentAdmission/Reporting/edit_reported_student.vue').default },
                ]
            },
            //Student => Leaving
            { path: '/student_leaving', component: require('./components/students/StudentAdmission/Leaving/school_leaving.vue').default,
                children: [
                    { path: '/', name:'student_leaving', component: require('./components/students/StudentAdmission/Leaving/school_leaving_list.vue').default },
                    { path: '/school_leaving_list', name:'school_leaving_list', component: require('./components/students/StudentAdmission/Leaving/school_leaving_list.vue').default },
                    { path: '/transfer_student', name:'transfer_student', component: require('./components/students/StudentAdmission/Leaving/transfer_student.vue').default },
                    { path: '/edit_transfer_student', name:'edit_transfer_student', component: require('./components/students/StudentAdmission/Leaving/edit_transfer_student.vue').default },
                ]
            },
            //Student => Updates
            { path: '/student_updates', component: require('./components/students/StudentAdmission/Updates/student_updates.vue').default,
                children: [
                    { path: '/', name:'student_updates', component: require('./components/students/StudentAdmission/Updates/student_update_list.vue').default },
                    { path: '/student_update_list', name:'student_update_list', component: require('./components/students/StudentAdmission/Updates/student_update_list.vue').default },
                    { path: '/update_student_whereabouts', name:'update_student_whereabouts', component: require('./components/students/StudentAdmission/Updates/update_student_whereabouts.vue').default },
                    { path: '/edit_student_whereabouts', name:'edit_student_whereabouts', component: require('./components/students/StudentAdmission/Updates/edit_student_whereabouts.vue').default },
                ]
            },

            //Student => Update transfers
            { path: '/student_transfers', component: require('./components/students/StudentAdmission/transfer/transfer_index.vue').default,
                children: [
                    { path: '/',name:'student_transfers', component: require('./components/students/StudentAdmission/transfer/update_student_list.vue').default },
                    { path: '/student_transfers_list',name:'student_transfers_list', component: require('./components/students/StudentAdmission/transfer/update_student_list.vue').default },
                    { path: '/update_student_transfer', name:'update_student_transfer', component: require('./components/students/StudentAdmission/transfer/update_student_transfer.vue').default },
                    { path: '/update_student_admission', name:'update_student_admission', component: require('./components/students/StudentAdmission/transfer/update_student_admission.vue').default },
                ]
            },
            // Aboard Student WhereAbouts
            { path: '/abroad_student',
                component: require('./components/students/StudentAdmission/StudentAboard/student_aboard_index.vue').default ,
                children:
                [
                    { path: '', component: require('./components/students/StudentAdmission/StudentAboard/list_student_aboard.vue').default },
                    { path: '/studentaboard_add', name:'StudentAboardAdd', component: require('./components/students/StudentAdmission/StudentAboard/add_student_aboard.vue').default },
                    { path: '/studentaboard_edit', name:'StudentAboardEdit', component: require('./components/students/StudentAdmission/StudentAboard/edit_student_aboard.vue').default },
                    { path: '/studentaboard_list', name:'StudentAboardList', component: require('./components/students/StudentAdmission/StudentAboard/list_student_aboard.vue').default },
                ]
            },

        ]
    },
    //Student => Class Section Allocation
    { path: '/class_section', component: require('./components/students/ClassSection/index.vue').default,
        children: [
            { path: '/', name:'class_section_allocation', name:'class_section_allocation', component: require('./components/students/ClassSection/list_class_section_allocation.vue').default },
            { path: '/list_class_section_allocation', name:'class_section_allocation', name:'class_section_allocation', component: require('./components/students/ClassSection/ClassSectionAllocation/list_class_section_allocation.vue').default },
            //Student => Class Section Allocation
            { path: '/class_section_allocation', component: require('./components/students/ClassSection/ClassSectionAllocation/class_section_allocation.vue').default,
                children: [
                    { path: '/', name:'class_section_allocation', name:'class_section_allocation', component: require('./components/students/ClassSection/ClassSectionAllocation/list_class_section_allocation.vue').default },
                    { path: '/list_class_section_allocation', name:'list_class_section_allocation', component: require('./components/students/ClassSection/ClassSectionAllocation/list_class_section_allocation.vue').default },
                    { path: '/allocate_class_section', name:'allocate_class_section', component: require('./components/students/ClassSection/ClassSectionAllocation/allocate_class_section.vue').default },
                    { path: '/edit_class_section_allocation', name:'edit_class_section_allocation', component: require('./components/students/ClassSection/ClassSectionAllocation/edit_class_section_allocation.vue').default },
                ]
            },
        ]
    },
     //Student List and Profile Related Routes
    //  { path: '/student_profile',name:'student_profile', component: require('./components/students/Assign_RollNo/student_profile.vue').default },
     { path: '/students_rollNo',name:'students_rollNo', component: require('./components/students/Assign_RollNo/students_rollNo.vue').default },


    //Student Services Routes
    { path: '/student_services', component: require('./components/students/StudentServices/index.vue').default,
    children: [
        { path: '/', name:'student_services', component: require('./components/students/StudentServices/student_houses_list.vue').default},
        { path: '/student_houses', name:'student_services', component: require('./components/students/StudentServices/Houses/student_houses.vue').default,
            children: [
                { path: '/', name:'student_houses', component: require('./components/students/StudentServices/Houses/student_houses_list.vue').default },
                { path: '/student_houses_list', name:'student_houses_list', component: require('./components/students/StudentServices/Houses/student_houses_list.vue').default },
                { path: '/allocate_student_houses', name:'allocate_student_houses', component: require('./components/students/StudentServices/Houses/allocate_student_houses.vue').default },
                { path: '/edit_student_house', name:'edit_student_house', component: require('./components/students/StudentServices/Houses/edit_student_house.vue').default },
            ]
        },
        //Student => Disciplinary Record
        { path: '/student_disciplinary_record', component: require('./components/students/StudentServices/DisciplinaryRecord/student_disciplinary_record.vue').default,
            children: [
                { path: '/', name:'student_disciplinary_record', component: require('./components/students/StudentServices/DisciplinaryRecord/disciplinary_record_list.vue').default },
                { path: '/disciplinary_record_list', name:'list_disciplinary_record', component: require('./components/students/StudentServices/DisciplinaryRecord/disciplinary_record_list.vue').default },
                { path: '/add_disciplinary_record', name:'add_disciplinary_record', component: require('./components/students/StudentServices/DisciplinaryRecord/add_disciplinary_record.vue').default },
                { path: '/edit_disciplinary_record', name:'edit_disciplinary_record', component: require('./components/students/StudentServices/DisciplinaryRecord/edit_disciplinary_record.vue').default },
            ]
        },
        // Student => Roles and Responsibilities
        { path: '/student_responsibilities', component: require('./components/students/StudentExtraCurricular/Responsibilities/student_responsibilities.vue').default,
            children: [
                { path: '/', name:'student_responsibilities', component: require('./components/students/StudentExtraCurricular/Responsibilities/student_responsibilities_list.vue').default },
                { path: '/student_responsibilities_list', name:'student_responsibilities_list', component: require('./components/students/StudentExtraCurricular/Responsibilities/student_responsibilities_list.vue').default },
                { path: '/add_student_responsibilities', name:'add_student_responsibilities', component: require('./components/students/StudentExtraCurricular/Responsibilities/add_student_responsibilities.vue').default },
                { path: '/edit_student_responsibilities', name:'edit_student_responsibilities', component: require('./components/students/StudentExtraCurricular/Responsibilities/edit_student_responsibilities.vue').default },
            ]
        },
        //Student => Awards and Achievements
        { path: '/student_awards', component: require('./components/students/StudentExtraCurricular/Awards/student_awards.vue').default,
            children: [
                { path: '/', name:'student_awards', component: require('./components/students/StudentExtraCurricular/Awards/student_awards_list.vue').default },
                { path: '/student_awards_list', name:'student_awards_list', component: require('./components/students/StudentExtraCurricular/Awards/student_awards_list.vue').default },
                { path: '/add_student_awards', name:'add_student_awards', component: require('./components/students/StudentExtraCurricular/Awards/add_student_awards.vue').default },
                { path: '/edit_student_awards', name:'edit_student_awards', component: require('./components/students/StudentExtraCurricular/Awards/edit_student_awards.vue').default },
            ]
        },
        //Counselling records

    ]
    },
//     { path: '/student_counselling_record', component: require('./components/students/counselling_records/index.vue').default,
//     children: [
//         { path: '/general_index',name:"general_index", component: require('./components/organization/general/index_list.vue').default },
//         { path: '/', name:'student_counselling_record', component: require('./components/students/counselling_records/list_counselling_records.vue').default },
//         { path: '/list_counselling_records', name:'list_counselling_records', component: require('./components/students/counselling_records/list_counselling_records.vue').default },
//         { path: '/add_counselling_records', name:'add_counselling_records', component: require('./components/students/counselling_records/add_counselling_records.vue').default },
//         { path: '/edit_counselling_records', name:'edit_counselling_records', component: require('./components/students/counselling_records/edit_counselling_records.vue').default },

//     ]
// },

{ path: '/counselling_record', component: require('./components/students/Counselling/index.vue').default,
    children:[
        { path: '/counselling_record',name:"counselling_record", component: require('./components/students/Counselling/CounsellingRecords/index_list.vue').default },

        { path: '/student_counselling_record',
            component: require('./components/students/Counselling/CounsellingRecords/index_counselling_records.vue').default,
            children: [
                { path: '',name:'index_counselling_records', component: require('./components/students/Counselling/CounsellingRecords/list_counselling_records.vue').default },
                { path: '/add_counselling_records', name:'add_counselling_records', component: require('./components/students/Counselling/CounsellingRecords/add_counselling_records.vue').default },
                { path: '/edit_counselling_records', name:'edit_counselling_records', component: require('./components/students/Counselling/CounsellingRecords/edit_counselling_records.vue').default },
                { path: '/list_counselling_records', name:'list_counselling_records', component: require('./components/students/Counselling/CounsellingRecords/list_counselling_records.vue').default },
            ]
        },
        { path: '/student_counselling_programs',
            component: require('./components/students/Counselling/CounsellingPrograms/index_counselling_programs.vue').default,
            children: [
                { path: '',name:'index_counselling_programs', component: require('./components/students/Counselling/CounsellingPrograms/list_counselling_programs.vue').default },
                { path: '/add_counselling_programs', name:'add_counselling_programs', component: require('./components/students/Counselling/CounsellingPrograms/add_counselling_programs.vue').default },
                { path: '/edit_counselling_programs', name:'edit_counselling_programs', component: require('./components/students/Counselling/CounsellingPrograms/edit_counselling_programs.vue').default },
                { path: '/list_counselling_programs', name:'list_counselling_programs', component: require('./components/students/Counselling/CounsellingPrograms/list_counselling_programs.vue').default },
            ]
        }
    ]
},

    //Student Programs and Clubs Routes
    { path: '/student_programs_clubs', component: require('./components/students/StudentExtraCurricular/programs_clubs_index.vue').default,
    children: [
        //Student => Programs and Clubs
        { path: '/', name:'student_programs_clubs', component: require('./components/students/StudentExtraCurricular/student_programs_list.vue').default},
        { path: '/student_programs', name:'student_programs_clubs', component: require('./components/students/StudentExtraCurricular/Programs/student_programs.vue').default,
            children: [
                { path: '/', name:'student_programs', component: require('./components/students/StudentExtraCurricular/Programs/student_programs_list.vue').default },
                { path: '/student_programs_list', name:'student_programs_list', component: require('./components/students/StudentExtraCurricular/Programs/student_programs_list.vue').default },
                { path: '/add_student_programs', name:'add_student_programs', component: require('./components/students/StudentExtraCurricular/Programs/add_student_programs.vue').default },
                { path: '/register_student_programs', name:'register_student_programs', component: require('./components/students/StudentExtraCurricular/Programs/register_student_programs.vue').default },
                { path: '/edit_student_programs', name:'edit_student_programs', component: require('./components/students/StudentExtraCurricular/Programs/edit_student_programs.vue').default },
            ]
        },
        { path: '/student_programs_members', component: require('./components/students/StudentExtraCurricular/Programs/student_programs_members.vue').default,
            children: [
                { path: '/', name:'student_programs_members', component: require('./components/students/StudentExtraCurricular/Programs/student_programs_members_list.vue').default },
                { path: '/student_programs_members_list', name:'student_programs_members_list', component: require('./components/students/StudentExtraCurricular/Programs/student_programs_members_list.vue').default },
                { path: '/add_student_programs_members', name:'add_student_programs_members', component: require('./components/students/StudentExtraCurricular/Programs/add_student_programs_members.vue').default },
                { path: '/register_student_programs_members', name:'register_student_programs_members', component: require('./components/students/StudentExtraCurricular/Programs/register_student_programs_members.vue').default },
                { path: '/edit_student_programs_members', name:'edit_student_programs_members', component: require('./components/students/StudentExtraCurricular/Programs/edit_student_programs_members.vue').default },
            ]
        },
        { path: '/student_clubs', name:'student_clubs', component: require('./components/students/StudentExtraCurricular/Programs/student_clubs_index.vue').default,
            children: [
                { path: '/', name:'student_clubs', component: require('./components/students/StudentExtraCurricular/Programs/student_clubs_list.vue').default },
                { path: '/student_clubs_list', name:'student_clubs_list', component: require('./components/students/StudentExtraCurricular/Programs/student_clubs_list.vue').default },
                { path: '/student_clubs_add', name:'student_clubs_add', component: require('./components/students/StudentExtraCurricular/Programs/student_clubs_add.vue').default },
                { path: '/student_clubs_edit', name:'student_clubs_edit', component: require('./components/students/StudentExtraCurricular/Programs/student_clubs_edit.vue').default },
            ]
        },
        { path: '/student_clubs_members', component: require('./components/students/StudentExtraCurricular/Programs/student_clubs_members.vue').default,
            children: [
                { path: '/', name:'student_clubs_members', component: require('./components/students/StudentExtraCurricular/Programs/student_clubs_members_list.vue').default },
                { path: '/student_clubs_members_list', name:'student_clubs_members_list', component: require('./components/students/StudentExtraCurricular/Programs/student_clubs_members_list.vue').default },
                { path: '/add_student_clubs_members', name:'add_student_clubs_members', component: require('./components/students/StudentExtraCurricular/Programs/add_student_clubs_members.vue').default },
                { path: '/register_student_clubs_members', name:'register_student_clubs_members', component: require('./components/students/StudentExtraCurricular/Programs/register_student_clubs_members.vue').default },
                { path: '/edit_student_clubs_members', name:'edit_student_clubs_members', component: require('./components/students/StudentExtraCurricular/Programs/edit_student_clubs_members.vue').default },
            ]
        },
        { path: '/program_action_plan', component: require('./components/students/StudentExtraCurricular/Programs/program_action_plan.vue').default,
            children: [
                { path: '/', name:'program_action_plan', component: require('./components/students/StudentExtraCurricular/Programs/program_action_plan_list.vue').default },
                { path: '/program_action_plan_list', name:'program_action_plan_list', component: require('./components/students/StudentExtraCurricular/Programs/program_action_plan_list.vue').default },
                { path: '/program_action_plan_add', name:'program_action_plan_add', component: require('./components/students/StudentExtraCurricular/Programs/program_action_plan_add.vue').default },
                { path: '/program_action_plan_edit', name:'program_action_plan_edit', component: require('./components/students/StudentExtraCurricular/Programs/program_action_plan_edit.vue').default },
            ]
        },
        { path: '/program_inventory_index', component: require('./components/students/StudentExtraCurricular/Programs/program_inventory_index.vue').default,
            children: [
                { path: '/', name:'program_inventory_index', component: require('./components/students/StudentExtraCurricular/Programs/program_inventory_list.vue').default },
                { path: '/program_inventory_list', name:'program_inventory_list', component: require('./components/students/StudentExtraCurricular/Programs/program_inventory_list.vue').default },
                { path: '/program_inventory_add', name:'program_inventory_add', component: require('./components/students/StudentExtraCurricular/Programs/program_inventory_add.vue').default },
                { path: '/program_inventory_view', name:'program_inventory_view', component: require('./components/students/StudentExtraCurricular/Programs/program_inventory_view.vue').default },
                { path: '/program_inventory_edit', name:'program_inventory_edit', component: require('./components/students/StudentExtraCurricular/Programs/program_inventory_edit.vue').default },
            ]
        },
        //Student => Projects
        { path: '/student_projects', component: require('./components/students/StudentExtraCurricular/Projects/student_projects.vue').default,
            children: [
                { path: '/', name:'student_projects', component: require('./components/students/StudentExtraCurricular/Projects/student_projects_list.vue').default },
                { path: '/student_projects_list', name:'student_projects_list', component: require('./components/students/StudentExtraCurricular/Projects/student_projects_list.vue').default },
                { path: '/add_student_projects', name:'add_student_projects', component: require('./components/students/StudentExtraCurricular/Projects/add_student_projects.vue').default },
                { path: '/edit_student_projects', name:'edit_student_projects', component: require('./components/students/StudentExtraCurricular/Projects/edit_student_projects.vue').default },
            ]
        },
        { path: '/student_projects_members', component: require('./components/students/StudentExtraCurricular/Projects/student_projects_members.vue').default,
            children: [
                { path: '/', name:'student_projects_members', component: require('./components/students/StudentExtraCurricular/Projects/student_projects_members_list.vue').default },
                { path: '/student_projects_members_list', name:'student_projects_members_list', component: require('./components/students/StudentExtraCurricular/Projects/student_projects_members_list.vue').default },
                { path: '/add_student_projects_members', name:'add_student_projects_members', component: require('./components/students/StudentExtraCurricular/Projects/add_student_projects_members.vue').default },
                { path: '/edit_student_projects_members', name:'edit_student_projects_members', component: require('./components/students/StudentExtraCurricular/Projects/edit_student_projects_members.vue').default },
            ]
        },
    ]
    },

    //Student Scouts Routes
    { path: '/student_scouts_index', component: require('./components/students/StudentExtraCurricular/scouts_index.vue').default,
    children: [
        //Student => Scouts
        { path: '/', component: require('./components/students/StudentExtraCurricular/student_scouts_list.vue').default},
        { path: '/student_scouts', component: require('./components/students/StudentExtraCurricular/Scouts/student_scouts.vue').default,
            children: [
                { path: '/', name:'student_scouts_index', component: require('./components/students/StudentExtraCurricular/Scouts/student_scouts_list.vue').default },
                { path: '/student_scouts_list', name:'student_scouts_list', component: require('./components/students/StudentExtraCurricular/Scouts/student_scouts_list.vue').default },
                { path: '/add_student_scouts', name:'add_student_scouts', component: require('./components/students/StudentExtraCurricular/Scouts/add_student_scouts.vue').default },
                { path: '/edit_student_scouts', name:'edit_student_scouts', component: require('./components/students/StudentExtraCurricular/Scouts/edit_student_scouts.vue').default },
            ]
        },
        { path: '/student_scouts_members', component: require('./components/students/StudentExtraCurricular/Scouts/student_scouts_members.vue').default,
            children: [
                { path: '/', name:'student_scouts_members', component: require('./components/students/StudentExtraCurricular/Scouts/student_scouts_members_list.vue').default },
                { path: '/student_scouts_members_list', name:'student_scouts_members_list', component: require('./components/students/StudentExtraCurricular/Scouts/student_scouts_members_list.vue').default },
                { path: '/add_student_scouts_members', name:'add_student_scouts_members', component: require('./components/students/StudentExtraCurricular/Scouts/add_student_scouts_members.vue').default },
                { path: '/edit_student_scouts_members', name:'edit_student_scouts_members', component: require('./components/students/StudentExtraCurricular/Scouts/edit_student_scouts_members.vue').default },
            ]
        },
        { path: '/scouts_badge', component: require('./components/students/StudentExtraCurricular/Scouts/scouts_badge.vue').default,
            children: [
                { path: '/', name:'scouts_badge', component: require('./components/students/StudentExtraCurricular/Scouts/scouts_badge_list.vue').default },
                { path: '/scouts_badge_list', name:'scouts_badge_list', component: require('./components/students/StudentExtraCurricular/Scouts/scouts_badge_list.vue').default },
                { path: '/add_scouts_badge', name:'add_scouts_badge', component: require('./components/students/StudentExtraCurricular/Scouts/add_scouts_badge.vue').default },
                { path: '/edit_scouts_badge', name:'edit_scouts_badge', component: require('./components/students/StudentExtraCurricular/Scouts/edit_scouts_badge.vue').default },
            ]
        },
        { path: '/scouts_leader', component: require('./components/students/StudentExtraCurricular/Scouts/scouts_leader.vue').default,
            children: [
                { path: '/', name:'scouts_leader', component: require('./components/students/StudentExtraCurricular/Scouts/scouts_leader_list.vue').default },
                { path: '/scouts_leader_list', name:'scouts_leader_list', component: require('./components/students/StudentExtraCurricular/Scouts/scouts_leader_list.vue').default },
                { path: '/add_scouts_leader', name:'add_scouts_leader', component: require('./components/students/StudentExtraCurricular/Scouts/add_scouts_leader.vue').default },
                { path: '/edit_scouts_leader', name:'edit_scouts_leader', component: require('./components/students/StudentExtraCurricular/Scouts/edit_scouts_leader.vue').default },
            ]
        },
    ]
    },

    //Student Training Routes
    { path: '/student_trainings_index', component: require('./components/students/StudentExtraCurricular/student_trainings_index.vue').default,
    children: [
        //Student => Training, Workshops, Seminars
        { path: '/', component: require('./components/students/StudentExtraCurricular/student_trainings_list.vue').default},
        { path: '/student_trainings', component: require('./components/students/StudentExtraCurricular/Trainings/student_trainings.vue').default,
            children: [
                { path: '/', name:'student_trainings', component: require('./components/students/StudentExtraCurricular/Trainings/student_trainings_list.vue').default },
                { path: '/student_trainings_list', name:'student_trainings_list', component: require('./components/students/StudentExtraCurricular/Trainings/student_trainings_list.vue').default },
                { path: '/add_student_trainings', name:'add_student_trainings', component: require('./components/students/StudentExtraCurricular/Trainings/add_student_trainings.vue').default },
                { path: '/edit_student_trainings', name:'edit_student_trainings', component: require('./components/students/StudentExtraCurricular/Trainings/edit_student_trainings.vue').default },
            ]
        },
        { path: '/student_trainings_participants', component: require('./components/students/StudentExtraCurricular/Trainings/student_trainings_participants.vue').default,
            children: [
                { path: '/', name:'student_trainings_participants', component: require('./components/students/StudentExtraCurricular/Trainings/student_trainings_participants_list.vue').default },
                { path: '/student_trainings_participants_list', name:'student_trainings_participants_list', component: require('./components/students/StudentExtraCurricular/Trainings/student_trainings_participants_list.vue').default },
                { path: '/add_student_trainings_participants', name:'add_student_trainings_participants', component: require('./components/students/StudentExtraCurricular/Trainings/add_student_trainings_participants.vue').default },
                { path: '/edit_student_trainings_participants', name:'edit_student_trainings_participants', component: require('./components/students/StudentExtraCurricular/Trainings/edit_student_trainings_participants.vue').default },
            ]
        },
    ]
    },
      //External data import Routes
      { path: '/data_import_index', component: require('./components/students/StudentExtraCurricular/DataImport/data_import.vue').default,
      children: [
          //RUB
          { path: '/', component: require('./components/students/StudentExtraCurricular/DataImport/RUB_Data/list_instittute.vue').default},
          { path: '/rub_data_import', component: require('./components/students/StudentExtraCurricular//DataImport/RUB_Data/rub_data.vue').default,
              children: [
                  { path: '/', name:'rub_data_import', component: require('./components/students/StudentExtraCurricular/DataImport/RUB_Data/list_instittute.vue').default },
                  { path: '/list_instittute', name:'list_instittute', component: require('./components/students/StudentExtraCurricular/DataImport/RUB_Data/list_instittute.vue').default },
                  { path: '/list_staff', name:'list_staff', component: require('./components/students/StudentExtraCurricular/DataImport/RUB_Data/list_staff.vue').default },
                  { path: '/list_student', name:'list_student', component: require('./components/students/StudentExtraCurricular/DataImport/RUB_Data/list_student.vue').default },
                  { path: '/list_rub_data', name:'list_rub_data', component: require('./components/students/StudentExtraCurricular/DataImport/RUB_Data/list_rub_data.vue').default },
                  { path: '/add_institute', name:'add_institute', component: require('./components/students/StudentExtraCurricular/DataImport/RUB_Data/add_institute.vue').default },
                  { path: '/add_staff', name:'add_staff', component: require('./components/students/StudentExtraCurricular/DataImport/RUB_Data/add_staff.vue').default },
                  { path: '/add_student', name:'add_student', component: require('./components/students/StudentExtraCurricular/DataImport/RUB_Data/add_student.vue').default },
                  { path: '/edit_rub_data', name:'edit_rub_data', component: require('./components/students/StudentExtraCurricular/DataImport/RUB_Data/edit_rub_data.vue').default },
              ]
          },
        //   MOLHR
          { path: '/student_trainings_participants', component: require('./components/students/StudentExtraCurricular/Trainings/student_trainings_participants.vue').default,
              children: [
                  { path: '/', name:'student_trainings_participants', component: require('./components/students/StudentExtraCurricular/Trainings/student_trainings_participants_list.vue').default },
                  { path: '/student_trainings_participants_list', name:'student_trainings_participants_list', component: require('./components/students/StudentExtraCurricular/Trainings/student_trainings_participants_list.vue').default },
                  { path: '/add_student_trainings_participants', name:'add_student_trainings_participants', component: require('./components/students/StudentExtraCurricular/Trainings/add_student_trainings_participants.vue').default },
                  { path: '/edit_student_trainings_participants', name:'edit_student_trainings_participants', component: require('./components/students/StudentExtraCurricular/Trainings/edit_student_trainings_participants.vue').default },
              ]
          },
            //NFCED
        { path: '/student_trainings_participants', component: require('./components/students/StudentExtraCurricular/Trainings/student_trainings_participants.vue').default,
            children: [
                { path: '/', name:'student_trainings_participants', component: require('./components/students/StudentExtraCurricular/Trainings/student_trainings_participants_list.vue').default },
                { path: '/student_trainings_participants_list', name:'student_trainings_participants_list', component: require('./components/students/StudentExtraCurricular/Trainings/student_trainings_participants_list.vue').default },
                { path: '/add_student_trainings_participants', name:'add_student_trainings_participants', component: require('./components/students/StudentExtraCurricular/Trainings/add_student_trainings_participants.vue').default },
                { path: '/edit_student_trainings_participants', name:'edit_student_trainings_participants', component: require('./components/students/StudentExtraCurricular/Trainings/edit_student_trainings_participants.vue').default },
            ]
        },
        //   NSB
        { path: '/student_trainings_participants', component: require('./components/students/StudentExtraCurricular/Trainings/student_trainings_participants.vue').default,
            children: [
                { path: '/', name:'student_trainings_participants', component: require('./components/students/StudentExtraCurricular/Trainings/student_trainings_participants_list.vue').default },
                { path: '/student_trainings_participants_list', name:'student_trainings_participants_list', component: require('./components/students/StudentExtraCurricular/Trainings/student_trainings_participants_list.vue').default },
                { path: '/add_student_trainings_participants', name:'add_student_trainings_participants', component: require('./components/students/StudentExtraCurricular/Trainings/add_student_trainings_participants.vue').default },
                { path: '/edit_student_trainings_participants', name:'edit_student_trainings_participants', component: require('./components/students/StudentExtraCurricular/Trainings/edit_student_trainings_participants.vue').default },
            ]
          },
            //   DCRC
        { path: '/student_trainings_participants', component: require('./components/students/StudentExtraCurricular/Trainings/student_trainings_participants.vue').default,
            children: [
                { path: '/', name:'student_trainings_participants', component: require('./components/students/StudentExtraCurricular/Trainings/student_trainings_participants_list.vue').default },
                { path: '/student_trainings_participants_list', name:'student_trainings_participants_list', component: require('./components/students/StudentExtraCurricular/Trainings/student_trainings_participants_list.vue').default },
                { path: '/add_student_trainings_participants', name:'add_student_trainings_participants', component: require('./components/students/StudentExtraCurricular/Trainings/add_student_trainings_participants.vue').default },
                { path: '/edit_student_trainings_participants', name:'edit_student_trainings_participants', component: require('./components/students/StudentExtraCurricular/Trainings/edit_student_trainings_participants.vue').default },
            ]
        },
      ]
      },

    //Student Health
    { path: '/student_health', component: require('./components/students/StudentHealth/index.vue').default,
    children: [
        { path: '/', name:'student_health', component: require('./components/students/StudentHealth/std_health_screening_list.vue').default},
        { path: '/std_health_screening', name:'student_health', component: require('./components/students/StudentHealth/HealthScreening/std_health_screening.vue').default,
            children: [
                { path: '/', name:'std_health_screening', component: require('./components/students/StudentHealth/HealthScreening/std_health_screening_list.vue').default },
                { path: '/std_health_screening_list', name:'std_health_screening_list', component: require('./components/students/StudentHealth/HealthScreening/std_health_screening_list.vue').default },
                { path: '/std_health_screening_add', name:'std_health_screening_add', component: require('./components/students/StudentHealth/HealthScreening/std_health_screening_add.vue').default },
                { path: '/std_health_screening_edit', name:'std_health_screening_edit', component: require('./components/students/StudentHealth/HealthScreening/std_health_screening_edit.vue').default },
                { path: '/std_health_screening_view', name:'std_health_screening_view', component: require('./components/students/StudentHealth/HealthScreening/std_health_screening_view.vue').default },
            ]
        },
        // Deworming
        { path: '/std_deworming',
        component: require('./components/students/StudentHealth/Deworming/std_deworming.vue').default,
            children: [
                { path: '/', name:'std_deworming', component: require('./components/students/StudentHealth/Deworming/std_deworming_list.vue').default },
                { path: '/std_deworming_list', name:'std_deworming_list', component: require('./components/students/StudentHealth/Deworming/std_deworming_list.vue').default },
                { path: '/std_deworming_add', name:'std_deworming_add', component: require('./components/students/StudentHealth/Deworming/std_deworming_add.vue').default },
                { path: '/std_deworming_edit', name:'std_deworming_edit', component: require('./components/students/StudentHealth/Deworming/std_deworming_edit.vue').default },
                { path: '/std_deworming_view', name:'std_deworming_view', component: require('./components/students/StudentHealth/Deworming/std_deworming_view.vue').default },
            ]
        },
        //supplementation
        { path: '/std_supplementation',
        component: require('./components/students/StudentHealth/Supplementation/std_supplementation.vue').default,
            children: [
                { path: '/', name:'std_supplementation', component: require('./components/students/StudentHealth/Supplementation/std_supplementation_list.vue').default },
                { path: '/std_supplementation_list', name:'std_supplementation_list', component: require('./components/students/StudentHealth/Supplementation/std_supplementation_list.vue').default },
                { path: '/std_supplementation_add', name:'std_supplementation_add', component: require('./components/students/StudentHealth/Supplementation/std_supplementation_add.vue').default },
                { path: '/std_supplementation_edit', name:'std_supplementation_edit', component: require('./components/students/StudentHealth/Supplementation/std_supplementation_edit.vue').default },
                { path: '/std_supplementation_view', name:'std_supplementation_view', component: require('./components/students/StudentHealth/Supplementation/std_supplementation_view.vue').default },
            ]
        },
        //vaccination
        { path: '/std_vaccination',
        component: require('./components/students/StudentHealth/Vaccination/std_vaccination.vue').default,
            children: [
                { path: '/', name:'std_vaccination', component: require('./components/students/StudentHealth/Vaccination/std_vaccination_list.vue').default },
                { path: '/std_vaccination_list', name:'std_vaccination_list', component: require('./components/students/StudentHealth/Vaccination/std_vaccination_list.vue').default },
                { path: '/std_vaccination_add', name:'std_vaccination_add', component: require('./components/students/StudentHealth/Vaccination/std_vaccination_add.vue').default },
                { path: '/std_vaccination_edit', name:'std_vaccination_edit', component: require('./components/students/StudentHealth/Vaccination/std_vaccination_edit.vue').default },
                { path: '/std_vaccination_view', name:'std_vaccination_view', component: require('./components/students/StudentHealth/Vaccination/std_vaccination_view.vue').default },
            ]
        },
        //BMI link
        { path: '/std_bmi',
        component: require('./components/students/StudentHealth/BMI/std_bmi.vue').default,
            children: [
                { path: '/', name:'std_bmi', component: require('./components/students/StudentHealth/BMI/std_bmi_list.vue').default },
                { path: '/std_bmi_list', name:'std_bmi_list', component: require('./components/students/StudentHealth/BMI/std_bmi_list.vue').default },
                { path: '/std_bmi_add', name:'std_bmi_add', component: require('./components/students/StudentHealth/BMI/std_bmi_add.vue').default },
                { path: '/std_bmi_edit', name:'std_bmi_edit', component: require('./components/students/StudentHealth/BMI/std_bmi_edit.vue').default },
                { path: '/std_bmi_view', name:'std_bmi_view', component: require('./components/students/StudentHealth/BMI/std_bmi_view.vue').default },
            ]
        },
        // Endorse Records
        { path: '/endorse_health_records',
        component: require('./components/students/StudentHealth/EndorseRecords/endorse_records_index.vue').default,
            children: [
                { path: '/', name:'endorse_health_records', component: require('./components/students/StudentHealth/EndorseRecords/endorse_records_list.vue').default },
                { path: '/endorse_records_list', name:'endorse_records_list', component: require('./components/students/StudentHealth/EndorseRecords/endorse_records_list.vue').default },
                { path: '/endorse_records_add', name:'endorse_records_add', component: require('./components/students/StudentHealth/EndorseRecords/endorse_records_add.vue').default,
                    children: [
                        { path: '/endorse_vaccination', name:'endorse_vaccination', component: require('./components/students/StudentHealth/EndorseRecords/endorse_vaccination.vue').default },
                        { path: '/endorse_supplementation', name:'endorse_supplementation', component: require('./components/students/StudentHealth/EndorseRecords/endorse_supplementation.vue').default },
                        { path: '/endorse_screening', name:'endorse_screening', component: require('./components/students/StudentHealth/EndorseRecords/endorse_screening.vue').default },
                    ]
                },
                { path: '/endorse_records_edit', name:'endorse_records_edit', component: require('./components/students/StudentHealth/EndorseRecords/endorse_records_edit.vue').default },
                { path: '/endorse_records_view', name:'endorse_records_view', component: require('./components/students/StudentHealth/EndorseRecords/endorse_records_view.vue').default },
            ]
        },
    ]
    },
    //Update Student Records
    { path: '/update_student_details', component: require('./components/students/UpdateDetails/index.vue').default,
    children: [
        { path: '/', name:'update_student_details', component: require('./components/students/UpdateDetails/CID/updated_cid_list.vue').default},
        { path: '/update_std_cid', name:'update_std_cid', component: require('./components/students/UpdateDetails/CID/updated_cid_index.vue').default,
            children: [
                { path: '/', name:'updated_cid_index', component: require('./components/students/UpdateDetails/CID/updated_cid_list.vue').default },
                { path: '/updated_cid_list', name:'updated_cid_list', component: require('./components/students/UpdateDetails/CID/updated_cid_list.vue').default },
                { path: '/update_cid', name:'update_cid', component: require('./components/students/UpdateDetails/CID/update_cid.vue').default },
                { path: '/edit_updated_cid', name:'edit_updated_cid', component: require('./components/students/UpdateDetails/CID/edit_updated_cid.vue').default },
            ]
        },
        { path: '/update_std_contact', name:'update_std_contact', component: require('./components/students/UpdateDetails/Contact/updated_contact_index.vue').default,
            children: [
                { path: '/', name:'updated_contact_index', component: require('./components/students/UpdateDetails/Contact/updated_contact_list.vue').default },
                { path: '/updated_contact_list', name:'updated_contact_list', component: require('./components/students/UpdateDetails/Contact/updated_contact_list.vue').default },
                { path: '/update_contact', name:'update_contact', component: require('./components/students/UpdateDetails/Contact/update_contact.vue').default },
                { path: '/edit_updated_contact', name:'edit_updated_contact', component: require('./components/students/UpdateDetails/Contact/edit_updated_contact.vue').default },
            ]
        },
        { path: '/update_maritial_status', name:'update_maritial_status', component: require('./components/students/UpdateDetails/MaritialStatus/updated_maritial_index.vue').default,
            children: [
                { path: '/', name:'updated_maritial_index', component: require('./components/students/UpdateDetails/MaritialStatus/updated_maritial_list.vue').default },
                { path: '/updated_maritial_list', name:'updated_maritial_list', component: require('./components/students/UpdateDetails/MaritialStatus/updated_maritial_list.vue').default },
                { path: '/update_maritial', name:'update_maritial', component: require('./components/students/UpdateDetails/MaritialStatus/update_maritial.vue').default },
                { path: '/edit_updated_maritial', name:'edit_updated_maritial', component: require('./components/students/UpdateDetails/MaritialStatus/edit_updated_maritial.vue').default },
            ]
        },
        { path: '/update_std_feeding', name:'update_std_feeding', component: require('./components/students/UpdateDetails/Feeding/updated_feeding_index.vue').default,
            children: [
                { path: '/', name:'updated_feeding_index', component: require('./components/students/UpdateDetails/Feeding/updated_feeding_list.vue').default },
                { path: '/updated_feeding_list', name:'updated_feeding_list', component: require('./components/students/UpdateDetails/Feeding/updated_feeding_list.vue').default },
                { path: '/update_feeding', name:'update_feeding', component: require('./components/students/UpdateDetails/Feeding/update_feeding.vue').default },
                { path: '/edit_updated_feeding', name:'edit_updated_feeding', component: require('./components/students/UpdateDetails/Feeding/edit_updated_feeding.vue').default },
            ]
        },
        { path: '/update_std_dietary', name:'update_std_dietary', component: require('./components/students/UpdateDetails/Dietary/updated_dietary_index.vue').default,
            children: [
                { path: '/', name:'updated_dietary_index', component: require('./components/students/UpdateDetails/Dietary/updated_dietary_list.vue').default },
                { path: '/updated_dietary_list', name:'updated_dietary_list', component: require('./components/students/UpdateDetails/Dietary/updated_dietary_list.vue').default },
                { path: '/update_dietary', name:'update_dietary', component: require('./components/students/UpdateDetails/Dietary/update_dietary.vue').default },
                { path: '/edit_updated_dietary', name:'edit_updated_dietary', component: require('./components/students/UpdateDetails/Dietary/edit_updated_dietary.vue').default },
            ]
        },
        { path: '/update_std_guardian', name:'update_std_guardian', component: require('./components/students/UpdateDetails/Guardian/updated_guardian_index.vue').default,
            children: [
                { path: '/', name:'updated_guardian_index', component: require('./components/students/UpdateDetails/Guardian/updated_guardian_list.vue').default },
                { path: '/updated_guardian_list', name:'updated_guardian_list', component: require('./components/students/UpdateDetails/Guardian/updated_guardian_list.vue').default },
                { path: '/update_guardian', name:'update_guardian', component: require('./components/students/UpdateDetails/Guardian/update_guardian.vue').default },
                { path: '/edit_updated_guardian', name:'edit_updated_guardian', component: require('./components/students/UpdateDetails/Guardian/edit_updated_guardian.vue').default },
            ]
        },
        { path: '/update_std_needy', name:'update_std_needy', component: require('./components/students/UpdateDetails/Needy/updated_needy_index.vue').default,
            children: [
                { path: '/', name:'updated_needy_index', component: require('./components/students/UpdateDetails/Needy/updated_needy_list.vue').default },
                { path: '/updated_needy_list', name:'updated_needy_list', component: require('./components/students/UpdateDetails/Needy/updated_needy_list.vue').default },
                { path: '/update_needy', name:'update_needy', component: require('./components/students/UpdateDetails/Needy/update_needy.vue').default },
                { path: '/edit_updated_needy', name:'edit_updated_needy', component: require('./components/students/UpdateDetails/Needy/edit_updated_needy.vue').default },
            ]
        },
        { path: '/update_std_scholarship', name:'update_std_scholarship', component: require('./components/students/UpdateDetails/ScholarshipDetails/updated_scholarship_index.vue').default,
            children: [
                { path: '/', name:'updated_scholarship_index', component: require('./components/students/UpdateDetails/ScholarshipDetails/updated_scholarship_list.vue').default },
                { path: '/updated_scholarship_list', name:'updated_scholarship_list', component: require('./components/students/UpdateDetails/ScholarshipDetails/updated_scholarship_list.vue').default },
                { path: '/update_scholarship', name:'update_scholarship', component: require('./components/students/UpdateDetails/ScholarshipDetails/update_scholarship.vue').default },
                { path: '/edit_updated_scholarship', name:'edit_updated_scholarship', component: require('./components/students/UpdateDetails/ScholarshipDetails/edit_updated_scholarship.vue').default },
            ]
        },
        { path: '/update_std_sen', name:'update_std_sen', component: require('./components/students/UpdateDetails/SEN/updated_sen_index.vue').default,
            children: [
                { path: '/', name:'updated_sen_index', component: require('./components/students/UpdateDetails/SEN/updated_sen_list.vue').default },
                { path: '/updated_sen_list', name:'updated_sen_list', component: require('./components/students/UpdateDetails/SEN/updated_sen_list.vue').default },
                { path: '/update_sen', name:'update_sen', component: require('./components/students/UpdateDetails/SEN/update_sen.vue').default },
                { path: '/edit_updated_sen', name:'edit_updated_sen', component: require('./components/students/UpdateDetails/SEN/edit_updated_sen.vue').default },
            ]
        },
    ]
    },
];
export default routes
