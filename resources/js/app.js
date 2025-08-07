import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';
import $ from 'jquery';
window.$ = $;
window.jQuery = $;
import Swal from 'sweetalert2';
window.Swal = Swal;

// Dodaj token CSRF do każdego żądania AJAX
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
});

// Test działania jQuery
    console.log('jQuery z pliku app.js!');