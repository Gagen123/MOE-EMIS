require('./bootstrap');
window.Vue = require('vue');
import VueRouter from 'vue-router';
import VueCharts from 'vue-chartjs';
import VTooltip from 'v-tooltip';
import vDatepicker from 'vuejs-datepicker';
Vue.use(VueRouter);
Vue.use(VTooltip)
//vue select
import vSelect from 'vue-select';
import { Form, HasError, AlertError } from 'vform';
window.form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
Vue.component('v-select', vSelect);
Vue.component('Datepicker', vDatepicker);

import Swal from 'sweetalert2';
window.Swal = Swal
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})
window.Toast = Toast;
window.Fire = new Vue();
const routes = [  
  { path: '/', component: require('./components/common/dashboard.vue').default },
  //Global Masters
  { path:'/global_master',
    component: require('./components/masters/global_masters/global_master_index.vue').default, 
    children:[
      { path: '/',name:'global_master', component: require('./components/masters/global_masters/global_masters_list.vue').default },
      { path: '/nationality_master', 
        component: require('./components/masters/global_masters/nationality/nationality_index.vue').default,
        children:[
          { path: '/',name:'nationality_master', component: require('./components/masters/global_masters/nationality/nationality_list.vue').default },
          { path: '/list_nationality',name:'list_nationality', component: require('./components/masters/global_masters/nationality/nationality_list.vue').default },
          { path: '/create_nationality',name:'create_nationality', component: require('./components/masters/global_masters/nationality/create_nationality.vue').default },
          { path: '/edit_nationality', name:'edit_nationality', component: require('./components/masters/global_masters/nationality/edit_nationality.vue').default },
        ],
      },
      { path: '/dzongkhag_master', 
        component: require('./components/masters/global_masters/dzongkhag/dzongkhag_master.vue').default,
        children:[
          { path: '/',name:'dzongkhag_master', component: require('./components/masters/global_masters/dzongkhag/List_dzongkhag_master.vue').default },
          { path: '/list_dzongkhag',name:'list_dzongkhag', component: require('./components/masters/global_masters/dzongkhag/List_dzongkhag_master.vue').default },
          { path: '/create_dzongkhag', name:'create_dzongkhag', component: require('./components/masters/global_masters/dzongkhag/create_dzongkhag.vue').default },
          { path: '/edit_dzongkhag', name:'edit_dzongkhag', component: require('./components/masters/global_masters/dzongkhag/edit_dzongkhag.vue').default },
        ],
      },
      
      { path: '/gewog_master', 
        component: require('./components/masters/global_masters/gewog/gewog_index.vue').default,
        children:[
          { path: '/',name:'gewog_master', component: require('./components/masters/global_masters/gewog/list_gewog.vue').default },
          { path: '/list_gewog',name:'list_gewog', component: require('./components/masters/global_masters/gewog/list_gewog.vue').default },
          { path: '/create_gewog', name:'create_gewog', component: require('./components/masters/global_masters/gewog/create_gewog.vue').default },
          { path: '/edit_gewog', name:'edit_gewog', component: require('./components/masters/global_masters/gewog/edit_gewog.vue').default },
        ],
      },
      
      { path: '/village_master', 
        component: require('./components/masters/global_masters/village/village_index.vue').default,
        children:[
          { path: '/',name:'village_master', component: require('./components/masters/global_masters/village/list_village.vue').default },
          { path: '/list_village',name:'list_village', component: require('./components/masters/global_masters/village/list_village.vue').default },
          { path: '/create_village', name:'create_village', component: require('./components/masters/global_masters/village/create_village.vue').default },
          { path: '/edit_village', name:'edit_village', component: require('./components/masters/global_masters/village/edit_village.vue').default },
        ],
      },
      
      { path: '/gender_master', 
        component: require('./components/masters/global_masters/gender/gender_index.vue').default,
        children:[
          { path: '/',name:'gender_master', component: require('./components/masters/global_masters/gender/list_gender.vue').default },
          { path: '/list_gender',name:'list_gender', component: require('./components/masters/global_masters/gender/list_gender.vue').default },
          { path: '/create_gender', name:'create_gender', component: require('./components/masters/global_masters/gender/create_gender.vue').default },
          { path: '/edit_gender', name:'edit_gender', component: require('./components/masters/global_masters/gender/edit_gender.vue').default },
        ], 
      },
    ]
  },

  //STAFF Masters
  { path: '/staff_link',
    component: require('./components/masters/staff_masters/staff_master_index.vue').default,
    children:[
      { path: '/',name:'staff_link', component: require('./components/masters/staff_masters/staff_master_list.vue').default },
      { path: '/working_agency_master',
        component: require('./components/masters/staff_masters/working_agency/working_agency.vue').default,
        children:[
          { path: '/',name:'working_agency_master', component: require('./components/masters/staff_masters/working_agency/working_agency_list.vue').default },
          { path: '/List_working_agency', name:'List_working_agency', component: require('./components/masters/staff_masters/working_agency/working_agency_list.vue').default },
          { path: '/create_working_agency',name:'create_working_agency', component: require('./components/masters/staff_masters/working_agency/create_working_agency.vue').default },
          { path: '/edit_workingagency', name:'edit_workingagency', component: require('./components/masters/staff_masters/working_agency/edit_working_agency.vue').default },
        ],
      },
      { path: '/transfer_reason',
        component: require('./components/masters/staff_masters/transfer_reason/transfer_reason.vue').default,
        children:[
          { path: '/',name:'transfer_reason', component: require('./components/masters/staff_masters/transfer_reason/list_transfer_reason.vue').default },
          { path: '/List_transfer_reason',name:'List_transfer_reason', component: require('./components/masters/staff_masters/transfer_reason/list_transfer_reason.vue').default },
          { path: '/create_transfer_reason',name:'create_transfer_reason', component: require('./components/masters/staff_masters/transfer_reason/create_transfer_reason.vue').default },
          { path: '/edit_transfer_reason', name:'edit_transfer_reason', component: require('./components/masters/staff_masters/transfer_reason/edit_transfer_reason.vue').default },
        ],
      },
      
      { path: '/major_group_master',
        component: require('./components/masters/staff_masters/major_group/major_group_index.vue').default,
        children:[
          { path: '/',name:'major_group_master', component: require('./components/masters/staff_masters/major_group/list_major_group.vue').default },
          { path: '/list_major_group',name:'list_major_group', component: require('./components/masters/staff_masters/major_group/list_major_group.vue').default },
          { path: '/create_major_group',name:'create_major_group', component: require('./components/masters/staff_masters/major_group/create_major_group.vue').default },
          { path: '/edit_major_group', name:'edit_major_group', component: require('./components/masters/staff_masters/major_group/edit_major_group.vue').default },
        ],
      },
      
      { path: '/sub_major_group_master',
        component: require('./components/masters/staff_masters/major_sub_group/subgroup_index.vue').default,
        children:[
          { path: '/',name:'sub_major_group_master', component: require('./components/masters/staff_masters/major_sub_group/list_sub_group.vue').default },
          { path: '/list_sub_major_group_master',name:'list_sub_major_group_master', component: require('./components/masters/staff_masters/major_sub_group/list_sub_group.vue').default },
          { path: '/create_sub_major_group_master',name:'create_sub_major_group_master', component: require('./components/masters/staff_masters/major_sub_group/create_sub_group.vue').default },
          { path: '/edit_sub_major_group_master', name:'edit_sub_major_group_master', component: require('./components/masters/staff_masters/major_sub_group/edit_sub_group.vue').default },
        ],
      },
      
      { path: '/position_title_master',
        component: require('./components/masters/staff_masters/position_title/position_title_index.vue').default,
        children:[
          { path: '/',name:'position_title_master', component: require('./components/masters/staff_masters/position_title/list_position_title.vue').default },
          { path: '/list_position_title',name:'list_position_title', component: require('./components/masters/staff_masters/position_title/list_position_title.vue').default },
          { path: '/create_position_title',name:'create_position_title', component: require('./components/masters/staff_masters/position_title/create_position_title.vue').default },
          { path: '/edit_position_title', name:'edit_position_title', component: require('./components/masters/staff_masters/position_title/edit_position_title.vue').default },
        ],
      },

      { path: '/position_level_master',
        component: require('./components/masters/staff_masters/position_level/position_level_index.vue').default,
        children:[
          { path: '/',name:'position_level_master', component: require('./components/masters/staff_masters/position_level/list_position_level.vue').default },
          { path: '/list_position_level_master',name:'list_position_level_master', component: require('./components/masters/staff_masters/position_level/list_position_level.vue').default },
          { path: '/create_position_level_master',name:'create_position_level_master', component: require('./components/masters/staff_masters/position_level/create_position_level.vue').default },
          { path: '/edit_position_level_master', name:'edit_position_level_master', component: require('./components/masters/staff_masters/position_level/edit_position_level.vue').default },
        ],
      },

      { path: '/management_body_designation',
        component: require('./components/masters/staff_masters/mgmn_body_desig/mgmn_designation.vue').default,
        children:[
          { path: '/',name:'management_body_designation', component: require('./components/masters/staff_masters/mgmn_body_desig/list_mgmn_designation.vue').default },
          { path: '/list_mgmn_desig',name:'list_mgmn_desig', component: require('./components/masters/staff_masters/mgmn_body_desig/list_mgmn_designation.vue').default },
          { path: '/create_mgmn_desig',name:'create_mgmn_desig', component: require('./components/masters/staff_masters/mgmn_body_desig/create_mgmn_desig.vue').default },
          { path: '/edit_mgmn_desig', name:'edit_mgmn_desig', component: require('./components/masters/staff_masters/mgmn_body_desig/edit_mgmn_desig.vue').default },
        ],
      },
      
      { path: '/qualification_type',
        component: require('./components/masters/staff_masters/qualification_type/qualification_type_index.vue').default,
        children:[
          { path: '/',name:'qualification_type', component: require('./components/masters/staff_masters/qualification_type/list_qualification_type.vue').default },
          { path: '/list_qualification_type',name:'list_qualification_type', component: require('./components/masters/staff_masters/qualification_type/list_qualification_type.vue').default },
          { path: '/create_qualification_type',name:'create_qualification_type', component: require('./components/masters/staff_masters/qualification_type/create_qualification_type.vue').default },
          { path: '/edit_qualification_type', name:'edit_qualification_type', component: require('./components/masters/staff_masters/qualification_type/edit_qualification_type.vue').default },
        ],
      },
      
      { path: '/qualification_level',
        component: require('./components/masters/staff_masters/qualification_level/qualification_level_index.vue').default,
        children:[
          { path: '/',name:'qualification_level', component: require('./components/masters/staff_masters/qualification_level/list_qualification_level.vue').default },
          { path: '/list_qualification_level',name:'list_qualification_level', component: require('./components/masters/staff_masters/qualification_level/list_qualification_level.vue').default },
          { path: '/create_qualification_level',name:'create_qualification_level', component: require('./components/masters/staff_masters/qualification_level/create_qualification_level.vue').default },
          { path: '/edit_qualification_level', name:'edit_qualification_level', component: require('./components/masters/staff_masters/qualification_level/edit_qualification_level.vue').default },
        ],
      },
      
      { path: '/staff_qualification',
        component: require('./components/masters/staff_masters/staff_qualification/staff_qualification_index.vue').default,
        children:[
          { path: '/',name:'staff_qualification', component: require('./components/masters/staff_masters/staff_qualification/list_staff_qualification.vue').default },
          { path: '/list_staff_qualification',name:'list_staff_qualification', component: require('./components/masters/staff_masters/staff_qualification/list_staff_qualification.vue').default },
          { path: '/create_staff_qualification',name:'create_staff_qualification', component: require('./components/masters/staff_masters/staff_qualification/create_staff_qualification.vue').default },
          { path: '/edit_staff_qualification', name:'edit_staff_qualification', component: require('./components/masters/staff_masters/staff_qualification/edit_staff_qualification.vue').default },
        ],
      },
      
      { path: '/staff_relationship',
        component: require('./components/masters/staff_masters/relationship/relationship_index.vue').default,
        children:[
          { path: '/',name:'staff_relationship', component: require('./components/masters/staff_masters/relationship/list_relationship.vue').default },
          { path: '/list_relationship',name:'list_relationship', component: require('./components/masters/staff_masters/relationship/list_relationship.vue').default },
          { path: '/create_relationship',name:'create_relationship', component: require('./components/masters/staff_masters/relationship/create_relationship.vue').default },
          { path: '/edit_relationship', name:'edit_relationship', component: require('./components/masters/staff_masters/relationship/edit_relationship.vue').default },
        ],
      },
      
      { path: '/marital_status',
        component: require('./components/masters/staff_masters/marital_status/marital_status_index.vue').default, 
        children:[ 
          { path: '/',name:'marital_status', component: require('./components/masters/staff_masters/marital_status/list_marital_status.vue').default },
          { path: '/list_marital_status',name:'list_marital_status', component: require('./components/masters/staff_masters/marital_status/list_marital_status.vue').default },
          { path: '/create_marital_status',name:'create_marital_status', component: require('./components/masters/staff_masters/marital_status/create_marital_status.vue').default },
          { path: '/edit_marital_status', name:'edit_marital_status', component: require('./components/masters/staff_masters/marital_status/edit_marital_status.vue').default },
        ],
      },
      
      { path: '/subject_area_masters',
        component: require('./components/masters/staff_masters/subject_area/subject_area_index.vue').default, 
        children:[ 
          { path: '/',name:'subject_area_masters', component: require('./components/masters/staff_masters/subject_area/list_subject_area.vue').default },
          { path: '/list_subject_area',name:'list_subject_area', component: require('./components/masters/staff_masters/subject_area/list_subject_area.vue').default },
          { path: '/create_subject_area',name:'create_subject_area', component: require('./components/masters/staff_masters/subject_area/create_subject_area.vue').default },
          { path: '/edit_subject_area', name:'edit_subject_area', component: require('./components/masters/staff_masters/subject_area/edit_subject_area.vue').default },
        ],
      },
      { path: '/teaching_subjects',
        component: require('./components/masters/staff_masters/subject/marital_status_index.vue').default, 
        children:[ 
          { path: '/',name:'teaching_subjects', component: require('./components/masters/staff_masters/subject/list_subject.vue').default },
          { path: '/list_subject',name:'list_subject', component: require('./components/masters/staff_masters/subject/list_subject.vue').default },
          { path: '/create_subject',name:'create_subject', component: require('./components/masters/staff_masters/subject/create_subject.vue').default },
          { path: '/edit_subject', name:'edit_subject', component: require('./components/masters/staff_masters/subject/edit_subject.vue').default },
        ],
      },
      { path: '/currier_stage',
        component: require('./components/masters/staff_masters/currier_stage/currier_stage_index.vue').default, 
        children:[ 
          { path: '/',name:'currier_stage', component: require('./components/masters/staff_masters/currier_stage/list_currier_stage.vue').default },
          { path: '/list_currier_stage',name:'list_currier_stage', component: require('./components/masters/staff_masters/currier_stage/list_currier_stage.vue').default },
          { path: '/create_currier_stage',name:'create_currier_stage', component: require('./components/masters/staff_masters/currier_stage/create_currier_stage.vue').default },
          { path: '/edit_currier_stage', name:'edit_currier_stage', component: require('./components/masters/staff_masters/currier_stage/edit_currier_stage.vue').default },
        ],
      }, 
    ],
  },

  //STAFF Transactions 
  { path:'/staff_registration', 
    component: require('./components/staff/index.vue').default, 
    children:[
      { path: '/',name:'staff_registration', component: require('./components/staff/staff_default_page.vue').default },
      { path: '/civil_staff', 
        component: require('./components/staff/civil/civil_index.vue').default,
        children:[
          { path: '/',name:'civil_staff',  component: require('./components/staff/civil/civil_list.vue').default },
          { path: '/list_civil_staff',name:'list_civil_staff',  component: require('./components/staff/civil/civil_list.vue').default },
          { path: '/create_civil_staff',name:'create_civil_staff',  component: require('./components/staff/civil/create_civil_staff.vue').default },
        ],
      },
      { path: '/private_staff', 
        component: require('./components/staff/private/private_staff_index.vue').default,
        children:[
          { path: '/',name:'private_staff',  component: require('./components/staff/private/private_staff_list.vue').default },
          { path: '/create_pricate_staff', component: require('./components/staff/private/create_pricate_staff.vue').default },
        ],
      },
    ]
  },

  // organization master route
  { path: '/OrganizationMasterIndex', component: require('./components/masters/organization_masters/OrganizationMasterIndex.vue').default,
    children: 
    [
      { path: '/location_index', 
        component: require('./components/masters/organization_masters/location_index.vue').default ,
        children: 
        [
          { path: '', component: require('./components/masters/organization_masters/location_list.vue').default },
          { path: '/location_add', name:'LocationAdd', component: require('./components/masters/organization_masters/location_add.vue').default },
          { path: '/location_edit', name:'LocationEdit', component: require('./components/masters/organization_masters/location_edit.vue').default },
          { path: '/location_list', name:'LocationList', component: require('./components/masters/organization_masters/location_list.vue').default },
                  
        ]    
      },
      { path: '/disaster_index', 
        component: require('./components/masters/organization_masters/disaster_index.vue').default ,
        children: 
        [
          { path: '', component: require('./components/masters/organization_masters/disaster_list.vue').default },
          { path: '/disaster_add', name:'DisasterAdd', component: require('./components/masters/organization_masters/disaster_add.vue').default },
          { path: '/disaster_edit', name:'DisasterEdit', component: require('./components/masters/organization_masters/disaster_edit.vue').default },
          { path: '/disaster_list', name:'DisasterList', component: require('./components/masters/organization_masters/disaster_list.vue').default },
                  
        ]    
      },
      { path: '/level_index', 
        component: require('./components/masters/organization_masters/level_index.vue').default ,
        children: 
        [
          { path: '', component: require('./components/masters/organization_masters/level_list.vue').default },
          { path: '/level_add', name:'LevelAdd', component: require('./components/masters/organization_masters/level_add.vue').default },
          { path: '/level_edit', name:'LevelEdit', component: require('./components/masters/organization_masters/level_edit.vue').default },
          { path: '/level_list', name:'LevelList', component: require('./components/masters/organization_masters/level_list.vue').default },
                  
        ]    
      },

      { path: '/structure_category_index', 
        component: require('./components/masters/organization_masters/structure_category_index.vue').default ,
        children: 
        [
          { path: '', component: require('./components/masters/organization_masters/structure_category_list.vue').default },
          { path: '/structure_category_add', name:'StructureCategoryAdd', component: require('./components/masters/organization_masters/structure_category_add.vue').default },
          { path: '/structure_category_edit', name:'StructureCategoryEdit', component: require('./components/masters/organization_masters/structure_category_edit.vue').default },
          { path: '/structure_category_list', name:'StructureCategoryList', component: require('./components/masters/organization_masters/structure_category_list.vue').default },
                  
        ]    
      },
      { path: '/structure_facility_index', 
        component: require('./components/masters/organization_masters/structure_facility_index.vue').default ,
        children:
        [
          { path: '', component: require('./components/masters/organization_masters/structure_facility_list.vue').default },
          { path: '/structure_facility_add', name:'StructureFacilityAdd', component: require('./components/masters/organization_masters/structure_facility_add.vue').default },
          { path: '/structure_facility_edit', name:'StructureFacilityEdit', component: require('./components/masters/organization_masters/structure_facility_edit.vue').default },
          { path: '/structure_facility_list', name:'StructureFacilityList', component: require('./components/masters/organization_masters/structure_facility_list.vue').default },
                  
        ]    
      },

      { path: '/equipment_type_index', 
        component: require('./components/masters/organization_masters/equipment_type_index.vue').default ,
        children:
        [
          { path: '', component: require('./components/masters/organization_masters/equipment_type_list.vue').default },
          { path: '/equipment_type_add', name:'EquipmentTypeAdd', component: require('./components/masters/organization_masters/equipment_type_add.vue').default },
          { path: '/equipment_type_edit', name:'EquipmentTypeEdit', component: require('./components/masters/organization_masters/equipment_type_edit.vue').default },
          { path: '/equipment_type_list', name:'EquipmentTypeList', component: require('./components/masters/organization_masters/equipment_type_list.vue').default },
                  
        ]    
      },

      { path: '/equipment_usage_index', 
        component: require('./components/masters/organization_masters/equipment_usage_index.vue').default ,
        children: 
        [
          { path: '', component: require('./components/masters/organization_masters/equipment_usage_list.vue').default },
          { path: '/equipment_usage_add', name:'EquipmentUsageAdd', component: require('./components/masters/organization_masters/equipment_usage_add.vue').default },
          { path: '/equipment_usage_edit', name:'EquipmentUsageEdit', component: require('./components/masters/organization_masters/equipment_usage_edit.vue').default },
          { path: '/equipment_usage_list', name:'EquipmentUsageList', component: require('./components/masters/organization_masters/equipment_usage_list.vue').default },
                  
        ]    
      },

      { path: '/sport_facility_index', 
        component: require('./components/masters/organization_masters/sport_facility_index.vue').default ,
        children: 
        [
          { path: '', component: require('./components/masters/organization_masters/sport_facility_list.vue').default },
          { path: '/sport_facility_add', name:'SportFacilityAdd', component: require('./components/masters/organization_masters/sport_facility_add.vue').default },
          { path: '/sport_facility_edit', name:'SportFacilityEdit', component: require('./components/masters/organization_masters/sport_facility_edit.vue').default },
          { path: '/sport_facility_list', name:'SportFacilityList', component: require('./components/masters/organization_masters/sport_facility_list.vue').default },
                  
        ]    
      },
      { path: '/sport_supporter_index', 
        component: require('./components/masters/organization_masters/sport_supporter_index.vue').default ,
        children: 
        [
          { path: '', component: require('./components/masters/organization_masters/sport_supporter_list.vue').default },
          { path: '/sport_supporter_add', name:'SportSupporterAdd', component: require('./components/masters/organization_masters/sport_supporter_add.vue').default },
          { path: '/sport_supporter_edit', name:'SportSupporterEdit', component: require('./components/masters/organization_masters/sport_supporter_edit.vue').default },
          { path: '/sport_supporter_list', name:'SportSupporterList', component: require('./components/masters/organization_masters/sport_supporter_list.vue').default },
                  
        ]    
      },
      { path: '/str_sub_category_index', 
        component: require('./components/masters/organization_masters/str_sub_category_index.vue').default ,
        children: 
        [
          { path: '', component: require('./components/masters/organization_masters/str_sub_category_list.vue').default },
          { path: '/str_sub_category_add', name:'StrSubCategoryAdd', component: require('./components/masters/organization_masters/str_sub_category_add.vue').default },
          { path: '/str_sub_category_edit', name:'StrSubCategoryEdit', component: require('./components/masters/organization_masters/str_sub_category_edit.vue').default },
          { path: '/str_sub_category_list', name:'StrSubCategoryList', component: require('./components/masters/organization_masters/str_sub_category_list.vue').default },
        ]    
      },

      { path: '/equipment_item_index', 
        component: require('./components/masters/organization_masters/equipment_item_index.vue').default ,
        children: 
        [
          { path: '', component: require('./components/masters/organization_masters/equipment_item_list.vue').default },
          { path: '/equipment_item_add', name:'EquipmentItemAdd', component: require('./components/masters/organization_masters/equipment_item_add.vue').default },
          { path: '/equipment_item_edit', name:'EquipmentItemEdit', component: require('./components/masters/organization_masters/equipment_item_edit.vue').default },
          { path: '/equipment_item_list', name:'EquipmentItemList', component: require('./components/masters/organization_masters/equipment_item_list.vue').default },
        ]    
      },
      { path: '/class_index', 
        component: require('./components/masters/organization_masters/class_index.vue').default ,
        children: 
        [
          { path: '', component: require('./components/masters/organization_masters/class_list.vue').default },
          { path: '/class_add', name:'ClassAdd', component: require('./components/masters/organization_masters/class_add.vue').default },
          { path: '/class_edit', name:'ClassEdit', component: require('./components/masters/organization_masters/class_edit.vue').default },
          { path: '/class_list', name:'ClassList', component: require('./components/masters/organization_masters/class_list.vue').default },
        ]    
      },
      { path: '/stream_index', 
        component: require('./components/masters/organization_masters/stream_index.vue').default ,
        children: 
        [
          { path: '', component: require('./components/masters/organization_masters/stream_list.vue').default },
          { path: '/stream_add', name:'StreamAdd', component: require('./components/masters/organization_masters/stream_add.vue').default },
          { path: '/stream_edit', name:'StreamEdit', component: require('./components/masters/organization_masters/stream_edit.vue').default },
          { path: '/stream_list', name:'StreamList', component: require('./components/masters/organization_masters/stream_list.vue').default },
        ]    
      },
    ]  
  },
  //STUDET MASTER
  { path: '/StudentMasterIndex', component: require('./components/masters/student_masters/StudentMasterIndex.vue').default,
    children: 
    [
      { path: '/studenthealth_index', 
      component: require('./components/masters/student_masters/studenthealth_index.vue').default ,
        children: [
          { path: '', component: require('./components/masters/student_masters/studenthealth_list.vue').default },
          { path: '/studenthealth_add', name:'StudentHealthAdd', component: require('./components/masters/student_masters/studenthealth_add.vue').default },
          { path: '/studenthealth_edit', name:'StudentHealthEdit', component: require('./components/masters/student_masters/studenthealth_edit.vue').default },
          { path: '/studenthealth_list', name:'StudentHealthList', component: require('./components/masters/student_masters/studenthealth_list.vue').default },
        ]    
      },
      { path: '/health_screening_index', 
      component: require('./components/masters/student_masters/health_screening_index.vue').default ,
        children: [
          { path: '', component: require('./components/masters/student_masters/health_screening_list.vue').default },
          { path: '/health_screening_add', name:'ScreeningAdd', component: require('./components/masters/student_masters/health_screening_add.vue').default },
          { path: '/health_screening_edit', name:'ScreeningEdit', component: require('./components/masters/student_masters/health_screening_edit.vue').default },
          { path: '/health_screening_list', name:'ScreeningList', component: require('./components/masters/student_masters/health_screening_list.vue').default },
        ]    
      },
      { path: '/term_index', 
       component: require('./components/masters/student_masters/term_index.vue').default ,
       children:  [
         { path: '', component: require('./components/masters/student_masters/term_list.vue').default },
         { path: '/term_add', name:'TermAdd', component: require('./components/masters/student_masters/term_add.vue').default },
         { path: '/term_edit', name:'TermEdit', component: require('./components/masters/student_masters/term_edit.vue').default },
         { path: '/term_list', name:'TermList', component: require('./components/masters/student_masters/term_list.vue').default },
        ]    
      },
    ] 
  },

  // organization general information route
  { path: '/general_index', component: require('./components/organization/general/general_index.vue').default,
    children:[
      { path: '/equipment_index', 
      component: require('./components/organization/general/equipment_index.vue').default ,
        children: [
          { path: '', component: require('./components/organization/general/equipment_list.vue').default },
          { path: '/equipment_add', name:'EquipmentAdd', component: require('./components/organization/general/equipment_add.vue').default },
          { path: '/equipment_edit', name:'EquipmentEdit', component: require('./components/organization/general/equipment_edit.vue').default },
          { path: '/equipment_list', name:'EquipmentList', component: require('./components/organization/general/equipment_list.vue').default },
        ]    
      },
      { path: '/locations',  component: require('./components/organization/general/locations.vue').default },
      { path: '/sections_add',component: require('./components/organization/general/sections_add.vue').default },
      { path: '/connectivity', component: require('./components/organization/general/connectivity.vue').default },
    ] 
  },

  // organization structural facility route

  { path: '/structural_index', component: require('./components/organization/structuralFacility/structural_index.vue').default,
    children:[
      { path: '/infrastructure_index', 
      component: require('./components/organization/structuralFacility/infrastructure_index.vue').default ,
        children: [
          { path: '', component: require('./components/organization/structuralFacility/infrastructure_list.vue').default },
          { path: '/infrastructure_add', name:'InfrastructureAdd', component: require('./components/organization/structuralFacility/infrastructure_add.vue').default },
          { path: '/infrastructure_edit', name:'InfrastructureEdit', component: require('./components/organization/structuralFacility/infrastructure_edit.vue').default },
          { path: '/infrastructure_list', name:'InfrastructureList', component: require('./components/organization/structuralFacility/infrastructure_list.vue').default },
        ]    
      },
      { path: '/sport_index', 
      component: require('./components/organization/structuralFacility/sport_index.vue').default ,
        children: [
          { path: '', component: require('./components/organization/structuralFacility/sport_list.vue').default },
          { path: '/sport_add', name:'SportAdd', component: require('./components/organization/structuralFacility/sport_add.vue').default },
          { path: '/sport_edit', name:'SportEdit', component: require('./components/organization/structuralFacility/sport_edit.vue').default },
          { path: '/sport_list', name:'SportList', component: require('./components/organization/structuralFacility/sport_list.vue').default },
        ]    
      },
      // { path: '/connectivity', component: require('./components/organization/general/connectivity.vue').default },
    ] 
  },

  // organization establishment route
  { path: '/establishment_index', component: require('./components/organization/establishment/establishment_index.vue').default,
  children:[
   
    { path: '/establishment', component: require('./components/organization/establishment/establishment.vue').default },
  ] 
},

 // organization restructuring route
 { path: '/restructuring_index', component: require('./components/organization/restructuring/restructuring_index.vue').default,
 children:[
  { path: '/change_basic_details', component: require('./components/organization/restructuring/change_basic_details.vue').default },
  { path: '/merger', component: require('./components/organization/restructuring/merger.vue').default },

  { path: '/bifurcation_index', 
  component: require('./components/organization/restructuring/bifurcation_index.vue').default ,
      children: [
          { path: '/', component: require('./components/organization/restructuring/bifurcation_list.vue').default },
          { path: '/bifurcation_list', component: require('./components/organization/restructuring/bifurcation_list.vue').default },
          { path: '/bifurcation', component: require('./components/organization/restructuring/bifurcation.vue').default },
      ]    
  },

  { path: '/closure_index', 
  component: require('./components/organization/restructuring/closure_index.vue').default ,
      children: [
          { path: '/', component: require('./components/organization/restructuring/closure_list.vue').default },
          { path: '/closure_list', component: require('./components/organization/restructuring/closure_list.vue').default },
          { path: '/closure', component: require('./components/organization/restructuring/closure.vue').default },
      ]    
  },
] 
},
]
const router = new VueRouter({
    routes 
})



router.beforeEach((to, from, next) => {
  if ($("body").hasClass("request_loading"))
      $("body").removeClass("request_loading");
  if (to.meta.middleware){
    const middleware = Array.isArray(to.meta.middleware) ? to.meta.middleware : [to.meta.middleware];
    const context = { from, next, router, to};
    const nextMiddleware = nextFactory(context, middleware, 1);
    return middleware[0] ({...context, next: nextMiddleware });
  }
  return next();
});

var numberOfAjaxCAllPending = 0;

// Add a request interceptor
axios.interceptors.request.use(function (config) {
  numberOfAjaxCAllPending++;

  var $body = $("body");
  $body.addClass("request_loading");
  return config;
}, function (error) {
  return Promise.reject(error);
});

// Add a response interceptor
axios.interceptors.response.use(function (response) {
  numberOfAjaxCAllPending--;

  if (numberOfAjaxCAllPending == 0) {
      var $body = $("body");
      $body.removeClass("request_loading");
  }
  return response;
}, function (error) { 
  numberOfAjaxCAllPending--;
  if (numberOfAjaxCAllPending == 0) {
      var $body = $("body");
      $body.removeClass("request_loading");
  }
  return Promise.reject(error);
});
const app = new Vue({
    el: '#app',
    router,
});