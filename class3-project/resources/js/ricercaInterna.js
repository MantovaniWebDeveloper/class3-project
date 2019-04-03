import Handlebars from 'handlebars/dist/cjs/handlebars';
const $ = require('jquery');

getCities();

//entry point after page is loaded
function getCities() {
    let url = 'http://127.0.0.1:8000/api/cities';

    $.ajax({
        url: url,
        type: 'GET',
        success: function (data) {
            populateCitiesDataList(data);
            //attaching listener for search options
            attachListeners();
            const STARTING_PAGE = 1;
            readSearchValues(false, STARTING_PAGE);
        },
        error: function (errore) {
            console.log(errore);
        }
    });
}

//populate datalist with cities data
function populateCitiesDataList(data) {
    let template = $('#elencoCitta-template').html();
    let compiledTemplate = Handlebars.compile(template);
    let html = compiledTemplate(data);
    $('#listaCitta').html(html);
}

function checkCityField() {
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

function showMoreItemsLoading() {
    let template = $('#resultLoading-template').html();
    let compiledTemplate = Handlebars.compile(template);
    let html = compiledTemplate();
    $('.wrap_results_content').append(html);
}

function readSearchValues(appendData, currentPage) {
    let cityCode = checkCityField();
    if (cityCode === false) {
        return;
    }
    let servizi = [];
    let priceRange = [];
    let barraKm = $('.barra').val();
    let room_count = $('#room_count option:selected').val();
    let bed_count = $('#bed_count option:selected').val();

    $.each($("input[name='services']:checked"), function () {
        servizi.push($(this).val());
    });

    let radioValue = $("input[name='order_type']:checked").val();

    $.each($("input[name='price_range']:checked"), function () {
        priceRange.push($(this).val());
    });

    let data = {
        "city_code": cityCode,
        "room_count": room_count,
        "bed_count": bed_count,
        "order_type": radioValue,
        "radius": barraKm
    };
    if (priceRange.length > 0) {
        let sommaPrezzi = 0;

        for (let i = 0; i < priceRange.length; i++) {
            sommaPrezzi = sommaPrezzi + parseInt(priceRange[i]);
        }
        data.price_range = sommaPrezzi;
    }
    if (servizi.length > 0) {
        data.services = servizi;
    }
    search(data, appendData, currentPage);
}

function search(data, appendData, current_page) {
    let url = 'http://127.0.0.1:8000/api/search?page=' + current_page;
    let last_page = 1;
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
                attachScrollbarListener(true, current_page, last_page);
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
    // current_page=1;
    readSearchValues(false, 1);
}

function attachScrollbarListener(attach, current_page, last_page) {
    if (attach) {
        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() === $(document).height()) {
                attachScrollbarListener(false);
                loadMore(current_page, last_page);
            }
        });
    } else {
        $(window).off('scroll');
    }
}

function loadMore(current_page, last_page) {
    if (current_page !== last_page) {
        current_page++;
        showMoreItemsLoading();
        readSearchValues(true, current_page);
    }
}
