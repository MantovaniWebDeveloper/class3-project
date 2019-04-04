import 'owl.carousel/dist/assets/owl.carousel.css';
import 'owl.carousel/dist/assets/owl.theme.default.css';
import 'owl.carousel';

$('#burgher-menu').on('click', function() {
    console.log('click');
    $('#menu').toggleClass('active');
});
$('#contact').on('click', function() {
    $('#message').toggleClass('hidden');
});

$('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    autoWidth: false,
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
