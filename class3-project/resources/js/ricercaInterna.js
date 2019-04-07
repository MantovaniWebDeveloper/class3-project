import Handlebars from 'handlebars/dist/cjs/handlebars';

(function () {
    let current_page = 1;
    let last_page = 1;
    const CITIES_URL = 'http://127.0.0.1:8000/api/cities';
    const SEARCH_URL = 'http://127.0.0.1:8000/api/search?page=';
    getCities();

    function getCities() {
        $.ajax({
            url: CITIES_URL,
            type: 'GET',
            success: function (data) {
                populateCitiesDataList(data);
                //attaching listener for search options
                attachListeners();
                readSearchValues(false);
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

    function showResult(apartments_data, promotion_data, append) {
        let promoTemplate = $('#resultAjax-promo-template').html();
        let stdTemplate = $('#resultAjax-template').html();
        let compiledPromoTemplate = Handlebars.compile(promoTemplate);
        let compiledStdTemplate = Handlebars.compile(stdTemplate);
        let promoHtml = compiledPromoTemplate(promotion_data);
        let stdHtml = compiledStdTemplate(apartments_data);
        $('#loading-element').remove();
        if (append) {
            $('.wrap_results_content').append(promoHtml);
        } else {
            $('.wrap_results_content').html(promoHtml);
        }
        $('.wrap_results_content').append(stdHtml);
    }

    function showMoreItemsLoading() {
        let template = $('#resultLoading-template').html();
        let compiledTemplate = Handlebars.compile(template);
        let html = compiledTemplate();
        $('.wrap_results_content').append(html);
    }

    function readSearchValues(appendData) {
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
        search(data, appendData);
    }

    function search(data, appendData) {
        $.ajax({
            url: SEARCH_URL + current_page,
            type: 'GET',
            data: data,
            beforeSend: function () {
                if (current_page === 1) {
                    $(".modalLoading").show();
                }
            },
            success: function (response) {
                console.log(response);
                $('#result_count').text(response.paginated_results.total);
                if (response.paginated_results.total === 0) {
                    $('.wrap_results_content').html('');
                    attachScrollbarListener(false);
                } else {
                    showResult(response.paginated_results.data, response.promo_apartments, appendData);
                    current_page = response.paginated_results.current_page;
                    last_page = response.paginated_results.last_page;
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
        current_page = 1;
        readSearchValues(false);
    }

    function attachScrollbarListener(attach) {
        if (attach) {
            $(window).scroll(function () {
                if ($(window).scrollTop() + $(window).height() === $(document).height()) {
                    attachScrollbarListener(false);
                    loadMore();
                }
            });
        } else {
            $(window).off('scroll');
        }
    }

    function loadMore() {
        if (current_page !== last_page) {
            current_page++;
            showMoreItemsLoading();
            readSearchValues(true);
        }
    }
})();

