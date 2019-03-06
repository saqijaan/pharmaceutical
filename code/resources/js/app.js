
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'
Vue.use(VueRouter)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
//
// Vue.component('example-component', require('./components/ExampleComponent.vue'));
// Vue.component('header-component', require('./components/HeaderComponent'));
// Vue.component('ppen-hour-component', require('./components/PpenHourComponent'));
// Vue.component('about-component', require('./components/AboutComponent'));
// Vue.component('meeting-component', require('./components/MeetingComponent'));
// Vue.component('operate-component', require('./components/OperateComponent'));
// Vue.component('meet-doc-component', require('./components/MeetOurDocComponent'));
// Vue.component('focused-on-you-component', require('./components/FocusedOnYouComponent'));
// Vue.component('service-component', require('./components/ServiceComponent'));
// Vue.component('footer-component', require('./components/FooterComponent'));
// Vue.component('mbl-nav-component', require('./components/MobileNavComponent'));

const about = require('./components/AboutComponent');
const index = require('./components/indexComponent');
const dashTopPrt = require('./components/themeDashboard/TopThreePrtComponents');

const routes = [
	{
		path: '/about',
		component: about
	},
	{
		path: '/',
		component: index
	}

];

const router = new VueRouter({
	routes
});

const app = new Vue({
    el: '#pharma',
    router,
    data:{
    	
    }
});
