$('.off_state, .on_state').click(function () {
    if (!$(this).hasClass('active')) {
        if ($(this).hasClass('off_state')) {
            //rendo visibile un annuncio nei risultati di ricerca
            setApartmentVisibility($(this), true);
        } else if ($(this).hasClass('off_state')) {
            //rendo invisibile un annuncio nei risultati di ricerca
            setApartmentVisibility($(this), false);
        }
    }
});

function setApartmentVisibility(element, visible) {
    let slug = $(element).data('slug');
    let url = 'http://127.0.0.1:8000/api/visibility';
    $.ajax(url, {
        method: 'PATCH',
        success: function (data) {
            console.log(data);
        },
        error: function (a) {
            console.log(a);
        },
        data: {
            visible: visible
        }
    });
}