require('./bootstrap');

import { createApp } from 'vue'
// import store from './store';

import MeetingsManager from './components/MeetingsManager'
import CartComponent from './components/CartComponent.vue';
const app = createApp({})

// app.use(store);
app.component('cart-component', CartComponent);


app.component('meetings-manager', MeetingsManager)
app.mount('#app')
