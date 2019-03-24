$(document).ready(function(){
    $('#burgher-menu').on('click',function(){
        console.log('click')
        
        $("#menu").toggleClass('active'); 
    })


});
{
    flatpickr("#check-in", {
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
        minDate: "today",
    });

    flatpickr("#check-out", {
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
        minDate: "today",
    });
}