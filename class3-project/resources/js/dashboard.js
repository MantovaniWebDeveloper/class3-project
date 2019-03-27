const $ = require('jquery');

//collego listener ai pulsanti visibilità
$('.off_state, .on_state').click(function () {
    manageVisibilityClick($(this));
});

//collego listener al pulsante elimina
$('.delete_button').click(function () {
    let element = $(this).parent();
    element.slideUp(300, function () {
        deleteApartment(element);
    });
});

function manageVisibilityClick(element) {
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

function setApartmentVisibility(element, visibility) {
    let slug = $(element).parent().parent().data('slug');
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
                setState(slug, visibility);
            } else {
                //qualcosa non ha funzionato
                setState(slug, !visibility);
                showMessage('Errore durante la modifica della visibilità');
            }
        },
        error: function () {
            //se c'è un errore ripristino lo stato precedente del pulsante
            setState(slug, !visibility);
            showMessage('Errore durante la modifica della visibilità');
        },
        data: {
            visible: visibility,
            slug: slug
        }
    });
}

function standBy(slug) {
    //disconnetto listener e mostro standby
    let elements = $('[data-slug="' + slug + '"] .mytoggle_state');
    elements.off();
    elements.removeClass('active');
    $('[data-slug="' + slug + '"] .standby_state').addClass('active');
}

function setState(slug, onState) {
    //mostro il nuovo stato e riconnetto listener
    $('[data-slug="' + slug + '"] .mytoggle_state').removeClass('active');
    let onStateElement = $('[data-slug="' + slug + '"] .on_state');
    let offStateElement = $('[data-slug="' + slug + '"] .off_state');
    if (onState) {
        onStateElement.addClass('active');
    } else {
        offStateElement.addClass('active');
    }
    onStateElement.click(function () {
        manageVisibilityClick($(this));
    });
    offStateElement.click(function () {
        manageVisibilityClick($(this));
    });
}

function showMessage(message) {
    let messageElement = $('#message_label');
    messageElement.removeClass('animation_class');
    messageElement.text(message);
    void messageElement.outerWidth();
    messageElement.addClass('animation_class');
}

function deleteApartment(element) {
    let slug = element.data('slug');
    let url = 'http://127.0.0.1:8000/api/apartment/delete';
    $.ajax(url, {
        method: 'DELETE',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            if (data.response == true) {
                element.remove();
            } else {
                element.slideDown();
            }
        },
        error: function (r) {
            console.log(r);
            showMessage('Errore durante la cancellazione dell\'appartamento');
            element.slideDown();
        },
        data: {
            slug: slug
        }
    });
}