const $ = require('jquery');

$('#search_address').click(function () {
    let user_address = $('#user_address').val();
    if (user_address !== "" && user_address.trim() !== "") {
        searchAddress($(this), user_address);
    }
});

function searchAddress(element, user_input) {
    let url = 'http://127.0.0.1:8000/api/address/search';
    $.ajax(url, {
        beforeSend: function () {
            element.prop('disabled', true);
        },
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (result) {
            console.log(result);
        },
        error: function (error) {
            console.log(error);
        },
        data: {
            'user_address': user_input
        },
        complete:function () {
            element.prop('disabled', false);
        }
    });
}
