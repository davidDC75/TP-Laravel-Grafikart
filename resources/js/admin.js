import './bootstrap';

import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.css';

import 'htmx.org';

import 'tom-select/dist/css/tom-select.bootstrap5.css';
import TomSelect from "tom-select";

import Alpine from 'alpinejs';

import.meta.glob([
    '../images/**',
    '../fonts/**',
]);

new TomSelect('select', {plugins: {remove_button: {title: 'Supprimer'}}});

window.Alpine = Alpine;

Alpine.start();


