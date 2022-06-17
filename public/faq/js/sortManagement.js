$(document.body).on('click', '.change-position', function (e) {
    let type = $(this).data('type');
    let url = $(this).data('url');
    let row = $(this).closest('tr');

    let currentPosition = $(this).closest('tr').data('index');
    let totalRows = $(this).closest('table').find('tbody tr').length;
    switch (type) {
        case 'up':
            if (currentPosition > 1 )
            {
                row.fadeOut(function () {
                    $(this).insertBefore(row.prev('tr'));
                    row.fadeIn();
                    sendRequest(url);
                });


            }
            break;

        case 'down':
            if (currentPosition < totalRows )
            {
                row.fadeOut(function () {
                    $(this).insertAfter(row.next('tr'));
                    row.fadeIn();
                    sendRequest(url);
                });
            }
            break;
    }
});

let sendRequest = function (url) {
    $.get(url);
}
