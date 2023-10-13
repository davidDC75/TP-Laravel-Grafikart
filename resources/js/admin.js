import './bootstrap';

import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.css';

import 'htmx.org';

import 'tom-select/dist/css/tom-select.bootstrap5.css';
import TomSelect from "tom-select";

new TomSelect('select', {plugins: {remove_button: {title: 'Supprimer'}}});
