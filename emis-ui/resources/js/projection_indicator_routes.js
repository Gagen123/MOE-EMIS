const routes = [
    //External data import Routes
    { path: '/data_import_index', component: require('./components/projection_indicator/data_import/data_import.vue').default,
        children: [
            //Instuties data import
            { path: '/', component: require('./components/projection_indicator/data_import/data_import_guideline.vue').default},
            { path: '/institute_index', component: require('./components/projection_indicator/data_import/institutes/institute_index.vue').default,
                children: [
                    { path: '/', name:'rub_data_import', component: require('./components/projection_indicator/data_import/institutes/list_instittute.vue').default },
                    { path: '/list_instittute', name:'list_instittute', component: require('./components/projection_indicator/data_import/institutes/list_instittute.vue').default },
                    { path: '/edit_institute', name:'edit_institute', component: require('./components/projection_indicator/data_import/institutes/edit_institute.vue').default },
                    { path: '/add_institute', name:'add_institute', component: require('./components/projection_indicator/data_import/institutes/add_institute.vue').default },
                    { path: '/institute_index', name:'institute_index', component: require('./components/projection_indicator/data_import/institutes/institute_index.vue').default },
                ]
            },
                // staff data import
            { path: '/staff_index', component: require('./components/projection_indicator/data_import/staffs/staff_index.vue').default,
            children: [
                { path: '/', name:'staff_index', component: require('./components/projection_indicator/data_import/staffs/list_staff.vue').default },
                { path: '/list_staff', name:'list_staff', component: require('./components/projection_indicator/data_import/staffs/list_staff.vue').default },
                { path: '/add_staff', name:'add_staff', component: require('./components/projection_indicator/data_import/staffs/add_staff.vue').default },
                { path: '/edit_staff', name:'edit_staff', component: require('./components/projection_indicator/data_import/staffs/edit_staff.vue').default },
                ]
            },
            // student data import
            { path: '/student_index', component: require('./components/projection_indicator/data_import/students/student_index.vue').default,
                children: [
                    { path: '/', name:'Dahe_index', component: require('./components/projection_indicator/data_import/students/list_student.vue').default },
                    { path: '/list_student', name:'list_student', component: require('./components/projection_indicator/data_import/students/list_student.vue').default },
                    { path: '/add_student', name:'add_student', component: require('./components/projection_indicator/data_import/students/add_student.vue').default },
                    { path: '/edit_student', name:'edit_student', component: require('./components/projection_indicator/data_import/students/edit_student.vue').default },
                ]
            },
            //   dahe data import
            { path: '/Dahe_index', component: require('./components/projection_indicator/data_import/dahe/dahe.vue').default,
                children: [
                    { path: '/', name:'Dahe_index', component: require('./components/projection_indicator/data_import/dahe/list_outgoing_student.vue').default },
                    { path: '/list_outgoing_student', name:'list_outgoing_student', component: require('./components/projection_indicator/data_import/dahe/list_outgoing_student.vue').default },
                    { path: '/add_outgoing_student', name:'add_outgoing_student', component: require('./components/projection_indicator/data_import/dahe/add_outgoing_student.vue').default },
                    { path: '/edit_outgoing_student', name:'edit_outgoing_student', component: require('./components/projection_indicator/data_import/dahe/edit_outgoing_student.vue').default },
                ]
            },

            //   nsb data import
            { path: '/nsb_index', component: require('./components/projection_indicator/data_import/nsb/nsb_index.vue').default,
                children: [
                    { path: '/', name:'nsb_index', component: require('./components/projection_indicator/data_import/nsb/list_nsb.vue').default },
                    { path: '/list_nsb', name:'list_nsb', component: require('./components/projection_indicator/data_import/nsb/list_nsb.vue').default },
                    { path: '/add_nsb', name:'add_nsb', component: require('./components/projection_indicator/data_import/nsb/add_nsb.vue').default },
                    { path: '/edit_nsb', name:'edit_nsb', component: require('./components/projection_indicator/data_import/nsb/edit_nsb.vue').default },
                ]
            },
            //   census data import
            { path: '/census_index', component: require('./components/projection_indicator/data_import/census/census_index.vue').default,
            children: [
                { path: '/', name:'census_index', component: require('./components/projection_indicator/data_import/census/list_census.vue').default },
                { path: '/list_census', name:'list_census', component: require('./components/projection_indicator/data_import/census/list_census.vue').default },
                { path: '/add_census', name:'add_census', component: require('./components/projection_indicator/data_import/census/add_census.vue').default },
                { path: '/edit_census', name:'edit_census', component: require('./components/projection_indicator/data_import/census/edit_census.vue').default },
            ]
        },
        ]
    },
    { path: '/education_center_index',
        component: require('./components/projection_indicator/educational_institutes/education_center_index.vue').default,
        children:[
            { path: '/',name:'education_center_index', component: require('./components/projection_indicator/educational_institutes/education_center_guidelines.vue').default },
            { path: '/educationcenter_index',component: require('./components/projection_indicator/educational_institutes/educationcenter_index.vue').default,
                children:[
                    { path: '/eccd_center_index',name:'eccd_center_index', component: require('./components/projection_indicator/educational_institutes/eccd_center_index.vue').default },
                    { path: '/school_center_index',name:'school_center_index', component: require('./components/projection_indicator/educational_institutes/school_center_index.vue').default },
                    { path: '/tertiary_center_index',name:'tertiary_center_index', component: require('./components/projection_indicator/educational_institutes/tertiary_center_index.vue').default },
                    { path: '/ecr_center_index',name:'ecr_center_index', component: require('./components/projection_indicator/educational_institutes/ecr_center_index.vue').default },
                    { path: '/sen_center_index',name:'sen_center_index', component: require('./components/projection_indicator/educational_institutes/sen_center_index.vue').default },
                ],
            },
        ],
    },
    { path: '/education_indicators',
        component: require('./components/projection_indicator/education_indicators/education_indicators_index.vue').default,
        children:[
            { path: '/',name:'education_indicators_index', component: require('./components/projection_indicator/education_indicators/education_indicators_guidelines.vue').default },
            { path: '/ei_enrollment_index',component: require('./components/projection_indicator/education_indicators/enrollment/ei_enrollment_index.vue').default,
                children:[
                    { path: '/enrollment_eccd',name:'enrollment_eccd', component: require('./components/projection_indicator/education_indicators/enrollment/enrollment_eccd.vue').default },
                    { path: '/enrollment_pre_primary',name:'enrollment_pre_primary', component: require('./components/projection_indicator/education_indicators/enrollment/enrollment_pre_primary.vue').default },
                    { path: '/enrollment_primary',name:'enrollment_primary', component: require('./components/projection_indicator/education_indicators/enrollment/enrollment_primary.vue').default },
                    { path: '/enrollment_basic',name:'enrollment_basic', component: require('./components/projection_indicator/education_indicators/enrollment/enrollment_basic.vue').default },
                    { path: '/enrollment_lower_secondary',name:'enrollment_lower_secondary', component: require('./components/projection_indicator/education_indicators/enrollment/enrollment_lower_secondary.vue').default },
                    { path: '/enrollment_middle_secondary',name:'enrollment_middle_secondary', component: require('./components/projection_indicator/education_indicators/enrollment/enrollment_middle_secondary.vue').default },
                    { path: '/enrollment_higher_secondary',name:'enrollment_higher_secondary', component: require('./components/projection_indicator/education_indicators/enrollment/enrollment_higher_secondary.vue').default },
                    { path: '/enrollment_tertiary',name:'enrollment_tertiary', component: require('./components/projection_indicator/education_indicators/enrollment/enrollment_tertiary.vue').default },
                ],
            },
            { path: '/ei_gpi_index',component: require('./components/projection_indicator/education_indicators/gender_parity/ei_gpi_index.vue').default,
                children:[
                    { path: '/gpi_primary',name:'gpi_primary', component: require('./components/projection_indicator/education_indicators/gender_parity/gpi_primary.vue').default },
                    { path: '/gpi_middle_secondary',name:'gpi_middle_secondary', component: require('./components/projection_indicator/education_indicators/gender_parity/gpi_middle_secondary.vue').default },
                    { path: '/gpi_lower_secondary',name:'gpi_lower_secondary', component: require('./components/projection_indicator/education_indicators/gender_parity/gpi_lower_secondary.vue').default },
                    { path: '/gpi_higher_secondary',name:'gpi_higher_secondary', component: require('./components/projection_indicator/education_indicators/gender_parity/gpi_higher_secondary.vue').default },
                    { path: '/gpi_tertiary',name:'gpi_tertiary', component: require('./components/projection_indicator/education_indicators/gender_parity/gpi_tertiary.vue').default },
                ],
            },
            { path: '/ei_growth_index',component: require('./components/projection_indicator/education_indicators/growth/ei_growth_index.vue').default,
                children:[
                    { path: '/growth_primary',name:'growth_primary', component: require('./components/projection_indicator/education_indicators/growth/growth_primary.vue').default },
                    { path: '/growth_middle_secondary',name:'growth_middle_secondary', component: require('./components/projection_indicator/education_indicators/growth/growth_middle_secondary.vue').default },
                    { path: '/growth_lower_secondary',name:'growth_lower_secondary', component: require('./components/projection_indicator/education_indicators/growth/growth_lower_secondary.vue').default },
                    { path: '/growth_higher_secondary',name:'growth_higher_secondary', component: require('./components/projection_indicator/education_indicators/growth/growth_higher_secondary.vue').default },
                    { path: '/growth_tertiary',name:'growth_tertiary', component: require('./components/projection_indicator/education_indicators/growth/growth_tertiary.vue').default },
                ],
            },
            { path: '/ei_teachers_index',component: require('./components/projection_indicator/education_indicators/teachers/ei_teachers_index.vue').default,
                children:[
                    { path: '/teachers_eccd',name:'teachers_eccd', component: require('./components/projection_indicator/education_indicators/teachers/teachers_eccd.vue').default },
                    { path: '/teachers_pre_primary',name:'teachers_pre_primary', component: require('./components/projection_indicator/education_indicators/teachers/teachers_pre_primary.vue').default },
                    { path: '/teachers_primary',name:'teachers_primary', component: require('./components/projection_indicator/education_indicators/teachers/teachers_primary.vue').default },
                    { path: '/teachers_middle_secondary',name:'teachers_middle_secondary', component: require('./components/projection_indicator/education_indicators/teachers/teachers_middle_secondary.vue').default },
                    { path: '/teachers_lower_secondary',name:'teachers_lower_secondary', component: require('./components/projection_indicator/education_indicators/teachers/teachers_lower_secondary.vue').default },
                    { path: '/teachers_higher_secondary',name:'teachers_higher_secondary', component: require('./components/projection_indicator/education_indicators/teachers/teachers_higher_secondary.vue').default },
                    { path: '/teachers_tertiary',name:'teachers_tertiary', component: require('./components/projection_indicator/education_indicators/teachers/teachers_tertiary.vue').default },
                ],
            },
            { path: '/ei_teachers_attrition_index',component: require('./components/projection_indicator/education_indicators/teachers_attrition/ei_teachers_attrition_index.vue').default,
                children:[
                    { path: '/attrition_primary',name:'attrition_primary', component: require('./components/projection_indicator/education_indicators/teachers_attrition/attrition_primary.vue').default },
                    { path: '/attrition_middle_secondary',name:'attrition_middle_secondary', component: require('./components/projection_indicator/education_indicators/teachers_attrition/attrition_middle_secondary.vue').default },
                    { path: '/attrition_lower_secondary',name:'attrition_lower_secondary', component: require('./components/projection_indicator/education_indicators/teachers_attrition/attrition_lower_secondary.vue').default },
                    { path: '/attrition_higher_secondary',name:'attrition_higher_secondary', component: require('./components/projection_indicator/education_indicators/teachers_attrition/attrition_higher_secondary.vue').default },
                ],
            },
        ],
    },
    { path: '/efficiency_indicators',
        component: require('./components/projection_indicator/efficiency_indicators/efficiency_indicators_index.vue').default,
        children:[
            { path: '/',name:'efficiency_indicators_index', component: require('./components/projection_indicator/efficiency_indicators/efficiency_indicators_guidelines.vue').default },
            { path: '/ei_completion_index',name:'ei_completion_index', component: require('./components/projection_indicator/efficiency_indicators/completion/ei_completion_index.vue').default },
            { path: '/ei_dropout_index',name:'ei_dropout_index', component: require('./components/projection_indicator/efficiency_indicators/dropout/ei_dropout_index.vue').default },
            { path: '/ei_promotion_index',name:'ei_promotion_index', component: require('./components/projection_indicator/efficiency_indicators/promotion/ei_promotion_index.vue').default },
            { path: '/ei_repitition_index',name:'ei_repitition_index', component: require('./components/projection_indicator/efficiency_indicators/repitition/ei_repitition_index.vue').default },
            { path: '/ei_survival_index',name:'ei_survival_index', component: require('./components/projection_indicator/efficiency_indicators/survival/ei_survival_index.vue').default },
            { path: '/ei_transition_index',name:'ei_transition_index', component: require('./components/projection_indicator/efficiency_indicators/transition/ei_transition_index.vue').default },
        ]
    },
    { path: '/quality_indicators',
        component: require('./components/projection_indicator/quality_indicators/quality_indicators_index.vue').default,
        children:[
            { path: '/',name:'quality_indicators_index', component: require('./components/projection_indicator/quality_indicators/quality_indicators_guidelines.vue').default },
            { path: '/qi_cs_index',component: require('./components/projection_indicator/quality_indicators/class_size/qi_cs_index.vue').default,
                children:[
                    { path: '/cs_primary',name:'cs_primary', component: require('./components/projection_indicator/quality_indicators/class_size/cs_primary.vue').default },
                    { path: '/cs_special_institute',name:'cs_special_institute', component: require('./components/projection_indicator/quality_indicators/class_size/cs_special_institute.vue').default },
                    { path: '/cs_lower_secondary',name:'cs_lower_secondary', component: require('./components/projection_indicator/quality_indicators/class_size/cs_lower_secondary.vue').default },
                    { path: '/cs_middle_secondary',name:'cs_middle_secondary', component: require('./components/projection_indicator/quality_indicators/class_size/cs_middle_secondary.vue').default },
                    { path: '/cs_higher_secondary',name:'cs_higher_secondary', component: require('./components/projection_indicator/quality_indicators/class_size/cs_higher_secondary.vue').default },
                ],
            },
            { path: '/qi_str_index',component: require('./components/projection_indicator/quality_indicators/student_teacher_ratio/qi_str_index.vue').default,
                children:[
                    { path: '/str_primary',name:'str_primary', component: require('./components/projection_indicator/quality_indicators/student_teacher_ratio/str_primary.vue').default },
                    { path: '/str_lower_secondary',name:'str_lower_secondary', component: require('./components/projection_indicator/quality_indicators/student_teacher_ratio/str_lower_secondary.vue').default },
                    { path: '/str_middle_secondary',name:'str_middle_secondary', component: require('./components/projection_indicator/quality_indicators/student_teacher_ratio/str_middle_secondary.vue').default },
                    { path: '/str_higher_secondary',name:'str_higher_secondary', component: require('./components/projection_indicator/quality_indicators/student_teacher_ratio/str_higher_secondary.vue').default },
                ],
            },
            { path: '/qi_exams_index',component: require('./components/projection_indicator/quality_indicators/exam_results/qi_exams_index.vue').default,
                children:[
                    { path: '/qi_bcse',name:'qi_bcse', component: require('./components/projection_indicator/quality_indicators/exam_results/qi_bcse.vue').default },
                    { path: '/qi_bhcse',name:'qi_bhcse', component: require('./components/projection_indicator/quality_indicators/exam_results/qi_bhcse.vue').default },
                ],
            },
            { path: '/qi_teacher_index',component: require('./components/projection_indicator/quality_indicators/teacher/qi_teacher_index.vue').default,
                children:[
                    { path: '/qi_teacher_attrition',name:'qi_teacher_attrition', component: require('./components/projection_indicator/quality_indicators/teacher/qi_teacher_attrition.vue').default },
                    { path: '/qi_teacher_development',name:'qi_teacher_development', component: require('./components/projection_indicator/quality_indicators/teacher/qi_teacher_development.vue').default },
                    { path: '/qi_teacher_education',name:'qi_teacher_education', component: require('./components/projection_indicator/quality_indicators/teacher/qi_teacher_education.vue').default },
                    { path: '/qi_teacher_nationality_level',name:'qi_teacher_nationality_level', component: require('./components/projection_indicator/quality_indicators/teacher/qi_teacher_nationality_level.vue').default },
                    { path: '/qi_teacher_nationality',name:'qi_teacher_nationality', component: require('./components/projection_indicator/quality_indicators/teacher/qi_teacher_nationality.vue').default },
                    { path: '/qi_teacher_workshops',name:'qi_teacher_workshops', component: require('./components/projection_indicator/quality_indicators/teacher/qi_teacher_workshops.vue').default },
                ],
            },
            { path: '/qi_counsellor_index',name:'qi_counsellor_index', component: require('./components/projection_indicator/quality_indicators/counsellor/qi_counsellor_index.vue').default },
            { path: '/qi_scouts_index',name:'qi_scouts_index', component: require('./components/projection_indicator/quality_indicators/scouts/qi_scouts_index.vue').default },
            { path: '/qi_sen_index',name:'qi_sen_index', component: require('./components/projection_indicator/quality_indicators/sen/qi_sen_index.vue').default },
        ]
    },

    //DELETE ALL ROUTES BELOW THIS LINE!!!!!
    { path: '/student_Projection_index',
        component: require('./components/projection_indicator/student_learners/student_learner_index.vue').default,
        children:[
            { path: '/',name:'student_Projection_index', component: require('./components/projection_indicator/student_learners/student_learner_guidelines.vue').default },
            { path: '/student_children_index',component: require('./components/projection_indicator/student_learners/student/student_index.vue').default,
                children:[
                    { path: '/eccd_children_index',name:'eccd_children_index', component: require('./components/projection_indicator/student_learners/student/eccd_index.vue').default },
                    { path: '/school_student_index',name:'school_student_index', component: require('./components/projection_indicator/student_learners/student/school_index.vue').default },
                    { path: '/tertiary_learners_index',name:'tertiary_learners_index', component: require('./components/projection_indicator/student_learners/student/tertiary_index.vue').default },
                ],
            },
            { path: '/student_enrolment',component: require('./components/projection_indicator/student_learners/student_enrolment/student_enrolment_index.vue').default,
                children:[
                    { path: '/eccd_enrollment_index',name:'eccd_enrollment_index', component: require('./components/projection_indicator/student_learners/student_enrolment/eccd_enrollment_index.vue').default },
                    { path: '/school_enrollment_index',name:'school_enrollment_index', component: require('./components/projection_indicator/student_learners/student_enrolment/school_enrollment_index.vue').default },
                    // { path: '/tertiary_learners_index',name:'tertiary_learners_index', component: require('./components/projection_indicator/student_learners/student/tertiary_index.vue').default },
                ],
            },

            { path: '/student_gender_index',component: require('./components/projection_indicator/student_learners/gender_parity/student_gender_parity_index.vue').default,
                children:[
                    { path: '/eccd_gender_parity_index',name:'eccd_gender_parity_index', component: require('./components/projection_indicator/student_learners/gender_parity/eccd_gender_parity_index.vue').default },
                    { path: '/school_gender_parity_index',name:'school_gender_parity_index', component: require('./components/projection_indicator/student_learners/gender_parity/school_gender_parity_index.vue').default },
                    // { path: '/tertiary_learners_index',name:'tertiary_learners_index', component: require('./components/projection_indicator/student_learners/student/tertiary_index.vue').default },
                ],
            },
        ],
    },
    //Teacher/Trainer/Facilitator

    { path: '/teacher_Projection_index',
        component: require('./components/projection_indicator/teacher_Facilitator/teacher_facilitator_index.vue').default,
        children:[
            { path: '/',name:'teacher_Projection_index', component: require('./components/projection_indicator/teacher_Facilitator/teacher_facilitator_guidelines.vue').default },
            { path: '/teacher_index',component: require('./components/projection_indicator/teacher_Facilitator/teacher_index.vue').default,
                children:[
                    { path: '/tertiary_teacher_index',name:'tertiary_teacher_index', component: require('./components/projection_indicator/teacher_Facilitator/teacher/tertiary_index.vue').default },
                    { path: '/school_teacher_index',name:'school_teacher_index', component: require('./components/projection_indicator/teacher_Facilitator/teacher/school_index.vue').default },
                    { path: '/eccd_teacher_index',name:'eccd_teacher_index', component: require('./components/projection_indicator/teacher_Facilitator/teacher/eccd_index.vue').default },
                    { path: '/ecr_teacher_index',name:'ecr_teacher_index', component: require('./components/projection_indicator/teacher_Facilitator/teacher/ecr_index.vue').default },
                ],
            },
            { path: '/gender_parity_index',component: require('./components/projection_indicator/teacher_Facilitator/gender_parity_index.vue').default,
                children:[
                    { path: '/tertiary_teacher_gender_index',name:'gender_parity_index', component: require('./components/projection_indicator/teacher_Facilitator/teacher/tertiary_index.vue').default },
                    { path: '/school_teacher_gender_index',name:'school_teacher_gender_index', component: require('./components/projection_indicator/teacher_Facilitator/teacher/school_index.vue').default },
                    { path: '/eccd_teacher_gender_index',name:'eccd_teacher_gender_index', component: require('./components/projection_indicator/teacher_Facilitator/teacher/eccd_index.vue').default },
                    { path: '/ecr_teacher_gender_index',name:'ecr_teacher_gender_index', component: require('./components/projection_indicator/teacher_Facilitator/teacher/ecr_index.vue').default },
                ],
            },
            { path: '/recruitment_index',component: require('./components/projection_indicator/teacher_Facilitator/recruitment_index.vue').default,
                children:[
                    { path: '/tertiary_teacher_recur_index',name:'tertiary_teacher_recur_index', component: require('./components/projection_indicator/teacher_Facilitator/teacher/tertiary_index.vue').default },
                    { path: '/school_teacher_recur_index',name:'school_teacher_recur_index', component: require('./components/projection_indicator/teacher_Facilitator/teacher/school_index.vue').default },
                    { path: '/eccd_teacher_recur_index',name:'eccd_teacher_recur_index', component: require('./components/projection_indicator/teacher_Facilitator/teacher/eccd_index.vue').default },
                    { path: '/ecr_teacher_recur_index',name:'ecr_teacher_recur_index', component: require('./components/projection_indicator/teacher_Facilitator/teacher/ecr_index.vue').default },
                ],
            },
            
        ],
    },
    { path: '/enrollment_Projection_index',
        component: require('./components/projection_indicator/enrollment/enrollment_index.vue').default,
        children:[
            { path: '/',name:'enrollment_Projection_index', component: require('./components/projection_indicator/enrollment/enrollment_guidelines.vue').default },
            { path: '/eccd_enrollment_index',name:'eccd_enrollment_index', component: require('./components/projection_indicator/enrollment/eccd/eccdenrollment_index.vue').default },
            { path: '/school_enrollment_index',name:'school_enrollment_index', component: require('./components/projection_indicator/enrollment/school/schoolenrollment_index.vue').default },
            { path: '/tertiary_enrollment_index',name:'tertiary_enrollment_index', component: require('./components/projection_indicator/enrollment/tertiary/tertiaryenrollment_index.vue').default },
        ],
    },

];
export default routes

