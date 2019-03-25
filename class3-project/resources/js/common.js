var $ = require("jquery");
const flatpickr = require("flatpickr");

$(document).ready(function () {
    $('#burgher-menu').on('click', function () {
        console.log('click');
        $('#menu').toggleClass('active');
    });
    flatpickr($('#check-in'), {});
});