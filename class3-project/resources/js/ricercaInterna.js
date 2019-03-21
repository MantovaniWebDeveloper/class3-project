import Handlebars from 'handlebars/dist/cjs/handlebars';

var $ = require("jquery");

  //invio del form che riesce a passare il data-id
  $('#cercaBtn').on('click', function(e){
      e.preventDefault();
      var ricerca = $("#listaCitta option[value='" + $('#listaCitta-input').val() + "']").attr('data-id');

      $('#inputNascosto').val(ricerca);
      $('#formInterno').submit();
  });
