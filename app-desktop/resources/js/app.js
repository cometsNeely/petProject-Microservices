import './bootstrap';

import { createApp } from 'vue';
import App from './App.vue'
import Router from './src/router/router.js';
import Store from '@/store/store.js'

createApp(App).use(Router).use(Store).mount('#app');