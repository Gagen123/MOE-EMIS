const routes = [  
    { path: '/OrganizationMasterIndex',name:'OrganizationMasterIndex', component: require('./components/masters/organization_masters/OrganizationMasterIndex.vue').default,
          children:[
               { path: '/org_service_index', 
                  component: require('./components/masters/organization_masters/service/service_index.vue').default ,
                  children: 
                  [
                    { path: '',name:'org_service_index', component: require('./components/masters/organization_masters/service/list_service.vue').default },
                    { path: '/list_org_service', name:'list_org_service', component: require('./components/masters/organization_masters/service/list_service.vue').default },
                    { path: '/create_org_service', name:'create_org_service', component: require('./components/masters/organization_masters/service/create_service.vue').default },
                    { path: '/edit_org_service', name:'edit_org_service', component: require('./components/masters/organization_masters/service/edit_service.vue').default },
                  ]    
              },
              { path: '/department_index', 
                  component: require('./components/masters/organization_masters/department/department_index.vue').default ,
                  children: 
                  [
                    { path: '',name:'department_index', component: require('./components/masters/organization_masters/department/list_department.vue').default },
                    { path: '/list_department', name:'list_department', component: require('./components/masters/organization_masters/department/list_department.vue').default },
                    { path: '/create_department', name:'create_department', component: require('./components/masters/organization_masters/department/create_department.vue').default },
                    { path: '/edit_department', name:'edit_department', component: require('./components/masters/organization_masters/department/edit_department.vue').default },
                  ]    
              },
              { path: '/proposed_by_index',  
                component: require('./components/masters/organization_masters/proposed_by/proposed_by_index.vue').default ,
                  children: [
                    { path: '/',name:'proposed_by_index', component: require('./components/masters/organization_masters/proposed_by/list_proposed_by.vue').default },
                    { path: '/list_proposed_by',name:'list_proposed_by', component: require('./components/masters/organization_masters/proposed_by/list_proposed_by.vue').default },
                    { path: '/create_proposed_by',name:'create_proposed_by', component: require('./components/masters/organization_masters/proposed_by/create_proposed_by.vue').default },
                    { path: '/edit_proposed_by',name:'edit_proposed_by', component: require('./components/masters/organization_masters/proposed_by/edit_proposed_by.vue').default },
                  ]    
              }, 
              { path: '/document_type_index',  
                component: require('./components/masters/organization_masters/document_type/document_type_index.vue').default ,
                  children: [
                    { path: '/',name:'document_type_index', component: require('./components/masters/organization_masters/document_type/list_document_type.vue').default },
                    { path: '/list_document_type',name:'list_document_type', component: require('./components/masters/organization_masters/document_type/list_document_type.vue').default },
                    { path: '/create_document_type',name:'create_document_type', component: require('./components/masters/organization_masters/document_type/create_document_type.vue').default },
                    { path: '/edit_document_type',name:'edit_document_type', component: require('./components/masters/organization_masters/document_type/edit_document_type.vue').default },
                  ]     
              },
              { path: '/income_facility_index',  
                component: require('./components/masters/organization_masters/income_facility/income_facility_index.vue').default ,
                  children: [
                    { path: '/',name:'income_facility_index', component: require('./components/masters/organization_masters/income_facility/list_income_facility.vue').default },
                    { path: '/list_income_facility',name:'list_income_facility', component: require('./components/masters/organization_masters/income_facility/list_income_facility.vue').default },
                    { path: '/create_income_facility',name:'create_income_facility', component: require('./components/masters/organization_masters/income_facility/create_income_facility.vue').default },
                    { path: '/edit_income_facility',name:'edit_income_facility', component: require('./components/masters/organization_masters/income_facility/edit_income_facility.vue').default },
                  ]     
              },
              { path: '/financial_information_index',  
                component: require('./components/masters/organization_masters/financial_information/financial_information_index.vue').default ,
                  children: [
                    { path: '/',name:'financial_information_index', component: require('./components/masters/organization_masters/financial_information/list_financial_information.vue').default },
                    { path: '/list_financial_information',name:'list_financial_information', component: require('./components/masters/organization_masters/financial_information/list_financial_information.vue').default },
                    { path: '/create_financial_information',name:'create_financial_information', component: require('./components/masters/organization_masters/financial_information/create_financial_information.vue').default },
                    { path: '/edit_financial_information',name:'edit_financial_information', component: require('./components/masters/organization_masters/financial_information/edit_financial_information.vue').default },
                  ]     
              }, 
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
            { path: '/furniture_type_index', 
                component: require('./components/masters/organization_masters/furniture_type/furniture_type_index.vue').default ,
                children: 
                [
                    { path: '',name:'furniture_type_index', component: require('./components/masters/organization_masters/furniture_type/furniture_type_list.vue').default },
                    { path: '/furniture_type_add', name:'furniture_type_add', component: require('./components/masters/organization_masters/furniture_type/furniture_type_add.vue').default },
                    { path: '/furniture_type_edit', name:'furniture_type_edit', component: require('./components/masters/organization_masters/furniture_type/furniture_type_edit.vue').default },
                    { path: '/furniture_type_list', name:'furniture_type_list', component: require('./components/masters/organization_masters/furniture_type/furniture_type_list.vue').default },
                ]    
            },
            { path: '/furniture_item_index', 
                component: require('./components/masters/organization_masters/furniture_item/furniture_item_index.vue').default ,
                children: 
                [
                    { path: '',name:'furniture_item_index', component: require('./components/masters/organization_masters/furniture_item/furniture_item_list.vue').default },
                    { path: '/furniture_item_add', name:'furniture_item_add', component: require('./components/masters/organization_masters/furniture_item/furniture_item_add.vue').default },
                    { path: '/furniture_item_edit', name:'furniture_item_edit', component: require('./components/masters/organization_masters/furniture_item/furniture_item_edit.vue').default },
                    { path: '/furniture_item_list', name:'furniture_item_list', component: require('./components/masters/organization_masters/furniture_item/furniture_item_list.vue').default },
                ]    
            },
            { path: '/furniture_usage_index', 
                component: require('./components/masters/organization_masters/furniture_usage/furniture_usage_index.vue').default ,
                children: 
                [
                    { path: '',name:'furniture_usage_index', component: require('./components/masters/organization_masters/furniture_usage/furniture_usage_list.vue').default },
                    { path: '/furniture_usage_add', name:'furniture_usage_add', component: require('./components/masters/organization_masters/furniture_usage/furniture_usage_add.vue').default },
                    { path: '/furniture_usage_edit', name:'furniture_usage_edit', component: require('./components/masters/organization_masters/furniture_usage/furniture_usage_edit.vue').default },
                    { path: '/furniture_usage_list', name:'furniture_usage_list', component: require('./components/masters/organization_masters/furniture_usage/furniture_usage_list.vue').default },
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
            { path: '/class_stream_index', 
                component: require('./components/masters/organization_masters/class_stream_mapping/class_stream_index.vue').default ,
                children: 
                [
                    { path: '',name:'class_stream_index', component: require('./components/masters/organization_masters/class_stream_mapping/class_stream_list.vue').default },
                    { path: '/class_stream_add', name:'ClassStreamAdd', component: require('./components/masters/organization_masters/class_stream_mapping/class_stream_add.vue').default },
                    { path: '/class_stream_edit', name:'ClassStreamEdit', component: require('./components/masters/organization_masters/class_stream_mapping/class_stream_edit.vue').default },
                    { path: '/class_stream_list', name:'ClassStreamList', component: require('./components/masters/organization_masters/class_stream_mapping/class_stream_list.vue').default },
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
    //Organziation Routes (Establishment)

    { path: '/establishment_verification',  name:'establishment_verification',component: require('./components/organization/establishment/establishment_verification.vue').default },
    { path: '/change_basic_details_verification', name:'change_basic_details_verification', component: require('./components/organization/restructuring/change_basic_details_verification.vue').default },
    { path: '/closure_verification',name:'closure_verification', component: require('./components/organization/restructuring/closure_verification.vue').default },
    { path: '/merger_verification',  name:'merger_verification',component: require('./components/organization/restructuring/merger_verification.vue').default },
    { path: '/bifurcation_verification',  name:'bifurcation_verification',component: require('./components/organization/restructuring/bifurcation_verification.vue').default },
    
    { path: '/establishment_index', component: require('./components/organization/establishment/establishment_index.vue').default,
      children:[
        { path: '',name:"establishment_index", component: require('./components/organization/establishment/public_school/list_public_school.vue').default },
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
        { path: '/public_eccd_index', 
          component: require('./components/organization/establishment/public_eccd/public_eccd_index.vue').default,
          children: [ 
            { path: '/', name:'public_eccd_index', component: require('./components/organization/establishment/public_eccd/list_public_eccd.vue').default },
            { path: '/list_public_eccd', name:'list_public_eccd', component: require('./components/organization/establishment/public_eccd/list_public_eccd.vue').default },
            { path: '/create_public_eccd',name:"create_public_eccd", component: require('./components/organization/establishment/public_eccd/create_public_eccd.vue').default },
            { path: '/edit_public_eccd',  name:'edit_public_eccd',component: require('./components/organization/establishment/public_eccd/edit_public_eccd.vue').default },
            { path: '/acknowledgement_public_eccd',  name:'acknowledgement_public_eccd',component: require('./components/organization/establishment/public_eccd/acknowledgement.vue').default },
            { path: '/show_public_eccd',  name:'show_public_eccd',component: require('./components/organization/establishment/public_eccd/show_public_eccd.vue').default },
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
        { path: '/private_eccd_index', 
          component: require('./components/organization/establishment/private_eccd/private_eccd_index.vue').default,
          children: [ 
            { path: '/', name:'private_eccd_index', component: require('./components/organization/establishment/private_eccd/list_private_eccd.vue').default },
            { path: '/list_private_eccd', name:'list_private_eccd', component: require('./components/organization/establishment/private_eccd/list_private_eccd.vue').default },
            { path: '/create_private_eccd',name:"create_private_eccd", component: require('./components/organization/establishment/private_eccd/create_private_eccd.vue').default },
            { path: '/edit_private_eccd',  name:'edit_private_eccd',component: require('./components/organization/establishment/private_eccd/edit_private_eccd.vue').default },
            { path: '/acknowledgement_private_eccd',  name:'acknowledgement_private_eccd',component: require('./components/organization/establishment/private_eccd/acknowledgement.vue').default },
            { path: '/show_private_eccd',  name:'show_private_eccd',component: require('./components/organization/establishment/private_eccd/show_private_eccd.vue').default },
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
        // { path: '/new_establishment_index',  name:'establishment_index',
        //   component: require('./components/organization/establishment/new_establishment/new_establishment_index.vue').default ,
        //   children: [
        //     { path: '',name:"establishment_index_list", component: require('./components/organization/establishment/new_establishment/establishment_index_list.vue').default },
        //     { path: '/establishment',name:"establishment", 
        //         component: require('./components/organization/establishment/new_establishment/establishment.vue').default,
        //         children: [
        //             // { path: '/public_school',name:"public_school", component: require('./components/organization/establishment/new_establishment/public_school.vue').default },
        //             { path: '/private_school',name:"private_school", component: require('./components/organization/establishment/new_establishment/private_school.vue').default },
        //             { path: '/public_eccd', name:'public_eccd', component: require('./components/organization/establishment/new_establishment/public_eccd.vue').default },
        //             { path: '/private_eccd',name:"private_eccd", component: require('./components/organization/establishment/new_establishment/private_eccd.vue').default },
        //             { path: '/public_ecr',name:"public_ecr", component: require('./components/organization/establishment/new_establishment/public_ecr.vue').default },
        //           ]
        //     },
        //     { path: '/estb_acknowledgement', name:'estb_acknowledgement', component: require('./components/organization/establishment/new_establishment/acknowledgement.vue').default },
        //   ]    
        // },
        // { path: '/org_details', 
        //   component: require('./components/organization/organization_details/org_details.vue').default ,
        //   children: [
        //     { path: '/org_details', name:'org_details', component: require('./components/organization/organization_details/org_details.vue').default },
        //     { path: '/school_list',name:"school_list", component: require('./components/organization/organization_details/school_list.vue').default },
        //     { path: '/school_details',  name:'school_details',component: require('./components/organization/organization_details/school_details.vue').default },
        //     { path: '/school_full_details',  name:'school_full_details',component: require('./components/organization/organization_details/school_full_details.vue').default },
        //   ] 
        // },
        
        
        { path: '/establishment_acknowledgement', name:'establishment_acknowledgement', component: require('./components/organization/establishment/acknowledgement.vue').default },
      ] 
    },

    //Organization Routes (General Information)
    { path: '/general_index', name:'general_index', component: require('./components/organization/general/general_index.vue').default,
        children:[
            { path: '/equipment_index',
                component: require('./components/organization/general/equipment/equipment_index.vue').default,
                children: [
                    { path: '',name:'equipment_index', component: require('./components/organization/general/equipment/equipment_list.vue').default },
                    { path: '/equipment_add', name:'EquipmentAdd', component: require('./components/organization/general/equipment/equipment_add.vue').default },
                    { path: '/equipment_edit', name:'EquipmentEdit', component: require('./components/organization/general/equipment/equipment_edit.vue').default },
                    { path: '/equipment_list', name:'EquipmentList', component: require('./components/organization/general/equipment/equipment_list.vue').default },
                ]    
            },
            { path: '/furniture_index',
                component: require('./components/organization/general/furniture/furniture_index.vue').default,
                children: [
                    { path: '',name:'furniture_index', component: require('./components/organization/general/furniture/furniture_list.vue').default },
                    { path: '/furniture_add', name:'furniture_add', component: require('./components/organization/general/furniture/furniture_add.vue').default },
                    { path: '/furniture_edit', name:'furniture_edit', component: require('./components/organization/general/furniture/furniture_edit.vue').default },
                    { path: '/furniture_list', name:'furniture_list', component: require('./components/organization/general/furniture/furniture_list.vue').default },
                ]    
            },  
            { path: '/locations', name:'locations', 
                component: require('./components/organization/general/locations.vue').default,
                children: 
                [
                    { path: '',name:'location_index', component: require('./components/masters/organization_masters/location/location_list.vue').default },
                    { path: '/location_add', name:'LocationAdd', component: require('./components/masters/organization_masters/location/location_add.vue').default },
                    { path: '/location_edit', name:'LocationEdit', component: require('./components/masters/organization_masters/location/location_edit.vue').default },
                    { path: '/location_list', name:'LocationList', component: require('./components/masters/organization_masters/location/location_list.vue').default },
                ]    
            },
            //section routes
            { path: '/section_index', 
              component: require('./components/organization/general/section/section_index.vue').default ,
              children: [
                { path: '',name:'section_index', component: require('./components/organization/general/section/list_section.vue').default },
                { path: '/list_section', name:'list_section', component: require('./components/organization/general/section/list_section.vue').default },
                { path: '/create_section', name:'create_section', component: require('./components/organization/general/section/create_section.vue').default },
                { path: '/edit_section', name:'edit_section', component: require('./components/organization/general/section/edit_section.vue').default },
                
              ] 
            }, 

            { path: '/sections_add', name:'sections_add', 
                // component: require('./components/organization/general/section/sections_add.vue').default,
                children: 
                [
                    { path: '',name:'location_index', component: require('./components/masters/organization_masters/location/location_list.vue').default },
                    { path: '/location_add', name:'LocationAdd', component: require('./components/masters/organization_masters/location/location_add.vue').default },
                    { path: '/location_edit', name:'LocationEdit', component: require('./components/masters/organization_masters/location/location_edit.vue').default },
                    { path: '/location_list', name:'LocationList', component: require('./components/masters/organization_masters/location/location_list.vue').default },
                ]    
            },
            { path: '/connectivity', name:'connectivity', 
                component: require('./components/organization/general/connectivity.vue').default,
                children: 
                [
                    { path: '',name:'location_index', component: require('./components/masters/organization_masters/location/location_list.vue').default },
                    { path: '/location_add', name:'LocationAdd', component: require('./components/masters/organization_masters/location/location_add.vue').default },
                    { path: '/location_edit', name:'LocationEdit', component: require('./components/masters/organization_masters/location/location_edit.vue').default },
                    { path: '/location_list', name:'LocationList', component: require('./components/masters/organization_masters/location/location_list.vue').default },
                ]    
            },
            { path: '/org_class_mapping', name:'org_class_mapping', 
                component: require('./components/organization/general/org_class_mapping.vue').default,
                children: 
                [
                    { path: '',name:'location_index', component: require('./components/masters/organization_masters/location/location_list.vue').default },
                    { path: '/location_add', name:'LocationAdd', component: require('./components/masters/organization_masters/location/location_add.vue').default },
                    { path: '/location_edit', name:'LocationEdit', component: require('./components/masters/organization_masters/location/location_edit.vue').default },
                    { path: '/location_list', name:'LocationList', component: require('./components/masters/organization_masters/location/location_list.vue').default },
                ]    
            },
        ] 
    },

  //  Organization (Restructuring Routes)
    { path: '/restructuring_index', component: require('./components/organization/restructuring/restructuring_index.vue').default,
      children:[
      { path: '/restructuring_index',name:"restructuring_index", component: require('./components/organization/restructuring/restructuring_index_list.vue').default },
      
      { path: '/name_change_index',  
        component: require('./components/organization/restructuring/name_change/name_change_index.vue').default ,
          children: [
            { path: '/',name:'name_change_index', component: require('./components/organization/restructuring/name_change/list_name_change.vue').default },
            { path: '/list_name_change',name:'list_name_change', component: require('./components/organization/restructuring/name_change/list_name_change.vue').default },
            { path: '/create_name_change',name:'create_name_change', component: require('./components/organization/restructuring/name_change/create_name_change.vue').default },
            { path: '/edit_name_change',name:'edit_name_change', component: require('./components/organization/restructuring/name_change/edit_name_change.vue').default },
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
            { path: '/level_change_acknowledgement', name:'level_change_acknowledgement', component: require('./components/organization/restructuring/level_change/acknowledgement.vue').default },
          ]    
      },
      { path: '/sen_details_index',  
        component: require('./components/organization/restructuring/sen_change/sen_change_index.vue').default ,
          children: [
            { path: '/',name:'sen_details_index', component: require('./components/organization/restructuring/sen_change/list_sen_change.vue').default },
            { path: '/list_sen_change',name:'list_sen_change', component: require('./components/organization/restructuring/sen_change/list_sen_change.vue').default },
            { path: '/create_sen_change',name:'create_sen_change', component: require('./components/organization/restructuring/sen_change/create_sen_change.vue').default },
            { path: '/sen_change_acknowledgement', name:'sen_change_acknowledgement', component: require('./components/organization/restructuring/sen_change/acknowledgement.vue').default },
          ]    
      },
      { path: '/feeding_details_index',  
        component: require('./components/organization/restructuring/feeding_change/feeding_change_index.vue').default ,
          children: [
            { path: '/',name:'feeding_details_index', component: require('./components/organization/restructuring/feeding_change/list_feeding_change.vue').default },
            { path: '/list_feeding_change',name:'list_feeding_change', component: require('./components/organization/restructuring/feeding_change/list_feeding_change.vue').default },
            { path: '/create_feeding_change',name:'create_feeding_change', component: require('./components/organization/restructuring/feeding_change/create_feeding_change.vue').default },
            { path: '/feeding_change_acknowledgement', name:'feeding_change_acknowledgement', component: require('./components/organization/restructuring/feeding_change/acknowledgement.vue').default },
          ]    
      },
      { path: '/proprietor_details_index',  
        component: require('./components/organization/restructuring/proprietor_change/proprietor_change_index.vue').default ,
          children: [
            { path: '/',name:'proprietor_details_index', component: require('./components/organization/restructuring/proprietor_change/list_proprietor_change.vue').default },
            { path: '/list_proprietor_change',name:'list_proprietor_change', component: require('./components/organization/restructuring/proprietor_change/list_proprietor_change.vue').default },
            { path: '/create_proprietor_change',name:'create_proprietor_change', component: require('./components/organization/restructuring/proprietor_change/create_proprietor_change.vue').default },
            { path: '/proprietor_change_acknowledgement', name:'proprietor_change_acknowledgement', component: require('./components/organization/restructuring/proprietor_change/acknowledgement.vue').default },
          ]    
      },
      { path: '/location_change_index',   
        component: require('./components/organization/restructuring/location_change/location_change_index.vue').default ,
          children: [
            { path: '/',name:'location_change_index', component: require('./components/organization/restructuring/location_change/list_location_change.vue').default },
            { path: '/list_location_change',name:'list_location_change', component: require('./components/organization/restructuring/location_change/list_location_change.vue').default },
            { path: '/create_location_change',name:'create_location_change', component: require('./components/organization/restructuring/location_change/create_location_change.vue').default },
            { path: '/location_change_acknowledgement', name:'location_change_acknowledgement', component: require('./components/organization/restructuring/location_change/acknowledgement.vue').default },
          ]    
      },
      { path: '/expension_index',  
        component: require('./components/organization/restructuring/expension/expension_index.vue').default ,
          children: [
            { path: '/',name:'expension_index', component: require('./components/organization/restructuring/expension/list_expension.vue').default },
            { path: '/list_expension',name:'list_expension', component: require('./components/organization/restructuring/expension/list_expension.vue').default },
            { path: '/create_expension',name:'create_expension', component: require('./components/organization/restructuring/expension/create_expension.vue').default },
            { path: '/expension_acknowledgement', name:'expension_acknowledgement', component: require('./components/organization/restructuring/expension/acknowledgement.vue').default },
          ]    
      },

      { path: '/bifurcation_index',  
        component: require('./components/organization/restructuring/bifurcation/bifurcation_index.vue').default ,
          children: [
            { path: '/',name:'bifurcation_index', component: require('./components/organization/restructuring/bifurcation/list_bifurcation.vue').default },
            { path: '/list_bifurcation',name:'list_bifurcation', component: require('./components/organization/restructuring/bifurcation/list_bifurcation.vue').default },
            { path: '/create_bifurcation',name:'create_bifurcation', component: require('./components/organization/restructuring/bifurcation/create_bifurcation.vue').default },
            { path: '/bifurcation_acknowledgement', name:'bifurcation_acknowledgement', component: require('./components/organization/restructuring/bifurcation/acknowledgement.vue').default },
          ]    
      },
      
       
      
      { path: '/change_details_index',
          name:'change_details_index', component: require('./components/organization/restructuring/change_details/change_details_index.vue').default,
            children: [
              { path: '',name:'change_details_index', component: require('./components/organization/restructuring/change_details/change_details_list.vue').default },
              { path: '/change_details_add',
                component: require('./components/organization/restructuring/change_details/change_details_add.vue').default,
                children: [
                  { path: '/change_name',name:"change_name", component: require('./components/organization/restructuring/change_details/change_name.vue').default },
                  { path: '/change_level',name:"change_level", component: require('./components/organization/restructuring/change_details/change_level.vue').default },
                  { path: '/change_feeding_details', name:'change_feeding_details', component: require('./components/organization/restructuring/change_details/change_feeding_details.vue').default },
                  { path: '/change_sen_details', name:'change_sen_details', component: require('./components/organization/restructuring/change_details/change_sen_details.vue').default },
                  { path: '/change_proprietor_details', name:'change_proprietor_details', component: require('./components/organization/restructuring/change_details/change_proprietor_details.vue').default },
                  { path: '/change_all_details', name:'change_all_details', component: require('./components/organization/restructuring/change_details/change_all_details.vue').default },
                ]
              },
              { path: '/change_details_edit', name:'change_details_edit', component: require('./components/organization/restructuring/change_details/change_details_edit.vue').default },
              { path: '/change_details_list', name:'change_details_list', component: require('./components/organization/restructuring/change_details/change_details_list.vue').default },
            ]  
        },

        { path: '/merger',name:'merger', component: require('./components/organization/restructuring/merger/merger.vue').default },
        // { path: '/bifurcation_index',  
        //   component: require('./components/organization/restructuring/bifurcation/bifurcation_index.vue').default ,
        //     children: [
        //       { path: '/',name:'bifurcation_index', component: require('./components/organization/restructuring/bifurcation/bifurcation_list.vue').default },
        //       { path: '/bifurcation_list',name:'bifurcation_list', component: require('./components/organization/restructuring/bifurcation/bifurcation_list.vue').default },
        //       { path: '/bifurcation', name:'BifurcationAdd', component: require('./components/organization/restructuring/bifurcation/bifurcation.vue').default },
        //     ]    
        // }, 
        { path: '/restr_acknowledgement', name:'restr_acknowledgement', component: require('./components/organization/restructuring/acknowledgement.vue').default },
        { path: '/closure_index', 
          component: require('./components/organization/restructuring/closure/closure_index.vue').default ,
          children: [
            { path: '/',name:'closure_index', component: require('./components/organization/restructuring/closure/closure_list.vue').default },
            { path: '/closure_list',name:'closure_list', component: require('./components/organization/restructuring/closure/closure_list.vue').default },
            { path: '/closure', name:'ClosureAdd', component: require('./components/organization/restructuring/closure/closure.vue').default },
          ]    
        },
      ] 
    },


    // Organisational Routes (structural facility route)
    { path: '/structural_index', component: require('./components/organization/structuralFacility/structural_index.vue').default,
      children:[
        { path: '/infrastructure_index', name:'structural_index',
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
        { path: '/wash',name:'wash', component: require('./components/organization/structuralFacility/wash.vue').default },
        { path: '/school_feeding',name:'school_feeding', component: require('./components/organization/structuralFacility/school_feeding.vue').default },
      ] 
    },
    { path: '/mission_vission',name:'mission_vission', component: require('./components/organization/organization_profile_update.vue').default },
    { path: '/organization_list',name:'organization_list', component: require('./components/organization/organization_list.vue').default },
    { path: '/view_organization_profile',name:'view_organization_profile', component: require('./components/organization/view_organization_profile.vue').default },
    { path: '/basic_details_index',name:'basic_details_index', component: require('./components/organization/organization_basic_details.vue').default },
         //new routes for change in details (restructuring)
    { path: '/structural_index', component: require('./components/organization/structuralFacility/structural_index.vue').default,
      children:[
        { path: '/infrastructure_index', name:'structural_index',
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
        { path: '/wash',name:'wash', component: require('./components/organization/structuralFacility/wash.vue').default },
        { path: '/school_feeding',name:'school_feeding', component: require('./components/organization/structuralFacility/school_feeding.vue').default },
      ] 
    },
    //Latest Routes (31st May - All missing information as per the requirement gathering and discussion)
    { path: '/financials', component: require('./components/organization/financials/index.vue').default,
      children:[
        { path: '/financial_information', name:'financial_information',
          component: require('./components/organization/financials/financial_information/financial_information.vue').default ,
          children: [
            { path: '',name:'financial_information', component: require('./components/organization/financials/financial_information/list_financial_information.vue').default },
            { path: '/add_financial_information', name:'add_financial_information', component: require('./components/organization/financials/financial_information/add_financial_information.vue').default },
            { path: '/edit_financial_information', name:'edit_financial_information', component: require('./components/organization/financials/financial_information/edit_financial_information.vue').default },
            { path: '/list_financial_information', name:'list_financial_information', component: require('./components/organization/financials/financial_information/list_financial_information.vue').default },
          ]    
        },
        { path: '/income_information', 
          component: require('./components/organization/financials/income_information/income_information.vue').default ,
          children: [
            { path: '',name:'income_information', component: require('./components/organization/financials/income_information/list_income_information.vue').default },
            { path: '/add_income_information', name:'add_income_information', component: require('./components/organization/financials/income_information/add_income_information.vue').default },
            { path: '/edit_income_information', name:'edit_income_information', component: require('./components/organization/financials/income_information/edit_income_information.vue').default },
            { path: '/list_income_information', name:'list_income_information', component: require('./components/organization/financials/income_information/list_income_information.vue').default },
          ] 
        },
        { path: '/child_facilities', 
          component: require('./components/organization/facilities/child/child_facilities.vue').default ,
          children: [
            { path: '',name:'child_facilities', component: require('./components/organization/facilities/child/list_child_facilities.vue').default },
            { path: '/add_child_facilities', name:'add_child_facilities', component: require('./components/organization/facilities/child/add_child_facilities.vue').default },
            { path: '/edit_child_facilities', name:'edit_child_facilities', component: require('./components/organization/facilities/child/edit_child_facilities.vue').default },
            { path: '/list_child_facilities', name:'list_child_facilities', component: require('./components/organization/facilities/child/list_child_facilities.vue').default },
          ] 
        },
        { path: '/visitors_information', 
          component: require('./components/organization/general/visitors_information/visitors_information.vue').default ,
          children: [
            { path: '',name:'visitors_information', component: require('./components/organization/general/visitors_information/list_visitors_information.vue').default },
            { path: '/add_visitors_information', name:'add_visitors_information', component: require('./components/organization/general/visitors_information/add_visitors_information.vue').default },
            { path: '/edit_visitors_information', name:'edit_visitors_information', component: require('./components/organization/general/visitors_information/edit_visitors_information.vue').default },
            { path: '/list_visitors_information', name:'list_visitors_information', component: require('./components/organization/general/visitors_information/list_visitors_information.vue').default },
          ] 
        },
        { path: '/projections', 
          component: require('./components/organization/general/projections/projections.vue').default ,
          children: [
            { path: '',name:'projections', component: require('./components/organization/general/projections/list_projections.vue').default },
            { path: '/add_projections', name:'add_projections', component: require('./components/organization/general/projections/add_projections.vue').default },
            { path: '/edit_projections', name:'edit_projections', component: require('./components/organization/general/projections/edit_projections.vue').default },
            { path: '/list_projections', name:'list_projections', component: require('./components/organization/general/projections/list_projections.vue').default },
          ] 
        },
        { path: '/disasters_information', 
          component: require('./components/organization/general/disasters_information/disasters_information.vue').default ,
          children: [
            { path: '',name:'disasters_information', component: require('./components/organization/general/disasters_information/list_disasters_information.vue').default },
            { path: '/add_disasters_information', name:'add_disasters_information', component: require('./components/organization/general/disasters_information/add_disasters_information.vue').default },
            { path: '/edit_disasters_information', name:'edit_disasters_information', component: require('./components/organization/general/disasters_information/edit_disasters_information.vue').default },
            { path: '/list_disasters_information', name:'list_disasters_information', component: require('./components/organization/general/disasters_information/list_disasters_information.vue').default },
          ] 
        },
        { path: '/location_details', 
          component: require('./components/organization/general/location_details/location_details.vue').default ,
          children: [
            { path: '',name:'location_details', component: require('./components/organization/general/location_details/list_location_details.vue').default },
            { path: '/add_location_details', name:'add_location_details', component: require('./components/organization/general/location_details/add_location_details.vue').default },
            { path: '/edit_location_details', name:'edit_location_details', component: require('./components/organization/general/location_details/edit_location_details.vue').default },
            { path: '/list_location_details', name:'list_location_details', component: require('./components/organization/general/location_details/list_location_details.vue').default },
          ] 
        },
        { path: '/compound_details', 
          component: require('./components/organization/general/compound_details/compound_details.vue').default ,
          children: [
            { path: '',name:'compound_details', component: require('./components/organization/general/compound_details/list_compound_details.vue').default },
            { path: '/add_compound_details', name:'add_compound_details', component: require('./components/organization/general/compound_details/add_compound_details.vue').default },
            { path: '/edit_compound_details', name:'edit_compound_details', component: require('./components/organization/general/compound_details/edit_compound_details.vue').default },
            { path: '/list_compound_details', name:'list_compound_details', component: require('./components/organization/general/compound_details/list_compound_details.vue').default },
          ] 
        },
      ] 
    },


    //New Routes for change in Details (restructuring)    
    // { path: '/restructuringnew_index', 
    //   component: require('./components/organization/restructuring/change_details/restructuringnew_index.vue').default,
    //     children:[
    //     { path: '/nameChange_index', 
    //       component: require('./components/organization/restructuring/change_details/changeInName/nameChange_index.vue').default ,
    //       children: [
    //         { path: '',name:'nameChange_index', component: require('./components/organization/restructuring/change_details/changeInName/nameChange_list.vue').default },
    //         { path: '/nameChange_add', name:'NameChangeAdd', component: require('./components/organization/restructuring/change_details/changeInName/nameChange_add.vue').default },
    //         { path: '/nameChange_edit', name:'NameChangeEdit', component: require('./components/organization/restructuring/change_details/changeInName/nameChange_edit.vue').default },
    //         { path: '/nameChange_list', name:'NameChangeList', component: require('./components/organization/restructuring/change_details/changeInName/nameChange_list.vue').default },
    //       ]    
    //     },       
    //     { path: '/levelChange_index', 
    //       component: require('./components/organization/restructuring/change_details/changeInLevel/levelChange_index.vue').default ,
    //       children: [
    //         { path: '',name:'levelChange_index', component: require('./components/organization/restructuring/change_details/changeInLevel/levelChange_list.vue').default },
    //         { path: '/levelChange_add', name:'LevelChangeAdd', component: require('./components/organization/restructuring/change_details/changeInLevel/levelChange_add.vue').default },
    //         { path: '/levelChange_edit', name:'LevelChangeEdit', component: require('./components/organization/restructuring/change_details/changeInLevel/levelChange_edit.vue').default },
    //         { path: '/levelChange_list', name:'LevelChangeList', component: require('./components/organization/restructuring/change_details/changeInLevel/levelChange_list.vue').default },
    //       ] 
    //     }, 		
    //     { path: '/feedingChange_index', 
    //       component: require('./components/organization/restructuring/change_details/changeInFeeding/feedingChange_index.vue').default ,
    //       children: [
    //         { path: '',name:'feedingChange_index', component: require('./components/organization/restructuring/change_details/changeInFeeding/feedingChange_list.vue').default },
    //         { path: '/feedingChange_add', name:'FeedingChangeAdd', component: require('./components/organization/restructuring/change_details/changeInFeeding/feedingChange_add.vue').default },
    //         { path: '/feedingChange_edit', name:'FeedingChangeEdit', component: require('./components/organization/restructuring/change_details/changeInFeeding/feedingChange_edit.vue').default },
    //         { path: '/feedingChange_list', name:'FeedingChangeList', component: require('./components/organization/restructuring/change_details/changeInFeeding/feedingChange_list.vue').default },
    //       ] 
    //     },
    //     { path: '/senChange_index', 
    //       component: require('./components/organization/restructuring/change_details/changeInSenDetails/senChange_index.vue').default ,
    //       children: [
    //         { path: '',name:'senChange_index', component: require('./components/organization/restructuring/change_details/changeInSenDetails/senChange_list.vue').default },
    //         { path: '/senChange_add', name:'SenChangeAdd', component: require('./components/organization/restructuring/change_details/changeInSenDetails/senChange_add.vue').default },
    //         { path: '/senChange_edit', name:'SenChangeEdit', component: require('./components/organization/restructuring/change_details/changeInSenDetails/senChange_edit.vue').default },
    //         { path: '/senChange_list', name:'SenChangeList', component: require('./components/organization/restructuring/change_details/changeInSenDetails/senChange_list.vue').default },
    //       ] 
    //     },  
    //     { path: '/bifurcation_index', 
    //       component: require('./components/organization/restructuring/change_details/bifurcation/bifurcation_index.vue').default ,
    //       children: [
    //         { path: '',name:'bifurcation_index', component: require('./components/organization/restructuring/change_details/bifurcation/bifurcation_list.vue').default },
    //         { path: '/bifurcation_add', name:'BifurcationAdd', component: require('./components/organization/restructuring/change_details/bifurcation/bifurcation_add.vue').default },
    //         { path: '/bifurcation_edit', name:'BifurcationEdit', component: require('./components/organization/restructuring/change_details/bifurcation/bifurcation_edit.vue').default },
    //         { path: '/bifurcation_list', name:'BifurcationList', component: require('./components/organization/restructuring/change_details/bifurcation/bifurcation_list.vue').default },
    //       ] 
    //     },
    //     { path: '/Merger_index', 
    //       component: require('./components/organization/restructuring/change_details/mergeR/merger_index.vue').default ,
    //       children: [
    //         { path: '',name:'merger_index', component: require('./components/organization/restructuring/change_details/mergeR/merger_list.vue').default },
    //         { path: '/merger_add', name:'MergerAdd', component: require('./components/organization/restructuring/change_details/mergeR/merger_add.vue').default },
    //         { path: '/merger_edit', name:'MergerEdit', component: require('./components/organization/restructuring/change_details/mergeR/merger_edit.vue').default },
    //         { path: '/merger_list', name:'MergerList', component: require('./components/organization/restructuring/change_details/mergeR/merger_list.vue').default },
    //       ] 
    //     },  
    //     { path: '/Closure_index', 
    //       component: require('./components/organization/restructuring/change_details/closurE/closure_index.vue').default ,
    //       children: [
    //         { path: '',name:'closure_index', component: require('./components/organization/restructuring/change_details/closurE/closure_list.vue').default },
    //         { path: '/closure_add', name:'MergerAdd', component: require('./components/organization/restructuring/change_details/closurE/closure_add.vue').default },
    //         { path: '/closure_edit', name:'MergerEdit', component: require('./components/organization/restructuring/change_details/closurE/closure_edit.vue').default },
    //         { path: '/closure_list', name:'MergerList', component: require('./components/organization/restructuring/change_details/closurE/closure_list.vue').default },
    //       ] 
    //     },
    //   ] 
    // },

    //New Routes for Other Infromation 
  //   { path: '/otherOrgInfo_index', 
  //   component: require('./components/organization/otherOrganizationalinfo/otherOrgInfo_index.vue').default,
  //     children:[
  //     { path: '/slocation_index', 
  //       component: require('./components/organization/otherOrganizationalinfo/schoolLocation/slocation_index.vue').default ,
  //       children: [
  //         { path: '',name:'slocation_index', component: require('./components/organization/otherOrganizationalinfo/schoolLocation/slocation_list.vue').default },
  //         { path: '/slocation_add', name:'SLocationAdd', component: require('./components/organization/otherOrganizationalinfo/schoolLocation/slocation_add.vue').default },
  //         { path: '/slocation_edit', name:'SLocationEdit', component: require('./components/organization/otherOrganizationalinfo/schoolLocation/slocation_edit.vue').default },
  //         { path: '/slocation_list', name:'SLocationList', component: require('./components/organization/otherOrganizationalinfo/schoolLocation/slocation_list.vue').default },
  //       ]    
  //     },       
  //     { path: '/connectivity_index', 
  //       component: require('./components/organization/otherOrganizationalinfo/connectivity/connectivity_index.vue').default ,
  //       children: [
  //         { path: '',name:'connectivity_index', component: require('./components/organization/otherOrganizationalinfo/connectivity/connectivity_list.vue').default },
  //         { path: '/connectivity_add', name:'ConnectivityAdd', component: require('./components/organization/otherOrganizationalinfo/connectivity/connectivity_add.vue').default },
  //         { path: '/connectivity_edit', name:'ConnectivityEdit', component: require('./components/organization/otherOrganizationalinfo/connectivity/connectivity_edit.vue').default },
  //         { path: '/connectivity_list', name:'ConnectivityList', component: require('./components/organization/otherOrganizationalinfo/connectivity/connectivity_list.vue').default },
  //       ] 
  //     }, 		
  //     { path: '/equipment&furniture_index', 
  //       component: require('./components/organization/otherOrganizationalinfo/equipment&furniture/equipment&furniture_index.vue').default ,
  //       children: [
  //         { path: '',name:'equipment&furniture_index', component: require('./components/organization/otherOrganizationalinfo/equipment&furniture/equipment&furniture_list.vue').default },
  //         { path: '/equipment&furniture_add', name:'Equipment&FurnitureAdd', component: require('./components/organization/otherOrganizationalinfo/equipment&furniture/equipment&furniture_add.vue').default },
  //         { path: '/equipment&furniture_edit', name:'Equipment&FurnitureEdit', component: require('./components/organization/otherOrganizationalinfo/equipment&furniture/equipment&furniture_edit.vue').default },
  //         { path: '/equipment&furniture_list', name:'Equipment&FurnitureList', component: require('./components/organization/otherOrganizationalinfo/equipment&furniture/equipment&furniture_list.vue').default },
  //       ] 
  //     },
   
  //     { path: '/classMapping_index', 
  //       component: require('./components/organization/otherOrganizationalinfo/class&sectionMapping/classMapping_index.vue').default ,
  //       children: [
  //         { path: '',name:'classMapping_index', component: require('./components/organization/otherOrganizationalinfo/class&sectionMapping/classMapping_list.vue').default },
  //         { path: '/classMapping_add', name:'BifurcationAdd', component: require('./components/organization/otherOrganizationalinfo/class&sectionMapping/classMapping_add.vue').default },
  //         { path: '/classMapping_edit', name:'BifurcationEdit', component: require('./components/organization/otherOrganizationalinfo/class&sectionMapping/classMapping_edit.vue').default },
  //         { path: '/classMapping_list', name:'BifurcationList', component: require('./components/organization/otherOrganizationalinfo/class&sectionMapping/classMapping_list.vue').default },
  //       ] 
  //     },
  //   ] 
  // },

  //Create New Organization

//   { path: '/newEstablishment_index', 
//   component: require('./components/organization/newEstablishment/newEstablishment_index.vue').default,
//     children:[
//     { path: '/newOrganization_index', 
//       component: require('./components/organization/newEstablishment/newOrganization/newOrganization_index.vue').default ,
//       children: [
//         { path: '',name:'slocation_index', component: require('./components/organization/newEstablishment/newOrganization/newOrganization_list.vue').default },
//         { path: '/newOrganization_add', name:'NewOrganizationAdd', component: require('./components/organization/newEstablishment/newOrganization/newOrganization_add.vue').default },
//         { path: '/newOrganization_edit', name:'NewOrganizationEdit', component: require('./components/organization/newEstablishment/newOrganization/newOrganization_edit.vue').default },
//         { path: '/newOrganization_list', name:'NewOrganizationList', component: require('./components/organization/newEstablishment/newOrganization/newOrganization_list.vue').default },
//       ]    
//     },       
//     { path: '/registerOrg_index', 
//       component: require('./components/organization/newEstablishment/registerOrg/registerOrg_index.vue').default ,
//       children: [
//         { path: '',name:'registerOrg_index', component: require('./components/organization/newEstablishment/registerOrg/registerOrg_list.vue').default },
//         { path: '/registerOrg_add', name:'RegisterOrgAdd', component: require('./components/organization/newEstablishment/registerOrg/registerOrg_add.vue').default },
//         { path: '/registerOrg_edit', name:'RegisterOrgEdit', component: require('./components/organization/newEstablishment/registerOrg/registerOrg_edit.vue').default },
//         { path: '/registerOrg_list', name:'RegisterOrgList', component: require('./components/organization/newEstablishment/registerOrg/registerOrg_list.vue').default },
//       ] 
//     }, 		
    
//     { path: '/headQuarter_index', 
//       component: require('./components/organization/newEstablishment/headQuarter/HQ_index.vue').default ,
//       children: [
//         { path: '',name:'HQ_index', component: require('./components/organization/newEstablishment/headQuarter/HQ_list.vue').default },
//         { path: '/HQ_add', name:'HQAdd', component: require('./components/organization/newEstablishment/headQuarter/HQ_add.vue').default },
//         { path: '/HQ_edit', name:'HQEdit', component: require('./components/organization/newEstablishment/headQuarter/HQ_edit.vue').default },
//         { path: '/HQ_list', name:'HQList', component: require('./components/organization/newEstablishment/headQuarter/HQ_list.vue').default },
//       ] 
//     },  
    
//   ] 
// },
];

export default routes