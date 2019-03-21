<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="{{asset('/js/app.js')}}"></script>
    </head>
    <body>
        @foreach($promoApartments as $promoApartment)
            <div class="">{{$promoApartment['title']}}</div>
        @endforeach
        <script>
            $.ajax({
                url: 'http://127.0.0.1:8000/api/cities',
                success: function (data) {
                    console.log(data);
                },
                error: function () {
                    console.log("errore");
                }
            });
        </script>
    </body>
</html>
