import _ from 'lodash';
window._ = _;

import jQuery from 'jquery';
window.$ = window.jQuery = jQuery;

import 'bootstrap';

//window.vue = require('vue');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.headers.common['Accept'] = 'application/json';
axios.defaults.withCredentials = true;

axios.interceptors.response.use(function(response) {
    return response;
}, function(error) {
    if (error.response.status && error.response.status == 401) {
        window.location.hash = 'login';
    }
    return Promise.reject(error);
});
window.axios = axios;
