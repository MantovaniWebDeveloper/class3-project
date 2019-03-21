import Handlebars from 'handlebars/dist/cjs/handlebars';

var $ = require("jquery");

  //invio del form che riesce a passare il data-id
  $('#cercaBtn').on('click', function(e){
        e.preventDefault();

        var ricerca = $("#listaCitta option[value='" + $('#listaCitta-input').val() + "']").attr('data-id');
        var url = 'http://127.0.0.1:8000/api/cities';

        $.ajax({
          url: url,
          type: 'GET',
          success: function(data) {
            //console.log(data);
          
          },
          error: function(errore) {
            console.log(errore);
          }
        });
})
