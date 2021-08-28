const routes = [
    //spms Masters Route
    { path: '/spms-master', component: require('./components/masters/spms_masters/spms_master_index.vue').default,
        children:
        [
            { path: '/',name:'spms-master', component: require('./components/masters/spms_masters/spms_master_list.vue').default},

            { path: '/domain-master', component: require('./components/masters/spms_masters/domain/domain_index.vue').default,
                children: [
                    { path: '', component: require('./components/masters/spms_masters/domain/list_domain.vue').default },
                    { path: '/list-domain', name: 'list_domain', component: require('./components/masters/spms_masters/domain/list_domain.vue').default },
                    { path: '/create-domain', name: 'create_domain', component: require('./components/masters/spms_masters/domain/create_domain.vue').default },
                    { path: '/edit-domain', name: 'edit_domain', component: require('./components/masters/spms_masters/domain/edit_domain.vue').default },
                ]
            },
            { path: '/area-master', component: require('./components/masters/spms_masters/area/area_index.vue').default,
                children: [
                    { path: '', component: require('./components/masters/spms_masters/area/list_area.vue').default },
                    { path: '/list-area', name: 'list_area', component: require('./components/masters/spms_masters/area/list_area.vue').default },
                    { path: '/create-area', name: 'create_area', component: require('./components/masters/spms_masters/area/create_area.vue').default },
                    { path: '/edit-area', name: 'edit_area', component: require('./components/masters/spms_masters/area/edit_area.vue').default },
                ]
            },

            { path: '/parameter-master', component: require('./components/masters/spms_masters/parameter/parameter_index.vue').default,
                children: [
                    { path: '', component: require('./components/masters/spms_masters/parameter/list_parameter.vue').default },
                    { path: '/list-parameter', name: 'list_parameter', component: require('./components/masters/spms_masters/parameter/list_parameter.vue').default },
                    { path: '/create-parameter', name: 'create_parameter', component: require('./components/masters/spms_masters/parameter/create_parameter.vue').default },
                    { path: '/edit-parameter', name: 'edit_parameter', component: require('./components/masters/spms_masters/parameter/edit_parameter.vue').default },
                ]
            },
            { path: '/indicator-master', component: require('./components/masters/spms_masters/indicator/indicator_index.vue').default,
                children: [
                    { path: '', component: require('./components/masters/spms_masters/indicator/list_indicator.vue').default },
                    { path: '/list-indicator', name: 'list_indicator', component: require('./components/masters/spms_masters/indicator/list_indicator.vue').default },
                    { path: '/create-indicator', name: 'create_indicator', component: require('./components/masters/spms_masters/indicator/create_indicator.vue').default },
                    { path: '/edit-indicator', name: 'edit_indicator', component: require('./components/masters/spms_masters/indicator/edit_indicator.vue').default },
                ]
            },
            { path: '/rubrics-master', component: require('./components/masters/spms_masters/rubrics/rubrics_index.vue').default,
                children: [
                    { path: '', component: require('./components/masters/spms_masters/rubrics/list_rubrics.vue').default },
                    { path: '/list-rubrics', name: 'list_rubrics', component: require('./components/masters/spms_masters/rubrics/list_rubrics.vue').default },
                    { path: '/create-rubrics', name: 'create_rubrics', component: require('./components/masters/spms_masters/rubrics/create_rubrics.vue').default },
                    { path: '/edit-rubrics', name: 'edit_rubrics', component: require('./components/masters/spms_masters/rubrics/edit_rubrics.vue').default },
                ]
            },
            { path: '/dzo-emo-master', component: require('./components/masters/spms_masters/dzongkhag_emo_mapping/dzongkhag_emo_mapping_index.vue').default,
                children: [
                    { path: '', component: require('./components/masters/spms_masters/dzongkhag_emo_mapping/create_dzongkhag_emo_mapping.vue').default },
                    { path: '/create-dzo-emo', name: 'create_dzo_emo', component: require('./components/masters/spms_masters/dzongkhag_emo_mapping/create_dzongkhag_emo_mapping.vue').default },
                ]
            },
        ]
    },
      //spms Transaction Route
      { path: '/spms', component: require('./components/spms/spms_index.vue').default,
      children:
      [
            { path: '/',name:'spms', component: require('./components/spms/spms_list.vue').default},

            { path: '/school-performance', component: require('./components/spms/school_performance/school_performance_index.vue').default,
                children: [
                    { path: '', component: require('./components/spms/school_performance/school_performance_dashboard.vue').default },
                    { path: '/school-performance-dashboard',name:'school_performance_dashboard', component: require('./components/spms/school_performance/school_performance_dashboard.vue').default },
                    { path: '/list-school-performance', name: 'list_school_performance', component: require('./components/spms/school_performance/list_school_performance.vue').default },
                    { path: '/view-school-performance', name: 'view_school_performance', component: require('./components/spms/school_performance/view_school_performance.vue').default },
                    { path: '/create-school-performance', name: 'create_school_performance', component: require('./components/spms/school_performance/create_school_performance.vue').default },
                    { path: '/edit-school-performance', name: 'edit_school_performance', component: require('./components/spms/school_performance/edit_school_performance.vue').default },
                ]
                
            },
            { path: '/school-performance-academic', component: require('./components/spms/school_performance_academic/school_performance_academic_index.vue').default,
                children: [
                    { path: '', component: require('./components/spms/school_performance_academic/school_performance_academic.vue').default },
                    { path: '/school-performance-academic',name:'school_performance_academic', component: require('./components/spms/school_performance_academic/school_performance_academic.vue').default },
                ]
            },
            { path: '/annual-school-plan', component: require('./components/spms/school_plan/school_plan_index.vue').default,
                children: [
                    { path: '', component: require('./components/spms/school_plan/container.vue').default },
                    { path: '/lists-annual-school-plan',name:'lists_annual_school_plan', component: require('./components/spms/school_plan/container.vue').default },
                    { path: '/list-annual-school-plan',name:'list_annual_school_plan', component: require('./components/spms/school_plan/list_school_plan.vue').default },
                    { path: '/view-annual-school-plan', name: 'view_annual_school_plan', component: require('./components/spms/school_plan/view_school_plan.vue').default },
                    { path: '/create-annual-school-plan', name:'create_annual_school_plan', component: require('./components/spms/school_plan/create_school_plan.vue').default },
                    { path: '/annual-school-plan-list',name:'annual_school_plan_list', component: require('./components/spms/school_plan/deo_emo_list_school_plan.vue').default },
                    { path: '/edit-annual-school-plan', name: 'edit_annual_school_plan', component: require('./components/spms/school_plan/edit_school_plan.vue').default },
                ]
            },
            { path: '/agency-input-form', component: require('./components/spms/agency_input_form/agency_input_form_index.vue').default,
                children: [
                    { path: '', component: require('./components/spms/agency_input_form/list_agency_input_form.vue').default },
                    { path: '/list-agency-input-form',name:'list_agency_input_form', component: require('./components/spms/agency_input_form/list_agency_input_form.vue').default },
                    { path: '/create-agency-input-form', name: 'create_agency_input_form', component: require('./components/spms/agency_input_form/create_agency_input_form.vue').default },
                    { path: '/edit-agency-input-form', name: 'edit_agency_input_form', component: require('./components/spms/agency_input_form/edit_agency_input_form.vue').default },
                    { path: '/create_observation-agency-input-form', name:'create_observation_agency_input_form', component: require('./components/spms/agency_input_form/create_observation_agency_input_form.vue').default },
                    { path: '/edit_observation-agency-input-form', name:'edit_observation_agency_input_form', component: require('./components/spms/agency_input_form/edit_observation_agency_input_form.vue').default },
                    { path: '/create-action-agency-input-form',name:'create_action_agency_input_form', component: require('./components/spms/agency_input_form/create_action_agency_input_form.vue').default },
                    { path: '/edit-action-agency-input-form',name:'edit_action_agency_input_form', component: require('./components/spms/agency_input_form/edit_action_agency_input_form.vue').default },
                    { path: '/create-acknowledgement-agency-input-form', name: 'create_acknowledgement_agency_input_form', component: require('./components/spms/agency_input_form/create_acknowledgement_agency_input_form.vue').default },
                    { path: '/view-agency-input-form', name: 'view_agency_input_form', component: require('./components/spms/agency_input_form/view_agency_input_form.vue').default },
                ]
            },
      ]
  },





];
export default routes
