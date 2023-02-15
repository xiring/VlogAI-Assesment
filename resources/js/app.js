import './bootstrap';

import {createApp} from 'vue'
import {createPinia} from "pinia";

import App from './App.vue'
import router from "./router";
import 'element-plus/dist/index.css'
import ElementPlus from 'element-plus'
import Vue3ColorPicker from "vue3-colorpicker";
import "vue3-colorpicker/style.css";


const piniaState = createPinia();
const app = createApp(App);
app.use(router).use(piniaState).use(ElementPlus).use(Vue3ColorPicker);
app.mount("#app");
