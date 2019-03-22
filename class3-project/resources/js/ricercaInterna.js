import Handlebars from 'handlebars/dist/cjs/handlebars';

var $ = require("jquery");
$(document).ready(function() {
  var url = 'http://127.0.0.1:8000/api/cities'

/*  $.ajax({
    url: url,
    type: 'GET',
    success: function(data) {
      //console.log(data);
      console.log("ciao");
    //  renderDatalistCitta(data);
      collegaListener();
    },
    error: function(errore) {
      console.log(errore);
    }


  }) */

  //funzione per stampare via handlebars le citta nel datalist
/*  function renderDatalistCitta(data){
    var templateBase = $('#elencoCitta-template').html();
    var templateCompilato = Handlebars.compile(templateBase);
    var html = templateCompilato(data);
    $('#listaCitta').html(html);
  }

  function collegaListener(){
    $('.services').change( function(){
      leggivalori();


    });

  }

  function leggiValori(){
    var servizi = [];
    $.each($("input[name='services']:checked"), function(){
                servizi.push($(this).val());
            });
            console.log(servizi);
  }
  //invio del form che riesce a passare il data-id
  $('#cercaBtn').on('click', function(){
      //  e.preventDefault();

        var ricerca = $("#listaCitta option[value='" + $('#listaCitta-input').val() + "']").attr('data-id');
        var url = 'http://127.0.0.1:8000/api/cities';

        var room_count = $('.selectRoomCount').val();
        var bed_count = $('.selectBedCount').val();


        console.log(ricerca);
        console.log(room_count);
        console.log(bed_count);

        $.ajax({
          url: url,
          type: 'GET',
          data: {
           "city_code": ricerca,
           "room_count": room_count,
           "bed_count":bed_count,
           "order_type":4,
           "radius": 20
          },
          success: function(data) {
            var result = JSON.parse(data);
            console.log(result);

          },
          error: function(errore) {
            console.log(errore);
          }
        });
  }); */


});
