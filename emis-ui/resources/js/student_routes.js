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
    
   
    
    { path: '/training_type_index', 
    component: require('./components/masters/student_masters/trainings/training_type_index.vue').default ,
      children: [
        { path: '', component: require('./components/masters/student_masters/trainings/training_type_index.vue').default },
        { path: '/training_type_add', name:'StudentTrainingTypeAdd', component: require('./components/masters/student_masters/trainings/training_type_add.vue').default },
        { path: '/training_type_edit', name:'StudentTrainingTypeEdit', component: require('./components/masters/student_masters/trainings/training_type_edit.vue').default },
        { path: '/training_type_list', name:'StudentTrainingTypeList', component: require('./components/masters/student_masters/trainings/training_type_list.vue').default },
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
    //Student Admission Related Routes
    { path: '/student_admission', component: require('./components/students/StudentAdmission/index.vue').default,
        children: [
            { path: '/',name:'student_admission', component: require('./components/students/StudentAdmission/student_admission_list.vue').default },
            { path: '/student_new_admission', component: require('./components/students/StudentAdmission/Admission/student_admission.vue').default,
                children: [ 
                    { path: '/', name:'student_new_admission', component: require('./components/students/StudentAdmission/Admission/student_admission_list.vue').default },
                    { path: '/student_admission_list',name:'student_admission_list', component: require('./components/students/StudentAdmission/Admission/student_admission_list.vue').default },
                    { path: '/new_student_admission',name:'new_student_admission', component: require('./components/students/StudentAdmission/Admission/new_student_admission.vue').default },
                    { path: '/edit_student_admission', name:'edit_student_admission', component: require('./components/students/StudentAdmission/Admission/edit_student_admission.vue').default },
                ]    
            },
            { path: '/student_admission_request', component: require('./components/students/StudentAdmission/Admission/student_admission.vue').default,
                children: [
                    { path: '/', component: require('./components/students/StudentAdmission/Admission/student_admission_list.vue').default },
                    { path: '/student_admission_list', name:'student_admission_list', component: require('./components/students/StudentAdmission/Admission/student_admission_list.vue').default },
                    { path: '/new_student_admission', name:'new_student_admission', component: require('./components/students/StudentAdmission/Admission/new_student_admission.vue').default },
                    { path: '/edit_student_admission', name:'edit_student_admission', component: require('./components/students/StudentAdmission/Admission/edit_student_admission.vue').default },
                ]    
            }, 
            { path: '/student_admission_apply', component: require('./components/students/StudentAdmission/Admission/student_admission.vue').default,
                children: [
                    { path: '/', component: require('./components/students/StudentAdmission/Admission/student_admission_list.vue').default },
                    { path: '/student_admission_list', name:'student_admission_list', component: require('./components/students/StudentAdmission/Admission/student_admission_list.vue').default },
                    { path: '/new_student_admission', name:'new_student_admission', component: require('./components/students/StudentAdmission/Admission/new_student_admission.vue').default },
                    { path: '/edit_student_admission', name:'edit_student_admission', component: require('./components/students/StudentAdmission/Admission/edit_student_admission.vue').default },
                ]    
            }, 
            // Student => Reporting
            { path: '/student_reporting', 
            component: require('./components/students/StudentAdmission/Reporting/student_reporting.vue').default,
                children: [
                    { path: '/', component: require('./components/students/StudentAdmission/Reporting/reported_student_list.vue').default },
                    { path: '/reported_student_list', name:'reported_student_list', component: require('./components/students/StudentAdmission/Reporting/reported_student_list.vue').default },
                    { path: '/report_student', name:'report_student', component: require('./components/students/StudentAdmission/Reporting/report_student.vue').default },
                    { path: '/edit_reported_student', name:'edit_reported_student', component: require('./components/students/StudentAdmission/Reporting/edit_reported_student.vue').default },
                ]    
            },
            //Student => Leaving
            { path: '/student_leaving', component: require('./components/students/StudentAdmission/Leaving/school_leaving.vue').default,
                children: [
                    { path: '/', component: require('./components/students/StudentAdmission/Leaving/school_leaving_list.vue').default },
                    { path: '/school_leaving_list', name:'school_leaving_list', component: require('./components/students/StudentAdmission/Leaving/school_leaving_list.vue').default },
                    { path: '/transfer_student', name:'transfer_student', component: require('./components/students/StudentAdmission/Leaving/transfer_student.vue').default },
                    { path: '/edit_transfer_student', name:'edit_transfer_student', component: require('./components/students/StudentAdmission/Leaving/edit_transfer_student.vue').default },
                ] 
            },
            //Student => Updates
            { path: '/student_updates', component: require('./components/students/StudentAdmission/Updates/student_updates.vue').default,
                children: [
                    { path: '/', component: require('./components/students/StudentAdmission/Updates/student_update_list.vue').default },
                    { path: '/student_update_list', name:'student_update_list', component: require('./components/students/StudentAdmission/Updates/student_update_list.vue').default },
                    { path: '/update_student_whereabouts', name:'update_student_whereabouts', component: require('./components/students/StudentAdmission/Updates/update_student_whereabouts.vue').default },
                    { path: '/edit_student_whereabouts', name:'edit_student_whereabouts', component: require('./components/students/StudentAdmission/Updates/edit_student_whereabouts.vue').default },
                ] 
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
                { path: '/student_houses_list', name:'student_houses_list', component: require('./components/students/StudentServices/Houses/student_houses_list.vue').default },
                { path: '/allocate_student_houses', name:'allocate_student_houses', component: require('./components/students/StudentServices/Houses/allocate_student_houses.vue').default },
                { path: '/edit_student_house', name:'edit_student_house', component: require('./components/students/StudentServices/Houses/edit_student_house.vue').default },
            ] 
        },
        //Student => Disciplinary Record
        { path: '/student_disciplinary_record', component: require('./components/students/StudentServices/DisciplinaryRecord/student_disciplinary_record.vue').default,
            children: [
                { path: '/', component: require('./components/students/StudentServices/DisciplinaryRecord/disciplinary_record_list.vue').default },
                { path: '/disciplinary_record', name:'disciplinary_record', component: require('./components/students/StudentServices/DisciplinaryRecord/disciplinary_record_list.vue').default },
                { path: '/add_disciplinary_record', name:'add_disciplinary_record', component: require('./components/students/StudentServices/DisciplinaryRecord/add_disciplinary_record.vue').default },
                { path: '/edit_disciplinary_record', name:'edit_disciplinary_record', component: require('./components/students/StudentServices/DisciplinaryRecord/edit_disciplinary_record.vue').default },
            ] 
        },
        // Student => Roles and Responsibilities
        { path: '/student_responsibilities', component: require('./components/students/StudentExtraCurricular/Responsibilities/student_responsibilities.vue').default,
            children: [
                { path: '/', component: require('./components/students/StudentExtraCurricular/Responsibilities/student_responsibilities_list.vue').default },
                { path: '/student_responsibilities_list', name:'student_responsibilities_list', component: require('./components/students/StudentExtraCurricular/Responsibilities/student_responsibilities_list.vue').default },
                { path: '/add_student_responsibilities', name:'add_student_responsibilities', component: require('./components/students/StudentExtraCurricular/Responsibilities/add_student_responsibilities.vue').default },
                { path: '/edit_student_responsibilities', name:'edit_student_responsibilities', component: require('./components/students/StudentExtraCurricular/Responsibilities/edit_student_responsibilities.vue').default },
            ]    
        },
        //Student => Awards and Achievements
        { path: '/student_awards', component: require('./components/students/StudentExtraCurricular/Awards/student_awards.vue').default,
            children: [
                { path: '/', component: require('./components/students/StudentExtraCurricular/Awards/student_awards_list.vue').default },
                { path: '/student_awards_list', name:'student_awards_list', component: require('./components/students/StudentExtraCurricular/Awards/student_awards_list.vue').default },
                { path: '/add_student_awards', name:'add_student_awards', component: require('./components/students/StudentExtraCurricular/Awards/add_student_awards.vue').default },
                { path: '/edit_student_awards', name:'edit_student_awards', component: require('./components/students/StudentExtraCurricular/Awards/edit_student_awards.vue').default },
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
                { path: '/student_programs_list', name:'student_programs_list', component: require('./components/students/StudentExtraCurricular/Programs/student_programs_list.vue').default },
                { path: '/add_student_programs', name:'add_student_programs', component: require('./components/students/StudentExtraCurricular/Programs/add_student_programs.vue').default },
                { path: '/register_student_programs', name:'register_student_programs', component: require('./components/students/StudentExtraCurricular/Programs/register_student_programs.vue').default },
                { path: '/edit_student_programs', name:'edit_student_programs', component: require('./components/students/StudentExtraCurricular/Programs/edit_student_programs.vue').default },
            ] 
        },
        { path: '/student_programs_members', component: require('./components/students/StudentExtraCurricular/Programs/student_programs_members.vue').default,
            children: [
                { path: '/', component: require('./components/students/StudentExtraCurricular/Programs/student_programs_members_list.vue').default },
                { path: '/student_programs_members_list', name:'student_programs_members_list', component: require('./components/students/StudentExtraCurricular/Programs/student_programs_members_list.vue').default },
                { path: '/add_student_programs_members', name:'add_student_programs_members', component: require('./components/students/StudentExtraCurricular/Programs/add_student_programs_members.vue').default },
                { path: '/register_student_programs_members', name:'register_student_programs_members', component: require('./components/students/StudentExtraCurricular/Programs/register_student_programs_members.vue').default },
                { path: '/edit_student_programs_members', name:'edit_student_programs_members', component: require('./components/students/StudentExtraCurricular/Programs/edit_student_programs_members.vue').default },
            ] 
        },
        { path: '/program_action_plan', component: require('./components/students/StudentExtraCurricular/Programs/program_action_plan.vue').default,
            children: [
                { path: '/', component: require('./components/students/StudentExtraCurricular/Programs/program_action_plan_list.vue').default },
                { path: '/program_action_plan_list', name:'program_action_plan_list', component: require('./components/students/StudentExtraCurricular/Programs/program_action_plan_list.vue').default },
                { path: '/program_action_plan_add', name:'program_action_plan_add', component: require('./components/students/StudentExtraCurricular/Programs/program_action_plan_add.vue').default },
                { path: '/program_action_plan_edit', name:'program_action_plan_edit', component: require('./components/students/StudentExtraCurricular/Programs/program_action_plan_edit.vue').default },
            ] 
        },
        { path: '/program_inventory_index', component: require('./components/students/StudentExtraCurricular/Programs/program_inventory_index.vue').default,
            children: [
                { path: '/', component: require('./components/students/StudentExtraCurricular/Programs/program_inventory_list.vue').default },
                { path: '/program_inventory_list', name:'program_inventory_list', component: require('./components/students/StudentExtraCurricular/Programs/program_inventory_list.vue').default },
                { path: '/program_inventory_add', name:'program_inventory_add', component: require('./components/students/StudentExtraCurricular/Programs/program_inventory_add.vue').default },
                { path: '/program_inventory_edit', name:'program_inventory_edit', component: require('./components/students/StudentExtraCurricular/Programs/program_inventory_edit.vue').default },
            ] 
        },
        //Student => Projects
        { path: '/student_projects', component: require('./components/students/StudentExtraCurricular/Projects/student_projects.vue').default,
            children: [
                { path: '/', component: require('./components/students/StudentExtraCurricular/Projects/student_projects_list.vue').default },
                { path: '/student_projects_list', name:'student_projects_list', component: require('./components/students/StudentExtraCurricular/Projects/student_projects_list.vue').default },
                { path: '/add_student_projects', name:'add_student_projects', component: require('./components/students/StudentExtraCurricular/Projects/add_student_projects.vue').default },
                { path: '/edit_student_projects', name:'edit_student_projects', component: require('./components/students/StudentExtraCurricular/Projects/edit_student_projects.vue').default },
            ] 
        },
        { path: '/student_projects_members', component: require('./components/students/StudentExtraCurricular/Projects/student_projects_members.vue').default,
            children: [
                { path: '/', component: require('./components/students/StudentExtraCurricular/Projects/student_projects_members_list.vue').default },
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
        { path: '/student_scouts', component: require('./components/students/StudentExtraCurricular/Scouts/student_scouts.vue').default,
            children: [
                { path: '/', component: require('./components/students/StudentExtraCurricular/Scouts/student_scouts_list.vue').default },
                { path: '/student_scouts_list', name:'student_scouts_list', component: require('./components/students/StudentExtraCurricular/Scouts/student_scouts_list.vue').default },
                { path: '/add_student_scouts', name:'add_student_scouts', component: require('./components/students/StudentExtraCurricular/Scouts/add_student_scouts.vue').default },
                { path: '/edit_student_scouts', name:'edit_student_scouts', component: require('./components/students/StudentExtraCurricular/Scouts/edit_student_scouts.vue').default },
            ] 
        },
        { path: '/student_scouts_members', component: require('./components/students/StudentExtraCurricular/Scouts/student_scouts_members.vue').default,
            children: [
                { path: '/', component: require('./components/students/StudentExtraCurricular/Scouts/student_scouts_members_list.vue').default },
                { path: '/student_scouts_members_list', name:'student_scouts_members_list', component: require('./components/students/StudentExtraCurricular/Scouts/student_scouts_members_list.vue').default },
                { path: '/add_student_scouts_members', name:'add_student_scouts_members', component: require('./components/students/StudentExtraCurricular/Scouts/add_student_scouts_members.vue').default },
                { path: '/edit_student_scouts_members', name:'edit_student_scouts_members', component: require('./components/students/StudentExtraCurricular/Scouts/edit_student_scouts_members.vue').default },
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
                { path: '/student_trainings_list', name:'student_trainings_list', component: require('./components/students/StudentExtraCurricular/Trainings/student_trainings_list.vue').default },
                { path: '/add_student_trainings', name:'add_student_trainings', component: require('./components/students/StudentExtraCurricular/Trainings/add_student_trainings.vue').default },
                { path: '/edit_student_trainings', name:'edit_student_trainings', component: require('./components/students/StudentExtraCurricular/Trainings/edit_student_trainings.vue').default },
            ] 
        },
        { path: '/student_trainings_participants', component: require('./components/students/StudentExtraCurricular/Trainings/student_trainings_participants.vue').default,
            children: [
                { path: '/', component: require('./components/students/StudentExtraCurricular/Trainings/student_trainings_participants_list.vue').default },
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
        { path: '/std_health_screening', 
            component: require('./components/students/StudentHealth/HealthScreening/std_health_screening.vue').default,
            children: [
                { path: '/', component: require('./components/students/StudentHealth/HealthScreening/std_health_screening_list.vue').default },
                { path: '/std_health_screening_list', name:'std_health_screening_list', component: require('./components/students/StudentHealth/HealthScreening/std_health_screening_list.vue').default },
                { path: '/std_health_screening_add', name:'std_health_screening_add', component: require('./components/students/StudentHealth/HealthScreening/std_health_screening_add.vue').default },
                { path: '/std_health_screening_edit', name:'std_health_screening_edit', component: require('./components/students/StudentHealth/HealthScreening/std_health_screening_edit.vue').default },
            ]    
        },
        // Deworming
        { path: '/std_deworming', 
        component: require('./components/students/StudentHealth/Deworming/std_deworming.vue').default,
            children: [
            { path: '/', component: require('./components/students/StudentHealth/Deworming/std_deworming_list.vue').default },
            { path: '/std_deworming_list', name:'std_deworming_list', component: require('./components/students/StudentHealth/Deworming/std_deworming_list.vue').default },
            { path: '/std_deworming_add', name:'std_deworming_add', component: require('./components/students/StudentHealth/Deworming/std_deworming_add.vue').default },
            { path: '/std_deworming_edit', name:'std_deworming_edit', component: require('./components/students/StudentHealth/Deworming/std_deworming_edit.vue').default },
            ]    
        },

        //supplementation
        { path: '/std_supplementation', 
        component: require('./components/students/StudentHealth/Supplementation/std_supplementation.vue').default,
            children: [
            { path: '/', component: require('./components/students/StudentHealth/Supplementation/std_supplementation_list.vue').default },
            { path: '/std_supplementation_list', name:'std_supplementation_list', component: require('./components/students/StudentHealth/Supplementation/std_supplementation_list.vue').default },
            { path: '/std_supplementation_add', name:'std_supplementation_add', component: require('./components/students/StudentHealth/Supplementation/std_supplementation_add.vue').default },
            { path: '/std_supplementation_edit', name:'std_supplementation_edit', component: require('./components/students/StudentHealth/Supplementation/std_supplementation_edit.vue').default },
            ] 
        },
        //vaccination
        { path: '/std_vaccination', 
        component: require('./components/students/StudentHealth/Vaccination/std_vaccination.vue').default,
            children: [
            { path: '/', component: require('./components/students/StudentHealth/Vaccination/std_vaccination_list.vue').default },
            { path: '/std_vaccination_list', name:'std_vaccination_list', component: require('./components/students/StudentHealth/Vaccination/std_vaccination_list.vue').default },
            { path: '/std_vaccination_add', name:'std_vaccination_add', component: require('./components/students/StudentHealth/Vaccination/std_vaccination_add.vue').default },
            { path: '/std_vaccination_edit', name:'std_vaccination_edit', component: require('./components/students/StudentHealth/Vaccination/std_vaccination_edit.vue').default },
            ] 
        },
        //BMI link
        { path: '/std_bmi', 
        component: require('./components/students/StudentHealth/BMI/std_bmi.vue').default,
            children: [
            { path: '/', component: require('./components/students/StudentHealth/BMI/std_bmi_list.vue').default },
            { path: '/std_bmi_list', name:'std_bmi_list', component: require('./components/students/StudentHealth/BMI/std_bmi_list.vue').default },
            { path: '/std_bmi_add', name:'std_bmi_add', component: require('./components/students/StudentHealth/BMI/std_bmi_add.vue').default },
            { path: '/std_bmi_edit', name:'std_bmi_edit', component: require('./components/students/StudentHealth/BMI/std_bmi_edit.vue').default },
            ] 
        },
    ] 
    },
];
export default routes