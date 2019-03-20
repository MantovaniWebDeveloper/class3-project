function doCall() {
    $.ajax('http://127.0.0.1:8000/cities', {
        success: function (data) {
            console.log(data);
        },
        error: function () {
            console.log("errore");
        }
    });
}
doCall();