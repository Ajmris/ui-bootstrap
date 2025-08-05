import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';
import $ from 'jquery';
import Swal from 'sweetalert2';

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

        Swal.fire({
            title: "Czy na pewno chcesz usunąć rekord?",
            text: "Nie będziesz mógł przewrócić tego rekordu.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Tak, usuń!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: "DELETE",
                    url: `/users/${userId}`,
                })
                .done(function(data){
                    window.location.reload();
                })
                .fail(function(data){
                    Swal.fire('Oops...', data.responseJSON.message, data.responseJSON.status);
                });
            }
        });
    });
});