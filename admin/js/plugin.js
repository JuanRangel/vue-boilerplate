
import Vue from 'vue';
import axios from 'axios';

window.axios = axios;

Vue.component('Example', require('./components/SliderSettingsForm.vue'));

window.onload = function() {

    const app = new Vue({
        el: '#plugin-el'
    });

}
