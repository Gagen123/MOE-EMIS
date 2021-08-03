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
            { path: '/rating-master', component: require('./components/masters/spms_masters/rating/rating_index.vue').default,
                children: [
                    { path: '', component: require('./components/masters/spms_masters/rating/list_rating.vue').default },
                    { path: '/list-rating', name: 'list_rating', component: require('./components/masters/spms_masters/rating/list_rating.vue').default },
                    { path: '/create-rating', name: 'create_rating', component: require('./components/masters/spms_masters/rating/create_rating.vue').default },
                    { path: '/edit-rating', name: 'edit_rating', component: require('./components/masters/spms_masters/rating/edit_rating.vue').default },
                ]
            },
            { path: '/dzo-emo-master', component: require('./components/masters/spms_masters/dzongkhag_emo_mapping/dzongkhag_emo_mapping_index.vue').default,
                children: [
                    { path: '', component: require('./components/masters/spms_masters/dzongkhag_emo_mapping/create_dzongkhag_emo_mapping.vue').default },
                    { path: '/create-dzo-emo', name: 'create_dzo_emo', component: require('./components/masters/spms_masters/dzongkhag_emo_mapping/create_dzongkhag_emo_mapping.vue').default },
                ]
            },
            { path: '/school-deo-master', component: require('./components/masters/spms_masters/school_deo_mapping/school_deo_mapping_index.vue').default,
                children: [
                    { path: '', component: require('./components/masters/spms_masters/school_deo_mapping/create_school_deo_mapping.vue').default },
                    { path: '/create-school-deo', name: 'create_school_deo', component: require('./components/masters/spms_masters/school_deo_mapping/create_school_deo_mapping.vue').default },
                ]
            },
    
            

        ]
    },
 




];
export default routes
