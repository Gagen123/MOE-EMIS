const routes = [
   // { path: '/education_center_index', name:'education_center_index', component: require('./components/projection_indicator/education_center_index.vue').default },
    { path: '/education_center_index',
        component: require('./components/projection_indicator/education_center/education_center_index.vue').default,
        children:[
            { path: '/',name:'education_center_index', component: require('./components/projection_indicator/education_center/education_center_guidelines.vue').default },
            { path: '/educationcenter_index',component: require('./components/projection_indicator/education_center/center/educationcenter_index.vue').default,
                children:[
                    { path: '/eccd_center_index',name:'eccd_center_index', component: require('./components/projection_indicator/education_center/center/eccd_center_index.vue').default },
                    { path: '/school_center_index',name:'school_center_index', component: require('./components/projection_indicator/education_center/center/school_center_index.vue').default },
                    { path: '/tertiary_center_index',name:'tertiary_center_index', component: require('./components/projection_indicator/education_center/center/tertiary_center_index.vue').default },
                    { path: '/ecr_center_index',name:'ecr_center_index', component: require('./components/projection_indicator/education_center/center/ecr_center_index.vue').default },
                    { path: '/sen_center_index',name:'sen_center_index', component: require('./components/projection_indicator/education_center/center/sen_center_index.vue').default },
       
                ],
            },
            { path: '/class_Projection_index',component: require('./components/projection_indicator/education_center/classSize/class_index.vue').default,
            children:[
                { path: '/class_size_index',name:'class_size_index', component: require('./components/projection_indicator/education_center/classSize/class_size_index.vue').default },
                { path: '/mssClass_size_index',name:'mssClass_size_index', component: require('./components/projection_indicator/education_center/classSize/mss_classSize_index.vue').default },
                { path: '/hssClass_size_index',name:'hssClass_size_index', component: require('./components/projection_indicator/education_center/classSize/hss_classSize_index.vue').default },
                { path: '/lssClass_size_index',name:'lssClass_size_index', component: require('./components/projection_indicator/education_center/classSize/lss_classSize_index.vue').default },
   
            ],
        },
        ],
    },
 // { path: '/class_Projection_index', name:'class_Projection_index', component: require('./components/projection_indicator/education_center/indicator_byGrowth_index.vue').default },
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
   // { path: '/teacher_Projection_index', name:'teacher_Projection_index', component: require('./components/projection_indicator/teacher_facilitators_index.vue').default },
 
    { path: '/bcsea_projection_index', name:'bcsea_projection_index', component: require('./components/projection_indicator/bcsea/bcsea_index.vue').default },

];
export default routes

