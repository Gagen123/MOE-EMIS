require('./bootstrap');
window.Vue = require('vue');
import VueRouter from 'vue-router';
import VueCharts from 'vue-chartjs';
import VTooltip from 'v-tooltip';
import vDatepicker from 'vuejs-datepicker';
import moment from 'moment';

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
import commonroutes from "./common_routes";
import moduleRoutes2 from "./globalmasterroutes";
import questionroutes from "./question_routes";
import staff from "./staff_routes";
import organization from "./organization";
import student_routes from "./student_routes";
import academic_routes from "./academic_routes";
import spms_routes from "./spms_routes";
import mess_manage_routes from "./mess_manage_routes";
import projection_indicator_routes from "./projection_indicator_routes";
import dietary from "./dietary";
import approval from "./approval";
import tre from "./tre";


require('./common');
require('./projectionCommon');
require('./staffcommondata');
require('./studentcommondata');

var allRoutes = [];
allRoutes = allRoutes.concat(commonroutes,moduleRoutes2,questionroutes,staff,organization,student_routes,mess_manage_routes,academic_routes,spms_routes,dietary,projection_indicator_routes,approval,tre);
const routes = allRoutes;
const router = new VueRouter({
    routes
});

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
  let _actionType = config.url;
  if (_actionType !== 'common/getNotification') {
    var $body = $("body");
    $body.addClass("request_loading");
  }
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
