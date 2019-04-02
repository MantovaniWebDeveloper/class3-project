const $ = require('jquery');
const chartJs = require('chart.js');

showStats($('.check').data('slug'), "matteoTIVEDO!");
function showStats(slug, group) {
    let url = 'http://127.0.0.1:8000/api/apartment/stats';
    $.ajax(url, {

        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (result) {
            // console.log(result.messages);

            showMessGraph(result.messages);
            showViewsGraph(result.visits);

        },
        error: function (error) {
            console.log(error);
        },
        data: {
            'slug': slug,
            'group_by': group
        },
        complete: function () {
            // element.prop('disabled', false);
        }
    });
}

function showMessGraph(data) {
    let etichette = [];
    let valori = [];
    for (let etichetta in data) {
        etichette.push(etichetta);
        valori.push(data[etichetta]);
    }
    let ctx = document.getElementById('myChartmess').getContext('2d');
    let chart = new chartJs(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: etichette,
            datasets: [{
                data: valori,
                label: 'statistiche messaggi',
                // backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)'
            }]
        },

        // Configuration options go here
        options: {}
    });
}

function showViewsGraph(data) {
    // console.log(data);
    let etichette = [];
    let valori = [];
    for (let etichetta in data) {
        etichette.push(etichetta);
        valori.push(data[etichetta]);
    }
    console.log(etichette);
    console.log(valori);
    let ctx = document.getElementById('myChartview').getContext('2d');
    let chart = new chartJs(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: etichette,
            datasets: [{
                data: valori,
                label: 'statistiche visualizzazioni',
                // backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(235, 59, 42)'
            }]
        },

        // Configuration options go here
        options: {}
    });
}
