import Vue from 'vue';
import VueRouter from 'vue-router';

import ContactsCreate from './components/views/ContactsCreate';
import ExampleComponent from './components/ExampleComponent';

Vue.use (VueRouter);

export default new VueRouter ({
  routes: [{path: '/', component: ExampleComponent}],
  routes: [{path: '/contacts/create', component: ContactsCreate}],
  mode: 'history',
});
