const routes = [  
    { path: '/OrganizationMasterIndex',name:'OrganizationMasterIndex', component: require('./components/masters/organization_masters/OrganizationMasterIndex.vue').default,
        children:[
            { path: '/location_index', 
                component: require('./components/masters/organization_masters/location/location_index.vue').default ,
                children: 
                [
                    { path: '',name:'location_index', component: require('./components/masters/organization_masters/location/location_list.vue').default },
                    { path: '/location_add', name:'LocationAdd', component: require('./components/masters/organization_masters/location/location_add.vue').default },
                    { path: '/location_edit', name:'LocationEdit', component: require('./components/masters/organization_masters/location/location_edit.vue').default },
                    { path: '/location_list', name:'LocationList', component: require('./components/masters/organization_masters/location/location_list.vue').default },
                ]    
            },
            { path: '/disaster_index', 
                component: require('./components/masters/organization_masters/disaster/disaster_index.vue').default ,
                children: 
                [
                    { path: '',name:'disaster_index', component: require('./components/masters/organization_masters/disaster/disaster_list.vue').default },
                    { path: '/disaster_add', name:'DisasterAdd', component: require('./components/masters/organization_masters/disaster/disaster_add.vue').default },
                    { path: '/disaster_edit', name:'DisasterEdit', component: require('./components/masters/organization_masters/disaster/disaster_edit.vue').default },
                    { path: '/disaster_list', name:'DisasterList', component: require('./components/masters/organization_masters/disaster/disaster_list.vue').default },
                ]    
            },
            { path: '/level_index', 
                component: require('./components/masters/organization_masters/level/level_index.vue').default ,
                children: 
                [
                    { path: '',name:'level_index', component: require('./components/masters/organization_masters/level/level_list.vue').default },
                    { path: '/level_add', name:'LevelAdd', component: require('./components/masters/organization_masters/level/level_add.vue').default },
                    { path: '/level_edit', name:'LevelEdit', component: require('./components/masters/organization_masters/level/level_edit.vue').default },
                    { path: '/level_list', name:'LevelList', component: require('./components/masters/organization_masters/level/level_list.vue').default },
                ]    
            },
            { path: '/structure_category_index', 
                component: require('./components/masters/organization_masters/structure_category/structure_category_index.vue').default ,
                children: 
                [
                    { path: '',name:'structure_category_index', component: require('./components/masters/organization_masters/structure_category/structure_category_list.vue').default },
                    { path: '/structure_category_add', name:'StructureCategoryAdd', component: require('./components/masters/organization_masters/structure_category/structure_category_add.vue').default },
                    { path: '/structure_category_edit', name:'StructureCategoryEdit', component: require('./components/masters/organization_masters/structure_category/structure_category_edit.vue').default },
                    { path: '/structure_category_list', name:'StructureCategoryList', component: require('./components/masters/organization_masters/structure_category/structure_category_list.vue').default },
                ]    
            },
            { path: '/structure_facility_index', 
                component: require('./components/masters/organization_masters/structure_facility/structure_facility_index.vue').default ,
                children:
                [
                    { path: '',name:'structure_facility_index', component: require('./components/masters/organization_masters/structure_facility/structure_facility_list.vue').default },
                    { path: '/structure_facility_add', name:'StructureFacilityAdd', component: require('./components/masters/organization_masters/structure_facility/structure_facility_add.vue').default },
                    { path: '/structure_facility_edit', name:'StructureFacilityEdit', component: require('./components/masters/organization_masters/structure_facility/structure_facility_edit.vue').default },
                    { path: '/structure_facility_list', name:'StructureFacilityList', component: require('./components/masters/organization_masters/structure_facility/structure_facility_list.vue').default },
                ]    
            },
    
            { path: '/equipment_type_index', 
                component: require('./components/masters/organization_masters/equipment_type/equipment_type_index.vue').default ,
                children:
                [
                    { path: '',name:'equipment_type_index', component: require('./components/masters/organization_masters/equipment_type/equipment_type_list.vue').default },
                    { path: '/equipment_type_add', name:'EquipmentTypeAdd', component: require('./components/masters/organization_masters/equipment_type/equipment_type_add.vue').default },
                    { path: '/equipment_type_edit', name:'EquipmentTypeEdit', component: require('./components/masters/organization_masters/equipment_type/equipment_type_edit.vue').default },
                    { path: '/equipment_type_list', name:'EquipmentTypeList', component: require('./components/masters/organization_masters/equipment_type/equipment_type_list.vue').default },
                ]    
            },
            { path: '/equipment_usage_index', 
                component: require('./components/masters/organization_masters/equipment_usage/equipment_usage_index.vue').default ,
                children: 
                [
                    { path: '',name:'equipment_usage_index', component: require('./components/masters/organization_masters/equipment_usage/equipment_usage_list.vue').default },
                    { path: '/equipment_usage_add', name:'EquipmentUsageAdd', component: require('./components/masters/organization_masters/equipment_usage/equipment_usage_add.vue').default },
                    { path: '/equipment_usage_edit', name:'EquipmentUsageEdit', component: require('./components/masters/organization_masters/equipment_usage/equipment_usage_edit.vue').default },
                    { path: '/equipment_usage_list', name:'EquipmentUsageList', component: require('./components/masters/organization_masters/equipment_usage/equipment_usage_list.vue').default },
                ]    
            },
  
            { path: '/sport_facility_index', 
                component: require('./components/masters/organization_masters/sport_facility/sport_facility_index.vue').default ,
                children: 
                [
                    { path: '',name:'sport_facility_index', component: require('./components/masters/organization_masters/sport_facility/sport_facility_list.vue').default },
                    { path: '/sport_facility_add', name:'SportFacilityAdd', component: require('./components/masters/organization_masters/sport_facility/sport_facility_add.vue').default },
                    { path: '/sport_facility_edit', name:'SportFacilityEdit', component: require('./components/masters/organization_masters/sport_facility/sport_facility_edit.vue').default },
                    { path: '/sport_facility_list', name:'SportFacilityList', component: require('./components/masters/organization_masters/sport_facility/sport_facility_list.vue').default },
                ]    
            },
            { path: '/sport_facility_subtype_index', 
                component: require('./components/masters/organization_masters/sport_facility_subtype/sport_facility_subtype_index.vue').default ,
                children: 
                [
                    { path: '',name:'sport_facility_subtype_index', component: require('./components/masters/organization_masters/sport_facility_subtype/sport_facility_subtype_list.vue').default },
                    { path: '/sport_facility_subtype_add', name:'SportFacilitySubtypeAdd', component: require('./components/masters/organization_masters/sport_facility_subtype/sport_facility_subtype_add.vue').default },
                    { path: '/sport_facility_subtype_edit', name:'SportFacilitySubtypeEdit', component: require('./components/masters/organization_masters/sport_facility_subtype/sport_facility_subtype_edit.vue').default },
                    { path: '/sport_facility_subtype_list', name:'SportFacilitySubtypeList', component: require('./components/masters/organization_masters/sport_facility_subtype/sport_facility_subtype_list.vue').default },
                        
                ]    
            },
            { path: '/sport_supporter_index', 
                component: require('./components/masters/organization_masters/sport_supporter/sport_supporter_index.vue').default ,
                children: 
                [
                    { path: '',name:'sport_supporter_index', component: require('./components/masters/organization_masters/sport_supporter/sport_supporter_list.vue').default },
                    { path: '/sport_supporter_add', name:'SportSupporterAdd', component: require('./components/masters/organization_masters/sport_supporter/sport_supporter_add.vue').default },
                    { path: '/sport_supporter_edit', name:'SportSupporterEdit', component: require('./components/masters/organization_masters/sport_supporter/sport_supporter_edit.vue').default },
                    { path: '/sport_supporter_list', name:'SportSupporterList', component: require('./components/masters/organization_masters/sport_supporter/sport_supporter_list.vue').default },
                ]    
            },
            { path: '/str_sub_category_index', 
                component: require('./components/masters/organization_masters/str_sub_category/str_sub_category_index.vue').default ,
                children: 
                [
                    { path: '',name:'str_sub_category_index', component: require('./components/masters/organization_masters/str_sub_category/str_sub_category_list.vue').default },
                    { path: '/str_sub_category_add', name:'StrSubCategoryAdd', component: require('./components/masters/organization_masters/str_sub_category/str_sub_category_add.vue').default },
                    { path: '/str_sub_category_edit', name:'StrSubCategoryEdit', component: require('./components/masters/organization_masters/str_sub_category/str_sub_category_edit.vue').default },
                    { path: '/str_sub_category_list', name:'StrSubCategoryList', component: require('./components/masters/organization_masters/str_sub_category/str_sub_category_list.vue').default },
                ]    
            },
  
            { path: '/equipment_item_index', 
                component: require('./components/masters/organization_masters/equipment_item/equipment_item_index.vue').default ,
                children: 
                [
                    { path: '',name:'equipment_item_index', component: require('./components/masters/organization_masters/equipment_item/equipment_item_list.vue').default },
                    { path: '/equipment_item_add', name:'EquipmentItemAdd', component: require('./components/masters/organization_masters/equipment_item/equipment_item_add.vue').default },
                    { path: '/equipment_item_edit', name:'EquipmentItemEdit', component: require('./components/masters/organization_masters/equipment_item/equipment_item_edit.vue').default },
                    { path: '/equipment_item_list', name:'EquipmentItemList', component: require('./components/masters/organization_masters/equipment_item/equipment_item_list.vue').default },
                ]    
            },
            { path: '/class_index', 
                component: require('./components/masters/organization_masters/class/class_index.vue').default ,
                children: 
                [
                    { path: '',name:'class_index', component: require('./components/masters/organization_masters/class/class_list.vue').default },
                    { path: '/class_add', name:'ClassAdd', component: require('./components/masters/organization_masters/class/class_add.vue').default },
                    { path: '/class_edit', name:'ClassEdit', component: require('./components/masters/organization_masters/class/class_edit.vue').default },
                    { path: '/class_list', name:'ClassList', component: require('./components/masters/organization_masters/class/class_list.vue').default },
                ]    
            },
            { path: '/stream_index', 
                component: require('./components/masters/organization_masters/stream/stream_index.vue').default ,
                children: 
                [
                    { path: '',name:'stream_index', component: require('./components/masters/organization_masters/stream/stream_list.vue').default },
                    { path: '/stream_add', name:'StreamAdd', component: require('./components/masters/organization_masters/stream/stream_add.vue').default },
                    { path: '/stream_edit', name:'StreamEdit', component: require('./components/masters/organization_masters/stream/stream_edit.vue').default },
                    { path: '/stream_list', name:'StreamList', component: require('./components/masters/organization_masters/stream/stream_list.vue').default },
                ]    
            },
            { path: '/contact_type_index', 
                component: require('./components/masters/organization_masters/contact_type/contact_type_index.vue').default ,
                children: 
                [
                    { path: '',name:'contact_type_index', component: require('./components/masters/organization_masters/contact_type/contact_type_list.vue').default },
                    { path: '/contact_type_add', name:'ContactTypeAdd', component: require('./components/masters/organization_masters/contact_type/contact_type_add.vue').default },
                    { path: '/contact_type_edit', name:'ContactTypeEdit', component: require('./components/masters/organization_masters/contact_type/contact_type_edit.vue').default },
                    { path: '/contact_type_list', name:'ContactTypeList', component: require('./components/masters/organization_masters/contact_type/contact_type_list.vue').default },
                ]    
            },
  
            { path: '/electricity_source_index', 
                component: require('./components/masters/organization_masters/electricity_source/electricity_source_index.vue').default ,
                children: 
                [
                    { path: '',name:'electricity_source_index', component: require('./components/masters/organization_masters/electricity_source/electricity_source_list.vue').default },
                    { path: '/electricity_source_add', name:'ElectricitySourceAdd', component: require('./components/masters/organization_masters/electricity_source/electricity_source_add.vue').default },
                    { path: '/electricity_source_edit', name:'ElectricitySourceEdit', component: require('./components/masters/organization_masters/electricity_source/electricity_source_edit.vue').default },
                    { path: '/electricity_source_list', name:'ElectricitySourceList', component: require('./components/masters/organization_masters/electricity_source/electricity_source_list.vue').default },
                ]    
            },
            { path: '/electricity_supply_index', 
                component: require('./components/masters/organization_masters/electricity_supply/electricity_supply_index.vue').default ,
                children: 
                [
                    { path: '',name:'electricity_supply_index', component: require('./components/masters/organization_masters/electricity_supply/electricity_supply_list.vue').default },
                    { path: '/electricity_supply_add', name:'ElectricitySupplyAdd', component: require('./components/masters/organization_masters/electricity_supply/electricity_supply_add.vue').default },
                    { path: '/electricity_supply_edit', name:'ElectricitySupplyEdit', component: require('./components/masters/organization_masters/electricity_supply/electricity_supply_edit.vue').default },
                    { path: '/electricity_supply_list', name:'ElectricitySupplyList', component: require('./components/masters/organization_masters/electricity_supply/electricity_supply_list.vue').default },
                ]    
            },
            { path: '/road_type_index', 
                component: require('./components/masters/organization_masters/road_type/road_type_index.vue').default ,
                children: 
                [
                    { path: '',name:'road_type_index', component: require('./components/masters/organization_masters/road_type/road_type_list.vue').default },
                    { path: '/road_type_add', name:'RoadTypeAdd', component: require('./components/masters/organization_masters/road_type/road_type_add.vue').default },
                    { path: '/road_type_edit', name:'RoadTypeEdit', component: require('./components/masters/organization_masters/road_type/road_type_edit.vue').default },
                    { path: '/road_type_list', name:'RoadTypeList', component: require('./components/masters/organization_masters/road_type/road_type_list.vue').default },
                ]    
            },
            { path: '/service_provider_index', 
                component: require('./components/masters/organization_masters/service_provider/service_provider_index.vue').default ,
                children: 
                [
                    { path: '',name:'service_provider_index', component: require('./components/masters/organization_masters/service_provider/service_provider_list.vue').default },
                    { path: '/service_provider_add', name:'ServiceProviderAdd', component: require('./components/masters/organization_masters/service_provider/service_provider_add.vue').default },
                    { path: '/service_provider_edit', name:'ServiceProviderEdit', component: require('./components/masters/organization_masters/service_provider/service_provider_edit.vue').default },
                    { path: '/service_provider_list', name:'ServiceProviderList', component: require('./components/masters/organization_masters/service_provider/service_provider_list.vue').default },
                ]    
            },
            { path: '/structure_designer_index', 
                component: require('./components/masters/organization_masters/structure_designer/structure_designer_index.vue').default ,
                children: 
                [
                    { path: '',name:'structure_designer_index', component: require('./components/masters/organization_masters/structure_designer/structure_designer_list.vue').default },
                    { path: '/structure_designer_add', name:'StructureDesignerAdd', component: require('./components/masters/organization_masters/structure_designer/structure_designer_add.vue').default },
                    { path: '/structure_designer_edit', name:'StructureDesignerEdit', component: require('./components/masters/organization_masters/structure_designer/structure_designer_edit.vue').default },
                    { path: '/structure_designer_list', name:'StructureDesignerList', component: require('./components/masters/organization_masters/structure_designer/structure_designer_list.vue').default },
                ]    
            },
            { path: '/attachment_index', 
                component: require('./components/masters/organization_masters/attachment/attachment_index.vue').default ,
                children: 
                [
                    { path: '',name:'attachment_index', component: require('./components/masters/organization_masters/attachment/attachment_list.vue').default },
                    { path: '/attachment_add', name:'AttachmentAdd', component: require('./components/masters/organization_masters/attachment/attachment_add.vue').default },
                    { path: '/attachment_edit', name:'AttachmentEdit', component: require('./components/masters/organization_masters/attachment/attachment_edit.vue').default },
                    { path: '/attachment_list', name:'AttachmentList', component: require('./components/masters/organization_masters/attachment/attachment_list.vue').default },
                ]    
            },
        ]  
    },

    // organization general information route
    { path: '/general_index', name:'general_index', component: require('./components/organization/general/general_index.vue').default,
      children:[
        { path: '/equipment_index',
        component: require('./components/organization/general/equipment/equipment_index.vue').default ,
          children: [
            { path: '',name:'equipment_index', component: require('./components/organization/general/equipment/equipment_list.vue').default },
            { path: '/equipment_add', name:'EquipmentAdd', component: require('./components/organization/general/equipment/equipment_add.vue').default },
            { path: '/equipment_edit', name:'EquipmentEdit', component: require('./components/organization/general/equipment/equipment_edit.vue').default },
            { path: '/equipment_list', name:'EquipmentList', component: require('./components/organization/general/equipment/equipment_list.vue').default },
          ]    
        },      
        { path: '/locations', name:'locations', component: require('./components/organization/general/locations.vue').default },
        { path: '/sections_add', name:'sections_add', component: require('./components/organization/general/section/sections_add.vue').default },
        { path: '/connectivity', name:'connectivity', component: require('./components/organization/general/connectivity.vue').default },
        { path: '/org_class_mapping',name:'org_class_mapping', component: require('./components/organization/general/org_class_mapping.vue').default },
      ] 
    },

    // organization establishment route
    { path: '/establishment_index', component: require('./components/organization/establishment/establishment_index.vue').default,
      children:[
        { path: '/establishment_index',name:"establishment_index", component: require('./components/organization/establishment/establishment_index_list.vue').default },
        { path: '/establishment',name:"establishment", component: require('./components/organization/establishment/establishment.vue').default },
        { path: '/estb_acknowledgement', name:'estb_acknowledgement', component: require('./components/organization/establishment/acknowledgement.vue').default },
        { path: '/register',name:'register', component: require('./components/organization/establishment/register.vue').default },
        { path: '/school_list',name:"school_list", component: require('./components/organization/establishment/school_list.vue').default },
        { path: '/school_details',  name:'school_details',component: require('./components/organization/establishment/school_details.vue').default },
        { path: '/school_full_details',  name:'school_full_details',component: require('./components/organization/establishment/school_full_details.vue').default },
        { path: '/head_quater_office', name:'head_quater_office', component: require('./components/organization/establishment/head_quater_office.vue').default },
        { path: '/list_head_quater_office',name:'list_head_quater_office', component: require('./components/organization/establishment/list_head_quater_office.vue').default },
        { path: '/org_details', name:'org_details', component: require('./components/organization/establishment/org_details.vue').default },
      ] 
    },
    { path: '/establishment_verification',  name:'establishment_verification',component: require('./components/organization/establishment/establishment_verification.vue').default },
    { path: '/change_basic_details_verification', name:'change_basic_details_verification', component: require('./components/organization/restructuring/change_basic_details_verification.vue').default },
    { path: '/closure_verification',name:'closure_verification', component: require('./components/organization/restructuring/closure_verification.vue').default },
    { path: '/merger_verification',  name:'merger_verification',component: require('./components/organization/restructuring/merger_verification.vue').default },
    { path: '/bifurcation_verification',  name:'bifurcation_verification',component: require('./components/organization/restructuring/bifurcation_verification.vue').default },

    // organization structural facility route
    { path: '/structural_index', component: require('./components/organization/structuralFacility/structural_index.vue').default,
      children:[
        // { path: '/wash',name:'wash', component: require('./components/organization/structuralFacility/wash.vue').default },
        { path: '/structural_index',name:"structural_index", component: require('./components/organization/structuralFacility/structural_index_list.vue').default },
        { path: '/infrastructure_index', 
          component: require('./components/organization/structuralFacility/infrastructure/infrastructure_index.vue').default ,
          children: [
            { path: '',name:'infrastructure_index', component: require('./components/organization/structuralFacility/infrastructure/infrastructure_list.vue').default },
            { path: '/infrastructure_add', name:'InfrastructureAdd', component: require('./components/organization/structuralFacility/infrastructure/infrastructure_add.vue').default },
            { path: '/infrastructure_edit', name:'InfrastructureEdit', component: require('./components/organization/structuralFacility/infrastructure/infrastructure_edit.vue').default },
            { path: '/infrastructure_list', name:'InfrastructureList', component: require('./components/organization/structuralFacility/infrastructure/infrastructure_list.vue').default },
          ]    
        },
        { path: '/sport_index', 
          component: require('./components/organization/structuralFacility/sport/sport_index.vue').default ,
          children: [
            { path: '',name:'sport_index', component: require('./components/organization/structuralFacility/sport/sport_list.vue').default },
            { path: '/sport_add', name:'SportAdd', component: require('./components/organization/structuralFacility/sport/sport_add.vue').default },
            { path: '/sport_edit', name:'SportEdit', component: require('./components/organization/structuralFacility/sport/sport_edit.vue').default },
            { path: '/sport_list', name:'SportList', component: require('./components/organization/structuralFacility/sport/sport_list.vue').default },
          ] 
        },
        // { path: '/school_feeding',name:'school_feeding', component: require('./components/organization/structuralFacility/school_feeding.vue').default },
      ] 
    },
    // organization restructuring route
    { path: '/restructuring_index', component: require('./components/organization/restructuring/restructuring_index.vue').default,
      children:[
        { path: '/restructuring_index',name:"restructuring_index", component: require('./components/organization/restructuring/restructuring_index_list.vue').default },
        { path: '/change_basic_details',name:'change_basic_details', component: require('./components/organization/restructuring/change_basic_details.vue').default },
        { path: '/merger',name:'merger', component: require('./components/organization/restructuring/merger.vue').default },
        { path: '/bifurcation_index',  
        component: require('./components/organization/restructuring/bifurcation/bifurcation_index.vue').default ,
          children: [
            { path: '/',name:'bifurcation_index', component: require('./components/organization/restructuring/bifurcation/bifurcation_list.vue').default },
            { path: '/bifurcation_list',name:'bifurcation_list', component: require('./components/organization/restructuring/bifurcation/bifurcation_list.vue').default },
            { path: '/bifurcation', name:'BifurcationAdd', component: require('./components/organization/restructuring/bifurcation/bifurcation.vue').default },
          ]    
        }, 
        { path: '/restr_acknowledgement', name:'restr_acknowledgement', component: require('./components/organization/restructuring/acknowledgement.vue').default },
        { path: '/closure_index', 
          component: require('./components/organization/restructuring/closure/closure_index.vue').default ,
          children: [
            { path: '/',name:'closure_index', component: require('./components/organization/restructuring/closure/closure_list.vue').default },
            { path: '/closure_list',name:'closure_list', component: require('./components/organization/restructuring/closure/closure_list.vue').default },
            { path: '/closure', name:'ClosureAdd', component: require('./components/organization/restructuring/closure/closure.vue').default },
          ]    
        },
        { path: '/wash',name:'wash', component: require('./components/organization/structuralFacility/wash.vue').default },
        { path: '/school_feeding',name:'school_feeding', component: require('./components/organization/structuralFacility/school_feeding.vue').default },
      ] 
    },
    { path: '/organization_profile',name:'organization_profile', component: require('./components/organization/organization_profile.vue').default },
];
export default routes