const routes = [
    //Academics Masters Route
    { path: '/academic-master', component: require('./components/masters/academics_masters/academics_master_index.vue').default,
        children:
        [
            { path: '/',name:'academic-master', component: require('./components/masters/academics_masters/academics_master_list.vue').default,},

            // { path: '/national-holiday-master', component: require('./components/masters/academics_masters/national_holiday/national_holiday_index.vue').default,
            //     children: [
            //         { path: '', component: require('./components/masters/academics_masters/national_holiday/list_national_holiday.vue').default },
            //         { path: '/list-national-holiday', name:'list_national_holiday', component: require('./components/masters/academics_masters/national_holiday/list_national_holiday.vue').default },
            //         { path: '/create-national-holiday', name: 'create_national_holiday', component: require('./components/masters/academics_masters/national_holiday/create_national_holidy.vue').default },
            //         { path: '/edit-national-holiday', name: 'edit_national_holiday', component: require('./components/masters/academics_masters/national_holiday/edit_national_holiday.vue').default },
            //     ]
            // },
            { path: '/subject-group-master', component: require('./components/masters/academics_masters/subject_group/subject_group_index.vue').default,
                children: [
                    { path: '', component: require('./components/masters/academics_masters/subject_group/list_subject_group.vue').default },
                    { path: '/list-subject-group', name: 'list_subject_group', component: require('./components/masters/academics_masters/subject_group/list_subject_group.vue').default },
                    { path: '/create-subject-group', name: 'create_subject_group', component: require('./components/masters/academics_masters/subject_group/create_subject_group.vue').default },
                    { path: '/edit-subject-group', name: 'edit_subject_group', component: require('./components/masters/academics_masters/subject_group/edit_subject_group.vue').default },
                ]
            },
            { path: '/subject-master', component: require('./components/masters/academics_masters/subject/subject_index.vue').default,
                children: [
                    { path: '', component: require('./components/masters/academics_masters/subject/list_subject.vue').default },
                    { path: '/list-subject', name: 'list_subject', component: require('./components/masters/academics_masters/subject/list_subject.vue').default },
                    { path: '/create-subject', name: 'aca_create_subject', component: require('./components/masters/academics_masters/subject/create_subject.vue').default },
                    { path: '/edit-subject', name: 'aca_edit_subject', component: require('./components/masters/academics_masters/subject/edit_subject.vue').default },
                ]
            },
            { path: '/assessment-area-master', component: require('./components/masters/academics_masters/assessment_area/assessment_area_index.vue').default,
                children: [
                    { path: '', component: require('./components/masters/academics_masters/assessment_area/list_assessment_area.vue').default },
                    { path: '/list-assessment-area', name: 'aca_list_assessment_area', component: require('./components/masters/academics_masters/assessment_area/list_assessment_area.vue').default },
                    { path: '/create-assessment-area', name: 'aca_create_assessment_area', component: require('./components/masters/academics_masters/assessment_area/create_assessment_area.vue').default },
                    { path: '/edit-assessment-area', name: 'aca_edit_assessment_area', component: require('./components/masters/academics_masters/assessment_area/edit_assessment_area.vue').default },
                ]
            },
            { path: '/subject-assessment-type-master', component: require('./components/masters/academics_masters/subject_assessment_type/subject_assessment_type_index.vue').default,
                children: [
                { path: '', component: require('./components/masters/academics_masters/subject_assessment_type/list_subject_assessment_type.vue').default },
                { path: '/list-subject-assessment-type', name: 'aca_list_subject_assessment_type', component: require('./components/masters/academics_masters/subject_assessment_type/list_subject_assessment_type.vue').default },
                { path: '/edit-subject-assessment-type', name: 'aca_edit_subject_assessment_type', component: require('./components/masters/academics_masters/subject_assessment_type/edit_subject_assessment_type.vue').default },
            ]
            },
            {  path: '/assessment-frequency-master', component: require('./components/masters/academics_masters/assessment_frequency/assessment_frequency_index.vue').default,
                children: [
                { path: '', component: require('./components/masters/academics_masters/assessment_frequency/create_assessment_frequency.vue').default },
                { path: '/create-assessment-frequency', name: 'aca_create_assessment_frequency', component: require('./components/masters/academics_masters/assessment_frequency/create_assessment_frequency.vue').default },
            ]
            },
            { path: '/subject-assessment-area-master', component: require('./components/masters/academics_masters/class_subject_assessment_area/subject_class_subject_assessment_area_index.vue').default,
                children: [
                    { path: '', component: require('./components/masters/academics_masters/class_subject_assessment_area/list_class_subject_assessment_area.vue').default },
                    { path: '/list-subject-assessment-area', name:'list_subject_assessment_area', component: require('./components/masters/academics_masters/class_subject_assessment_area/list_class_subject_assessment_area.vue').default },
                    { path: '/create-subject-assessment-area', name: 'aca_subject_assessment_area', component: require('./components/masters/academics_masters/class_subject_assessment_area/create_class_subject_assessment_area.vue').default },
                ]
            },


        ]
    },
    //Academics Transaction Route
    { path:'/academic', component: require('./components/academics/academics_index.vue').default,
    children: [
        { path: '', name:'academic', component: require('./components/academics/academics_default_page.vue').default},

        { path:'/class-teacher', component:require('./components/academics/class_teacher/class_teacher_index.vue').default,
            children: [
                { path: '', name:'class-teacher', component:require('./components/academics/class_teacher/create_class_teacher.vue').default},
                { path: '/create-class-teacher',name:'create_class_teacher', component:require('./components/academics/class_teacher/create_class_teacher.vue').default},
            ]
        },
        { path:'/subject-teacher', component:require('./components/academics/subject_teacher/subject_teacher_index.vue').default,
            children: [
                { path: '',name:'subject-teacher', component:require('./components/academics/subject_teacher/create_subject_teacher.vue').default},
                { path: '/create-subject-teacher',name:'create_subject_teacher', component:require('./components/academics/subject_teacher/create_subject_teacher.vue').default},
            ]
        },
        { path:'/student-elective-subject', component:require('./components/academics/students_elective_subject/students_elective_subject_index.vue').default,
            children: [
                { path: '', component:require('./components/academics/students_elective_subject/list_students_elective_subject.vue').default},
                { path: '/list-students-elective-subject', name: 'list_students_elective_subject', component: require('./components/academics/students_elective_subject/list_students_elective_subject.vue').default },
                { path: '/edit-student-elective-subject',name:'edit_students_elective_subject', component:require('./components/academics/students_elective_subject/edit_students_elective_subject.vue').default},
            ]
        },
        { path:'/term-result', component:require('./components/academics/term_result/term_result_index.vue').default,
            children: [
                { path: '', component:require('./components/academics/term_result/list_term_result.vue').default},
                { path: '/list-term-result', name: 'list_term_result', component: require('./components/academics/term_result/list_term_result.vue').default },
                { path: '/edit-term-result',name:'edit_term_result', component:require('./components/academics/term_result/edit_term_result.vue').default},
                { path: '/view-term-result',name:'view_term_result', component:require('./components/academics/term_result/view_term_result.vue').default},
            ]
        },
        { path:'/consolidated-result', component:require('./components/academics/consolidated_result/consolidated_result_index.vue').default,
            children: [
                { path: '', component:require('./components/academics/consolidated_result/list_consolidated_result.vue').default},
                { path: '/list-consolidated-result', name: 'list_consolidated_result', component: require('./components/academics/consolidated_result/list_consolidated_result.vue').default },
                { path: '/view-consolidated-result', name: 'view_consolidated_result', component: require('./components/academics/consolidated_result/view_consolidated_result.vue').default },
                { path: '/edit-consolidated-result',name:'edit_consolidated_result', component:require('./components/academics/consolidated_result/edit_consolidated_result.vue').default},
                { path: '/view-detail-consolidated-result', name: 'view_detail_consolidated_result', component: require('./components/academics/consolidated_result/view_detail_consolidated_result.vue').default },

            ]
        },
        { path:'/student-attendance', component:require('./components/academics/student_attendance/student_attendance_index.vue').default,
            children: [
                { path: '', component:require('./components/academics/student_attendance/list_student_attendance.vue').default},
                { path: '/list-student-attendance', name: 'list_student_attendance', component: require('./components/academics/student_attendance/list_student_attendance.vue').default},
                { path: '/create-student-attendance', name: 'create_student_attendance', component: require('./components/academics/student_attendance/create_student_attendance.vue').default },
                { path: '/edit-student-attendance',name:'edit_student_attendance', component:require('./components/academics/student_attendance/edit_student_attendance.vue').default},

            ]
        },


    ]
}




];
export default routes
