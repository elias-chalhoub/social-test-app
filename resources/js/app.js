import { createApp } from 'vue';
import './services/bootstrap';
import Router from './services/router';
import Store from './services/store';

const app = createApp({});

// Components.
import App from './components/App.vue';


app.component('app', App);
app.use(Router).use(Store).mount('#app');
