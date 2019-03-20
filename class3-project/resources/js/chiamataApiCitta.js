import Handlebars from 'handlebars/dist/cjs/handlebars';

var $ = require("jquery");

$(document).ready(function() {
  var url = 'http://127.0.0.1:8000/api/cities'
  //alert("sono vivo cazzo");
  $.ajax({
    url: url,
    type: 'GET',
    success: function(data) {
      //console.log(data);

      for(var i = 0; i < data.length; i++) {

        var codeCitta = data[i].code;
        var nameCitta = data[i].name;
        console.log(codeCitta);
        console.log(nameCitta);

      }

    },
    error: function(errore) {
      console.log(errore);
    }

  })

});
