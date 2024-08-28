require('./bootstrap');

import $ from 'jquery';
window.$ = window.jQuery = $;

import 'jquery-ui/ui/widgets/datepicker.js';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
