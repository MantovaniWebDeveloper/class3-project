$(document).ready(function(){
    console.log('ready');
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