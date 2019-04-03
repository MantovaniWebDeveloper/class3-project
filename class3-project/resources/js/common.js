var $ = require("jquery");
import flatpickr from "flatpickr";


$('#burgher-menu').on('click', function() {
    console.log('click');
    $('#menu').toggleClass('active');
});
var show_date = flatpickr($('.flatpickr'), {
    clickOpens: true,
    dateFormat: "d-m-Y",
});


});
