$('.off_state, .on_state').click(function () {
    //collego listener
    manageClick($(this));
});

function manageClick(element) {
    //ignoro click su elemento attivo
    if (!element.hasClass('active')) {
        if (element.hasClass('off_state')) {
            //nascondo un annuncio nei risultati di ricerca
            setApartmentVisibility(element, 0);
        } else if (element.hasClass('on_state')) {
            //mostro un annuncio nei risultati di ricerca
            setApartmentVisibility(element, 1);
        }
    }
}

function setApartmentVisibility(element, visible) {
    let slug = $(element).data('slug');
    let url = 'http://127.0.0.1:8000/api/apartment/visibility';
    $.ajax(url, {
        beforeSend: function () {
            standBy(slug);
        },
        method: 'PATCH',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (result) {
            //cambio stato pulsante
            if (result) {
                setState(slug, visible);
            }else{
                //qualcosa non ha funzionato
                setState(slug, !visible);
            }
        },
        error: function () {
            //se c'è un errore ripristino lo stato precedente del pulsante
            setState(slug, !visible);
        },
        data: {
            visible: visible,
            slug: slug
        }
    });
}

function standBy(slug) {
    //disconnetto listener e mostro standby
    let elements = $('[data-slug="' + slug + '"]');
    elements.off();
    elements.removeClass('active');
    $('.standby_state[data-slug="' + slug + '"]').addClass('active');
}

function setState(slug, onState) {
    //mostro il nuovo stato e riconnetto listener
    $('[data-slug="' + slug + '"]').removeClass('active');
    let onStateElement = $('.on_state[data-slug="' + slug + '"]');
    let offStateElement = $('.off_state[data-slug="' + slug + '"]');
    if (onState) {
        onStateElement.addClass('active');
    } else {
        offStateElement.addClass('active');
    }
    onStateElement.click(function () {
        manageClick($(this));
    });
    offStateElement.click(function () {
        manageClick($(this));
    });
}