const routes = [  
    { path: '/StudentServicesMasterIndex', component: require('./components/masters/student_masters/StudentServicesIndex.vue').default,
        children: [
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
            { path: '/program_name_index', 
                component: require('./components/masters/student_masters/programs_clubs/program_name_index.vue').default ,
                children: [
                    { path: '', component: require('./components/masters/student_masters/programs_clubs/program_name_index.vue').default },
                    { path: '/program_name_add', name:'ProgramNameAdd', component: require('./components/masters/student_masters/programs_clubs/program_name_add.vue').default },
                    { path: '/program_name_edit', name:'ProgramNameEdit', component: require('./components/masters/student_masters/programs_clubs/program_name_edit.vue').default },
                    { path: '/program_name_list', name:'ProgramNameList', component: require('./components/masters/student_masters/programs_clubs/program_name_list.vue').default },
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
        ] 
    },

    //ACADEMIC MASTER
    { path: '/academic-link', component: require('./components/masters/academics_masters/academics_master_index.vue').default,
        children:[
            { 
                path: '/', 
                name:'academic-link',
                component: require('./components/masters/academics_masters/academics_master_list.vue').default,
            },
            {  path: '/subject-group-master', component: require('./components/masters/academics_masters/subject_group/subject_group_index.vue').default,
                children: [
                    { path: '', component: require('./components/masters/academics_masters/subject_group/list_subject_group.vue').default },
                    { path: '/list-subject-group', name: 'list_subject_group', component: require('./components/masters/academics_masters/subject_group/list_subject_group.vue').default },
                    { path: '/create-subject-group', name: 'create_subject_group', component: require('./components/masters/academics_masters/subject_group/create_subject_group.vue').default },
                    { path: '/edit-subject-group', name: 'edit_subject_group', component: require('./components/masters/academics_masters/subject_group/edit_subject_group.vue').default },
                ],
            },
            {  path: '/subject-master', component: require('./components/masters/academics_masters/subject/subject_index.vue').default,
                children: [
                    { path: '', component: require('./components/masters/academics_masters/subject/list_subject.vue').default },
                    { path: '/list-subject', name: 'aca_list_subject', component: require('./components/masters/academics_masters/subject/list_subject.vue').default },
                    { path: '/create-subject', name: 'aca_create_subject', component: require('./components/masters/academics_masters/subject/create_subject.vue').default },
                    { path: '/edit-subject', name: 'aca_edit_subject', component: require('./components/masters/academics_masters/subject/edit_subject.vue').default },
                ],
            },
            {  path: '/assessment-area-master', component: require('./components/masters/academics_masters/assessment_area/assessment_area_index.vue').default,
                children: [
                    { path: '', component: require('./components/masters/academics_masters/assessment_area/list_assessment_area.vue').default },
                    { path: '/list-assessment-area', name: 'aca_list_assessment_area', component: require('./components/masters/academics_masters/assessment_area/list_assessment_area.vue').default },
                    { path: '/create-assessment-area', name: 'aca_create_assessment_area', component: require('./components/masters/academics_masters/assessment_area/create_assessment_area.vue').default },
                    { path: '/edit-assessment-area', name: 'aca_edit_assessment_area', component: require('./components/masters/academics_masters/assessment_area/edit_assessment_area.vue').default },
                ],
            },
        ] 
    },

    //Student Services Routes
    { path: '/student_services', component: require('./components/students/StudentServices/index.vue').default,
    children: [
        //Student => Houses
        { path: '/student_houses', component: require('./components/students/StudentServices/Houses/student_houses.vue').default,
            children: [
                { path: '/', component: require('./components/students/StudentServices/Houses/student_houses_list.vue').default },
                { path: '/student_houses_list', component: require('./components/students/StudentServices/Houses/student_houses_list.vue').default },
                { path: '/allocate_student_houses', component: require('./components/students/StudentServices/Houses/allocate_student_houses.vue').default },
                { path: '/edit_student_house', component: require('./components/students/StudentServices/Houses/edit_student_house.vue').default },
            ] 
        },
        //Student => Disciplinary Record
        { path: '/student_disciplinary_record', component: require('./components/students/StudentServices/DisciplinaryRecord/student_disciplinary_record.vue').default,
            children: [
                { path: '/', component: require('./components/students/StudentServices/DisciplinaryRecord/disciplinary_record_list.vue').default },
                { path: '/disciplinary_record', component: require('./components/students/StudentServices/DisciplinaryRecord/disciplinary_record_list.vue').default },
                { path: '/add_disciplinary_record', component: require('./components/students/StudentServices/DisciplinaryRecord/add_disciplinary_record.vue').default },
                { path: '/edit_disciplinary_record', component: require('./components/students/StudentServices/DisciplinaryRecord/edit_disciplinary_record.vue').default },
            ] 
        },
        // Student => Roles and Responsibilities
        { path: '/student_responsibilities', component: require('./components/students/StudentExtraCurricular/Responsibilities/student_responsibilities.vue').default,
            children: [
                { path: '/', component: require('./components/students/StudentExtraCurricular/Responsibilities/student_responsibilities_list.vue').default },
                { path: '/student_responsibilities_list', component: require('./components/students/StudentExtraCurricular/Responsibilities/student_responsibilities_list.vue').default },
                { path: '/add_student_responsibilities', component: require('./components/students/StudentExtraCurricular/Responsibilities/add_student_responsibilities.vue').default },
                { path: '/edit_student_responsibilities', component: require('./components/students/StudentExtraCurricular/Responsibilities/edit_student_responsibilities.vue').default },
            ]    
        },
        //Student => Awards and Achievements
        { path: '/student_awards', component: require('./components/students/StudentExtraCurricular/Awards/student_awards.vue').default,
            children: [
                { path: '/', component: require('./components/students/StudentExtraCurricular/Awards/student_awards_list.vue').default },
                { path: '/student_awards_list', component: require('./components/students/StudentExtraCurricular/Awards/student_awards_list.vue').default },
                { path: '/add_student_awards', component: require('./components/students/StudentExtraCurricular/Awards/add_student_awards.vue').default },
                { path: '/edit_student_awards', component: require('./components/students/StudentExtraCurricular/Awards/edit_student_awards.vue').default },
            ] 
        },
    ] 
    },

    //Student Programs and Clubs Routes
    { path: '/student_programs_clubs', component: require('./components/students/StudentExtraCurricular/programs_clubs_index.vue').default,
    children: [
        //Student => Programs and Clubs
        { path: '/student_programs', component: require('./components/students/StudentExtraCurricular/Programs/student_programs.vue').default,
            children: [
                { path: '/', component: require('./components/students/StudentExtraCurricular/Programs/student_programs_list.vue').default },
                { path: '/student_programs_list', component: require('./components/students/StudentExtraCurricular/Programs/student_programs_list.vue').default },
                { path: '/add_student_programs', component: require('./components/students/StudentExtraCurricular/Programs/add_student_programs.vue').default },
                { path: '/register_student_programs', component: require('./components/students/StudentExtraCurricular/Programs/register_student_programs.vue').default },
                { path: '/edit_student_programs', component: require('./components/students/StudentExtraCurricular/Programs/edit_student_programs.vue').default },
            ] 
        },
        { path: '/student_programs_members', component: require('./components/students/StudentExtraCurricular/Programs/student_programs_members.vue').default,
            children: [
                { path: '/', component: require('./components/students/StudentExtraCurricular/Programs/student_programs_list.vue').default },
                { path: '/student_programs_members_list', component: require('./components/students/StudentExtraCurricular/Programs/student_programs_members_list.vue').default },
                { path: '/add_student_programs_members', component: require('./components/students/StudentExtraCurricular/Programs/add_student_programs_members.vue').default },
                { path: '/register_student_programs_members', component: require('./components/students/StudentExtraCurricular/Programs/register_student_programs_members.vue').default },
                { path: '/edit_student_programs_members', component: require('./components/students/StudentExtraCurricular/Programs/edit_student_programs_members.vue').default },
            ] 
        },
        { path: '/program_inventory_index', component: require('./components/students/StudentExtraCurricular/Programs/program_inventory_index.vue').default,
            children: [
                { path: '/', component: require('./components/students/StudentExtraCurricular/Programs/program_inventory_list.vue').default },
                { path: '/program_inventory_list', component: require('./components/students/StudentExtraCurricular/Programs/program_inventory_list.vue').default },
                { path: '/program_inventory_add', component: require('./components/students/StudentExtraCurricular/Programs/program_inventory_add.vue').default },
                { path: '/program_inventory_edit', component: require('./components/students/StudentExtraCurricular/Programs/program_inventory_edit.vue').default },
            ] 
        },
        //Student => Projects
        { path: '/student_projects', component: require('./components/students/StudentExtraCurricular/Projects/student_projects.vue').default,
            children: [
                { path: '/', component: require('./components/students/StudentExtraCurricular/Projects/student_projects_list.vue').default },
                { path: '/student_projects_list', component: require('./components/students/StudentExtraCurricular/Projects/student_projects_list.vue').default },
                { path: '/add_student_projects', component: require('./components/students/StudentExtraCurricular/Projects/add_student_projects.vue').default },
                { path: '/edit_student_projects', component: require('./components/students/StudentExtraCurricular/Projects/edit_student_projects.vue').default },
            ] 
        },
        { path: '/student_projects_members', component: require('./components/students/StudentExtraCurricular/Projects/student_projects_members.vue').default,
            children: [
                { path: '/', component: require('./components/students/StudentExtraCurricular/Projects/student_projects_members_list.vue').default },
                { path: '/student_projects_members_list', component: require('./components/students/StudentExtraCurricular/Projects/student_projects_members_list.vue').default },
                { path: '/add_student_projects_members', component: require('./components/students/StudentExtraCurricular/Projects/add_student_projects_members.vue').default },
                { path: '/edit_student_projects_members', component: require('./components/students/StudentExtraCurricular/Projects/edit_student_projects_members.vue').default },
            ] 
        },
    ] 
    },

    //Student Scouts Routes
    { path: '/student_scouts_index', component: require('./components/students/StudentExtraCurricular/scouts_index.vue').default,
    children: [
        //Student => Scouts
        { path: '/student_scouts', component: require('./components/students/StudentExtraCurricular/Scouts/student_scouts.vue').default,
            children: [
                { path: '/', component: require('./components/students/StudentExtraCurricular/Scouts/student_scouts_list.vue').default },
                { path: '/student_scouts_list', component: require('./components/students/StudentExtraCurricular/Scouts/student_scouts_list.vue').default },
                { path: '/add_student_scouts', component: require('./components/students/StudentExtraCurricular/Scouts/add_student_scouts.vue').default },
                { path: '/edit_student_scouts', component: require('./components/students/StudentExtraCurricular/Scouts/edit_student_scouts.vue').default },
            ] 
        },
        { path: '/student_scouts_members', component: require('./components/students/StudentExtraCurricular/Scouts/student_scouts_members.vue').default,
            children: [
                { path: '/', component: require('./components/students/StudentExtraCurricular/Scouts/student_scouts_members_list.vue').default },
                { path: '/student_scouts_members_list', component: require('./components/students/StudentExtraCurricular/Scouts/student_scouts_members_list.vue').default },
                { path: '/add_student_scouts_members', component: require('./components/students/StudentExtraCurricular/Scouts/add_student_scouts_members.vue').default },
                { path: '/edit_student_scouts_members', component: require('./components/students/StudentExtraCurricular/Scouts/edit_student_scouts_members.vue').default },
            ] 
        },
    ] 
    },

    //Student Training Routes
    { path: '/student_trainings_index', component: require('./components/students/StudentExtraCurricular/student_trainings_index.vue').default,
    children: [
        //Student => Training, Workshops, Seminars
        { path: '/student_trainings', component: require('./components/students/StudentExtraCurricular/Trainings/student_trainings.vue').default,
            children: [
                { path: '/', component: require('./components/students/StudentExtraCurricular/Trainings/student_trainings_list.vue').default },
                { path: '/student_trainings_list', component: require('./components/students/StudentExtraCurricular/Trainings/student_trainings_list.vue').default },
                { path: '/add_student_trainings', component: require('./components/students/StudentExtraCurricular/Trainings/add_student_trainings.vue').default },
                { path: '/edit_student_trainings', component: require('./components/students/StudentExtraCurricular/Trainings/edit_student_trainings.vue').default },
            ] 
        },
        { path: '/student_trainings_participants', component: require('./components/students/StudentExtraCurricular/Trainings/student_trainings_participants.vue').default,
            children: [
                { path: '/', component: require('./components/students/StudentExtraCurricular/Trainings/student_trainings_participants_list.vue').default },
                { path: '/student_trainings_participants_list', component: require('./components/students/StudentExtraCurricular/Trainings/student_trainings_participants_list.vue').default },
                { path: '/add_student_trainings_participants', component: require('./components/students/StudentExtraCurricular/Trainings/add_student_trainings_participants.vue').default },
                { path: '/edit_student_trainings_participants', component: require('./components/students/StudentExtraCurricular/Trainings/edit_student_trainings_participants.vue').default },
            ] 
        },
    ] 
    },

    //Student Health
    { path: '/student_health', component: require('./components/students/StudentHealth/index.vue').default,
    children: [
        { path: '/std_health_screening', 
            component: require('./components/students/StudentHealth/HealthScreening/std_health_screening.vue').default,
            children: [
                { path: '/', component: require('./components/students/StudentHealth/HealthScreening/std_health_screening_list.vue').default },
                { path: '/std_health_screening_list', component: require('./components/students/StudentHealth/HealthScreening/std_health_screening_list.vue').default },
                { path: '/std_health_screening_add', component: require('./components/students/StudentHealth/HealthScreening/std_health_screening_add.vue').default },
                { path: '/std_health_screening_edit', component: require('./components/students/StudentHealth/HealthScreening/std_health_screening_edit.vue').default },
            ]    
        },
        // Deworming
        { path: '/std_deworming', 
        component: require('./components/students/StudentHealth/Deworming/std_deworming.vue').default,
            children: [
            { path: '/', component: require('./components/students/StudentHealth/Deworming/std_deworming_list.vue').default },
            { path: '/std_deworming_list', component: require('./components/students/StudentHealth/Deworming/std_deworming_list.vue').default },
            { path: '/std_deworming_add', component: require('./components/students/StudentHealth/Deworming/std_deworming_add.vue').default },
            { path: '/std_deworming_edit', component: require('./components/students/StudentHealth/Deworming/std_deworming_edit.vue').default },
            ]    
        },

        //supplementation
        { path: '/std_supplementation', 
        component: require('./components/students/StudentHealth/Supplementation/std_supplementation.vue').default,
            children: [
            { path: '/', component: require('./components/students/StudentHealth/Supplementation/std_supplementation_list.vue').default },
            { path: '/std_supplementation_list', component: require('./components/students/StudentHealth/Supplementation/std_supplementation_list.vue').default },
            { path: '/std_supplementation_add', component: require('./components/students/StudentHealth/Supplementation/std_supplementation_add.vue').default },
            { path: '/std_supplementation_edit', component: require('./components/students/StudentHealth/Supplementation/std_supplementation_edit.vue').default },
            ] 
        },
        //vaccination
        { path: '/std_vaccination', 
        component: require('./components/students/StudentHealth/Vaccination/std_vaccination.vue').default,
            children: [
            { path: '/', component: require('./components/students/StudentHealth/Vaccination/std_vaccination_list.vue').default },
            { path: '/std_vaccination_list', component: require('./components/students/StudentHealth/Vaccination/std_vaccination_list.vue').default },
            { path: '/std_vaccination_add', component: require('./components/students/StudentHealth/Vaccination/std_vaccination_add.vue').default },
            { path: '/std_vaccination_edit', component: require('./components/students/StudentHealth/Vaccination/std_vaccination_edit.vue').default },
            ] 
        },
        //BMI link
        { path: '/std_bmi', 
        component: require('./components/students/StudentHealth/BMI/std_bmi.vue').default,
            children: [
            { path: '/', component: require('./components/students/StudentHealth/BMI/std_bmi_list.vue').default },
            { path: '/std_bmi_list', component: require('./components/students/StudentHealth/BMI/std_bmi_list.vue').default },
            { path: '/std_bmi_add', component: require('./components/students/StudentHealth/BMI/std_bmi_add.vue').default },
            { path: '/std_bmi_edit', component: require('./components/students/StudentHealth/BMI/std_bmi_edit.vue').default },
            ] 
        },
    ] 
    },
];
export default routes