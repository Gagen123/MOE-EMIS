const routes = [
    { path: '/establishment_index', component: require('./components/organization/establishment/establishment_index.vue').default,
        children:[
            { path: '/',name:"establishment_index", component: require('./components/organization/establishment/estblishment_guide.vue').default },

            { path: '/eccd_approval_index',
            component: require('./components/organization/establishment/eccd/eccd_index.vue').default,
            children: [
                    { path: '/', name:'eccd_approval_index', component: require('./components/organization/establishment/eccd/list_eccd.vue').default },
                    { path: '/create_eccd',name:"create_eccd", component: require('./components/organization/establishment/eccd/create_eccd.vue').default },

                    { path: '/list_eccd', name:'list_eccd', component: require('./components/organization/establishment/eccd/list_eccd.vue').default },
                    { path: '/show_eccd',  name:'show_eccd',component: require('./components/organization/establishment/eccd/show_eccd.vue').default },
                    { path: '/acknowledgement_eccd',  name:'acknowledgement_eccd',component: require('./components/organization/establishment/eccd/acknowledgement.vue').default },
                ]
            },

            { path: '/public_school_index',
            component: require('./components/organization/establishment/public_school/public_school_index.vue').default,
            children: [
                    { path: '/', name:'public_school_index', component: require('./components/organization/establishment/public_school/list_public_school.vue').default },
                    { path: '/list_public_school', name:'list_public_school', component: require('./components/organization/establishment/public_school/list_public_school.vue').default },
                    { path: '/create_public_school',name:"create_public_school", component: require('./components/organization/establishment/public_school/create_public_school.vue').default },
                    { path: '/edit_public_school',  name:'edit_public_school',component: require('./components/organization/establishment/public_school/edit_school_details.vue').default },
                    { path: '/acknowledgement_public_school',  name:'acknowledgement_public_school',component: require('./components/organization/establishment/public_school/acknowledgement.vue').default },
                    { path: '/show_public_school',  name:'show_public_school',component: require('./components/organization/establishment/public_school/show_public_school.vue').default },
                ]
            },

            { path: '/private_school_index',
            component: require('./components/organization/establishment/private_school/private_school_index.vue').default,
            children: [
                    { path: '/', name:'private_school_index', component: require('./components/organization/establishment/private_school/list_private_school.vue').default },
                    { path: '/list_private_school', name:'list_private_school', component: require('./components/organization/establishment/private_school/list_private_school.vue').default },
                    { path: '/create_private_school',name:"create_private_school", component: require('./components/organization/establishment/private_school/create_private_school.vue').default },
                    { path: '/edit_private_school',  name:'edit_private_school',component: require('./components/organization/establishment/private_school/edit_private_school.vue').default },
                    { path: '/acknowledgement_private_school',  name:'acknowledgement_private_school',component: require('./components/organization/establishment/private_school/acknowledgement.vue').default },
                    { path: '/show_private_school',  name:'show_private_school',component: require('./components/organization/establishment/private_school/show_private_school.vue').default },
                ]
            },

            { path: '/ecr_index',
                component: require('./components/organization/establishment/ecr/ecr_index.vue').default,
                children: [
                    { path: '/', name:'ecr_index', component: require('./components/organization/establishment/ecr/list_ecr.vue').default },
                    { path: '/list_ecr', name:'list_ecr', component: require('./components/organization/establishment/ecr/list_ecr.vue').default },
                    { path: '/create_ecr',name:"create_ecr", component: require('./components/organization/establishment/ecr/create_ecr.vue').default },
                    { path: '/edit_ecr',  name:'edit_ecr',component: require('./components/organization/establishment/ecr/edit_ecr.vue').default },
                    { path: '/acknowledgement_ecr',  name:'acknowledgement_ecr',component: require('./components/organization/establishment/ecr/acknowledgement.vue').default },
                    { path: '/show_ecr',  name:'show_ecr',component: require('./components/organization/establishment/ecr/show_ecr.vue').default },
                ]
            },
            { path: '/register',
                component: require('./components/organization/establishment/register/register_index.vue').default ,
                children: [
                    { path: '/',name:'register', component: require('./components/organization/establishment/register/register_list.vue').default },
                    { path: '/list_register',name:'list_register', component: require('./components/organization/establishment/register/register_list.vue').default },
                    { path: '/create_register',name:'create_register', component: require('./components/organization/establishment/register/register.vue').default },
                    { path: '/edit_register',name:'edit_register', component: require('./components/organization/establishment/register/edit_register.vue').default },
                ]
            },
            { path: '/headquaters_index',
                component: require('./components/organization/establishment/headquarters/headquarters_index.vue').default ,
                children: [
                    { path: '/', name:'headquaters_index', component: require('./components/organization/establishment/headquarters/list_headquarters.vue').default },
                    { path: '/list_headquaters',  name:'list_headquaters', component: require('./components/organization/establishment/headquarters/list_headquarters.vue').default },
                    { path: '/create_headquaters',name:'create_headquaters', component: require('./components/organization/establishment/headquarters/create_headquaters.vue').default },
                    { path: '/edit_headquaters',name:'edit_headquaters', component: require('./components/organization/establishment/headquarters/edit_headquarters.vue').default },
                    { path: '/acknowledgement_headquarters',  name:'acknowledgement_headquarters',component: require('./components/organization/establishment/headquarters/acknowledgement.vue').default },
                ]
            },

            { path: '/establishment_acknowledgement', name:'establishment_acknowledgement', component: require('./components/organization/establishment/acknowledgement.vue').default },
        ]
    },

    //change routes
    { path: '/restructuring_index', component: require('./components/organization/restructuring/restructuring_index.vue').default,
        children:[
            { path: '/restructuring_index',name:"restructuring_index", component: require('./components/organization/restructuring/restructuring_index_list.vue').default },
            { path: '/location_change_index',
                component: require('./components/organization/restructuring/location_change/location_change_index.vue').default ,
                children: [
                    { path: '/',name:'location_change_index', component: require('./components/organization/restructuring/location_change/list_location_change.vue').default },
                    { path: '/list_location_change',name:'list_location_change', component: require('./components/organization/restructuring/location_change/list_location_change.vue').default },
                    { path: '/create_location_change',name:'create_location_change', component: require('./components/organization/restructuring/location_change/create_location_change.vue').default },
                    { path: '/edit_location_change',name:'edit_location_change', component: require('./components/organization/restructuring/location_change/edit_location_change.vue').default },
                    { path: '/view_location_change',name:'view_location_change', component: require('./components/organization/restructuring/location_change/view_location_change.vue').default },
                    { path: '/location_change_acknowledgement', name:'location_change_acknowledgement', component: require('./components/organization/restructuring/location_change/acknowledgement.vue').default },
                ]
            },

            { path: '/name_change_index',
            component: require('./components/organization/restructuring/name_change/name_change_index.vue').default ,
                children: [
                { path: '/',name:'name_change_index', component: require('./components/organization/restructuring/name_change/list_name_change.vue').default },
                { path: '/list_name_change',name:'list_name_change', component: require('./components/organization/restructuring/name_change/list_name_change.vue').default },
                { path: '/create_name_change',name:'create_name_change', component: require('./components/organization/restructuring/name_change/create_name_change.vue').default },
                { path: '/edit_name_change',name:'edit_name_change', component: require('./components/organization/restructuring/name_change/edit_name_change.vue').default },
                { path: '/view_name_change',name:'view_name_change', component: require('./components/organization/restructuring/name_change/view_name_change.vue').default },
                { path: '/name_change_acknowledgement', name:'name_change_acknowledgement', component: require('./components/organization/restructuring/name_change/acknowledgement.vue').default },
                ]
            },

            { path: '/level_change_index',
            component: require('./components/organization/restructuring/level_change/level_change_index.vue').default ,
                children: [
                { path: '/',name:'level_change_index', component: require('./components/organization/restructuring/level_change/list_level_change.vue').default },
                { path: '/list_level_change',name:'list_level_change', component: require('./components/organization/restructuring/level_change/list_level_change.vue').default },
                { path: '/create_level_change',name:'create_level_change', component: require('./components/organization/restructuring/level_change/create_level_change.vue').default },
                { path: '/edit_level_change',name:'edit_level_change', component: require('./components/organization/restructuring/level_change/edit_level_change.vue').default },
                { path: '/view_level_change',name:'view_level_change', component: require('./components/organization/restructuring/level_change/view_level_change.vue').default },
                { path: '/level_change_acknowledgement', name:'level_change_acknowledgement', component: require('./components/organization/restructuring/level_change/acknowledgement.vue').default },
                ]
            },
            { path: '/upgrade_index',
            component: require('./components/organization/restructuring/upgrade/upgrade_index.vue').default ,
                children: [
                { path: '/',name:'upgrade_index', component: require('./components/organization/restructuring/upgrade/list_upgrade.vue').default },
                { path: '/list_upgrade',name:'list_upgrade', component: require('./components/organization/restructuring/upgrade/list_upgrade.vue').default },
                { path: '/create_upgrade',name:'create_upgrade', component: require('./components/organization/restructuring/upgrade/create_upgrade.vue').default },
                { path: '/edit_upgrade',name:'edit_upgrade', component: require('./components/organization/restructuring/upgrade/edit_upgrade.vue').default },
                { path: '/view_upgrade',name:'view_upgrade', component: require('./components/organization/restructuring/upgrade/view_upgrade.vue').default },
                { path: '/upgrade_acknowledgement', name:'upgrade_acknowledgement', component: require('./components/organization/restructuring/upgrade/acknowledgement.vue').default },
                ]
            },
            { path: '/sen_details_index',
            component: require('./components/organization/restructuring/sen_change/sen_change_index.vue').default ,
                children: [
                { path: '/',name:'sen_details_index', component: require('./components/organization/restructuring/sen_change/list_sen_change.vue').default },
                { path: '/list_sen_change',name:'list_sen_change', component: require('./components/organization/restructuring/sen_change/list_sen_change.vue').default },
                { path: '/create_sen_change',name:'create_sen_change', component: require('./components/organization/restructuring/sen_change/create_sen_change.vue').default },
                { path: '/edit_sen_change',name:'edit_sen_change', component: require('./components/organization/restructuring/sen_change/edit_sen_change.vue').default },
                { path: '/view_sen_change',name:'view_sen_change', component: require('./components/organization/restructuring/sen_change/view_sen_change.vue').default },
                { path: '/sen_change_acknowledgement', name:'sen_change_acknowledgement', component: require('./components/organization/restructuring/sen_change/acknowledgement.vue').default },
                ]
            },
            { path: '/feeding_details_index',
            component: require('./components/organization/restructuring/feeding_change/feeding_change_index.vue').default ,
                children: [
                { path: '/',name:'feeding_details_index', component: require('./components/organization/restructuring/feeding_change/list_feeding_change.vue').default },
                { path: '/list_feeding_change',name:'list_feeding_change', component: require('./components/organization/restructuring/feeding_change/list_feeding_change.vue').default },
                { path: '/create_feeding_change',name:'create_feeding_change', component: require('./components/organization/restructuring/feeding_change/create_feeding_change.vue').default },
                { path: '/edit_feeding_change',name:'edit_feeding_change', component: require('./components/organization/restructuring/feeding_change/edit_feeding_change.vue').default },
                { path: '/view_feeding_change',name:'view_feeding_change', component: require('./components/organization/restructuring/feeding_change/view_feeding_change.vue').default },
                { path: '/feeding_change_acknowledgement', name:'feeding_change_acknowledgement', component: require('./components/organization/restructuring/feeding_change/acknowledgement.vue').default },
                ]
            },
            { path: '/proprietor_details_index',
            component: require('./components/organization/restructuring/proprietor_change/proprietor_change_index.vue').default ,
                children: [
                { path: '/',name:'proprietor_details_index', component: require('./components/organization/restructuring/proprietor_change/list_proprietor_change.vue').default },
                { path: '/list_proprietor_change',name:'list_proprietor_change', component: require('./components/organization/restructuring/proprietor_change/list_proprietor_change.vue').default },
                { path: '/create_proprietor_change',name:'create_proprietor_change', component: require('./components/organization/restructuring/proprietor_change/create_proprietor_change.vue').default },
                { path: '/edit_proprietor_change',name:'edit_proprietor_change', component: require('./components/organization/restructuring/proprietor_change/edit_proprietor_change.vue').default },
                { path: '/view_proprietor_change',name:'view_proprietor_change', component: require('./components/organization/restructuring/proprietor_change/view_proprietor_change.vue').default },
                { path: '/proprietor_change_acknowledgement', name:'proprietor_change_acknowledgement', component: require('./components/organization/restructuring/proprietor_change/acknowledgement.vue').default },
                ]
            },


            { path: '/fee_structure_change_index',
            component: require('./components/organization/restructuring/fee_structure/fee_structure_index.vue').default ,
                children: [
                { path: '/',name:'fee_structure_change_index', component: require('./components/organization/restructuring/fee_structure/list_fee_structure.vue').default },
                { path: '/list_fee_structure',name:'list_fee_structure', component: require('./components/organization/restructuring/fee_structure/list_fee_structure.vue').default },
                { path: '/create_fee_structure',name:'create_fee_structure', component: require('./components/organization/restructuring/fee_structure/create_fee_structure.vue').default },
                { path: '/edit_fee_structure',name:'edit_fee_structure', component: require('./components/organization/restructuring/fee_structure/edit_fee_structure.vue').default },
                { path: '/view_fee_structure',name:'view_fee_structure', component: require('./components/organization/restructuring/fee_structure/view_fee_structure.vue').default },
                { path: '/fee_structure_acknowledgement', name:'fee_structure_acknowledgement', component: require('./components/organization/restructuring/fee_structure/acknowledgement.vue').default },
                ]
            },
            { path: '/bording_change_index',
            component: require('./components/organization/restructuring/boarding/boarding_index.vue').default ,
                children: [
                { path: '/',name:'bording_change_index', component: require('./components/organization/restructuring/boarding/list_boarding.vue').default },
                { path: '/list_boarding',name:'list_boarding', component: require('./components/organization/restructuring/boarding/list_boarding.vue').default },
                { path: '/create_boarding',name:'create_boarding', component: require('./components/organization/restructuring/boarding/create_boarding.vue').default },
                { path: '/edit_boarding',name:'edit_boarding', component: require('./components/organization/restructuring/boarding/edit_boarding.vue').default },
                { path: '/view_boarding',name:'view_boarding', component: require('./components/organization/restructuring/boarding/view_boarding.vue').default },
                { path: '/boarding_acknowledgement', name:'boarding_acknowledgement', component: require('./components/organization/restructuring/boarding/acknowledgement.vue').default },
                ]
            },

            { path: '/expension_index',
            component: require('./components/organization/restructuring/expension/expension_index.vue').default ,
                children: [
                { path: '/',name:'expension_index', component: require('./components/organization/restructuring/expension/list_expension.vue').default },
                { path: '/list_expension',name:'list_expension', component: require('./components/organization/restructuring/expension/list_expension.vue').default },
                { path: '/create_expension',name:'create_expension', component: require('./components/organization/restructuring/expension/create_expension.vue').default },
                { path: '/edit_expension',name:'edit_expension', component: require('./components/organization/restructuring/expension/edit_expension.vue').default },
                { path: '/view_expension',name:'view_expension', component: require('./components/organization/restructuring/expension/view_expension.vue').default },
                { path: '/expension_acknowledgement', name:'expension_acknowledgement', component: require('./components/organization/restructuring/expension/acknowledgement.vue').default },
                ]
            },

            { path: '/autonomus_index',
            component: require('./components/organization/restructuring/autonomous/autonomous_index.vue').default ,
                children: [
                { path: '/',name:'autonomus_index', component: require('./components/organization/restructuring/autonomous/list_autonomous.vue').default },
                { path: '/list_autonomous',name:'list_autonomous', component: require('./components/organization/restructuring/autonomous/list_autonomous.vue').default },
                { path: '/create_autonomous',name:'create_autonomous', component: require('./components/organization/restructuring/autonomous/create_autonomous.vue').default },
                { path: '/edit_autonomous',name:'edit_autonomous', component: require('./components/organization/restructuring/autonomous/edit_autonomous.vue').default },
                { path: '/view_autonomous',name:'view_autonomous', component: require('./components/organization/restructuring/autonomous/show_autonomous.vue').default },
                { path: '/autonomous_acknowledgement', name:'autonomous_acknowledgement', component: require('./components/organization/restructuring/autonomous/acknowledgement.vue').default },
                ]
            },

            { path: '/stream_change_index',
            component: require('./components/organization/restructuring/stream_change/stream_change_index.vue').default ,
                children: [
                { path: '/',name:'stream_change_index', component: require('./components/organization/restructuring/stream_change/list_stream_change.vue').default },
                { path: '/list_stream_change',name:'list_stream_change', component: require('./components/organization/restructuring/stream_change/list_stream_change.vue').default },
                { path: '/create_stream_change',name:'create_stream_change', component: require('./components/organization/restructuring/stream_change/create_stream_change.vue').default },
                { path: '/edit_stream_change',name:'edit_stream_change', component: require('./components/organization/restructuring/stream_change/edit_stream_change.vue').default },
                { path: '/view_stream_change',name:'view_stream_change', component: require('./components/organization/restructuring/stream_change/view_stream_change.vue').default },
                { path: '/stream_change_acknowledgement', name:'stream_change_acknowledgement', component: require('./components/organization/restructuring/stream_change/acknowledgement.vue').default },
                ]
            },

            { path: '/bifurcation_index',
            component: require('./components/organization/restructuring/bifurcation/bifurcation_index.vue').default ,
                children: [
                { path: '/',name:'bifurcation_index', component: require('./components/organization/restructuring/bifurcation/list_bifurcation.vue').default },
                { path: '/list_bifurcation',name:'list_bifurcation', component: require('./components/organization/restructuring/bifurcation/list_bifurcation.vue').default },
                { path: '/create_bifurcation',name:'create_bifurcation', component: require('./components/organization/restructuring/bifurcation/create_bifurcation.vue').default },
                { path: '/edit_bifurcation',name:'edit_bifurcation', component: require('./components/organization/restructuring/bifurcation/edit_bifurcation.vue').default },
                { path: '/show_bifurcation',name:'show_bifurcation', component: require('./components/organization/restructuring/bifurcation/show_bifurcation.vue').default },
                { path: '/bifurcation_acknowledgement', name:'bifurcation_acknowledgement', component: require('./components/organization/restructuring/bifurcation/acknowledgement.vue').default },
                ]
            },

            { path: '/merger_index',
                component: require('./components/organization/restructuring/merger/merger_index.vue').default ,
                children: [
                    { path: '/',name:'merger_index', component: require('./components/organization/restructuring/merger/merger_list.vue').default },
                    { path: '/merger_list',name:'merger_list', component: require('./components/organization/restructuring/merger/merger_list.vue').default },
                    { path: '/merger', name:'merger', component: require('./components/organization/restructuring/merger/merger.vue').default },
                ]
            },
            { path: '/restr_acknowledgement', name:'restr_acknowledgement', component: require('./components/organization/restructuring/acknowledgement.vue').default },
            { path: '/closure_index',
                component: require('./components/organization/restructuring/closure/closure_index.vue').default ,
                children: [
                { path: '/',name:'closure_index', component: require('./components/organization/restructuring/closure/closure_list.vue').default },
                { path: '/closure_list',name:'closure_list', component: require('./components/organization/restructuring/closure/closure_list.vue').default },
                { path: '/closure', name:'closure', component: require('./components/organization/restructuring/closure/closure.vue').default },
                { path: '/closure_acknowledgement', name:'closure_acknowledgement', component: require('./components/organization/restructuring/closure/acknowledgement.vue').default },
                ]
            },
            { path: '/reopening_index',
                component: require('./components/organization/restructuring/reopening_public/reopening_index.vue').default ,
                children: [
                { path: '/',name:'reopening_index', component: require('./components/organization/restructuring/reopening_public/reopening_list.vue').default },
                { path: '/reopening_add',name:'reopening_add', component: require('./components/organization/restructuring/reopening_public/reopening_add.vue').default },
                { path: '/reopening_list', name:'reopening_list', component: require('./components/organization/restructuring/reopening_public/reopening_list.vue').default },
                { path: '/reopening_acknowledgement', name:'reopening_acknowledgement', component: require('./components/organization/restructuring/reopening_public/acknowledgement.vue').default },
                ]
            },
        ]
    },

    { path: '/eccd_verification',  name:'eccd_verification',component: require('./components/organization/establishment/eccd/eccd_verification.vue').default },
    { path: '/location_change_verification',  name:'location_change_verification',component: require('./components/organization/restructuring/location_change/location_change_verification.vue').default },
];
export default routes
