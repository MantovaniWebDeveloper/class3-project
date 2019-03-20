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

      for(var i = 0; i < data.length; i++) {

        /*var codeCitta = data[i].code;
        var nameCitta = data[i].name;
        console.log(codeCitta);
        console.log(nameCitta);*/
        citta = {
          code: data[i].code,
          nome: data[i].name
        }

      }
      cittaItaliane.push(citta);

      //console.log(cittaItaliane);

      for(var i = 0; i < cittaItaliane.length; i++) {

        var templateBase = $('#elencoCitta-template').html();
        var templateCompilato = Handlebars.compile(templateBase);
        var context = {
               codeCitta: cittaItaliane[i].code,
               nomeCitta: cittaItaliane[i].nome
             };
        var htmlStampato = templateCompilato(context);
        $('cittaRisultato').appen(htmlStampato);

     }




    },
    error: function(errore) {
      console.log(errore);
    }

  })

});
