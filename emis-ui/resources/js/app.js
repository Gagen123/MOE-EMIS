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
            { path: '/',name:'dzongkhag_master', component: require('./components/masters/global_masters/dzongkhag/list_dzongkhag_master.vue').default },
            { path: '/list_dzongkhag',name:'list_dzongkhag', component: require('./components/masters/global_masters/dzongkhag/list_dzongkhag_master.vue').default },
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
        { path: '/mother_tongue_master', 
          component: require('./components/masters/global_masters/mother_tongue/mother_tongue_index.vue').default,
          children:[
            { path: '/',name:'mother_tongue_master', component: require('./components/masters/global_masters/mother_tongue/list_mother_tongue.vue').default },
            { path: '/list_mother_tongue',name:'list_mother_tongue', component: require('./components/masters/global_masters/mother_tongue/list_mother_tongue.vue').default },
            { path: '/create_mother_tongue', name:'create_mother_tongue', component: require('./components/masters/global_masters/mother_tongue/create_mother_tongue.vue').default },
            { path: '/edit_mother_tongue', name:'edit_mother_tongue', component: require('./components/masters/global_masters/mother_tongue/edit_mother_tongue.vue').default },
          ], 
        },
      ]
    },
    { path:'/question_answer_index',
      component: require('./components/questionAnswer/question_answer_index.vue').default, 
      children:[
        { path: '/',name:'question_answer_index', component: require('./components/questionAnswer/question_answer_list.vue').default },
        { path: '/module', 
          component: require('./components/questionAnswer/module/module_index.vue').default,
          children:[
            { path: '/',name:'module', component: require('./components/questionAnswer/module/list_module.vue').default },
            { path: '/list_module',name:'list_module', component: require('./components/questionAnswer/module/list_module.vue').default },
            { path: '/create_module', name:'create_module', component: require('./components/questionAnswer/module/create_module.vue').default },
            { path: '/edit_module', name:'edit_module', component: require('./components/questionAnswer/module/edit_module.vue').default },
          ], 
        },
        { path: '/service', 
          component: require('./components/questionAnswer/service/service_index.vue').default,
          children:[
            { path: '/',name:'service', component: require('./components/questionAnswer/service/list_service.vue').default },
            { path: '/list_service',name:'list_service', component: require('./components/questionAnswer/service/list_service.vue').default },
            { path: '/create_service', name:'create_service', component: require('./components/questionAnswer/service/create_service.vue').default },
            { path: '/edit_service', name:'edit_service', component: require('./components/questionAnswer/service/edit_service.vue').default },
          ], 
        },
        { path: '/question_category', 
          component: require('./components/questionAnswer/category/category_index.vue').default,
          children:[
            { path: '/',name:'question_category', component: require('./components/questionAnswer/category/list_category.vue').default },
            { path: '/list_question_category',name:'list_question_category', component: require('./components/questionAnswer/category/list_category.vue').default },
            { path: '/create_question_category', name:'create_question_category', component: require('./components/questionAnswer/category/create_category.vue').default },
            { path: '/edit_question_category', name:'edit_question_category', component: require('./components/questionAnswer/category/edit_category.vue').default },
          ], 
        },
        { path: '/question', 
          component: require('./components/questionAnswer/question/question_index.vue').default,
          children:[
            { path: '/',name:'question', component: require('./components/questionAnswer/question/list_question.vue').default },
            { path: '/list_question',name:'list_question', component: require('./components/questionAnswer/question/list_question.vue').default },
            { path: '/create_question', name:'create_question', component: require('./components/questionAnswer/question/create_question.vue').default },
            { path: '/edit_question', name:'edit_question', component: require('./components/questionAnswer/question/edit_question.vue').default },
          ], 
        },
        { path: '/answer', 
          component: require('./components/questionAnswer/answer/answer_index.vue').default,
          children:[
            { path: '/',name:'answer', component: require('./components/questionAnswer/answer/list_answer.vue').default },
            { path: '/list_answer',name:'list_answer', component: require('./components/questionAnswer/answer/list_answer.vue').default },
            { path: '/create_answer', name:'create_answer', component: require('./components/questionAnswer/answer/create_answer.vue').default },
            { path: '/edit_answer', name:'edit_answer', component: require('./components/questionAnswer/answer/edit_answer.vue').default },
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
          { path: '',name:'working_agency_master', component: require('./components/masters/staff_masters/working_agency/working_agency_list.vue').default },
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
      { path: '/transfer_undertaking',
        component: require('./components/masters/staff_masters/transfer_undertaking/transfer_undertaking_index.vue').default,
        children:[
          { path: '/',name:'transfer_undertaking', component: require('./components/masters/staff_masters/transfer_undertaking/list_transfer_undertaking.vue').default },
          { path: '/list_transfer_undertaking',name:'list_transfer_undertaking', component: require('./components/masters/staff_masters/transfer_undertaking/list_transfer_undertaking.vue').default },
          { path: '/create_transfer_undertaking',name:'create_transfer_undertaking', component: require('./components/masters/staff_masters/transfer_undertaking/create_transfer_undertaking.vue').default },
          { path: '/edit_transfer_undertaking', name:'edit_transfer_undertaking', component: require('./components/masters/staff_masters/transfer_undertaking/edit_transfer_undertaking.vue').default },
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
        { path: '/qualification_description',
          component: require('./components/masters/staff_masters/qualification_description/qualification_description_index.vue').default, 
          children:[ 
            { path: '/',name:'qualification_description', component: require('./components/masters/staff_masters/qualification_description/list_qualification_description.vue').default },
            { path: '/list_qualification_description',name:'list_qualification_description', component: require('./components/masters/staff_masters/qualification_description/list_qualification_description.vue').default },
            { path: '/create_qualification_description',name:'create_qualification_description', component: require('./components/masters/staff_masters/qualification_description/create_qualification_description.vue').default },
            { path: '/edit_qualification_description', name:'edit_qualification_description', component: require('./components/masters/staff_masters/qualification_description/edit_qualification_description.vue').default },
          ],
        },
        { path: '/course_mode',
          component: require('./components/masters/staff_masters/course_mode/course_mode_index.vue').default, 
          children:[ 
            { path: '/',name:'course_mode', component: require('./components/masters/staff_masters/course_mode/list_course_mode.vue').default },
            { path: '/list_course_mode',name:'list_course_mode', component: require('./components/masters/staff_masters/course_mode/list_course_mode.vue').default },
            { path: '/create_course_mode',name:'create_course_mode', component: require('./components/masters/staff_masters/course_mode/create_course_mode.vue').default },
            { path: '/edit_course_mode', name:'edit_course_mode', component: require('./components/masters/staff_masters/course_mode/edit_course_mode.vue').default },
          ],
        },

      ],
    },

     //HR Developemnt (Training) Masters
    { path: '/traing_master',
      component: require('./components/masters/hr_development_masters/hr_development_index.vue').default,
      children:[
       { path: '/',name:'traing_master', component: require('./components/masters/hr_development_masters/hr_development_list.vue').default },
       
       { path: '/training_type_master',
         component: require('./components/masters/hr_development_masters/training_type/training_type_index.vue').default,
         children:[
           { path: '/',name:'training_type_master', component: require('./components/masters/hr_development_masters/training_type/training_type_list.vue').default },
           { path: '/list_training_type', name:'list_training_type', component: require('./components/masters/hr_development_masters/training_type/training_type_list.vue').default },
           { path: '/create_training_type',name:'create_training_type', component: require('./components/masters/hr_development_masters/training_type/create_training_type.vue').default },
           { path: '/edit_training_type', name:'edit_training_type', component: require('./components/masters/hr_development_masters/training_type/edit_training_type.vue').default },
         ],
       },
       
       { path: '/related_programme',
         component: require('./components/masters/hr_development_masters/related_programme/related_programme_index.vue').default,
         children:[
           { path: '/',name:'related_programme', component: require('./components/masters/hr_development_masters/related_programme/related_programme_list.vue').default },
           { path: '/list_related_programme', name:'list_related_programme', component: require('./components/masters/hr_development_masters/related_programme/related_programme_list.vue').default },
           { path: '/create_related_programme',name:'create_related_programme', component: require('./components/masters/hr_development_masters/related_programme/create_related_programme.vue').default },
           { path: '/edit_related_programme', name:'edit_related_programme', component: require('./components/masters/hr_development_masters/related_programme/edit_related_programme.vue').default },
         ],
       },
       { path: '/programme_level',
         component: require('./components/masters/hr_development_masters/programme_level/programme_level_index.vue').default,
         children:[
           { path: '/',name:'programme_level', component: require('./components/masters/hr_development_masters/programme_level/programme_level_list.vue').default },
           { path: '/list_programme_level', name:'list_programme_level', component: require('./components/masters/hr_development_masters/programme_level/programme_level_list.vue').default },
           { path: '/create_programme_level',name:'create_programme_level', component: require('./components/masters/hr_development_masters/programme_level/create_programme_level.vue').default },
           { path: '/edit_programme_level', name:'edit_programme_level', component: require('./components/masters/hr_development_masters/programme_level/edit_programme_level.vue').default },
         ],
       },
       { path: '/programme_type',
         component: require('./components/masters/hr_development_masters/programme_type/programme_type_index.vue').default,
         children:[
           { path: '/',name:'programme_type', component: require('./components/masters/hr_development_masters/programme_type/programme_type_list.vue').default },
           { path: '/list_programme_type', name:'list_programme_type', component: require('./components/masters/hr_development_masters/programme_type/programme_type_list.vue').default },
           { path: '/create_programme_type',name:'create_programme_type', component: require('./components/masters/hr_development_masters/programme_type/create_programme_type.vue').default },
           { path: '/edit_programme_type', name:'edit_programme_type', component: require('./components/masters/hr_development_masters/programme_type/edit_programme_type.vue').default },
         ],
       },
       { path: '/course_type',
         component: require('./components/masters/hr_development_masters/course_type/course_type_index.vue').default,
         children:[
           { path: '/',name:'course_type', component: require('./components/masters/hr_development_masters/course_type/course_type_list.vue').default },
           { path: '/list_course_type', name:'list_course_type', component: require('./components/masters/hr_development_masters/course_type/course_type_list.vue').default },
           { path: '/create_course_type',name:'create_course_type', component: require('./components/masters/hr_development_masters/course_type/create_course_type.vue').default },
           { path: '/edit_course_type', name:'edit_course_type', component: require('./components/masters/hr_development_masters/course_type/edit_course_type.vue').default },
         ],
       },

       { path: '/financial_source',
         component: require('./components/masters/hr_development_masters/financial_source/financial_source_index.vue').default,
         children:[
           { path: '/',name:'financial_source', component: require('./components/masters/hr_development_masters/financial_source/financial_source_list.vue').default },
           { path: '/list_financial_source', name:'list_financial_source', component: require('./components/masters/hr_development_masters/financial_source/financial_source_list.vue').default },
           { path: '/create_financial_source',name:'create_financial_source', component: require('./components/masters/hr_development_masters/financial_source/create_financial_source.vue').default },
           { path: '/edit_financial_source', name:'edit_financial_source', component: require('./components/masters/hr_development_masters/financial_source/edit_financial_source.vue').default },
         ],
       },
       
       { path: '/category',
         component: require('./components/masters/hr_development_masters/category/category_index.vue').default,
         children:[
           { path: '/',name:'category', component: require('./components/masters/hr_development_masters/category/category_list.vue').default },
           { path: '/list_category', name:'list_category', component: require('./components/masters/hr_development_masters/category/category_list.vue').default },
           { path: '/create_category',name:'create_category', component: require('./components/masters/hr_development_masters/category/create_category.vue').default },
           { path: '/edit_category', name:'edit_category', component: require('./components/masters/hr_development_masters/category/edit_category.vue').default },
         ],
       },
       { path: '/donor_agency',
         component: require('./components/masters/hr_development_masters/donor_agency/donor_agency_index.vue').default,
         children:[
           { path: '/',name:'donor_agency', component: require('./components/masters/hr_development_masters/donor_agency/donor_agency_list.vue').default },
           { path: '/list_donor_agency', name:'list_donor_agency', component: require('./components/masters/hr_development_masters/donor_agency/donor_agency_list.vue').default },
           { path: '/create_donor_agency',name:'create_donor_agency', component: require('./components/masters/hr_development_masters/donor_agency/create_donor_agency.vue').default },
           { path: '/edit_donor_agency', name:'edit_donor_agency', component: require('./components/masters/hr_development_masters/donor_agency/edit_donor_agency.vue').default },
         ],
       },
       { path: '/project_donor_agency', 
         component: require('./components/masters/hr_development_masters/project_donor_agency/project_donor_agency_index.vue').default,
         children:[
           { path: '/',name:'project_donor_agency', component: require('./components/masters/hr_development_masters/project_donor_agency/project_donor_agency_list.vue').default },
           { path: '/list_project_donor_agency', name:'list_project_donor_agency', component: require('./components/masters/hr_development_masters/project_donor_agency/project_donor_agency_list.vue').default },
           { path: '/create_project_donor_agency',name:'create_project_donor_agency', component: require('./components/masters/hr_development_masters/project_donor_agency/create_project_donor_agency.vue').default },
           { path: '/edit_project_donor_agency', name:'edit_project_donor_agency', component: require('./components/masters/hr_development_masters/project_donor_agency/edit_project_donor_agency.vue').default },
         ],
       },
       { path: '/degree',
         component: require('./components/masters/hr_development_masters/degree/degree_index.vue').default,
         children:[
           { path: '/',name:'degree', component: require('./components/masters/hr_development_masters/degree/degree_list.vue').default },
           { path: '/list_degree', name:'list_degree', component: require('./components/masters/hr_development_masters/degree/degree_list.vue').default },
           { path: '/create_degree',name:'create_degree', component: require('./components/masters/hr_development_masters/degree/create_degree.vue').default },
           { path: '/edit_degree', name:'edit_degree', component: require('./components/masters/hr_development_masters/degree/edit_degree.vue').default },
         ],
       },
       { path: '/nature_of_participation',
         component: require('./components/masters/hr_development_masters/nature_of_participation/nature_of_participation_index.vue').default,
         children:[
           { path: '/',name:'nature_of_participation', component: require('./components/masters/hr_development_masters/nature_of_participation/nature_of_participation_list.vue').default },
           { path: '/list_nature_of_participation', name:'list_nature_of_participation', component: require('./components/masters/hr_development_masters/nature_of_participation/nature_of_participation_list.vue').default },
           { path: '/create_nature_of_participation',name:'create_nature_of_participation', component: require('./components/masters/hr_development_masters/nature_of_participation/create_nature_of_participation.vue').default },
           { path: '/edit_nature_of_participation', name:'edit_nature_of_participation', component: require('./components/masters/hr_development_masters/nature_of_participation/edit_nature_of_participation.vue').default },
         ],
       },
       { path: '/target_group',
         component: require('./components/masters/hr_development_masters/target_group/target_group_index.vue').default,
         children:[
           { path: '/',name:'target_group', component: require('./components/masters/hr_development_masters/target_group/target_group_list.vue').default },
           { path: '/list_target_group', name:'list_target_group', component: require('./components/masters/hr_development_masters/target_group/target_group_list.vue').default },
           { path: '/create_target_group',name:'create_target_group', component: require('./components/masters/hr_development_masters/target_group/create_target_group.vue').default },
           { path: '/edit_target_group', name:'edit_target_group', component: require('./components/masters/hr_development_masters/target_group/edit_target_group.vue').default },
         ],
       },
     ]
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
            { path: '/edit_civil_staff',name:'edit_civil_staff',  component: require('./components/staff/civil/edit_civil_staff.vue').default },
            // { path: '/create_civil_staff',name:'create_civil_staff',  component: require('./components/staff/civil/create_staff.vue').default },
          ],
        },

        { path: '/private_staff', 
          component: require('./components/staff/private/private_staff_index.vue').default,
          children:[
            { path: '/',name:'private_staff',  component: require('./components/staff/private/private_staff_list.vue').default },
            { path: '/list_private_staff',name:'list_private_staff',  component: require('./components/staff/private/private_staff_list.vue').default },
            { path: '/create_private_staff',name:'create_private_staff', component: require('./components/staff/private/create_private_staff.vue').default },
            { path: '/edit_private_staff', name:'edit_private_staff', component: require('./components/staff/private/edit_private_staff.vue').default },
          ],
        },
        
        { path: '/transfer_window_index', 
          component: require('./components/staff/transfer_window/transfer_window_index.vue').default,
          children:[
            { path: '/', name:'transfer_window_index',  component: require('./components/staff/transfer_window/transfer_window_list.vue').default },
            { path: '/list_transfer_window',name:'list_transfer_window',  component: require('./components/staff/transfer_window/transfer_window_list.vue').default },
            { path: '/create_transfer_window',name:'create_transfer_window', component: require('./components/staff/transfer_window/create_transfer_window.vue').default },
            { path: '/edit_transfer_window', name:'edit_transfer_window', component: require('./components/staff/transfer_window/edit_transfer_window.vue').default },
          ],
        },
        { path: '/transfer_index', 
          component: require('./components/staff/transfer/transfer_index.vue').default,
          children:[
          { path: '/', name:'transfer_index',  component: require('./components/staff/transfer/transfer_list.vue').default },
          { path: '/list_transfer',name:'list_transfer',  component: require('./components/staff/transfer/transfer_list.vue').default },
          { path: '/create_transfer',name:'create_transfer', component: require('./components/staff/transfer/create_transfer.vue').default },
          { path: '/edit_transfer', name:'edit_transfer', component: require('./components/staff/transfer/edit_transfer.vue').default },
        ],
      },

      ]
    },

    //Staff Training 
    { path:'/create_inset', 
      component: require('./components/staff/training/inset_index.vue').default, 
      children:[
        { path: '/',name:'create_inset', component: require('./components/staff/training/inset_list.vue').default },
        
        { path: '/programme_index', 
          component: require('./components/staff/training/create_programme/programme_index.vue').default, 
          children:[
            { path: '/',name:'programme_index',  component: require('./components/staff/training/create_programme/list_programme.vue').default },
            { path: '/list_programme',name:'list_programme',  component: require('./components/staff/training/create_programme/list_programme.vue').default },
            { path: '/create_training_programme',name:'create_training_programme',  component: require('./components/staff/training/create_programme/create_training_programme.vue').default },
            // { path: '/edit_civil_staff',name:'edit_civil_staff',  component: require('./components/staff/civil/edit_civil_staff.vue').default },
          ],
        },
      ]
    },

    // organization master route
    { path: '/OrganizationMasterIndex', component: require('./components/masters/organization_masters/OrganizationMasterIndex.vue').default,
      children: 
      [
        { path: '/location_index', 
          component: require('./components/masters/organization_masters/location/location_index.vue').default ,
          children: 
          [
            { path: '', component: require('./components/masters/organization_masters/location/location_list.vue').default },
            { path: '/location_add', name:'LocationAdd', component: require('./components/masters/organization_masters/location/location_add.vue').default },
            { path: '/location_edit', name:'LocationEdit', component: require('./components/masters/organization_masters/location/location_edit.vue').default },
            { path: '/location_list', name:'LocationList', component: require('./components/masters/organization_masters/location/location_list.vue').default },
                    
          ]    
        },
        { path: '/disaster_index', 
          component: require('./components/masters/organization_masters/disaster/disaster_index.vue').default ,
          children: 
          [
            { path: '', component: require('./components/masters/organization_masters/disaster/disaster_list.vue').default },
            { path: '/disaster_add', name:'DisasterAdd', component: require('./components/masters/organization_masters/disaster/disaster_add.vue').default },
            { path: '/disaster_edit', name:'DisasterEdit', component: require('./components/masters/organization_masters/disaster/disaster_edit.vue').default },
            { path: '/disaster_list', name:'DisasterList', component: require('./components/masters/organization_masters/disaster/disaster_list.vue').default },
                    
          ]    
        },
        { path: '/level_index', 
          component: require('./components/masters/organization_masters/level/level_index.vue').default ,
          children: 
          [
            { path: '', component: require('./components/masters/organization_masters/level/level_list.vue').default },
            { path: '/level_add', name:'LevelAdd', component: require('./components/masters/organization_masters/level/level_add.vue').default },
            { path: '/level_edit', name:'LevelEdit', component: require('./components/masters/organization_masters/level/level_edit.vue').default },
            { path: '/level_list', name:'LevelList', component: require('./components/masters/organization_masters/level/level_list.vue').default },
                    
          ]    
        },

        { path: '/structure_category_index', 
          component: require('./components/masters/organization_masters/structure_category/structure_category_index.vue').default ,
          children: 
          [
            { path: '', component: require('./components/masters/organization_masters/structure_category/structure_category_list.vue').default },
            { path: '/structure_category_add', name:'StructureCategoryAdd', component: require('./components/masters/organization_masters/structure_category/structure_category_add.vue').default },
            { path: '/structure_category_edit', name:'StructureCategoryEdit', component: require('./components/masters/organization_masters/structure_category/structure_category_edit.vue').default },
            { path: '/structure_category_list', name:'StructureCategoryList', component: require('./components/masters/organization_masters/structure_category/structure_category_list.vue').default },
                    
          ]    
        },
        { path: '/structure_facility_index', 
          component: require('./components/masters/organization_masters/structure_facility/structure_facility_index.vue').default ,
          children:
          [
            { path: '', component: require('./components/masters/organization_masters/structure_facility/structure_facility_list.vue').default },
            { path: '/structure_facility_add', name:'StructureFacilityAdd', component: require('./components/masters/organization_masters/structure_facility/structure_facility_add.vue').default },
            { path: '/structure_facility_edit', name:'StructureFacilityEdit', component: require('./components/masters/organization_masters/structure_facility/structure_facility_edit.vue').default },
            { path: '/structure_facility_list', name:'StructureFacilityList', component: require('./components/masters/organization_masters/structure_facility/structure_facility_list.vue').default },
                    
          ]    
        },

        { path: '/equipment_type_index', 
          component: require('./components/masters/organization_masters/equipment_type/equipment_type_index.vue').default ,
          children:
          [
            { path: '', component: require('./components/masters/organization_masters/equipment_type/equipment_type_list.vue').default },
            { path: '/equipment_type_add', name:'EquipmentTypeAdd', component: require('./components/masters/organization_masters/equipment_type/equipment_type_add.vue').default },
            { path: '/equipment_type_edit', name:'EquipmentTypeEdit', component: require('./components/masters/organization_masters/equipment_type/equipment_type_edit.vue').default },
            { path: '/equipment_type_list', name:'EquipmentTypeList', component: require('./components/masters/organization_masters/equipment_type/equipment_type_list.vue').default },
                    
          ]    
        },

        { path: '/equipment_usage_index', 
          component: require('./components/masters/organization_masters/equipment_usage/equipment_usage_index.vue').default ,
          children: 
          [
            { path: '', component: require('./components/masters/organization_masters/equipment_usage/equipment_usage_list.vue').default },
            { path: '/equipment_usage_add', name:'EquipmentUsageAdd', component: require('./components/masters/organization_masters/equipment_usage/equipment_usage_add.vue').default },
            { path: '/equipment_usage_edit', name:'EquipmentUsageEdit', component: require('./components/masters/organization_masters/equipment_usage/equipment_usage_edit.vue').default },
            { path: '/equipment_usage_list', name:'EquipmentUsageList', component: require('./components/masters/organization_masters/equipment_usage/equipment_usage_list.vue').default },
                    
          ]    
        },

        { path: '/sport_facility_index', 
          component: require('./components/masters/organization_masters/sport_facility/sport_facility_index.vue').default ,
          children: 
          [
            { path: '', component: require('./components/masters/organization_masters/sport_facility/sport_facility_list.vue').default },
            { path: '/sport_facility_add', name:'SportFacilityAdd', component: require('./components/masters/organization_masters/sport_facility/sport_facility_add.vue').default },
            { path: '/sport_facility_edit', name:'SportFacilityEdit', component: require('./components/masters/organization_masters/sport_facility/sport_facility_edit.vue').default },
            { path: '/sport_facility_list', name:'SportFacilityList', component: require('./components/masters/organization_masters/sport_facility/sport_facility_list.vue').default },
                    
          ]    
        },

        { path: '/sport_facility_subtype_index', 
          component: require('./components/masters/organization_masters/sport_facility_subtype/sport_facility_subtype_index.vue').default ,
          children: 
          [
            { path: '', component: require('./components/masters/organization_masters/sport_facility_subtype/sport_facility_subtype_list.vue').default },
            { path: '/sport_facility_subtype_add', name:'SportFacilitySubtypeAdd', component: require('./components/masters/organization_masters/sport_facility_subtype/sport_facility_subtype_add.vue').default },
            { path: '/sport_facility_subtype_edit', name:'SportFacilitySubtypeEdit', component: require('./components/masters/organization_masters/sport_facility_subtype/sport_facility_subtype_edit.vue').default },
            { path: '/sport_facility_subtype_list', name:'SportFacilitySubtypeList', component: require('./components/masters/organization_masters/sport_facility_subtype/sport_facility_subtype_list.vue').default },
                    
          ]    
      },
        { path: '/sport_supporter_index', 
          component: require('./components/masters/organization_masters/sport_supporter/sport_supporter_index.vue').default ,
          children: 
          [
            { path: '', component: require('./components/masters/organization_masters/sport_supporter/sport_supporter_list.vue').default },
            { path: '/sport_supporter_add', name:'SportSupporterAdd', component: require('./components/masters/organization_masters/sport_supporter/sport_supporter_add.vue').default },
            { path: '/sport_supporter_edit', name:'SportSupporterEdit', component: require('./components/masters/organization_masters/sport_supporter/sport_supporter_edit.vue').default },
            { path: '/sport_supporter_list', name:'SportSupporterList', component: require('./components/masters/organization_masters/sport_supporter/sport_supporter_list.vue').default },
                    
          ]    
        },
        { path: '/str_sub_category_index', 
          component: require('./components/masters/organization_masters/str_sub_category/str_sub_category_index.vue').default ,
          children: 
          [
            { path: '', component: require('./components/masters/organization_masters/str_sub_category/str_sub_category_list.vue').default },
            { path: '/str_sub_category_add', name:'StrSubCategoryAdd', component: require('./components/masters/organization_masters/str_sub_category/str_sub_category_add.vue').default },
            { path: '/str_sub_category_edit', name:'StrSubCategoryEdit', component: require('./components/masters/organization_masters/str_sub_category/str_sub_category_edit.vue').default },
            { path: '/str_sub_category_list', name:'StrSubCategoryList', component: require('./components/masters/organization_masters/str_sub_category/str_sub_category_list.vue').default },
          ]    
        },

        { path: '/equipment_item_index', 
          component: require('./components/masters/organization_masters/equipment_item/equipment_item_index.vue').default ,
          children: 
          [
            { path: '', component: require('./components/masters/organization_masters/equipment_item/equipment_item_list.vue').default },
            { path: '/equipment_item_add', name:'EquipmentItemAdd', component: require('./components/masters/organization_masters/equipment_item/equipment_item_add.vue').default },
            { path: '/equipment_item_edit', name:'EquipmentItemEdit', component: require('./components/masters/organization_masters/equipment_item/equipment_item_edit.vue').default },
            { path: '/equipment_item_list', name:'EquipmentItemList', component: require('./components/masters/organization_masters/equipment_item/equipment_item_list.vue').default },
          ]    
        },
        { path: '/class_index', 
          component: require('./components/masters/organization_masters/class/class_index.vue').default ,
          children: 
          [
            { path: '', component: require('./components/masters/organization_masters/class/class_list.vue').default },
            { path: '/class_add', name:'ClassAdd', component: require('./components/masters/organization_masters/class/class_add.vue').default },
            { path: '/class_edit', name:'ClassEdit', component: require('./components/masters/organization_masters/class/class_edit.vue').default },
            { path: '/class_list', name:'ClassList', component: require('./components/masters/organization_masters/class/class_list.vue').default },
          ]    
        },
        { path: '/stream_index', 
          component: require('./components/masters/organization_masters/stream/stream_index.vue').default ,
          children: 
          [
            { path: '', component: require('./components/masters/organization_masters/stream/stream_list.vue').default },
            { path: '/stream_add', name:'StreamAdd', component: require('./components/masters/organization_masters/stream/stream_add.vue').default },
            { path: '/stream_edit', name:'StreamEdit', component: require('./components/masters/organization_masters/stream/stream_edit.vue').default },
            { path: '/stream_list', name:'StreamList', component: require('./components/masters/organization_masters/stream/stream_list.vue').default },
          ]    
        },
        { path: '/contact_type_index', 
          component: require('./components/masters/organization_masters/contact_type/contact_type_index.vue').default ,
          children: 
          [
            { path: '', component: require('./components/masters/organization_masters/contact_type/contact_type_list.vue').default },
            { path: '/contact_type_add', name:'ContactTypeAdd', component: require('./components/masters/organization_masters/contact_type/contact_type_add.vue').default },
            { path: '/contact_type_edit', name:'ContactTypeEdit', component: require('./components/masters/organization_masters/contact_type/contact_type_edit.vue').default },
            { path: '/contact_type_list', name:'ContactTypeList', component: require('./components/masters/organization_masters/contact_type/contact_type_list.vue').default },
          ]    
        },

        { path: '/electricity_source_index', 
          component: require('./components/masters/organization_masters/electricity_source/electricity_source_index.vue').default ,
          children: 
          [
            { path: '', component: require('./components/masters/organization_masters/electricity_source/electricity_source_list.vue').default },
            { path: '/electricity_source_add', name:'ElectricitySourceAdd', component: require('./components/masters/organization_masters/electricity_source/electricity_source_add.vue').default },
            { path: '/electricity_source_edit', name:'ElectricitySourceEdit', component: require('./components/masters/organization_masters/electricity_source/electricity_source_edit.vue').default },
            { path: '/electricity_source_list', name:'ElectricitySourceList', component: require('./components/masters/organization_masters/electricity_source/electricity_source_list.vue').default },
          ]    
        },
        { path: '/electricity_supply_index', 
          component: require('./components/masters/organization_masters/electricity_supply/electricity_supply_index.vue').default ,
          children: 
          [
            { path: '', component: require('./components/masters/organization_masters/electricity_supply/electricity_supply_list.vue').default },
            { path: '/electricity_supply_add', name:'ElectricitySupplyAdd', component: require('./components/masters/organization_masters/electricity_supply/electricity_supply_add.vue').default },
            { path: '/electricity_supply_edit', name:'ElectricitySupplyEdit', component: require('./components/masters/organization_masters/electricity_supply/electricity_supply_edit.vue').default },
            { path: '/electricity_supply_list', name:'ElectricitySupplyList', component: require('./components/masters/organization_masters/electricity_supply/electricity_supply_list.vue').default },
          ]    
        },
        { path: '/road_type_index', 
          component: require('./components/masters/organization_masters/road_type/road_type_index.vue').default ,
          children: 
          [
            { path: '', component: require('./components/masters/organization_masters/road_type/road_type_list.vue').default },
            { path: '/road_type_add', name:'RoadTypeAdd', component: require('./components/masters/organization_masters/road_type/road_type_add.vue').default },
            { path: '/road_type_edit', name:'RoadTypeEdit', component: require('./components/masters/organization_masters/road_type/road_type_edit.vue').default },
            { path: '/road_type_list', name:'RoadTypeList', component: require('./components/masters/organization_masters/road_type/road_type_list.vue').default },
          ]    
        },
        { path: '/service_provider_index', 
          component: require('./components/masters/organization_masters/service_provider/service_provider_index.vue').default ,
          children: 
          [
            { path: '', component: require('./components/masters/organization_masters/service_provider/service_provider_list.vue').default },
            { path: '/service_provider_add', name:'ServiceProviderAdd', component: require('./components/masters/organization_masters/service_provider/service_provider_add.vue').default },
            { path: '/service_provider_edit', name:'ServiceProviderEdit', component: require('./components/masters/organization_masters/service_provider/service_provider_edit.vue').default },
            { path: '/service_provider_list', name:'ServiceProviderList', component: require('./components/masters/organization_masters/service_provider/service_provider_list.vue').default },
          ]    
        },
        { path: '/structure_designer_index', 
          component: require('./components/masters/organization_masters/structure_designer/structure_designer_index.vue').default ,
          children: 
          [
            { path: '', component: require('./components/masters/organization_masters/structure_designer/structure_designer_list.vue').default },
            { path: '/structure_designer_add', name:'StructureDesignerAdd', component: require('./components/masters/organization_masters/structure_designer/structure_designer_add.vue').default },
            { path: '/structure_designer_edit', name:'StructureDesignerEdit', component: require('./components/masters/organization_masters/structure_designer/structure_designer_edit.vue').default },
            { path: '/structure_designer_list', name:'StructureDesignerList', component: require('./components/masters/organization_masters/structure_designer/structure_designer_list.vue').default },
          ]    
        },
        { path: '/attachment_index', 
          component: require('./components/masters/organization_masters/attachment/attachment_index.vue').default ,
          children: 
          [
            { path: '', component: require('./components/masters/organization_masters/attachment/attachment_list.vue').default },
            { path: '/attachment_add', name:'AttachmentAdd', component: require('./components/masters/organization_masters/attachment/attachment_add.vue').default },
            { path: '/attachment_edit', name:'AttachmentEdit', component: require('./components/masters/organization_masters/attachment/attachment_edit.vue').default },
            { path: '/attachment_list', name:'AttachmentList', component: require('./components/masters/organization_masters/attachment/attachment_list.vue').default },
          ]    
        },
      ]  
    },

    //STUDENT MASTER
    { path: '/StudentServicesMasterIndex', component: require('./components/masters/student_masters/StudentServicesIndex.vue').default,
      children: 
      [
        { path: '/student_award_index', 
        component: require('./components/masters/student_masters/awards/student_award_index.vue').default ,
          children: [
            { path: '', component: require('./components/masters/student_masters/awards/student_award_list.vue').default },
            { path: '/student_award_add', name:'StudentAwardAdd', component: require('./components/masters/student_masters/awards/student_award_add.vue').default },
            { path: '/student_award_edit', name:'StudentAwardEdit', component: require('./components/masters/student_masters/awards/student_award_edit.vue').default },
            { path: '/student_award_list', name:'StudentAwardList', component: require('./components/masters/student_masters/awards/student_award_list.vue').default },
          ]    
        },
        { path: '/offence_type_index', 
        component: require('./components/masters/student_masters/disciplinary_record/offence_type_index.vue').default ,
          children: [
            { path: '', component: require('./components/masters/student_masters/disciplinary_record/offence_type_index.vue').default },
            { path: '/offence_type_add', name:'OffenceTypeAdd', component: require('./components/masters/student_masters/disciplinary_record/offence_type_add.vue').default },
            { path: '/offence_type_edit', name:'OffenceTypeEdit', component: require('./components/masters/student_masters/disciplinary_record/offence_type_edit.vue').default },
            { path: '/offence_type_list', name:'OffenceTypeList', component: require('./components/masters/student_masters/disciplinary_record/offence_type_list.vue').default },
          ]    
        },
        { path: '/offence_severity_index', 
        component: require('./components/masters/student_masters/disciplinary_record/offence_severity_index.vue').default ,
          children: [
            { path: '', component: require('./components/masters/student_masters/disciplinary_record/offence_severity_index.vue').default },
            { path: '/offence_severity_add', name:'OffenceSeverityAdd', component: require('./components/masters/student_masters/disciplinary_record/offence_severity_add.vue').default },
            { path: '/offence_severity_edit', name:'OffenceSeverityEdit', component: require('./components/masters/student_masters/disciplinary_record/offence_severity_edit.vue').default },
            { path: '/offence_severity_list', name:'OffenceSeverityList', component: require('./components/masters/student_masters/disciplinary_record/offence_severity_list.vue').default },
          ]    
        },
        { path: '/action_taken_index', 
        component: require('./components/masters/student_masters/disciplinary_record/action_taken_index.vue').default ,
          children: [
            { path: '', component: require('./components/masters/student_masters/disciplinary_record/action_taken_index.vue').default },
            { path: '/action_taken_add', name:'ActionTakenAdd', component: require('./components/masters/student_masters/disciplinary_record/action_taken_add.vue').default },
            { path: '/action_taken_edit', name:'ActionTakenEdit', component: require('./components/masters/student_masters/disciplinary_record/action_taken_edit.vue').default },
            { path: '/action_taken_list', name:'ActionTakenList', component: require('./components/masters/student_masters/disciplinary_record/action_taken_list.vue').default },
          ]    
        },
        { path: '/roles_responsibilities_index', 
        component: require('./components/masters/student_masters/roles_responsibilities/roles_responsibilities_index.vue').default ,
          children: [
            { path: '', component: require('./components/masters/student_masters/roles_responsibilities/roles_responsibilities_index.vue').default },
            { path: '/roles_responsibilities_add', name:'RolesResponsibilitiesAdd', component: require('./components/masters/student_masters/roles_responsibilities/roles_responsibilities_add.vue').default },
            { path: '/roles_responsibilities_edit', name:'RolesResponsibilitiesEdit', component: require('./components/masters/student_masters/roles_responsibilities/roles_responsibilities_edit.vue').default },
            { path: '/roles_responsibilities_list', name:'RolesResponsibilitiesList', component: require('./components/masters/student_masters/roles_responsibilities/roles_responsibilities_list.vue').default },
          ]    
        },
        { path: '/program_name_index', 
        component: require('./components/masters/student_masters/programs_clubs/program_name_index.vue').default ,
          children: [
            { path: '', component: require('./components/masters/student_masters/programs_clubs/program_name_index.vue').default },
            { path: '/program_name_add', name:'ProgramNameAdd', component: require('./components/masters/student_masters/programs_clubs/program_name_add.vue').default },
            { path: '/program_name_edit', name:'ProgramNameEdit', component: require('./components/masters/student_masters/programs_clubs/program_name_edit.vue').default },
            { path: '/program_name_list', name:'ProgramNameList', component: require('./components/masters/student_masters/programs_clubs/program_name_list.vue').default },
          ]    
        },
        { path: '/program_support_index', 
        component: require('./components/masters/student_masters/programs_clubs/program_support_index.vue').default ,
          children: [
            { path: '', component: require('./components/masters/student_masters/programs_clubs/program_support_index.vue').default },
            { path: '/program_support_add', name:'ProgramSupportAdd', component: require('./components/masters/student_masters/programs_clubs/program_support_add.vue').default },
            { path: '/program_support_edit', name:'ProgramSupportEdit', component: require('./components/masters/student_masters/programs_clubs/program_support_edit.vue').default },
            { path: '/program_support_list', name:'ProgramSupportList', component: require('./components/masters/student_masters/programs_clubs/program_support_list.vue').default },
          ]    
        },
        { path: '/program_roles_index', 
        component: require('./components/masters/student_masters/programs_clubs/program_roles_index.vue').default ,
          children: [
            { path: '', component: require('./components/masters/student_masters/programs_clubs/program_roles_index.vue').default },
            { path: '/program_roles_add', name:'ProgramRolesAdd', component: require('./components/masters/student_masters/programs_clubs/program_roles_add.vue').default },
            { path: '/program_roles_edit', name:'ProgramRolesEdit', component: require('./components/masters/student_masters/programs_clubs/program_roles_edit.vue').default },
            { path: '/program_roles_list', name:'ProgramRolesList', component: require('./components/masters/student_masters/programs_clubs/program_roles_list.vue').default },
          ]    
        },
        { path: '/project_type_index', 
        component: require('./components/masters/student_masters/projects_initiatives/project_type_index.vue').default ,
          children: [
            { path: '', component: require('./components/masters/student_masters/projects_initiatives/project_type_index.vue').default },
            { path: '/project_type_add', name:'ProjectTypeAdd', component: require('./components/masters/student_masters/projects_initiatives/project_type_add.vue').default },
            { path: '/project_type_edit', name:'ProjectTypeEdit', component: require('./components/masters/student_masters/projects_initiatives/project_type_edit.vue').default },
            { path: '/project_type_list', name:'ProjectTypeList', component: require('./components/masters/student_masters/projects_initiatives/project_type_list.vue').default },
          ]    
        },
        /*
        //delete after discussing with Aditiya. May not need these routes
        { path: '/project_program_index', 
        component: require('./components/masters/student_masters/projects_initiatives/project_program_index.vue').default ,
          children: [
            { path: '', component: require('./components/masters/student_masters/projects_initiatives/project_program_index.vue').default },
            { path: '/project_program_add', name:'ProjectProgramAdd', component: require('./components/masters/student_masters/projects_initiatives/project_program_add.vue').default },
            { path: '/project_program_edit', name:'ProjectProgramEdit', component: require('./components/masters/student_masters/projects_initiatives/project_program_edit.vue').default },
            { path: '/project_program_list', name:'ProjectProgramList', component: require('./components/masters/student_masters/projects_initiatives/project_program_list.vue').default },
          ]    
        },
        */
      ] 
    },
    
   //STAFF Masters
   { path: '/staff_link',
   component: require('./components/masters/staff_masters/staff_master_index.vue').default,
   children:[
     { path: '/',name:'staff_link', component: require('./components/masters/staff_masters/staff_master_list.vue').default },
     
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
     
   ],
 },

 //ACADEMIC MASTER
 { path: '/academic-link', component: require('./components/masters/academics_masters/academics_master_index.vue').default,
   children: 
   [
     { 
        path: '/', 
        name:'academic-link',
        component: require('./components/masters/academics_masters/academics_master_list.vue').default,
     },
     {  path: '/subject-group-master', component: require('./components/masters/academics_masters/subject_group/subject_group_index.vue').default,
        children: [
          { path: '', component: require('./components/masters/academics_masters/subject_group/list_subject_group.vue').default },
          { path: '/list-subject-group', name: 'list_subject_group', component: require('./components/masters/academics_masters/subject_group/list_subject_group.vue').default },
          { path: '/create-subject-group', name: 'create_subject_group', component: require('./components/masters/academics_masters/subject_group/create_subject_group.vue').default },
          { path: '/edit-subject-group', name: 'edit_subject_group', component: require('./components/masters/academics_masters/subject_group/edit_subject_group.vue').default },
      ],
    },
    {  path: '/subject-master', component: require('./components/masters/academics_masters/subject/subject_index.vue').default,
        children: [
          { path: '', component: require('./components/masters/academics_masters/subject/list_subject.vue').default },
          { path: '/list-subject', name: 'aca_list_subject', component: require('./components/masters/academics_masters/subject/list_subject.vue').default },
          { path: '/create-subject', name: 'aca_create_subject', component: require('./components/masters/academics_masters/subject/create_subject.vue').default },
          { path: '/edit-subject', name: 'aca_edit_subject', component: require('./components/masters/academics_masters/subject/edit_subject.vue').default },
      ],
    },
    {  path: '/assessment-area-master', component: require('./components/masters/academics_masters/assessment_area/assessment_area_index.vue').default,
        children: [
          { path: '', component: require('./components/masters/academics_masters/assessment_area/list_assessment_area.vue').default },
          { path: '/list-assessment-area', name: 'aca_list_assessment_area', component: require('./components/masters/academics_masters/assessment_area/list_assessment_area.vue').default },
          { path: '/create-assessment-area', name: 'aca_create_assessment_area', component: require('./components/masters/academics_masters/assessment_area/create_assessment_area.vue').default },
          { path: '/edit-assessment-area', name: 'aca_edit_assessment_area', component: require('./components/masters/academics_masters/assessment_area/edit_assessment_area.vue').default },
      ],
    },
  ] 
 },

  //Student Services Routes
  { path: '/student_services', component: require('./components/students/StudentServices/index.vue').default,
  children: [
      //Student => Houses
      { path: '/student_houses', component: require('./components/students/StudentServices/Houses/student_houses.vue').default,
          children: [
              { path: '/', component: require('./components/students/StudentServices/Houses/student_houses_list.vue').default },
              { path: '/student_houses_list', component: require('./components/students/StudentServices/Houses/student_houses_list.vue').default },
              { path: '/allocate_student_houses', component: require('./components/students/StudentServices/Houses/allocate_student_houses.vue').default },
              { path: '/edit_student_house', component: require('./components/students/StudentServices/Houses/edit_student_house.vue').default },
          ] 
      },
      //Student => Disciplinary Record
      { path: '/student_disciplinary_record', component: require('./components/students/StudentServices/DisciplinaryRecord/student_disciplinary_record.vue').default,
          children: [
              { path: '/', component: require('./components/students/StudentServices/DisciplinaryRecord/disciplinary_record_list.vue').default },
              { path: '/disciplinary_record', component: require('./components/students/StudentServices/DisciplinaryRecord/disciplinary_record_list.vue').default },
              { path: '/add_disciplinary_record', component: require('./components/students/StudentServices/DisciplinaryRecord/add_disciplinary_record.vue').default },
              { path: '/edit_disciplinary_record', component: require('./components/students/StudentServices/DisciplinaryRecord/edit_disciplinary_record.vue').default },
          ] 
      },
      // Student => Roles and Responsibilities
      { path: '/student_responsibilities', component: require('./components/students/StudentExtraCurricular/Responsibilities/student_responsibilities.vue').default,
          children: [
              { path: '/', component: require('./components/students/StudentExtraCurricular/Responsibilities/student_responsibilities_list.vue').default },
              { path: '/student_responsibilities_list', component: require('./components/students/StudentExtraCurricular/Responsibilities/student_responsibilities_list.vue').default },
              { path: '/add_student_responsibilities', component: require('./components/students/StudentExtraCurricular/Responsibilities/add_student_responsibilities.vue').default },
              { path: '/edit_student_responsibilities', component: require('./components/students/StudentExtraCurricular/Responsibilities/edit_student_responsibilities.vue').default },
          ]    
      },
      //Student => Awards and Achievements
      { path: '/student_awards', component: require('./components/students/StudentExtraCurricular/Awards/student_awards.vue').default,
          children: [
              { path: '/', component: require('./components/students/StudentExtraCurricular/Awards/student_awards_list.vue').default },
              { path: '/student_awards_list', component: require('./components/students/StudentExtraCurricular/Awards/student_awards_list.vue').default },
              { path: '/add_student_awards', component: require('./components/students/StudentExtraCurricular/Awards/add_student_awards.vue').default },
              { path: '/edit_student_awards', component: require('./components/students/StudentExtraCurricular/Awards/edit_student_awards.vue').default },
          ] 
      },
  ] 
},

//Student Programs and Clubs Routes
{ path: '/student_programs_clubs', component: require('./components/students/StudentExtraCurricular/programs_clubs_index.vue').default,
  children: [
      //Student => Programs and Clubs
      { path: '/student_programs', component: require('./components/students/StudentExtraCurricular/Programs/student_programs.vue').default,
          children: [
              { path: '/', component: require('./components/students/StudentExtraCurricular/Programs/student_programs_list.vue').default },
              { path: '/student_programs_list', component: require('./components/students/StudentExtraCurricular/Programs/student_programs_list.vue').default },
              { path: '/add_student_programs', component: require('./components/students/StudentExtraCurricular/Programs/add_student_programs.vue').default },
              { path: '/register_student_programs', component: require('./components/students/StudentExtraCurricular/Programs/register_student_programs.vue').default },
              { path: '/edit_student_programs', component: require('./components/students/StudentExtraCurricular/Programs/edit_student_programs.vue').default },
          ] 
      },
      { path: '/student_programs_members', component: require('./components/students/StudentExtraCurricular/Programs/student_programs_members.vue').default,
          children: [
              { path: '/', component: require('./components/students/StudentExtraCurricular/Programs/student_programs_list.vue').default },
              { path: '/student_programs_members_list', component: require('./components/students/StudentExtraCurricular/Programs/student_programs_members_list.vue').default },
              { path: '/add_student_programs_members', component: require('./components/students/StudentExtraCurricular/Programs/add_student_programs_members.vue').default },
              { path: '/register_student_programs_members', component: require('./components/students/StudentExtraCurricular/Programs/register_student_programs_members.vue').default },
              { path: '/edit_student_programs_members', component: require('./components/students/StudentExtraCurricular/Programs/edit_student_programs_members.vue').default },
          ] 
      },
      { path: '/program_inventory_index', component: require('./components/students/StudentExtraCurricular/Programs/program_inventory_index.vue').default,
          children: [
              { path: '/', component: require('./components/students/StudentExtraCurricular/Programs/program_inventory_list.vue').default },
              { path: '/program_inventory_list', component: require('./components/students/StudentExtraCurricular/Programs/program_inventory_list.vue').default },
              { path: '/program_inventory_add', component: require('./components/students/StudentExtraCurricular/Programs/program_inventory_add.vue').default },
              { path: '/program_inventory_edit', component: require('./components/students/StudentExtraCurricular/Programs/program_inventory_edit.vue').default },
          ] 
      },
      //Student => Projects
      { path: '/student_projects', component: require('./components/students/StudentExtraCurricular/Projects/student_projects.vue').default,
          children: [
              { path: '/', component: require('./components/students/StudentExtraCurricular/Projects/student_projects_list.vue').default },
              { path: '/student_projects_list', component: require('./components/students/StudentExtraCurricular/Projects/student_projects_list.vue').default },
              { path: '/add_student_projects', component: require('./components/students/StudentExtraCurricular/Projects/add_student_projects.vue').default },
              { path: '/edit_student_projects', component: require('./components/students/StudentExtraCurricular/Projects/edit_student_projects.vue').default },
          ] 
      },
      { path: '/student_projects_members', component: require('./components/students/StudentExtraCurricular/Projects/student_projects_members.vue').default,
          children: [
              { path: '/', component: require('./components/students/StudentExtraCurricular/Projects/student_projects_members_list.vue').default },
              { path: '/student_projects_members_list', component: require('./components/students/StudentExtraCurricular/Projects/student_projects_members_list.vue').default },
              { path: '/add_student_projects_members', component: require('./components/students/StudentExtraCurricular/Projects/add_student_projects_members.vue').default },
              { path: '/edit_student_projects_members', component: require('./components/students/StudentExtraCurricular/Projects/edit_student_projects_members.vue').default },
          ] 
      },
  ] 
},

//Student Scouts Routes
{ path: '/student_scouts_index', component: require('./components/students/StudentExtraCurricular/scouts_index.vue').default,
  children: [
      //Student => Scouts
      { path: '/student_scouts', component: require('./components/students/StudentExtraCurricular/Scouts/student_scouts.vue').default,
          children: [
              { path: '/', component: require('./components/students/StudentExtraCurricular/Scouts/student_scouts_list.vue').default },
              { path: '/student_scouts_list', component: require('./components/students/StudentExtraCurricular/Scouts/student_scouts_list.vue').default },
              { path: '/add_student_scouts', component: require('./components/students/StudentExtraCurricular/Scouts/add_student_scouts.vue').default },
              { path: '/edit_student_scouts', component: require('./components/students/StudentExtraCurricular/Scouts/edit_student_scouts.vue').default },
          ] 
      },
      { path: '/student_scouts_members', component: require('./components/students/StudentExtraCurricular/Scouts/student_scouts_members.vue').default,
          children: [
              { path: '/', component: require('./components/students/StudentExtraCurricular/Scouts/student_scouts_members_list.vue').default },
              { path: '/student_scouts_members_list', component: require('./components/students/StudentExtraCurricular/Scouts/student_scouts_members_list.vue').default },
              { path: '/add_student_scouts_members', component: require('./components/students/StudentExtraCurricular/Scouts/add_student_scouts_members.vue').default },
              { path: '/edit_student_scouts_members', component: require('./components/students/StudentExtraCurricular/Scouts/edit_student_scouts_members.vue').default },
          ] 
      },
  ] 
},

//Student Training Routes
{ path: '/student_trainings_index', component: require('./components/students/StudentExtraCurricular/student_trainings_index.vue').default,
  children: [
      //Student => Training, Workshops, Seminars
      { path: '/student_trainings', component: require('./components/students/StudentExtraCurricular/Trainings/student_trainings.vue').default,
          children: [
              { path: '/', component: require('./components/students/StudentExtraCurricular/Trainings/student_trainings_list.vue').default },
              { path: '/student_trainings_list', component: require('./components/students/StudentExtraCurricular/Trainings/student_trainings_list.vue').default },
              { path: '/add_student_trainings', component: require('./components/students/StudentExtraCurricular/Trainings/add_student_trainings.vue').default },
              { path: '/edit_student_trainings', component: require('./components/students/StudentExtraCurricular/Trainings/edit_student_trainings.vue').default },
          ] 
      },
      { path: '/student_trainings_participants', component: require('./components/students/StudentExtraCurricular/Trainings/student_trainings_participants.vue').default,
          children: [
              { path: '/', component: require('./components/students/StudentExtraCurricular/Trainings/student_trainings_participants_list.vue').default },
              { path: '/student_trainings_participants_list', component: require('./components/students/StudentExtraCurricular/Trainings/student_trainings_participants_list.vue').default },
              { path: '/add_student_trainings_participants', component: require('./components/students/StudentExtraCurricular/Trainings/add_student_trainings_participants.vue').default },
              { path: '/edit_student_trainings_participants', component: require('./components/students/StudentExtraCurricular/Trainings/edit_student_trainings_participants.vue').default },
          ] 
      },
  ] 
},

//Student Health
{ path: '/student_health', component: require('./components/students/StudentHealth/index.vue').default,
    children: [
      { path: '/std_health_screening', 
          component: require('./components/students/StudentHealth/HealthScreening/std_health_screening.vue').default,
            children: [
              { path: '/', component: require('./components/students/StudentHealth/HealthScreening/std_health_screening_list.vue').default },
              { path: '/std_health_screening_list', component: require('./components/students/StudentHealth/HealthScreening/std_health_screening_list.vue').default },
              { path: '/std_health_screening_add', component: require('./components/students/StudentHealth/HealthScreening/std_health_screening_add.vue').default },
              { path: '/std_health_screening_edit', component: require('./components/students/StudentHealth/HealthScreening/std_health_screening_edit.vue').default },
            ]    
      },
      // Deworming
      { path: '/std_deworming', 
        component: require('./components/students/StudentHealth/Deworming/std_deworming.vue').default,
          children: [
            { path: '/', component: require('./components/students/StudentHealth/Deworming/std_deworming_list.vue').default },
            { path: '/std_deworming_list', component: require('./components/students/StudentHealth/Deworming/std_deworming_list.vue').default },
            { path: '/std_deworming_add', component: require('./components/students/StudentHealth/Deworming/std_deworming_add.vue').default },
            { path: '/std_deworming_edit', component: require('./components/students/StudentHealth/Deworming/std_deworming_edit.vue').default },
          ]    
      },

      //supplementation
      { path: '/std_supplementation', 
        component: require('./components/students/StudentHealth/Supplementation/std_supplementation.vue').default,
            children: [
            { path: '/', component: require('./components/students/StudentHealth/Supplementation/std_supplementation_list.vue').default },
            { path: '/std_supplementation_list', component: require('./components/students/StudentHealth/Supplementation/std_supplementation_list.vue').default },
            { path: '/std_supplementation_add', component: require('./components/students/StudentHealth/Supplementation/std_supplementation_add.vue').default },
            { path: '/std_supplementation_edit', component: require('./components/students/StudentHealth/Supplementation/std_supplementation_edit.vue').default },
          ] 
      },
      //vaccination
      { path: '/std_vaccination', 
        component: require('./components/students/StudentHealth/Vaccination/std_vaccination.vue').default,
          children: [
            { path: '/', component: require('./components/students/StudentHealth/Vaccination/std_vaccination_list.vue').default },
            { path: '/std_vaccination_list', component: require('./components/students/StudentHealth/Vaccination/std_vaccination_list.vue').default },
            { path: '/std_vaccination_add', component: require('./components/students/StudentHealth/Vaccination/std_vaccination_add.vue').default },
            { path: '/std_vaccination_edit', component: require('./components/students/StudentHealth/Vaccination/std_vaccination_edit.vue').default },
          ] 
      },
      //BMI link
      { path: '/std_bmi', 
        component: require('./components/students/StudentHealth/BMI/std_bmi.vue').default,
          children: [
            { path: '/', component: require('./components/students/StudentHealth/BMI/std_bmi_list.vue').default },
            { path: '/std_bmi_list', component: require('./components/students/StudentHealth/BMI/std_bmi_list.vue').default },
            { path: '/std_bmi_add', component: require('./components/students/StudentHealth/BMI/std_bmi_add.vue').default },
            { path: '/std_bmi_edit', component: require('./components/students/StudentHealth/BMI/std_bmi_edit.vue').default },
          ] 
      },
    ] 
  },

  // organization general information route
  { path: '/general_index', component: require('./components/organization/general/general_index.vue').default,
    children:[
      { path: '/equipment_index', 
      component: require('./components/organization/general/equipment/equipment_index.vue').default ,
        children: [
          { path: '', component: require('./components/organization/general/equipment/equipment_list.vue').default },
          { path: '/equipment_add', name:'EquipmentAdd', component: require('./components/organization/general/equipment/equipment_add.vue').default },
          { path: '/equipment_edit', name:'EquipmentEdit', component: require('./components/organization/general/equipment/equipment_edit.vue').default },
          { path: '/equipment_list', name:'EquipmentList', component: require('./components/organization/general/equipment/equipment_list.vue').default },
        ]    
      },      
      { path: '/locations', name:'locations', component: require('./components/organization/general/locations.vue').default },
      { path: '/sections_add', name:'sections_add', component: require('./components/organization/general/section/sections_add.vue').default },
      { path: '/connectivity', name:'connectivity', component: require('./components/organization/general/connectivity.vue').default },
      { path: '/org_class_mapping', component: require('./components/organization/general/org_class_mapping.vue').default },
    ] 
  },
  
  // organization establishment route
  { path: '/establishment_index', component: require('./components/organization/establishment/establishment_index.vue').default,
    children:[
      { path: '/establishment_index',name:"establishment_index", component: require('./components/organization/establishment/establishment_index_list.vue').default },
      { path: '/establishment',name:"establishment", component: require('./components/organization/establishment/establishment.vue').default },
      { path: '/acknowledgement', name:'acknowledgement', component: require('./components/organization/establishment/acknowledgement.vue').default },
      { path: '/register',name:'register', component: require('./components/organization/establishment/register.vue').default },
      { path: '/school_list',name:"school_list", component: require('./components/organization/establishment/school_list.vue').default },
      { path: '/school_details',  name:'school_details',component: require('./components/organization/establishment/school_details.vue').default },
      { path: '/school_full_details',  name:'school_full_details',component: require('./components/organization/establishment/school_full_details.vue').default },
      { path: '/head_quater_office', component: require('./components/organization/establishment/head_quater_office.vue').default },
      { path: '/list_head_quater_office', component: require('./components/organization/establishment/list_head_quater_office.vue').default },
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
      { path: '/wash',name:'wash', component: require('./components/organization/structuralFacility/wash.vue').default },
      { path: '/structural_index',name:"structural_index", component: require('./components/organization/structuralFacility/structural_index_list.vue').default },
      { path: '/infrastructure_index', 
        component: require('./components/organization/structuralFacility/infrastructure/infrastructure_index.vue').default ,
        children: [
          { path: '', component: require('./components/organization/structuralFacility/infrastructure/infrastructure_list.vue').default },
          { path: '/infrastructure_add', name:'InfrastructureAdd', component: require('./components/organization/structuralFacility/infrastructure/infrastructure_add.vue').default },
          { path: '/infrastructure_edit', name:'InfrastructureEdit', component: require('./components/organization/structuralFacility/infrastructure/infrastructure_edit.vue').default },
          { path: '/infrastructure_list', name:'InfrastructureList', component: require('./components/organization/structuralFacility/infrastructure/infrastructure_list.vue').default },
        ]    
      },
      { path: '/sport_index', 
        component: require('./components/organization/structuralFacility/sport/sport_index.vue').default ,
        children: [
          { path: '', component: require('./components/organization/structuralFacility/sport/sport_list.vue').default },
          { path: '/sport_add', name:'SportAdd', component: require('./components/organization/structuralFacility/sport/sport_add.vue').default },
          { path: '/sport_edit', name:'SportEdit', component: require('./components/organization/structuralFacility/sport/sport_edit.vue').default },
          { path: '/sport_list', name:'SportList', component: require('./components/organization/structuralFacility/sport/sport_list.vue').default },
        ] 
      },
      { path: '/school_feeding', component: require('./components/organization/structuralFacility/school_feeding.vue').default },
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
          { path: '/bifurcation_list', component: require('./components/organization/restructuring/bifurcation/bifurcation_list.vue').default },
          { path: '/bifurcation', name:'BifurcationAdd', component: require('./components/organization/restructuring/bifurcation/bifurcation.vue').default },
        ]    
      }, 
      { path: '/restr_acknowledgement', name:'restr_acknowledgement', component: require('./components/organization/restructuring/acknowledgement.vue').default },
      { path: '/closure_index', 
        component: require('./components/organization/restructuring/closure/closure_index.vue').default ,
        children: [
          { path: '/', component: require('./components/organization/restructuring/closure/closure_list.vue').default },
          { path: '/closure_list',name:'closure_list', component: require('./components/organization/restructuring/closure/closure_list.vue').default },
          { path: '/closure', name:'ClosureAdd', component: require('./components/organization/restructuring/closure/closure.vue').default },
        ]    
      },
      { path: '/wash', component: require('./components/organization/structuralFacility/wash.vue').default },
      { path: '/school_feeding', component: require('./components/organization/structuralFacility/school_feeding.vue').default },

    ] 
  },
