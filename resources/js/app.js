/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import ElementUI from 'element-ui';
import locale from 'element-ui/lib/locale/lang/en'

Vue.use(ElementUI, {locale})

window.events = new Vue()

window.flash = (options) => {
    window.events.$emit('flash', options ) 
}

window.onRecaptcha = (token) => {
    let el = document.getElementById('recaptchaToken') 
    el.value = token;
    document.getElementById(el.dataset.form).submit()
}

window.hotelUrl = (path) => {
    var metaDomain = document.querySelectorAll('meta[name="hotel-domain"]');
    if(metaDomain) return `${window.location.origin}/${metaDomain[0].content}/${path.replace(/^\s*\/*\s*|\s*\/*\s*$/gm, '')}`;

    return window.location.origin +'/'+ path.replace(/^\s*\/*\s*|\s*\/*\s*$/gm, '');
}

window.hotelCurrency = () => {
    var metaDomain = document.querySelectorAll('meta[name="hotel-currency"]');
    if(metaDomain) return metaDomain[0].content;

    return 'GHS';
}

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('flash-box', require('./components/Flash.vue').default);

Vue.component('new-room-category-form', require('./components/house/categories/NewCategoryForm.vue').default);
Vue.component('category-details', require('./components/house/categories/CategoryDetails.js').default);
Vue.component('rooms-table', require('./components/house/reservations/RoomsTable.vue').default);
Vue.component('reservations-form', require('./components/house/reservations/Form.vue').default);
Vue.component('reservation-details', require('./components/house/reservations/ReservationDetails.js').default);

Vue.component('customer-create', require('./components/crm/CustomerCreate.vue').default);
Vue.component('lead-form', require('./components/crm/LeadForm.vue').default);
Vue.component('company-create', require('./components/crm/CompanyCreate.vue').default);
Vue.component('customer-segment', require('./components/crm/CustomerSegment.vue').default);
Vue.component('customer-notes', require('./components/crm/CustomerNotes.vue').default);

//charts
Vue.component('chart-spark-line', require('./components/charts/SparkLine.vue').default);
Vue.component('compare-bar-chart', require('./components/charts/CompareBarChart.vue').default);
Vue.component('reserve-doughnut', require('./components/charts/ReserveDoughnut.vue').default);
Vue.component('customer-acq-chart', require('./components/charts/CustomerAcqChart.vue').default);

//marketing
Vue.component('sms-template-form', require('./components/crm/SmsTemplateForm.vue').default);


// 
// Vue.component('products-list', require('./components/ProductsList.js').default);

// Vue.component('hotel-themes', require('./components/HotelThemes.vue').default);
Vue.component('hotel-general', require('./components/HotelGeneral.js').default);

Vue.component('hotel-users', require('./components/users/HotelUsers.vue').default);
Vue.component('invitation-form', require('./components/users/InvitationForm.vue').default);
Vue.component('invitations-list', require('./components/users/Invitations.js').default);

Vue.component('subscribe-hotel', require('./components/SubscribeHotel.vue').default);
Vue.component('renewal-cards', require('./components/RenewalCards.vue').default);

// Vue.component('select2', require('./components/Select2.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});





