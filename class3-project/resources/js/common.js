var $ = require("jquery");
import flatpickr from "flatpickr";

$(document).ready(function() {
    $('#burgher-menu').on('click', function() {
        console.log('click');
        $('#menu').toggleClass('active');
    });
    flatpickr($('.flatpickr'), {});
});