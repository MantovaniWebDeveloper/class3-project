const $ = require('jquery');

$('#search_address').click(function() {
    let user_address = $('#user_address').val();
    if (user_address !== "" && user_address.trim() !== "") {
        searchAddress($(this), user_address);
    }
});

function searchAddress(element, user_input) {
    let url = 'http://127.0.0.1:8000/api/address/search';
    $.ajax(url, {
        beforeSend: function() {
            element.prop('disabled', true);
        },
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(result) {
            // console.log(result);
            showVie(result);
        },
        error: function(error) {
            console.log(error);
        },
        data: {
            'user_address': user_input
        },
        complete: function() {
            element.prop('disabled', false);
        }
    });
}

function showVie(data) {
    var vie = data.results;
    var elenco = $('#elencovie');
    elenco.empty();
    for (var via of vie) {
        console.log(via);
        elenco.append(
            '<li class="via" data-lat="' + via.lat + '" data-long="' + via.lng + '">' + via.address_name + '</li>'
        );
    }
    $('.via').click(function() {
        showMap($(this).data('lat'), $(this).data('long'));
        $('.via').removeClass('bg-secondary');
        $(this).addClass('bg-secondary');
    })
}

function showMap(lat, long) {
    let url = 'http://127.0.0.1:8000/api/address/search/map';
    $.ajax(url, {

        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(result) {
            console.log(result);
            // showVie(result);
        },
        error: function(error) {
            console.log(error);
        },
        data: {
            'lat': lat,
            'long': long
        },
        complete: function() {
            // element.prop('disabled', false);
        }
    });
}