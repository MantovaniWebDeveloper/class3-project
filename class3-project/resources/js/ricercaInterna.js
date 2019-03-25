import Handlebars from 'handlebars/dist/cjs/handlebars';

var $ = require("jquery");
$(document).ready(function () {
    var url = 'http://127.0.0.1:8000/api/cities'

    $.ajax({
        url: url,
        type: 'GET',
        success: function (data) {
            //console.log(data);
            renderDatalistCitta(data);
            collegaListener();
        },
        error: function (errore) {
            console.log(errore);
        }

    });

    //funzione per stampare via handlebars le citta nel datalist
    function renderDatalistCitta(data) {
        var templateBase = $('#elencoCitta-template').html();
        var templateCompilato = Handlebars.compile(templateBase);
        var html = templateCompilato(data);
        $('#listaCitta').html(html);
    }

    function collegaListener() {
        $('.servizio').change(function () {
            leggiValori();
        });
        $('.ordinamento').change(function () {
            leggiValori();
        });

        $('.tipoPrezzo').change(function () {
            leggiValori();
        });
        $('.barra').change(function () {
            leggiValori();
        })

    }

    function leggiValori() {
        var codiceCitta = controllaCitta();
        if (codiceCitta === false) {
            console.log("controllo codice citta non passato - leggi valori");
            return;
        }
        var servizi = [];
        var tipoPrezzi = [];
        var barraKm = $('.barra').val();
        var room_count = $('.selectRoomCount').val();
        var bed_count = $('.selectBedCount').val();

        $.each($("input[name='services']:checked"), function () {
            servizi.push($(this).val());
        });
        //  console.log(servizi);
        var radioValue = $("input[name='order_type']:checked").val();

        $.each($("input[name='price_range']:checked"), function () {
            tipoPrezzi.push($(this).val());
        });
        console.log(tipoPrezzi);

        var data = {
            "city_code": codiceCitta,
            "room_count": room_count,
            "bed_count": bed_count,
            "order_type": radioValue,
            "radius": barraKm
        };
        if (tipoPrezzi.length > 0) {
          var sommaPrezzi = 0;

          for (var i = 0; i < tipoPrezzi.length; i++) {
            sommaPrezzi = sommaPrezzi + parseInt(tipoPrezzi[i]);
          }
            console.log(sommaPrezzi);
            data.price_range = sommaPrezzi;
        }
        if (servizi.length > 0) {
            data.services = servizi;
        }
        console.log(data);
        /*  $.ajax({
            url: url,
            type: 'GET',
            data: {

            },
            success: function(data) {
              var result = JSON.parse(data);
              console.log(result);

            },
            error: function(errore) {
              console.log(errore);
            }
          });*/
    }

    function controllaCitta() {

        var codiceCitta = $("#listaCitta option[value='" + $('#listaCitta-input').val() + "']").attr('data-id');
        console.log("Codice citta: " + codiceCitta);
        if (typeof codiceCitta === 'undefined') {
            console.log("controllo codice citta non passato - funzione interna");
            $('#listaCitta-input').addClass('errore');

            return false;
        }
        return codiceCitta;
    }

    //invio del form che riesce a passare il data-id
    $('#cercaBtn').on('click', function () {
        leggiValori();
    });

});
