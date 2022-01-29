

require('./bootstrap');

window.Vue = require('vue').default;

import VueRouter from 'vue-router'

Vue.use(VueRouter)



import {routes} from './routes';

import User from './helpers/User';

window.User = User

import Toastermsg from './helpers/Toastermsg';

window.Toastermsg = Toastermsg

import Noty from './helpers/Noty';

window.Noty = Noty

Vue.component('pagination', require('laravel-vue-pagination'));










window.Reload = new Vue();


const router = new VueRouter({
    routes,
    mode : 'history'
  })


  //sweet alert

  import Swal from 'sweetalert2'
import Vue from 'vue';

  window.Swal = Swal

  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })

  window.Toast = Toast




const app = new Vue({
    el: '#app',
    router
});
