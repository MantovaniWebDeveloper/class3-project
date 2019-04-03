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

$(document).ready(function(){
  console.log("owl");
  $(".owl-carousel").owlCarousel({
    loop:true,
   margin:10,
   nav:true,
   responsive:{
       0:{
           items:1
       },
       600:{
           items:3
       },
       1000:{
           items:5
       }
   }
  });
});
