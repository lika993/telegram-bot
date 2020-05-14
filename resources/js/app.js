import Vue from 'vue';
import App from './App.vue';
import VueRouter from 'vue-router';
import router from './router';
import axios from 'axios';
import VueAxios from 'vue-axios';
import Fragment from 'vue-fragment';
Vue.use(Fragment.Plugin);

Vue.use(VueAxios, axios);

Vue.router = router
axios.defaults.baseURL = '/api/';
let vm = new Vue({

    el: '#app',
    data(){
        return {
           
        }},
         router,
		render(h) {
		    return h(App, {
		        props: {
		           
		        }
		    })
		}
	});