// { path: '/subject_assestment', component: require('./components/masters/academics_masters/academics_master_index.vue').default,
//     children: 
//     [
//       { path: '/subject_assestment', name:'subject_assestment', 
//       component: require('./components/masters/academics_masters/subject_assessment_type/subject_assessment_type_index.vue').default ,
//         children: [
//           { path: '', component: require('./components/masters/academics_masters/subject_assessment_type/list_subject_assessment_type.vue').default },
//           { path: '/subject_assessment_type_create', name:'SubjectAssessmentTypeCreate', component: require('./components/masters/academics_masters/subject_assessment_type/create_subject_assessment_type.vue').default },
//           { path: '/subject_assessment_type_edit', name:'SubjectAssessmentTypeEdit', component: require('./components/masters/academics_masters/subject_assessment_type/edit_subject_assessment_type.vue').default },
//           { path: '/subject_assessment_type_list', name:'SubjectAssessmentTypeList', component: require('./components/masters/academics_masters/subject_assessment_type/list_subject_assessment_type.vue').default },
//         ]    
//       },
     
//     ] 
//   },
  { path: '/profile', name:'profile', component: require('./components/common/profile.vue').default },
  { path: '/tasklist', name:'tasklist', component: require('./components/common/taskList.vue').default },
  { path: '/track_application',  name:'track_application',component: require('./components/common/track_application.vue').default },
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