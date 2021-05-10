import Vue from 'vue'
import App from './App.vue'
import './assets/css/main.css'
import { Drag, Drop } from 'vue-drag-drop';
import VueResizeObserver from "vue-resize-observer";
import axios from 'axios';
import VueAxios from 'vue-axios';
Vue.use(VueResizeObserver);
 
Vue.component('drag', Drag);
Vue.component('drop', Drop);

Vue.use(VueAxios, axios);


Vue.config.productionTip = false

new Vue({
  render: h => h(App),
}).$mount('#app')
