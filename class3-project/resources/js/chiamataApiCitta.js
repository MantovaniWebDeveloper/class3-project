import Handlebars from 'handlebars/dist/cjs/handlebars';

var $ = require("jquery");

$(document).ready(function() {
  var url = 'http://127.0.0.1:8000/api/cities'
  var cittaItaliane = [];
  //alert("sono vivo cazzo");
  $.ajax({
    url: url,
    type: 'GET',
    success: function(data) {
      //console.log(data);
      var templateBase = $('#elencoCitta-template').html();
      var templateCompilato = Handlebars.compile(templateBase);
      var html = templateCompilato(data);
      $('#listaCitta').html(html);
    },
    error: function(errore) {
      console.log(errore);
    }


  })

  //recupero data value
$('#cercaBtn').on('click', function(e){
    e.preventDefault();
    var ricerca = $("#listaCitta option[value='" + $('#listaCitta-input').val() + "']").attr('data-id');

    $('#inputNascosto').val(ricerca);
    $('#formInterno').submit();
});
})
