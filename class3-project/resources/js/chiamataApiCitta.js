import Handlebars from 'handlebars/dist/cjs/handlebars';

var $ = require("jquery");

$(document).ready(function() {
  var url = 'http://127.0.0.1:8000/api/cities';
  var cittaItaliane = [];
  //alert("sono vivo cazzo");
  $.ajax({
    url: url,
    type: 'GET',
    success: function(data) {
      //console.log(data);
      renderDatalistCitta(data);
    },
    error: function() {
      console.log("errore");
    }

  });

  //funzione per stampare via handlebars le citta nel datalist
  function renderDatalistCitta(data){
    var templateBase = $('#elencoCitta-template').html();
    var templateCompilato = Handlebars.compile(templateBase);
    var html = templateCompilato(data);
    $('#listaCitta').html(html);
  }

  //invio del form che riesce a passare il data-id
  $('#cercaBtn').on('click', function(e){
      e.preventDefault();
      var ricerca = $("#listaCitta option[value='" + $('#listaCitta-input').val() + "']").attr('data-id');

      $('#inputNascosto').val(ricerca);
      $('#formInterno').submit();
  });
})
