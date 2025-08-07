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
                    url: deleteURL+userId,
                    headers: {
                        'Accept': 'application/json'
                    }
                })
                .done(function(data){
                    window.location.reload();
                })
                .fail(function(data){
                    console.log('AJAX fail data:', data); // <--- kluczowe
                    Swal.fire('Oops...', data.responseJSON?.message, 'error');
                });
            }
        });
    });
});