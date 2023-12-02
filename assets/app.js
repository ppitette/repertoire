import './bootstrap.js';
/*
 * assets/app.js
 */

import './styles/app.scss';

import 'bootstrap';

import '@fortawesome/fontawesome-free/js/fontawesome';
import '@fortawesome/fontawesome-free/js/solid';
import '@fortawesome/fontawesome-free/js/regular';
import '@fortawesome/fontawesome-free/js/brands';

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});
