import 'owl.carousel/dist/assets/owl.carousel.css';
import 'owl.carousel/dist/assets/owl.theme.default.css';
import 'owl.carousel';

$('#burgher-menu').on('click', function () {
    console.log('click');
    $('#menu').toggleClass('active');
});

$(".owl-carousel").owlCarousel({
    loop: true,
    margin: 10,
    items: 4,
    nav: true,
    autoWidth:true,
});

