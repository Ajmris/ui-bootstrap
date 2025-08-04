import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';
import $ from 'jquery';
window.$ = window.jQuery = $;
// Dodaj token CSRF do każdego żądania AJAX
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
});
// Test działania jQuery
$(function() {
    console.log('jQuery działa!');
});
// Usuwanie użytkowników
$(function () {
    $('.delete').click(function () {
        const userId = $(this).data("id");

        $.ajax({
            method: "DELETE",
            url: `/users/${userId}`,
        })
        .done(function(response){
            window.location.reload();
        })
        .fail(function(response){
            alert("ERROR");
        });
    });
});