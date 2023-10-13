import './bootstrap';

import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.css';

import Alpine from 'alpinejs';

import.meta.glob([
    '../images/**',
    '../fonts/**',
]);

window.Alpine = Alpine;

Alpine.start();
