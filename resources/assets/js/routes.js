import Vue from 'vue'
import Router from 'vue-router'
import Home from './module/home/component/home.vue';
Vue.use(Router);

export default new Router({
  routes: [
    { path: '/', component: Home},
   ]
});