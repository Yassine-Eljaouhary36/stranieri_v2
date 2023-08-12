require('./bootstrap');

import { createApp } from 'vue'
// import store from './store';

import MeetingsManager from './components/MeetingsManager'
import AppointmentDetails from './components/AppointmentDetails';
const app = createApp({})

// app.use(store);
app.component('appointment-details', AppointmentDetails);


app.component('meetings-manager', MeetingsManager)
app.mount('#app')
