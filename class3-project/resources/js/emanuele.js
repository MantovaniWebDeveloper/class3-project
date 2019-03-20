import Handlebars from 'handlebars/dist/cjs/handlebars'

function doCall() {
    $.ajax('http://127.0.0.1:8000/cities', {
        success: function (data) {
            showData(data);
        },
        error: function () {
            console.log("errore");
        }
    });
}
//quando il document è caricato lancio la chiamata
doCall();

function showData(data) {
    //acquisisco script di handlebars pijesse na paralisi
    var source = document.getElementById("city-template").innerHTML;
    //compilo
    var template = Handlebars.compile(source);
    var html = template(data);
    //aggiungo html
    $('#cities').html(html);
}