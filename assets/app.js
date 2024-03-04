/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */


// any CSS you import will output into a single css file (app.css in this case)
import './bootstrap/bootstrap.min.css';
import './styles/style.css';
import './styles/app.css';

import $ from 'jquery';

import 'select2';

$('select').select2();

let $contactBtn = $('#contact-button')
$contactBtn.on("click", e => {
    e.preventDefault();
    $('#contact-form').slideDown();
    $contactBtn.fadeOut('slow');
});


// start the Stimulus application
import './bootstrap';
