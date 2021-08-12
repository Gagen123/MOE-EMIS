const routes = [
   // { path: '/education_center_index', name:'education_center_index', component: require('./components/projection_indicator/education_center_index.vue').default },
    { path: '/education_center_index',
        component: require('./components/projection_indicator/education_center/education_center_index.vue').default,
        children:[
            { path: '/',name:'education_center_index', component: require('./components/projection_indicator/education_center/education_center_guidelines.vue').default },
            { path: '/eccd_center_index',name:'eccd_center_index', component: require('./components/projection_indicator/education_center/eccds/eccd_center_index.vue').default },
            { path: '/school_center_index',name:'school_center_index', component: require('./components/projection_indicator/education_center/eccds/school_center_index.vue').default },
            { path: '/tertiary_center_index',name:'tertiary_center_index', component: require('./components/projection_indicator/education_center/eccds/tertiary_center_index.vue').default },
        ],
    },
    { path: '/student_Projection_index',
        component: require('./components/projection_indicator/student_learners/student_learner_index.vue').default,
        children:[
            { path: '/',name:'student_Projection_index', component: require('./components/projection_indicator/student_learners/student_learner_guidelines.vue').default },
            { path: '/student_index',component: require('./components/projection_indicator/student_learners/student/student_index.vue').default,
                children:[
                    { path: '/eccd_children_index',name:'eccd_children_index', component: require('./components/projection_indicator/student_learners/student/eccd_index.vue').default },
                    { path: '/school_student_index',name:'school_student_index', component: require('./components/projection_indicator/student_learners/student/school_index.vue').default },
                    { path: '/tertiary_learners_index',name:'tertiary_learners_index', component: require('./components/projection_indicator/student_learners/student/tertiary_index.vue').default },
                ],
            },
            { path: '/student_enrolment',component: require('./components/projection_indicator/student_learners/student_enrolment/student_enrolment_index.vue').default,
                children:[
                    { path: '/eccd_children_index',name:'eccd_children_index', component: require('./components/projection_indicator/student_learners/student/eccd_index.vue').default },
                    { path: '/school_student_index',name:'school_student_index', component: require('./components/projection_indicator/student_learners/student/school_index.vue').default },
                    { path: '/tertiary_learners_index',name:'tertiary_learners_index', component: require('./components/projection_indicator/student_learners/student/tertiary_index.vue').default },
                ],
            },
        ],
    },
    //Teacher/Trainer/Facilitator

    { path: '/teacher_Projection_index',
        component: require('./components/projection_indicator/teacher_Facilitator/teacher_facilitator_index.vue').default,
        children:[
            { path: '/',name:'student_Projection_index', component: require('./components/projection_indicator/teacher_Facilitator/teacher_facilitator_guidelines.vue').default },
            { path: '/teacher_index',component: require('./components/projection_indicator/teacher_Facilitator/teacher_index.vue').default,
                children:[
                    { path: '/tertiary_teacher_index',name:'tertiary_teacher_index', component: require('./components/projection_indicator/teacher_Facilitator/teacher/tertiary_index.vue').default },
                    { path: '/school_teacher_index',name:'school_teacher_index', component: require('./components/projection_indicator/teacher_Facilitator/teacher/school_index.vue').default },
                    { path: '/eccd_teacher_index',name:'eccd_ieccd_teacher_indexndex', component: require('./components/projection_indicator/teacher_Facilitator/teacher/eccd_index.vue').default },
                    { path: '/ecr_teacher_index',name:'ecr_teacher_index', component: require('./components/projection_indicator/teacher_Facilitator/teacher/ecr_index.vue').default },
                ],
            },
            { path: '/gender_parity_index',component: require('./components/projection_indicator/teacher_Facilitator/gender_parity_index.vue').default,
                children:[
                    { path: '/tertiary_teacher_gender_index',name:'tertiary_teacher_index', component: require('./components/projection_indicator/teacher_Facilitator/teacher/tertiary_index.vue').default },
                    { path: '/school_teacher_gender_index',name:'school_teacher_index', component: require('./components/projection_indicator/teacher_Facilitator/teacher/school_index.vue').default },
                    { path: '/eccd_teacher_gender_index',name:'eccd_ieccd_teacher_indexndex', component: require('./components/projection_indicator/teacher_Facilitator/teacher/eccd_index.vue').default },
                    { path: '/ecr_teacher_gender_index',name:'ecr_teacher_index', component: require('./components/projection_indicator/teacher_Facilitator/teacher/ecr_index.vue').default },
                ],
            },
            { path: '/recruitment_index',component: require('./components/projection_indicator/teacher_Facilitator/recruitment_index.vue').default,
                children:[
                    { path: '/tertiary_teacher_recur_index',name:'tertiary_teacher_index', component: require('./components/projection_indicator/teacher_Facilitator/teacher/tertiary_index.vue').default },
                    { path: '/school_teacher_recur_index',name:'school_teacher_index', component: require('./components/projection_indicator/teacher_Facilitator/teacher/school_index.vue').default },
                    { path: '/eccd_teacher_recur_index',name:'eccd_ieccd_teacher_indexndex', component: require('./components/projection_indicator/teacher_Facilitator/teacher/eccd_index.vue').default },
                    { path: '/ecr_teacher_recur_index',name:'ecr_teacher_index', component: require('./components/projection_indicator/teacher_Facilitator/teacher/ecr_index.vue').default },
                ],
            },
            
        ],
    },
    { path: '/enrollment_Projection_index', name:'enrollment_Projection_index', component: require('./components/projection_indicator/enrollment_index.vue').default },
    { path: '/enrollment_byAge_index', name:'enrollment_byAge_index', component: require('./components/projection_indicator/enrollment_byAge_index.vue').default },
    { path: '/growth_Projection_index', name:'growth_Projection_index', component: require('./components/projection_indicator/indicator_byGrowth_index.vue').default },
    { path: '/parity_Projection_index', name:'parity_Projection_index', component: require('./components/projection_indicator/gender_parity_index.vue').default },
    { path: '/transition_Projection_index', name:'transition_Projection_index', component: require('./components/projection_indicator/tranisition_rate_index.vue').default },
    { path: '/bcsea_Projection_index', name:'bcsea_Projection_index', component: require('./components/projection_indicator/bcsea_report_index.vue').default },

];
export default routes

