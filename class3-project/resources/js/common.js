var $ = require("jquery");


$(document).ready(function(){
    $('#burgher-menu').on('click', function(){
        console.log('click');
        $('#menu').toggleClass('active');
    })
})
