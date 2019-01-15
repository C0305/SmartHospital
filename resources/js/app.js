require('./bootstrap');
import Vue from 'vue';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import locale from 'element-ui/lib/locale/lang/en'

import App from './ui/App'
import store from './ui/global/store'
import router from './ui/global/router'

Vue.use(ElementUI, {locale});

const app = new Vue({
    el: '#app',
    render: h => h(App),
    store,
    router
});
