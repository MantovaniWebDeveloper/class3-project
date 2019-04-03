import Handlebars from 'handlebars/dist/cjs/handlebars';

const $ = require('jquery');
let last_page = 0;
let current_page = 1;
getCities();

function getCities() {
    let url = 'http://127.0.0.1:8000/api/cities';

    $.ajax({
        url: url,
        type: 'GET',
        success: function (data) {
            populateCitiesDataList(data);
            attachListeners();
            leggiValori(false);
        },
        error: function (errore) {
            console.log(errore);
        }
    });
}

//funzione per stampare via handlebars le citta nel datalist
function populateCitiesDataList(data) {
    let template = $('#elencoCitta-template').html();
    let compiledTemplate = Handlebars.compile(template);
    let html = compiledTemplate(data);
    $('#listaCitta').html(html);
}

function controllaCitta() {
    var codiceCitta = $("#listaCitta option[value='" + $('#listaCitta-input').val() + "']").attr('data-id');
    if (typeof codiceCitta === 'undefined') {
        $('#listaCitta-input').addClass('errore');
        return false;
    }
    return codiceCitta;
}

function showResult(data, append) {
    let template = $('#resultAjax-template').html();
    let compiledTemplate = Handlebars.compile(template);
    let html = compiledTemplate(data);
    $('#loading-element').remove();
    if (append) {
        $('.wrap_results_content').append(html);
    } else {
        $('.wrap_results_content').html(html);
    }
}

function addLoading() {
    let template = $('#resultLoading-template').html();
    let compiledTemplate = Handlebars.compile(template);
    let html = compiledTemplate();
    $('.wrap_results_content').append(html);
}

function leggiValori(appendData) {
    let codiceCitta = controllaCitta();
    if (codiceCitta === false) {
        return;
    }
    let servizi = [];
    let tipoPrezzi = [];
    let barraKm = $('.barra').val();
    let room_count = $('#room_count option:selected').val();
    let bed_count = $('#bed_count option:selected').val();

    $.each($("input[name='services']:checked"), function () {
        servizi.push($(this).val());
    });

    let radioValue = $("input[name='order_type']:checked").val();

    $.each($("input[name='price_range']:checked"), function () {
        tipoPrezzi.push($(this).val());
    });

    let data = {
        "city_code": codiceCitta,
        "room_count": room_count,
        "bed_count": bed_count,
        "order_type": radioValue,
        "radius": barraKm
    };
    if (tipoPrezzi.length > 0) {
        let sommaPrezzi = 0;

        for (let i = 0; i < tipoPrezzi.length; i++) {
            sommaPrezzi = sommaPrezzi + parseInt(tipoPrezzi[i]);
        }
        data.price_range = sommaPrezzi;
    }
    if (servizi.length > 0) {
        data.services = servizi;
    }
    search(data, appendData);
}

function search(data, appendData) {
    let url = 'http://127.0.0.1:8000/api/search?page=' + current_page;
    console.log(url);
    $.ajax({
        url: url,
        type: 'GET',
        data: data,
        beforeSend: function () {
            $(".modalLoading").show();
        },
        success: function (result) {
            let parsedData = JSON.parse(result);
            console.log(parsedData);
            $('#result_count').text(parsedData.total);
            if (parsedData.total === 0) {
                $('.wrap_results_content').html('');
                attachScrollbarListener(false);
            } else {
                showResult(parsedData.data, appendData);
                current_page = parsedData.current_page;
                last_page = parsedData.last_page;
                attachScrollbarListener(true);
            }
        },
        error: function (errore) {
            console.log(errore);
        },
        complete: function () {
            $(".modalLoading").hide();
        }
    });
}

function attachListeners() {
    $('.servizio').change(function () {
        performSearch();
    });

    $('.ordinamento').change(function () {
        performSearch();
    });

    $('.tipoPrezzo').change(function () {
        performSearch();
    });

    $('.barra').change(function () {
        performSearch();
    });

    $('#cercaBtn').click(function (e) {
        e.preventDefault();
        performSearch();
    });
}

function performSearch() {
    current_page=1;
    leggiValori(false);
}

function attachScrollbarListener(attach) {
    if (attach) {
        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() === $(document).height()) {
                loadMore();
            }
        });
    } else {
        $(window).off('scroll');
    }
}

function loadMore() {
    attachScrollbarListener(false);
    if (current_page === last_page) {
        // console.log("no loading");
    } else {
        current_page++;
        addLoading();
        leggiValori(true);
    }
}