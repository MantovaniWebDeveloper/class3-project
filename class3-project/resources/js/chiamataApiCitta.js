import Handlebars from 'handlebars/dist/cjs/handlebars';

let $ = require("jquery");

$(document).ready(function () {
    let url = 'http://127.0.0.1:8000/api/cities';
    $.ajax({
        url: url,
        type: 'GET',
        success: function (data) {
            renderDatalistCitta(data);
        },
        error: function (errore) {
            console.log(errore);
        }

    });

    //funzione per stampare via handlebars le citta nel datalist
    function renderDatalistCitta(data) {
        let template = $('#elencoCitta-template').html();
        let compiled = Handlebars.compile(template);
        let html = compiled(data);
        $('#listaCitta').html(html);
    }

    //invio del form che riesce a passare il data-id
    $('#cercaBtn').on('click', function (e) {
        e.preventDefault();
        let ricerca = $("#listaCitta option[value='" + $('#listaCitta-input').val().replace("'", "\\'") + "']").attr('data-id');
        $('#inputNascosto').val(ricerca);
        $('#formInterno').submit();
    });
});